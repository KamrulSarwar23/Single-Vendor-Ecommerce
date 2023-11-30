<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function cartDetails()
    {

        $cartItems = Cart::content();

        if (count($cartItems) == 0) {
            Session::forget('coupon');
            toastr('Please Add Product to Your Cart', 'warning', 'Cart is empty');
            return redirect()->route('home.page');
        }
        return view('frontend.pages.cart-details', compact('cartItems'));
    }

    public function addCart(Request $request)
    {

        $product = Product::findOrFail($request->product_id);

        // Check product Quantity
        if ($product->qty == 0) {
            return response(['status' => 'error', 'message' => 'Product Stock Out']);
        } else if ($product->qty < $request->qty) {
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }

        $variantTotalAmount = 0;
        $variants = [];

        if ($request->has('variants_items')) {
            foreach ($request->variants_items as $item_id) {
                $variantitem = ProductVariantItem::find($item_id);
                $variants[$variantitem->productVariantname->name]['name'] =  $variantitem->name;
                $variants[$variantitem->productVariantname->name]['price'] =  $variantitem->price;
                $variantTotalAmount += $variantitem->price;
            }
        }

        // Check Discount 

        $productPrice = 0;
        if (checkProductDiscount($product)) {
            $productPrice = $product->offer_price;
        } else {
            $productPrice = $product->price;
        }
        
        $cartdata = [];
        $cartdata['id'] = $product->id;
        $cartdata['name'] = $product->name;
        $cartdata['qty'] = $request->qty;
        $cartdata['price'] = $productPrice;
        $cartdata['weight'] = 10;
        $cartdata['options']['variants'] = $variants;
        $cartdata['options']['variants_total'] = $variantTotalAmount;
        $cartdata['options']['image'] = $product->thumb_image;
        $cartdata['options']['slug'] = $product->slug;

        Cart::add($cartdata);

        return response(['status' => 'success', 'message' => 'Product Added to cart successfully']);
    }

    public function updateProductQuantity(Request $request)
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        // Check product Quantity
        if ($product->qty == 0) {
            return response(['status' => 'error', 'message' => 'Product Stock Out']);
        } else if ($product->qty < $request->qty) {
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);
        return response(['status' => 'success', 'message' => 'Product Quantity Updated', 'product_total' => $productTotal]);
    }

    public function getProductTotal($rowId)
    {
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return  $total;
    }

    public function cartTotal()
    {
        $total = 0;

        foreach (Cart::content() as $product) {
            $total += $this->getProductTotal($product->rowId);
        }

        return $total;
    }

    // Clear Cart
    public function clearCart()
    {
        Cart::destroy();
        return response(['status' => 'success', 'message' => 'Cart Cleared Successfully']);
    }

    public function clearProduct($rowId)
    {
        Cart::remove($rowId);
        $cartItems = Cart::content();
        if (count($cartItems) > 0) {
            toastr('Product Removed From Cart Successfully');
        }

        return redirect()->back();
    }

    public function getCartCount()
    {
        return Cart::content()->count();
    }

    public function getCartProduct()
    {
        return Cart::content();
    }

    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);
        return response(['status' => 'success', 'message' => 'Product Removed From Cart Successfully']);
    }

    public function applyCoupon(Request $request)
    {

        if ($request->coupon_code == null) {
            return response(['status' => 'error', 'message' => 'Coupon Code is Required']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();
        if ($coupon == null) {
            return response(['status' => 'error', 'message' => 'Coupon Not Exists!']);
        } elseif ($coupon->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon Not Exists!']);
        } elseif ($coupon->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon is Expired!']);
        } elseif ($coupon->total_used >= $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'You can Not Apply This Coupon']);
        }

        if ($coupon->discount_type == 'amount') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount,
            ]);
        } elseif ($coupon->discount_type == 'percent') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount,
            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon Applied Successfully']);
    }

    // calculate coupon discount

    public function couponCalculation()
    {
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $subtotal = getTotalCartCount();
            if ($coupon['discount_type'] == 'amount') {
                $total = $subtotal - $coupon['discount'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            } elseif ($coupon['discount_type'] == 'percent') {
                $discount = ($subtotal * $coupon['discount'] / 100);
                $total = $subtotal - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);
            }
        } else {
            $total = getTotalCartCount();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);
        }
    }
}

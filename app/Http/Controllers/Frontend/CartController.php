<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addCart(Request $request)
    {

        $product = Product::findOrFail($request->product_id);
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

    public function cartDetails()
    {

        $cartItems = Cart::content();

        return view('frontend.pages.cart-details', compact('cartItems'));
    }

    public function updateProductQuantity(Request $request)
    {

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
    // Clear Cart
    public function clearCart()
    {
        Cart::destroy();
        return response(['status' => 'success', 'message' => 'Cart Cleared successfully']);
    }

    public function clearProduct($rowId)
    {
        Cart::remove($rowId);
        toastr('Product Removed From Cart Successfully');
        return redirect()->back();
    }

    public function getCartCount(){
        return Cart::content()->count();
    }
}

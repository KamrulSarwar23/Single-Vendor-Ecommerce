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
                $variants[$variantitem->productVariantname->name] ['name'] =  $variantitem->name;
                $variants[$variantitem->productVariantname->name] ['price'] =  $variantitem->price;
                $variantTotalAmount += $variantitem->price;
            }
        }
      
        // Check Discount 

        $productTotalAmount = 0;
        if (checkProductDiscount($product)) {
            $productTotalAmount = ($product->offer_price + $variantTotalAmount);
        }else{
            $productTotalAmount = ($product->price + $variantTotalAmount);
        }

        $cartdata = [];
        $cartdata['id'] = $product->id;
        $cartdata['name'] = $product->name;
        $cartdata['qty'] = $request->qty;
        $cartdata['price'] = $productTotalAmount * $request->qty;
        $cartdata['weight'] = 10;
        $cartdata['options'] ['variants']= $variants;
        $cartdata['options'] ['image'] = $product->thumb_image; 
        $cartdata['options'] ['slug'] = $product->slug; 

        Cart::add($cartdata);

        return response(['status' => 'success', 'message'=> 'Product Added to cart successfully']);
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FlashSale;
class FrontendProductController extends Controller
{
    public function showProduct(string $slug){

        $product = Product::with('vendor', 'category', 'productImageGallery', 'variant', 'brand')->where('slug', $slug)->where('status', 1)->first();
        $flashSaleDate = FlashSale::first();
        return view('frontend.pages.product-details', compact('product', 'flashSaleDate'));
    }
}

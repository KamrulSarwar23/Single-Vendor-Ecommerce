<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FlashSale;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Session;

class FrontendProductController extends Controller
{

    public function productIndex(Request $request)
    {
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();
            $products = Product::where([
                'category_id' =>  $category->id,
                'status' => 1,
                'is_approved' => 1
            ])->paginate(12);
            
        } elseif ($request->has('subcategory')) {
            $subcategory = SubCategory::where('slug', $request->subcategory)->first();
            $products = Product::where([
                'subcategory_id' =>  $subcategory->id,
                'status' => 1,
                'is_approved' => 1
            ])->paginate(12);

        } elseif ($request->has('childcategory')) {
            $childcategory = ChildCategory::where('slug', $request->childcategory)->first();
            $products = Product::where([
                'childcategory_id' =>  $childcategory->id,
                'status' => 1,
                'is_approved' => 1
            ])->paginate(12);
        }

        return view('frontend.pages.product', compact('products'));
    }


    public function showProduct(string $slug)
    {
        $product = Product::with('vendor', 'category', 'productImageGallery', 'variant', 'brand')->where('slug', $slug)->where('status', 1)->first();
        $flashSaleDate = FlashSale::first();
        return view('frontend.pages.product-details', compact('product', 'flashSaleDate'));
    }

    public function productListView(Request $request)
    {
        Session::put('product-list-style', $request->style);
    }
}

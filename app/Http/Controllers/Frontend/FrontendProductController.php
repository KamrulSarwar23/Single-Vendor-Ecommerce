<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FlashSale;
use App\Models\Review;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
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
            ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0];
                    $to = $price[1];
                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } elseif ($request->has('subcategory')) {
            $subcategory = SubCategory::where('slug', $request->subcategory)->first();
            $products = Product::where([
                'subcategory_id' =>  $subcategory->id,
                'status' => 1,
                'is_approved' => 1
            ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0];
                    $to = $price[1];
                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } elseif ($request->has('childcategory')) {
            $childcategory = ChildCategory::where('slug', $request->childcategory)->first();
            $products = Product::where([
                'childcategory_id' =>  $childcategory->id,
                'status' => 1,
                'is_approved' => 1
            ])

                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0];
                    $to = $price[1];
                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } elseif ($request->has('brand')) {
            $brand = Brand::where('slug', $request->brand)->firstOrFail();

            $products = Product::where([
                'brand_id' =>  $brand->id,
                'status' => 1,
                'is_approved' => 1
            ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    $from = $price[0];
                    $to = $price[1];
                    return $query->where('price', '>=', $from)->where('price', '<=', $to);
                })
                ->paginate(12);
        } elseif ($request->has('search')) {
            $products = Product::where(['status' => 1, 'is_approved' => 1])->where(function ($query) use ($request) {
                $query->where('name', 'Like', '%' . $request->search . '%')
                    ->orwhere('long_description', 'Like', '%' . $request->search . '%')
                    ->orwhere('short_description', 'Like', '%' . $request->search . '%')
                    ->orwhereHas('category', function ($query) use ($request) {
                        $query->where('name', 'Like', '%' . $request->search . '%')
                            ->orwhere('long_description', 'Like', '%' . $request->search . '%')
                            ->orwhere('short_description', 'Like', '%' . $request->search . '%');
                    })

                    ->orwhereHas('subcategory', function ($query) use ($request) {
                        $query->where('name', 'Like', '%' . $request->search . '%')
                            ->orwhere('long_description', 'Like', '%' . $request->search . '%')
                            ->orwhere('short_description', 'Like', '%' . $request->search . '%');
                    })

                    ->orwhereHas('childcategory', function ($query) use ($request) {
                        $query->where('name', 'Like', '%' . $request->search . '%')
                            ->orwhere('long_description', 'Like', '%' . $request->search . '%')
                            ->orwhere('short_description', 'Like', '%' . $request->search . '%');
                    })

                    ->orwhereHas('brand', function ($query) use ($request) {
                        $query->where('name', 'Like', '%' . $request->search . '%')
                            ->orwhere('long_description', 'Like', '%' . $request->search . '%')
                            ->orwhere('short_description', 'Like', '%' . $request->search . '%');
                    });
            })->paginate(12);
        } else {
            $products = Product::where(['status' => 1, 'is_approved' => 1])->orderBy('id', 'DESC')->paginate(12);
        }


        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();

        $product_page_banner = Advertisement::where('key', 'product-page-banner')->first();
        $product_page_banner = json_decode($product_page_banner->value);

        return view('frontend.pages.product', compact('products', 'categories', 'brands', 'product_page_banner'));
    }


    public function showProduct(string $slug)
    {
        $product = Product::with('vendor', 'category', 'productImageGallery', 'variant', 'brand')->where('slug', $slug)->where('status', 1)->first();
        $flashSaleDate = FlashSale::first();
        $productReview = Review::where('product_id', $product->id)->where('status', 1)->paginate(10);
        return view('frontend.pages.product-details', compact('product', 'flashSaleDate', 'productReview'));
    }

    public function productListView(Request $request)
    {
        Session::put('product-list-style', $request->style);
    }
}

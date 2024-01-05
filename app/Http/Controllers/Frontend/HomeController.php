<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSale;
use App\Models\FooterGridThree;
use App\Models\Slider;
use App\Models\FlashSaleItem;
use App\Models\FooterGridTwo;
use App\Models\FooterInfo;
use App\Models\FooterSocial;
use App\Models\FooterTitle;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Vendor;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItem = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();
        $brands = Brand::where('is_featured', 1)->where('status', 1)->get();
        $typeBaseProduct = $this->getTypeBaseProduct();
        $categorySliderProductOne = HomePageSetting::where('key', 'product_slider_one')->first();
        $categorySliderProductTwo = HomePageSetting::where('key', 'product_slider_two')->first();
        $categorySliderProductThree = HomePageSetting::where('key', 'product_slider_three')->first();
        $categories = Category::get();
        $subcategories = SubCategory::all();
        $childcategories = ChildCategory::all();

        $home_page_banner_section_one = Advertisement::where('key', 'home-page-banner-section-one')->first();
        $home_page_banner_section_one = json_decode($home_page_banner_section_one->value);

        $home_page_banner_section_two = Advertisement::where('key', 'home-page-banner-section-two')->first();
        $home_page_banner_section_two = json_decode($home_page_banner_section_two->value);

        $home_page_banner_section_three = Advertisement::where('key', 'home-page-banner-section-three')->first();
        $home_page_banner_section_three = json_decode($home_page_banner_section_three->value);

        $home_page_banner_section_four = Advertisement::where('key', 'home-page-banner-section-four')->first();
        $home_page_banner_section_four = json_decode($home_page_banner_section_four->value);
        return view(
            'frontend.home.home',
            compact(
                'sliders',
                'flashSaleDate',
                'flashSaleItem',
                'popularCategory',
                'brands',
                'typeBaseProduct',
                'categorySliderProductOne',
                'categorySliderProductTwo',
                'categorySliderProductThree',
                'categories',
                'subcategories',
                'childcategories',
                'home_page_banner_section_one',
                'home_page_banner_section_two',
                'home_page_banner_section_three',
                'home_page_banner_section_four'
            )
        );
    }

    public function getTypeBaseProduct()
    {
        $typeBaseProduct = [];
        $typeBaseProduct['new_arrival'] = Product::where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProduct['featured_product'] = Product::where(['product_type' => 'featured_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProduct['top_product'] = Product::where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProduct['best_product'] = Product::where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        return $typeBaseProduct;
    }

    public function vendorPage()
    {
        $vendor = Vendor::paginate(10);
        return view('frontend.pages.vendor', compact('vendor'));
    }

    public function vendorProduct(string $id)
    {
        $products = Product::where(['status' => 1, 'is_approved' => 1, 'vendor_id' => $id])->orderBy('id', 'DESC')->paginate(12);
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        $vendor = Vendor::findOrfail($id);

        return view('frontend.pages.vendor-product', compact('products', 'categories', 'brands', 'vendor'));
    }
}

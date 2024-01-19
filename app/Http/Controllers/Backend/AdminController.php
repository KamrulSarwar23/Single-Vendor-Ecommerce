<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Coupon;
use App\Models\NewsLettersubscriber;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use NunoMaduro\Collision\Adapters\Phpunit\Subscribers\Subscriber;

class AdminController extends Controller
{

    public function dashboard(){

        $todaysOrder = Order::whereDate('created_at', Carbon::today())->count();
        $todaysPendingOrder = Order::whereDate('created_at', Carbon::today())->where('order_status', '!=', 'delivered')->where('order_status', '!=', 'cancel')->count();
        $totalCompleteOrder = Order::where('order_status', 'delivered')->count();
        $totalPendingOrder = Order::where('order_status', '!=', 'delivered')->where('order_status', '!=', 'cancel')->count();
        $totalCancelOrder = Order::where('order_status', '=', 'cancel')->count();
        $totalOrder = Order::count();

        $todaysEarning = Order::where('order_status','!=', 'cancel')->where('payment_status', 1)->whereDate('created_at', Carbon::today())->sum('sub_total');
        $monthEarning = Order::where('order_status','!=', 'cancel')->where('payment_status', 1)->whereMonth('created_at', Carbon::now()->month)->sum('sub_total');
        $yearEarning = Order::where('order_status','!=', 'cancel')->where('payment_status', 1)->whereYear('created_at', Carbon::now()->year)->sum('sub_total');
        $totalEarning = Order::where('order_status','!=', 'cancel')->where('payment_status', 1)->sum('sub_total');

        $totalReview = Review::count();
        $totalBrand = Brand::count();
        $totalCategory = Category::count();
        $totalSubCategory = SubCategory::count();
        $totalChildCategory = ChildCategory::count();
        $totalCoupon = Coupon::count();
        $totalBlog = Blog::count();
        $totalCustomer = User::where('role', 'user')->count();
        $totalSubscriber = NewsLettersubscriber::where('is_verified', 1)->count();
        $totalVendor = User::where('role', 'vendor')->count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalProduct = Product::count();
        $totalSellerProduct = Product::where('vendor_id', '!=', Auth::user()->vendor->id)->count();
        $totalPendingProduct = Product::where('is_approved', 0)->count();

        return view('admin.dashboard', compact([
            'todaysOrder',
            'todaysPendingOrder',
            'totalCompleteOrder',
            'totalPendingOrder',
            'totalCancelOrder',
            'totalOrder',
            'todaysEarning',
            'monthEarning',
            'yearEarning',
            'totalEarning',
            'totalReview',
            'totalBrand',
            'totalCategory',
            'totalSubCategory',
            'totalChildCategory',
            'totalCoupon',
            'totalBlog',
            'totalCustomer',
            'totalSubscriber',
            'totalVendor',
            'totalAdmin',
            'totalProduct',
            'totalSellerProduct',
            'totalPendingProduct'
        ]));
        
    }

    public function login(){

        return view('admin.auth.login');
        
    }

}
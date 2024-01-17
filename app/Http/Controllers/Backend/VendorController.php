<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Review;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function dashboard()
    {
        $todaysorder = Order::whereDate('created_at', Carbon::today())->whereHas('orderProduct', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $todayspendingorder = Order::whereDate('created_at', Carbon::today())->where('order_status', '!=', 'delivered')->whereHas('orderProduct', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalorder = Order::whereHas('orderProduct', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalpendingorder = Order::where('order_status', '!=', 'delivered')->whereHas('orderProduct', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalcompletedorder = Order::where('order_status', 'delivered')->whereHas('orderProduct', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalproduct = Product::where('vendor_id', Auth::user()->vendor->id)->count();

        $todaysearning = OrderProduct::whereDate('created_at', Carbon::today())->whereHas('order', function ($query) {
            $query->where('order_status', 'delivered')
                ->whereDate('created_at', Carbon::today())
                ->where('vendor_id', Auth::user()->vendor->id);
        })
            ->select(DB::raw('SUM(unit_price * qty) as todays_earning'))
            ->first()
            ->todays_earning;


        $thismonthearning = OrderProduct::whereMonth('created_at', Carbon::now()->month)->whereHas('order', function ($query) {
            $query->where('order_status', 'delivered')
                ->whereDate('created_at', Carbon::today())
                ->where('vendor_id', Auth::user()->vendor->id);
        })
            ->select(DB::raw('SUM(unit_price * qty) as month_earning'))
            ->first()
            ->month_earning;

        $thisyearearning = OrderProduct::whereMonth('created_at', Carbon::now()->month)->whereHas('order', function ($query) {
            $query->where('order_status', 'delivered')
                ->whereDate('created_at', Carbon::today())
                ->where('vendor_id', Auth::user()->vendor->id);
        })
            ->select(DB::raw('SUM(unit_price * qty) as year_earning'))
            ->first()
            ->year_earning;

        $totalearning = OrderProduct::whereHas('order', function ($query) {
            $query->where('order_status', 'delivered')
                ->whereDate('created_at', Carbon::today())
                ->where('vendor_id', Auth::user()->vendor->id);
        })
            ->select(DB::raw('SUM(unit_price * qty) as total_earning'))
            ->first()
            ->total_earning;

        $totalreview = Review::whereHas('product', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();


        // $todaysearning = Order::where('order_status', 'delivered')->whereDate('created_at', Carbon::today())->whereHas('orderProduct', function ($query) {
        //     $query->where('vendor_id', Auth::user()->vendor->id);
        // })->sum('sub_total');

        // $thismonthearning = Order::whereMonth('created_at', Carbon::now()->month)->where('order_status', 'delivered')->whereHas('orderProduct', function ($query) {
        //     $query->where('vendor_id', Auth::user()->vendor->id);
        // })->sum('sub_total');

        // $thisyearearning = Order::whereYear('created_at', Carbon::now()->year)->where('order_status', 'delivered')->whereHas('orderProduct', function ($query) {
        //     $query->where('vendor_id', Auth::user()->vendor->id);
        // })->sum('sub_total');

        // $totalearning = Order::where('order_status', 'delivered')->whereHas('orderProduct', function ($query) {
        //     $query->where('vendor_id', Auth::user()->vendor->id);
        // })->sum('sub_total');


        return view(
            'vendor.dashboard.dashboard',
            compact(
                'todaysorder',
                'todayspendingorder',
                'totalorder',
                'totalpendingorder',
                'totalcompletedorder',
                'totalproduct',
                'todaysearning',
                'thismonthearning',
                'thisyearearning',
                'totalearning',
                'totalreview'
            )
        );
    }
}

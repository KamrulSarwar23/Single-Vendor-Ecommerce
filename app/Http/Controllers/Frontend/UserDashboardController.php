<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
   public function index()
   {
      $totalorder = Order::where('user_id', Auth::user()->id)->count();
      $completeorder = Order::where('user_id', Auth::user()->id)->where('order_status', 'delivered')->count();
      $pendingorder = Order::where('user_id', Auth::user()->id)->where('order_status', '!=', 'delivered')->count();
      $totalreview = Review::where('user_id', Auth::user()->id)->count();
      $wishlist = WishList::where('user_id', Auth::user()->id)->count();

      return view('frontend.dashboard.dashboard', compact('totalorder', 'completeorder', 'totalreview', 'wishlist', 'pendingorder'));
   }
}

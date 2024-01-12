<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ProductTrackController extends Controller
{
    public function index(Request $request)
    {
        $order = '';
        if ($request->has('track_id')) {
            $order = Order::where('invoice_id', $request->track_id)->first();
            return view('frontend.pages.product-track', compact('order'));
        } else {
            return view('frontend.pages.product-track');
        }
    }
}

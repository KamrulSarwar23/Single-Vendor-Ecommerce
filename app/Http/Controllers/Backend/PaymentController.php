<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function payment()
    {
        if (!session::has('shipping_address')) {
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }
}

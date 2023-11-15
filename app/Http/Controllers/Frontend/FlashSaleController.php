<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;

class FlashSaleController extends Controller
{
    public function index(){

        $flashSaleDate = FlashSale::first();
        $flashSaleItem = FlashSaleItem::where('status', 1)->orderBy('id', 'DESC')->paginate(20);

        return view('frontend.pages.flashsale', compact('flashSaleDate', 'flashSaleItem'));
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductReviewsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorProductReviewController extends Controller
{
    public function index(VendorProductReviewsDataTable $datatable){
        return $datatable->render('vendor.review.index');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerPendingProductsDataTable;
use App\DataTables\SellerProductsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SellerProductController extends Controller
{
    public function index(SellerProductsDataTable $datatable){
        return $datatable->render('admin.products.seller-products.index');
    }

    public function pendingProducts(SellerPendingProductsDataTable $dataTable){
        return $dataTable->render('admin.products.seller-pending-products.index');
    }

    public function chnageapprovestatus(Request $request){

        $product = Product::findOrFail($request->id);
        $product->is_approved = $request->value;
        $product->save();

        return response(['message' => 'Product Approve Status Has Been Changed']);
    }
}

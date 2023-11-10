<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantItemController extends Controller
{
    public function index(VendorProductVariantItemDataTable $datatable, $productId, $variantId)
    {

        $product = Product::findOrFail($productId);

           // Check Product Vendor
           if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }

        $variant = ProductVariant::findOrFail($variantId);
        return $datatable->render('vendor.product.product-variant-item.index', compact('product', 'variant'));
    }

    public function create(string $productId, string $variantId)
    {

        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);
        return view('vendor.product.product-variant-item.create', compact('variant', 'product'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'variant_id' => ['integer', 'required'],
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);


        $variantItem = new ProductVariantItem();
        $variantItem->product_variant_id = $request->variant_id;
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();

        toastr('created successfully', 'success');
        return redirect()->route(
            'vendor.product-variant-item.index',
            ['productId' => $request->product_id, 'variantId' => $request->variant_id]
        );
    }

    public function edit(string $variantItemId)
    {
        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        return view('vendor.product.product-variant-item.edit', compact('variantItem'));
    }


    public function update(string $variantItemId, Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);


        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();

        toastr('created successfully', 'success');
        return redirect()->route(
            'vendor.product-variant-item.index',
            ['productId' => $variantItem->productVariantname->product_id, 'variantId' => $variantItem->product_variant_id]
        );
    }

    public function destroy(string $variantItemId)
    {
        $productVariantItem = ProductVariantItem::findOrFail($variantItemId);
        $productVariantItem->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }


    public function changeStatus(Request $request)
    {
        $productVariantItem = ProductVariantItem::findOrFail($request->id);
        $productVariantItem->status = $request->status == 'true' ? 1 : 0;
        $productVariantItem->save();

        return response(['message' => 'Status has been Updated!']);
    }
}

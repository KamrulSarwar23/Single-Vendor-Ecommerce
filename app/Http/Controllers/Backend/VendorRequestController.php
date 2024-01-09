<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorRequestController extends Controller
{
    public function index(VendorRequestDataTable $datatable)
    {
        return $datatable->render('admin.vendor-request.index');
    }

    public function show(string $id)
    {
        $vendorrequest = Vendor::findOrFail($id);
        return view('admin.vendor-request.show', compact('vendorrequest'));
    }

    public function changeVendorStatus(Request $request)
    {
        $vendor = Vendor::findOrFail($request->id);
        $vendor->status = $request->status;
        $vendor->save();

        $user = User::findOrFail($vendor->user_id);
        $user->role = 'vendor';
        $user->save();
        return response(['status' => 'success', 'message' => 'Vendor Status Updated successfully']);
    }

}

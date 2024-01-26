<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminListDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    public function index(AdminListDataTable $datatable)
    {
        return $datatable->render('admin.admin-list.index');
    }

    public function changeStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status == 'true' ? 'active' : 'inactive';
        $user->save();

        return response(['message' => 'Status has been Updated!']);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $product = Product::where('vendor_id', $user->vendor->id)->get();
        if (count($product) > 0) {
            return response(['status' => 'error', 'message' => 'This User contains Products. For delete this you have to delete product first']);
        }
        Vendor::where('user_id', $user->id)->delete();
        $user->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }
}

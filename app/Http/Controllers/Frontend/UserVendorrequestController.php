<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVendorrequestController extends Controller
{
    use ImageUploadTrait;

    public function vendorRequest()
    {
        return view('frontend.dashboard.vendor-request.index');
    }

    public function vendorRequestSend(Request $request)
    {
        $request->validate([
            'shop_image' => ['required', 'image', 'max:3000'],
            'shop_name' => ['required', 'max:200'],
            'shop_email' => ['required', 'email'],
            'shop_phone' => ['required', 'max:200'],
            'shop_address' => ['required'],
            'about' => ['required'],
        ]);

        $imagePaths = $this->uploadImage($request, 'shop_image', 'uploads');

        $vendor = new Vendor();
        $vendor->banner = $imagePaths;
        $vendor->phone = $request->shop_phone;
        $vendor->user_id = Auth::user()->id;
        $vendor->email = $request->shop_email;
        $vendor->address = $request->shop_address;
        $vendor->shop_name = $request->shop_name;
        $vendor->description = $request->about;
        $vendor->status = 0;
        $vendor->save();
        toastr('Request Send Successfully! Please Wait for Approve', 'success', 'success');
        return redirect()->back();
    }
}

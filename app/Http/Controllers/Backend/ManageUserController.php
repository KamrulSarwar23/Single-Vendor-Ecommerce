<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreatedMail;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Helper\MailHelper;

class ManageUserController extends Controller
{
    public function index()
    {
        return view('admin.manage-user.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'role' => ['required']
        ]);

        $user = new User();


        if ($request->role === 'admin') {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'admin';
            $user->status = 'active';
            $user->save();

            $vendor = new Vendor();
            $vendor->banner = 'uploads/12345.jpg';
            $vendor->shop_name = 'Shop Name';
            $vendor->phone = 'Your Number';
            $vendor->email = $request->email;
            $vendor->address = 'address';
            $vendor->description = 'shop description';
            $vendor->user_id = $user->id;
            $vendor->status = 1;
            $vendor->save();
            MailHelper::setMailConfig();
            Mail::to($request->email)->send(new AccountCreatedMail($request->name, $request->email, $request->password));
            toastr('Created Successfully');
            return redirect()->back();
        
        } else if ($request->role === 'vendor') {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'vendor';
            $user->status = 'active';
            $user->save();

            $vendor = new Vendor();
            $vendor->banner = 'uploads/12345.jpg';
            $vendor->shop_name = 'Shop  Name';
            $vendor->phone = '01572144151';
            $vendor->email = $request->email;
            $vendor->address = 'address';
            $vendor->description = 'shop description';
            $vendor->user_id = $user->id;
            $vendor->status = 1;
            $vendor->save();
            MailHelper::setMailConfig();
            Mail::to($request->email)->send(new AccountCreatedMail($request->name, $request->email, $request->password));
            toastr('Created Successfully');
            return redirect()->back();

        } else if ($request->role === 'user')  {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = 'user';
            $user->status = 'active';
            $user->save();
            MailHelper::setMailConfig();
            Mail::to($request->email)->send(new AccountCreatedMail($request->name, $request->email, $request->password));
            toastr('Created Successfully');
            return redirect()->back();
        }

    }
}

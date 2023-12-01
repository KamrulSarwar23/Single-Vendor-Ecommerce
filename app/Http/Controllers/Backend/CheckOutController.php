<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    public function index()
    {
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();
        $shippingMethods = ShippingRule::where('status', 1)->get();
        return view('frontend.pages.checkout', compact('addresses', 'shippingMethods'));
    }

    public function checkoutCreateAddress(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'max:200', 'email'],
            'phone' => ['required', 'max:200'],
            'country' => ['required', 'max:200'],
            'state' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'zip_code' => ['required', 'max:200'],
            'address' => ['required'],
        ]);

        $address = new UserAddress();
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->zip_code = $request->zip_code;
        $address->address = $request->address;
        $address->save();
        toastr('Successfully Added');
        return redirect()->route('user.checkout');
    }

    public function checkoutFormSubmit(Request $request)
    {
        $request->validate([
            'shipping_method_id' => ['required', 'integer'],
            'shipping_address_id' => ['required', 'integer'],
        ]);

        $shipping_method = ShippingRule::findOrFail($request->shipping_method_id);

        if ($shipping_method) {
            Session::put('shipping_method', [
                'id' => $shipping_method->id,
                'name' => $shipping_method->name,
                'type' => $shipping_method->type,
                'cost' => $shipping_method->cost,
            ]);
        }

        $shipping_address = UserAddress::findOrFail($request->shipping_address_id)->toArray();
        if ($shipping_address) {
            Session::put('shipping_address', $shipping_address);
        }

        return response(['status' => 'success', 'redirect_url' => route('user.payment')]);
    }
}

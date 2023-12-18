<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function wishList()
    {
        $wishlistproducts = WishList::with('product')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.pages.wishlist', compact('wishlistproducts'));
    }

    public function addTowishList(Request $request)
    {

        if (!Auth::check()) {
            return response(['status' => 'error', 'message' => 'Login before added to wishlist']);
        }

        $wishlistcount = WishList::where(['product_id' => $request->id, 'user_id' => Auth::user()->id])->count();

        if ($wishlistcount > 0) {
            return response(['status' => 'error', 'message' => 'The product is already at wish list']);
        }

        $wishlist = new WishList();
        $wishlist->product_id = $request->id;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->save();
        $count = WishList::where('user_id', Auth::user()->id)->count();

        return response(['status' => 'success', 'message' => 'Product added into wishlist successfully', 'count' => $count]);
    }

    public function removeFromWishList(Request $request)
    {

        $wishlist = WishList::where('product_id', $request->id)->first();
        $wishlist->delete();
        return response(['status' => 'success', 'message' => 'Product removed from wishlist successfully']);
    }

}

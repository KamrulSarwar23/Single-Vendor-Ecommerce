<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserProductreviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    use ImageUploadTrait;


    public function index(UserProductreviewsDataTable $datatable){
        return $datatable->render('frontend.dashboard.review.index');
    }

    public function create(Request $request)
    {

        $request->validate([
            'rating' => ['required'],
            'review' => ['required', 'max:200'],
            'images.*' => ['image'],
        ]);


        $imagePaths = $this->uploadMultiImage($request, 'image', 'uploads');

        $count = Review::where(['user_id' => Auth::user()->id, 'product_id' => $request->product_id])->first();


        if ($count) {
            toastr('You Already Added a Review For this Product', 'error', 'error');
            return redirect()->back();
        }

        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->product_id = $request->product_id;
        $review->vendor_id = $request->vendor_id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->status = 0;
        $review->save();

        if (!empty($imagePaths)) {

            foreach ($imagePaths as $path) {
                $reviewImage = new ReviewImage();
                $reviewImage->review_id = $review->id;
                $reviewImage->image = $path;
                $reviewImage->save();
            }
        }
        toastr('Review created successfully');
        return redirect()->back();
    }
}

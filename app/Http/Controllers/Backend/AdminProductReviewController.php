<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminProductReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminProductReviewController extends Controller
{
    public function index(AdminProductReviewDataTable $datatable){
        return $datatable->render('admin.review.index');
    }

    public function changeReviewStatus(Request $request){
        $review = Review::findOrFail($request->id);
        $review->status = $request->status == 'true' ? 1 : 0;
        $review->save();
        return response(['message' => 'Status has been Updated!']);
    }

    public function destory(string $id){
        $review = Review::findOrFail($id);
        $review->delete();
        return response(['status'=> 'success', 'message' => 'Deleted Successfully']);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\NewsLettersubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Mail\NewsLetter;
use App\Models\NewsLettersubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function index(NewsLettersubscriberDataTable $datatable)
    {
        return $datatable->render('admin.subscriber.index');
    }

    public function destory(string $id)
    {
        $subscriber = NewsLettersubscriber::findOrFail($id)->delete();
        return response(['status' => 'success', 'message' => 'Subscriber deleted successfully']);
    }

    public function sendMail(Request $request){
        $request->validate([
            'subject' => ['required'],
            'message' => ['required'],
        ]);

        $emails = NewsLettersubscriber::where('is_verified', 1)->pluck('email')->toArray();

        Mail::to($emails)->send(new NewsLetter($request->subject, $request->message));

        toastr('Message sent successfully');
        return redirect()->back();

    }
} 

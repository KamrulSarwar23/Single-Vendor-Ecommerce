<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\NewsLettersubscriber;
use Illuminate\Http\Request;
use Str;
use Mail;

class NewsLetterController extends Controller
{
    public function newsLetterRequest(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $existsubscriber = NewsLettersubscriber::where('email', $request->email)->first();

        if (!empty($existsubscriber) > 0) {
            if ($existsubscriber->is_verified == 0) {
                $existsubscriber->verified_token = \Str::random(25);
                $existsubscriber->save();

                // set mail config
                MailHelper::setMailConfig();
                //Send mail
                Mail::to($existsubscriber->email)->send(new SubscriptionVerification($existsubscriber));
                return response(['status' => 'success', 'message' => 'A Verification Link has been sent to this email! Please Check']);
            } elseif ($existsubscriber->is_verified == 1) {
                return response(['status' => 'error', 'message' => 'You already subscribed with this email']);
            }
        } else {
            $subscriber = new NewsLettersubscriber();
            $subscriber->email = $request->email;
            $subscriber->verified_token = \Str::random(25);
            $subscriber->is_verified = 0;
            $subscriber->save();

            // set mail config
            MailHelper::setMailConfig();

            //Send mail
            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));
            return response(['status' => 'success', 'message' => 'A Verification Link has been sent to this email! Please Check']);
        }
    }


    public function newsLetterEmailVerify($token)
    {
        $verify = NewsLettersubscriber::where('verified_token', $token)->first();
        if ($verify) {
            $verify->verified_token = 'verified';
            $verify->is_verified = 1;
            $verify->save();
            toastr('Email Verification Success', 'success', 'success');
            return redirect()->route('home.page');
        } else {
            toastr('Invalid Token', 'error', 'error');
            return redirect()->route('home.page');
        }
    }
}

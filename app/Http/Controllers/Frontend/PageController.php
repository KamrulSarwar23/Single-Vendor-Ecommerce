<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Mail\Contact;
use App\Models\EmailConfig;
use App\Models\GeneralSetting;
use App\Models\TermsCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helper\MailHelper;

class PageController extends Controller
{
    public function aboutPage()
    {
        $aboutcontent = About::first();
        return view('frontend.pages.about', compact('aboutcontent'));
    }

    public function termsConditionPage()
    {
        $termsConditioncontent = TermsCondition::first();
        return view('frontend.pages.terms-condition', compact('termsConditioncontent'));
    }

    public function contactPage()
    {
        $contactinfo = GeneralSetting::first();
        $contactPage = TermsCondition::first();
        return view('frontend.pages.contact', compact('contactPage', 'contactinfo'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'max:200'],
            'message' => ['required', 'max:1000'],
        ]);

        $email = EmailConfig::first();
        MailHelper::setMailConfig();
        Mail::to($email->email)->send(new Contact($request->subject, $request->message, $request->email));
        return response(['status' => 'success', 'message' => 'Message Sent']);
    }

}

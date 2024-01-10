<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\TermsCondition;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function aboutPage(){
        $aboutcontent = About::first();
        return view('frontend.pages.about', compact('aboutcontent'));
    }

    public function termsConditionPage(){
        $termsConditioncontent = TermsCondition::first();
        return view('frontend.pages.terms-condition', compact('termsConditioncontent'));
    }
}

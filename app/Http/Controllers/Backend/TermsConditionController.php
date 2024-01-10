<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TermsCondition;
use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    public function index(){
        $termsconditioncontent =TermsCondition::first();
        return view('admin.termscondition.index', compact('termsconditioncontent'));
    }

    public function update(Request $request)
    {   
        $request->validate([
            'content' => ['required']
        ]);

        TermsCondition::updateOrCreate(
            ['id' => 1],
            ['content' => $request->content]
        );

        toastr('Update Successfully');
        return redirect()->back();
    }
}

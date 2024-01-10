<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $aboutcontent =About::first();
        return view('admin.about.index', compact('aboutcontent'));
    }

    public function update(Request $request)
    {   
        $request->validate([
            'content' => ['required']
        ]);

        About::updateOrCreate(
            ['id' => 1],
            ['content' => $request->content]
        );

        toastr('Update Successfully');
        return redirect()->back();
    }
}

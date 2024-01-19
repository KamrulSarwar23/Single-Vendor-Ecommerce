<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CodSetting;

class CodSettingController extends Controller
{

    public function CodSetting(Request $request){
        $request->validate([
            'status' => ['required']
        ]);

        CodSetting::updateOrCreate(
            ['id' => 1],

            ['status' =>  $request->status]
        );

        toastr('Updated Succesfully', 'success', 'success');

        return redirect()->back();

    }
}

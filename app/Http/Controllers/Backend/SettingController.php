<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfig;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $emailconfig = EmailConfig::first();
        $generalSetting = GeneralSetting::first();
        return view('admin.settings.index', compact('generalSetting', 'emailconfig'));
    }

    public function generalSettingUpdate(Request $request)
    {
        $request->validate([
            'site_name' => ['required', 'max:200'],
            'layout' => ['required', 'max:200'],
            'contact_email' => ['required', 'max:200'],
            'currency_name' => ['required', 'max:200'],
            'currency_icon' => ['required', 'max:200'],
            'time_zone' => ['required']
        ]);

        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'layout' => $request->layout,
                'contact_email' => $request->contact_email,
                'contact_phone' => $request->contact_phone,
                'contact_address' => $request->contact_address,
                'map' => $request->map,
                'currency_name' => $request->currency_name,
                'currency_icon' => $request->currency_icon,
                'time_zone' => $request->time_zone
            ]
        );

        toastr('Updated Successfully');

        return redirect()->back();
    }

    public function emailConfigSetting(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'mail_host' => ['required'],
            'smtp_username' => ['required'],
            'smtp_password' => ['required'],
            'mail_port' => ['required'],
            'mail_encryption' => ['required'],
        ]);

        $emailconfig = EmailConfig::updateOrCreate(
            [
                'id' => 1,
            ],

            [
                'email' => $request->email,
                'mail_host' => $request->mail_host,
                'smtp_username' => $request->smtp_username,
                'smtp_password' => $request->smtp_password,
                'mail_port' => $request->mail_port,
                'mail_encryption' => $request->mail_encryption,
            ]
        );

        toastr('Updated Successfully');
        return redirect()->back();
    }
}

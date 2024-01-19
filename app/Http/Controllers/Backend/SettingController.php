<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfig;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;

class SettingController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $emailconfig = EmailConfig::first();
        $generalSetting = GeneralSetting::first();
        $logoSetting = LogoSetting::first();
        return view('admin.settings.index', compact('generalSetting', 'emailconfig', 'logoSetting'));
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

    public function logoSettingUpdate(Request $request)
    {
        $request->validate([
            'logo' => ['image', 'max:3000'],
            'favicon' => ['image', 'max:3000'],
        ]);

        $logoSetting = LogoSetting::first();

        $logoPath = $this->updateImage($request, 'logo', 'uploads', $request->old_logo);
        $faviconPath = $this->updateImage($request, 'favicon', 'uploads', $request->old_favicon);

        LogoSetting::updateOrCreate(
            ['id' => 1],
            [
                'logo' => !empty($logoPath) ? $logoPath : $request->old_logo,
                'favicon' => !empty($faviconPath) ? $faviconPath : $request->old_favicon,
            ]
        );
        toastr('Updated Successfully', 'success', 'success');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $home_page_banner_section_one = Advertisement::where('key', 'home-page-banner-section-one')->first();
        $home_page_banner_section_one = json_decode($home_page_banner_section_one->value);

        $home_page_banner_section_two = Advertisement::where('key', 'home-page-banner-section-two')->first();
        $home_page_banner_section_two = json_decode($home_page_banner_section_two->value);

        $home_page_banner_section_three = Advertisement::where('key', 'home-page-banner-section-three')->first();
        $home_page_banner_section_three = json_decode($home_page_banner_section_three->value);

        $home_page_banner_section_four = Advertisement::where('key', 'home-page-banner-section-four')->first();
        $home_page_banner_section_four = json_decode($home_page_banner_section_four->value);

        $product_page_banner = Advertisement::where('key', 'product-page-banner')->first();
        $product_page_banner = json_decode($product_page_banner->value);

        $cart_page_banner = Advertisement::where('key', 'cart-page-banner')->first();
        $cart_page_banner = json_decode($cart_page_banner->value);

        return view('admin.advertisement.index', compact(
            'home_page_banner_section_one',
            'home_page_banner_section_two',
            'home_page_banner_section_three',
            'home_page_banner_section_four',
            'product_page_banner',
            'cart_page_banner'
        ));
    }

    public function homePageBannerSectionOne(Request $request)
    {
        $request->validate([
            'banner_image' => ['image'],
            'banner_url' => ['required'],
            'banner_text_one' => ['required'],
            'banner_text_two' => ['required'],
        ]);

        $imagePath = $this->updateImage($request, 'banner_image', 'uploads');

        $value = [
            'banner_one' => [
                'banner_image' => '',
                'banner_text_one' => $request->banner_text_one,
                'banner_text_two' => $request->banner_text_two,
                'banner_url' => $request->banner_url,
                'status' => $request->status == 'on' ? 1 : 0
            ]
        ];

        if (!empty($imagePath)) {
            $value['banner_one']['banner_image'] = $imagePath;
        } else {

            $value['banner_one']['banner_image'] =  $request->banner_old_image;
        }

        $adveritise = Advertisement::updateOrCreate(
            ['key' => 'home-page-banner-section-one'],

            ['value' => json_encode($value)]
        );

        toastr('Home Page Banner Section One Updated Successfully', 'success', 'success');
        return redirect()->back();
    }

    public function homePageBannerSectionTwo(Request $request)
    {
        $request->validate([
            'banner_one_image' => ['image'],
            'banner_one_url' => ['required'],
            'banner_two_image' => ['image'],
            'banner_two_url' => ['required'],
            'banner_one_text_one' => ['required'],
            'banner_one_text_two' => ['required'],
            'banner_two_text_one' => ['required'],
            'banner_two_text_two' => ['required'],

        ]);

        $imagePathone = $this->updateImage($request, 'banner_one_image', 'uploads');

        $imagePathtwo = $this->updateImage($request, 'banner_two_image', 'uploads');

        $value = [
            'banner_one' => [
                'banner_one_image' => '',
                'banner_one_text_one' => $request->banner_one_text_one,
                'banner_one_text_two' => $request->banner_one_text_two,
                'banner_one_url' => $request->banner_one_url,
                'banner_one_status' => $request->banner_one_status == 'on' ? 1 : 0
            ],

            'banner_two' => [
                'banner_two_image' => '',
                'banner_two_text_one' => $request->banner_two_text_one,
                'banner_two_text_two' => $request->banner_two_text_two,
                'banner_two_url' => $request->banner_two_url,
                'banner_two_status' => $request->banner_two_status == 'on' ? 1 : 0
            ]
        ];


        if (!empty($imagePathone)) {
            $value['banner_one']['banner_one_image'] = $imagePathone;
        } else {
            $value['banner_one']['banner_one_image'] =  $request->banner_one_old_image;
        }


        if (!empty($imagePathtwo)) {
            $value['banner_two']['banner_two_image'] = $imagePathtwo;
        } else {
            $value['banner_two']['banner_two_image'] =  $request->banner_two_old_image;
        }

        $adveritise = Advertisement::updateOrCreate(
            ['key' => 'home-page-banner-section-two'],

            ['value' => json_encode($value)]
        );

        toastr('Home Page Banner Section Two Updated Successfully', 'success', 'success');
        return redirect()->back();
    }

    public function homePageBannerSectionThree(Request $request)
    {
        $request->validate([
            'banner_one_image' => ['image'],
            'banner_one_url' => ['required'],
            'banner_two_image' => ['image'],
            'banner_two_url' => ['required'],
            'banner_three_image' => ['image'],
            'banner_three_url' => ['required'],
            'banner_one_text_one' => ['required'],
            'banner_one_text_two' => ['required'],
            'banner_two_text_one' => ['required'],
            'banner_two_text_two' => ['required'],
            'banner_three_text_one' => ['required'],
            'banner_three_text_two' => ['required'],
        ]);

        $imagePathone = $this->updateImage($request, 'banner_one_image', 'uploads');

        $imagePathtwo = $this->updateImage($request, 'banner_two_image', 'uploads');

        $imagePaththree = $this->updateImage($request, 'banner_three_image', 'uploads');

        $value = [
            'banner_one' => [
                'banner_image' => '',
                'banner_one_text_one' => $request->banner_one_text_one,
                'banner_one_text_two' => $request->banner_one_text_two,
                'banner_url' => $request->banner_one_url,
                'status' => $request->banner_one_status == 'on' ? 1 : 0
            ],

            'banner_two' => [
                'banner_image' => '',
                'banner_two_text_one' => $request->banner_two_text_one,
                'banner_two_text_two' => $request->banner_two_text_two,
                'banner_url' => $request->banner_two_url,
                'status' => $request->banner_two_status == 'on' ? 1 : 0
            ],

            'banner_three' => [
                'banner_image' => '',
                'banner_three_text_one' => $request->banner_three_text_one,
                'banner_three_text_two' => $request->banner_three_text_two,
                'banner_url' => $request->banner_three_url,
                'status' => $request->banner_three_status == 'on' ? 1 : 0
            ]
        ];


        if (!empty($imagePathone)) {
            $value['banner_one']['banner_image'] = $imagePathone;
        } else {
            $value['banner_one']['banner_image'] =  $request->banner_one_old_image;
        }


        if (!empty($imagePathtwo)) {
            $value['banner_two']['banner_image'] = $imagePathtwo;
        } else {
            $value['banner_two']['banner_image'] =  $request->banner_two_old_image;
        }

        if (!empty($imagePaththree)) {
            $value['banner_three']['banner_image'] = $imagePaththree;
        } else {
            $value['banner_three']['banner_image'] =  $request->banner_three_old_image;
        }


        $adveritise = Advertisement::updateOrCreate(
            ['key' => 'home-page-banner-section-three'],

            ['value' => json_encode($value)]
        );

        toastr('Home Page Banner Section Three Updated Successfully', 'success', 'success');
        return redirect()->back();
    }


    public function homePageBannerSectionFour(Request $request)
    {
        $request->validate([
            'banner_image' => ['image'],
            'banner_url' => ['required'],
            'banner_text_one' => ['required'],
            'banner_text_two' => ['required']
        ]);

        $imagePath = $this->updateImage($request, 'banner_image', 'uploads');

        $value = [
            'banner_one' => [
                'banner_image' => '',
                'banner_text_one' => $request->banner_text_one,
                'banner_text_two' => $request->banner_text_two,
                'banner_url' => $request->banner_url,
                'status' => $request->status == 'on' ? 1 : 0
            ]
        ];

        if (!empty($imagePath)) {
            $value['banner_one']['banner_image'] = $imagePath;
        } else {

            $value['banner_one']['banner_image'] =  $request->banner_old_image;
        }

        $adveritise = Advertisement::updateOrCreate(
            ['key' => 'home-page-banner-section-four'],

            ['value' => json_encode($value)]
        );

        toastr('Home Page Banner Section Four Updated Successfully', 'success', 'success');
        return redirect()->back();
    }

    public function productPageBanner(Request $request)
    {

        $request->validate([
            'banner_image' => ['image'],
            'banner_url' => ['required'],
            'banner_text_one' => ['required'],
            'banner_text_two' => ['required']
        ]);

        $imagePath = $this->updateImage($request, 'banner_image', 'uploads');

        $value = [
            'banner_one' => [
                'banner_image' => '',
                'banner_text_one' => $request->banner_text_one,
                'banner_text_two' => $request->banner_text_two,
                'banner_url' => $request->banner_url,
                'status' => $request->status == 'on' ? 1 : 0
            ]
        ];

        if (!empty($imagePath)) {
            $value['banner_one']['banner_image'] = $imagePath;
        } else {

            $value['banner_one']['banner_image'] =  $request->banner_old_image;
        }

        $adveritise = Advertisement::updateOrCreate(
            ['key' => 'product-page-banner'],

            ['value' => json_encode($value)]
        );

        toastr('Product Page Banner Updated Successfully', 'success', 'success');
        return redirect()->back();
    }

    public function cartPageBanner(Request $request)
    {
        $request->validate([
            'banner_one_image' => ['image'],
            'banner_one_url' => ['required'],
            'banner_two_image' => ['image'],
            'banner_two_url' => ['required'],
            'banner_one_text_one' => ['required'],
            'banner_one_text_two' => ['required'],
            'banner_two_text_one' => ['required'],
            'banner_two_text_two' => ['required'],
        ]);

        $imagePathone = $this->updateImage($request, 'banner_one_image', 'uploads');

        $imagePathtwo = $this->updateImage($request, 'banner_two_image', 'uploads');

        $value = [
            'banner_one' => [
                'banner_one_image' => '',
                'banner_one_text_one' => $request->banner_one_text_one,
                'banner_one_text_two' => $request->banner_one_text_two,
                'banner_one_url' => $request->banner_one_url,
                'banner_one_status' => $request->banner_one_status == 'on' ? 1 : 0
            ],

            'banner_two' => [
                'banner_two_image' => '',
                'banner_two_text_one' => $request->banner_two_text_one,
                'banner_two_text_two' => $request->banner_two_text_two,
                'banner_two_url' => $request->banner_two_url,
                'banner_two_status' => $request->banner_two_status == 'on' ? 1 : 0
            ]
        ];


        if (!empty($imagePathone)) {
            $value['banner_one']['banner_one_image'] = $imagePathone;
        } else {
            $value['banner_one']['banner_one_image'] =  $request->banner_one_old_image;
        }


        if (!empty($imagePathtwo)) {
            $value['banner_two']['banner_two_image'] = $imagePathtwo;
        } else {
            $value['banner_two']['banner_two_image'] =  $request->banner_two_old_image;
        }

        $adveritise = Advertisement::updateOrCreate(
            ['key' => 'cart-page-banner'],

            ['value' => json_encode($value)]
        );

        toastr('Cart Page Banner Updated Successfully', 'success', 'success');
        return redirect()->back();
    }
}

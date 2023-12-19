<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;

class FooterInfoController extends Controller
{

    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footerinfo =  FooterInfo::first();
        return view('admin.footer.footer-info.index', compact('footerinfo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => ['nullable', 'image', 'max: 3000'],
            'phone' => ['max: 300'],
            'email' => ['max: 300'],
            'address' => ['max: 300'],
            'copyright' => ['max: 300'],
        ]);

        $footerinfo =  FooterInfo::find($id);

        $imagePath = $this->updateImage($request, 'logo', 'uploads', $footerinfo?->logo);

        $footerinfo =  FooterInfo::updateOrCreate(

            ['id' => $id],

            [
                'logo' =>  empty(!$imagePath) ? $imagePath : $footerinfo->logo,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'copyright' => $request->copyright,
            ]
        );

        toastr('Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

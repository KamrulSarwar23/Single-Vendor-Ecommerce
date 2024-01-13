<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterSocialDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterSocial;
use Illuminate\Http\Request;

class FooterSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterSocialDataTable $datatable)
    {
        return $datatable->render('admin.footer.footer-social.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-social.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required'],
            'name' => ['required'],
            'url' => ['required', 'url'],
            'status' => ['required'],
        ]);

        $footersocial = new FooterSocial();
        $footersocial->icon = $request->icon;
        $footersocial->name = $request->name;
        $footersocial->url = $request->url;
        $footersocial->status = $request->status;
        $footersocial->save();
        toastr('Created Successfully', 'success', 'success');
        return redirect()->route('admin.footer-social.index');
        
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
        $footersocial = FooterSocial::findorFail($id);
        return view('admin.footer.footer-social.edit', compact('footersocial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required'],
            'name' => ['required'],
            'url' => ['required'],
            'status' => ['required'],
        ]);

        $footersocial = FooterSocial::findOrFail($id);
        $footersocial->icon = $request->icon;
        $footersocial->name = $request->name;
        $footersocial->url = $request->url;
        $footersocial->status = $request->status;
        $footersocial->save();
        toastr('Updated Successfully' , 'success', 'success');
        return redirect()->route('admin.footer-social.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footersocial = FooterSocial::findOrFail($id);
        $footersocial->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {
        $footersocial = FooterSocial::findOrFail($request->id);
        $footersocial->status = $request->status == 'true' ? 1 : 0;
        $footersocial->save();

        return response(['message' => 'Status has been Updated!']);
    }
}

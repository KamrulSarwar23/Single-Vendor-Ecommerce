<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridThreeDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterGridThree;
use App\Models\FooterTitle;

class FooterGridThreeController extends Controller
{
    public function index(FooterGridThreeDataTable $datatable)
    {
        $footertitle =  FooterTitle::first();
        return $datatable->render('admin.footer.footer-grid-three.index', compact('footertitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-grid-three.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'url' => ['required', 'url'],
            'status' => ['required'],
        ]);

        $footergridthree = new FooterGridThree();
        $footergridthree->name = $request->name;
        $footergridthree->url = $request->url;
        $footergridthree->status = $request->status;
        $footergridthree->save();

        toastr('Created Successfully', 'success', 'success');
        return redirect()->route('admin.footer-grid-three.index');
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
        $footergridthree = FooterGridThree::findorFail($id);
        return view('admin.footer.footer-grid-three.edit', compact('footergridthree'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'url' => ['required', 'url'],
            'status' => ['required'],
        ]);

        $footergridthree = FooterGridThree::findOrFail($id);
        $footergridthree->name = $request->name;
        $footergridthree->url = $request->url;
        $footergridthree->status = $request->status;
        $footergridthree->save();

        toastr('Updated Successfully', 'success', 'success');
        return redirect()->route('admin.footer-grid-three.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footergridthree = FooterGridThree::findOrFail($id);
        $footergridthree->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {

        $footergridthree = FooterGridThree::findOrFail($request->id);
        $footergridthree->status = $request->status == 'true' ? 1 : 0;
        $footergridthree->save();

        return response(['message' => 'Status has been Updated!']);
    }

    public function changeTitle(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max: 300']
        ]);

        FooterTitle::updateOrCreate(

            [
                'id' => 1,
            
            ],

            [
                'footer_grid_three_title' => $request->name,
            
            ]
            );

            toastr('Updated Successfully', 'success', 'success');
            return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridTwoDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGridTwo;
use App\Models\FooterTitle;
use Illuminate\Http\Request;

class FooterGridTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridTwoDataTable $datatable)
    {
        $footertitle =  FooterTitle::first();
        return $datatable->render('admin.footer.footer-grid-two.index', compact('footertitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-grid-two.create');
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

        $footergridtwo = new FooterGridTwo();
        $footergridtwo->name = $request->name;
        $footergridtwo->url = $request->url;
        $footergridtwo->status = $request->status;
        $footergridtwo->save();

        toastr('Created Successfully', 'success', 'success');
        return redirect()->route('admin.footer-grid-two.index');
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
        $footergridtwo = FooterGridTwo::findorFail($id);
        return view('admin.footer.footer-grid-two.edit', compact('footergridtwo'));
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

        $footergridtwo = FooterGridTwo::findOrFail($id);
        $footergridtwo->name = $request->name;
        $footergridtwo->url = $request->url;
        $footergridtwo->status = $request->status;
        $footergridtwo->save();

        toastr('Updated Successfully', 'success', 'success');
        return redirect()->route('admin.footer-grid-two.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footergridtwo = FooterGridTwo::findOrFail($id);
        $footergridtwo->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {

        $footergridtwo = FooterGridTwo::findOrFail($request->id);
        $footergridtwo->status = $request->status == 'true' ? 1 : 0;
        $footergridtwo->save();

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
                'footer_grid_two_title' => $request->name,
            
            ]
            );

            toastr('Updated Successfully', 'success', 'success');
            return redirect()->back();
    }
}

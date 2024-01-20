<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\EcommerceServiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\EcommerceService;
use Illuminate\Http\Request;

class EcommerceServiceController extends Controller
{
    public function index(EcommerceServiceDataTable $datatable)
    {
        return $datatable->render('admin.ecommerce-service.index');
    }


    public function create()
    {
        return view('admin.ecommerce-service.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required'],
            'heading' => ['required'],
            'service' => ['required'],
            'status' => ['required'],
        ]);

        $service = new EcommerceService();
        $service->icon = $request->icon;
        $service->heading = $request->heading;
        $service->service = $request->service;
        $service->status = $request->status;
        $service->save();

        toastr('Service Added Successfully');
        return redirect()->route('admin.ecommerce-service.index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $service = EcommerceService::findOrFail($id);
        return view('admin.ecommerce-service.edit', compact('service'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required'],
            'heading' => ['required'],
            'service' => ['required'],
            'status' => ['required'],
        ]);

        $service = EcommerceService::findOrFail($id);
        $service->icon = $request->icon;
        $service->heading = $request->heading;
        $service->service = $request->service;
        $service->status = $request->status;
        $service->save();

        toastr('Service Updated Successfully');
        return redirect()->route('admin.ecommerce-service.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = EcommerceService::findOrFail($id);
        $service->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {
        $service = EcommerceService::findOrFail($request->id);
        $service->status = $request->status == 'true' ? 1 : 0;
        $service->save();
        return response(['status' => 'success', 'message' => 'Status Updated']);
    }
}

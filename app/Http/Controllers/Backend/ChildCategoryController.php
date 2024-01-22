<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\HomePageSetting;
use App\Models\Product;
use Illuminate\Http\Request;
use Str;
use Rule;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.childcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('admin.childcategory.create', compact('categories', 'subcategories'));
    }

    /**
     * Get Sub-categoried
     */


    public function getSubCategories(Request $request)
    {

        $subcategories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();
        return $subcategories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'category' => ['required'],
            'subcategory' => ['required'],
            'name' => ['required', 'max:200', 'unique:child_categories,name'],
            'status' => ['required'],

        ]);


        $childcategory = new ChildCategory();

        $childcategory->category_id = $request->category;
        $childcategory->subcategory_id = $request->subcategory;
        $childcategory->name = $request->name;
        $childcategory->slug = Str::slug($request->name);
        $childcategory->status = $request->status;

        $childcategory->save();

        toastr('Created Succesfully', 'success');

        return redirect()->route('admin.childcategory.index');
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
        $categories = Category::all();
        $childcategories = ChildCategory::findOrFail($id);
        $subcategories = SubCategory::where('category_id', $childcategories->category_id)->get();
        return view('admin.childcategory.edit', compact('categories', 'subcategories', 'childcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'category' => ['required'],
            'subcategory' => ['required'],
            'name' => ['required', 'max:200', 'unique:child_categories,name,' . $id],
            'status' => ['required'],

        ]);


        $childcategory = ChildCategory::findOrFail($id);

        $childcategory->category_id = $request->category;
        $childcategory->subcategory_id = $request->subcategory;
        $childcategory->name = $request->name;
        $childcategory->slug = Str::slug($request->name);
        $childcategory->status = $request->status;

        $childcategory->save();

        toastr('Created Succesfully', 'success');

        return redirect()->route('admin.childcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childcategory = ChildCategory::findOrFail($id);

        if (Product::where('childcategory_id', $childcategory->id)->count() > 0) {
            return response(['status' => 'error', 'message' => 'It Contains relations cant delete']);
        }
        $homepagesetting = HomePageSetting::all();
        foreach ($homepagesetting as $item) {
            $array = json_decode($item->value, true);
            $collection = collect($array);
            if ($collection->contains('child_category', $childcategory->id)) {
                return response(['status' => 'error', 'message' => 'It Contains relations cant delete']);
            }
        }
        $childcategory->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {

        $childcategory = ChildCategory::findOrFail($request->id);
        $childcategory->status = $request->status == 'true' ? 1 : 0;
        $childcategory->save();

        return response(['message' => 'Status has been Updated!']);
    }
}

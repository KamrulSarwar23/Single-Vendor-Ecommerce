<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Http\Request;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([

            'category' => ['required'],
            'name' => ['required', 'max:200', 'unique:sub_categories,name'],
            'status' => ['required'],

        ]);


        $subcategory = new SubCategory();

        $subcategory->category_id = $request->category;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->status = $request->status;

        $subcategory->save();

        toastr('Created Succesfully', 'success');

        return redirect()->route('admin.subcategory.index');
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
        $category = Category::all();
        $subcategory = SubCategory::findOrFail($id);
        return view('admin.subcategory.edit', compact('subcategory', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'category' => ['required'],
            'name' => ['required', 'max:200', 'unique:sub_categories,name,'.$id],
            'status' => ['required'],

        ]);


        $subcategory = SubCategory::findOrFail($id);

        $subcategory->category_id = $request->category;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->status = $request->status;

        $subcategory->save();

        toastr('Upadated Succesfully', 'success');

        return redirect()->route('admin.subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $childcategory = ChildCategory::where('subcategory_id', $subcategory->id)->count();

        if ($childcategory > 0) {
            return response(['status' => 'error', 'message' => 'This item contains sub items. For delete this you have to delete sub items first.']);
        }
        $subcategory->delete();
        
        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }

    public function changeStatus(Request $request){

        $subcategory = SubCategory::findOrFail($request->id);
        $subcategory->status = $request->status == 'true' ? 1 : 0;
        $subcategory->save();

        return response(['message' => 'Status has been Updated!']);
    }
}

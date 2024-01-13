<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $datatable)
    {
        return $datatable->render('admin.blog.blog-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'max:200', 'unique:blog_categories'],
                'status' => ['required']
            ],
            [
                'name.unique' => 'Category Already Exists!'

            ]
        );

        $blogcategory = new BlogCategory();
        $blogcategory->name = $request->name;
        $blogcategory->slug = Str::slug($request->name);
        $blogcategory->status = $request->status;
        $blogcategory->save();

        toastr('Created Successfully', 'success', 'success');
        return redirect()->route('admin.blog-category.index');
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
        $blogcategory = BlogCategory::findOrFail($id);
        return view('admin.blog.blog-category.edit', compact('blogcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => ['required', 'max:200', 'unique:blog_categories,name,' . $id],
                'status' => ['required']
            ],
            [
                'name.unique' => 'Category Already Exists!'
            ]
        );

        $blogcategory = BlogCategory::findOrFail($id);
        $blogcategory->name = $request->name;
        $blogcategory->slug = Str::slug($request->name);
        $blogcategory->status = $request->status;
        $blogcategory->save();

        toastr('Updated Successfully', 'success', 'success');
        return redirect()->route('admin.blog-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blogcategory = BlogCategory::findOrFail($id);

        $blog = Blog::where('category_id', $blogcategory->id)->get();

        if (count($blog) > 0) {
            return response(['status' => 'error', 'message' => 'This category contains blog items. For delete this you have to delete blog items first.']);
        }

        $blogcategory->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {

        $blogcategory = BlogCategory::findOrFail($request->id);
        $blogcategory->status = $request->status == 'true' ? 1 : 0;
        $blogcategory->save();

        return response(['message' => 'Status has been Updated!']);
    }
}

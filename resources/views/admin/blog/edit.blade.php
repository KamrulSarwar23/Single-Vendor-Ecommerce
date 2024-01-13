@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Blog</h4>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Preview</label>
                                    <img width="150px" src="{{ asset($blog->image) }}" alt="">
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control"name="title" value="{{ $blog->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select id="inputState" class="form-control" name="category">
                                        <option>Select</option>
                                        @foreach ($categories as $category)
                                            <option {{ $blog->category_id == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" id="" class="form-control summernote">{!! $blog->description !!}</textarea>
                                </div>


                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" name="seo_title" class="form-control"
                                        value="{{ $blog->seo_title }}">

                                </div>

                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <textarea name="seo_description" id="" class="form-control">{{ $blog->seo_description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">State</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $blog->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $blog->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                    </select>
                                </div>

                                <button class="btn btn-primary">Update</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

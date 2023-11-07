@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
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
                            <h4>update Brand</h4>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('admin.brand.update', $brand->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Preview</label>
                                    <br>
                                    <img width="100px" height="100px" src="{{ asset($brand->logo) }}" alt="">
                                </div>

                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" name="logo" value="{{ $brand->logo }}">
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control"name="name" value="{{ $brand->name }}">
                                </div>



                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="is_featured">
                                        <option {{ $brand->is_featured == 1 ? 'selected' : '' }} value="1">Yes</option>
                                        <option {{ $brand->is_featured == 0 ? 'selected' : '' }} value="0">No</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $brand->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $brand->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
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

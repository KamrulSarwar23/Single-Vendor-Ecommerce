@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Footer</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Footer Grid Three</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.footer-grid-three.update', $footergridthree->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $footergridthree->name }}">
                                </div>

                                <div class="form-group">
                                    <label>Url</label>
                                    <input type="text" class="form-control" name="url"
                                        value="{{ $footergridthree->url }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">State</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $footergridthree->status == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $footergridthree->status == 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

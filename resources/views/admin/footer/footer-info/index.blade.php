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
                            <h4>Footer Info</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.footer-info.update', 1) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                        
                                    <div class="form-group">
                                        <label>Preview</label>
                                        <div>
                                           <img width="120" height="120px" src="{{ asset($footerinfo->logo) }}" alt="">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Logo</label>
                                            <div>
                                                <input class="form-control" type="file" name="logo">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone" value="{{ $footerinfo->phone }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" value="{{ $footerinfo->email }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" value="{{ $footerinfo->address }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Copy-Right</label>
                                            <input type="text" class="form-control" name="copyright" value="{{ $footerinfo->copyright }}">
                                        </div>
                                    </div>
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

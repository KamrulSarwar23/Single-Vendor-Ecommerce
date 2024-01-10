@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>About Page</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>About Page</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.about.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="summernote" name="content" id="">{!! @$aboutcontent->content !!}</textarea>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection

@extends('vendor.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
     
    @include('vendor.layouts.sidebar')


      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          
          <div class="dashboard_content mt-2 mt-md-0">
            <a class="btn btn-warning my-3" href="{{route('vendor.products.index')}}">Back</a>

            <h3><i class="far fa-user"></i>Product: {{ $product->name }}</h3>
           
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                
                <form action="{{ route('vendor.product-image-gallery.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group wsus_input">
                    <label for="">Image <code>(Multiple Image Supported)</code> </label>
                    <input name="image[]" class="form-control" type="file" multiple>
                    <input type="hidden" name="product" value="{{ $product->id }}">
                </div>

                <button type="submit" class="btn btn-primary">Uoload</button>

            </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Product Images</h3>

            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                
                {{ $dataTable->table() }}
 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

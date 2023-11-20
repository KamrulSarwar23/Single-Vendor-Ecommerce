@extends('vendor.layouts.master')
@section('title')
{{$setting->site_name}} || Product Variant Item
@endsection
@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3 ">
                                <a class="btn btn-warning" href="{{ route('vendor.product-variant.index', ['product' => $product->id]) }}">Back</a>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Variant Name: {{$variant->name}}</h4>
                                    <div class="card-header-action create-button">
                                        <a href="{{ route('vendor.product-variant-item.create', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                                            class="btn btn-primary">Create New</a>
                                    </div>
                                </div>
                                <div class="card-body"> 
        
                                    {{ $dataTable->table() }}
        
                                </div>
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

    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {

                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('vendor.product-variant-item.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush

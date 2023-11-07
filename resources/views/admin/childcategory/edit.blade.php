@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Sub Category</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update ChildCategories</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.childcategory.update', $childcategories->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select id="inputState" class="form-control main-category" name="category">
                                        <option value="">Select</option>

                                        @foreach ($categories as $category)
                                            <option {{$category->id == $childcategories->category_id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Sub Category</label>
                                    <select id="inputState" class="form-control sub-category" name="subcategory">
                                        <option value="">Select</option>

                                        @foreach ($subcategories as $subcategory)
                                        <option {{$subcategory->id == $childcategories->subcategory_id ? 'selected' : ''}} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$childcategories->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $childcategories->status == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $childcategories->status == 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {

                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-SubCategories') }}", // Corrected the semicolon to a comma
                    data: {
                        id: id
                    },
                    success: function(data) {
                       
                        $('.sub-category').html('<option value="">Select</option>')
                        $.each(data, function(i, item) {
                            
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush


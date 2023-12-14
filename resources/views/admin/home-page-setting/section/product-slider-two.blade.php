<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
    @php
        $productSliderTwo = json_decode($productSliderTwo->value);

    @endphp
    <h5>Product Silder Two</h5>
    <div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product-slider-two') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" id="" class="form-control main-category">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == $productSliderTwo->category ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $subCategories = \App\Models\SubCategory::where('category_id', $productSliderTwo->category)->get();
                                @endphp

                                <label>Sub Category</label>
                                <select name="sub_category" id="" class="form-control sub-category">
                                    <option value="">Select</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option
                                            {{ $subCategory->id == $productSliderTwo->sub_category ? 'selected' : '' }}
                                            value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $childCategories = \App\Models\ChildCategory::where('subcategory_id', $productSliderTwo->child_category)->get();
                                @endphp

                                <label>Child Category</label>
                                <select name="child_category" id="" class="form-control child-category">
                                    <option value="">Select</option>
                                    @foreach ($childCategories as $childCategory)
                                        <option
                                            {{ $childCategory->id == $productSliderTwo->child_category ? 'selected' : '' }}
                                            value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                $('body').on('change', '.main-category', function(e) {

                    let id = $(this).val();
                    let row = $(this).closest('.row');
                    $.ajax({
                        method: 'GET',
                        url: "{{ route('admin.get-SubCategories') }}",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            let selector = row.find('.sub-category');
                            selector.html('<option value="">Select</option>')
                            $.each(data, function(i, item) {

                                selector.append(
                                    `<option value="${item.id}">${item.name}</option>`)
                            })
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                });

                $('body').on('change', '.sub-category', function(e) {

                    let id = $(this).val();
                    let row = $(this).closest('.row');
                    $.ajax({
                        method: 'GET',
                        url: "{{ route('admin.product.get-child-categories') }}",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            let selector = row.find('.child-category');
                            selector.html('<option value="">Select</option>')
                            $.each(data, function(i, item) {

                                selector.append(
                                    `<option value="${item.id}">${item.name}</option>`)
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

</div>

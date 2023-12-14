<div class="tab-pane fade" id="list-slider-three" role="tabpanel" aria-labelledby="list-settings-list">
    @php
        $productSliderThree = json_decode($productSliderThree->value, true);
    @endphp
    
    <h5>Product Silder Three</h5>
    <div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product-slider-three') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h5>Part-One:</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_one" id="" class="form-control main-category">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == $productSliderThree[0]['category'] ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $subCategories = \App\Models\SubCategory::where('category_id', $productSliderThree[0]['category'])->get();
                                @endphp

                                <label>Sub Category</label>
                                <select name="sub_cat_one" id="" class="form-control sub-category">
                                    <option value="">Select</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option
                                            {{ $subCategory->id == $productSliderThree[0]['sub_category'] ? 'selected' : '' }}
                                            value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $childCategories = \App\Models\ChildCategory::where('subcategory_id', $productSliderThree[0]['child_category'])->get();
                                @endphp

                                <label>Child Category</label>
                                <select name="child_cat_one" id="" class="form-control child-category">
                                    <option value="">Select</option>
                                    @foreach ($childCategories as $childCategory)
                                        <option
                                            {{ $childCategory->id == $productSliderThree[0]['child_category'] ? 'selected' : '' }}
                                            value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <h5>Part-Two:</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_two" id="" class="form-control main-category">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == $productSliderThree[1]['category'] ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $subCategories = \App\Models\SubCategory::where('category_id', $productSliderThree[1]['category'])->get();
                                @endphp

                                <label>Sub Category</label>
                                <select name="sub_cat_two" id="" class="form-control sub-category">
                                    <option value="">Select</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option
                                            {{ $subCategory->id == $productSliderThree[1]['sub_category'] ? 'selected' : '' }}
                                            value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $childCategories = \App\Models\ChildCategory::where('subcategory_id', $productSliderThree[1]['child_category'])->get();
                                @endphp

                                <label>Child Category</label>
                                <select name="child_cat_two" id="" class="form-control child-category">
                                    <option value="">Select</option>
                                    @foreach ($childCategories as $childCategory)
                                        <option
                                            {{ $childCategory->id == $productSliderThree[1]['child_category'] ? 'selected' : '' }}
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

<div class="tab-pane fade" id="list-slider-five" role="tabpanel" aria-labelledby="list-messages-list">

    <div class="card">
        <div class="card-body">
            <h5>Product Page Banner:</h5>

            <form action="{{ route('admin.product-page-banner') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Status</label> <br>
                    <label class="custom-switch">
                        <input type="checkbox" {{ $product_page_banner->banner_one->status == 1 ? 'checked' : '' }} name="status" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>

                <div class="form-group">

                    <label for="">Banner Image</label>
                    <br>
                    <img width="300px" height="200px" src="{{ asset($product_page_banner->banner_one->banner_image) }}" alt="">
                </div>

                <div class="form-group">

                    <label for="">Banner Image</label>
                    <input type="file" class="form-control" name="banner_image" value="">
                    <input type="hidden" class="form-control" name="banner_old_image" value="{{ $product_page_banner->banner_one->banner_image }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Text One</label>
                    <input type="text" class="form-control" name="banner_text_one" value="{{ $product_page_banner->banner_one->banner_text_one }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Text Two</label>
                    <input type="text" class="form-control" name="banner_text_two" value="{{ $product_page_banner->banner_one->banner_text_two }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Url</label>
                    <input type="text" class="form-control" name="banner_url" value="{{ $product_page_banner->banner_one->banner_url }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>

</div>

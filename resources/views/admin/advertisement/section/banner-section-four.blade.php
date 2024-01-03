<div class="tab-pane fade" id="list-slider-four" role="tabpanel" aria-labelledby="list-settings-list">

    <div class="card">
        <div class="card-body">
            <h5>Banner Section Four:</h5>
            <form action="{{ route('admin.home-page-banner-section-four') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Status</label> <br>
                    <label class="custom-switch">
                        <input type="checkbox"
                            {{ $home_page_banner_section_four->banner_one->status == 1 ? 'checked' : '' }}
                            name="status" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>

                <div class="form-group">

                    <label for="">Banner Image</label>
                    <br>
                    <img width="300px" height="200px"
                        src="{{ asset($home_page_banner_section_four->banner_one->banner_image) }}" alt="">
                </div>

                <div class="form-group">

                    <label for="">Banner Image</label>
                    <input type="file" class="form-control" name="banner_image" value="">
                    <input type="hidden" class="form-control" name="banner_old_image"
                        value="{{ $home_page_banner_section_four->banner_one->banner_image }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Text One</label>
                    <input type="text" class="form-control" name="banner_text_one" value="{{ $home_page_banner_section_four->banner_one->banner_text_one }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Text Two</label>
                    <input type="text" class="form-control" name="banner_text_two" value="{{ $home_page_banner_section_four->banner_one->banner_text_two }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Url</label>
                    <input type="text" class="form-control" name="banner_url"
                        value="{{ $home_page_banner_section_four->banner_one->banner_url }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>

</div>

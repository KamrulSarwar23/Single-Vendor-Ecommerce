<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">

    <div class="card">
        <div class="card-body">
            <h5>Banner Section Two:</h5>

            <form action="{{ route('admin.home-page-banner-section-two') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5>Banner One</h5>
                <div class="form-group">
                    <label for="">Status</label> <br>
                    <label class="custom-switch">
                        <input type="checkbox"
                            {{ @$home_page_banner_section_two->banner_one->banner_one_status == 1 ? 'checked' : '' }}
                            name="banner_one_status" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>

                <div class="form-group">

                    <label for="">Banner Image</label>
                    <br>
                    <img width="300px" height="200px"
                        src="{{ asset(@$home_page_banner_section_two->banner_one->banner_one_image) }}" alt="">
                </div>

                <div class="form-group">

                    <label for="">Banner Image</label>
                    <input type="file" class="form-control" name="banner_one_image" value="">
                    <input type="hidden" class="form-control" name="banner_one_old_image"
                        value="{{ @$home_page_banner_section_two->banner_one->banner_one_image }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Text One</label>
                    <input type="text" class="form-control" name="banner_one_text_one" value="{{ @$home_page_banner_section_two->banner_one->banner_one_text_one }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Text Two</label>
                    <input type="text" class="form-control" name="banner_one_text_two" value="{{ @$home_page_banner_section_two->banner_one->banner_one_text_two }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Url</label>
                    <input type="text" class="form-control" name="banner_one_url"
                        value="{{ @$home_page_banner_section_two->banner_one->banner_one_url }}">
                </div>

                <hr>

                <h5>Banner Two</h5>

                <div class="form-group">
                    <label for="">Status</label> <br>
                    <label class="custom-switch">
                        <input type="checkbox"
                            {{ @$home_page_banner_section_two->banner_two->banner_two_status == 1 ? 'checked' : '' }}
                            name="banner_two_status" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>

                <div class="form-group">

                    <label for="">Banner Image</label>
                    <br>
                    <img width="300px" height="200px"
                        src="{{ asset(@$home_page_banner_section_two->banner_two->banner_two_image) }}" alt="">
                </div>

                <div class="form-group">

                    <label for="">Banner Image</label>
                    <input type="file" class="form-control" name="banner_two_image" value="">
                    <input type="hidden" class="form-control" name="banner_two_old_image"
                        value="{{ @$home_page_banner_section_two->banner_two->banner_two_image }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Text One</label>
                    <input type="text" class="form-control" name="banner_two_text_one" value="{{ @$home_page_banner_section_two->banner_two->banner_two_text_one }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Text Two</label>
                    <input type="text" class="form-control" name="banner_two_text_two" value="{{ @$home_page_banner_section_two->banner_two->banner_two_text_two }}">
                </div>

                <div class="form-group">
                    <label for="">Banner Url</label>
                    <input type="text" class="form-control" name="banner_two_url"
                        value="{{ @$home_page_banner_section_two->banner_two->banner_two_url }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>

</div>

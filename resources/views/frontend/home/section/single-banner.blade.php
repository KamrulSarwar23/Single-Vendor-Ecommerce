<section id="wsus__single_banner" class="wsus__single_banner_2">
    <div class="container">

        <div class="row">
            @if ($home_page_banner_section_two->banner_one->banner_one_status == 1)
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset($home_page_banner_section_two->banner_one->banner_one_image) }}"
                                alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>{{ $home_page_banner_section_two->banner_one->banner_one_text_one }}</h6>
                            <h3>{{ $home_page_banner_section_two->banner_one->banner_one_text_two }}</h3>
                            <a class="shop_btn"
                                href="{{ $home_page_banner_section_two->banner_one->banner_one_url }}">shop now</a>
                        </div>
                    </div>
                </div>
            @endif

            @if ($home_page_banner_section_two->banner_two->banner_two_status == 1)
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset($home_page_banner_section_two->banner_two->banner_two_image) }}"
                                alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>{{ $home_page_banner_section_two->banner_two->banner_two_text_one }}</h6>
                            <h3>{{ $home_page_banner_section_two->banner_two->banner_two_text_two }}</h3>
                            <a class="shop_btn"
                                href="{{ $home_page_banner_section_two->banner_two->banner_two_url }}">shop now</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

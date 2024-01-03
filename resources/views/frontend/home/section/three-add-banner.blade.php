<section id="wsus__single_banner" class="home_2_single_banner">
    <div class="container">
        <div class="row">

            @if ($home_page_banner_section_three->banner_one->status == 1)
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content banner_1">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset($home_page_banner_section_three->banner_one->banner_image) }}"
                                alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>{{ $home_page_banner_section_three->banner_one->banner_one_text_one }}</h6>
                            <h3>{{ $home_page_banner_section_three->banner_one->banner_one_text_two }}</h3>
                            <a class="shop_btn"
                                href="{{ $home_page_banner_section_three->banner_one->banner_url }}">shop now</a>
                        </div>
                    </div>
                </div>
            @endif


            <div class="col-xl-6 col-lg-6">
                <div class="row">
                    @if ($home_page_banner_section_three->banner_two->status == 1)
                        <div class="col-12">
                            <div class="wsus__single_banner_content single_banner_2">
                                <div class="wsus__single_banner_img">
                                    <img src="{{ asset($home_page_banner_section_three->banner_two->banner_image) }}"
                                        alt="banner" class="img-fluid w-100">
                                </div>
                                <div class="wsus__single_banner_text">
                                    <h6>{{ $home_page_banner_section_three->banner_two->banner_two_text_one }}</h6>
                                    <h3>{{ $home_page_banner_section_three->banner_two->banner_two_text_two }}</h3>
                                    <a class="shop_btn"
                                        href="{{ $home_page_banner_section_three->banner_two->banner_url }}">shop
                                        now</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($home_page_banner_section_three->banner_three->status == 1)
                        <div class="col-12 mt-lg-4">
                            <div class="wsus__single_banner_content">
                                <div class="wsus__single_banner_img">
                                    <img src="{{ asset($home_page_banner_section_three->banner_three->banner_image) }}"
                                        alt="banner" class="img-fluid w-100">
                                </div>
                                <div class="wsus__single_banner_text">
                                    <h6>{{ $home_page_banner_section_three->banner_three->banner_three_text_one }}</h6>
                                    <h3>{{ $home_page_banner_section_three->banner_three->banner_three_text_two }}</h3>
                                    <a class="shop_btn"
                                        href="{{ $home_page_banner_section_three->banner_three->banner_url }}">shop
                                        now</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</section>

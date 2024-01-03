@if ($home_page_banner_section_four->banner_one->status == 1)
    <section id="wsus__large_banner">
        <div class="container">
            <div class="row">
                <div class="cl-xl-12">
                    <div class="wsus__large_banner_content"
                        style="background: url({{ asset($home_page_banner_section_four->banner_one->banner_image) }});">
                        <div class="wsus__large_banner_content_overlay">
                            <div class="row">
                                <div class="col-xl-6 col-12 col-md-6">
                                    <div class="wsus__large_banner_text">
                                        <h3>{{ $home_page_banner_section_four->banner_one->banner_text_one }}</h3>
                                        <p>{{ $home_page_banner_section_four->banner_one->banner_text_two }}</p>
                                        <a class="shop_btn"
                                            href="{{ $home_page_banner_section_four->banner_one->banner_url }}">view
                                            more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

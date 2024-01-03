@php
    $popularCategories = json_decode($popularCategory->value, true);
@endphp

<section id="wsus__monthly_top" class="wsus__monthly_top_2">
    <div class="container">
        <div class="row">

            @if ($home_page_banner_section_one->banner_one->status == 1)
                <div class="col-xl-12 col-lg-12">
                    <div class="wsus__monthly_top_banner">
                        <div class="wsus__monthly_top_banner_img">
                            <img src="{{ asset($home_page_banner_section_one->banner_one->banner_image) }}" alt="img"
                                class="img-fluid w-100">
                            <span></span>
                        </div>
                        <div class="wsus__monthly_top_banner_text">
                            <h4>{{ $home_page_banner_section_one->banner_one->banner_text_one }}</h4>
                            <h3>{{ $home_page_banner_section_one->banner_one->banner_text_two }}</h3>
                            <a class="shop_btn" href="{{ $home_page_banner_section_one->banner_one->banner_url }}">shop
                                now</a>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header for_md">
                    <h3>Popular Category</h3>
                    <div class="monthly_top_filter">

                        @php
                            $products = [];
                        @endphp
                        @foreach ($popularCategories as $key => $popularCategory)
                            @php
                                $lastKey = [];
                                foreach ($popularCategory as $key => $category) {
                                    if ($category == null) {
                                        break;
                                    }
                                    $lastKey = [$key => $category];
                                }
                                if (array_keys($lastKey)[0] == 'category') {
                                    $category = \App\Models\Category::find($lastKey['category']);
                                    $products[] = \App\Models\Product::where('category_id', $category->id)
                                        ->orderBy('id', 'DESC')
                                        ->take(12)
                                        ->get();
                                } elseif (array_keys($lastKey)[0] == 'sub_category') {
                                    $category = \App\Models\SubCategory::find($lastKey['sub_category']);
                                    $products[] = \App\Models\Product::where('subcategory_id', $category->id)
                                        ->orderBy('id', 'DESC')
                                        ->take(12)
                                        ->get();
                                } else {
                                    $category = \App\Models\ChildCategory::find($lastKey['child_category']);
                                    $products[] = \App\Models\Product::where('childcategory_id', $category->id)
                                        ->orderBy('id', 'DESC')
                                        ->take(12)
                                        ->get();
                                }
                            @endphp
                            <button class="{{ $loop->index == 0 ? 'auto_click active' : '' }}"
                                data-filter=".category-{{ $loop->index }}">{{ $category->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row grid">
                    @foreach ($products as $key => $product)
                        @foreach ($product as $item)
                            <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3 category-{{ $key }}">
                                <a class="wsus__hot_deals__single" href="{{ route('product-detail', $item->slug) }}">
                                    <div class="wsus__hot_deals__single_img mb-2">
                                        <img src="{{ asset($item->thumb_image) }}" alt="bag"
                                            class="img-fluid w-100 " style="height: 180px">
                                    </div>
                                    <div class="wsus__hot_deals__single_text">
                                        <h5>{!! limitText($item->name) !!}</h5>
                                        <p class="wsus__rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </p>
                                        @if (checkProductDiscount($item))
                                            <p class="wsus__tk">{{ $setting->currency_icon }}{{ $item->price }}
                                                <del>{{ $setting->currency_icon }}{{ $item->offer_price }}</del>
                                            </p>
                                        @else
                                            <p class="wsus__tk">{{ $setting->currency_icon }}{{ $item->price }}</p>
                                        @endif

                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
@endpush

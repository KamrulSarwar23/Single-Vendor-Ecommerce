@extends('frontend.layouts.master')

@section('title')
    {{ $setting->site_name }} || Flash Sale
@endsection

@section('content')
    <!--============================BREADCRUMB START==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Flash Sale</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="javascript:;">Flash Sale</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================BREADCRUMB END==============================-->


    <!--============================DAILY DEALS DETAILS START==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="wsus__offer_countdown">
                                <span class="end_text">ends time :</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($flashSaleItem as $item)
                        @php
                            $product = \App\Models\Product::findOrFail($item->product_id);
                        @endphp

                        <div class="col-xl-3 col-sm-6 col-lg-4">

                            <div class="wsus__product_item">
                                <span class="wsus__new">{{ ProductType($product->product_type) }}</span>

                                @if (checkProductDiscount($product))
                                    <span
                                        class="wsus__minus">-{{ calculateDiscountPercent($product->price, $product->offer_price) }}</span>
                                @endif

                                <a class="wsus__pro_link" href="{{ route('product-detail', $product->slug) }}">
                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                        class="img-fluid w-100 img_1" />

                                    <img src=" 
                                 
                                @if (isset($product->productImageGallery[0]->image)) {{ asset($product->productImageGallery[0]->image) }}
                                @else
                                {{ asset($product->thumb_image) }} @endif "
                                        alt="product" class="img-fluid w-100 img_2" />

                                </a>

                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $product->id }}"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a data-id="{{ $product->id }}" class="addToWishlist" href=""><i
                                                class="far fa-heart"></i></a></li>

                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category" href="#">{{ $product->category->name }} </a>
                                    <p class="wsus__pro_rating">
                                        @php
                                            $avgrating = $product->reviews()->avg('rating');
                                            $fullrating = round($avgrating);
                                        @endphp

                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullrating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor

                                        <span>({{ count($product->reviews) }} review)</span>
                                    </p>
                                    <a class="wsus__pro_name"
                                        href="{{ route('product-detail', $product->slug) }}">{{ limitText($product->name, 30) }}</a>

                                    @if (checkProductDiscount($product))
                                        <p class="wsus__price">{{ $setting->currency_icon }}{{ $product->offer_price }}
                                            <del>${{ $product->price }}</del>
                                        </p>
                                    @else
                                        <p class="wsus__price">{{ $setting->currency_icon }}{{ $product->price }}
                                        </p>
                                    @endif

                                    <form class="shopping-cart-form">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        @foreach ($product->variant as $variant)
                                            <select class="d-none" name="variants_items[]">

                                                @foreach ($variant->productVariantItems as $variantitem)
                                                    <option value="{{ $variantitem->id }}"
                                                        {{ $variantitem->is_default == 1 ? 'selected' : '' }}>
                                                        {{ $variantitem->name }}
                                                        {{ $setting->currency_icon }}{{ $variantitem->price }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endforeach

                                        <input name="qty" type="hidden" min="1" max="100" value="1" />

                                        <button class="add_cart" style="border: none" href="#" type="submit">add to
                                            cart</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    @if ($flashSaleItem->hasPages())
                        {{ $flashSaleItem->links() }}
                    @endif
                </div>

            </div>
        </div>
        </div>
    </section>
    <!--============================ DAILY DEALS DETAILS END ==============================-->


    <!--========================== PRODUCT MODAL VIEW START ===========================-->

    @foreach ($flashSaleItem as $item)
        @php
            $product = \App\Models\Product::findOrFail($item->product_id);
        @endphp

        <section class="product_popup_modal">
            <div class="modal fade" id="exampleModal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="far fa-times"></i></button>
                            <div class="row">
                                <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">

                                    <div class="wsus__quick_view_img">

                                        @if ($product->video_link)
                                            <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                                href="{{ $product->video_link }}">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        @endif

                                        <div class="row modal_slider">
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100">
                                                </div>
                                            </div>

                                            @if (count($product->productImageGallery) == 0)
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                            class="img-fluid w-100">
                                                    </div>
                                                </div>
                                            @endif

                                            @foreach ($product->productImageGallery as $productImage)
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($productImage->image) }}" alt="product"
                                                            class="img-fluid w-100">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="wsus__pro_details_text">
                                        <a class="title" href="javascript:;">{{ $product->name }}</a>
                                        <p class="wsus__stock_area"><span class="in_stock">in stock</span> (167 item)</p>

                                        @if (checkProductDiscount($product))
                                            <h4>{{ $setting->currency_icon }}{{ $product->offer_price }}
                                                <del>{{ $setting->currency_icon }}{{ $product->price }}</del>
                                            </h4>
                                        @else
                                            <h4>{{ $setting->currency_icon }}{{ $product->price }}</h4>
                                        @endif

                                        <p class="review">
                                            @php
                                                $avgrating = $product->reviews()->avg('rating');
                                                $fullrating = round($avgrating);
                                            @endphp

                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $fullrating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor

                                            <span>({{ count($product->reviews) }} review)</span>
                                        </p>

                                        <p class="description">{{ $product->short_description }}</p>


                                        <form class="shopping-cart-form">

                                            <div class="wsus__selectbox">
                                                <div class="row">

                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                    @foreach ($product->variant as $variant)
                                                        @if ($variant->status != 0)
                                                            <div class="col-xl-6 col-sm-6 mb-2">
                                                                <h5 class="mb-2">{{ $variant->name }}:</h5>
                                                                <select class="select_2" name="variants_items[]">
                                                                    @foreach ($variant->productVariantItems as $variantitem)
                                                                        @if ($variantitem->status != 0)
                                                                            <option value="{{ $variantitem->id }}"
                                                                                {{ $variantitem->is_default == 1 ? 'selected' : '' }}>
                                                                                {{ $variantitem->name }}
                                                                                ({{ $setting->currency_icon }}{{ $variantitem->price }})
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>

                                            <div class="wsus__quentity">
                                                <h5>quentity: </h5>
                                                <div class="select_number">
                                                    <input class="number_area" name="qty" type="text"
                                                        min="1" max="100" value="1" />
                                                </div>
                                            </div>

                                            <ul class="wsus__button_area">
                                                <li><button type="submit" class="add_cart" data-href="#">add to
                                                        cart</button></li>
                                                <li><a class="buy_now" href="{{ route('user.checkout') }}">buy now</a>
                                                </li>
                                                <li><a data-id="{{ $product->id }}" class="addToWishlist"
                                                        href="#"><i class="fal fa-heart"></i></a></li>
                                            </ul>

                                        </form>

                                        <p class="brand_model"><span>brand :</span> {{ $product->brand->name }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
    <!--========================== PRODUCT MODAL VIEW END ===========================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            simplyCountdown('.simply-countdown-one', {
                year: {{ date('Y', strtotime($flashSaleDate->end_date)) }},
                month: {{ date('m', strtotime($flashSaleDate->end_date)) }},
                day: {{ date('d', strtotime($flashSaleDate->end_date)) }},
                enableUtc: true
            });
        })
    </script>
@endpush

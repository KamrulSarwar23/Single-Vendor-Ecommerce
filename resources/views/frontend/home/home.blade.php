@extends('frontend.layouts.master')

@section('title')
    {{ $setting->site_name }} Ecommerce
@endsection


@section('content')
    <!--============================ BANNER PART 2 START ==============================-->

    @include('frontend.home.section.banner-slider')

    <!--============================ BANNER PART 2 END ==============================-->




    <!--============================ FLASH SELL START ==============================-->

    @include('frontend.home.section.flash-sale')

    <!--============================FLASH SELL END ==============================-->




    <!--============================ Top Category start ==============================-->

    @include('frontend.home.section.top-category-product')

    <!--============================ Top Category end ==============================-->




    <!--============================ Brand Slider Start ==============================-->

    @include('frontend.home.section.brand-slider')

    <!--============================BRAND SLIDER END==============================-->



    <!--============================SINGLE BANNER START ==============================-->


    @include('frontend.home.section.single-banner')

    <!--============================SINGLE BANNER END==============================-->




    <!--============================HOT DEALS START==============================-->

    @include('frontend.home.section.hot-deals')

    <!--============================HOT DEALS END ==============================-->



    <!--============================ ELECTRONIC PART ONE START  ==============================-->

    @include('frontend.home.section.category-product-slider-one')

    <!--============================ELECTRONIC PART ONE END ==============================-->



    <!--============================ELECTRONIC PART TWO START ==============================-->

    @include('frontend.home.section.category-product-slider-two')  

    <!--============================ELECTRONIC PART TWO END ==============================-->




    <!--============================ LARGE BANNER  START ==============================-->

    {{-- @include('frontend.home.section.large-banner')   --}}

    <!--============================LARGE BANNER  END==============================-->




    <!--============================WEEKLY BEST ITEM START ==============================-->

    {{-- @include('frontend.home.section.weekly-best-item') --}}

    <!--============================WEEKLY BEST ITEM END ==============================-->




    <!--============================HOME SERVICES START==============================-->

    {{-- @include('frontend.home.section.home-services') --}}

    <!--============================HOME SERVICES END==============================-->




    <!--============================ HOME BLOGS START==============================-->

    {{-- @include('frontend.home.section.blog') --}}

    <!--============================ HOME BLOGS END==============================-->
@endsection

@extends('frontend.layouts.master')

@section('title')
    {{ $setting->site_name }} Ecommerce
@endsection


@section('content')
    <!--============================ Banner Part Start ==============================-->

    @include('frontend.home.section.banner-slider')

    <!--============================ Banner Part End ==============================-->



    <!--============================ Flash Sale Start ==============================-->

    @include('frontend.home.section.flash-sale')

    <!--============================ Flash Sale End ==============================-->




    <!--============================ Top Category start ==============================-->

    @include('frontend.home.section.top-category-product')

    <!--============================ Top Category end ==============================-->




    <!--============================ Brand Slider Start ==============================-->

    @include('frontend.home.section.brand-slider')

    <!--============================Brand Slider End==============================-->



    <!--============================Single Banner Start ==============================-->

    @include('frontend.home.section.single-banner')

    <!--============================Single Banner End==============================-->




    <!--============================Hot Deals Start==============================-->

    @include('frontend.home.section.hot-deals')

    <!--============================Hot Deals End ==============================-->


    <!--============================ Electronic Part one Start  ==============================-->

    @include('frontend.home.section.category-product-slider-one')

    <!--============================EElectronic Part one End ==============================-->


    <!--============================Three add banner Start==============================-->

    @include('frontend.home.section.three-add-banner')

    <!--===========================Three add banner End==============================-->


    <!--============================Electronic Part Two Start ==============================-->

    @include('frontend.home.section.category-product-slider-two')

    <!--============================Electronic Part Two End ==============================-->



    <!--============================ Large Banner Start ==============================-->

    @include('frontend.home.section.large-banner')

    <!--============================Large Banner End==============================-->


    <!--============================Weekly Best Item Start==============================-->

    @include('frontend.home.section.weekly-best-item')

    <!--============================Weekly Best Item End ==============================-->



    <!--============================Home Services Start==============================-->

     @include('frontend.home.section.home-services') 

    <!--============================Home Services End==============================-->


    <!--============================Home Blogs Start==============================-->

     @include('frontend.home.section.blog') 

    <!--============================ Home Blogs End==============================-->

@endsection

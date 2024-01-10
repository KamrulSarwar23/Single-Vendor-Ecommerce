@extends('frontend.layouts.master')

@section('title')
    {{ $setting->site_name }} || About Page
@endsection


@section('content')
    <!--============================Breadcrumb Start==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>about</h4>
                        <ul>
                            <li><a href="{{ route('home.page') }}">home</a></li>
                            <li><a href="javascript:;">about</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================Breadcrumb End==============================-->

    <!--============================About Page Start==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-5">
                            {!! @$aboutcontent->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================About Page End==============================-->
@endsection

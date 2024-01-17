@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $setting->site_name }} || User Dashboard
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            @include('frontend.dashboard.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <h3 class="mb-3">User Dashboard</h3>
                    <div class="dashboard_content">
                        <div class="wsus__dashboard">
                            <div class="row">
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="{{ route('user.orders') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Order</p>
                                        <h5 class="text-light">{{ $totalorder }}</h5>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item sky" href="{{ route('user.orders') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Complete Order</p>
                                        <h5 class="text-light">{{ $completeorder }}</h5>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="{{ route('user.orders') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Pending Order</p>
                                        <h5 class="text-light">{{ $pendingorder }}</h5>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item sky" href="{{ route('user.review.index') }}">
                                        <i class="fas fa-star"></i>
                                        <p>Total Review</p>
                                        <h5 class="text-light">{{ $totalreview }}</h5>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="{{ route('user.wishlist.index') }}">
                                        <i class="far fa-heart"></i>
                                        <p>wishlist</p>
                                        <h5 class="text-light">{{ $wishlist }}</h5>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item orange" href="{{ route('user.profile') }}">
                                        <i class="fas fa-user-shield"></i>
                                        <p>profile</p>
                                        <h5 class="text-light">-</h5>
                                    </a>
                                </div>
    
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Home Page Settings</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Settings</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">

                                        <a class="list-group-item list-group-item-action active" id="list-profile-list"
                                            data-toggle="list" href="#list-profile" role="tab">Home Page Section One</a>
                                        <a class="list-group-item list-group-item-action" id="list-messages-list"
                                            data-toggle="list" href="#list-messages" role="tab">Home Page Section
                                            Two</a>
                                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                                            data-toggle="list" href="#list-settings" role="tab">Home Page Section
                                            Three</a>
                                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                                            data-toggle="list" href="#list-slider-four" role="tab">Home Page Section
                                            Four</a>
                                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                                            data-toggle="list" href="#list-slider-five" role="tab">Product Page Banner</a>
                                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                                            data-toggle="list" href="#list-slider-six" role="tab">Cart Page Banner</a>

                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">

                                        @include('admin.advertisement.section.banner-section-one')

                                        @include('admin.advertisement.section.banner-section-two')

                                        @include('admin.advertisement.section.banner-section-three')

                                        @include('admin.advertisement.section.banner-section-four')

                                        @include('admin.advertisement.section.product-page-banner')

                                        @include('admin.advertisement.section.cart-page-banner')

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

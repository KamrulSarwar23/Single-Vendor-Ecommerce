@extends('frontend.layouts.master')

@section('title')
    {{ $setting->site_name }} || Wish List
@endsection


@section('content')
    <!--============================BREADCRUMB START==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>wishlist</h4>
                        <ul>
                            <li><a href="{{ route('home.page') }}">home</a></li>
                            <li><a href="javascript:;">wishlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================BREADCRUMB END==============================-->

    <!--============================Wish List PAGE START==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wsus__cart_list wishlist">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            Product Image
                                        </th>

                                        <th class="wsus__pro_name" style="width:580px">
                                            Product Name
                                        </th>

                                        <th class="wsus__pro_status">
                                            Stock
                                        </th>

                                        <th class="wsus__pro_tk">
                                            price
                                        </th>

                                        <th class="wsus__pro_icon">
                                            action
                                        </th>
                                    </tr>
                                    @foreach ($wishlistproducts as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ asset($item->product->thumb_image) }}"
                                                    alt="product" class="img-fluid w-100">

                                                <a class="removeFromWishList" data-id="{{ $item->product->id }}"
                                                    href="#"><i class="far fa-times"></i></a>
                                            </td>

                                            <td class="wsus__pro_name" style="width:580px">
                                                <p>{{ $item->product->name }}</p>
                                            </td>

                                            <td class="wsus__pro_status">
                                                <p>{{ $item->product->qty }}</p>
                                            </td>


                                            <td class="wsus__pro_tk">
                                                <h6>{{ $setting->currency_icon }}{{ $item->product->price }}</h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a class="common_btn"
                                                    href="{{ route('product-detail', $item->product->slug) }}">view
                                                    Product</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            @if (count($wishlistproducts) == 0)
                                <div class="card mt-5 p-3 text-center">
                                    <h3>Product Not Found</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================Wish List PAGE END==============================-->
@endsection

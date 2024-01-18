@extends('admin.layouts.master')

@section('title')
    {{ $setting->site_name }} || Admin Dashboard
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.order.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Todays Orders</h4>
                            </div>
                            <div class="card-body">
                                {{ $todaysOrder }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.pending.order') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Todays Pending Orders</h4>
                            </div>
                            <div class="card-body">
                                {{ $todaysPendingOrder }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.delivered.order') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Complete Orders</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCompleteOrder }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.pending.order') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pending Orders</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPendingOrder }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
    
     
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.cancel.order') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Canceled Orders</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCancelOrder }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.order.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Orders</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalOrder }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="javascript:;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Todays Earning</h4>
                            </div>
                            <div class="card-body">
                                {{ $todaysEarning }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="javascript:;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>This Month Earnings</h4>
                            </div>
                            <div class="card-body">
                                {{ $monthEarning }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
       

      
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="javascript:;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>This Year Earnings</h4>
                            </div>
                            <div class="card-body">
                                {{ $yearEarning }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="javascript:;">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Earnings</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalEarning }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.review.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Reviews</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalReview }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.brand.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Brands</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalBrand }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
       

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.category.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Categories</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCategory }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.subcategory.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total SubCategoris</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSubCategory }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.childcategory.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total ChildCategories</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalChildCategory }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.coupons.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Coupon</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCoupon }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
      
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.blog.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-pen"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Blogs</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalBlog }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.subscribers') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Subscribers</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSubscriber }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.customer.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Customer</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCustomer }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.vendor.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Vendors</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalVendor }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.admin-list.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Admin</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalAdmin }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.seller-pending-products.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fab fa-product-hunt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Seller Pending Product</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPendingProduct }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.seller-products.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fab fa-product-hunt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Seller Product</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSellerProduct }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.products.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fab fa-product-hunt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Product</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalProduct }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </section>
@endsection

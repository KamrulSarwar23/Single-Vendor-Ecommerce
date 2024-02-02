<style>
    .fa-circle-chevron-down,
    .fa-gear,
    .fa-house,
    .fa-people-roof,
    .fa-sliders,
    .fa-list,
    .fa-product-hunt,
    .fa-list-check,
    .fa-money-check-dollar,
    .fa-windows,
    .fa-bolt,
    .fa-tags,
    .fa-pen,
    .fa-user-tie,
    .fa-shield-halved,
    .fa-sack-dollar,
    .fa-window-maximize,
    .fa-comment,
    .fa-tachometer-alt,
    .fa-paperclip {
        color: #e1e9e6;
        font-size: 15px;
    }

    ul li a {
        font-size: 14px;
    }
</style>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a style="font-size: 22px; color:#d8e4df" href="javascript:;">{{ @$setting->site_name }}</a>
        </div>


        <ul class="sidebar-menu">

            <li class="menu-header">Ecommerce</li>
            <li><a class="nav-link" href="{{ route('home.page') }}"><i class="fa-solid fa-house"></i>
                    <span>Go To Home Page</span>
                </a></li>

            <li class="dropdown {{ setActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>

            </li>
            <li
                class="dropdown {{ setActive(['admin.slider.*', 'admin.home-page-setting.*', 'admin.vendor-condition.*', 'admin.about.*', 'admin.terms-condition.*', 'admin.ecommerce-service.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-shield-halved"></i>
                    <span>Manage Website</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Banner Slider</a></li>

                    <li class="{{ setActive(['admin.home-page-setting.*']) }}"><a class="nav-link"
                            href="{{ route('admin.home-page-setting.index') }}">Home Page Setting</a></li>

                    <li class="{{ setActive(['admin.about.*']) }}"><a class="nav-link"
                            href="{{ route('admin.about.index') }}">About Page</a></li>
                    <li class="{{ setActive(['admin.terms-condition.*']) }}"><a class="nav-link"
                            href="{{ route('admin.terms-condition.index') }}">Terms & Conditions</a></li>
                <li class="{{ setActive(['admin.ecommerce-service.*']) }}"><a class="nav-link"
                                href="{{ route('admin.ecommerce-service.index') }}">Ecommerce Service</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.category.*', 'admin.subcategory.*', 'admin.childcategory.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa-solid fa-bolt"></i>
                    <span>Manage Category</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Categories</a></li>
                    <li class="{{ setActive(['admin.subcategory.*']) }}"><a class="nav-link"
                            href="{{ route('admin.subcategory.index') }}">Sub Category</a></li>
                    <li class="{{ setActive(['admin.childcategory.*']) }}"><a class="nav-link"
                            href="{{ route('admin.childcategory.index') }}">Child Category</a></li>

                </ul>
            </li>

            <li
                class="dropdown {{ setActive([
                    'admin.order.*',
                    'admin.pending.*',
                    'admin.delivered.*',
                    'admin.processed-ready.*',
                    'admin.dropped-off.*',
                    'admin.shipped.*',
                    'admin.outfor-delivery.*',
                    'admin.cancel.*',
                ]) }}">

                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-comment"></i>
                    <span>Manage Orders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.order.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order.index') }}">All Orders</a></li>

                    <li class="{{ setActive(['admin.pending.*']) }}"><a class="nav-link"
                            href="{{ route('admin.pending.order') }}">Pending Orders</a></li>

                    <li class="{{ setActive(['admin.processed-ready.*']) }}"><a class="nav-link"
                            href="{{ route('admin.processed-ready.order') }}">Processed & Ready Ship</a></li>

                    <li class="{{ setActive(['admin.dropped-off.*']) }}"><a class="nav-link"
                            href="{{ route('admin.dropped-off.order') }}">Dropped Off Orders</a></li>

                    <li class="{{ setActive(['admin.shipped.*']) }}"><a class="nav-link"
                            href="{{ route('admin.shipped.order') }}">Shipped Orders</a></li>

                    <li class="{{ setActive(['admin.outfor-delivery.*']) }}"><a class="nav-link"
                            href="{{ route('admin.outfor-delivery.order') }}">Out For Delivery Orders</a></li>

                    <li class="{{ setActive(['admin.delivered.*']) }}"><a class="nav-link"
                            href="{{ route('admin.delivered.order') }}">Delivered Orders</a></li>

                    <li class="{{ setActive(['admin.cancel.*']) }}"><a class="nav-link"
                            href="{{ route('admin.cancel.order') }}">Cancel Orders</a></li>
                </ul>
            </li>

            <li
                class="dropdown 
            {{ setActive([
                'admin.brand.*',
                'admin.products.*',
                'admin.seller-products.*',
                'admin.seller-pending-products.*',
                'admin.product-image-gallery.*',
                'admin.product-variant.*',
                'admin.product-variant-item.*',
                'admin.review.*',
            ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-brands fa-product-hunt"></i>
                    <span>Manage Products</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link"
                            href="{{ route('admin.brand.index') }}">Brands</a></li>

                    <li
                        class="{{ setActive([
                            'admin.products.*',
                            'admin.product-image-gallery.*',
                            'admin.product-variant.*',
                            'admin.product-variant-item.*',
                        ]) }}">
                        <a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
                    </li>

                    <li class="{{ setActive(['admin.review.*']) }}"><a class="nav-link"
                            href="{{ route('admin.review.index') }}">Product Reviews</a></li>

                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['admin.vendor-profile.*', 'admin.flash-sale.*', 'admin.coupons.*', 'admin.shipping-rule.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-paperclip"></i>
                    <span>Manage Ecommerce</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.flash-sale.*']) }}"><a class="nav-link"
                            href="{{ route('admin.flash-sale.index') }}">Flash Sale</a></li>

                    <li class="{{ setActive(['admin.coupons.*']) }}"><a class="nav-link"
                            href="{{ route('admin.coupons.index') }}">Coupons</a></li>

                    <li class="{{ setActive(['admin.shipping-rule.*']) }}"><a class="nav-link"
                            href="{{ route('admin.shipping-rule.index') }}">Shipping Rule</a></li>


                </ul>
            </li>


            <li class="dropdown {{ setActive(['admin.blog-category.*', 'admin.blog.*', 'admin.blog-comment']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-pen"></i>
                    <span>Manage Blog</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.blog-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.blog-category.index') }}">Blog Categories</a></li>
                    <li class="{{ setActive(['admin.blog.*']) }}"><a class="nav-link"
                            href="{{ route('admin.blog.index') }}">Blog</a></li>
                    <li class="{{ setActive(['admin.blog-comment']) }}"><a class="nav-link"
                            href="{{ route('admin.blog-comment') }}">Blog Comments</a></li>
                </ul>
            </li>


            <li
                class="dropdown {{ setActive(['admin.footer-info.*', 'admin.footer-social.*', 'admin.footer-grid-two.*', 'admin.footer-grid-three.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-tags"></i>
                    <span>Manage Footer</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.footer-info.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-info.index') }}">Footer Info</a></li>

                    <li class="{{ setActive(['admin.footer-social.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-social.index') }}">Footer Social Icon</a></li>

                    <li class="{{ setActive(['admin.footer-grid-two.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-two.index') }}">Footer Grid Two</a></li>

                    <li class="{{ setActive(['admin.footer-grid-three.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-three.index') }}">Footer Grid Three</a></li>
                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['admin.vendor-request.*', 'admin.customer.*', 'admin.vendor.*', 'admin.manage-user.*', 'admin.admin-list.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-user-tie"></i>
                    <span>Manage Users</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.customer.*']) }}"><a class="nav-link"
                            href="{{ route('admin.customer.index') }}">Customers</a></li>
                    <li class="{{ setActive(['admin.admin-list.*']) }}"><a class="nav-link"
                            href="{{ route('admin.admin-list.index') }}">Admin List</a></li>
                    <li class="{{ setActive(['admin.manage-user.*']) }}"><a class="nav-link"
                            href="{{ route('admin.manage-user.index') }}">Create User by Role</a></li>
                </ul>
            </li>

            <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link"
                href="{{ route('admin.vendor-profile.index') }}"><i
                    class="fa-solid fa-money-check-dollar"></i><span>Manage
                    Seller Profile</span></a></li>


            <li class="{{ setActive(['admin.transaction']) }}"><a class="nav-link"
                    href="{{ route('admin.transaction') }}"><i
                        class="fa-solid fa-money-check-dollar"></i><span>Manage
                        Transaction</span></a></li>

            <li class="{{ setActive(['admin.subscribers']) }}"><a class="nav-link"
                    href="{{ route('admin.subscribers') }}"><i class="fa-solid fa-people-roof"></i>
                    <span>Subscribers</span>
                </a></li>

            <li class="{{ setActive(['admin.advertisement.index']) }}"><a class="nav-link"
                    href="{{ route('admin.advertisement.index') }}"><i class="fa-solid fa-people-roof"></i>
                    <span>Advertisement</span>
                </a></li>

            <li class="{{ setActive(['admin.setting.index']) }}"><a class="nav-link"
                    href="{{ route('admin.setting.index') }}"><i class="fa-solid fa-gear"></i> <span>Site
                        Settings</span>
                </a></li>

            <li class="{{ setActive(['admin.payment-settings.*']) }}"><a class="nav-link"
                    href="{{ route('admin.payment-settings.index') }}"><i
                        class="fa-solid fa-sack-dollar"></i><span>Payment
                        Setting</span></a></li>
        </ul>

    </aside>
</div>

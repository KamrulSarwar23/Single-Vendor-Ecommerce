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
    .fa-windows {
        color: #5C8374;
    }

    ul li a {
        font-size: 14px;
    }

</style>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ setActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fa-solid fa-house"></i><span>Dashboard</span></a>

            </li>
            <li class="menu-header">Starter</li>
            <li class="dropdown {{ setActive(['admin.slider.*','admin.home-page-setting.*' ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-sliders"></i>
                    <span>Manage Website</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Banner Slider</a></li>

                    <li class="{{ setActive(['admin.home-page-setting.*']) }}"><a class="nav-link"
                            href="{{ route('admin.home-page-setting.index') }}">Home Page Setting</a></li>

                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.category.*', 'admin.subcategory.*', 'admin.childcategory.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa-solid fa-list"></i>
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
                        class="fa-solid fa-people-roof"></i>
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

            <li class="{{ setActive(['admin.transaction']) }}"><a class="nav-link"
                    href="{{ route('admin.transaction') }}"><i class="fa-solid fa-money-check-dollar"></i><span>Manage
                        Transaction</span></a></li>

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

                    <li class="{{ setActive(['admin.seller-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-products.index') }}">Seller Products</a></li>

                    <li class="{{ setActive(['admin.seller-pending-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-pending-products.index') }}">Seller Pending Products</a></li>

                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['admin.vendor-profile.*', 'admin.flash-sale.*', 'admin.coupons.*', 'admin.shipping-rule.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-list-check"></i>
                    <span>Manage Ecommerce</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.flash-sale.*']) }}"><a class="nav-link"
                            href="{{ route('admin.flash-sale.index') }}">Flash Sale</a></li>

                    <li class="{{ setActive(['admin.coupons.*']) }}"><a class="nav-link"
                            href="{{ route('admin.coupons.index') }}">Coupons</a></li>

                    <li class="{{ setActive(['admin.shipping-rule.*']) }}"><a class="nav-link"
                            href="{{ route('admin.shipping-rule.index') }}">Shipping Rule</a></li>

                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-profile.index') }}">Vendor Profile</a></li>



                </ul>
            </li>
            <li class="{{ setActive(['admin.setting.index']) }}"><a class="nav-link"
                    href="{{ route('admin.setting.index') }}"><i class="fa-solid fa-gear"></i> <span>Site
                        Settings</span>
                </a></li>

            <li class="{{ setActive(['admin.payment-settings.*']) }}"><a class="nav-link"
                    href="{{ route('admin.payment-settings.index') }}"><i class="fa-solid fa-gear"></i><span>Payment
                        Setting</span></a></li>
        </ul>

    </aside>
</div>

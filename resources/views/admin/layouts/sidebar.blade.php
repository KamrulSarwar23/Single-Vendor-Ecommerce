<style>
    .active {
        background-color: rgb(93, 114, 236, 0.5)
    }

    .fa-circle-chevron-down,
    .fa-gear {
        color: rgb(93, 114, 236)
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
                        class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>
            <li class="menu-header">Starter</li>
            <li class="dropdown {{ setActive(['admin.slider.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-circle-chevron-down"></i>
                    <span>Manage Slider</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Slider</a></li>

                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.category.*', 'admin.subcategory.*', 'admin.childcategory.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-circle-chevron-down"></i>
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

            <li class="dropdown {{ setActive(['admin.order.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-circle-chevron-down"></i>
                    <span>Manage Orders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.order.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order.index') }}">All Orders</a></li>
                    
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
            ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-solid fa-circle-chevron-down"></i>
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
                        class="fa-solid fa-circle-chevron-down"></i>
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
                    href="{{ route('admin.setting.index') }}"><i class="fa-solid fa-gear"></i> <span>Site Settings</span>
                </a></li>

            <li class="{{ setActive(['admin.payment-settings.*']) }}"><a class="nav-link"
                    href="{{ route('admin.payment-settings.index') }}"><i class="fa-solid fa-gear"></i><span>Payment Setting</span></a></li>
        </ul>

    </aside>
</div>

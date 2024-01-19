<style>
    .active {
        background-color: rgba(0, 0, 0, 0.4);
    }
</style>

<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="{{ asset(@$logosetting->logo) }}" alt="logo"
            class="img-fluid"></a>
    <ul class="dashboard_link">
        <li class=""><a class="" href="{{ route('home.page') }}"><i class="fas fa-home"></i>Go To Home Page</a></li>
        <li class="{{ setActive(['vendor.dashboard']) }}"><a class="" href="{{ route('vendor.dashboard') }}"><i
                    class="fas fa-tachometer"></i>Dashboard</a></li>
        <li class="{{ setActive(['vendor.orders']) }}"><a class="" href="{{ route('vendor.orders') }}"><i class="far fa-clipboard"></i>Orders</a></li>
        <li class="{{ setActive(['vendor.products.*']) }}"><a href="{{ route('vendor.products.index') }}"><i class="fab fa-product-hunt"></i>Products</a></li>
        <li class="{{ setActive(['vendor.review.index']) }}"><a href="{{ route('vendor.review.index') }}"><i class="fas fa-star"></i>Reviews</a></li>
        <li class="{{ setActive(['vendor.shop-profile.*']) }}"><a href="{{ route('vendor.shop-profile.index') }}"><i
                    class="far fa-user"></i> Seller Profile</a></li>
        <li class="{{ setActive(['vendor.profile']) }}"><a href="{{ route('vendor.profile') }}"><i
                    class="far fa-user"></i> My Profile</a></li>
        <li>


            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
            this.closest('form').submit();"><i
                        class="far fa-sign-out-alt"></i> Log out</a>

            </form>

        </li>
    </ul>
</div>

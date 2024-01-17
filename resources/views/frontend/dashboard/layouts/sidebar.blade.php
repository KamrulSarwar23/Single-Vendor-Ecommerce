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
    <a href="dsahboard.html" class="dash_logo"><img src="{{ asset('frontend/images/logo.png') }}" alt="logo"
            class="img-fluid"></a>
    <ul class="dashboard_link">

        <li class=""><a href="{{ route('home.page') }}"><i class="fas fa-home"></i>Go To Home Page</a></li>

        <li class="{{ setActive(['user.dashboard']) }}"><a href="{{ route('user.dashboard') }}"><i
                    class="fas fa-tachometer"></i>Dashboard</a></li>

        @auth
            @if (auth()->user()->role == 'vendor')
                <li class="{{ setActive(['vendor.dashboard']) }}"><a href="{{ route('vendor.dashboard') }}"><i
                            class="fas fa-tachometer"></i>Go To Vendor Dashboard</a></li>
            @endif
        @endauth

        <li class="{{ setActive(['user.orders']) }}"><a href="{{ route('user.orders') }}"><i class="fas fa-list-ul"></i>
                Orders</a></li>
        <li class="{{ setActive(['user.review.index']) }}"><a href="{{ route('user.review.index') }}"><i
                    class="far fa-star"></i> Reviews</a></li>
        <li class="{{ setActive(['user.profile']) }}"><a href="{{ route('user.profile') }}"><i class="far fa-user"></i>
                My Profile</a></li>

        <li class="{{ setActive(['user.address.index']) }}"><a href="{{ route('user.address.index') }}"><i
                    class="fal fa-gift-card"></i> Addresses</a></li>

        @auth
            @if (auth()->user()->role !== 'vendor')
                <li class="{{ setActive(['user.vendor.request']) }}"><a href="{{ route('user.vendor.request') }}"><i
                            class="far fa-user"></i>
                        Request To Be Vendor</a></li>
            @endif
        @endauth

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
            this.closest('form').submit();"><i
                        class="far fa-sign-out-alt"></i>Log out</a>

            </form>
        </li>
    </ul>
</div>

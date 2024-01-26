@php

    $categories = App\Models\Category::where('status', 1)
        ->with([
            'subcategories' => function ($query) {
                $query->where('status', 1)->with([
                    'childcategories' => function ($query) {
                        $query->where('status', 1);
                    },
                ]);
            },
        ])
        ->get();
@endphp

<!--============================ MAIN  MENU START ==============================-->

<nav class="wsus__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>

                    <ul class="wsus_menu_cat_item show_home toggle_menu">
                        
                        @foreach ($categories as $category)
                            <li><a class="{{ count($category->subcategories) > 0 ? 'wsus__droap_arrow' : '' }}"
                                    href="{{ route('products.index', ['category' => $category->slug]) }}"><i
                                        class="{{ $category->icon }}"></i>
                                    {{ $category->name }}
                                </a>
                                <ul class="{{ count($category->subcategories) > 0 ? 'wsus_menu_cat_droapdown' : '' }}">

                                    @foreach ($category->subcategories as $subcategory)
                                        <li><a
                                                href="{{ route('products.index', ['subcategory' => $subcategory->slug]) }}">{{ $subcategory->name }}
                                                <i
                                                    class="{{ count($subcategory->childcategories) > 0 ? 'fas fa-angle-right' : '' }}"></i></a>
                                            <ul
                                                class="{{ count($subcategory->childcategories) > 0 ? 'wsus__sub_category' : '' }}">

                                                @foreach ($subcategory->childcategories as $childcategory)
                                                    <li><a
                                                            href="{{ route('products.index', ['childcategory' => $childcategory->slug]) }}">{{ $childcategory->name }}</a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach

                        <li><a href="{{ route('products.index') }}"><i class="fal fa-gem"></i> View All Categories</a>
                        </li>
                    </ul>

                    <ul class="wsus__menu_item">
                        <li><a class="{{ setActive(['home.page']) }}" href="{{ route('home.page') }}">home</a></li>
                        <li><a class="{{ setActive(['products.index']) }}" href="#">shop <i
                                    class="fas fa-caret-down"></i></a>
                            <div class="wsus__mega_menu">
                                <div class="row">
                                    @foreach ($categories->take(4) as $category)
                                        <div class="col-xl-3 col-lg-3">
                                            <div class="wsus__mega_menu_colum">
                                                <h4> <a
                                                        href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                                </h4>

                                                <ul class="wsis__mega_menu_item">
                                                    @foreach ($category->subcategories as $subcategory)
                                                        <li><a
                                                                href="{{ route('products.index', ['subcategory' => $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                                                        </li>

                                                        @foreach ($subcategory->childcategories as $childcategory)
                                                            <li><a
                                                                    href="{{ route('products.index', ['childcategory' => $childcategory->slug]) }}">{{ $childcategory->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>

                        <li><a class="{{ setActive(['blog']) }}" href="{{ route('blog') }}">blog</a></li>

                        <li class="wsus__relative_li"><a
                                class="{{ setActive(['about.index', 'terms-condition.index']) }}" href="#">Terms
                                & Condition <i class="fas fa-caret-down"></i></a>
                            <ul class="wsus__menu_droapdown">
                                <li><a href="{{ route('about.index') }}">about</a></li>
                                <li><a href="{{ route('terms-condition.index') }}">privacy policy</a></li>
                            </ul>
                        </li>
                        <li><a class="{{ setActive(['flash-sale']) }}" href="{{ route('flash-sale') }}">Flash Sale</a>
                        </li>
                        <li><a class="{{ setActive(['product-track.index']) }}"
                                href="{{ route('product-track.index') }}">track order</a></li>

                    </ul>
                    <ul class="wsus__menu_item wsus__menu_item_right">
                        <li><a class="{{ setActive(['contact.index']) }}"
                                href="{{ route('contact.index') }}">contact</a></li>
                        @auth
                            @if (auth()->user()->role === 'user')
                                <li><a class="btn btn-secondary text-white" href="{{ route('user.dashboard') }}">Go
                                        Dashboard</a></li>
                            @elseif(auth()->user()->role === 'admin')
                                <li><a class="btn btn-secondary text-white" href="{{ route('admin.dashboard') }}">Go
                                        Dashboard</a></li>
                            @endif
                        @else
                            <li><a class="btn btn-secondary text-white" href="{{ route('login') }}">Login</a></li>
                        @endauth

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!--============================ MAIN MENU END ==============================-->


<!--============================ MOBILE MENU START==============================-->

<section id="wsus__mobile_menu">
    <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
    <ul class="wsus__mobile_menu_header_icon d-inline-flex">


        <li>
            <a href="{{ route('user.wishlist.index') }}">
                <i class="fal fa-heart"></i>
                <span id="wishList_count">
                    @if (auth()->check())
                        {{ \App\Models\WishList::where('user_id', auth()->user()->id)->count() }}
                    @else
                        0
                    @endif
                </span>
            </a>
        </li>

        <li>
            @auth
            @if (auth()->user()->role === 'user')
                <li><a class="text-white" href="{{ route('user.dashboard') }}"><i class="fal fa-user"></i></a></li>
            @elseif(auth()->user()->role === 'admin')
                <li><a class="text-white" href="{{ route('admin.dashboard') }}"><i class="fal fa-user"></i></a></li>
            @endif
        @else
            <li><a class="text-white" href="{{ route('login') }}">Login</a></li>
        @endauth

        </li>
    </ul>

    <form action="{{ route('products.index') }}" method="GET">
        <input type="text" placeholder="Search" name="search" value="{{ request()->search }}">
        <button type="submit"><i class="far fa-search"></i></button>
    </form>


    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                role="tab" aria-controls="pills-home" aria-selected="true">Categories</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                role="tab" aria-controls="pills-profile" aria-selected="false">main menu</button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <ul class="wsus_mobile_menu_category">

                        @foreach ($categories as $category)
                            <li><a href="{{ route('products.index', ['category' => $category->slug]) }}"
                                    class="{{ count($category->subcategories) > 0 ? 'accordion-button' : '' }} collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreew-{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="flush-collapseThreew-{{ $loop->index }}"><i
                                        class="{{ $category->icon }}"></i>
                                    {{ $category->name }} </a>

                                @if (count($category->subcategories) > 0)
                                    <div id="flush-collapseThreew-{{ $loop->index }}"
                                        class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach ($category->subcategories as $subcategory)
                                                    <li><a
                                                            href="{{ route('products.index', ['subcategory' => $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        <li><a href="{{ route('home.page') }}">home</a></li>
                        <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">shop</a>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample2">
                                <div class="accordion-body">
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li><a
                                                    href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a href="{{ route('blog') }}">blog</a></li>
                        <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree101" aria-expanded="false"
                                aria-controls="flush-collapseThree101">Terms & Condition</a>
                            <div id="flush-collapseThree101" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample2">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="{{ route('about.index') }}">about us</a></li>
                                        <li><a href="{{ route('terms-condition.index') }}">privacy & policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a href="{{ route('product-track.index') }}">track order</a></li>
                        <li><a href="{{ route('flash-sale') }}">flash sale</a></li>
                        <ul class="">

                            @auth
                                @if (auth()->user()->role === 'user')
                                    <li><a class="text-white" href="{{ route('user.dashboard') }}">Go
                                            Dashboard</a></li>
                                @elseif(auth()->user()->role === 'vendor')
                                    <li><a class="text-white" href="{{ route('vendor.dashboard') }}">Go
                                            Dashboard</a></li>
                                @elseif(auth()->user()->role === 'admin')
                                    <li><a class="text-white" href="{{ route('admin.dashboard') }}">Go
                                            Dashboard</a></li>
                                @endif
                            @else
                                <li><a class="text-white" href="{{ route('login') }}">Login</a></li>
                            @endauth

                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!--============================ MOBILE MENU END ==============================-->

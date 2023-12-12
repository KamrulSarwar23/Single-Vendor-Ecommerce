<section id="wsus__hot_deals" class="wsus__hot_deals_2">
    <div class="container">

        <div class="wsus__hot_large_item">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header justify-content-start">
                        <div class="monthly_top_filter2 mb-1">
                            <button class="active auto_click" data-filter=".new_arrival">New Arrival</button>
                            <button data-filter=".featured_product">Featured</button>
                            <button data-filter=".top_product">Top Product</button>
                            <button data-filter=".best_product">Best Product</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row grid2">
                @foreach ($typeBaseProduct as $key => $products)
                    @foreach ($products as $product)
                        <div class="col-xl-3 col-sm-6 col-lg-4 {{ $key }}">

                            <div class="wsus__product_item">
                                <span class="wsus__new">{{ ProductType($product->product_type) }}</span>

                                @if (checkProductDiscount($product))
                                    <span
                                        class="wsus__minus">-{{ calculateDiscountPercent($product->price, $product->offer_price) }}</span>
                                @endif

                                <a class="wsus__pro_link" href="{{ route('product-detail', $product->slug) }}">
                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                        class="img-fluid w-100 img_1" />

                                    <img src=" 
                         
                        @if (isset($product->productImageGallery[0]->image)) {{ asset($product->productImageGallery[0]->image) }}
                        @else
                        {{ asset($product->thumb_image) }} @endif "
                                        alt="product" class="img-fluid w-100 img_2" />

                                </a>

                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $product->id }}"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a>
                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category" href="#">{{ $product->category->name }} </a>
                                    <p class="wsus__pro_rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>(133 review)</span>
                                    </p>
                                    <a class="wsus__pro_name"
                                        href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>

                                    @if (checkProductDiscount($product))
                                        <p class="wsus__price">
                                            {{ $setting->currency_icon }}{{ $product->offer_price }}
                                            <del>${{ $product->price }}</del>
                                        </p>
                                    @else
                                        <p class="wsus__price">{{ $setting->currency_icon }}{{ $product->price }}
                                        </p>
                                    @endif

                                    <form class="shopping-cart-form">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        @foreach ($product->variant as $variant)
                                            <select class="d-none" name="variants_items[]">

                                                @foreach ($variant->productVariantItems as $variantitem)
                                                    <option value="{{ $variantitem->id }}"
                                                        {{ $variantitem->is_default == 1 ? 'selected' : '' }}>
                                                        {{ $variantitem->name }}
                                                        {{ $setting->currency_icon }}{{ $variantitem->price }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endforeach

                                        <input name="qty" type="hidden" min="1" max="100"
                                            value="1" />

                                        <button class="add_cart" style="border: none" href="#" type="submit">add
                                            to
                                            cart</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

    </div>
</section>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.shopping-cart-form').on('submit', function(e) {
            e.preventDefault();
            let formdata = $(this).serialize();

            $.ajax({
                method: 'POST',
                data: formdata,
                url: "{{ route('add-to-cart') }}",
                success: function(data) {
                    if (data.status == 'success') {
                        getCartCount()
                        fetchSidebarCartProducts()
                        $('.mini_cart_actions').removeClass('d-none');
                        toastr.success(data.message);
                    } else if (data.status == 'error') {
                        toastr.error(data.message);
                    }

                },
                error: function(data) {

                }
            })
        })

        function getCartCount() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart-count') }}",
                success: function(data) {
                    $('#cart-count').text(data)
                },
                error: function(data) {

                }
            })
        }


        function fetchSidebarCartProducts() {

            $.ajax({
                method: 'GET',
                url: "{{ route('cart-products') }}",
                success: function(data) {
                    $('.mini-cart-wrapper').html("");

                    var html = '';
                    for (let item in data) {
                        let product = data[item];
                        html += `
                         <li id="mini_cart_${product.rowId}">
                                <div class="wsus__cart_img">
                                <a href="{{ url('product-detail') }}/${product.options.slug}"><img src="{{ asset('/') }}${product.options.image}" alt="product"
                                    class="img-fluid w-100"></a>
                                    <a class="wsis__del_icon remove_sidebar_product" data-id="${product.rowId}"
                                    href=""><i class="fas fa-minus-circle"></i></a>
                                </div>

                                <div class="wsus__cart_text">
                                    <a class="wsus__cart_title"
                                        href="{{ url('product-detail') }}/${product.options.slug}">${product.name}</a>
                                    <p>{{ $setting->currency_icon }}${product.price}</p>
                                    <small>Variants  Total: {{ $setting->currency_icon }}${product.options.variants_total}</small>
                                    <br>
                                    <small>Qty: ${product.qty}</small>
                                </div>
                                 
                            </li> `
                    }
                    $('.mini-cart-wrapper').html(html);
                    getSidebarCartSubtotal();
                },
                error: function(data) {

                }
            })
        }

        // Remove Product From Sidebar Cart

        $('body').on('click', '.remove_sidebar_product', function(e) {
            e.preventDefault();
            let rowId = $(this).data('id');
            $.ajax({
                method: 'POST',
                url: "{{ route('cart.remove-sidebar-product') }}",
                data: {
                    rowId: rowId
                },
                success: function(data) {
                    let productId = '#mini_cart_' + rowId;
                    $(productId).remove()
                    getSidebarCartSubtotal()

                    if ($('.mini-cart-wrapper').find('li').length == 0) {
                        $('.mini_cart_actions').addClass('d-none');
                        $('.mini-cart-wrapper').html(
                            '<li class="text-center"> Cart is Empty </li>')
                    }
                    toastr.success(data.message);
                },
                error: function(data) {

                }
            })
        })

        // Get Sidebar Cart Subtotal
        function getSidebarCartSubtotal() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {
                    $('#mini_cart_subtotal').text("{{ $setting->currency_icon }}" + data);
                },
                error: function(data) {

                }
            })
        }

        //add product to wishlist

        $('.addToWishlist').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('user.wishlist.store') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            $('#wishList_count').text(data.count)
                            toastr.success(data.message);
                        } else if (data.status == 'error') {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }

                })
            }),

            $('.removeFromWishList').on('click', function() {

                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('user.wishlist.remove') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            location.reload();
                            toastr.success(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }

                })
            })

    })
</script>

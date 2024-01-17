@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);
@endphp

@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <section class="section">
                        <div class="col-md-12 text-right mb-3">
                              
                            <button class="btn btn-warning btn-icon icon-left print-invoice"><i
                                    class="fas fa-print"></i>
                                Print</button>
                        </div>
                        <div class="invoice">
                            <div class="invoice-print">
                                <div class="row">
                                
                                    <div class="col-lg-12">
                                        <div class="invoice-title">
                                            <h2>Invoice</h2>
                                            <div class="invoice-number">Order #{{ $order->invoice_id }}</div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <address>
                                                    <strong>Billed To:</strong><br>
                                                    <b>Name:</b> {{ $address->name }}<br>
                                                    <b>Email:</b> {{ $address->email }}<br>
                                                    <b>Phone:</b> {{ $address->phone }}<br>
                                                    <b>Address:</b> {{ $address->address }}<br>
                                                    {{ $address->city }}, {{ $address->state }},
                                                    {{ $address->zip_code }}<br>
                                                    {{ $address->country }}
                                                </address>
                                            </div>
                                            <div class="col-md-6 text-md-right">
                                                <address>
                                                    <strong>Billed To:</strong><br>
                                                    <b>Name:</b> {{ $address->name }}<br>
                                                    <b>Email:</b> {{ $address->email }}<br>
                                                    <b>Phone:</b> {{ $address->phone }}<br>
                                                    <b>Address:</b> {{ $address->address }}<br>
                                                    {{ $address->city }}, {{ $address->state }},
                                                    {{ $address->zip_code }}<br>
                                                    {{ $address->country }}
                                                </address>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <address>
                                                    <strong>Payment Method:</strong><br>
                                                    <br>Method:</b> {{ $order->payment_method }} <br>
                                                    <br>Transaction Id: {{ @$order->transaction->transaction_id }}</b> <br>
                                                    <br>Payment Status:</b>
                                                    {{ $order->payment_status == 1 ? 'Completed' : 'Pending' }}
                                                </address>
                                            </div>
                                            <div class="col-md-6 text-md-right">
                                                <address>
                                                    <strong>Order Date:</strong><br>
                                                    {{ date('d F, Y', strtotime($order->created_at)) }}<br><br>
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="section-title">Order Summary</div>
                                        <p class="section-lead">All items here cannot be deleted.</p>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-md">
                                                <tr>
                                                    <th data-width="40">#</th>
                                                    <th>Item</th>
                                                    <th>Variant</th>
                                                    <th>Shop Name</th>
                                                    <th class="text-center">Price</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-right">Totals</th>
                                                </tr>

                                                @foreach ($order->orderProduct as $product)
                                                    @php
                                                        $variant = json_decode($product->variants);

                                                    @endphp

                                                    <tr>
                                                        <td>{{ ++$loop->index }}</td>

                                                        @if (isset($product->product->slug))
                                                            <td><a
                                                                    href="{{ route('product-detail', $product->product->slug) }}">{{ $product->product_name }}</a>
                                                            </td>
                                                        @else
                                                            <td>{{ $product->product_name }}</td>
                                                        @endif

                                                        <td>
                                                            @foreach ($variant as $key => $variant)
                                                                {{ $key }}: {{ $variant->name }}
                                                                ({{ @$setting->currency_icon }}{{ $variant->price }})
                                                            @endforeach
                                                        </td>

                                                        <td>{{ $product->vendor->shop_name }}</td>

                                                        <td class="text-center">
                                                            {{ @$setting->currency_icon }}{{ $product->unit_price }}
                                                        </td>
                                                        <td class="text-center">{{ $product->qty }}</td>
                                                        <td class="text-right">
                                                            {{ @$setting->currency_icon }}{{ ($product->unit_price + $product->variants_total) * $product->qty }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </table>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-lg-8">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Order Status</label>

                                                        <select name="order_status" id="order_status"
                                                            data-id='{{ $order->id }}' class="form-control">
                                                            @foreach (config('order-status.order_status_admin') as $key => $orderStatus)
                                                                <option {{ $order->order_status == $key ? 'selected' : '' }}
                                                                    value="{{ $key }}">
                                                                    {{ $orderStatus['status'] }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Payment Status</label>
                                                        <select name="payment_status" id="payment_status"
                                                            data-id="{{ $order->id }}" class="form-control">
                                                            <option {{ $order->payment_status == 0 ? 'selected' : '' }}
                                                                value="0">Pending</option>
                                                            <option {{ $order->payment_status == 1 ? 'selected' : '' }}
                                                                value="1">Completed</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-4 text-right">
                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-name">Subtotal</div>
                                                    <div class="invoice-detail-value">
                                                        {{ @$setting->currency_icon }}{{ $order->sub_total }}</div>
                                                </div>

                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-name">Coupon (-)</div>
                                                    @if ($coupon)
                                                        @if ($coupon->discount_type == 'amount')
                                                            <div class="invoice-detail-value">
                                                                {{ @$setting->currency_icon }}{{ $coupon->discount }}</div>
                                                        @elseif($coupon->discount_type == 'percent')
                                                            <div class="invoice-detail-value">%{{ @$coupon->discount }}
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="invoice-detail-value">0</div>
                                                    @endif
                                                </div>



                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-name">Shipping (+)</div>
                                                    <div class="invoice-detail-value">
                                                        {{ @$setting->currency_icon }}{{ @$shipping->cost }}
                                                    </div>
                                                </div>

                                                <hr class="mt-2 mb-2">
                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-name">Total</div>
                                                    <div class="invoice-detail-value invoice-detail-value-lg">
                                                        {{ @$setting->currency_icon }}{{ $order->amount }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="text-md-right">
                              
                                <button class="btn btn-warning btn-icon icon-left print-invoice"><i
                                        class="fas fa-print"></i>
                                    Print</button>
                            </div>
                        </div>

                    </section>

                </div>

            </div>
        </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            //     $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            $('#order_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.order.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })

            $('#payment_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.payment.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })

            $('.print-invoice').on('click', function() {
                let printBody = $('.invoice-print');
                let originalContents = $('body').html();

                $('body').html(printBody.html());
                window.print();

                $('body').html(originalContents);
            })
        })
    </script>
@endpush

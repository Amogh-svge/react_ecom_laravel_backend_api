@extends('admin.layout.admin_layout')
@section('main_content')
    <div class="box-height">
        <h2 class="az-content-title">Order Details</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Order</span>
            <span>Details</span>
        </div>
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-lg-5 card shadow border-0 rounded  mb-4">
                <ul class="card-body order-details-list mt-2">
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Invoice no: </label>
                        <span class="text-danger font-weight-bold">{{ $details->invoice_no }}</span>
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Product Name:</label>
                        {{ $details->product_name }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Product Code:</label>
                        {{ $details->product_code }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Product Size:</label>
                        {{ $details->size }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Product Color:</label>
                        {{ $details->color }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Product Quantity:</label>
                        {{ $details->quantity }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Unit Price:</label>
                        {{ $details->unit_price }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Total:</label>
                        {{ $details->total_price }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Email:</label>
                        {{ Auth::user()->email }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Username:</label>
                        {{ Auth::user()->name }}
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 card shadow border-0 rounded  ">
                <ul class="card-body order-details-list mt-2">
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Payment Method:</label>
                        {{ $details->payment_method }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Delivery Address:</label>
                        {{ $details->delivery_address }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">City:</label>
                        {{ $details->city }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Delivery Charge:</label>
                        {{ $details->delivery_charge }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Order Date:</label>
                        {{ $details->order_date }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Order Time:</label>
                        {{ $details->order_time }}
                    </li>
                    <li>
                        <label class="col-form-label text-lg font-weight-bold mx-2">Order Status:</label>
                        <span>{{ $details->order_status }}</span>
                    </li>
                    <form
                        @if ($details->order_status == 'pending') action="{{ route('order.processing', $details->id) }}"
                        @elseif($details->order_status == 'processing') action="{{ route('order.purchasing', $details->id) }}"
                        @else action="#" @endif
                        method="GET">
                        <button class="w-100 btn btn-success mt-3">
                            @switch($details->order_status)
                                @case('pending')
                                    Processing Order
                                @break

                                @case('processing')
                                    Purchasing Order
                                @break

                                @default
                                    Delete Order
                            @endswitch
                        </button>
                    </form>
                </ul>
            </div>
        </div>
    </div>
@endsection

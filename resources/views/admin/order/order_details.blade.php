@extends('admin.layout.admin_layout')
@section('main_content')
    <div class="box-height">
        <h2 class="az-content-title">Order Details</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Order</span>
            <span>Details</span>
        </div>

        <div class="row d-flex gap-1 align-items-center">
            <div class="col card shadow border-0 rounded mx-4">
                <ul class="card-body order-details-list mt-2">
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Product Name:
                        </label>{{ $details->product_name }}</li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Product Code:
                        </label>{{ $details->product_code }}</li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Product Size:
                        </label>{{ $details->size }}</li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Product Color:
                        </label>{{ $details->color }}
                    </li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Product Quantity:
                        </label>{{ $details->quantity }}</li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Unit Price:
                        </label>{{ $details->unit_price }}
                    </li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Total:
                        </label>{{ $details->total_price }}</li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">User Email:
                        </label>{{ Auth::user()->name }}
                    </li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">User Name:
                        </label>{{ Auth::user()->email }}
                    </li>
                </ul>
            </div>
            <div class="col card shadow border-0 rounded">
                <ul class="card-body order-details-list mt-2">
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Payment Method:
                        </label>{{ $details->payment_method }}</li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Delivery Address:
                        </label>{{ $details->delivery_address }}</li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">City:
                        </label>{{ $details->city }}</li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Delivery Charge:
                        </label>{{ $details->delivery_charge }}
                    </li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Order Date:
                        </label>{{ $details->order_date }}</li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Order Time:
                        </label>{{ $details->order_time }}
                    </li>
                    <li><label class="col-form-label text-lg font-weight-bold mx-2">Order Status:
                        </label>{{ $details->order_status }}</li>
                    <button class="w-100 btn btn-success mt-3">Processing Order</button>
                </ul>
            </div>
        </div>
    </div>
@endsection

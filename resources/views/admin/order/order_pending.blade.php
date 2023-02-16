@extends('admin.layout.admin_layout')
@section('main_content')
    <div class="box-height">
        <h2 class="az-content-title">All Pending Orders</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Order</span>
            <span>Pending Orders</span>
        </div>

        <div class="card-body">
            <div class="table-responsive mt-1">
                <table id="table_id" class="table table-striped " width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Product Name</th>
                            <th>Invoice No.</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending_orders as $key => $order)
                            <tr class="">
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->invoice_no }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td class="text-danger font-weight-bold">{{ $order->order_status }}</td>
                                <td><a href="{{ route('order.details', $order->id) }}" class="btn btn-info">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

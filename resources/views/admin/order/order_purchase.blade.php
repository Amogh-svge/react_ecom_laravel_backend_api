@extends('admin.layout.admin_layout')
@section('main_content')
    <div class="box-height">
        <h2 class="az-content-title">All Purchased Orders</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Order</span>
            <span>Purchased Orders</span>
        </div>

        <div class="card-body">
            <div class="table-responsive mt-1">
                <table id="table_id" class="  table table-striped " width="100%" cellspacing="0">
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
                        @foreach ($purchased_orders as $key => $order)
                            <tr class="">
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->invoice_no }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->order_status }}</td>
                                <td>
                                    <form action="{{ route('order_statement.delete', $order->id) }}" class="statement_form"
                                        data-id="{{ $order->id }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="confirmDelete(this)"
                                            class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

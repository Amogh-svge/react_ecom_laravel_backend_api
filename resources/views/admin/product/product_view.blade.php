@extends('admin.layout.admin_layout')

@section('main_content')
    <div class="box-height">
        <h2 class="az-content-title">Product List</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Product</span>
            <span>List Products</span>
        </div>

        <div class="card-body">
            <div class="table-responsive  mt-1">
                <table id="table_id" class="table table-striped " width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Product Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    <div class="d-flex ">
                                        <div class="recent-product-img">
                                            <img src="{{ $product->image }}" alt={{ $product->title }}>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->product_code }}</td>
                                <td>{{ $product->category }}</td>
                                <td class="d-flex">
                                    <span>
                                        <a class="btn btn-info mx-1"
                                            href={{ route('product.show', $product->id) }}>Details</a>
                                    </span>
                                    <span>
                                        <a class="btn btn-primary mx-2"
                                            href={{ route('product.edit', $product->id) }}>Edit</a>
                                        {{-- <ion-icon name="alert"></ion-icon> --}}
                                    </span>

                                    <form action="{{ route('product.destroy', $product->id) }}" id="product_form_delete"
                                        method="POST">
                                        @method('DELETE') @csrf
                                        <button class="btn btn-danger" type="submit"
                                            onclick="confirmDelete(this)">Remove</button>
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

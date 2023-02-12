@extends('admin.layout.admin_layout')

@section('main_content')
    <div>
        <h2 class="az-content-title">Category List</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Category</span>
            <span>List Category</span>
        </div>

        <div class="card-body">
            <div class="table-responsive  mt-1">
                <table id="table_id" class="  table table-striped " width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Category Image</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    <div class="d-flex ">
                                        <div class="recent-product-img">
                                            <img src="{{ $item->category_image }}" alt={{ $item->category_name }}>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->category_name }}</td>
                                <td class="d-flex">
                                    <span>

                                        <a class="btn btn-primary mx-2"
                                            href={{ route('category.edit', $item->id) }}>Edit</a>
                                    </span>
                                    <form action="{{ route('category.delete', $item->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            onclick="event.preventDefault();
                                        window.confirm('Do you want to delete?')===true && this.closest('form').submit();"
                                            class="btn btn-danger" type="submit">Remove</button>
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

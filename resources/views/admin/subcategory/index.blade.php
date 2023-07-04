@extends('admin.layout.admin_layout')

@section('main_content')
    <div class="box-height">
        <h2 class="az-content-title">Sub_Category List</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Sub_Category</span>
            <span>List Sub_Category</span>
        </div>

        <div class="card-body">
            <div class="table-responsive mt-1">
                <table id="table_id" class="  table table-striped " width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Category</th>
                            <th>Sub_Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sub_categories as $key => $sub_category)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $sub_category->category_name }}</td>
                                <td>{{ $sub_category->subcategory_name }}</td>
                                <td class="d-flex">
                                    <span>
                                        <a class="btn btn-primary mx-2"
                                            href={{ route('subcategory.edit', $sub_category->id) }}>Edit</a>
                                    </span>
                                    <form action="{{ route('subcategory.destroy', $sub_category->id) }}"
                                        data-id="{{ $sub_category->id }}" class="subcategory_delete_form" method="POST">
                                        @method('DELETE') @csrf
                                        <button class="btn btn-danger" onclick="confirmDelete(this)"
                                            type="submit">Remove</button>
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

@extends('admin.layout.admin_layout')

@section('main_content')
    <div class="box-height">
        <h2 class="az-content-title">Product List</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Permissions</span>
            <span>List Permissions</span>
        </div>

        <div class="card-body">
            <div class="table-responsive  mt-1">
                <table id="table_id" class="table table-striped " width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                            <tr>
                                <td scope="row">{{ $key + 1 }}</td>
                                <td>{{ $permission->name }}</td>
                                <td class="d-flex">
                                    <span>
                                        <a class="btn btn-info mx-1"
                                            href={{ route('permission.show', $permission->id) }}>Details</a>
                                    </span>
                                    <span>
                                        <a class="btn btn-primary mx-2"
                                            href={{ route('permission.edit', $permission->id) }}>Edit</a>
                                    </span>

                                    <form action="{{ route('permission.destroy', $permission->id) }}"
                                        data-id="{{ $permission->id }}" class="permission_form_delete" method="POST">
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

@extends('admin.layout.admin_layout')

@section('main_content')
    <div class="box-height">
        <h2 class="az-content-title">List Roles Permission</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Role</span>
            <span>List Roles Permission</span>
        </div>

        <div class="card-body">
            <div class="d-flex my-4">
                <a href="{{ route('roles.add_roles_to_permission') }}" class="btn btn-info">Assign Permission</a>
            </div>
            <div class="table-responsive  mt-1">
                <table id="table_id" class="table table-striped " width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($roles as $role)
                                        <span class="badge rounded-pill m-1 p-2 bg-warning">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="d-flex">
                                    <span>
                                        <a class="btn btn-primary mx-2" href={{ route('roles.edit', $role->id) }}>Edit</a>
                                    </span>

                                    <form action="{{ route('roles.destroy', $role->id) }}" data-id="{{ $role->id }}"
                                        class="role_form_delete" method="POST">
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

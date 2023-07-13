@extends('admin.layout.admin_layout')

@section('main_content')
    <div class="az-dashboard-one-title">
        <div class="az-content-breadcrumb text-dark m-2">
            <span>Dashboard</span>
            <span>Role</span>
            <span>Add Roles In Permission</span>
        </div>
    </div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Roles In Permission
            </h2>
        </x-slot>

        <form enctype="multipart/form-data" action={{ route('roles.store') }} class="form-inputs my-3" method="POST">
            @csrf

            <div class="row row-sm p-4">
                <div class="col-lg-12 my-2">
                    <label class="az-content-label mb-3">Role Name</label>
                    <select class="form-control select2">
                        <option label="Choose one"></option>
                        @forelse ($roles as $role)
                            <option value={{ $role->id }}>{{ $role->name }}</option>
                        @empty
                            <option value="#">No Roles</option>
                        @endforelse
                    </select>
                    @include('admin.common.error', ['field' => 'name']) {{-- error message --}}
                </div>

                <div class="col-lg-12 my-2 p-1 border-bottom border-secondary">
                    <input type="checkbox" class="m-1"><span class=" font-bold">PERMISSION ALL</span>
                </div>
                <div class="col-lg-12 my-2 p-1 d-flex flex-wrap justify-content-between">
                    @forelse ($permissions as $key =>  $groups)
                        <div class="border-bottom p-2">
                            <label
                                class="text-uppercase font-bold text-md text-gray-800 leading-tight mx-1">{{ $key }}
                            </label>
                            <input type="checkbox">
                            @foreach ($groups as $permission)
                                <div class="d-flex m-1">
                                    <input type="checkbox" class="m-1"
                                        value={{ $permission->id }}><span>{{ $permission->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    @empty
                    @endforelse
                </div>

                <div class="col-lg-12 my-3 d-flex">
                    <Button class="btn btn-primary">Save Changes</Button>
                </div>
            </div>
        </form>

    </x-app-layout>
    </div>
@endsection

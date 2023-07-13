@extends('admin.layout.admin_layout')

@section('main_content')
    <div class="az-dashboard-one-title">
        <div class="az-content-breadcrumb text-dark m-2">
            <span>Dashboard</span>
            <span>Role</span>
            <span>Create Role</span>
        </div>
    </div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Role
            </h2>
        </x-slot>

        <form enctype="multipart/form-data" action={{ route('roles.store') }} class="form-inputs my-3" method="POST">
            @csrf

            <div class="row row-sm p-4">
                <div class="col-lg-12 my-2">
                    <label class="az-content-label mb-3">Role Name</label>
                    <input name="name" class="invalid  w-100 " placeholder="Enter Role Name" value="{{ old('name') }}"
                        type="text">
                    @include('admin.common.error', ['field' => 'name']) {{-- error message --}}
                </div>

                <div class="col-lg-12 my-3 d-flex">
                    <Button class="btn btn-primary">Create</Button>
                </div>
            </div>
        </form>

    </x-app-layout>
    </div>
@endsection

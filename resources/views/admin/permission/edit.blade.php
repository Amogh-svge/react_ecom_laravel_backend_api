@extends('admin.layout.admin_layout')

@section('main_content')
    <div class="az-dashboard-one-title">
        <div class="az-content-breadcrumb text-dark m-2">
            <span>Dashboard</span>
            <span>Permissions</span>
            <span>Edit Permission</span>
        </div>
    </div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Permission
            </h2>
        </x-slot>

        <form action={{ route('permission.update', $permission->id) }} class="form-inputs my-3" method="POST">
            @csrf
            @method('PUT')

            <div class="row row-sm p-4">
                <div class="col-lg-12 my-2">
                    <label class="az-content-label mb-3">Permission Name</label>
                    <input name="name" class="invalid  w-100 " placeholder="Enter Permission Name"
                        value="{{ $permission->name }}" type="text">
                    @include('admin.common.error', ['field' => 'name']) {{-- error message --}}
                </div>

                <div class="col-lg-12 my-2">
                    <label class="az-content-label mb-3">Group Name</label>
                    <select name="group" class="form-control select2">
                        <option label="Choose one"></option>
                        @php
                            $groups = ['products', 'categories', 'roles', 'order', 'settings', 'subcategory', 'slider', 'siteInfo'];
                        @endphp
                        @foreach ($groups as $group)
                            <option value={{ $permission->group }} {{ $permission->group === $group ? 'selected' : null }}>
                                {{ $permission->group }}</option>
                        @endforeach
                    </select>
                    @include('admin.common.error', ['field' => 'group']) {{-- error message --}}
                </div>

                <div class="col-lg-12 my-3 d-flex">
                    <Button class="btn btn-primary">Update</Button>
                </div>
            </div>
        </form>

    </x-app-layout>
    </div>
@endsection

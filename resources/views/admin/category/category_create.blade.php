@extends('admin.layout.admin_layout')

@section('main_content')
    <div class="az-dashboard-one-title">
        <div class="az-content-breadcrumb text-dark m-2">
            <span>Dashboard</span>
            <span>Category</span>
            <span>Create Category</span>
        </div>
    </div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Category
            </h2>
        </x-slot>

        <form enctype="multipart/form-data" action={{ route('category.store') }} class="form-inputs my-3" method="POST">
            @csrf

            <div class="row row-sm p-4">
                <div class="col-lg-12 my-2">
                    <label class="az-content-label mb-3">Category Name</label>
                    <input name="category_name" class="invalid  w-100 " placeholder="Enter Category Name"
                        value="{{ old('category_name') }}" type="text">
                    @include('admin.common.error', ['field' => 'category_name']) {{-- error message --}}
                </div>

                <div class="col-lg mg-t-10 mg-lg-t-0 my-2">
                    <label class="az-content-labeal mb-3">Select Category Image</label>
                    <div class="custom-file">
                        <input name="category_image" onchange="getpath" type="file" class="custom-file-input"
                            id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    @include('admin.common.error', ['field' => 'category_image']) {{-- error message --}}
                </div>

                <div class="my-2">
                    <img style=" width:100px; height:100px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" id="showImage"
                        src="{{ url('img/no-image.png') }}" class="rounded-full">
                </div>
                <div class="col-lg-12 my-3 d-flex">
                    <Button class="btn btn-primary  ">Create</Button>
                </div>
            </div>
        </form>

    </x-app-layout>
    </div>
@endsection

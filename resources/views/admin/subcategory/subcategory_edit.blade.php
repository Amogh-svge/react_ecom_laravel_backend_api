@extends('admin.layout.admin_layout')

@section('main_content')
    <div>
        {{-- <h2 class="az-content-title"></h2> --}}
        <div class="az-dashboard-one-title">
            <div class="az-content-breadcrumb text-dark m-2">
                <span>Dashboard</span>
                <span>SubCategory</span>
                <span>Edit SubCategory</span>
            </div>
        </div>
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Edit SubCategory
                </h2>
            </x-slot>

            <form enctype="multipart/form-data" action="{{ route('subcategory.update', $subcategory->id) }}"
                class="form-inputs my-3" method="POST">
                @csrf
                @method('PUT')

                <div class="row row-sm p-4">
                    <div class="col-lg-12 my-2">
                        <label class="az-content-label mb-3">Sub_Category Name</label>
                        <input name="subcategory_name" class="invalid  w-100 " placeholder="Enter SubCategory Name"
                            value="{{ $subcategory->subcategory_name }}" type="text">
                        @error('subcategory_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div><!-- col -->

                    <div class="col-lg-12 my-2">
                        <label class="az-content-label mb-3" for="select-category">Select Category</label>
                        <select name="category_name" class="invalid w-100 form-select" aria-label="Default select example">
                            <option value="#">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_name }}"
                                    {{ $subcategory->category_name == $category->category_name ? 'selected' : '' }}>
                                    {{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div><!-- col -->


                    <div class="col-lg-12 my-3 d-flex">
                        <Button class="btn btn-primary">Update</Button>
                    </div>
                </div>
            </form>

        </x-app-layout>
    </div>
@endsection

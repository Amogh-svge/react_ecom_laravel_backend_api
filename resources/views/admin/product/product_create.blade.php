@extends('admin.layout.admin_layout')

@section('main_content')
    <div>
        <div class="az-dashboard-one-title">
            <div class="az-content-breadcrumb text-dark m-2">
                <span>Dashboard</span>
                <span>Product</span>
                <span>Create Product</span>
            </div>
        </div>
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Create Product
                </h2>
            </x-slot>

            <form action="#" class="form-inputs my-3" method="POST">
                @csrf
                <div class="row p-2">
                    <div class="col-lg-8 ">
                        <div class="shadow p-4 rounded">
                            <div class="mb-3">
                                <label for="inputProductTitle" class="az-content-label mb-3">Product Title</label>
                                <input type="text" class="w-100" id="inputProductTitle"
                                    placeholder="Enter product title">
                                @include('admin.common.error', ['field' => 'category_name']) {{-- error message --}}
                            </div>
                            <div class="mb-3">
                                <label for="editor" class="az-content-label mb-3">Product
                                    Description</label>
                                <textarea class="form-control" id="editor" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="ecitor" class="az-content-label mb-3">Product Images</label>
                                <div class="custom-file">
                                    <input name="category_image" onchange="getpath" type="file" class="custom-file-input"
                                        id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="shadow p-4 rounded">
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="inputPrice"class="az-content-label mb-3">Price</label>
                                    <input type="text" class="form-control" id="inputPrice" placeholder="00.00">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="inputCompareatprice"class="az-content-label mb-3">Compare Price</label>
                                    <input type="text" class="form-control" id="inputCompareatprice" placeholder="00.00">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="inputCostPerPrice"class="az-content-label mb-3">Cost Per Price</label>
                                    <input type="text" class="form-control" id="inputCostPerPrice" placeholder="00.00">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="inputStarPoints"class="az-content-label mb-3">Star Points</label>
                                    <input type="text" class="form-control" id="inputStarPoints" placeholder="00.00">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="inputProductType"class="az-content-label mb-3">Product Type</label>
                                    <select class="form-select w-100 border-0" id="inputProductType">
                                        <option value="#"> Select Product </option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="inputVendor"class="az-content-label mb-3">Vendor</label>
                                    <select class="form-select w-100 border-0" id="inputVendor">
                                        <option value="#"> Select Vendor </option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="inputCollection"class="az-content-label mb-3">Collection</label>
                                    <select class="form-select w-100 border-0" id="inputCollection">
                                        <option value="#"> Select Collection </option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="inputProductTags"class="az-content-label mb-3">Product Tags</label>
                                    <input type="text" class="form-control" id="inputProductTags"
                                        placeholder="Enter Product Tags">
                                </div>
                                <div class="col-12 mb-3">
                                    <button class="btn btn-purple">Save Product</button>
                                    <div class="d-grid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </x-app-layout>
    </div>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch((error) => {
                // console.error(error);
            });
    </script>
@endsection

@extends('admin.layout.admin_layout')

@section('main_content')
    <div>
        <div class="az-dashboard-one-title">
            <div class="az-content-breadcrumb text-dark m-2">
                <span>Dashboard</span>
                <span>Product</span>
                <span>Edit Product</span>
            </div>
        </div>
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Product
                </h2>
            </x-slot>

            {{-- @dd($product_info) --}}
            <form method="post" action="{{ route('product.update', $product_info['id']) }}" name="product_form"
                enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="row p-2">
                    <div class="col-lg-8 ">
                        <div class="border border-white shadow p-4 rounded">
                            <div class="mb-3">
                                <label for="inputProductTitle" class="az-content-label mb-3">Product Title</label>
                                <input type="text" name="title" class="w-100 border-0" id="inputProductTitle"
                                    placeholder="Enter Product Title" value=" {{ $product_info['title'] }}">
                                @include('admin.common.error', ['field' => 'title']) {{-- error message --}}
                            </div>


                            <div class="mb-3">
                                <label for="ecitor" class="az-content-label mb-3">Product Thumbnail</label>
                                <div class="custom-file">
                                    <input name="image" onchange="getpath" type="file" class="custom-file-input"
                                        id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose File</label>
                                </div>
                                @include('admin.common.error', ['field' => 'image'])
                            </div>

                            <div class="mb-3">
                                <img style=" object-fit:contain; width:100px; height:100px; box-shadow: rgba(0, 0, 0, 0.199) 0px 3px 8px;"
                                    id="showImage" src="{{ url('img/no-image.png') }}" class="rounded">
                            </div>

                            <div class="mb-3 ">
                                <label for="formFile" class="az-content-label mb-3">Sub-Images</label>
                                <div class="sub_image custom-file my-1" id="subImageId">
                                    <input name="sub_images[]" type="file" class="custom-file-input" id="customFile"
                                        multiple>
                                    <label class="custom-file-label" for="customFile">Choose File</label>
                                </div>
                                @include('admin.common.error', ['field' => 'sub_images'])
                            </div>

                            <div class="mb-3">
                                <label for="inputProductDescription" class="az-content-label mb-3">Short Description</label>
                                <textarea name="short_description" class="form-control" id="inputProductDescription" rows="2">{{ $product_info['short_description'] }}</textarea>
                                @include('admin.common.error', ['field' => 'short_description'])
                            </div>

                            <div class="mb-3">
                                <label for="editor" class="az-content-label mb-3">Product
                                    Description</label>
                                <textarea class="form-control" name="long_description" id="editor10" placeholder="Enter Product Description"
                                    rows="3">{{ $product_info['long_description'] }}</textarea>

                                @include('admin.common.error', ['field' => 'long_description'])

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="border border-white shadow p-4 rounded">
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="inputPrice" class="az-content-label mb-3">Price</label>
                                    <input type="text" name="price" class="form-control border-0" id="inputPrice"
                                        placeholder="00.00" value="{{ $product_info['price'] }}">
                                    @include('admin.common.error', ['field' => 'price'])
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="inputCompareatprice" class="az-content-label mb-3">Special Price</label>
                                    <input type="text" name="special_price" class="form-control border-0"
                                        id="inputCompareatprice" placeholder="00.00"
                                        value="{{ $product_info['special_price'] }}">
                                    @include('admin.common.error', ['field' => 'special_price'])
                                </div>


                                <div class="col-md-12 mb-3">

                                    <label for="inputPrice" class="az-content-label mb-3">Product Code</label>
                                    <input type="text" name="product_code" class="form-control border-0" id="inputPrice"
                                        placeholder="Enter Product Code" value="{{ $product_info['product_code'] }}">
                                    @include('admin.common.error', ['field' => 'product_code'])
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="inputProductType" class="az-content-label mb-3">Product Category</label>
                                    <select name="category" class="form-select w-100 border-0" id="inputProductType">

                                        <option>Select Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item }}"
                                                {{ $item == $product_info['category'] ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @include('admin.common.error', ['field' => 'category'])
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="inputProductType" class="az-content-label mb-3">Product
                                        SubCategory</label>
                                    <select name="sub_category" class="form-select w-100 border-0" id="inputProductType">

                                        <option selected="">Select SubCategory</option>
                                        @foreach ($subcategory as $item)
                                            <option value="{{ $item }}"
                                                {{ $product_info['sub_category'] == $item ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @include('admin.common.error', ['field' => 'sub_category'])
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="inputCollection" class="az-content-label mb-3">Brand </label>
                                    <select name="brand" class="form-select w-100 border-0" id="inputCollection"
                                        value="{{ old('brand') }}">
                                        <option selected="">Select Brand</option>
                                        <option value="Tony">Tony</option>
                                        <option value="Apple">Apple</option>
                                        <option value="OPPO">OPPO</option>
                                        <option value="Samsung">Samsung</option>
                                    </select>
                                    @include('admin.common.error', ['field' => 'brand'])
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="az-content-label mb-3">Product Size</label>
                                    <input type="text" name="size" class="form-control border-0 visually-hidden"
                                        data-role="tagsinput" placeholder="S,M,L,XL"
                                        value="{{ $product_info['size'] }}">
                                    @include('admin.common.error', ['field' => 'size'])
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="az-content-label mb-3">Product Color</label>
                                    <input type="text" name="color" class="form-control border-0 visually-hidden"
                                        data-role="tagsinput" placeholder="Red,White,Black"
                                        value="{{ $product_info['color'] }}">
                                    @include('admin.common.error', ['field' => 'color'])
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="form-check my-1">
                                        <input class="form-check-input" name="remark" type="radio" value="FEATURED"
                                            id="flexCheckDefault"
                                            {{ $product_info['remark'] == 'FEATURED' ? 'checked' : '' }}>
                                        <label class="form-check-label " for="flexCheckDefault">FEATURED</label>
                                    </div>

                                    <div class="form-check my-1">
                                        <input class="form-check-input" checked name="remark" type="radio"
                                            value="NEW" id="flexCheckDefault"
                                            {{ $product_info['remark'] == 'NEW' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">NEW</label>
                                    </div>

                                    <div class="form-check my-1">
                                        <input class="form-check-input" name="remark" type="radio" value="COLLECTION"
                                            id="flexCheckDefault"
                                            {{ $product_info['remark'] == 'COLLECTION' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">COLLECTION</label>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <button class="btn btn-purple" onclick="window.product_form.submit()">Update
                                        Product</button>
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
            .create(document.querySelector('#editor10'))
            .catch((error) => {
                // console.error(error);
            });
    </script>
@endsection

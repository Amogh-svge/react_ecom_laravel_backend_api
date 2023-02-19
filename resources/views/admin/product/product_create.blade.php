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

            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row p-2">
                    <div class="col-lg-8 ">
                        <div class="border border-white shadow p-4 rounded">
                            <div class="mb-3">
                                <label for="inputProductTitle" class="az-content-label mb-3">Product Title</label>
                                <input type="text" name="title" class="w-100 border-0" id="inputProductTitle"
                                    placeholder="Enter Product Title">
                                @include('admin.common.error', ['field' => 'category_name']) {{-- error message --}}
                            </div>


                            <div class="mb-3">
                                <label for="ecitor" class="az-content-label mb-3">Product Thumbnail</label>
                                <div class="custom-file">
                                    <input name="image" onchange="getpath" type="file" class="custom-file-input"
                                        id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose File</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <img style=" object-fit:contain; width:100px; height:100px; box-shadow: rgba(0, 0, 0, 0.199) 0px 3px 8px;"
                                    id="showImage" src="{{ url('img/no-image.png') }}" class="rounded">
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="az-content-label mb-3">Sub-Images</label>
                                <div class="custom-file">
                                    <input name="sub_images" type="file" class="custom-file-input" id="customFile"
                                        multiple>
                                    <label class="custom-file-label" for="customFile">Choose File</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="inputProductDescription" class="az-content-label mb-3">Short Description</label>
                                <textarea name="short_description" class="form-control" id="inputProductDescription" rows="2"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="editor" class="az-content-label mb-3">Product
                                    Description</label>
                                <textarea class="form-control" placeholder="Enter Product Description" id="editor" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="border border-white shadow p-4 rounded">
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="inputPrice" class="az-content-label mb-3">Product Code</label>
                                    <input type="text" name="product_code" class="form-control border-0" id="inputPrice"
                                        placeholder="Enter Product Code">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="inputCompareatprice" class="az-content-label mb-3">Special Price</label>
                                    <input type="text" name="special_price" class="form-control border-0"
                                        id="inputCompareatprice" placeholder="00.00">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="inputPrice" class="az-content-label mb-3">Price</label>
                                    <input type="text" name="price" class="form-control border-0" id="inputPrice"
                                        placeholder="00.00">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="inputCompareatprice" class="az-content-label mb-3">Special Price</label>
                                    <input type="text" name="special_price" class="form-control border-0"
                                        id="inputCompareatprice" placeholder="00.00">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="inputProductType" class="az-content-label mb-3">Product Category</label>
                                    <select name="category" class="form-select w-100 border-0" id="inputProductType">

                                        <option selected="">Select Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->category_name }}"> {{ $item->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="inputProductType" class="az-content-label mb-3">Product
                                        SubCategory</label>
                                    <select name="sub_category" class="form-select w-100 border-0" id="inputProductType">

                                        <option selected="">Select SubCategory</option>
                                        @foreach ($subcategory as $item)
                                            <option value="{{ $item->subcategory_name }}"> {{ $item->subcategory_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="inputCollection" class="az-content-label mb-3">Brand </label>
                                    <select name="brand" class="form-select w-100 border-0" id="inputCollection">
                                        <option selected="">Select Brand</option>
                                        <option value="Tony">Tony</option>
                                        <option value="Apple">Apple</option>
                                        <option value="OPPO">OPPO</option>
                                        <option value="Samsung">Samsung</option>
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="az-content-label mb-3">Product Size</label>
                                    <input type="text" name="size" class="form-control border-0 visually-hidden"
                                        data-role="tagsinput" value="S,M,L,XL">
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="az-content-label mb-3">Product Color</label>
                                    <input type="text" name="color" class="form-control border-0 visually-hidden"
                                        data-role="tagsinput" value="Red,White,Black">
                                </div>
                                <div class="col-12 mb-3">

                                    <div class="form-check my-1">
                                        <input class="form-check-input" name="remark" type="radio" value="FEATURED"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">FEATURED</label>
                                    </div>

                                    <div class="form-check my-1">
                                        <input class="form-check-input" name="remark" type="radio" value="NEW"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">NEW</label>
                                    </div>

                                    <div class="form-check my-1">
                                        <input class="form-check-input" name="remark" type="radio" value="COLLECTION"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">COLLECTION</label>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <button class="btn btn-purple">Save Product</button>
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

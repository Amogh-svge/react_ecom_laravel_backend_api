@extends('admin.layout.admin_layout')

@section('main_content')
    <div class="box-height">
        <h2 class="az-content-title">Product Details</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Product</span>
            <span>Product Details</span>
        </div>
        {{-- @dd($product_info); --}}
        <div class="row">
            <div class="col-lg-12 my-2">
                <h3 class="font-weight-normal"> {{ $product_info['title'] }}</h3>
            </div>
            <div class="col-lg-8">
                <div class="card mb-3">
                    <h5 class="card-header">Product Specification</h5>
                    <div class="card-body">
                        <div class="d-flex  m-4 ">
                            <span class="d-flex align-items-center  w-100">
                                {{-- <b class="text-success mr-1">price</b> --}}
                                <ion-icon size="large" name="pricetag"></ion-icon>
                                @if ($product_info['special_price'] != 'null')
                                    <h1 class="text-purple ml-2">Rs {{ $product_info['special_price'] }}</h1>
                                    <strike class="text-weight-light text-danger">Rs {{ $product_info['price'] }}</strike>
                                @else
                                    <h1 class="text-purple ml-2">Rs {{ $product_info['price'] }}</h1>
                                @endif
                            </span>
                        </div>

                        <div class="card-text">

                            <div class="d-flex justify-content-between">

                                <li class="list-group-item w-50 d-flex align-items-center border-0">
                                    <ion-icon class="mr-3" size="large " name="barcode"></ion-icon>
                                    <span>
                                        <p class="font-weight-bold m-0">Product Code</p>
                                        <p class="text-danger font-weight-bold m-0">{{ $product_info['product_code'] }}</p>
                                    </span>
                                </li>

                                <li class="list-group-item w-50 d-flex align-items-center border-0">
                                    <p class="font-weight-bold m-0 badge badge-dark p-1 mr-3">Brand</p>
                                    <span>
                                        <p class="font-weight-bold m-0">Brand</p>
                                        <p class=" m-0">
                                            {{ $product_info['product_code'] ? $product_info['product_code'] : '' }}</p>
                                    </span>
                                </li>
                            </div>
                            <div class="d-flex justify-content-between">
                                <li class="list-group-item w-50 d-flex  align-items-center border-0">
                                    <ion-icon class="mr-3" size="large" name="menu"></ion-icon>
                                    <span>
                                        <p class="font-weight-bold m-0">Category</p>
                                        <p class=" m-0">{{ $product_info['category'] }}</p>
                                    </span>
                                </li>

                                <li class="list-group-item w-50 d-flex align-items-center border-0">
                                    <ion-icon class="mr-3" size="large" name="grid"></ion-icon>
                                    <span>
                                        <p class="font-weight-bold m-0">Sub-Category</p>
                                        <p class=" m-0">{{ $product_info['sub_category'] }}</p>
                                    </span>
                                </li>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header">Product Description</h5>
                    <div class="card-body">
                        <div class="card-text">
                            <h5 class="card-title">Short Description</h5>
                            <p>{{ $product_info['short_description'] }}</p>
                        </div>

                        <div class="card-text">
                            <h5>Long Description</h5>
                            <p>{{ $product_info['long_description'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-2">
                    {{-- <h5 class="card-header">Product Specification</h5> --}}
                    {{-- {{ asset('storage/images/202302041724w.png') }} --}}
                    <img src="{{ $product_info['image'] }}" class="card-img-top" alt="product-thumbnails"
                        id="thumnail_subimage">

                    <div class="sub_images">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="{{ $product_info['image_one'] }}">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="{{ $product_info['image_two'] }}" alt="product-thumbnails">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="{{ $product_info['image_three'] }}" alt="product-thumbnails">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="{{ $product_info['image'] }}" alt="product-thumbnails">
                    </div>

                </div>
                <ul class="list-group">
                    <li class="list-group-item "><b>Product Name: </b> {{ $product_info['title'] }} </li>
                    <li class="list-group-item"><b>Color: </b> {{ $product_info['color'] }}</li>
                    <li class="list-group-item"><b>Size: </b> {{ $product_info['size'] }}</li>
                    <li class="list-group-item d-flex align-items-center"><b>Remark: </b> <span
                            class="badge badge-primary mx-2"> {{ $product_info['remark'] }}</span></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4"></div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let thumbnail_id = document.getElementById('thumnail_subimage');
        let sub_image = document.querySelectorAll('.product-subimage');
        const changeDisplayedImage = (event) => {
            thumbnail_id.src = event.src;
        }
    </script>
@endsection

@extends('admin.layout.admin_layout')

@section('main_content')
    <div class="box-height">
        <h2 class="az-content-title">Product Details</h2>
        <div class="az-content-breadcrumb">
            <span>Dashboard</span>
            <span>Product</span>
            <span>Product Details</span>
        </div>
        <div class="row">
            <div class="col-lg-12 my-2">
                <h3 class="font-weight-normal"> Lenovo Special H1</h3>
            </div>
            <div class="col-lg-8">
                <div class="card mb-3">
                    <h5 class="card-header">Product Specification</h5>
                    <div class="card-body">
                        <div class="d-flex  m-4 ">
                            <span class="d-flex  w-100">
                                <b class="text-success mr-1">price</b>
                                <h1 class="text-purple">Rs 389.38</h1>
                                <strike class="text-weight-light text-danger">Rs 389.38</strike>
                            </span>
                        </div>

                        <div class="card-text">

                            <div class="d-flex justify-content-between">

                                <li class="list-group-item w-50 d-flex align-items-center border-0">
                                    <ion-icon class="mr-3" size="large " name="barcode"></ion-icon>
                                    <span>
                                        <p class="font-weight-bold m-0">Product Code</p>
                                        <p class="text-danger font-weight-bold m-0">123534</p>
                                    </span>
                                </li>

                                <li class="list-group-item w-50 d-flex align-items-center border-0">
                                    <p class="font-weight-bold m-0 badge badge-dark p-1 mr-3">Brand</p>
                                    <span>
                                        <p class="font-weight-bold m-0">Brand</p>
                                        <p class=" m-0">123534</p>
                                    </span>
                                </li>
                            </div>
                            <div class="d-flex justify-content-between">
                                <li class="list-group-item w-50 d-flex  align-items-center border-0">
                                    <ion-icon class="mr-3" size="large" name="menu"></ion-icon>
                                    <span>
                                        <p class="font-weight-bold m-0">Category</p>
                                        <p class=" m-0">Laptop</p>
                                    </span>
                                </li>

                                <li class="list-group-item w-50 d-flex align-items-center border-0">
                                    <ion-icon class="mr-3" size="large" name="grid"></ion-icon>
                                    <span>
                                        <p class="font-weight-bold m-0">Sub-Category</p>
                                        <p class=" m-0">Samsung</p>
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
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio reiciendis quasi molestiae
                                dignissimos maxime porro debitis aspernatur quo </p>
                        </div>

                        <div class="card-text">
                            <h5>Long Description</h5>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio reiciendis quasi molestiae
                                dignissimos maxime porro debitis aspernatur quo qui iure fuga inventore, sit officia
                                quam
                                itaque! Eveniet dolor ipsam ad? Quia fugit a quaerat, error asperiores consectetur minus
                                eum
                                odio sequi beatae placeat ad sapiente facilis debitis? Nam, quidem pariatur!
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio reiciendis quasi molestiae
                                dignissimos maxime porro debitis aspernatur quo qui iure fuga inventore, sit officia
                                quam
                                itaque! Eveniet dolor ipsam ad? Quia fugit a quaerat, error asperiores consectetur minus
                                eum
                                odio sequi beatae placeat ad sapiente facilis debitis? Nam, quidem pariatur!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-2">
                    {{-- <h5 class="card-header">Product Specification</h5> --}}
                    {{-- {{ asset('storage/images/202302041724w.png') }} --}}
                    <img src="https://static-01.daraz.com.np/p/831955e0d31312230828856db9951011.jpg" class="card-img-top"
                        alt="product-thumbnails" id="thumnail_subimage">

                    <div class="sub_images">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="https://itti.com.np/pub/media/catalog/product/cache/d73a5018306142840707bd616a4ef293/d/e/dell-inspiron-3511-price-nepal-i5-1135g7-processor.jpg">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="https://static-01.daraz.com.np/p/ccb10b0bdecdd844f401f5bba4238869.jpg"
                            alt="product-thumbnails">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="https://static-01.daraz.com.np/p/bfd98b4642e619332b6c64a2a49b1a2c.jpg"
                            alt="product-thumbnails">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="https://static-01.daraz.com.np/p/831955e0d31312230828856db9951011.jpg"
                            alt="product-thumbnails">
                    </div>

                </div>
                <ul class="list-group">
                    <li class="list-group-item "><b>Product Name: </b>Lenovo Hp 12 </li>
                    <li class="list-group-item"><b>Color: </b> Yellow</li>
                    <li class="list-group-item"><b>Size: </b>XL,L</li>
                    <li class="list-group-item d-flex align-items-center"><b>Remark: </b> <span
                            class="badge badge-primary mx-2">NEW</span></li>
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

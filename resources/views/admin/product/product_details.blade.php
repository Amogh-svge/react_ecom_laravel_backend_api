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
            <div class="col-8">

                <div class="card mb-3">
                    <h5 class="card-header">Product Specification</h5>
                    <div class="card-body">
                        <h3 class="font-weight-light">Lenovo Special H1</h3>

                        <div class="card-text">
                            <li class="list-group-item"><b>Product Code:</b>
                                <span class="text-danger font-weight-bold">123534</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><b>Price: </b> <strike>Rs.12563</strike></span>
                                <span><b>Special Price: </b> Rs. 12340 </span>
                            </li>
                            <li class="list-group-item">Product Code: <b>123534</b></li>
                            <li class="list-group-item">Product Code: <b>123534</b></li>
                            <li class="list-group-item">Product Code: <b>123534</b></li>
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
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header">Product Specification</h5>
                    {{-- {{ asset('storage/images/202302041724w.png') }} --}}
                    <img src="https://static-01.daraz.com.np/p/efeace0d7507f3770af3d9fbdeff2427.jpg" class="card-img-top"
                        alt="...">

                    {{-- <div class="sub_images">
                        <img class="product-subimage"
                            src="https://static-01.daraz.com.np/p/efeace0d7507f3770af3d9fbdeff2427.jpg" alt="">

                        <img class="product-subimage"
                            src="https://static-01.daraz.com.np/p/efeace0d7507f3770af3d9fbdeff2427.jpg" alt="">

                        <img class="product-subimage"
                            src="https://static-01.daraz.com.np/p/efeace0d7507f3770af3d9fbdeff2427.jpg" alt="">

                        <img class="product-subimage"
                            src="https://static-01.daraz.com.np/p/efeace0d7507f3770af3d9fbdeff2427.jpg" alt="">

                    </div> --}}
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="product-subimage"
                                    src="https://static-01.daraz.com.np/p/efeace0d7507f3770af3d9fbdeff2427.jpg"
                                    alt="">
                            </div>
                            <div class="carousel-item">
                                <img class="product-subimage"
                                    src="https://itti.com.np/pub/media/catalog/product/cache/d73a5018306142840707bd616a4ef293/m/s/msi-gp66-leopard-10ue-price-nepal-i7-10870h-rtx-3060.jpg"
                                    alt="">
                            </div>
                            <div class="carousel-item">
                                <img class="product-subimage"
                                    src="https://static-01.daraz.com.np/p/efeace0d7507f3770af3d9fbdeff2427.jpg"
                                    alt="">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon text-danger" aria-hidden="true"></span>
                            <i class="fas fa-angle-left bg-dark "></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next bg-primary" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item "><b>Product Name:</b>Lenovo Hp 12 </li>
                        <li class="list-group-item"><b>Color: </b> Yellow</li>
                        <li class="list-group-item"><b>Size: </b>XL,L</li>
                        <li class="list-group-item"><b>Remark: </b>NEW</li>
                        <li class="list-group-item"><b>Brand:</b></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-4"></div>
        </div>
    </div>
@endsection

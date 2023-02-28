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
            <div class="col-lg-8">

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
            <div class="col-lg-4">
                <div class="card">
                    <h5 class="card-header">Product Specification</h5>
                    {{-- {{ asset('storage/images/202302041724w.png') }} --}}
                    <img src="http://localhost:8000/storage/images/202302041726headgears.jpg" class="card-img-top"
                        alt="product-thumbnails" id="thumnail_subimage">

                    <div class="sub_images">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="http://localhost:8000/storage/images/202302041726headgears.jpg" alt="product-thumbnails">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="http://localhost:8000/storage/images/202302041726whirlpool-200-genius-cls-wine-adora-5-nepal_1.jpg"
                            alt="product-thumbnails">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="http://localhost:8000/storage/images/2023020417266147e4a30f3888963cf088a57ecc4616.jpg"
                            alt="product-thumbnails">
                        <img class="product-subimage" onclick="changeDisplayedImage(this)"
                            src="http://localhost:8000/storage/images/202302041726whirlpool-200-genius-cls-wine-adora-5-nepal_1.jpg"
                            alt="product-thumbnails">
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

            <div class="col-lg-4"></div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let thumbnail_id = document.getElementById('thumnail_subimage');
        let sub_image = document.querySelectorAll('.product-subimage');
        const changeDisplayedImage = (event) => {
            console.log(event.src);
            thumbnail_id.src = event.src;
        }
    </script>
@endsection

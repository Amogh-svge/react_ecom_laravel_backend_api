<?php

use App\Http\Controllers\User\{AuthController, ForgetController, ResetController, UserController};
use App\Http\Controllers\Admin\{
    CategoryController,
    ContactController,
    FavouriteController,
    NotificationController,
    ProductCartController,
    ProductDetailsController,
    ProductListController,
    ProductReviewController,
    SiteInfoController,
    SliderController,
    VisitorController
};
use Illuminate\Support\Facades\Route;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

////// User Login Api ///////
Route::controller(AuthController::class)->group(function () {
    Route::post("/login", "login"); //manage login
    Route::post("/register", "register"); //manage register
});

//manage forget password
Route::post("/forgetpassword", [ForgetController::class, "forgetPassword"]);
//manage reset password
Route::post("/resetpassword", [ResetController::class, "resetPassword"]);
//manage reset data
Route::get("/resetInfo/{token}", [ResetController::class, "getResetInfo"]);
//manage user
Route::get("/user", [UserController::class, "user"])->middleware('auth:api');

////// End of User Login Api ///////



/*ProductList Controller */
Route::controller(ProductListController::class)->group(function () {
    Route::get("/productlistbyremark/{remark}",  "productListByRemark");    //manage productlist by remark
    Route::get("/productlistbycategory/{category}",  "productListByCategory");    //manage productlist by category
    Route::get("/productlistbysubcategory/{category}/{subcategory}",  "productListBySubCategory");    //manage productlist by sub-category
    Route::get("/search/{keyword}",  "searchProducts");    //manage search results
    Route::get("/related/{subcategory}/{id}",  "relatedProducts");    //related product route
});


/*ProductCart Controller */
Route::controller(ProductCartController::class)->group(function () {
    Route::get("/cartlist/{email}", "cartList"); //cart list route
    Route::get("/removecartlist/{id}", "removeCartList"); //Remove cart list route
    Route::get("/cartitemplus/{id}/{quantity}/{price}", "cartItemPlus"); //cart item increase route
    Route::get("/cartitemminus/{id}/{quantity}/{price}", "cartItemMinus");    //cart item decrease route
    Route::post("/cartsorder", "cartOrder");    //cart Order route
    Route::get("/orderlistbyuser/{email}", "orderListByUser");    //cart Order History route
    Route::post("/addtocart", "addToCart");    //product cart route
    Route::get("/cartcount/{email}",  "cartCount");    //cart count route

    //cart item decrease route
    // Route::get("/cartitemminus/{id}/{quantity}/{price}", "cartItemMinus");
});


/*Favourite Controller */
Route::controller(FavouriteController::class)->group(function () {
    Route::get("/favourite/{product_code}/{email}",  "addFavourite");    //favourite route
    Route::get("/favouritelist/{email}",  "favouriteList");    //favourite Items route
    Route::get("/favouriteremove/{product_code}/{email}",  "favouriteRemove");    //favourite Items remove route
});


/*ProductReview Controller */
Route::controller(ProductReviewController::class)->group(function () {
    Route::get("/reviewlist/{code}",  "reviewList");    //review product route
    Route::post("/postreview",  "postReview");    //post product review  route
});


Route::get("/getvisitor", [VisitorController::class, "getVisitorDetails"]); //get visitor
Route::post("/postcontact", [ContactController::class, "postContactDetails"]); //contact page
Route::get("/allsiteinfo", [SiteInfoController::class, "allSiteInfo"]); //siteInfo manage
Route::get("/allcategory", [CategoryController::class, "allCategory"]); //manage category


//manage home slider
Route::get("/allSlider", [SliderController::class, "allSlider"]);
//manage product details
Route::get("/productdetails/{id}", [ProductDetailsController::class, "productDetails"]);
//manage notification details
Route::get("/notification/{id?}", [NotificationController::class, "notificationDetail"]);

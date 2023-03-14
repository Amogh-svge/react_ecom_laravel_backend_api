<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FavouriteController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductCartController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ForgetController;
use App\Http\Controllers\User\ResetController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

////// User Login Api ///////

Route::controller(AuthController::class)->group(function () {
    Route::post("/login", "login"); //manage login
    Route::post("/register", "register"); //manage register
});

Route::controller(ResetController::class)->group(function () {
    Route::post("/resetpassword",  "resetPassword"); //manage reset password
    Route::get("/resetInfo/{token}",  "getResetInfo"); //manage reset data
});

//manage forget password
Route::post("/forgetpassword", [ForgetController::class, "forgetPassword"]);

Route::middleware(['auth:api'])->group(function () {
    Route::get("/user", [UserController::class, "user"]); //manage user

});
////// End of User Login Api ///////



Route::controller(ProductListController::class)->group(function () {
    Route::get("/productlistbyremark/{remark}", "productListByRemark");  //manage productlist by remark
    Route::get("/productlistbycategory/{category}", "productListByCategory");  //manage productlist by category
    Route::get("/productlistbysubcategory/{category}/{subcategory}", "productListBySubCategory");   //manage productlist by sub-category
    Route::get("/search/{keyword}", "searchProducts"); //manage search results
    Route::get("/related/{subcategory}/{id}", "relatedProducts"); //related product route
});


Route::controller(ProductReviewController::class)->group(function () {
    Route::get("/reviewlist/{code}", "reviewList"); //review product route
    Route::post("/postreview", "postReview"); //post product review  route
});

Route::controller(FavouriteController::class)->group(function () {
    Route::get("/favourite/{product_code}/{email}", "addFavourite"); //favourite route
    Route::get("/favouritelist/{email}", "favouriteList"); //favourite Items route
    Route::get("/favouriteremove/{product_code}/{email}", "favouriteRemove"); //favourite Items remove route
});


Route::controller(ProductCartController::class)->group(function () {
    Route::post("/addtocart", "addToCart");  //product cart route
    Route::get("/cartcount/{email}", "cartCount"); //cart count route
    Route::get("/cartlist/{email}", "cartList"); //cart list route
    Route::get("/removecartlist/{id}", "removeCartList"); //remove cart list route
    Route::get("/cartitemplus/{id}/{quantity}/{price}", "cartItemPlus"); //cart item increase route
    Route::get("/cartitemminus/{id}/{quantity}/{price}", "cartItemMinus"); //cart item decrease route
    Route::get("/orderlistbyuser/{email}", "orderListByUser");  //cart Order History route
    Route::post("/cartorder", "cartOrder")->middleware('auth:api');  //cart Order route
});


//get visitor
Route::get("/getvisitor", [VisitorController::class, "getVisitorDetails"]);
//contact page
Route::post("/postcontact", [ContactController::class, "postContactDetails"]);
//siteInfo manage
Route::get("/allsiteinfo", [SiteInfoController::class, "allSiteInfo"]);
//manage category
Route::get("/allcategory", [CategoryController::class, "allCategory"]);
//manage home slider
Route::get("/allSlider", [SliderController::class, "allSlider"]);
//manage product details
Route::get("/productdetails/{id}", [ProductDetailsController::class, "productDetails"]);
//manage notification details
Route::get("/notification/{id?}", [NotificationController::class, "notificationDetail"]);

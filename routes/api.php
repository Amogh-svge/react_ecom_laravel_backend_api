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

Route::post("/login", [AuthController::class, "login"]); //manage login
Route::post("/register", [AuthController::class, "register"]); //manage register
//manage forget password
Route::post("/forgetpassword", [ForgetController::class, "forgetPassword"]);
//manage reset password
Route::post("/resetpassword", [ResetController::class, "resetPassword"]);
//manage reset data
Route::get("/resetInfo/{token}", [ResetController::class, "getResetInfo"]);
//manage user
Route::get("/user", [UserController::class, "user"])->middleware('auth:api');

////// End of User Login Api ///////








Route::get("/getvisitor", [VisitorController::class, "getVisitorDetails"]); //get visitor
Route::post("/postcontact", [ContactController::class, "postContactDetails"]); //contact page
Route::get("/allsiteinfo", [SiteInfoController::class, "allSiteInfo"]); //siteInfo manage
Route::get("/allcategory", [CategoryController::class, "allCategory"]); //manage category
//manage productlist by remark
Route::get("/productlistbyremark/{remark}", [ProductListController::class, "productListByRemark"]);
//manage productlist by category
Route::get("/productlistbycategory/{category}", [ProductListController::class, "productListByCategory"]);
//manage productlist by sub-category
Route::get("/productlistbysubcategory/{category}/{subcategory}", [ProductListController::class, "productListBySubCategory"]);
//manage home slider
Route::get("/allSlider", [SliderController::class, "allSlider"]);
//manage product details
Route::get("/productdetails/{id}", [ProductDetailsController::class, "productDetails"]);
//manage notification details
Route::get("/notification/{id?}", [NotificationController::class, "notificationDetail"]);

//manage search results
Route::get("/search/{keyword}", [ProductListController::class, "searchProducts"]);
//related product route
Route::get("/related/{subcategory}/{id}", [ProductListController::class, "relatedProducts"]);
//review product route
Route::get("/reviewlist/{code}", [ProductReviewController::class, "reviewList"]);

//post product review  route
Route::post("/postreview", [ProductReviewController::class, "postReview"]);
//product cart route
Route::post("/addtocart", [ProductCartController::class, "addToCart"]);
//cart count route
Route::get("/cartcount/{email}", [ProductCartController::class, "cartCount"]);
//favourite route
Route::get("/favourite/{product_code}/{email}", [FavouriteController::class, "addFavourite"]);
//favourite Items route
Route::get("/favouritelist/{email}", [FavouriteController::class, "favouriteList"]);
//favourite Items remove route
Route::get("/favouriteremove/{product_code}/{email}", [FavouriteController::class, "favouriteRemove"]);
//cart list route
Route::get("/cartlist/{email}", [ProductCartController::class, "cartList"]);
//cart list route
Route::get("/removecartlist/{id}", [ProductCartController::class, "removeCartList"]);
//cart item increase route
Route::get("/cartitemplus/{id}/{quantity}/{price}", [ProductCartController::class, "cartItemPlus"]);
//cart item decrease route
Route::get("/cartitemminus/{id}/{quantity}/{price}", [ProductCartController::class, "cartItemMinus"]);

//cart Order route
Route::post("/cartsorder", [ProductCartController::class, "cartOrder"]);

//cart Order History route
Route::get("/orderlistbyuser/{email}", [ProductCartController::class, "orderListByUser"]);

//cart item decrease route
// Route::get("/cartitemminus/{id}/{quantity}/{price}", [ProductCartController::class, "cartItemMinus"]);

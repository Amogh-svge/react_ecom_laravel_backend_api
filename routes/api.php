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
    Route::get("/productlist",  "productList");    //manage productlist by sub-category
    Route::get("/search/{keyword}",  "searchProducts");    //manage search results
    Route::get("/related/{subcategory}/{id}",  "relatedProducts");    //related product route
});


/*ProductCart Controller */
Route::controller(ProductCartController::class)->group(function () {
    Route::get("/cart/{email}", "index"); //cart list route
    Route::delete("/cart/{id}", "delete"); //Remove cart list route
    Route::post("/cart/order", "order");    //cart Order route
    Route::post("/cart", "add");    //product cart route
    Route::get("/cart/count/{email}",  "count");    //cart count route
    Route::get("/order/{email}", "orderListByUser");    //cart Order History route
    Route::get("/cart/item/plus/{id}/{quantity}/{price}", "cartItemPlus"); //cart item increase route
    Route::get("/cart/item/minus/{id}/{quantity}/{price}", "cartItemMinus");    //cart item decrease route
});


/*Favourite Controller */
Route::controller(FavouriteController::class)->group(function () {
    Route::post("/favourite",  "create");    //favourite route
    Route::get("/favourite/{email}",  "index");    //favourite Items route
    Route::delete("/favourite/{favourite}",  "destroy");    //favourite Items remove route
});


/*ProductReview Controller */
Route::controller(ProductReviewController::class)->group(function () {
    Route::get("/review/{code}",  "index");    //review product route
    Route::post("/review",  "create");    //post product review  route
});

Route::controller(SiteInfoController::class)->group(function () {
    Route::get("/info", [SiteInfoController::class, "index"]); //siteInfo manage
});


Route::get("/getvisitor", [VisitorController::class, "getVisitorDetails"]); //get visitor
Route::post("/contact", [ContactController::class, "create"]); //contact page
Route::get("/category", [CategoryController::class, "index"]); //manage category


//manage home slider
Route::get("/allSlider", [SliderController::class, "allSlider"]);
//manage product details
Route::get("/productdetails/{id}", [ProductDetailsController::class, "index"]);
//manage notification details
Route::get("/notification/{id?}", [NotificationController::class, "notificationDetail"]);

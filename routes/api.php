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
    Route::get("/productlistbyremark/{remark}",  "productListByRemark");
    Route::get("/productlistbycategory/{category}",  "productListByCategory");
    Route::get("/productlistbysubcategory/{category}/{subcategory}",  "productListBySubCategory");
    Route::get("/productlist",  "productList");
    Route::get("/search/{keyword}",  "searchProducts");
    Route::get("/related/{subcategory}/{id}",  "relatedProducts");
});


/*ProductCart Controller */
Route::controller(ProductCartController::class)->prefix('cart')->group(function () {
    Route::get("/{email}", "index");
    Route::delete("/{cart}", "delete");
    //cart Order route
    Route::post("/order", "order");
    Route::post("/", "add");
    Route::get("/count/{email}",  "count");
    //cart item increase route
    Route::patch("/item/plus/{cart}", "cartItemPlus");
    //cart item decrease route
    Route::patch("/item/minus/{cart}", "cartItemMinus");
});

//cart Order History route
Route::get("/order/{email}", [ProductCartController::class, "orderListByUser"]);

/*Favourite Controller */
Route::controller(FavouriteController::class)->prefix('favourite')->group(function () {
    Route::post("/",  "create");
    Route::get("/{email}",  "index");
    Route::delete("/{favourite}",  "destroy");
});


/*ProductReview Controller */
Route::controller(ProductReviewController::class)->prefix('review')->group(function () {
    Route::get("/{code}",  "index");
    Route::post("/",  "create");
});

Route::controller(SiteInfoController::class)->group(function () {
    Route::get("/info", [SiteInfoController::class, "index"]);
});


Route::get("/getvisitor", [VisitorController::class, "getVisitorDetails"]);
//manage contact
Route::post("/contact", [ContactController::class, "create"]);
//manage category
Route::get("/category", [CategoryController::class, "index"]);


//manage home slider
Route::get("/slider", [SliderController::class, 'index']);
//manage product details
Route::get("/productdetails/{id}", [ProductDetailsController::class, "index"]);
//manage notification details
Route::get("/notification/{id?}", [NotificationController::class, "notificationDetail"]);

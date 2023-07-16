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
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

Route::post('/forgetpassword', [ForgetController::class, 'forgetPassword']);
Route::post('/resetpassword', [ResetController::class, 'resetPassword']);
Route::get('/resetInfo/{token}', [ResetController::class, 'getResetInfo']);
//manage user
Route::get('/user', [UserController::class, 'user'])->middleware('auth:api');

////// End of User Login Api ///////

/*ProductList Controller */
Route::controller(ProductListController::class)->group(function () {
    Route::get('/productlistbyremark/{remark}', 'productListByRemark');
    Route::get('/productlistbycategory/{category}', 'productListByCategory');
    Route::get('/productlistbysubcategory/{category}/{subcategory}', 'productListBySubCategory');
    Route::get('/productlist', 'productList');
    Route::get('/search/{keyword}', 'searchProducts');
    Route::get('/related/{subcategory}/{id}', 'relatedProducts');
});

/*ProductCart Controller */
Route::controller(ProductCartController::class)->prefix('cart')->group(function () {
    Route::get('/{email}', 'index');
    Route::get('/count/{email}', 'count');
    Route::post('/order', 'order');
    Route::post('/', 'add');
    Route::patch('/item/plus/{cart}', 'cartItemPlus');
    Route::patch('/item/minus/{cart}', 'cartItemMinus');
    Route::delete('/{cart}', 'delete');
});

//cart Order History route
Route::get('/order/{email}', [ProductCartController::class, 'orderListByUser']);

/*Favourite Controller */
Route::controller(FavouriteController::class)->prefix('favourite')->group(function () {
    Route::post('/', 'create');
    Route::get('/{email}', 'index');
    Route::delete('/{favourite}', 'destroy');
});

/*ProductReview Controller */
Route::controller(ProductReviewController::class)->prefix('review')->group(function () {
    Route::get('/{code}', 'index');
    Route::post('/', 'create');
});

Route::controller(SiteInfoController::class)->group(function () {
    Route::get('/info', [SiteInfoController::class, 'index']);
});


Route::get('/visitor', [VisitorController::class, 'getVisitorDetails']);
Route::post('/contact', [ContactController::class, 'create']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/slider', [SliderController::class, 'index']);
Route::get('/productdetails/{id}', [ProductDetailsController::class, 'index']);
Route::get('/notification/{id?}', [NotificationController::class, 'notificationDetail']);

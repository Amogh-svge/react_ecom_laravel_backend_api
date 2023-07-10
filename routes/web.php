<?php

use App\Http\Controllers\Admin\Backend\CategoryController;
use App\Http\Controllers\Admin\Backend\OrderController;
use App\Http\Controllers\Admin\Backend\ProductController;
use App\Http\Controllers\Admin\Backend\SliderController;
use App\Http\Controllers\Admin\Backend\SubCategoryController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.layout.index');
    })->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::get('/user/profile', [AdminController::class, 'userProfile'])->name('user.profile');
    });

    Route::controller(SiteInfoController::class)->prefix('siteinfo')->group(function () {
        Route::get('/', 'manageSiteInfo')->name('siteInfo.manage');
        Route::put('/update', 'updateSiteInfo')->name('siteInfo.update');
    });

    Route::controller(OrderController::class)->prefix('order')->group(function () {
        Route::get('/pending', 'pendingList')->name('pending.list');
        Route::get('/processing', 'processingList')->name('processing.list');
        Route::get('/purchased', 'purchasedList')->name('purchased.list');
        Route::get('/details/{details}', 'details')->name('order.details');
        Route::post('/order_processing/{process}', 'processing')->name('order.processing');
        Route::post('/order_purchasing/{purchase}', 'purchasing')->name('order.purchasing');
        Route::delete('/statement_delete/{delete}', 'statementDelete')->name('order_statement.delete');
    });

    Route::resource('category', CategoryController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('product', ProductController::class);
    Route::resource('subcategory', SubCategoryController::class);
});

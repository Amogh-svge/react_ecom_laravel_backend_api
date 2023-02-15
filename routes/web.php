<?php

use App\Http\Controllers\Admin\Backend\OrderController;
use App\Http\Controllers\Admin\Backend\SliderController as BackendSliderController;
use App\Http\Controllers\Admin\Backend\SubCategoryController;
use App\Http\Controllers\Admin\CategoryController;
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

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/list', 'getAllCategory')->name('category.list');
        Route::get('/category/create', 'createCategory')->name('category.create');
        Route::post('/category/store', 'storeCategory')->name('category.store');
        Route::get('/category/edit/{categ_id}', 'editCategory')->name('category.edit');
        Route::put('/category/update/{categ_id}', 'updateCategory')->name('category.update');
        Route::delete('/category/delete/{categ_id}',  'deleteCategory')->name('category.delete');
    });

    Route::controller(SiteInfoController::class)->group(function () {
        Route::get('/siteinfo', 'manageSiteInfo')->name('siteInfo.manage');
        Route::put('/siteinfo/update', 'updateSiteInfo')->name('siteInfo.update');
    });

    Route::controller(OrderController::class)->prefix('order')->group(function () {
        Route::get('/pending', 'pendingList')->name('pending.list');
        Route::get('/processing', 'processingList')->name('processing.list');
        Route::get('/purchased', 'purchasedList')->name('purchased.list');
        Route::get('/details/{id}', 'details')->name('order.details');
    });

    Route::resource('slider', BackendSliderController::class);

    Route::resource('subcategory', SubCategoryController::class);
});

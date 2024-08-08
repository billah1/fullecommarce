<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;


    Route::get('/sales-data', [DashboardController::class, "getMonthlySalesData"]);
Route::get('/unique-user-visits', [DashboardController::class, 'getUniqueUserVisits']);
Route::middleware(['auth', 'verified'])->prefix('admin/')->group(function () {
    Route::get('dashboard', [DashboardController::class, "dashboard"])->name('admin.dashboard');
    Route::get('settings/logo', [SettingsController::class, "logo"])->name('admin.setting.logo');

    Route::post('upload-logo', [SettingsController::class, 'uploadLogo'])->name('admin.uploadLogo');
    Route::post('settings/update-is-active/{logoId}', [SettingsController::class, 'updateIsActive']);

    Route::get('category', [CategoryController::class, 'showAllCategory'])->name('admin.showAllCategory');
    Route::post('category', [CategoryController::class, 'categoryStore'])->name('admin.categoryStore');
    Route::post('/toggle/{category}', [CategoryController::class, 'toggle'])->name('status.toggle');
    Route::put('/category/{category}', [CategoryController::class, 'edit'])->name('admin.categoryEdit');
    Route::delete('/category/delete/{category}', [CategoryController::class, 'delete'])->name('admin.categoryDelete');


    Route::middleware(['admin'])->group(function () {
        Route::get('product/add-new-product', [ProductController::class, 'addNewProduct'])->name('admin.addNewProduct');
        Route::post('product/save', [ProductController::class, 'productStore'])->name('admin.productStore');
        Route::put('product/update/{product}', [ProductController::class, 'productUpdate'])->name('admin.productUpdate');
        Route::get('product/list', [ProductController::class, 'showProductList'])->name('admin.productList');
        Route::post('/toggle-product/{product}', [ProductController::class, 'toggle'])->name('productStatus.toggle');
        Route::put('/product/{code}', [ProductController::class, 'edit'])->name('admin.productEdit');
        Route::delete('/product/delete/{product}', [ProductController::class, 'delete'])->name('admin.productDelete');
        Route::delete('/product/delete-image/{id}', [ProductController::class, 'deleteImage']);

        Route::post('/import-products', [ProductController::class, 'importProducts'])->name('import.products');
        Route::get('/export-products', [ProductController::class, 'exportProducts'])->name('export.products');

        Route::get('/orders', [OrderController::class, 'showAllOrder'])->name('admin.orderList');
        Route::get('/done-order/{order}', [OrderController::class, 'completeOrder'])->name('completeOrder');

        Route::get('/Coupons', [CouponController::class, 'showAllCoupons'])->name('admin.coupons');
        Route::post('/Coupons/store', [CouponController::class, 'couponStore'])->name('admin.couponStore');
        Route::post('/toggle/couponStatus/{coupon}', [CouponController::class, 'toggle'])->name('coupon.status.toggle');
        Route::put('/coupon/{coupon}', [CouponController::class, 'edit'])->name('admin.couponEdit');
        Route::delete('/coupon/delete/{coupon}', [CouponController::class, 'delete'])->name('admin.couponDelete');

        Route::get('/sliders', [SliderController::class, 'showAllSlider'])->name('admin.sliders');
        Route::post('slider/store', [SliderController::class, 'sliderStore'])->name('admin.sliderStore');
        Route::put('/slider/{slider}', [SliderController::class, 'edit'])->name('admin.sliderEdit');
        Route::post('/toggle/sliderStatus/{slider}', [SliderController::class, 'toggle'])->name('slider.status.toggle');
        Route::delete('/slider/delete/{slider}', [SliderController::class, 'delete'])->name('admin.sliderDelete');

        Route::get('/banners', [BannerController::class, 'showBanners'])->name('admin.banner');
        Route::post('banner/save', [BannerController::class, 'bannerSave'])->name('admin.bannerSave');
//        Route::put('/slider/{slider}', [SliderController::class, 'edit'])->name('admin.sliderEdit');
//        Route::post('/toggle/sliderStatus/{slider}', [SliderController::class, 'toggle'])->name('slider.status.toggle');
//        Route::delete('/slider/delete/{slider}', [SliderController::class, 'delete'])->name('admin.sliderDelete');


    });

});

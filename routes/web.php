<?php

use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryToProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserProductController;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('contact-us', [HomeController::class, 'contactUs'])->name('contactUs');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/auth', [UserAuthController::class, 'index'])->name('user.auth');
Route::post('/user-login', [UserAuthController::class, 'login'])->name('user.auth.login');
Route::post('/user-register', [UserAuthController::class, 'register'])->name('user.auth.register');

Route::middleware('custom.auth')->group(function () {

    Route::get('/checkout/{product?}', [CheckoutController::class, 'checkout'])->name('user.checkout');
    Route::post('/checkout/purchase', [PurchaseController::class, 'purchase'])->name('user.checkout.purchase');
    Route::get('/order/{order}/success',[PurchaseController::class, 'success'])->name('user.order.success');
    Route::post('/user-logout', [UserAuthController::class, 'logout'])->name('user.auth.logout');

    Route::get('/my-account', [MyAccountController::class, 'index'])->name('user.account');
    Route::get('/invoice/{order}', [InvoiceController::class, 'showInvoice'])->name('user.invoice');

    Route::post('/apply-coupon', [CouponController::class, 'applyCoupon']);
});

Route::get('product/{product}/details', [UserProductController::class, 'productDetails'])->name('product.details');
Route::get('category/{category}/products', [CategoryToProductController::class, 'showCategoryWiseProducts'])->name('category.products');
Route::get('category/all-products/', [CategoryToProductController::class, 'showAllProducts'])->name('allProducts');
Route::post('/add-to-cart', [CartController::class, 'addToCart']);
Route::post('/delete-cart', [CartController::class, 'deleteToCart']);


require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', [HomeUserController::class, 'index'])->name('home');
Route::get('/home/search', [HomeUserController::class, 'search'])->name('home.search');

Route::middleware(['auth'])->group(function () {
    //User View
    Route::get('/home/{id}', [HomeUserController::class, 'itemDetail'])->name('home.detail');

    Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile.index')->can('VIEW BUYER');
    Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit')->can('VIEW BUYER');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update')->can('VIEW BUYER');

    Route::get('/shopping-cart', [HomeUserController::class, 'showCart'])->name('shopping-cart')->can('VIEW BUYER');
    Route::get('/shopping-cart/done', [HomeUserController::class, 'showDone'])->name('shopping-cart.done')->can('VIEW BUYER');
    Route::post('/shopping-cart/store', [TransactionController::class, 'storeCart'])->name('shopping-cart.store')->can('VIEW BUYER');
    Route::put('/shopping-cart/batal/{id}', [TransactionController::class, 'batal'])->name('shopping-cart.batal')->can('VIEW BUYER');

    Route::get('/history', [PaymentController::class, 'history'])->name('history')->can('VIEW BUYER');
    Route::get('/history/done', [PaymentController::class, 'historyDone'])->name('history.done')->can('VIEW BUYER');
    Route::get('/checkout/{id}', [PaymentController::class, 'createPayment'])->name('payment.create')->can('VIEW BUYER');
    Route::get('/direct-checkout/{id}', [PaymentController::class, 'directPayment'])->name('payment.direct')->can('VIEW BUYER');
    Route::post('/checkout/pay/{id}', [PaymentController::class, 'storePayment'])->name('payment.store')->can('VIEW BUYER');
    Route::post('/direct-checkout/pay/{id}', [PaymentController::class, 'storeDirect'])->name('payment.storeDirect')->can('VIEW BUYER');

    Route::get('/merchant', [MerchantController::class, 'dashboard'])->name('merchant.dashboard')->can('VIEW MERCHANT');
    Route::get('/merchant/create', [MerchantController::class, 'create'])->name('merchant.items.create')->can('VIEW MERCHANT');
    Route::post('/merchant/store', [MerchantController::class, 'store'])->name('merchant.items.store')->can('VIEW MERCHANT');
    Route::get('/merchant/edit/{id}', [MerchantController::class, 'edit'])->name('merchant.items.edit')->can('VIEW MERCHANT');
    Route::post('/merchant/update/{id}', [MerchantController::class, 'update'])->name('merchant.items.update')->can('VIEW MERCHANT');
    Route::get('/merchant/transactions', [MerchantController::class, 'index'])->name('home.merchant')->can('VIEW MERCHANT');
    Route::get('/merchant/history', [MerchantController::class, 'history'])->name('merchant.history')->can('VIEW MERCHANT');
    Route::put('/merchant/approve/{id}', [TransactionController::class, 'approve'])->name('merchant.approve')->can('VIEW MERCHANT');

    //Admin view
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home')->can('VIEW ADMIN');

    Route::get('/admin/user/index', [UserController::class, 'index'])->name('user.index')->can('VIEW USER');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('user.create')->can('CREATE USER');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('user.store')->can('CREATE USER');
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->can('EDIT USER');
    Route::put('/admin/user/update/{id}', [UserController::class, 'update'])->name('user.update')->can('EDIT USER');

    Route::get('/admin/items/index', [ItemController::class, 'index'])->name('items.index')->can('VIEW ITEMS');
    Route::get('/admin/items/create', [ItemController::class, 'create'])->name('items.create')->can('CREATE ITEMS');
    Route::post('/admin/items/store', [ItemController::class, 'store'])->name('items.store')->can('CREATE ITEMS');
    Route::get('/admin/items/edit/{id}', [ItemController::class, 'edit'])->name('items.edit')->can('EDIT ITEMS');
    Route::put('/admin/items/update/{id}', [ItemController::class, 'update'])->name('items.update')->can('EDIT ITEMS');

    Route::get('/admin/category/index', [CategoryController::class, 'index'])->name('category.index')->can('VIEW CATEGORY');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('category.store')->can('CREATE CATEGORY');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->can('EDIT CATEGORY');
    Route::put('/admin/category/update/{id}', [CategoryController::class, 'update'])->name('category.update')->can('EDIT CATEGORY');

    Route::get('/admin/transaction/index', [TransactionController::class, 'index'])->name('transaction.index')->can('VIEW TRANSACTION');

    Route::get('/admin/payment/index', [PaymentController::class, 'index'])->name('payment.index')->can('VIEW PAYMENT');
});

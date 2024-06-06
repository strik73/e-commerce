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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();
//User View
Route::get('/home', [HomeUserController::class, 'index'])->name('home');
Route::get('/home/search', [HomeUserController::class, 'search'])->name('home.search');
Route::get('/home/{id}', [HomeUserController::class, 'itemDetail'])->name('home.detail');

Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile.index');
Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/shopping-cart', [HomeUserController::class, 'showCart'])->name('shopping-cart');
Route::post('/shopping-cart/store', [TransactionController::class, 'storeCart'])->name('shopping-cart.store');
Route::put('/shopping-cart/batal/{id}', [TransactionController::class, 'batal'])->name('shopping-cart.batal');

Route::get('/history', [PaymentController::class, 'history'])->name('history');
Route::get('/checkout/{id}', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::post('/checkout/pay/{id}', [PaymentController::class, 'storePayment'])->name('payment.store');

Route::get('/merchant', [MerchantController::class, 'dashboard'])->name('merchant.dashboard');
Route::get('/merchant/create', [MerchantController::class, 'create'])->name('merchant.items.create');
Route::post('/merchant/store', [MerchantController::class, 'store'])->name('merchant.items.store');
Route::get('/merchant/edit/{id}', [MerchantController::class, 'edit'])->name('merchant.items.edit');
Route::post('/merchant/update/{id}', [MerchantController::class, 'update'])->name('merchant.items.update');
Route::get('/merchant/transactions', [MerchantController::class, 'index'])->name('home.merchant');
Route::get('/merchant/history', [MerchantController::class, 'history'])->name('merchant.history');
Route::put('/merchant/approve/{id}', [TransactionController::class, 'approve'])->name('merchant.approve');

//Admin view
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');

Route::get('/admin/user/index', [UserController::class, 'index'])->name('user.index');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/admin/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/admin/user/update/{id}', [UserController::class, 'update'])->name('user.update');

Route::get('/admin/items/index', [ItemController::class, 'index'])->name('items.index');
Route::get('/admin/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/admin/items/store', [ItemController::class, 'store'])->name('items.store');
Route::get('/admin/items/edit/{id}', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/admin/items/update/{id}', [ItemController::class, 'update'])->name('items.update');

Route::get('/admin/category/index', [CategoryController::class, 'index'])->name('category.index');
Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/admin/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');

Route::get('/admin/transaction/index', [TransactionController::class, 'index'])->name('transaction.index');

Route::get('/admin/payment/index', [PaymentController::class, 'index'])->name('payment.index');

<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
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
    return view('welcome');
});

Auth::routes();

Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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


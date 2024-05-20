<?php

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

Route::get('/admin/items/index', [App\Http\Controllers\ItemController::class, 'index'])->name('items.index');

Route::get('/admin/category/index', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
Route::post('/admin/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');



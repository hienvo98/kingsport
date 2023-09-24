<?php

use App\Http\Controllers\Admin\AdminController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryControlelr;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register', function () {
        return view('auth.404');  
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('list-category');
    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('create-category');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('store-category');
    Route::get('/admin/category/edit/{categoryId}', [CategoryController::class, 'edit']);
    Route::post('/admin/category/update/{categoryId}', [CategoryController::class, 'update'])->name('update-category');
    Route::post('/admin/sub-category/create', [SubCategoryControlelr::class, 'store'])->name('create-sub-category');
    Route::get('/admin/category/delete/{categoryId}',[CategoryController::class,'destroy']);
    Route::get('/admin/category/search',[CategoryController::class,'search']);
    Route::get('/admin/product', [ProductController::class, 'index'])->name('list-product');
    Route::resource('admin', AdminController::class);
});


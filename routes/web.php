<?php

use App\Http\Controllers\Admin\AdminController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryControlelr;
use App\Http\Controllers\HomeController;

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

Route::group(['middleware' => 'auth','prefix'=>'admin','as'=>'admin.'], function () {
    Route::post('/logout',[AdminController::class,'logout'])->name('logout');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{categoryId}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{categoryId}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/sub-category/create', [SubCategoryControlelr::class, 'store'])->name('subCategory.create');
    Route::get('/category/delete/{categoryId}',[CategoryController::class,'destroy'])->name('category.destroy');
    Route::get('/category/search',[CategoryController::class,'search']);
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::resource('/', AdminController::class);
});



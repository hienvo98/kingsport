<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController;
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


Route::view('/', 'auth.login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/register', function () {
        return view('auth.404');  
});

Route::group(['middleware' => ['auth','isAdmin'],'prefix'=>'admin','as'=>'admin.'], function () {
    Route::post('/logout',[AdminController::class,'logout'])->name('logout');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    
    Route::prefix('category')->group(function () {       
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{categoryId}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{categoryId}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/sub-category/create', [SubCategoryControlelr::class, 'store'])->name('subCategory.create');
        Route::get('/delete/{categoryId}',[CategoryController::class,'destroy'])->name('category.destroy');
        Route::get('/search',[CategoryController::class,'search']);
        Route::get('/get-subcategories/{categoryId}', [CategoryController::class, 'getSubCategory']);
    });

    Route::prefix('product')->group(function () {
        Route::get('/index', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store',[ProductController::class,'store'])->name('product.store');
        // Route::get('/edit',[ProductController::class,'edit'])->name('product.edit');
        // Route::post('/update',[ProductController::class,'update'])->name('product.update');
        // Route::get('/delete/{productId}',[ProductController::class,'destroy'])->name('product.destroy');
    });

    Route::prefix('/role')->group(function(){
        Route::get('/show',[RoleController::class,'show'])->name('role.show');
        Route::get('/index',[RoleController::class,'index'])->name('role.index');
        Route::get('/create',[RoleController::class,'create'])->name('role.create');
        Route::post('/store',[RoleController::class,'store'])->name('role.store');
        Route::get('/edit/{id}',[RoleController::class,'edit'])->name('role.edit');
        Route::post('/update',[RoleController::class,'update'])->name('role.update');
        Route::get('/delete/{id}',[RoleController::class,'destroy'])->name('role.destroy');
    });

    Route::prefix('/post')->group(function(){
        Route::get('/index',[ArticleController::class,'index'])->name('post.index');
        Route::get('/create',[ArticleController::class,'create'])->name('post.create');
        Route::post('/store',[ArticleController::class,'store'])->name('post.store');
        Route::get('/edit/{id}',[ArticleController::class,'edit'])->name('post.edit');
        Route::post('/update',[ArticleController::class,'update'])->name('post.update');
        Route::get('/delete/{id}',[ArticleController::class,'destroy'])->name('post.destroy');

    });

    Route::post('/authorizeUser',[AdminController::class,'authorizeUser']);
    Route::get('/authorize/edit/{id}',[AdminController::class,'editRole']);
    Route::post('/authorize/update',[AdminController::class,'updateRole']);
    Route::get('/',[AdminController::class,'index']);
    Route::get('/create',[AdminController::class,'create']);
    Route::get('/show',[AdminController::class,'show']);
    Route::get('/delete/{id}',[AdminController::class,'destroy']);
    Route::get('/restore/{id}',[AdminController::class,'restore']);
    Route::get('/roleUser/search/{id}',[AdminController::class,'search']);
    Route::post('/store',[AdminController::class,'store']);
});


//dùng để reset lại tất cả các quyền và cấp super Admin
Route::get('/reset',[HomeController::class,'reset']);


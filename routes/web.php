<?php

use App\Models\Article;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ShowroomController;
use App\Http\Controllers\Admin\SubCategoryControlelr;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TopSearchController;
use App\Http\Controllers\MigrateController;

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

/// ---------------------------------------------------------------- - example routes

Route::get('/cloud',[HomeController::class,'testCloud']);

/// ----------------------------------------------------------------
Route::post('/migrate',[MigrateController::class,'migrateNewSource']);
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
        Route::get('/sub-category/getRank/{categoryId}',[SubCategoryControlelr::class,'getRank']);
        Route::get('/delete/{categoryId}',[CategoryController::class,'destroy'])->name('category.destroy');
        Route::get('/search',[CategoryController::class,'search']);
        Route::get('/get-subcategories/{categoryId}', [CategoryController::class, 'getSubCategory']);
    });

    Route::prefix('product')->group(function () {
        Route::get('/index/{id?}', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store',[ProductController::class,'store'])->name('product.store');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
        Route::post('/update/{id}',[ProductController::class,'update'])->name('product.update');
        Route::get('/delete/{productId}',[ProductController::class,'destroy'])->name('product.destroy');
        Route::get('/filterProductsAjax/{flag?}',[ProductController::class,'filterProductsAjax']);
        Route::get('/search',[ProductController::class,'search']);
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
        Route::get('/index/{id?}',[ArticleController::class,'index'])->name('post.index');
        Route::get('/create',[ArticleController::class,'create'])->name('post.create');
        Route::post('/store',[ArticleController::class,'store'])->name('post.store');
        Route::get('/edit/{id}',[ArticleController::class,'edit'])->name('post.edit');
        Route::post('/update/{id}',[ArticleController::class,'update'])->name('post.update');
        Route::get('/delete/{id}',[ArticleController::class,'destroy'])->name('post.destroy');
        Route::get('/search',[ArticleController::class,'search']);
        Route::get('/filterArticlesAjax/{flag?}',[ArticleController::class,'filterArticlesAjax']);
    });

    Route::prefix('/tag')->group(function(){
        Route::get('/index/{id?}',[TagController::class,'index'])->name('tag.index');
        Route::get('/create',[TagController::class,'create'])->name('tag.create');
        Route::post('/store',[TagController::class,'store'])->name('tag.store');
        Route::get('/edit/{id}',[TagController::class,'edit'])->name('tag.edit');
        Route::post('/update/{id}',[TagController::class,'update'])->name('tag.update');
        Route::get('/delete/{id}',[TagController::class,'destroy'])->name('tag.destroy');
        Route::get('/search',[TagController::class,'search']);
    });

    Route::prefix('/topsearch')->group(function(){
        Route::get('/index/{id?}',[TopSearchController::class,'index'])->name('topsearch.index');
        Route::get('/create',[TopSearchController::class,'create'])->name('topsearch.create');
        Route::post('/store',[TopSearchController::class,'store'])->name('topsearch.store');
        Route::get('/edit/{id}',[TopSearchController::class,'edit'])->name('topsearch.edit');
        Route::post('/update/{id}',[TopSearchController::class,'update'])->name('topsearch.update');
        Route::get('/delete/{id}',[TopSearchController::class,'destroy'])->name('topsearch.destroy');
        Route::get('/search',[TopSearchController::class,'search']);
    });

    Route::prefix('/showroom')->group(function(){
        Route::get('/index/{id?}',[ShowroomController::class,'index'])->name('showroom.index');
        Route::get('/create',[ShowroomController::class,'create'])->name('showroom.create');
        Route::post('/store',[ShowroomController::class,'store'])->name('showroom.store');
        Route::get('/edit/{id}',[ShowroomController::class,'edit'])->name('showroom.edit');
        Route::post('/update/{id}',[ShowroomController::class,'update'])->name('showroom.update');
        Route::get('/delete/{id}',[ShowroomController::class,'destroy'])->name('showroom.destroy');
        Route::get('/search',[ShowroomController::class,'search']);
        Route::get('/filterShowroomAjax/{flag?}',[ShowroomController::class,'filterShowroomAjax']);
    });

    Route::prefix('/faq')->group(function(){
        Route::get('/index',[FAQController::class,'index'])->name('faq.index');
        Route::get('/create',[FAQController::class,'create'])->name('faq.create');
        Route::post('/store',[FAQController::class,'store'])->name('faq.store');
        Route::get('/edit/{id}',[FAQController::class,'edit'])->name('faq.edit');
        Route::post('/update/{id}',[FAQController::class,'update'])->name('faq.update');
        Route::get('/delete/{id}',[FAQController::class,'destroy'])->name('faq.destroy');
    });

    Route::prefix('/event')->group(function(){
        Route::get('/index',[EventController::class,'index'])->name('event.index');
        Route::get('/create',[EventController::class,'create'])->name('event.create');
        Route::post('/store',[EventController::class,'store'])->name('event.store');
        Route::get('/edit/{id}',[EventController::class,'edit'])->name('event.edit');
        Route::post('/update/{id}',[EventController::class,'update'])->name('event.update');
        Route::get('/delete/{id}',[EventController::class,'destroy'])->name('event.destroy');
        Route::get('/search',[EventController::class,'search']);
    });

    Route::prefix('/banner')->group(function(){
        Route::get('/index',[BannerController::class,'index'])->name('banner.index');
        Route::get('/create',[BannerController::class,'create'])->name('banner.create');
        Route::post('/store',[BannerController::class,'store'])->name('banner.store');
        Route::get('/edit/{id}',[BannerController::class,'edit'])->name('banner.edit');
        Route::post('/update/{id}',[BannerController::class,'update'])->name('banner.update');
        Route::get('/delete/{id}',[BannerController::class,'destroy'])->name('banner.destroy');
        Route::get('/search',[BannerController::class,'search']);
    });

    Route::prefix('/voucher')->group(function(){
        Route::get('/index',[VoucherController::class,'index'])->name('voucher.index');
        Route::get('/create',[VoucherController::class,'create'])->name('voucher.create');
        Route::post('/store',[VoucherController::class,'store'])->name('voucher.store');
        Route::get('/edit/{id}',[VoucherController::class,'edit'])->name('voucher.edit');
        Route::post('/update/{id}',[VoucherController::class,'update'])->name('voucher.update');
        Route::get('/delete/{id}',[VoucherController::class,'destroy'])->name('voucher.destroy');
        Route::get('/search',[VoucherController::class,'search']);
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
Route::get('/test2',[HomeController::class,'test2']);



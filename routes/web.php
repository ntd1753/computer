<?php

//use App\Http\Controllers\Admin\AccessoryController;
use App\Http\Controllers\Admin\AccessoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PostController;
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
Route::fallback(function () {
    return redirect()->route('index');
});
Route::get('/login', [LoginController::class,'show'])->name('auth.login');
Route::post('/login', [LoginController::class,'login'])->name('login');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('index');

    Route::group(['prefix' => 'brand'], function () {
        Route::get('/',[BrandController::class,'index'])->name("brand.index"); // danh sách
        Route::get('/add', [BrandController::class,'add'])->name('brand.add'); // Trả về form thêm mới
        Route::post('/add', [BrandController::class,'store'])->name('brand.store'); // tạo mới
        Route::get('/edit/{id}', [BrandController::class,'edit'])->name('brand.edit'); // Trả về form edit
        Route::post('/edit/{id}', [BrandController::class,'update'])->name('brand.update'); // Update
        Route::get('/delete/{id}', [BrandController::class,'destroy'])->name('brand.destroy'); // delete
    });
    Route::group(['prefix'=>'category'],function() {
        Route::get('/', [CategoryController::class,'index'])->name('category.index');
        Route::get('/add', [CategoryController::class,'add'])->name('category.add');
        Route::post('/add', [CategoryController::class,'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
        Route::post('/edit/{id}', [CategoryController::class,'update'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class,'destroy'])->name('category.destroy');
    });
    Route::group(['prefix'=>'product'],function() {
        Route::group(['prefix'=>'accessory/{accessory_type}'],function() {
            Route::get('/',[AccessoryController::class,'index'])->name("accessory.index"); // danh sách
            Route::get('/add', [AccessoryController::class,'add'])->name('accessory.add'); // Trả về form thêm mới
            Route::post('/add', [AccessoryController::class,'store'])->name('accessory.store'); // tạo mới
            Route::get('/edit/{id}', [AccessoryController::class,'edit'])->name('accessory.edit'); // Trả về form edit
            Route::post('/edit/{id}', [AccessoryController::class,'update'])->name('accessory.update'); // Update
            Route::get('/delete/{id}', [AccessoryController::class,'destroy'])->name('accessory.destroy'); // delete
        });
        Route::group(['prefix'=>'pc'],function() {
        });
    });

    Route::group(['prefix'=>'post'],function() {
        Route::get('/', [PostController::class,'index'])->name('post.index');
        Route::get('/add', [PostController::class,'add'])->name('post.add');
        Route::post('/add', [PostController::class,'store'])->name('post.store');
        Route::get('/edit/{id}', [PostController::class,'edit'])->name('post.edit');
        Route::post('/edit/{id}', [PostController::class,'update'])->name('post.update');
        Route::get('/delete/{id}', [PostController::class,'destroy'])->name('post.destroy');
    });
    Route::group(['prefix'=>'user'],function() {
        Route::get('/', [CategoryController::class,'index'])->name('user.index');
        Route::get('/add', [CategoryController::class,'add'])->name('user.add');
        Route::post('/add', [CategoryController::class,'store'])->name('user.store');
        Route::get('/edit/{id}', [CategoryController::class,'edit'])->name('user.edit');
        Route::post('/edit/{id}', [CategoryController::class,'update'])->name('user.update');
        Route::get('/delete/{id}', [CategoryController::class,'destroy'])->name('user.destroy');
    });
});

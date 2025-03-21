<?php

//use App\Http\Controllers\Admin\AccessoryController;
use App\Http\Controllers\Admin\AccessoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\UserController;

use App\Models\CustomPermission;
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

    Route::prefix('brand')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('BrandManagement')])->group(function() {
        Route::get('/',[BrandController::class,'index'])->name("brand.index"); // danh sách
        Route::get('/add', [BrandController::class,'add'])->name('brand.add'); // Trả về form thêm mới
        Route::post('/add', [BrandController::class,'store'])->name('brand.store'); // tạo mới
        Route::get('/edit/{id}', [BrandController::class,'edit'])->name('brand.edit'); // Trả về form edit
        Route::post('/edit/{id}', [BrandController::class,'update'])->name('brand.update'); // Update
        Route::get('/delete/{id}', [BrandController::class,'destroy'])->name('brand.destroy'); // delete
    });
    Route::prefix('category')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('CategoryManagement')])->group(function(){
        Route::get('/', [CategoryController::class,'index'])->name('category.index');
        Route::get('/add', [CategoryController::class,'add'])->name('category.add');
        Route::post('/add', [CategoryController::class,'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
        Route::post('/edit/{id}', [CategoryController::class,'update'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class,'destroy'])->name('category.destroy');
    });
    Route::prefix('product')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('ProductManagement')])->group(function() {
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

    Route::prefix('post')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('PostManagement')])->group(function() {
        Route::get('/', [PostController::class,'index'])->name('post.index');
        Route::get('/add', [PostController::class,'add'])->name('post.add');
        Route::post('/add', [PostController::class,'store'])->name('post.store');
        Route::get('/edit/{id}', [PostController::class,'edit'])->name('post.edit');
        Route::post('/edit/{id}', [PostController::class,'update'])->name('post.update');
        Route::get('/delete/{id}', [PostController::class,'destroy'])->name('post.destroy');
    });
    Route::prefix('user')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('UserManagement')])->group(function() {
        Route::get('/', [UserController::class,'index'])->name('user.index');
        Route::get('/add', [UserController::class,'add'])->name('user.add');
        Route::post('/add', [UserController::class,'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class,'edit'])->name('user.edit');
        Route::post('/edit/{id}', [UserController::class,'update'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class,'destroy'])->name('user.destroy');
    });
    Route::prefix('role')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('UserRoleAndPermissionList')])->group(function () {
        Route::group(['middleware' => [
            'checkPermissionByFunction:'.CustomPermission::getPermissionByKey('UserRoleAndPermissionList')
        ]], function () {
            Route::get('/index', [RolePermissionController::class, 'index'])->name('role.index');
            Route::get('/search', [RolePermissionController::class, 'search'])->name('role.search');
            Route::post('/create', [RolePermissionController::class, 'store'])->name('role.store')->middleware('checkPermissionByFunction:'.CustomPermission::getPermissionByKey('AddARole'));
            Route::post('/update', [RolePermissionController::class, 'update'])->name('role.update')->middleware('checkPermissionByFunction:'.CustomPermission::getPermissionByKey('EditARole'));
            Route::get('/permissions', [RolePermissionController::class, 'getListPermission'])->name('role.permissions')->middleware('checkPermissionByFunction:'.CustomPermission::getPermissionByKey('AssignRole'));
            Route::post('/assign-permission', [RolePermissionController::class, 'assignPermission'])->name('role.assign_permissions')->middleware('checkPermissionByFunction:'.CustomPermission::getPermissionByKey('AssignRole'));
        });
    });
    Route::prefix('banner')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('BannerManagement')])
        ->group(function (){
        Route::get('/',[BannerController::class,'index'])->name("banner.index");
        Route::get('/add', [BannerController::class,'add'])->name('banner.add')
            ->middleware('checkPermissionByFunction:'.CustomPermission::getPermissionByKey('AddABanner'));
        Route::post('/add', [BannerController::class,'store'])->name('banner.store')
        ->middleware('checkPermissionByFunction:'.CustomPermission::getPermissionByKey('AddABanner'));
        Route::get('/edit/{id}', [BannerController::class,'edit'])->name('banner.edit')
            ->middleware('checkPermissionByFunction:'.CustomPermission::getPermissionByKey('EditABanner'));
        Route::post('/edit/{id}', [BannerController::class,'update'])->name('banner.update')
            ->middleware('checkPermissionByFunction:'.CustomPermission::getPermissionByKey('EditABanner'));
        Route::get('/delete/{id}', [BannerController::class,'destroy'])->name('banner.destroy')
            ->middleware('checkPermissionByFunction:'.CustomPermission::getPermissionByKey('DeleteABanner'));
    });

        Route::prefix('config')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('Setting')])
            ->group(function (){
            Route::get('/edit', [ConfigController::class,'edit'])->name('config.edit'); // Trả về form edit category
            Route::post('/edit', [ConfigController::class,'update'])->name('config.update'); // Trả về form edit category
        });
});
 Route::get('/error/404', function () {
     return view("errors.404");
 })->name('error.permission');


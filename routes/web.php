<?php

//use App\Http\Controllers\Admin\AccessoryController;
use App\Http\Controllers\Admin\AccessoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\LaptopController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PcController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PrebuiltPcController;
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
    Route::get('/getRevenueByMonth', [DashboardController::class, 'getRevenueByMonth'])->name('getRevenueByMonth');

    Route::prefix('brand')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('BrandManagement')])->group(function() {
        Route::get('/',[BrandController::class,'index'])->name("brand.index"); // danh sách
        Route::get('/add', [BrandController::class,'add'])->name('brand.add'); // Trả về form thêm mới
        Route::post('/add', [BrandController::class,'store'])->name('brand.store'); // tạo mới
        Route::get('/edit/{id}', [BrandController::class,'edit'])->name('brand.edit'); // Trả về form edit
        Route::post('/edit/{id}', [BrandController::class,'update'])->name('brand.update'); // Update
        Route::get('/delete/{id}', [BrandController::class,'destroy'])->name('brand.destroy'); // delete
    });
    Route::prefix('category/{model_type}')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('CategoryManagement')])->group(function(){
        Route::get('/', [CategoryController::class,'index'])->name('category.index');
        Route::get('/add', [CategoryController::class,'add'])->name('category.add');
        Route::post('/add', [CategoryController::class,'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
        Route::post('/edit/{id}', [CategoryController::class,'update'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class,'destroy'])->name('category.destroy');
    });
    Route::prefix('product')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('ProductManagement')])->group(function() {
        Route::group(['prefix'=>'accessory/{accessory_type}'],function() {
            Route::get('/',[AccessoryController::class,'index'])->name("accessory.index");
            Route::get('/add', [AccessoryController::class,'add'])->name('accessory.add');
            Route::post('/add', [AccessoryController::class,'store'])->name('accessory.store');
            Route::get('/edit/{id}', [AccessoryController::class,'edit'])->name('accessory.edit');
            Route::post('/edit/{id}', [AccessoryController::class,'update'])->name('accessory.update');
            Route::get('/delete/{id}', [AccessoryController::class,'destroy'])->name('accessory.destroy');
        });
        Route::group(['prefix'=>'prebuilt-pc'],function() {
            Route::get('/',[PrebuiltPcController::class,'index'])->name("prebuiltPc.index");
            Route::get('/add', [PrebuiltPcController::class,'add'])->name('prebuiltPc.add');
            Route::post('/add', [PrebuiltPcController::class,'store'])->name('prebuiltPc.store');
            Route::get('/edit/{id}', [PrebuiltPcController::class,'edit'])->name('prebuiltPc.edit');
            Route::post('/edit/{id}', [PrebuiltPcController::class,'update'])->name('prebuiltPc.update');
            Route::get('/delete/{id}', [PrebuiltPcController::class,'destroy'])->name('prebuiltPc.destroy');
        });
        Route::group(['prefix'=>'laptop'],function() {
            Route::get('/',[LaptopController::class,'index'])->name("laptop.index");
            Route::get('/add', [LaptopController::class,'add'])->name('laptop.add');
            Route::post('/add', [LaptopController::class,'store'])->name('laptop.store');
            Route::get('/edit/{id}', [LaptopController::class,'edit'])->name('laptop.edit');
            Route::post('/edit/{id}', [LaptopController::class,'update'])->name('laptop.update');
            Route::get('/delete/{id}', [LaptopController::class,'destroy'])->name('laptop.destroy');
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
    Route::prefix('order')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('OrderManagement')])
        ->group(function(){
        Route::get('/', [\App\Http\Controllers\OrderController::class,'index'])->name('order.index');
        Route::get('/search', [\App\Http\Controllers\OrderController::class,'search'])->name('order.search');
        Route::get('/edit/{id}', [\App\Http\Controllers\OrderController::class,'edit'])->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('EditAnOrder')])->name('order.edit');
        Route::post('/edit/{id}', [\App\Http\Controllers\OrderController::class,'update'])->name('order.update');
    });
    Route::prefix('review')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('ReviewManagement')])
        ->group(function(){
            Route::get('/', [\App\Http\Controllers\Admin\ReviewController::class,'index'])->name('review.index');
            Route::get('/search', [\App\Http\Controllers\Admin\ReviewController::class,'index'])->name('review.search');
            Route::get('/edit/{id}', [\App\Http\Controllers\Admin\ReviewController::class,'edit'])
                ->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('EditAReview')])
                ->name('review.edit');
            Route::post('/edit/{id}', [\App\Http\Controllers\Admin\ReviewController::class,'update'])
                ->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('EditAReview')])
                ->name('review.update');
        });
   Route::prefix('filters')->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('FilterManagement')])
       ->group(function () {
        Route::get('/', [FilterController::class, 'index'])->name('filters.index');
        Route::get('/{id}/edit', [FilterController::class, 'edit'])
            ->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('EditFilter')])
            ->name('filters.edit');
        Route::post('/{id}', [FilterController::class, 'update'])
            ->middleware(['checkPermissionByFunction:'.CustomPermission::getPermissionByKey('EditFilter')])
            ->name('filters.update');
    });

});
 Route::get('/error/404', function () {
     return view("errors.404");
 })->name('error.permission');

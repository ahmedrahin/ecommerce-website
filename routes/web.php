<?php

/*
|--------------------------------------------------------------------------
| Frontend Web Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Frontend\PagesController;

/*
|--------------------------------------------------------------------------
| Admin Web Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserManagement\UserController;
use App\Http\Controllers\UserManagement\RoleControllerr;
use App\Http\Controllers\Apps\BrandController;
use App\Http\Controllers\Apps\CategoryController;
use App\Http\Controllers\Apps\SubcategoryController;
use App\Http\Controllers\Apps\SubsubcategoryController;
use App\Http\Controllers\Apps\ProductController;
use App\Http\Controllers\Apps\VariantController;
use App\Http\Controllers\Apps\ShippingController;
use App\Http\Controllers\Apps\ProductEditController;
use App\Http\Controllers\Apps\OrderController;
use App\Http\Controllers\Apps\SettingController;
use App\Http\Controllers\Apps\AdminManagementController;
use App\Http\Controllers\Apps\CouponController;


/*
|--------------------------------------------------------------------------
| Frontend Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PagesController::class, 'home'])->name('homepage');

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/c-clean', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    session()->flush();
    return env('APP_NAME') . ' All cache cleared.';
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('admin-management.')->middleware('can:admin catalouge')->group(function () {
        Route::resource('/admin-list', AdminManagementController::class);
        Route::resource('/admin-management/roles', RoleManagementController::class);
        Route::resource('/admin-management/permissions', PermissionManagementController::class);
    });

    Route::name('user-management.')->group(function () {
        // Route::resource('/user-management/users', UserManagementController::class);
    });

    Route::prefix('product-catalogue')->name('product-catalogue.')->middleware('can:product catalouge')->group(function () {
        Route::get('brand', [BrandController::class, 'index'])->name('brand.index');
        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('subcategory', [SubcategoryController::class, 'index'])->name('subcategory.index');
        Route::get('subsubcategory', [SubsubcategoryController::class, 'index'])->name('subsubcategory.index');
    });

    // product management
    Route::name('product-management.')->group(function () {
        Route::controller(ProductController::class)->group(function () {

            // Apply middleware for permissions
            Route::get('/all-product', 'index')->name('index')->middleware('can:all product');
            Route::get('/create-product', 'create')->name('create')->middleware('can:add product');
            Route::post('/store-product', 'store')->name('store')->middleware('can:add product');
            Route::get('/product-edit/{id}', [ProductEditController::class, 'edit'])->name('edit')->middleware('can:update product');
            Route::post('/product-update/{id}', [ProductEditController::class, 'update'])->name('update')->middleware('can:update product');
            Route::get('/product-details/{id}', 'show')->name('show')->middleware('can:all product');
            
            // API for categories (without middleware, as they might be public)
            Route::get('/get-subcategories/{category_id}', [SubcategoryController::class, 'getSubcategories']);
            Route::get('/get-subsubcategories/{subcategory_id}', [SubsubcategoryController::class, 'getSubsubcategories']);
        
            // API for product variations
            Route::get('/get-attribute-value/{attribute_id}', [VariantController::class, 'getAttributeValue']);
        });
    });

    // product variant
    Route::name('product-variant.')->group(function(){
        Route::controller(VariantController::class)->group(function () {
            Route::get('/product-variant', 'index')->name('index');
        });
    });

    // shipping management
    Route::name('shipping.')->group(function(){
        Route::controller(ShippingController::class)->group(function () {
            Route::get('/shipping-district', 'district')->name('district');
            Route::get('/shipping-state', 'state')->name('state');
            Route::get('/shipping-method', 'shipping_method')->name('shipping_method');
        });
    });

    // order management
    Route::name('order-management.')->middleware('can:order catalouge')->group(function(){
        Route::resource('/order', OrderController::class);
    });

    // coupon
    Route::name('coupon.')->group(function(){
        Route::get('coupon', [CouponController::class, 'index'])->name('index');
    });

    // setting
    Route::name('setting.')->group(function(){
        Route::controller(SettingController::class)->group(function(){
            Route::get('/genarel-settings', 'manage')->name('manage');
        });
    });
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\API\SubscriberController;
use App\Http\Controllers\Apps\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;


// use App\Http\Controllers\Api\OrderController;
// use App\Http\Controllers\Api\TicketParcentController;
// use App\Http\Controllers\Api\AirlineController;
// use App\Http\Controllers\Api\AirlinesCommissionController;
// use App\Http\Controllers\Api\BankDetailsController;
// use App\Http\Controllers\Api\FundController;
/*
|--------------------------------------------------------------------------
| API Routes 
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [SubscriberController::class, 'register']);
Route::post('/login', [SubscriberController::class, 'login']);

Route::get('/brands', [BrandController::class, 'getBrand']);
Route::get('/topbar_menu_items', [CategoryController::class, 'getAllCategoriesWithHierarchy']);
Route::get('/product-stock', function(){
   return json_encode(App\Models\Product::with('productStock.attributeOptions')->get());
});

//http://localhost:8000/api/products?query=/kids/activewear
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/get_product_by_id/{id}', [ProductController::class, 'getProductById']);
    Route::get('/categories', [CategoryController::class, 'index']);
});

Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'addToCart']);
});
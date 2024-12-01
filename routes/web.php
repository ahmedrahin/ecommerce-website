<?php

/*
|--------------------------------------------------------------------------
| Frontend Web Controllers
|--------------------------------------------------------------------------
*/
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Models\Order;
use App\Http\Controllers\Apps\OrderController;


/*
|--------------------------------------------------------------------------
| Frontend Web Routes
|--------------------------------------------------------------------------
*/

// home and static pages
Route::get('/', [PagesController::class, 'home'])->name('homepage');
Route::get('/about-us', [PagesController::class, 'about'])->name('about');
Route::get('/contact-us', [PagesController::class, 'contact'])->name('contact');

// shop page
Route::prefix('shop')->controller(ShopController::class)->group(function () {
    Route::get('/', 'allProducts')->name('shop');
    Route::get('/wishlist', 'wishlist')->name('wishlist');
});

// product-details page
Route::get('/product/{slug}', [ShopController::class, 'productDetails'])->name('product-details');

// checkout page
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/success-order/{order_id}', function ($order_id) {
    $order = Order::where('order_id', $order_id)->firstOrFail();
    return view('frontend.pages.order.success', compact('order'));
})->name('success.order');
// order invoice download pdf
Route::get('/order-invoice/{order_id}', [OrderController::class, 'downloadInvoice'])->name('order.invoice.pdf');

Route::get('/cart', function(){
    return view('frontend.pages.order.cart');
})->name('cart')->middleware('check.cart');

// user dashboard page
Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard')->middleware('auth');
Route::get('/invoice/{order_id}', [UserDashboardController::class, 'invoice'])->name('order.invoice')->middleware('auth');

Route::fallback(function () {
    return view('pages.system.fallback');
});

require __DIR__ . '/auth.php';
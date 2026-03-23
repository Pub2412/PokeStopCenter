<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;

// Default landing dashboard page
Route::get('/', function () {
    $featuredProducts = Product::with(['photos', 'reviews'])
        ->active()
        ->orderByDesc('id')
        ->limit(6)
        ->get();

    return view('home.index', compact('featuredProducts'));
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');
});

Route::get('/email/verify/{token}', [AuthController::class, 'verifyEmail'])->name('auth.verify');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');

// Shop Routes (Public)
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/products/{product:id}', [ShopController::class, 'show'])->name('shop.product.show');
Route::get('/search', [ShopController::class, 'search'])->name('shop.search');
Route::get('/filter', [ShopController::class, 'filter'])->name('shop.filter');

// Cart Routes (Auth required, non-admin only)
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/checkout', [CartController::class, 'showCheckout'])->name('cart.checkout.show');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/add/{product:id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{cartItem:id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem:id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Order / Transaction Routes (Auth required, non-admin only)
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order:id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order:id}/pay', [OrderController::class, 'pay'])->name('orders.pay');
});

// Review Routes (Auth required)
Route::middleware('auth')->group(function () {
    Route::post('/products/{product:id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review:id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review:id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Admin Routes
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Product Management
    Route::resource('products', ProductController::class);
    Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
    Route::post('products/{product}/photos', [ProductController::class, 'uploadPhotos'])->name('products.photos.upload');
    Route::post('products/{product}/photos/{photo}/primary', [ProductController::class, 'setPrimaryPhoto'])->name('products.photos.primary');
    Route::delete('products/{product}/photos/{photo}', [ProductController::class, 'deletePhoto'])->name('products.photos.delete');
    Route::post('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete');

    // User Management
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::post('users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.update-role');

    // Review Management
    Route::delete('reviews/{review}', [ReviewController::class, 'adminDestroy'])->name('reviews.admin-delete');
    Route::get('reviews', [ReviewController::class, 'adminIndex'])->name('reviews.index');

    // Orders/Transactions
    Route::get('orders', [OrderController::class, 'adminIndex'])->name('orders.index');
    Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

    // Analytics/Reports
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics');
});


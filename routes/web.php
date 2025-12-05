<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuth;
use App\Http\Controllers\Auth\AdminAuth;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;

// ====================
// PUBLIC WEB ROUTES
// ====================

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/rekomendasi', function () {
    return view('rekomendasi');
})->name('rekomendasi');

Route::get('/kategori', function () {
    return view('kategori');
})->name('kategori');

Route::get('/promo', function () {
    return view('promo');
})->name('promo');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/invoice', function () {
    return view('invoice');
})->name('invoice');

Route::get('/product', function () {
    return view('product');
})->name('product');

Route::get('/alamat', function () {
    return view('alamat');
})->name('alamat');

Route::get('/listalamat', function () {
    return view('alamat_list');
})->name('listalamat');

Route::get('/addalamat', function () {
    return view('alamat_add');
})->name('addalamat');

Route::get('/banner', function () {
    return view('admin_banner');
})->name('banner');

Route::get('/pesanan', function () {
    return view('pesanan');
})->name('pesanan');


//testing route



// Checkout routes (no authentication required)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/order/confirmation/{id}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');

// Public chat bot route (no authentication required)
Route::post('/chat/bot', [ChatController::class, 'getBotResponse'])->name('chat.bot');

// Protected routes (require authentication)
Route::middleware(['auth.user'])->group(function () {
    // Protected profile route (require authentication)
    Route::get('/user/profile', [UserAuth::class, 'profile'])->name('user.profile');
    Route::post('/logout', [UserAuth::class, 'logout'])->name('logout');
    
    // Chat routes for users
    Route::get('/chat', [ChatController::class, 'userChat'])->name('user.chat');
    Route::post('/chat/send', [ChatController::class, 'sendUserMessage'])->name('chat.send.user');
    Route::get('/chat/refresh', [ChatController::class, 'getUserChatForRefresh'])->name('chat.refresh.user');
});
    


// Put Submission Route here
Route::post('/register', [UserAuth::class, 'register'])->name('register.submit');

// Help Pages
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/pengiriman', function () {
    return view('pengiriman');
})->name('pengiriman');

Route::get('/pengembalian', function () {
    return view('pengembalian');
})->name('pengembalian');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/order/confirmation/{id}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');

// Public chat bot route
Route::post('/chat/bot', [ChatController::class, 'getBotResponse'])->name('chat.bot');

// ====================
// AUTH ACTIONS
// ====================

Route::post('/register', [UserAuth::class, 'register'])->name('register.submit');
Route::post('/login', [UserAuth::class, 'login'])->name('login.submit');

// Admin auth
Route::get('/admin/login', function () {
    return view('admin_login');
})->name('admin.login');

Route::post('/admin/login', [AdminAuth::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuth::class, 'logout'])->name('admin.logout');

// ====================
// PROTECTED WEB ROUTES
// ====================

// User protected views
Route::middleware(['auth.user'])->group(function () {
    // Protected profile route (require authentication)
    Route::get('/user/profile', [UserAuth::class, 'profile'])->name('user.profile');
    Route::post('/logout', [UserAuth::class, 'logout'])->name('logout');

    // User chat routes
    Route::get('/chat', [ChatController::class, 'userChat'])->name('user.chat');
    Route::post('/chat/send', [ChatController::class, 'sendUserMessage'])->name('chat.send.user');
    Route::get('/chat/refresh', [ChatController::class, 'getUserChatForRefresh'])->name('chat.refresh.user');
});

// Admin protected views
Route::prefix('admin')->middleware(['auth.admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');
    Route::get('/billing', [AdminController::class, 'billing'])->name('admin.billing');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');

    // Admin product management
    //    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
       Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    // Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    // Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    // Admin chat routes
    Route::get('/chat', [ChatController::class, 'adminChat'])->name('admin.chat');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'getChatMessages'])->name('admin.chat.messages');
    Route::post('/chat/send', [ChatController::class, 'sendAdminMessage'])->name('chat.send.admin');
    Route::get('/chat/unread-count', [ChatController::class, 'getUnreadCount'])->name('admin.chat.unread');
    Route::get('/chat/recent-users', [ChatController::class, 'getRecentUsers'])->name('admin.chat.recent');
});

// ====================
// PUBLIC API ROUTES (JSON)
// ====================

Route::prefix('public')->group(function () {
    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::get('/category/{categoryId}', [ProductController::class, 'byCategory']);
        Route::get('/search/{keyword}', [ProductController::class, 'search']);
    });

    // Categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);

    // Promos
    Route::get('/promo', [PromoController::class, 'index']);
    Route::get('/promo/{id}', [PromoController::class, 'show']);
});

// ====================
// PROTECTED API ROUTES
// ====================

// Admin API routes
Route::prefix('admin/api')->middleware('auth.admin')->group(function () {
    // Products
    Route::apiResource('products', ProductController::class)
        ->only(['store', 'update', 'destroy']);

    Route::post('products/{id}/thumbnail', [ProductController::class, 'updateThumbnail']);

    // Categories
    Route::apiResource('categories', CategoryController::class)
        ->only(['store', 'update', 'destroy']);

    // Addresses (view only)
    Route::get('addresses', [AddressController::class, 'index']);
    Route::get('addresses/{id}', [AddressController::class, 'show']);

    // Promos
    Route::apiResource('promo', PromoController::class)
        ->except(['index', 'show']);

    // Orders
    Route::apiResource('orders', OrderController::class);
});

// User API routes
Route::prefix('user/api')->middleware('auth.user')->group(function () {
    // Addresses
    Route::apiResource('addresses', AddressController::class);
    Route::post('addresses/{id}/select', [AddressController::class, 'select']);

    // Orders
    Route::apiResource('orders', OrderController::class);
});

// ====================
// DEBUG/TEST ROUTES
// ====================

Route::get('/force-logout', function () {
    Auth::guard('user')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('success', 'Logged out successfully!');
});

Route::get('/debug-auth', function () {
    $user = Auth::guard('user')->user();
    $admin = Auth::guard('admin')->user();

    return response()->json([
        'authenticated' => [
            'user' => Auth::guard('user')->check(),
            'admin' => Auth::guard('admin')->check()
        ],
        'user' => $user ? [
            'id' => $user->id,
            'nama' => $user->nama,
            'email' => $user->email,
            'profile_id' => $user->id_profile
        ] : null,
        'admin' => $admin ? [
            'id' => $admin->id,
            'nama' => $admin->nama,
            'email' => $admin->email
        ] : null,
        'session_id' => session()->getId(),
        'timestamp' => now()->toISOString()
    ]);
})->name('debug.auth');

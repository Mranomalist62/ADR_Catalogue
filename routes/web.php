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
use App\Http\Controllers\PaymentController;

// ==========================================================
// PUBLIC WEB ROUTES (Views)
// ==========================================================

Route::get('/', fn() => view('Home'))->name('home');
Route::get('/login', fn() => view('login'))->name('login');
Route::get('/register', fn() => view('register'))->name('register');

Route::get('/rekomendasi', fn() => view('rekomendasi'))->name('rekomendasi');
Route::get('/kategori', fn() => view('kategori'))->name('kategori');
Route::get('/invoice', fn() => view('invoice'))->name('invoice');

Route::get('/product/{id}', fn($id) => view('product', compact('id')))->name('product');
    Route::get('/profile', fn() => view('profile'))->name('profile');


Route::get('/banner', fn() => view('admin_banner'))->name('banner');



// Help pages
Route::get('/faq', fn() => view('faq'))->name('faq');
Route::get('/pengiriman', fn() => view('pengiriman'))->name('pengiriman');
Route::get('/pengembalian', fn() => view('pengembalian'))->name('pengembalian');
Route::get('/kontak', fn() => view('kontak'))->name('kontak');

// ==========================================================
// CHATBOT (PUBLIC)
// ==========================================================

Route::post('/chat/send', [ChatController::class, 'sendUserMessage']);
Route::post('/chat/bot', [ChatbotController::class, 'reply']);

// ==========================================================
// AUTH ACTIONS
// ==========================================================

Route::post('/register', [UserAuth::class, 'register'])->name('register.submit');
Route::post('/login', [UserAuth::class, 'login'])->name('login.submit');


// Admin auth
Route::get('/admin/login', fn() => view('admin_login'))->name('admin.login');
Route::post('/admin/login', [AdminAuth::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuth::class, 'logout'])->name('admin.logout');

// ==========================================================
// USER PROTECTED WEB ROUTES
// ==========================================================

Route::middleware(['auth.user'])->group(function () {

    Route::get('/promo', fn() => view('promo'))->name('promo'); // DUPLICATE
    Route::post('/logout', [UserAuth::class, 'logout'])->name('logout'); // DUPLICATE LOGOUT BELOW


    //Pembayaran
    Route::get('/pembayaran', fn() => view('Pembayaran') )->name('pembayaran');
    Route::get('/pesanan', fn() => view('pesanan'))->name('pesanan');

    //Alamat
    Route::get('/alamat', fn() => view('alamat'))->name('alamat');
    Route::get('/listalamat', fn() => view('alamat_list'))->name('listalamat');
    Route::get('/addalamat', fn() => view('alamat_add'))->name('addalamat');
    Route::get('/editalamat/{id}', function($id) {return view('alamat_edit', ['addressId' => $id]);})->name('alamat.edit');


    // Chat routes
    Route::get('/chat', [ChatController::class, 'userChat'])->name('user.chat');
    Route::post('/chat/send', [ChatController::class, 'sendUserMessage'])->name('chat.send.user');
    Route::get('/chat/refresh', [ChatController::class, 'getUserChatForRefresh'])->name('chat.refresh.user');


});

// ==========================================================
// ADMIN WEB ROUTES (PROTECTED)
// ==========================================================

Route::prefix('admin')->middleware(['auth.admin'])->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('admin');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');
    Route::get('/billing', [AdminController::class, 'billing'])->name('admin.billing');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');

    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');

    // Admin chat
    Route::get('/chat', [ChatController::class, 'adminChat'])->name('admin.chat');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'getChatMessages'])->name('admin.chat.messages');
    Route::post('/chat/send', [ChatController::class, 'sendAdminMessage'])->name('chat.send.admin');
    Route::get('/chat/unread-count', [ChatController::class, 'getUnreadCount'])->name('admin.chat.unread');
    Route::get('/chat/recent-users', [ChatController::class, 'getRecentUsers'])->name('admin.chat.recent');
});

// ==========================================================
// PUBLIC API ROUTES (JSON API)
// ==========================================================

Route::prefix('public')->group(function () {

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/search', [ProductController::class, 'search']);
        Route::get('/by-category/{categoryId}', [ProductController::class, 'byCategory']);
        Route::get('/category/{categoryId}', [ProductController::class, 'byCategory']);

        Route::get('/recommended', [ProductController::class, 'recommended']);
        Route::get('/terbaru', [ProductController::class, 'terbaru']);
        Route::get('/diskon', [ProductController::class, 'diskon']); // FIX lowercase route::

        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
    });

    // Categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);

    // Promo
    Route::get('/promo', [PromoController::class, 'index']);
    Route::get('/promo/{id}', [PromoController::class, 'show']);

    // Payment
    Route::post('/payments/notification', [PaymentController::class, 'handleNotification']);

});

// ==========================================================
// ADMIN API ROUTES
// ==========================================================

Route::prefix('admin/api')->middleware('auth.admin')->group(function () {

    Route::apiResource('products', ProductController::class)
        ->only(['store', 'update', 'destroy']);

    Route::post('products/{id}/thumbnail', [ProductController::class, 'updateThumbnail']);

    Route::apiResource('categories', CategoryController::class)
        ->only(['store', 'update', 'destroy']);

    Route::get('/addresses/default/', [AddressController::class, 'getDefaultAddress'])->name('alamat.default');
    Route::get('addresses', [AddressController::class, 'index']);
    Route::get('addresses/{id}', [AddressController::class, 'show']);



    Route::apiResource('promo', PromoController::class)
        ->except(['index', 'show']);

    Route::apiResource('orders', OrderController::class);

    Route::prefix('payments')->group(function () {
        Route::get('/order/{order}', [PaymentController::class, 'show']);
        Route::post('/create', [PaymentController::class, 'create']);
        Route::get('/history', [PaymentController::class, 'history']);
        Route::get('/{payment}', [PaymentController::class, 'detail']);
        Route::get('/status/{order}', [PaymentController::class, 'checkStatus']);
        Route::post('/{order}/cancel', [PaymentController::class, 'cancel']);
        Route::get('/return/{orderId}', [PaymentController::class, 'paymentReturn']);
        Route::get('/error/{orderId}', [PaymentController::class, 'paymentError']);
        Route::get('/pending/{orderId}', [PaymentController::class, 'paymentPending']);
        Route::get('/unfinished/{orderId}', [PaymentController::class, 'paymentUnfinished']);
    });
});

// ==========================================================
// USER API ROUTES
// ==========================================================

Route::prefix('user/api')->middleware('auth.user')->group(function () {
    Route::get('addresses/default', [AddressController::class, 'getDefaultAddress'])->name('alamat.default');
    Route::post('addresses/{id}/select', [AddressController::class, 'select']);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('orders', OrderController::class)->except(['update', 'destroy']);



    Route::prefix('payments')->group(function () {
        Route::get('/order/{order}', [PaymentController::class, 'show']);
        Route::post('/create', [PaymentController::class, 'create']);
        Route::get('/history', [PaymentController::class, 'history']);
        Route::get('/{payment}', [PaymentController::class, 'detail']);
        Route::get('/status/{order}', [PaymentController::class, 'checkStatus']);
        Route::post('/{order}/cancel', [PaymentController::class, 'cancel']);
        Route::get('/return/{orderId}', [PaymentController::class, 'paymentReturn']);
        Route::get('/error/{orderId}', [PaymentController::class, 'paymentError']);
        Route::get('/pending/{orderId}', [PaymentController::class, 'paymentPending']);
        Route::get('/unfinished/{orderId}', [PaymentController::class, 'paymentUnfinished']);
    });
});

// ==========================================================
// DEBUG ROUTES
// ==========================================================

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

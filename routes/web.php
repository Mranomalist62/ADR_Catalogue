<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\adminAuth;
use App\Http\Controllers\Auth\userAuth;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CheckoutController;

// Public routes (no authentication required)
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

// Help Pages Routes
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
// Admin routes
Route::get('/admin/login', function () {
    return view('admin_login');
})->name('admin.login');

Route::post('/admin/login', [App\Http\Controllers\Auth\adminAuth::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [App\Http\Controllers\Auth\adminAuth::class, 'Logout'])->name('admin.logout');

Route::middleware(['auth.admin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\admin::class, 'dashboard'])->name('admin');
    
    Route::get('/admin/orders', [App\Http\Controllers\admin::class, 'orders'])->name('admin.orders');
    
    Route::get('/admin/statistics', [App\Http\Controllers\admin::class, 'statistics'])->name('admin.statistics');
    
    Route::get('/admin/billing', [App\Http\Controllers\admin::class, 'billing'])->name('admin.billing');
    
    Route::get('/admin/products', [App\Http\Controllers\admin::class, 'products'])->name('admin.products');
    Route::post('/admin/products', [App\Http\Controllers\admin::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [App\Http\Controllers\admin::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [App\Http\Controllers\admin::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [App\Http\Controllers\admin::class, 'deleteProduct'])->name('admin.products.delete');
    
    // Chat routes for admin
    Route::get('/admin/chat', [ChatController::class, 'adminChat'])->name('admin.chat');
    Route::get('/admin/chat/messages/{userId}', [ChatController::class, 'getChatMessages'])->name('admin.chat.messages');
    Route::post('/admin/chat/send', [ChatController::class, 'sendAdminMessage'])->name('chat.send.admin');
    Route::get('/admin/chat/unread-count', [ChatController::class, 'getUnreadCount'])->name('admin.chat.unread');
    Route::get('/admin/chat/recent-users', [ChatController::class, 'getRecentUsers'])->name('admin.chat.recent');
});
Route::post('/login', [UserAuth::class, 'login'])->name('login.submit');

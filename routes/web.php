<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\adminAuth;
use App\Http\Controllers\Auth\userAuth;

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

Route::get('/admin', function () {
        return view('admin');
    })->name('admin');

    Route::get('/product', function () {
        return view('product');
    })->name('product');

//testing route

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


// Protected routes (require authentication)
Route::middleware(['auth:user'])->group(function () {

    Route::get('/promo', function () {
        return view('promo');
    })->name('promo');

    Route::get('/profile', [UserAuth::class, 'profile'])->name('profile');
    Route::post('/logout', [UserAuth::class, 'logout'])->name('logout');
});


// Put Submission Route here
Route::post('/register', [UserAuth::class, 'register'])->name('register.submit');
Route::post('/login', [UserAuth::class, 'login'])->name('login.submit');


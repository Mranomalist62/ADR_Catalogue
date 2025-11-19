<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\adminAuth;
use App\Http\Controllers\Auth\userAuth;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group((function(){
    Route::post('/user/register', [userAuth::class, 'register']);
    Route::post('/user/login', [userAuth::class, 'login']);
    Route::post('/user/logout', [userAuth::class, 'logout']);
}));

Route::prefix('admin')->group((function(){
    Route::post('/admin/register', [adminAuth::class, 'register']);
    Route::post('/admin/login', [adminAuth::class, 'login']);
    Route::post('/admin/logout', [adminAuth::class, 'logout']);
}));
Route::get('/home', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/rekomendasi', function () {
    return view('rekomendasi');
})->name('rekomendasi');

Route::get('/promo', function () {
    return view('promo');
})->name('promo');

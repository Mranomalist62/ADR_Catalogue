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
    Route::post('/admin/login', [adminAuth::class, 'login']);
    Route::post('/admin/logout', [adminAuth::class, 'logout']);
    Route::get('/admin/profile', [adminAuth::class, 'profile']);
}));

<?php

use Illuminate\Support\Facades\Route;

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

Route :: get('/admin', function() {
    return view('admin');
}) -> name('admin');

Route::get('/kategori', function () {
    return view('kategori');
})->name('kategori');
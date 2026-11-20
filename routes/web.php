<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - ReWear
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return redirect()->route('products.index');
})->name('home');

// Register dan Login
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

// Dashboard dan Logout
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

// CRUD Produk - Fitur teman
Route::resource('products', ProductController::class);

// CRUD Pesanan - Fitur kamu
Route::resource('pesanan', PesananController::class);

// Alias route orders
Route::get('/orders', [PesananController::class, 'index'])
    ->name('seller.orders');

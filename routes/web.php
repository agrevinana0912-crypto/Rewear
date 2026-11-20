<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PesananController;

/*
|--------------------------------------------------------------------------
| Web Routes - ReWear Preloved Marketplace
|--------------------------------------------------------------------------
*/

// Halaman utama: dialihkan langsung ke dashboard produk preloved
Route::get('/', function () {
    return redirect()->route('products.index');
})->name('home');

// Rute CRUD Produk Preloved (Fitur dari project preloved-produk)
Route::resource('products', ProductController::class);

// Rute CRUD Kelola Pesanan (Fitur ReWear)
Route::resource('pesanan', PesananController::class);

// Alias rute orders untuk kompatibilitas tautan dari preloved-produk
Route::get('/orders', [PesananController::class, 'index'])->name('seller.orders');

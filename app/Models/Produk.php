<?php

namespace App\Models;

/**
 * Model Produk (Alias/Ekstensi dari Product)
 * Menjaga kompatibilitas fitur pesanan ReWear yang mengacu ke model Produk
 * agar terhubung langsung ke tabel products.
 */
class Produk extends Product
{
    protected $table = 'products';
}

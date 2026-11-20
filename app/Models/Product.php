<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'nama_produk',
        'kategori',
        'deskripsi',
        'harga',
        'ukuran',
        'kondisi',
        'stok',
        'foto',
        'user_id',
    ];

    /**
     * Relasi ke pemilik produk (User / Penjual)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke item transaksi jika dibeli
     */
    public function transaksiItems()
    {
        return $this->hasMany(TransaksiItem::class, 'produk_id');
    }
}

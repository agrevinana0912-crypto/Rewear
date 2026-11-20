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
     * Relasi ke pemilik produk
     */
    public function user()
    {
        return $this->belongsTo(
            UserRewear::class,
            'user_id',
            'ID_USER'
        );
    }

    /**
     * Relasi ke item transaksi
     */
    public function transaksiItems()
    {
        return $this->hasMany(
            TransaksiItem::class,
            'produk_id',
            'id'
        );
    }
}

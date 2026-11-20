<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $primaryKey = 'ID_PRODUK';

    public $timestamps = false;

    protected $fillable = [
        'ID_USER',
        'NAMA_PRODUK',
        'DESKRIPSI',
        'HARGA',
        'STOK',
        'KONDISI',
    ];

    public function detailPesanan()
    {
        return $this->hasMany(
            DetailPesanan::class,
            'ID_PRODUK',
            'ID_PRODUK'
        );
    }
}

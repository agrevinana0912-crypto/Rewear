<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';

    protected $primaryKey = 'ID_DETAIL_PESANAN';

    public $timestamps = false;

    protected $fillable = [
        'ID_PESANAN',
        'ID_PRODUK',
        'JUMLAH',
    ];

    public function pesanan()
    {
        return $this->belongsTo(
            Pesanan::class,
            'ID_PESANAN',
            'ID_PESANAN'
        );
    }

    public function produk()
    {
        return $this->belongsTo(
            Produk::class,
            'ID_PRODUK',
            'ID_PRODUK'
        );
    }
}

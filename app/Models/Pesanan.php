<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $primaryKey = 'ID_PESANAN';

    public $timestamps = false;

    protected $fillable = [
        'ID_USER',
        'TANGGAL',
        'TOTAL_HARGA',
        'STATUS',
    ];

    // Relasi ke tabel user_rewear
    public function userRewear()
    {
        return $this->belongsTo(
            UserRewear::class,
            'ID_USER',
            'ID_USER'
        );
    }

    // Relasi ke tabel detail_pesanan
    public function detailPesanan()
    {
        return $this->hasMany(
            DetailPesanan::class,
            'ID_PESANAN',
            'ID_PESANAN'
        );
    }
}

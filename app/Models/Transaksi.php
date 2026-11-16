<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Ganti 'transaksis' di bawah ini dengan nama tabel yang benar di database Anda:
    // Contoh jika nama tabelnya 'transaksi':
    protected $table = 'transaksi'; 
    
    // Atau jika nama tabelnya 'pesanan':
    // protected $table = 'pesanan';

    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id');
    }
}
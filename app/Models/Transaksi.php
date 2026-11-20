<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id');
    }
}

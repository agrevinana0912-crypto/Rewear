<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserRewear extends Authenticatable
{
    protected $table = 'user_rewear';

    protected $primaryKey = 'ID_USER';

    public $timestamps = false;

    protected $fillable = [
        'NAMA',
        'EMAIL',
        'PASSWORD',
        'ALAMAT',
        'NO_HP',
        'ROLE',
    ];

    protected $hidden = [
        'PASSWORD',
    ];

    public function getAuthPasswordName()
    {
        return 'PASSWORD';
    }

    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }

    public function pesanans()
    {
        return $this->hasMany(
            Pesanan::class,
            'ID_USER',
            'ID_USER'
        );
    }
}

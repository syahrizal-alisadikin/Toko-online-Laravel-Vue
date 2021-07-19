<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;        // <-- import JWTSubject
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Authenticatable implements JWTSubject // <-- tambahkan ini

{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

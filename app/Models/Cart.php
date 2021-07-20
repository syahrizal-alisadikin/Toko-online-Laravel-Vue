<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'fk_product_id', 'fk_customer_id', 'price', 'quantity', 'weight'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'fk_product_id','id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'fk_customer_id','id');
    }
}

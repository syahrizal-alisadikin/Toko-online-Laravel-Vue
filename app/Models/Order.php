<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['fk_invoice_id', 'invoice', 'fk_product_id', 'product_name', 'image', 'qty', 'price'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['image', 'title', 'slug', 'fk_category_id', 'content', 'weight', 'price', 'discount'];

    public function getImageAttribute($image)
    {
        return asset('storage/products/' . $image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'fk_category_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'stock',
        'price'
    ];

    // Relationships
    public function productDetails(){
        return $this->hasOne(ProductDetail::class, 'product_id'); 
    }
    public function images(){
        return $this->morphMany(Image::class, 'imageable'); 
    }
    public function reviews(){
        return $this->hasMany(Review::class, 'product_id'); 
    }
    public function cartItem(){
        return $this->hasMany(cartItem::class, 'product_id'); 
    }
}

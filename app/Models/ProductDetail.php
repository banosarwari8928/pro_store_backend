<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable = [
        "brand",
        "catagory",
        "discription"
    ];
    /** @use HasFactory<\Database\Factories\ProductDetailFactory> */
    use HasFactory;
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
}

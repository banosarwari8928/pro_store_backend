<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    public function pro_details(){
        return $this->hasOne(ProductDetail::class);
    }
    public function images(){
        return $this->morphMany(Image::class,"imageable");
    }
}

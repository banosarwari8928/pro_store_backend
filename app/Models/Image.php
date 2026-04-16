<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        "img_url",
        "imageable_id",
        "imageable_type"
    ];
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;
    public function imageable(){
        return $this->morphTo();
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class productResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name"=>$this->name,
            "stock"=>$this->stock,
            "pricd"=>$this->price,
            "brand"=>$this->pro_details->brand,
            "description"=>$this->pro_details->description,
            "catagory"=>$this->pro_details->catagory,
            "image"=>$this->images->map(function($images){
                return asset('storage/'.$images->img_url);
            }),
        ];
    }
}

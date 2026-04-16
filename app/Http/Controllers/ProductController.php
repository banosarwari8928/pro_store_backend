<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Image;
// use App\Http\Controllers\Pr
use App\Models\Product;
use App\Models\Product_Deltail;
use App\Models\ProductDetail;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $product = Product::with(['productDetails', 'images', 'reviews'])->paginate(10);
        return response()->json([
            'product'=> $product,
            'message'=> 'Success'
        ],202);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        $product = new Product();
        $product->create([
            'name'=> $request->name,
            'stock'=> $request->stock,
            'price'=> $request->price,
        ]);
        $product->save();

         $productDetails = new ProductDetail();
         $productDetails->create([
            'brand'=>$request->brand,
            'description'=>$request->description,
            'category'=>$request->category,
            'product_id'=>$product->id,
         ]);
         $path = null;
         if($request->hasFile('image')){
            $path = $request->file('image')->store('Products_Image', 'public');
         }
         $image = new Image();
         $image->create([
            'img_url'=>$path,
            'imageable_id'=> $product->id,
            'imageable_type'=> Product::class,
         ]);
         $image->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return response()->json([
            'data'=> $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

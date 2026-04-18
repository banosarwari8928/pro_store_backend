<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProudctUpdateREq;
use App\Models\Image;
// use App\Http\Controllers\Pr
use App\Models\Product;
use App\Models\Product_Deltail;
use App\Models\ProductDetail;
use Exception;
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
           $product = new Product();
        $product->create([
            "name"=> $request->name,
            "stock"=> $request->stock,
            "price"=> $request->price,
        ]);
        $product->save();

        $productDetails = new ProductDetail();
        $productDetails->create([
            "brand"=> $request->barnd,
            "description"=> $request->description,
            "product_id"=> $request->id,
            "category"=> $request->cat,
        ]);
        $productDetails->save();
        $path = null;
        if($request->hasFile("image")){
            $path = $request->file("image")->store("pro_img","public");
        }
        $image = new Image();
        $image->create([
            "img_url"=> $path,
            "imageable_id"=> $product,
            "imageable_type"=> Product::class
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
    public function update(ProudctUpdateREq $request, string $id)
    {
       $product = Product::findOrFail($id);
       $product->update([
        "name"=> $request->name,
        "stock"=> $request->stock,
        "price"=> $request->price,
       ]);
         $product->save();
            $productDetails = ProductDetail::where("product_id" , $id)->first();
            $productDetails->update([
                "brand" => $request->brand,
                "description" => $request->description,
                "category" => $request->category,
            ]);
            $productDetails->save();
            $path = null;
            if($request->hasFile('image')){
                $path = $request->file('img_url')->store('images' , 'public');
            }
            $path2 = null ;
            if($request->hasFile('image2')){
               $path2 =  $request->file('image2')->store('images', 'public');
            }
            $image = Image::where("imageable_id" , $id)->where("imageable_type" , Product::class)->first();
            for($i = 0; count($image)> 0; $i++){
                if($i === 0){
                    $image->update([
                        'img_url' => $path,
                    ]);
                }
                else{
                    $image->update([
                        'img_url'=> $path2,
                    ]);
                }
            }
            return response()->json([
                "message" => "Product updated successfully",
            ]);
    }
    // {
    //     //
    //     try{
    //         $product=Product::findOrFail($id)->with(['images','pro_details'])->First();
    //         $product->update([
    //             "name"=>$request->name,
    //             "price"=>$request->price,
    //             "stock"=>$request->stock,
    //         ]);
    //         $product->save();
    //         $productDetail=ProductDetail::where('product_id', $product->id)->first();
    //         $productDetail->update(
    //             [
    //                 "description"=>$request->discribtion,
    //                 "catagory"=>$request->catagory,
    //                 "brand"=>$request->brand,
    //             ]
    //         );
    //         $image=null;
    //         $image2=null;
    //         if($request->hasFile('image1')){
    //             $image=$request->file('image1')->store('product_images','public');
    //         }
    //        $images= Image::where('imageable_type',Product::class)->where('imageable_id','product_id')->get();
    //       for($i = 0; count($image)>0;$i++){
    //         if($i ==0){

    //         }else{

    //         }
    //       }
    //        $images->update([
    //         "imageable_id"=>$product->id,
    //         "img_url"=>$image
    //        ]);
    //     }
    //     catch(Exception $err){
    //         return response()->json(
    //             [
    //                 "error"=>$err->getMessage(),
    //             ],
    //         );
    //     };
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

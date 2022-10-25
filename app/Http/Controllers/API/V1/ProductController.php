<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public $dataError = [
        "data" => null,
        "error" => "Product not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "Product deleted successfully !",
    ];

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/product",
     *   summary="All products",
     *   description="This route returns all products",
     *   tags={"Product"},
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1), 
     *              @OA\Property(property="name", type="text", example="Altenwerth, Koelpin and Breitenberg"),
     *              @OA\Property(property="address", type="text", example="12720 Kuphal Green\nCristfort, CO 08458"), 
     *              @OA\Property(property="description", type="text", example="Veniam aut officiis molestiae magnam. Necessitatibus assumenda quod adipisci nostrum totam est doloribus. Delectus quis quaerat numquam neque nisi laboriosam sit. Minima voluptatum sed commodi aperiam ut."),
     *              @OA\Property(property="created_at", type="text", example="2022-10-18T14:57:16.000000Z"),
     *              @OA\Property(property="updated_at", type="text", example="2022-10-18T14:57:16.000000Z")
     *          )
     *      )
     * )
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required'],
            'manufacturer_id'=>['required','exists:manufacturers,id'],
            'global_name'=>['required'],
            'unit_id'=>['required','exists:units,id'],
            'mandatory_assortment'=>['required'],
            'barcode'=>['required']
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->manufacturer_id = $request->manufacturer_id;
        $product->global_name = $request->global_name;
        $product->unit_id = $request->unit_id;
        $product->mandatory_assortment = $request->mandatory_assortment;
        $product->barcode = $request->barcode;
        $product->save();
        return response()->json(new ProductResource($product),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $product = Product::find($product);
        if($product){
            return response()->json(new ProductResource($product),200);
        }
        return response()->json($this->dataError,404);
    }


    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        $product = Product::find($product);
        if($product){
            $request->validate([
                'name'=>['required'],
                'manufacturer_id'=>['required','exists:manufacturers,id'],
                'global_name'=>['required'],
                'unit_id'=>['required','exists:units,id'],
                'mandatory_assortment'=>['required'],
                'barcode'=>['required']
            ]);
    
            $product = new Product();
            $product->name = $request->name;
            $product->manufacturer_id = $request->manufacturer_id;
            $product->global_name = $request->global_name;
            $product->unit_id = $request->unit_id;
            $product->mandatory_assortment = $request->mandatory_assortment;
            $product->barcode = $request->barcode;
            $product->save();
            return response()->json(new ProductResource($product),200);
      }
        return response()->json($this->dataError,404);        

    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = Product::find($product);
        if($product){
            $product->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}
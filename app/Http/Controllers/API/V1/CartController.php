<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public $dataError = [
        "data" => null,
        "error" => "Branch not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "Branch deleted successfully !",
    ];


    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /** 
     * @OA\Get(
     *   path="/api/v1/cart",
     *   summary="All carts",
     *   description="This route returns all carts",
     *   tags={"Cart"},
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
        return CartResource::collection(Cart::all());
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

     /**
     * @OA\Post(
     *      path="/v1/cart",
     *      operationId="storeProject",
     *      tags={"Cart"},
     *      summary="Store new project",
     *      description="Returns project data",
     *      @OA\RequestBody(
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id'=>['required','exists:orders,id'],
            'product_id'=>['required','exists:products,id'],
            'quantity'=>['required']
        ]);
        $cart = new Cart();
        $cart->order_id =$request->order_id;
        $cart->product_id = $request->product_id;;
        $cart->quantity= $request->quantity;
        $cart->save();

        return response()->json(new CartResource($cart),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show($cart)
    {
        $cart = Cart::find($cart);

        if($cart){
            return response()->json(new CartResource($cart),200);
        }
         return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$cart)
    {
        $c  = Cart::find($cart);
        if ($c) {
            $c->order_id =$request->order_id;
            $c->product_id = $request->product_id;;
            $c->quantity= $request->quantity;
            $c->save();
            return response()->json(new CartResource($c),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart)
    {
        $cart = Cart::find($cart);
        if($cart){
            $cart->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}
<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public $dataError = [
        "data" => null,
        "error" => "Order not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "Order deleted successfully !",
    ];

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/order",
     *   summary="All orders",
     *   description="This route returns all orders",
     *   tags={"Order"},
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
        return OrderResource::collection(Order::all());
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
            'branch_id'=>['required','exists:branches,id'],
            'user_id'=>['required','exists:users,id'],
            'status'=>['required'],
            'total_price'=>['required'],
        ]);

        $order = new Order();
        $order->branch_id =$request->branch_id;
        $order->user_id =$request->user_id;
        $order->status =$request->status;
        $order->total_price =$request->total_price;
        $order->save();

        return response()->json(new OrderResource($order),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
        $order = Order::find($order);
        if($order){
            return response()->json(new OrderResource($order),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$order)
    {
        $order = Order::find($order);
        if($order){
            $request->validate([
                'branch_id'=>['required','exists:branches,id'],
                'user_id'=>['required','exists:users,id'],
                'status'=>['required'],
                'total_price'=>['required'],
            ]);
    
            $order->branch_id =$request->branch_id;
            $order->user_id =$request->user_id;
            $order->status =$request->status;
            $order->total_price =$request->total_price;
            $order->save();
            return response()->json(new OrderResource($order),200);
      }
      return response()->json($this->dataError,404);        
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($order)
    {
        $order = Order::find($order);
        if($order){
            $order->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}
<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\DebtResource;
use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{

    public $dataError = [
        "data" => null,
        "error" => "Debt not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "Debt deleted successfully !",
    ];

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/debt",
     *   summary="All debts",
     *   description="This route returns all debts",
     *   tags={"Debt"},
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
        return DebtResource::collection(Debt::all());
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
            'order_id'=>['required','exists:orders,id'],
            'customer_id'=>['required','exists:customers,id'],
            'deadline'=>['required'],
            'notification_number'=>['required'],
            'status'=>['required'],
            'user_id'=>['required','exists:users,id'],
            'paid_amount'=>['required'],


        ]);
        $debt = Debt::create($request->all());

        return response()->json(new DebtResource($debt),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function show($debt)
    {
        $debt = Debt::find($debt);
        if($debt){
            return response()->json(new DebtResource($debt),200);
        }
         return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function edit(Debt $debt)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$debt)
    {
        $debt = Debt::find($debt);
        if($debt){
            $request->validate([
                'order_id'=>['required','exists:orders,id'],
                'customer_id'=>['required','exists:customers,id'],
                'deadline'=>['required'],
                'notification_number'=>['required'],
                'status'=>['required'],
                'user_id'=>['required','exists:users,id'],
                'paid_amount'=>['required'],
            ]);
            $debt->order_id = $request->order_id;
            $debt->customer_id = $request->customer_id;
            $debt->deadline = $request->deadline;
            $debt->notification_number = $request->notification_number;
            $debt->status = $request->status;
            $debt->user_id = $request->user_id;
            $debt->paid_amount = $request->paid_amount;
            return response()->json(new DebtResource($debt),200);        
        }
        return response()->json($this->dataError,404);        
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function destroy($debt)
    {
        $debt = Debt::find($debt);
        if($debt){
            $debt->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}
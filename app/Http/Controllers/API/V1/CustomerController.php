<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    
    public $dataError = [
        "data" => null,
        "error" => "Customer not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "Customer deleted successfully !",
    ];


    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/customer",
     *   summary="All customers",
     *   description="This route returns all customers",
     *   tags={"Customer"},
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
        return CustomerResource::collection(Customer::all());
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
            'surname'=>['required'],
            'phone'=>['required'],
            'address'=>['required'],
            'card_number'=>['required','unique:customers,card_number'],
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->surname = $request->surname;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->card_number = $request->card_number;
        $customer->save();
        return response()->json(new CustomerResource($customer),200);

    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($customer)
    {
        $customer = Customer::find($customer);
        if($customer){
            return response()->json(new CustomerResource($customer),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customer)
    {
        $customer = Customer::find($customer);
        if($customer){
            $request->validate([
                'name'=>['required'],
                'surname'=>['required'],
                'phone'=>['required'],
                'address'=>['required'],
                'card_number'=>['required','unique:customers,card_number'],
            ]);
            $customer->name = $request->name;
            $customer->surname = $request->surname;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->card_number = $request->card_number;
            $customer->save();
            return response()->json(new CustomerResource($customer),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($customer)
    {
        $customer = Customer::find($customer);
        if($customer){
            $customer->delete();
            return response()->json($this->dataSuccess);
        }
        return response()->json($this->dataError,404);
    }
}
<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\ManufacturerResource;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Queue\ManuallyFailedException;

class ManufacturerController extends Controller
{

    
    public $dataError = [
        "data" => null,
        "error" => "manufacturer not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "manufacturer deleted successfully !",
    ];


    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/manufacturer",
     *   summary="All manufacturers",
     *   description="This route returns all manufacturers",
     *   tags={"Manufacturer"},
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
        return ManufacturerResource::collection(Manufacturer::all());
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
            'country'=>['required']
        ]);
        $manufacturer = new Manufacturer();
        $manufacturer->name = $request->name;
        $manufacturer->country  = $request->country;
        $manufacturer->save();
        return response()->json(new ManufacturerResource($manufacturer),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show($manufacturer)
    {
        $manufacturerFind = Manufacturer::find($manufacturer);
        if($manufacturerFind){
            return response()->json(new ManufacturerResource($manufacturerFind),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$manufacturer)
    {
        $manufacturerFind = Manufacturer::find($manufacturer);
        if($manufacturerFind){
            $request->validate([
                'name'=>['required'],
                'country'=>['required']
            ]);
            $manufacturerFind->name = $request->name;
            $manufacturerFind->country  = $request->country;
            $manufacturerFind->save();
            return response()->json(new ManufacturerResource($manufacturerFind),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy($manufacturer)
    {
        $manufacturerFind = Manufacturer::find($manufacturer);
        if($manufacturerFind){
            $manufacturerFind->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}
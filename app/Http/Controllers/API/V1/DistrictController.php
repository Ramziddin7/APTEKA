<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\DistrictResource;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{

    public $dataError = [
        "data" => null,
        "error" => "District not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "District deleted successfully !",
    ];


    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/district",
     *   summary="All districts",
     *   description="This route returns all districts",
     *   tags={"District"},
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
        return DistrictResource::collection(District::all());
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
            'region_id'=>['required','exists:regions,id']
        ]);
        $district = District::create($request->all());

        return response()->json(new DistrictResource($district),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show($district)
    {
        $district = District::find($district);
        if($district){
            return response()->json(new DistrictResource($district),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$district)
    {
        $district = District::find($district);
        if($district){
            $request->validate([
                'name'=>['required'],
                'region_id'=>['required','exists:regions,id']
            ]);

            $district = new District();
            $district->name = $request->name;
            $district->region_id = $request->region_id;
            $district->save();
            return response()->json(new DistrictResource($district),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy($district)
    {
        $district = District::find($district);
        if($district){
            $district->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}
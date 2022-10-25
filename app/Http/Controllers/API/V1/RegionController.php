<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\RegionResource;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{

    public $dataError = [
        "data" => null,
        "error" => "Region not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "Region deleted successfully !",
    ];

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/region",
     *   summary="All regions",
     *   description="This route returns all regiones",
     *   tags={"Region"},
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
        return RegionResource::collection(Region::all());
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
            'name'=>['required']
        ]);

        $region = new Region();
        $region->name = $request->name;
        $region->save();
        return response()->json(new RegionResource($region),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show($region)
    {
        $region = Region::find($region);
        if($region){
            return response()->json(new RegionResource($region),200);
        }
        return response()->json($this->dataError,404);

    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$region)
    {
        $region = Region::find($region);
        if($region){
            
        $request->validate([
            'name'=>['required']
        ]);
        $region->name = $request->name;
        $region->save();
        return response()->json(new RegionResource($region),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy($region)
    {
        $region = Region::find($region);
        if($region){
            $region->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}
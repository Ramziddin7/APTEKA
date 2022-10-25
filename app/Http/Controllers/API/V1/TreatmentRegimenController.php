<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\TreatmentRegimenResource;
use App\Models\TreatmentRegimen;
use Database\Seeders\TreatmentRegimenSeeder;
use Illuminate\Http\Request;

class TreatmentRegimenController extends Controller
{

    
    public $dataError = [
        "data" => null,
        "error" => "Treatment Regimen not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "Treatment Regimen deleted successfully !",
    ];


    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/treatmentregimen",
     *   summary="All treatment regimens",
     *   description="This route returns all treatment regimens",
     *   tags={"Treatment regimen"},
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
        return TreatmentRegimenResource::collection(TreatmentRegimen::all());
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
            'customer_id'=>['required','exists:customers,id'],
            'user_id'=>['required','exists:users,id'],
            'note'=>['required']
        ]);
        $a = new  TreatmentRegimen();
        $a->user_id = $request->user_id;
        $a->customer_id =$request->customer_id;
        $a->note =$request->note;
        $a->save();
        return response()->json(new TreatmentRegimenResource($a),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\TreatmentRegimen  $treatmentRegimen
     * @return \Illuminate\Http\Response
     */
    public function show($treatmentRegimen)
    {
        $treatmentRegimen = TreatmentRegimen::find($treatmentRegimen);
        if($treatmentRegimen){
            return response()->json(new TreatmentRegimenResource($treatmentRegimen),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TreatmentRegimen  $treatmentRegimen
     * @return \Illuminate\Http\Response
     */
    public function edit($treatmentRegimen)
    {
        // 
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TreatmentRegimen  $treatmentRegimen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$treatmentRegimen)
    {
        $find = TreatmentRegimen::find($treatmentRegimen);
        if($find){
            $request->validate([
                'customer_id'=>['required','exists:customers,id'],
                'user_id'=>['required','exists:users,id'],
                'note'=>['required']
            ]);
            $find->user_id = $request->user_id;
            $find->customer_id =$request->customer_id;
            $find->note =$request->note;
            $find->save();
            return response()->json(new TreatmentRegimenResource($find),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreatmentRegimen  $treatmentRegimen
     * @return \Illuminate\Http\Response
     */
    public function destroy($treatmentRegimen)
    {
        $find = TreatmentRegimen::find($treatmentRegimen);
        if($find){
            $find->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}
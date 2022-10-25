<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    public $dataError = [
        "data" => null,
        "error" => "Organization not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "Organization deleted successfully !",
    ];

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/organization",
     *   summary="All organizations",
     *   description="This route returns all organizations",
     *   tags={"Organization"},
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
        return OrganizationResource::collection(Organization::all());
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
            'full_name'=>['required'],
            'address'=>['required'],
            'phone'=>['required'],
            'district_id'=>['required','exists:districts,id'],
        ]);

        $organization = new Organization();
        $organization->name = $request->name;
        $organization->full_name = $request->full_name;
        $organization->address = $request->address;
        $organization->phone = $request->phone;
        $organization->district_id = $request->district_id;
        $organization->save();
        return response()->json(new OrganizationResource($organization),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show($organization)
    {
        $organization = Organization::find($organization);
        if($organization){
            return response()->json(new OrganizationResource($organization),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$organization)
    {
        $organization = Organization::find($organization);
        if($organization){
            $request->validate([
                'name'=>['required'],
                'full_name'=>['required'],
                'address'=>['required'],
                'phone'=>['required'],
                'district_id'=>['required','exists:districts,id'],
            ]);
    
            $organization->name = $request->name;
            $organization->full_name = $request->full_name;
            $organization->address = $request->address;
            $organization->phone = $request->phone;
            $organization->district_id = $request->district_id;
            $organization->save();
            return response()->json(new OrganizationResource($organization),200);
      }
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy($organization)
    {
        $organization = Organization::find($organization);
        if($organization){
            $organization->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}
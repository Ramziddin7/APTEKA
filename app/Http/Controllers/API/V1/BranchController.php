<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\BranchResource;
use App\Models\Branch;
use Illuminate\Http\Request;



class BranchController extends Controller
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
     *   path="/api/v1/branch",
     *   summary="All branches",
     *   description="This route returns all branches",
     *   tags={"Branch"},
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
        return BranchResource::collection(Branch::all());
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


        /**  @OA\Post(
        * path="/api/v1/branch",
        * summary="Add to branch",
        * description="Add a branch",
        * operationId="addToCart",
        * tags={"Branch"},
        * @OA\RequestBody(
        *    required=true,
        *    description="Add to cart",
         *    @OA\JsonContent(
        *       @OA\Property(property="name", type="string", example="Branch name"),
        *       @OA\Property(property="address", type="text", example="Branch Address Example"),
        *       @OA\Property(property="description", type="text", example="Branch description"),
        *        )
        *     )
        * ),
        * @OA\Response(
        *    response=200,
        *    description="Success",
        *    response=401,
        *    description="Validation Error",
        * )
        */

    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required'],
            'address'=>['required'],
            'description'=>['required']
        ]);
        $branch = Branch::create($request->all());

        return response()->json( new BranchResource($branch),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show($branch)
    {
        $branchFind = Branch::find($branch);
        if($branchFind){
            return response()->json(new BranchResource($branchFind),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        //
    }
    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$branch)
    {
        $branch = Branch::find($branch);
        if($branch){
            $request->validate([
                'name'=>['required'],
                'address'=>['required'],
                'description'=>['required']
            ]);

            $branch->name = $request->name;
            $branch->description = $request->description;
            $branch->address = $request->address;
            $branch->save();
            return response()->json(new BranchResource($branch),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($branch)
    {
        $branch = Branch::find($branch);
        if($branch){
            $branch->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}
<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public $dataError = [
        "data" => null,
        "error" => "Role not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "Role deleted successfully !",
    ];

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/role",
     *   summary="All roles",
     *   description="This route returns all roles",
     *   tags={"Role"},
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
        return RoleResource::collection(Role::all());
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

        $role = new Role();
        $role->name = $request->name;
        $role->save();
        return response()->json(new RoleResource($role),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($role)
    {
        $role = Role::find($role);
        if($role){
        return response()->json(new RoleResource($role),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$role)
    {
        $role = Role::find($role);
        if($role){
            $request->validate([
                'name'=>['required']
            ]);
            $role->name = $request->name;
            $role->save();
            return response()->json(new RoleResource($role),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($role)
    {
        $role = Role::find($role);
        if($role){
            $role->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}
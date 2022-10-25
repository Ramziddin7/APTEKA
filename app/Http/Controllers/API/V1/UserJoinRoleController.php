<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\UserJoinRoleResource;
use App\Models\UserJoinRole;
use Illuminate\Http\Request;

class UserJoinRoleController extends Controller
{

    
    
    public $dataError = [
        "data" => null,
        "error" => "User Join Role data not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "User Join Role data deleted successfully !",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserJoinRoleResource::collection(UserJoinRole::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id'=>['required','exists:roles,id'],
            'user_id'=>['required','exists:users,id']
        ]);

        $a = new  UserJoinRole();
        $a->user_id = $request->user_id;
        $a->role_id =$request->role_id;
        $a->save();
        return response()->json(new UserJoinRoleResource($a),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserJoinRole  $userJoinRole
     * @return \Illuminate\Http\Response
     */
    public function show($userJoinRole)
    {
        $userRole = UserJoinRole::find($userJoinRole);
        if($userRole){
            return response()->json(new UserJoinRoleResource($userRole),200);
        }
        return response()->json($this->dataError,404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserJoinRole  $userJoinRole
     * @return \Illuminate\Http\Response
     */
    public function edit(UserJoinRole $userJoinRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserJoinRole  $userJoinRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$userJoinRole)
    {
        $userRole = UserJoinRole::find($userJoinRole);
        if($userRole){
        $userRole = new  UserJoinRole();
        $userRole->user_id = $request->user_id;
        $userRole->role_id =$request->role_id;
        $userRole->save();
        return response()->json(new UserJoinRoleResource($userRole),200);
        }
        return response()->json($this->dataError,404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserJoinRole  $userJoinRole
     * @return \Illuminate\Http\Response
     */
    public function destroy($userJoinRole)
    {
        $userRole = UserJoinRole::find($userJoinRole);
        if($userRole){
            $userRole->delete();
            return response()->json($this->dataSuccess);
        }
        return response()->json($this->dataError,404);
    }
}

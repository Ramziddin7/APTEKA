<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'branch'=>$this->branch,
            'user'=>$this->user,
            'status'=>$this->status,
            'total_price'=>$this->total_price,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}

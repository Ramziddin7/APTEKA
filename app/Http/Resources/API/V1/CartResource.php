<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'order'=>$this->order,
            'product'=>$this->product,
            'quantity'=>$this->quantity,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}

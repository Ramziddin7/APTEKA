<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentRegimenResource extends JsonResource
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
            'customer'=>$this->customer,
            'user'=>$this->user,
            'note'=>$this->note,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}

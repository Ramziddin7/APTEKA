<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
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
            'name'=>$this->name,
            'full_name'=>$this->full_name,
            'address'=>$this->address,
            'phone'=>$this->phone,
            'district'=>$this->district,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}

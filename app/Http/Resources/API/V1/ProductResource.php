<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'global_name'=>$this->global_name,
            'manufacturer'=>$this->manufacturer,
            'unit'=>$this->unit,
            'mandatory_assortment'=>$this->mandatory_assortment,
            'barcode'=>$this->barcode,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}

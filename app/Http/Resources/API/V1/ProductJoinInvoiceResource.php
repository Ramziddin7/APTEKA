<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductJoinInvoiceResource extends JsonResource
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
            'product'=>$this->product,
            'invoice'=>$this->invoice,
            'series'=>$this->series,
            'deaedline'=>$this->deaedline,
            'amount'=>$this->amount,
            'base_price'=>$this->base_price,
            'base_price_percent'=>$this->base_price_percent,
            'trade_discount'=>$this->trade_discount,
            'delivery_cost'=>$this->delivery_cost,
            'vat'=>$this->vat,
            'certificate'=>$this->certificate,
            'price'=>$this->price,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}

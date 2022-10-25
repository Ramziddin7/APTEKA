<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
         'id'=>$this->id,
        'organization'=>$this->organization,
        'invoice_number'=>$this->invoice_number,
        'invoice_date'=>$this->invoice_date,
        'accept_by'=>$this->accept_by,
        'payment_type'=>$this->payment_type,
        'total_price'=>$this->total_price,
        'updated_at'=>$this->updated_at,
        'created_at'=>$this->created_at
        ];
    }
}

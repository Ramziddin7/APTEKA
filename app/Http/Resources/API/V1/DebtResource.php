<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class DebtResource extends JsonResource
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
            'order'=>$this->order,
            'customer'=>$this->customer,
            'deadline'=>$this->deadline,
            'notification_number'=>$this->notification_number,
            'status'=>$this->status,
            'user'=>$this->user,
            'paid_ammount'=>$this->paid_ammount,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}

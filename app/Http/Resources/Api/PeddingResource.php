<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PendingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'number'=>$this->order->number,
            'amount'=>$this->amount,
           'type'=>$this->order->type,
           'name'=>$this->customer->name,
            'vendorName'=>$this->vendor->name,
            'phone'=>$this->customer->phone,
            'date'=> $this->CreatedText,


        ];
    }
}

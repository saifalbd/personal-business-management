<?php

namespace App\Http\Resources\report;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderReportResource extends JsonResource
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
            '_uid'=>$this->id,
            'orderNumber'=>$this->order->number,
            'amount'=>$this->amount,
            'profit'=>$this->profit,
            'vendorName'=>$this->vendor->name,
            'date'=>$this->CreatedText,
            
        ];
    }
}

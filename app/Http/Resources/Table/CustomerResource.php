<?php

namespace App\Http\Resources\Table;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'phoneNumber'=>$this->phone,
            'name'=>$this->name,
            'tariffName'=>$this->tariff->name,
            'orderCount'=>$this->orders->count(),
            'paymentCount'=>$this->payments->count(),
            'paymentSum'=>$this->payments->sum('amount'),
            'show'=>['url'=>route('customer.show',$this->id),'txt'=>'show'],
        ];
    }
}

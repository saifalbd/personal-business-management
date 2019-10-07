<?php

namespace App\Http\Resources\Customer\Table;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersRelationCustomerResource extends JsonResource
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
            'customerName'=>$this->name,
            'phoneNumber'=>$this->phone,
            'count'=>$this->payments_count,
        ];
    }
}

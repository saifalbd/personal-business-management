<?php

namespace App\Http\Resources\Customer\Table;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersRelationResource extends JsonResource
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
'orderNumber'=>$this->number,
'orderType'=>$this->type,
'customers'=>$this->customers->list->toArray()

        ];
    }
}

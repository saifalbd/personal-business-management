<?php

namespace App\Http\Resources\Table;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
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
            'localRate'=>$this->from,
            'foreignMoney'=>$this->to,
            'foreignWithFee'=>$this->withCharge,
            'exRate'=>$this->CustomerRate,
            'fee'=>($this->to*0.02),
            'editUrl'=>route('rate.edit',['id'=>$this->id]),
            'removeUrl'=>route('rate.remove',['id'=>$this->id]),
        ];
    }
}

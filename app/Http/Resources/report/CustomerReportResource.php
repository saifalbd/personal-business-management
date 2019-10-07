<?php

namespace App\Http\Resources\report;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerReportResource extends JsonResource
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
            'phone'=>$this->phone,
            'name'=>$this->name,
            'amount'=>$this->amount,
            'profit'=>round($this->profit,2),
            'bill'=>$this->bill,

        ];
    }
}

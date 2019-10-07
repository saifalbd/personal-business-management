<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DueResource extends JsonResource
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
            'amount'=>$this->amount,
            'type'=>$this->repayable->type,
            'active'=>$this->active,
            'comment'=>$this->commentTxt,
            'date'=>$this->CreatedText,
            'pushUrl'=>route('invoice.pull',['type'=>'customer','payId'=>$this->id,'id'=>$this->repayable->customer->id])

        ];
    }
}

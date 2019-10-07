<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditPayment extends JsonResource
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
            'active'=>$this->active,
            'comment'=>$this->CommentTxt,
            'date'=>$this->CreatedText,

            'pullUrl'=>route('invoice.pull',['type'=>'vendor','payId'=>$this->id,'id'=>$this->vendor->id])

        ];
    }
}

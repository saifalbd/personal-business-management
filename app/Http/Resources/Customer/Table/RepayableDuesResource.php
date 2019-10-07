<?php

namespace App\Http\Resources\Customer\Table;

use function date_format;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepayableDuesResource extends JsonResource
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
            'dueAmount'=>$this->amount,
            'dueType'=>$this->type,
            'commentTxt'=>$this->payment->commentTxt,
            'date'=> date_format(date_create($this->created_at),"d M h:iA"),
            'invoiceStatus'=>$this->payment->customerStatusInInvoice,
            'pushUrl'=>route('invoice.push',['type'=>'customer','payId'=>$this->payment->id,'id'=>$this->customer->id])


        ];
    }
}

<?php

namespace App\Http\Resources\Customer\Table;

use function date_format;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPaymentsResource extends JsonResource
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
            'vendorName'=>$this->vendor->name, //??null,
            'date'=> date_format(date_create($this->created_at),"d M h:iA"),
            'invoiceStatus'=>$this->customerStatusInInvoice,
            'pushUrl'=>route('invoice.push',['type'=>'customer','payId'=>$this->id,'id'=>$this->customer->id])
        ];
    }
}

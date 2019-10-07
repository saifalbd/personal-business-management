<?php

namespace App\Http\Resources\Vendor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditPaymentResource extends JsonResource
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
            'comment'=>$this->CommentTxt,
            'vendorName'=>$this->vendor->name,
            'invoiceStatus'=>$this->vendorStatusInInvoice,
            'date'=>$this->CreatedText,
            'pushUrl'=>route('invoice.push',['type'=>'vendor','payId'=>$this->id,'id'=>$this->vendor->id])


        ];
    }
}

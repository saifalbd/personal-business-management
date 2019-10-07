<?php

namespace App\Http\Resources\Table;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
//use 
class PendingResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return  [
            'id'=>$this->id,
            'number'=>$this->order->number,
            'amount'=>$this->amount,
            'bill'=>$this->bill,
            'type'=>$this->order->type,
            'commentTxt'=>$this->commentTxt,
            'createdTxt'=>$this->CreatedText,
            'vendor'=>$this->vendor->name,
            'customer'=>$this->customer->name,
             'phone'=>$this->customer->phone,
            'date'=>$this->CreatedText,
          
            
            'dropdown'=>[

                ['url'=>route('changeEdit.editBill',['payId'=>$this->id]),'txt'=>'edit Bill'],
                ['url'=>route('changeEdit.editAmount',['payId'=>$this->id]),'txt'=>'edit Amount'],
                ['url'=>route('changeEdit.changeOrder',['payId'=>$this->id]),'txt'=>'change Order'],
                ['url'=>route('changeEdit.editOrder',['orderId'=>$this->order->id]),'txt'=>'edit Order'],
                ['url'=>route('changeEdit.changeVendor',['payId'=>$this->id]),'txt'=>'change Vendor'],
                ['url'=>route('changeEdit.changeCustomer',['payId'=>$this->id]),'txt'=>'change Customer'],
                ['url'=>route('payment.removeConfirm',['id'=>$this->id]),'txt'=>'remove Payment'],
            ],

        ];
    }

}

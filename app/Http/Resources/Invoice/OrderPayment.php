<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPayment extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $parent = $this->invoice[0]->parent;



        $result = [

            '_uid'=>$this->id,
            'profit'=>$this->id,
            'amount'=>$this->amount,
            'active'=>$this->active,
            'bill'=>$this->bill,
            'orderNumber'=>$this->order->number,
            'comment'=>$this->commentTxt,
            'date'=>$this->CreatedText,];

        if ($parent){
            $result['pullUrl'] = route('invoice.pull',
                ['type'=>$parent['type'],'payId'=>$this->id,
                    'id'=>$parent['parent_id']]);
        }else{
            $result['pullUrl'] = null;
        }

        return $result;
    }
}

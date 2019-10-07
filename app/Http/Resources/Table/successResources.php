<?php

namespace App\Http\Resources\Table;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class successResources extends JsonResource
{


    /**
     * use App\Http\Resources\Table\successResources;
     */
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
            'type'=>$this->order->type,
            'commentTxt'=>$this->commentTxt,
            'createdTxt'=>$this->CreatedText,
            'vendor'=>$this->vendor->name,
            'customer'=>$this->customer->name,
            'date'=>$this->CreatedText,

        ];
    }



}

<?php

namespace App\Http\Resources\report;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditReportResource extends JsonResource
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
            'date'=>$this->CreatedText

        ];
    }
}

<?php

namespace App\Http\Resources\Table;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class creditDebitForAdd extends JsonResource
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
            'date'=>$this->CreatedText,
        ];
    }
}

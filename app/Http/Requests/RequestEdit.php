<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestEdit extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [

"payment_id" =>'required|integer',
"customer_id" =>'required|integer',
"vendor_id" =>'required|integer',
"order_id" =>'required|integer',
"vendorGroup" =>'nullable',
"vendor" =>'required|integer',
"orderGroup" =>'nullable',
"type" =>'required',
"number" =>'required|confirmed',
"paymentGroup" =>'nullable',
"amount" =>'required|integer|confirmed',
"customerGroup" =>'nullable',
"senderId" =>'required|integer',

        ];
    }
}

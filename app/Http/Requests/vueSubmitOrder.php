<?php

namespace App\Http\Requests;

use App\Http\Helper\CustomValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class vueSubmitOrder extends FormRequest
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
            'customerId'=>['required','numeric'],
            'vendorId'=>['required','numeric'],
            'orderId'=>['required','numeric'],
            'amount'=>['required','numeric'],
            'bill'=>['required','numeric'],
            'comment'=>['sometimes','string']
        ];
    }
    public function messages()
    {
        $m = new CustomValidateMessage();
        return [
            'customerId.required' => $m->required('customerId'),
            'customerId.numeric' => $m->numeric('customerId'),
            'orderId.required' => $m->required('orderId'),
            'orderId.numeric' => $m->numeric('orderId'),
            'amount.required' => $m->required('amount'),
            'amount.numeric' => $m->numeric('amount'),
            'bill.required' => $m->required('bill'),
            'bill.numeric' => $m->numeric('bill'),
            'comment.string'=>$m->numeric('comment'),

        ];
    }
}

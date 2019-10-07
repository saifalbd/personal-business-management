<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helper\CustomValidateMessage;


class PaymentEdit extends FormRequest
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
            'paymentID'=>'required|integer',
            'vendorID'=>'required|integer',
            'oldAmount'=>'required|integer',
            'newAmount'=>'required|integer',
            'customerBill'=>'required|integer'
        ];
    }

public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'paymentID.required' => $m->required('payment id'),
        'vendorID.required' => $m->required('vendor id'),
        'oldAmount.required' => $m->required('old amount'),
        'newAmount.required' => $m->required('new amount'),
        'customerBill.required' => $m->required('customer Bill'),
        'paymentID.integer' => $m->integer('payment id'),
        'vendorID.integer' => $m->integer('vendor id'),
        'oldAmount.integer' => $m->integer('old amount'),
        'newAmount.integer' => $m->integer('new amount'),
        'customerBill.integer' => $m->integer('customer Bill'),
      
           
    ];
}

}

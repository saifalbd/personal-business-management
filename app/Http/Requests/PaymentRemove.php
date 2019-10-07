<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helper\CustomValidateMessage;

class PaymentRemove extends FormRequest
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
'paymentType'=> ["required" , "in:orderPayment,vendorPayment"],
'customerName'=>'required|exists:customers,name',
'customerNumber'=>'required|integer|exists:customers,phone',
'amount'=>'required|integer',
'comment'=> 'required|max:150',
        ];
    }
public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'paymentType.required' => $m->required('payment Type'),
        'customerName.required' => $m->required('customer Name'),
        'customerNumber.required' => $m->required('customer Phone'),
        'amount.required' => $m->required('new amount'),
        'comment.required' => $m->required('comment'),
        'paymentID.integer' => $m->integer('payment id'),
        'vendorID.integer' => $m->integer('vendor id'),
        'oldAmount.integer' => $m->integer('old amount'),
        'newAmount.integer' => $m->integer('new amount'),
        'customerBill.integer' => $m->integer('customer Bill'),
      
           
    ];
}

}
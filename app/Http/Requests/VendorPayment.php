<?php

namespace App\Http\Requests;

use App\Http\Helper\CustomValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class VendorPayment extends FormRequest
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
         'amount' => 'required|integer|max:150000',
         'amountType' => ["required" , "max:50", "in:prepaid,return"] , //prepaid or return
        'paymentType' => ["required" , "max:50", "in:credit,debit"], //cradit or dabit
        'paymentType' => ["required" , "max:50", "in:credit,debit"], //cradit or dabit
        'date'=>'required|date',
        'description' => 'required|max:50',
        ];
    }

public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'amount.required' => $m->required('amount'),
        'amount.integer' => $m->integer('amount'),
        'amount.max' => $m->required('amount 150000'),

        'amountType.required' => $m->required('amount Type'),
        'amountType.max' => $m->required('amount Type'),
        'amountType.in' => $m->in('amount Type','value must be prepaid or return'),

        'paymentType.required' => $m->required('payment Type'),
        'paymentType.max' => $m->max('payment Type'),
        'paymentType.in' => $m->required('payment Type','value must be credit or debit'),

        
        'date.required' => $m->required('Date'),
        'date.date' => $m->date('Date'),
        'description.required' => $m->required('description'),
        'description.max' => $m->max('description 50'),
      
      
           
    ];
}
}

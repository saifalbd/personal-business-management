<?php

namespace App\Http\Requests\ChangeEdit;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helper\CustomValidateMessage;

class changeCustomer extends FormRequest
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
            'customerChange'=>'required',
            'paymentID'=>'required|integer',
            'oldCustomerID'=>'required|integer',
            'newCustomerID'=>'required|integer'
        ];
    }
public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'paymentID.required' => $m->required('payment id'),
        'customerChange.required' => $m->required('checkbox'),
        'oldCustomerID.required' => $m->required('old Customer id'),
        'newCustomerID.required' => $m->required('new Customer id'),
        'paymentID.integer' => $m->integer('payment id'),
        'oldCustomerID.integer' => $m->integer('old Customer id'),
        'newCustomerID.integer' => $m->integer('new Customer id'),
     
      
           
    ];
}


}
<?php

namespace App\Http\Requests\ChangeEdit;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helper\CustomValidateMessage;

class editCustomer extends FormRequest
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
        'customerEdit' => 'required',
        'customerID' => 'required|integer',
        'customerName' => 'required',
        'customerPhone' => 'required|integer',
        'city' => 'sometimes|nullable|string',
            'tariffId'=>'required|integer',
        'customerNameConfrim' => 'sometimes|nullable',
        'customerPhoneConfrim' => 'sometimes|nullable',
            'customerCityConfrim' => 'sometimes|nullable',
            'customerTariffConfrim' => 'sometimes|nullable',

        'comment'=>'required|string'

        ];
    }

public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'customerEdit.required' => $m->required('customer Edit CheckBox'),
        'customerName.required' => $m->required('customer Name'),
        'customerPhone.required' => $m->required('customer Phone'),
        'customerID.required' => $m->required('Customer id'),
        'customerID.integer' => $m->integer('Customer id'),
        'comment.required' => $m->required('comment'),
        'comment.string' => $m->string('comment'),
       
     
      
           
    ];
}

 
}

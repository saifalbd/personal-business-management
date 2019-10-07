<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helper\CustomValidateMessage;

class CustomerCreate extends FormRequest
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
        'customerName' => 'required|max:30',
        'customerPhone' => 'required|unique:customers,phone|max:50',
         'cityName' =>['required','string'],
          'tariffId' =>['required','integer'],
        'description' => 'sometimes|nullable|max:50',
        ];
    }

public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'customerName.required' => $m->required('customer Name'),
        'customerPhone.unique' => $m->unique('customer Phone'),
        'customerPhone.required' => $m->required('customer Phone'),
      
           
    ];
}
}

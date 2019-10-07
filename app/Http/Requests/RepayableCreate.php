<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helper\CustomValidateMessage;

class RepayableCreate extends FormRequest
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
            "type" =>'required',
            "customer_id" =>'required|integer',
            
            "due" =>'required_without_all:due,payment|sometimes|nullable|integer',
            "payment" =>'required_without_all:due,payment|sometimes|nullable|integer',
             'comment' => 'sometimes|nullable|max:50',
            
        ];
    }

public function messages()
{
  $m = new CustomValidateMessage();


    return [
        'type.required' => $m->required('type'),
        'type.string' => $m->string('payment type'),
        'customer_id.required' =>$m->string('customer id'),
       
        'due.required_without_all'=>'A due or payment are required',
      'due.integer'=>$m->integer('due'),
        'payment.required_without_all'=>'A due or payment are required',
        'payment.integer'=>$m->integer('payment'),
         
    ];

}

}

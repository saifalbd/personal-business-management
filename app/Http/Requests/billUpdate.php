<?php

namespace App\Http\Requests;

use App\Http\Helper\CustomValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class billUpdate extends FormRequest
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
            'paymentId'=>'required|integer',
            'oldBill'=>'required|integer',
            'newBill'=>'required|integer'
        ];
    }
    public function messages()
    {
        $m = new CustomValidateMessage();
        return [
            'paymentId.required' => $m->required('payment id'),
            'paymentId.integer' => $m->integer('payment id'),
            'oldBill.required' => $m->required('oldBill id'),
            'oldBill.integer' => $m->integer('oldBill id'),
            'newBill.required' => $m->required('newBill id'),
            'newBill.integer' => $m->integer('newBill id'),



        ];
    }
}

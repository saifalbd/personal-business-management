<?php

namespace App\Http\Requests\Api;

use App\Http\Helper\CustomValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class orderFind extends FormRequest
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
            'phone'=>'required|numeric',
            'number'=>'required|numeric',
            'amount'=>'required|numeric'
        ];
    }
    public function messages()
    {
        $m = new CustomValidateMessage();
        return [
            'phone.required' => $m->required('Phone'),
            'phone.numeric' => $m->numeric('Phone'),
            'number.required' => $m->required('number'),
            'number.numeric' => $m->numeric('number'),
            'amount.required' => $m->required('amount'),
            'amount.numeric' => $m->numeric('amount'),
        ];
    }
}

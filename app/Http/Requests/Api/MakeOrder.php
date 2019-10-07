<?php

namespace App\Http\Requests\Api;

use App\Http\Helper\CustomValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class MakeOrder extends FormRequest
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
            'type'=>'required|string',
            'number'=>'required|numeric'
        ];
    }
    public function messages()
    {
        $m = new CustomValidateMessage();
        return [
            'type.required' => $m->required('type'),
            'type.string' => $m->string('type'),
            'number.required' => $m->required('number'),
            'number.numeric' => $m->numeric('number'),
        ];
    }


}

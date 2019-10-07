<?php

namespace App\Http\Requests\Api;

use App\Http\Helper\CustomValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class MakeCustomer extends FormRequest
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
            'name'=>'required|string',
            'phone'=>'required|numeric'
        ];
    }
    public function messages()
    {
        $m = new CustomValidateMessage();
        return [
            'name.required' => $m->required('name'),
            'name.string' => $m->string('name'),
            'phone.required' => $m->required('phone'),
            'phone.numeric' => $m->numeric('phone'),
        ];
    }



}

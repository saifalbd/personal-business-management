<?php

namespace App\Http\Requests;

use App\Http\Helper\CustomValidateMessage;
use Illuminate\Foundation\Http\FormRequest;


class CurrentBankRateCreate extends FormRequest
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
        $m = new CustomValidateMessage();
        return [
            'bankRate'=>'required|integer'
        ];
    }

public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'bankRate.required' => $m->required('bank Rate'),
        'bankRate.integer' => $m->integer('bank Rate'),
      
           
    ];
}
}

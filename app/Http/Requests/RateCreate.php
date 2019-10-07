<?php

namespace App\Http\Requests;

use App\Http\Helper\CustomValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class RateCreate extends FormRequest
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
            //"fromRate" =>'required|integer|unique:rates,from',
           // "toRate" =>'required|integer|unique:rates,to',
            "fromRate" =>'required|integer',
            "toRate" =>'required|integer',
        ];
    }

public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'fromRate.required' => $m->required('from Rate'),
        'fromRate.integer' => $m->integer('from Rate'),
        'fromRate.unique' => $m->unique('from Rate'),
        'toRate.required' => $m->required('To Rate'),
        'toRate.integer' => $m->integer('To Rate'),
        'toRate.unique' => $m->unique('To Rate'),
           
    ];
}
}

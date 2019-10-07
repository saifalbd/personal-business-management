<?php

namespace App\Http\Requests\Api;

use App\Http\Helper\CustomValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class PendingFinder extends FormRequest
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
            'date'=>'sometimes|nullable|date',
            'vendorid'=>'sometimes|nullable|numeric'
        ];
    }

public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'bankRate.date' => $m->required('select Date'),
        'vendorid.numeric' => $m->numeric('select Vendor value'),
      
           
    ];
}
}

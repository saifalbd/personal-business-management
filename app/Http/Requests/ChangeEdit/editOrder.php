<?php

namespace App\Http\Requests\ChangeEdit;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helper\CustomValidateMessage;

class editOrder extends FormRequest
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

            "orderEdit" => 'required',
            "number" =>'sometimes|nullable',
            "oldNumber" =>'required',
            "type" => 'required|string',
            "comment" => 'required|string',
            "numberConfirm" =>'sometimes|nullable',
            "typeConfirm" => 'sometimes|nullable',
        ];
    }

    public function messages()
    {
        $m = new CustomValidateMessage();
        return [
            'orderEdit.required' => $m->required('order Edit CheckBox'),
            'number.required' => $m->required('number'),
            'oldNumber.required' => $m->required('number'),
            'type.required' => $m->required('order type'),
            'comment.required' => $m->required('comment'),
            'comment.string' => $m->string('comment'),




        ];
    }

}

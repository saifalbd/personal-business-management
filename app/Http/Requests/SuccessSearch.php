<?php

namespace App\Http\Requests;

use App\Http\Helper\CustomValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class SuccessSearch extends FormRequest
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
             'fromDate'=>'sometimes|nullable|date',
             'toDate'=>'sometimes|nullable|date',
            'vendorid'=>'sometimes|nullable|max:5|integer'
        ];
    }
public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'fromDate.date' => $m->date('from Date'),
        'toDate.date' => $m->date('To Date'),
        'vendorid.integer' => $m->integer('Vendor Id'),
           
    ];
}
}

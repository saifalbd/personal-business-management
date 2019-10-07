<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helper\CustomValidateMessage;

class RequestCreate extends FormRequest
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
            'vendor'=>'required|integer',
            'type'=>'required|max:15',
            'number'=>'required|numeric|digits_between:11,12',
            'amount'=>'required|integer',
            'senderName'=>'required|string',
            'senderNumber'=>'required|integer',
            'cost'=>'sometimes|nullable|integer',
             'comment' => 'sometimes|nullable|string|max:50',
        ];
    }

public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'vendor.required' => $m->required('vendor id'),
        'vendor.integer' => $m->integer('vendor id'),
        'type.required'  =>  $m->required('Request Type'),
        'number.required'=>  $m->required('Number'),
        'number.numeric'=>  $m->numeric('Number'),
        'number.digits_between'=>  $m->digits_between('Number 11 minimum and 12 maximum'),
        'amount.integer'=>  $m->integer('Amount'),
        'amount.required'=>  $m->required('Amount'),
        'senderName.required'=>$m->required('sender Name'),
        'senderName.string'=>$m->string('sender Name'),
        'senderNumber.required'=>$m->required('sender Number'),
        'comment.string' => $m->string('sender Number'),
        'cost.integer' => $m->integer('customer cost'),
    ];
}
}

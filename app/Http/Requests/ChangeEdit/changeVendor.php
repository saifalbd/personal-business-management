<?php

namespace App\Http\Requests\ChangeEdit;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helper\CustomValidateMessage;

class changeVendor extends FormRequest
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
            'vendorChange'=>'required',
            'paymentID'=>'required|integer|exists:payments,id',
            'customerID'=>'required|integer|exists:customers,id',
            'oldVendorID'=>'required|integer|exists:vendors,id',
            'newVendorID'=>'required|integer|exists:vendors,id',
            'comment'=>'required|string'
        ];
    }
public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'paymentID.required' => $m->required('payment id'),
        'vendorChange.required' => $m->required('checkbox'),
        'oldVendorID.required' => $m->required('old Vendor id'),
        'newVendorID.required' => $m->required('new Vendor id'),
        'paymentID.integer' => $m->integer('payment id'),
        'oldVendorID.integer' => $m->integer('old Vendor id'),
        'newVendorID.integer' => $m->integer('new Vendor id'),
         'comment.required' => $m->required('comment'),
        'comment.string' => $m->string('comment'),
     
      
           
    ];
}
}

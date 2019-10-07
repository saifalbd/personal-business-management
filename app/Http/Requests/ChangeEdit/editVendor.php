<?php

namespace App\Http\Requests\ChangeEdit;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helper\CustomValidateMessage;

class editVendor extends FormRequest
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
        'vendorName' => 'required|max:255',
        'vendorType' => 'required|max:255',
        'vendorRate' => 'required',
        'comment' => 'sometimes|nullable|max:50',
        ];
    }
public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'vendorName.required' => $m->required('payment id'),
        'vendorChange.required' => $m->required('checkbox'),
        'vendorType.required' => $m->required('old Vendor id'),
        'newVendorID.required' => $m->required('new Vendor id'),
        'paymentID.integer' => $m->integer('payment id'),
        'oldVendorID.integer' => $m->integer('old Vendor id'),
        'newVendorID.integer' => $m->integer('new Vendor id'),
     
      
           
    ];
}
}

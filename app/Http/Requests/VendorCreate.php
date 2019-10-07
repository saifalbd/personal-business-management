<?php

namespace App\Http\Requests;

use App\Http\Helper\CustomValidateMessage;
use Illuminate\Foundation\Http\FormRequest;

class VendorCreate extends FormRequest
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
        'vendorName' => 'required|unique:vendors,name|max:255',
        'vendorType' => 'required|string|max:255',
        'vendorRate' => 'required|integer',
        'description' => 'sometimes|nullable|max:50',
        ];
    }

public function messages()
{
    $m = new CustomValidateMessage();
    return [
        'vendorName.required' => $m->required('Vendor Name'),
        'vendorName.unique' => $m->unique('Vendor Name'),
        'vendorName.max' => $m->max('Vendor Name'),

        'vendorType.required' => $m->required('Vendor Type'),
        'vendorType.max' => $m->max('Vendor Type'),
        'vendorType.string' => $m->string('Vendor Type'),

        'vendorRate.required' => $m->required('Vendor Rate'),
        'vendorRate.integer' => $m->integer('Vendor Rate'),
        
        'description.max' => $m->max('description max 50'),
      
        
           
    ];
}
}

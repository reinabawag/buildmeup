<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CustomerRequest extends FormRequest
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
        if (Auth::user()->hasAnyRole('approver')) {
            return [
                
            ];
        }

        return [
            'code'		=> 'max:7',
			'name'  	=> 'bail|required|max:60',
			'addr1' 	=> 'max:50',
			'addr2' 	=> 'max:50',
			'addr3' 	=> 'max:50',
			'addr4' 	=> 'max:50',
			'city'		=> 'max:30',
			'zip'		=> 'max:10',
			'slsman'	=> 'required',
			'vat_code' 	=> 'required|max:6',
			'ewt_code'	=> 'required|max:6',
			'tin_code' 	=> 'required|max:25'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'The customer name field is required.',
            'slsman.required'   => 'The salesman field is required.',
            'tin_code.required' => 'The tax identification number field is required.'
        ];
    }
}

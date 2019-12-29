<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileFormValidation extends FormRequest
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
            'phoneNo' => 'required|regex:/(03)[0-9]{9}/',
            'address_1' => 'required|min:5|max:64',
            'address_2' => 'required|min:5|max:64',
            'city' => 'required|min:2|max:64',
            'zip_code' => 'required|regex:/[0-9]{5}/',
        ];

    }
    public function messages()
    {
        return [
            'phoneNo.required' => 'PhoneNo Is Required',
            'phoneNo.regex' => 'PhoneNo Format Should Be like this 03031234567',

            'address_1.required' => 'Address1 Is Required',
            'address_1.min' => 'Address1 Should Be Atleast 5 Characters',
            'address_1.max' => 'Address1 Should Be not More Than 64 Characters',

            'address_2.required' => 'Address2 Is Required',
            'address_2.min' => 'Address2 Should Be Atleast 5 Characters',
            'address_2.max' => 'Address2 Should Be not More Than 64 Characters',

            'city.required' => 'City Is Required',
            'city.min' => 'City Should Be Atleast 5 Characters',
            'city.max' => 'City Should Be not More Than 64 Characters',

            'zip_code.required' => 'ZipCode Is Required',
            'zip_code.regex' => 'ZipCode Format Should Be like this 39350',
        ];

    }
}

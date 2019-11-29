<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountsChangingRequest extends FormRequest
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
            'name' => 'required|min:5|max:64',
            'phoneNo' => 'required|regex:/(03)[0-9]{9}/',
            'zip_code' => 'required|regex:/[0-9]{5}/',
            'password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:7',             // must be at least 10 characters in length
                'regex:/[a-zA-Z]/',      // must contain at least one lower or uppercase alphabet
                'regex:/[0-9]/',      // must contain at least one digit
            ],
            'confirm_password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name Field Should Not Be Empty',
            'name.min' => 'Name Should Be Atleast 5 Characters',
            'name.max' => 'Name Should Not Be More Than 64 Characters',

            'phoneNo.required' => 'PhoneNo Is Required',
            'phoneNo.regex' => 'PhoneNo Format Should Be like this 03031234567',

            'zip_code.required' => 'ZipCode Is Required',
            'zip_code.regex' => 'ZipCode Format Should Be like this 39350',

            'password.required' => 'Password Field Should Not Be Empty',

            'new_password.required' => 'New Password Field Should Not Be Empty',
            'new_password.min' => 'New Password Should Be Atleast 7 Characters',
            'new_password.regex' => 'New Password Must Contains Atleast One Alphabet or Digit',

            'confirm_password.required' => 'Confirm Password Field Should Not Be Empty',
        ];
    }
}

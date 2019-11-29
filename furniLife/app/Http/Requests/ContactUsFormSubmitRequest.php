<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsFormSubmitRequest extends FormRequest
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
            'title' => 'required|min:5|max:64',
            'message' => 'required|min:10|max:64',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title Field Should Not Be Empty',
            'title.min' => 'Title Should Be Atleast 5 Characters',
            'title.max' => 'Title Should Not Be More Than 64 Characters',

            'message.required' => 'Message Field Should Not Be Empty',
            'message.min' => 'Message Should Be Atleast 5 Characters',
            'message.max' => 'Message Should Not Be More Than 64 Characters',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewSubmitFormRequest extends FormRequest
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
            'star' => 'required|',
            'review' => 'required|min:5|max:128',
        ];
    }

    public function messages()
    {
        return [
            'star.required' => 'Select Stars Within 5 Options',

            'review.required' => 'Review Field is Required',
            'review.min' => 'Review Must Be Atleast 5 Characters',
            'review.max' => 'Review Must Not Be Greater Than 128 Characters'
        ];
    }
}

<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class AdminAddProductFormValidation extends FormRequest
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
        if (Request::isMethod('post'))
        {
            return [
                'title' => 'required|min:6|max:100',
                'price' => 'required',
                'description' => 'required',
                'category' => 'required',
                'product_file' => 'required|image|max:1999',
            ];
        }
        if (Request::isMethod('patch'))
        {
            return [
                'title' => 'required|min:6|max:100',
                'price' => 'required',
                'description' => 'required',
                'category' => 'required',
                'product_file' => 'image|nullable|max:1999',
            ];
        }
    }
}

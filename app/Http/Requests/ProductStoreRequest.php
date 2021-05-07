<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'price' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name is Required.',
            'name.string' => 'The Name must be String.',
            'price.required' => 'The Price is Required.',
            'name.numeric' => 'The Price must be Number.'
        ];
    }
}

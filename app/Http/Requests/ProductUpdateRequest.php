<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'price' => 'nullable|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'The Name must be String',
            'price.numeric' => 'The Price must be Number'
        ];
    }
}

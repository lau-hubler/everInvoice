<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'code' => [
                'required',
                'alpha_num',
                'size:6',
                Rule::unique('products')->ignore($this->product),
            ],
            'name' => 'required|min:3',
            'description' => 'required|min:5',
            'price' => 'required|min:0',
            'category_id' => 'required'
        ];
    }
}

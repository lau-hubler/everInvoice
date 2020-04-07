<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'product_id' => "required|unique:orders,product_id,$this->id,id,invoice_id,$this->invoice_id",
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'product_iva' => 'required|numeric|between:0,1'
        ];
    }
}

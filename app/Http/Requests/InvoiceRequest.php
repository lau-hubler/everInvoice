<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'client_id' => 'required',
            'vendor_id' => 'required|different:client_id',
            'invoice_date' => 'required',
            'delivery_date' => 'exclude_if:status_id,1|after_or_equal:invoice_date|before_or_equal:due_date',
            'due_date' => 'required|after_or_equal:invoice_date',
            'status_id' => 'required'
        ];
    }
}

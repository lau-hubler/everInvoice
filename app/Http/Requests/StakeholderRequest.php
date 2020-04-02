<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StakeholderRequest extends FormRequest
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
            'name' => 'required|min:3',
            'is_company' => 'boolean',
            'surname' => 'nullable|min:3',
            'company' => 'nullable|min:3',
            'document_type_id' => 'required',
            'document' => [
                'required',
                'min:5',
                "unique:stakeholders,document,$this->id,id,document_type_id,$this->document_type_id",
                ],
            'email' => 'required|email',
        ];
    }
}

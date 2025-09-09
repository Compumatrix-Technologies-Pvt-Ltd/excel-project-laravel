<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DeductionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'supplier_id' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric'
        ];
    }

    public function messages()
    {

        return [

            'date.required' => 'Date is required',
            'date.date' => 'Must be a valid date',

            'supplier_id.required' => 'Supplier id is required',

            'type.required' => 'Type is required',

            'amount.required' => 'Amount is required',
            'amount.numeric' => 'Amount must be a numeric value'
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class Transactionrequest extends FormRequest
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
            'trx_date' => 'required|date',
            'trx_no' => 'unique:transactions',
            'ticket_no' => 'required|unique:transactions',
            'supplier_id' => 'required',
            'weight' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'trx_date.required' => 'TRX date is required',
            'trx_date.date' => 'TRX date must be a valid date',

            'ticket_no.required' => 'Ticket number is required',
            'ticket_no.unique' => 'Ticket number must be unique',

            'trx_no.unique' => 'TRX number must be unique',

            'supplier_id.required' => 'Supplier Id is required',

            'weight.required' => 'Weight is required',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Suppliersrequest extends FormRequest
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
    public function rules()
    {
        return [
            'prefix' => 'required|string|max:5',
            'supplier_name' => 'required|string',
            'address1' => 'required|string',
            'mpob_lic_no' => 'numeric',
            'mpob_exp_date' => 'date',
            'mspo_cert_no' => 'numeric',
            'mspo_exp_date' => 'date',
            'email' => 'required|email|max:255',
            'tel1' => 'max:15',
            'tel2' => 'max:15',
            'bank_id' => 'required|string|max:50',
            'bank_acc_no' => 'required|string|max:50',
        ];
    }

    /**
     * Get the custom error messages for the validator.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'prefix.required' => 'The prefix field is required.',
            'prefix.string' => 'The prefix must be a string.',
            'prefix.max' => 'The prefix cannot be longer than 5 characters.',


            'supplier_name.required' => 'The supplier name is required.',
            'supplier_name.string' => 'The supplier name must be a string.',

            'address1.required' => 'The address 1 is required.',
            'address1.string' => 'The address 1 must be a string.',

            'mpob_lic_no.numeric' => 'The MPOB License No. must be numeric.',

            'mpob_exp_date.date' => 'The MPOB Expiry Date must be a valid date.',

            'mspo_cert_no.numeric' => 'The MSPO Certificate No. must be numeric.',

            'mspo_exp_date.date' => 'The MSPO Expiry Date must be a valid date.',

            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email address cannot be longer than 255 characters.',

            'tel1.max' => 'The telephone 1 cannot be longer than 15 characters.',

            'tel2.max' => 'The telephone 2 cannot be longer than 15 characters.',

            'bank_id.required' => 'The bank ID is required.',
            'bank_id.string' => 'The bank ID must be a string.',
            'bank_id.max' => 'The bank ID cannot be longer than 50 characters.',

            'bank_acc_no.required' => 'The bank account number is required.',
            'bank_acc_no.string' => 'The bank account number must be a string.',
            'bank_acc_no.max' => 'The bank account number cannot be longer than 50 characters.',

        ];
    }

}

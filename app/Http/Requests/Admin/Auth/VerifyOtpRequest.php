<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
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
            'otp' => 'required|array|size:4', 
            'otp.*' => 'required|digits:1', 
        ];
    }

    public function messages()
    {
        return [
            'otp.required' => 'Please enter the OTP.',
            'otp.array' => 'OTP must consist of 4 digits.',
            'otp.size' => 'OTP must contain exactly 4 digits.',
            'otp.*.required' => 'Each OTP digit is required.',
            'otp.*.digits' => 'Each OTP digit must be a number.',
        ];
    }
}

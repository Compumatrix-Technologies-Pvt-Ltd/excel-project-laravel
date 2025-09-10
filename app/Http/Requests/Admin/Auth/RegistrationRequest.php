<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|numeric|digits_between:7,15',
            'password' => 'regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|min:6|confirmed',
        ];

    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter name.',
            'name.regex' => 'Invalid format, Please enter alphabet only.',
            'name.min' => 'Name should be minimum 3 characters long.',
            'email.required' => 'Please enter email address.',
            'email.email' => 'Email format is invalid.',
            'email.unique' => 'Email has already taken.',
            'mobile_number.required' => 'Please enter mobile number.',
            'mobile_number.numeric' => 'Mobile number must be numeric.',
            'mobile_number.digits_between' => 'Mobile number must be between 7 and 15 digits.',
            'password.min' => 'Password should be minimum 6 characters long',
            'password.required' => 'Please enter password.',
            'password.confirmed' => 'Password and Confirm password should match',
            'password.regex' => 'Please enter alpha numeric with capital letters.',
        ];
    }
}

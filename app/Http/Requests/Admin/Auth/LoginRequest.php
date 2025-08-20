<?php

namespace App\Http\Requests\Admin\Auth;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

   public function rules()
    {       
            return [               
                'email'  => 'required|email',
                'password'  => 'required'
            ];
       
    }

    public function messages()
    {
        return [
            'email.required'  => 'Please enter email address.',
            'email.email'  => 'Email format is invalid.',
            'password.required' => 'Please enter password.',
        ];
    }
}
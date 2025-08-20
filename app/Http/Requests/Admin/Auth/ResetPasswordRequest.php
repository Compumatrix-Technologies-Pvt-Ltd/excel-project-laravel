<?php

namespace App\Http\Requests\Admin\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class ResetPasswordRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

   public function rules(Request $request)
    {       
            return [       
                'password' => 'required|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|min:8',
                'confirm_password' => 'required|same:password',
            ];
       
    }

    public function messages()
    {
        return [            
            'password.min' => 'Password should be minimum 8 characters long.',
            'password.required' =>  'Please enter new password.',
            'confirm_password.required' => 'Please enter confirm password.',
            'confirm_password.same'=> 'Confirm password does not match new password.',   
            'password.regex'  => 'Please enter alpha numeric with capital letters.',
 
        ];
    }
}
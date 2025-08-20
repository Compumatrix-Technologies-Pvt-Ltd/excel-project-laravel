<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        $id = base64_decode(base64_decode(request('h_user_id'))) ?? null;
        if ($id == null) 
        {
            return [
                'name' => 'required|regex:/^[a-zA-Z]+$/u|max:255|min:3',
                'mobile_number'  => 'required|unique:users,mobile_number',
                'email'  => 'required|email|nique:users,email',
            ];
        }
        else
        {
            return [
                'name' => 'required',
                'mobile_number' => 'required|min:7|unique:users,mobile_number,'.$id,
                'email' => 'required|email|unique:users,email,'.$id,
            ];
        }
        
    }

    public function messages()
    {
        return [
            'name.required' => __('Please enter name.'),
            'email.required' => __('Please enter email.'),
            'email.email' => __('Please enter valid email.'),
            'name.regex' => __('Invalid format, Please enter alphabet only.'),
            'name.min' => __('Name should be minimum 3 characters long.'),
            'name.max' => __('Name should be minimum 255 characters long.'),
            'mobile_number.required' => __('Please enter mobile number.'),
            'mobile_number.unique' => __('Mobile number has already taken.'),
            'email.unique' => __('Email has already taken.'),
        ];
    }
}

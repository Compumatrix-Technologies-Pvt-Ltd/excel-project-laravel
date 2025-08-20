<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
//use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class AdminUsersRequest extends FormRequest
{
    //use GeneralTrait;
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
    
        $id = base64_decode(base64_decode($request->hidden_id)) ?? null;
        if ($id == null) 
        {
            return [
                'name'  => 'required',
                'email' => 'required|unique:users,email|max:100',
                'mobile_number'  => 'required|unique:users,mobile_number',
                'department' => 'required',

            ];
        }
        else
        {
            return [
                'name'  => 'required',
                'email' => 'required|unique:users,email,'.$id,
                'mobile_number' => 'required|min:7|unique:users,mobile_number,'.$id,

            ];
        }
    }

    public function messages()
    {
        return [

            'name.required' => 'Please enter name.',
            'email.required' => 'Please enter email.',
            'email.email' => 'Email format is invalid.',
            'mobile_number.unique' => 'mobile number has already taken',
            'email.unique' => 'Email has already taken',
            'department.required' => 'Department is required.',
            'contact_no.required' => 'Please enter mobile number.',
        ]; 
    }
}

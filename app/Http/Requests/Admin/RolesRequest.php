<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RolesRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        $id = base64_decode(base64_decode($request->hidden_id)) ?? null; 
        if ($id === null || $id == "") 
        {
            return [
                'name'=> 'required|regex:/^[A-Za-z0-9 ]+$/|unique:roles,name'
            ];
        }else{
             return [
                'name'=> 'required|regex:/^[A-Za-z0-9 ]+$/|unique:roles,name,'.$id,
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter department name.',
            'name.regex'   => 'Please enter valid department name',
            'name.unique'  => 'Name already taken.'
        ];
    }
}

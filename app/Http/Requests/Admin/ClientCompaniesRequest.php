<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
//use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ClientCompaniesRequest extends FormRequest
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
                'c_name'  => 'required|unique:client_companies',
                'c_signboard_name' => 'required|unique:client_companies',
            ];
        }
        else
        {
            return [
                'c_name' => 'required|unique:client_companies,c_name,'.$id,
                'c_signboard_name' => 'required|unique:client_companies,c_signboard_name,'.$id,

            ];
        }
    }

    public function messages()
    {
        return [

            'c_signboard_name.required' => 'Please enter company signboard name.',
            'c_name.required' => 'Please enter company name.',
            'c_name.unique' => 'Company name has already taken',
            'c_signboard_name.unique' => 'Company signboard name has already taken',
        ]; 
    }
}

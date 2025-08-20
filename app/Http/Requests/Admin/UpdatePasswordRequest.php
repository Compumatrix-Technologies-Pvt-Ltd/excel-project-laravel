<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        // $id = base64_decode(base64_decode($this->route('storeUpdatePassword'))) ?? null; 
        $confirm_password = $request->confirm_password;
        $id = base64_decode(base64_decode($request->h_id));
        $user = User::find($id);
            return [
                'current_password' => 'required',
                'new_password' => 'required|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|min:6',
                'confirm_password' => 'required|same:new_password',
                'current_password' => ['required', function ($attribute, $confirm_password, $fail) use ($user) {
                    if (!\Hash::check($confirm_password, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }],
                'confirm_password' => ['required', function ($attribute, $confirm_password, $fail) use ($user) {
                    if (\Hash::check($confirm_password,$user->password)) {
                        return $fail(__('The new password must be different from the current  password.'));
                    }
                }],
            ];
    }

    public function messages()
    {
        return [
            'current_password.required' => __('Please enter current password.'),
            'new_password.required'     => __('Please enter new password.'),
            'confirm_password.required' => __('Please enter confirm password.'),
            'new_password.regex'        => __('Please enter alpha numeric with capital letters.'),
        ];
    }
}

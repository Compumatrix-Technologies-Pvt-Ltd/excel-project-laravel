<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Auth\LoginRequest;

use Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->ViewData = [];
        $this->ModuleView  = 'admin.auth.';
        //$this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $this->ModuleTitle              = __('Sign In');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view($this->ModuleView . 'login', $this->ViewData);

    }
    public function register()
    {
        $this->ModuleTitle              = __('Sing Up');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view($this->ModuleView . 'register', $this->ViewData);
    }
    public function register2()
    {
        $this->ModuleTitle              = __('Sing Up');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view($this->ModuleView . 'register2', $this->ViewData);
    }
    public function emailVerification()
    {
        $this->ModuleTitle              = __('Email Verification');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view($this->ModuleView . 'email-verification', $this->ViewData);
    }
    public function verificationSuccess()
    {
        $this->ModuleTitle              = __('Verification Success');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view($this->ModuleView . 'verification-success', $this->ViewData);
    }

    // Login check function
    public function checkLogin(LoginRequest $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email           = $request['email'];
        $password        = $request['password'];
        
        $userCredentials['email'] = $email;
        $userCredentials['password'] = $password;

        $user = User::where(['email'=>$request->email])->first();
          if($user){
                if (auth()->attempt($userCredentials)) {
                if(Hash::check($request->password, $user->password)) {
                    $this->JsonData['url'] = route('admin.dashboard');
                    $this->JsonData['status'] = 'success';
                    $this->JsonData['msg'] = "You have successfully logged in...Please wait";
                    }else{
                    $this->JsonData['status'] = 'error';
                    $this->JsonData['msg'] = "These credentials do not match our records.";
                    }
                }else{
                    $this->JsonData['status'] = 'error';
                    $this->JsonData['msg'] = "These credentials do not match our records.";
                }
        }else{
            $this->JsonData['status'] = 'error';
            $this->JsonData['msg'] = "These credentials do not match our records.";
        }
        return response()->json($this->JsonData);
    }
    //logout function
    public function logout(Request $request) {
        Auth::logout();
        $this->ModuleTitle              = __('Logout');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view($this->ModuleView . 'logout', $this->ViewData);

    }
}

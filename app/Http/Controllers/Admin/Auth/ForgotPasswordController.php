<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AdminForgotPasswordMail;


//Model
use App\Models\User;

//Request
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Auth\ResetPasswordRequest;

use Illuminate\Support\Facades\Mail;
use Hash;
use Carbon\Carbon;
use DB;
class ForgotPasswordController extends Controller
{
    public function __construct(User $UserModel)
    {
        $this->ViewData = [];

        $this->UserModel        = $UserModel;
        //$this->middleware('guest')->except('logout');
    }

    public function show(Request $request)
    {
        $this->ModuleTitle              = __('Forgot Password');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view('admin.auth.passwords.email',$this->ViewData);
    }
    public function frontShow(Request $request)
    {
        $this->ModuleTitle              = __('Forgot Password');
        $this->ViewData['moduleAction'] = $this->ModuleTitle; 
        return view('front.auth.passwords.email',$this->ViewData);
    }
    public function forgotPasswordSubmit(Request $request)
    {
        
            $userData = User::where('email',$request->input('email'))->first();
            if($userData)
            {
                $route ="";
                $userid     = $userData->id;
                $userEmail   = $userData->email;
                $fullname    = $userData->name;
                $data       = [];
                $data['fullname'] = $fullname;
                $forgotten_code = sha1(uniqid(rand()));
                $base_64 = base64_encode($forgotten_code);
                User::where('id', $userid)
                ->update([
                    'token' => $forgotten_code
                ]);
                $data['site_url'] = env('APP_URL');
                $data['support_email'] = config('constants.ADMIN_MAIL');
                $data['url'] = url('/') . '/admin/password-reset/' . $base_64;
                $route = route('admin.auth.password.reset');
                $mailPath = Mail::to($userEmail)->send(new AdminForgotPasswordMail($data, 'web'));
                try {
                    $result = $mailPath;
                    $this->JsonData['status'] = __('success');
                    $this->JsonData['url'] = $route;
                    $this->JsonData['msg'] = "Password reset link has been sent.";
            
                } catch (Exception $e) {
                    if (count(Mail::failures()) > 0) {
                        $this->JsonData['status'] = __('error');
                        $this->JsonData['msg'] = "Could not find an account with that email address.";
                    }
                    }
            }else{
                $this->JsonData['status'] = __('error');
                $this->JsonData['msg'] = "Could not find an account with that email address.";
            } 
        return response()->json($this->JsonData);exit;
    }
    public function resetPasswordSubmit(ResetPasswordRequest $request)
    {
        
            $this->JsonData['status'] = __('error');
            $this->JsonData['msg'] = __('Faild to set password');
            try{
                $token = base64_decode($request->user_token);

                $isValidObject =$this->UserModel->where('token', $token)->first();
                if ($isValidObject) {
                    $collection = $this->UserModel->where('email', $isValidObject->email)->first();
                    $this->UserModel->where('id', $collection->id)->update(['password' => Hash::make($request->password),'token'=>'']);

                    $this->JsonData['status'] = __('success');
                    $this->JsonData['url'] = route('admin.login');
                    $this->JsonData['msg'] = "Password Updated Successfully";
                    }
            }catch(\Exception $e){
                $this->JsonData['msg'] = "Something went wrong on server.Please contact to Server.";
                $this->JsonData['error_msg'] = $e->getMessage();
            }
        return response()->json($this->JsonData);
    }
    public function showChangePassword($token = false)
    {
        $this->ViewData['moduleAction'] = __('Reset Password');
        if ($token) {
            $UrlToekn = base64_decode($token);
            $collection = User::where('token', $UrlToekn)
                ->first();
            if (!empty($collection)) {
                $this->ViewData['email'] = $collection->email;
                $this->ViewData['token'] = $token;
                return view("admin.auth.passwords.password-set", $this->ViewData);
            } else {
                return view("admin.auth.passwords.email",$this->ViewData);
            }
        }
    }
    public function showUserChangePassword($token = false)
    {
        if ($token) {
            $UrlToekn = base64_decode($token);
            $collection = User::where('token', $UrlToekn)
                ->first();
            if (!empty($collection)) {
                $this->ViewData['email'] = $collection->email;
                $this->ViewData['token'] = $token;
                $this->ViewData['objPageData'] = DB::table('page_other_items')->where('id',1)->first();
                return view("front.auth.passwords.password-set", $this->ViewData);
            } else {
                return view("front.auth.passwords.email");
            }
        }
    }
}

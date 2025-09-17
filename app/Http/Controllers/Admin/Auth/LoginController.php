<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\RegistrationRequest;
use App\Http\Requests\Admin\Auth\ResendOtpRequest;
use App\Http\Requests\Admin\Auth\VerifyOtpRequest;
use App\Mail\EmailVerificationMail;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Support\Facades\Mail;
use Log;
use Session;

use Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->ViewData = [];
        $this->ModuleView = 'admin.auth.';
        //$this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $this->ModuleTitle = __('Sign In');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'login', $this->ViewData);

    }
    public function register()
    {
        $this->ModuleTitle = __('Sing Up');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'register', $this->ViewData);
    }
    public function register2()
    {
        $this->ModuleTitle = __('Sing Up');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'register2', $this->ViewData);
    }
    public function emailVerification($encId)
    {
        // dd("here");
        $userId = base64_decode(base64_decode($encId));
        // dd($userId);
        $this->ModuleTitle = __('Email Verification');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['user'] = User::findOrFail($userId);
        return view($this->ModuleView . 'email-verification', $this->ViewData);
    }
    public function verificationSuccess()
    {
        $this->ModuleTitle = __('Verification Success');
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

        $email = $request['email'];
        $password = $request['password'];

        $userCredentials['email'] = $email;
        $userCredentials['password'] = $password;

        $user = User::where(['email' => $request->email])->first();
        if ($user) {
            if (auth()->attempt($userCredentials)) {
                if (Hash::check($request->password, $user->password)) {

                    Session::put('yearMonth', date('Ym'));

                    $this->JsonData['url'] = route('admin.dashboard');
                    $this->JsonData['status'] = 'success';
                    $this->JsonData['msg'] = "You have successfully logged in...Please wait";
                } else {
                    $this->JsonData['status'] = 'error';
                    $this->JsonData['msg'] = "These credentials do not match our records.";
                }
            } else {
                $this->JsonData['status'] = 'error';
                $this->JsonData['msg'] = "These credentials do not match our records.";
            }
        } else {
            $this->JsonData['status'] = 'error';
            $this->JsonData['msg'] = "These credentials do not match our records.";
        }
        return response()->json($this->JsonData);
    }
    //logout function
    public function logout(Request $request)
    {
        Auth::logout();
        $this->ModuleTitle = __('Logout');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'logout', $this->ViewData);

    }

    // YearMonthController.php
    public function store(Request $request)
    {
        $request->validate([
            'yearMonth' => 'required|date_format:Ym',
        ]);

        session(['yearMonth' => $request->yearMonth]);

        return response()->json([
            'status' => 'success',
            'msg' => 'Year-Month updated successfully',
        ]);
    }

    public function registerSubmit(RegistrationRequest $request)
    {

        // dd($request->all());
        $otp = rand(1000, 9999);
        $expiresAt = now()->addMinutes(2);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = strtolower(trim($request->email));
        $user->mobile_number = $request->mobile_number ?? null;
        // $user->role = null;
        $user->status = 'inactive';
        $user->password = Hash::make($request->password);
        $user->otp = $otp;
        $user->otp_expires_at = $expiresAt;
        $user->email_verified_at = null;
    
        $user->assignRole('hq');
        $user->save();

        try {

            $data = [
                'user' => $user,
                'otp' => $otp
            ];

            Mail::to($user->email)->send(new EmailVerificationMail('email_verification', $data));

        } catch (Exception $e) {
            Log::error("Failed to send OTP email: " . $e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'url' => route('email.verification', ['id' => base64_encode(base64_encode($user->id))]),
            'message' => 'OTP sent to your email. Please verify your email to process.',
        ]);

    }
    public function verifyOtp(VerifyOtpRequest $request, $encId)
    {
        $userId = base64_decode(base64_decode($encId));

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404);
        }

        if ($user->email_verified_at) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email is already verified.',
            ], 400);
        }

        $otp = implode('', $request->otp);

        if ($user->otp !== $otp) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid OTP.',
            ], 422);
        }

        if ($user->otp_expires_at < now()) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP has expired.',
            ], 422);
        }

        $user->email_verified_at = now();
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return response()->json([
            'status' => 'success',
            'url' => route('verification.success'),
            'message' => 'Email verified successfully. Registration complete.',
        ]);
    }

    public function resendOtp($encId)
    {
        $userId = base64_decode(base64_decode($encId));

        // dd($userId);
        $user = User::find($userId);

        if ($user->email_verified_at) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email already verified.',
                'url' => route('email.verification', ['id' => base64_encode(base64_encode($user->id))]),
            ], 400);
        }

        $otp = rand(1000, 9999);
        $expiresAt = now()->addMinutes(2);

        $user->otp = $otp;
        $user->otp_expires_at = $expiresAt;
        $user->save();

        try {

            $data = [
                'user' => $user,
                'otp' => $otp
            ];

            Mail::to($user->email)->send(new EmailVerificationMail('email_verification', $data));

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'url' => route('email.verification', ['id' => base64_encode(base64_encode($user->id))]),
                'message' => 'Failed to send OTP email. Please try again later.',
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'url' => route('email.verification', ['id' => base64_encode(base64_encode($user->id))]),
            'message' => 'New OTP sent to your email.',
        ]);
    }

}

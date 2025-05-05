<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\OTP;
use App\Models\User;
use App\Mail\sendOTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    // PAGE ROUTER
    public function login() {
        $title = "Login";
        return view('login', compact('title'));
    }

    public function register() {
        $title = "Register";
        return view('register', compact('title'));
    }

    public function forgotPassword() {
        $title = "Forgot Password";
        return view('forgot-password', compact('title'));
    }

    public function resetPassword() {
        $title = "Reset Password";
        return view('reset-password', compact('title'));
    }

    public function confirmOTP() {
        $title = "Confirm OTP";
        return view('confirm-otp', compact('title'));
    }

    public function profile() {
        $title = "Profile";
        return view('user.profile.profile', compact('title'));
    }




    
    // BACKEND USER
    public function createUser(Request $request) {
        try {
            $rules = [
                'username'          => 'required|string|min:6|unique:users',
                'email'             => 'required|string|email|unique:users',
                'password'          => 'required|string|min:8',
                'confirm_password'  => 'required|string|min:8|same:password'
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 422,
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ])->withInput();
            }

            $hashed_password = Hash::make($request->password, [
                'memory' => 1024,
                'time' => 2,
                'threads' => 4
            ]);

            $createdUser = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $hashed_password
            ]);

            if(!$createdUser) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 500,
                    'status' => false,
                    'message' => 'Failed to create user. Please try again later.',
                ])->withInput();
            }

            $otpCode = $this->storeOTP($createdUser->id);

            Mail::to($request->email)->send(new sendOTP($otpCode, $request->username));

            Auth::login($createdUser);
            $request->session()->regenerate();

            return redirect()->route('Confirm-OTP')->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => 'Register successfully. Please check your email to verify your account.',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unexpected error. Please try again later.',
            ], 500);
        }
    }

    public function storeOTP($id) {
        $otp            = (string) mt_rand(100000, 999999);
        $expiredAt      = Carbon::now()->addMinutes(10);
        $encryptedOTP   = Crypt::encrypt($otp);

        $isUserAlereadyExist = OTP::where('user_id', $id)->first();

        if($isUserAlereadyExist) {
            $isUserAlereadyExist->otp = $encryptedOTP;
            $isUserAlereadyExist->expired_otp = $expiredAt;

            $isUserAlereadyExist->save();
        
            return $otp;
        } else {
            OTP::create([
                'user_id'       => $id,
                'otp'           => $encryptedOTP,
                'expired_otp'   => $expiredAt
            ]);

            return $otp;
        }
    }

    public function verifyOTP(Request $request) {
        try {
            $rules = [
                'otp' => 'required|string|size:6',
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 422,
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ])->withInput();
            }

            $otp = OTP::where('user_id', Auth::id())->first();

            if(!$otp) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'OTP not found. Please request a new one.',
                ])->withInput();
            }

            $decryptedOTP = $this->decryptedData($otp->otp);

            if(Carbon::now() > Carbon::parse($otp->expired_otp)) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 422,
                    'status' => false,
                    'message' => 'OTP expired. Please request a new one.',
                ])->withInput();
            }

            if($decryptedOTP != $request->otp) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 422,
                    'status' => false,
                    'message' => 'Invalid OTP. Please try again.',
                ])->withInput();
            }

            $otp->delete();
            
            $user = User::find(Auth::id());
            $user->email_verified_at = Carbon::now();
            $user->save();

            return redirect()->route('User-Dashboard')->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => 'Account verified successfully. Welcome to the dashboard!',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unexpected error. Please try again later.',
            ], 500);
        }
    }

    public function decryptedData($data) {
        try {
            return Crypt::decrypt($data);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return false;
        }
    }
}
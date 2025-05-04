<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
    public function createUser(Request $requset) {
        try {
            $rules = [
                'username'          => 'required|string|min:6|unique:users',
                'email'             => 'required|string|email|unique:users',
                'password'          => 'required|string|min:8',
                'confirm_password'  => 'required|string|min:8|same:password'
            ];

            $validator = Validator::make($requset->all(), $rules);

            if($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors(),
                ], 400)->withInput();
            }

            $hashed_password = Hash::make($request->password, [
                'memory' => 1024,
                'time' => 2,
                'threads' => 4
            ]);

            $createUser = User::create([
                'username' => $requset->username,
                'email' => $requset->email,
                'password' => $hashed_password
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User created successfully.',
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unexpected error. Please try again later.',
            ], 500);
        }
    }

    public function storeOTP($id, $otp, $expiredAt) {
        $encryptedOTP = Crypt::encrypt($otp);

        $isUserAlereadyExist = OTP::where('user_id', $id)
                                        ->first();

        if($isUserAlereadyExist) {
            $isUserAlereadyExist->otp = $encryptedOTP;
            $isUserAlereadyExist->expired_otp = $expiredAt;

            return $isUserAlereadyExist->save();
        
        } else {
            return OTP::create([
                'user_id'       => $id,
                'otp'           => $encryptedOTP,
                'expired_otp'   => $expiredAt
            ]);
        }
    }
}
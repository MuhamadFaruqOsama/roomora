<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}

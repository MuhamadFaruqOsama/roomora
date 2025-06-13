<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\OTP;
use App\Models\User;
use App\Mail\sendOTP;
use App\Models\UserProfile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ResetPassword;
use App\Mail\sendResetPassword;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
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

    public function resetPassword($token) {
        $title = "Reset Password";

        // if token valid
        $isTokenExist = Cache::get($token);

        if(!$isTokenExist) {
            return redirect()->route('Forgot-Password')->with('return_message', [
                'status_code' => 404,
                'status' => false,
                'message' => 'Token not found.'
            ]);
        }

        $getToken = ResetPassword::where('email', $isTokenExist)->first();

        if (!$getToken) {
            return redirect()->route('Forgot-Password')->with('return_message', [
                'status_code' => 404,
                'status' => false,
                'message' => 'No reset request found for this email.'
            ]);
        }

        // var_dump($token, $getToken->token);

        if($getToken->token != $token) {
            return redirect()->route('Forgot-Password')->with('return_message', [
                'status_code' => 404,
                'status' => false,
                'message' => 'Token is invalid. Please request a new one.'
            ]);
        }

        if(Carbon::now() > Carbon::parse($getToken->expired_at)) {
            return redirect()->route('Forgot-Password')->with('return_message', [
                'status_code' => 422,
                'status' => false,
                'message' => 'Token expired. Please request a new one.',
            ])->withInput();
        }
        
        return view('reset-password', compact('title'));
    }

    public function confirmOTP() {
        $title = "Confirm OTP";
        return view('confirm-otp', compact('title'));
    }

    public function profile() {
        $title = "Profile";

        $userData =  User::select('email', 'username', 'email_notification')->where('id', Auth::id())->first();

        $data = UserProfile::select('full_name', 'NIM', 'major', 'entry_year')->where('user_id', Auth::id())->first();

        return view('user.profile.profile', compact('title', 'data', 'userData'));
    }




    
    // BACKEND USER
    public function auth(Request $request) {
        try {
            $rules = [
                'email' => 'required|string|email',
                'password' => 'required|string|min:8'
            ];

            $validator = Validator::make($request->all(), $rules);
            
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if(!Auth::attempt($request->only(['email','password']))) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 403,
                    'status' => false,
                    'message' => 'Invalid email and password. Please try again.',
                ])->withInput();
            }

            if(Auth::user()->role == "admin") {
                $route = "Admin-Dashboard";
            } else {
                $route = "User-Dashboard";
            }

            return redirect()->route($route)->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => 'Login successfully',
            ]);
            
        } catch (Exception $e) {
            return redirect()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later.',
            ])->withInput();
        }
    }
    
    public function createUser(Request $request) {
        try {
            $rules = [
                'username'          => 'required|string|min:6|unique:users|regex:/^[a-zA-Z0-9_]+$/',
                'email'             => 'required|string|email|unique:users',
                'password'          => 'required|string|min:8',
                'confirm_password'  => 'required|string|min:8|same:password'
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
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
            return redirect()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later.',
            ])->withInput();
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
                return redirect()->back()->withErrors($validator)->withInput();
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
            return response()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later.',
            ]);
        }
    }

    public function resendOTP() {
        try {
            $data = Auth::user();
    
            if (!$data) {
                return response()->json([
                    'status_code' => 401,
                    'status' => false,
                    'message' => 'User not authenticated.',
                ], 401);
            }
    
            $otpCode = $this->storeOTP($data->id);
            Mail::to($data->email)->send(new SendOTP($otpCode, $data->username));
    
            return response()->json([
                'status_code' => 200,
                'status' => true,
                'message' => 'OTP sent successfully. Please check your email.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function sendResetPasswordLink(Request $request) {
        try {
            $rules = [
                'email' => 'required|string|email',
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::where('email', $request->email)->first();

            if(!$user) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'Email not found. Please check your email.',
                ])->withInput();
            }

            $generatedToken = Crypt::encrypt($user->email . Str::random(20));
            
            $expiredAt = Carbon::now()->addMinutes(20);
            
            Cache::add($generatedToken, $user->email, Carbon::now()->addMinutes(20));

            $isTokenAlereadyExist = ResetPassword::where('email', $user->email)->first();

            $encryptedToken = Crypt::encrypt($generatedToken);

            if($isTokenAlereadyExist) {
                $isTokenAlereadyExist->token = $generatedToken;
                $isTokenAlereadyExist->expired_at = $expiredAt;
            } else {
                $storeToken = ResetPassword::create([
                    'email' => $user->email,
                    'token' => $generatedToken,
                    'expired_at' => $expiredAt
                ]);
            }

            Mail::to($user->email)->send(new sendResetPassword($generatedToken, $user->username));

            return redirect()->back()->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => 'Reset password link sent successfully. Please check your email.',
            ]);

        } catch (Exception $e) {
            return response()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later.',
            ]);
        }
    }
    
    public function resetPasswordAction(Request $request) {
        try {
            $rules = [
                'password' => 'required|string|min:8',
                'confirm_password' => 'required|string|same:password'
            ];
            
            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $email = Cache::get($token);

            if(!$email) {
                return redirect()->route('Forgot-Password')->with('return_message', [
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'Token is invalid. Please request a new one.'
                ]);
            }

            $hashed_new_password = Hash::make($request->password, [
                'memory' => 1024,
                'time' => 2,
                'threads' => 4
            ]);

            
            
        } catch (Exception $e) {
            return response()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later.',
            ]);
        }
    }
    
    public function editProfile(Request $request) {
        try {
            $rules = [
                'full_name' => 'required|string',
                'nim' => 'required|string',
                'major' => 'required|string',
                'entry_year' => 'required|date'
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $findUser = UserProfile::where('user_id', Auth::id())->first();
    
            if (!$findUser) {
                // Buat profil baru jika belum ada
                UserProfile::create([
                    'user_id' => Auth::id(),
                    'full_name' => $request->full_name,
                    'NIM' => $request->nim,
                    'major' => $request->major,
                    'entry_year' => $request->entry_year
                ]);
    
                $message = "Profile information added successfully.";
            } else {
                // Cek apakah ada perubahan data
                $hasChanged = (
                    $findUser->full_name !== $request->full_name ||
                    $findUser->NIM !== $request->nim ||
                    $findUser->major !== $request->major ||
                    $findUser->entry_year !== $request->entry_year
                );
    
                if (!$hasChanged) {
                    return redirect()->back()->with('return_message', [
                        'status_code' => 200,
                        'status' => true,
                        'message' => "No changes were made."
                    ]);
                }
    
                // Simpan perubahan
                $findUser->update([
                    'full_name' => $request->full_name,
                    'NIM' => $request->nim,
                    'major' => $request->major,
                    'entry_year' => $request->entry_year
                ]);

                $message = "Profile updated successfully.";
            }
    
            return redirect()->back()->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => $message
            ]);
            
        } catch (Exception $e) {
            return redirect()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later.'
            ])->withInput();
        }
    }

    public function changePassword(Request $request) {
        try {
            
            $rules = [
                'old_password' => 'required|string|min:8',
                'new_password' => 'required|string|min:8',
                'confirm_password' => 'required|string|min:8|same:new_password'
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $userData = User::where('id', Auth::id())->first();
            
            if (!Hash::check($request->old_password, $userData->password)) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 403,
                    'status' => false,
                    'message' => 'Old Password do not match.'
                ])->withInput();
            }

            $hashed_new_password = Hash::make($request->password, [
                'memory' => 1024,
                'time' => 2,
                'threads' => 4
            ]);

            $userData->password = $hashed_new_password;
            $userData->save();

            return redirect()->back()->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => 'Change Password successfully'
            ])->withInput();
            
        } catch (Exception $e) {
            return redirect()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'unexpected error. please try again later'
            ])->withInput();
        }
    }

    public function changeEmailNotificationPermission() {
        try {
            
            $findUser = User::where('id', Auth::id())->first();

            $findUser->email_notification = !$findUser->email_notification;
            $findUser->save();

            return response()->json([
                'status_code' => 200,
                'status' => true,
                'message' => 'Successfully changed Email Notification Permission'
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later'
            ]);
        }
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('Login')->with('return_message', [
            'status_code' => 200,
            'status' => true,
            'message' => 'Logout successfully!',
        ]);
    }
    
    public function decryptedData($data) {
        try {
            return Crypt::decrypt($data);
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return false;
        }
    }
}
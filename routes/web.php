<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ComplaintController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [UserController::class, 'login'])->name('Login');
Route::get('/register', [UserController::class, 'register'])->name('Register');
Route::post('/create-user', [UserController::class, 'createUser'])->name('Create-User');
Route::get('/forgot-password', [UserController::class, 'forgotPassword'])->name('Forgot-Password');
Route::get('/reset-password/{token}', [UserController::class, 'resetPassword'])->name('Reset-Password');

// Protected routes (user must be authenticated via Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    
    // Before email verification
    Route::get('/confirm-otp', [UserController::class, 'confirmOTP'])->name('Confirm-OTP');
    Route::post('/verify-otp', [UserController::class, 'verifyOTP'])->name('Verify-OTP');

    Route::prefix('app')->middleware('verified.email')->group(function () {
        // After verified
        Route::get('/dashboard', function () {
            return view('user.dashboard', [
                'title' => 'Dashboard'
            ]);
        })->name('User-Dashboard');
        Route::get('/class', [ClassController::class, 'class'])->name('View Class');
        Route::get('/complaint', [ComplaintController::class, 'complaint'])->name('View Complaint');
        Route::get('/history', [HistoryController::class, 'history'])->name('View History');
        Route::get('/profile', [UserController::class, 'profile'])->name('View Profile');
    });



    // USER
});

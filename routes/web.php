<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FileUploaderController;

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
Route::post('/', [UserController::class, 'auth'])->name('Auth');
Route::get('/register', [UserController::class, 'register'])->name('Register');
Route::post('/register', [UserController::class, 'createUser'])->name('Create-User');
Route::get('/forgot-password', [UserController::class, 'forgotPassword'])->name('Forgot-Password');
Route::post('/forgot-password', [UserController::class, 'sendResetPasswordLink'])->name('Send-Reset-Password-Link');
Route::get('/reset-password/{token}', [UserController::class, 'resetPassword'])->name('Confirm-Reset-Password');
Route::post('/reset-password', [UserController::class, 'resetPasswordAction'])->name('Reset-Password');

// Protected routes (user must be authenticated via Sanctum)
Route::middleware('auth:sanctum')->group(function () {

    // FILE UPLOADER =====================================================================================
    Route::post('/upload', [FileUploaderController::class, 'upload']);
    Route::delete('/revert', [FileUploaderController::class, 'revert']);
    
    // USER ===============================================================================================
    Route::middleware('role:user')->group(function () {
        
        // Before email verification
        Route::get('/confirm-otp', [UserController::class, 'confirmOTP'])->name('Confirm-OTP');
        Route::get('/resend-OTP', [UserController::class, 'resendOTP'])->name('resend-OTP');
        Route::post('/verify-otp', [UserController::class, 'verifyOTP'])->name('Verify-OTP');

        // After verified
        Route::prefix('app')->middleware('verified.email')->group(function () {
            Route::get('/dashboard', function () {
                return view('user.dashboard', [
                    'title' => 'Dashboard'
                ]);
            })->name('User-Dashboard');
            Route::get('/class', [ClassController::class, 'class'])->name('View-Class');
            Route::get('/class/{id}', [ClassController::class, 'detailClass'])->name('Detail-Class');
            Route::post('/class', [ClassController::class, 'bookClass'])->name('Book-Class');
            Route::get('/complaint', [ComplaintController::class, 'complaint'])->name('View-Complaint');
            Route::post('/complaint', [ComplaintController::class, 'postComplaint'])->name('Complaint');
            Route::post('/confirm-complaint', [ComplaintController::class, 'confirmComplaint'])->name('Confirm-Complaint');
            Route::get('/history', [HistoryController::class, 'history'])->name('View-History');
            Route::get('/response/{id}', [HistoryController::class, 'response'])->name('View-Response');
            Route::get('/profile', [UserController::class, 'profile'])->name('View-Profile');
            Route::post('/profile', [UserController::class, 'editProfile'])->name('Edit-Profile');
            Route::post('/change-email-notification-permission', [UserController::class, 'changeEmailNotificationPermission'])->name('Email-Notification');
            Route::post('/change-password', [UserController::class, 'changePassword'])->name('Change-Password');
            Route::post('/logout', [UserController::class, 'logout'])->name('Logout');
        });
    });



    // ADMIN ===============================================================================================
});

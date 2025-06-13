<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
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
Route::middleware('auth:web')->group(function () {

    Broadcast::routes(['middleware' => ['auth:web']]);
    
    // FILE UPLOADER =====================================================================================
    Route::post('/upload', [FileUploaderController::class, 'upload']);
    Route::delete('/revert', [FileUploaderController::class, 'revert']);
    
    // Before email verification
    Route::get('/confirm-otp', [UserController::class, 'confirmOTP'])->name('Confirm-OTP');
    Route::get('/resend-OTP', [UserController::class, 'resendOTP'])->name('resend-OTP');
    Route::post('/verify-otp', [UserController::class, 'verifyOTP'])->name('Verify-OTP');
    
    // USER ===============================================================================================
    Route::middleware('role:user')->group(function () {
        // After verified
        Route::prefix('app')->middleware('verified.email')->group(function () {

            // dashboard
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('User-Dashboard');

            // class
            Route::get('/class', [ClassController::class, 'class'])->name('View-Class');
            Route::get('/class/{id}', [ClassController::class, 'detailClass'])->name('Detail-Class');
            Route::post('/class', [ClassController::class, 'bookClass'])->name('Book-Class');
            Route::delete('/cancel-booking-class', [ClassController::class, 'cancelBookingClass'])->name('Cancel-Booking-Class');
            Route::post('/class-json', [ClassController::class, 'bookClassJson'])->name('Book-Class-Json');

            // complaint
            Route::get('/complaint', [ComplaintController::class, 'complaint'])->name('View-Complaint');
            Route::post('/complaint', [ComplaintController::class, 'postComplaint'])->name('Complaint');
            Route::post('/confirm-complaint', [ComplaintController::class, 'confirmComplaint'])->name('Confirm-Complaint');

            // history
            Route::get('/history', [HistoryController::class, 'history'])->name('View-History');
            Route::get('/response/{id}', [HistoryController::class, 'response'])->name('View-Response');

            // profile
            Route::get('/profile', [UserController::class, 'profile'])->name('View-Profile');
            Route::post('/profile', [UserController::class, 'editProfile'])->name('Edit-Profile');
            Route::post('/change-email-notification-permission', [UserController::class, 'changeEmailNotificationPermission'])->name('Email-Notification');
            Route::post('/change-password', [UserController::class, 'changePassword'])->name('Change-Password');
            Route::post('/logout', [UserController::class, 'logout'])->name('Logout-user');
        });
    });


    Route::middleware('role:admin')->group(function () {
        // ADMIN ===============================================================================================
        Route::prefix('admin')->middleware('verified.email')->group(function () {

            // dashboard
            Route::get('/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('Admin-Dashboard');

            // class
            Route::get('/class-management', [ClassController::class, 'classAdmin'])->name('Class-Admin');
            Route::get('/class-management/{id}', [ClassController::class, 'detailClassAdmin'])->name('Detail-Class-Admin');
            Route::get('/class-booking', [ClassController::class, 'classBookingAdmin'])->name('Class-Booking-Admin');
            Route::get('/class-booking/{id}', [ClassController::class, 'detailClassBookingAdmin'])->name('Detail-Class-Booking-Admin');
            Route::post('/response-class/{id}', [ClassController::class, 'addResponseBookingClassAdmin'])->name('Add-Response-Booking-Class-Admin');
            Route::post('/add-class', [ClassController::class, 'addClassAdmin'])->name('Add-Class-Admin');
            Route::get('/edit-class/{id}', [ClassController::class, 'editClassAdmin'])->name('Update-Class-Admin');
            Route::post('/edit-class/{id}', [ClassController::class, 'postEditClassAdmin'])->name('Post-Update-Class-Admin');
            Route::delete('/delete-class', [ClassController::class, 'deleteClassAdmin'])->name('Delete-Class-Admin');

            // facility
            Route::delete('/delete-class-facility', [FacilityController::class, 'deleteFacilityClassAdmin'])->name('Delete-Class-Facility-Admin');

            // schedule
            Route::get('/schedule', [ScheduleController::class, 'scheduleAdmin'])->name('Schedule-Admin');

            // complaint
            Route::get('/facility-complaint', [ComplaintController::class, 'complaintAdmin'])->name('Complaint-Admin');
            Route::get('/facility-complaint/{id}', [ComplaintController::class, 'detailComplaintAdmin'])->name('Detail-Complaint-Admin');
            Route::post('/response-facility-complaint/{id}', [ComplaintController::class, 'responseComplaintAdmin'])->name('Response-Complaint-Admin');

            // logout
            Route::post('/logout', [UserController::class, 'logout'])->name('Logout-admin');
        });
    });
});
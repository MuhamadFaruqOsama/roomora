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

Route::get('/', [UserController::class, 'login'])->name('Login');
Route::get('/register', [UserController::class, 'register'])->name('Register');
Route::get('/forgot-password', [UserController::class, 'forgotPassword'])->name('Forgot Password');
Route::get('/reset-password/{token}', [UserController::class, 'resetPassword'])->name('Reset Password');
Route::get('/confirm-otp', [UserController::class, 'confirmOTP'])->name('Confirm OTP');


// USER
Route::get('/app/dashboard', function() {
    return view('user.dashboard', [
        'title' => 'Dashboard'
    ]);
})->name('User Dashboard');
Route::get('/app/class', [ClassController::class, 'class'])->name('View Class');
Route::get('/app/complaint', [ComplaintController::class, 'complaint'])->name('View Complaint');
Route::get('/app/history', [HistoryController::class, 'history'])->name('View History');
Route::get('/app/profile', [UserController::class, 'profile'])->name('View Profile');
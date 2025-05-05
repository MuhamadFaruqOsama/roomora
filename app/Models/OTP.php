<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;

    protected $table = 'otp';

    protected $fillable = [
        'user_id',
        'otp',
        'expired_otp'
    ];
}

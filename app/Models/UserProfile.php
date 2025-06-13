<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = "user_profile";

    protected $fillable = [
        "user_id",
        "full_name",
        "NIM",
        "major",
        "entry_year"
    ];

    protected static function booted()
    {
        static::saved(function ($class) {
            Cache::forget('user_profile-' . Auth::id());
        });

        static::deleted(function ($class) {
            Cache::forget('user_profile-' . Auth::id());
        });
    }
}

<?php

namespace App\Models;

use App\Models\Complaint;
use App\Models\BookingClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    protected $fillable = [
        'user_id',
        'activity',
        'book_id',
        'complaint_id'
    ];

    public function bookingClass(): BelongsTo
    {
        return $this->belongsTo(BookingClass::class, 'book_id', 'id');
    }

    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class, 'complaint_id', 'id');
    }

    protected static function booted()
    {
        static::saved(function ($class) {
            Cache::forget('history-data-' . Auth::id());
            Cache::forget('response-data-' . Auth::id());
        });

        static::deleted(function ($class) {
            Cache::forget('history-data-' . Auth::id());
            Cache::forget('response-data-' . Auth::id());
        });
    }
}

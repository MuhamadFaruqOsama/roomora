<?php

namespace App\Models;

use App\Models\Complaint;
use App\Models\BookingClass;
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
}

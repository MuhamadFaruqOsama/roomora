<?php

namespace App\Models;

use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingClass extends Model
{
    use HasFactory;

    protected $table = 'booking_class';

    protected $fillable = [
        'user_id',
        'class_id',
        'title',
        'date',
        'desc',
        'status',
        'start',
        'end'
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }
}

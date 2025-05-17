<?php

namespace App\Models;

use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaint';

    protected $fillable = [
        'user_id',
        'class_id',
        'title',
        'photo',
        'desc',
        'status'
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }
}

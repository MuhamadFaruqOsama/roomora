<?php

namespace App\Models;

use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule';

    protected $fillable = [
        'class_id',
        'day',
        'start',
        'end',
        'subject',
        'type'
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }
}

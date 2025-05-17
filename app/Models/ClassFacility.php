<?php

namespace App\Models;

use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassFacility extends Model
{
    use HasFactory;

    protected $table = 'class_facility';

    protected $fillable = [
        'class_id',
        'name',
        'condition',
        'total'
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }
}

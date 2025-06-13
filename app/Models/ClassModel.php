<?php

namespace App\Models;

use App\Models\Schedule;
use App\Models\ClassFacility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';

    protected $fillable = [
        'code',
        'name',
        'picture',
        'desc',
        'preview_picture',
    ];

    protected static function booted()
    {
        static::saved(function ($class) {
            Cache::forget('class-data-' . Auth::id());
            Cache::forget('detail-class-' . Auth::id() . '-' . $class->id);
        });

        static::deleted(function ($class) {
            Cache::forget('class-data-' . Auth::id());
            Cache::forget('detail-class-' . Auth::id() . '-' . $class->id);
        });
    }
    
    public function facilities()
    {
        return $this->hasMany(ClassFacility::class, 'class_id');
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'class_id');
    }
}

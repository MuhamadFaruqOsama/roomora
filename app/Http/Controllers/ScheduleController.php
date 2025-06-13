<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ScheduleController extends Controller
{
    public function scheduleAdmin(Request $request)
    {
        $title = "Schedule";

        $classData = ClassModel::select('id', 'name', 'code')->get();
        
        $scheduleData = null;
        $class = null;
        if ($request->query('class')) {
            $class_id = $request->query('class');
            $class = ClassModel::with('schedule')->where('id', $class_id)->first();

            if ($class) {
                $scheduleData = $class->schedule->map(function ($item) use ($class) {
                    return [
                        'schedule_id' => $item->id,
                        'class' => $class->code . '-' . $class->name,
                        'desc_class' => $class->desc,
                        'day' => $item->day,
                        'start' => Carbon::parse($item->start)->translatedFormat('H:i'),
                        'end' => Carbon::parse($item->end)->translatedFormat('H:i'),
                        'subject' => $item->subject,
                        'type' => $item->type,
                    ];
                });
            } else {
                $scheduleData = collect(); 
            }
        } else {
            $scheduleData = collect(); 
        }


        return view('admin.schedule.schedule', compact('title', 'scheduleData', 'classData', 'class'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\ClassModel;
use App\Models\UserProfile;
use App\Models\BookingClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    public function class() {
        $title = "Class";

        $ttl = 60 * 60 * 24;
        
        $userProfileData = Cache::remember('user-data-' . Auth::id(), $ttl, function () {
            return UserProfile::select('user_id')->where('user_id', Auth::id())->first();
        });

        

        $classData = Cache::remember('class-data-' . Auth::id(), $ttl, function () {
            return ClassModel::select('id', 'code', 'name', 'picture')->get();
        });
        

        return view('user.class.class', compact('title', 'userProfileData', 'classData'));
    }

    public function bookClass(Request $request) {
        try {
            $rules = [
                'class_id' => 'required|string|exists:class,id',
                'title' => 'required|string',
                'date' => 'required|date|after_or_equal:today',
                'start' => 'required|date_format:H:i',
                'end' => 'required|date_format:H:i',
                'description' => 'nullable|string'
            ];

            $validator = Validator::make($request->all(), $rules);

            $validator->after(function ($validator) use ($request) {
                if ($request->start >= $request->end) {
                    $validator->errors()->add('end', 'The end time must be after the start time.');
                }
            });

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $booking = BookingClass::create([
                'user_id' => Auth::id(),
                'class_id' => $request->class_id,
                'title' => $request->title,
                'date' => $request->date,
                'start' => $request->start,
                'end' => $request->end,
                'desc' => $request->description,
            ]);

            $addToHistory = History::create([
                'user_id' => Auth::id(),
                'activity' => 'booking class',
                'book_id' => $booking->id
            ]);

            Cache::forget('history-data-' . Auth::id());

            return redirect()->back()->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => 'Successfully booked class'
            ]);
            
        } catch (Exception $e) {
            return redirect()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later!'
            ])->withInput();
        }
    }

    public function detailClass($id) {
        try {
            $ttl = 60 * 60 * 24;
            
            $findClass = Cache::remember('detail-class-' . Auth::id() . '-' . $id, $ttl, function () use ($id) {
                return ClassModel::with(['facilities', 'schedule'])->find($id);
            });

            if(!$findClass) {
                return redirect()->route('named_route')->with('return_message', [
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'Class not found!'
                ]);
            }

            $title = $findClass->code . '-' . $findClass->name;

            return view('user.class.detail', compact('title', 'findClass'));
            
        } catch (Exception $e) {
            return redirect()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later!'
            ])->withInput();
        }
    }
}

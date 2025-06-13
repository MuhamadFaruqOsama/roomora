<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\History;
use App\Models\Schedule;
use App\Models\ClassModel;
use App\Models\UserProfile;
use App\Models\BookingClass;
use Illuminate\Http\Request;
use App\Models\ClassFacility;
use App\Mail\BookingClassMail;
use App\Events\BookingClassSent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Events\ResponseBookingClassSent;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    public function class() {
        $title = "Class";
        
        $userProfileData    = UserProfile::select('user_id')->where('user_id', Auth::id())->first();
        $scheduleClass      =  ClassModel::with(['schedule'])->get();
        $classData          = ClassModel::select('id', 'code', 'name', 'picture')->get();

        return view('user.class.class', compact('title', 'userProfileData', 'classData', 'scheduleClass'));
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
            $findClass = ClassModel::with(['facilities', 'schedule'])->find($id);

            if(!$findClass) {
                return redirect()->route('View-Class')->with('return_message', [
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'Class not found!'
                ]);
            }

            $userProfileData = UserProfile::select('user_id')->where('user_id', Auth::id())->first();
            
            $title = $findClass->code . '-' . $findClass->name;

            return view('user.class.detail', compact('title', 'findClass', 'userProfileData'));
            
        } catch (Exception $e) {
            return redirect()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later!'
            ])->withInput();
        }
    }

    public function bookClassJson(Request $request) {
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
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
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

            $findClass = ClassModel::find($request->class_id);

            if(!$findClass) {
                return response()->json([
                    'status' => false,
                    'message' => 'Class not found!'
                ], 404);
            }

            broadcast(new BookingClassSent([
                'id' => $booking->id,
                'title' => $request->title,
                'class' => $findClass->code . '-' . $findClass->name,
                'desc_class' => $findClass->desc ?? '-',
                'day' => Carbon::parse($request->date)->translatedFormat('l'),
                'date' => Carbon::parse($request->date)->translatedFormat('d F Y'),
                'start' => Carbon::parse($request->start)->translatedFormat('H:i'),
                'end' => Carbon::parse($request->end)->translatedFormat('H:i'),
                'desc' => $request->description ?? '-',
                'updated_at' => $booking->updated_at->diffForHumans(),
                'status' => 'pending',
            ]))->toOthers();

            return response()->json([
                'status' => true,
                'message' => 'successfully booking class!'
            ], 200);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'unexpected error. please try again later!'
            ], 500);
        }
    }

    public function cancelBookingClass(Request $request) {
        try {
            
            $rules = [
                'id' => 'required|exists:booking_class,id'
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $deleteHistory = History::where('book_id', $request->id)->delete();
            $deleteBooking = BookingClass::where('id', $request->id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'successfully cancel booking class!'
            ], 200);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'unexpected error. please try again later!'
            ], 500);
        }
    }

    public function classAdmin() {
        $title = "Class Management";

        $ttl = 60 * 60 * 24;

        $dataClass = ClassModel::latest()->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'code' => $item->code,
                    'name' => $item->name,
                    'photo' => $item->picture,
                    'desc' => $item->desc,
                    'created_at' => Carbon::parse($item->created_at)->translatedFormat('l, d F Y'),
                ];
        });

        return view('admin.class.management', compact('title', 'dataClass'));
    }

    public function classBookingAdmin() {
        $title = "Class Booking";

        $findBookingClass = BookingClass::with('class')
                                            ->latest()
                                            ->get()
                                            ->map(function ($item) {
                                                $class = $item->class;

                                                return [
                                                    'id' => $item->id,
                                                    'title' => $item->title,
                                                    'class' => $class ? "{$class->name}-{$class->code}" : '-',
                                                    'desc_class' => $class->desc ?? '-',
                                                    'day' => Carbon::parse($item->date)->translatedFormat('l'),
                                                    'date' => Carbon::parse($item->date)->translatedFormat('d F Y'),
                                                    'start' => Carbon::parse($item->start)->translatedFormat('H:i'),
                                                    'end' => Carbon::parse($item->end)->translatedFormat('H:i'),
                                                    'desc' => $item->desc ?? '-',
                                                    'updated_at' => $item->updated_at->diffForHumans(),
                                                    'status' => $item->status ?? '-',
                                                ];
                                            });

        return view('admin.class.booking', compact('title', 'findBookingClass'));
    }

    public function addClassAdmin(Request $request) {
        try {
            $rules = [
                'room_code' => 'required|string',
                'room_name' => 'required|string',
                'description' => 'required|string',
                'room_picture' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'preview_picture' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'facility_name.*' => 'required|string',
                'facility_condition.*' => 'required|in:good,fair,broken',
                'facility_total.*' => 'required|integer|min:1',
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $class = ClassModel::create([
                'code' => $request->room_code,
                'name' => $request->room_name,
                'desc' => $request->description,
            ]);

            // add room picture
            if ($request->hasFile('room_picture')) {
                $file = $request->file('room_picture');
                $filePath = $file->store('room_picture', 'public');

                $class->update([
                    'picture' => $filePath,
                ]);
                $class->save();
            }

            // add 360 picture
            if ($request->hasFile('preview_picture')) {
                $file = $request->file('preview_picture');
                $filePath = $file->store('preview_picture', 'public');

                $class->update([
                    'preview_picture' => $filePath,
                ]);
                $class->save();
            }

            // add facility
            foreach ($request->facility_name as $index => $name) {
                ClassFacility::create([
                    'class_id' => $class->id,
                    'name' => $name,
                    'condition' => $request->facility_condition[$index],
                    'total' => $request->facility_total[$index],
                ]);
            }
            
            return redirect()->back()->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => 'Class add successfully.'
            ]);
            
        } catch (Exception $e) {
            return redirect()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later!'
            ])->withInput();
        }
    }

    public function detailClassAdmin($id) {
        $ttl = 60 * 60 * 24;

        $findClass = ClassModel::with(['facilities', 'schedule'])->find($id);

        if(!$findClass) {
            return redirect()->route('Class-Admin')->with('return_message', [
                'status_code' => 404,
                'status' => false,
                'message' => 'Class not found!'
            ]);
        }

        $title = $findClass->code . '-' . $findClass->name;
        
        return view('admin.class.detail', compact('title', 'findClass'));
    }

    public function editClassAdmin($id) {
        $findClass = ClassModel::with(['facilities'])->find($id);

        if(!$findClass) {
            return redirect()->route('Class-Admin')->with('return_message', [
                'status_code' => 404,
                'status' => false,
                'message' => 'Class not found!'
            ]);
        }

        $title = $findClass->code . '-' . $findClass->name;

        return view('admin.class.edit', compact('title', 'findClass'));
    }

    public function postEditClassAdmin(Request $request, $id) {
        try {
            $rules = [
                'room_code' => 'required|string',
                'room_name' => 'required|string',
                'description' => 'required|string',
                'room_picture' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'preview_picture' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'facility_name.*' => 'required|string',
                'facility_condition.*' => 'required|in:good,fair,broken',
                'facility_total.*' => 'required|integer|min:1',
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $findClass = ClassModel::find($id);

            if(!$findClass) {
                return redirect()->route('Class-Admin')->with('return_message', [
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'Class not found!'
                ]);
            }

            $findClass->update([
                'code' => $request->room_code,
                'name' => $request->room_name,
                'desc' => $request->description,
            ]);

            // add room picture
            if ($request->hasFile('room_picture')) {
                // Hapus gambar lama jika ada
                if ($findClass->picture && Storage::disk('public')->exists($findClass->picture)) {
                    Storage::disk('public')->delete($findClass->picture);
                }
                
                $file = $request->file('room_picture');
                $filePath = $file->store('room_picture', 'public');

                $findClass->update([
                    'picture' => $filePath,
                ]);
                $findClass->save();
            }

            // add 360 picture
            if ($request->hasFile('preview_picture')) {
                // Hapus gambar lama jika ada
                if ($findClass->preview_picture && Storage::disk('public')->exists($findClass->preview_picture)) {
                    Storage::disk('public')->delete($findClass->preview_picture);
                }
                
                $file = $request->file('preview_picture');
                $filePath = $file->store('preview_picture', 'public');

                $findClass->update([
                    'preview_picture' => $filePath,
                ]);
                $findClass->save();
            }

            // add facility
            $oldFacilities = ClassFacility::where('class_id', $id)->get();
            $newFacilitiesCount = count($request->facility_name);

            foreach ($request->facility_name as $index => $name) {
                if (isset($oldFacilities[$index])) {
                    $oldFacilities[$index]->update([
                        'name' => $request->facility_name[$index],
                        'condition' => $request->facility_condition[$index],
                        'total' => $request->facility_total[$index],
                    ]);
                } else {
                    ClassFacility::create([
                        'class_id' => $id,
                        'name' => $request->facility_name[$index],
                        'condition' => $request->facility_condition[$index],
                        'total' => $request->facility_total[$index],
                    ]);
                }
            }

            if ($oldFacilities->count() > $newFacilitiesCount) {
                for ($i = $newFacilitiesCount; $i < $oldFacilities->count(); $i++) {
                    $oldFacilities[$i]->delete();
                }
            }

            return redirect()->route('Detail-Class-Admin', ['id' => $id])->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => 'Class updated successfully.'
            ]);

        } catch (Exception $e) {
            return redirect()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later!'
            ])->withInput();
        }
    }

    public function deleteClassAdmin(Request $request) {
        try {
            
            $rules = [
                'id' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $findClass = ClassModel::find($request->id);

            if(!$findClass) {
                return response()->json([
                    'status' => false,
                    'message' => 'Class not found!'
                ]);
            }

            if ($findClass->picture && Storage::disk('public')->exists($findClass->picture)) {
                Storage::disk('public')->delete($findClass->picture);
            }

            if ($findClass->preview_picture && Storage::disk('public')->exists($findClass->preview_picture)) {
                Storage::disk('public')->delete($findClass->preview_picture);
            }

            $findClass->delete();

            return response()->json([
                'status' => true,
                'message' => 'Class deleted successfully.'
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unexpected error. Please try again later!'
            ]);
        }
    }

    public function detailClassBookingAdmin($id) {
        $findClass = BookingClass::with(['class'])->find($id);

        if(!$findClass) {
            return redirect()->route('Class-Booking-Admin')->with('return_message', [
                'status_code' => 404,
                'status' => false,
                'message' => 'Class not found!'
            ]);
        }

        $title = $findClass->class->code . '-' . $findClass->class->name;

        return view('admin.class.detail-booking', compact('title', 'findClass'));
    }

    public function addResponseBookingClassAdmin(Request $request, $id) {
        try {
            $rules = [
                'accept_reject' => 'required|in:accept,reject',
                'response' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $findClass = BookingClass::find($id);

            if(!$findClass) {
                return redirect()->route('Class-Booking-Admin')->with('return_message', [
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'Class not found!'
                ]);
            }

            if($request->accept_reject == 'accept') {
                $startTime = Carbon::parse($findClass->start)->format('Y-m-d H:i:s');
                $endTime = Carbon::parse($findClass->end)->format('Y-m-d H:i:s');

                $today = Carbon::today();
                $nextWeek = Carbon::today()->addDays(7);
                $dayName = Carbon::parse($findClass->date)->translatedFormat('l');

                $isScheduled = Schedule::where('day', $dayName)
                    ->where(function ($query) use ($startTime, $endTime) {
                        $query->where(function ($q) use ($startTime, $endTime) {
                            $q->where('start', '<', $endTime)
                            ->where('end', '>', $startTime);
                        });
                    })
                    ->where(function ($query) use ($today, $nextWeek) {
                        $query->where(function ($q) {
                            $q->where('type', 'main');
                        })->orWhere(function ($q) use ($today, $nextWeek) {
                            $q->where('type', 'book')
                            ->whereBetween('created_at', [$today, $nextWeek]);
                        });
                    })
                    ->count();

                if($isScheduled > 0) {
                    return redirect()->back()->with('return_message', [
                        'status_code' => 422,
                        'status' => false,
                        'message' => 'The class is already on that day and time, please reject and leave a message if the class has been booked.'
                    ])->withInput();
                }
                
                $findClass->update([
                    'status' => 'accepted'
                ]);

                $addToSchedule = Schedule::create([
                    'class_id' => $findClass->class_id,
                    'day' => Carbon::parse($findClass->date)->translatedFormat('l'),
                    'start' => $startTime,
                    'end' => $endTime,
                    'subject' => $findClass->title,
                    'type' => 'book'
                ]);
            } else {
                $findClass->update([
                    'status' => 'rejected'
                ]);
            }

            $findClass->update([
                'response' => $request->response,
                'response_created_at' => Carbon::now(),
            ]);
            
            $findClass->save();

            $findHistory = History::select('id')->where('user_id', $findClass->user_id)->where('book_id', $findClass->id)->first();
            
            if(!$findHistory) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'History not found'
                ])->withInput();
            }

            $isNotifEmailAllowed = User::select('email_notification', 'email', 'username')->where('id', $findClass->user_id)->first();

            if($isNotifEmailAllowed->email_notification) {
                
                $classData = ClassModel::select('name', 'code')->where('id', $findClass->class_id)->first();
                
                $data = [
                    'id' => $findClass->id,
                    'username' => $isNotifEmailAllowed->username,
                    'status' => $findClass->status,
                    'history_id' => $findHistory->id,
                    'class_room' => $classData->code . '-' . $classData->name,
                    'title' => $findClass->title,
                    'desc' => $findClass->desc,
                    'response' => $findClass->response
                ];
                
                Mail::to($isNotifEmailAllowed->email)->send(new BookingClassMail($data));
            }

            broadcast(new ResponseBookingClassSent([
                'id' => $findClass->id,
                'history_id' => $findHistory->id,
                'user_id' => $findClass->user_id,
                'title' => $findClass->title,
                'response_at' => $findClass->response_created_at->diffForHumans()
            ]))->toOthers();

            return redirect()->route('Detail-Class-Booking-Admin', ['id' => $id])->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => 'Response added successfully.'
            ]);

        } catch (Exception $e) {
            return redirect()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later!'
            ])->withInput();
        }
    }
}

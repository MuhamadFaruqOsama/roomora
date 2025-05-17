<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Complaint;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    public function complaint() {
        $title = "Complaint";

        $ttl = 60 * 60 * 24;

        $classData = Cache::remember('class-data-' . Auth::id(), $ttl, function () {
            return ClassModel::select('id', 'code', 'name', 'picture')->get();
        });
        
        return view('user.complaint.complaint', compact('title', 'classData'));
    }

    public function postComplaint(Request $request) {
        try {
            $rules = [
                'class_id' => 'required|string|exists:class,id',
                'title' => 'required|string|max:255',
                'photo_evidence' => 'required|array|max:5',
                'photo_evidence.*' => 'string',
                'description' => 'nullable|string'
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $complaint = Complaint::create([
                'user_id' => Auth::id(),
                'class_id' => $request->class_id,
                'title' => $request->title,
                'desc' => $request->description,
            ]);
    
            $photoPaths = [];
            if ($request->hasFile('photo_evidence')) {
                $files = $request->file('photo_evidence');
                foreach ($files as $file) {
                    $filePath = $file->store('complaints', 'public');
                    $photoPaths[] = $filePath;
                }
            }
    
            $complaint->update([
                'photo' => json_encode($photoPaths)
            ]);
    
            History::create([
                'user_id' => Auth::id(),
                'activity' => 'complaint',
                'complaint_id' => $complaint->id
            ]);
    
            Cache::forget('history-data-' . Auth::id());
    
            return redirect()->back()->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => 'Complaint submitted successfully.'
            ]);
    
        } catch (Exception $e) {
            return redirect()->back()->with('return_message', [
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later!'
            ])->withInput();
        }
    }
    
    public function confirmComplaint(Request $request) {
        try {

            $rules = [
                'complaint_id' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return response()->json([
                    'status_code' => 422,
                    'status' => false,
                    'message' => $validator->errors()->first()
                ]);
            }

            $findComplaint = Complaint::where('id', $request->complaint_id)->first();

            $findComplaint->status = 'confirmed';
            $findComplaint->save();

            return response()->json([
                'status_code' => 200,
                'status' => true,
                'message' => 'complaint confirmed successfully!'
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error. Please try again later!'
            ]);
        }
    }
}

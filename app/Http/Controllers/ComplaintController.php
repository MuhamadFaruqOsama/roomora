<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\History;
use App\Models\Complaint;
use App\Models\ClassModel;
use App\Mail\ComplaintMail;
use Illuminate\Http\Request;
use App\Events\ComplaintSent;
use App\Events\ConfirmComplaintSent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Events\ResponseComplaintSent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    public function complaint() {
        $title = "Complaint";

        $classData = ClassModel::select('id', 'code', 'name', 'picture')->get();
        
        return view('user.complaint.complaint', compact('title', 'classData'));
    }

    public function postComplaint(Request $request) {
        try {
            $rules = [
                'class_id' => 'required|string|exists:class,id',
                'title' => 'required|string|max:255',
                'photo_evidence' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'description' => 'nullable|string',
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

            $filePath = '';
            if ($request->hasFile('photo_evidence')) {
                $file = $request->file('photo_evidence');
                $filePath = $file->store('complaints', 'public');

                $complaint->update([
                    'photo' => $filePath,
                ]);
            }

            History::create([
                'user_id' => Auth::id(),
                'activity' => 'complaint',
                'complaint_id' => $complaint->id,
            ]);

            $findClass = ClassModel::find($request->class_id);

            if(!$findClass) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'Class not found.'
                ])->withInput();
            }

            broadcast(new ComplaintSent([
                'id' => $complaint->id,
                'class' => $findClass->code . '-' . $findClass->name,
                'title' => $request->title,
                'photo' => $filePath,
                'status' => 'pending',
                'created_at' => $complaint->created_at->diffForHumans(),
            ]))->toOthers();

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

            broadcast(new ConfirmComplaintSent([
                'id' => $request->complaint_id,
                'user_id' => Auth::id() 
            ]))->toOthers();

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

    public function complaintAdmin() {
        $title = "Facility Complaint";

        $dataComplaint = Complaint::with(['class'])->latest()->get()->map(function($item) {
                return [
                    'id' => $item->id,
                    'class' => $item->class->code . '-' . $item->class->name,
                    'title' => $item->title,
                    'photo' => $item->photo,
                    'status' => $item->status,
                    'created_at' => $item->updated_at->diffForHumans(),
                ];
        });

        return view('admin.complaint.complaint', compact('title', 'dataComplaint'));
    }

    public function detailComplaintAdmin($id) {
        $dataComplaint =  Complaint::with(['class'])->where('id', $id)->first();

        if (!$dataComplaint) {
            return redirect()->back()->with('return_message', [
                'status_code' => 404,
                'status' => false,
                'message' => 'Complaint not found!'
            ]);
        }

        $title = $dataComplaint->class->code . '-' . $dataComplaint->class->name;

        return view('admin.complaint.detail', compact('title', 'dataComplaint'));
    }

    public function responseComplaintAdmin(Request $request, $id) {
        try {
            $rules = [
                'response' => 'required|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $complaint = Complaint::where('id', $id)->first();

            if (!$complaint) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'Complaint not found!'
                ]);
            }

            $complaint->response = $request->response;
            $complaint->status = 'finished';
            $complaint->response_created_at = Carbon::now();
            $complaint->save();

            $findHistory = History::select('id')->where('complaint_id', $complaint->id)->where('user_id', $complaint->user_id)->first();

            if (!$findHistory) {
                return redirect()->back()->with('return_message', [
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'History not found!'
                ]);
            }

            $isNotifEmailAllowed = User::select('email_notification', 'email', 'username')->where('id', $complaint->user_id)->first();

            if($isNotifEmailAllowed->email_notification) {
                
                $classData = ClassModel::select('name', 'code')->where('id', $complaint->class_id)->first();
                
                $data = [
                    'id' => $complaint->id,
                    'username' => $isNotifEmailAllowed->username,
                    'history_id' => $findHistory->id,
                    'class_room' => $classData->code . '-' . $classData->name,
                    'title' => $complaint->title,
                    'desc' => $complaint->desc,
                    'response' => $complaint->response
                ];
                
                Mail::to($isNotifEmailAllowed->email)->send(new ComplaintMail($data));
            }
            
            broadcast(new ResponseComplaintSent([
                'id' => $complaint->id,
                'history_id' => $findHistory->id,
                'user_id' => $complaint->user_id,
                'title' => $complaint->title,
                'response_at' => $complaint->response_created_at->diffForHumans()
            ]))->toOthers();

            return redirect()->back()->with('return_message', [
                'status_code' => 200,
                'status' => true,
                'message' => 'Response submitted successfully.'
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

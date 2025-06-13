<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HistoryController extends Controller
{
    public function history() {
        $title = "History";

        $dataHistory = History::where('user_id', Auth::id())
                                ->when(request('activity') == 'complaint', function ($query) {
                                    return $query->with('complaint.class');
                                })
                                ->when(request('activity') == 'booking class', function ($query) {
                                    return $query->with('bookingClass.class');
                                })
                                ->latest()
                                ->get();

        return view('user.history.history', compact('title', 'dataHistory'));
    }

    public function response($historyID) {
        $title = "Response";
        
        $responseData = History::where('user_id', Auth::id())->where('id', $historyID)
                                ->when(request('activity') == 'complaint', function ($query) {
                                    return $query->with('complaint.class');
                                })
                                ->when(request('activity') == 'booking class', function ($query) {
                                    return $query->with('bookingClass.class');
                                })
                                ->first();

        // Jika data tidak ditemukan
        if (!$responseData) {
            return redirect()->route('View-History')->with('return_message', [
                'status_code' => 404,
                'status' => false,
                'message' => 'Response not found!'
            ]);
        }

        return view('user.history.response', compact('title', 'responseData'));
    }
}

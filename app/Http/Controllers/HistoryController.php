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

        $ttl = 60 * 60 * 24;
        
        $dataHistory = Cache::remember('history-data-' . Auth::id(), $ttl, function () {
            return History::where('user_id', Auth::id())
                ->when(request('activity') == 'complaint', function ($query) {
                    return $query->with('complaint.class');
                })
                ->when(request('activity') == 'booking class', function ($query) {
                    return $query->with('bookingClass.class');
                })
                ->latest()
                ->get();
        });

        return view('user.history.history', compact('title', 'dataHistory'));
    }

    public function response($historyID) {
        $title = "Response";
        $ttl = 60 * 60 * 24; // Cache selama 24 jam

        $responseData = Cache::remember('response-data-' . Auth::id() . '-' . $historyID, $ttl, function () use ($historyID) {
            return History::where('user_id', Auth::id())->where('id', $historyID)
                ->when(request('activity') == 'complaint', function ($query) {
                    return $query->with('complaint.class');
                })
                ->when(request('activity') == 'booking class', function ($query) {
                    return $query->with('bookingClass.class');
                })
                ->first();
        });

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

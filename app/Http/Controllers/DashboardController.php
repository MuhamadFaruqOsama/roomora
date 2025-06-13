<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Complaint;
use App\Models\ClassModel;
use App\Models\BookingClass;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function dashboard() {
        $title = 'Dashboard';
        
        $dataNotification = History::where('user_id', Auth::id())
                            ->where('created_at', '>=', Carbon::now()->subDays(7))
                            ->when(request('activity') == 'complaint', function ($query) {
                                return $query->where('activity', 'complaint')
                                            ->whereHas('complaint', function ($q) {
                                                $q->whereNotNull('response')
                                                ->whereNotNull('response_created_at');
                                            })
                                            ->with('complaint.class');
                            })
                            ->when(request('activity') == 'booking class', function ($query) {
                                return $query->where('activity', 'booking class')
                                            ->whereHas('bookingClass', function ($q) {
                                                $q->where('status', '!=', 'pending')
                                                ->whereNotNull('response')
                                                ->whereNotNull('response_created_at');
                                            })
                                            ->with('bookingClass.class');
                            })
                            ->when(!in_array(request('activity'), ['complaint', 'booking class']), function ($query) {
                                return $query->where(function ($q) {
                                    $q->where(function ($q) {
                                        $q->where('activity', 'complaint')
                                        ->whereHas('complaint', function ($sub) {
                                            $sub->whereNotNull('response')
                                                ->whereNotNull('response_created_at');
                                        });
                                    })->orWhere(function ($q) {
                                        $q->where('activity', 'booking class')
                                        ->whereHas('bookingClass', function ($sub) {
                                            $sub->where('status', '!=', 'pending')
                                                ->whereNotNull('response')
                                                ->whereNotNull('response_created_at');
                                        });
                                    });
                                })->with(['complaint.class', 'bookingClass.class']);
                            })
                            ->latest()
                            ->limit(7)
                            ->get();

        $dataCounts =  DB::table('history')
                            ->select('activity', DB::raw('count(*) as total'))
                            ->where('user_id', Auth::id())
                            ->groupBy('activity')
                            ->pluck('total', 'activity')
                            ->toArray();
                            
        return view('user.dashboard', compact('title', 'dataNotification', 'dataCounts'));
    }

    public function dashboardAdmin() {
        $title = "Dashboard";

        $totalRooms = ClassModel::count();
        $statusBookingCounts = BookingClass::select('status', DB::raw('count(*) as total'))
                        ->groupBy('status')
                        ->pluck('total', 'status');

        // complaint
        $statusComplaintCounts = Complaint::select('status', DB::raw('count(*) as total'))
                        ->groupBy('status')
                        ->pluck('total', 'status');

        return view('admin.dashboard', compact('title', 'totalRooms', 'statusBookingCounts', 'statusComplaintCounts'));
    }
}

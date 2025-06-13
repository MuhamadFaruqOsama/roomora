@extends('layouts.admin')

@section('main-content')
    {{-- main content --}}
    <div class="flex-1">

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">
            <div class="stats-card bg-blue-500 text-white p-4 rounded-lg">
                <h5 class="text-lg">Total Rooms</h5>
                <h2 class="text-2xl text-end mt-2 font-bold">{{ $totalRooms ?? 0 }}</h2>
            </div>
            <div class="stats-card bg-green-500 text-white p-4 rounded-lg">
                <h5 class="text-lg">Pending Bookings</h5>
                <h2 class="text-2xl text-end mt-2 font-bold">{{ $statusBookingCounts['pending'] ?? 0 }}</h2>
            </div>
            <div class="stats-card bg-yellow-500 text-gray-800 p-4 rounded-lg">
                <h5 class="text-lg">Pending Complaints</h5>
                <h2 class="text-2xl text-end mt-2 font-bold">{{ $statusComplaintCounts['pending'] ?? 0 }}</h2>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6">
            <div class="card col-span-2 bg-white shadow-md p-4 rounded-lg">
                <h5 class="text-lg font-semibold mb-3">Booking Class Status</h5>
                <canvas id="bookingClassChart" data-pending="{{ $statusBookingCounts['pending'] ?? 0 }}" data-rejected="{{ $statusBookingCounts['rejected'] ?? 0 }}" data-accepted="{{ $statusBookingCounts['accepted'] ?? 0 }}"></canvas>
            </div>
            <div class="card bg-white col-span-2 shadow-md p-4 rounded-lg">
                <h5 class="text-lg font-semibold mb-3">Complaints Status</h5>
                <canvas id="complaintsChart" data-pending="{{ $statusComplaintCounts['pending'] ?? 0 }}" data-rejected="{{ $statusComplaintCounts['rejected'] ?? 0 }}" data-finished="{{ $statusComplaintCounts['finished'] ?? 0 }}" data-confirmed="{{ $statusComplaintCounts['confirmed'] ?? 0 }}"></canvas>
            </div>
            {{-- <div class="card bg-white shadow-md p-4 rounded-lg col-span-4">
                <h5 class="text-lg font-semibold">class Bookings Overview</h5>
                <canvas id="bookingsChart"></canvas>
            </div> --}}
        </div>

        <!-- Recent Activity -->
        {{-- <div class="card bg-white shadow-md p-4 rounded-lg">
            <h5 class="text-lg font-semibold">Recent Activity</h5>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Time</th>
                            <th class="px-4 py-2 text-left">Activity</th>
                            <th class="px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2">10:30 AM</td>
                            <td class="px-4 py-2">Room 101 Booking Request</td>
                            <td class="px-4 py-2"><span class="bg-yellow-400 text-white py-1 px-2 rounded-full">Pending</span></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">09:45 AM</td>
                            <td class="px-4 py-2">Facility Complaint - Room 203</td>
                            <td class="px-4 py-2"><span class="bg-green-500 text-white py-1 px-2 rounded-full">Resolved</span></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">09:15 AM</td>
                            <td class="px-4 py-2">Schedule Update - Room 305</td>
                            <td class="px-4 py-2"><span class="bg-teal-400 text-white py-1 px-2 rounded-full">Updated</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>
    {{-- main content --}}

@endsection
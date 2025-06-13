@extends('layouts.admin')

@section('main-content')
    
    {{-- main content --}}
    <div class="flex-1">
        <!-- Rooms Table -->
        <div class="rounded-lg overflow-hidden">
           <div id="table-admin-grid" data-table-data='@json($findBookingClass)' data-title="booking-class" data-table-header="Class, Date, Time, Status, Action"></div>
        </div>
    </div>
    {{-- main content --}}
    
@endsection
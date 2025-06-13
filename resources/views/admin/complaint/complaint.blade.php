@extends('layouts.admin')

@section('main-content')
    
    {{-- main content --}}
    <div class="flex-1">
        <!-- Rooms Table -->
        <div class="rounded-lg overflow-hidden">
           <div id="table-admin-grid" data-table-data='@json($dataComplaint)' data-table-header="Photo, Class & Problem, Status, Action" data-title="complaint"></div>
        </div>
    </div>
    {{-- main content --}}
    
@endsection
@extends('layouts.admin')

@section('main-content')
    
    {{-- main content --}}
    <div class="flex-1">
        <div class="flex justify-end items-center">
            <button onclick="document.getElementById('addRoomModal').classList.remove('hidden')" 
                    class="px-4 py-2 bg-[#5aa9e6] text-white rounded-full cursor-pointer hover:shadow-md flex items-center">
                <i class="bi bi-plus-lg mr-2"></i>
                Add New Room
            </button>
        </div>

        <!-- Rooms Table -->
        <div class="rounded-lg overflow-hidden">
           <div id="table-admin-grid" data-table-data='@json($dataClass)' data-title="class-management" data-table-header="Code, Name, Photo, Desc, added on, Action"></div>
        </div>
    </div>
    {{-- main content --}}
    
@endsection
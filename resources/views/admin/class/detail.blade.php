@extends('layouts.detail-admin')

@section('main-content')

    {{-- header --}}
    <x-admin.back-header
        parentDirectory="Class Management"
        currentDirectory="Detail class {{ $title }}"
        id="{{ $findClass->id }}"   
        :menu="true"     
    ></x-admin.back-header>
    {{-- header --}}

    
    {{-- detail --}}
    <div class="p-5 pb-10">
        <div class="grid lg:grid-cols-3 gap-5">
            <div class="col-span-1">
                <div class="text-sm text-gray-500">Class Photo:</div>

                {{--  --}}
                <script src="https://cdn.jsdelivr.net/npm/three@0.147/build/three.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/uevent@2/browser.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/photo-sphere-viewer@4/dist/photo-sphere-viewer.min.js"></script>
                
                <!-- the viewer container must have a defined size -->
                <div id="preview-360-class" style="width: 100%; height: 70vh;" data-image="{{ asset('storage/' . $findClass->preview_picture) }}"></div>
                {{--  --}}
            </div>
            <div class="col-span-2">
                <div class="text-xl text-gray-700 capitalize font-semibold mb-4">{{ $findClass->title }}</div>
                {{--  --}}
                <div class="flex flex-col mb-3">
                    <div class="text-sm text-gray-500">Class:</div>
                    <div class="text-gray-700 text-base">{{ $title }}</div>
                </div>
                <div class="flex flex-col mb-3">
                    <div class="text-sm text-gray-500">Description:</div>
                    <div class="text-gray-700 text-base">{{ $findClass->desc }}</div>
                </div>
                <div class="flex flex-col mb-3">
                    <div class="text-sm text-gray-500">added on:</div>
                    <div class="text-gray-700 text-base">{{ $findClass->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>
        <div class="mt-5 w-full p-4 bg-white rounded-lg">
            <div class="text-sm text-gray-500">Class Facility:</div>
            
            {{-- custom output for table --}}
            @php
                $facilities = $findClass->facilities->map(function($facility) {
                    return [
                        'id' => $facility->id,
                        'name' => $facility->name,
                        'condition' => $facility->condition,
                        'total' => $facility->total,
                    ];
                });
            @endphp
            {{-- custom output for table --}}
            
            <div id="table-admin-grid" data-table-data='@json($facilities)' data-title="class-facility" data-table-header="Name, Condition, Total, Action"></div>
            <div class="text-sm text-gray-500 mt-5">Schedule:</div>
            <div class="overflow-x-auto">
                <x-mobile.schedule
                    :scheduleData="$findClass->schedule"
                    className="{{ $title }}"
                    isProfileDataFilled="{{ null }}"
                    classId="{{ $findClass->id }}"
                    ></x-mobile.schedule>
            </div>
            <div class="flex justify-end mt-3">
                <a href="{{ route('Schedule-Admin') }}" class="py-3 px-5 rounded-full bg-[#5aa9e6] text-white hover:shadow-md flex items-center">
                    Configure schedule for this class
                </a>
            </div>
        </div>
    </div>
    {{-- detail --}}
@endsection
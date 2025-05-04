@extends('layouts.mobile')

@php
    $classList = [
        [
            'id' => 1,
            'name' => 'Class 312',
            'image' => 'room-1.jpg',
            'description' => 'Lantai 3',
        ],
        [
            'id' => 1,
            'name' => 'Class 312',
            'image' => 'room-1.jpg',
            'description' => 'Lantai 3',
        ],
        [
            'id' => 1,
            'name' => 'Class 312',
            'image' => 'room-1.jpg',
            'description' => 'Lantai 3',
        ],
        [
            'id' => 1,
            'name' => 'Class 312',
            'image' => 'room-1.jpg',
            'description' => 'Lantai 3',
        ],
        [
            'id' => 1,
            'name' => 'Class 312',
            'image' => 'room-1.jpg',
            'description' => 'Lantai 3',
        ]
    ]
@endphp

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}"></x-mobile.mobile-header>
    {{-- header --}}

    {{-- search bar --}}
    <div class="my-3 px-5">
        <div class="flex gap-2 overflow-auto pe-5 flex-nowrap whitespace-nowrap">
            <button id="btn-class-list" onclick="changeClassPage('class-list')" class="bg-[#FBBC05] rounded-full py-2 px-5 cursor-pointer text-base">
                Class
            </button>
            <button id="btn-schedule-list" onclick="changeClassPage('schedule-list')" class="bg-gray-200 rounded-full py-2 px-5 cursor-pointer text-base">
                Schedule
            </button>
            <button id="btn-booking-class" onclick="changeClassPage('booking-class')" class="bg-gray-200 rounded-full py-2 px-5 cursor-pointer text-base">
                Booking Class
            </button>
        </div>        
    </div>
    {{-- search bar --}}

    {{-- class list --}}
    <div id="class-list" class="px-5 pb-24">
        <x-mobile.search-bar
            name="search-class"
            placeholder="Search class here"
        ></x-mobile.search-bar>
        <div class="grid gap-3 grid-cols-2 mt-3">
            @foreach ($classList as $item)
                <x-mobile.class-card
                    id="{{ $item['id'] }}"
                    image="{{ $item['image'] }}"
                    name="{{ $item['name'] }}"
                    description="{{ $item['description'] }}"
                ></x-mobile.class-card>
            @endforeach
        </div>
    </div>
    {{-- class list --}}

    {{-- schedule --}}
    <div id="schedule-list" class="px-5 pb-24"></div>
    {{-- schedule --}}

    {{-- booking class --}}
    <div id="booking-class" class="px-5 pb-24 hidden">
        @include('components.mobile.booking-class')
    </div>
    {{-- booking class --}}

    {{-- navbar --}}
    <div class="fixed bottom-0 w-full sm:w-[70%] md:w-[40%]">
        <x-mobile.mobile-navbar title="{{ $title }}"></x-mobile.mobile-navbar>
    </div>
@endsection
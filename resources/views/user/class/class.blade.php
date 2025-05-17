@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}"></x-mobile.mobile-header>
    {{-- header --}}

    {{-- search bar --}}
    <div class="my-3 px-5">
        <div class="flex gap-2 overflow-auto pe-5 flex-nowrap whitespace-nowrap">
            <button id="btn-class-list" onclick="changeClassPage('class-list')" class="bg-[#FBBC05] rounded-full text-white py-2 px-5 text-sm cursor-pointer">
                Class
            </button>
            <button id="btn-schedule-list" onclick="changeClassPage('schedule-list')" class="bg-gray-200 rounded-full text-gray-700 py-2 px-5 text-sm cursor-pointer">
                Schedule
            </button>
            <button id="btn-booking-class" onclick="changeClassPage('booking-class')" class="bg-gray-200 rounded-full text-gray-700 py-2 px-5 text-sm cursor-pointer">
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
            @foreach ($classData as $item)
                <x-mobile.class-card
                    id="{{ $item->id }}"
                    image="{{ $item->picture }}"
                    name="{{ $item->code . '-' . $item->name }}"
                ></x-mobile.class-card>
            @endforeach
        </div>
    </div>
    {{-- class list --}}

    {{-- schedule --}}
    <div id="schedule-list" class="pb-24">
        @include('user.class.schedule')
    </div>
    {{-- schedule --}}

    {{-- booking class --}}
    <div id="booking-class" class="pb-24 hidden">
        @if ($userProfileData)
            @include('components.mobile.booking-class')
        @else
            <div class="bg-yellow-100 text-sm p-2 mx-5 rounded-md border border-yellow-300">
                Please fill your user profile first before use this feature. You can go to profile page, or follow this link: <a href="/app/profile" class="text-yellow-500 font-semibold mt-2">Fill the user profile</a>
            </div>
        @endif
    </div>
    {{-- booking class --}}

    {{-- navbar --}}
    <div class="fixed bottom-0 w-full sm:w-[70%] md:w-[40%]">
        <x-mobile.mobile-navbar title="{{ $title }}"></x-mobile.mobile-navbar>
    </div>
@endsection
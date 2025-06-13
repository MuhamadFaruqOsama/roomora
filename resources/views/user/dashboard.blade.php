@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- features --}}
    <div class="bg-[#5aa9e6] shadow-sm rounded-br-4xl py-5 pe-5">
        {{-- header --}}
        <div class="flex justify-between items-center ps-5">
            <div class="">
                <div class="text-gray-100 text-xs">{{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->translatedFormat('l, d F Y') }}</div>
                <div class="font-semibold text-white">Dashboard</div>
            </div>
            <div class="flex gap-3 items-center">
                <button class="relative w-fit" type="button" data-drawer-target="notification-detail" data-drawer-toggle="notification-detail" aria-controls="notification-detail" aria-expanded="false">
                    <i class="hgi hgi-stroke hgi-notification-01 text-2xl text-white font-semibold"></i>
                    @if ($dataNotification->count() > 0)
                        <span class="absolute p-[7px] h-[7px] bg-red-500 rounded-full top-0 right-0 text-xs flex items-center justify-center text-white" id="total-notification-user">
                            {{ $dataNotification->count() }}
                        </span>
                    @endif
                </button>
                <a href="/app/profile">
                    <img src="{{ asset('img/app/blank_pp.png') }}" class="w-[35px] h-[35px] bg-gray-300 rounded-full ring-2 ring-white" alt="profile picture"/>
                </a>
            </div>
        </div>

        {{-- features --}}
        <div class="text-gray-50 text-sm font-semibold mt-10 ps-5">Features</div>
        <div class="grid grid-cols-3 gap-2 mt-3 ps-5">
            {{-- class features --}}
            <div class="col-span-3 rounded-md bg-[#ffe45e] px-3 py-3 text-white rounded-tr-3xl">
                <a href="/app/class" class="flex justify-between items-center">
                    <div class="">
                        <div class="font-semibold text-black text-md">Class</div>
                        <div class="text-xs text-gray-700 line-clamp-1">view schedules, bookings and class details</div>
                    </div>
                </a>
            </div>

            {{-- aduan --}}
            <div class="col-span-2 rounded-md bg-[#ff6392] px-3 py-3 text-white">
                <a href="/app/complaint">
                    <div class="font-semibold text-md text-white">Complaint</div>
                    <div class="text-xs text-white line-clamp-1">Complaints regarding inappropriate facilities</div>
                </a>
            </div>

            {{-- history --}}
            <div class="rounded-md bg-[#f9f9f9] px-3 py-3 text-white rounded-br-3xl">
                <a href="/app/history">
                    <div class="font-semibold text-md text-black">History</div>
                    <div class="text-xs text-gray-700 line-clamp-1">History of complaints and class bookings</div>
                </a>
            </div>
        </div>
    </div>

    {{-- notification --}}
    <div id="notification" class="px-5 pb-24">
        <div class="text-gray-700 text-sm font-semibold mt-7">Your Activity</div>
        <div class="flex justify-center text-gray-500 px-5 my-3">
            <div id="activity-data" data-booking-class="{{ $dataCounts['booking class'] ?? 0 }}" data-complaint="{{ $dataCounts['complaint'] ?? 0 }}"></div>
            <canvas id="activity-chart"></canvas>
        </div>
    </div>

    {{-- navbar --}}
    <div class="fixed bottom-0 w-full sm:w-[70%] md:w-[40%]">
        <x-mobile.mobile-navbar title="{{ $title }}"></x-mobile.mobile-navbar>
    </div>

    {{-- notification --}}
    @include('components.mobile.notification')
    {{-- notification --}}
@endsection
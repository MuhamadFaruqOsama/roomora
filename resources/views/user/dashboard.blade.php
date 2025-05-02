@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- features --}}
    <div class="bg-[#24316F] shadow-sm rounded-br-4xl py-5 pe-5">
        {{-- header --}}
        <div class="flex justify-between items-center ps-5">
            <div class="">
                <div class="text-gray-300 text-xs">Senin, 29 jan 2025</div>
                <div class="font-semibold text-white">Dashboard</div>
            </div>
            <div class="w-[40px] h-[40px] bg-gray-300 rounded-full">p</div>
        </div>

        {{-- features --}}
        <div class="text-gray-50 text-sm font-semibold mt-7 ps-5">Features</div>
        <div class="grid grid-cols-3 gap-2 mt-3 ps-5">
            {{-- class features --}}
            <div class="col-span-3 rounded-md bg-[#FBBC05] px-5 py-3 text-white rounded-tr-3xl">
                <a href="/app/class" class="flex justify-between items-center">
                    <div class="">
                        <div class="font-semibold text-black text-md">Class</div>
                        <div class="text-xs text-gray-700 line-clamp-1">view schedules, bookings and class details</div>
                    </div>
                    {{-- <div class="flex justify-center items-center w-[35px] h-[35px] border border-gray-800 rounded-full text-black">
                        <i class="fa-solid fa-arrow-right -rotate-45"></i>
                    </div> --}}
                </a>
            </div>

            {{-- aduan --}}
            <div class="col-span-2 rounded-md bg-white px-5 py-3 text-white">
                <a href="/app/complaint">
                    <div class="font-semibold text-md text-black">Complaint</div>
                    <div class="text-xs text-gray-700 line-clamp-1">Complaints regarding inappropriate facilities</div>
                </a>
            </div>

            {{-- history --}}
            <div class="rounded-md bg-white px-5 py-3 text-white rounded-br-3xl">
                <a href="/app/history">
                    <div class="font-semibold text-md text-black">History</div>
                    <div class="text-xs text-gray-700 line-clamp-1">History of complaints and class bookings</div>
                </a>
            </div>
        </div>
    </div>

    {{-- notification --}}
    <div id="notification" class="pe-5">
        <div class="text-gray-700 text-sm font-semibold mt-7 ps-5">Notification</div>
        {{-- history --}}
        <div class="col-span-2 rounded-r-full bg-white mt-2 px-5 py-3 flex items-center gap-4 border border-gray-300">
            <i class="fa-solid fa-triangle-exclamation text-lg text-yellow-500"></i>
            <a href="">
                <div class="flex items-center justify-between w-full">
                    <div class="font-semibold text-gray-700 text-md">Complaint</div>
                    <div class="text-xs text-gray-600">19:00</div>
                </div>
                <div class="text-sm text-gray-500 line-clamp-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam animi distinctio quos hic fuga quibusdam deserunt numquam ullam sapiente voluptate?</div>
            </a>
        </div>
        


    </div>

    {{-- navbar --}}
    <div class="fixed bottom-0 w-full sm:w-[70%] md:w-[40%]">
        <x-mobile.mobile-navbar title="{{ $title }}"></x-mobile.mobile-navbar>
    </div>
@endsection
@extends('layouts.admin')

@section('main-content')
    
    <div class="py-3 flex justify-end w-full gap-5">
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-[#ff6392] hover:shadow-md cursor-pointer focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-7 py-2.5 text-center inline-flex items-center" type="button">
            Choose Class 
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>
        <button onclick="document.getElementById('addScheduleModal').classList.remove('hidden')" 
                class="px-4 py-2 bg-[#5aa9e6] text-white rounded-full cursor-pointer hover:shadow-md flex items-center">
            <i class="bi bi-plus-lg mr-2"></i>
            Add Schedule For this Class
        </button>

        <!-- Dropdown menu -->
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                @foreach ($classData as $item)
                    <li>
                        <a href="/admin/schedule?class={{ $item->id }}" class="block px-4 py-2 hover:bg-gray-100">Class {{ $item->code }}-{{ $item->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="">
        {{-- schedule table --}}
        @if (!$scheduleData->isEmpty())
            <div class="text-gray-600 mt-2 font-semibold mb-2">
                Schedule Table Class {{ $scheduleData->first()['class'] }}
            </div>

            <div
                id="table-admin-grid"
                data-table-data='@json($scheduleData)'
                data-table-header="Class, Day & Time, Subject, Type, Action"
                data-title="schedule"></div>

            {{-- preview schedule --}}
            <div class="text-gray-600 mt-5 font-semibold mb-2">Preview Schedule</div>
            <x-mobile.schedule 
                :scheduleData="$class->schedule" 
                className="{{ $scheduleData->first()['class'] }}"
                isProfileDataFilled="{{ false }}"
                classId="{{ $class->id }}"
                ></x-mobile.schedule>
        @endif

    </div>
    
@endsection
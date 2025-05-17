@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}" backBtn={{ true }}></x-mobile.mobile-header>
    {{-- header --}}

    <div class="bg-white">
        <img
            src="{{ asset('img/class/room/' . $findClass->picture) }}"
            alt="Image {{ $title }}"
            class="w-full h-[40vh] object-cover"
            loading="lazy">
        <div class="px-5 mt-3 pb-24">
            <div class="font-semibold text-gray-800 text-2xl">{{ $title }}</div>
            <div class="mt-4">
                <div class="text-gray-400 text-sm">Desc:</div>
                <div class="text-gray-700 text-base">{{ $findClass->desc }}</div>
            </div>
            <div class="mt-4">
                <div class="text-gray-400 text-sm">Facility:</div>
                <div class="text-gray-700 text-base">
                    <table class="min-w-full border border-blue-300 text-sm text-left">
                        <tr>
                            <th class="border border-blue-300 py-2 ps-2 bg-blue-100">Name</th>
                            <th class="border border-blue-300 py-2 ps-2 bg-blue-100">Total</th>
                            <th class="border border-blue-300 py-2 ps-2 bg-blue-100">Condition</th>
                        </tr>
                        @foreach ($findClass->facilities as $item)
                            <tr>
                                <td class="border border-blue-300 py-2 ps-2 bg-white">
                                    {{ $item->name }}
                                </td>
                                <td class="border border-blue-300 py-2 ps-2 bg-white">
                                    {{ $item->total }}
                                </td>
                                <td class="border border-blue-300 py-2 ps-2 bg-white">
                                    @php $condition = $item->condition; @endphp
                                    @if ($condition == 'good')
                                        <span class="text-green-500 px-1 rounded-sm ms-2 h-fit text-xs bg-green-100">{{ $condition }}</span>
                                    @elseif ($condition == 'fair')
                                        <span class="text-yellow-500 px-1 rounded-sm ms-2 h-fit text-xs bg-yellow-100">{{ $condition }}</span>
                                    @elseif ($condition == 'broken')
                                        <span class="text-red-500 px-1 rounded-sm ms-2 h-fit text-xs bg-red-100">{{ $condition }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-gray-400 text-sm">Preview Room:</div>
                <button type="button" class="text-gray-700 text-base w-full bg-blue-100 rounded-md p-3 flex items-center justify-center border border-blue-300 cursor-pointer">
                    Clcik to view 360° Photo
                </button>
            </div>
            <div class="mt-4">
                <div class="text-gray-400 text-sm">Schedule:</div>
                <div class="overflow-x-auto">
                    <x-mobile.schedule :scheduleData="$findClass->schedule" className="{{ $title }}"></x-mobile.schedule>
                </div>
            </div>
        </div>
    </div>
@endsection
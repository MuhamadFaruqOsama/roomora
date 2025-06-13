@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}" backBtn={{ true }}></x-mobile.mobile-header>
    {{-- header --}}

    <div class="bg-white">
        <img
            src="{{ asset('storage/' . $findClass->picture) }}"
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
                    <table class="min-w-full border border-[#5aa9e6] text-sm text-left">
                        <tr>
                            <th class="border border-[#5aa9e6] text-white py-2 ps-2 bg-[#7fc8f8]">Name</th>
                            <th class="border border-[#5aa9e6] text-white py-2 ps-2 bg-[#7fc8f8]">Total</th>
                            <th class="border border-[#5aa9e6] text-white py-2 ps-2 bg-[#7fc8f8]">Condition</th>
                        </tr>
                        @foreach ($findClass->facilities as $item)
                            <tr>
                                <td class="border border-[#5aa9e6] py-2 ps-2 bg-white">
                                    {{ $item->name }}
                                </td>
                                <td class="border border-[#5aa9e6] py-2 ps-2 bg-white">
                                    {{ $item->total }}
                                </td>
                                <td class="border border-[#5aa9e6] py-2 ps-2 bg-white">
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
                <div class="text-gray-400 text-sm">Preview Room <span class="text-xs text-gray-400">(360° photo)</span>:</div>

                <script src="https://cdn.jsdelivr.net/npm/three@0.147/build/three.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/uevent@2/browser.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/photo-sphere-viewer@4/dist/photo-sphere-viewer.min.js"></script>
                
                <!-- the viewer container must have a defined size -->
                <div id="preview-360-class" style="width: 100%; height: 70vh;" data-image="{{ asset('storage/' . $findClass->preview_picture) }}"></div>
            </div>
            <div class="mt-4">
                <div class="text-gray-400 text-sm">Schedule:</div>
                <div class="overflow-x-auto">
                    <x-mobile.schedule 
                        scheduleData="{{ $findClass->schedule }}" 
                        className="{{ $title }}"
                        isProfileDataFilled="{{ $userProfileData }}"
                        classId="{{ $findClass->id }}"
                        ></x-mobile.schedule>
                </div>
            </div>
        </div>
    </div>
@endsection
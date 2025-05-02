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
    <div class="my-3 px-5 grid grid-cols-2">
        <div class="flex gap-2 overflow-auto pe-5">
            <button class="bg-[#FBBC05] rounded-full py-2 px-5 cursor-pointer text-base">
                Class
            </button>
            <button class="bg-gray-200 rounded-full py-2 px-5 cursor-pointer text-base">
                Schadule
            </button>
        </div>
        <div class="ps-2">
            {{-- <x-mobile.search-bar
                name="search-class"
                placeholder="Search class"
            ></x-mobile.search-bar> --}}
        </div>
    </div>
    {{-- search bar --}}

    {{-- class list --}}
    <div id="class-list" class="px-5 mb-24 grid gap-3 grid-cols-2">
        @foreach ($classList as $item)
            <x-mobile.class-card
                id="{{ $item['id'] }}"
                image="{{ $item['image'] }}"
                name="{{ $item['name'] }}"
                description="{{ $item['description'] }}"
            ></x-mobile.class-card>
        @endforeach
    </div>
    {{-- class list --}}

    {{-- navbar --}}
    <div class="fixed bottom-0 w-full sm:w-[70%] md:w-[40%]">
        <x-mobile.mobile-navbar title="{{ $title }}"></x-mobile.mobile-navbar>
    </div>
@endsection
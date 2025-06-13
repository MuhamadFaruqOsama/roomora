@php
    $title = "Offline";
@endphp

@extends('layouts.main')

@section('main-content')

    <div class="w-full h-screen relative bg-white">
        <div class="absolute top-0 left-0 w-full h-full flex flex-col justify-center items-center">
            <img src="{{ asset('img/app/offline.png') }}" alt="Offline" class="w-[200px] mb-4 mx-auto">
            <h1 class="text-2xl font-bold text-gray-800">Oops, You are offline</h1>
            <p class="text-gray-500">Please check your internet connection.</p>
        </div>
    </div>

@endsection
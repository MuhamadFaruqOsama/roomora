@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}"></x-mobile.mobile-header>
    {{-- header --}}

    {{-- profile picture --}}
    <div class="relative w-[100px] mx-auto">
        <img 
            src="{{ asset('img/class/room/room-1.jpg') }}" 
            alt="profile picture"
            class="w-full h-[100px] rounded-full border-4 border-white shadow-md mx-auto mt-4">
        <button type="button" class="absolute bottom-0 right-0 bg-[#FBBC05] w-[30px] h-[30px] rounded-full flex justify-center items-center">
            <i class="fa-regular fa-pen-to-square"></i>
        </button>
    </div>
    {{-- profile picture --}}

    {{-- profile section --}}
    <div class="px-5 my-5">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-1">
            <div class="text-[#24316F] border-b border-gray-200 px-3 py-1 text-sm">Profile</div>
            <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600 border-b border-gray-200">
                <i class="hgi hgi-stroke hgi-user-account text-lg"></i>
                Username
            </div>
            <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600 border-b border-gray-200">
                <i class="hgi hgi-stroke hgi-student text-lg"></i>
                Prodi
            </div>
            <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600">
                <i class="hgi hgi-stroke hgi-validation-approval text-lg"></i>
                Masuk Tanggal 2023
            </div>
        </div>
    </div>
    {{-- profile section --}}

    {{-- profile settings --}}
    <div class="px-5 mb-5">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-1">
            <div class="text-[#24316F] border-b border-gray-200 px-3 py-1 text-sm">Profile Settings</div>
            <button class="flex justify-between items-center w-full" type="button" data-drawer-target="edit-profile" data-drawer-show="edit-profile" aria-controls="edit-profile">
                <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600 border-b border-gray-200">
                    <i class="hgi hgi-stroke hgi-user-settings-01 text-lg"></i>
                    Edit Profile
                </div>
                <i class="hgi hgi-stroke hgi-circle-arrow-up-right me-3 text-lg text-gray-600"></i>
            </button>
            <button class="flex justify-between items-center w-full" type="button" data-drawer-target="change-password" data-drawer-show="change-password" aria-controls="change-password">
                <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600">
                    <i class="hgi hgi-stroke hgi-shield-key text-lg"></i>
                    Change Password
                </div>
                <i class="hgi hgi-stroke hgi-circle-arrow-up-right me-3 text-lg text-gray-600"></i>
            </button>
        </div>
    </div>
    {{-- profile settings --}}

    {{-- logout --}}
    <div class="px-5 mb-5 pb-24">
        <div class="bg-red-100 rounded-2xl shadow-sm border border-red-200 p-1">
            <a href="/logout" class="flex justify-between items-center">
                <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-red-600 border-b border-gray-200">
                    Logout
                </div>
                <i class="hgi hgi-stroke hgi-circle-arrow-up-right me-3 text-lg text-red-600"></i>
            </a>
        </div>
    </div>
    {{-- logout --}}

    {{-- edit profile --}}
    @include('components.mobile.edit-profile')
    {{-- edit profile --}}

    {{-- change password --}}
    @include('components.mobile.change-password')
    {{-- change password --}}

    {{-- navbar --}}
    <div class="fixed bottom-0 w-full sm:w-[70%] md:w-[40%]">
        <x-mobile.mobile-navbar title="{{ $title }}"></x-mobile.mobile-navbar>
    </div>
@endsection
@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}"></x-mobile.mobile-header>
    {{-- header --}}

    {{-- profile picture --}}
    <div class="relative w-[100px] mx-auto">
        <img 
            src="{{ asset('img/app/blank_pp.png') }}" 
            alt="profile picture"
            class="w-full h-[100px] rounded-full border-4 border-white shadow-md mx-auto mt-4">
        {{-- <button type="button" class="absolute bottom-0 right-0 bg-[#FBBC05] w-[30px] h-[30px] rounded-full flex justify-center items-center">
            <i class="fa-regular fa-pen-to-square"></i>
        </button> --}}
    </div>
    {{-- profile picture --}}

    {{-- profile section --}}
        <div class="px-5 mt-5">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-1">
                <div class="text-[#24316F] border-b border-gray-200 px-3 py-1 text-sm">User Data</div>
                <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600 border-b border-gray-200">
                    <i class="hgi hgi-stroke hgi-user text-lg"></i>
                    {{ $userData->username }}
                </div>
                <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600">
                    <span class="text-lg">@</span>
                    {{ $userData->email }}
                </div>
            </div>
        </div>
        {{-- profile section --}}

    @if ($data)
        {{-- profile section --}}
        <div class="px-5 mt-5">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-1">
                <div class="text-[#24316F] border-b border-gray-200 px-3 py-1 text-sm">User Profile</div>
                <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600 border-b border-gray-200">
                    <i class="hgi hgi-stroke hgi-user text-lg"></i>
                    {{ $data->full_name }}
                </div>
                <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600 border-b border-gray-200">
                    <i class="hgi hgi-stroke hgi-user-account text-lg"></i>
                    {{ $data->NIM }}
                </div>
                <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600 border-b border-gray-200">
                    <i class="hgi hgi-stroke hgi-student text-lg"></i>
                    {{ $data->major }}
                </div>
                <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600">
                    <i class="hgi hgi-stroke hgi-validation-approval text-lg"></i>
                    {{ \Carbon\Carbon::parse($data->entry_year)->locale('id')->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>
        {{-- profile section --}}
    @endif

    {{-- profile settings --}}
    <div class="px-5 my-5">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-1">
            <div class="text-[#24316F] border-b border-gray-200 px-3 py-1 text-sm">Profile Settings</div>
            <div class="block w-full border-b border-gray-200 pb-4">
                <div class="flex items-center gap-4 px-3 py-3 text-gray-600">
                    <i class="hgi hgi-stroke hgi-notification-01 text-lg"></i>
                    Email Notification
                </div>
                <div class="text-xs text-gray-500 px-3">
                    This allows the system to send notifications through your email.
                </div>
                <div class="flex justify-end px-3 mt-3">
                    <label for="toggle-email">
                        <input type="checkbox" id="toggle-email" {{ $userData->email_notification ? 'checked' : '' }} onchange="editEmailNotificationPermission()" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300
                            after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:w-5 after:h-5 after:bg-white after:border
                            after:border-gray-300 after:rounded-full after:transition-all
                            peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white">
                        </div>
                    </label>
                </div>
            </div>
            <button class="flex justify-between items-center w-full" type="button" data-drawer-target="edit-profile" data-drawer-show="edit-profile" aria-controls="edit-profile">
                <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600 border-b border-gray-200">
                    <i class="hgi hgi-stroke hgi-user-settings-01 text-lg"></i>
                    {{ $data != null ? 'Edit Profile' : 'Fill Profile Data' }}
                </div>
                <i class="hgi hgi-stroke hgi-circle-arrow-up-right me-3 text-lg text-gray-600"></i>
            </button>
            <button onclick="getNotification('feature is under development')" class="flex justify-between items-center w-full" type="button">
                <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-gray-600 border-b border-gray-200">
                    <i class="hgi hgi-stroke hgi-mail-at-sign-01 text-lg"></i>
                    Change Email
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
            <form action="{{ route('Logout-user') }}" method="post" id="logout-form">
                @csrf
                <button type="submit" class="flex justify-between items-center w-full">
                    <div class="w-full py-3 px-3 rounded-md flex gap-4 items-center text-red-600 border-b border-gray-200">
                        Logout
                    </div>
                    <i class="hgi hgi-stroke hgi-circle-arrow-up-right me-3 text-lg text-red-600"></i>
                </button>
            </form>
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
@extends('layouts/main')

@section('main-content')
    <div class="relative w-full min-h-screen bg-[#5aa9e6]">
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full sm:w-[90%] md:w-[400px]">
            <div class="flex justify-center items-center gap-5 mb-5 px-5 mt-5">
                <img 
                    src="{{ asset('img/app/logo.png') }}" 
                    alt="logo"
                    class="w-[70px]">
                <div class="flex flex-col">
                    <div class="text-white text-4xl font-semibold">Roomora</div>
                    <div class="text-xs text-gray-300">Manage your room, facilitate your study</div>
                </div>
            </div>
            <div class="bg-white shadow-lg p-5 w-full rounded-t-4xl border border-gray-300 min-h-[80vh]">
                <div class="text-2xl text-[#5aa9e6] mt-5 font-bold">Confirm OTP</div>
                <div class="text-gray-500 text-sm">We have sent an OTP code to the email you registered. Please enter the OTP code to verify your account.</div>
                <div class="border-t border-gray-200 w-full my-3"></div>
                <form action="{{ route('Verify-OTP') }}" method="POST" onsubmit="disableForm(event, 'verification')">
                    @csrf

                    {{-- OTP input --}}
                    <x-input-default
                        name="OTP"
                        placeholder="Input OTP here"
                        type="text">
                    </x-input-default>

                    {{-- submit button --}}
                    <div class="mt-5">
                        <x-button-default
                            type="submit"
                            text="verification"
                            name="verification"
                        ></x-button-default>
                    </div>
                </form>
                <button onclick="resendOTP()" class="text-center w-full" id="resend-btn">
                    <div class="mt-5 cursor-pointer text-blue-500 transition-all hover:text-blue-600 text-sm">Resend OTP</div>
                </button>
            </div>
        </div>
    </div>

@endsection
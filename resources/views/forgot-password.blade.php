@extends('layouts/main')

@section('main-content')
    <div class="relative w-full min-h-screen bg-[#24316F]">
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
                <div class="text-2xl text-[#24316F] mt-5 font-bold">Forgot Password</div>
                <div class="text-gray-500 text-sm">Please enter your email to make sure it's really you</div>
                <div class="border-t border-gray-200 w-full my-3"></div>
                <form action="">
                    {{-- tel input --}}
                    <x-input-default
                        name="Email"
                        placeholder="Input email here"
                        type="email">
                    </x-input-default>

                    {{-- submit button --}}
                    <div class="mt-5">
                        <x-button-default
                            type="submit"
                            text="Confirm"
                            name="Confirm"
                        ></x-button-default>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
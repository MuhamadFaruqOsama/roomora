@extends('layouts/main')

@section('main-content')
    
    <div class="relative w-full min-h-screen bg-[#24316F]">
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full sm:w-[90%] md:w-[400px]">
            <div class="flex justify-center items-center gap-5 mb-5 px-5">
                <img 
                    src="{{ asset('img/app/logo.png') }}" 
                    alt="logo"
                    class="w-[70px]">
                <div class="flex flex-col">
                    <div class="text-white text-4xl font-semibold">Roomora</div>
                    <div class="text-xs text-gray-300">Manage your room, facilitate your study</div>
                </div>
            </div>
            <div class="bg-white shadow-lg p-5 w-full rounded-t-4xl border border-gray-300 h-[80vh]">
                <div class="text-2xl text-[#24316F] mt-5 font-bold">Login</div>
                <div class="text-gray-500 text-sm">Hello, Welcome back!</div>
                <div class="border-t border-gray-200 w-full my-3"></div>
                <form action="{{ route('Auth') }}" method="POST" onsubmit="disableForm(event, 'login')">
                    @csrf
                    
                    {{-- email input --}}
                    <x-input-default
                        name="Email"
                        placeholder="Input Email here"
                        type="email">
                    </x-input-default>

                    {{-- password input --}}
                    <x-input-default
                        name="Password"
                        placeholder="Input Password here"
                        type="password">
                    </x-input-default>

                    {{-- <div class="my-3 text-end">
                        <a href="/forgot-password" class="cursor-pointer text-blue-500 transition-all hover:text-blue-600 text-sm">Forgot Password</a>
                    </div> --}}

                    {{-- submit button --}}
                    <x-button-default
                        type="submit"
                        text="Login"
                        name="login"
                    ></x-button-default>

                    {{-- OR --}}
                    <div class="border-t border-gray-200 w-full my-3"></div>
                    <div class="text-center">
                        <div class="text-gray-400 text-sm">Don't have an account yet? <a href="/register" class="cursor-pointer text-blue-500 transition-all hover:text-blue-600">Register here</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
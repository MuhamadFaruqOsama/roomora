@extends('layouts.detail-admin')

@section('main-content')

    {{-- header --}}
    <x-admin.back-header
        parentDirectory="Class Booking"
        currentDirectory="Detail booking {{ $title }}"
        id="{{ $findClass->id }}"   
    ></x-admin.back-header>
    {{-- header --}}

    
    {{-- detail --}}
    <div class="p-5 pb-10">
        <div class="relative">
            <ol class="relative text-gray-500 border-s-2 border-gray-400 ms-5 mt-5">
                <li class="mb-10 ms-5">
                    <span class="absolute flex items-center justify-center w-10 h-10 bg-green-200 rounded-full -start-5 ring-4 ring-green-300">
                        <svg class="w-4 h-4 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5.917 5.724 10.5 15 1.5"/>
                        </svg>
                    </span>
                    {{--  --}}
                    <div class="ms-5">
                        <div class="text-xs text-gray-500">Booking Request Detail:</div>
                        <div class="bg-white border border-gray-200 py-3 px-5">
                            {{--  --}}
                            <div class="flex flex-col mb-3">
                                <div class="text-sm text-gray-500">Title:</div>
                                <div class="text-gray-700 text-base">{{ $findClass->title }}</div>
                            </div>
                            {{--  --}}
                            {{--  --}}
                            <div class="flex flex-col mb-3">
                                <div class="text-sm text-gray-500">Class:</div>
                                <div class="text-gray-700 text-base">{{ $title }}</div>
                            </div>
                            {{--  --}}
                            {{--  --}}
                            <div class="flex flex-col mb-3">
                                <div class="text-sm text-gray-500">Day:</div>
                                <div class="text-gray-700 text-base">{{ \Carbon\Carbon::parse($findClass->date)->translatedFormat('l') }}</div>
                            </div>
                            {{--  --}}
                            {{--  --}}
                            <div class="flex flex-col mb-3">
                                <div class="text-sm text-gray-500">Time:</div>
                                <div class="text-gray-700 text-base">
                                    {{ \Carbon\Carbon::parse($findClass->start)->translatedFormat('H:i') }} - 
                                    {{ \Carbon\Carbon::parse($findClass->end)->translatedFormat('H:i') }}
                                </div>
                            </div>
                            {{--  --}}
                            {{--  --}}
                            <div class="flex flex-col mb-3">
                                <div class="text-sm text-gray-500">Date:</div>
                                <div class="text-gray-700 text-base">{{ \Carbon\Carbon::parse($findClass->date)->translatedFormat('d F Y') }}</div>
                            </div>
                            {{--  --}}
                            {{--  --}}
                            <div class="flex flex-col mb-3">
                                <div class="text-sm text-gray-500">Description:</div>
                                <div class="text-gray-700 text-base">{{ $findClass->desc }}</div>
                            </div>
                            {{--  --}}
                        </div>
                    </div>
                    {{--  --}}
                </li>
                <li class="mb-10 ms-6">
                    <span class="absolute flex items-center {{ $findClass->response != null ? 'text-green-500' : 'text-gray-500' }} justify-center w-10 h-10 {{ $findClass->response != null ? 'bg-green-200' : 'bg-white'}} rounded-full -start-5 ring-4 {{ $findClass->response != null ? 'ring-green-300' : 'ring-gray-200' }} ">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                            <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                        </svg>
                    </span>
                    <div class="ms-5">
                        <div class="text-xs text-gray-500">Your Response:</div>
                        <div class="p-5 bg-white border border-gray-200 me-5">
                            @if ($findClass->response != null)
                                {{--  --}}
                                <div class="flex flex-col mb-3">
                                    <div class="text-sm text-gray-500">Response:</div>
                                    <div class="text-gray-700 text-base">{{ $findClass->response }}</div>
                                </div>
                                {{--  --}}
                                {{--  --}}
                                <div class="flex flex-col mb-3">
                                    <div class="text-sm text-gray-500">Status:</div>
                                    @if ($findClass->status == 'accepted')
                                        <span class="text-green-500 px-2 py-1 w-fit rounded-full h-fit text-sm bg-green-100">{{ $findClass->status }}</span>
                                    @else
                                        <span class="text-red-500 px-2 py-1 w-fit rounded-full h-fit text-sm bg-red-100">{{ $findClass->status }}</span>
                                    @endif
                                </div>
                                {{--  --}}
                                {{--  --}}
                                <div class="flex flex-col mb-3">
                                    <div class="text-sm text-gray-500">Response given on :</div>
                                    <div class="text-gray-700 text-base">{{ \Carbon\Carbon::parse($findClass->response_created_at)->diffForHumans() }}</div>
                                </div>
                                {{--  --}}
                            @else
                                <form action="/admin/response-class/{{ $findClass->id }}" method="post" onsubmit="disableForm(event, 'response')" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="accept-reject" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Accept or reject booking</label>
                                        <select id="accept-reject" name="accept_reject" class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                            <option value="accept">Accept</option>
                                            <option value="reject">Reject</option>
                                        </select>
                                        @error('accept_reject')
                                            <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <textarea
                                            name="response"
                                            id="response"
                                            cols="30"
                                            rows="5"
                                            class="block w-full p-3 bg-white border border-gray-300 text-sm text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('response') ?? '' }}</textarea>
                                        @error('response')
                                            <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <x-button-default
                                        type="submit"
                                        text="Give Response"
                                        name="response"
                                    ></x-button-default>
                                </form>
                            @endif
                        </div>
                    </div>
                </li>
            </ol>
        </div>
    </div>
    {{-- detail --}}
@endsection
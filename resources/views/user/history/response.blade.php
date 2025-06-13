@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}" backBtn={{ true }}></x-mobile.mobile-header>
    {{-- header --}}

    @php
        $isComplaint = $responseData->activity == "complaint";
    @endphp

    

    <div class="relative">
        <ol class="relative text-gray-500 border-s border-gray-200 ms-5 mt-5">
            <li class="mb-10 ms-5">
                <span class="absolute flex items-center justify-center w-6 h-6 bg-green-200 rounded-full -start-3 ring-2 ring-green-300">
                    <svg class="w-3.5 h-3.5 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                </span>
                {{--  --}}
                    <div class="bg-white border border-gray-200 py-3 px-5 me-5">
                        <div class="flex gap-4">
                            <div class="w-full">
                                <div class="flex justify-between gap-4 w-full items-center pb-2 border-b border-gray-200">
                                    <div class="font-medium flex items-center">
                                        <span class="capitalize line-clamp-1 flex gap-4 items-center">
                                            @if ($isComplaint)
                                                <div class="flex gap-3">
                                                    <div class="w-8 h-8 text-white bg-[#ff6392] flex items-center justify-center rounded-full">
                                                        <i class="hgi hgi-stroke hgi-settings-error-01 text-xl font-medium"></i>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="flex gap-3">
                                                    <div class="w-8 h-8 text-white bg-[#5aa9e6] flex items-center justify-center rounded-full">
                                                        <i class="hgi hgi-stroke hgi-mail-validation-02 text-xl font-medium"></i>
                                                    </div>
                                                </div>
                                            @endif
                                            {{ $responseData->activity }}
                                        </span>
                                        @php
                                            $status = $isComplaint ? $responseData->complaint->status : $responseData->bookingClass->status;
                                        @endphp
                                        @if ($status == 'finished')
                                            <span class="text-green-500 px-2 py-1 rounded-full ms-2 h-fit text-xs bg-green-100">{{ $status }}</span>
                                        @elseif($status == 'pending')
                                            <span class="text-yellow-500 px-2 py-1 rounded-full ms-2 h-fit text-xs bg-yellow-100">{{ $status }}</span>
                                        @elseif($status == 'confirmed')
                                            <span class="text-blue-500 px-2 py-1 rounded-full ms-2 h-fit text-xs bg-blue-100">{{ $status }}</span>
                                        @elseif($status == 'rejected')
                                            <span class="text-red-500 px-2 py-1 rounded-full ms-2 h-fit text-xs bg-red-100">{{ $status }}</span>
                                        @endif
                                    </div>
                                    <div class="flex">
                                        <div class="text-xs text-gray-500 line-clamp-1">{{ \Carbon\Carbon::parse($isComplaint ? $responseData->complaint->created_at : $responseData->bookingClass->created_at)->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="mt-2 w-full">
                                    {{--  --}}
                                    <div class="grid mb-2.5 grid-cols-3 items-center">
                                        <div class="text-gray-500 text-sm flex items-center gap-1"><i class="hgi hgi-stroke hgi-checkmark-circle-02"></i> ID</div>
                                        <div class="text-start text-gray-800 col-span-2 line-clamp-1">: #{{ $responseData->id }}</div>
                                    </div>
                                    {{--  --}}
                                    {{--  --}}
                                    <div class="grid mb-2.5 grid-cols-3 items-center">
                                        <div class="text-gray-500 text-sm flex items-center gap-1"><i class="hgi hgi-stroke hgi-task-done-01"></i> Title</div>
                                        <div class="text-start text-gray-800 col-span-2 line-clamp-1">: {{ $isComplaint ? $responseData->complaint->title : $responseData->bookingClass->title }}</div>
                                    </div>
                                    {{--  --}}
                                    {{--  --}}
                                    <div class="grid mb-2.5 grid-cols-3 items-center">
                                        <div class="text-gray-500 text-sm flex items-center gap-1"><i class="hgi hgi-stroke hgi-plaza"></i> Class</div>
                                        <div class="text-start text-gray-800 col-span-2 line-clamp-1">: {{ $isComplaint ? $responseData->complaint->class->code . '-' . $responseData->complaint->class->name : $responseData->bookingClass->class->code . '-' . $responseData->bookingClass->class->name }}</div>
                                    </div>
                                    {{--  --}}
                                    {{--  --}}
                                    <div class="grid mb-2.5 grid-cols-3 items-center">
                                        <div class="text-gray-500 text-sm flex items-center gap-1"><i class="hgi hgi-stroke hgi-task-01"></i> Desc</div>
                                        <div class="text-start text-gray-800 col-span-2 line-clamp-1">: {{ $isComplaint ? $responseData->complaint->desc : $responseData->bookingClass->desc }}</div>
                                    </div>
                                    {{--  --}}
                                    {{--  --}}
                                    <div class="grid mb-2.5 grid-cols-3 items-center">
                                        <div class="text-gray-500 text-sm flex items-center gap-1"><i class="hgi hgi-stroke hgi-calendar-03"></i> Date</div>
                                        <div class="text-start text-gray-800 col-span-2 line-clamp-1">: {{ \Carbon\Carbon::parse($isComplaint ? $responseData->complaint->created_at : $responseData->bookingClass->date)->translatedFormat('l, d F Y') }}</div>
                                    </div>
                                    {{--  --}}
                                    @if (!$isComplaint)
                                        {{--  --}}
                                        <div class="grid mb-2.5 grid-cols-3 items-center">
                                            <div class="text-gray-500 text-sm flex items-center gap-1"><i class="hgi hgi-stroke hgi-clock-01"></i> Start at</div>
                                            <div class="text-start text-gray-800 col-span-2 line-clamp-1">: {{ \Carbon\Carbon::parse($responseData->bookingClass->start)->format('H:i') }}</div>
                                        </div>
                                        {{--  --}}
                                        {{--  --}}
                                        <div class="grid mb-2.5 grid-cols-3 items-center">
                                            <div class="text-gray-500 text-sm flex items-center gap-1"><i class="hgi hgi-stroke hgi-clock-01"></i> End at</div>
                                            <div class="text-start text-gray-800 col-span-2 line-clamp-1">: {{ \Carbon\Carbon::parse($responseData->bookingClass->end)->format('H:i') }}</div>
                                        </div>
                                        {{--  --}}
                                    @else
                                        {{--  --}}
                                        <div class="mb-2.5 items-center">
                                            <div class="text-gray-500 text-sm flex items-center gap-1">
                                                <i class="hgi hgi-stroke hgi-clock-01"></i> Photo Evidence
                                            </div>
                                            <img src="{{ asset('storage/'. $responseData->complaint->photo) }}" alt="{{ $responseData->complaint->photo }}" class="w-full h-[200px] object-cover rounded-lg mt-2" loading="lazy">
                                        </div>
                                        {{--  --}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                {{--  --}}
            </li>
            <li class="mb-10 ms-6">
                <span class="absolute flex items-center justify-center w-6 h-6 {{ ($isComplaint && !empty($responseData->complaint?->response)) || (!$isComplaint && !empty($responseData->bookingClass?->response)) ? 'bg-green-200 ring-green-300' : 'bg-gray-100 ring-white' }} rounded-full -start-3 ring-2 ">
                    <svg class="w-3.5 h-3.5 {{ ($isComplaint && !empty($responseData->complaint?->response)) || (!$isComplaint && !empty($responseData->bookingClass?->response)) ? 'text-green-500' : 'text-gray-500' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                    </svg>
                </span>
                {{--  --}}
                @if (
                    ($isComplaint && !empty($responseData->complaint?->response)) ||
                    (!$isComplaint && !empty($responseData->bookingClass?->response))
                )
                    <div class="px-5 py-2 bg-white border border-gray-200 me-5">
                        <div class="flex gap-4">
                            <div class="w-full">
                                <div class="flex justify-between gap-4 w-full items-center pb-2 border-b border-gray-200">
                                    <div class="font-medium flex items-center">
                                        <span class="capitalize line-clamp-1 flex gap-4 items-center">
                                            <div class="flex gap-3">
                                                <div class="w-8 h-8 bg-[#FBBC05] text-white flex items-center justify-center rounded-full">
                                                    <i class="hgi hgi-stroke hgi-manager text-xl font-medium"></i>
                                                </div>
                                            </div>
                                            Admin
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <div class="text-xs text-gray-500 line-clamp-1">{{ \Carbon\Carbon::parse($isComplaint ? $responseData->complaint->response_created_at : $responseData->bookingClass->response_created_at)->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="mt-2 w-full">
                                    {{--  --}}
                                    <div class="text-gray-500 text-sm">Response:</div>
                                    <div class="text-start text-gray-800 col-span-2 mb-1 line-clamp-1">{{ $isComplaint ? $responseData->complaint->response : $responseData->bookingClass->response }}</div>
                                    {{--  --}}
                                    {{--  --}}
                                    <div class="text-gray-500 text-sm mt-3">Status:</div>
                                    <div class="text-start text-gray-800 col-span-2 mb-1 line-clamp-1">
                                        @php
                                            $status = $isComplaint ? $responseData->complaint->status : $responseData->bookingClass->status;
                                        @endphp
                                        @if ($status == 'finished')
                                            <span class="text-green-500 px-2 py-1 rounded-full h-fit text-xs bg-green-100">{{ $status }}</span>
                                        @elseif($status == 'pending')
                                            <span class="text-yellow-500 px-2 py-1 rounded-full h-fit text-xs bg-yellow-100">{{ $status }}</span>
                                        @elseif($status == 'confirmed' || $status == 'accepted')
                                            <span class="text-blue-500 px-2 py-1 rounded-full h-fit text-xs bg-blue-100">{{ $status }}</span>
                                        @elseif($status == 'rejected')
                                            <span class="text-red-500 px-2 py-1 rounded-full h-fit text-xs bg-red-100">{{ $status }}</span>
                                        @endif
                                    </div>
                                    {{--  --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if ($isComplaint)
                        @if ($status != 'confirmed')
                            <div class="mt-5 px-5 flex gap-3 justify-end">
                                <a href="/app/complaint">
                                    <button class="py-2 px-4 rounded-full cursor-pointer bg-[#ff6392] text-sm text-white">Not Satisfied</button>
                                </a>
                                <button class="py-2 px-4 rounded-full cursor-pointer bg-[#FBBC05] text-sm text-white" onclick="confirmComplaint({{ $responseData->complaint->id }})">Confirm</button>
                            </div>
                        @endif
                    @else
                        @if ($responseData->bookingClass->status == 'rejected')
                            <div class="mt-5 px-5 flex gap-3 justify-end">
                                <a href="/app/class">
                                    <button class="py-2 px-4 rounded-full cursor-pointer bg-[#ff6392] text-sm text-white capitalize">look for another class</button>
                                </a>
                            </div>
                        @endif
                    @endif
                @else
                    <div class="text-gray-700">No Response Yet</div>
                    @if (!$isComplaint && $responseData->bookingClass->status == 'pending')
                        <div class="mt-5 px-5 flex gap-3 justify-end">
                            <button class="py-2 px-4 rounded-full cursor-pointer bg-[#ff6392] text-sm text-white capitalize" type="button" onclick="cancelBookingClass({{ $responseData->bookingClass->id }})">Cancel Booking</button>
                        </div>
                    @endif
                @endif
                {{--  --}}
            </li>
        </ol>
    </div>
@endsection
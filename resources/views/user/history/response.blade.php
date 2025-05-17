@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}" backBtn={{ true }}></x-mobile.mobile-header>
    {{-- header --}}

    @php
        $isComplaint = $responseData->activity == "complaint";
    @endphp
    
    <div class="bg-white border border-gray-200 py-3 px-5 mt-5">
        <div class="flex gap-4">
            @if ($isComplaint)
                <div class="flex gap-3">
                    <div class="w-14 h-14 bg-red-500 text-white flex items-center justify-center rounded-full">
                        <i class="hgi hgi-stroke hgi-settings-error-01 text-2xl font-medium"></i>
                    </div>
                </div>
            @else
                <div class="flex gap-3">
                    <div class="w-14 h-14 bg-green-500 text-white flex items-center justify-center rounded-full">
                        <i class="hgi hgi-stroke hgi-mail-validation-02 text-2xl font-medium"></i>
                    </div>
                </div>
            @endif
            <div class="w-full">
                <div class="flex justify-between gap-4 w-full items-center pb-2 border-b border-gray-200">
                    <div class="font-medium flex items-center">
                        <span class="capitalize line-clamp-1">{{ $responseData->activity }}</span>
                        @php
                            $status = $isComplaint ? $responseData->complaint->status : $responseData->bookingClass->status;
                        @endphp
                        @if ($status == 'finished')
                            <span class="text-green-500 px-1 rounded-sm ms-2 h-fit text-xs bg-green-100">{{ $status }}</span>
                        @elseif($status == 'pending')
                            <span class="text-yellow-500 px-1 rounded-sm ms-2 h-fit text-xs bg-yellow-100">{{ $status }}</span>
                        @elseif($status == 'confirmed')
                            <span class="text-blue-500 px-1 rounded-sm ms-2 h-fit text-xs bg-blue-100">{{ $status }}</span>
                        @elseif($status == 'rejected')
                            <span class="text-red-500 px-1 rounded-sm ms-2 h-fit text-xs bg-red-100">{{ $status }}</span>
                        @endif
                    </div>
                    <div class="flex">
                        <div class="text-xs text-gray-500 line-clamp-1">{{ \Carbon\Carbon::parse($isComplaint ? $responseData->complaint->created_at : $responseData->bookingClass->created_at)->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="mt-2 w-full">
                    {{--  --}}
                    <div class="grid grid-cols-3 items-center">
                        <div class="text-gray-500 text-sm mb-1">ID</div>
                        <div class="text-start text-gray-800 col-span-2 mb-1 line-clamp-1">#{{ $responseData->id }}</div>
                    </div>
                    {{--  --}}
                    {{--  --}}
                    <div class="grid grid-cols-3 items-center">
                        <div class="text-gray-500 text-sm mb-1">Title</div>
                        <div class="text-start text-gray-800 col-span-2 mb-1 line-clamp-1">{{ $isComplaint ? $responseData->complaint->title : $responseData->bookingClass->title }}</div>
                    </div>
                    {{--  --}}
                    {{--  --}}
                    <div class="grid grid-cols-3 items-center">
                        <div class="text-gray-500 text-sm">Class</div>
                        <div class="text-start text-gray-800 col-span-2 mb-1 line-clamp-1">{{ $isComplaint ? $responseData->complaint->class->code . '-' . $responseData->complaint->class->name : $responseData->bookingClass->class->code . '-' . $responseData->bookingClass->class->name }}</div>
                    </div>
                    {{--  --}}
                    {{--  --}}
                    <div class="grid grid-cols-3 items-center">
                        <div class="text-gray-500 text-sm">Desc</div>
                        <div class="text-start text-gray-800 col-span-2 mb-1 line-clamp-1">{{ $isComplaint ? $responseData->complaint->desc : $responseData->bookingClass->desc }}</div>
                    </div>
                    {{--  --}}
                </div>
            </div>
        </div>
    </div>

    @if (
        ($isComplaint && !empty($responseData->complaint?->response)) ||
        (!$isComplaint && !empty($responseData->bookingClass?->response))
    )
        <div class="mt-5 px-5 py-2 bg-white border border-gray-200">
            <div class="flex gap-4">
                <div class="flex gap-3">
                    <div class="w-14 h-14 bg-[#FBBC05] text-white flex items-center justify-center rounded-full">
                        <i class="hgi hgi-stroke hgi-manager text-2xl font-medium"></i>
                    </div>
                </div>
                <div class="w-full">
                    <div class="flex justify-between gap-4 w-full items-center pb-2 border-b border-gray-200">
                        <div class="font-medium flex items-center">
                            <span class="capitalize line-clamp-1">Admin</span>
                        </div>
                        <div class="flex">
                            <div class="text-xs text-gray-500 line-clamp-1">{{ \Carbon\Carbon::parse($isComplaint ? $responseData->complaint->response_created_at : $responseData->bookingClass->response_created_at)->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="mt-2 w-full">
                        {{--  --}}
                        <div class="text-gray-500 text-sm mb-2">Response:</div>
                        <div class="text-start text-gray-800 col-span-2 mb-1 line-clamp-1">{{ $isComplaint ? $responseData->complaint->response : $responseData->bookingClass->response }}</div>
                        {{--  --}}
                    </div>
                </div>
            </div>
        </div>
        
        @if ($isComplaint)
            @if ($status != 'confirmed')
                <div class="mt-5 px-5 flex gap-3 justify-end">
                    <a href="/app/complaint">
                        <button class="py-2 px-4 rounded-full cursor-pointer bg-red-500 text-sm text-white">Not Satisfied</button>
                    </a>
                    <button class="py-2 px-4 rounded-full cursor-pointer bg-[#FBBC05] text-sm text-white" onclick="confirmComplaint({{ $responseData->complaint->id }})">Confirm</button>
                </div>
            @endif
        @else
            @if ($responseData->bookingClass->status == 'rejected')
                <div class="mt-5 px-5 flex gap-3 justify-end">
                    <a href="/app/class">
                        <button class="py-2 px-4 rounded-full cursor-pointer bg-red-500 text-sm text-white capitalize">look for another class</button>
                    </a>
                </div>
            @endif
        @endif
    @else
        <div class="flex mt-3 px-5 justify-center text-gray-400">No Response Yet</div>
    @endif
@endsection
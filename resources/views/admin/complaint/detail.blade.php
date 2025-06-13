@extends('layouts.detail-admin')

@section('main-content')

    {{-- header --}}
    <x-admin.back-header
        parentDirectory="Complaint"
        currentDirectory="Detail {{ $title }}"        
    ></x-admin.back-header>
    {{-- header --}}

    <div class="p-5 pb-10">
        <div class="grid lg:grid-cols-3 gap-5">
            <div class="col-span-1">
                <div class="text-sm text-gray-500">Photo Evidence:</div>
                <img src="{{ asset('storage/' . $dataComplaint->photo) }}" alt="{{ $title }}" loading="lazy" class="w-full rounded-md">
            </div>
            <div class="col-span-2">
                <div class="text-xl text-gray-700 capitalize font-semibold mb-4">{{ $dataComplaint->title }}</div>
                {{--  --}}
                <div class="flex flex-col mb-3">
                    <div class="text-sm text-gray-500">Class:</div>
                    <div class="text-gray-700 text-base">{{ $title }}</div>
                </div>
                <div class="flex flex-col mb-3">
                    <div class="text-sm text-gray-500">Description:</div>
                    <div class="text-gray-700 text-base">{{ $dataComplaint->desc }}</div>
                </div>
                <div class="flex flex-col mb-3">
                    <div class="text-sm text-gray-500">Submited on:</div>
                    <div class="text-gray-700 text-base">{{ $dataComplaint->created_at->diffForHumans() }}</div>
                </div>
                <div class="flex flex-col">
                    <div class="text-sm text-gray-500">Status:</div>
                    <div class="text-gray-700 text-base">
                        @php
                            $status = $dataComplaint->status;
                        @endphp

                        @if ($status === 'pending')
                            <span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-yellow-100 text-yellow-500">{{ $status }}</span>
                        @elseif ($status === 'rejected')
                            <span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-red-100 text-red-500">{{ $status }}</span>
                        @elseif ($status === 'finished')
                            <span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-green-100 text-green-500">{{ $status }}</span>
                        @else
                            <span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-blue-100 text-blue-500">{{ $status }}</span>
                        @endif
                    </div>
                </div>
                {{--  --}}
                @if ($dataComplaint->response != null)
                    <div class="flex flex-col mb-3 mt-3">
                        <div class="text-sm text-gray-500">Response:</div>
                        <div class="text-gray-700 text-base">{{ $dataComplaint->response }}</div>
                    </div>
                    <div class="flex flex-col mb-3 mt-3">
                        <div class="text-sm text-gray-500">Response given to:</div>
                        <div class="text-gray-700 text-base">{{ \Carbon\Carbon::parse($dataComplaint->response_created_at)->diffForHumans() }}</div>
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-sm p-3 mt-4">
                        <form action="/admin/response-facility-complaint/{{ $dataComplaint->id }}" method="post" onsubmit="disableForm(event, 'submit')">
                            <label for="response" class="capitalize text-sm text-gray-600 font-semibold">provide a response to this complaint</label>
                            @csrf
                            <textarea 
                                name="response" 
                                id="response"
                                cols="30" 
                                rows="10"
                                class="block w-full p-3 bg-white border border-gray-300 text-sm text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('response') border-red-500 @enderror"
                                required>{{ old('response') ?? '' }}</textarea>
                            @error('response')
                                <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
                            @enderror
                            <div class="pt-2">
                                <x-button-default
                                    type="submit"
                                    text="Submit"
                                    name="submit"
                                ></x-button-default>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
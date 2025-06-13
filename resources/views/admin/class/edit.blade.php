@extends('layouts.detail-admin')

@section('main-content')

    {{-- header --}}
    <x-admin.back-header
        parentDirectory="Detail Class {{ $title }}"
        currentDirectory="Edit class {{ $title }}"        
    ></x-admin.back-header>
    {{-- header --}}

    
    {{-- detail --}}
    <div class="bg-white p-3">
        <!-- Modal body -->
        <form action="/admin/edit-class/{{ $findClass->id }}" method="POST" enctype="multipart/form-data" onsubmit="disableForm(event, 'update-class')">
            @csrf
            <div class="p-4 space-y-4">
                <div>
                    <x-input-default
                        name="Room_Code"
                        placeholder="Input room code here"
                        type="text"
                        value="{{ $findClass->code }}">
                    </x-input-default>
                </div>
                <div>
                    <x-input-default
                        name="Room_Name"
                        placeholder="Input room name here"
                        type="text"
                        value="{{ $findClass->name }}">
                    </x-input-default>
                </div>
                <div>
                    <label for="description" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Short Description (optional)</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        cols="30" 
                        rows="5" 
                        class="block w-full p-3 bg-white border border-gray-300 text-sm text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                        required>{{ $findClass->desc ?? old('description') ?? '' }}</textarea>
                    @error('description')
                        <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <div class="flex justify-between">
                        <label for="room-picture" class="block text-sm font-medium text-gray-700">Room Picture <span class="text-sm text-gray-500">(leave blank if not replaced)</span></label>
                    </div>
                    <input type="file" name="room_picture" class="filepond" accept="image/*" id="room-picture-input" capture="environment">
                    @error('room_picture')
                        <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label for="preview-picture" class="block text-sm font-medium text-gray-700">360° Picture <span class="text-sm text-gray-500">(leave blank if not replaced)</span></label>
                    <input type="file" name="preview_picture" class="filepond" accept="image/*" id="preview-picture-input" capture="environment">
                    @error('preview_picture')
                        <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <div class="flex gap-3 items-center my-3">
                        <div class="block mb-3 text-base font-medium text-gray-900 whitespace-nowrap">Class Facilities</div>
                        <div class="border-2 border-gray-300 w-full"></div>
                    </div>
                    <div id="facility-container">
                        @if ($findClass->facilities->count() == 0)
                            <div class="flex justify-between items-start gap-4 mb-4" id="facility-0">
                                <div class="grid grid-cols-4 gap-3 w-full">
                                    <div class="col-span-4">
                                        <label for="facility_name_0" class="block mb-1 text-sm line-clamp-1 font-medium text-gray-900 ms-3">Name</label>
                                        <input 
                                            type="text" 
                                            id="facility_name_0" 
                                            name="facility_name[]" 
                                            class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            placeholder="Input facility name here" 
                                            required 
                                        />
                                    </div>
                                    <div class="col-span-2">
                                        <label for="facility_condition_0" class="block mb-1 text-sm font-medium line-clamp-1 text-gray-900 ms-3">Condition</label>
                                        <select 
                                            id="facility_condition_0" 
                                            name="facility_condition[]" 
                                            class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            required>
                                            <option value="good">Good</option>
                                            <option value="fair">Fair</option>
                                            <option value="broken">Broken</option>
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="facility_total_0" class="block mb-1 text-sm font-medium text-gray-900 ms-3 line-clamp-1">Facility</label>
                                        <input 
                                            type="number" 
                                            id="facility_total_0" 
                                            name="facility_total[]" 
                                            class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            placeholder="Total" 
                                            required 
                                        />
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2 mt-6">
                                    <button type="button" onclick="addFacility()" class="py-1 px-3 text-xs rounded-full bg-yellow-300 cursor-pointer text-gray-900">Add</button>
                                </div>
                            </div>
                        @else
                            @foreach ($findClass->facilities as $key => $item)
                                <div class="flex justify-between items-start gap-4 mb-4" id="facility-{{ $key }}">
                                    <div class="grid grid-cols-4 gap-3 w-full">
                                        <div class="col-span-4">
                                            <label for="facility_name_{{ $key }}" class="block mb-1 text-sm line-clamp-1 font-medium text-gray-900 ms-3">Name</label>
                                            <input 
                                                type="text" 
                                                id="facility_name_{{ $key }}" 
                                                name="facility_name[]" 
                                                class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                                placeholder="Input facility name here" 
                                                required 
                                                value="{{ $item->name }}"
                                            />
                                        </div>
                                        <div class="col-span-2">
                                            <label for="facility_condition_{{ $key }}" class="block mb-1 text-sm font-medium line-clamp-1 text-gray-900 ms-3">Condition</label>
                                            <select 
                                                id="facility_condition_{{ $key }}" 
                                                name="facility_condition[]" 
                                                class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                                required>
                                                <option @if ($item->condition == "good") selected @endif value="good">Good</option>
                                                <option @if ($item->condition == "fair") selected @endif value="fair">Fair</option>
                                                <option @if ($item->condition == "broken") selected @endif value="broken">Broken</option>
                                            </select>
                                        </div>
                                        <div class="col-span-2">
                                            <label for="facility_total_{{ $key }}" class="block mb-1 text-sm font-medium text-gray-900 ms-3 line-clamp-1">Facility</label>
                                            <input 
                                                type="number" 
                                                id="facility_total_{{ $key }}" 
                                                name="facility_total[]" 
                                                class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                                placeholder="Total" 
                                                required 
                                                value="{{ $item->total }}"
                                            />
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-2 mt-6">
                                        @if ($key > 0)
                                            <button type="button" onclick="deleteFacility({{ $key }})" class="py-1 px-3 text-xs rounded-full bg-red-400 text-white">Delete</button>
                                        @endif
                                        <button type="button" onclick="addFacility()" class="py-1 px-3 text-xs rounded-full bg-yellow-300 cursor-pointer text-gray-900">Add</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-end p-4 space-x-3 border-t border-gray-200 rounded-b">
                <x-button-default
                    type="submit"
                    name="update-class"
                    text="Save Changes"
                ></x-button-default>
            </div>
        </form>
    </div>
    {{-- detail --}}
@endsection
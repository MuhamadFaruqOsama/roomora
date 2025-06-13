<!-- Add Room Modal -->
<div id="addRoomModal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto inset-0 h-auto">
    <div class="relative w-full mx-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm h-auto">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                <h3 class="text-xl font-medium text-gray-900">
                    Add New Room
                </h3>
                <button type="button" onclick="document.getElementById('addRoomModal').classList.add('hidden')" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('Add-Class-Admin') }}" method="POST" enctype="multipart/form-data" onsubmit="disableForm(event, 'add-class')">
                @csrf
                <div class="p-4 space-y-4">
                    <div>
                        <x-input-default
                            name="Room_Code"
                            placeholder="Input room code here"
                            type="text">
                        </x-input-default>
                    </div>
                    <div>
                        <x-input-default
                            name="Room_Name"
                            placeholder="Input room name here"
                            type="text">
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
                            required>{{ old('description') ?? '' }}</textarea>
                        @error('description')
                            <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="room-picture" class="block text-sm font-medium text-gray-700">Room Picture</label>
                        <input type="file" name="room_picture" class="filepond" accept="image/*" id="room-picture-input" capture="environment" required>
                        @error('room_picture')
                            <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="preview-picture" class="block text-sm font-medium text-gray-700">360° Picture (Optional)</label>
                        <input type="file" name="preview_picture" class="filepond" accept="image/*" id="preview-picture-input" capture="environment" required>
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
                            <div class="flex justify-between items-start gap-4 mb-4" id="facility-1">
                                <div class="grid grid-cols-4 gap-3 w-full">
                                    <div class="col-span-4">
                                        <label for="facility_name_1" class="block mb-1 text-sm line-clamp-1 font-medium text-gray-900 ms-3">Name</label>
                                        <input 
                                            type="text" 
                                            id="facility_name_1" 
                                            name="facility_name[]" 
                                            class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            placeholder="Input facility name here" 
                                            required 
                                        />
                                    </div>
                                    <div class="col-span-2">
                                        <label for="facility_condition_1" class="block mb-1 text-sm font-medium line-clamp-1 text-gray-900 ms-3">Condition</label>
                                        <select 
                                            id="facility_condition_1" 
                                            name="facility_condition[]" 
                                            class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            required>
                                            <option selected disabled>Choose condition</option>
                                            <option value="good">Good</option>
                                            <option value="fair">Fair</option>
                                            <option value="broken">Broken</option>
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="facility_total_1" class="block mb-1 text-sm font-medium text-gray-900 ms-3 line-clamp-1">Facility</label>
                                        <input 
                                            type="number" 
                                            id="facility_total_1" 
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
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 space-x-3 border-t border-gray-200 rounded-b">
                    <x-button-default
                        type="submit"
                        name="add-class"
                        text="Add Class"
                    ></x-button-default>
                </div>
            </form>
        </div>
    </div>
</div>
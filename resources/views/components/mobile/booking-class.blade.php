<div class="bg-white py-3 px-5 border border-gray-300">
    <div class="text-gray-900 pt-1 pb-4 mb-3 text-lg font-semibold border-b border-gray-200 text-center">Form Booking Class</div>
    <form action="{{ route('Book-Class') }}" method="POST" onsubmit="disableForm(event, 'booking-class')">
        @csrf
        
        {{-- kode kelas --}}
        <div class="mb-3">
            <label for="class-code" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Select class code</label>
            <select id="class-code" name="class_id" class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('class_id') border-red-500 @enderror" required>
                <option selected>Choose class</option>
                @foreach ($classData as $item)
                    <option value="{{ $item->id }}">{{ $item->code . '-' . $item->name }}</option>
                @endforeach
            </select>
            @error('class_id')
                <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
            @enderror
        </div>
        {{-- kode kelas --}}

        {{-- title --}}
        <div class="mb-3">
            {{-- username --}}
            <x-input-default
                name="Title"
                placeholder="Input title here"
                type="text">
            </x-input-default>
        </div>
        {{-- title --}}

        {{-- date --}}
        <div class="mb-3">
            {{-- username --}}
            <x-input-default
                name="Date"
                placeholder="Input date here"
                type="date">
            </x-input-default>
        </div>
        {{-- date --}}

        <div class="grid grid-cols-2 gap-2">
            {{-- start --}}
            <div class="mb-3">
                {{-- username --}}
                <x-input-default
                    name="Start"
                    placeholder="Input date here"
                    type="time">
                </x-input-default>
            </div>
            {{-- start --}}
            {{-- end --}}
            <div class="mb-3">
                {{-- username --}}
                <x-input-default
                    name="End"
                    placeholder="Input date here"
                    type="time">
                </x-input-default>
            </div>
            {{-- end --}}
        </div>

        {{-- deskripsi singkat --}}
        <div class="mb-3">
            <label for="description" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Short Description (optional)</label>
            <textarea 
                name="description" 
                id="description" 
                cols="30" 
                rows="5" 
                class="block w-full p-3 bg-white border border-gray-300 text-sm text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
        </div>
        {{-- deskripsi singkat --}}

        {{-- submit --}}
        <x-button-default
            type="submit"
            name="booking-class"
            text="Submit"
        ></x-button-default>
        {{-- submit --}}
    </form>
</div>
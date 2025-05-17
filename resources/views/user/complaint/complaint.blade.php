@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}"></x-mobile.mobile-header>
    {{-- header --}}

    {{-- form complaint --}}
    <div class="px-5 mt-3 mb-10 pb-24">
        <div class="bg-green-100 text-sm p-2 text-green-700 rounded-md border border-green-500">
            Please input the title, class code, photo evidence, and a short description if necessary to make it easier for the admin to handle it.
        </div>
        <form action="" method="post" class="mt-3" enctype="multipart/form-data" onsubmit="disableForm(event, 'complaint')" >
            @csrf
            {{-- kode kelas --}}
            <div class="mb-3">
                <label for="class-code" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Select class code</label>
                <select id="class-code" name="class_id" class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option selected>Choose class</option>
                    @foreach ($classData as $item)
                        <option value="{{ $item->id }}">{{ $item->code . '-' . $item->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- kode kelas --}}
            {{-- kode kelas --}}
            <div class="mb-3">
                <x-input-default
                    name="Title"
                    placeholder="Input title here"
                    type="text"
                ></x-input-default>
            </div>
            {{-- kode kelas --}}
            {{-- bukti foto --}}
            <div class="mb-3">
                <label for="photo-evidence" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Photo Evidence <span class="text-xs text-gray-400">(Max: 5)</span></label>
                <input type="file" name="photo_evidence[]" class="filepond" multiple data-max-files="5" accept="image/*" id="photo-evidence" capture="environment" required>
                @error('photo_evidence')
                    <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
                @enderror
                @error('photo_evidence.*')
                    <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
                @enderror
            </div>
            {{-- bukti foto --}}
            {{-- deskripsi singkat --}}
            <div class="mb-3">
                <label for="description" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Short Description (optional)</label>
                <textarea 
                    name="description" 
                    id="description" 
                    cols="30" 
                    rows="5" 
                    class="block w-full p-3 bg-white border border-gray-300 text-sm text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') ?? '' }}</textarea>
            </div>
            {{-- deskripsi singkat --}}

            {{-- submit --}}
            <x-button-default
                type="submit"
                name="complaint"
                text="Submit"
            ></x-button-default>
            {{-- submit --}}
        </form>
    </div>
    {{-- form complaint --}}

    {{-- navbar --}}
    <div class="fixed bottom-0 w-full sm:w-[70%] md:w-[40%]">
        <x-mobile.mobile-navbar title="{{ $title }}"></x-mobile.mobile-navbar>
    </div>
@endsection
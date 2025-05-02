@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}"></x-mobile.mobile-header>
    {{-- header --}}

    {{-- form complaint --}}
    <div class="px-5 mt-3 mb-10">
        <div class="bg-yellow-100 text-sm p-2 rounded-md border border-yellow-300">Please input the class code, photo evidence, and a short description if necessary to make it easier for the admin to handle it.</div>
        <form action="" method="post" class="mt-3">
            @csrf
            {{-- kode kelas --}}
            <div class="mb-3">
                <label for="class-code" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Select class code</label>
                <select id="class-code" class="block w-full p-3 rounded-full bg-gray-50 border border-gray-300 text-sm text-gray-900  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option selected>Choose class code</option>
                    <option value="">E-303</option>
                </select>
            </div>
            {{-- kode kelas --}}
            {{-- bukti foto --}}
            <div class="mb-3">
                <label for="photo-evidence" class="block mb-1 text-sm font-medium text-gray-900 ms-3">photo evidence</label>
                <input type="file" class="filepond" name="filepond[]" multiple data-max-files="5" id="photo-evidence" required> 
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
                    class="block w-full p-3 bg-gray-50 border border-gray-300 text-sm text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            {{-- deskripsi singkat --}}

            {{-- submit --}}
            <button 
                type="submit"
                class="w-full bg-[#FBBC05] text-white text-center transition-all duration-300 hover:bg-[#FBBC05] cursor-pointer py-3 rounded-full"
                >
                Submit
            </button>
            {{-- submit --}}
        </form>
    </div>
    {{-- form complaint --}}

    {{-- navbar --}}
    <div class="fixed bottom-0 w-full sm:w-[70%] md:w-[40%]">
        <x-mobile.mobile-navbar title="{{ $title }}"></x-mobile.mobile-navbar>
    </div>
@endsection
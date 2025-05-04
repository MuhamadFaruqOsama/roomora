<div class="bg-white rounded-lg p-3 border border-gray-300 shadow-sm">
    <div class="text-gray-900 pt-1 pb-4 mb-3 text-lg font-semibold border-b border-gray-200 text-center">Form Booking Class</div>
    <form action="">
        {{-- kode kelas --}}
        <div class="mb-3">
            <label for="class-code" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Select class code</label>
            <select id="class-code" class="block w-full p-3 rounded-full bg-gray-50 border border-gray-300 text-sm text-gray-900  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                <option selected>Choose class code</option>
                <option value="">E-303</option>
            </select>
        </div>
        {{-- kode kelas --}}

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
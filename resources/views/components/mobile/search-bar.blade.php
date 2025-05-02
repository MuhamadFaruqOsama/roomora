<div class="relative w-full">
    <input 
        type="text" 
        name="{{ $name }}" 
        id="search-{{ $name }}"
        autocomplete="on"
        placeholder="{{ $placeholder }}"
        class="block w-full py-3 px-5 rounded-full border border-gray-300 text-sm text-gray-900 bg-white 
            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        required
    >
    <i class="fa-solid fa-magnifying-glass text-lg absolute top-1/2 right-5 -translate-y-1/2"></i>
</div>
<div class="mb-3">
    {{-- label --}}
    <label 
        for="input-{{ $name }}" 
        class="block mb-1 text-sm font-medium text-gray-900 ms-3">
        {{ $name }}
    </label>

    {{-- input --}}
    <div class="relative">
        <input 
            type="{{ $type }}" 
            id="input-{{ $name }}" 
            value="{{ old($name) }}"
            class="block w-full p-3 rounded-full bg-gray-50 border border-gray-300 text-sm text-gray-900 
           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
            placeholder="{{ $placeholder }}" 
            name="{{ $name }}" 
            @if($value) 
                value="{{ $value }}"
            @endif
            @if($isRequired) required @endif
            @if($type == "password") 
                autocomplete="off" 
            @else
                autocomplete="on"
            @endif
            />

        {{-- if the type of the input is password, then show the toggle button --}}
        @if ($type == "password")
            <button
                id="button-{{ $name }}"
                type="button"
                class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer"
                onclick="showPassword('button-{{ $name }}','input-{{ $name }}')"
            >
                <i 
                    id="togglePassword"
                    class="fa-regular fa-eye"></i>
            </button>
        @endif
    </div>
</div>
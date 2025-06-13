@php
    $fieldName = strtolower($name);
@endphp

<div class="mb-3">
    {{-- label --}}
    <label 
        for="input-{{ $fieldName }}" 
        class="block mb-1 text-sm font-medium text-gray-900 ms-3">
        {{ str_replace(['_', '[', ']'], ' ', $name) }}
    </label>

    {{-- input --}}
    <div class="relative">
        <input 
            type="{{ $type }}" 
            id="input-{{ $fieldName }}" 
            class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 
           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error($fieldName) border-red-500 @enderror" 
            placeholder="{{ $placeholder }}" 
            name="{{ $fieldName }}" 
            value="{{ $value ?? old($fieldName) ?? '' }}"
            @if($isRequired) required @endif
            @if($isReadOnly) readonly @endif
            @if($type == "password") autocomplete="off" @else autocomplete="on" @endif
            />

        {{-- if the type of the input is password, then show the toggle button --}}
        @if ($type == "password")
            <button
                id="button-{{ $fieldName }}"
                type="button"
                class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer"
                onclick="showPassword('button-{{ $fieldName }}','input-{{ $fieldName }}')"
            >
                <i 
                    id="togglePassword"
                    class="fa-regular fa-eye"></i>
            </button>
        @endif
    </div>

    @error($fieldName)
        <small class="text-xs text-red-500 font-medium ms-3">{{ $message }}</small>
    @enderror
</div>
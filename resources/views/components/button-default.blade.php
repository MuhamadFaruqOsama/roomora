<button 
    type="{{ $type }}"
    id="button-{{ $name }}"
    class="w-full bg-[#FBBC05] text-white text-center transition-all duration-300 hover:bg-[#FBBC05] cursor-pointer py-3 rounded-full"
    @if($type == "submit")
        onclick="processing('button-{{ $name }}')"
    @endif
    >
    {{ $text }}
</button>
<a href="/app/class/{{ $id }}">
    <div class="bg-white border border-gray-200 rounded-lg relative overflow-hidden shadow-sm">
        <img src="{{ asset('img/class/room/' . $image) }}" alt="{{ $name }}" class="w-full h-32 object-cover rounded-t-lg" loading="lazy">
        <div class="bg-gradient-to-t from-black to-transparent absolute bottom-0 left-0 right-0 h-[29%] text-white flex flex-col items-center justify-center">
            <div class="text-base font-semibold">
                {{ $name }}
            </div>
            <div class="text-xs mb-2 -mt-1">
                {{ $description }}
            </div>
        </div>
    </div>
</a>
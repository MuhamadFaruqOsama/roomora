<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-3">
    <div class="flex justify-between items-center pb-2 border-b border-gray-300 mb-2">
        <div class="text-gray-800 font-semibold">
            {{ $type }} 
            @if ($status == 'finished')
                <span class="bg-green-500 px-1 rounded-sm ms-2 text-xs text-white">{{ $status }}</span>
            @elseif($status == 'pending')
                <span class="bg-yellow-500 px-1 rounded-sm ms-2 text-xs text-white">{{ $status }}</span>
            @elseif($status == 'rejected')
                <span class="bg-red-500 px-1 rounded-sm ms-2 text-xs text-white">{{ $status }}</span>
            @endif
            
        </div>
        <div class="text-gray-500 text-sm">{{ $time }}</div>
    </div>
    <div class="grid grid-cols-3">
        {{--  --}}
        <div class="text-gray-500 mb-1">Class :</div>
        <div class="text-start text-gray-800 font-semibold col-span-2 mb-1">{{ $class }}</div>
        {{--  --}}
        {{--  --}}
        <div class="text-gray-500 mb-1">Title :</div>
        <div class="text-start text-gray-800 text-sm col-span-2 mb-1">{{ $title }}</div>
        {{--  --}}
        @if ($type == 'complaint')
            {{--  --}}
            <div class="text-gray-500 mb-1">Image :</div>
            <a href="{{ asset('img/class/room/' . $image) }}" class="px-1 rounded-sm bg-yellow-600 text-white col-span-2 w-fit text-sm mb-1">show image</a>
            {{-- <div class="w-full col-span-2 pb-2">
                <img src="{{ asset('img/class/room/' . $image) }}" alt="booking class" class="h-16 rounded-md" loading="lazy">
            </div> --}}
            {{--  --}}
        @endif
        {{--  --}}
        <div class="text-gray-500">Desc :</div>
        <div class="text-start text-gray-800 text-sm col-span-2">{{ $description }}</div>
        {{--  --}}
    </div>
</div>
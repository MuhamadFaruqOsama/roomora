<div class="bg-white border border-gray-200 py-3 px-5">
    <div class="flex gap-4">
        @if ($type == "complaint")
            <div class="flex gap-3">
                <div class="w-14 h-14 bg-red-500 text-white flex items-center justify-center rounded-full">
                    <i class="hgi hgi-stroke hgi-settings-error-01 text-2xl font-medium"></i>
                </div>
            </div>
        @else
            <div class="flex gap-3">
                <div class="w-14 h-14 bg-green-500 text-white flex items-center justify-center rounded-full">
                    <i class="hgi hgi-stroke hgi-mail-validation-02 text-2xl font-medium"></i>
                </div>
            </div>
        @endif
        <div class="w-full">
            <div class="flex justify-between gap-4 w-full items-center pb-2 border-b border-gray-200">
                <div class="font-medium flex items-center">
                    <span class="capitalize line-clamp-1">{{ $type }}</span>
                    @if ($status == 'finished')
                        <span class="text-green-500 px-1 rounded-sm ms-2 h-fit text-xs bg-green-100">{{ $status }}</span>
                    @elseif($status == 'pending')
                        <span class="text-yellow-500 px-1 rounded-sm ms-2 h-fit text-xs bg-yellow-100">{{ $status }}</span>
                    @elseif($status == 'confirmed')
                        <span class="text-blue-500 px-1 rounded-sm ms-2 h-fit text-xs bg-blue-100">{{ $status }}</span>
                    @elseif($status == 'rejected')
                        <span class="text-red-500 px-1 rounded-sm ms-2 h-fit text-xs bg-red-100">{{ $status }}</span>
                    @endif
                </div>
                <div class="flex">
                    <div class="text-xs text-gray-500 line-clamp-1">{{ \Carbon\Carbon::parse($time)->diffForHumans() }}</div>
                </div>
            </div>
            <div class="mt-2 w-full pb-2 border-b border-gray-200">
                {{--  --}}
                <div class="grid grid-cols-3 items-center">
                    <div class="text-gray-500 text-sm mb-1">ID</div>
                    <div class="text-start text-gray-800 col-span-2 mb-1 line-clamp-1">#{{ $id }}</div>
                </div>
                {{--  --}}
                {{--  --}}
                <div class="grid grid-cols-3 items-center">
                    <div class="text-gray-500 text-sm mb-1">Title</div>
                    <div class="text-start text-gray-800 col-span-2 mb-1 line-clamp-1">{{ $title }}</div>
                </div>
                {{--  --}}
                {{--  --}}
                <div class="grid grid-cols-3 items-center">
                    <div class="text-gray-500 text-sm">Class</div>
                    <div class="text-start text-gray-800 col-span-2 mb-1 line-clamp-1">{{ $class }}</div>
                </div>
                {{--  --}}
            </div>
            <div class="mt-2 flex justify-end">
                <a href="{{ '/app/response/' . $id }}">
                    <button class="py-2 px-4 rounded-full bg-[#FBBC05] text-white text-sm hover:[#FBBC05] cursor-pointer">See Detail</button>
                </a>
            </div>
        </div>
    </div>
</div>
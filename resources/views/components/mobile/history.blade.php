@php
    $badgeType = $type == "complaint" ? "complaint" : "booking-class";
@endphp

<div class="bg-white py-3 px-5 shadow-sm {{ $type == "complaint" ? 'border-s-4 border-[#ff6392]' : 'border-s-4 border-[#5aa9e6]'}}">
    <div class="flex gap-4">
        <div class="w-full">
            <div class="flex justify-between gap-4 w-full items-center pb-2 border-b border-gray-200">
                <div class="font-medium flex items-center">
                    <span class="capitalize line-clamp-1 flex gap-4 items-center">
                        @if ($type == "complaint")
                            <div class="flex gap-3">
                                <div class="w-8 h-8 text-white bg-[#ff6392] flex items-center justify-center rounded-full">
                                    <i class="hgi hgi-stroke hgi-settings-error-01 text-xl font-medium"></i>
                                </div>
                            </div>
                        @else
                            <div class="flex gap-3">
                                <div class="w-8 h-8 text-white bg-[#5aa9e6] flex items-center justify-center rounded-full">
                                    <i class="hgi hgi-stroke hgi-mail-validation-02 text-xl font-medium"></i>
                                </div>
                            </div>
                        @endif
                        {{ $type }}
                    </span>
                    <div id="{{ $badgeType }}-badge-{{ $description }}">
                        @if ($status == 'finished')
                            <span class="text-green-500 px-2 py-1 rounded-full ms-2 h-fit text-xs bg-green-100">{{ $status }}</span>
                        @elseif($status == 'pending')
                            <span class="text-yellow-500 px-2 py-1 rounded-full ms-2 h-fit text-xs bg-yellow-100">{{ $status }}</span>
                        @elseif($status == 'confirmed' || $status == 'accepted')
                            <span class="text-blue-500 px-2 py-1 rounded-full ms-2 h-fit text-xs bg-blue-100">{{ $status }}</span>
                        @elseif($status == 'rejected')
                            <span class="text-red-500 px-2 py-1 rounded-full ms-2 h-fit text-xs bg-red-100">{{ $status }}</span>
                        @endif
                    </div>
                </div>
                <div class="flex">
                    <div class="text-xs text-gray-500 line-clamp-1">{{ \Carbon\Carbon::parse($time)->diffForHumans() }}</div>
                </div>
            </div>
            <div class="mt-2 w-full pb-2 border-b border-gray-200">
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
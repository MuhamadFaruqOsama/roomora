<div class="flex justify-between items-center gap-4 px-4 py-4 bg-white shadow-sm">
    <div class="flex justify-start items-center gap-4 ">
        <button type="button" class="flex items-center justify-center text-xl w-10 h-10 rounded-full hover:bg-gray-200 cursor-pointer" onclick="history.go(-1)">
            <i class="hgi hgi-stroke hgi-arrow-left-03"></i>
        </button>
        <div class="flex gap-3 items-end border-s border-gray-300 ps-4">
            <button type="button" onclick="history.go(-1)">
                <div class="text-gray-600 hover:underline line-clamp-1">{{ $parentDirectory }}</div>
            </button>
            <i class="hgi hgi-stroke hgi-arrow-right-01"></i>
            <div class="text-xl text-gray-700 font-medium line-clamp-1">{{ $currentDirectory }}</div>
        </div>
    </div>

    @if ($menu && $id != null)
        <button class="w-10 h-10 rounded-full hover:bg-gray-200 cursor-pointer" id="button-menu-dropdown" data-dropdown-toggle="menu-dropdown">
            <i class="hgi hgi-stroke hgi-more-vertical-circle-01"></i>
        </button>

        <div id="menu-dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-gray-200 shadow-sm w-44">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="button-menu-dropdown">
                <li>
                    <a href="/admin/edit-class/{{ $id }}" class="block px-4 py-2 hover:bg-gray-100">Edit This Class</a>
                </li>
                <li>
                    <button type="button" onclick="confirmModal('Do you really want to delete this class?', {{ $id }})" class="block px-4 py-2 hover:bg-gray-100 w-full cursor-pointer text-left">
                        Delete This Class
                    </button>
                </li>
            </ul>
        </div>
    @endif
</div>
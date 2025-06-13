<div class="bg-[#5aa9e6] text-center py-3 px-5 text-white font-semibold text-lg relative">
    {{ $title }}

    @if ($backBtn)
        <a onclick="history.go(-1)" class="cursor-pointer text-white absolute top-1/2 -translate-y-1/2 text-2xl left-5"><i class="hgi hgi-stroke hgi-arrow-left-03"></i></a>
    @endif
</div>
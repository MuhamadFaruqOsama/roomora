<div class="px-5 mb-4">
    <div class="bg-[#ff639214] text-sm p-2 text-gray-700 rounded-tr-lg rounded-br-lg shadow-sm border-s-4 border-[#ff6392]">
        You can directly click on the empty schedule to book the class.
        @if ($userProfileData == null)
            But you can't book the class before you full fill the profile data first on the profile page, or follow this link: <a href="/app/profile" class="underline font-medium">Fill Profile Data</a>
        @endif
    </div>
</div>

<div id="accordion-flush" class="px-5" data-accordion="collapse" data-active-classes="bg-[#ffe45e]" data-inactive-classes="bg-white text-gray-700 bg-blue-100">
    @foreach ($scheduleClass as $key => $item)
        <h2 id="accordion-flush-heading-{{ $key }}">
            <button type="button"
                class="flex items-center justify-between w-full px-5 py-3 font-medium rtl:text-right text-gray-500 border-b border-gray-200 gap-3"
                data-accordion-target="#accordion-flush-body-{{ $key }}"
                aria-expanded="false"
                aria-controls="accordion-flush-body-{{ $key }}">
                <span>{{ $item->code . '-' . $item->name }}</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-flush-body-{{ $key }}" class="hidden" aria-labelledby="accordion-flush-heading-{{ $key }}">
            <div class="py-3 border-b border-gray-200 overflow-x-auto">
                <x-mobile.schedule 
                    :scheduleData="$item->schedule" 
                    className="{{ $item->code . '-' . $item->name }}" 
                    modalKey="{{ $key }}"
                    isProfileDataFilled="{{ $userProfileData }}"
                    classId="{{ $item->id }}"
                    />
            </div>
        </div>
    @endforeach
</div>

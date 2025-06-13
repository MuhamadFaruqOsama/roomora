<!-- drawer component -->
<div id="notification-detail" class="fixed top-0 left-0 z-40 h-screen py-4 overflow-y-auto transition-transform -translate-x-full bg-white w-full" tabindex="-1" aria-labelledby="drawer-label">
    <div class="px-5">
        <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500">
            Notification <div class="text-sm text-gray-500 font-normal ms-2">(Last 7 days)</div>
        </h5>
        <button type="button" data-drawer-hide="notification-detail" aria-controls="notification-detail" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center" >
           <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
           </svg>
           <span class="sr-only">Close menu</span>
        </button>
    </div>
       
    {{--  --}}
        <div id="notification-list" class="px-5">
            @foreach ($dataNotification as $item)
                <a href="/app/response/{{ $item->id }}">
                    <div class="text-sm p-2 mb-2 text-gray-700 shadow-sm border-s-4 {{ $item->complaint ? 'border-[#ff6392] bg-[#ff639214]' : 'border-[#5aa9e6] bg-[#5aa9e61f]' }}">
                        <div class="text-gray-700 font-medium mb-2 capitalize flex justify-between">
                            {{ $item->complaint ? 'complaint' : 'booking class' }}
                            <div class="text-xs text-gray-500">
                                {{ $item->complaint ? \Carbon\Carbon::parse($item->complaint->response_created_at)->diffForHumans() : \Carbon\Carbon::parse($item->bookingClass->response_created_at)->diffForHumans() }}
                            </div>
                        </div>
                        <div class="text-sm text-gray-600 line-clamp-2">
                            <div class="text-sm text-gray-600 line-clamp-2">
                                @if ($item->complaint)
                                    Your complaint about <span class="font-medium text-black">"{{ $item->complaint->title }}"</span> has been responded to by the admin. Click to see the response
                                @else
                                    Your booking class <span class="font-medium text-black">"{{ $item->bookingClass->class->code . '-' . $item->bookingClass->class->name}}"</span> has been responded to by the admin. Click here to see the response
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    {{--  --}}
 </div>
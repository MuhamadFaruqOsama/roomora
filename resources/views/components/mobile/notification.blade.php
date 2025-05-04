<!-- drawer component -->
<div id="notification-detail" class="fixed top-0 left-0 z-40 h-screen py-4 overflow-y-auto transition-transform -translate-x-full bg-white w-full" tabindex="-1" aria-labelledby="drawer-label">
    <div class="px-5">
        <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500">
            Notification
        </h5>
        <button type="button" data-drawer-hide="notification-detail" aria-controls="notification-detail" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center" >
           <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
           </svg>
           <span class="sr-only">Close menu</span>
        </button>
    </div>
       
    {{-- notification list --}}
    <div id="notification-list">
        <div class="bg-yellow-50 border-t border-b border-yellow-200 w-full py-2 px-5">
            <div class="flex justify-between items-center mb-2">
                <div class="text-gray-800 font-medium text-md">Notification</div>
                <div class="text-gray-700 text-xs">09:00</div>
            </div>
            <div class="text-gray-500 text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium, atque necessitatibus numquam inventore perferendis quos ab quis eos hic delectus?</div>
            <div class="flex justify-end mt-2">
                <button type="button" class="text-yellow-500 text-base font-semibold">Confirm</button>
            </div>
        </div>
    </div>
    {{-- notification list --}}
 </div>
<!-- drawer component -->
<div id="change-password" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-full" tabindex="-1" aria-labelledby="drawer-label">
    <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500">
        Change Password
    </h5>
    <button type="button" data-drawer-hide="change-password" aria-controls="change-password" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center" >
       <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
       </svg>
       <span class="sr-only">Close menu</span>
    </button>
       
    {{-- form edit --}}
    <form action="{{ route('Change-Password') }}" method="post" onsubmit="disableForm(event, 'change-password')">
        @csrf
        {{-- username --}}
        <x-input-default
            name="Old_Password"
            placeholder="Input old password here"
            type="password">
        </x-input-default>
        {{-- username --}}

        {{-- name --}}
        <x-input-default
            name="New_Password"
            placeholder="Input new password here"
            type="password">
        </x-input-default>
        {{-- name --}}

        {{-- nim --}}
        <x-input-default
            name="Confirm_Password"
            placeholder="Input confirm password here"
            type="password">
        </x-input-default>
        {{-- nim --}}

        {{-- submit button --}}
        <div class="mt-5">
            <x-button-default
                type="submit"
                text="Change Password"
                name="change-password"
            ></x-button-default>
        </div>
    </form>
    {{-- form edit --}}
 </div>
<!-- drawer component -->
<div id="edit-profile" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-full" tabindex="-1" aria-labelledby="drawer-label">
    <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500">
        Edit Profile
    </h5>
    <button type="button" data-drawer-hide="edit-profile" aria-controls="edit-profile" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center" >
       <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
       </svg>
       <span class="sr-only">Close menu</span>
    </button>
       
    {{-- form edit --}}
    <form action="" method="post">
        @csrf
        {{-- username --}}
        <x-input-default
            name="Username"
            placeholder="Input username here"
            type="text">
        </x-input-default>
        {{-- username --}}

        {{-- name --}}
        <x-input-default
            name="Name"
            placeholder="Input name here"
            type="text">
        </x-input-default>
        {{-- name --}}

        {{-- nim --}}
        <x-input-default
            name="NIM"
            placeholder="Input NIM here"
            type="text">
        </x-input-default>
        {{-- nim --}}

        {{-- major --}}
        <x-input-default
            name="Major"
            placeholder="Input major here"
            type="text">
        </x-input-default>
        {{-- major --}}

        {{-- major --}}
        <x-input-default
            name="Entry-Year"
            placeholder="Input entry year here"
            type="date">
        </x-input-default>
        {{-- major --}}

        {{-- submit button --}}
        <div class="mt-5">
            <x-button-default
                type="submit"
                text="Save Changes"
                name="save-changes"
            ></x-button-default>
        </div>
    </form>
    {{-- form edit --}}
 </div>
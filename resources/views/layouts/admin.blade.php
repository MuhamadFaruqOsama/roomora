<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- PWA --}}
    <!-- Web Application Manifest -->
    <link rel="manifest" href="/manifest.json">
    <!-- Chrome for Android theme color -->
    <meta name="theme-color" content="#000000">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="PWA">
    <link rel="icon" sizes="512x512" href="/images/icons/icon-512x512.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="PWA">
    <link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">

    <link href="/images/icons/splash-640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-750x1334.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-1242x2208.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-828x1792.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-1242x2688.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-1536x2048.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-1668x2224.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-1668x2388.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-2048x2732.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

    <!-- Tile for Win8 -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/icons/icon-512x512.png">

    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- tailwind --}}
    {{-- @vite('resources/css/app.css') --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-Dp8lEPYM.css') }}">

    {{-- global css --}}
    <link rel="stylesheet" href="{{ asset('css/globals.css') }}">

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- hugeicons --}}
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

    {{-- dropify --}}
    <link rel="stylesheet" href="{{ asset('css/dropify.min.css') }}" />

    <!-- FilePond Core -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <!-- Plugin Preview Gambar -->
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

    <!-- Plugin Compress dan Resize -->
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>

    {{-- grid js --}}
    <link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />

    {{-- notif --}}
    <link rel="stylesheet" href="{{ asset('css/notyf.min.css') }}">

    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

    @laravelPWA

    {{-- title --}}
    <title>{{ $title }}</title>
</head>
<body>

    {{-- sidebar data --}}
    @php
        $navItems = [
            [
                'title' => 'Dashboard', 
                'icon' => 'hgi hgi-stroke hgi-pie-chart', 
                'route' => '/admin/dashboard',
            ],
            [
                'title' => 'Class', 
                'icon' => 'hgi hgi-stroke hgi-building-03', 
                // 'route' => '/admin/class-management',
                'data' => [
                    [
                        'title' => 'Class Management',
                        'icon' => 'hgi hgi-stroke hgi-building-03',
                        'route' => '/admin/class-management',
                    ],
                    [
                        'title' => 'Class Booking', 
                        'icon' => 'hgi hgi-stroke hgi-clock-04', 
                        'route' => '/admin/class-booking',
                    ],
                ],
            ],
            [
                'title' => 'Schedule', 
                'icon' => 'hgi hgi-stroke hgi-calendar-03', 
                'route' => '/admin/schedule',
            ],
            [
                'title' => 'Facility Complaint', 
                'icon' => 'hgi hgi-stroke hgi-customer-service-01', 
                'route' => '/admin/facility-complaint',
            ]
        ];
    @endphp
    {{-- sidebar data --}}

    {{-- main content --}}
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-white">
            <a href="/admin/dashboard" class="flex items-center ps-2.5 mb-5">
                <img 
                    src="{{ asset('img/app/logo.png') }}" 
                    alt="logo"
                    class="w-[40px]">
                <div class="ms-2">
                    <span class="self-center text-xl font-semibold whitespace-nowrap">Roomora</span>
                    <div class="text-xs text-gray-600">Manage your room, facilitate your study</div>
                </div>
            </a>
            <ul class="space-y-2 font-medium">
                @foreach ($navItems as $key => $item)
                    @if (isset($item['data']))
                        <li>
                            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group {{ $title == $item['title'] ? 'bg-[#ff6392] hover-[#ff639269] text-white' : 'hover:bg-gray-100 text-gray-900' }}" aria-controls="dropdown-example-{{ $key }}" data-collapse-toggle="dropdown-example-{{ $key }}">
                                <i class="{{ $item['icon'] }} text-xl font-medium"></i>
                                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">
                                    {{ $item['title'] }}
                                </span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                            <ul id="dropdown-example-{{ $key }}" class="hidden py-2 space-y-2">
                                @foreach ($item['data'] as $item)
                                    <li>
                                        <a href="{{ $item['route'] }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group {{ $title == $item['title'] ? 'bg-[#ff6392] hover-[#ff639269] text-white' : 'hover:bg-gray-100 text-gray-900' }}">{{ $item['title'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ $item['route'] }}" class="flex items-center p-2 text-gray-900 rounded-lg {{ $title == $item['title'] ? 'bg-[#ff6392] hover-[#ff639269] text-white' : 'hover:bg-gray-100 text-gray-900' }} group">
                                <i class="{{ $item['icon'] }} text-xl font-medium"></i>
                                <span class="ms-3">{{ $item['title'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </aside>

    <div class="sm:ml-64 bg-gray-100 min-h-screen">
        <x-admin.admin-header title="{{ $title }}"></x-admin.admin-header>
        <div class="p-4">
            @yield('main-content')
        </div>
    </div>
    {{-- main content --}}

    {{-- modal --}}
    @if ($title == "Class Management")
        @include('components.admin.add-class')
    @endif
    {{-- modal --}}

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/910e994c98.js" crossorigin="anonymous"></script>

    {{-- SHARING JAVASCRIPT --}}
        {{-- jquery --}}
        {{-- <script src="{{ asset('js/sharing/jquery-3.7.1.min.js') }}"></script> --}}

        {{-- bootstrap js --}}
        {{-- @vite('resources/js/app.js') --}}
        <script src="{{ asset('build/assets/app-B_072z63.js') }}"></script>

        {{-- sweet alert --}}
        <script src="{{ asset('js/sharing/sweetalert2.min.js') }}"></script>

        {{-- toast --}}
        <script src="{{ asset('js/sharing/notyf.min.js') }}"></script>

        {{-- notif function --}}
        <script src="{{ asset('js/sharing/notyf.js') }}"></script>

        {{-- showPassword --}}
        <script src="{{ asset('js/sharing/showPassword.js') }}"></script>

        {{-- form --}}
        <script src="{{ asset('js/sharing/form.js') }}"></script>

        {{-- dropify --}}
        <script src="{{ asset('js/sharing/image-upload.js') }}"></script>

        {{-- switch class menu --}}
        <script src="{{ asset('js/user/switch-class-menu.js') }}"></script>

        {{-- OTP --}}
        <script src="{{ asset('js/user/OTP.js') }}"></script>

        {{-- chart js --}}
        <script src="{{ asset('js/sharing/chart.umd.js') }}"></script>

        {{-- admin --}}
        <script src="{{ asset('js/admin/dashboard.js') }}"></script>

        {{-- table --}}
        <script src="{{ asset('js/admin/table.js') }}"></script>
        
        {{-- class facility --}}
        <script src="{{ asset('js/admin/facility.js') }}"></script>

        {{-- realtime notification --}}
        <script src="{{ asset('js/admin/realtime-notification.js') }}"></script>

        {{-- grid js --}}
        <script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
        
        {{-- confirm --}}
        <script src="{{ asset('js/admin/confirm.js') }}"></script>

        {{-- class --}}
        <script src="{{ asset('js/admin/class.js') }}"></script>

    {{-- dropify --}}
    <script src="{{ asset('js/sharing/dropify.min.js') }}"></script>

    {{-- flowbite --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    @if(session('return_message'))
        @php
            $message = session('return_message');
        @endphp
        <script>
            getNotification("{{ $message['message'] }}", "{{ $message['status'] }}")
        </script>
    @endif

    {{-- pwa service worker --}}
    <script type="text/javascript">
        // Initialize the service worker
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('../serviceworker.js', {
                scope: '.'
            }).then(function (registration) {
                // Registration was successful
                console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
            }, function (err) {
                // registration failed :(
                console.log('Laravel PWA: ServiceWorker registration failed: ', err);
            });
        }
    </script>
</body>
</html>
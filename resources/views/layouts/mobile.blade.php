<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="user-id" content="{{ Auth::id() ?? '' }}">

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

    <!-- 360 photo -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photo-sphere-viewer@4/dist/photo-sphere-viewer.min.css"/>

    {{-- notif --}}
    <link rel="stylesheet" href="{{ asset('css/notyf.min.css') }}">

    @laravelPWA
    
    {{-- title --}}
    <title>{{ $title }}</title>
</head>
<body>

    <div class="bg-gray-50 w-[100%] sm:w-[70%] md:w-[40%] mx-auto min-h-screen relative">
        @yield('mobile-main-content')
    </div>

    {{-- bootstrap js --}}
    {{-- @vite('resources/js/app.js') --}}
    <script src="{{ asset('build/assets/app-B_072z63.js') }}"></script>
    
    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/910e994c98.js" crossorigin="anonymous"></script>

    {{-- SHARING JAVASCRIPT --}}
        {{-- jquery --}}
        {{-- <script src="{{ asset('js/sharing/jquery-3.7.1.min.js') }}"></> --}}

        {{-- toast --}}
        <script src="{{ asset('js/sharing/notyf.min.js') }}"></script>

        {{-- notif function --}}
        <script src="{{ asset('js/sharing/notyf.js') }}"></script>

        {{-- showPassword --}}
        <script src="{{ asset('js/sharing/showPassword.js') }}"></script>

        {{-- button --}}
        <script src="{{ asset('js/sharing/form.js') }}"></script>

        {{-- filepond --}}
        <script src="{{ asset('js/sharing/image-upload.js') }}"></script>

        {{-- chart js --}}
        <script src="{{ asset('js/sharing/chart.umd.js') }}"></script>

        <!-- 360 photo -->
        <script src="{{ asset('js/sharing/360-photo-viewer.js') }}"></script>

        {{-- switch class menu --}}
        <script src="{{ asset('js/user/switch-class-menu.js') }}"></script>

        {{-- OTP --}}
        <script src="{{ asset('js/user/OTP.js') }}"></script>

        {{-- email notification --}}
        <script src="{{ asset('js/user/email_notification.js') }}"></script>

        {{-- complaint --}}
        <script src="{{ asset('js/user/complaint.js') }}"></script>

        {{-- schedule --}}
        <script src="{{ asset('js/user/schedule.js') }}"></script>

        {{-- dashboard --}}
        <script src="{{ asset('js/user/dashboard.js') }}"></script>

        {{-- booking class --}}
        <script src="{{ asset('js/user/bookingClass.js') }}"></script>

        {{-- realtime notification --}}
        <script src="{{ asset('js/user/realtime-notification.js') }}"></script>

        {{-- dashboard notification --}}
        <script src="{{ asset('js/user/dashboard-notification.js') }}"></script>

        {{-- realtime notification --}}
        <script src="{{ asset('js/user/history.js') }}"></script>

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
            navigator.serviceWorker.register('/serviceworker.js', {
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
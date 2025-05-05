<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- tailwind --}}
    @vite('resources/css/app.css')

    {{-- global css --}}
    <link rel="stylesheet" href="{{ asset('css/globals.css') }}">

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- hugeicons --}}
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

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

    {{-- notif --}}
    <link rel="stylesheet" href="{{ asset('css/notyf.min.css') }}">

    {{-- flowbite --}}
    
    {{-- title --}}
    <title>{{ $title }}</title>
</head>
<body>

    <div class="bg-gray-50 w-[100%] sm:w-[70%] md:w-[40%] mx-auto min-h-screen relative">
        @yield('mobile-main-content')
    </div>

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/910e994c98.js" crossorigin="anonymous"></script>

    {{-- SHARING JAVASCRIPT --}}
        {{-- jquery --}}
        <script src="{{ asset('js/sharing/jquery-3.7.1.min.js') }}"></script>

        {{-- showPassword --}}
        <script src="{{ asset('js/sharing/showPassword.js') }}"></script>

        {{-- button --}}
        <script src="{{ asset('js/sharing/button.js') }}"></script>

        {{-- filepond --}}
        <script src="{{ asset('js/sharing/image-upload.js') }}"></script>

        {{-- switch class menu --}}
        <script src="{{ asset('js/user/switch-class-menu.js') }}"></script>

    {{-- flowbite --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    {{-- toast --}}
    <script src="{{ asset('js/sharing/notyf.min.js') }}"></script>

    @if(session('return_message'))
        <script>
            $(document).ready(function () {
                const notyf = new Notyf({
                    duration: 5000,
                    dismissible: true,
                    position: {
                        x: 'center',
                        y: 'bottom'
                    }
                });

                @php
                    $message = session('return_message');
                    $msgText = addslashes($message['message']);
                @endphp

                @if($message['status'])
                    notyf.success("{{ $msgText }}");
                @else
                    notyf.error("{{ $msgText }}");
                @endif
            });
        </script>
    @endif
</body>
</html>
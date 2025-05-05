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

    {{-- notif --}}
    <link rel="stylesheet" href="{{ asset('css/notyf.min.css') }}">

    {{-- title --}}
    <title>{{ $title }}</title>
</head>
<body>

    <div class="bg-gray-50">
        @yield('main-content')
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
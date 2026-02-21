<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        <link rel="icon" type="image/svg+xml" href="{{ asset('/imgs/favicon.svg') }}">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('css/Bootstrap5_3.min.css') }}">
        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
        <!-- Tailwind -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
    
    <!-- Alpine.js CDN (needed for Breeze interactions) -->
    <script src="{{ asset('js/alpinejs3.min.js') }}" defer></script>
    <script src="{{ asset('js/popper2.min.js') }}" ></script>
    <script src="{{ asset('js/Bootstrap5_3.min.js') }}" ></script>
</html>

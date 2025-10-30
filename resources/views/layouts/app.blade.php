<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', ' GDE') }} - لوحة التحكم</title>

        <!-- Tailwind CSS CDN -->
        <script src="{{ asset('js/tailwindcss_3.min.js') }}" defer></script>
        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Bootstrap5_3.min.css') }}">

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Alpine.js CDN (needed for Breeze interactions) -->
    <script src="{{ asset('js/alpinejs3.min.js') }}" defer></script>
    <script src="{{ asset('js/popper2.min.js') }}" ></script>
    <script src="{{ asset('js/Bootstrap5_3.min.js') }}" ></script>

    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/dataTables.min.js') }}" ></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}" ></script>


</html>

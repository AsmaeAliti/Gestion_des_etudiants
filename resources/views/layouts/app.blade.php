<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', ' GDE') }} - لوحة التحكم</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('css/Bootstrap5_3.min.css') }}">
        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
        <!-- Tailwind -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @yield('styles')

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 pb-5">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @yield('header')

            <!-- Page Content -->
            <main>
              @yield('content')
            </main>

        </div>

        @include('layouts.footer')

    </body>

    
    <!-- Alpine.js CDN (needed for Breeze interactions) -->
    <script src="{{ asset('js/alpinejs3.min.js') }}" defer></script>
    <script src="{{ asset('js/popper2.min.js') }}" ></script>
    <script src="{{ asset('js/Bootstrap5_3.min.js') }}" ></script>
    @yield('scripts')

</html>

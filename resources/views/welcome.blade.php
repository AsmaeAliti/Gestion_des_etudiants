<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'GTE') }}</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
      
    </head>
    <body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

        <!--  Top Navigation -->
        <header class="w-full bg-white/80 backdrop-blur border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
                
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('/imgs/arfan_logo_menu.jpg') }}" 
                            alt="Arfan Logo" 
                            class="h-14 w-auto object-contain">
                    </a>
                </div>
                
                @if (Route::has('login'))
                    <nav class="flex items-center gap-3 text-sm font-medium">
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                            class="px-6 py-2.5 bg-gradient-to-r from-sky-600 to-blue-600 text-white rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition">
                                لوحة التحكم
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                            class="px-4 py-2 text-gray-600 hover:text-sky-600 transition">
                                تسجيل الدخول
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                class="px-6 py-2.5 bg-gradient-to-r from-sky-600 to-blue-600 text-white rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition">
                                    التسجيل
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>


        <!-- Hero Section -->
        <section class="relative flex-1 flex items-center overflow-hidden bg-gradient-to-br from-gray-50 via-white to-blue-50">

            <!-- Soft Background Shape -->
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-blue-200 opacity-20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-sky-200 opacity-20 rounded-full blur-3xl"></div>

            <div class="relative max-w-7xl mx-auto px-6 py-24 grid lg:grid-cols-2 gap-16 items-center">

                <!-- Text -->
                <div class="text-center lg:text-right space-y-8">

                    <h2 class="text-4xl lg:text-6xl font-extrabold leading-tight text-gray-900">
                        نظام إدارة وتتبع  
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-sky-500">
                            التلاميذ
                        </span>
                    </h2>

                    <p class="text-lg lg:text-xl text-gray-600 leading-relaxed max-w-xl mx-auto lg:mx-0">
                        منصة احترافية لإدارة بيانات التلاميذ،  
                        عرض الإحصائيات وتحليل المعلومات  
                        بطريقة دقيقة وسهلة الاستخدام
                    </p>

                   
                    <!-- Feature Badges -->
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start pt-6 text-sm text-gray-600">

                        <div class="flex items-center gap-2 bg-white shadow-md px-4 py-2 rounded-xl">
                            <i class="fa-solid fa-chart-column text-green-500"></i> تقارير ذكية
                        </div>

                        <div class="flex items-center gap-2 bg-white shadow-md px-4 py-2 rounded-xl">
                            <i class="fa-solid fa-user-graduate text-sky-600"></i> إدارة التلاميذ
                        </div>

                        <div class="flex items-center gap-2 bg-white shadow-md px-4 py-2 rounded-xl">
                            <i class="fa-solid fa-bolt text-yellow-300"></i> أداء سريع
                        </div>

                    </div>
                </div>

                <!-- Illustration Card -->
                <div class="flex justify-center">

                    <div class="bg-white shadow-2xl rounded-3xl p-8 border border-gray-100 hover:scale-105 transition duration-500">

                        <svg class="w-full max-w-md" viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="60" y="60" width="380" height="260" rx="20" fill="#ffffff" stroke="#e5e7eb" stroke-width="2"/>
                            <rect x="120" y="200" width="40" height="80" rx="6" fill="#3b82f6"/>
                            <rect x="180" y="160" width="40" height="120" rx="6" fill="#60a5fa"/>
                            <rect x="240" y="180" width="40" height="100" rx="6" fill="#93c5fd"/>
                            <rect x="300" y="140" width="40" height="140" rx="6" fill="#2563eb"/>
                            <path d="M120 150 L180 130 L240 160 L300 110" 
                                stroke="#10b981" 
                                stroke-width="4" 
                                fill="none"
                                stroke-linecap="round"/>
                            <circle cx="120" cy="150" r="6" fill="#10b981"/>
                            <circle cx="180" cy="130" r="6" fill="#10b981"/>
                            <circle cx="240" cy="160" r="6" fill="#10b981"/>
                            <circle cx="300" cy="110" r="6" fill="#10b981"/>
                        </svg>

                    </div>

                </div>

            </div>
        </section>



    </body>

</html>

@extends('layouts.app')

@section('styles')
    <style>
        @media print {
        body * {
            visibility: hidden;
        }
        /* show all except for the print button */
        #student-card, #student-card *:not(#print_button) {
            visibility: visible;
        }
        #student-card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
    </style>
@endsection

@section('content')
<div class="">



    <div class="container mx-auto mt-8 px-4">

        <!-- Student Info Card -->
        <div class="bg-white shadow-xl rounded-3xl overflow-hidden max-w-4xl mx-auto border border-gray-200" id="student-card">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-6 px-8 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <i class="fa-solid fa-id-card text-5xl"></i>
                    <div>
                        <h2 class="text-2xl font-bold">بطاقة تعريف التلميذ(ة)</h2>
                        <p class="text-sm opacity-90 mt-1">رمز مسار: {{ $student->massar_code }}</p>
                    </div>
                </div>

                <!-- Placeholder for print button later -->
                <button onclick="window.print()" class="bg-white text-blue-600 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100" id="print_button">
                    <i class="fa-solid fa-print"></i> طباعة
                </button>
            </div>

            <!-- Body -->
            <div class="px-8 pb-8 pt-3 space-y-8">

                <!-- Student Name & Gender/Age -->
                <div class="text-center">
                    <h5 class="text-3xl font-bold text-gray-800 mb-2">
                        {{ $student->first_name }} {{ $student->last_name }} 
                       
                    </h5>
                    <span class="badge bg-gray-200 text-gray-800 px-4 py-2 rounded-full text-lg">
                        {{ $student->gender }} | {{ $student->age ?? '—' }} سنة | 
                        <span class="{{ $student->active == '1' ? 'text-success' : 'text-danger' }}">
                            {{ $student->active == '1' ? 'نشط(ة)' : '(ة)غير نشط' }}
                        </span> 
                    </span>
                </div>

                <!-- Grid Layout for Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-700">

                    <!-- Personal Info -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-lg text-blue-600 border-b border-blue-200 pb-1">المعلومات الشخصية</h4>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-cake-candles text-blue-500"></i>
                            <span>تاريخ الازدياد: {{ $student->birth_date ?? '—' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-location-dot text-blue-500"></i>
                            <span>مكان الازدياد: {{ $student->birth_place ?? '—' }}</span>
                        </div>
                    </div>

                    <!-- Disability Info -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-lg text-amber-600 border-b border-amber-200 pb-1">الإعاقة</h4>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-wheelchair text-amber-500"></i>
                            <span>نوع الإعاقة: {{ $student->disability_type ?? '—' }}</span>
                        </div>
                        <div class="flex items-center justify-start">
                            <span>درجة الإعاقة: 
                            @php
                                $labels = [
                                    '0' => 'خفيفة',
                                    '1' => 'متوسطة',
                                    '2' => 'عميقة',
                                    '3' => 'متطورة',
                                ];
                            @endphp
                            {{ $labels[$student->disability_degree] ?? 'غير محدد' }}

                            </span>
                            <span class="badge {{ $student->companian_need == 'Y' ? 'bg-success' : 'bg-secondary' }} px-3 py-1 rounded-full ms-3">مرافق: {{ $student->companian_need == 'Y' ? 'نعم' : 'لا' }}</span>
                        </div>
                    </div>

                    <!-- Academic Info -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-lg text-emerald-600 border-b border-emerald-200 pb-1">المعلومات الدراسية</h4>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-school text-emerald-500"></i>
                            <span>المستوى الدراسي: {{ $student->education_level }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-chalkboard-user text-emerald-500"></i>
                            <span>الأستاذ(ة) الدامج(ة): {{ $student->inclusive_teacher ?? '—' }}</span>
                        </div>
                         <div class="flex items-center gap-3">
                            <i class="fa-solid fa-chalkboard-user text-emerald-500"></i>
                            <span>المؤسسة الدامجة : {{ $organizations[$student->organization_id] ?? '—' }}</span>
                        </div>
                    </div>

                    <!-- Services & Interventions -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-lg text-purple-600 border-b border-purple-200 pb-1">الخدمات والتدخلات</h4>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-clock text-purple-500"></i>
                            <span>عدد ساعات الاستفادة: {{ $student->room_service_hours ?? 0 }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-hand-holding-heart text-purple-500"></i>
                            <span>نوع الخدمات المقدمة: {{ $student->services_provided_type ?? '—' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-stethoscope text-purple-500"></i>
                            <span>التدخل الطبي: {{ $student->medical_intervention ?? '—' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-notes-medical text-purple-500"></i>
                            <span>تفاصيل التدخل: {{ $student->medical_intervention_details ?? '—' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-cogs text-purple-500"></i>
                            <span>التكييف ونوعه: {{ $student->benefits_from_adaptation ? 'نعم' : 'لا' }} | {{ $student->adaptation_type ?? '—' }}</span>
                        </div>
                    </div>

                </div>

            </div>

            
        </div>

    </div>
    
   
    
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
@endsection
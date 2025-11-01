@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
<div class="">


    @section('header')
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('لوحة التحكم') }}
      </h2>
    @endsection
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("لقد قمت بتسجيل الدخول!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
      <table id="students_list" class="table table-striped">
        <thead class="table-primary">
            <tr>
              <th>ر.ت</th>
              <th>الاسم</th>
              <th scope="col">النسب</th>
              <th scope="col">الجنس</th>
              <!-- <th scope="col">تاريخ الازدياد</th> -->
              <!-- <th scope="col">مكان الازدياد</th> -->
              <th scope="col">السن</th>
              <th scope="col">رمز مسار</th>
              <th scope="col">المستوى الدراسي</th>
              <th scope="col">الاستاذ الدامج</th>
              <!-- <th scope="col">المؤسسةالدّامجة</th> -->
              <th scope="col">نوع الاعاقة</th>
              <th scope="col">درجتها</th>
              <th scope="col">الحاجة إلى مرافق</th>
              <!--<th scope="col">عدد ساعات الاستفادة من خدمات القاعة</th>
               <th scope="col">نوع الخدمات المعرفية المقدّمة</th>
              <th scope="col">التدخل الطبي والشبه الطبي</th>
              <th scope="col">نوعه والجهة المتدخلة</th>
              <th scope="col">الاستفادة من  التكييف ونوعه</th>
              <th scope="col">طبيعة التكييف الممنوح</th> -->
              <th scope="col" style="width: 100px !important;"></th>
            </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
    
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/dataTables.min.js') }}" ></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}" ></script>
    <script src="{{ asset('scripts/students_list.js') }}" ></script>
@endsection
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
    

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-12">
      <div class="alert alert-info text-center ">
        <i class="fa-solid fa-circle-info"></i> <b>ملاحظة :</b> تُظهر هذه القائمة جميع التلاميذ والتلميذات المسجلين في النظام.
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
          @foreach($students_data as $student)
            <tr>
              <td><b>{{ $student->id }}</b></td>
              <td>{{ $student->first_name }}</td>
              <td>{{ $student->last_name }}</td>
              <td>{{ $student->gender }}</td>
              <td>{{ $student->age }}</td>
              <td>{{ $student->massar_code }}</td>
              <td>{{ $student->education_level }}</td>
              <td>{{ $student->inclusive_teacher }}</td>
              <td>{{ $student->disability_type }}</td>
              <td>{{ $student->disability_degree }}</td>
              <td>{{ $student->needs_assistant }}</td>
              <td>
                <button class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></button>
                <button class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></button>
              </td>
            </tr>
          @endforeach
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
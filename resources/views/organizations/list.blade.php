@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
<div class="">


    @section('header')
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('قائمة الروافد') }}
      </h2>
    @endsection
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-12">
      <div class="alert alert-info text-center ">
        <i class="fa-solid fa-circle-info"></i> <b>ملاحظة :</b> تُظهر هذه القائمة جميع الروافد مع إجمالي عدد الطلبة والطالبات المسجلين في كل رافد.
      </div>
    </div>
    
    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
      <table id="students_list" class="table table-striped">
        <thead class="table-dark">
            <tr>
              <th>الروافد</th>
              <th scope="col">مجموع الإناث</th>
              <th scope="col">مجموع الذكور</th>
              <th scope="col">المجموع</th>
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
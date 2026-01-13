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
      <table id="organization_list" class="table table-hover table-striped">
        <thead class="table-dark">
            <tr class="text-center">
              <th scope="col">الروافد</th>
              <th scope="col">مجموع الإناث</th>
              <th scope="col">مجموع الذكور</th>
              <th scope="col">المجموع</th>
              <th scope="col" width="150px"></th>
            </tr>
        </thead>
        <tbody>
          @foreach($organization_data as $organization)
            <tr>
              <td>{{ $organization->organization_name }}</td>
              <td>{{ $organization->female_count }}</td>
              <td>{{ $organization->male_count }}</td>
              <td>{{ $organization->total_members }}</td>
              <td>
                <!-- <button class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></button> -->
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
    <script src="{{ asset('scripts/organization_list.js') }}" ></script>
@endsection
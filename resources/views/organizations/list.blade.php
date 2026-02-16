@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">    
@endsection

@section('content')
<div class="">


    @section('header')
      <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <div class="d-flex justify-between ">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('قائمة الروافد') }}
            </h2>
            <div data-bs-toggle="modal" data-bs-target="#StoreOrganization" id="add_organization" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-sky-600 text-white font-medium text-sm shadow hover:bg-sky-700 hover:shadow-md transition cursor-pointer">
                <i class="fa-solid fa-school"></i> إضافة رافد
            </div>
          </div>
        </div>
      </header>
    @endsection
    
    <!-- alerts for session and page description -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-12">

     <div id="ajax_message"></div>
      @if (session('success'))
        <div class="alert alert-success text-center"><i class="fa-solid fa-square-check"></i> {{ session('success') }} </div>
      @endif

      @if (session('danger'))
          <div class="alert alert-danger text-center"><i class="fa-solid fa-triangle-exclamation"></i> {{ session('danger') }} </div>
      @endif

      <div class="alert alert-info text-center ">
        <i class="fa-solid fa-circle-info"></i> <b>ملاحظة :</b> تُظهر هذه القائمة جميع الروافد مع إجمالي عدد الطلبة والطالبات المسجلين في كل رافد.
      </div>

    </div>
    
    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
      <table id="organization_list" class="table table-hover table-striped table-bordered">
        <thead class="table-warning">
            <tr class="text-center">
              <th scope="col" class="text-start">الروافد</th>
              <th scope="col">مجموع الإناث</th>
              <th scope="col">مجموع الذكور</th>
              <th scope="col">المجموع</th>
              <th scope="col" width="100px"></th>
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
                
                <!-- Edit Button -->
                <button href="{{ url('/organization/' . $organization->id . '/edit') }}" data-id="{{$organization->id}}" data-bs-toggle="modal" data-bs-target="#StoreOrganization" class="edit_organization inline-flex items-center justify-center w-9 h-9 rounded-xl bg-amber-500 text-white hover:bg-amber-600 transition shadow-sm">
                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                </button>

                <!-- Delete Button -->
                <button data-bs-toggle="modal" data-bs-target="#changeStatus" data-id="{{$organization->id}}" class="change_status inline-flex items-center justify-center w-9 h-9 rounded-xl bg-red-600 text-white hover:bg-red-700 transition shadow-sm">
                    <i class="fa-solid fa-trash-can text-sm"></i>
                </button>

              </td>
            </tr>
          @endforeach
        </tbody>
      </table>


      <!-- Store Organization  -->
      <div class="modal fade" id="StoreOrganization" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            
            <form method="POST" id="store_organization_form" enctype="multipart/form-data" action=" {{ route('organization.store') }} ">
            @csrf

              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">إضافة رافد</h1>
                <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                <input type="hidden" class="form-control" id="o_id" name="o_id">
              </div>

              <div class="modal-body p-0">

              
                <div class="alert alert-info text-center mb-0">
                  <i class="fa-solid fa-circle-info"></i>
                  <b>تنبيه :</b> بتغيير الحالة، سيتم تعطيل حالة طلاب هذه الرافد تلقائيًا.
                </div>
                
                <div class="m-3">
                  <label for="organization_name" class="form-label"> اسم رافد </label>
                  <input type="text" class="form-control" id="organization_name" name="organization_name">
                </div>

              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> إغلاق</button>
                  <button type="submit" id="add_organization_sbmt" class="btn btn-sm btn-outline-primary" id="store_organization_btn"><i class="fa-solid fa-plus"></i> إضافة  </button>
                  <button type="button" id="update_organization_sbmt" class="btn btn-sm btn-outline-warning" id="store_organization_btn"><i class="fa-solid fa-pen-to-square"></i> تحديث  </button>
              </div>
            </form>

          </div>
        </div>
      </div>



      <!-- Modal to Deactive Organization -->
      <div class="modal fade" id="changeStatus" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" id="deactive_organization_form" enctype="multipart/form-data" action=" {{ route('organization.change_status') }} ">
            @csrf
              <div class="modal-header">
                <h1 class="modal-title fs-5"> تعطيل حالة الرافد </h1>
                <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              
              <div class="modal-body p-0">

                <div class="alert alert-danger text-center mb-0">
                  <i class="fa-solid fa-triangle-exclamation"></i> 
                  <b>تنبيه :</b> بتغيير الحالة، سيتم تعطيل حالة طلاب هذه الرافد تلقائيًا :
                  <ol class="list-decimal text-end me-5 mt-3" id="students_for_org"></ol>
                </div>

                <input type="hidden" id="change_status_organization_id" name="organization_id" value=""> 
                <input type="hidden" id="new_status" name="new_status" value="0">

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> إغلاق</button>
                <button type="submit" class="btn btn-sm btn-outline-danger" id="deactive_organization_btn"><i class="fa-solid fa-school-circle-xmark"></i> تعطيل </button>
              </div>
            </form>
          </div>
        </div>
      </div>


      
    </div>
    
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/dataTables.min.js') }}" ></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}" ></script>
    <script src="{{ asset('scripts/organization_list.js') }}" ></script>
@endsection
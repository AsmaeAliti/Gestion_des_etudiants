@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
<div class="">


    @section('header')
      <div class="d-flex justify-between ">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('جدول تتبع التلاميذ') }}
        </h2>
        <div class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#StoreStudents"><i class="fa-solid fa-user-plus"></i> إضافة تلميذ جديد</div>
      </div>
    @endsection
    

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-12">
      <div class="alert alert-info text-center ">
        <i class="fa-solid fa-circle-info"></i> <b>ملاحظة :</b> تُظهر هذه القائمة جميع التلاميذ والتلميذات المسجلين في النظام.
      </div>
    </div>

    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
      
    <!-- table of students -->
      <table id="students_list" class="table table-sm table-bordered table-hover table-striped">
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
              <th class="text-center">{{ $student->id }}</th>
              <td>{{ $student->first_name }}</td>
              <td>{{ $student->last_name }}</td>
              <td>{{ $student->gender }}</td>
              <td>{{ $student->age }}</td>
              <td>{{ $student->massar_code }}</td>
              <td>{{ $student->education_level }}</td>
              <td>{{ $student->inclusive_teacher }}</td>
              <td>{{ $student->disability_type }}</td>
              <td>{{ $student->disability_degree }}</td>
              <td class="text-center">{{ $student->needs_assistant }}</td>
              <td>
                <button class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></button>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#StoreStudents"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
    <!-- Modal to store Student -->
    <div class="modal fade" id="StoreStudents" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <h1 class="modal-title fs-5"> إضافة تلميذ جديد </h1>
            <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            
            <div class="alert alert-info text-center ">
              <i class="fa-solid fa-circle-info"></i> <b>ملاحظة :</b> يرجى ملء جميع الحقول المطلوبة بعناية لضمان تسجيل التلميذ بشكل صحيح في النظام.
            </div>


            <form method="POST" enctype="multipart/form-data" action="">

              <div class="row my-4">

                <label class="col-1" for="name">الاسم: </label>
                <div class="col-4">
                  <input class="form-control" id="name" name="Name" value="">
                </div>

                <label class="col-1" for="last_name">النسب: </label>
                <div class="col-3">
                  <input class="form-control" id="last_name" name="Last_name" value="">
                </div>
            
                <label class="col-1" for="age">السن: </label>
                <div class="col-2">
                  <input class="form-control" id="age" name="Age" type="number" value="0">
                </div>

              </div>
              
              <hr>

              <!-- Radio buttons for gender -->
              <div class="form-group my-4">
                  <label>الجنس : </label>
                  <div class="form-check">
                    <div class="row mt-2">
                      <div class="col-6">
                        <input class="form-check-input float-end mx-3" type="radio" name="Sexe" id="male" value="ذكر">
                        <label class="form-check-label float-end" for="male">
                            ذكر
                        </label>
                      </div>
                      <div class="col-6">
                        <input class="form-check-input float-end mx-3" type="radio" name="Sexe" id="female" value="أنثى">
                        <label class="form-check-label float-end" for="female">
                            أنثى
                        </label>
                      </div>
                    </div>                  
                  </div>
              </div>

              <div class="form-group my-4">
                  <label for="birth_date">تاريخ الازدياد : </label>
                  <input type="date" id="birth_date" name="Birth_date" value="" class="form-control mt-3">
              </div>

              <div class="form-group my-4">
                  <label for="birth_city">مكان الازدياد : </label>
                  <input id="birth_city" name="Birth_city" value="" class="form-control mt-3 ">
              </div>

              <div class="form-group my-4">
                  <label for="massar_code">رمز مسار : </label>
                  <input id="massar_code" name="Massar_code" value="" class="form-control mt-3">
              </div>

              <div class="form-group my-4">
                  <label for="school_level">المستوى الدراسي : </label>
                  <input id="school_level" name="School_level" value="" class="form-control mt-3">
              </div>

              <div class="form-group my-4">
                  <label for="Integrated_teacher">الاستاذ الدامج : </label>
                  <input id="Integrated_teacher" name="Integrated_teacher" value="" class="form-control mt-3">
              </div>

              <div class="form-group my-4">
                  <label for="inclusive_organization">المؤسسة الدامجة : </label>
                  <select id="inclusive_organization" name="Inclusive_organization" class="form-select mt-3">
                      <option value="">اختر المؤسسة الدامجة</option>
                      @foreach($organizations as $organization)
                        <option value="{{ $organization->id }}">{{ $organization->organization_name }}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group my-4">
                  <label for="disability_type">نوع الاعاقة : </label>
                  <input id="disability_type" name="Disability_type" value="" class="form-control mt-3">
              </div>


              <div class="form-group my-4">
                  <label for="disability_level">درجتها : </label>


                  <select class="form-select" aria-label="Default select example" name="Disability_level" value="">
                    <option value="عميقة">عميقة</option>
                    <option value="متوسطة">متوسطة</option>
                    <option value="خفيفة">خفيفة</option>
                    <option value="متطورة">متطورة</option>
                  </select>
              </div>


              <div class="form-group my-4">
                  <label for="Companian_need">الحاجة إلى مرافق : </label>


                  <div class="form-check">
                    <div class="row mt-2">
                      <div class="col-6">
                        <input class="form-check-input float-end mx-3" type="radio" name="Companian_need" id="yes" value="نعم" >
                        <label class="form-check-label float-end" for="yes">
                        نعم
                        </label>
                      </div>
                      <div class="col-6">
                        <input class="form-check-input float-end mx-3" type="radio" name="Companian_need" id="no" value="لا">
                        <label class="form-check-label float-end" for="no">
                        لا
                        </label>
                      </div>
                    </div>                  
                  </div>

              </div>

              <div class="form-group my-4">
                  <label for="Hours_number">عدد ساعات الاستفادة من خدمات القاعة : </label>
                  <input id="Hours_number" name="Hours_number" value="" class="form-control mt-3 ">
              </div>

              <div class="form-group my-4">
                  <label for="Stervices_provided_type">نوع الخدمات المعرفية المقدّمة : </label>
                  <input id="Stervices_provided_type" name="Stervices_provided_type" value="" class="form-control mt-3 ">
              </div>

              <div class="form-group my-4">
                  <label for="Intervention_medical">التدخل الطبي والشبه الطبي : </label>
                  <input id="Intervention_medical" name="Intervention_medical" value="" class="form-control mt-3">
              </div>

              <div class="form-group my-4">
                  <label for="Intervention_type">نوعه والجهة المتدخلة : </label>
                  <input id="Intervention_type" name="Intervention_type" value="" class="form-control mt-3">
              </div>

              <div class="form-group my-4">
                  <label for="Conditioning_utilization">الاستفادة من  التكييف ونوعه : </label>
                  <input id="Conditioning_utilization" name="Conditioning_utilization" value="" class="form-control mt-3">
              </div>

              <div class="form-group my-4">
                  <label for="Conditioning_type">طبيعة التكييف الممنوح : </label>
                  <input id="Conditioning_type" name="Conditioning_type" value="" class="form-control mt-3">
              </div>

            </form>

          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-success"><i class="fa-solid fa-user-plus"></i> إضافة</button>
            <button type="button" class="btn btn-sm btn-warning" hidden><i class="fa-solid fa-user-pen"></i> تحديث</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> إغلاق</button>
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
    <script src="{{ asset('scripts/students_list.js') }}" ></script>
@endsection
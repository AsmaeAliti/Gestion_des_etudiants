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
        <div data-bs-toggle="modal" data-bs-target="#StoreStudents" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-green-600 text-white font-medium text-sm shadow hover:bg-green-700 hover:shadow-md transition cursor-pointer">
            <i class="fa-solid fa-user-plus text-sm"></i> إضافة تلميذ(ة)
        </div>

      </div>
    @endsection
    

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-12">
    
      @if (session('success'))
        <div class="alert alert-success text-center"><i class="fa-solid fa-square-check"></i> {{ session('success') }} </div>
      @endif

      @if (session('danger'))
          <div class="alert alert-danger text-center"><i class="fa-solid fa-triangle-exclamation"></i> {{ session('danger') }} </div>
      @endif
      
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
              <td class="text-center">
                  @php
                      $degree = $student->disability_degree;

                      $styles = [
                          '0' => 'bg-green-100 text-green-800 border border-green-300',
                          '1' => 'bg-yellow-100 text-yellow-800 border border-yellow-300',
                          '2' => 'bg-orange-100 text-orange-800 border border-orange-300',
                          '3' => 'bg-red-100 text-red-800 border border-red-300',
                      ];

                      $labels = [
                          '0' => 'خفيفة',
                          '1' => 'متوسطة',
                          '2' => 'عميقة',
                          '3' => 'متطورة',
                      ];
                  @endphp

                  <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $styles[$degree] ?? 'bg-gray-100 text-gray-700' }}">
                      {{ $labels[$degree] ?? 'غير محدد' }}
                  </span>
              </td>

              <td class="text-center">{{ ( $student->needs_assistant == 'Y' ? 'نعم' : 'لا' ) }}</td>
              <td>

                <!-- View Button -->
                <button class="inline-flex items-center justify-center w-9 h-9 rounded-xl  bg-blue-600 text-white hover:bg-blue-700 transition shadow-sm">
                    <i class="fa-solid fa-eye text-sm"></i>
                </button>

                <!-- Edit Button -->
                <button data-bs-toggle="modal" data-bs-target="#StoreStudents" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-yellow-500 text-white hover:bg-yellow-600 transition shadow-sm">
                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                </button>

                <!-- Delete Button -->
                <button data-bs-toggle="modal" data-bs-target="#changeStatus" class="change_status inline-flex items-center justify-center w-9 h-9 rounded-xl bg-red-600 text-white hover:bg-red-700 transition shadow-sm">
                    <i class="fa-solid fa-trash-can text-sm"></i>
                </button>

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
            <h1 class="modal-title fs-5"> إضافة تلميذ(ة) </h1>
            <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">

            <div class="alert alert-info text-center mb-4">
              <i class="fa-solid fa-circle-info"></i> 
              <b>ملاحظة :</b> يرجى ملء جميع الحقول المطلوبة بعناية لضمان تسجيل التلميذ(ة) بشكل صحيح في النظام.
            </div>

            <form method="POST" id="student_form" enctype="multipart/form-data" action=" {{ route('students.store') }} ">
            @csrf

              <!-- القسم 1: المعلومات الشخصية -->
              <div class="card mb-6 border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-blue-100 text-blue-900 fw-semibold text-center">
                  <i class="fa-solid fa-address-card me-2"></i> المعلومات الشخصية
                </div>
                
                <div class="card-body bg-blue-50 px-4 py-4 rounded-bottom">
                  <div class="row g-4">
                    <!-- Massar Code -->
                    <div class="col-md-4">
                      <label for="massar_code" class="form-label fw-medium text-gray-700">
                        رمز مسار :
                      </label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="massar_code" name="Massar_code" required>
                    </div>

                    <!-- First Name -->
                    <div class="col-md-4">
                      <label for="First_name" class="form-label fw-medium text-gray-700">
                        الاسم :
                      </label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="First_name" name="First_name" required>
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-4">
                      <label for="last_name" class="form-label fw-medium text-gray-700">
                        النسب :
                      </label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="last_name" name="Last_name" required>
                    </div>

                    <!-- Age -->
                    <div class="col-md-4">
                      <label for="age" class="form-label fw-medium text-gray-700">
                        السن :
                      </label>
                      <input type="number" class="form-control form-control-sm rounded-xl" id="age" name="Age" value="0">
                    </div>

                    <!-- Birth Date -->
                    <div class="col-md-4">
                      <label for="birth_date" class="form-label fw-medium text-gray-700">
                        تاريخ الازدياد :
                      </label>
                      <input type="date" class="form-control form-control-sm rounded-xl" id="birth_date" name="Birth_date" required>
                    </div>

                    <!-- Birth Place -->
                    <div class="col-md-4">
                      <label for="birth_place" class="form-label fw-medium text-gray-700">
                        مكان الازدياد :
                      </label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="birth_city" name="Birth_place" required>
                    </div>

                    <!-- Gender -->
                    <div class="col-md-12">
                      
                      <div class="d-flex justify-content-center gap-4">
                        <label class="form-label fw-medium text-gray-700 d-block mb-2">
                          الجنس :
                        </label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gender" id="male" value="ذكر" checked>
                          <label class="form-check-label" for="male"><i class="fa-solid fa-person"></i> ذكر</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gender" id="female" value="أنثى">
                          <label class="form-check-label" for="female"><i class="fa-solid fa-person-dress"></i> أنثى</label>
                        </div>
                      </div>
                      
                    </div>

                  </div>
                </div>
              </div>


              <!-- القسم 2: المعلومات الدراسية -->
              <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-emerald-100 text-emerald-800 fw-bold text-center"><i class="fa-solid fa-person-chalkboard"></i> المعلومات الدراسية</div>
                <div class="card-body bg-emerald-50">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label for="inclusive_organization" class="form-label fw-medium text-gray-700">المؤسسة الدامجة :</label>
                      <select id="inclusive_organization" name="Inclusive_organization" class="form-select form-select-sm rounded-xl">
                        <option value="">اختر المؤسسة الدامجة</option>
                        @foreach($organizations as $organization)
                          <option value="{{ $organization->id }}">{{ $organization->organization_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="school_level" class="form-label fw-medium text-gray-700">المستوى الدراسي  :</label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="school_level" name="School_level" required>
                    </div>
                    <div class="col-md-4">
                      <label for="Integrated_teacher" class="form-label fw-medium text-gray-700">الأستاذ(ة) الدامج(ة) :</label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="Integrated_teacher" name="Integrated_teacher" required>
                    </div>
                  </div>
                </div>
              </div>

              <!-- القسم 3: معلومات الإعاقة -->
              <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-yellow-100 text-yellow-800 fw-bold text-center"><i class="fa-solid fa-wheelchair"></i> معلومات الإعاقة</div>
                <div class="card-body bg-yellow-50">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label for="disability_type" class="form-label fw-medium text-gray-700">نوع الإعاقة :</label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="disability_type" name="Disability_type" required>
                    </div>
                    <div class="col-md-4">
                      <label for="disability_level" class="form-label fw-medium text-gray-700">درجة الإعاقة :</label>
                      <select class="form-select form-select-sm rounded-xl" name="Disability_level">
                        <option value="">اختر الدرجة</option>
                        <option value="0">خفيفة</option>
                        <option value="1">متوسطة</option>
                        <option value="2">عميقة</option>
                        <option value="3">متطورة</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label d-block">الحاجة إلى مرافق :</label>
                      <div class="d-flex justify-content-around">
                        <div>
                          <input class="form-check-input" type="radio" name="Companian_need" id="yes" value="Y">
                          <label class="form-check-label" for="yes">نعم</label>
                        </div>
                        <div>
                          <input class="form-check-input" type="radio" name="Companian_need" id="no" value="N" checked>
                          <label class="form-check-label" for="no">لا</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- القسم 4: الخدمات والتدخلات -->
              <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-purple-100 text-purple-800 fw-bold text-center"><i class="fa-solid fa-list-check"></i> الخدمات والتدخلات</div>
                <div class="card-body bg-purple-50">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label for="Hours_number" class="form-label fw-medium text-gray-700">عدد ساعات الاستفادة :</label>
                      <input type="number" class="form-control form-control-sm rounded-xl" id="Hours_number" name="Hours_number" value="0" >
                    </div>
                    <div class="col-md-6">
                      <label for="Stervices_provided_type" class="form-label fw-medium text-gray-700">نوع الخدمات المقدمة :</label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="Stervices_provided_type" name="Stervices_provided_type" required>
                    </div>
                    <div class="col-md-6">
                      <label for="Intervention_medical" class="form-label fw-medium text-gray-700">التدخل الطبي / الشبه الطبي :</label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="Intervention_medical" name="Intervention_medical" required>
                    </div>
                    <div class="col-md-6">
                      <label for="Intervention_type" class="form-label fw-medium text-gray-700">نوعه والجهة المتدخلة :</label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="Intervention_type" name="Intervention_type">
                    </div>
                    <div class="col-md-6">
                      <label for="Conditioning_utilization" class="form-label fw-medium text-gray-700">الاستفادة من التكييف ونوعه :</label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="Conditioning_utilization" name="Conditioning_utilization">
                    </div>
                    <div class="col-md-6">
                      <label for="Conditioning_type" class="form-label fw-medium text-gray-700">طبيعة التكييف الممنوح :</label>
                      <input type="text" class="form-control form-control-sm rounded-xl" id="Conditioning_type" name="Conditioning_type">
                    </div>
                  </div>
                </div>
              </div>

            </form>
          </div>



          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> إغلاق</button>
            <button type="submit" class="btn btn-sm btn-outline-success" id="add_student"><i class="fa-solid fa-user-plus"></i> إضافة</button>
            <button type="button" class="btn btn-sm btn-warning" hidden><i class="fa-solid fa-user-pen"></i> تحديث</button>
          </div>

        </div>
      </div>
    </div>

    <!-- Modal to Deactive Student -->
    <div class="modal fade" id="changeStatus" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form method="POST" id="deactive_student_form" enctype="multipart/form-data" action=" {{ route('students.change_status') }} ">
          @csrf
            <div class="modal-header">
              <h1 class="modal-title fs-5"> تعطيل تسجيل التلميذ(ة) </h1>
              <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-0">

              <div class="alert alert-warning text-center mb-0">
                <i class="fa-solid fa-triangle-exclamation"></i> 
                <b>تنبيه :</b> هل أنت متأكد من رغبتك في تعطيل تسجيل هذا التلميذ(ة)؟ لن يكون بإمكانه(ا) الوصول إلى خدمات القاعة بعد الآن.
              </div>

              <input type="hidden" id="change_status_student_id" name="student_id" value=""> 
              <input type="hidden" id="new_status" name="new_status" value="0">

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> إغلاق</button>
              <button type="submit" class="btn btn-sm btn-outline-danger" id="deactive_student_btn"><i class="fa-solid fa-user-slash"></i> تعطيل التسجيل</button>
            </div>
          </form>
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
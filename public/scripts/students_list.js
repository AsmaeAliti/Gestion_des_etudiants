$(document).ready(function () {

  var students_list = new DataTable('#students_list', {
    
      language: {
          url: '/js/datatable-ar.json',
      },
      processing: true,
      ajax: '/dashboard',
      createdRow: function(row, data, dataIndex) {
          if (data.active == 0) {
              $(row).find('td').css('background-color', '#ffc9c9'); // Tailwind red-100  
          }
      },
      columns: [
          { data: 'id', className: 'text-center fw-bold' },
          { data: 'first_name' },
          { data: 'last_name' },
          { data: 'gender' },
          { data: 'age' },
          { data: 'massar_code' },
          { data: 'education_level' },
          { data: 'inclusive_teacher' },
          { data: 'disability_type' },

          // Disability Degree Badge
          { data: 'disability_degree', className: 'text-center', 
            render: function(data) {

                const styles = {
                    '0': 'bg-green-100 text-green-800 border border-green-300',
                    '1': 'bg-yellow-100 text-yellow-800 border border-yellow-300',
                    '2': 'bg-orange-100 text-orange-800 border border-orange-300',
                    '3': 'bg-red-100 text-red-800 border border-red-300'
                };

                const labels = {
                    '0': 'خفيفة',
                    '1': 'متوسطة',
                    '2': 'عميقة',
                    '3': 'متطورة'
                };

                return "<span class='px-3 py-1 rounded-full text-sm font-semibold " + (styles[data] ?? "bg-gray-100 text-gray-700") +"'> " + ( labels[data] ?? 'غير محدد' ) + "</span>" ;
            }
          },

          // Companion Need
          { data: 'companian_need', className: 'text-center', 
            render: function(data) {
                return data === 'Y' ? 'نعم' : 'لا';
            }
          },

          // Action Buttons
          { data: 'id', orderable: false, searchable: false, 
            render: function(data) {

                return '<div class="d-flex justify-content-evenly gap-1">'+

                      '<a href="/student/'+ data +'/view_student" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition shadow-sm">'+
                          '<i class="fa-solid fa-eye text-sm"></i>'+
                      '</a>'+

                      '<button data-id="'+ data +'" data-bs-toggle="modal" data-bs-target="#StoreStudents" class="edit_student inline-flex items-center justify-center w-9 h-9 rounded-xl bg-yellow-500 text-white hover:bg-yellow-600 transition shadow-sm">'+
                          '<i class="fa-solid fa-pen-to-square text-sm"></i>'+
                      '</button>'+

                      '<button data-id="'+ data +'" data-bs-toggle="modal" data-bs-target="#changeStatus" class="change_status inline-flex items-center justify-center w-9 h-9 rounded-xl bg-red-600 text-white hover:bg-red-700 transition shadow-sm"> '+
                          '<i class="fa-solid fa-trash-can text-sm"></i>'+
                      '</button>'+

                  '</div>';
            }
          }
      ],
      
      initComplete: function () {
        // add new checkbox to show active and inactive users
        $('#students_list_wrapper > div:first').append(`
            <div class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto">
              <div class="form-check form-switch ms-3">
                <input class="form-check-input" type="checkbox" id="toggleInactive">
                <label class="form-check-label" for="toggleInactive">
                    عرض التلاميذ غير النشطين
                </label>
              </div>
            </div>
        `);
        $('#toggleInactive').on('change', function () {
            var value = $(this).is(':checked') ? 'on' : 'off';
            students_list.ajax.url('/dashboard?include_inactive_students=' + value).load();
        });
      },

    }
  );
  
  
  $("#add_student_sbmt").click(function(e) {
    
    e.preventDefault(); // prevent any default form submission

    var form = document.getElementById("student_form");
    if (!form.checkValidity()) {
      // This triggers the browser’s built-in HTML5 validation messages
      form.reportValidity();
      return; // Stop here if invalid
    }

    var $this = $(this);
    $this.prop("disabled", true);
    $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جاري الإضافة...');
    
    $("#student_form").submit();

  }) ;

  // add new student
  $("#add_student").click(function(e) {
    
    $("#StoreStudents .modal-title").text("إضافة تلميذ(ة) ");
    
    $("#add_student_sbmt").show() ;
    $("#update_student_sbmt").hide() ;

    // Text / date / select inputs
    $("#massar_code, #first_name, #last_name, #age, #birth_date, #birth_city, #inclusive_organization, #education_level, #inclusive_teacher, #disability_type, #disability_degree, #room_service_hours, #services_provided_type, #medical_intervention, #medical_intervention_details, #benefits_from_adaptation, #adaptation_type")
    .val('');
    
  }) ;


  // Change students status
  $(".change_status").click(function(e) {
    
    var student_id = $(this).closest("tr").find("th").eq(0).text().trim();
    
    $("#change_status_student_id").val(student_id);
    $("#new_status").val('0'); // تعيين الحالة إلى غير نشيط

    var student_first_name = $(this).closest("tr").find("td").eq(0).text();
    var student_last_name = $(this).closest("tr").find("td").eq(1).text();

    $("#changeStatus .modal-title").text("تعطيل تسجيل [ "+ student_first_name + " " + student_last_name +" ] ");
    
  }) ;
  
  // edit info of the student
  $(".edit_student").click(function(e) {
    
    var student_id = $(this).closest("tr").find("th").eq(0).text().trim();

    // hide add student button 
    $("#add_student_sbmt").hide() ;
    $("#update_student_sbmt").show().prop("disabled", false) ;
    $("#update_student_sbmt").html('<i class="fa-solid fa-user-pen"></i> تحديث');

    var student_first_name = $(this).closest("tr").find("td").eq(0).text();
    var student_last_name = $(this).closest("tr").find("td").eq(1).text();

    $("#StoreStudents .modal-title").text("تحديث معلومات [ "+ student_first_name + " " + student_last_name +" ] ");
    

    // ajax requset to edit dtuent
    $.ajax({
      url: "/student/"+ student_id +"/edit",
      type: "GET",
      success: function(result) {
        
        $("#s_id").val(result['id']) ;
        $("#massar_code").val(result['massar_code']) ;
        $("#first_name").val(result['first_name']) ;
        $("#last_name").val(result['last_name']) ;
        $("#age").val(result['age']) ;
        $("#birth_date").val(result['birth_date']) ;
        $("#birth_place").val(result['birth_place']) ; 
        $('input[name="gender"][value="' + result['gender'] + '"]').prop('checked', true);
        $("#inclusive_organization").val(result['organization_id']) ; 
        $("#education_level").val(result['education_level']) ; 
        $("#inclusive_teacher").val(result['inclusive_teacher']) ;
        $("#disability_type").val(result['disability_type']) ;
        $("#disability_degree").val(result['disability_degree']) ; 
        $('input[name="companian_need"][value="' + result['companian_need'] + '"]').prop('checked', true);
        $("#room_service_hours").val(result['room_service_hours']) ;
        $("#services_provided_type").val(result['services_provided_type']) ;
        $("#medical_intervention").val(result['medical_intervention']) ; 
        $("#medical_intervention_details").val(result['medical_intervention_details']) ;
        $("#benefits_from_adaptation").val(result['benefits_from_adaptation']) ;
        $("#adaptation_type").val(result['adaptation_type']) ;
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Code to run if the request fails
        console.error(errorThrown);
      },
      complete: function(jqXHR, textStatus) {
        // Code to run after the request finishes (regardless of success/error)
        // console.log("Request complete");
      }
    });
  }) ;

  $("#update_student_sbmt").click(function () {

    var student_id = $("#s_id").val();

    var form = document.getElementById("student_form");
    if (!form.checkValidity()) {
      // This triggers the browser’s built-in HTML5 validation messages
      form.reportValidity();
      return; // Stop here if invalid
    }

    var $this = $(this);
    $this.prop("disabled", true);
    $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جاري التحديث ...');
    
    // ajax requset to edit dtuent
    $.ajax({
      url: "/student/"+ student_id +"/update",
      type: "POST",
      data : $("#student_form").serialize(),
      success: function(result) {
        console.log(result)
        if (result.status) {
      
          $("#ajax_message").html(
              `<div class="alert alert-success text-center">
                  <i class="fa-solid fa-square-check"></i> ${result.message}
              </div>`
          );

        } else {
          $("#ajax_message").html(
              `<div class="alert alert-danger text-center">
                  <i class="fa-solid fa-triangle-exclamation"></i> ${result.message}
              </div>`
          );
        }
        // HIDE MODAL 
        $("#StoreStudents").modal('hide');
        

      }

    });
    

  })
    

}) ;

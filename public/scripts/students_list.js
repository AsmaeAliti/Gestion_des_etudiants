$(document).ready(function () {

  var students_list = new DataTable('#students_list', {
    language: {
        url: '/js/datatable-ar.json',
    }}
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
    $("#massar_code, #First_name, #last_name, #age, #birth_date, #birth_city, #inclusive_organization, #education_level, #Integrated_teacher, #disability_type, #disability_degree, #Hours_number, #Stervices_provided_type, #medical_intervention, #Intervention_type, #benefits_from_adaptation, #Conditioning_type")
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
    $("#update_student_sbmt").show() ;

    var student_first_name = $(this).closest("tr").find("td").eq(0).text();
    var student_last_name = $(this).closest("tr").find("td").eq(1).text();

    $("#StoreStudents .modal-title").text("تحديث معلومات [ "+ student_first_name + " " + student_last_name +" ] ");
    
    // ajax requset to edit dtuent
    $.ajax({
      url: "/student/"+ student_id +"/edit",
      type: "GET",
      success: function(result) {
        
        $("#massar_code").val(result['massar_code']) ;
        $("#First_name").val(result['first_name']) ;
        $("#last_name").val(result['last_name']) ;
        $("#age").val(result['age']) ;
        $("#birth_date").val(result['birth_date']) ;
        $("#birth_city").val(result['birth_place']) ; 
        $('input[name="gender"][value="' + result['gender'] + '"]').prop('checked', true);
        $("#inclusive_organization").val(result['inclusive_organization']) ; 
        $("#education_level").val(result['education_level']) ; 
        $("#Integrated_teacher").val(result['inclusive_teacher']) ;
        $("#disability_type").val(result['disability_type']) ;
        $("#disability_degree").val(result['disability_degree']) ; 
        $('input[name="companian_need"][value="' + result['companian_need'] + '"]').prop('checked', true);
        $("#Hours_number").val(result['room_service_hours']) ;
        $("#Stervices_provided_type").val(result['cognitive_services_type']) ;
        $("#medical_intervention").val(result['medical_intervention']) ; 
        $("#Intervention_type").val(result['medical_intervention_details']) ;
        $("#benefits_from_adaptation").val(result['benefits_from_adaptation']) ;
        $("#Conditioning_type").val(result['adaptation_type']) ;
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Code to run if the request fails
        console.error(errorThrown);
      },
      complete: function(jqXHR, textStatus) {
        // Code to run after the request finishes (regardless of success/error)
        console.log("Request complete");
      }
    });

    
  }) ;

}) ;

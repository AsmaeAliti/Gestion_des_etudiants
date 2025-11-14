$(document).ready(function () {

  var students_list = new DataTable('#students_list', {
    language: {
        url: '/js/datatable-ar.json',
    }}
  );

  $("#add_student").click(function(e) {
    
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

  $(".change_status").click(function(e) {
    
    var student_id = $(this).closest("tr").find("th").eq(0).text().trim();
    console.log(student_id);
    $("#change_status_student_id").val(student_id);
    $("#new_status").val('0'); // تعيين الحالة إلى غير نشيط

    var student_first_name = $(this).closest("tr").find("td").eq(0).text();
    var student_last_name = $(this).closest("tr").find("td").eq(1).text();

    $("#changeStatus .modal-title").text("تعطيل تسجيل [ "+ student_first_name + " " + student_last_name +" ] ");
    
  
    
  }) ;

}) ;

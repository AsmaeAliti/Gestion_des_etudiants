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

    $.ajax({
      type: "POST",
      url: "/student/store",
      data: $("#student_form").serialize(), 
      success: function(response) {
        // إعادة تحميل الصفحة بعد الإضافة
        // location.reload();

        
        $this.prop("disabled", false);
        $this.html('<i class="fa-solid fa-user-plus"></i> إضافة');
      },
      error: function(xhr, status, error) {
        alert("حدث خطأ أثناء إضافة الطالب: " + xhr.responseText);
        $this.prop("disabled", false);
        $this.html('<i class="fa-solid fa-user-plus"></i> إضافة');
      }
    });


  });


}) ;

$(document).ready(function (){

    var organization_list = new DataTable('#organization_list', {
        language: {
            url: '/js/datatable-ar.json',
        }}
    );

    
    $("#add_organization_sbmt").click(function(e) {
        
        e.preventDefault(); // prevent any default form submission

        var form = document.getElementById("organization_form");
        if (!form.checkValidity()) {
        // This triggers the browser’s built-in HTML5 validation messages
        form.reportValidity();
        return; // Stop here if invalid
        }

        var $this = $(this);
        $this.prop("disabled", true);
        $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جاري الإضافة...');
        
        $("#store_organization_form").submit();

    }) ;

    // add new Organization
    $("#add_organization").click(function(e) {
        
        $("#StoreOrganization .modal-title").text("إضافة رافد ");
        
        $("#add_organization_sbmt").show() ;
        $("#update_organization_sbmt").hide() ;

        // Text / date / select inputs
        $("#organization_name").val('');
        
    }) ;


    // Change Organization status
    $(".change_status").click(function(e) {
        
        var organization_id = $(this).attr('data-id');
        
        $("#change_status_organization_id").val(organization_id);
        $("#new_status").val('0'); // تعيين الحالة إلى غير نشيط
        $("#students_for_org").html("")
        var organization_name = $(this).closest("tr").find("td").eq(0).text();
        $("#changeStatus .modal-title").text("تعطيل تسجيل [ "+ organization_name +" ] ");


        // ajax requset to students name for this organization
        $.ajax({
            url: "/organization/"+ organization_id +"/students_details",
            type: "GET",
            success: function(students) {
                
                var students_list = "" ;
                students.forEach(student => {
                    students_list += "<li><b>#"+ student['massar_code'] +"</b> - "+ student['first_name'] +" "+ student['last_name'] +"</li>" ;
                });
                $("#students_for_org").html(students_list) ;

            }

        });
      
    }) ;
  
    // edit info of the Organization
    $(".edit_organization").click(function(e) {
    
        var organization_id = $(this).attr('data-id');

        // hide add organization button 
        $("#add_organization_sbmt").hide() ;
        $("#update_organization_sbmt").show() ;

        var organization_name = $(this).closest("tr").find("td").eq(0).text();
        $("#StoreOrganization .modal-title").text("تحديث معلومات [ "+ organization_name + " ] ");
        
        $("#organization_name").val(organization_name) ;
        $("#o_id").val(organization_id) ;
        
    
    }) ; 

    $("#update_organization_sbmt").click(function () {

        var organization_id = $("#o_id").val();
        var organization_name = $("#organization_name").val() ;
        var this_row = $("#organization_list tr").has("td button[data-id='"+ organization_id +"']")

        var form = document.getElementById("store_organization_form");
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
            url: "/organization/"+ organization_id +"/update",
            type: "POST",
            data : $("#store_organization_form").serialize(),
            success: function(result) {
        
                if (result.status) {
            
                    $("#ajax_message").html(
                        `<div class="alert alert-success text-center">
                            <i class="fa-solid fa-square-check"></i> ${result.message}
                        </div>`
                    );
                    this_row.find("td:first").text(organization_name);
                    this_row.addClass("table-success") ;


                } else {
                    $("#ajax_message").html(
                        `<div class="alert alert-danger text-center">
                            <i class="fa-solid fa-triangle-exclamation"></i> ${result.message}
                        </div>`
                    );
                    this_row.addClass("table-danger") ;

                }
                // HIDE MODAL 
                $("#StoreOrganization").modal('hide');
            }

        });
      

    })
    
}) ;
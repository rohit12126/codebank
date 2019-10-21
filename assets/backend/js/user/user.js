/*
* This is for user management.
* 
*/
// drag and drop csv file.
dropContainerDocument.ondragover = dropContainerDocument.ondragenter = function(evt) {
    evt.preventDefault();
};
dropContainerDocument.ondrop = function(evt) {
    // pretty simple -- but not for IE :(
    userImage.files = evt.dataTransfer.files;
    $("#userImage").trigger('change');
    evt.preventDefault();
};
/* Show student details*/
$("body").on('click', '.viewStudent', function (event) { 
    var user_id = $(this).data('id');
    $.ajax({
        type: "post",
        data: "user_id="+user_id,
        url: SITE_URL+"backend/users/view",
        success: function(result){
            $("#viewStudentModal .modal-content").html(result);
            $("#viewStudentModal").modal('show');
        }
    });
});

$("body").on('submit', '.student_upload', function (event) {
    if($('.student_upload').parsley().isValid()){
        $('.loader-wrap').removeClass('dn');
        $.ajax({
            type: "post",
            url: SITE_URL+"backend/users/import",
            data: new FormData($('.student_upload')[0]),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            success: function (output) {
                if(output.status == 'success') {
                    $("#importStudentModal .student-list-section").html(output.html);
                    $("#importStudentModal").modal('show');
                    /*$(".contact").inputmask("999-999-9999",{
                        placeholder: "___-___-____"
                    });*/
                    $(".date-mask").inputmask("mm/dd/yyyy",{ 'placeholder': 'MM/DD/YYYY' });
                }
                else {
                    toasterMessage('error', output.message);
                }
                $('.loader-wrap').addClass('dn');
            },
            error: function() {
                $('.loader-wrap').addClass('dn');                    
            }
        });
    }
    event.preventDefault();
});

$("body").on('submit', '#importStudentModal form', function (event) {
    if(!checkValidateEmail()) {
        if($(this).parsley().isValid()){  
            $('.loader-wrap').removeClass('dn');
            var URL = $(this).prop('action');
            var $profile = $(this);
            $.ajax({
                type: "post",
                url: URL,
                data: new FormData($($profile)[0]),
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                success: function (output) {
                    if(output.status == 'success') {
                        table.draw();
                        $(".student_upload").trigger('reset');
                        $(".student_upload select[name='group_id[]']").val("").trigger('change');
                        $(".download_sample a").click();
                        $(".student_upload .file_name").html('');
                        $(".student_upload input[type=file]").val('');
                        $("#remove-file").hide();
                        $("#importStudentModal").modal('hide');
                    }
                    if(output.check_mail) {
                        $("#importStudentModal input[name='email[]']").removeClass('parsley-error');
                        $("#importStudentModal .duplicate_email").hide();
                        $.each(output.check_mail, function( index, value ) {
                            $("[value='"+value.email+"']").addClass('parsley-error');
                            $("[value='"+value.email+"']").next('.duplicate_email').show();
                            $("[value='"+value.email+"']").next().next('.duplicate_email').show();
                        });
                    }
                    toasterMessage(output.status, output.message);
                    $('.loader-wrap').addClass('dn');
                },
                error: function() {
                    toasterMessage('error', 'Something went wrong, Please try again later.');
                    $('.loader-wrap').addClass('dn');                    
                }
            });
        }
    }
    event.preventDefault();
});

function checkValidateEmail() {
    var res = false;
    var list = $("#importStudentModal input[name='email[]']").map(function(){return $(this).val();}).get();
    var result = [];
    $.each(list, function(i, e) {
        // console.log(e);
        if ($.inArray(e, result) == -1) {
            result.push(e);
            $("#importStudentModal table tr").eq(i+1).find(".duplicate_email").hide();
            $("#importStudentModal table tr").eq(i+1).find("input[name='email[]']").removeClass('parsley-error');
        }
        else {
            res = true;
            $("#importStudentModal table tr").eq(i+1).find("input[name='email[]']").focus();
            $("#importStudentModal table tr").eq(i+1).find("input[name='email[]']").addClass('parsley-error');
            $("#importStudentModal table tr").eq(i+1).find(".duplicate_email").show();
        }
    });
    return res;
}

function close_import_student() {
    swal({
        title: "Are you sure?",
        text: "Once closed, you will not be able to recover your changes!",
        icon: "warning",
        // buttons: true,
        buttons: ["Cancel", "Yes"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $("#importStudentModal").modal('hide');
        }
    });
}

$("body").on('click', '.edit-student', function () {
    $("#viewStudentModal").modal('hide');
    var user_id = $(this).data('id');
    var where = {user_id: user_id};
    $.ajax({
        type: "post",
        data: {table: 'users', where: where},
        url: SITE_URL+"backend/common/get_data",
        dataType: "json",
        success: function(result){
            $("#addSubjectModal .card-title").html("Edit User");
            $("#addSubjectModal .modal-confirm").html("Update");
            $("#addSubjectModal input[name=user_id]").val(result.user_id);
            $("#addSubjectModal input[name=name]").val(result.name);
            $("#addSubjectModal input[name=email]").val(result.email);
            $("#addSubjectModal input[name=contact]").val(result.contact);
            /*$("#addSubjectModal input[name=university_name]").val(result.university_name);*/
            $("#addSubjectModal input[name=date_of_birth]").val(chnage_date_format(result.date_of_birth));
            $("#addSubjectModal").modal('show');
        }
    });
});

function chnage_date_format(date) {
    if(date && date != '0000-00-00') {
        var dateAr = date.split('-');
        return newDate = dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0];
    }
    else {
        return '';
    }
}
var table;
$(document).ready(function() {
    $("#tab1 #checkAll").click(function() {
        if ($("#tab1 #checkAll").is(':checked')) {
            $("#tab1 input[type=checkbox]").each(function() {
                $(this).prop("checked", true);
            });
        } else {
            $("#tab1 input[type=checkbox]").each(function() {
                $(this).prop("checked", false);
            });
        }
    });

    $("body").on('click', '.checkbox', function() {
        $('.order-select-status').val('');
    });

    //$('.loader-wrap').removeClass('dn');
    table = $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "pageLength": PER_PAGE,
        "lengthChange": false,
        "bFilter": false,
        "bInfo" : false,
        "ajax": {
            "url": SITE_URL+"backend/users/list",
            "type": "GET",
            "data":function (d) {
                d.name     = $("#searchName").val();
                d.status   = $("#searchStatus").val();
                d.verify   = $("#searchVerify").val();
            }
        },
        "order": [[ 1, "desc1" ]],
        "columns": [
            { "data": "sl_num", "width" : "5%" },
            { "data": "name", "width" : "25%" },
            { "data": "email", "width" : "30%" },
            { "data": "contact", "width" : "10%" },
            { "data": "user_login", "width" : "10%" },
            { "data": "is_verify", "width" : "5%" },
            { "data": "status", "width" : "5%" },
            { "data": "last_login", "width" : "7%" },
            { "data": "action", "width" : "3%" },
        ],
        "aoColumnDefs" : [ 
            {"aTargets" : [8], "orderable":  false, "sClass":  "text-center"},
            // {"aTargets" : [7], "orderable":  false, "sClass":  "text-center"},
            {"aTargets" : [5], "sClass":  "text-center"},
            {"aTargets" : [4], "orderable":  false, "sClass":  "text-center"},
           /* {"aTargets" : [4], "sClass":  "text-center"},*/
            /*{"aTargets" : [3], "orderable":  false, "sClass":  "text-center"},*/
            {"aTargets" : [0], "orderable":  false},
        ],
        'createdRow': function( row, data, dataIndex ) {
            if(data.name == 'error') {
                $(row).attr('class', 'text-center');
                $('td:eq(0)', row).attr('colspan', '9');
                $('td:eq(1)', row).css('display', 'none');
                $('td:eq(2)', row).css('display', 'none');
                $('td:eq(3)', row).css('display', 'none');
                $('td:eq(4)', row).css('display', 'none');
                $('td:eq(5)', row).css('display', 'none');
                $('td:eq(6)', row).css('display', 'none');
                $('td:eq(7)', row).css('display', 'none');
                $('td:eq(8)', row).css('display', 'none');
            }
            $("#tab1 input[type=checkbox]").each(function() {
                $(this).prop("checked", false);
            });
        },
        "fnDrawCallback": function(oSettings) {
            //$(".recordsFiltered").text("Total Records: "+oSettings.json.recordsFiltered);
            if (oSettings.json.recordsFiltered <= PER_PAGE) {
                $('.dataTables_paginate').hide();
            }
            else {
                $('.dataTables_paginate').show();                    
            }
            $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
            $('[data-toggle="tooltip"]').tooltip();
            //$('.loader-wrap').addClass('dn');
        },
    } );
} );

function customFilter() {
   //$('.loader-wrap').removeClass('dn');
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?search='+$.trim($("#searchName").val()) +'&status='+$.trim($("#searchStatus").val());
    window.history.pushState({path:newurl},'',newurl);
    table.draw();
}
function resetFilter() {
    //$('.loader-wrap').removeClass('dn');
    $('#filterForm :input').val('');
    table.draw();
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    window.history.pushState({path:newurl},'',newurl);
}

$("body").on('click', '.change_status', function () {
    action_name =$(this).attr('data-status');
    var user_id = $(this).data('id');
    var status = $(this).data('status');
    if(action_name==1){
        action = 'active';
    }else{
        $("#inactiveModal input[name=user_id]").val(user_id);
        $('#inactiveModal form').parsley().reset();
        $("#inactiveModal").modal('show');
        return false;
        action = "inactive";
    }

    swal({
        title: "Are you sure?",
        text: "You want to change status to "+action+".",
        icon: "warning",
        // buttons: true,
        buttons: ["Cancel", "Yes"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $('.loader-wrap').removeClass('dn');
            $.ajax({
                type: "post",
                data: "user_id="+user_id+"&status="+status,
                url: SITE_URL+"backend/users/change_user_status",
                dataType: "json",
                success: function(output){
                    $('.loader-wrap').addClass('dn');
                    table.draw();
                    toasterMessage(output.status, output.message);
                }
            });
        }
    });
});

$("#inactiveModal form").submit(function (event) {
    if($('#inactiveModal form').parsley().isValid()){
        var user_id = $("#inactiveModal input[name=user_id]").val();
        var reason = $("#inactiveModal textarea[name=reason]").val();
        $('.loader-wrap').removeClass('dn');
        $.ajax({
            type: "post",
            data: "user_id="+user_id+"&status=0&reason="+reason,
            url: SITE_URL+"backend/users/change_user_status",
            dataType: "json",
            success: function(output){
                $('.loader-wrap').addClass('dn');
                if(output.status == 'success') {
                    $("#inactiveModal").modal('hide');
                    $("#inactiveModal form").trigger('reset');
                }
                table.draw();
                toasterMessage(output.status, output.message);
            }
        });
    }
    event.preventDefault();
});

$("#inactiveModal .modal-confirm").click(function (event) {
    var user_id = $("#inactiveModal input[name=user_id]").val();
    $.ajax({
        type: "post",
        data: "user_id="+user_id+"&status=0",
        url: SITE_URL+"backend/users/change_user_status",
        dataType: "json",
        success: function(output){
            if(output.status == 'success') {
                $("#inactiveModal").modal('hide');
                $("#inactiveModal form").trigger('reset');
            }
            table.draw();
            toasterMessage(output.status, output.message);
        }
    });
});

$("body").on('click', '.send_mail', function () {
    var action_name = $(this).attr('data-status');
    var email = $(this).data('email');
    if(action_name == 1){
        var message = 'Login credentials will be send to '+email+".";
    }else{
        var message = "You have already sent Login details to this user. \nLogin credentials will be send to "+email+"\nDo you want to send it again?";
    }

    swal({
        // title: "Are you sure?",
        text: message,
        icon: "warning",
        // buttons: true,
        buttons: ["Cancel", "Yes"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            var user_id = $(this).data('id');
            $('.loader-wrap').removeClass('dn');
            $.ajax({
                type: "post",
                data: "user_id="+user_id,
                url: SITE_URL+"backend/users/send_mail",
                dataType: "json",
                success: function(output){
                    table.draw();
                    toasterMessage(output.status, output.message);
                    $('.loader-wrap').addClass('dn');
                }
            });
        }
    });
});

//Start open modal of add topic
$("body").on('click', '.add-student', function () { 
    $("#addSubjectModal form").parsley().reset();
    $("#addSubjectModal form").trigger('reset');
    $("#addSubjectModal form .select2").val('').trigger('change');
    $("#addSubjectModal .card-title").html("Add User");
    $("#addSubjectModal .modal-confirm").html("Submit");
    $("#addSubjectModal input[name=user_id]").val("");
    $("#addSubjectModal").modal('show');
});
//End open modal of add topic

$("body").on('click', '.change_password', function () {
    var user_id = $(this).data('id');
    $("#changePasswordModal form").trigger('reset');
    $("#changePasswordModal input[name=user_id]").val(user_id);
    $("#changePasswordModal").modal('show');
});
//Start submit modal
$( "#change_password" ).submit(function( event ) {
    if($(this).parsley().isValid()){
        var form_id = $(this).parents('.modal').prop('id');
        var POSTURL = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: POSTURL,
            data: new FormData($(this)[0]),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            beforeSend: function () {
               $('.loader-wrap').removeClass('dn');
            },
            complete: function () {
               $('.loader-wrap').addClass('dn');
            },
            success: function (output) {
                table.draw();
                if(output.status == 'success') {
                    $("#"+form_id).modal('hide');
                    $("#"+form_id+" form").trigger('reset');
                }
                toasterMessage(output.status, output.message);
            },
            error: function (error) {
               $('.loader-wrap').addClass('dn');
            }
        });
        event.preventDefault();
    }
});
$( "#filterForm" ).submit(function( event ) {
    if($(this).parsley().isValid()){
        var form_id = $(this).parents('.modal').prop('id');
        var POSTURL = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: POSTURL,
            data: new FormData($(this)[0]),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            beforeSend: function () {
                $('.loader-wrap').removeClass('dn');
            },
            complete: function () {
               $('.loader-wrap').addClass('dn');
            },
            success: function (output) {
                table.draw();
                if(output.status == 'success') {
                    $("#"+form_id).modal('hide');
                    $("#"+form_id+" form").trigger('reset');
                }
                toasterMessage(output.status, output.message);
            },
            error: function (error) {
               $('.loader-wrap').addClass('dn');
            }
        });
        event.preventDefault();
    }
});
/*submit data for add user */
$( ".addStudents" ).submit(function( event ) {
    if($(this).parsley().isValid()){
        var form_id = $(this).parents('.modal').prop('id');
        var POSTURL = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: POSTURL,
            data: new FormData($(this)[0]),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            beforeSend: function () {
                $('.loader-wrap').removeClass('dn');
            },
            complete: function () {
               $('.loader-wrap').addClass('dn');
            },
            success: function (output) {
                if($(".addStudents input[name=user_id]") != '') {
                    table.order([ 1, "desc1" ]);
                }
                table.draw();
                if(output.status == 'success') {
                    $("#"+form_id).modal('hide');
                    $("#"+form_id+" form").trigger('reset');
                }
                toasterMessage(output.status, output.message);
            },
            error: function (error) {
               $('.loader-wrap').addClass('dn');
            }
        });
        event.preventDefault();
    }
});

//End submit modal
//Start delete user
$("body").on('click', '.remove-student', function () {
    var user_id = $(this).data('id');
    swal({
        title: "Are you sure?",
        text: "You want to Delete this user.",
        icon: "warning",
        // buttons: true,
        buttons: ["Cancel", "Yes"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "post",
                data: "user_id="+user_id,
                url: SITE_URL+"backend/users/delete",
                dataType: "json",
                success: function(output){
                    table.draw();
                    toasterMessage(output.status, output.message);
                }
            });
        }
    });
});


$('body').find('#tab1').on('change', '.commonstatus', function(event) {
    var row_id = [];
    var new_status = $(this).val();
    if (new_status == 1) {
        var message = 'You want to active it.';
    } else if (new_status == 2) {
        var message = 'You want to inactive it.';
    } else if (new_status == 3) {
        var message = 'You want to send login credential.';
    } else {
        return false;
    }
    if ($("input:checkbox[name='checkstatus[]']").is(':checked')) {
        swal({
            title: "Are you sure?",
            text: message,
            icon: "warning",
            // buttons: true,
            buttons: ["Cancel", "Yes"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var i = 0;
                $("input[type='checkbox']:checked").each(function() {
                    if($(this).val() != ''){
                        row_id[i] = $(this).val();
                        i++;
                    }
                });
                // console.log(row_id);
                var tb_name = "users"; 
                var col_name = "status";
                $('.loader-wrap').removeClass('dn');
                $.ajax({
                    type: "post",
                    data: {'type': '1', 'status': new_status, 'row_id': row_id},
                    url: SITE_URL+"backend/users/manage_status",
                    dataType: "json",
                    success: function(output){
                        $('.loader-wrap').addClass('dn');
                        $('#checkAll').prop('checked',false);
                        table.draw();
                        toasterMessage(output.status, output.message);
                    }
                });
            }
            else {
                $('.order-select-status').val('');
            }
        });

    } else {
        // warningMsg("Please check the checkbox");
        return false;
    }
});
//End delete user

$("body").on('click', '.viewLoginHistory', function (event) { 
    var user_id = $(this).data('id');
    $.ajax({
        type: "post",
        data: "user_id="+user_id,
        url: SITE_URL+"backend/users/view_login_history",
        success: function(result){
            $("#viewLoginHistoryModal .modal-content").html(result);
            $("#viewLoginHistoryModal").modal('show');
        }
    });
});
/*For disable alphabet key press only allow number*/
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function formToggle(){
    $("#importFrm").slideToggle();
}

$("#remove-file").click(function() {
    $(this).hide();
    $(".student_upload").trigger('reset');
    $(".file_name").html('');
});

$(".date-mask").inputmask("mm/dd/yyyy",{ 'placeholder': 'MM/DD/YYYY', "onincomplete": function() {
    } 
});

$("body").on('keyup', "#importStudentModal input[name='email[]']", function() {
    $(this).attr('value', $(this).val());
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('.select2').select2({
        placeholder: "Select Groups"
    });
})
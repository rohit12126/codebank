/*
* This is for faq page.
*
*/
var table;
$(document).ready(function() {
    table = $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "pageLength": PER_PAGE,
        "lengthChange": false,
        "bFilter": false,
        "bInfo" : false,
        "ajax": {
            "url": SITE_URL+"backend/faq/list",
            "type": "GET",
            "data":function (d) {
                d.question    = $("#searchquestion").val();
            }
        },
        "columns": [
            { "data": "sl_num" },
            { "data": "question" },
            { "data": "answer" },
            { "data": "order_by" },
            { "data": "status" },
            { "data": "actions" },
        ],
        "aoColumnDefs" : [ 
            {"aTargets" : [0], "orderable":  false},
            {"aTargets" : [2], "orderable":  false, "sClass":  "text-center"},
            // {"aTargets" : [3], "orderable":  false},
            {"aTargets" : [5], "orderable":  false, "sClass":  "actions"},
        ],
        'createdRow': function( row, data, dataIndex ) {
            if(data.question == 'error') {
                $(row).attr('class', 'text-center');
                $('td:eq(0)', row).attr('colspan', '6');
                $('td:eq(1)', row).css('display', 'none');
                $('td:eq(2)', row).css('display', 'none');
                $('td:eq(3)', row).css('display', 'none');
                $('td:eq(4)', row).css('display', 'none');
                $('td:eq(5)', row).css('display', 'none');
            }
        },
        "order": [[ 1, "desc1" ]],
        "fnDrawCallback": function(oSettings) {
            if (oSettings.json.recordsFiltered <= PER_PAGE) {
                $('.dataTables_paginate').hide();
            }
            else {
                $('.dataTables_paginate').show();                    
            }
            if (oSettings.json.recordsFiltered > 0) {
                $(".update-order-div").show();
            }
            else {
                $(".update-order-div").hide();
            }
            $('[data-toggle="tooltip"]').tooltip();
        }
    } );
} );
function customFilter() {
    var question = $.trim($("#searchquestion").val());
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?question='+question;

    window.history.pushState({path:newurl},'',newurl);
    table.draw();
}
function resetFilter() {

    $('#filterForm :input').val('');
    table.order([ 1, "desc1" ]);
    table.draw();
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    window.history.pushState({path:newurl},'',newurl);
}

tinymce.init({ selector: ".tinymce_edittor",
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
    menubar: false,
    height :200,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor media",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime table contextmenu paste textcolor directionality",
    ],
    resize: false,
    toolbar: "insertfile undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | preview code ",  
});

function openQuestionModal() {
    $("#addFaqModal form").parsley().reset();
    $("#addFaqModal form").trigger('reset');
    tinyMCE.activeEditor.setContent('');
    $("#addFaqModal").modal('show');
}
$( "#addFaqModal form" ).submit(function( event ) {
    if($(this).parsley().isValid()){
        $("#addFaqModal textarea[name=answer]").val(tinyMCE.activeEditor.getContent());
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
                if(output.status == 'success') {
                    table.order([ 1, "desc1" ]);
                    table.draw();
                    swal({
                        title: "Success",
                        text: "FAQ has been added successfully.",
                        icon: "success",
                        buttons: ["Add More", "Close"],
                        closeOnClickOutside: false,
                        // buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#addFaqModal").modal('hide');
                            $("#addFaqModal form").trigger('reset');
                            $(".custom_question").html('');
                        } else {
                            $(".custom_question").html('');
                            $("#addFaqModal input[name=question]").val('');
                            tinyMCE.activeEditor.setContent('');
                            $("#addFaqModal input[name=order_by]").val('00.00');
                        }
                    });
                }
                else {
                    toasterMessage(output.status, output.message);
                }
            },
            error: function (error) {
               $('.loader-wrap').addClass('dn');
            }
        });
        event.preventDefault();
    }
});
$("body").on('click', '.edit_faq', function() {
    $("#editFaqModal form").parsley().reset();
    var faq_id = $(this).data('id');
    $.ajax({
        type: "post",
        data: "faq_id="+faq_id,
        url: SITE_URL+"backend/faq/get_data",
        dataType: "json",
        success: function(result){
            $("#editFaqModal input[name=faq_id]").val(result.faq_id);
            $("#editFaqModal textarea[name=question]").val(result.question);
            tinyMCE.activeEditor.setContent(result.answer);
            $("#editFaqModal input[name=order_by]").val(result.order_by);
            $("#editFaqModal").modal('show');
        }
    });
});
$( "#editFaqModal form" ).submit(function( event ) {
    if($(this).parsley().isValid()){
        $("#editFaqModal textarea[name=answer]").val(tinyMCE.activeEditor.getContent());
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
                if(output.status == 'success') {
                    table.draw('page');
                    $("#editFaqModal").modal('hide');
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

/* start change status */
$("body").on('click', '.change_status', function () {
    action_name =$(this).attr('data-status');
    if(action_name==1){
        action ='Inactive';
    }else{
        action="Active";
    }
    swal({
        title: "Are you sure?",
        text: "You want to change status to "+action+'.',
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            var faq_id = $(this).data('id');
            var status = $(this).data('status');
            $.ajax({
                type: "post",
                data: "faq_id="+faq_id+"&status="+status,
                url: SITE_URL+"backend/faq/change_faq_status",
                dataType: "json",
                success: function(output){
                    table.draw();
                    toasterMessage(output.status, output.message);
                }
            });
        }
    });
});
/* End change status */
function updateTableForm() {
    var POSTURL = SITE_URL+"backend/faq/update_order_by";
    var $profile = $('#tableForm');
    $.ajax({
        type: 'POST',
        url: POSTURL,
        data: new FormData($($profile)[0]),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        beforeSend: function() {
            $('.loader-wrap').removeClass('dn');
        },
        complete: function() {
            $('.loader-wrap').addClass('dn');
        },
        success: function(result) {
            table.draw('page');
            toasterMessage(result.status, result.message);
        },
        error: function(error) {
            $('.loader-wrap').addClass('dn');
            toasterMessage('error', 'Something went wrong please try again later');
        }
    });
}
//Start delete subject
$("body").on('click', '.delete_faq', function () {
    var faq_id = $(this).data('id');
    swal({
        // title: "Are you sure you want to Delete this FAQ?",
        text: "Are you sure you want to Delete this FAQ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "post",
                data: "faq_id="+faq_id,
                url: SITE_URL+"backend/faq/delete",
                dataType: "json",
                success: function(output){
                    table.draw('page');
                    toasterMessage(output.status, output.message);
                }
            });
        }
    });
});
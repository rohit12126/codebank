/*
* This is for email template page.
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
            "url": SITE_URL+"backend/template/list",
            "type": "GET",
            "data":function (d) {
                d.all    = $("#search").val();
            }
        },
        "columns": [
            { "data": "0", "width" : "3%" },
            { "data": "1", "width" : "30%" },
            { "data": "2", "width" : "30%" },
            { "data": "3", "width" : "15%" },
            { "data": "4", "width" : "5%" },
        ],
        "aoColumnDefs" : [ 
            {"aTargets" : [4], "orderable":  false, "sClass":  "actions"},
            {"aTargets" : [0], "orderable":  false},
        ],
        "createdRow": function( row, data, dataIndex ) {
            if(data[1] == 'error') {
                $(row).attr('class', 'text-center');
                $('td:eq(0)', row).attr('colspan', '5');
                $('td:eq(1)', row).css('display', 'none');
                $('td:eq(2)', row).css('display', 'none');
                $('td:eq(3)', row).css('display', 'none');
                $('td:eq(4)', row).css('display', 'none');
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
            $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
            $('[data-toggle="tooltip"]').tooltip();
        }
    } );
} );

function customFilter() {
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?search='+$.trim($("#search").val());
    window.history.pushState({path:newurl},'',newurl);
    // table.search($(this).val()).draw() ;
    table.draw();
}
function resetFilter() {
    $('#filterForm input').val('');
    table.draw();
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    window.history.pushState({path:newurl},'',newurl);
}

$("body").on('click', '.edit-template', function () {
    var id = $(this).data('id');
    $.ajax({
        type: "post",
        data: "id="+id,
        url: SITE_URL+"backend/template/get_data",
        dataType: "json",
        success: function(result){
            $("#editTemplateModal input[name=id]").val(result.email_template_id);
            $("#editTemplateModal input[name=template_name]").val(result.template_name);
            $("#editTemplateModal input[name=template_subject]").val(result.template_subject);
            $('#editTemplateModal select[name=template_layout] option[value='+result.template_layout+']').prop("selected", true);
            tinyMCE.activeEditor.setContent(result.template_body);
            $("#editTemplateModal").modal('show');
        }
    });
});
$( "#editTemplateModal form" ).submit(function( event ) {
    if($(this).parsley().isValid()){
        var POSTURL = $(this).attr('action');
        $("#editTemplateModal textarea[name=template_body]").val(tinyMCE.activeEditor.getContent());
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
                    $("#editTemplateModal").modal('hide');
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
$("body").on('click', '.view-tempate', function () {
    var id = $(this).data('id');
    $.ajax({
        type: "post",
        data: "id="+id,
        url: SITE_URL+"backend/template/view",
        success: function(result){
            $("#viewTemplateModal .card-body").html(result);
            $("#viewTemplateModal .card-body table").css('width', '100%');
            $("#viewTemplateModal").modal('show');
        }
    });
});
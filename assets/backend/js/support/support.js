/*
* This is for support
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
            "url": SITE_URL+"backend/support/list",
            "type": "GET",
            "data":function (d) {
                d.all    = $("#search").val();
                d.status    = $("#searchStatus").val();
                d.subject = $('#searchSubject').val();
                d.orderby = $('#searchOrderBy').val();
            }
        },
        "columns": [
            { "data": "0" },
            { "data": "1" },
            { "data": "2" },
            { "data": "3" },
            { "data": "4" },
            { "data": "5" },
        ],
        "aoColumnDefs" : [ 
            {"aTargets" : [5], "sClass":  "actions", "orderable":  false},
            {"aTargets" : [3], "orderable":  false},
            {"aTargets" : [0], "orderable":  false},
        ],
        "order": [[ 1, "desc1" ]],
        'createdRow': function( row, data, dataIndex ) {
            if(data[1] == 'error') {
                $(row).attr('class', 'text-center');
                $('td:eq(0)', row).attr('colspan', '6');
                $('td:eq(1)', row).css('display', 'none');
                $('td:eq(2)', row).css('display', 'none');
                $('td:eq(3)', row).css('display', 'none');
                $('td:eq(4)', row).css('display', 'none');
                $('td:eq(5)', row).css('display', 'none');
            }
        },
        "fnDrawCallback": function(oSettings) {
            if (oSettings.json.recordsFiltered <= PER_PAGE) {
                $('.dataTables_paginate').hide();
            }
            else {
                $('.dataTables_paginate').show();                    
            }
            addreadmoreButton();
            $('[data-toggle="tooltip"]').tooltip();
        }
    } );
} );
function customFilter() {
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?search='+$.trim($("#search").val())+'&subject='+$.trim($("#searchSubject").val())+'&orderby='+$.trim($("#searchOrderBy").val())+'&status='+$.trim($("#searchStatus").val());
    window.history.pushState({path:newurl},'',newurl);
    table.draw();
}
function resetFilter() {
    $('#filterForm :input').val('');
    table.draw();
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    window.history.pushState({path:newurl},'',newurl);
}
//Start delete subject
$("body").on('click', '.remove-row', function () {
    var support_id = $(this).data('id');
    swal({
        title: "Are you sure?",
        text: "You want to delete this data.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "post",
                data: "support_id="+support_id,
                url: SITE_URL+"backend/support/delete",
                dataType: "json",
                success: function(output){
                    table.draw('page');
                    toasterMessage(output.status, output.message);
                }
            });
        }
    });
});
//Start code for read more
//Start code for read more
var showChar = 70;  // How many characters are shown by default
var ellipsestext = "...";
var moretext = "Read more";
var lesstext = "Read less";
function  addreadmoreButton(){
    $('.more').each(function() {
        var content = $(this).html();
        if(content.length > showChar) { 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar); 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="javascript:;" class="morelink read-more">' + moretext + '</a></span>'; 
            $(this).html(html);
        } 
    });
    $(".main-loader").hide();
}
// addreadmoreButton();
$(document).ready(function() {
    $("body").on('click','.morelink' ,function(e){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
//End code for read more

$("body").on('click', '.supportReplyModal', function (event) { 
    var support_id = $(this).data('id');
    $.ajax({
        type: "post",
        data: "support_id="+support_id,
        url: SITE_URL+"backend/support/reply_modal",
        success: function(result){
            $("#supportReplyModal .modal-content").html(result);
            $("#supportReplyModal").modal('show');
        }
    });
});
//Change status of support ticket
$("body").on('click', '.change_status', function () {
    action_name =$(this).attr('data-status');
    var support_id = $(this).data('id');
    var status = $(this).data('status');
    if(action_name==1){
        action = 'close';
    }else{
        action = "open";
    }
    swal({
        title: "Are you sure?",
        text: "You want to change status to "+action+".",
        icon: "warning",
        buttons: ["Cancel", "Yes"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "post",
                data: "support_id="+support_id+"&status="+status,
                url: SITE_URL+"backend/support/change_support_status",
                dataType: "json",
                success: function(output){
                    table.draw('page');
                    toasterMessage(output.status, output.message);
                }
            });
        }
    });
});
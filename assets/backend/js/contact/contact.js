/*
* This is for contact page.
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
            "url": SITE_URL+"backend/contact/list",
            "type": "GET",
            "data":function (d) {
                d.all    = $("#search").val();
                d.subject    = $("#searchSubject").val();
            }
        },
        "columns": [
            { "data": "0", 'width': "1%" },
            { "data": "1", 'width': "15%" },
            { "data": "2", 'width': "15%" },
            { "data": "3", 'width': "15%" },
            { "data": "4", 'width': "15%" },
            { "data": "5", 'width': "35%" },
            { "data": "6", 'width': "4%" },
        ],
        "aoColumnDefs" : [ 
            {"aTargets" : [6], "sClass":  "actions", "orderable":  false},
            {"aTargets" : [5], "orderable":  false},
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
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?search='+$.trim($("#search").val())+'&subject='+$.trim($("#searchSubject").val());
    window.history.pushState({path:newurl},'',newurl);
    table.draw();
}
function resetFilter() {
    $('#filterForm input').val('');
    table.draw();
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    window.history.pushState({path:newurl},'',newurl);
}
//Start delete subject
$("body").on('click', '.remove-row', function () {
    var contact_id = $(this).data('id');
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
                data: "contact_id="+contact_id,
                url: SITE_URL+"backend/contact/delete",
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
var showChar = 100;  // How many characters are shown by default
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
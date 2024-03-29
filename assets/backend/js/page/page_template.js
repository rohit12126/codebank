/*
* This is for Page template
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
        "ordering": false,
        "ajax": {
            "url": SITE_URL+"backend/pages/list",
            "type": "GET",
            "data":function (d) {
                d.all    = $("#search").val();
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
            {"aTargets" : [3], "sClass":  "actions"},
            {"aTargets" : [1], "orderable":  false},
        ],
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

$("body").on('click', '.edit-row', function () {
    var page_id = $(this).data('id');
    $('.loader-wrap').removeClass('dn');
        load_template(page_id);
    $.ajax({
        type: "post",
        data: "page_id="+page_id,
        url: SITE_URL+"backend/pages/get_data",
        dataType: "json",
        success: function(result){
            $("#editPageModal input[name=page_id]").val(result.page_id);
            $("#editPageModal input[name=title]").val(result.title);
            $("#editPageModal input[name=meta_description]").val(result.meta_description);
            $("#editPageModal input[name=meta_content]").val(result.meta_content);
            $("#editPageModal input[name=meta_keyword]").val(result.meta_keyword);
            //inyMCE.activeEditor.setContent(result.description);
            $("#editPageModal").modal('show');
            $('.loader-wrap').addClass('dn');
        }
    });
});
$( "#editPageModal form" ).submit(function( event ) {
    if($(this).parsley().isValid()){
        var POSTURL = $(this).attr('action');
        //$("#editPageModal textarea[name=description]").val(tinyMCE.activeEditor.getContent());
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
                    $("#editPageModal").modal('hide');
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
$("body").on('click', '.view-row', function () {
    var page_id = $(this).data('id');
    $.ajax({
        type: "post",
        data: "page_id="+page_id,
        dataType: "json",
        url: SITE_URL+"backend/pages/view",
        success: function(result){
            $("#viewTemplateModal .card-title").html("Preview ("+result.title+")");
            //$("#viewTemplateModal .card-body").html(result.description);
            $("#viewTemplateModal .card-body").html('<style>'+result.css+'</style>'+result.html);
            // $("#viewTemplateModal .card-body table").css('width', '100%');
            $("#viewTemplateModal").modal('show');
        }
    });
});

const LandingPage = {
    html: `<div>...</div>`,
    css: null,
    components: null,
    style: null,
};

function load_template(pageId) {
    var editor = grapesjs.init({
    components: LandingPage.components || LandingPage.html,
    style: LandingPage.style || LandingPage.css,
    noticeOnUnload: 0,
    storageManager: {
        type: 'remote',
        stepsBeforeSave: 1,
        urlStore: SITE_URL+'backend/pages/store_template/'+pageId,
        urlLoad: SITE_URL+'backend/pages/load_template/'+pageId,
        autosave: true,
        autoload: true, 
        contentTypeJson: true,
    },
    container : '#gjs',
    fromElement: true,
    plugins: [
                'gjs-blocks-basic', 
                'grapesjs-lory-slider', 
                'grapesjs-custom-code',
                'grapesjs-tabs',
                'gjs-blocks-flexbox',
                'grapesjs-plugin-forms',
                'grapesjs-tui-image-editor',
                'grapesjs-touch'
            ],
    pluginsOpts: {
        'gjs-blocks-basic': {},
        'grapesjs-lory-slider': {},
        'grapesjs-custom-code': {},
        'grapesjs-tabs': {},
        'gjs-blocks-flexbox': {},
        'grapesjs-tui-image-editor': {}
    }
  });
    /*
    //Start Code for save btn
    editor.Panels.addButton('options',
        [{
            id: 'save-db',
            className: 'fa fa-floppy-o',
            command: 'save-db',
            attributes: {title: 'Save template'}
        }]
    );
    //End Code for save btn

    // Add the command
    editor.Commands.add('save-db', { run: function(editor, sender) {
          sender && sender.set('active', 0); // turn off the button
          editor.store();
        }
    });*/  
}
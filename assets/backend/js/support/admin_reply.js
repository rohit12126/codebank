/*
* This is for reply modal.
* send reply message to user by admin.
*/
$("body").on('submit', '#commentForm', function( event ) {
    if($(this).parsley().isValid()){
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
                    $("#supportReplyModal").modal('hide');
                    $(this).trigger('reset');
                }
                toasterMessage(output.status, output.message);
            },
            error: function (error) {
                toasterMessage('error', '');
                $('.loader-wrap').addClass('dn');
            }
        });
        event.preventDefault();
    }
});
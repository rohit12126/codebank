/*
* This is for settings page.
* 
*/
$("body").on('submit', '#settingForm', function( event ) {
    if($(this).parsley().isValid()){
        var POSTURL = $(this).attr('action');
        var data = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: POSTURL,
            data: data,
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
                toasterMessage(output.status, output.message);
            },
            error: function (error) {
                $('.loader-wrap').addClass('dn');
                toasterMessage('error', '<?= AJAX_ERROR_MESSAGE; ?>');
            }
        });
        event.preventDefault();
    }
});
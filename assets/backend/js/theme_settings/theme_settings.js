/*
* This is for theme settings page.
* 
*/

/*Reset defaul theme settings*/
$("body").on('submit', '#themeSettingForm', function( event ) {
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
                if(output.status == 'success') {
                    setTimeout(function(){ location.reload(true); }, 1000);
                }
            },
            error: function (error) {
                $('.loader-wrap').addClass('dn');
                toasterMessage('error', '<?= AJAX_ERROR_MESSAGE; ?>');
            }
        });
        event.preventDefault();
    }
});
/*Reset defaul theme settings*/
function resetDefault() {
    swal({
        title: "Are you sure?",
        text: "You want to reset default.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                url: SITE_URL+'/backend/theme_settings/default',
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
                    if(output.status == 'success') {
                        setTimeout(function(){ location.reload(true); }, 1000);
                    }
                },
                error: function (error) {
                    $('.loader-wrap').addClass('dn');
                    toasterMessage('error', '<?= AJAX_ERROR_MESSAGE; ?>');
                }
            });
        }
    });  
}
/*show image on propover for color info*/
$(document).ready(function() {
    $('[data-rel=popover]').popover({
        html: true,
        trigger: "hover",
        placement: 'bottom',
        content: function () { return '<img src="' + $(this).data('img') + '" height="200"/>'; }
    });
})
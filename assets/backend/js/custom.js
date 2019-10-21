/* Add here all your JS customizations */
function toasterMessage(type, message) {
    $('.notifyjs-corner').empty();
    if(type == 'success') {
        var title = '';
        var icon = SITE_URL+"assets/backend/img/alert-icons/alert-checked.svg";
    }
    if(type == 'info') {
        // var title = 'Info';
        var title = '';
        var icon = SITE_URL+"assets/backend/img/alert-icons/alert-checked.svg";
    }
    if(type == 'warning') {
        var title = '';
        var icon = SITE_URL+"assets/backend/img/alert-icons/alert-danger.svg";
    }
    if(type == 'error') {
        var title = '';
        var icon = SITE_URL+"assets/backend/img/alert-icons/alert-disabled.svg";
    }
    if(type == 'error')
        type = "danger";
    $.notify({
        icon: icon,
        title: "<strong>"+title+"</strong> ",
        message: message            
    },{
        icon_type: 'image',
        type: type,
        allow_duplicates: false
    });
}
/*
* This is for admn profile page.
*
*/
/* Update frofile details*/
$( "#profileForm" ).submit(function( event ) {
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
				if(output.status == 'success')
					$(".profile-info .name").html($("#user_name").val());
			    toasterMessage(output.status, output.message);
			},
			error: function (error) {
			   $('.loader-wrap').addClass('dn');
			}
		});
	  	event.preventDefault();
  	}
});

/* Change password of admin*/
$( "#passwordForm" ).submit(function( event ) {
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
					$('#passwordForm')[0].reset();
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
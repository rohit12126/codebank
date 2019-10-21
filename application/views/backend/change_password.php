<section class="card">
    <?php msg_alert(); ?>
    <header class="card-header">
        <!-- <div class="card-actions">
            <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
            <a href="#" class="card-action card-action-dismiss fa fa-times" data-card-dismiss=""></a>
        </div> -->
        <h2 class="card-title">Change Password</h2>
    </header>
    <div class="card-body">
    	<div class="col-lg-8 col-xl-6">
	        <form role="form" method="post" data-bvalidator-validate class="form-horizontal">
				<div class="form-group">
					<label for="inputPwd">Old Password<small class="required">*</small></label>
					<input type="password" class="form-control" id="password" placeholder="******" name="oldpassword" data-bvalidator="required">
					<?php echo form_error('oldpassword'); ?>
				</div>
				<div class="form-group">
						<label for="inputPassword">New Password<small class="required">*</small></label>
						<input type="password" class="form-control" id="inputPassword" name="newpassword" placeholder="******" data-bvalidator="minlen[6],maxlen[10],required">
						<?php echo form_error('newpassword')?>
				</div>
				<div class="form-group">
					<label for="inputPass">Confirm Password<small class="required">*</small></label>
					<input type="password" class="form-control" id="inputPass" name="confpassword" placeholder="******" data-bvalidator="equal[inputPassword],required" data-bvalidator-msg-equal="Confirm Password should be same as new password.">
					<?php echo form_error('confpassword')?>
				</div>
				<div class="form-row">
					<div class="col-md-12 text-right mt-3">
						<button class="btn btn-primary modal-confirm" type="submit">Save</button>
					</div>
				</div>
			</form>
		</div>
    </div>
</section>
<script type="text/javascript">
	$( "form" ).submit(function( event ) {
		if($(this).data('bValidator').isValid()){
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
				    toasterMessage(output.status, output.message);
				},
				error: function (error) {
				   $('.loader-wrap').addClass('dn');
				}
			});
		  	event.preventDefault();
	  	}
	});
</script>
<div class="bredcrums-wrap">
    <ul>
        <li><a href="<?= base_url("backend/dashboard"); ?>"><?=$this->lang->line('heading_dashboard')?></a></li>
        <li><?=$this->lang->line('heading_my_profile')?></li>
    </ul>
</div>
<div class="row">
	<div class="col-lg-6">
		<section class="card">
		    <header class="card-header">
		        <h2 class="card-title"><i class="fa fa-user"></i><b> <?=$this->lang->line('heading_update_profile')?></b></h2>
		    </header>
		    <div class="card-body" style="height: 400px;">
		        <form role="form" class="form-horizontal" method="post" data-parsley-validate  class="form-horizontal" id="profileForm" action="<?php echo current_url()?>">
		        	<?php
		        	$nameArray = explode(" ", $user['name']);
		        	$first_name = $nameArray[0];
		        	unset($nameArray[0]);
		        	$last_name = implode(" ", $nameArray);
		        	?>
		        	<div class="form-group">
						<label for="inputPwd"><?=$this->lang->line('label_first_name')?><small class="required">*</small></label>
						<input type="text" class="form-control" id="user_name" placeholder="John" name="first_name" value="<?= $first_name; ?>" required="" maxlength="20" data-parsley-required-message="<?=$this->lang->line('error_name_required')?>">
		                <?php echo form_error('first_name')?>
					</div>
		        	<div class="form-group">
						<label for="inputPwd"><?=$this->lang->line('label_last_name')?></label>
						<input type="text" class="form-control" maxlength="20" placeholder="John" name="last_name" value="<?= $last_name; ?>">
		                <?php echo form_error('last_name')?>
					</div>
		        	<div class="form-group">
						<label for="inputPwd"><?=$this->lang->line('label_email')?><small class="required">*</small></label>
						<input type="email" class="form-control" id="inputEmail" name="email" placeholder="xyz@mail.com" value="<?= $user['email']; ?>" required="" data-parsley-required-message="<?=$this->lang->line('error_email_required')?>" data-parsley-type-message="<?=$this->lang->line('error_valid_email')?>">
		                    <?php echo form_error('email')?>
					</div>
					<div class="form-row">
						<div class="col-md-12 text-right mt-3">
							<button class="btn btn-primary modal-confirm" type="submit"><?=$this->lang->line('button_update')?></button>
						</div>
					</div>
		        </form>
		    </div>
		</section>
	</div>
	<div class="col-lg-6">
		<section class="card">
		    <header class="card-header">
		        <h2 class="card-title"><i class="fa fa-lock"></i><b> <?=$this->lang->line('heading_change_password')?></b></h2>
		    </header>
		    <div class="card-body" style="height: 400px;">
		        <form role="form" method="post" id="passwordForm" action="<?= base_url("backend/superadmin/change_password"); ?>" data-parsley-validate class="form-horizontal">
					<div class="form-group">
						<label for="inputPwd"><?=$this->lang->line('label_old_password')?><small class="required">*</small></label>
						<input type="password" class="form-control" id="password" placeholder="******" name="oldpassword" required="" data-parsley-required-message="<?=$this->lang->line('error_old_password_required')?>">
						<?php echo form_error('oldpassword'); ?>
					</div>
					<div class="form-group">
						<label for="inputPassword"><?=$this->lang->line('label_new_password')?><small class="required">*</small></label>
						<input type="password" class="form-control" id="inputPassword" name="newpassword" placeholder="******" required="" data-parsley-required-message="<?=$this->lang->line('error_new_password_required')?>"data-parsley-minlength="6" maxlength="20" data-parsley-minlength-message="<?=$this->lang->line('error_new_password_minlength')?>">
						<?php echo form_error('newpassword')?>
					</div>
					<div class="form-group">
						<label for="inputPass"><?=$this->lang->line('label_confirm_password')?><small class="required">*</small></label>
						<input type="password" class="form-control" id="inputPass" name="confpassword" placeholder="******" required="" data-parsley-required-message="<?=$this->lang->line('error_confirm_password_required')?>" 
						data-parsley-equalto-message="<?=$this->lang->line('error_confirm_password_match')?>" data-parsley-equalto="#inputPassword">
						<?php echo form_error('confpassword')?>
					</div>
					<div class="form-row">
						<div class="col-md-12 text-right mt-3">
							<button class="btn btn-primary modal-confirm" type="submit"><?=$this->lang->line('button_update')?></button>
						</div>
					</div>
				</form>
		    </div>
		</section>
	</div>
</div>

<!-- custom css for profile page -->
<link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/profile/profile.css" />
<!--  End -->
<!-- profile js -->
<script src="<?php echo BACKEND_THEME_URL;?>js/profile/profile.js"></script>
<!-- End profile js -->
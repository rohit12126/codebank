<div class="home-topbar">
    <div class="brand-logo">
        <a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/frontend/img/chapter-logo-1.png') ?>">
        </a>
    </div>    
    <?php
    if(user_logged_in()) {
        ?>
        <div class="header-btn-wrap">
            <div class="dropdown">
                <button type="button" class="btn white-btn dropdown-toggle" data-toggle="dropdown">
                    <img src=" <?= base_url("assets/frontend/img/user-login-blue.png"); ?>">
                    <span><?=$this->lang->line('dropdown_title_my_account')?></span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= base_url('account/profile'); ?>">
                    <?= file_get_contents_curl("assets/frontend/img/setting-icon-black.svg"); ?>
                    <?=$this->lang->line('dropdown_title_my_profile')?></a><hr>
                    <a class="dropdown-item" href="<?= base_url('account/support'); ?>">
                    <?= file_get_contents_curl("assets/frontend/img/book.svg"); ?><?=$this->lang->line('dropdown_title_my_tickets')?>
                    </a><hr>
                    <a class="dropdown-item" href="<?= base_url('paypal'); ?>">
                    <?= file_get_contents_curl("assets/frontend/img/book.svg"); ?><?=$this->lang->line('dropdown_title_paypal')?>
                    </a><hr>
                    <a class="dropdown-item" href="<?= base_url('stripe'); ?>">
                    <?= file_get_contents_curl("assets/frontend/img/book.svg"); ?><?=$this->lang->line('dropdown_title_stripe')?>
                    </a><hr>
                    <a class="dropdown-item" href="<?= base_url('account/dashboard/logout'); ?>">
                    <?= file_get_contents_curl("assets/frontend/img/logout-black-drop.svg"); ?>
                        <?=$this->lang->line('dropdown_title_logout')?>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    else {
        ?>
        <div class="auth-btn-wrap">
            <ul>
                <li><a href="javascript:void(0);" class="loginBtn">
                <span><?=$this->lang->line('dropdown_title_login')?></span> <?= file_get_contents_curl("assets/frontend/img/home-login.svg"); ?> </a></li>
            </ul>
        </div>
        <?php
    }
    ?>
</div>
<div class="home-page-wrap">
    <section class="banner">
        <div class="home-bg"></div>
        <div class="home-banner-content">
            <div class="left-img-wrap">
                <img src="<?php echo base_url('assets/frontend/img/baneer-left-img.png')?>">
            </div>

            <div class="text-center">
              
            </div>
        </div>
        <div class="copyright-section text-center">  © <?=$this->lang->line('heading_copyright_text')?> <?= SITE_NAME." ".date('Y'); ?>.
            <div class="devlope-by">
                <span>Design &amp; Developed by 
                    <a href="https://www.chapter247.com" target="_blank">
                        <img src="<?php echo FRONTEND_THEME_URL;?>img/chapter-logo-1.png" class="gray-logo">
                        <img src="<?php echo FRONTEND_THEME_URL;?>img/chapter-logo-2.png" class="color-logo">
                    </a>
                </span>
            </div>
        </div>
    </section>
</div>
<div class="login-modal-wrap">
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="<?php echo base_url('assets/frontend/img/cross.svg')?>" width="20px;"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login-form login-form-section">
                        <form class="form form-margin-top" role="form" autocomplete="off" id="signinForm" action="<?= base_url("pages/login_submit"); ?>" method="POST" data-parsley-validate>
                            <h2 class="text-center"><span class="highlighter"><?=$this->lang->line('heading_login')?></span><!--  to your Account! -->
                            </h2>
                            <p class="subheading"><?=$this->lang->line('heading_login_modal')?></p>
                            <div class="form-wrap">
                                <div class="form-group img-right-border">
                                    <input type="email" class="form-control" id="email" placeholder="Ex: john@example.com" name="email" required="" data-parsley-required-message="<?=$this->lang->line('error_email_required')?>" data-parsley-type-message="<?=$this->lang->line('error_valid_email')?>">
                                    <img src="<?php echo FRONTEND_THEME_URL;?>img/close-envelope.svg" width="22px">
                                </div>
                                <div class="form-group img-right-border">
                                    <input type="password" class="form-control" id="pwd" placeholder="john@123" name="password" required="" data-parsley-required-message="<?=$this->lang->line('error_password_required')?>">
                                    <img src="<?php echo FRONTEND_THEME_URL;?>img/input-lock.svg" width="22px">
                                </div>
                                    <button type="submit" class="btn btn-primary white-btn"><?=$this->lang->line('button_login')?></button>
                           
                                <div class="lost-password"><a href="javascript:void(0);" id ="passChange"><?=$this->lang->line('button_forgot_password')?></a>
                                </div>
                            </div>    
                        </form>
                    </div>
                    <div class="login-form forgot-form-section" style="display: none;">
                        <form action="<?php echo base_url('pages/forgot_password_submit');?>" method="post" class="form-wrap" id="changePass" data-parsley-validate >
                            <h2 class="text-center"><span class="highlighter"><?=$this->lang->line('heading_lost')?></span> <?=$this->lang->line('heading_your_password')?></h2>
                            <p class="subheading"><?=$this->lang->line('heading_forgot_msg')?></p>
                            <div class="form-wrap">
                                <div class="form-group img-right-border">
                                    <input type="email" class="form-control" id="email" placeholder="Ex: john@example.com" name="email" required="" data-parsley-required-message="<?=$this->lang->line('error_email_required')?>" data-parsley-type-message="<?=$this->lang->line('error_valid_email')?>">
                                    <img src="<?php echo FRONTEND_THEME_URL;?>img/close-envelope.svg" width="22px">
                                </div>
                                <button type="submit" class="btn btn-primary white-btn"><?=$this->lang->line('button_submit')?></button>
                                <div class="lost-password" >
                                    <a href="javascript:void(0);" id="loginPage">
                                        <span><?=$this->lang->line('button_remember_password')?></span> | <b class="highlighter"><?=$this->lang->line('button_login')?></b>
                                    </a>
                                </div>
                            </div>    
                        </form>
                    </div>
                    <div class="login-form change-password-section" style="display: none;">
                        <form class="form form-margin-top" role="form" autocomplete="off" id="resetForm" action="<?= base_url("pages/resetpassword_submit"); ?>" method="POST" data-parsley-validate>
                            <h2 class="text-center"><span class="highlighter"> Reset </span>Your Password</h2>
                            <div class="form-wrap">
                                <div class="form-group img-right-border">
                                    <input type="password" id="password1" class="form-control" placeholder="Ex: john@123" name="password" required="" data-parsley-required-message="<?=$this->lang->line('error_new_password_required')?>" maxlength="20" pattern="/^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/" data-parsley-pattern-message="<?=$this->lang->line('error_password_minlength')?>">
                                    <img src="<?php echo FRONTEND_THEME_URL;?>img/input-lock.svg" width="22px">
                                
                                </div>
                                <div class="form-group img-right-border">
                                    <input type="password" id="con_pass" class="form-control" name="con_pass" placeholder="Ex: john@123" required="" data-parsley-required-message="<?=$this->lang->line('error_confirm_password_required')?>" data-parsley-equalto="#password1" data-parsley-equalto-message="<?=$this->lang->line('error_confirm_password_match')?>">
                                    <img src="<?php echo FRONTEND_THEME_URL;?>img/input-lock.svg" width="22px">
                                
                                </div>
                                <input type="hidden" name="key" value="<?= $this->input->get('token'); ?>">
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary white-btn"><?=$this->lang->line('button_update')?></button>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    /*.left-img-wrap img{
        margin-left: 68px;
    }*/
</style>
<script type="text/javascript">
    //Start submit form of signin
    $( "#signinForm" ).submit(function( event ) {   
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
                success: function (output) {
                    if(output.status == 'success') {
                        // window.location.href = BASE_URL+"account/dashboard";
                        // window.location.href = BASE_URL;
                        window.location.href = output.URL;
                    }
                    else {
                        toasterMessage('error', output.message);
                    }
                },
                error: function (error) {
                    toasterMessage('error', '<?=AJAX_ERROR_MESSAGE?>');
                }
            });
            event.preventDefault();
        }
    });
    //End submit form of signup

    //Start submit form of password change
    $( "#changePass" ).submit(function( event ) { 
        if($(this).parsley().isValid()){ 
            var form_id = $(this).parents('.modal').prop('id');
            var POSTURL =$(this).attr('action'); 
            $.ajax({
                type: 'POST',
                url: POSTURL,
                data: new FormData($(this)[0]),
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                beforeSend: function () {
                   $('.main-loader').removeClass('dn');
                },
                complete: function () {
                   $('.main-loader').addClass('dn');
                },
                success: function (output) { 
                    if(output.status == 'success') {
                        $("#"+form_id).modal('hide');
                        $("#changePass").trigger("reset");
                        toasterMessage('success', output.message);
                    }
                    else {
                        toasterMessage('error', output.message);
                    }
                },
                error: function (error) {
                   $('.main-loader').addClass('dn');
                }
            });
            event.preventDefault();
        }
    });
    //End submit form of password change

    //Start submit form of reset password
    $( "#resetForm" ).submit(function( event ) {
        if($(this).parsley().isValid()){
            $(".section-loader").show();
            var POSTURL = $(this).attr('action');
            $.ajax({
                type: 'POST',
                url: POSTURL,
                data: new FormData($(this)[0]),
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                success: function (output) {
                    $(".section-loader").hide();
                    if(output.status == 'success') {
                        window.location.href = BASE_URL;
                    }
                    else {
                        toasterMessage('error', output.message);
                    }
                },
                error: function (error) {
                    toasterMessage('error', '<?=AJAX_ERROR_MESSAGE?>');
                }
            });
            event.preventDefault();
        }
    });
    //End submit form of reset password

    $('body').on('click' , '#passChange' , function(){
        $("#signinForm").parsley().reset();
        $("#changePass").parsley().reset();
        $('#signinForm')[0].reset();
        $('#changePass')[0].reset();
        $("#loginModal .change-password-section").hide();
        $('.forgot-form-section').show();
        $('.login-form-section').hide();
    });
    $("body").on('click' , '#loginPage' , function(){
        $("#signinForm").parsley().reset();
        $("#changePass").parsley().reset();
        $('#signinForm')[0].reset();
        $('#changePass')[0].reset();
        $("#loginModal .change-password-section").hide();
        $('.forgot-form-section').hide();
        $('.login-form-section').show();
    });
    $("body").on('click' , '.loginBtn' , function(){
        $(".left-toggle-move .close-toggle-btn").click();
        $("#signinForm").parsley().reset();
        $("#changePass").parsley().reset();
        $('#signinForm')[0].reset();
        $('#changePass')[0].reset();
        $('.login-form-section').show();
        $('.forgot-form-section').hide();
        $("#loginModal .change-password-section").hide();
        $("#loginModal").modal('show');
    });

    $(document).ready(function(){
        <?php
        if($this->input->get('token')) {
            ?>
            $("#loginModal").modal('show');
            $("#loginModal .login-form-section").hide();
            $("#loginModal .forgot-form-section").hide();
            $("#loginModal .change-password-section").show();
            <?php
        }
        ?>
    });

</script>
<style type="text/css">
    
.toggle-bar-icon i{
    color: #305160;

}
</style>
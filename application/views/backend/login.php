<!doctype html>
<html class="fixed">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">
        <title><?php if(isset($title)) { echo $title ." | "; } ?><?= SITE_NAME; ?></title>
        <link rel="icon" href="<?= base_url("assets/favicon.png"); ?>" type="image/x-icon"/>
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>vendor/bootstrap/css/bootstrap.css" />
        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/theme.css" />
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/style.css" />
        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/custom.css">
        <!-- custom css for login page -->
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/login/login.css" />
        <!--  End -->
    </head>
    <body style="background: #ecedf0;">
        <!-- start: page -->
        <div class="login-wrap">
            <section class="body-sign">
                <div class="center-sign">
                    <a target="_blank" href="<?= base_url(); ?>" class="logo">
                        <img src="<?= base_url("assets/frontend/img/chapter-logo-1.png"); ?>" width="140" alt="<?= SITE_NAME; ?>" />
                    </a>
                    <div class="panel card-sign">
                        <div class="card-body">
                            <?php echo form_open(current_url(), array('class'=>'form-signin')); ?>
                                <div class="form-group mb-3">
                                    <label><?=$this->lang->line('label_login_email')?></label>
                                    <div class="input-group">
                                        <input name="email" type="text" class="form-control form-control-lg" placeholder="Ex: john@gmail.com" value="<?= set_value('email');?>"/>
                                    </div>
                                    <?php echo form_error('email');?>
                                    <p><?= $error_mail_msg; ?></p>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="clearfix">
                                        <label class="float-left"><?=$this->lang->line('label_login_password')?></label>
                                    </div>
                                    <div class="input-group">
                                        <input name="password" type="password" class="form-control form-control-lg" placeholder="Ex: john@123" value="<?= set_value('password');?>"/>
                                    </div>
                                    <?php echo form_error('password');?>
                                    <p><?= $error_pass_msg ; ?></p>
                                    <?php if($this->session->flashdata('msg_error')): ?>
                                        <script type="text/javascript"> setTimeout(function(){ $(".help-block").hide(); }, 3000);</script>
                                        <div class="text-center">
                                            <span class="help-block btn btn-danger" style="color: #fff; font-size: 16px; padding: 3px; font-weight: 500;margin-bottom: -10px;">
                                            <?php echo $this->session->flashdata('msg_error'); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class=" text-center">
                                    <button type="submit" class="btn btn btn-primary mt-2 btn-block">Sign In</button>
                                </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </section>
            <p class="text-center text-muted mt-3 mb-3 copyright"> <?php echo date("Y"); ?> © <a target="_blank" href="<?= base_url(); ?>"><?php echo SITE_NAME_WITH_EXTENTION; ?></a> </p>
        </div>
        <!-- end: page -->
        <!-- Vendor -->
    <script src="<?php echo BACKEND_THEME_URL;?>vendor/jquery/jquery.js"></script>
    <script src="<?php echo BACKEND_THEME_URL;?>vendor/font-awesome-5/js/fontawesome.min.js"></script>
    <script src="<?php echo BACKEND_THEME_URL;?>vendor/bootstrap/js/bootstrap.js"></script>
    </body>
</html>
<?php
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if(isset($title)) { echo $title." | "; } ?><?= SITE_NAME; ?></title>  
    <link rel="icon" href="<?= base_url("assets/favicon.png"); ?>" type="image/x-icon"/>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta meta name="viewport" content=  "width=device-width, user-scalable=no" /> 
    <link rel="stylesheet" href="<?= base_url('assets/frontend/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/css/style.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/css/custom.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/css/responsive.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="<?= base_url('assets/frontend/js/jquery-3.4.1.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>vendor/datatables/media/css/dataTables.bootstrap4.css">
    <script src="<?php echo BACKEND_THEME_URL;?>vendor/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo BACKEND_THEME_URL;?>vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo BACKEND_THEME_URL;?>js/notify.min.js"></script>
    <script src="<?= base_url("assets/backend/plugin/sweetalert/dist/sweetalert.min.js"); ?>"></script>
    <script>
        BASE_URL = "<?= base_url(); ?>";
    </script>
    <script src="<?= base_url('assets/frontend/js/custom.js'); ?>"></script>
    <!-- For Mob Nav -->
    <div class="mob-toggle-btn">
        <div class="toggle-bar-icon"> 
            <i class="fa fa-bars"></i>
        </div>
    </div>
    <div class="mob-nav-wrap">
        <div class="mob-left-toggle-wrapper">
            <div class="mob-toggle-section">
                <span class="close-toggle-btn toggle-bar-icon"> <?= file_get_contents_curl("assets/frontend/img/mob-close.svg"); ?> </span> 
                <div class="mob-toggle-section-inner">
                    <div class="mob-user-info">
                        <span class="user-icon"> <?= file_get_contents_curl("assets/frontend/img/mob-user-image.svg"); ?>
                         </span> 
                        <div class="user-name-wrap">
                            <?php
                            if(user_logged_in() == true) {
                                echo '<div class="name">Hello,<br><a href="'.base_url('account/profile').'">'.ucfirst(user_name()).'</a></div>';
                            }
                            else {
                                ?>
                                <div class="name">Hello,<br><a class="link-text loginBtn" href="javascript:void(0);">Login to <?= SITE_NAME; ?></a></div>
                                <?php
                            }
                            ?>
                        </div>
                    </div> 
               
                    <div class="container-fluid">
                        <?php
                        if(user_logged_in()){
                            ?>
                            <ul>
                                <li>
                                    <a class="<?php if($segment2 == 'profile') { echo 'active'; } ?>" href="<?= base_url('account/profile'); ?>"> <?= file_get_contents_curl("assets/frontend/img/setting-icon-black.svg"); ?> My Profile</a>
                                </li>
                                <li>
                                    <a class="<?php if($segment2 == 'support') { echo 'active'; } ?>" href="<?= base_url('account/support'); ?>"> <?= file_get_contents_curl("assets/frontend/img/book.svg"); ?>My Tickets</a>
                                </li>
                                <li>
                                    <a class="<?php if($segment2 == 'paypal') { echo 'active'; } ?>" href="<?= base_url('account/paypal'); ?>"> <?= file_get_contents_curl("assets/frontend/img/book.svg"); ?>PayPal</a>
                                </li>
                                <li>
                                    <a class="<?php if($segment2 == 'stripe') { echo 'active'; } ?>" href="<?= base_url('account/stripe'); ?>"> <?= file_get_contents_curl("assets/frontend/img/book.svg"); ?>Stripe</a>
                                </li>
                                <li>
                                    <a  href="<?= base_url('account/dashboard/logout'); ?>"> <?= file_get_contents_curl("assets/frontend/img/logout-black-drop.svg"); ?> Log out </a>
                                </li>
                            </ul>
                            <?php
                        }
                        else {
                            ?>
                            <ul>
                                <li>
                                    <a  href="javascript:void(0);" class="loginBtn"> <?= file_get_contents_curl("assets/frontend/img/logout-black-drop.svg"); ?> Login </a>
                                </li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('.toggle-bar-icon').click(function(){
        $('.mob-left-toggle-wrapper').toggleClass('left-toggle-move');
        $('body').toggleClass('body-off-scroll')
    });
}) 
</script>
</head>
<body>
    <?php msg_alert(); ?>

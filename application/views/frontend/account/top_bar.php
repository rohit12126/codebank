<?php
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);
?>
<nav class="navbar navbar-expand-lg navbar-light inner-nav">
    <a class="navbar-brand" href="<?= base_url(); ?>">
        <img src="<?= base_url("assets/frontend/img/chapter-logo-1.png"); ?>">
    </a>
    <div class="" id="navbarText">
        <div class="ml-auto">
            <div class="header-btn-wrap">
                <a href="<?= base_url(); ?>" class="btn white-btn return-menu-btn mr-2">
                    <?= file_get_contents_curl("assets/frontend/img/prev.svg"); ?>
                    <span><?=$this->lang->line('dropdown_title_main_menu')?></span>
                </a>
                
                <div class="dropdown">
                    <button type="button" class="btn white-btn dropdown-toggle" data-toggle="dropdown">
                        <img src=" <?= base_url("assets/frontend/img/user-login-black.png"); ?>" class="user-login-black-icon">

                        <img src=" <?= base_url("assets/frontend/img/user-login-blue.png"); ?>" class="user-login-blue-icon">
                        <span><?=$this->lang->line('dropdown_title_my_account')?></span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item <?php if($segment2 == 'profile') echo "active"; ?>" href="<?= base_url('account/profile'); ?>">
                        <?= file_get_contents_curl("assets/frontend/img/setting-icon-black.svg"); ?><?=$this->lang->line('dropdown_title_my_profile')?>
                        </a><hr>
                        <a class="dropdown-item <?php if($segment2 == 'support') echo "active"; ?>" href="<?= base_url('account/support'); ?>">
                        <?= file_get_contents_curl("assets/frontend/img/book.svg"); ?><?=$this->lang->line('dropdown_title_my_tickets')?>
                        </a><hr>
                        <a class="dropdown-item <?php if($segment1 == 'paypal') echo "active"; ?>" href="<?= base_url('paypal'); ?>">
                        <?= file_get_contents_curl("assets/frontend/img/book.svg"); ?><?=$this->lang->line('dropdown_title_paypal')?>
                        </a><hr>
                        <a class="dropdown-item <?php if($segment1 == 'stripe') echo "active"; ?>" href="<?= base_url('stripe'); ?>">
                        <?= file_get_contents_curl("assets/frontend/img/book.svg"); ?><?=$this->lang->line('dropdown_title_stripe')?>
                        </a><hr>
                        <a class="dropdown-item <?php if($segment2 == 'contact_us') echo "active"; ?>" href="<?= base_url('pages/contact_us'); ?>">
                        <?= file_get_contents_curl("assets/frontend/img/book.svg"); ?><?='Contact us'?>
                        </a><hr>
                        <a class="dropdown-item <?php if($segment2 == 'upload_documents') echo "active"; ?>" href="<?= base_url('pages/upload_documents'); ?>">
                        <?= file_get_contents_curl("assets/frontend/img/book.svg"); ?><?='Image Upload'?>
                        </a><hr>
                        <a class="dropdown-item" href="<?= base_url('account/dashboard/logout'); ?>">
                        <?= file_get_contents_curl("assets/frontend/img/logout-black-drop.svg"); ?><?=$this->lang->line('')?>
                            Log out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<style>
    .user-login-black-icon{
        display: none;
    }
    .header-btn-wrap .dropdown button .user-login-blue-icon{
        opacity: 1;
    }
</style>
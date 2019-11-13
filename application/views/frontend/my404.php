<?php
if($show_header) {
?>
    <div class="home-topbar">
        <div class="brand-logo">
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/frontend/img/chapter-logo-1.png') ?>"></a>
        </div>    
        <div class="auth-btn-wrap">
            <a href="<?= base_url(); ?>" class="btn white-btn mr-2"><span><?=$this->lang->line('heading_404_go_to_website')?></span> <i class="fa fa-link"></i></a>
        </div>
    </div>
    <?php
}
?>
<div class="not-found-page text-center">        
    <div class="error-img-wrap">
        <img src="<?= base_url("assets/frontend/img/404-img.svg"); ?>" style="<?php if($show_header) { echo 'margin-top:60px;'; } ?>">
    </div>
    <div class="error-content">
        <h3>Well, This is Disappointing.</h3>
        <p>Sorry. Sometimes things don't go according to plan.</p>
        <p>Please check back with the person who sent you this link,
      because that page is nowhere to be found.</p>
        <a href="<?= base_url(); ?>" class="btn white-btn"><i class="fa fa-home"></i> <?=$this->lang->line('heading_404_go_to_home')?></a>  
    </div>            
</div>
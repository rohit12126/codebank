<div class="bredcrums-wrap">
    <ul>
        <li><a href="<?= base_url("backend/dashboard"); ?>"><?=$this->lang->line('heading_dashboard')?></a></li>
        <li><?=$this->lang->line('heading_theme_settings')?></li>
    </ul>
</div>
<section class="card">
    <header class="card-header">
        <h2 class="card-title"><i class="fa fa-cogs"></i><b><?=$this->lang->line('heading_theme_settings')?></b></h2>
    </header>
    <div class="card-body">
        <div class="card-body">
            <form method="post" action="<?=current_url()?>" class="form-horizontal" data-parsley-validate id="themeSettingForm">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for=""><?= $this->lang->line('label_sidebar_color')?><small class="required">*</small> <i class="far fa-question-circle" data-rel="popover" data-placement="top" data-img="<?= BACKEND_THEME_URL;?>img/theme-settings/sidebar.png"></i></label>
                            <input type="color" class="form-control" name="sidebar_color" value="<?=isset($current_settings->sidebar_color)?$current_settings->sidebar_color:''?>" required="" data-parsley-required-message="<?= $this->lang->line('error_theme_setting_sidebar')?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for=""><?= $this->lang->line('label_header_color')?><small class="required">*</small> <i class="far fa-question-circle" data-rel="popover" data-placement="top" data-img="<?= BACKEND_THEME_URL;?>img/theme-settings/header.png"></i></label>
                            <input type="color" class="form-control" name="header_color"  value="<?=isset($current_settings->header_color)?$current_settings->header_color:''?>" required="" data-parsley-required-message="<?= $this->lang->line('error_theme_setting_header')?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for=""><?= $this->lang->line('label_sidebar_active_color')?><small class="required">*</small> <i class="far fa-question-circle" data-rel="popover" data-placement="top" data-img="<?= BACKEND_THEME_URL;?>img/theme-settings/active-sidebar.png"></i></label>
                            <input type="color" class="form-control" name="sidebar_active_color" value="<?=isset($current_settings->sidebar_active_color)?$current_settings->sidebar_active_color:''?>" required="" data-parsley-required-message="<?= $this->lang->line('error_theme_setting_header')?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for=""><?= $this->lang->line('label_sidebar_hover_color')?><small class="required">*</small> <i class="far fa-question-circle" data-rel="popover" data-placement="top" data-img="<?= BACKEND_THEME_URL;?>img/theme-settings/sidebar-hover.png"></i></label>
                            <input type="color" class="form-control" name="sidebar_hover_color" value="<?=isset($current_settings->sidebar_hover_color)?$current_settings->sidebar_hover_color:''?>" required="" data-parsley-required-message="<?= $this->lang->line('error_theme_setting_sidebar_hover')?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for=""><?= $this->lang->line('label_admin_dropdown_color')?><small class="required">*</small> <i class="far fa-question-circle" data-rel="popover" data-placement="top" data-img="<?= BACKEND_THEME_URL;?>img/theme-settings/admin-dropdown.png"></i></label>
                            <input type="color" class="form-control" name="admin_dropdown" value="<?=isset($current_settings->admin_dropdown)?$current_settings->admin_dropdown:''?>" required="" data-parsley-required-message="<?= $this->lang->line('error_theme_admin_dropdown')?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for=""><?= $this->lang->line('label_btn_primary_color')?><small class="required">*</small> <i class="far fa-question-circle" data-rel="popover" data-placement="top" data-img="<?= BACKEND_THEME_URL;?>img/theme-settings/primary-button.png"></i></label>
                            <input type="color" class="form-control" name="btn_primary" value="<?=isset($current_settings->btn_primary)?$current_settings->btn_primary:''?>" required="" data-parsley-required-message="<?= $this->lang->line('error_theme_btn_primary')?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for=""><?= $this->lang->line('label_btn_default_color')?><small class="required">*</small> <i class="far fa-question-circle" data-rel="popover" data-placement="top" data-img="<?= BACKEND_THEME_URL;?>img/theme-settings/default-button.png"></i></label>
                            <input type="color" class="form-control" name="btn_default" value="<?=isset($current_settings->btn_default)?$current_settings->btn_default:''?>" required="" data-parsley-required-message="<?= $this->lang->line('error_theme_btn_default')?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for=""><?= $this->lang->line('label_btn_danger_color')?><small class="required">*</small> <i class="far fa-question-circle" data-rel="popover" data-placement="top" data-img="<?= BACKEND_THEME_URL;?>img/theme-settings/delete-button.png"></i></label>
                            <input type="color" class="form-control" name="btn_danger" value="<?=isset($current_settings->btn_danger)?$current_settings->btn_danger:''?>" required="" data-parsley-required-message="<?= $this->lang->line('error_theme_btn_danger')?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for=""><?= $this->lang->line('label_btn_success_color')?><small class="required">*</small> <i class="far fa-question-circle" data-rel="popover" data-placement="top" data-img="<?= BACKEND_THEME_URL;?>img/theme-settings/success-button.png"></i></label>
                            <input type="color" class="form-control" name="btn_success" value="<?=isset($current_settings->btn_success)?$current_settings->btn_success:''?>" required="" data-parsley-required-message="<?= $this->lang->line('error_theme_btn_success')?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for=""><?= $this->lang->line('label_modal_header_color')?><small class="required">*</small> <i class="far fa-question-circle" data-rel="popover" data-placement="top" data-img="<?= BACKEND_THEME_URL;?>img/theme-settings/modal-header.png"></i></label>
                            <input type="color" class="form-control" name="modal_header" value="<?=isset($current_settings->modal_header)?$current_settings->modal_header:''?>" required="" data-parsley-required-message="<?= $this->lang->line('error_theme_modal_header')?>">
                        </div>
                    </div>
                </div>
                <!--form-body -->
                <Br>
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 center-block">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><?=$this->lang->line('button_update')?> </button>
                            <a class="btn btn-default" onclick="resetDefault()"><?=$this->lang->line('button_theme_setting_default')?> </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- User js -->
<script src="<?php echo BACKEND_THEME_URL;?>js/theme_settings/theme_settings.js"></script>
<!-- End User js -->
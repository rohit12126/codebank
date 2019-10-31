<div class="bredcrums-wrap">
    <ul>
        <li><a href="<?= base_url("backend/dashboard"); ?>"><?=$this->lang->line('heading_dashboard')?></a></li>
        <li><?=$this->lang->line('heading_settings')?></li>
    </ul>
</div>
<section class="card">
    <header class="card-header">
        <h2 class="card-title"><i class="fa fa-cog"></i><b><?=$this->lang->line('heading_settings')?></b></h2>
    </header>
    <div class="card-body">
        <div class="card-body">
            <form method="post" action="<?=current_url()?>" class="form-horizontal" data-parsley-validate id="settingForm">
                <div class="form-body">
                <?php if (!empty($options)): ?>
                    <?php foreach ($options as $row):
                    if($row->option_id != 22 && $row->option_id != 23): ?>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <label class="col-md-2 control-label text-left font-weight-bold">
                                <?php
                                echo str_replace("_", " ", ucfirst(strtolower($row->option_name)));
                                if($row->option_id != 2 && $row->option_id != 20 && $row->option_id != 21) {
                                    ?>
                                    <span class="error">*</span>
                                    <?php
                                }
                                ?>
                            </label>
                            <div class="col-md-8">
                                <?php 
                                if($row->option_value != strip_tags($row->option_value)) {
                                    ?>
                                    <textarea name="<?php echo trim($row->option_name) ?>" placeholder="Enter short about us" class="form-control" rows="5"><?php echo $row->option_value ?></textarea>
                                    <?php
                                } else{ 
                                    ?>
                                    <input type="text" name="<?php echo trim($row->option_name) ?>" placeholder="<?php echo $row->option_name ?>" class="form-control"  value="<?php echo $row->option_value?>" <?php if($row->option_id != 2 && $row->option_id != 20 && $row->option_id != 21) echo 'required=""'; ?>>
                                    <?php
                                }
                                echo form_error(trim($row->option_name));
                                ?>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php endforeach ?>
                <?php endif ?>
                </div>
                <!--form-body -->
                <Br>
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 center-block">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"> <?=$this->lang->line('button_update')?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- custom css for settings page -->
<link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/settings/settings.css" />
<!--  End -->
<!-- User js -->
<script src="<?php echo BACKEND_THEME_URL;?>js/settings/settings.js"></script>
<!-- End User js -->

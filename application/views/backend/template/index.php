<div class="bredcrums-wrap">
    <ul>
        <li><a href="<?= base_url("backend/dashboard"); ?>"><?= $this->lang->line('heading_dashboard')?></a></li>
        <li><?= $this->lang->line('heading_email_template')?></li>
    </ul>
</div>
<section class="card email-template card-min">
    <header class="card-header">
        <h2 class="card-title"> <i class="fas fa-envelope"></i><b><?= $this->lang->line('heading_email_template')?></b></h2>
    </header>
    <div class="card-body">
        <form id="filterForm" onsubmit="return false;">
            <div class="row form-group">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput"><?= $this->lang->line('label_search')?></label>
                        <input type="text" class="form-control" id="search" placeholder="<?= $this->lang->line('placeholder_search_title') ?>" onkeyup="customFilter();" value="<?= $this->input->get('search'); ?>">
                    </div>
                </div>
                <div class="col-sm-6 search-btn-col">
                    <button type="button" class="btn btn-danger btn-reset" onclick="resetFilter();" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$this->lang->line('tooltip_template_reset_search')?>"><i class="fas fa-sync-alt"></i></button>
                </div>
            </div>
        </form>
        <table id="example" class="<?= TABLE_CLASS; ?>">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('table_heading_title')?></th>
                    <th><?= $this->lang->line('table_heading_subject')?></th>
                    <th>Layout<?= $this->lang->line('table_heading_layout')?></th>
                    <th><?= $this->lang->line('table_heading_action')?></th>
                </tr>
            </thead>
        </table>
    </div>
</section>
<!-- Edit Template Modal -->
<div id="editTemplateModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-block modal-block-lg modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <header class="card-header">
                <h2 class="card-title"><?= $this->lang->line('heading_email_template_edit') ?></h2>
                <div class="card-actions">
                    <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
                </div>
            </header>
            <form method="POST" class="mb-0" action="<?= base_url('backend/template/edit'); ?>" data-parsley-validate>
                <div class="card-body">
                    <div class="email-temp-wrap">
                        <div class="col-sm-4">
                            <input type="hidden" name="id">
                            <label for="inputPassword4"><?= $this->lang->line('label_template_title') ?><small class="required">*</small></label>
                            <input type="text" class="form-control" placeholder="<?= $this->lang->line('placeholder_template_title') ?>" name="template_name" required="" data-parsley-required-message="Template title is required" maxlength="50">
                        </div>
                        <div class="col-sm-4">
                            <label for="inputPassword4"><?= $this->lang->line('label_template_subject') ?><small class="required">*</small></label>
                            <input type="text" class="form-control" placeholder="<?= $this->lang->line('placeholder_template_subject') ?>" name="template_subject"  required="" data-parsley-required-message="Template subject is required">
                        </div>
                        <div class="col-sm-4">
                            <label for="inputPassword4"><?= $this->lang->line('label_template_layout') ?><small class="required">*</small></label>
                            <select class="form-control" name="template_layout" required="">
                                <?php foreach (email_template_layout() as $key => $value) { ?>
                                    <option value="<?=$key?>"><?=ucwords($value)?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="inputPassword4"><?= $this->lang->line('label_template_body') ?><small class="required">*</small></label>
                        <textarea type="text" class="form-control tinymce_edittor" placeholder="<?= $this->lang->line('placeholder_template_body') ?>" name="template_body" data-bvalidator="required"></textarea>
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm"><?= $this->lang->line('button_update') ?></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('button_close') ?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </div>
    </div>
</div>
<!-- View Template Modal -->
<div id="viewTemplateModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-block modal-block-lg modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <header class="card-header">
                <h2 class="card-title"><?= $this->lang->line('heading_preview')?></h2>
                <div class="card-actions">
                    <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
                </div>
            </header>
            <div class="card-body">
            </div>
            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('button_close') ?></button>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
<!-- custom css for email template -->
<link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/email_template/email_template.css" />
<!--  End -->
<script src="<?php echo BACKEND_THEME_URL;?>js/email_template/email_template.js"></script>

<div class="bredcrums-wrap">
    <ul>
        <li><a href="<?= base_url("backend/dashboard"); ?>"><?= $this->lang->line('heading_dashboard') ?></a></li>
        <li><?=$this->lang->line('heading_faq')?></li>
    </ul>
</div>
<section class="card">
    <header class="card-header">
        <div class="card-actions" style="top: 5px;">
            <button  class="btn btn-primary mb-30" onclick="openQuestionModal();"><i class="fas fa-plus"></i> <?=$this->lang->line('button_add_faq')?></button>
        </div>
        <h2 class="card-title"><i class="fa fa-book"></i><b><?=$this->lang->line('heading_faq')?></b></h2>
    </header>
    <div class="card-body">
        <form id="filterForm" onsubmit="return false">
            <div class="row form-group">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput"><?=$this->lang->line('label_faq_question')?></label>
                        <input type="text" class="form-control" id="searchquestion" placeholder="<?=$this->lang->line('placeholder_faq_question')?>" onkeyup="customFilter();" value="<?= $this->input->get('question'); ?>">
                    </div>
                </div>
                <div class="col-sm-6 search-btn-col">
                    <button type="button" class="btn btn-danger btn-reset" onclick="resetFilter();" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$this->lang->line('tooltip_faq_reset_search')?>"><i class="fas fa-sync-alt"></i></button>
                </div>
            </div>
        </form>
        <form id="tableForm">
            <table id="example" class="<?php echo TABLE_CLASS; ?>">
                <thead>
                    <tr>
                        <th style="width: 1%;">#</th>
                        <th><?= $this->lang->line('table_heading_question')?></th>
                        <th><?= $this->lang->line('table_heading_answer')?></th>
                        <th style="width: 70px;"><?= $this->lang->line('table_heading_orderby')?></th>
                        <th style="width: 70px;"><?= $this->lang->line('table_heading_status')?></th>
                        <th style="width: 50px;"><?= $this->lang->line('table_heading_action')?></th>
                    </tr>
                </thead>
            </table>
            <div class="col-sm-12 text-right update-order-div">
                <button type="button" style="margin-top: 5px; margin-right: -15px;" class="btn btn-success" onclick="updateTableForm();"><?= $this->lang->line('button_update_orderby')?></button>
            </div>
        </form>
    </div>
</section>
<!-- Add Note Modal -->
<div id="addFaqModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" >
    <div class="modal-dialog modal-block modal-block-md">
        <!-- Modal content-->
        <div class="modal-content">
            <header class="card-header">
                <h2 class="card-title"><?=$this->lang->line('heading_add_faq')?></h2>
                <div class="card-actions">
                     <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
                </div>
            </header>
            <form method="POST" class="mb-0" action="<?= base_url('backend/faq/add'); ?>" data-parsley-validate enctype ="multipart/form-data">
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="inputEmail4"><?= $this->lang->line('label_question')?><small class="required">*</small></label>
                            <textarea class="form-control" maxlength="100" name="question" placeholder="Question" required="" data-parsley-required-message="<?= $this->lang->line('error_faq_question_required')?>"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="inputPassword4"><?= $this->lang->line('label_answer')?><small class="required">*</small></label>
                            <textarea type="text" class="form-control tinymce_edittor" placeholder="Note" name="answer" placeholder="Type answer here..." data-parsley-required-message="Answer field is required."></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="inputPassword4"><?= $this->lang->line('label_orderby')?><small class="required">*</small></label>
                            <input type="text" class="form-control" placeholder="00.00" value="00.00" maxlength="5" name="order_by" required="" data-parsley-required-message="<?= $this->lang->line('error_faq_order_by_required')?>">
                        </div>
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm"><?= $this->lang->line('button_submit')?></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('button_close')?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </div>
    </div>
</div>
<!-- Add Note Modal -->
<div id="editFaqModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" >
    <div class="modal-dialog modal-block modal-block-md">
        <!-- Modal content-->
        <div class="modal-content">
            <header class="card-header">
                <h2 class="card-title"><?=$this->lang->line('heading_edit_faq')?></h2>
                <div class="card-actions">
                     <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
                </div>
            </header>
            <form method="POST" class="mb-0" action="<?= base_url('backend/faq/edit'); ?>" data-parsley-validate enctype ="multipart/form-data">
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="inputEmail4"><?= $this->lang->line('label_question')?><small class="required">*</small></label>
                            <input type="hidden" name="faq_id">
                            <textarea class="form-control"  maxlength="100" name="question" placeholder="Question" required="" data-parsley-required-message="<?= $this->lang->line('error_faq_question_required')?>"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="inputPassword4"><?= $this->lang->line('label_answer')?><small class="required">*</small></label>
                            <textarea type="text" class="form-control tinymce_edittor" data-parsley-required-message="Answer field is required." name="answer"></textarea> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="inputPassword4"><?= $this->lang->line('label_orderby')?><small class="required">*</small></label>
                            <input type="text" class="form-control" placeholder="00.00" value="00.00" maxlength="5" name="order_by" required="" data-parsley-required-message="<?= $this->lang->line('error_faq_order_by_required')?>">
                            
                        </div>
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm"><?= $this->lang->line('button_update')?></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('button_close')?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </div>
    </div>
</div>
<!-- custom css for faq page -->
<link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/faq/faq.css" />
<!--  End -->
<!-- FAQ js -->
<script src="<?php echo BACKEND_THEME_URL;?>js/faq/faq.js"></script>
<!-- End FAQ js -->

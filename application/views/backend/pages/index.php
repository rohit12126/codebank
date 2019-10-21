<div class="bredcrums-wrap">
    <ul>
        <li><a href="<?= base_url("backend/dashboard"); ?>"><?=$this->lang->line('heading_dashboard')?></a></li>
        <li><?=$this->lang->line('heading_page_content')?></li>
    </ul>
</div>
<section class="card">
    <header class="card-header">
        <h2 class="card-title"> <i class="fas fa-envelope"></i><b><?=$this->lang->line('heading_page_content')?></b></h2>
    </header>
    <div class="card-body">
        <form id="filterForm" onsubmit="return false;">
            <div class="row form-group">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput"><?=$this->lang->line('label_page_search')?></label>
                        <input type="text" class="form-control" id="search" placeholder="<?=$this->lang->line('placeholder_page_search')?>" onkeyup="customFilter();" value="<?= $this->input->get('search'); ?>">
                    </div>
                </div>
                <div class="col-sm-6 search-btn-col">
                    <button type="button" class="btn btn-danger btn-reset" onclick="resetFilter();" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$this->lang->line('tooltip_page_reset_search')?>"><i class="fas fa-sync-alt"></i></button>
                </div>
            </div>
        </form>
        <table id="example" class="<?= TABLE_CLASS; ?> page-content-table">
            <thead>
                <tr>
                    <th style="width: 1%;">#</th>
                    <th><?=$this->lang->line('table_heading_page_title')?></th>
                    <th><?=$this->lang->line('table_heading_meta_description')?></th>
                    <th><?=$this->lang->line('table_heading_meta_content')?></th>
                    <th><?=$this->lang->line('table_heading_meta_keyword')?></th>
                    <th style="width: 5%;"><?= $this->lang->line('table_heading_action')?></th>
                </tr>
            </thead>
        </table>
    </div>
</section>
<!-- Edit Template Modal -->
<div id="editPageModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-block modal-block-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <header class="card-header">
                <h2 class="card-title"><?=$this->lang->line('heading_page_content_edit')?></h2>
                <div class="card-actions">
                     <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
                </div>
            </header>
            <form method="POST" class="mb-0" action="<?= base_url('backend/pages/edit'); ?>" data-parsley-validate>
                <div class="card-body">
                    <div class="col-sm-6">
                        <div class=" form-group">                
                            <input type="hidden" name="page_id">
                            <label for="inputPassword4"><?=$this->lang->line('label_page_title')?><small class="required">*</small></label>
                            <input type="text" class="form-control" placeholder="<?=$this->lang->line('placeholder_page_template_title')?>" name="title" required="" data-parsley-required-message="<?=$this->lang->line('error_page_title_required')?>" maxlength="50">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class=" form-group">                        
                            <label for="inputPassword4"><?=$this->lang->line('label_page_meta_desc')?></label>
                            <input type="text" class="form-control" placeholder="<?=$this->lang->line('placeholder_page_meta_desc')?>" name="meta_description">                        
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class=" form-group">                         
                            <label for="inputPassword4"><?=$this->lang->line('label_page_meta_content')?></label>
                            <input type="text" class="form-control" placeholder="<?=$this->lang->line('placeholder_page_meta_content')?>" name="meta_content">                    
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class=" form-group">                          
                            <label for="inputPassword4"><?=$this->lang->line('label_page_meta_key')?></label>
                            <input type="text" class="form-control" placeholder="<?=$this->lang->line('placeholder_page_meta_key')?>" name="meta_keyword">                         
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class=" form-group">
                            <label for="inputPassword4"><?=$this->lang->line('label_page_body')?><small class="required">*</small></label>
                            <textarea type="text" class="form-control tinymce_edittor" placeholder="<?=$this->lang->line('placeholder_page_body')?>" name="description"></textarea>
                        </div>
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm"><?=$this->lang->line('button_update')?></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?=$this->lang->line('button_close')?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </div>
    </div>
</div>
<!-- View Template Modal -->
<div id="viewTemplateModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-block modal-block-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <header class="card-header">
                <h2 class="card-title"><?=$this->lang->line('heading_page_preview')?></h2>
                <div class="card-actions">
                     <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
                </div>
            </header>
            <div class="card-body">
            </div>
            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?=$this->lang->line('button_close')?></button>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
<!-- custom css for page template -->
<link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/page_template/page_template.css" />
<!--  End -->
<!-- Support page js -->
<script src="<?php echo BACKEND_THEME_URL;?>js/page/page_template.js"></script>
<!--End Support page js -->

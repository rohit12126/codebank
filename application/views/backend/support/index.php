<div class="bredcrums-wrap">
    <ul>
        <li><a href="<?= base_url("backend/dashboard"); ?>"><?=$this->lang->line('heading_dashboard') ?></a></li>
        <li><?=$this->lang->line('heading_support') ?></li>
    </ul>
</div>
<section class="card">
    <header class="card-header">
        <h2 class="card-title"> <i class="fas fa-ticket-alt"></i><b><?=$this->lang->line('heading_support') ?></b></h2>
    </header>
    <div class="card-body">
        <form id="filterForm" onsubmit="return false;">
            <div class="row form-group">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput"><?= $this->lang->line('label_support_search')?></label>
                        <input type="text" class="form-control" id="search" placeholder="<?= $this->lang->line('placeholder_support_search')?>" onkeyup="customFilter();" value="<?= $this->input->get('search'); ?>">
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="col-form-label" for="inputPassword4"><?= $this->lang->line('label_subject')?></label>
                        <select class="form-control" id="searchSubject" onchange="customFilter();">
                            <option value=""><?= $this->lang->line('support_select_subject')?></option>
                            <?php foreach (support_subject() as $key => $row) { ?>
                               <option value="<?=$key ?>" <?php if($key === $this->input->get('status')) echo "selected"; ?>><?=$row ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="col-form-label" for="inputPassword4"><?= $this->lang->line('label_status')?></label>
                        <select class="form-control" id="searchStatus" onchange="customFilter();">
                            <option value=""><?= $this->lang->line('support_select_status')?></option>
                            <?php foreach (support_status() as $key => $value) { ?>
                                <option value="<?=$key?>" <?php if($key === $this->input->get('status')) echo "selected"; ?>><?=ucwords($value)?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="col-form-label" for="inputPassword4"><?= $this->lang->line('label_order_by')?></label>
                        <select class="form-control" id="searchOrderBy" onchange="customFilter();">
                            <option value=""><?= $this->lang->line('support_select_order_by')?></option>
                            <option value="0"><?= $this->lang->line('support_new')?></option>
                            <option value="1"><?= $this->lang->line('support_old')?></option>
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-3 search-btn-col">
                    <button type="button" class="btn btn-danger btn-reset" onclick="resetFilter();" data-toggle="tooltip" data-placement="top" title="" data-original-title="Reset your search"><i class="fas fa-sync-alt"></i></button>
                </div>
            </div>
        </form>
        <table id="example" class="<?= TABLE_CLASS; ?>">
            <thead>
                <tr>
                    <th style="width: 1%;">#</th>
                    <th style="width: 20%;"><?=$this->lang->line('table_heading_support_ticket_info') ?></th>
                    <th style="width: 35%;"><?=$this->lang->line('table_heading_support_user_info') ?></th>
                    <th style="width: 35%;"><?=$this->lang->line('table_heading_support_last_comment') ?></th>
                    <th style="width: 4%;"><?=$this->lang->line('table_heading_support_status') ?></th>
                    <th style="width: 5%;"><?=$this->lang->line('table_heading_support_actions') ?></th>
                </tr>
            </thead>
        </table>
    </div>
</section>
<!-- Support reply Modal -->
<div id="supportReplyModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-block modal-block-md modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
        </div>
    </div>
</div>
<!-- custom css for support page -->
<link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/support/support.css" />
<!--  End -->
<!-- support js -->
<script src="<?php echo BACKEND_THEME_URL;?>js/support/support.js"></script>
<!-- End support js -->

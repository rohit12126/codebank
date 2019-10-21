<div class="bredcrums-wrap">
    <ul>
        <li><a href="<?= base_url("backend/dashboard"); ?>"><?=$this->lang->line('heading_dashboard') ?></a></li>
        <li><?=$this->lang->line('heading_contact_us') ?></li>
    </ul>
</div>
<section class="card">
    <header class="card-header">
        <h2 class="card-title"> <i class="fas fa-comments" aria-hidden="true"></i><b><?=$this->lang->line('heading_contact_us') ?></b></h2>
    </header>
    <div class="card-body">
        <form id="filterForm" onsubmit="return false;">
            <div class="row form-group">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput"><?=$this->lang->line('label_contact_search') ?></label>
                        <input type="text" class="form-control" id="search" placeholder="<?=$this->lang->line('placeholder_contact_search') ?>" onkeyup="customFilter();" value="<?= $this->input->get('search'); ?>">
                    </div>
                </div>
                
                <div class="col-sm-6 search-btn-col">
                    <button type="button" class="btn btn-danger btn-reset" onclick="resetFilter();" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$this->lang->line('tooltip_contact_reset_search')?>"><i class="fas fa-sync-alt"></i></button>
                </div>
            </div>
        </form>
        <table id="example" class="<?= TABLE_CLASS; ?>">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?=$this->lang->line('table_heading_contact_name') ?></th>
                    <th><?=$this->lang->line('table_heading_contact_email') ?></th>
                    <th><?=$this->lang->line('table_heading_contact_number') ?></th>
                    <th><?=$this->lang->line('table_heading_contact_subject') ?></th>
                    <th><?=$this->lang->line('table_heading_contact_message') ?></th>
                    <th><?=$this->lang->line('table_heading_contact_actions') ?></th>
                </tr>
            </thead>
        </table>
    </div>
</section>
<!-- custom css for contact page -->
<link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/contact/contact.css" />
<!--  End -->
<!-- contact js -->
<script src="<?php echo BACKEND_THEME_URL;?>js/contact/contact.js"></script>
<!-- End Contact js -->

<div class="row">
    <div class="col">
        <div class="bredcrums-wrap">
            <ul>
                <li><a href="<?= base_url("backend/dashboard"); ?>"><?= $this->lang->line('heading_dashboard') ?></a></li>
                <li><?= $this->lang->line('heading_user') ?></li>
            </ul>
        </div>
        <section class="card card-min">
            <header class="card-header">
                <div class="download_sample">
                    <!-- <span class="recordsFiltered"><?= $this->lang->line('heading_total_records') ?>: 0</span> -->
                    <a href="javascript:void(0);" class="btn btn-primary btn-toggle-link tooltips" data-toggle="tooltip" title="<?=$this->lang->line('tooltip_user_import')?>" onclick="formToggle();">&nbsp; <?= $this->lang->line('button_import_csv'); ?> &nbsp;<i class="fa fa-chevron-down"></i> </a>
                    <button data-toggle="tooltip" title="<?=$this->lang->line('tooltip_user_add')?>" class="btn btn-primary mb-30 add-student"><i class="fas fa-plus"></i> <?= $this->lang->line('button_add_user');?></button>
                </div>
                <h2 class="card-title"><i class="fas fa-user" aria-hidden="true"></i> <b><?= $this->lang->line('heading_user') ?></b></h2>
            </header>
            <div class="clearfix"></div>
            <!-- File upload form -->
            <div class="card-body row" id="importFrm" style="display: none;">
                <div class="col-sm-12">
                    <form action="<?php echo base_url('backend/users/import'); ?>" class="student_upload" method="post" enctype="multipart/form-data" data-parsley-validate>
                        <div class="row student admin-uploade-section">
                            <div class="col-sm-6">
                                <p>
                                    <h4><?= $this->lang->line('heading_user_bulk_info') ?></h4>
                                    <ul class="backend-listing">
                                        <li>
                                            <div class="download-btn-wrap">  <?= $this->lang->line('heading_click_here') ?> 
                                                <a class="btn download_sample_btn" href="<?= base_url('assets/user_sample_data.csv') ?>" download><?= $this->lang->line('heading_download_sample') ?></a>
                                            </div>
                                        </li>
                                        
                                        <li>Attach/Upload only .csv file to insert user records in the system.</li>
                                        <li>Kindly Insert 250 records at a time, for adding more records again create new file.</li>
                                        <li>Kindly make sure before inserting the user data Email Address should be unique because this email address will be the login details of User.</li>
                                        <li>Kindly follow the user_sample_data.csv to Import Bulk user Data.</li>
                                    </ul>
                                    
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group text-center" id="dropContainerDocument">
                                    <label for="userImage" class="file-upload" style="position: relative;">
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-original-title="Click here to remove file" id="remove-file" style="position: absolute; right: 2px; top: 1px;display: none;"><i class="fa fa-times"></i></a>
                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                        <span><?= $this->lang->line('heading_user_bulk') ?></span>
                                        <p class="file_name"></p>
                                        <input type="file" name="file" id="userImage" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onchange="$('.file_name').html(this.files[0].name);$('#remove-file').show();" />
                                    </label>
                                    <div class="upload-download-btn-wrap">
                                        <div class="upload-download-btn">
                                            <input type="submit" class="btn btn-primary" name="importSubmit" id="importSubmit" value="Import">
                                        </div>
                                        <div class="download-btn-wrap">
                                            <a class="btn download_sample_btn" href="<?= base_url('assets/user_sample_data.csv') ?>" download><?=$this->lang->line('heading_download_sample') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>             
            </div>
            <div class="card-body" id="tab1">
                <form id="filterForm" onsubmit="return false;">
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label" for="formGroupExampleInput"><?= $this->lang->line('label_search')?></label>
                                <input type="text" class="form-control" id="searchName" placeholder="Search by user name, email" onkeyup="customFilter();" value="<?= $this->input->get('search') ; ?>">
                            </div>
                        </div>
                        
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="col-form-label" for="inputPassword4"><?= $this->lang->line('label_status')?></label>
                                <select class="form-control" id="searchStatus" onchange="customFilter();">
                                    <option value=""><?= $this->lang->line('label_select_status') ?></option>
                                    <?php foreach (status() as $key => $value) { ?>
                                        <option value="<?=$key?>" <?php if($key === $this->input->get('status')) echo "selected"; ?>><?=ucwords($value)?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 search-btn-col">
                            <div class="form-group">
                                <label class="col-form-label" for="inputPassword4"><?= $this->lang->line('label_mail_sent')?></label>
                                <select class="form-control" id="searchVerify" onchange="customFilter();">
                                    <option value=""><?= $this->lang->line('label_select_status') ?></option>
                                    <?php foreach (mail_status() as $key => $value) { ?>
                                        <option value="<?=$key?>" <?php if($key === $this->input->get('verify')) echo "selected"; ?>><?=ucwords($value)?></option>
                                    <?php } ?>
                                    
                                </select>
                            </div>
                            <button type="button" class="btn btn-danger btn-reset ml-3" onclick="resetFilter();" data-toggle="tooltip" data-placement="top"   title="" data-original-title="<?=$this->lang->line('tooltip_user_reset_search')?>"><i class="fas fa-sync-alt"></i></button>
                        </div>
                    </div>
                </form>
                <!-- <div class="table-responsive"> -->
                    <table id="example" class="<?= TABLE_CLASS; ?> table-list user-list-table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="col-sm-12 no-padding">
                                        <div class="checkbox-wrap">
                                            <label class="checkbox-input term-check check-box-block">
                                                <input class="styled" type="checkbox" id="checkAll" class="" >
                                                <div class="checkbox" for="checkAll"></div>
                                            </label>
                                            <div class="all-select-box">
                                                <select class="form-control commonstatus order-select-status">
                                                    <option value=""><?= $this->lang->line('option_title_all')?></option>
                                                    <option value="1"><?= $this->lang->line('option_title_active')?></option>
                                                    <option value="2"><?= $this->lang->line('option_title_inactive')?></option>
                                                    <option value="3"><?= $this->lang->line('option_title_send_mail')?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <th><?= $this->lang->line('table_heading_user_name')?></th>
                                <th><?= $this->lang->line('table_heading_email')?></th>
                                <th><?= $this->lang->line('table_heading_contact_number')?></th>
                                <th><?= $this->lang->line('table_heading_user_login')?></th>
                                <th><?= $this->lang->line('table_heading_mail_sent')?></th>
                                <th><?= $this->lang->line('table_heading_status')?></th>
                                <th><?= $this->lang->line('table_heading_last_login')?></th>
                                <th style="width: 300px;"><?= $this->lang->line('table_heading_action')?></th>
                            </tr>
                        </thead>
                    </table>
                <!-- </div> -->
            </div>
        </section>
    </div>
</div>
<!-- Add Student Modal -->
<div id="addSubjectModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <header class="card-header">
                <h2 class="card-title"><?= $this->lang->line('heading_add_user');?></h2>
                <div class="card-actions">
                    <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
                </div>
            </header>
            <form autocomplete="off" method="POST" class="mb-0 addStudents" action="<?= base_url('backend/users/add'); ?>" data-parsley-validate enctype="multipart/form-data">
                <div class="card-body">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="hidden" name="user_id">
                            <label for="inputPassword4"><?= $this->lang->line('label_user_name');?><small class="required">*</small></label>
                            <input type="text" class="form-control" placeholder="<?= $this->lang->line('placeholder_user_name');?>" name="name" required="" data-parsley-required-message="<?= $this->lang->line('error_user_name_required');?>" maxlength="40">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputPassword4"><?= $this->lang->line('label_email');?> <small class="required">*</small></label>
                            <input type="email" class="form-control" placeholder="<?= $this->lang->line('placeholder_email');?>" name="email" required="" data-parsley-required-message="<?= $this->lang->line('error_email_required');?>" data-parsley-type-message="<?= $this->lang->line('error_email_invalid');?>" maxlength="50">
                        </div>
                    </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputPassword4"><?= $this->lang->line('label_contact_number');?></label>
                            <input type="text" name="contact" class="form-control contact" placeholder="<?= $this->lang->line('placeholder_contact_number');?>" data-parsley-minlength="10" maxlength="15" data-parsley-type="digits" data-parsley-type-message="Contact number must contain only digits." data-parsley-minlength-message="<?= $this->lang->line('error_contact_number_minlength');?>" onkeypress="return isNumber(event)">
                        </div>
                    </div>
                     <div class="col-sm-6">
                         <div class="form-group">
                            <label for="inputPassword4"><?= $this->lang->line('label_date_of_birth');?></label>
                                <input type="text" name="date_of_birth" class="form-control date-mask" placeholder="MM/DD/YYYY" data-parsley-required-message="" data-parsley-pattern="^[0-9]{2}/[0-9]{2}/[0-9]{4}$"
                                data-parsley-max-message="Date of birth should be less than current date." data-parsley-pattern-message="<?= $this->lang->line('error_date_of_birth_invalid');?>">
                        </div>
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm"><?= $this->lang->line('button_submit'); ?></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('button_close'); ?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </div>
    </div>
</div>
<!-- Change Password Modal -->
<div id="changePasswordModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <header class="card-header">
                <h2 class="card-title"><?= $this->lang->line('heading_change_password')?></h2>
                <div class="card-actions">
                    <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
                </div>
            </header>
            <form method="POST" class="mb-0" id="change_password" action="<?= base_url('backend/users/change_password'); ?>" data-parsley-validate>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputPassword4"><?= $this->lang->line('label_new_password')?></label>
                        <input type="hidden" name="user_id">
                        <input type="password" id="password1" class="form-control" placeholder="******" name="new_pass" required="" data-parsley-required-message="<?= $this->lang->line('error_new_password_required')?>" maxlength="20" pattern="/^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/" data-parsley-pattern-message="<?= $this->lang->line('error_confirm_password_minlength')?>">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword4"><?= $this->lang->line('label_confirm_password')?></label>
                        <input type="password" id="con_pass" class="form-control" name="con_pass" placeholder="******" required="" data-parsley-required-message="<?= $this->lang->line('error_confirm_password_required')?>" data-parsley-equalto="#password1" data-parsley-equalto-message="<?= $this->lang->line('error_confirm_password_same')?>" maxlength="20">
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm"><?= $this->lang->line('button_submit');?></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('button_close');?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </div>
    </div>
</div>
<!-- Import Student Modal -->
<div id="importStudentModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-block modal-block-full modal-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <header class="card-header">
                <h2 class="card-title"><?=$this->lang->line('heading_import_user')?></h2>
                <div class="card-actions">
                    <a href="#" class="card-action card-action-dismiss fa fa-times" onclick="close_import_student();"></a>
                </div>
            </header>
            <form method="POST" class="mb-0" action="<?= base_url('backend/users/add_bulk_student'); ?>" data-parsley-validate>
                <div class="student-list-section">
                    
                </div>
            </form>
        </div>
    </div>
</div>
<!-- View Student Modal -->
<div id="viewStudentModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-block modal-block-lg modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
        </div>
    </div>
</div>
<!-- View Student Modal -->
<div id="viewLoginHistoryModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-block modal-block-md modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
        </div>
    </div>
</div>
<!-- View Student Modal -->
<div id="inactiveModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-block modal-block-md modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <header class="card-header">
                <h2 class="card-title"><?= $this->lang->line('heading_inactive_user')?></h2>
                <div class="card-actions">
                    <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
                </div>
            </header>
            <form autocomplete="off" method="POST" class="mb-0" data-parsley-validate>
                <div class="card-body">
                    <div class="form-group" style="width: 100%;">
                        <input type="hidden" name="user_id">
                        <label for="inputPassword4"><?= $this->lang->line('label_inactive_reason')?><small class="required">*</small></label>
                        <textarea class="form-control" placeholder="Type here. . ." name="reason" required="" data-parsley-required-message="This field is required." maxlength="240"></textarea>
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary"><?= $this->lang->line('button_send_mail')?></button>
                            <button type="button" class="btn btn-default modal-confirm"><?= $this->lang->line('button_inactive_without_mail')?></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('button_close')?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </div>
    </div>
</div>
<!-- custom css for user page -->
<link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/user/user.css" />
<!--  End -->
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<!-- User js -->
<script src="<?php echo BACKEND_THEME_URL;?>js/user/user.js"></script>
<!-- End User js -->

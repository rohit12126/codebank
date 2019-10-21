<header class="card-header">
    <h2 class="card-title"><?= $this->lang->line('heading_user_information') ?></h2>
    <div class="card-actions">
        <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
    </div>
</header>
<div class="card-body">
    <div class="edit-wrap">
        <a href="javascript:;" class="edit-student" data-id="<?= $user_id; ?>"> <i class="fa fa-edit"></i> </a>
    </div>        
    <div class="row  modal-row col-sm-12">
        <div class="col-lg-6 col-xl-6">
            <h5 class="heading"><span><i class="fa fa-info-circle" aria-hidden="true"></i> </span><b><?= $this->lang->line('heading_basic_information') ?></b></h5>
            <table class="table">
                <tbody>
                    <tr>
                        <th><?=$this->lang->line('table_heading_user_name') ?></th>
                        <td> <font class="colon">: &nbsp;</font><?= ucfirst($user['name']); ?></td>
                    </tr>
                    <tr>
                        <th><?=$this->lang->line('table_heading_email') ?></th>
                        <td> <font class="colon">: &nbsp;</font><?= $user['email']; ?></td>
                    </tr>
                    <tr>
                        <th><?=$this->lang->line('table_heading_contact_number') ?></th>
                        <td> <font class="colon">: &nbsp;</font><?= $user['contact']?$user['contact']: "N/A"; ?></td>
                    </tr>
                    <tr>
                        <th><?=$this->lang->line('table_heading_date_of_birth') ?></th>
                        <td> <font class="colon">: &nbsp;</font><?= change_date_format($user['date_of_birth'], 'd M, Y')?change_date_format($user['date_of_birth'], 'd M, Y'): "N/A"; ?></td>
                    </tr>
                    <tr>
                        <th><?=$this->lang->line('table_heading_status') ?></th>
                        <td class="btn00 btn-xs00 cursor-text"> <font class="colon">: &nbsp;</font>
                            <?php
                            if($user['status']) {
                                echo "Active";
                            }
                            else {
                                echo "Inactive";
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-6 col-xl-6">
            <h5 class="heading"><span><i class="fa fa-unlock" aria-hidden="true"></i> 
            </span><b><?=$this->lang->line('heading_account_access') ?></b></h5>
            <table class="table">
                <tbody>
                    <tr>
                        <th>
                            <?=$this->lang->line('heading_account_created') ?>
                        </th>
                        <td> <font class="colon">: &nbsp;</font><i class="fa fa-calendar"></i>
                            <?= change_date_format($user['created_on'], 'd M Y, H:i'); ?><br>
                        </td>
                    </tr>
                    <tr>
                        <th> 
                            <?=$this->lang->line('heading_account_update') ?>
                        </th>
                        <td> <font class="colon">: &nbsp;</font><i class="fa fa-calendar"></i>
                            <?= $user['updated_on'] ? change_date_format($user['updated_on'], 'd M Y, H:i') : "N/A"; ?><br>
                        </td>
                    </tr>
                    <tr>
                        <th> 
                            <?=$this->lang->line('heading_last_login') ?>
                        </th>
                        <td> <font class="colon">: &nbsp;</font><i class="fa fa-calendar"></i>
                            <?= $user['last_login']? change_date_format($user['last_login'], 'd M Y, H:i') : "N/A"; ?><br>
                        </td>
                    </tr>
                    <tr>
                        <th> 
                            <?=$this->lang->line('heading_last_login_ip') ?>
                        </th>
                        <td> <font class="colon">: &nbsp;</font><i class="fa fa-desktop" aria-hidden="true"></i>
                            <?= $user['ip_address'] ? $user['ip_address'] : "N/A"; ?><br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer class="card-footer">
    <div class="row">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('button_close')?></button>
        </div>
    </div>
</footer>
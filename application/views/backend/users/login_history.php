<header class="card-header">
    <h2 class="card-title"><?= $this->lang->line('heading_user_login_history') ?></h2>
    <div class="card-actions">
        <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
    </div>
</header>
<div class="card-body">
    <div class="row modal-row">
        <div class="col-md-12">
            <!-- <h5 class="heading"><span><i class="fa fa-info-circle" aria-hidden="true"></i> </span><b>Login History </b></h5> -->
            <div class="history-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?=$this->lang->line('table_heading_date') ?></th>
                            <th><?=$this->lang->line('table_heading_city') ?></th>
                            <th><?=$this->lang->line('table_heading_ip') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $row) {
                            ?>
                            <tr>
                                <td><?= change_date_format($row->created_on, 'd M, Y h:i A'); ?></td>
                                <td><?= $row->city?$row->city:'N/A'; ?></td>
                                <td><?= $row->ip_address; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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
<?php
$firstUser = 0;
$secondUser = 0;
$thirdUser = 0;
$totalUser = 0;
$adminUser = 4;
$systemUser = 3;
$start_date = date('Y-m-d');
foreach ($users as $row) {
    if(change_date_format($row->created_on) >= date('Y-m-d', strtotime($start_date . ' -7 day'))) {
        $firstUser++;
    }
    if(change_date_format($row->created_on) >= date('Y-m-d', strtotime($start_date . ' -30 day'))) {
        $secondUser++;
    }
    if(change_date_format($row->created_on) >= date('Y-m-d', strtotime($start_date . ' -90 day'))) {
        $thirdUser++;
    }
    $totalUser++;
    if($row->user_type) {
        $adminUser++;
    }
    else {
        $systemUser++;
    }
}
?>
<section class="card dashboard">
    <header class="card-header">
        <div class="card-actions" style="top: 5px;"> </div>
        <header class="panel-heading" style="font-weight: bold;font-size:16px;">
            <?=ucfirst($this->lang->line('heading_dashboard_hello'))?> <?= ucfirst(superadmin_name()); ?>, <?=ucfirst($this->lang->line('heading_dashboard_welcome'))?> <?= SITE_NAME; ?>.
        </header>
    </header>
    <div class="card-body main-bg">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">       
                            <div class="text-value"><?= $firstUser; ?></div>
                             <div><?=$this->lang->line('heading_last_week')?></div>
                             <div class="card-icon-wrap"><i class="fa fa-user"></i></div> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <button class="btn btn-transparent p-0 float-right" type="button">
                            <i class="icon-location-pin"></i>
                            </button>
                            <div class="text-value"><?= $secondUser; ?></div>
                            <div><?=$this->lang->line('heading_last_month')?></div>
                            <div class="card-icon-wrap"><i class="fa fa-user"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <div class="text-value"><?= $thirdUser; ?></div>
                            <div><?=$this->lang->line('heading_last_three_month')?></div>
                            <div class="card-icon-wrap"><i class="fa fa-user"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <div class="text-value"><?= $totalUser; ?></div>
                            <div><?=$this->lang->line('heading_total_users')?></div>
                            <div class="card-icon-wrap"><i class="fa fa-users"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"><a>Users</a></div>
                        <div class="card-body">
                            <?php
                            if($graph) {
                                ?>
                                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                                <?php
                            }
                            else {
                                ?>
                                <div class="no-data-img-wrap">
                                    <img src="<?= base_url(BACKEND_NO_DATA_AVAILABLE); ?>">
                                    <p>No data available!</p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><a><?=$this->lang->line('heading_dashboard_no_of_user')?></a></div>
                        <div class="card-body">
                            <?php
                            if(!$adminUser && !$systemUser) {
                                ?>
                                <div class="no-data-img-wrap">
                                    <img src="<?= base_url(BACKEND_NO_DATA_AVAILABLE); ?>">
                                    <p><?=$this->lang->line('heading_dashboard_no_data')?></p>
                                </div>
                                <?php
                            }
                            else {
                                ?>
                                <div id="chartContainer1" style="height: 300px; width: 100%;"></div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- custom css for dashboard page -->
<link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/dashboard/dashboard.css"/>
<!--  End -->
<script>
/* Variables for chart data*/
var _dataPoints =  <?= json_encode($graph, JSON_NUMERIC_CHECK) ?>;
var _adminCreatedUser = <?= $adminUser; ?>;
var _systemUser = <?= $systemUser; ?>;
</script>
<!-- custom js for dashboard -->
<script src="<?php echo BACKEND_THEME_URL;?>js/dashboard/dashboard.js"></script>
<!-- end -->
<!-- canvas chart js -->
<script src="<?= base_url("assets/frontend/js/canvasjs.min.js"); ?>"></script>
<!-- end -->

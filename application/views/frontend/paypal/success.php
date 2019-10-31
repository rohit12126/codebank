<?= $topbar; ?>
<section class="body-wrap">
    <div class="dashboars-wrap profile-page">
        <div class="page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="custom-bredcrum">
                        <ul>
                            <li><a href="<?= base_url(); ?>"><?=$this->lang->line('heading_home')?></a></li>
                            <li><b><?=$this->lang->line('heading_my_profile')?></b></li>
                        </ul>
                    </div>
                    <div class="row profile-form-wrap">
                        <div class="col-sm-12">
                            <div class="basic-info-wrap">
                                <div class="user-common-heading">
                                    <h2><span class="highlighter">PayPal</span> Payment</h2>
                                </div>
                                <div class="basic-info-content">

                                    <div class="thank-page-section">
                                        <div class="thank-page-block-up">
                                            <div class="thank-page-img">
                                                <img style="height: 50px;" src="<?php echo base_url("assets/frontend/img/check.svg"); ?>" >
                                            </div>
                                            <h2>Payment Details <span></span></h2>
                                        </div>
                                        <p>Transaction ID : <span><?php echo isset($result->txn_id)?$result->txn_id:''; ?>
                                            <?php echo isset($txn_id)?$txn_id:''; ?>
                                        </span></p>
                                        <p>Amount Paid : <span class="amount-block">€<?php echo isset($result->amount)?$result->amount:''; ?></span></p>
                                        <p>Payment Status : <span><b>
                                            <?php
                                            /*if($result->status == 1) {
                                                echo 'Completed';
                                            }
                                            else if($result->status == 2) {
                                                echo 'Failure';
                                            }
                                            else {
                                                echo $result->status;
                                            }*/
                                            ?>
                                            </b></span>
                                        </p>
                                        <p><small>It may take some time to update the details in your Account.</small></p>
                                        <div class="user-sent-info">
                                            <div class="user-sent-info-heading">A receipt of payment has been sent to</div>
                                            <a href="mailto:<?php echo isset($result->email)?$result->email:''; ?>" class="user-sent-info-email"><?php echo isset($result->email)?$result->email:''; ?></a><br>
                                            <a href="<?= base_url('account/profile'); ?>" class="btn btn-primary">Back to Profile</a>
            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
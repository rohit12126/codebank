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
                                                    <!-- <img src="<?php echo base_url("assest/frontend/img/check.svg"); ?>" > -->
                                                </div>
                                                <i class="fa fa-times-circle" aria-hidden="true" style="font-size: 61px; color: #e35a10; padding-bottom: 15px;"></i>
                                                <h2>Payment Failed!</h2>
                                            </div>
                                            <p>We're sorry, something went wrong with your payment.</p>
                                            <div class="user-sent-info">
                                                <div class="btn-contishop">
                                                    <a href="<?php echo base_url("paypal"); ?>" class="btn  contact-us-button">
                                                        Try again
                                                    </a>
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
    </div>
</section>
<?= $topbar; ?>
<section class="body-wrap">
    <div class="dashboars-wrap profile-page marked-page">
        <div class="page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper marked-main-section">
                    <div class="custom-bredcrum">
                        <ul>
                            <li><a href="<?= base_url(); ?>"><?=$this->lang->line('heading_home')?></a></li>
                            <li><b><?=$this->lang->line('heading_support_list')?></b></li>
                        </ul>
                    </div>
                    <div class="marked-section">
                        <div class="col-sm-12 marked-question-bg">
                            <div class="row marked-question-wrap">
                                <div class="col-sm-<?php echo isset($support) && !empty($support)?'7':'12'?> pl-0 pr-0 chat-left-bg">
                                    <div class="marked-question-left">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h4><?=$this->lang->line('heading_support_tickets')?></h4>
                                            <a href="javascript:0;" class="btn btn-primary mr-2" data-toggle="modal" data-target="#newTicketModal"><?=$this->lang->line('button_new_ticket')?></a>    
                                        </div>
                                        
                                        <div id="custom-scrollbar">
                                            <?php if(isset($support) && !empty($support)):?>
                                            <?php foreach ($support as $key => $row) : ?>
                                                <div class="marked-question-inner-body view-ticket <?php echo ($key == 0)?'clicked-highlight':''?>" onclick="getChat('<?php echo  $row->support_id;?>', '<?php echo $row->status?>')" id="question_<?=  $row->support_id;?>" rel="<?= $key+1; ?>">
                                                    <div class="question list-tile">
                                                        <div class="ticket-number-wrap"><span class="chat-question-numbering"><?= $key+1; ?>.</span><?= $row->ticket_id; ?></div>
                                                        <div class="subject">
                                                            <p class="d-flex">
                                                                <span class="mr-2"><i class="fa fa-comments-o"></i></span> 
                                                                <span><?php echo support_subject($row->subject); ?></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                     
                                                   
                                                    <div class="questin-right-section ">
                                                        <div class="question-date-wrap">
                                                            <i class="fa fa-calendar" aria-hidden="true"></i> Date: <?= change_date_format($row->created_on, 'd M, Y'); ?>
                                                        </div>
                                                        <div class="question-status-wrap">
                                                            <i class="fa fa-toggle-<?php echo ($row->status==1)?'on':'off'?>" aria-hidden="true"></i> Status: <?php echo ($row->status==1)?'<span class="status-open">Open</span>':'<span class="status-closed">Closed</span>'?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                            <div class="no-data-img-wrap">
                                                <img src=" <?= base_url("assets/frontend/img/no-data-img.png"); ?>">
                                                <p><?=$this->lang->line('heading_no_tickets')?></p>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>  
                                <?php if(isset($support) && !empty($support)):?>
                                <div class="col-sm-5 pl-0 pr-0 chat-right-bg">
                                    <div class="chat-section chat_wrap">
                                        <!--  chat section here (Dynamic)-->

                                    </div>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>           
                </div>
            </div>
        </div>
    </div>
</section>
<div class="login-modal-wrap tutorial">
    <div class="modal fade" id="examModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="<?php echo base_url('assets/frontend/img/cross.svg')?>" width="20px;"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login-form choose-exam-section" >
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newTicketModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered chat-modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="<?php echo base_url('assets/frontend/img/cross.svg')?>" width="20px;"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login-form choose-exam-section" >
                        <form method="POST" action="<?= base_url('account/support/generate_ticket'); ?>" data-parsley-validate class="marked-textare" id="ticketForm">
                            <div class="chat-form-wrap">
                                <div class="form-group">
                                    <label for="subject"><?= $this->lang->line('label_subject')?><small class="required">*</small></label>
                                    <select class="form-control" name="subject" id="subject" required="" data-parsley-required-message="Subject is required.">
                                        <option value="">Select subject</option>
                                        <?php foreach (support_subject() as $key => $row) { ?>
                                            <option value="<?=$key ?>"><?=$row ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comment"><?= $this->lang->line('label_comment')?><small class="required">*</small></label>
                                    <textarea class="form-control" rows="3" id="comment" name="comment" placeholder="Type Your Message Here...." required="" data-parsley-required-message="Comment is required."></textarea>
                                </div>
                                <div class="marked-form-btn-wrap">
                                    <button type="submit" class="btn btn-primary" id="btn_submit"><?=$this->lang->line('button_submit')?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('.tooltip').tooltip();

        $('.view-ticket').on('click', function(){
            $('.clicked-highlight').removeClass('clicked-highlight');
            $(this).addClass('clicked-highlight');
        });

        defaultSupportId = '';
        <?php if(isset($support) && !empty($support)){ ?>
            defaultSupportId = '<?php echo $support[0]->support_id ?>';
        <?php }?>
        getChat(defaultSupportId, 1);

    });

    function getChat(supportId, scroll) {
        if(supportId) {
            $('.main-loader').removeClass('dn');
            $.ajax({
                type:"POST",
                url:"<?php echo base_url('account/support/get_support_chat');?>",
                data:'support_id='+supportId,
                success:function(output){
                    if(output) {
                        $('.chat_wrap').html(output);
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                    $('.main-loader').addClass('dn');
                },
                error: function (error) {
                    console.log(error);
                    $('.main-loader').addClass('dn');
                    toasterMessage('error', '<?= AJAX_ERROR_MESSAGE; ?>');
                }
            });
        }
    }

    $("body").on('submit', '#ticketForm', function( event ) {
        if($(this).parsley().isValid()){
            var POSTURL = $(this).attr('action');
            var data = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: POSTURL,
                data: data,
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                beforeSend: function () {
                    $('.main-loader').removeClass('dn');
                },
                complete: function () {
                    $(".main-loader").addClass('dn');
                },
                success: function (output) {
                    toasterMessage(output.status, output.message);
                    if(output.status == 'success') {
                        $('#newTicketModal').modal('hide');
                        if(data.inserted_id) {
                            getChat(data.inserted_id, 1);    
                        }
                        location.reload();
                    }
                },
                error: function (error) {
                    $('.main-loader').addClass('dn');
                    toasterMessage('error', '<?= AJAX_ERROR_MESSAGE; ?>');
                }
            });
            event.preventDefault();
        }
    });

    $("body").on('submit', '#commentForm', function( event ) {
        if($(this).parsley().isValid()){
            var POSTURL = $(this).attr('action');
            var data = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: POSTURL,
                data: data,
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                beforeSend: function () {
                    $('.main-loader').removeClass('dn');
                },
                complete: function () {
                    $(".main-loader").addClass('dn');
                },
                success: function (output) {
                    if(output.status == 'success') {
                        $(this).trigger('reset');
                        var support_id = $("input[name=support_id]").val();
                        if(support_id) {
                            getChat(support_id, 1);    
                        }
                    }
                    //toasterMessage(output.status, output.message);
                },
                error: function (error) {
                    $('.main-loader').addClass('dn');
                    toasterMessage('error', '<?= AJAX_ERROR_MESSAGE; ?>');
                }
            });
            event.preventDefault();
        }
    });
</script>
<style>
    a.morelink {
        text-decoration:none;
        outline: none;
    }
    .morecontent span {
        display: none;
    }
    td.comment.more {
        background: #fff;
    }
    body{
        background:#f5f5f5; 
    }
    .toggle-bar-icon i{
        color: #fff;
    }
    .reciver-time {
        text-align: right;
    }
    .sender-time {
        text-align: left;
    }
    .ticket-number-wrap{
        display: flex;
        width: 160px;
    }
</style>
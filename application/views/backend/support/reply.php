  <!-- Modal content-->
<div class="modal-content chat-section ">
    <header class="card-header">
        <h2 class="card-title"><?=$this->lang->line('heading_ticket_number') ?> : <?= strtoupper($support->ticket_id)?></h2>
        <div class="card-actions">
            <a href="#" class="card-action card-action-dismiss fa fa-times" data-dismiss="modal"></a>
        </div>
    </header>
    <div class="chat-content">
        <div id="custom-scrollbar">
        <?php if(!empty($support)) {
            $replies = json_decode($support->replies);
            foreach ($replies as $key => $row_array) { 
                if (array_key_exists("You",$row_array)) { ?>
                    <div class="reciver-content-wrap">
                        <div class="reciver-content" id="receiver">
                           <?= ucfirst($row_array->You->comment); ?>
                        </div>
                    </div>
               
                    <div class="reciver-time">
                        <span>
                           <?= change_date_format($row_array->You->date, 'M j, Y, g:i A'); ?>
                        </span>
                    </div>
                <?php } else if (array_key_exists("Admin",$row_array)) { ?>
                    <div class="sender-content-wrap">
                        <div class="sender-content" id="sender">
                            <?= ucfirst($row_array->Admin->comment);?>
                        </div>
                    </div>
               
                    <div class="sender-time">
                        <span>
                           <?= change_date_format($row_array->Admin->date, 'M j, Y, g:i A'); ?>
                        </span>
                    </div>
                <?php }
                ?>
            <?php }
        } ?>
                
        </div>
    </div>
    <form method="POST" class="mb-0 " action="<?= base_url('backend/support/reply'); ?>" data-parsley-validate enctype="multipart/form-data" id="commentForm">
        <div class="card-body">
            <div class="full-form-group">
                <input type="hidden" name="support_id" value="<?= $support->support_id?>">
                <label for="comment"><?=$this->lang->line('label_support_comment')?><small class="required">*</small></label>
                <textarea <?= $support->status==0?'disabled':''?> class="form-control comment" id="comment" placeholder="Type here..." name="reply" required="" data-parsley-required-message="<?=$this->lang->line('error_message_comment_required')?>"></textarea>
            </div>
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary modal-confirm" <?= $support->status==0?'disabled':''?>><?=$this->lang->line('button_reply')?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?=$this->lang->line('support_button_close') ?></button>
                </div>
            </div>
        </footer>
    </form>
</div>
<!-- custom css for support reply section -->
<link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/support/reply.css" />
<!--  End -->
<script src="<?= base_url('assets/frontend/js/parsley.js'); ?>"></script>
<script src="<?php echo BACKEND_THEME_URL;?>js/support/admin_reply.js"></script>

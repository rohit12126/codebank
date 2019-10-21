<div class="chat-heading">
    <h4><span></span> <?=$this->lang->line('heading_ticket_number_on_chat')?> : <?= strtoupper($support->ticket_id)?></h4>
</div>
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
<script src="<?= base_url('assets/frontend/js/parsley.js'); ?>"></script>
<form method="POST" action="<?= base_url('account/support/reply'); ?>" data-parsley-validate class="marked-textare" id="commentForm">
    <div class="chat-form-wrap">
        <div class="form-group">
            <input type="hidden" name="support_id" class="support_id" value="<?= $support->support_id?>">
            <textarea <?= $support->status==0?'disabled':''?> class="form-control" rows="3" id="comment" name="comment" placeholder="Type Your Message Here...." class="comment" required="" data-parsley-required-message="Comment is required."></textarea>
        </div>
        <div class="marked-form-btn-wrap">
            <button type="submit" class="btn btn-primary pull-left" id="btn_submit" <?= $support->status==0?'disabled':''?>><?=$this->lang->line('button_reply')?></button>
        </div>
    </div>
</form>
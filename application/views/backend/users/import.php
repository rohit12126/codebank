<div class="card-body" style="max-height: 500px; overflow: scroll;">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 20px;">#</th>
                    <th style="width: 160px;"><?= $this->lang->line('table_heading_user_name')?><small class="required">*</small></th>
                    <th style="width: 230px;"><?= $this->lang->line('table_heading_email')?><small class="required">*</small></th>
                    <th style="width: 140px;"><?= $this->lang->line('table_heading_contact_number')?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($data as $row) {
                    // print_r($row);
                    $i++;
                    ?>
                    <tr>
                        <td style="display: flex; align-items: center;"><?= $i; ?>.&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="remove_row"><i class="fa fa-times"></i></a></td>
                        <td>
                            <input type="name" name="name[]" class="form-control" id="name" placeholder="Ex: John Doe" value="<?= $row[0]; ?>" required="" data-parsley-required-message="<?= $this->lang->line('error_user_name_required')?>" maxlength="50">
                        </td>
                        <td>
                            <input type="email" name="email[]" class="form-control" id="email" placeholder="Ex: johndoe@gmail.com" value="<?= $row[1]; ?>" required="" data-parsley-required-message="<?= $this->lang->line('error_email_required')?>" data-parsley-type-message="<?= $this->lang->line('error_email_invalid')?>">
                            <ul class="parsley-errors-list filled duplicate_email" style="display: none;"><li class="parsley-required"><?= $this->lang->line('error_message_email_address_exist')?></li></ul>
                        </td>
                        <td>
                            <!-- <input type="text" name="contact[]" class="form-control contact" placeholder="___-___-____" data-parsley-pattern="^[0-9]{3}-[0-9]{3}-[0-9]{4}$" data-parsley-pattern-message="Invalid contact number." value="<?= $row[2] ?>"> -->
                            <input type="text" name="contact[]" class="form-control contact" placeholder="Contact Number" minlength="10" maxlength="15" value="<?= $row[2] ?>">
                        </td>
                        
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<footer class="card-footer">
    <div class="row">
        <div class="col-md-12 text-right">
            <button class="btn btn-primary modal-confirm"><?= $this->lang->line('button_submit')?></button>
            <button type="button" class="btn btn-default" onclick="close_import_student();"><?= $this->lang->line('button_close')?></button>
        </div>
    </div>
</footer>
<script>
    $( function() {
        $( ".datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            inline: true,
        });
    } );
    $(".remove_row").click(function(){
        $(this).parents('tr').remove();
    });
</script>
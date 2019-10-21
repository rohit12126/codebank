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
                        <div class="col-sm-6 ">
                            <div class="basic-info-wrap">
                                <div class="user-common-heading">
                                    <h2><span class="highlighter"><?=$this->lang->line('heading_user')?></span> <?=$this->lang->line('heading_information')?></h2>
                                </div>
                                <div class="basic-info-content">
                                    <div class="basic-info-form">
                                        <form data-parsley-validate class="form-horizontal" id="profileForm" role="form" method="POST" action="<?= base_url("account/profile/profile_change"); ?>">
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="name" class ="control-label"><?=$this->lang->line('label_user_name')?><span class="red-star">*</span></label>
                                                </div>
                                                <div class="input-wrap name-input img-right-border">
                                                    <input type="text" id="name" name="name" class="form-control" id="name" placeholder="Ex: John Doe" value="<?= $user['name']; ?>" required="" data-parsley-required-message="Student name is required." maxlength="50">
                                                    <?= file_get_contents_curl("assets/frontend/img/user-login.svg"); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="email" class ="control-label"><?=$this->lang->line('label_email_address')?><span class="red-star">*</span></label>
                                                </div>
                                                <div class="input-wrap img-right-border">
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Ex: johndoe@gmail.com" value="<?= $user['email']; ?>" required="" data-parsley-required-message="Email address is required." data-parsley-type-message="Invalid email address.">
                                                    <?= file_get_contents_curl("assets/frontend/img/close-envelope.svg"); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="email" class ="control-label"><?=$this->lang->line('label_contact_number')?></label>
                                                </div>
                                                <div class="input-wrap img-right-border">
                                                    <input type="text" name="contact" class="form-control contact" placeholder="Contact Number" data-parsley-minlength="10" maxlength="15" data-parsley-minlength-message="Contact number should be minimum 10 digits." value="<?= $user['contact']; ?>">
                                                    <?= file_get_contents_curl("assets/frontend/img/phone.svg"); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="name" class ="control-label"><?=$this->lang->line('label_date_of_birth')?></label>
                                                </div>
                                                <div class="input-wrap name-input img-right-border">
                                                    <input type="text" name="date_of_birth" class="form-control date-mask" placeholder="Ex: 23/06/2019" value="<?= change_date_format($user['date_of_birth'], 'm/d/Y'); ?>" data-parsley-required-message="Date of Birth is required" data-parsley-pattern="^[0-9]{2}/[0-9]{2}/[0-9]{4}$" data-parsley-pattern-message="Invalid date.">
                                                    <?= file_get_contents_curl("assets/frontend/img/calendar.svg"); ?>
                                                </div>
                                            </div>
                                            <div class="form-group edit-btn ">
                                                <div class="label-btn-wrap label-wrap"> </div>
                                                <div class="input-wrap">
                                                    <button type="submit" class="btn white-btn"><?=$this->lang->line('button_update')?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="change-password-wrap">
                                <div class="user-common-heading">
                                    <h2><span class="highlighter"><?=$this->lang->line('heading_password')?></span> <?=$this->lang->line('heading_password')?></h2>
                                </div>
                                <div class="change-password-content">
                                    <form data-parsley-validate method="POST" id="passwordForm" action="<?= base_url("account/profile/change_password"); ?>">
                                        <div class="form-group">
                                            <div class="label-wrap">
                                                <label for="npwd" class="control-label"><?=$this->lang->line('label_old_password')?><span class="red-star">*</span></label>
                                            </div>
                                            <div class="input-wrap pasword-input img-right-border">
                                                <input type="password" id="old_password" class="form-control" name="old_password"placeholder="Ex: abc123456" required="" data-parsley-required-message="Old password is required.">
                                                <?= file_get_contents_curl("assets/frontend/img/input-lock.svg"); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="label-wrap">
                                                <label for="npwd" class="control-label"><?=$this->lang->line('label_new_password')?><span class="red-star">*</span></label>
                                            </div>
                                            <div class="input-wrap pasword-input img-right-border">
                                                <input type="password" id="password1" class="form-control" placeholder="Ex: 123456abc" name="password" required="" data-parsley-required-message="New password is required." maxlength="20" pattern="/^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/" data-parsley-pattern-message="Password should be minimum 6 characters in length including numbers and letters.">
                                                <?= file_get_contents_curl("assets/frontend/img/input-lock.svg"); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="label-wrap">  
                                                <label for="cpwd" class="control-label"><?=$this->lang->line('label_confirm_password')?><span class="red-star">*</span></label>
                                            </div>
                                            <div class="input-wrap pasword-input img-right-border">
                                                <input type="password" id="con_pass" class="form-control" name="con_pass" placeholder="Ex: 123456abc" required="" data-parsley-required-message="Confirm password is required." data-parsley-equalto="#password1" data-parsley-equalto-message="Confirm Password is not matching with New password.">
                                                <?= file_get_contents_curl("assets/frontend/img/input-lock.svg"); ?>
                                            </div>
                                        </div>
                                        <div class="form-group edit-btn">
                                            <div class="label-btn-wrap label-wrap"> </div>
                                            <div class="input-wrap">
                                                <button type="submit" class="btn white-btn"><?=$this->lang->line('button_update')?></button>
                                            </div>
                                        </div>
                                    </form>
                                
                                </div>
                                <div class="info-wrap">
                                    <div class="user-common-heading">
                                        <h2>Support</h2>
                                    </div>                                      
                                        <div class="group-name">
                                            Please contact us for questions or if you would like to submit a suggestion for future content. We'll do our best to respond to you as soon as possible.
                                        </div>
                                    <div class="info-content">
                                        <a href="#" target="_blank">Click here </a> to Contact Us
                                    </div>                                  
                                </div>
                            </div>                      
                        </div>
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
    </div>
</section>
<script type="text/javascript" >
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $("#name").keypress(function () {
            var _val = $(this).val();
            var _txt = _val.charAt(0).toUpperCase() + _val.slice(1);
            $(this).val(_txt);
        })

        $("#university_name").keypress(function () {
            var _val = $(this).val();
            var _txt = _val.charAt(0).toUpperCase() + _val.slice(1);
            $(this).val(_txt);
        })
    });
    //Start submit form of profile
    $( "#profileForm" ).submit(function( event ) {
        if($(this).parsley().isValid()){
            var POSTURL = $(this).attr('action');
            $(".main-loader").removeClass('dn');
            $.ajax({
                type: 'POST',
                url: POSTURL,
                data: new FormData($(this)[0]),
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                success: function (output) {
                    $(".main-loader").addClass('dn');
                    if(output.status == 'success') {
                        $(".headerUserName").html(output.name);
                    }
                    toasterMessage(output.status, output.message);
                },
                error: function (error) {
                    $(".main-loader").addClass('dn');
                    toasterMessage('error', 'Something went wrong, please try again.');
                }
            });
            event.preventDefault();
        }
    });
    //End submit form of profile
    
    $( "#passwordForm" ).submit(function( event ) {
        if($(this).parsley().isValid()){
            var POSTURL = $(this).attr('action');
            $(".main-loader").removeClass('dn');
            $.ajax({
                type: 'POST',
                url: POSTURL,
                data: new FormData($(this)[0]),
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                success: function (output) {
                    $(".main-loader").addClass('dn');
                    if(output.status == 'success') {
                        $("#passwordForm").trigger('reset');
                    }
                    toasterMessage(output.status, output.message);
                },
                error: function (error) {
                    $(".main-loader").addClass('dn');
                    toasterMessage('error', 'Something went wrong, please try again.');
                }
            });
            event.preventDefault();
        }
    });
    //End submit form of change password
</script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script type="text/javascript">
    $("#contact").inputmask("999-999-9999",{
        placeholder: "___-___-____"
    });
    $(".date-mask").inputmask("mm/dd/yyyy",{ 'placeholder': 'MM/DD/YYYY', "onincomplete": function(){
        // alert('inputmask complete');
        // $(this).val('');
    } });
</script>
<style type="text/css">    
    body{
        background: #efefef;
    }
</style>
<?= $topbar; ?>
<section class="body-wrap">
    <div class="dashboars-wrap profile-page">
        <div class="page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="custom-bredcrum">
                        <ul>
                            <li><a href="<?= base_url(); ?>"><?=$this->lang->line('heading_home')?></a></li>
                            <li><b><?=$this->lang->line('heading_contact_us')?></b></li>
                        </ul>
                    </div>

                    <div class="row profile-form-wrap">
                        <div class="col-sm-12 ">
                            <div class="basic-info-wrap">
                                <div class="user-common-heading">
                                    <h2><span class="highlighter">Contact</span> Us</h2>
                                </div>
                                
                                    <form data-parsley-validate class="form-horizontal" id="contactForm" role="form" method="POST" action="<?= base_url("pages/contact_us"); ?>">
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="name" class ="control-label">Name<span class="red-star">*</span></label>
                                                </div>
                                                <div class="input-wrap name-input img-right-border">
                                                    <input type="text" id="name" name="name" class="form-control" id="name" placeholder="Ex: John Doe" value="" required="" data-parsley-required-message="name is required." maxlength="50">
                                                    <?= file_get_contents_curl("assets/frontend/img/user-login.svg"); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="email" class ="control-label">Email<span class="red-star">*</span></label>
                                                </div>
                                                <div class="input-wrap img-right-border">
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Ex: johndoe@gmail.com" value="" required="" data-parsley-required-message="Email address is required." data-parsley-type-message="Invalid email address." maxlength="100">
                                                    <?= file_get_contents_curl("assets/frontend/img/close-envelope.svg"); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="email" class ="control-label">Contact Number</label>
                                                </div>
                                                <div class="input-wrap img-right-border">
                                                    <input type="text" name="contact" class="form-control contact" placeholder="Contact Number" data-parsley-minlength="10" maxlength="15" data-parsley-minlength-message="Contact number should be minimum 10 digits." value="" onkeypress="return isNumber(event)">
                                                    <?= file_get_contents_curl("assets/frontend/img/phone.svg"); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="name" class ="control-label">Subject<span class="red-star">*</span></label>
                                                </div>
                                                <div class="input-wrap name-input">
                                                    <select class="form-control" required="" data-parsley-required-message="Subject is required." name="subject">
                                                    <option value="">Select subject</option>
                                                    <?php foreach (support_subject() as $key => $row) { ?>
                                                       <option value="<?=$key?>"><?=$row?></option>
                                                   <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="name" class ="control-label">Message</label>
                                                </div>
                                                <div class="input-wrap name-input ">
                                                    <textarea type="text" name="message" class="form-control date-mask" rows="5" placeholder="Type message ..." required="" value="" data-parsley-maxlength="250" data-parsley-maxlength-message="Message should be maximum 250 character in length."data-parsley-required-message="Message is required." ></textarea>
                                
                                                </div>
                                            </div>
                                            <div class="form-group edit-btn ">
                                                <div class="label-btn-wrap label-wrap"> </div>
                                                <div class="input-wrap">
                                                    <button type="submit" class="btn white-btn">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
    </div>
</section>

<script>
    $("body").on('submit', '#contactForm', function( event ) {
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
                        $('#contactForm').trigger('reset');
                    }
                    toasterMessage(output.status, output.message);
                },
                error: function (error) {
                    $('.main-loader').addClass('dn');
                    toasterMessage('error', '<?= AJAX_ERROR_MESSAGE; ?>');
                }
            });
            event.preventDefault();
        }
    });
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
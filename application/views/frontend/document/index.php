<?= $topbar; ?>
<section class="body-wrap">
    <div class="dashboars-wrap profile-page">
        <div class="page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="custom-bredcrum">
                        <ul>
                            <li><a href="<?= base_url(); ?>"><?=$this->lang->line('heading_home')?></a></li>
                            <li><b><?='Upload Image'//$this->lang->line('heading_my_profile')?></b></li>
                        </ul>
                    </div>
                    <div class="row profile-form-wrap">
                        <div class="col-sm-12">
                            <div class="basic-info-wrap">
                                <div class="user-common-heading">
                                    <h2><span class="highlighter">Upload</span> Image</h2>
                                </div>
                                <div class="basic-info-content">
                                    <div class="basic-info-form">
                                        <form action="<?php echo base_url('pages/upload_documents'); ?>" class="question_upload" method="post" data-parsley-validate enctype="multipart/form-data" id="uploadFile">
                                        <div class="row">
                                            <div class="col-sm-12">    
                                            
                                                <div class="label-wrap">
                                                    <label for="file" class="control-label">Image<span class="red-star">*</span></label>
                                                </div>
                                                <div class="input-wrap name-input img-right-border">
                                                    <input type="file" class="form-control" id="file"  name="file" required="" accept="image/*" data-required-message="File is required."> 
                                                        <small class="text-success">File type should be .gif, .jpg, .jpeg, .png</small><br>

                                                </div>

                                                <div class="form-check-inline">
                                                  <label class="form-check-label">
                                                    <input type="checkbox" name="resize" class="form-check-input" value="1"> Image Resize
                                                  </label>
                                                </div>
                                                <div class="form-check-inline">
                                                  <label class="form-check-label">
                                                    <input type="checkbox" name ="thumbnail" class="form-check-input" value="1"> Create Thumnails
                                                  </label>
                                                </div>

                                                <div class="upload-download-btn-wrap">
                                                    <div class="upload-download-btn">
                                                        <input type="submit" class="btn btn-primary" value="Upload">
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="basic-info-form">
                                        <pre id="json"></pre>
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
<script>
    $( "#uploadFile" ).submit(function( event ) {
        if($(this).parsley().isValid()){
            var POSTURL = $(this).attr('action');
            $.ajax({
                type: 'POST',
                url: POSTURL,
                data: new FormData($(this)[0]),
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                beforeSend: function () {
                    $('.loader-wrap').removeClass('dn');
                },
                complete: function () {
                    $('.loader-wrap').addClass('dn');
                },
                success: function (output) {
                    if(output.status == 'success') {
                        $("#uploadFile")[0].reset();
                    }
                    toasterMessage(output.status, output.message);
                },
                error: function (error) {
                   $('.loader-wrap').addClass('dn');
                }
            });
        } 
        event.preventDefault();
    });
</script>
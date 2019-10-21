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
                                    <h2><span class="highlighter">One Time</span> Payment</h2>
                                </div>
                                <div class="basic-info-content">
                                    <div class="basic-info-form">
                                        <form id="paymentForm" data-parsley-validate>
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="name" class="control-label">Card Number<span class="red-star">*</span></label>
                                                </div>
                                                <div class="input-wrap name-input img-right-border">
                                                    <input class="form-control" name="card_number" required="" placeholder="Card number" type="text" id="cardNumber" data-parsley-pattern="^[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}$" data-parsley-pattern-message="Please enter valid card number." data-parsley-required-message="Please enter valid card number.">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="email" class="control-label">Expiry Date<span class="red-star">*</span></label>
                                                </div>
                                                <div class="input-wrap img-right-border">
                                                    <input  class="form-control" name="month_year" required="" placeholder="MM / YYYY" type="text" id="monthYear" data-parsley-pattern="^[0-9]{2}/[0-9]{4}$" data-parsley-pattern-message="Please enter valid expiry." data-parsley-required-message="Please enter valid expiry.">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="label-wrap">
                                                    <label for="email" class="control-label">CVV</label>
                                                </div>
                                                <div class="input-wrap img-right-border">
                                                    <input class="form-control" id="cvvCode" maxlength="4" name="cvv" required="" placeholder="CVV" type="text" data-parsley-pattern="^[0-9]{3}$" data-parsley-pattern-message="Please enter valid 3 digit cvv." data-parsley-required-message="Please enter valid 3 digit cvv.">
                                                </div>
                                                <input type="hidden" name="stripeToken" id="stripeToken">
                                                <input type="hidden" name="amount" id="amount">
                                            </div>
                                            <div class="form-group edit-btn ">
                                                <div class="label-btn-wrap label-wrap"> </div>
                                                <div class="input-wrap">
                                                    <button type="submit" class="btn white-btn">Pay</button>
                                                    <a href="<?= base_url('stripe'); ?>" class="btn white-btn pull-right">Back</a>
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
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script type="text/javascript">
    $('#cardNumber').inputmask("9999 9999 9999 9999");
    $("#monthYear").inputmask("mm/yyyy",{ 'placeholder': 'MM/YYYY' });
    $('#cvvCode').inputmask("999");
</script>
<script type="text/javascript">
    Stripe.setPublishableKey('pk_test_YhMZ1HkUCp39igUJEm3L00ZN');
    $( "#paymentForm" ).submit(function( event ) {
        if($(this).parsley().isValid()){
            monthYear = $('#monthYear').val();
            var expiryArr = monthYear.split('/');
            Stripe.createToken({
                number: $('#cardNumber').val(),
                cvc: $('#cvvCode').val(),
                exp_month: expiryArr[0],
                exp_year: expiryArr[1]
            }, function(status, response) {
                $(".main-loader").hide();
                if (response.error) {
                    var messageErr = '<strong>Error : </strong>' + response.error.message;
                    toasterMessage('error', messageErr);
                    return false;
                } else {
                    var token = response['id'];
                    $('#stripeToken').val(token);
                    $('#amount').val('1');
                    pay();
                    // $(".main-loader").hide();
                }
            });
            event.preventDefault();
        }      

    });

    function pay() {
        $(".main-loader").show();
        var form_data = $("#paymentForm").serialize();
        $.ajax({
            url: BASE_URL+'stripe/pay',
            type: 'POST',
            data: form_data,
            dataType: "json",
            success: function(data) {
                // console.log(data);
                toasterMessage(data.status, data.message);
                document.getElementById("json").innerHTML = JSON.stringify(data.txnData, undefined, 2);
                $(".main-loader").hide();
            },
            error: function() {
                toasterMessage('error', 'Something went wrong. Please try again later.');
                $(".main-loader").hide();
                return false;
            }
        });

    }
</script>
<style type="text/css">    
    body{
        background: #efefef;
    }
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*Check which host has been called*/
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

define('PAYPAL_USERNAME', 'anjali.chapter247123_api1.gmail.com');
define('PAYPAL_PASSWORD', 'B4J9ZZQW9AE8VKKR');
define('PAYPAL_SIGNATURE', 'APV93brfMdBDSeBsk.5vqTFN0lx8AUhsNOIoLnsOURbamq4uLR.QEVo-');
define('PAYPAL_URL', 'https://api-3t.sandbox.paypal.com/nvp'); // For live transactions, change to 'https://api-3t.paypal.com/nvp' For sandbox 'https://api-3t.sandbox.paypal.com/nvp'	

define('STRIPE_KEY',"sk_test_nCP8oGymCfdkTZLqDpBpiPYG");
define('PUBLISH_KEY','pk_test_YhMZ1HkUCp39igUJEm3L00ZN');
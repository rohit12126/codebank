<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*Check which host has been called*/
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

define('PAYPAL_USERNAME', '');
define('PAYPAL_PASSWORD', '');
define('PAYPAL_SIGNATURE', '');
define('PAYPAL_URL', 'https://api-3t.paypal.com/nvp'); // For live transactions, change to 'https://api-3t.paypal.com/nvp' For sandbox 'https://api-3t.sandbox.paypal.com/nvp'	
define('STRIPE_KEY',"");
define('PUBLISH_KEY',"");
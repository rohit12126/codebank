<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
// Paypal library configuration
// ------------------------------------------------------------------------
// PayPal environment, Sandbox or Live
if($_SERVER['HTTP_HOST'] == '192.168.2.137' || $_SERVER['HTTP_HOST'] == 'localhost') {
	$config['sandbox'] = TRUE; // FALSE for live environment
}
else {
	$config['sandbox'] = FALSE; // FALSE for live environment
}
// PayPal business email
if($config['sandbox']) {
	$config['business'] = 'anjali.chapter247123@gmail.com';
	//client_id and client_secret use from paypal defaul account. 
	$config['client_id'] = 'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS';
	$config['client_secret'] = 'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL';
}
else {
	$config['business'] = '';
	$config['client_id'] = '';
	$config['client_secret'] = '';	
	//live
}
// What is the default currency?
$config['paypal_lib_currency_code'] = 'USD';
// Where is the button located at?
$config['paypal_lib_button_path'] = 'assets/images/';
// If (and where) to log ipn response in a file
$config['paypal_lib_ipn_log'] = TRUE;
$config['paypal_lib_ipn_log_file'] = BASEPATH . 'logs/paypal_ipn.log';
$config['paypal_url'] = ($config['sandbox'] == TRUE)?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
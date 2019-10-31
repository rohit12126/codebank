<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paypal {
	protected $CI; // codeigniter object

	private $ClientID; // ClientID

	private $ClientSecret; // ClientSecret

    public function __construct($config = array()) {
    	$this->CI =& get_instance();
        require_once APPPATH.'third_party/PayPal-PHP-SDK/autoload.php';
        $this->ClientID = $config['client_id'];
        $this->ClientSecret = $config['client_secret'];
    }
    /* Initialize api ClientID and ClientSecret*/
    public function apiContext() {
        return $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->ClientID,     // ClientID
                $this->ClientSecret  // ClientSecret
            )
        );
    }
}
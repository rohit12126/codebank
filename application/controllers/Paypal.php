<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        // Load paypal library & product model
        $this->load->library('paypal_lib');
        $this->load->config('paypal');
    }

    private function _check_login(){
        if(user_logged_in()===FALSE){
            redirect(base_url());
        }
    }

    public function index() {
        $this->_check_login();
        $data['title'] = 'PayPal';
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['template'] = 'frontend/paypal/index';
        $this->load->view('template/frontend/template',$data);
    }

    public function subscribe($id = null) {
    	$this->_check_login();
        $userID = user_id();
        $returnURL = base_url().'paypal/success';//Success url
        $cancelURL = base_url().'paypal/cancel';//cancel  url
        $notifyURL = base_url().'paypal/ipn';
        $data['return'] = $returnURL;
        $data['cancel_return'] = $cancelURL;
        $data['notify_url'] = $notifyURL;
        //Item details
        $data['item_name'] = 'Monthly';
        $data['custom'] = $userID;
        $data['item_number'] = $id;
        $data['no_shipping'] = '1';
        // $data['amount'] = $product['price'];
        //Start Subscription details
        // $data['srt'] = '3'; //Recurring times.
        $data['a3'] = 10; //Regular subscription price.
        $data['p3'] = '1'; //Subscription duration
        $data['t3'] = 'M'; //D M W Y
        $data['src'] = '1'; //Recurring payments
        $data['currency_code'] = 'EUR';     //USD
        $data['cmd'] = '_xclick-subscriptions';
        //end Subscription details
        $data['business'] = $this->config->item('business');
        $queryString = http_build_query($data);
        $paypalUrl = $this->config->item('paypal_url');
        // Redirect to paypal IPN
        header('location:' . $paypalUrl . '?' . $queryString);
    }
     
    public function success($txn_id = ''){
        // Get the transaction data
        $user_id = user_id();
        $paypalInfo = $this->input->get();
        $created = date('Y-m-d H:i:s');
        if($paypalInfo) {
            $this->crud->createData('paypal_temp_data', array('data' => json_encode($paypalInfo), 'created' => $created));
            $check_transaction = $this->crud->readData('txn_id', 'transaction', array('txn_id' => $paypalInfo['tx']))->row_array();
            if(!$check_transaction) {
                    $transaction = array(
                        'user_id'           => $user_id,
                        'transaction_type'  => 1,
                        'amount'            => $paypalInfo['amt'],
                        'status'            => $paypalInfo['st'],
                        'transaction_details'=> json_encode($paypalInfo),
                        'txn_id'            => $paypalInfo['tx'],
                        'transaction_date'  => $created
                    );
                    $transactionid = $this->crud->createData('transaction', $transaction);
                    if(!empty($transactionid)){
                        $parent_info=$this->crud->readData('name,email', 'users', array('user_id' => $user_id))->row_array();
                        $email_data = array(
                            'name'  => $parent_info['name'],
                            'child_name' =>'',                  
                            'site_name' => SITE_NAME
                        );
                        $param = array(
                            'template_id' => '21',
                            'data' => $email_data,
                        );
                        sendEmail($parent_info['email'], $param);
                    }
            }
            redirect("paypal/success/$paypalInfo[tx]");
        } else {
            $purchase_history = $this->crud->readData('transaction.*, users.email', 'transaction', array('txn_id' => $txn_id), array('users' => 'transaction.user_id = users.user_id'))->row();
            if(empty($purchase_history))
                redirect(base_url());
            $data['result'] = $purchase_history;
            $data['title'] = 'Payment Success';
            $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
            $data['template']='frontend/paypal/success';
            $this->load->view('template/frontend/template',$data);
        }
    }
    // Load payment failed view
    public function cancel(){
        $data['title'] = 'Payment Cancel';
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['template']='frontend/paypal/cancel';
        $this->load->view('template/frontend/template',$data);
    }
     
    public function ipn(){
        $paypalInfo = $_REQUEST;
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $created = date('Y-m-d H:i:s');
        if(!empty($paypalInfo)){
             $this->crud->createData('paypal_temp_data', array('data' => json_encode($paypalInfo), 'created' => $created));
            // Validate and get the ipn response
            $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

            // Check whether the transaction is valid
            if($ipnCheck){
                // Insert the transaction data in the database
                $txn_type = $paypalInfo['txn_type'];
                if($txn_type == 'subscr_signup') {
                    $subscr_id = $paypalInfo['subscr_id'];
                    $user_id = $paypalInfo["custom"];
                    $check = $this->crud->readData('txn_id', 'user_plan', array('user_id' => $user_id, 'subscription_id' => ''))->row_array();
                    if($check) {
                        $this->crud->updateData('user_plan', array('subscription_id' => $subscr_id), array('user_id' => $user_id));
                        $update_txn = array(
                            // 'status' => $paypalInfo["payment_status"],
                            'transaction_details' => json_encode($paypalInfo),
                            'subscription_id' => $paypalInfo['subscr_id'],
                        );
                        $this->crud->updateData('transaction', $update_txn, array('txn_id' => $check['txn_id']));
                    }

                }
                if($txn_type == 'subscr_payment') {
                    $txn_id = $paypalInfo["txn_id"];
                    $subscr_id = $paypalInfo['subscr_id'];
                    $transaction = $this->crud->readData('*', 'transaction', array('subscription_id' => $subscr_id))->row_array();
                    $check_transaction = $this->crud->readData('txn_id, user_id', 'transaction', array('txn_id' => $txn_id))->row_array();
                    if(!$check_transaction) {
                        $insert_txn = array(
                            'user_id' => $transaction['user_id'],
                            'membership_id' => $transaction['membership_id'],
                            'transaction_type' => 1,
                            'amount' => $transaction['amount'],
                            'status' => $paypalInfo["payment_status"],
                            'transaction_details' => json_encode($paypalInfo),
                            'user_plan_details' => $transaction['user_plan_details'],
                            'txn_id' => $txn_id,
                            'subscription_id' => $subscr_id,
                            'transaction_date' => $created,
                        );
                        $this->crud->createData('transaction', $insert_txn);
                        $plan = $this->crud->readData('*', 'membership', array('membership_id' => $transaction['membership_id']))->row_array();
                        $end_date = $created;
                        if($plan['period'] == 'M')
                            $end_date = date('Y-m-d H:i:s', strtotime($created . ' +1 month'));
                        if($plan['period'] == 'Y')
                            $end_date = date('Y-m-d H:i:s', strtotime($created . ' +1 year'));

                        $update_plan = array(
                            'membership_expiry_date' => $end_date,
                            'txn_id' => $txn_id,
                        );
                        $this->crud->updateData('user_plan', $update_plan, array('subscription_id' => $subscr_id));
                        $user = $this->crud->readData('*', 'users', array('user_id' => $check_transaction['user_id']))->row_array();
                        //Start Send email
                        $my_membership =($plan['membership_type']==1)?"Monthly ":"Yearly ";
                        $my_membership .=($plan['user_access']==0)?"(Single User)":"(Multi User)";
                        $email_data = array(
                            'plan_name'  => $my_membership,
                            'txn_id' => $txn_id,
                            'amt' => $transaction['amount'],
                            'amt_status' => $paypalInfo["payment_status"],
                            'user_name' => $user['name']
                        );
                        $param = array(
                            'template_id' => '22',
                            'data' => $email_data,
                        );
                        sendEmail($user['email'], $param);
                        //End Send email
                    }
                }
                if($txn_type == 'subscr_cancel') {
                    $subscr_id = $paypalInfo['subscr_id'];
                    $this->crud->updateData('user_plan', array('status' => 2, 'membership_cancelled_date' => $created), array('subscription_id' => $subscr_id));
                    $this->crud->updateData('transaction', array('cancelled_date' => $created), array('subscription_id' => $subscr_id));
                }
                if($txn_type == 'recurring_payment_suspended') {
                    $subscr_id = $paypalInfo['recurring_payment_id'];
                    $this->crud->updateData('user_plan', array('status' => 2, 'membership_cancelled_date' => $created), array('subscription_id' => $subscr_id));
                    $this->crud->updateData('transaction', array('cancelled_date' => $created), array('subscription_id' => $subscr_id));
                }
            }
        }
        // echo "<pre>"; print_r($paypalInfo); die();
    }

    public function get_transaction_details( $transaction_id ) {
        $api_request = 'USER=' . urlencode( PAYPAL_USERNAME )
            .  '&PWD=' . urlencode( PAYPAL_PASSWORD )
            .  '&SIGNATURE=' . urlencode( PAYPAL_SIGNATURE )
            .  '&VERSION=76.0'
            .  '&METHOD=GetTransactionDetails'
            .  '&TransactionID=' . $transaction_id;
 
        $ch = curl_init();
        // print_r($api_request); die();
        curl_setopt( $ch, CURLOPT_URL, PAYPAL_URL ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
        curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
        // Uncomment these to turn off server and peer verification
        // curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        // curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        // Set the API parameters for this transaction
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );
        // Request response from PayPal
        $response = curl_exec( $ch );
        // print_r($response);
        // If no response was received from PayPal there is no point parsing the response
        if( ! $response )
            die( 'Calling PayPal to change_subscription_status failed: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')' );
     
        curl_close( $ch );
        // An associative array is more usable than a parameter string
        parse_str( $response, $parsed_response );
        return $parsed_response;
    }

    public function change_subscription_status( $profile_id, $action ) {
        $api_request = 'USER=' . urlencode( PAYPAL_USERNAME )
            .  '&PWD=' . urlencode( PAYPAL_PASSWORD )
            .  '&SIGNATURE=' . urlencode( PAYPAL_SIGNATURE )
            .  '&VERSION=76.0'
            .  '&METHOD=ManageRecurringPaymentsProfileStatus'
            .  '&PROFILEID=' . urlencode( $profile_id )
            .  '&ACTION=' . urlencode( $action )
            .  '&NOTE=' . urlencode( 'Profile cancelled at store' );
     
        $ch = curl_init();
        // print_r($api_request); die();
        curl_setopt( $ch, CURLOPT_URL, PAYPAL_URL ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
        curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
        // Uncomment these to turn off server and peer verification
        // curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        // curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
     
        // Set the API parameters for this transaction
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );
     
        // Request response from PayPal
        $response = curl_exec( $ch );
        // print_r($response);
     
        // If no response was received from PayPal there is no point parsing the response
        if( ! $response )
            die( 'Calling PayPal to change_subscription_status failed: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')' );
     
        curl_close( $ch );
     
        // An associative array is more usable than a parameter string
        parse_str( $response, $parsed_response );
     
        return $parsed_response;
    }

    public function cancel_subscription_plan() {
        $this->_check_login();
        $user_id = user_id();
        $current_plan = $this->crud->current_plan($user_id);
        $response = $this->change_subscription_status( $current_plan->subscription_id, 'Cancel' );
        // $response = $this->change_subscription_status( 'I-V8CF5PJ9L3YE', 'Cancel' );
        if($response['ACK'] == 'Success') {
            $this->crud->updateData('purchase_history', array('subscription_status' => 'Cancel'), array('subscription_id' => $current_plan->subscription_id));
            $res = array(
                'status' => true,
                'message' => 'Subscription successfully cancelled'
            );
        }
        else if($response['ACK'] == 'Failure') {
            $res = array(
                'status' => false,
                'message' => $response['L_LONGMESSAGE0']
            );
        }
        else {
            $res = array(
                'status' => false,
                'message' => "Something went wrong, try again"
            );
        }
        echo json_encode($res);
    }

    public function test() {
        $response = $this->get_transaction_details('46V17402WT791764A'); // 3PW55399RB761081X
        if($response) {
            if($response['ACK'] == 'Success') {
                echo $response['SUBSCRIPTIONID'];
            }
            if($response['ACK'] == 'Failure') {
                echo $response['L_LONGMESSAGE0'];
            }
        }
        echo "<pre>"; print_r($response);   
    }

}
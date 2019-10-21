<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stripe extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
    }

    private function _check_login(){
        if(user_logged_in()===FALSE){
            redirect(base_url());
        }
    }

    public function index() {
        $this->_check_login();
        $user_id = user_id();
        $data['user'] = $this->crud->readData('user_id, name, contact, email, date_of_birth', 'users', array('user_id' => $user_id))->row_array();
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['title'] = 'Stripe';
        $data['template'] = 'frontend/stripe/index';
        $this->load->view('template/frontend/template',$data);
    }
    /*One time payment by user*/
    public function one_time() {
        $user_id = user_id();
        $data['user'] = $this->crud->readData('user_id, name, contact, email, date_of_birth', 'users', array('user_id' => $user_id))->row_array();
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['title'] = 'Stripe';
        $data['template'] = 'frontend/stripe/one_time';
        $this->load->view('template/frontend/template',$data);
    }

    public function pay() {
        // Stripe API secret key
        $secret_key = STRIPE_KEY;
        $response = array();
        // Check whether stripe token is not empty
        if(!empty($_POST['stripeToken'])){
            
            // Get token, card and item info
            $token  = $_POST['stripeToken'];
            $email  = 'chandu@gmail.com';       //Change customer mail ID
            $amount = $_POST['amount'];
            $currency = 'usd';                  //Change currency
            
            // Include Stripe PHP library
            require_once(APPPATH."third_party/stripe/init.php");
            
            // Set api key
            \Stripe\Stripe::setApiKey($secret_key);
            
            // Add customer to stripe
            $customer = \Stripe\Customer::create(array(
                'email' => $email,
                'source'  => $token
            ));
            
            // Charge a credit or a debit card
            $charge = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount'   => $amount * 100,
                'currency' => $currency,
            ));
            
            // Retrieve charge details
            $chargeJson = $charge->jsonSerialize();

            // Check whether the charge is successful
            if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){
                
                // Start Save Order in DB
                // End Save Order in DB
                $response = array(
                    'status' => 'success',
                    'message' => 'Your payment was successful.',
                    'txnData' => $chargeJson
                );
                
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'Transaction has been failed.'
                );
            }
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Form submission error...'
            );
        }

        // Return response
        echo json_encode($response);
    }
    /*Recurring payment by user*/
    public function recurring() {
        $user_id = user_id();
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['title'] = 'Recurring';
        $data['template'] = 'frontend/stripe/recurring';
        $this->load->view('template/frontend/template',$data);
    }

    public function payment_process_stripe(){
        $stripeToken = $this->input->post('stripeToken');

        if ($stripeToken == '') {
            echo json_encode(array('status' => 'error', 'message' => 'Unable to get stripe token'));
            die;
        }

        try{
            require_once(APPPATH."third_party/stripe/init.php");
            \Stripe\Stripe::setApiKey(STRIPE_KEY);
                
            //Start create customer on stripe if this user is not exist on it otherwise get stripe customer ID from DB
            // creating customer
            $customerData = \Stripe\Customer::create(array(
                'description' => 'New user',
                'email' => 'chandu@gmail.com',
                'source'  => $stripeToken
            ));
            
            $custData = $customerData->__toArray();
            $secretKey = $custData['id'];
            //End create customer on stripe if this user is not exist on it otherwise get stripe customer ID from DB


            //Start create plan on stripe if this plan is not exist on it otherwise get stripe plan ID from DB
            $planDetails = \Stripe\Plan::create([
                "amount" => 1*100,              //Currency*100
                "interval" => "day",
                'interval_count'=> 1,
                "product" => [
                    "name" => "Custom Customer Plan"
                ],
                "currency" => "usd",
                "id" => "custom-customer-plan"
            ]);

            $stripeId = $planDetails->id;
            //End create plan on stripe if this plan is not exist on it otherwise get stripe plan ID from DB
            

            $data = \Stripe\Subscription::create(array(
                "customer" => $secretKey,
                "items" => array(
                    array(
                        "plan" => $stripeId
                    ),
                )
            ));

            $chargeJson = $data->jsonSerialize();
            // $subscriptionData   = $data->__toArray();

            /*//Start Send email
            $email_data = array(
                'name'  => $secretCustId->name,
                'plan_name'  => $my_membership,
                'txn_id' => $subscriptionData['id'],
                'amt' => $getPlanIdDB[0]->price,
                'amt_status' => "Completed"
            );
            $param = array(
                'template_id' => '22',
                'data' => $email_data,
            );
            sendEmail($user['email'], $param);
            //End Send email*/
        
            echo json_encode(array('status' => 'success', 'message' => 'Congratulation! You have purchasing a plan successfully.', 'txnData' => $chargeJson));
            // echo 1;
        } catch (Exception $e) {
            /*echo "<pre>";
            print_r($e);*/
            echo json_encode(array('status' => 'error', 'message' => 'Unable to subscribe for plan.'));
            // echo 3;      
        }
    }
}
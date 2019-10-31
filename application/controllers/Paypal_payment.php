<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payee;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
class Paypal_payment extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        // Load paypal config 
        $this->config->load('paypal'); 
        // Load paypal library
        $this->load->library('paypal', 
                        $param = array(
                            'client_id'=>$this->config->item('client_id'),
                            'client_secret'=>$this->config->item('client_secret')
                        )
                    );
    }

    public function index() {
        // Initialize paypal settings
        $apiContext = $this->paypal->apiContext();

        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal('21.00'); //Total amount
        $amount->setCurrency('USD'); //currency

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        $redirect_url = base_url().'paypal_payment/success'; //redirect url
        $cancel_url = base_url().'paypal_payment/cancel';   // cancel url
        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl($redirect_url)
            ->setCancelUrl($cancel_url);

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        // 4. Make a Create Call
        try {
            $payment->create($apiContext);
            // Redirect to paypal page.
            redirect($payment->getApprovalLink());
            //echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
        }
        catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            //echo $ex->getData();
            //p($ex->getData());
            $this->session->flashdata('msg_error', 'Something went wrong, Please try again later.');
        }
    }

    public function cancel() {
        $data['title'] = 'Payment Cancel';
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['template']='frontend/paypal/cancel';
        $this->load->view('template/frontend/template',$data);
    }
    
    public function success() {
        $paymentId = $this->input->get('paymentId');
        $token = $this->input->get('token');
        $PayerID = $this->input->get('PayerID');
        if(!empty($paymentId)&&!empty($PayerID)) {

            $apiContext = $this->paypal->apiContext();
            $payment = Payment::get($paymentId, $apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($PayerID);

            $details = new Details();
            $details->setShipping(2.2)
                ->setTax(1.3)
                ->setSubtotal(17.50);

            $amount = new Amount();
            $amount->setCurrency('USD');
            $amount->setTotal(21);
            $amount->setDetails($details);

            $transaction = new Transaction();
            $transaction->setAmount($amount);
            $execution->addTransaction($transaction);

        try {
                $result = $payment->execute($execution, $apiContext);
                if ($result->getState() == 'approved') {
                    $trans = $result->getTransactions();
                    // item info
                    $Subtotal = $trans[0]->getAmount()->getDetails()->getSubtotal();
                    $Tax = $trans[0]->getAmount()->getDetails()->getTax();

                    $payer = $result->getPayer();
                    // payer info //
                    $PaymentMethod =$payer->getPaymentMethod();
                    $PayerStatus =$payer->getStatus();
                    $PayerMail =$payer->getPayerInfo()->getEmail();

                    $relatedResources = $trans[0]->getRelatedResources();
                    $sale = $relatedResources[0]->getSale();

                    // sale info //
                    $saleId = $sale->getId();
                    $CreateTime = $sale->getCreateTime();
                    $UpdateTime = $sale->getUpdateTime();
                    $State = $sale->getState();
                    $Total = $sale->getAmount()->getTotal();

                    $paymentDetails = array(
                        'payment_id' => $paymentId,
                        'subtotal'=> $Subtotal,
                        'tax'=> $Tax,
                        'payment_method'=> $PaymentMethod,
                        'payer_status'=> $PayerStatus,
                        'payer_mail'=> $PayerMail,
                        'sale_id'=> $saleId,
                        'create_time'=> $CreateTime,
                        'update_time'=> $UpdateTime,
                        'state'=> $State,
                        'total'=> $Total,
                    );
                    $this->crud->createData('paypal_temp_data', array('data' => json_encode($paymentDetails), 'created' => $CreateTime));
                    //p($paymentDetails); die;
                }
            } catch (Exception $ex) {
                $this->session->flashdata('msg_error', 'Something went wrong, Please try again later.');
                //ResultPrinter::printError("Executed Payment", "Payment", null, null, $ex);
                //exit(1);
            }
        }

        $data['result'] = '';
        $data['txn_id'] = $paymentId?$paymentId:'';
        $data['title'] = 'Payment Success';
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['template']='frontend/paypal/success';
        $this->load->view('template/frontend/template',$data);
    }

    public function getPaymentDetails($paymentId = '') {
        try {
            //PAYID-LWXQP2Y8C153815GV101572M
            //$paymentId = 'PAYID-LWXOQGI31J986908Y3454728';
            $apiContext = $this->paypal->apiContext();
            $payment = Payment::get($paymentId, $apiContext);
           //p($payment);
            if ($payment->getState() == 'approved') {
                $trans = $payment->getTransactions();
                // item info
                $Subtotal = $trans[0]->getAmount()->getDetails()->getSubtotal();
                $Tax = $trans[0]->getAmount()->getDetails()->getTax();

                $payer = $payment->getPayer();
                // payer info //
                $PaymentMethod =$payer->getPaymentMethod();
                $PayerStatus =$payer->getStatus();
                $PayerMail =$payer->getPayerInfo()->getEmail();

                $relatedResources = $trans[0]->getRelatedResources();
                $sale = $relatedResources[0]->getSale();

                // sale info //
                $saleId = $sale->getId();
                $CreateTime = $sale->getCreateTime();
                $UpdateTime = $sale->getUpdateTime();
                $State = $sale->getState();
                $Total = $sale->getAmount()->getTotal();

                $paymentDetails = array(
                    'payment_id' => $paymentId,
                    'subtotal'=> $Subtotal,
                    'tax'=> $Tax,
                    'payment_method'=> $PaymentMethod,
                    'payer_status'=> $PayerStatus,
                    'payer_mail'=> $PayerMail,
                    'sale_id'=> $saleId,
                    'create_time'=> $CreateTime,
                    'update_time'=> $UpdateTime,
                    'state'=> $State,
                    'total'=> $Total,
                );
                //p($paymentDetails); die;
                return $paymentDetails;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            $this->session->flashdata('msg_error', 'Something went wrong, Please try again later.');
            //ResultPrinter::printError("Get Payment", "Payment", null, null, $ex);
            //exit(1);
            return false;
        }
    }
}




<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

	public function __construct() {
      	parent:: __construct();
        if(user_logged_in()===FALSE)
        	redirect(base_url());
    }
    // List of support ticket
    public function index(){
        $user_id = user_id();
        $data['support'] = $this->crud->readData('support.*, ', 'support', array('user_id' => $user_id),array(),array(),"support_id desc")->result();
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['title'] = 'Support';
        $data['template'] = 'frontend/account/support/tickets';
        $this->load->view('template/frontend/template',$data);
    }
    // Generate new ticket for support and send message to admin.
    public function generate_ticket() {
    	$this->form_validation->set_rules('subject','subject','required');
        $this->form_validation->set_rules('comment','Comment','trim|required');
        if($this->form_validation->run() === TRUE){
        	$user_id = user_id();
        	$user = $this->crud->readData('users.*, ', 'users', array('user_id' => $user_id),array())->row();
        	$replies = array();
			$replies[] = ['You'=>[
			        'comment' =>  htmlentities($this->input->post('comment')),
			        'date' => date('Y-m-d h:i:s'),
			]];
			$data['user_id'] = $user->user_id;
        	$data['replies'] = json_encode($replies);
        	$data['subject'] = htmlentities($this->input->post('subject'));
        	$data['name']	 = ucwords($user->name);
        	$data['email']	 = $user->email;
        	$data['contact_number'] = $user->contact;
        	$data['status'] = 1;
        	$data['ticket_id'] = time();//strtoupper(substr(md5(uniqid(mt_rand(),true)),0,10));
        	if($support = $this->crud->createData('support', $data)) {
	        	echo json_encode(array('status' => 'success','data'=>$support, 'message' => "Support ticket has been created successfully."));        		
        	}
        	else {
	        	echo json_encode(array('status' => 'error', 'message' => "Something went wrong, Please try again later."));
        	}
        }
        else {
        	echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
    }
	// Get support chat content.
    public function get_support_chat() {
        $support_id = $this->input->post('support_id');
        $data['support'] = $this->crud->readData('support.*, ', 'support', array('support_id' => $support_id),array())->row();
        $this->load->view('frontend/account/support/ticket_chat', $data);
    }
    // Reply to admin by user for open ticket.
    public function reply() {
		$this->form_validation->set_rules('support_id','Support id','required');
        $this->form_validation->set_rules('comment','Comment','trim|required');
        if($this->form_validation->run() === TRUE){
        	$support_id = $this->input->post('support_id');
        	$support = $this->crud->readData('support.*, ', 'support', array('support_id' => $support_id, 'status'=>1),array())->row();
        	if(!$support) {
        		echo json_encode(array('status' => 'error', 'message' => "Something went wrong, Please try again later."));
        	}
        	$replies = json_decode($support->replies);
        	if(!empty($replies)) {
        		$last = key(array_slice($replies, -1, 1, true));
				$last++;
        	} else {
        		$last = 0;
        	}
			$replies[$last] = (object)['You'=>(object)[
			        'comment' =>  htmlentities($this->input->post('comment')),
			        'date' => date('Y-m-d h:i:s'),
			]];
        	$data['replies'] = json_encode($replies);
            $data['is_new'] = 0; //for new message.
        	if($this->crud->updateData('support', $data, array('support_id' => $support_id))) {
	        	echo json_encode(array('status' => 'success', 'message' => "Reply has been sent to User successfully."));        		
        	}
        	else {
	        	echo json_encode(array('status' => 'error', 'message' => "Something went wrong, Please try again later."));
        	}
        }
        else {
        	echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
    }
}

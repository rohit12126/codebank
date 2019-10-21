<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Superadmin extends CI_Controller {

	public function __construct() {
        parent:: __construct();
        // clear_cache();
        $this->load->library('encryption');
    }

	public function index(){
		redirect('behindthescreen');
	}
    // Check super admin loged in
	private function _check_login(){
		if(superadmin_logged_in()===FALSE)
			redirect(base_url().'behindthescreen');
	}
    // Super admin login
	public function login() {
        if(superadmin_logged_in()===TRUE) redirect(base_url('backend/dashboard'));
        $data['title'] = $this->lang->line('title_message_admin_login');
        $data['error_mail_msg'] = '';
        $data['error_pass_msg'] = '';
        $this->form_validation->set_rules('password','Password','trim|required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        if($this->form_validation->run() === TRUE){
        	$email = $this->input->post('email');
        	$password = $this->input->post('password');
            $check = $this->crud->readData('*', 'users', array('email' => $email, 'user_role' => 1))->row_array();
            if($check) {
                if($password == $this->encryption->decrypt($check['password'])) {
                    $user_data = array(
                        'user_id'       => $check['user_id'],
                        'user_role'     => $check['user_role'],
                        'email'         => $check['email'],
                        'user_name'     => $check['name'],
                        'logged_in'     => TRUE
                    ); 
                    $this->session->unset_userdata('superadmin_info'); 
                    $this->session->set_userdata('superadmin_info', $user_data);
                    $URL =  get_cookie('URL');
                    if($URL) {
                        delete_cookie('URL');
                        redirect(base_url($URL));
                    }
                    else {
                        redirect(base_url('backend/dashboard'));
                    }
                }
                else {
                    $data['error_pass_msg'] = $this->lang->line('error_login_password');
                }
            }
            else {
                $data['error_mail_msg'] = $this->lang->line('error_login_email');
            }
        }
        $this->load->view('backend/login', $data);
	}
    // Logout superadmin
    public function logout(){
        $this->_check_login(); //check  login authentication
        $this->session->sess_destroy();
        redirect(base_url().'behindthescreen');
    }
    // Super admin dashboard
    public function dashboard() {
        $this->_check_login(); //check login authentication
        $data['title'] = $this->lang->line('title_message_dashboard');
        $data['users'] = $this->crud->readData('user_type, created_on', 'users', array('user_role' => 0))->result();
        $graph = array();
        $graph[] = array('y' => 2, 'label' => ucfirst('Demo'));
        $graph[] = array('y' => 4, 'label' => ucfirst('Test'));
        $graph[] = array('y' => 3, 'label' => ucfirst('other'));
        $data['graph'] = $graph;
        $data['css'] = array('assets/backend/css/dashboard.css');
        $data['template'] = "backend/dashboard";
        $this->load->view('template/backend/superadmin_template',$data);
	}
    // Update profile of Super admin 
    public function profile() {
        $this->_check_login();
        $data['title']= $this->lang->line('title_message_account_details');
        if($this->input->post()) {
            // header('Content-Type: application/json');
            $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[20]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'max_length[20]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == TRUE)  {
                $name = $this->input->post('first_name');
                $email = $this->input->post('email');
                $last_name = $this->input->post('last_name');
                if($last_name)
                    $name = $name." ".$last_name;
                $user_data  = array(
                    'name'    =>  $name,
                    'email'   =>  $this->input->post('email'),
                );
                $check = $this->crud->readData('user_id, email', 'users', array('email' => $email))->row_array();
                $error = 0;
                if($check) {
                    if($check['user_id'] != superadmin_id()) {
                        $error = 1;
                    }
                }
                if($error) {
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_profile_email')));
                }
                else {
                    if($this->crud->updateData('users', $user_data,array('user_id'=>superadmin_id()))){
                        $details = superadmin_details();
                        $details['user_name'] = $user_data['name'];
                        $details['email'] = $user_data['email'];
                        $this->session->set_userdata('superadmin_info', $details);
                        echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_profile_update')));
                    }else{
                        echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_profile_update')));
                    }                    
                }
            }else{
                echo json_encode(array('status' => 'error', 'message' => validation_errors()));
            }
            exit;
        }
        $data['user'] = $this->crud->readData('*', 'users', array('user_id'=>superadmin_id()))->row_array();
        $data['template'] = 'backend/profile';
        $this->load->view('template/backend/superadmin_template',$data);
    }
    // Change password of superadmin
    public function change_password(){
        $this->load->library('encryption');
        $this->_check_login(); //check login authentication
        $user_id = superadmin_id();
        $data['title']= $this->lang->line('title_message_change_password');
        if($this->input->post()) {
            $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required');
            $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|matches[confpassword]');
            $this->form_validation->set_rules('confpassword','Confirm Password', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == TRUE){
                $old_password = $this->input->post('oldpassword');
                $password = $this->input->post('newpassword');
                $password = $this->encryption->encrypt($password);
                $check = $this->crud->readData('password', 'users', array('user_id' => $user_id, 'user_role' => 1))->row_array();
                if($old_password == $this->encryption->decrypt($check['password'])) {
                    if($this->crud->updateData('users', array('password' => $password), array('user_id' => $user_id, 'user_role' => 1))) {
                        echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_password_update')));
                    }
                    else {
                        echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
                    }
                }
                else {
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_old_password')));
                }
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => validation_errors()));
            }
            exit;
        }
        $data['template']='backend/change_password';
        $this->load->view('template/backend/superadmin_template',$data);
    }
}
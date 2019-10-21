<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
        parent:: __construct();
        if(user_logged_in()===FALSE) {
            set_cookie('URL', uri_string(), 3600);
            redirect(base_url());
        }
    }
    // User profile page
    public function index(){
        $user_id = user_id();
        $data['user'] = $this->crud->readData('user_id, name, contact, email, date_of_birth', 'users', array('user_id' => $user_id))->row_array();
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['title'] = 'My Profile';
        $data['template'] = 'frontend/account/profile';
        $this->load->view('template/frontend/template',$data);
    }
    // Update user profile.
    public function profile_change() {
        $user_id = user_id();
        if($this->form_validation->run('profile_change') === TRUE){
            $data = $this->input->post();
            if($data['date_of_birth']) {
                $data['date_of_birth'] = change_date_format($data['date_of_birth']);
            }
            $check = $this->crud->readData('user_id', 'users', array('email' => $data['email']))->row_array();
            $old_data = $this->crud->readData('email', 'users', array('user_id' => $user_id))->row_array();
            $error = '';
            if($check) {
                if($check['user_id'] != $user_id) {
                    $error = '1';
                }
            }
            $data = my_htmlentities($data);
            if(empty($error)) {
                if($old_data['email'] != $data['email']) {
                    //Start Send email
                    $email_data = array(
                        'name'  => htmlentities($data['name']),
                        'old_email' => $old_data['email'],
                        'new_email' => $data['email']
                    );
                    $param = array(
                        'template_id' => '23',
                        'data' => $email_data,
                    );
                    // sendEmail($old_data['email'], $param);
                    sendEmail($data['email'], $param);
                    //End Send email
                }
                if($this->crud->updateData('users', $data, array('user_id' => $user_id, 'user_role' => 0))) {
                    $user_info = $this->session->userdata('user_info');
                    $user_info['user_name'] = $data['name'];
                    $name = ucfirst(explode(" ", $data['name'])[0]);
                    $this->session->set_userdata('user_info', $user_info);
                    echo json_encode(array('status' => 'success', 'message' => 'Profile details has been updated successfully.', 'name' => $name));
                }
                else {
                    echo json_encode(array('status' => 'error', 'message' => 'Something went wrong, please try again later.'));
                }
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => 'Email already exist.'));
            }
        }
        else {
            echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
    }
    // Change user password.
    public function change_password() {
        $this->load->library('encryption');
        $user_id = user_id();
        if($this->form_validation->run('change_password') === TRUE){
            $old_password = $this->input->post('old_password');
            $password = $this->input->post('password');
            $password = $this->encryption->encrypt($password);
            $check = $this->crud->readData('password', 'users', array('user_id' => $user_id, 'user_role' => 0))->row_array();
            // echo $this->encryption->decrypt($check['password']);
            if($old_password == $this->encryption->decrypt($check['password'])) {
                if($this->crud->updateData('users', array('password' => $password), array('user_id' => $user_id, 'user_role' => 0))) {
                    echo json_encode(array('status' => 'success', 'message' => 'Password has been updated successfully.'));
                }
                else {
                    echo json_encode(array('status' => 'error', 'message' => 'Something went wrong, please try again later.'));
                }
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => 'Incorrect Old Password'));
            }
        }
        else {
            echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
        parent:: __construct();
        if(user_logged_in()===FALSE) {
            set_cookie('URL', uri_string(), 3600);
            redirect(base_url());
        }
    }

    public function index(){
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['title'] = 'Dashboard';
        $data['template'] = 'frontend/account/dashboard';
        $this->load->view('template/frontend/template',$data);
    }

    public function logout() {
        $user_id = user_id();
        $this->crud->updateData('users', array('login_status' => 0), array('user_id' => $user_id));
        $this->session->unset_userdata('user_info');
        redirect(base_url());
    }
}
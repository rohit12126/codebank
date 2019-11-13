<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('encryption');
    }
    /*Show home page*/
    public function index() { 
        if($this->input->get('token')) {
            if(user_logged_in() == true) redirect(base_url());
        }
        $data['title'] = 'Home';
        $data['template'] = 'frontend/index';
        $this->load->view('template/frontend/template',$data);
    }
    /*Login by user*/
    public function login_submit() {
        if($this->form_validation->run('login') === TRUE){
            $date = date('Y-m-d H:i:s');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $check = $this->crud->readData('*', 'users', array('email' => $email, 'user_role' => 0))->row_array();
            $ip_address = $this->input->ip_address();
            $URL = base_url();
            if($check) {
                if($check['status'] == 1) {
                    if($password == $this->encryption->decrypt($check['password'])) {
                        $user_data = array(
                            'user_id'       => $check['user_id'],
                            'user_role'     => $check['user_role'],
                            'email'         => $check['email'],
                            'user_name'     => $check['name'],
                            'logged_in'     => TRUE
                        );
                        $this->session->unset_userdata('user_info');
                        $this->session->set_userdata('user_info', $user_data);
                        $this->crud->updateData('users', array('ip_address' => $ip_address, 'last_login' => $date, 'login_status' => '1'), array('user_id' => $check['user_id']));
                        $city = '';
                        $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip_address);
                        $ipInfo = (array)json_decode($ipInfo);
                        if($ipInfo['status'] == 'success') {
                            $city = $ipInfo['city']."($ipInfo[regionName], $ipInfo[country])";
                        }
                        $insert = array(
                            'user_id' => $check['user_id'],
                            'ip_address' => $ip_address,
                            'city' => $city,
                        );
                        $this->crud->createData('login_history', $insert);
                        $this->session->set_flashdata('msg_success', $this->lang->line('success_message_logged_in'));

                        if(get_cookie('URL')) {
                            $URL =  get_cookie('URL');
                        }

                        echo json_encode(array('status' => 'success', 'URL' => $URL, 'message' => validation_errors()));
                    }
                    else {
                        echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_user_password')));
                    }
                }
                else {
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_user_account_deactivated')));
                }
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_user_email')));
            }
        }
        else {
            echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
    }
    /*Forget password*/
    public function forgot_password_submit() {
        if ($this->form_validation->run('forgot_password') == TRUE){
            $email = $this->input->post('email');
            $check = $this->crud->readData('user_id, email, name', 'users', array('email' => $email, 'user_role' => 0))->row_array();
            if($check){
                $new_password_key = trim(md5(rand(1000,9999)));
                $updateResult = $this->crud->updateData('users', array('new_password_key'=>$new_password_key), array('user_id' => $check['user_id']));
                if($updateResult){
                    //Start Send email
                    $email_data = array(
                        'name'  => htmlentities(ucfirst($check['name'])),
                        'link' => base_url("?token=$new_password_key")
                    );
                    $param = array(
                        'template_id' => '25',
                        'data' => $email_data,
                    );
                    sendEmail($check['email'], $param);
                    //End Send email
                    echo json_encode(array('status' => 'success', 'message' => 'Password reset instructions have been sent to <strong>'.$check['email'].'</strong>.<br> If not received email don&#39;t forget to check spam folder.'));
                }
                else {
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
                }
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_user_email_not_registered')));
            }
        }else{
            echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
    }
    /*Reset password*/
    public function resetpassword_submit(){
        if ($this->form_validation->run('resetpassword') == TRUE)  {
            $data = $this->input->post();
            $check = $this->crud->readData('user_id', 'users', array('new_password_key' => $data['key']))->row_array();
            if(empty($check) || $data['key'] == '') {
                echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_token_expired')));
            }
            else {
                $user_data  = array('password' => $this->encryption->encrypt($data['password']), 'new_password_key' => '');
                if($this->crud->updateData('users', $user_data, array('user_id' => $check['user_id']))){
                    $this->session->set_flashdata('msg_success',$this->lang->line('success_message_user_password_update'));
                    echo json_encode(array('status' => 'success', 'message' => ''));
                }else{
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_user_password_updation_fail')));
                }
            }
        }
        else {
            echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
    }
    /*Show page not found*/
    public function my404() {
        $is_backend = 0;
        $show_header = 1;
        if(superadmin_logged_in() && $this->uri->segment(1) =='backend') {
            $is_backend = 1;
            $show_header = 0;
        }
        $this->output->set_status_header('404'); 
        $data['title'] = 'Page Not Found';
        $data['show_header'] = $show_header;
        $data['template'] = 'frontend/my404';
        if($is_backend) {
            $this->load->view('template/backend/superadmin_template',$data);
        }
        else {
            $this->load->view('template/frontend/template',$data);
        }
    }
    /* Submit contact us form*/
    public function contact_us(){ 
        if($this->input->post()) {
            if($this->form_validation->run('contact_us') === TRUE){
                $data =[
                        'name'=> $this->input->post('name'),
                        'email'=> $this->input->post('email'),
                        'contact_number'=> $this->input->post('contact_number'),
                        'subject'=> $this->input->post('subject'),
                        'message'=> $this->input->post('message'),
                    ];
                if($this->crud->createData('contact_us', $data)) {
                    echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_contact_us'))); die;
                }
                else {
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong'))); die;
                }
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => validation_errors())); die;
            }
        } 
        $data['title'] = 'Contact Us';
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['template'] = 'frontend/contact/contact_form';
        $this->load->view('template/frontend/template',$data);
    }

    public function show_template() {
        //32,3,27,8,29
        $template_data = $this->crud->readData('page_template, title', 'pages', array('page_id'=>27))->row_array();
        if(empty($template_data) || empty($template_data['page_template'])) {
            redirect('pages/my404');
        }
        $data_array = json_decode($template_data['page_template'], TRUE);
        $data['template_css'] = $data_array['gjs-css'];
        $data['template_html'] = $data_array['gjs-html'];
        $data['title'] = ucwords($template_data['title']);
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['template'] = 'frontend/pages/index';
        $this->load->view('template/frontend/template',$data);
    }

    public function upload_documents() {
        if(isset($_FILES['file'])&&$_FILES['file']['tmp_name']) {
            $path = "assets/backend/uploads/main/";
            $image   = $_FILES['file'];
            /*$_FILES['image']['name'] = $image['name'];
            $_FILES['image']['type'] = $image['type'];
            $_FILES['image']['tmp_name'] = $image['tmp_name'];
            $_FILES['image']['error'] = $image['error'];
            $_FILES['image']['size'] = $image['size'];*/
            $image_resize = $this->input->post('resize');
            $thumb = $this->input->post('thumbnail');
            $FName = upload_file('file', $path, 'gif|jpg|jpeg|png');
            if(is_array($FName)) {
                echo json_encode(array('status' => 'error', 'message' => $FName['error']));
                exit;
            } else {
                if (!empty($FName)) {
                    if($image['type'] = 'image/jpeg' || $image['type'] = 'image/gif' || $image['type'] = 'image/png' ) {
                        if($image_resize) {
                            $upload_dir = "assets/backend/uploads/resize/";
                            //resize image or compress
                            resize_image($path, $upload_dir, $FName);
                        }

                        if($thumb) {
                            //create thumbnails
                            create_thumb($path.$FName, 'assets/backend/uploads/thumb/'.'254x254_'.$FName, 254,254);
                        }
                    }
                    echo json_encode(array('status' => 'success', 'message' => 'File has been uploaded successfully.'));
                        exit;
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Something went wrong, Please try later.'));
                    exit;
                } 
            } 
        }
        $data['topbar'] = $this->load->view('frontend/account/top_bar', '', true);
        $data['template'] = 'frontend/document/index';
        $this->load->view('template/frontend/template',$data);
    }
}
<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller{
	public function __construct() {
		parent::__construct();
        $this->load->library('encryption');
        $this->load->helper('file');
		if(superadmin_logged_in()===FALSE) {
            set_cookie('URL' , uri_string(), 3600);
			redirect('behindthescreen');
        }
	}
    /*Show user page*/
	public function index(){
		$data['title']= $this->lang->line('title_message_user');
        $data['template'] = 'backend/users/index';
		$this->load->view('template/backend/superadmin_template',$data);
	}
    /* Show datatable list of user page.*/
	public function list() { 
		$name = trim($this->input->get('name'));
        $status = trim($this->input->get('status'));
        $verify = trim($this->input->get('verify'));
		$start = $this->input->get('start');
		$length = $this->input->get('length');
		$order = $this->input->get('order')[0]['column'];
		$order_by = $this->input->get('order')[0]['dir'];
		if($order == 0) {
			$order = "users.user_id";
		}
		else if($order == 1) {
			$order = "name";
		}
		else if($order == 2) {
			$order = "email";
		}
        else if($order == 3) {
            $order = "contact";
        }
		else if($order == 5) {
			$order = "is_verify";
		}
        else if($order == 6) {
            $order = "status";
        }
		else if($order == 7) {
			$order = "last_login";
		}
		else {
			$order = "users.user_id";
			$order_by = "desc";
		}

		if($order_by == 'desc1') {
			$order 	  = "users.user_id";
			$order_by = 'desc';
		}
		$response = array(
			"draw" => $this->input->get('draw'),
		);
		$result = array();
		$i = $start;
		$where = '`users`.`user_role` = 0';
		if($name) {
			$where .= " AND (`name` LIKE '%".$name."%' OR `email` LIKE '%".$name."%')";
		}
        if($status != '') {
            $where .= " AND `status` = $status";
        }
        if($verify != '') {
            $where .= " AND `is_verify` = $verify";
        }

		$recordsFiltered = $this->crud->readData('COUNT(`user_id`) AS `user_id`', 'users', $where)->row_array()['user_id'];
		$users = $this->crud->readData('distinct(users.user_id),users.*, (SELECT COUNT(`lh_id`) FROM `login_history` WHERE `login_history`.`user_id` = `users`.`user_id`) AS user_login', 'users', $where , array() , '', "$order $order_by", array($length, $start))->result();
		if($users) {
			foreach ($users as $row) {
				$i++;
                $contact = $row->contact ? ucwords($row->contact) : "N/A";
				$arr = array(
					'sl_num' => '
					<div class="d-flex check-box-main-wrap">
						<div class="checkbox-wrap content-show">
							<label class="checkbox-input check-box-block">
                            	<input class="styled checkbox-row" type="checkbox" id="checkall'.$i.'" name="checkstatus[]" value="'.$row->user_id.'">  
                            	<div class="checkbox" for="checkall'.$i.'."></div>
                            </label>
						</div>
						<div class="amount">
                            '.$i.'.</div></div>',
					'name' => '<a href="javascript:void(0);" class="viewStudent" data-id="'.$row->user_id.'">'.ucwords(strtolower($row->name)).'</a>',
					'email' => $row->email,
                    'contact' => '<a class="edit-student" href="javascript:void(0);" data-id="'.$row->user_id.'">'.$contact."</a>",
                    'user_login' => $row->user_login?'<a class="dropdown-item viewLoginHistory" href="javascript:void(0);" data-id="'.$row->user_id.'">'.$row->user_login.'</a>':'N/A',
					'status' => '',
					'last_login' => change_date_format($row->last_login, DATE_FORMAT) ? change_date_format($row->last_login, DATE_FORMAT) : "N/A",
                    'is_verify' => '',
                    'action' => '<div class=action-dropdown>
                        <div class="btn-group">
                            <div  class=" dropdown-toggle three-dot-ic" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </div>
                            <div class="dropdown-menu">
                                <a class="dropdown-item edit-student" href="javascript:void(0);" data-id="'.$row->user_id.'"><i class="fa fa-pencil-alt"></i><span>Edit User info</span></a>
                                <a class="dropdown-item change_password" href="javascript:void(0);" data-id="'.$row->user_id.'"><i class="fa fa-key"></i><span>Change Password</span></a>
                                <a class="dropdown-item viewStudent" href="javascript:void(0);" data-id="'.$row->user_id.'"><i class="fa fa-eye"></i><span>View Details</span></a>
                                <a class="dropdown-item remove-student" href="javascript:void(0);" data-id="'.$row->user_id.'"><i class="fa fa-trash-alt"></i><span>Delete User </span></a>
                                <!--<a class="dropdown-item viewLoginHistory" href="javascript:void(0);" data-id="'.$row->user_id.'"><i class="fa fa-eye"></i><span>View Login History</span></a>-->
                                <a class="dropdown-item" target="_blank" href="'.base_url("backend/users/user_login/").$row->user_id.'"><i class="fa fa-unlock-alt"></i><span>Proxy Login</span></a>
                            </div>
                        </div>                      
                    </div>'
				);

				if($row->status == 1) {
					$arr['status'] = '<span class="badge badge-success change_status btn-xs btn btn-success tooltips" data-toggle="tooltip" data-status="0" data-id="'.$row->user_id.'" title="Click here to '.status('0').' user status">'.status($row->status).'</span>';
				}
				else { 
					$arr['status'] = '<span class="badge badge-success change_status btn-xs btn btn-danger tooltips" data-toggle="tooltip" data-status="1" data-id="'.$row->user_id.'" title="Click here to '.status('1').' user status">'.status($row->status).'</span>';
				}
                if($row->is_verify == 1) {
                    $arr['is_verify'] = '<span class="badge badge-success send_mail btn-xs btn btn-success tooltips" data-toggle="tooltip" data-status="0" data-id="'.$row->user_id.'" data-email="'.$row->email.'" title="'.$this->lang->line('tooltip_user_email').'">'.mail_status($row->is_verify).'</span>';
                }
                else { 
                    $arr['is_verify'] = '<span class="badge badge-success send_mail btn-xs btn btn-danger tooltips" data-toggle="tooltip"  data-status="1" data-id="'.$row->user_id.'" data-email="'.$row->email.'" title="'.$this->lang->line('tooltip_user_email').'">'.mail_status($row->is_verify).'</span>';
                }
				array_push($result, $arr);
			}
		}
		else {
            $where = str_replace('`users`.`user_role` = 0', '', $where);
			$arr = array(
				'sl_num' => $where ? TABLE_NO_RESULT : TABLE_NO_RESULT_EMPTY,
				'name' => 'error',
				'email' => '',
                'contact' => '',
                'user_login' => '',
				'status' => '',
				'last_login' => '',
                'send_mail' => '',
                'is_verify' => '',
				'action' => '',
			);
			array_push($result, $arr);
		}
		$response['recordsFiltered'] = $recordsFiltered;
		$response['data'] = $result;
		echo json_encode($response);
	}
    /*Change status of user active or inactive*/
	public function change_user_status() {
		$user_id = $this->input->post('user_id');
		$status = $this->input->post('status');
        $reason = $this->input->post('reason');
		$check = $this->crud->readData('user_id, email, name', 'users', array('user_id' => $user_id))->row_array();

        //Start Send email
        $email_data = array(
            'name'  => htmlentities(ucfirst($check['name'])),
            'reason'  => $reason,
            'link' => base_url(),
            'site_name' => SITE_NAME
        );
        if($status) {
            $param = array(
                'template_id' => '26',
                'data' => $email_data,
            );
            sendEmail($check['email'], $param);
        }
        else {
            if($reason) {
                $param = array(
                    'template_id' => '27',
                    'data' => $email_data,
                );
                sendEmail($check['email'], $param);
            }
        }

        //End Send email
		if($check) {
			if($this->crud->updateData('users', array('status' => $status), array('user_id' => $user_id))) {
	        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_user_status')));        		
        	}
        	else {
	        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
        	}
		}
		else {
			echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
		}
	}
    // Send email for password.
    public function send_mail() {
        $user_id = $this->input->post('user_id');
        $check = $this->crud->readData('user_id, name, email', 'users', array('user_id' => $user_id))->row_array();
        if($check) {
            $password = random_strings(4).rand(11,99);
            $data['password'] = $this->encryption->encrypt($password);
            $data['is_verify'] = 1;
            //Start Send email
            $email_data = array(
                'name'  => htmlentities(ucfirst($check['name'])),
                'email' => $check['email'],
                'password' => $password,
                'link' => base_url(),
                'site_name' => SITE_NAME
            );
            $param = array(
                'template_id' => '17',
                'data' => $email_data,
            );
            sendEmail($check['email'], $param);
            //End Send email
            if($this->crud->updateData('users', $data, array('user_id' => $user_id))) {
                echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_login_credentials')));
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
            }
        }
        else {
            echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
        }
    }
    // Add and Edit User from backend. 
	public function add() { 
    	$data = $this->input->post();
        $user_id = $data['user_id'];
        unset($data['user_id']);
        $this->form_validation->set_rules('name','Name','trim|required|max_length[50]');
        if($user_id == '')
            $this->form_validation->set_rules('email','Email','trim|required|max_length[50]|valid_email|is_unique[users.email]', array('valid_email' => 'Invalid Email', 'is_unique' => 'Email address is already exist.'));
        else
            $this->form_validation->set_rules('email','Email','trim|required|max_length[50]|valid_email', array('valid_email' => 'Invalid Email address.'));
        if($this->form_validation->run() === TRUE){
            $data['date_of_birth'] = change_date_format($data['date_of_birth']);
            $password = random_strings(4).rand(11,99);
            $data['password'] = $this->encryption->encrypt($password);
        	$where = array(
        		'email' => $data['email'],
                'user_role' => 0
        	);
        	$check = $this->crud->readData('*', 'users', $where)->row_array();
        	if($check) {
                if($user_id == '') {
    	        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_student_already_exist')));
                }
                else {
                    if($check['user_id'] == $user_id) {
                        unset($data['password']);
                        $this->crud->updateData('users', $data, array('user_id' => $user_id));
                        echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_user_details_update')));
                    }
                    else {
                        echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_email_already_exist')));
                    }
                }
        	}
        	else {
                if($user_id == '') {
                    $data['status'] = 1;
                    $data['is_verify'] = 1;
            		$this->crud->createData('users', $data);
                    //Start Send email
                    $email_data = array(
                        'name'  => htmlentities(ucfirst($data['name'])),
                        'email' => $data['email'],
                        'password' => $password,
                        'link' => base_url(),
                        'site_name' => SITE_NAME
                    );
                    $param = array(
                        'template_id' => '17',
                        'data' => $email_data,
                    );
                    // sendEmail($old_data['email'], $param);
                    sendEmail($data['email'], $param);
                    //End Send email
    		        echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_user_details_add')));
                }
                else {
                    unset($data['password']);
                    $this->crud->updateData('users', $data, array('user_id' => $user_id));
                    echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_user_details_update')));
                }
			}
        }
        else {
        	echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
	}
    // manage user status from backend
    public function manage_status() {  	
        if(!empty($_POST['type'])){
            $default_arr = array(
                'status' => FALSE
            ); 
            $status = $this->input->post('status');            
            $count = count($this->input->post('row_id'));

          
            for ($i=0; $i < $count ; $i++){
                if($status == 3 ||$status == 2 || $status == 1 || $status == ''){
                    if($_POST['type'] == 1 && ($status == 2 || $status == 1)){
                        if($status == 2 ){
                            $update_status = array('status' => 0);
                        }elseif($status == 1){
                            $update_status = array('status' => 1);
                        }
                        $this->crud->updateData('users', $update_status, array('user_id' => $_POST['row_id'][$i]));
                    }
                    if($status == 3) {      //Send login credential
                        $user_id = $_POST['row_id'][$i];
                        $check = $this->crud->readData('user_id, name, email', 'users', array('user_id' => $user_id))->row_array();
                        if($check) {
                            $password = random_strings(4).rand(11,99);
                            $data['password'] = $this->encryption->encrypt($password);
                            $data['is_verify'] = 1;
                            //Start Send email
                            $email_data = array(
                                'name'  => htmlentities(ucfirst($check['name'])),
                                'email' => $check['email'],
                                'password' => $password,
                                'link' => base_url(),
                                'site_name' => SITE_NAME
                            );
                            $param = array(
                                'template_id' => '17',
                                'data' => $email_data,
                            );
                            // sendEmail($old_data['email'], $param);
                            sendEmail($check['email'], $param);
                            //End Send email
                            $this->crud->updateData('users', $data, array('user_id' => $user_id));
                        }
                    }
                }
            }
            if($status == 3) {
                echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_login_credentials')));
            }
            else {
                echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_user_status')));
            }
        }
  	}
    // Change password of user from backend.
	public function change_password() {
        $this->form_validation->set_rules('user_id', 'User', 'required', array('required' => 'You must provide a %s.'));
		$this->form_validation->set_rules('new_pass','New Password','required|trim|min_length[6]|max_length[15]');
        $this->form_validation->set_rules('con_pass','Confirm Password','trim|required|matches[new_pass]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if($this->form_validation->run() === TRUE){ 
        	$this->load->library('encryption');
        	$user_id  = $this->input->post('user_id');
			$password = $this->encryption->encrypt($this->input->post('new_pass'));
        	if($this->crud->updateData('users', array('password' => $password), array('user_id' => $user_id))) {
	        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_user_password_update')));
        	}
        	else {
	        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
        	}
        }
        else {
        	echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
	}
    // Delete particular user.
	public function delete() {
    	$user_id = $this->input->post('user_id');
    	if($this->crud->deleteData('users', array('user_id' => $user_id))) {
        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_user_delete')));        		
    	}
    	else {
        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
    	}
	}
    // Proxy login a user from backend.
	public function user_login($user_id = 0) {
        $check = $this->crud->readData('*', 'users', array('user_id' => $user_id, 'user_role' => 0))->row_array();

        if($check) {
        	$user_id=$check['user_id'];
            $user_data = array(
                'user_id'       => $user_id,
                'exam_id'       => $check['exam_id'],
                'user_role'     => $check['user_role'],
                'email'         => $check['email'],
                'user_name'     => $check['name'],
                'logged_in'     => TRUE
            );
            $user_ip=$this->getUserIpAddr();
            $this->crud->updateData('users', array('ip_address' => $user_ip, 'last_login' => date('Y-m-d H:i:s')), array('user_id' => $user_id));
            $this->session->unset_userdata('user_info');
            $this->session->set_userdata('user_info', $user_data);
            redirect(base_url());
        }
        else {
        	$this->session->set_flashdata('msg_error', $this->lang->line('error_message_user_invalid'));
            redirect(base_url('backend/user'));
        }
	}
    // Get user IP address
	function getUserIpAddr(){
	    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
	        //ip from share internet
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	        //ip pass from proxy
	        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }else{
	        $ip = $_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}
    // View user details.
    public function view() {
        $user_id = $this->input->post('user_id');
        $data['user'] = $this->crud->readData('users.*, ', 'users', array('user_id' => $user_id),array())->row_array();
        $data['user_id'] = $user_id;
        $this->load->view('backend/users/view', $data);
    }
    // View user login history
    public function view_login_history() {
        $user_id = $this->input->post('user_id');
        $data['data'] = $this->crud->readData('*', 'login_history', array('user_id' => $user_id),array(), '', 'lh_id DESC',array(10,0))->result();
        $data['user_id'] = $user_id;
        $this->load->view('backend/users/login_history', $data);
    }
    // update user password from backend.
	public function profile($user_id = '') {
		$data['user'] = $this->crud->readData('users.*', 'users', array('user_id' => $user_id),array())->row_array();
		if(empty($data['user'])) redirect(base_url('backend/student'));

		if($this->input->post('password')) {
        	$this->form_validation->set_rules('password[password]', 'Password', 'required|min_length[6]|max_length[10]');
			$this->form_validation->set_rules('password[con_pass]', 'Confirm Password', 'required|matches[password[password]]');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        	if ($this->form_validation->run() == TRUE)	{
        		$password = $this->encryption->encrypt($this->input->post('password')['password']);
				$user_data  = array('password' => $password);
				if($this->crud->updateData('users', $user_data, array('user_id' => $user_id))){
					$this->session->set_flashdata('msg_success',$this->lang->line('success_message_user_password_update'));
				}else{
					$this->session->set_flashdata('msg_error',$this->lang->line('error_message_user_password_updation_fail'));
				}
				redirect("backend/users/profile/$user_id");
        	}
        }
		$data['title']= 'Student Profile';
		$data['user_id'] = $user_id;
        $data['template'] = 'backend/users/profile';
		$this->load->view('template/backend/superadmin_template',$data);
	}
    // Change user status 
	public function change_status($user_id = '', $status = 0) {
	    $data=array('status'=>$status);
	    if($this->crud->updateData('users', $data, array('user_id' => $user_id)))    {
		    $this->session->set_flashdata('msg_success',$this->lang->line('success_message_status'));
		}
	    redirect($_SERVER['HTTP_REFERER']);
	}
    // Import user data using csv.
    public function import(){
        $status = 'error';
        $message = $this->lang->line('error_message_something_went_wrong');
        $html = '';
        $file = $_FILES['file']['name'];
        $csvFormat = array('Student Name', 'Email', 'Contact Number');
        if($file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if($ext == 'CSV' || $ext == 'csv') {

                $csvHeader = array();
                $csvData = array();
                $file = fopen($_FILES['file']['tmp_name'],"r");

                $i = 0;
                while(! feof($file)) {
                    $csv = fgetcsv($file);
                    if($i == 0) {
                        $csvHeader = $csv;
                    }
                    else {
                        if($csv)
                            $csvData[] = $csv;
                    }
                    $i++;
                }
                fclose($file);
                if(implode(",", $csvHeader) != implode(",", $csvFormat)) {
                    $message = $this->lang->line('error_invalid_csv_format');
                }
                else {
                    $result = array(
                        'data' => $csvData,
                    );
                    $html = $this->load->view('backend/users/import', $result, true);
                    $status = 'success';
                    $message = 'Student List';
                }
            }
            else {
                $message = $this->lang->line('error_select_csv');
            }
        }
        else {
            $message = $this->lang->line('error_select_csv');
        }
        echo json_encode(array('status' => $status, 'message' => $message, 'html' => $html));
    }
    /* add bulk users from csv*/
    public function add_bulk_student() {
        $data = $this->input->post();
        $email = implode(",", $data['email']);
        $check_mail = $this->crud->readData('DISTINCT email', 'users', "FIND_IN_SET(`email`, '$email')")->result_array();
        $this->form_validation->set_rules('name[]','Name','trim|required|max_length[50]');
        $this->form_validation->set_rules('email[]','Email','trim|required|max_length[50]|valid_email|is_unique[users.email]', array('valid_email' => 'Invalid Email', 'is_unique' => '%s already exist'));
        if($this->form_validation->run() === TRUE){
            $inserts = array();
            foreach ($data['name'] as $key => $name) {
                $insert = array(
                    'name'                      => $name,
                    'email'                     => $data['email'][$key],
                    'contact'                   => $data['contact'][$key],
                    'status'                    => 1,
                );
                $insert = my_htmlentities($insert);
                $inserts[] = $insert;
            }
            $this->crud->createData('users', $inserts);
            echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_user_import'), 'check_mail' => ''));            
        }
        else {
            echo json_encode(array('status' => 'error', 'message' => validation_errors(), 'check_mail' => $check_mail));
        }
    }
}
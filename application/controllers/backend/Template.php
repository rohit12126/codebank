<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(superadmin_logged_in()===FALSE) {
			set_cookie('URL' , uri_string(), 3600);
			redirect('behindthescreen');
		}
	}
	// Show email template page.
	public function index() {
		$data['title'] = $this->lang->line('title_message_email_template');
		$data['template'] = 'backend/template/index';
		$this->load->view('template/backend/superadmin_template',$data);
	}
	// Datatable list of email template page.
	public function list() {
		$search = $this->input->get('all');
		$start = $this->input->get('start');
		$length = $this->input->get('length');
		$order = $this->input->get('order')[0]['column'];
		$order_by = $this->input->get('order')[0]['dir'];
		if($order == 0) {
			$order = "email_template_id";
		}
		else if($order == 1) {
			$order = "template_name";
		}
		else if($order == 2) {
			$order = "template_subject";
		}
		else if($order == 3) {
			$order = "template_layout";
		}
		else {
			$order = "email_template_id";
			$order_by = "desc";
		}
		if($order_by == 'desc1') {
			$order 	  = "email_template_id";
			$order_by = 'desc';
		}
		$response = array(
			"draw" => $this->input->get('draw'),
		);
		$result = array();
		$i = $start+1;
		$where = '';
		if($search) {
			$where .= "`template_name` LIKE '%".$search."%' OR `template_subject` LIKE '%".$search."%'";
		}
		$recordsFiltered = $this->crud->readData('COUNT(`email_template_id`) AS `id`', 'email_templates', $where)->row_array()['id'];
		$subject = $this->crud->readData('*', 'email_templates', $where, array(), '', "$order $order_by", array($length, $start))->result();
		if($subject) {
			foreach ($subject as $row) {
				$arr = array(
					'0' => $i++.'.',
					'1' => ucfirst($row->template_name),
					'2' => ucfirst($row->template_subject),
					'3' => ucfirst($row->template_layout),
                    '4' => '<a href="javascript:void(0);" data-toggle="tooltip" title="'.$this->lang->line('tooltip_template_edit').'" data-id="'.$row->email_template_id.'" class="on-default edit-template"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                        <a href="javascript:void(0);" data-id="'.$row->email_template_id.'" data-toggle="tooltip" title="'.$this->lang->line('tooltip_template_view').'"  class="on-default view-tempate"><i class="fa fa-eye"></i></a>'
				);
				array_push($result, $arr);
			}
		}
		else {
			$arr = array(
				'0' => $where ? TABLE_NO_RESULT : TABLE_NO_RESULT_EMPTY,
				'1' => 'error',
				'2' => '',
				'3' => '',
				'4' => '',
			);
			array_push($result, $arr);
		}
		$response['recordsFiltered'] = $recordsFiltered;
		$response['data'] = $result;
		echo json_encode($response);
	}
	// Get email template data using id
	public function get_data() {
		$email_template_id = $this->input->post('id');
		$subject = $this->crud->readData('*', 'email_templates', array('email_template_id' => $email_template_id))->row_array();
		echo json_encode($subject);
	}
	// Edit email template.
	public function edit() {
        if($this->form_validation->run('email_template_edit') === TRUE){
        	$email_template_id = $this->input->post('id');
        	$data['template_subject'] = $this->input->post('template_name');
        	$data['template_layout'] = $this->input->post('template_layout');
        	$data['template_name'] = $this->input->post('template_name');
        	$data['template_updated'] = date('Y-m-d H:i:s');
        	$data['template_body'] = $this->input->post('template_body');
        	if($this->crud->updateData('email_templates', $data, array('email_template_id' => $email_template_id))) {
	        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_email_template_update')));        		
        	}
        	else {
	        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
        	}
        }
        else {
        	echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
	}
	// View email template.
	public function view() {
		$id = $this->input->post('id');
		$email_template = $this->crud->readData('template_body, template_layout', 'email_templates', array('email_template_id' => $id))->row_array();
		$this->load->view('template/email/'.$email_template['template_layout'], array('email_message' => $email_template['template_body']));
	}
}

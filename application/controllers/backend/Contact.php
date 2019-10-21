<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(superadmin_logged_in()===FALSE)
			redirect('behindthescreen');
	}
	// Show contact page
	public function index() {
		$data['title'] = $this->lang->line('title_message_contact');
		$data['template'] = 'backend/contact/index';
		$this->load->view('template/backend/superadmin_template',$data);
	}
	// list of contact data
	public function list() {
		// $search = $this->input->get('search')['value'];
		$search = $this->input->get('all');
		$subject = $this->input->get('subject');
		$start = $this->input->get('start');
		$length = $this->input->get('length');
		$order = $this->input->get('order')[0]['column'];
		$order_by = $this->input->get('order')[0]['dir'];
		if($order == 1) {
			$order = "name";
		}
		else if($order == 2) {
			$order = "email";
		}
		else if($order == 3) {
			$order = "contact_number";
		}
		else if($order == 4) {
			$order = "subject";
		}
		else {
			$order = "contact_id";
			$order_by = "desc";
		}
		if($order_by == 'desc1') {
			$order 	  = "contact_id";
			$order_by = 'desc';
		}
		$response = array(
			"draw" => $this->input->get('draw'),
		);
		$result = array();
		$i = $start+1;
		$where = '';
		if($search) {
			$where .= "(`name` LIKE '%".$search."%' OR `email` LIKE '%".$search."%')";
		}
		if($subject != '') {
			if($search) {
				$where .= " AND `subject` = $subject";
			}
			else {
				$where .= "`subject` = $subject";
			}
		}
		$recordsFiltered = $this->crud->readData('COUNT(`contact_id`) AS `contact_id`', 'contact_us', $where)->row_array()['contact_id'];
		$subject = $this->crud->readData('*', 'contact_us', $where, array(), '', "$order $order_by", array($length, $start))->result();
		if($subject) {
			foreach ($subject as $row) {
				$arr = array(
					'0' => $i++.'.',
					'1' => ucfirst($row->name),
					'2' => $row->email,
					'3' => $row->contact_number ? $row->contact_number : "N/A",
					'4' => ($row->subject !=''|| $row->subject !=NULL) ? ucfirst(support_subject($row->subject)):"N/A",
					'5' => '<div class="sx-media-subheading sx-ellipsis-text more">'.ucfirst($row->message).'</div>',
					'6' => '<a href="javascript:void(0);" data-toggle="tooltip" title="'.$this->lang->line('tooltip_contact_delete').'" data-id="'.$row->contact_id.'" class="on-default remove-row"><i class="far fa-trash-alt"></i></a>'
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
				'5' => '',
				'6' => ''
			);
			array_push($result, $arr);
		}
		$response['recordsFiltered'] = $recordsFiltered;
		$response['data'] = $result;
		echo json_encode($response);
	}
	// Delete contact record
	public function delete() {
    	$contact_id = $this->input->post('contact_id');
    	if($this->crud->deleteData('contact_us', array('contact_id' => $contact_id))) {
        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_contact_delete')));        		
    	}
    	else {
        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
    	}
	}
}

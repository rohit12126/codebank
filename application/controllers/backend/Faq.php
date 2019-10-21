<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if(superadmin_logged_in()===FALSE)
			redirect('behindthescreen');
	}
	// Show FAQ page
	public function index(){
		$data['title']= $this->lang->line('title_message_faq');
        $data['template'] = 'backend/faq/index';
		$this->load->view('template/backend/superadmin_template',$data);
	}
	// Datatable list of FAQ page.
	public function list() {
		$question = $this->input->get('question');
		$start = $this->input->get('start');
		$length = $this->input->get('length');
		$order = $this->input->get('order')[0]['column'];
		$order_by = $this->input->get('order')[0]['dir'];
		if($order == 0) {
			$order = "faq_id";
		}
		else if($order == 1) {
			$order = "question";
		}
		else if($order == 3) {
			$order = "order_by";
		}
		else if($order == 4) {
			$order = "status";
		}
		else {
			$order = "faq_id";
			$order_by = "desc";
		}

		if($order_by == 'desc1') {
			$order 	  = "faq_id";
			$order_by = 'desc';
		}
		$response = array(
			"draw" => $this->input->get('draw')
		);
		$result = array();
		$i = $start+1;
		$where = '';
		if($question) {
			if($where)
				$where .= " AND `question` LIKE '%".$question."%'";
			else
				$where .= "`question` LIKE '%".$question."%'";
		}
		$recordsFiltered = $this->crud->readData('COUNT(`faq_id`) AS `faq_id`', 'faq', $where)->row_array()['faq_id'];
		$faq = $this->crud->readData('*', 'faq', $where, array(), '', "$order $order_by", array($length, $start))->result();
		if($faq) {
			foreach ($faq as $row) {
				if($row->status == "0"){
					$status = '<span class="badge badge-success change_status btn-xs btn btn-danger tooltips" data-toggle="tooltip" data-status="'.$row->status.'" data-id="'.$row->faq_id.'" title="'.$this->lang->line('tooltip_faq_status').' '.status('1').'">'.status($row->status).'</span>';
				}else{
					$status = '<span class="badge badge-success change_status btn-xs btn btn-success tooltips" data-toggle="tooltip" data-status="'.$row->status.'" data-id="'.$row->faq_id.'" title="'.$this->lang->line('tooltip_faq_status').' '.status('0').'" >'.status($row->status).'</span>';
				}
				$arr = array(
					'sl_num' => $i++.'.',
					'question' => $row->question,
					'answer' => $row->answer,
					'order_by' => '<input maxlength="5" type="text" class="form-control" placeholder="00.00" name="order_by['.$row->faq_id.']" value="'.$row->order_by.'">',
					'status'=> $status,
                    'actions' =>'<a href="javascript:void(0);" data-id="'.$row->faq_id.'" data-toggle="tooltip" title="'.$this->lang->line('tooltip_faq_edit').'" class="on-default edit-row tooltips edit_faq"  data-toggle="modal" data-title = "Result" ><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0);" data-id="'.$row->faq_id.'" data-toggle="tooltip" title="'.$this->lang->line('tooltip_faq_delete').'" class="on-default remove-row tooltips delete_faq danger"  data-toggle="modal" data-title = "Result" ><i class="fa fa-trash-alt"></i></a>',
				);
				array_push($result, $arr);
			}
		}
		else {
			$arr = array(
				'sl_num' => TABLE_NO_RESULT,
				'question' => 'error',
				'answer' => 'error',
				'order_by' => 'error',
				'status'=> '',
                'actions' => '',
			);
			array_push($result, $arr);
		}
		$response['recordsFiltered'] = $recordsFiltered;
		$response['data'] = $result;
		echo json_encode($response);
	}
	// Update custom order by column
	public function update_order_by() {
		$order_by = $this->input->post('order_by');
		foreach ($order_by as $key => $value) {
			$this->crud->updateData('faq', array('order_by' => $value), array('faq_id' => $key));
		}
		echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_orderby_update')));
	}
	// Add FAQ 
	public function add() {
        if($this->form_validation->run('faq_add') === TRUE){
        	$data = $this->input->post();
        	$data['status'] = 1;
        	if($this->crud->createData('faq', $data)) {
	        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_faq_create')));
        	}
        	else {
	        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
        	}
        }
        else {
        	echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
	}
	// Edit FAQ
	public function edit() {
        if($this->form_validation->run('faq_edit') === TRUE){
        	$data = $this->input->post();
        	$faq_id = $data['faq_id'];
        	unset($data['faq_id']);
        	if($this->crud->updateData('faq', $data, array('faq_id' => $faq_id))) {
	        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_faq_update')));
        	}
        	else {
	        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
        	}
        }
        else {
        	echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
	}
	// Change of FAQ status "Active" or "Inactive"
	public function change_faq_status() { 
		$faq_id = $this->input->post('faq_id'); 
		$status = $this->input->post('status');
		if($status == '1') {
			$status = '0';
		}else{
			$status = '1';
		}
		$check = $this->crud->readData('faq_id', 'faq', array('faq_id' => $faq_id))->row_array(); 
		if($check) { 
			if($this->crud->updateData('faq', array('status' => $status), array('faq_id' => $faq_id))) { 
	        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line
	        		('success_message_status')));
        	}
        	else {
	        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
        	}
		}
		else {
			echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
		}
	}
	// Get FAQ FAQ data using id
	public function get_data() {
		$faq_id = $this->input->post('faq_id');
		$faq = $this->crud->readData('*', 'faq', array('faq_id' => $faq_id))->row_array();
		echo json_encode($faq);
	}
	// Delete particular FAQ
	public function delete() {
		$faq_id = $this->input->post('faq_id');
		if($this->crud->deleteData('faq', array('faq_id' => $faq_id))) { 
        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_faq_delete')));
    	}
    	else {
        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
    	}
	}

}
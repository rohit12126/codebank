<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(superadmin_logged_in()===FALSE)
			redirect('behindthescreen');
	}
	// show support page.
	public function index() {
		$data['title'] = $this->lang->line('title_message_support');
		$data['template'] = 'backend/support/index';
		$this->load->view('template/backend/superadmin_template',$data);
	}
	// show list of support ticket.
	public function list() {
		$search = $this->input->get('all');
		$status = $this->input->get('status');
		$subject = $this->input->get('subject');
		$order_new_message = $this->input->get('orderby');
		$start = $this->input->get('start');
		$length = $this->input->get('length');
		$order = $this->input->get('order')[0]['column'];
		$order_by = $this->input->get('order')[0]['dir'];
		if($order == 1) {
			$order = "ticket_id";
		}
		else if($order == 2) {
			$order = "name";
		}
		else if($order == 4) {
			$order = "status";
		}
		else {
			$order = "support_id";
			$order_by = "desc";
		}
		if($order_by == 'desc1') {
			$order 	  = "support_id";
			$order_by = 'desc';
		}
		$response = array(
			"draw" => $this->input->get('draw'),
		);
		$result = array();
		$i = $start+1;
		$where = '';
		if($search) {
			$where .= "(`name` LIKE '%".trim($search)."%' OR `ticket_id` LIKE '%".trim($search)."%' OR `email` LIKE '%".trim($search)."%')";
		}

        if($status != '') {
			if($where !='') {
				$where .= " AND `status` = $status";
			}
			else {
				$where .= "`status` = $status";
			}
		}

		if($subject != '') {
			if($where !='') {
				$where .= " AND `subject` = $subject";
			}
			else {
				$where .= "`subject` = $subject";
			}
		}

		if($order_new_message != '') {
			if($where !='') {
				$where .= " AND `is_new` = $order_new_message";
			}
			else {
				$where .= "`is_new` = $order_new_message";
			}
		}

		$recordsFiltered = $this->crud->readData('COUNT(`support_id`) AS `support_id`', 'support', $where)->row_array()['support_id'];
		$support_data = $this->crud->readData('*', 'support', $where, array(), '', "$order $order_by", array($length, $start))->result();
		if($support_data) {
			foreach ($support_data as $row) {
				$contcat = $row->contact_number?$row->contact_number:'N/A';
				$chat = json_decode($row->replies);
				$last_key = array_keys($chat);
				$last_chat = $chat[end($last_key)];
				$last_comment = '';
				$last_date = '';
				if(isset($last_chat->You)) {
					$last_comment = $last_chat->You->comment;
					$last_date = change_date_format($last_chat->You->date, 'M j, Y, g:i A');
				} else {
					$last_comment = $last_chat->Admin->comment;
					$last_date = change_date_format($last_chat->Admin->date, 'M j, Y, g:i A');
				}
				$arr = array(
					'0' => $i++.'.',
					'1' => '<a href="javascript:void(0);" data-toggle="tooltip" title="Click here for Reply" data-id="'.$row->support_id.'" class="on-default supportReplyModal"><b>#'.$row->ticket_id.'</b></a><b><br>Type: - </b>'.ucfirst(support_subject($row->subject)),
					'2' => '<b><br>Name: -</b>'.ucfirst($row->name).'<b><br>Email: - </b>'.$row->email.'<b><br>Mobile: - </b>'.$contcat,
					'3' => '<b><br>Comment: - </b><div class="sx-media-subheading sx-ellipsis-text more">'.ucfirst($last_comment).'</div><b><br>Date Time: - </b>'.$last_date.'',
					'4' =>'',
					'5' => '<a href="javascript:void(0);" data-toggle="tooltip" title="Reply" data-id="'.$row->support_id.'" class="on-default supportReplyModal"><i class="fas fa-reply"></i></a>

					<a href="javascript:void(0);" data-toggle="tooltip" title="Delete Support data" data-id="'.$row->support_id.'" class="on-default remove-row"><i class="far fa-trash-alt"></i></a>'
				);

				if($row->status == 1) {
					$arr['4'] = '<span class="badge badge-success change_status btn-xs btn btn-success tooltips" data-toggle="tooltip" data-status="'.$row->status.'" data-id="'.$row->support_id.'" title="Click here to close ticket status">'.support_status($row->status).'</span>';
				}
				else { 
					$arr['4'] = '<span class="badge badge-success change_status btn-xs btn btn-danger tooltips" data-toggle="tooltip" data-status="'.'.$row->status.'.'" data-id="'.$row->support_id.'" title="Click here to open ticket status">'.support_status($row->status).'</span>';
				}
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
				/*'6' => '',
				'7' => '',*/
				
			);
			array_push($result, $arr);
		}
		$response['recordsFiltered'] = $recordsFiltered;
		$response['data'] = $result;
		echo json_encode($response);
	}
	// delete support ticket
	public function delete() {
    	$support_id = $this->input->post('support_id');
    	if($this->crud->deleteData('support', array('support_id' => $support_id))) {
        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_support_delete')));        		
    	}
    	else {
        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
    	}
	}
	// Change of support status "Active" or "Inactive"
	public function change_support_status() { 
		$support_id = $this->input->post('support_id'); 
		$status = $this->input->post('status');
		if($status == '1') {
			$status = '0';
		}else{
			$status = '1';
		}
		$check = $this->crud->readData('support_id', 'support', array('support_id' => $support_id))->row_array(); 
		if($check) { 
			if($this->crud->updateData('support', array('status' => $status), array('support_id' => $support_id))) { 
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

	 // Get reply modal content.
    public function reply_modal() {
        $support_id = $this->input->post('support_id');
        $data['support'] = $this->crud->readData('support.*, ', 'support', array('support_id' => $support_id),array())->row();
        if(!empty($data['support'])) {
        	$this->crud->updateData('support', array('is_new' => 1), array('support_id' => $support_id));
        }
        $this->load->view('backend/support/reply', $data);
    }
    // Reply to user by admin for open ticket.
    public function reply() {
		$this->form_validation->set_rules('support_id','Support id','required');
        $this->form_validation->set_rules('reply','Comment','trim|required');
        if($this->form_validation->run() === TRUE){
        	$support_id = $this->input->post('support_id');
        	$support = $this->crud->readData('support.*, ', 'support', array('support_id' => $support_id, 'status'=>1),array())->row();
        	if(empty($support)){
        		echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong'))); die;
        	}
        	$replies = json_decode($support->replies);
        	if(!empty($replies)) {
        		$last = key(array_slice($replies, -1, 1, true));
				$last++;
        	} else {
        		$last = 0;
        	}
			$replies[$last] = (object)['Admin'=>(object)[
			        'comment' =>  htmlentities($this->input->post('reply')),
			        'date' => date('Y-m-d h:i:s'),
			]];
        	$data['replies'] = json_encode($replies);
        	if($this->crud->updateData('support', $data, array('support_id' => $support_id))) {
	        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_reply')));        		
        	}
        	else {
	        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
        	}
        }
        else {
        	echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(superadmin_logged_in()===FALSE)
			redirect('behindthescreen');
	}
	// Show page template page.
	public function index() {
		$data['title'] = $this->lang->line('title_message_page_template');
		$data['template'] = 'backend/pages/index';
		$this->load->view('template/backend/superadmin_template',$data);
	}
	// Show Datatable list of template page. 
	public function list() {
		$search = $this->input->get('all');
		$start = $this->input->get('start');
		$length = $this->input->get('length');
		$order = $this->input->get('order')[0]['column'];
		$order_by = $this->input->get('order')[0]['dir'];
		if($order == 0) {
			$order = "page_id";
		}
		else {
			$order = "page_id";
			$order_by = "desc";
		}
		$response = array(
			"draw" => $this->input->get('draw'),
		);
		$result = array();
		$i = $start+1;
		$where = '';
		if($search) {
			$where .= "`title` LIKE '%".$search."%'";
		}
		$recordsFiltered = $this->crud->readData('COUNT(`page_id`) AS `page_id`', 'pages', $where)->row_array()['page_id'];
		$subject = $this->crud->readData('*', 'pages', $where, array(), '', "title", array($length, $start))->result();
		if($subject) {
			foreach ($subject as $row) {
				$arr = array(
					'0' => $i++.'.',
					'1' => ucfirst($row->title),
					'2' => trim($row->meta_description) ? $row->meta_description : "N/A",
					'3' => trim($row->meta_content) ? $row->meta_content : "N/A",
					'4' => trim($row->meta_keyword) ? $row->meta_keyword : "N/A",
					'5' => '<a href="javascript:void(0);" data-toggle="tooltip" title="'.$this->lang->line('tooltip_page_edit').'" data-id="'.$row->page_id.'" class="on-default edit-row tooltips"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0);"  data-toggle="tooltip" title="'.$this->lang->line('tooltip_page_view').'" data-id="'.$row->page_id.'" class="on-default view-row tooltips"><i class="far fa-eye"></i></a>'
				);
				array_push($result, $arr);
			}
		}
		else {
			$arr = array(
				'0' => TABLE_NO_RESULT,
				'1' => 'error',
				'2' => '',
				'3' => '',
				'4' => '',
				'5' => ''
			);
			array_push($result, $arr);
		}
		$response['recordsFiltered'] = $recordsFiltered;
		$response['data'] = $result;
		echo json_encode($response);
	}
	// Get data of page template using page id
	public function get_data() {
		$page_id = $this->input->post('page_id');
		$subject = $this->crud->readData('*', 'pages', array('page_id' => $page_id))->row_array();
		echo json_encode($subject);
	}
	// Edit particular page template
	public function edit() {
        if($this->form_validation->run('page_template_edit') === TRUE){
        	$page_id = $this->input->post('page_id');
        	$data = [
        			'title' => $this->input->post('title'),
        			'meta_description' => $this->input->post('meta_description'),
        			'meta_content' => $this->input->post('meta_content'),
        			'meta_keyword' => $this->input->post('meta_keyword'),
        			'description' => $this->input->post('description'),
        			'updated_at' => date('Y-m-d H:i:s')
        		];
        	if($this->crud->updateData('pages', $data, array('page_id' => $page_id))) {
	        	echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_page_template')));        		
        	}
        	else {
	        	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
        	}
        }
        else {
        	echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
	}
	// View page template
	public function view() {
		$page_id = $this->input->post('page_id');
		$data = $this->crud->readData('title, description', 'pages', array('page_id' => $page_id))->row_array();
		echo json_encode($data);
	}
	// Show 404 page 
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
}

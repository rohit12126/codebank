<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Common extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if(superadmin_logged_in()===FALSE)
		redirect('behindthescreen');
	}

	public function get_data(){
		$table = $this->input->post('table');
		$where = $this->input->post('where');
		$data = $this->crud->readData('*', $table, $where)->row_array();
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
}
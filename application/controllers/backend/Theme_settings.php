<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Theme_settings extends CI_Controller{
	public function __construct() {
		parent::__construct();
		if(superadmin_logged_in()===FALSE){
			redirect('behindthescreen');
		}
		$this->load->helper('file');
	}
	/*customize theme settings*/
	public function index(){
		if($this->input->post()) {
	        if($this->form_validation->run('theme_settings') === TRUE){
				$current_setting_data = $this->input->post();
				if ( ! $this->update_css_file($current_setting_data)) {
				    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
				} else {
					$update_data['option_value'] = json_encode($current_setting_data);
					if($this->crud->updateData('options', $update_data, array('option_id' => 22))) {
						echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_theme_setting_update')));
					} else {
						echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
					}
				}
			} else {
				echo json_encode(array('status' => 'error', 'message' => validation_errors()));
			}
		} else {
			$current_settings = $this->crud->readData('option_name, option_value', 'options', array('option_id'=> 22))->row_array();
			$data['current_settings'] = json_decode($current_settings['option_value']);
			$data['title'] = $this->lang->line('title_message_theme_settings');
			$data['template'] = 'backend/theme_settings/index';
			$this->load->view('template/backend/superadmin_template',$data);
		}
	} 
	/*Reset default theme settings*/
	public function default(){ 
		$default_settings = $this->crud->readData('option_name, option_value', 'options', array('option_id'=> 23))->row_array();//Default theme setting option_id = 23 
		if(!empty($default_settings)) {
			$update_data['option_value'] = $default_settings['option_value'];
			// Set current theme as a default settings option_id = 22 current theme settings.
			if($this->crud->updateData('options', $update_data, array('option_id' => 22))) {
				$this->update_css_file(json_decode($default_settings['option_value'], TRUE));
				echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_theme_setting_reset_default')));
			} else {
				echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
			}
		} else {
			echo json_encode(array('status' => 'error', 'message' => $this->lang->line('error_message_something_went_wrong')));
		}
	}
	/*Write new css at global_css_settings.css file*/
	private function update_css_file($data = array()) {
		if($data) {
			$file_location = FCPATH.'assets/backend/css/global_css_settings.css';
			$new_file_data = ':root {--main-sidebar-bg-color : '.$data['sidebar_color'].';
			  --top-header-bg-color : '.$data['header_color'].';
			  --btn-userbox-bg-color : '.$data['admin_dropdown'].';
			  --nav-active-bg-color : '.$data['sidebar_active_color'].';
			  --nav-active-shadow-color :#fff;
			  --nav-hover-bg-color : '.$data['sidebar_hover_color'].';
			  --card-header-bg-color : '.$data['modal_header'].';
			  --card-footer-bg-color : #fff;
			  --btn-primary-bg-color : '.$data['btn_primary'].';
			  --btn-default-bg-color : '.$data['btn_default'].';
			  --btn-secondary-bg-color : #6c757d;
			  --btn-danger-bg-color : '.$data['btn_danger'].';
			  --btn-success-bg-color : '.$data['btn_success'].';
			  --body-link-color : #3b3838;
			  --body-link-hover-color : #2851a3;
			}';
			if ( ! write_file($file_location, $new_file_data, 'r+')) {
			   	return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
}
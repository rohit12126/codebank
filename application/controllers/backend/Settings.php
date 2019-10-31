<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        if(superadmin_logged_in()===FALSE)
            redirect('behindthescreen');
    }
    // Show all setting options and update the options
    public function index() {
        $this->load->model('User_model');
        $options_data = $this->User_model->get_result('options', array('status' => 1));
        if($this->input->post()) {
            foreach ($options_data as $row) {
                if($row->option_id != 2 && $row->option_id != 20 && $row->option_id != 21 && $row->option_id != 22 && $row->option_id != 23) {
                    $this->form_validation->set_rules("".$row->option_name."","".$row->option_name."",'trim|required');
                    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                }
            }
            if ($this->form_validation->run() == TRUE) {
                foreach ($options_data as $row){
                    if($row->option_id != 22 && $row->option_id != 23) {
                        $post_data = array('option_value' => trim($_POST[$row->option_name]));
                        $this->User_model->update('options', $post_data,array('option_name' => $row->option_name));
                    } 
                }
                echo json_encode(array('status' => 'success', 'message' => $this->lang->line('success_message_setting_update'))); die;
            } else {
                echo json_encode(array('status' => 'error', 'message' => validation_errors())); die;
            }
        }
        $data['title'] =  $this->lang->line('title_message_settings');
        $data['options'] =  $options_data;
        $data['template'] = 'backend/settings';
        $this->load->view('template/backend/superadmin_template',$data);
    }
}


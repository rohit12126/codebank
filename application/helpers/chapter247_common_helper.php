<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	clear cache
*/
if ( ! function_exists('clear_cache')) {
	function clear_cache(){
		$CI =& get_instance();
		$CI->output->set_header('Expires: Wed, 11 Jan 1984 05:00:00 GMT' );
		$CI->output->set_header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . 'GMT');
		$CI->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");
		$CI->output->set_header("Pragma: no-cache");			
	}
}

/**
*   print_r for debugging
*/
if ( ! function_exists('p')) {
    function p($data){
        echo '<pre>'; print_r($data); echo '</pre>';
    }                    
}

/**
*	check superadmin logged in
*/
if(!function_exists('superadmin_logged_in')){
	function superadmin_logged_in(){
		$CI =& get_instance();
		$superadmin_info = $CI->session->userdata('superadmin_info');
		if($superadmin_info['logged_in']===TRUE && $superadmin_info['user_role']==1)
			return TRUE;
		else
			return FALSE;
	}
}
/**
*	get superadmin id
*/
if ( ! function_exists('superadmin_id')) {
	function superadmin_id(){
		$CI =& get_instance();
		$superadmin_info = $CI->session->userdata('superadmin_info');	
			return $superadmin_info['user_id'];		
	}
}
/**
*   check user logged in
*/
if(!function_exists('user_logged_in')){
    function user_logged_in(){
        $CI =& get_instance();
        $user_info = $CI->session->userdata('user_info');
        if($user_info['logged_in']===TRUE && $user_info['user_role']==0)
            return TRUE;
        else
            return FALSE;
    }
}
/**
*   get user id
*/
if ( ! function_exists('user_id')) {
    function user_id(){
        $CI =& get_instance();
        $user_info = $CI->session->userdata('user_info');       
            return $user_info['user_id'];        
    }
}

// Get superadmin details 
if ( ! function_exists('superadmin_details')) {
    function superadmin_details(){
        $CI =& get_instance();
        $superadmin_info = $CI->session->userdata('superadmin_info');   
        return $superadmin_info;     
        //print_r($superadmin_info); die();   
    }
}

// Get user details 
if ( ! function_exists('user_details')) {
    function user_details(){
        $CI =& get_instance();
        $user_info = $CI->session->userdata('user_info');   
        return $user_info;     
        //print_r($superadmin_info); die();   
    }
}
/**
*   get superadmin name
*/
if ( ! function_exists('superadmin_name')) { 
    function superadmin_name(){
        $CI =& get_instance();
        $superadmin_info = $CI->session->userdata('superadmin_info');
        if($superadmin_info['logged_in']===TRUE )
            return $superadmin_info['user_name'];
        else
            return FALSE;
    }                   
}
/**
*   get user name
*/
if ( ! function_exists('user_name')) { 
    function user_name(){
        $CI =& get_instance();
        $user_info = $CI->session->userdata('user_info');
        if($user_info['logged_in']===TRUE)
            return $user_info['user_name'];
        else
            return FALSE;
    }                   
}
/**
*   get user email
*/
if ( ! function_exists('user_email')) { 
    function user_email(){
        $CI =& get_instance();
        $user_info = $CI->session->userdata('user_info');
        if($user_info['logged_in']===TRUE)
            return $user_info['email'];
        else
            return FALSE;
    }                   
}

/**	
* backend message alert 
*/
if ( ! function_exists('msg_alert')) {
    function msg_alert(){
        $CI =& get_instance();
        if($CI->session->flashdata('msg_success')): ?>    
        <script>
            $('.notifyjs-corner').empty();
            /*$.notify("<?php //echo $CI->session->flashdata('msg_success'); ?>", "success");*/
            $.notify({
                icon: "<?php echo base_url('assets/backend/img/alert-icons/alert-checked.svg'); ?>",
                title: "",
                message: "<?php echo $CI->session->flashdata('msg_success'); ?>"            
            },{
                icon_type: 'image',
                type: 'success',
                allow_duplicates: false
            });

        </script>
        <?php endif;
        if($CI->session->flashdata('msg_info')): ?>   
        <script>
            $('.notifyjs-corner').empty();
            /*$.notify("<?php //echo $CI->session->flashdata('msg_info'); ?>", "info");*/
            $.notify({
                icon: "<?php echo base_url('assets/backend/img/alert-icons/alert-checked.svg'); ?>",
                title: "",
                message: "<?php echo $CI->session->flashdata('msg_info'); ?>"           
            },{
                icon_type: 'image',
                type: 'success',
                allow_duplicates: false
            });
        </script>
        <?php endif;
        if($CI->session->flashdata('msg_warning')): ?>    
        <script>
            $('.notifyjs-corner').empty();
            /*$.notify("<?php //echo $CI->session->flashdata('msg_warning'); ?>", "warn");*/
            $.notify({
                icon: "<?php echo base_url('assets/backend/img/alert-icons/alert-danger.svg'); ?>",
                title: " ",
                message: "<?php echo $CI->session->flashdata('msg_warning'); ?>"

            },{
                icon_type: 'image',
                type: 'warning',
                allow_duplicates: false
            });
        </script>
        <?php endif;
        if($CI->session->flashdata('msg_error')): ?>  
        <script>
            $('.notifyjs-corner').empty();  
            $.notify({
                icon: "<?php echo base_url('assets/backend/img/alert-icons/alert-disabled.svg'); ?>",
                title: " ",
                message: "<?php echo $CI->session->flashdata('msg_error'); ?>"

            },{
                icon_type: 'image',
                type: 'danger',
                allow_duplicates: false
            });
        </script>
        <?php endif;
    }                 
}
/** 
* Bootstrap message alert 
*/
if ( ! function_exists('message_alert')) {
    function message_alert(){
        $CI =& get_instance();
        if($CI->session->flashdata('message_success')): ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $CI->session->flashdata('message_success'); ?>
            </div>
        <script>
        <?php endif;
        if($CI->session->flashdata('message_info')): ?>   
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $CI->session->flashdata('message_info'); ?>
            </div>
        <?php endif;
        if($CI->session->flashdata('message_warning')): ?>
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $CI->session->flashdata('message_warning'); ?>
            </div>
        <?php endif;
        if($CI->session->flashdata('message_error')): ?>  
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $CI->session->flashdata('message_error'); ?>
            </div>
        <?php endif;
    }                 
}
/**
* CI pagination for backend 
*/
if ( ! function_exists('backend_pagination')) {
    function backend_pagination(){
        $data = array();        
        $data['full_tag_open'] = '<ul class="pagination clearfix">';        
        $data['full_tag_close'] = '</ul>';
        $data['first_tag_open'] = '<li>';
        $data['first_tag_close'] = '</li>';
        $data['num_tag_open'] = '<li>';
        $data['num_tag_close'] = '</li>';
        $data['last_tag_open'] = '<li>';
        $data['last_tag_close'] = '</li>';
        $data['next_link'] = '&gt;';
        $data['next_tag_open'] = '<li>';
        $data['next_tag_close'] = '</li>';
        $data["prev_link"] = "&lt;";
        $data['prev_tag_open'] = '<li>';
        $data['prev_tag_close'] = '</li>';
        $data['cur_tag_open'] = '<li class="active"><a data-ci-pagination-page="1" href="#/1">';
        $data['cur_tag_close'] = '</a></li>';
        $data["num_tag_open"] = '<li>';
        $data["num_tag_close"] = "</li>";
        return $data;
    }                   
}
/**
*   Change format of give date
*/
if (!function_exists('change_date_format')) {
    function change_date_format($date, $format = 'Y-m-d') {
        if($date) {
            if($date > 0) {
                $newDate = date($format, strtotime($date));
                return $newDate;
            }
            else {
                return '';
            }
        }
        else {
            return '';
        }
    }
}
/**
*   upload files
*/
function to_upload_image($image = '', $folder = '', $type = 'pdf|gif|jpg|jpeg|png|txt|docx|doc', $name = true) {
    $CI = & get_instance();
    $CI->load->library('upload');
    $new_name = date("YmdHis");
    // echo $dirPath = IMAGEUPLOADPATH . $folder . '/';
    $dirPath = $folder;
    $config['upload_path'] = $dirPath;
    // $config['allowed_types'] = 'pdf|gif|jpg|jpeg|png|txt|docx|doc';
    $config['allowed_types'] = $type;
    $config['max_size'] = "4096";   //4MB
    $config['max_width'] = '0';
    $config['max_height'] = '0';
    if($name) {
        $config['file_name'] = $new_name;
    }
    $CI->upload->initialize($config);
    if (!$CI->upload->do_upload($image)) {
        $error = $CI->upload->display_errors();
        return array('error' => $error);
        // return 'error';
    }
    $imageData = $CI->upload->data();
    if (is_array($imageData)) {
        // print_r($imageData);
        return $imageData['file_name'];
    }
}
/**
*   Send email
*/
if ( ! function_exists('sendEmail')) {  
    function sendEmail($to='', $param='') {
        $CI =& get_instance();
        $CI->load->library('parser');
        $CI->load->library('email');
        if(!empty($to)){
            $template = $CI->crud->readData('*', 'email_templates', array('email_template_id' => $param['template_id']))->row_array();
            if($template) {
                $html = $CI->load->view('template/email/'.$template['template_layout'], array('email_message' => $template['template_body']), true);
                $param['data']['site_name'] = SITE_NAME;
                $string = $CI->parser->parse_string($html, $param['data'], true);
                // die();
                if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.2.137') {
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'ssl://smtp.gmail.com'; //change this
                    $config['smtp_port'] = '465';
                    $config['smtp_user'] = 'test.chapter247@gmail.com'; //change this
                    $config['smtp_pass'] = 'chapter247@@'; //change this
                }
                
                $config['mailtype']  = 'html';
                // $config['charset']  = 'iso-8859-1';
                $config['charset']  = 'UTF-8';
                $config['wordwrap']  = TRUE;
                $config['newline']  = "\r\n";
                /*$config['mailtype']  = 'html';
                $config['charset']  = 'iso-8859-1';*/
        //      $config['wordwrap']  = TRUE;
        //      $config['newline']  = "\r\n";
                $CI->email->initialize($config);
                $CI->email->from(NO_REPLY_EMAIL, NO_REPLY_EMAIL_FROM_NAME);
                $CI->email->to($to);
                // $CI->email->cc('another@another-example.com');
                // $CI->email->bcc('them@their-example.com');
                $CI->email->subject($template['template_subject']);
                $CI->email->message(utf8_encode($string));
                $CI->email->set_crlf( "\r\n" );
                if($CI->email->send()) {
                    return "";
                }
                else {
                    // print_r($CI->email->print_debugger());
                    return "Something went wrong";
                }
                // return $string;
            }
            else {
                return "Invalid template id";
            }
        }
        return "Something went wrong";
    }
}
/**
*   show member ship type
*/
function membership_type($type='') {
    $array = array('Select Subscription Plan', 'Monthly', 'Forever');
    if($type != '') {
        if($type == 0) {
            return "N/A";
        }
        else {
            if (isset($array[$type])) {
                return $array[$type];
            }
            else {
                return '';
            }
        }
    }
    else {
        return $array;
    }
}
/**
*   show membership status
*/
function membership_status($type='') {
    $array = array(
        '0' => 'Expired',
        '1' => 'Active',
        '2' => 'Cancelled',
        '3' => 'Expired',
    );
    if($type != '') {
        if (isset($array[$type])) {
            return $array[$type];
        }
        else {
            return '';
        }
    }
    else {
        return $array;
    }
}
/**
*   get last executed query for debugging
*/
function lq() {
    $CI = & get_instance();
    echo $CI->db->last_query();
    die();
}
/**
*   get setting option row
*/
if ( ! function_exists('get_option_url')) {
    function get_option_url($option_name){  
        $CI =& get_instance();      
         if($query = $CI->crud->readData('*', 'options',array('option_name'=>$option_name))->row())
            return $query->option_value;
         else
            return false;
    }
}
/**
*   get icons or file
*/
function file_get_contents_curl($url) {
   if(file_exists($url)) {
        $url = base_url($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
        // echo base_url();
        // return file_get_contents($url);
   }
   else {
       return '';
   }
}

/**
*   convert time to human-readable format
*/
function time_elapsed_string($time) {
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
/**
*   generate random string
*/
function random_strings($length_of_string) {
    // String of all alphanumeric character 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
    // Shufle the $str_result and returns substring 
    // of specified length 
    return substr(str_shuffle($str_result), 0, $length_of_string);
} 

/**
*   get notification data.
*/
function open_notifications() {
    $response = array();
    $CI =& get_instance();
    $data = $CI->crud->readData('notification_id, name, question, comment, notifications.created_on, notifications.status, notifications.exam_id, notifications.section_id, notifications.question_id', 'notifications', array('is_read' => 0), array('users' => 'notifications.user_id = users.user_id', 'questions' => 'notifications.question_id = questions.question_id'), 'notification_id')->num_rows();
    return $data;
}
/**
*   converts seconds to time h:m:s.
*/
function second_to_date($seconds = '') {
    $s = $seconds;
    $h = floor($s / 3600);
    $s -= $h * 3600;
    $m = floor($s / 60);
    $s -= $m * 60;
    return $h.':'.sprintf('%02d', $m).':'.sprintf('%02d', $s);
}
/**
*   converts string characters to HTML entities.
*/
function my_htmlentities($array) {
    if(is_array($array)) {
        foreach ($array as $key => $value) {
            $array[$key] = htmlentities($value);
        }
    }
    return $array;
}
/**
*   Show graph colour
*/
function graph_color($type = 0) {
     $array = array('01829E','2593AB','44A2B7','5EAFC1','75BAC9','8CC5D2', 'ACD5DE', 'C3E1E7', 'D4E9ED', 'E0EFF2', 'E8F3F5', 'EEF6F7', '8A2BE2', 'DE5D83', 'CD7F32', '964B00', '702963', '960018','99CBD6');
    return $array[$type];
}
/**
*   remove spacial character from give string
*/
function remove_special_character($array) {
    foreach ($array as $key => $value) {
        $line = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $value);
        $array[$key] = $line;
    }
    return $array;
}
/**
*   show support subject
*/
if ( ! function_exists('support_subject')) {  
    function support_subject($type = '') {
        $array = array('Support', 'Subscriptions', 'Payments', 'User Account', 'Other');
        if($type != '') {
            return $array[$type];
        }
        else {
            return $array;
        }
    }
}
/**
*   show contact us subject
*/
if ( ! function_exists('contact_subject')) {  
    function contact_subject($type = '') {
        $array = array('Support', 'Subscriptions', 'Payments', 'User Account', 'Other');
        if($type != '') {
            return $array[$type];
        }
        else {
            return $array;
        }
    }
}
/**
*   common status
*/
if ( ! function_exists('status')) {  
    function status($type = '') {
        $array = array('Inactive', 'Active');
        if($type != '') {
            return $array[$type];
        }
        else {
            return $array;
        }
    }
}
/**
*   for support status 
*/
if ( ! function_exists('support_status')) {  
    function support_status($type = '') {
        $array = array('Close', 'Open');
        if($type != '') {
            return $array[$type];
        }
        else {
            return $array;
        }
    }
}
/**
*   for Mail status 
*/
if ( ! function_exists('mail_status')) {  
    function mail_status($type = '') {
        $array = array('No', 'Yes');
        if($type != '') {
            return $array[$type];
        }
        else {
            return $array;
        }
    }
}
/**
*   for email template 
*/
if ( ! function_exists('email_template_layout')) {  
    function email_template_layout($type = '') {
        $array = array('default' => 'Default', 'layout1' => 'Layout1', 'layout2' => 'Layout2', 'layout3'=> 'Layout3');
        if($type != '') {
            return $array[$type];
        }
        else {
            return $array;
        }
    }
}

/**
* Create Thumbnails
*/
//create_thumb($dir.'check/'.$name, './assets/uploads/thumbnail/'.$nameThumb, 100,100);
if(!function_exists('create_thumb')){
    function create_thumb($path, $target_path, $new_w = 254, $new_h = 254){
        /* read the source image */
        $source_image = FALSE;
        $sourcePathinfo   = getimagesize($path);
        $mime = isset($sourcePathinfo['mime']) ? $sourcePathinfo['mime'] : '';
        switch(strtolower($mime)) {
            case 'image/gif':
                $source_image = imagecreatefromgif($path);
                break;
            case 'image/png':
                $source_image = imagecreatefrompng($path);
                break;
            case 'image/jpeg':
                $source_image = imagecreatefromjpeg($path);
                break;
        }
        $thumb_width  = $new_w;
        $thumb_height = $new_h;

        $width  = imagesx($source_image);
        $height = imagesy($source_image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ( $original_aspect >= $thumb_aspect ) {
           // If image is wider than thumbnail (in aspect ratio sense)
           $new_height = $thumb_height;
           $new_width = $width / ($height / $thumb_height);
        } else {
           // If the thumbnail is wider than the image
           $new_width = $thumb_width;
           $new_height = $height / ($width / $thumb_width);
        }
        $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
        // Resize and crop
        imagecopyresampled($thumb,$source_image, 0 - ($new_width - $thumb_width) / 2,  0 - ($new_height - $thumb_height) / 2, 0, 0,$new_width, $new_height,$width, $height);
        switch(strtolower($mime)) {
            case 'image/gif':
                if (@imagegif($thumb, $target_path)) {
                    imagedestroy($thumb);
                    imagedestroy($source_image);
                }
            break;
            case 'image/png':
                if (@imagepng($thumb, $target_path, 6)) {
                    imagedestroy($thumb);
                    imagedestroy($source_image);
                }
            break;
            case 'image/jpeg':
                if (@imagejpeg($thumb, $target_path, 90)) {
                    imagedestroy($thumb);
                    imagedestroy($source_image);
                }
            break;
        }
    }
}

/**
*   For image compress/resize
*/
//resize_image($dir.'check/','./assets/uploads/', $name);
if ( ! function_exists('resize_image')) {
    function resize_image( $source, $target, $image_name, $width_new = 0, $height_new = 0) {

        $sourcePath = $source . $image_name;
        $targetPath = $target . $image_name;

        $sourcePathinfo   = getimagesize($sourcePath);
        list($w,$h,$type) = getimagesize($sourcePath);
        
        $file_size = filesize($sourcePath); 
        $file_size = $file_size / 1024; 
        
        if( ($file_size < 50) && ($width_new == 0) && ($height_new == 0) ){
            copy($sourcePath, $targetPath);
            return true;
        }

            $mime = isset($sourcePathinfo['mime']) ? $sourcePathinfo['mime'] : '';
            switch(strtolower(image_type_to_mime_type($type))) {
                case 'image/gif':
                    $originalImage = imagecreatefromgif($sourcePath);
                    break;
                case 'image/png':
                    $originalImage = imagecreatefrompng($sourcePath);
                    break;
                case 'image/jpeg':
                    $originalImage = imagecreatefromjpeg($sourcePath);
                    break;
                default:
                    return false;
                    break;
            }

            $width          =   $sourcePathinfo[0];
            $height         =   $sourcePathinfo[1];
            $set=0;
            if( ($width_new == 0) && ($height_new == 0)){
                if($width > 1600 || $height > 900){
                    $width_new  = 1248;
                    $height_new = 734;
                }else{
                    /*in case coping (without maintaing ratio)*/
                    $thumbWidth    =   $width;
                    $thumbHeight   =   $height;
                    $set=1;
                }
            }
            /*maintaing Ratio of Image */
            if($set == 0){
            //this code is for maintain near aspect ratio
            if($width > $height) {
                $ratio = $height / $width;
                $height_new = $width_new * $ratio;
                
                $thumbWidth    =   $width_new;
                $thumbHeight   =   $height_new;
            }

            if($width < $height) {
                $ratio = $width / $height;
                $width_new = $height_new * $ratio;
                
                $thumbWidth    =  $width_new;
                $thumbHeight   =  $height_new;
            }

            if($width == $height) {
              if ($height_new < $width_new) {
                    
                    $ratio = $height / $width;
                    $height_new = $width_new * $ratio;
                 
                    $thumbWidth    =  $width_new;
                    $thumbHeight   =  $height_new;
                } else if ($newHeight > $newWidth) {

                    $ratio = $width / $height;
                    $width_new = $height_new * $ratio;
                
                    $thumbWidth    =  $width_new;
                    $thumbHeight   =  $height_new;
                } else {
                    // *** Sqaure being resized to a square
                $thumbWidth    =  $width_new;
                $thumbHeight   =  $height_new;
            }
          }
        }
        /*maintaing Ratio of Image */
        $thumbImage  =   ImageCreateTrueColor($thumbWidth,$thumbHeight);
        if ($mime == 'image/png') {
            if( ($width_new > 0) && ($height_new > 0)){
                imagealphablending($thumbImage, false);
                imagesavealpha($thumbImage, true);
                $background = imagecolorallocatealpha($thumbImage, 255, 255, 255, 127);
                imagecolortransparent($thumbImage, $background);
            }
        } else {
            $background = imagecolorallocate($thumbImage, 255, 255, 255);
        }
        imagecopyresampled($thumbImage,$originalImage,0,0,0,0,$thumbWidth,$thumbHeight,$width,$height);
        switch(strtolower(image_type_to_mime_type($type))) {
            case 'image/gif':
                    imagegif($thumbImage,$targetPath);
            break;
            case 'image/png':
                    $quality = ($file_size > 200) ? 5 : 1;
                    imagepng($thumbImage,$targetPath,$quality);
            break;
            case 'image/jpeg':
                if( ($thumbWidth  > 254) || ($thumbHeight > 254) ){
                        $quality = ($file_size > 200) ? 50 : 90;
                }else{
                        $quality = 100;
                }
                imagejpeg($thumbImage,$targetPath,$quality);
            break;
            default:
            return false;
            break;
        }
    }
}
/**
* Upload file
*/
//upload_file('file', $upload_path, 'pdf|gif|jpg|jpeg|png');
if ( ! function_exists('upload_file')) {
    function upload_file($image = '', $folder = '', $type = 'pdf|gif|jpg|jpeg|png|txt|docx|doc', $name = true) {
        $CI = & get_instance();
        $CI->load->library('upload');
        $new_name = date("YmdHis");
        $dirPath = $folder;
        $config['upload_path'] = $dirPath;
        $config['allowed_types'] = $type;
        $config['max_size']   = "1000000";
        $config['max_width']  = '0';
        $config['max_height'] = '0';
        if($name) {
            $config['file_name'] = $new_name;
        }
        $CI->upload->initialize($config);
        if (!$CI->upload->do_upload($image)) {
            $error = $CI->upload->display_errors();
            return array('error' => $error);
        }
        $imageData = $CI->upload->data();
        if (is_array($imageData)) {
            return $imageData['file_name'];
        }
    }
}
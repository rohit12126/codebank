<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$config = array(
	'login' => array(
		array(
			'field' => 'email',
			'label' => 'Email Address',
			'rules' => 'trim|required|valid_email',
			'errors'=> array(
                'required'    => $CI->lang->line('error_email_required'),
            ),
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_password_required'),
            ),
		),
	),

	'forgot_password' => array(
		array(
			'field' => 'email',
			'label' => 'Email Address',
			'rules' => 'trim|required|valid_email',
            'errors'=> array(
                'required'    => $CI->lang->line('error_email_required'),
                'valid_email' => $CI->lang->line('error_email_invalid'),
            ),
		),
	),
	'resetpassword' => array(
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required|min_length[6]|max_length[20]',
			'errors'=> array(
                'required'    => $CI->lang->line('error_password_required'),
            ),
		),
		array(
			'field' => 'con_pass',
			'label' => 'Confirm Password',
			'rules' => 'trim|required|matches[password]',
			'errors'=> array(
                'required' => $CI->lang->line('error_confirm_password_required'),
                'matches[password]' => $CI->lang->line('error_confirm_password_match'),
            ),
		),
	),

	'profile_change' => array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'required|trim|max_length[50]',
			'errors'=> array(
                'required'    => $CI->lang->line('error_name_required'),
            ),
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|max_length[50]|valid_email',
			'errors'=> array(
                'required'    => $CI->lang->line('error_email_required'),
                'valid_email' => $CI->lang->line('error_email_invalid'),
            ),
		),
	),

	'change_password' => array(
		array(
			'field' => 'old_password',
			'label' => 'Old password',
			'rules' => 'required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_old_password_required'),
            ),
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|trim|min_length[6]|max_length[20]',
			'errors'=> array(
                'required'    => $CI->lang->line('error_new_password_required'),
            ),
		),
		array(
			'field' => 'con_pass',
			'label' => 'Confirm password',
			'rules' => 'trim|required|matches[password]',
			'errors'=> array(
                'required' => $CI->lang->line('error_confirm_password_required'),
                'matches' => $CI->lang->line('error_confirm_password_match'),
            ),
		),
	),

	'page_template_edit' => array(
		array(
			'field' => 'page_id',
			'label' => 'page_id',
			'rules' => 'required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_message_page_id'),
            ),
		),
		array(
			'field' => 'title',
			'label' => 'Page Title',
			'rules' => 'trim|required|max_length[50]',
			'errors'=> array(
                'required'    => $CI->lang->line('error_message_page_title'),
                'max_length'  => $CI->lang->line('error_message_page_title_max_length'),
            ),
		),
		/*array(
			'field' => 'description',
			'label' => 'Page Body',
			'rules' => 'required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_message_page_body'),
            )
		)*/
	),

	'faq_edit' => array(
		array(
			'field' => 'faq_id',
			'label' => 'FAQ ID',
			'rules' => 'required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_message_faq_id_required'),
            ),
		),
		array(
			'field' => 'question',
			'label' => 'Question',
			'rules' => 'trim|required|max_length[100]',
			'errors'=> array(
                'required'    => $CI->lang->line('error_message_faq_que_required'),
                'max_length'  => $CI->lang->line('error_message_faq_que_max_length'),
            )
		),
		array(
			'field' => 'answer',
			'label' => 'Answer',
			'rules' => 'required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_message_faq_ans_required'),
            ),
		),
		array(
			'field' => 'order_by',
			'label' => 'Order By',
			'rules' => 'trim|required|numeric',
			'errors'=> array(
                'required' => $CI->lang->line('error_message_faq_orderby_required'),
                'numeric'  => $CI->lang->line('error_message_faq_orderby_numeric'),
            ),
		),
	),

	'faq_add' => array(
		array(
			'field' => 'question',
			'label' => 'Question',
			'rules' => 'trim|required|max_length[100]',
			'errors'=> array(
                'required'    => $CI->lang->line('error_message_faq_que_required'),
                'max_length'  => $CI->lang->line('error_message_faq_que_max_length'),
            ),
		),
		array(
			'field' => 'answer',
			'label' => 'Answer',
			'rules' => 'required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_message_faq_ans_required'),
            )
		),
		array(
			'field' => 'order_by',
			'label' => 'Order By',
			'rules' => 'trim|required|numeric',
			'errors'=> array(
                'required' => $CI->lang->line('error_message_faq_orderby_required'),
                'numeric'  => $CI->lang->line('error_message_faq_orderby_numeric'),
            ),
		),
	),

	'support_reply' => array(
		array(
			'field' => 'support_id',
			'label' => 'support id',
			'rules' => 'required',
			'errors'=> array(
                'required' => $CI->lang->line('error_message_support_id'),
            ),
		),
		array(
			'field' => 'reply',
			'label' => 'Comment',
			'rules' => 'trim|required',
			'errors'=> array(
                'required' => $CI->lang->line('error_message_support_comment'),
            ),
		),
	),

	'email_template_edit' => array(
		array(
			'field' => 'id',
			'label' => 'Template id',
			'rules' => 'required',
			'errors'=> array(
                'required' => $CI->lang->line('error_message_email_template_id_required'),
            ),
		),
		array(
			'field' => 'template_name',
			'label' => 'Template Title',
			'rules' => 'trim|required|max_length[50]',
			'errors'=> array(
                'required'   => $CI->lang->line('error_message_email_template_title_required'),
                'max_length' => $CI->lang->line('error_message_email_template_max_length'),
            ),
		),
		array(
			'field' => 'template_subject',
			'label' => 'Template Subject',
			'rules' => 'trim|required|max_length[50]',
			'errors'=> array(
                'required'   => $CI->lang->line('error_message_email_template_subject_required'),
                'max_length' => $CI->lang->line('error_message_email_template_subject_max_length'),
            ),
		),
		array(
			'field' => 'template_layout',
			'label' => 'Template Layout',
			'rules' => 'trim|required',
			'errors'=> array(
                'required' => $CI->lang->line('error_message_email_template_layout_required'),
            ),
		),
		array(
			'field' => 'template_body',
			'label' => 'Email Template Body',
			'rules' => 'trim|required',
			'errors'=> array(
                'required' => $CI->lang->line('error_message_email_template_body_required'),
            ),
		),
	),

	'admin_change_password' => array(
		array(
			'field' => 'oldpassword',
			'label' => 'Old password',
			'rules' => 'required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_old_password_required'),
            ),
		),
		array(
			'field' => 'newpassword',
			'label' => 'Password',
			'rules' => 'required|trim|min_length[6]|max_length[20]',
			'errors'=> array(
                'required'    => $CI->lang->line('error_new_password_required'),
                'min_length' => $CI->lang->line('error_password_minlength')
            ),
		),
		array(
			'field' => 'confpassword',
			'label' => 'Confirm password',
			'rules' => 'trim|required|matches[newpassword]',
			'errors'=> array(
                'required' => $CI->lang->line('error_confirm_password_required'),
                'matches' => $CI->lang->line('error_confirm_password_match'),
            ),
		),
	),

	'admin_profile' => array(
		array(
			'field' => 'first_name',
			'label' => 'First Name',
			'rules' => 'required|max_length[20]',
			'errors'=> array(
                'required' => $CI->lang->line('error_first_name_required'),
                'max_length' => $CI->lang->line('error_first_name_max_length'),
            ),
		),
		array(
			'field' => 'last_name',
			'label' => 'Last Name',
			'rules' => 'max_length[20]',
			'errors'=> array(
                'required' => $CI->lang->line('error_last_name_required'),
                'max_length' => $CI->lang->line('error_last_name_max_length'),
            ),
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|max_length[50]|valid_email',
			'errors'=> array(
                'required'    => $CI->lang->line('error_email_required'),
                'valid_email' => $CI->lang->line('error_email_invalid'),
                'max_length' => $CI->lang->line('error_email_max_length'),
            ),
		),
	),

	'admin_login' => array(
		array(
			'field' => 'email',
			'label' => 'Email Address',
			'rules' => 'trim|required|valid_email',
			'errors'=> array(
                'required'    => $CI->lang->line('error_email_required'),
                'valid_email' => $CI->lang->line('error_email_invalid'),
            ),
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_password_required'),
            ),
		),
	),

	'theme_settings' => array(
		array(
			'field' => 'sidebar_color',
			'label' => 'sidebar color',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_sidebar_color_required'),
            ),
		),
		array(
			'field' => 'header_color',
			'label' => 'header color',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_header_color_required'),
            ),
		),
		array(
			'field' => 'sidebar_active_color',
			'label' => 'sidebar active color',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_sidebar_active_color_required'),
            ),
		),
		array(
			'field' => 'admin_dropdown',
			'label' => 'admin dropdown color',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_admin_dropdown_required'),
            ),
		),
		array(
			'field' => 'sidebar_hover_color',
			'label' => 'sidebar hover color',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_sidebar_hover_color_required'),
            ),
		),
		array(
			'field' => 'btn_primary',
			'label' => 'sidebar hover color',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_btn_primary_required'),
            ),
		),

		array(
			'field' => 'btn_default',
			'label' => 'default button color',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_btn_default_required'),
            ),
		),

		array(
			'field' => 'btn_danger',
			'label' => 'danger button color',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_btn_danger_required'),
            ),
		),
		array(
			'field' => 'btn_success',
			'label' => 'Success button color',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_btn_success_required'),
            ),
		),
		array(
			'field' => 'modal_header',
			'label' => 'modal/popup header color',
			'rules' => 'trim|required',
			'errors'=> array(
                'required' => $CI->lang->line('error_modal_header_required'),
            ),
		),
	),
	'contact_us' => array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|required|max_length[50]',
			'errors'=> array(
                'required' => $CI->lang->line('error_contact_name_required'),
                'max_length' => $CI->lang->line('error_contact_name_max_length'),
            ),
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|max_length[50]',
			'errors'=> array(
                'required'   => $CI->lang->line('error_contact_email_required'),
                'valid_email'=> $CI->lang->line('error_contact_email_valid'),
                'max_length' => $CI->lang->line('error_contact_email_max_length'),
            ),
		),
		array(
			'field' => 'subject',
			'label' => 'Subject',
			'rules' => 'trim|required',
			'errors'=> array(
                'required'    => $CI->lang->line('error_contact_subject_required'),
            ),
		),
		array(
			'field' => 'contact_number',
			'label' => 'Contact number',
			'rules' => 'is_natural|max_length[15]',
			'errors'=> array(
                'max_length' => $CI->lang->line('error_contact_max_length'),
                'is_natural' => $CI->lang->line('error_contact_number_is_numeric'),
            ),
		),
		array(
			'field' => 'message',
			'label' => 'Message',
			'rules' => 'trim|required|max_length[250]',
			'errors'=> array(
				'required'   => $CI->lang->line('error_contact_message_required'),
                'max_length' => $CI->lang->line('error_contact_message_max_length'),
            ),
		),
	),
);
?>
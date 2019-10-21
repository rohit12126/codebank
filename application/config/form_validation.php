<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
	'login' => array(
		array(
			'field'  => 'email',
			'label'  => 'Email Address',
			'rules'  => 'trim|required',
			'errors' => array(
                'required' => 'You must provide a %s.',
            ),
		),
		array(
			'field'  => 'password',
			'label'  => 'Password',
			'rules'  => 'trim|required',
			'errors' => array(
                'required' => 'You must provide a %s.',
            ),
		),
	),
	'forgot_password' => array(
		array(
			'field'  => 'email',
			'label'  => 'Email Address',
			'rules'  => 'trim|required|valid_email',
			'errors' => array(
                'required'    => 'You must provide a %s.',
                'valid_email' => 'Invalid email address',
            ),
		),
	),
	'resetpassword' => array(
		array(
			'field'  => 'password',
			'label'  => 'Password',
			'rules'  => 'trim|required|min_length[6]|max_length[20]',
		),
		array(
			'field'  => 'con_pass',
			'label'  => 'Confirm Password',
			'rules'  => 'trim|required|matches[password]',
		),
	),
	'profile_change' => array(
		array(
			'field'  => 'name',
			'label'  => 'Name',
			'rules'  => 'required|trim|max_length[50]',
			'errors' => array(
                'required'    => 'You must provide a %s.',
            ),
		),
		array(
			'field'  => 'email',
			'label'  => 'Email',
			'rules'  => 'trim|required|max_length[50]|valid_email',
			'errors' => array(
                'required'    => 'You must provide a %s.',
                'valid_email' => 'Invalid email address.',
            ),
		),
	),
	'change_password' => array(
		array(
			'field'  => 'old_password',
			'label'  => 'Old password',
			'rules'  => 'required',
			'errors' => array(
                'required'    => 'You must provide a %s.',
            ),
		),
		array(
			'field'  => 'password',
			'label'  => 'Password',
			'rules'  => 'required|trim|min_length[6]|max_length[20]',
			'errors' => array(
                'required'    => 'You must provide a %s.',
            ),
		),
		array(
			'field'  => 'con_pass',
			'label'  => 'Confirm password',
			'rules'  => 'trim|required|matches[password]',
		),
	),

	'faq_edit' => array(
		array(
			'field'  => 'faq_id',
			'label'  => 'FAQ ID',
			'rules'  => 'required',
		),
		array(
			'field'  => 'question',
			'label'  => 'Question',
			'rules'  => 'trim|required|max_length[100]',
		),
		array(
			'field'  => 'answer',
			'label'  => 'Answer',
			'rules'  => 'required',
		),
		array(
			'field'  => 'order_by',
			'label'  => 'Order By',
			'rules'  => 'trim|required|numeric',
		),
	),

	'faq_add' => array(
		array(
			'field'  => 'question',
			'label'  => 'Question',
			'rules'  => 'trim|required|max_length[100]',
		),
		array(
			'field'  => 'answer',
			'label'  => 'Answer',
			'rules'  => 'required',
		),
		array(
			'field'  => 'order_by',
			'label'  => 'Order By',
			'rules'  => 'trim|required|numeric',
		),
	),
);
?>

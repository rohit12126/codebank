<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
	// Insert data using table name and data array.
	public function insert($table_name='',  $data=''){
		$query=$this->db->insert($table_name, $data);
		 //$this->db->last_query(); die();
		if($query)
			$this->db->insert_id(); 
		else
			return FALSE;		
	}
	// Get data as multiple row of a table.
	public function get_result($table_name='', $id_array='',$columns=array()){
		if(!empty($columns)):
			$all_columns = implode(",", $columns);
			$this->db->select($all_columns);
		endif; 
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;		
		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}
	// Get data as single row of a table.
	public function get_row($table_name='', $id_array='',$columns=array()){
		if(!empty($columns)):
			$all_columns = implode(",", $columns);
			$this->db->select($all_columns);
		endif; 
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;
		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}
	//update data of a table
	public function update($table_name='', $data='', $id_array=''){
		if(!empty($id_array)):
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;
		return $this->db->update($table_name, $data);		
	}
	// delete row of a table
	public function delete($table_name='', $id_array=''){		
	 	return $this->db->delete($table_name, $id_array);
	}

	// User login
	public function login($email,$password,$user_type=FALSE){	
        if($user_type=='superadmin'){
			$ur = 0;
		}else if($user_type=='seller'){
			$ur = 1;
		}else if($user_type=='customers'){
			$ur = 2;
		}
		$data  = array('email'=>$email,'user_role'=>$ur);

		$query_get = $this->db->get_where('users',$data);
		$count = $query_get->num_rows(); 
		$res = $query_get->row_array();
		$salt = $res['salt'];
		if($count==1){
			$query = "SELECT * FROM `users` WHERE `email` ='".$email."' AND `password` = '".sha1($salt.sha1($salt.sha1($password)))."' AND `user_role` = '".$ur."'";
			$sql= $this->db->query($query);
			$check_count = $sql->num_rows();
			$result = $sql->row();
			if($check_count == 1)
			{
				//p('fdsFD'); die;
				if($result->status==1){
                    $user_id=$sql->row()->user_id;
					$user_data = array(
						'user_id' 			=> $sql->row()->user_id,
						'user_role' 	=> $sql->row()->user_role,
						'email'			=> $sql->row()->email,
						'user_name' 	=> $sql->row()->user_name,
						'phone_no' 		=> $sql->row()->phone_no,
						'logged_in' 	=> TRUE
					);

					if($user_type=='superadmin'){
						$this->session->unset_userdata('superadmin_info');
						$this->session->set_userdata('superadmin_info',$user_data);
					}else if($user_type=='seller'){

						$this->session->unset_userdata('seller_info');
						$this->session->set_userdata('seller_info',$user_data);

						$selleradmin_name = ucwords(selleradmin_name());
						$this->session->set_flashdata('msg_success', 'Welcome '.$selleradmin_name.', You have logged in successfully');

						if(empty($result->skipped)) 
							redirect(base_url('seller/agreement_step/'.base64_encode($result->user_id)));

						if($result->confirmation_code!='verified') 
							redirect(base_url('seller/phone_verification/'.base64_encode($result->user_id)));

						if(!empty($result->skipped)){
							$skipped = json_decode($result->skipped);
							$status = $skipped->status;
							if($status==0){
								$lastPage = end($skipped->skipped_pages);
								redirect(base_url('seller/'.$lastPage.'/'.base64_encode($result->user_id)));
							}else{
								redirect(base_url('seller/dashboard'));
							}
						}	
					}else if($user_type=='customers'){

						$this->session->unset_userdata('user_info');

						$querys = "SELECT `shipping_address_id` FROM `shipping_addresess` WHERE `user_id` ='".$user_id."'";
				            $sqls= $this->db->query($querys);
				            $count_shiping_address = $sqls->num_rows();
				            $results = $sqls->row();
				            if($count_shiping_address>0){
				              $this->session->unset_userdata('shipping_address_id');
				              $this->session->set_userdata('shipping_address_id',$sqls->row()->shipping_address_id); 
				            }  
						$this->session->set_userdata('user_info',$user_data);
						// set wallet Amount in session 
				    // end
						/*---Store cart data in cart session--*/
						$this->setCartData($user_data['id']);
						$user_name = ucfirst(user_name());
						$this->session->set_flashdata('msg_success', 'Welcome '.$user_name.', You have logged in successfully');
					}
					return TRUE;

				}else{
					$this->session->set_flashdata('msg_error', 'Your account is not activated yet. Please contact administratorr');
					return FALSE;
				}
				
			}else{
				$this->session->set_flashdata('msg_error', 'Incorrect Email Or Password');
				return FALSE;
			}	
		}else{
			$this->session->set_flashdata('msg_error', 'Incorrect Email Or Password');
			return FALSE;
		}
	}
		
	// all user proxy login
	public function proxy_login($data=array()){	

		$query_get = $this->db->get_where('users',$data);
		$count = $query_get->num_rows();
		$res = $query_get->row_array();

		$status = $res['status'];
		$user_role = $res['user_role'];

		if($count==1){
			if($status==1){
				$user_data = array(
					'id' 				=> $res['user_id'],
					'user_role' 		=> $res['user_role'],
					'first_name' 		=> $res['first_name'],
					'last_name'			=> $res['last_name'],
					'email'				=> $res['email'],
					'last_ip' 			=> $res['last_ip'],
					'last_login' 		=> $res['last_login'],
					'user_name' 		=> $res['user_name'],
					'business_name' 	=> $res['business_name'],
					'confirmation_code' => $res['confirmation_code'],
					'mobile' 			=> $res['mobile'],
					'country_code' 		=> $res['country_code'],
					'logged_in' 		=> TRUE
				);
				return $user_data;
			}else{
				return FALSE;
			}	
		}else{
			return FALSE;
		}
	}
}
?>
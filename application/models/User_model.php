<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	public function add(){

		$salt = substr(md5(uniqid(rand(), true)), 0, 9);
		$data = array(
					'username'		=>$this->input->post('username'),
					'email'			=>$this->input->post('email'),
					'password'		=>sha1($salt . sha1($salt . sha1($this->input->post('password')))),
					'salt'			=>$salt,
					'firstname'		=>$this->input->post('firstname'),
					'lastname'		=>$this->input->post('lastname'),
					'status'		=>0,
					'date_created'	=>date('Y-m-d H:i:s')
				);

		//$this->db->trans_start();
		$this->db->insert('users',$data);
		//$this->db->trans_complete();
		
		/*if ($this->db->trans_status() === FALSE)
		{
		        // generate an error... or use the log_message() function to log your error
		}*/
	}


    public function login($username,$password)
    {
    	$user = $this->getUser($username);
    	if(!is_null($user)){
    		$salt = $user->salt;

    		$this->db->where("$username",$username);
    		$this->db->or_where("email",$username);
	        $this->db->where("password",sha1($salt . sha1($salt . sha1($password))));
	            
	        $query=$this->db->get("users");

	        if($query->num_rows()>0)
	        {
	         	foreach($query->result() as $rows)
	            {
	            	//add all data to session
	                $newdata = array(
                	   	'user_id' 		=> $rows->user_id,
	                    'logged_in' 	=> TRUE
                   );
				}
            	
            	$this->session->userdata = $newdata;

            	$this->cart_model->moveSessionToDB($rows->user_id);
                return true;            
			}
    	}
		
		return false;
    }

    public function getUser($username){
    	$this->db->where("$username",$username);
    	$this->db->or_where("email",$username);
    	$query=$this->db->get("users");
    	$row = $query->row();

    	return $row;
    }

    public function getUserByEmail($email){
    	$this->db->where("email",$email);
    	$query=$this->db->get("users");
    	$row = $query->row();

    	return $row;
    }

    public function logout(){
    	$newdata = array(
		'user_id'   =>'',
		'logged_in' => FALSE
		);
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
    }

    public function getUsers(){
    	$query=$this->db->get("users");
    	$result = $query->result();

    	return $result;
    }

    public function getUserById($user_id){
    	$this->db->where("user_id",$user_id);
    	$query=$this->db->get("users");
    	$row = $query->row();

    	return $row;
    }
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function register()
	{
		$data = array();
		if($this->user_model->isLoggedIn())
		{
			redirect('/', 'refresh');
		}
		else{
			$this->load->view('common/header',$data);
			$this->load->view("user/register", $data);
			$this->load->view('common/footer',$data);
		}
	}
	public function submit(){

		$this->load->library('form_validation');
		// field name, error message, validation rules
		// $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

		if($this->form_validation->run() == FALSE)
		{
			$this->register();
		}
		else
		{
			$this->user_model->add();
			$this->success();
		}
	}
	
	public function home(){
		redirect('/', 'refresh');
	}
	public function login()
	{
		if($this->user_model->isLoggedIn())
		{
			redirect('/', 'refresh');
		}
		else{
			if($this->input->post()){
				$username=$this->input->post('username');
				$password=$this->input->post('password');
				//var_dump($email);
				$result=$this->user_model->login($username,$password);
				if($result){
					$this->success();
					
				} 
				else{
					 $this->fail();
				}      
			}
			else{
				$this->load->view('common/header');
				$this->load->view("user/login");
				$this->load->view('common/footer');
			}	
		}
	}

	public function success(){
		//$this->load->view('welcome_message');
		redirect('/', 'refresh');
	}

	public function logout()
	{
		$this->user_model->logout();
		redirect('/', 'refresh');
	}

	public function fail(){
		echo 'fail';
	}
}
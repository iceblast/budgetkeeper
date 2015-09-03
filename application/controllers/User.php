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
		if($this->user_model->isLoggedIn())
		{
			redirect('/', 'refresh');
		}
		else{
			if($this->input->post()){
				$this->load->library('form_validation');

				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
				$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

				if($this->form_validation->run() == FALSE)
				{
					$this->load->view('common/header');
					$this->load->view('user/register');
					$this->load->view('common/footer');
				}
				else
				{
					$this->user_model->add();
					$this->success();
				}      
			}
			else{
				$this->load->view('common/header');
				$this->load->view('user/register');
				$this->load->view('common/footer');
			}	
		}
	}
	
	public function login()
	{
		if($this->user_model->isLoggedIn())
		{
			redirect('/');
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
		redirect('/');
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
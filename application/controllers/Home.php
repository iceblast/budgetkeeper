<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('entry_model');
	}

	public function index()
	{
		if(!$this->user_model->isLoggedIn())
		{
			redirect('/user/login', 'refresh');
		}
		else{

			$this->load->model('category_model');

			$data = array();
			$user_id = $this->session->userdata['user_id'];
			
			$data['categories']=$this->category_model->getCategoriesByUserId($user_id);
			$data['entry_types']=$this->entry_model->getEntryTypes();

			add_header_js('highcharts.js');
			//add_header_js('home.js');
			add_header_js('stackedcharts.js');
			$this->load->view('common/header',$data);
			$this->load->view("home/index", $data);
			$this->load->view('common/footer',$data);	
		}		
	}
}
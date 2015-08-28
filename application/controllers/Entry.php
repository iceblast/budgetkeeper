<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('entry_model');
		$this->load->model('user_model');

		if(!$this->user_model->isLoggedIn())
		{
			redirect('/user/login', 'refresh');
		}
	}

	public function index(){

		if($this->input->post()){
			$this->entry_model->add();
			//redirect('/', 'refresh');
		}
		
			$this->load->model('category_model');

			$data = array();
			$user_id = $this->session->userdata['user_id'];
			$hour = date('H');
			$minute = (date('i')>30)?'30':'00';

			$data['categories']=$this->category_model->getCategoriesByUserId($user_id);
			$data['entry_types']=$this->entry_model->getEntryTypes();
			$data['date']= date('Y-m-d')." $hour:$minute";
			add_header_js('typeahead.bundle.min.js');
			add_header_js('jquery.datetimepicker.js');
			add_header_css('jquery.datetimepicker.css');
			$this->load->view('common/header',$data);
			$this->load->view("entry/index", $data);
			$this->load->view('common/footer',$data);	
	}

	public function suggestDesc(){
		$results = $this->entry_model->getDescSuggest();
		echo json_results($results,'description');
	}
}
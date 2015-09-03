<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graph extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('graph_model');
		$this->load->model('user_model');

		if(!$this->user_model->isLoggedIn())
		{
			redirect('/user/login', 'refresh');
		}
	}
	
	public function dailyExpenses(){
		echo $this->graph_model->getDailyExpenses();
	}
	public function hourlyExpenses(){
		echo $this->graph_model->getHourlyExpenses();
	}
}
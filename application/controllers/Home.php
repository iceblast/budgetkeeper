<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data = array();
		$this->load->view('common/header',$data);
		$this->load->view("home/index", $data);
		$this->load->view('common/footer',$data);
	}
}
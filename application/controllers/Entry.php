<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('entry_model');
	}

	public function save(){
			$this->entry_model->add();
			redirect('/', 'refresh');
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry_model extends CI_Model {
	public function add(){
		$data = array(
					'user_id'		=>$this->session->userdata['user_id'],
					'category'		=>$this->input->post('category'),
					'description'	=>$this->input->post('description'),
					'amount'		=>$this->input->post('amount'),
					'date'			=>$this->input->post('date'),
					'entry_type'	=>$this->input->post('entry_type'),
					'status'		=>1,
					'date_created'	=>date('Y-m-d H:i:s')
				);

		$this->db->insert('entries',$data);
	}

	public function getEntries(){

	}

	public function getEntryTypes(){
		$this->db->where("status",1);
    	$query=$this->db->get("entry_types");
    	$results = $query->result();

    	return $results;
	}
}
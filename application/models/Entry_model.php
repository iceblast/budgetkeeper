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

	public function getEntries($entry_type=NULL, $datefrom=NULL, $dateto=NULL,$account=NULL){
		if(isset($entry_type)) $this->db->where('entry_type',$entry_type);
		if(isset($account)) $this->db->where('account',$account);
		if(isset($datefrom)&&isset($dateto)){
			$this->db->where('date >=',$datefrom);
			$this->db->where('date <=',$dateto);
		} 
		elseif(isset($datefrom)){
			$this->db->where('date >=',$datefrom);
		}
		elseif(isset($dateto)){
			$this->db->where('date <=',$dateto);
		}
		$this->db->where('user_id',$this->session->userdata['user_id']);
		$this->db->order_by('date','ASC');
		//var_dump($this->db->get_compiled_select("entries"));die();
		$query=$this->db->get("entries");
		$results = $query->result();

		return $results;
	}

	public function getSummarizedEntries($entry_type=NULL, $datefrom=NULL, $dateto=NULL,$account=NULL){
		//halfhour
		//$this->db->select('SUM(amount) amount,entry_type,SEC_TO_TIME(FLOOR((TIME_TO_SEC(date))/1800)*1800) date,account');
		
		$this->db->select('GROUP_CONCAT(concat(description,\' - \',amount) SEPARATOR \'<br/>\') description,SUM(amount) amount,entry_type,SEC_TO_TIME(FLOOR((TIME_TO_SEC(date))/3600)*3600) date,account');

		if(isset($entry_type)) $this->db->where('entry_type',$entry_type);
		else{
			$this->db->group_start();
			$this->db->where('entry_type ','1');
			$this->db->or_where('entry_type ','2');
			$this->db->group_end();
		}
		if(isset($account)) $this->db->where('account',$account);
		if(isset($datefrom)&&isset($dateto)){
			$this->db->where('date >=',$datefrom);
			$this->db->where('date <=',$dateto);
		} 
		elseif(isset($datefrom)){
			$this->db->where('date >=',$datefrom);
		}
		elseif(isset($dateto)){
			$this->db->where('date <=',$dateto);
		}
		$this->db->where('user_id',$this->session->userdata['user_id']);
		//halfhour
		// $this->db->group_by(array("date_format(date,'%Y-%m-%d')", "hour(date)","floor(minute(date)/30)",'entry_type','account')); 
		$this->db->group_by(array("date_format(date,'%Y-%m-%d')", "hour(date)",'entry_type','account'));
		$this->db->order_by('date','ASC');
		//var_dump($this->db->get_compiled_select("entries"));die();
		$subquery=$this->db->get_compiled_select("entries");
		$this->db->simple_query('SET @runtot:=0');
		$query = $this->db->query('select a.*, (@runtot := @runtot + a.amount) AS rt from ('.$subquery.') a');
		//$query=$this->db->get("entries");
		$results = $query->result();

		return $results;
	}

	public function getEntryTypes(){
		$this->db->where("status",1);
    	$query=$this->db->get("entry_types");
    	$results = $query->result();

    	return $results;
	}

	public function getDescSuggest($account=NULL){
		$this->db->select('description');
		if(isset($account)) $this->db->where('account',$account);
		$this->db->where('user_id',$this->session->userdata['user_id']);
		$query=$this->db->get("entries");
		$results = $query->result();

		return $results;
	}

	public function getExpensesByDate($date=NULL,$account=NULL){
		if(!isset($date)){
			$date=date('Y-m-d');
		} 
		else{
			$date = new DateTime($date);
			$date = $date->format('Y-m-d');
		}
		
		$datefrom = $date.' 00:00:00';
		$dateto = $date.' 23:59:59';
		return $this->getSummarizedEntries('2',$datefrom,$dateto,$account);
	}
}
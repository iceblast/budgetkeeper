<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function getCategoriesByUserId($user_id){

    	$this->db->where("user_id",$user_id);
    	$query=$this->db->get("users_categories");
    	$results = $query->result();

    	return $results;
    }

    public function getCategoriesByType($user_id,$type){
        
        $this->db->where("user_id",$user_id);
        $this->db->where("entry_type",$type);
        $query=$this->db->get("users_categories");
        $results = $query->result();

        return $results;
    }
}
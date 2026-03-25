<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hsn_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('hsnMaster',$data);
		return $this->db->affected_rows()!=1? false:true;
	}


	public function select()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->from('hsnMaster');
		return $this->db->get()->result_array();
	}

	      
}
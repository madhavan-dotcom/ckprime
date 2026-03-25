<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grade_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('grade',$data);
		return $this->db->affected_rows()!=1? false:true;
	}
	public function select()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->from('grade');
		return $this->db->get()->result_array();
	}

	public function edit_select($id)
	{
		$this->db->where('id', $id);
		$this->db->from('grade');
		return $this->db->get()->row_array();
	}

	public function updategrade($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('grade', $data);
		return $this->db->affected_rows()!=1 ? false:true;
	}
	// public function user_update($id,$data)
	// {
	// 	$this->db->where('id',$id);
	// 	$this->db->update('login',$data);
	// 	return $this->db->affected_rows()!=1? false:true;

	      
}
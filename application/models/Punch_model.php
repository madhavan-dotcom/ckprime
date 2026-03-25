<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Punch_model extends CI_Model {

var $table = 'attendance';
	var $column_order = array(null, 'staffname','staffid','leave_type','duration','reason','status'); //set column field database for datatable orderable
	var $column_search = array('staffname','staffid','leave_type','duration','reason','status'); //set column field database for datatable searchable 
	var $order = array('id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		//add custom filter here
			
		// $this->db->where('status >',0);
		 $today=date('Y-m-d');
	     $this->db->where('date',$today);
		$this->db->order_by('id','desc');
		$this->db->from($this->table);
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					//$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				// if(count($this->column_search) - 1 == $i) //last loop
				// 	$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
	    $today=date('Y-m-d');
	     $this->db->where('date',$today);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
private function _get_datatables_query1()
	{
		
		//add custom filter here
			
		// $this->db->where('status >',0);
		$today=date('Y-m-d');
		$fromdate=date('Y-m-d',strtotime('-1 day '.$today));
	    $todate=$today;
	     $this->db->where('date >=',$fromdate)->where('date <=',$todate);
		$this->db->order_by('id','desc');
		$this->db->from('shift_attendance');
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					//$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				// if(count($this->column_search) - 1 == $i) //last loop
				// 	$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables1()
	{
		$this->_get_datatables_query1();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered1()
	{
		$this->_get_datatables_query1();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all1()
	{
	    $today=date('Y-m-d');
	    $fromdate=date('Y-m-d',strtotime('-1 day '.$today));
	    $todate=$today;
	     $this->db->where('date >=',$fromdate)->where('date <=',$todate);
		$this->db->from('shift_attendance');
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	


}
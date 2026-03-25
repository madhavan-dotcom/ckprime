<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inspectionmaster_model extends CI_Model {

    public function add($data)
    {
        $this->db->insert('inspectionmaster',$data);
        return $this->db->affected_rows()!=1? false:true;
    }

    public function select()
    {
        $this->db->select('*');
        $this->db->where('status',1);
        $this->db->from('inspectionmaster');
        return $this->db->get()->result_array();
    }

    public function editdata($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('inspectionmaster');
        return $query->row_array();
    }
    
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('inspectionmaster', $data);
        return $this->db->affected_rows() > 0;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('inspectionmaster');
        return $this->db->affected_rows() > 0;
    }

}
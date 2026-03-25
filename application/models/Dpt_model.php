<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Dpt_model extends CI_Model
{
    var $table = 'dpt_report';
    var $column = array('dpt_report_no', 'dpt_date', 'customername', 'id'); //set column field database for order and search
    var $column_search = array('dpt_report_no', 'customername', 'id'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        if ($this->input->post('fromdate')) {
            $this->db->where('dpt_date >=', date('Y-m-d', strtotime($this->input->post('fromdate'))));
        }
        if ($this->input->post('todate')) {
            $this->db->where('dpt_date <=', date('Y-m-d', strtotime($this->input->post('todate'))));
        }
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) 
        {
            if ($_POST['search']['value']) 
            {
                if ($i === 0) 
                {
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) 
        {
            $this->db->order_by('id', $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        //echo $this->_get_datatables_query();
        //exit;
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        if ($this->input->post('fromdate')) {
            $this->db->where('dpt_date >=', date('Y-m-d', strtotime($this->input->post('fromdate'))));
        }
        if ($this->input->post('todate')) {
            $this->db->where('dpt_date <=', date('Y-m-d', strtotime($this->input->post('todate'))));
        }
        $this->_get_datatables_query();
        $query = $this->db->get();
        $this->db->order_by('id', 'desc');
        return $query->num_rows();
    }
    public function count_all()
    {
        if ($this->input->post('fromdate')) {
            $this->db->where('dpt_date >=', date('Y-m-d', strtotime($this->input->post('fromdate'))));
        }
        if ($this->input->post('todate')) {
            $this->db->where('dpt_date <=', date('Y-m-d', strtotime($this->input->post('todate'))));
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }




    public function search_reports()
    {
        if ($this->input->post('fromdate') == '') {
            $fromdate = '';
        } else {
            $fromdate = date('Y-m-d', strtotime($this->input->post('fromdate')));
        }
        if ($this->input->post('todate') == '') {
            $todate = '';
        } else {
            $todate = date('Y-m-d', strtotime($this->input->post('todate')));
        }
        if ($fromdate != '' && $todate != '') {
            $this->db->where('status', 1);
            // $this->db->where('balance >',0);
            $this->db->where('quotationdate >=', $fromdate);
            $this->db->where('quotationdate <=', $todate);
            $query = $this->db->get('quotation_details');
        } else if ($fromdate != '' && $todate == '') {
            $this->db->where('status', 1);
            $this->db->where('quotationdate >=', $fromdate);
            $query = $this->db->get('quotation_details');
        } else if ($fromdate == '' && $todate != '') {
            $this->db->where('status', 1);
            $this->db->where('quotationdate <=', $todate);
            $query = $this->db->get('quotation_details');
        } else {
            $this->db->where('status', 1);
            $query = $this->db->get('quotation_details');
        }
        return $query->result_array();
    }



    public function pending()
    {
        $this->db->select('*');
        $this->db->where('balance >', 0);
        $this->db->from('purchase_details');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }
}

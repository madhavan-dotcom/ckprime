<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Sup_purchaseorder_pending_model extends CI_Model
{
  var $table = 'sup_purchaseorder_reports';
  var $column_search = array('purchasedate', 'purchaseorderno', 'suppliername', 'id'); //set column field database for order and search
  var $order = array('id' => 'desc'); // default order 

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  private function _get_datatables_query()
  {
    //add custom filter here
    if ($this->input->post('fromdate')) {
      $this->db->where('purchasedate >=', date('Y-m-d', strtotime($this->input->post('fromdate'))));
    }
    if ($this->input->post('todate')) {
      $this->db->where('purchasedate <=', date('Y-m-d', strtotime($this->input->post('todate'))));
    }
    if ($this->input->post('cusname')) {
      $this->db->where('suppliername', $this->input->post('cusname'));
    }

    $this->db->where('balaceqty >', 0);
    $this->db->from($this->table);
    $i = 0;

    foreach ($this->column_search as $item) // loop column 
    {
      if ($_POST['search']['value']) // if datatable send POST for search
      {

        if ($i === 0) // first loop
        {
          //$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        // if(count($this->column_search) - 1 == $i) //last loop
        //  $this->db->group_end(); //close bracket
      }
      $i++;
    }

    if (isset($_POST['order'])) // here order processing
    {
      $this->db->order_by('id', $_POST['order']['0']['dir']);

      // $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function get_datatables()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
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
    if ($this->input->post('fromdate')) {
      $this->db->where('purchasedate >=', date('Y-m-d', strtotime($this->input->post('fromdate'))));
    }
    if ($this->input->post('todate')) {
      $this->db->where('purchasedate <=', date('Y-m-d', strtotime($this->input->post('todate'))));
    }
    if ($this->input->post('cusname')) {
      $this->db->where('suppliername', $this->input->post('cusname'));
    }

    $this->db->from($this->table);
    return $this->db->count_all_results();
  }


  public function search_billing()
  {
    // Start building the query
    $this->db->select('*');
    $this->db->from('sup_purchaseorder_reports');

    // Apply supplier name filter
    if (!empty($_POST['cusname'])) {
      $this->db->like('supplierid', $_POST['cusname']);
    }

    if (!empty($_POST['fromdate'])) {
      $this->db->where('purchasedate >=', date('Y-m-d', strtotime($_POST['fromdate'])));
    }

    if (!empty($_POST['todate'])) {
      $this->db->where('purchasedate <=', date('Y-m-d', strtotime($_POST['todate'])));
    }

    $this->db->where('balaceqty >', 0);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function search_billings()
  {

    if ($this->session->userdata('rcbio_fromdate') != "") {
      $fromdate = date('Y-m-d', strtotime($this->session->userdata('rcbio_fromdate')));
    } else {
      $fromdate = '';
    }

    if ($this->session->userdata('rcbio_todate') != "") {
      $todate = date('Y-m-d', strtotime($this->session->userdata('rcbio_todate')));
    } else {
      $todate = '';
    }

    if (@$fromdate) {
      $this->db->where('purchasedate >=', $fromdate);
    }
    if (@$todate) {
      $this->db->where('purchasedate <=', $todate);
    }
    if (@$this->session->userdata('rcbio_cusname')) {
      $this->db->where('suppliername', $this->session->userdata('rcbio_cusname'));
    }
    // $this->db->where('balaceqty >', 0);
    return $query = $this->db->get('sup_purchaseorder_reports')->result_array();
  }
}

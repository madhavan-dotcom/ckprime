<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Oldmaterial_dc extends CI_Controller {
public function __construct()
{
parent::__construct();
$this->load->model('oldmaterialdc_model');
if($this->session->userdata('rcbio_login')=='')
{
$this->session->set_flashdata('msg','Please Login to continue!');
redirect('login');
}
date_default_timezone_set('Asia/Kolkata');
}




public function rebill()
{
$id=$this->uri->segment(3);

$data['pre']=$this->db->where('id',$id)->get('materialdc_details_backup')->result();
$this->load->view('materaildcbills',$data);
}

public function view()
{
$data['dcbill']=$this->oldmaterialdc_model->select();
$this->load->view('header');
$this->load->view('oldmaterialdc_view',$data);
$this->load->view('footer1');
// echo"<pre>";
// print_r($data);
}

public function pending()
{
$data['view']=$this->oldmaterialdc_model->select_pending();
$this->load->view('header');
$this->load->view('dc_pending',$data);
$this->load->view('footer1');
}



public function autocomplete_cusname()
{
$orderno=$this->input->post('keyword');
$this->db->select('*');
$this->db->from('customer_details');
$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')");
$this->db->like('name',$orderno);
$query = $this->db->get();
$result = $query->result();
$name       =  array();
foreach ($result as $d){
$json_array             = array();
$json_array['label']    = $d->name;
$json_array['value']    = $d->name;
$name[]             = $json_array;
}
echo json_encode($name);
}



public function ajax_list()
{
$list = $this->oldmaterialdc_model->get_datatables();
$data = array();
$no = $_POST['start'];
$a=1;
$totalamount[]=array();
foreach ($list as $person) {

$no++;
$row = array();
$row[] = $a++;
$row[] = date('d-m-Y',strtotime($person->dcdate));
$row[] =$person->dctype;
$row[] =$person->dcno;
$row[] =$person->cusname;
$row[] = str_replace('||', ',', $person->inwardno);

$htmls='<div class="btn-group">
<button type="button" class="btn
btn-info dropdown-toggle waves-effect waves-light"
data-toggle="dropdown" aria-expanded="false">Manage <span
class="caret"></span></button>
<ul class="dropdown-menu"
role="menu" style="background: #23BDCF none repeat scroll
0% 0%;width:14px;min-width: 100%;">

<li><a class="" target="_blank" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url().'oldmaterial_dc/rebill/'.$person->id.'" title="Print" >Print</a></li>
';


$htmls.='</ul>
</div>';
$row[] = $htmls;
$data[] = $row;
}

$output = array(
"draw" => $_POST['draw'],
"recordsTotal" => $this->oldmaterialdc_model->count_all(),
"recordsFiltered" => $this->oldmaterialdc_model->count_filtered(),
"data" => $data,
);
//output to json format
echo json_encode($output);
}

public function search()
{ 
$fromdate=$this->input->post('fromdate');
$todate=$this->input->post('todate');
$customername=$this->input->post('customername');

$data=array(
'rcbio_fromdate' => $fromdate,
'rcbio_todate' => $todate,
'rcbio_customername' => $customername,
'rcbio_bill_format' =>'Print',
);
$this->session->set_userdata($data);
}

public function search_reports()
{   
$bill_format=$this->session->userdata('rcbio_bill_format');                
if($bill_format=='Print')
{
$data['purchase']=$this->oldmaterialdc_model->search_billing();
$data['fromdate']=$this->session->userdata('rcbio_fromdate');
$data['todate']=$this->session->userdata('rcbio_todate');
$data['cusname']=$this->session->userdata('rcbio_customername');
$this->load->view('materialdc_reports',$data);
}
}

public function viewdc()
{
$id=$this->input->post('id');
$data=$this->db->where('id',$id)->get('materialdc_details_backup')->result_array();
if($data)
{
foreach ($data as $row) {
$html='<div class="row">
<table class="table m-0">
<thead>
<tr>
<th>S.No</th>
<th>HSN No</th>
<th>Item Name</th>
<th>UOM</th>
<th>Qty</th>
<th>Remarks</th>
</tr>   
</thead>
<tbody>';

$itemname=explode('||',$row['itemname']);
$qty=explode('||',$row['qty']);
$hsnno=explode('||',$row['hsnno']);
@$remarks=explode('||',$row['remarks']);
$uom=explode('||',$row['uom']);
$count=count($itemname);
$a=1;
for ($i=0; $i < $count; $i++) { 
$html.='<tr>
<td>'.$a++.'</td>
<td>'.$hsnno[$i].'</td>
<td>'.$itemname[$i].'</td>
<td>'.$uom[$i].'</td>
<td>'.$qty[$i].'</td>
<td>'.@$remarks[$i].'</td>
</tr>';
}
$html.='</tbody>
</table>
</div>
<div class="row">
<div class="col-md-4">
</div>
<div class="col-md-4">
</div>
</div>';
}
}
else
{
$html='';
}
echo $html;
}



public function autocomplete_name()
{
$orderno=$this->input->post('keyword');
$this->db->select('*');
$this->db->from('customer_details');
$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')");
$this->db->like('name',$orderno);
$query = $this->db->get();
$result = $query->result();
$name       =  array();
foreach ($result as $d){
$json_array             = array();
$json_array['label']    = $d->name;
$json_array['value']    = $d->name;
$name[]             = $json_array;
}
echo json_encode($name);
}


public function get_name()
{
$cusname=$this->input->post('cusname');
$this->db->select('*');
$this->db->from('customer_details');
$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')");
$this->db->where('name',$cusname);
$query = $this->db->get();
$result = $query->result();
foreach($result as $s)
{   
$vob['address']=$s->address1.', '.$s->address2;
}
echo json_encode($vob);
}

public function check_cusname()
{
$name=$_POST['cusname'];
$data=$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('name',$name)->get('customer_details')->result();
echo $count=count($data);
}


}

ob_flush();

?>
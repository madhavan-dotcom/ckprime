<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class OldpurchaseOrder extends CI_Controller {

public function __construct()
{
parent::__construct();
$this->load->model('oldpurchaseorder_model');
if($this->session->userdata('rcbio_login')=='')
{

$this->session->set_flashdata('msg','Please Login to continue!');
redirect('login');
} 
date_default_timezone_set('Asia/Kolkata');    
}



public function view()
{
$this->load->view('header');
$this->load->view('oldpurchaseOrder_view');
$this->load->view('footer1');
}

public function views()
{
$id=base64_decode($this->uri->segment(3));
$data['result']=$this->db->where('id',$id)->get('purchaseorder_details_backup')->result_array(); 
$this->load->view('header');
$this->load->view('purchaseOrder_viewDet',$data);
$this->load->view('footer');
}

public function pending()
{
$data['view']=$this->oldpurchaseorder_model->select_pending();
$this->load->view('header');
$this->load->view('purchaseOrder_pending',$data);
$this->load->view('footer1');
}


public function ajax_list()
{
$list = $this->oldpurchaseorder_model->get_datatables();
$data = array();
$no = $_POST['start'];
$i=1;
foreach ($list as $person) {
$startTimeStamp = strtotime($person->invoicedate);
$endTimeStamp = strtotime(date('Y-m-d'));
$timeDiff = abs($endTimeStamp - $startTimeStamp);
$numberDays = $timeDiff/86400;  // 86400 seconds in one day
$numberDays = intval($numberDays);

$no++;
$row = array();
$row[] = $i++;
$row[] =date('d-m-Y',strtotime($person->invoicedate));
$row[] = $person->purchaseorderno;
$row[] = $person->purchaseorder;
$row[] = $person->customername;
$row[] = $numberDays.' Days';
$row[] = $person->grandtotal;
$code=base64_encode($person->id);
//add html for action
$deleteOptn='<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$code."'".')">Delete</a>';
if($person->edit_status=='0')
{
$row[] = '
<div class="btn-group">
<button type="button" class="btn
btn-info dropdown-toggle waves-effect waves-light"
data-toggle="dropdown" aria-expanded="false">Manage <span
class="caret"></span></button>
<ul class="dropdown-menu"
role="menu" style="background: #23BDCF none repeat scroll
0% 0%;width:14px;min-width: 100%;">


<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('oldpurchaseOrder/views/'.$code).'" title="View" >View</a></li>

<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('oldpurchaseOrder/invoice/'.$code).'" title="Hapus" >Print</a></li>


</ul>
</div>

'; 
}

else
{

$row[] = '


<div class="btn-group">
<button type="button" class="btn
btn-info dropdown-toggle waves-effect waves-light"
data-toggle="dropdown" aria-expanded="false">Manage <span
class="caret"></span></button>
<ul class="dropdown-menu"
role="menu" style="background: #23BDCF none repeat scroll
0% 0%;width:14px;min-width: 100%;">


<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchaseorder/views/'.$code).'" title="View" >View</a></li>
<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchaseorder/edit/'.$code).'" title="Edit" >Edit</a></li>
<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('purchaseorder/invoice/'.$code).'" title="Hapus" >Print</a></li>
<li>'.$deleteOptn.'</li>
</ul>
</div>

';
}

$data[] = $row;
}

$output = array(
"draw" => $_POST['draw'],
"recordsTotal" => $this->oldpurchaseorder_model->count_all(),
"recordsFiltered" => $this->oldpurchaseorder_model->count_filtered(),
"data" => $data,
);
//output to json format
echo json_encode($output);
}



public function ajax_delete($id)
{
$this->oldpurchaseorder_model->delete_by_id($id);
echo json_encode(array("status" => TRUE));
}


public function autocomplete_customername()
{
$orderno=$this->input->post('keyword');
$this->db->select('*');
$this->db->from('customer_details');
$this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
$this->db->like('name',$orderno);
$query = $this->db->get();
$result = $query->result();
$name       =  array();
foreach ($result as $d){
$json_array             = array();
$json_array['label']    = $d->name;
$json_array['value']    = $d->name;
$json_array['address']    = $d->address1.', '.$d->address2.', '.$d->city.', '.$d->state;
$json_array['supplierid'] = $d->id;
$name[]             = $json_array;
}
echo json_encode($name);
}

public function autocomplete_itemcode()
{
$orderno=$this->input->post('keyword');
$this->db->select('*');
$this->db->from('additem');
$this->db->like('itemno',$orderno);
$query = $this->db->get();
$result = $query->result();
$name       =  array();
foreach ($result as $d){
$json_array             = array();
$json_array['label']    = $d->itemno;
$json_array['value']    = $d->itemno;
$name[]             = $json_array;
}
echo json_encode($name);
}

public function get_itemcode()
{
$itemcode=$this->input->post('name');
$this->db->select('*');
$this->db->from('additem');
$this->db->where('itemno',$itemcode);
$query = $this->db->get();
$result = $query->result();
foreach($result as $h)
{   
$vob['itemname']=$h->itemname;
$vob['price']=$h->price;
$vob['hsnno']=$h->hsnno;
}
echo json_encode($vob);
}

public function get_hsnno()
{
$itemcode=$this->input->post('name');
$this->db->select('*');
$this->db->from('additem');
$this->db->where('hsnno',$itemcode);
$query = $this->db->get();
$result = $query->result();
foreach($result as $h)
{   
$vob['itemname']=$h->itemname;
$vob['price']=$h->price;
$vob['sgst']=$h->sgst;
$vob['cgst']=$h->cgst;
$vob['igst']=$h->igst;
}
echo json_encode($vob);
}


public function get_itemnames()
{
$itemcode=$this->input->post('name');
$this->db->select('*');
$this->db->from('additem');
$this->db->where('itemname',$itemcode);
$query = $this->db->get();
$result = $query->result();
foreach($result as $h)
{   
$uom=$this->db->select('uom')->where('id',$h->uom)->get('uom')->row()->uom;
$vob['hsnno']=$h->hsnno;
$vob['price']=$h->price;
$vob['priceType']=$h->priceType;
$vob['sgst']=$h->sgst;
$vob['cgst']=$h->cgst;
$vob['igst']=$h->igst;
$vob['uom']=$uom;
}
echo json_encode($vob);
}

public function autocomplete_itemname()
{
$orderno=$this->input->post('keyword');
$this->db->select('*');
$this->db->from('additem');
$this->db->like('itemname',$orderno);
$this->db->where('itemtype','Raw Material');
$query = $this->db->get();
$result = $query->result();
$name       =  array();
foreach ($result as $d){
$json_array             = array();
$json_array['label']    = $d->itemname;
$json_array['value']    = $d->itemname;
$json_array['price']    = $d->price;
$json_array['sgst']    = $d->sgst;
$json_array['cgst']    = $d->cgst;
$json_array['igst']    = $d->igst;
$name[]             = $json_array;
}
echo json_encode($name);
}

public function autocomplete_hsnno()
{
$orderno=$this->input->post('keyword');
$this->db->select('*');
$this->db->from('additem');
$this->db->like('hsnno',$orderno);
$query = $this->db->get();
$result = $query->result();
$name       =  array();
foreach ($result as $d){
$json_array             = array();
$json_array['label']    = $d->hsnno;
$json_array['value']    = $d->hsnno;
$name[]             = $json_array;
}
echo json_encode($name);
}



public function getsupplier()
{
$name=$_POST['name'];
$data=$this->db->where('name',$name)->where("(type = 'Intra supplier' OR type = 'Inter supplier')")->get('customer_details')->result();
echo $count=count($data);
}


public function search()
{ 
$fromdate=$this->input->post('fromdate');
$todate=$this->input->post('todate');
$customername=$this->input->post('customername');
$purchaseorderno=$this->input->post('purchaseorderno');

$data=array(
'rcbio_fromdate' => $fromdate,
'rcbio_todate' => $todate,
'rcbio_customername' => $customername,
'rcbio_purchaseorderno' => $purchaseorderno,
'rcbio_bill_format' =>'Print',
);
$this->session->set_userdata($data);
}


public function search_reports()
{   
$bill_format=$this->session->userdata('rcbio_bill_format');                
$data['purchase']=$this->oldpurchaseorder_model->search_billing();
$data['fromdate']=$this->session->userdata('rcbio_fromdate');
$data['todate']=$this->session->userdata('rcbio_todate');
$data['customername']=$this->session->userdata('rcbio_customername');
$data['purchaseorderno']=$this->session->userdata('rcbio_purchaseorderno');
$this->load->view('purchaseOrder_searchreports',$data);
}  




public function pending_search()
{
$data['pending']=$this->oldpurchaseorder_model->search_reports();
$this->load->view('header');
$this->load->view('purchase_pending_view',$data);
$this->load->view('footer1');
}


public function purchase_reports()
{
@$suppliername=$_POST['suppliername'];
@$fromdate=$_POST['fromdate'];
@$todate=$_POST['todate'];
$data['pending']=$this->oldpurchaseorder_model->search_pending();
// echo"<pre>";
// print_r($data);
$this->load->view('purchase_reports',$data,$fromdate,$todate,$suppliername);
}

public function reports()
{
@$suppliername=$_POST['suppliername'];
@$fromdate=$_POST['fromdate'];
@$todate=$_POST['todate'];
$data['pending']=$this->oldpurchaseorder_model->search_reports();
$this->load->view('purchase_reports2',$data,$fromdate,$todate);
}

public function reports1()
{
@$suppliername=$_POST['suppliername'];
@$fromdate=$_POST['fromdate'];
@$todate=$_POST['todate'];
$data['pending']=$this->oldpurchaseorder_model->search_pending();
$this->load->view('purchase_reports1',$data,$fromdate,$todate);
}

public function get_supplier()
{
$name=$_POST['name'];
$data=$this->db->where('name',$name)->get('customer_details')->result();
echo $count=count($data);
}







public function invoice()
{
$id=base64_decode($this->uri->segment(3));
// $this->load->library('mpdf'); 
$data['pre']=$this->db->where('id',$id)->get('purchaseorder_details_backup')->result();

foreach($data['pre'] as $b)
{
$number= $b->grandtotal;
}
$no = round($number);
$point = round($number - $no, 2) * 100;
$hundred = null;
$digits_1 = strlen($no);
$i = 0;
$str = array();
$words = array('0' => '', '1' => 'One', '2' => 'Two',
'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
'13' => 'Thirteen', '14' => 'Fourteen',
'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
'60' => 'Sixty', '70' => 'Seventy',
'80' => 'Eighty', '90' => 'Ninety');
$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
while ($i < $digits_1) {
$divider = ($i == 2) ? 10 : 100;
$number = floor($no % $divider);
$no = floor($no / $divider);
$i += ($divider == 10) ? 1 : 2;
if ($number) {
$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
$str [] = ($number < 21) ? $words[$number] .
" " . $digits[$counter] . $plural . " " . $hundred
:
$words[floor($number / 10) * 10]
. " " . $words[$number % 10] . " "
. @$digits[$counter] . $plural . " " . $hundred;
} 
else $str[] = null;
}
$str = array_reverse($str);
$result = implode('', $str);
$data['fin']=$result;
$data['profile']=$this->db->get('profile')->result();
$data['invoice']=$this->db->where('id',$id)->get('purchaseorder_details_backup')->result();
//$this->load->view('invoicebill',$data);
$this->load->view('purchaseOrder_bill',$data);
}

public function directPrint()
{
$data['pre']=$this->db->order_by('id','desc')->limit(1)->get('purchaseorder_details_backup')->result();
foreach($data['pre'] as $b)
{
$number= $b->grandtotal;
}
$no = round($number);
// $point = round($number - $no, 2) * 100;
$hundred = null;
$digits_1 = strlen($no);
$i = 0;
$str = array();
$words = array('0' => '', '1' => 'One', '2' => 'Two',
'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
'13' => 'Thirteen', '14' => 'Fourteen',
'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
'60' => 'Sixty', '70' => 'Seventy',
'80' => 'Eighty', '90' => 'Ninety');
$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
while ($i < $digits_1) {
$divider = ($i == 2) ? 10 : 100;
$number = floor($no % $divider);
$no = floor($no / $divider);
$i += ($divider == 10) ? 1 : 2;
if ($number) {
$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
$str [] = ($number < 21) ? $words[$number] .
" " . $digits[$counter] . $plural . " " . $hundred
:
$words[floor($number / 10) * 10]
. " " . $words[$number % 10] . " "
. @$digits[$counter] . $plural . " " . $hundred;
} 
else $str[] = null;
}
$str = array_reverse($str);
$result = implode('', $str);
$data['fin']=$result;
$data['profile']=$this->db->get('profile')->result();
$data['invoice']=$data['pre'];

$this->load->view('purchaseOrder_bill',$data);
//$this->load->view('invoicebill',$data);
// $this->load->view('invoice_bill',$data);


}

}

ob_flush();
?>
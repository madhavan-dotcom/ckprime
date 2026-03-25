<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Olddcbill extends CI_Controller {
public function __construct()
{
parent::__construct();
$this->load->model('olddcbill_model');
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
$data['pre']=$this->db->where('id',$id)->get('dcbill_details_backup')->result();
$this->load->view('dcbills',$data);
}

public function view()
{
$data['dcbill']=$this->olddcbill_model->select();
$this->load->view('header');
$this->load->view('olddcbill_view',$data);
$this->load->view('footer1');

}

public function pending()
{
$data['view']=$this->olddcbill_model->select_pending();
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
$list = $this->olddcbill_model->get_datatables();
$data = array();
$no = $_POST['start'];
$a=1;
$totalamount[]=array();
foreach ($list as $person) {
// $noofitemss=explode('||',$person->itemname);
// $noofitems=count($noofitemss);
// $totalamount[]=$person->totalamount;
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

<li><a class="" target="_blank" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url().'olddcbill/rebill/'.$person->id.'" title="Print" >Print</a></li>
';

$htmls.='</ul>
</div>';
$row[] = $htmls;
$data[] = $row;
}

$output = array(
"draw" => $_POST['draw'],
"recordsTotal" => $this->olddcbill_model->count_all(),
"recordsFiltered" => $this->olddcbill_model->count_filtered(),
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
$data['purchase']=$this->olddcbill_model->search_billing();
$data['fromdate']=$this->session->userdata('rcbio_fromdate');
$data['todate']=$this->session->userdata('rcbio_todate');
$data['cusname']=$this->session->userdata('rcbio_customername');
$this->load->view('dc_reports',$data);
}
}

public function viewdc()
{
$id=$this->input->post('id');
$data=$this->db->where('id',$id)->get('dcbill_details')->result_array();
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

public function autocomplete_itemname()
{
$orderno=$this->input->post('keyword');
$this->db->select('*');
$this->db->from('additem');
$this->db->like('itemname',$orderno);
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
// $json_array['advanceamount'] = $d->voucheramount;
$name[]             = $json_array;
}
echo json_encode($name);
}

public function autocomplete_itemcode()
{
$orderno=$this->input->post('keyword');
$this->db->select('*');
$this->db->from('additem');
$this->db->like('itemcode',$orderno);
$query = $this->db->get();
$result = $query->result();
$name       =  array();
foreach ($result as $d){
$json_array             = array();
$json_array['label']    = $d->itemcode;
$json_array['value']    = $d->itemcode;
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

public function check_itemname()
{
$name=$_POST['itemname'];
$data=$this->db->where('itemname',$name)->get('additem')->result();
echo $count=count($data);
}

public function check_itemcode()
{
$name=$_POST['itemcode'];
$data=$this->db->where('itemcode',$name)->get('additem')->result();
echo $count=count($data);
}

public function check_cusname()
{
$name=$_POST['cusname'];
$data=$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('name',$name)->get('customer_details')->result();
echo $count=count($data);
}

public function get_itemnames()
{
$itemcode=$this->input->post('name');
// $itemcode='Micro Mac';
$this->db->select('*');
$this->db->from('additem');
$this->db->where('itemname',$itemcode);
$query = $this->db->get();
$result = $query->result();
foreach($result as $h)
{   
$uom=$this->db->select('uom')->where('id',$h->uom)->get('uom')->row()->uom;
$vob['hsnno']=$h->hsnno;
$vob['itemcode']=$h->itemcode;
$vob['uom']=$uom;
}
echo json_encode($vob);
}

public function get_itemcodes()
{
$itemcode=$this->input->post('name');
// $itemcode='Micro Mac';
$this->db->select('*');
$this->db->from('additem');
$this->db->where('itemcode',$itemcode);
$query = $this->db->get();
$result = $query->result();
foreach($result as $h)
{   
$uom=$this->db->select('uom')->where('id',$h->uom)->get('uom')->row()->uom;
$vob['hsnno']=$h->hsnno;
$vob['itemname']=$h->itemname;
$vob['uom']=$uom;
}
echo json_encode($vob);
}

Public function get_inwardno()
{
$cusname=$_POST['id'];
$query=$this->db->where('status',1)->where('cusname',$cusname)->where('balanceqty >',0)->group_by('inwardno')->get('inward_delivery');
$result= $query->result();
$data=array(); 
if($result)
{
foreach($result as $r)
{
$data['value']=$r->inwardno;
$data['label']=$r->inwardno;
$json[]=$data;
}
}
echo json_encode($json);
}

Public function getdc_item()
{
$cusname=$_POST['id'];

 $querys=$this->db->where('status',1)->where('cusname',$cusname)->where('balanceqty >',0)->get('inward_delivery');
$results= $querys->result();
$datas=array();
 foreach($results as $row)
 {
   $datas['label']=$row->inwardno;
   $datas['value']=$row->inwardno.' - '.$row->itemname.' - '.$row->balanceqty.' - '.date('d-m-Y',strtotime($row->inwarddate));
   $jsons[]=$datas;
 }
 echo json_encode($jsons);

}

public function getinward_details()
{
$dctype=$this->input->post('dctype');
if($dctype=='Against Inward')
{
$html='<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select Inward No</span></div>';
}
else
{
$this->load->view('directdc');
}
}

public function getinwarddetails()
{
$inwardno=$this->input->post('inwardno');
if($inwardno=='')
{
$html='<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select Inward No</span></div>';
}
else
{
$count=count($inwardno);
for ($i=0; $i < $count; $i++) { 
$data[]=$this->db->where('inwardno',$inwardno[$i])->where('balanceqty >',0)->get('inward_delivery')->result_array();
}

$html='
<table class="responsive table" width="100%">
<thead> 
<tr>
<th>&nbsp;&nbsp;&nbsp;&nbsp;HSN Code</th>
<th>&nbsp;&nbsp;&nbsp;&nbsp;Customer DC No</th>
<th>&nbsp;&nbsp;&nbsp;&nbsp;Item Name</th>
<th>&nbsp;&nbsp;UOM</th>
<th>&nbsp;&nbsp;Qty</th>
<th>&nbsp;&nbsp;Remarks</th>
</tr>  
</thead>
<tbody>';

foreach ($data as $datas) 
{
foreach ($datas as $rows) 
{
$html.='
<tr>
<td>
<input class="form-control" parsley-trigger="change" readonly id="insertid" type="hidden" name="insertid" value="'.$rows['insertid'].'">
<input class="form-control" parsley-trigger="change" readonly id="id" type="hidden" name="id[]" value="'.$rows['id'].'"> 
<input class="form-control" parsley-trigger="change" readonly id="hsnno" type="text" name="hsnno[]" value="'.$rows['hsnno'].'">
<div id="hsnno_valid"></div>
</td>

<td>
<input class="form-control" parsley-trigger="change" required id="" readonly type="text" name="customerdcno[]" value="'.$rows['customerdcno'].'">
<input class="form-control" parsley-trigger="change" required id="" readonly type="hidden" name="customerdcdate[]" value="'.$rows['customerdcdate'].'">
<div id="itemname_valid"></div>
</td>

<td><input class="form-control" parsley-trigger="change" required id="" readonly type="text" name="itemname[]" value="'.$rows['itemname'].'"><div id="itemname_valid"></div><input type="text" name="item_desc[]" value="'.$rows['item_desc'].'" style="margin-top: 2px;" class="form-control"></td>

<td><input class="form-control" value="'.$rows['uom'].'" readonly id="uom" type="text" name="uom[]"  autocomplete="off"><div id="qty_valid"></div></td>

<td>
<input class="form-control decimal" parsley-trigger="change" required id="qty'.$rows['id'].'" type="text" name="qty[]"  autocomplete="off">
<input class="form-control"  id="inwardqty'.$rows['id'].'" type="hidden" name="inwardqty[]" value="'.$rows['balanceqty'].'" autocomplete="off">
<div id="qty_valid" style="color:green;">Inward Qty : '.$rows['balanceqty'].'</div>
</td>

<td>
<input class="form-control" id="remarks" type="text" name="remarks[]"  value="'.$rows['remarks'].'" autocomplete="off">
<div id="qty_valid"></div>
</td>

<td><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td>
</tr>';
}
}
$html.='
</tbody>
</table>

<br>

<div class="col-sm-offset-4">
<button  class="btn btn-info" id="submit" name="save" value="save">Save</button>
<button  class="btn btn-primary"  name="print" id="print" value="print">Print</button> 
<button type="reset"  class="btn btn-default" id="">Reset</button>
</div>
<script>
$(".remove").click(function(){
$(this).parents("tr").remove();
});
</script>';
foreach ($data as $datas) 
{
foreach ($datas as $rows) 
{
$html.='
<script>
$("#qty'.$rows['id'].'").keyup(function(){
var qty=$("#qty'.$rows['id'].'").val();
var inwardqty=$("#inwardqty'.$rows['id'].'").val();

if(parseFloat(qty) > parseFloat(inwardqty))
{
alert("Invalid Qty");
$("#qty'.$rows['id'].'").val("");
$("#qty'.$rows['id'].'").focus();
}
});
$(".decimal").keyup(function(){
var val = $(this).val();
if(isNaN(val)){
val = val.replace(/[^0-9\.-]/g,\'\');
if(val.split(\'.\').length>2)
val =val.replace(/\.-+$/,"");
}
$(this).val(val);
});
</script>';
}
}
}
echo $html;
}

public function geteditinwarddetails()
{
$id=$this->input->post('id');
$data=$this->db->where('insertid',$id)->get('dc_delivery')->result_array();

$html='
<table class="responsive table" width="100%">
<thead> 
<tr>
<th>&nbsp;&nbsp;&nbsp;&nbsp;HSN Code</th>
<th>&nbsp;&nbsp;&nbsp;&nbsp;Customer DC No</th>
<th>&nbsp;&nbsp;&nbsp;&nbsp;Item Name</th>
<th>&nbsp;&nbsp;UOM</th>
<th>&nbsp;&nbsp;Qty</th>
<th>&nbsp;&nbsp;Remarks</th>
</tr>  
</thead>
<tbody>';
foreach ($data as $rows) {
//$balanceqty=$this->db->select('balanceqty')->where('id',$rows['inwardid'])->get('inward_delivery')->row()->balanceqty;
$balanceqtyQry=$this->db->select('balanceqty')->where('id',$rows['inwardid'])->get('inward_delivery')->row();
//$balanceqtyQry = $this->db->select('balanceqty')->where('inwardno',$rows['inwardno'])->where('itemname',$rows['itemname'])->get('inward_delivery')->row();
if($balanceqtyQry)
{
$balanceqty = $balanceqtyQry->balanceqty;
}
else
{
$balanceqty = 0;
}
$totalqty=$balanceqty+$rows['qty'];
$html.='
<tr>
<td>
<input class="form-control" parsley-trigger="change" readonly id="ids" type="hidden" name="ids[]" value="'.$rows['inwardid'].'"> 
<input class="form-control" parsley-trigger="change" readonly id="hsnno" type="text" name="hsnno[]" value="'.$rows['hsnno'].'">
<div id="hsnno_valid"></div>
</td>
<td>
<input class="form-control" parsley-trigger="change" required id="" readonly type="text" name="customerdcno[]" value="'.$rows['customerdcno'].'"><input class="form-control" parsley-trigger="change" required id="" readonly type="hidden" name="customerdcdate[]" value="'.$rows['customerdcdate'].'">
<div id="itemname_valid"></div>
</td>
<td>
<input class="form-control" parsley-trigger="change" required id="" readonly type="text" name="itemname[]" value="'.$rows['itemname'].'">
<div id="itemname_valid"></div><input type="text" name="item_desc[]" value="'.$rows['item_desc'].'" style="margin-top: 2px;" class="form-control">
</td>
<td>
<input class="form-control" value="'.$rows['uom'].'" readonly id="uom" type="text" name="uom[]" autocomplete="off">
<div id="qty_valid"></div>
</td>
<td>
<input class="form-control" parsley-trigger="change" required id="qty'.$rows['id'].'" value="'.$rows['qty'].'" type="text" name="qty[]"  autocomplete="off">
<input class="form-control"  id="inwardqty'.$rows['id'].'" type="hidden" name="inwardqty[]" value="'.$totalqty.'" autocomplete="off">
<div id="qty_valid" style="color:green;">Remaining Inward Qty : '.$balanceqty.'</div>
</td>
<td>
<input class="form-control" id="remarks" type="text" name="remarks[]"  value="'.$rows['remarks'].'" autocomplete="off">
<div id="qty_valid"></div>
</td>
</tr>';
}
$html.='
</tbody>
</table>
<br>
<div class="col-sm-offset-4">
<button  class="btn btn-info" id="submit" name="save" value="save">Update</button>
<button type="reset"  class="btn btn-default" id="">Reset</button>
</div>
<script>
$(".remove").click(function(){
$(this).parents("tr").remove();
});
</script>';
foreach ($data as $rows) 
{
$html.='
<script>
$("#qty'.$rows['id'].'").keyup(function(){
var qty=$("#qty'.$rows['id'].'").val();
var inwardqty=$("#inwardqty'.$rows['id'].'").val();
if(parseFloat(qty) > parseFloat(inwardqty))
{
alert("Invalid Qty");
$("#qty'.$rows['id'].'").val("");
$("#qty'.$rows['id'].'").focus();
}
});
</script>';
}
echo $html;
}

public function geteditinward_details()
{
$id=$this->input->post('id');
$data['result']=$this->db->where('id',$id)->get('dcbill_details')->result_array();
$this->load->view('editdirectdc',$data);
}
}

ob_flush();

?>
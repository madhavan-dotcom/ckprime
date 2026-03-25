<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Inward extends CI_Controller {

public function __construct()
{
parent::__construct();
$this->load->model('inward_model');
$this->load->model('inward_itemwise_model');
$this->load->model('dcwise_model');
if($this->session->userdata('rcbio_login')=='')
{
$this->session->set_flashdata('msg','Please Login to continue!');
redirect('login');
}
}
public function index()
{
    $query_update1 =$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('inward_details')->result_array();
    foreach($query_update1 as $row)
    {
    $quotationnos=$row['inwardno'];
    $default_bond=$this->db->where('id',1)->get('preference_settings')->row();
    $new_bond_prefix = $default_bond->inwardPrefix;
    @$quotationnos=str_replace($new_bond_prefix,'',$quotationnos);
    }
    
    if(date('m')=='04')
    {
    $month=date('m');
    $year=date('Y');
    $old=$this->db->where('month(date)', $month)->where('year(date) ', $year)->get('inward_details')->result_array();
    if($old)
    {
    @$bond_no = $quotationnos;
    if(is_null($bond_no))
    {
    $default_bond=$this->db->where('id',1)->get('preference_settings')->row();
    $new_bond_prefix = $default_bond->inwardPrefix;
    $new_bond_noo = $new_bond_prefix.$default_bond->inward;
    //$new_bond_noo = '100001'; 
    } 
    else 
    {
    $default_bond=$this->db->where('id',1)->where('inward !=','')->get('preference_settings')->row();
    if($default_bond)
    {
    $bond_no=$default_bond->inward;
    $bondLen = strlen($bond_no);
    $bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
    $new_bond_prefix = $default_bond->inwardPrefix;
    $new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d',$bondOnlyNum);
    }
    else
    {
    $bondLen = strlen($bond_no);
    $bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
    $default_bond=$this->db->where('id',1)->get('preference_settings')->row();
    $new_bond_prefix = $default_bond->inwardPrefix;
    $new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', (float)$bondOnlyNum + 1);
    }
    
    }
    }
    else
    {
    $default_bond=$this->db->where('id',1)->get('preference_settings')->row();
    $new_bond_prefix = $default_bond->inwardPrefix;
    $new_bond_noo = $new_bond_prefix.$default_bond->inward;
    //$new_bond_noo = '100001';
    }
    
    }
    else
    {
    @$bond_no = $quotationnos;
    if(is_null($bond_no))
    {
    $default_bond=$this->db->where('id',1)->get('preference_settings')->row();
    $new_bond_prefix = $default_bond->inwardPrefix;
    $new_bond_noo = $new_bond_prefix.$default_bond->inward;
    //$new_bond_noo = '100001'; 
    } 
    else
    {
    $default_bond=$this->db->where('id',1)->where('inward !=','')->get('preference_settings')->row();
    if($default_bond)
    {
    @$bond_no=$default_bond->inward;
    $new_bond_prefix = $default_bond->inwardPrefix;
    $bondLen = strlen($bond_no);
    $bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
    $new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
    }
    else
    {
    $bondLen = strlen($bond_no);
    $default_bond=$this->db->where('id',1)->get('preference_settings')->row();
    $new_bond_prefix = $default_bond->inwardPrefix;
    $bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
    $new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', (int)$bondOnlyNum + 1);
    }
    }
    }
$data['cusno']=$new_bond_noo;
$data['grade'] = $this->db->where('status',1)->get('grade')->result();
$this->load->view('header');
$this->load->view('add_inward',$data);
$this->load->view('footer1');
}

Public function create()
{
$type=$this->uri->segment(3);    
$data['']=$this->backup_model->create_backup($type);
}

public function insert()
{
$hsnno=implode('||',array_filter($_POST['hsnno']));
$itemcode=implode('||',array_filter($_POST['itemcode']));
$heatno = implode('||',array_filter($_POST['heatno']));
$itemname=implode('||',array_filter($_POST['itemname']));
$itemid = implode('||',array_filter($_POST['itemid']));
$item_desc=implode('||',array_filter($_POST['item_desc']));
$uom=implode('||',array_filter($_POST['uom']));
$grade = implode('||',array_filter($_POST['grade']));
$qty=implode('||',array_filter($_POST['qty']));
$remarks=implode('||',array_filter($_POST['remarks']));
$inwardnoyear=$_POST['inwardno'].''.date('-y').'';
$inwardnodate=$_POST['inwardno'].''.date('dmy').'';

$data=array('date'=>date('Y-m-d'),
'inwardno'=>$_POST['inwardno'],
'inwarddate'=>date('Y-m-d',strtotime($_POST['inwarddate'])),
'cusname'=>$_POST['cusname'],
'address'=>$_POST['address'], 
'customerdcno'=>$_POST['customerdcno'],
'customerdcdate'=>date('Y-m-d',strtotime($_POST['customerdcdate'])),
'heatno'=>$heatno,
'itemname'=>$itemname,
'itemid'=>$itemid,
'item_desc'=>$item_desc,
'qty'=>$qty,
'remarks'=>$remarks,
'hsnno'=>$hsnno,
'itemcode'=>$itemcode,
'uom'=>$uom,
'grade'=>$grade,
'inwardnoyear'=>$inwardnoyear,
'inwardnodate'=>$inwardnodate,
'status'=>1, 
'delete_status'=>1, 
);

$result=$this->inward_model->add($data);
if($result==true)
{
$insertid=$this->db->insert_id();
$this->db->query("UPDATE preference_settings SET inward='' WHERE id=1");
$hsnnos=$_POST['hsnno'];
$itemcodes=$_POST['itemcode'];
$itemidds=$_POST['itemid'];
$heatnos = $_POST['heatno'];
$itemnames=$_POST['itemname'];
$item_descs=$_POST['item_desc'];
$uoms=$_POST['uom'];
$grades = $_POST['grade'];
$qtys=$_POST['qty'];
$remarkss=$_POST['remarks'];
$count=count($_POST['itemname']);
$insertIdArray =array();
for ($i=0; $i <$count ; $i++) { 
$datas=array('date'=>date('Y-m-d'),
'insertid'=>$insertid,
'inwardno'=>$_POST['inwardno'],
'inwarddate'=>date('Y-m-d',strtotime($_POST['inwarddate'])),
'cusname'=>$_POST['cusname'],
'address'=>$_POST['address'], 
'customerdcno'=>$_POST['customerdcno'],
'customerdcdate'=>date('Y-m-d',strtotime($_POST['customerdcdate'])),
'itemname'=>$itemnames[$i],
'item_desc'=>$item_descs[$i],
'qty'=>$qtys[$i],
'grade'=>$grades[$i],
'heatno'=>$heatnos[$i],
'balanceqty'=>$qtys[$i],
'lastupdatedqty'=>$qtys[$i],
'remarks'=>$remarkss[$i],
'hsnno'=>$hsnnos[$i],
'itemcode'=>$itemcodes[$i],
'uom'=>$uoms[$i],
'itemid'=>$itemidds[$i],
'inwardnoyear'=>$inwardnoyear,
'inwardnodate'=>$inwardnodate,
'status'=>1, 
'inward_status'=>1, 
);
$this->db->insert('inward_delivery',$datas);
$insertIdArray[]=$this->db->insert_id();
}
$this->db->query("UPDATE inward_details SET inward_delivery_id='".implode(",",$insertIdArray)."' WHERE id='".$insertid."' ");
$this->session->set_flashdata('msg','Inward Added Successfully');
redirect('inward');
}
else
{
$this->session->set_flashdata('msg1','Inward Added Unsuccessfully');
redirect('inward');
}

}

public function edit()
{
$id=base64_decode($this->uri->segment(3));
$data['result']=$this->db->where('id',$id)->get('inward_details')->result_array(); 
$this->load->view('header');
$this->load->view('edit_inward',$data);
$this->load->view('footer');
}

public function update()
{
$id=$_POST['id'];
$hsnno=implode('||',array_filter($_POST['hsnno']));
$itemcode=implode('||',array_filter($_POST['itemcode']));
$itemname=implode('||',array_filter($_POST['itemname']));
$itemid=implode('||',array_filter($_POST['itemid']));
$item_desc=implode('||',array_filter($_POST['item_desc']));
$uom=implode('||',array_filter($_POST['uom']));
$qty=implode('||',array_filter($_POST['qty']));
$grade=implode('||',array_filter($_POST['grade']));
$heatno=implode('||',array_filter($_POST['heatno']));
$remarks=implode('||',array_filter($_POST['remarks']));
$inwardnoyear=$_POST['inwardno'].''.date('-y').'';
$inwardnodate=$_POST['inwardno'].''.date('dmy').'';
$inward_delivery_id = implode(",",$_POST['inward_delivery_id']);

$data=array('date'=>date('Y-m-d'),
'inwardno'=>$_POST['inwardno'],
'inwarddate'=>date('Y-m-d',strtotime($_POST['inwarddate'])),
'cusname'=>$_POST['cusname'],
'address'=>$_POST['address'], 
'customerdcno'=>$_POST['customerdcno'],
'customerdcdate'=>date('Y-m-d',strtotime($_POST['customerdcdate'])),
'itemname'=>$itemname,
'itemid'=>$itemid,
'item_desc'=>$item_desc,
'qty'=>$qty,
'remarks'=>$remarks,
'hsnno'=>$hsnno,
'itemcode'=>$itemcode,
'uom'=>$uom,
'grade'=>$grade,
'heatno'=>$heatno,
'inwardnoyear'=>$inwardnoyear,
'inwardnodate'=>$inwardnodate,
'inward_delivery_id' => $inward_delivery_id
);

$result=$this->inward_model->updates($data,$id);
if($result==true)
{
$checkdata=$this->db->where('insertid',$_POST['id'])->get('inward_delivery')->result_array();
if($checkdata)
{
$counts=count($checkdata);
for ($j=0; $j <$counts ; $j++) { 
$this->db->where('insertid',$_POST['id'])->delete('inward_delivery');
}
}
$insertid=$id;
$hsnnos=$_POST['hsnno'];
$itemcodes=$_POST['itemcode'];
$heatnos=$_POST['heatno'];
$itemnames=$_POST['itemname'];
$itemids=$_POST['itemid'];
$item_descs=$_POST['item_desc'];
$uoms=$_POST['uom'];
$grades=$_POST['grade'];
$qtys=$_POST['qty'];
$remarkss=$_POST['remarks'];
$inwdelId = $_POST['inward_delivery_id'];
$count=count($_POST['itemname']);
$insertIdArray =array();
for ($i=0; $i <$count ; $i++) { 
if($inwdelId[$i]=='')
{
$datas=array(
'date'=>date('Y-m-d'),
'insertid'=>$insertid,
'inwardno'=>$_POST['inwardno'],
'inwarddate'=>date('Y-m-d',strtotime($_POST['inwarddate'])),
'cusname'=>$_POST['cusname'],
'address'=>$_POST['address'], 
'customerdcno'=>$_POST['customerdcno'],
'customerdcdate'=>date('Y-m-d',strtotime($_POST['customerdcdate'])),
'itemname'=>$itemnames[$i],
'itemid'=>$itemids[$i],
'itemcode'=>$itemcodes[$i],
'heatno'=>$heatnos[$i],
'item_desc'=>$item_descs[$i],
'qty'=>$qtys[$i],
'balanceqty'=>$qtys[$i],
'lastupdatedqty'=>$qtys[$i],
'remarks'=>$remarkss[$i],
'hsnno'=>$hsnnos[$i],
'itemcode'=>$itemcodes[$i],
'uom'=>$uoms[$i],
'grade'=>$grades[$i],
'inwardnoyear'=>$inwardnoyear,
'inwardnodate'=>$inwardnodate,
'status'=>1, 
'inward_status'=>1, 
);

// print_r($datas);die;

$this->db->insert('inward_delivery',$datas);
$insertIdArray[]=$this->db->insert_id();
}
else
{
$datas=array('id' => $inwdelId[$i],
'date'=>date('Y-m-d'),
'insertid'=>$insertid,
'inwardno'=>$_POST['inwardno'],
'inwarddate'=>date('Y-m-d',strtotime($_POST['inwarddate'])),
'cusname'=>$_POST['cusname'],
'address'=>$_POST['address'], 
'customerdcno'=>$_POST['customerdcno'],
'customerdcdate'=>date('Y-m-d',strtotime($_POST['customerdcdate'])),
'itemname'=>$itemnames[$i],
'itemid'=>$itemids[$i],
'itemcode'=>$itemcodes[$i],
'heatno'=>$heatnos[$i],
'item_desc'=>$item_descs[$i],
'qty'=>$qtys[$i],
'balanceqty'=>$qtys[$i],
'lastupdatedqty'=>$qtys[$i],
'remarks'=>$remarkss[$i],
'hsnno'=>$hsnnos[$i],
'itemcode'=>$itemcodes[$i],
'uom'=>$uoms[$i],
'grade'=>$grades[$i],
'inwardnoyear'=>$inwardnoyear,
'inwardnodate'=>$inwardnodate,
'status'=>1, 
'inward_status'=>1, 
);
// echo '<pre>';


$this->db->insert('inward_delivery',$datas);
$insertIdArray[]=$inwdelId[$i];
}

}
$this->db->query("UPDATE inward_details SET inward_delivery_id='".implode(",",$insertIdArray)."' WHERE id='".$insertid."' ");
$this->session->set_flashdata('msg','Inward Added Successfully');
redirect('inward');
}
else
{
$this->session->set_flashdata('msg1','Inward Added Unsuccessfully');
redirect('inward');
}
}

public function view()
{
$data['inward']=$this->inward_model->select();
$this->load->view('header');
$this->load->view('inward_view',$data);
$this->load->view('footer1');
}

public function pending()
{
$data['view']=$this->inward_model->select_pending();
$this->load->view('header');
$this->load->view('inward_pending',$data);
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
$list = $this->inward_model->get_datatables();
//print_r($list);
$data = array();
$no = $_POST['start'];
$a=1;
$totalamount[]=array();
foreach ($list as $person) {
$no++;
$row = array();
$row[] = $a++;
$row[] = date('d-m-Y',strtotime($person->inwarddate));
$row[] =$person->inwardno;
$row[] = $person->cusname;
$row[] = $person->customerdcno;
$row[] = date('d-m-Y',strtotime($person->customerdcdate));
//$delestatus=$this->db->where('insertid',$person->id)->get('inward_delivery')->num_rows();
//$inwardstatus=$this->db->select_sum('inward_status')->where('insertid',$person->id)->get('inward_delivery')->row()->inward_status;
$delestatus=$person->delete_status;
if($delestatus==1) 
{ 
$editLink = base_url().'inward/edit/'.base64_encode($person->id);
$deleteLink = 'delete_person('."'".$person->id."'".')';
}
else
{
$editLink = 'javascript:alert(\'Sorry! You cannot able to edit\');';
$deleteLink = 'javascript:alert(\'Sorry! You cannot able to delete\');';
}
$htmls='
<div class="btn-group">
<button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light"  data-toggle="dropdown" aria-expanded="false">Manage <span class="caret"></span></button>
<ul class="dropdown-menu" role="menu" style="background: #23BDCF  none repeat scroll 0% 0%;width:14px;min-width: 100%;">
<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Delete" onclick="view_person('."'".$person->id."'".')">View</a></li>';
$htmls.='<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.$editLink.'" >Edit </a></li>';
$htmls.='<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Delete" onclick="'.$deleteLink.'" >Delete</a></li>';

/*if($delestatus==$inwardstatus)
{
$htmls.='<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url().'inward/edit/'.base64_encode($person->id).'" >Edit '.$delestatus.'</a></li>';
$htmls.='<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Delete" onclick="delete_person('."'".$person->id."'".')">Delete</a></li>';
}
else
{
}*/

$htmls.='
</ul>
</div>
';
$row[] = $htmls;
$data[] = $row;
}
$output = array(
"draw" => $_POST['draw'],
"recordsTotal" => $this->inward_model->count_all(),
"recordsFiltered" => $this->inward_model->count_filtered(),
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

$data=array('rcbio_fromdate' => $fromdate,
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
$data['purchase']=$this->inward_model->search_billing();
$data['fromdate']=$this->session->userdata('rcbio_fromdate');
$data['todate']=$this->session->userdata('rcbio_todate');
$data['customername']=$this->session->userdata('rcbio_customername');
$this->load->view('inwardstmt_report',$data);
}

}
public function download()
{
$fromdate=$this->input->post('fromdate');
$todate=$this->input->post('todate');
$customername=$this->input->post('customername');

$data=array('rcbio_fromdate' => $fromdate,
'rcbio_todate' => $todate,
'rcbio_customername' => $customername,
'rcbio_bill_format' =>'Excel',
);
$this->session->set_userdata($data);

}
public function excel_download(){
    
     $bill_format=$this->session->userdata('rcbio_bill_format'); 
     if($bill_format=='Excel'){
    $val=$this->inward_model->search_billing();
$this->load->library('excel');
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('Inward Reports');
//set cell A1 content with some text
$this->excel->getActiveSheet()->setCellValue('A1', 'INWARD DETAILS');
$this->excel->getActiveSheet()->setCellValue('A2', 'DATE');
$this->excel->getActiveSheet()->setCellValue('B2', 'INWARD NO');
$this->excel->getActiveSheet()->setCellValue('C2', 'NAME');
$this->excel->getActiveSheet()->setCellValue('D2', 'CUSTOMER DC NO');
$this->excel->getActiveSheet()->setCellValue('E2', 'CUSTOMER DC DATE');
$this->excel->getActiveSheet()->setCellValue('F2', 'HSN CODE');
$this->excel->getActiveSheet()->setCellValue('G2', 'ITEM NAME');
$this->excel->getActiveSheet()->setCellValue('H2', 'UOM');
$this->excel->getActiveSheet()->setCellValue('I2', 'QTY');



//merge cell A1 until C1
$this->excel->getActiveSheet()->mergeCells('A1:I1');
//set aligment to center for that merged cell (A1 to C1)
$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//make the font become bold
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

for($col = ord('A'); $col <= ord('I'); $col++){
//set column dimension
$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
//change the font size
$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}
//retrive contries table data

//$rs = $this->db->get('countries');

$exceldata=array();
foreach ($val as $row)
{


$data['date']=date('d-m-Y',strtotime($row['date']));
$data['inwardno']=$row['inwardno'];
$data['cusname']=$row['cusname'];
$data['customerdcno']=$row['customerdcno'];
$data['customerdcdate']=$row['customerdcdate'];
$data['hsnno']=$row['hsnno'];
$data['itemname']=$row['itemname'];
$data['uom']=$row['uom'];
$data['qty']=$row['qty'];
@$exceldata[] = $data;
}
//Fill data 

if(count($exceldata) > 0)
{
$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');
}


$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$filename='Inward Reports-'.date('d/m/y').'.xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
}
}

public function viewbilling()
{
$id=$this->input->post('id');
$data=$this->db->where('id',$id)->get('inward_details')->result_array();
if($data)
{
foreach ($data as $row) {
$html='
<div class="row">
<table class="table m-0">
<thead>
<tr>
<th>S.No</th>
<th>HSN Code</th>
<th>Item Name</th>
<th>UOM</th>
<th>Qty</th>
<th>Remarks</th>
</tr>   
</thead>
<tbody>';
$hsnno=explode('||',$row['hsnno']);
$itemname=explode('||',$row['itemname']);
$uom=explode('||',$row['uom']);
$qty=explode('||',$row['qty']);
$remarks=explode('||',$row['remarks']);
$count=count($itemname);
$a=1;
for ($i=0; $i < $count; $i++) { 
$html.='
<tr>
<td>'.$a++.'</td>
<td>'.$hsnno[$i].'</td>
<td>'.$itemname[$i].'</td>
<td>'.$uom[$i].'</td>
<td>'.$qty[$i].'</td>
<td>'.@$remarks[$i].'</td>
</tr>';

}

$html.='
</tbody>
</table>
</div>
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4"></div>
</div>';
}
}
else
{
$html='';
}
echo $html;
}

//       public function ajax_delete($id)
// {
//  $this->inward_model->delete_by_id($id);
//  echo json_encode(array("status" => TRUE));
// }

Public function delete()
{    
$data=$this->db->where('id',$_POST['id'])->delete('inward_details');
if($data)
{
$checkdata=$this->db->where('insertid',$_POST['id'])->get('inward_delivery')->result_array();
if($checkdata)
{
$count=count($checkdata);
for ($i=0; $i <$count ; $i++) { 
$this->db->where('insertid',$_POST['id'])->delete('inward_delivery');
}
}
echo'yes';
}
else
{
echo'no';   
} 
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
$json_array['itemid']  = $d->id;
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

public function check_cusname()
{
$name=$_POST['cusname'];
$data=$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('name',$name)->get('customer_details')->result();
echo $count=count($data);
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
@$uom=$this->db->select('uom')->where('id',$h->uom)->get('uom')->row()->uom;
@$grade=$this->db->select('grade')->where('id',$h->grade)->get('grade')->row()->grade;
$vob['hsnno']=$h->hsnno;
$vob['itemid']=$h->id;
$vob['itemcode']=$h->itemcode;
$vob['uom']=$uom;
$vob['grade']=$grade;
}
echo json_encode($vob);
}

public function itemwise_report()
{
    $this->load->view('header');
    $this->load->view('inward_itemwise');
    $this->load->view('footer1');
}

public function itemwise_ajax_list()
	{
		$list = $this->inward_itemwise_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$a=1;
		$totalamount[]=array();
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $a++;
// 			$row[] = date('d-m-Y',strtotime($person->inwarddate));
			$row[] = date('d-m-Y',strtotime($person->customerdcdate));
			$row[] = $person->customerdcno;
			$row[] = $person->cusname;
			$row[] = $person->itemname;
			$row[] = $person->qty;

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->inward_itemwise_model->count_all(),
			"recordsFiltered" => $this->inward_itemwise_model->count_filtered(),
			"data" => $data,
		);
//output to json format
		echo json_encode($output);
	}


	public function dcwise_report()
	{
		$this->load->view('header');
		$this->load->view('dcwise_report');
		$this->load->view('footer1');
	}

	public function dcwise_ajax_list()
	{
		$list = $this->dcwise_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$a=1;
		$totalamount[]=array();
		foreach($list as $person)
		{

			$inwardno = $this->db->select('inwardno')->where('id',$person->inwardid)->get('inward_details')->row()->inwardno;
			
			
			$no++;
			$row = array();
			$row[]=$a++;
			$row[]= date('d-m-y',strtotime($person->dcdate));
			$row[] = $inwardno;
			$row[] = $person->cusname;
			$row[] =$person->dcno;
			$row[] = $person->qty;

			$data[] = $row;
		
		}
	
	
	$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $this->dcwise_model->count_all(),
		"recordsFiltered" => $this->dcwise_model->count_filtered(),
		"data" => $data,
	);
		echo json_encode($output);
	}

	public function reports()
	{
		$fromdate = $_POST['fromdate'];
		$todate   = $_POST['todate'];
		$customername = $_POST['customername'];
		$dcno = $_POST['dcno'];
		$inwardno = $_POST['inwardno'];
		$data['dcdetails'] = $this->dcwise_model->search_dc();
		$this->load->view('dcwise_overall_reports',$data,$fromdate,$todate,$customername,$dcno,$inwardno);
 	}
}
ob_flush();
?>

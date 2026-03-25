<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class HsnMaster extends CI_Controller {

public function __construct()
{
parent::__construct();
$this->load->model('hsn_model');
if($this->session->userdata('rcbio_login')=='')
{

$this->session->set_flashdata('msg','Please Login to continue!');
redirect('login');
}
date_default_timezone_set('Asia/Kolkata');
}
public function index()
{
$data['uom']=$this->hsn_model->select();
$this->load->view('header');
$this->load->view('addhsn',$data);
$this->load->view('footer1');
}

Public function get_uom()
{	


$id=$_POST['uom_id'];

// echo"<pre>";
// print_r($id);

$where=array('id'=>$_POST['uom_id']);
$data = $this->db->get_where('hsnMaster',$where)->row();
echo json_encode($data);



}

public function insert()
{


$data=
array(
'date'=>date('Y-m-d'),
'hsnno' =>$_POST['hsnno'],

'status'=>1);
$result=$this->hsn_model->add($data); 
if($result==true)
{
$this->session->set_flashdata('msg','HSNNO  Added Successfully!');
redirect('hsnMaster');
}
else
{
$this->session->set_flashdata('msg1','HSNNO Added Unsuccessfully!');
redirect('hsnMaster');
}
}


public function delete()
{
$del=$this->input->post('id');
$data=$this->db->where('id',$del)->delete('hsnMaster');
if($data)
{
$this->session->set_flashdata('msg','HSNNO  Deleted Successfully!');
redirect('hsnMaster');
}
else
{
$this->session->set_flashdata('msg1','HSNNO  Deleted Unsuccessfully');
redirect('hsnMaster');
}
}
public function checkUom()
{
$uom = $this->input->post('uom');
$checkExists=$this->db->where('uom', $uom)->count_all_results('hsnMaster');
echo $checkExists;
}
}

ob_flush();
?>
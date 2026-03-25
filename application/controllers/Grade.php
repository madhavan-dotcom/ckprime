<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Grade extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		  $this->load->model('grade_model');
		 if($this->session->userdata('rcbio_login')=='')
		{
			
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}
	public function index()
	{
		$data['grade']=$this->grade_model->select();
		$this->load->view('header');
		$this->load->view('addgrade',$data);
		$this->load->view('footer1');
	}

	Public function get_grade()
	{	
		$id=$_POST['grade_id'];
		// echo"<pre>";
		// print_r($id);
		$where=array('id'=>$_POST['grade_id']);
		$data = $this->db->get_where('grade',$where)->row();
		echo json_encode($data);
	}


	public function insert()
	{
		$data=
		array(
			'date'=>date('Y-m-d'),
			'grade' =>$_POST['grade'],
			'heat_treatment'=>$_POST['heat_treatment'],
			'hsnno' => $_POST['hsnno'],	
			'element' => implode(',',$_POST['element']),
			'min_value' => implode(',',$_POST['min_value']),
			'max_value' => implode(',',$_POST['max_value']),	
			'mechanicalelement' =>implode(',',$_POST['mechanicalelement']),
			'mechanicalminvalue' =>implode(',',$_POST['mechanicalminvalue']),
			'mechanicalmaxvalue' =>implode(',',$_POST['mechanicalmaxvalue']),
			'remarks' => $_POST['remarks'],
			'status'=>1
		);
		$result=$this->grade_model->add($data); 
		if($result==true)
		{
			$this->session->set_flashdata('msg','Grade  Added Successfully!');
			redirect('grade');
		}
		else
		{
			$this->session->set_flashdata('msg1','Grade Added Unsuccessfully!');
			redirect('grade');
		}
	}

	public function editgrade($id)
	{
		$data['grade_data']=$this->grade_model->edit_select($id);
		$this->load->view('header');
		$this->load->view('editgrade',$data);
		$this->load->view('footer1');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data=
		array(
			// 'date'=>date('Y-m-d'),
			'grade' =>$_POST['grade'],
			'heat_treatment'=>$_POST['heat_treatment'],
			'hsnno' => $_POST['hsnno'],	
			'element' => implode(',',$_POST['element']),
			'min_value' => implode(',',$_POST['min_value']),
			'max_value' => implode(',',$_POST['max_value']),	
			'mechanicalelement' =>implode(',',$_POST['mechanicalelement']),
			'mechanicalminvalue' =>implode(',',$_POST['mechanicalminvalue']),
			'mechanicalmaxvalue' =>implode(',',$_POST['mechanicalmaxvalue']),
			'remarks' => $_POST['remarks'],
			'status'=>1
		);
// 		print_r($data);die;
		$result=$this->grade_model->updategrade($id,$data); 
		if($result==true)
		{
			$this->session->set_flashdata('msg','Grade  Added Successfully!');
			redirect('grade');
		}
		else
		{
			$this->session->set_flashdata('msg1','Grade Added Unsuccessfully!');
			redirect('grade');
		}
	}


	// public function view()
	// {  
	// 	$data['user']=$this->tax_model->select();
	// 	$this->load->view('header');
	// 	$this->load->view('addvat',$data);
	// 	$this->load->view('footer1');
	// }

	// public function update()
	// {
	// 	$id =$_POST['id'];
	// 	$data=
	// 	array(
	// 		'date'=>date('Y-m-d'),
	// 		'username' =>$_POST['username'],
	// 		'name' =>$_POST['name'],
	// 		'password' =>$_POST['password'],
	// 		'status'=>1);
	// 	$result=$this->user_model->user_update($id,$data); 
	// 	if($result==true)
	// 	{
	// 		$this->session->set_flashdata('msg','User  Updated Successfully!');
	// 		redirect('user');
	// 	}
	// 	else
	// 	{
	// 		$this->session->set_flashdata('msg1','No changes');
	// 		redirect('user');
	// 	}
	// }
	public function delete()
	{
		$del=$this->input->post('id');
		$data=$this->db->where('id',$del)->delete('grade');
		if($data)
		{
			$this->session->set_flashdata('msg','Grade  Deleted Successfully!');
			redirect('grade');
		}
		else
		{
			$this->session->set_flashdata('msg1','Grade  Deleted Unsuccessfully');
			redirect('grade');
		}
	}
	public function checkgrade()
	{
		$grade = $this->input->post('grade');
		$checkExists=$this->db->where('grade', $grade)->count_all_results('grade');
		echo $checkExists;
	}
}

ob_flush();
?>
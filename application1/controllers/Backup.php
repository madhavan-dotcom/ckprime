<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
// error_reporting(0);
class Backup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		  $this->load->model('backup_model');
		 if($this->session->userdata('rcbio_login')=='')
		{
			
			$this->session->set_flashdata('msg','Please Login to continue!');
			date_default_timezone_set('Asia/Kolkata');
			redirect('login');
		}
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('add_backup');
		$this->load->view('footer1');
	}

	Public function create()
	{
		 $type=$this->uri->segment(3);		
		$data['']=$this->backup_model->create_backup($type);
			
			
		
	}
	public function savebackup(){

		$data = $this->db->where('status',1)->get('backup_url')->row();
		if($data)
		{
			$type = $data->url;
		}
		else{
	 	 $type=$_POST['url'];
		  $datas = array(
			'url'=>$type,
			'status'=>1
		 );
		 $this->db->insert('backup_url',$datas);
		}
	 	
		$data=$this->backup_model->saveuser_url($type); 
		redirect('Dashboard');
	}

}

ob_flush();
?>
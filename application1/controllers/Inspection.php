<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Inspection extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}	
		date_default_timezone_set('Asia/Kolkata');		
	}
	public function index()
	
	{

		$this->load->view('inspection');
	}
}
<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Inspectionmaster extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('inspectionmaster_model');
        if ($this->session->userdata('rcbio_login') == '') {
            $this->session->set_flashdata('msg', 'Please Login to continue!');
            redirect('login');
        }
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index()
    {
        $data['inspection'] = $this->inspectionmaster_model->select();
        $this->load->view('header');
        $this->load->view('addinspectionmaster', $data);
        $this->load->view('footer1');
    }

    public function insert()
    {
        $data = array(
            'date' => date('Y-m-d'),
            'itemid' => $this->input->post('itemid'),
            'product_code' => $this->input->post('product_code'),
            'itemname' => $this->input->post('itemname'),
            'sno' => implode(',', $this->input->post('sno')),
            'view' => implode(',', $this->input->post('view')),
            'length' => implode(',', $this->input->post('length')),
            'status' => 1,
        );
        $result = $this->inspectionmaster_model->add($data);
        if ($result) {
            $this->session->set_flashdata('msg', 'Inspection Master Added Successfully!');
            redirect('Inspectionmaster');
        } else {
            $this->session->set_flashdata('err', 'Technical Problem! Please try again later.');
            redirect('Inspectionmaster');
        }
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $data['edit'] = $this->inspectionmaster_model->editdata($id);
        $this->load->view('header');
        $this->load->view('editinspectionmaster', $data);
        $this->load->view('footer1');
    }

    public function update()
    {
        $id = $this->input->post('id');
        
        $data = array(
            'date' => date('Y-m-d'),
            'itemid' => $this->input->post('itemid'),
            'product_code' => $this->input->post('product_code'),
            'itemname' => $this->input->post('itemname'),
            'sno' => implode(',', $this->input->post('sno')),
            'view' => implode(',', $this->input->post('view')),
            'length' => implode(',', $this->input->post('length')),
            'status' => 1,
        );
        
        $result = $this->inspectionmaster_model->update($id, $data);
        if ($result) {
            $this->session->set_flashdata('msg', 'Inspection Master Updated Successfully!');
            redirect('Inspectionmaster');
        } else {
            $this->session->set_flashdata('err', 'Technical Problem! Please try again later.');
            redirect('Inspectionmaster');
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $result = $this->inspectionmaster_model->delete($id);
        if ($result) {
            $this->session->set_flashdata('msg', 'Inspection Master Deleted Successfully!');
            redirect('Inspectionmaster');
        } else {
            $this->session->set_flashdata('err', 'Technical Problem! Please try again later.');
            redirect('Inspectionmaster');
        }
    }

}
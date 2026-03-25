<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Mtc extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtc_model');
		$this->load->model('Inspection_model');
		$this->load->model('Ut_model');
		$this->load->model('Mpt_model');
		$this->load->model('Dpt_model');

		if ($this->session->userdata('rcbio_login') == '') {
			$this->session->set_flashdata('msg', 'Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}
	public function index($code = null)
	{
		// print_r($code);die;
		$decode = base64_decode($code);
		$data['report'] = $this->db->where('id', $decode)->get('mtc_report')->row(); // Pass to the view if needed
		$this->load->view('mtc', $data);
	}

	public function edit($code = null)
	{
		$edit = base64_decode($code);
		$data['edit'] = $this->db->where('id', $edit)->get('mtc_report')->row();
		$this->load->view('header');
		$this->load->view('edit_mtc', $data);
		$this->load->view('footer1');
	}
	public function create_mtc()
	{
		$query_update1 = $this->db->where('status', 1)->order_by('id', 'desc')->limit(1)->get('mtc_report')->result_array();
		foreach ($query_update1 as $row) {
			$quotationnos = $row['tcno'];
			$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
			$new_bond_prefix = $default_bond->mtcPrefix;
			@$quotationnos = str_replace($new_bond_prefix, '', $quotationnos);
		}

		if (date('m') == '04') {
			$month = date('m');
			$year = date('Y');
			$old = $this->db->where('month(date)', $month)->where('year(date) ', $year)->get('mtc_report')->result_array();
			if ($old) {
				@$bond_no = $quotationnos;
				if (is_null($bond_no)) {
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->mtcPrefix;
					$new_bond_noo = $new_bond_prefix . $default_bond->tcno;
					//$new_bond_noo = '100001'; 
				} else {
					$default_bond = $this->db->where('id', 1)->where('tcno !=', '')->get('preference_settings')->row();
					if ($default_bond) {
						$bond_no = $default_bond->tcno;
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_prefix = $default_bond->mtcPrefix;
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
					} else {
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
						$new_bond_prefix = $default_bond->mtcPrefix;
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (float)$bondOnlyNum + 1);
					}
				}
			} else {
				$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->mtcPrefix;
				$new_bond_noo = $new_bond_prefix . $default_bond->tcno;
				//$new_bond_noo = '100001';
			}
		} else {
			@$bond_no = $quotationnos;
			if (is_null($bond_no)) {
				$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->mtcPrefix;
				$new_bond_noo = $new_bond_prefix . $default_bond->tcno;
				//$new_bond_noo = '100001'; 
			} else {
				$default_bond = $this->db->where('id', 1)->where('tcno !=', '')->get('preference_settings')->row();
				if ($default_bond) {
					@$bond_no = $default_bond->tcno;
					$new_bond_prefix = $default_bond->mtcPrefix;
					$bondLen = strlen($bond_no);
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
				} else {
					$bondLen = strlen($bond_no);
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->mtcPrefix;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (int)$bondOnlyNum + 1);
				}
			}
		}
		$data['tcno'] = $new_bond_noo;
		$this->load->view('header');
		$this->load->view('createmtc', $data);
		$this->load->view('footer1');
	}

	public function reports_mtc()
	{
		$this->load->view('header');
		$this->load->view('reportsmtc');
		$this->load->view('footer1');
	}

	// public function getpodetails()
	// {
	// 	$pono = $this->input->post('pono');
	// 	$po = $this->input->post('po');
	// 	$getpodetails = $this->db->where('purchaseorderno', $pono)->where('purchaseorder', $po)->where('status', 1)->get('purchaseorder_reports')->row();
	// 	echo json_encode($getpodetails);
	// }

public function getpodetails()
{
    $pono = $this->input->post('pono');

$this->db->select('purchase_reports.heatno,
                   purchaseorder_reports.itemcode,
                   purchaseorder_reports.itemname,
                   purchaseorder_reports.drawingno');
$this->db->from('purchase_reports');
$this->db->join('purchaseorder_reports', 'purchase_reports.purchaseorder = purchaseorder_reports.purchaseorder');
$this->db->where('purchase_reports.purchaseorder', $pono);
$this->db->where('purchase_reports.create_mtc_status`', 1);
$this->db->group_by('purchase_reports.heatno');
$query = $this->db->get();
echo json_encode($query->result());

}


	public function get_heatno()
	{
		$heatno = $this->input->post('name');

		$this->db->select('*');
		$this->db->from('purchase_reports');
		$this->db->join('additem', 'additem.id = purchase_reports.itemid');
		$this->db->where('purchase_reports.heatno', $heatno);
		$this->db->where('purchase_reports.create_mtc_status', 1);
		$query = $this->db->get();
		$result = $query->result();

		$vob = array();
		foreach ($result as $h) {
			$vob['heatno'] = $h->heatno;
			$vob['balance'] = $h->qty;
			$vob['itemcode'] = $h->itemcode;
			$vob['itemname'] = $h->itemname;
			$vob['drawingno'] = $h->drawingno;
		}
		echo json_encode($vob);
	}

	public function getgradedetails()
	{
		$grade = $this->input->post('grade');
		$getgradedetails = $this->db->where('id', $grade)->where('status', 1)->get('grade')->row();
		echo json_encode($getgradedetails);
	}

	public function save_mtc()
	{
		// 2. Chemical composition arrays
		$chemical_elements = $this->input->post('chemical_element');       // array
		$chemical_min      = $this->input->post('chemical_minvalue');      // array
		$chemical_max      = $this->input->post('chemical_maxvalue');      // array
		$chemical_actual   = $this->input->post('chemical_actualvalue');   // array

		// Implode chemical arrays to comma-separated strings
		$element_str  = implode(',', $chemical_elements);
		$min_str      = implode(',', $chemical_min);
		$max_str      = implode(',', $chemical_max);
		$actual_str   = implode(',', $chemical_actual);

		// 3. Mechanical properties arrays
		$mechanical_elements = $this->input->post('mechanical_element');
		$mechanical_min      = $this->input->post('mechanical_minvalue');
		$mechanical_max      = $this->input->post('mechanical_maxvalue');
		$mechanical_actual   = $this->input->post('mechanical_actualvalue');

		// Implode mechanical arrays
		$mech_element_str = implode(',', $mechanical_elements);
		$mech_min_str     = implode(',', $mechanical_min);
		$mech_max_str     = implode(',', $mechanical_max);
		$mech_actual_str  = implode(',', $mechanical_actual);

		// 4. Prepare data to insert
		$data = [
			'date'             => date('Y-m-d'),
			'tcno'             => $this->input->post('tcno'),
			'tcdate'          => $this->input->post('tc_date'),
			'customername'     => $this->input->post('customername'),
			'customerid'       => $this->input->post('customerid'),
			'purchaseorderno' => $this->input->post('purchase_order_no'),
			'purchaseorder' => $this->input->post('purchase_order'),
			'grade'         => $this->input->post('grade'),
			'heat_treatment'   => $this->input->post('heat_treatment'),
			'heatno'          => $this->input->post('heat_no'),
			'product_code'     => $this->input->post('product_code'),
			'itemname'         => $this->input->post('itemname'),
			'drawing_no'        => $this->input->post('drawingno'),
			'partno'           => $this->input->post('partno'),
			'poured_qty'       => $this->input->post('poured_qty'),
			'remarks'          => $this->input->post('remarks'),
			// Chemical composition
			'chemical_element' => $element_str,
			'chemical_minvalue'     => $min_str,
			'chemical_maxvalue'     => $max_str,
			'chemical_actualvalue'  => $actual_str,
			// Mechanical properties
			'mechanical_element' => $mech_element_str,
			'mechanical_minvalue'     => $mech_min_str,
			'mechanical_maxvalue'     => $mech_max_str,
			'mechanical_actualvalue'  => $mech_actual_str,
			'status' => 1
		];

		// 5. Insert into mtc_report
		$result =   $this->db->insert('mtc_report', $data);
		if ($result == true) {
			$this->db->where('heatno', $this->input->post('heat_no'))->update('purchase_reports', ['create_mtc_status' => 2]);
			$this->db->query("UPDATE preference_settings SET tcno='' WHERE id=1");
		}
		$this->session->set_flashdata('success', 'MTC Report saved successfully!');
		redirect('Mtc/reports_mtc'); // adjust to your page
	}

	public function update_mtc()
	{
		$id = $this->input->post('id');
		// 2. Chemical composition arrays
		$chemical_elements = $this->input->post('chemical_element');       // array
		$chemical_min      = $this->input->post('chemical_minvalue');      // array
		$chemical_max      = $this->input->post('chemical_maxvalue');      // array
		$chemical_actual   = $this->input->post('chemical_actualvalue');   // array

		// Implode chemical arrays to comma-separated strings
		$element_str  = implode(',', $chemical_elements);
		$min_str      = implode(',', $chemical_min);
		$max_str      = implode(',', $chemical_max);
		$actual_str   = implode(',', $chemical_actual);

		// 3. Mechanical properties arrays
		$mechanical_elements = $this->input->post('mechanical_element');
		$mechanical_min      = $this->input->post('mechanical_minvalue');
		$mechanical_max      = $this->input->post('mechanical_maxvalue');
		$mechanical_actual   = $this->input->post('mechanical_actualvalue');

		// Implode mechanical arrays
		$mech_element_str = implode(',', $mechanical_elements);
		$mech_min_str     = implode(',', $mechanical_min);
		$mech_max_str     = implode(',', $mechanical_max);
		$mech_actual_str  = implode(',', $mechanical_actual);

		// 4. Prepare data to insert
		$data = [
        	'date'             => date('Y-m-d'),
			'tcno'             => $this->input->post('tcno'),
			'tcdate'          => $this->input->post('tc_date'),
			'customername'     => $this->input->post('customername'),
			'customerid'       => $this->input->post('customerid'),
			'purchaseorderno' => $this->input->post('purchase_order_no'),
			'purchaseorder' => $this->input->post('purchase_order'),
			'grade'         => $this->input->post('grade'),
			'heat_treatment'   => $this->input->post('heat_treatment'),
			'heatno'          => $this->input->post('heat_no'),
			'product_code'     => $this->input->post('product_code'),
			'itemname'         => $this->input->post('itemname'),
			'drawing_no'        => $this->input->post('drawingno'),
			'partno'           => $this->input->post('partno'),
			'poured_qty'       => $this->input->post('poured_qty'),
			'remarks'          => $this->input->post('remarks'),
			// Chemical composition
			'chemical_element' => $element_str,
			'chemical_minvalue'     => $min_str,
			'chemical_maxvalue'     => $max_str,
			'chemical_actualvalue'  => $actual_str,
			// Mechanical properties
			'mechanical_element' => $mech_element_str,
			'mechanical_minvalue'     => $mech_min_str,
			'mechanical_maxvalue'     => $mech_max_str,
			'mechanical_actualvalue'  => $mech_actual_str,
			'status' => 1
		];

		// 5. Insert into mtc_report
		$result =   $this->db->where('id', $id)->update('mtc_report', $data);
		if ($result == true) {
			$this->session->set_flashdata('success', 'MTC Report saved successfully!');
		}
		redirect('Mtc/reports_mtc'); // adjust to your page
	}


	public function delete_mtc()
	{
		$id = base64_decode($this->input->post('id'));
		$result = $this->db->where('id', $id)->delete('mtc_report');

		if ($result) {
			echo 'yes';
		} else {
			echo 'no';
		}
	}

	public function ajax_list()
	{
		$list = $this->Mtc_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i = 1;
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $i++;
			$row[] = $person->date;
			$row[] = $person->tcno;
			$row[] = $person->customername;
			$row[] = $person->purchaseorderno;
			$code = base64_encode($person->id);

			$row[] = '

		<div class="btn-group">
		<button type="button" class="btn
		btn-info dropdown-toggle waves-effect waves-light"
		data-toggle="dropdown" aria-expanded="false">Manage <span
		class="caret"></span></button>
		<ul class="dropdown-menu"
		role="menu" style="background: #23BDCF none repeat scroll
		0% 0%;width:14px;min-width: 100%;">
		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/edit/' . $code) . '" target="_blank" title="Edit" >Edit</a></li>
		<li><a class="" target="_blank" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/index/' . $code) . '" title="Print" >Print</a></li>

		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person(' . "'" . $code . "'" . ')">Delete</a></li>
		</ul>
		</div>

		';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Mtc_model->count_all(),
			"recordsFiltered" => $this->Mtc_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	// public function ajax_list()
	// {
	// 	$list = $this->Mtc_model->get_datatables();
	// 	$data = array();
	// 	$no = $_POST['start'];
	// 	$i = 1;
	// 	foreach ($list as $person) {
	// 		$no++;
	// 		$row = array();
	// 		$row[] = $i++;
	// 		$row[] = $person->date;
	// 		$row[] = $person->tcno;
	// 		$row[] = $person->customername;
	// 		$row[] = $person->purchaseorderno;

	// 		$code = base64_encode($person->id);


	// 		$row[] = '


	// 	<div class="btn-group">
	// 	<button type="button" class="btn
	// 	btn-info dropdown-toggle waves-effect waves-light"
	// 	data-toggle="dropdown" aria-expanded="false">Manage <span
	// 	class="caret"></span></button>
	// 	<ul class="dropdown-menu"
	// 	role="menu" style="background: #23BDCF none repeat scroll
	// 	0% 0%;width:14px;min-width: 100%;">
	// 	<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('quotation/views/' . $code) . '" title="View" >View</a></li>
	// 	<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/edit/' . $code) . '" title="Edit" >Edit</a></li>
	// 	<li><a class="" target="_blank" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/index/' . $code) . '" title="Print" >Print</a></li>

	// 	<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person(' . "'" . $code . "'" . ')">Delete</a></li>
	// 	</ul>
	// 	</div>

	// 	';

	// 		$data[] = $row;
	// 	}

	// 	$output = array(
	// 		"draw" => $_POST['draw'],
	// 		"recordsTotal" => $this->Mtc_model->count_all(),
	// 		"recordsFiltered" => $this->Mtc_model->count_filtered(),
	// 		"data" => $data,
	// 	);
	// 	//output to json format
	// 	echo json_encode($output);
	// }


	public function create_inspection()
	{

		$query_update1 = $this->db->where('status', 1)->order_by('id', 'desc')->limit(1)->get('inspection_report')->result_array();
		foreach ($query_update1 as $row) {
			$quotationnos = $row['insno'];
			$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
			$new_bond_prefix = $default_bond->insPrefix;
			@$quotationnos = str_replace($new_bond_prefix, '', $quotationnos);
		}

		if (date('m') == '04') {
			$month = date('m');
			$year = date('Y');
			$old = $this->db->where('month(date)', $month)->where('year(date) ', $year)->get('inspection_report')->result_array();
			if ($old) {
				@$bond_no = $quotationnos;
				if (is_null($bond_no)) {
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->insPrefix;
					$new_bond_noo = $new_bond_prefix . $default_bond->insno;
					//$new_bond_noo = '100001'; 
				} else {
					$default_bond = $this->db->where('id', 1)->where('insno !=', '')->get('preference_settings')->row();
					if ($default_bond) {
						$bond_no = $default_bond->insno;
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_prefix = $default_bond->insPrefix;
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
					} else {
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
						$new_bond_prefix = $default_bond->insPrefix;
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (float)$bondOnlyNum + 1);
					}
				}
			} else {
				$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->insPrefix;
				$new_bond_noo = $new_bond_prefix . $default_bond->insno;
				//$new_bond_noo = '100001';
			}
		} else {
			@$bond_no = $quotationnos;
			if (is_null($bond_no)) {
				$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->insPrefix;
				$new_bond_noo = $new_bond_prefix . $default_bond->insno;
				//$new_bond_noo = '100001'; 
			} else {
				$default_bond = $this->db->where('id', 1)->where('insno !=', '')->get('preference_settings')->row();
				if ($default_bond) {
					@$bond_no = $default_bond->insno;
					$new_bond_prefix = $default_bond->insPrefix;
					$bondLen = strlen($bond_no);
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
				} else {
					$bondLen = strlen($bond_no);
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->insPrefix;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (int)$bondOnlyNum + 1);
				}
			}
		}
		$data['insno'] = $new_bond_noo;
		$this->load->view('header');
		$this->load->view('createinspection', $data);
		$this->load->view('footer1');
	}



	public function autocomplete_itemname()
	{
		$orderno = $this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('itemname', $orderno);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) {
			$json_array             = array();
			$json_array['label']    = stripslashes($d->itemname);
			$json_array['value']    = stripslashes($d->itemname);
			$json_array['drawingno']    = $d->drawingno;
			$json_array['itemcode']    = $d->itemcode;
			$json_array['itemid']    = $d->id;



			// $json_array['advanceamount'] = $d->voucheramount;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}



	public function autocomplete_productname()
	{
		$keyword = $this->input->post('keyword');

		$this->db->select('additem.*, inspectionmaster.*');
		$this->db->from('additem');
		$this->db->join('inspectionmaster', 'inspectionmaster.itemid = additem.id', 'left');
		$this->db->like('additem.itemname', $keyword);
		$query = $this->db->get();
		$result = $query->result();

		$response = [];
		foreach ($result as $row) {
			$response[] = [
				'label'        => $row->itemname,   // SHOW IN DROPDOWN
				'value'        => $row->itemname,   // INSERT INTO INPUT
				'itemid'       => $row->id,
				'itemname'     => $row->itemname,
				'drawingno'    => $row->drawingno,
				'itemcode'     => $row->itemcode,
				'product_code' => $row->product_code,
				'sno'          => $row->sno,
				'view'         => $row->view,
				'length'       => $row->length
			];
		}

		echo json_encode($response);
	}

	public function reports_inspection()
	{
		$this->load->view('header');
		$this->load->view('reports_inspection');
		$this->load->view('footer1');
	}


	public function save_inspection()
	{
		$sno = $this->input->post('sno');
		$view = $this->input->post('view');
		$length = $this->input->post('length');
		$inspection1 = $this->input->post('inspection1');
		$inspection2 = $this->input->post('inspection2');
		$inspection3 = $this->input->post('inspection3');
		$inspection4 = $this->input->post('inspection4');
		$remark      = $this->input->post('remark');
		$ndt         = $this->input->post('ndt');
		$qty         = $this->input->post('qty');
		$result      = $this->input->post('result');
		$ndtremark    = $this->input->post('ndt_remarks');
		$overallremark = $this->input->post('overall_remarks');

		$heatno1 = $this->input->post('heatno1');
		$heatno2 = $this->input->post('heatno2');
		$heatno3 = $this->input->post('heatno3');
		$heatno4 = $this->input->post('heatno4');

		$data = [
			'date'  => date('Y-m-d'),
			'insno' => $this->input->post('insno'),
			'inspection_date' => $this->input->post('inspection_date'),
			'customername' => $this->input->post('customername'),
			'customerid' => $this->input->post('customerid'),
			'itemname' => $this->input->post('itemname'),
			'drawingno' => $this->input->post('drawingno'),
			'product_code' => $this->input->post('product_code'),
			'grade' => $this->input->post('grade'),
			'dimension_in' => $this->input->post('dimension_in'),

			'heatno1' => $heatno1,
			'heatno2' => $heatno2,
			'heatno3' => $heatno3,
			'heatno4' => $heatno4,

			'sno' => is_array($sno) ? implode(',', $sno) : $sno,
			'view' => is_array($view) ? implode(',', $view) : $view,
			'length' => is_array($length) ? implode(',', $length) : $length,
			'inspection1' => is_array($inspection1) ? implode(',', $inspection1) : $inspection1,
			'inspection2' => is_array($inspection2) ? implode(',', $inspection2) : $inspection2,
			'inspection3' => is_array($inspection3) ? implode(',', $inspection3) : $inspection3,
			'inspection4' => is_array($inspection4) ? implode(',', $inspection4) : $inspection4,
			'remark' => is_array($remark) ? implode(',', $remark) : $remark,

			'ndt' => is_array($ndt) ? implode(',', $ndt) : $ndt,
			'qty' => is_array($qty) ? implode(',', $qty) : $qty,
			'result' => is_array($result) ? implode(',', $result) : $result,
			'ndt_remarks' => is_array($ndtremark) ? implode(',', $ndtremark) : $ndtremark,
			'overall_remarks' => is_array($overallremark) ? implode(',', $overallremark) : $overallremark,
			'status' => 1,
		];

		$result = $this->db->insert('inspection_report', $data);

		if ($result == true) {
			$this->db->query("UPDATE preference_settings SET insno='' WHERE id =1");
		}
		$this->session->set_flashdata('success', 'INSPECTION Report saved successfully !');
		redirect('Mtc/reports_inspection');
	}


	public function edit_inspection($code = null)
	{
		$edit = base64_decode($code);
		$data['edit'] = $this->db->where('id', $edit)->get('inspection_report')->row();
		$this->load->view('header');
		$this->load->view('edit_inspection', $data);
		$this->load->view('footer1');
	}

	public function update_inspection()
	{
		$id = $this->input->post('id');
		$sno = $this->input->post('sno');
		$view = $this->input->post('view');
		$length = $this->input->post('length');
		$inspection1 = $this->input->post('inspection1');
		$inspection2 = $this->input->post('inspection2');
		$inspection3 = $this->input->post('inspection3');
		$inspection4 = $this->input->post('inspection4');
		$remark      = $this->input->post('remark');
		$ndt         = $this->input->post('ndt');
		$qty         = $this->input->post('qty');
		$result      = $this->input->post('result');
		$ndtremark    = $this->input->post('ndt_remarks');
		$overallremark = $this->input->post('overall_remarks');

		$data = [
			'date'  => date('Y-m-d'),
			'insno' => $this->input->post('insno'),
			'inspection_date' => $this->input->post('inspection_date'),
			'customername' => $this->input->post('customername'),
			'customerid' => $this->input->post('customerid'),
			'itemname' => $this->input->post('itemname'),
			'drawingno' => $this->input->post('drawingno'),
			'product_code' => $this->input->post('product_code'),
			'grade' => $this->input->post('grade'),
			'dimension_in' => $this->input->post('dimension_in'),

			'heatno1' => $this->input->post('heatno1'),
			'heatno2' => $this->input->post('heatno2'),
			'heatno3' => $this->input->post('heatno3'),
			'heatno4' => $this->input->post('heatno4'),

			'sno' => is_array($sno) ? implode(',', $sno) : $sno,
			'view' => is_array($view) ? implode(',', $view) : $view,
			'length' => is_array($length) ? implode(',', $length) : $length,
			'inspection1' => is_array($inspection1) ? implode(',', $inspection1) : $inspection1,
			'inspection2' => is_array($inspection2) ? implode(',', $inspection2) : $inspection2,
			'inspection3' => is_array($inspection3) ? implode(',', $inspection3) : $inspection3,
			'inspection4' => is_array($inspection4) ? implode(',', $inspection4) : $inspection4,
			'remark' => is_array($remark) ? implode(',', $remark) : $remark,

			'ndt' => is_array($ndt) ? implode(',', $ndt) : $ndt,
			'qty' => is_array($qty) ? implode(',', $qty) : $qty,
			'result' => is_array($result) ? implode(',', $result) : $result,
			'ndt_remarks' => is_array($ndtremark) ? implode(',', $ndtremark) : $ndtremark,
			'overall_remarks' => is_array($overallremark) ? implode(',', $overallremark) : $overallremark,
			'status' => 1,
		];

		$result = $this->db->where('id', $id)->update('inspection_report', $data);

		if ($result == true) {
			$this->session->set_flashdata('success', 'INSPECTION Report update successfully !');
			redirect('Mtc/reports_inspection');
		}
	}


	public function inspection_print($code = null)
	{
		$decode = base64_decode($code);
		$data['report'] = $this->db->where('id', $decode)->get('inspection_report')->row();
		$data['grade'] = $this->db->select('grade')->where('id', $data['report']->grade)->get('grade')->row()->grade;
		$this->load->view('inspection', $data);
	}

	public function ajaxlist_inspection()
	{
		$list = $this->Inspection_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i = 1;
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $i++;
			$row[] = $person->date;
			$row[] = $person->insno;
			$row[] = $person->customername;
			$row[] = $person->drawingno;
			$code = base64_encode($person->id);

			$row[] = '

		<div class="btn-group">
		<button type="button" class="btn
		btn-info dropdown-toggle waves-effect waves-light"
		data-toggle="dropdown" aria-expanded="false">Manage <span
		class="caret"></span></button>
		<ul class="dropdown-menu"
		role="menu" style="background: #23BDCF none repeat scroll
		0% 0%;width:14px;min-width: 100%;">
		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/edit_inspection/' . $code) . '" target="_blank" title="Edit" >Edit</a></li>
		<li><a class="" target="_blank" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/inspection_print/' . $code) . '" title="Print" >Print</a></li>

		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_inspection(' . "'" . $code . "'" . ')">Delete</a></li>
		</ul>
		</div>

		';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Inspection_model->count_all(),
			"recordsFiltered" => $this->Inspection_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function delete_inspection()
	{
		$id = base64_decode($this->input->post('id'));
		$result = $this->db->where('id', $id)->delete('inspection_report');

		if ($result) {
			echo 'yes';
		} else {
			echo 'no';
		}
	}

	// 	UT






	public function ut()
	{

		$query_update1 = $this->db->where('status', 1)->order_by('id', 'desc')->limit(1)->get('ut_report')->result_array();
		foreach ($query_update1 as $row) {
			$quotationnos = $row['ut_report_no'];
			$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
			$new_bond_prefix = $default_bond->utPrefix;
			@$quotationnos = str_replace($new_bond_prefix, '', $quotationnos);
		}

		if (date('m') == '04') {
			$month = date('m');
			$year = date('Y');
			$old = $this->db->where('month(date)', $month)->where('year(date) ', $year)->get('ut_report')->result_array();
			if ($old) {
				@$bond_no = $quotationnos;
				if (is_null($bond_no)) {
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->utPrefix;
					$new_bond_noo = $new_bond_prefix . $default_bond->utno;
					//$new_bond_noo = '100001'; 
				} else {
					$default_bond = $this->db->where('id', 1)->where('utno !=', '')->get('preference_settings')->row();
					if ($default_bond) {
						$bond_no = $default_bond->utno;
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_prefix = $default_bond->utPrefix;
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
					} else {
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
						$new_bond_prefix = $default_bond->utPrefix;
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (float)$bondOnlyNum + 1);
					}
				}
			} else {
				$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->utPrefix;
				$new_bond_noo = $new_bond_prefix . $default_bond->utno;
				//$new_bond_noo = '100001';
			}
		} else {
			@$bond_no = $quotationnos;
			if (is_null($bond_no)) {
				$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->utPrefix;
				$new_bond_noo = $new_bond_prefix . $default_bond->utno;
				//$new_bond_noo = '100001'; 
			} else {
				$default_bond = $this->db->where('id', 1)->where('utno !=', '')->get('preference_settings')->row();
				if ($default_bond) {
					@$bond_no = $default_bond->utno;
					$new_bond_prefix = $default_bond->utPrefix;
					$bondLen = strlen($bond_no);
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
				} else {
					$bondLen = strlen($bond_no);
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->utPrefix;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (int)$bondOnlyNum + 1);
				}
			}
		}
		$data['utno'] = $new_bond_noo;
		$this->load->view('header');
		$this->load->view('ut', $data);
		$this->load->view('footer1');
	}



	public function save_ut()
	{
		$data = array(
			'date' => date('Y-m-d'),
			'ut_report_no' => $this->input->post('ut_report_no'),
			'ut_date' => $this->input->post('ut_date'),
			'customername' => $this->input->post('customername'),
			'customerid' => $this->input->post('customerid'),
			'stage_of_test' => $this->input->post('stage_of_test'),
			'test_date' => $this->input->post('test_date'),
			'surface_condition' => $this->input->post('surface_condition'),
			'calibration_block' => $this->input->post('calibration_block'),
			'equipment' => $this->input->post('equipment'),
			'couplant' => $this->input->post('couplant'),
			'probe' => $this->input->post('probe'),
			'range_of_crt' => $this->input->post('range_of_crt'),
			'frequency' => $this->input->post('frequency'),
			'gain' => $this->input->post('gain'),
			'area_coverage' => $this->input->post('area_coverage'),
			'procedure_ref' => $this->input->post('procedure_ref'),
			'acceptance_standard' => $this->input->post('acceptance_standard'),
			'description' => $this->input->post('description'),
			'itemid' => $this->input->post('itemid'),
			'drawing' => $this->input->post('drawing'),
			'grade' => $this->input->post('grade'),
			'heat_no' => $this->input->post('heat_no'),
			'ut_no' => $this->input->post('ut_no'),
			'result' => $this->input->post('result'),
			'status' => 1

		);

		$result = $this->db->insert('ut_report', $data);

		if ($result == true) {
			$this->db->query("UPDATE preference_settings SET utno='' WHERE id =1");
		}
	}


	public function update_ut()
	{
		$id = $this->input->post('id');

		$data = array(
			'date' => date('Y-m-d'),
			'ut_report_no' => $this->input->post('ut_report_no'),
			'ut_date' => $this->input->post('ut_date'),
			'customername' => $this->input->post('customername'),
			'customerid' => $this->input->post('customerid'),
			'stage_of_test' => $this->input->post('stage_of_test'),
			'test_date' => $this->input->post('test_date'),
			'surface_condition' => $this->input->post('surface_condition'),
			'calibration_block' => $this->input->post('calibration_block'),
			'equipment' => $this->input->post('equipment'),
			'couplant' => $this->input->post('couplant'),
			'probe' => $this->input->post('probe'),
			'range_of_crt' => $this->input->post('range_of_crt'),
			'frequency' => $this->input->post('frequency'),
			'gain' => $this->input->post('gain'),
			'area_coverage' => $this->input->post('area_coverage'),
			'procedure_ref' => $this->input->post('procedure_ref'),
			'acceptance_standard' => $this->input->post('acceptance_standard'),
			'description' => $this->input->post('description'),
			'itemid' => $this->input->post('itemid'),
			'drawing' => $this->input->post('drawing'),
			'grade' => $this->input->post('grade'),
			'heat_no' => $this->input->post('heat_no'),
			'ut_no' => $this->input->post('ut_no'),
			'result' => $this->input->post('result'),
			'status' => 1

		);

		$this->db->where('id', $id);
		$result = $this->db->update('ut_report', $data);
	}



	public function ut_reports()
	{
		$this->load->view('header');
		$this->load->view('ut_reports');
		$this->load->view('footer1');
	}

	public function edit_ut($code = null)
	{
		$edit = base64_decode($code);
		$data['edit'] = $this->db->where('id', $edit)->get('ut_report')->row();
		$this->load->view('header');
		$this->load->view('edit_ut', $data);
		$this->load->view('footer1');
	}


	public function ut_print($code = null)
	{

		$decode = base64_decode($code);
		$data['ut'] = $this->db->where('id', $decode)->get('ut_report')->row();
		$data['grade'] = $this->db->select('grade')->where('id', $data['report']->grade)->get('grade')->row()->grade;

		$this->load->view('utprint', $data);
	}


	public function delete_ut()
	{
		$id = base64_decode($this->input->post('id'));
		$result = $this->db->where('id', $id)->delete('mpt_report');

		if ($result) {
			echo 'yes';
		} else {
			echo 'no';
		}
	}


	public function ajaxlist_ut()
	{

		$list = $this->Ut_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i = 1;
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $i++;
			$row[] = $person->date;
			$row[] = $person->ut_report_no;
			$row[] = $person->customername;
			$row[] = $person->drawing;
			$code = base64_encode($person->id);

			$row[] = '

		<div class="btn-group">
		<button type="button" class="btn
		btn-info dropdown-toggle waves-effect waves-light"
		data-toggle="dropdown" aria-expanded="false">Manage <span
		class="caret"></span></button>
		<ul class="dropdown-menu"
		role="menu" style="background: #23BDCF none repeat scroll
		0% 0%;width:14px;min-width: 100%;">
		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/edit_ut/' . $code) . '" target="_blank" title="Edit" >Edit</a></li>
		<li><a class="" target="_blank" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/ut_print/' . $code) . '" title="Print" >Print</a></li>

		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_inspection(' . "'" . $code . "'" . ')">Delete</a></li>
		</ul>
		</div>

		';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Ut_model->count_all(),
			"recordsFiltered" => $this->Ut_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}



	//MPT 
	public function mpt()
	{

		$query_update1 = $this->db->where('status', 1)->order_by('id', 'desc')->limit(1)->get('mpt_report')->result_array();
		foreach ($query_update1 as $row) {
			$quotationnos = $row['mpt_report_no'];
			$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
			$new_bond_prefix = $default_bond->mptPrefix;
			@$quotationnos = str_replace($new_bond_prefix, '', $quotationnos);
		}

		if (date('m') == '04') {
			$month = date('m');
			$year = date('Y');
			$old = $this->db->where('month(date)', $month)->where('year(date) ', $year)->get('ut_report')->result_array();
			if ($old) {
				@$bond_no = $quotationnos;
				if (is_null($bond_no)) {
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->mptPrefix;
					$new_bond_noo = $new_bond_prefix . $default_bond->mptno;
					//$new_bond_noo = '100001'; 
				} else {
					$default_bond = $this->db->where('id', 1)->where('mptno !=', '')->get('preference_settings')->row();
					if ($default_bond) {
						$bond_no = $default_bond->mptno;
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_prefix = $default_bond->mptPrefix;
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
					} else {
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
						$new_bond_prefix = $default_bond->mptPrefix;
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (float)$bondOnlyNum + 1);
					}
				}
			} else {
				$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->mptPrefix;
				$new_bond_noo = $new_bond_prefix . $default_bond->mptno;
				//$new_bond_noo = '100001';
			}
		} else {
			@$bond_no = $quotationnos;
			if (is_null($bond_no)) {
				$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->mptPrefix;
				$new_bond_noo = $new_bond_prefix . $default_bond->mptno;
				//$new_bond_noo = '100001'; 
			} else {
				$default_bond = $this->db->where('id', 1)->where('mptno !=', '')->get('preference_settings')->row();
				if ($default_bond) {
					@$bond_no = $default_bond->mptno;
					$new_bond_prefix = $default_bond->mptPrefix;
					$bondLen = strlen($bond_no);
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
				} else {
					$bondLen = strlen($bond_no);
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->mptPrefix;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (int)$bondOnlyNum + 1);
				}
			}
		}
		$data['mptno'] = $new_bond_noo;
		$this->load->view('header');
		$this->load->view('mpt', $data);
		$this->load->view('footer1');
	}




	public function save_mpt()
	{
		$data = array(

			'date' => date('Y-m-d'),
			'mpt_report_no' => $_POST['mpt_report_no'],
			'mpt_date' => $_POST['mpt_date'],
			'customername' => $_POST['customername'],
			'customerid' => $_POST['customerid'],
			'grade' => $_POST['grade'],
			'equipment_make' => $_POST['equipment_make'],
			'magnetic_powder_color' => $_POST['magnetic_powder_color'],
			'equipment_type' => $_POST['equipment_type'],
			'prod_spacing' => $_POST['prod_spacing'],
			'procedure_ref' => $_POST['procedure_ref'],
			'current_amps' => $_POST['current_amps'],
			'stage_of_test' => $_POST['stage_of_test'],
			'magnetisation' => $_POST['magnetisation'],
			'process' => $_POST['process'],
			'surface_condition' => $_POST['surface_condition'],
			'inspection_date' => $_POST['inspection_date'],
			'acceptance_standard' => $_POST['acceptance_standard'],
			'current' => $_POST['current'],
			'medium' => $_POST['medium'],
			'light_indensity' => $_POST['light_indensity'],
			'fluosrecent' => $_POST['fluosrecent'],
			'area_of_test' => $_POST['area_of_test'],
			'casting_temp' => $_POST['casting_temp'],
			'demagnetization' => $_POST['demagnetization'],
			'observation' => $_POST['observation'],
			'po_no_dt' => is_array($_POST['po_no_dt']) ? implode(',', $_POST['po_no_dt']) : $_POST['po_no_dt'],
			'description' => is_array($_POST['description']) ? implode(',', $_POST['description']) : $_POST['description'],
			'drawing_no' => is_array($_POST['drawing_no']) ? implode(',', $_POST['drawing_no']) : $_POST['drawing_no'],
			'heat_no' => is_array($_POST['heat_no']) ? implode(',', $_POST['heat_no']) : $_POST['heat_no'],
			'mpi_no' => is_array($_POST['mpi_no']) ? implode(',', $_POST['mpi_no']) : $_POST['mpi_no'],
			'desp_qty' => is_array($_POST['desp_qty']) ? implode(',', $_POST['desp_qty']) : $_POST['desp_qty'],
			'status' => 1

		);



		$result = $this->db->insert('mpt_report', $data);

		if ($result == true) {
			$this->db->query("UPDATE preference_settings SET mptno='' WHERE id =1");
		}
	}


	public function mpt_reports()
	{
		$this->load->view('header');
		$this->load->view('mpt_reports');
		$this->load->view('footer1');
	}


	public function mpt_print($code = null)
	{
		$decode = base64_decode($code);
		$data['mpt'] = $this->db->where('id', $decode)->get('mpt_report')->row();
		$this->load->view('mptprint', $data);
	}

	public function edit_mpt($code = null)
	{
		$edit = base64_decode($code);
		$data['edit'] = $this->db->where('id', $edit)->get('mpt_report')->row();
		$this->load->view('header');
		$this->load->view('edit_mpt', $data);
		$this->load->view('footer1');
	}

	public function update_mpt()
	{
		$id = $this->input->post('id');

		$data = array(

			'date' => date('Y-m-d'),
			'mpt_report_no' => $_POST['mpt_report_no'],
			'mpt_date' => $_POST['mpt_date'],
			'customername' => $_POST['customername'],
			'customerid' => $_POST['customerid'],
			'grade' => $_POST['grade'],
			'equipment_make' => $_POST['equipment_make'],
			'magnetic_powder_color' => $_POST['magnetic_powder_color'],
			'equipment_type' => $_POST['equipment_type'],
			'prod_spacing' => $_POST['prod_spacing'],
			'procedure_ref' => $_POST['procedure_ref'],
			'current_amps' => $_POST['current_amps'],
			'stage_of_test' => $_POST['stage_of_test'],
			'magnetisation' => $_POST['magnetisation'],
			'process' => $_POST['process'],
			'surface_condition' => $_POST['surface_condition'],
			'inspection_date' => $_POST['inspection_date'],
			'acceptance_standard' => $_POST['acceptance_standard'],
			'current' => $_POST['current'],
			'medium' => $_POST['medium'],
			'light_indensity' => $_POST['light_indensity'],
			'fluosrecent' => $_POST['fluosrecent'],
			'area_of_test' => $_POST['area_of_test'],
			'casting_temp' => $_POST['casting_temp'],
			'demagnetization' => $_POST['demagnetization'],
			'observation' => $_POST['observation'],
			'po_no_dt' => is_array($_POST['po_no_dt']) ? implode(',', $_POST['po_no_dt']) : $_POST['po_no_dt'],
			'description' => is_array($_POST['description']) ? implode(',', $_POST['description']) : $_POST['description'],
			'drawing_no' => is_array($_POST['drawing_no']) ? implode(',', $_POST['drawing_no']) : $_POST['drawing_no'],
			'heat_no' => is_array($_POST['heat_no']) ? implode(',', $_POST['heat_no']) : $_POST['heat_no'],
			'mpi_no' => is_array($_POST['mpi_no']) ? implode(',', $_POST['mpi_no']) : $_POST['mpi_no'],
			'desp_qty' => is_array($_POST['desp_qty']) ? implode(',', $_POST['desp_qty']) : $_POST['desp_qty'],
			'status' => 1

		);


		$this->db->where('id', $id);
		$result = $this->db->update('mpt_report', $data);
	}


	public function delete_mpt()
	{
		$id = base64_decode($this->input->post('id'));
		$result = $this->db->where('id', $id)->delete('mpt_report');

		if ($result) {
			echo 'yes';
		} else {
			echo 'no';
		}
	}








	public function ajaxlist_mpt()
	{
		$list = $this->Mpt_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i = 1;
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $i++;
			$row[] = $person->date;
			$row[] = $person->mpt_report_no;
			$row[] = $person->customername;
			$row[] = $person->drawing_no;
			$code = base64_encode($person->id);

			$row[] = '

		<div class="btn-group">
		<button type="button" class="btn
		btn-info dropdown-toggle waves-effect waves-light"
		data-toggle="dropdown" aria-expanded="false">Manage <span
		class="caret"></span></button>
		<ul class="dropdown-menu"
		role="menu" style="background: #23BDCF none repeat scroll
		0% 0%;width:14px;min-width: 100%;">
		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/edit_mpt/' . $code) . '" target="_blank" title="Edit" >Edit</a></li>
		<li><a class="" target="_blank" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/mpt_print/' . $code) . '" title="Print" >Print</a></li>

		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_inspection(' . "'" . $code . "'" . ')">Delete</a></li>
		</ul>
		</div>

		';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Mpt_model->count_all(),
			"recordsFiltered" => $this->Mpt_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	//dpt

	public function dpt()
	{

		$query_update1 = $this->db->where('status', 1)->order_by('id', 'desc')->limit(1)->get('dpt_report')->result_array();
		foreach ($query_update1 as $row) {
			$quotationnos = $row['dpt_report_no'];
			$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
			$new_bond_prefix = $default_bond->dptPrefix;
			@$quotationnos = str_replace($new_bond_prefix, '', $quotationnos);
		}

		if (date('m') == '04') {
			$month = date('m');
			$year = date('Y');
			$old = $this->db->where('month(date)', $month)->where('year(date) ', $year)->get('ut_report')->result_array();
			if ($old) {
				@$bond_no = $quotationnos;
				if (is_null($bond_no)) {
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->dptPrefix;
					$new_bond_noo = $new_bond_prefix . $default_bond->dptno;
					//$new_bond_noo = '100001'; 
				} else {
					$default_bond = $this->db->where('id', 1)->where('dptno !=', '')->get('preference_settings')->row();
					if ($default_bond) {
						$bond_no = $default_bond->dptno;
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_prefix = $default_bond->dptPrefix;
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
					} else {
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
						$new_bond_prefix = $default_bond->dptPrefix;
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (float)$bondOnlyNum + 1);
					}
				}
			} else {
				$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->dptPrefix;
				$new_bond_noo = $new_bond_prefix . $default_bond->dptno;
				//$new_bond_noo = '100001';
			}
		} else {
			@$bond_no = $quotationnos;
			if (is_null($bond_no)) {
				$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->dptPrefix;
				$new_bond_noo = $new_bond_prefix . $default_bond->dptno;
				//$new_bond_noo = '100001'; 
			} else {
				$default_bond = $this->db->where('id', 1)->where('dptno !=', '')->get('preference_settings')->row();
				if ($default_bond) {
					@$bond_no = $default_bond->dptno;
					$new_bond_prefix = $default_bond->dptPrefix;
					$bondLen = strlen($bond_no);
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
				} else {
					$bondLen = strlen($bond_no);
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->dptPrefix;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (int)$bondOnlyNum + 1);
				}
			}
		}
		$data['dptno'] = $new_bond_noo;
		$this->load->view('header');
		$this->load->view('dpt', $data);
		$this->load->view('footer1');
	}


	public function save_dpt()
	{
		$data = array(
			'date' => date('Y-m-d'),
			'dpt_report_no' => $_POST['dpt_report_no'],
			'dpt_date' => $_POST['dpt_date'],
			'customername' => $_POST['customername'],
			'customerid' => $_POST['customerid'],
			'report_no' => $_POST['report_no'],
			'stage_of_test' => $_POST['stage_of_test'],
			'grade' => $_POST['grade'],
			'type_of_penetrant' => $_POST['type_of_penetrant'],
			'casting_temperature' => $_POST['casting_temperature'],
			'type_of_developer' => $_POST['type_of_developer'],
			'surface_condition' => $_POST['surface_condition'],
			'testing_date' => $_POST['testing_date'],
			'acceptance_standard' => $_POST['acceptance_standard'],
			'dwell_time' => $_POST['dwell_time'],
			'procedure_ref' => $_POST['procedure_ref'],
			'fluosrecent' => $_POST['fluosrecent'],
			'area_method_of_test' => $_POST['area_method_of_test'],
			'penetrant_apply_method' => $_POST['penetrant_apply_method'],
			'precleaning_method' => $_POST['precleaning_method'],
			'post_of_test_cleaning' => $_POST['post_of_test_cleaning'],
			'light_indensity' => $_POST['light_indensity'],
			'background' => $_POST['background'],
			'result' => $_POST['result'],
			'description' => is_array($_POST['description']) ? implode(',', $_POST['description']) : $_POST['description'],
			'drawing_no' => is_array($_POST['drawing_no']) ? implode(',', $_POST['drawing_no']) : $_POST['drawing_no'],
			'heat_no' => is_array($_POST['heat_no']) ? implode(',', $_POST['heat_no']) : $_POST['heat_no'],
			'dp_no' => is_array($_POST['dp_no']) ? implode(',', $_POST['dp_no']) : $_POST['dp_no'],
			'qty' => is_array($_POST['qty']) ? implode(',', $_POST['qty']) : $_POST['qty'],
			'status' => 1

		);


		$result = $this->db->insert('dpt_report', $data);

		if ($result == true) {
			$this->db->query("UPDATE preference_settings SET dptno='' WHERE id =1");
		}
	}


	public function dpt_print($code = null)
	{
		$decode = base64_decode($code);
		$data['dpt'] = $this->db->where('id', $decode)->get('dpt_report')->row();

		$this->load->view('dptprint', $data);
	}


	public function edit_dpt($code = null)
	{
		$edit = base64_decode($code);
		$data['edit'] = $this->db->where('id', $edit)->get('dpt_report')->row();
		$this->load->view('header');
		$this->load->view('edit_dpt', $data);
		$this->load->view('footer1');
	}



	public function delete_dpt()
	{
		$id = base64_decode($this->input->post('id'));
		$result = $this->db->where('id', $id)->delete('dpt_report');

		if ($result) {
			echo 'yes';
		} else {
			echo 'no';
		}
	}


	public function update_dpt($code = null)
	{
		$id = $this->input->post('id');

		$data = array(
			'date' => date('Y-m-d'),
			'dpt_report_no' => $_POST['dpt_report_no'],
			'dpt_date' => $_POST['dpt_date'],
			'customername' => $_POST['customername'],
			'customerid' => $_POST['customerid'],
			'report_no' => $_POST['report_no'],
			'stage_of_test' => $_POST['stage_of_test'],
			'grade' => $_POST['grade'],
			'type_of_penetrant' => $_POST['type_of_penetrant'],
			'casting_temperature' => $_POST['casting_temperature'],
			'type_of_developer' => $_POST['type_of_developer'],
			'surface_condition' => $_POST['surface_condition'],
			'testing_date' => $_POST['testing_date'],
			'acceptance_standard' => $_POST['acceptance_standard'],
			'dwell_time' => $_POST['dwell_time'],
			'procedure_ref' => $_POST['procedure_ref'],
			'fluosrecent' => $_POST['fluosrecent'],
			'area_method_of_test' => $_POST['area_method_of_test'],
			'penetrant_apply_method' => $_POST['penetrant_apply_method'],
			'precleaning_method' => $_POST['precleaning_method'],
			'post_of_test_cleaning' => $_POST['post_of_test_cleaning'],
			'light_indensity' => $_POST['light_indensity'],
			'background' => $_POST['background'],
			'result' => $_POST['result'],
			'description' => is_array($_POST['description']) ? implode(',', $_POST['description']) : $_POST['description'],
			'drawing_no' => is_array($_POST['drawing_no']) ? implode(',', $_POST['drawing_no']) : $_POST['drawing_no'],
			'heat_no' => is_array($_POST['heat_no']) ? implode(',', $_POST['heat_no']) : $_POST['heat_no'],
			'dp_no' => is_array($_POST['dp_no']) ? implode(',', $_POST['dp_no']) : $_POST['dp_no'],
			'qty' => is_array($_POST['qty']) ? implode(',', $_POST['qty']) : $_POST['qty'],
			'status' => 1

		);

		$this->db->where('id', $id);
		$result = $this->db->update('dpt_report', $data);
	}




	public function ajaxlist_dpt()
	{
		$list = $this->Dpt_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i = 1;
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $i++;
			$row[] = $person->date;
			$row[] = $person->dpt_report_no;
			$row[] = $person->customername;
			$row[] = $person->drawing_no;
			$code = base64_encode($person->id);

			$row[] = '

		<div class="btn-group">
		<button type="button" class="btn
		btn-info dropdown-toggle waves-effect waves-light"
		data-toggle="dropdown" aria-expanded="false">Manage <span
		class="caret"></span></button>
		<ul class="dropdown-menu"
		role="menu" style="background: #23BDCF none repeat scroll
		0% 0%;width:14px;min-width: 100%;">
		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/edit_dpt/' . $code) . '" target="_blank" title="Edit" >Edit</a></li>
		<li><a class="" target="_blank" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('Mtc/dpt_print/' . $code) . '" title="Print" >Print</a></li>

		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_inspection(' . "'" . $code . "'" . ')">Delete</a></li>
		</ul>
		</div>

		';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Dpt_model->count_all(),
			"recordsFiltered" => $this->Dpt_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	public function dpt_reports()
	{
		$this->load->view('header');
		$this->load->view('dpt_reports');
		$this->load->view('footer1');
	}
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Supplier_purchaseorder extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('sup_purchaseorder_model');
		$this->load->model('Sup_purchaseorder_pending_model');
		if ($this->session->userdata('rcbio_login') == '') {

			$this->session->set_flashdata('msg', 'Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}

	public function index()
	{

		$spo_type = $this->db->select('spo_type')->where('id', 1)->get('preference_settings')->row()->spo_type;

		$data['grade'] = $this->db->where('status', 1)->get('grade')->result();
		if ($spo_type == 'Multiple Tax') {
			$data['invoiceno'] = $this->invoiceno();
			$this->load->view('header');
			$this->load->view('sup_purchaseOrder_add', $data);
			$this->load->view('footer');
		} else {
			$data['invoiceno'] = $this->invoiceno();
			$this->load->view('header');
			$this->load->view('sup_purchaseOrder_overall', $data);
			$this->load->view('footer');
		}
	}
	public function invoiceno()
	{
		$last = $this->db->select('purchaseorderno')
			->where('status', 1)
			->order_by('id', 'DESC')
			->limit(1)
			->get('sup_purchaseorder_details')
			->row();

		$pref = $this->db->where('id', 1)->get('preference_settings')->row();

		$prefix = $pref->spo_prefix;                       // SPO/25-26/-
		$startNo = $pref->supplierpurchaseorder;           // e.g. 009 or empty

		// If starting number empty, default 001
		if (empty($startNo)) $startNo = "001";

		// No previous PO
		if (!$last) {
			return $prefix . $startNo;
		}

		$lastPO = $last->purchaseorderno;                  // SPO/25-26/-002

		// Extract only the last numeric block
		preg_match('/(\d+)$/', $lastPO, $matches);
		$lastNum = $matches[1] ?? "";

		// If no numeric part found
		if ($lastNum === "") {
			return $prefix . $startNo;
		}

		// Next number
		$newNum = intval($lastNum) + 1;

		// Maintain padding length
		$padLength = strlen($lastNum);
		$newNumFormatted = str_pad($newNum, $padLength, "0", STR_PAD_LEFT);

		return $prefix . $newNumFormatted;
	}


	public function insert()
	{
		$invoiceno = $this->invoiceno();

		$grandtotal = $_POST['grandtotal'];
		$customerid = $_POST['customerid'];
		if ($_POST['potype'] == 'BOM') {
			$_POST['selected_bom'] = 0;
		}
		$_POST['invoiceno'] = 0;
		//exit;
		$hsnno = implode('||', $_POST['hsnno']);
		$itemname = implode('||',$_POST['itemname']);
		$itemid = implode('||', $_POST['itemid']);
		$item_desc = implode('||', $_POST['item_desc']);
		$deliverydates = implode('||', $_POST['deliverydates']);
		$qty = implode('||', $_POST['qty']);
		// 	$balanceqty=implode('||',$_POST['balanceqty']);
		// 	$bom_qty=implode('||',$_POST['bomqty']);
		$uom = implode('||', $_POST['uom']);
		$rate = implode('||', $_POST['rate']);
		$amount = implode('||', $_POST['amount']);
		$grade = implode('||', $_POST['grade']);
		$drawingno = implode('||', $_POST['drawingno']);
		$itemcode = implode('||', $_POST['itemcode']);
		$weight = implode('||', $_POST['weight']);
		// @$discount=implode('||',$_POST['discount']);
		@$discount = is_array($_POST['discount']) ? implode('||', $_POST['discount']) : $_POST['discount'];
		@$discountamount = is_array($_POST['discountamount']) ? implode('||', $_POST['discountamount']) : $_POST['discountamount'];
		$taxableamount = implode('||', $_POST['taxableamount']);
		$cgst = $_POST['cgst'];
		$cgstamount = $_POST['cgstamount'];
		$sgst = $_POST['sgst'];
		$sgstamount = $_POST['sgstamount'];
		$igst = $_POST['igst'];
		$igstamount = $_POST['igstamount'];
		$total = $_POST['total'];
		// 	$selected_bom=implode('||',$_POST['selected_bom']);
		$potype = $this->input->post('potype');
		$subtotal = $this->input->post('subtotal');
		$freightamount = $this->input->post('freightamount');
		$freightcgst = $this->input->post('freightcgst');
		$freightcgstamount = $this->input->post('freightcgstamount');
		$freightsgst = $this->input->post('freightsgst');
		$freightsgstamount = $this->input->post('freightsgstamount');
		$freightigst = $this->input->post('freightigst');
		$freightigstamount = $this->input->post('freightigstamount');
		$freighttotal = $this->input->post('freighttotal');
		$loadingamount = $this->input->post('loadingamount');
		$loadingcgst = $this->input->post('loadingcgst');
		$loadingcgstamount = $this->input->post('loadingcgstamount');
		$loadingsgst = $this->input->post('loadingsgst');
		$loadingsgstamount = $this->input->post('loadingsgstamount');
		$loadingigst = $this->input->post('loadingigst');
		$loadingigstamount = $this->input->post('loadingigstamount');
		$loadingtotal = $this->input->post('loadingtotal');
		$othercharges = $this->input->post('othercharges');
		$hiddenDiscountBy = $this->input->post('hiddenDiscountBy');
		$roundOff = $this->input->post('roundOff');
		$grandtotal = $this->input->post('grandtotal');
		$purchasenoyear = $_POST['purchaseorderno'] . '' . date('-Y') . '';
		$purchasenodate = $_POST['purchaseorderno'] . '' . date('dmy') . '';
		$workorderid = implode('||', $_POST['id']);


		$pcode = $_POST['hsnno'];
		$count7 = count($pcode);
		for ($i = 0; $i < $count7; $i++) {
			$res[] = "0";
			$ret[] = "1";
		}

		$billtype = $_POST['gsttype'];
		if ($billtype == 'intrastate') {
			$sgst = is_array($_POST['sgst']) ? implode('||', $_POST['sgst']) : $_POST['sgst'];
			$cgst = is_array($_POST['cgst']) ? implode('||', $_POST['cgst']) : $_POST['cgst'];
			$igst = implode('||', $res); // always array of zeros
			$sgstamount = is_array($_POST['sgstamount']) ? implode('||', $_POST['sgstamount']) : $_POST['sgstamount'];
			$cgstamount = is_array($_POST['cgstamount']) ? implode('||', $_POST['cgstamount']) : $_POST['cgstamount'];
			$igstamount = implode('||', $res);
			$sgsts = 'sgst';
			$cgsts = 'cgst';
			$igsts = '';
		}

		if ($billtype == 'interstate') {
			$sgst = implode('||', $res);
			$cgst = implode('||', $res);
			$igst = is_array($_POST['igst']) ? implode('||', $_POST['igst']) : $_POST['igst'];
			$sgstamount = implode('||', $res);
			$cgstamount = implode('||', $res);
			$igstamount = is_array($_POST['igstamount']) ? implode('||', $_POST['igstamount']) : $_POST['igstamount'];
			$igsts = 'igst';
			$sgsts = '';
			$cgsts = '';
		}




		$data = array(
			'date' => date('Y-m-d'),
			'purchasedate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
			// 	'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
			'potype' => $_POST['potype'],
			'purchaseorderno' => $invoiceno,
			// 	'selected_bom' =>$selected_bom, 
			'itemid' => $itemid,
			'customerId' => $customerid,
			'customername' => $_POST['customername'],
			'supplierid' => $_POST['supplierid'],
			'suppliername' => $_POST['suppliername'],
			'shipTo'   => $_POST['shipTo'],
			'shipToAddress' => $_POST['shipToAddress'],
			'address' => $_POST['address'],
			'invoiceno' => $_POST['invoiceno'],
			'billtype' => $_POST['gsttype'],
			'gsttype' => $_POST['gsttype'],
			'tcctype'   => $_POST['tcctype'],
			'deliverydate' => $_POST['deliverydate'],
			'requirements' => $_POST['requirements'],
			'vendor_quot' => $_POST['vendor_quot'],
			'quot_date' => $_POST['quot_date'],
			'typesgst' => $sgsts,
			'typecgst' => $cgsts,
			'typeigst' => $igsts,
			'hsnno' => $hsnno,
			'itemcode' => $itemcode,
			'itemname' => $itemname,
			'item_desc' => $item_desc,
			'uom' => $uom,
			'weight' => $weight,
			'workorderno' => $_POST['workorderno'],
			'purchaseorder' => $_POST['purchaseorder'],
			'workorderid' => $workorderid,
			'grade' => $grade,
			'drawingno' => $drawingno,
			'rate' => $rate,
			'qty' => $qty,
			'deliverydates' => $deliverydates,
			'balanceqty' => $qty,
			// 	'bom_qty'=>$bom_qty,
			'amount' => $amount,
			'discount' => $discount,
			'discountamount' => $discountamount,
			'taxableamount' => $taxableamount,
			'sgst' => $sgst,
			'sgstamount' => $sgstamount,
			'cgst' => $cgst,
			'cgstamount' => $cgstamount,
			'igst' => $igst,
			'igstamount' => $igstamount,
			'total' => $total,
			'subtotal' => $_POST['subtotal'],
			'freightamount' => $freightamount,
			'freightcgst' => $freightcgst,
			'freightcgstamount' => $freightcgstamount,
			'freightsgst' => $freightsgst,
			'freightsgstamount' => $freightsgstamount,
			'freightigst' => $freightigst,
			'freightigstamount' => $freightigstamount,
			'freighttotal' => $freighttotal,
			'loadingamount' => $loadingamount,
			'loadingcgst' => $loadingcgst,
			'loadingcgstamount' => $loadingcgstamount,
			'loadingsgst' => $loadingsgst,
			'loadingsgstamount' => $loadingsgstamount,
			'loadingigst' => $loadingigst,
			'loadingigstamount' => $loadingigstamount,
			'loadingtotal' => $loadingtotal,
			'roundOff' => $roundOff,
			'othercharges' => $othercharges,
			'discountBy' => $hiddenDiscountBy,
			'return_status' => implode('||', $ret),
			'grandtotal' => $grandtotal,
			'purchasenodate' => $purchasenodate,
			'purchasenoyear' => $purchasenoyear,
			'status' => 1,
			'edit_status' => 1
		);


// 		echo '<pre>';
// 		print_r($data);die;
		$result = $this->db->insert('sup_purchaseorder_details', $data);
		if ($result == true) {

			$purchaseid = $this->db->insert_id();
			$this->db->query("UPDATE preference_settings SET supplierpurchaseorder='' WHERE id=1");
			$this->db->where('purchaseorderno', $this->input->post('workorderno'))->update('purchaseorder_details', ['edit_status' => 2]);
			$sparename = $_POST['itemname'];

			$hsnnos = $_POST['hsnno'];
			$sgsts = $_POST['sgst'];
			$cgsts = $_POST['cgst'];
			$igsts = $_POST['igst'];
			$priceTypes = $_POST['priceType'];



			$itemnames = $_POST['itemname'];
			$itemids  = $_POST['itemid'];
			$item_descs = $_POST['item_desc'];
			$itemcodes = $_POST['itemcode'];
			$uom = $_POST['uom'];
			$rates = $_POST['rate'];
			$qty = $_POST['qty'];
			$total = $_POST['total'];
			$hsnnoss = $_POST['hsnno'];
			$grades = $_POST['grade'];
			$drawingnos = $_POST['drawingno'];
			$workorderids = $_POST['id'];
			$weights = $_POST['weight'];
			$deliverydatess = $_POST['deliverydates'];
			$count = count($sparename);



			for ($j = 0; $j <  $count; $j++) {
				$podatass = array(
					'date' => date('Y-m-d'),
					'potype' => $potype,
					'purchasedate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
					// 	'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
					'purchaseorderno' => $_POST['purchaseorderno'],
					'purchaseorder' => $_POST['purchaseorder'],
					// 	'selected_bom'=>$selected_bom,				
					'customerId' => $customerid,
					'customername' => $_POST['customername'],
					'supplierid' => $_POST['supplierid'],
					'suppliername' => $_POST['suppliername'],
					'workorderno' => $_POST['workorderno'],
					'workorderid' => $workorderids[$j],
					'invoiceno' => $_POST['invoiceno'],
					'deliverydate' => $_POST['deliverydate'],
					'itemid' => $itemids[$j],
					'itemcode' => $itemcodes[$j],
					'itemname' => $itemnames[$j],
					'item_desc' => $item_descs[$j],
					'uom' => $uom[$j],
					'rate' => $rates[$j],
					'qty' => $qty[$j],
					'balaceqty' => $qty[$j],
					'grade' => $grades[$j],
					'drawingno' => $drawingnos[$j],
					'weight' => $weights[$j],
					// 	'bom_qty'=>$bom_qty[$j],
					'total' => $total[$j],
					'hsnno' => $hsnnoss[$j],
					'address' => $_POST['address'],
					'subtotal' => $_POST['subtotal'],
					'grandtotal' => $_POST['grandtotal'],
					'deliverydates' => $deliverydatess[$j],
					'purchasenodate' => $purchasenodate,
					'purchasenoyear' => $purchasenoyear,
					'purchaseid' => $purchaseid,
					'status' => 1
				);

                //   echo '<pre>';
                //   print_r($podatass);die;

				$this->db->insert('sup_purchaseorder_reports', $podatass);
			}

			if ($potype == 'workorder') {
				$workorderid = $this->input->post('id');

				$qty = $this->input->post('qty');
				$balanceqty = $this->input->post('balanceqty');
				$itemname = $this->input->post('itemname');
				$counts = count($itemname);

				for ($z = 0; $z < $counts; $z++) {
					$balanceQtys = $balanceqty[$z] - $qty[$z];
					$datas = array('workorderbalance' => $balanceQtys);
					$this->db->where('id', $workorderid[$z]);
					$this->db->update('purchaseorder_reports', $datas);
				}
			}

			$this->session->set_flashdata('msg', 'purchaseorder Added Successfully');
			//if($_POST['print']=='print')
			if (isset($_POST['print'])) {
				redirect('supplier_purchaseorder/directPrint');
			}
			//if($_POST['save']=='save')
			if (isset($_POST['save'])) {
				redirect('supplier_purchaseorder');
			}
		} else {
			$this->session->set_flashdata('msg1', 'purchaseorder Added Unsuccessfully');
			redirect('purchaseorder');
		}
	}

	public function view()
	{
		//$data['purchase']=$this->sup_purchaseorder_model->select();
		//$data['vat']=$this->db->get('vat_details')->result_array(); 
		$this->load->view('header');
		$this->load->view('sup_purchaseOrder_view');
		$this->load->view('footer1');
	}

	public function views()
	{
		$id = base64_decode($this->uri->segment(3));
		$data['result'] = $this->db->where('id', $id)->get('sup_purchaseorder_details')->result_array();
		$this->load->view('header');
		$this->load->view('sup_purchaseOrder_viewDet', $data);
		$this->load->view('footer');
	}

	public function pending()
	{

		$suppliername = $this->input->post('suppliername');
		$fromdate     = $this->input->post('fromdate');
		$todate       = $this->input->post('todate');
		$data['view'] = $this->sup_purchaseorder_model->select_pending($suppliername, $fromdate, $todate);
		$this->load->view('header');
		$this->load->view('purchaseOrder_pending', $data);
		$this->load->view('footer1');
	}


	public function ajax_list()
	{
		$list = $this->sup_purchaseorder_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i = 1;
		foreach ($list as $person) {
			$startTimeStamp = strtotime($person->purchasedate);
			$endTimeStamp = strtotime(date('Y-m-d'));
			$timeDiff = abs($endTimeStamp - $startTimeStamp);
			$numberDays = $timeDiff / 86400;  // 86400 seconds in one day
			$numberDays = intval($numberDays);

			$no++;
			$row = array();
			$row[] = $i++;
			$row[] = date('d-m-Y', strtotime($person->purchasedate));
			$row[] = $person->purchaseorderno;
			$row[] = $person->customername;
			$row[] = $person->suppliername;
			$row[] = $numberDays . ' Days';
			$row[] = $person->grandtotal;
			$code = base64_encode($person->id);
			//add html for action
			$deleteOptn = '<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person(' . "'" . $code . "'" . ')">Delete</a>';

			if ($person->edit_status == '2') {
				$disable = 'style="pointer-events:none; opacity:0.5; color:#ccc !important; cursor:not-allowed;"';
				$row[] = '
			<div class="btn-group">
				<button type="button" class="btn btn-secondary dropdown-toggle waves-effect waves-light"
				data-toggle="dropdown" aria-expanded="false">Manage <span class="caret"></span></button>

				<ul class="dropdown-menu"
				role="menu" style="background: #23BDCF;width:14px;min-width:100%;">

					<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('supplier_purchaseorder/views/' . $code) . '" title="View" >View</a></li>
					<li><a ' . $disable . ' href="#">Edit</a></li>
					<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="' . base_url('supplier_purchaseorder/invoice/' . $code) . '" title="Hapus" >Print</a></li> 
					<li><a ' . $disable . ' href="#">Delete</a></li>

				</ul>
			</div>
			';
			} else if ($person->edit_status == 1) {

				$row[] = '


					<div class="btn-group">
					<button type="button" class="btn
					btn-info dropdown-toggle waves-effect waves-light"
					data-toggle="dropdown" aria-expanded="false">Manage <span
					class="caret"></span></button>
					<ul class="dropdown-menu"
					role="menu" style="background: #23BDCF none repeat scroll
					0% 0%;width:14px;min-width: 100%;">


					<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('supplier_purchaseorder/views/' . $code) . '" title="View" >View</a></li>
					<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('supplier_purchaseorder/edit/' . $code) . '" title="Edit" >Edit</a></li>
					<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="' . base_url('supplier_purchaseorder/invoice/' . $code) . '" title="Hapus" >Print</a></li>  
					<li>' . $deleteOptn . '</li>
					</ul>
					</div>

					';
			}

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->sup_purchaseorder_model->count_all(),
			"recordsFiltered" => $this->sup_purchaseorder_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	// public function excel_download()
	// {
	//     // 🔥 HARD RESET OUTPUT
	//     if (ob_get_length()) {
	//         ob_end_clean();
	//     }
	//     ob_start();

	//     error_reporting(E_ALL);
	//     ini_set('display_errors', 0); // IMPORTANT for download

	//     $this->load->library('excel');

	//     // 🔥 CREATE FRESH OBJECT (VERY IMPORTANT)
	//     $objPHPExcel = new PHPExcel();
	//     $sheet = $objPHPExcel->setActiveSheetIndex(0);

	//     /* ========= TITLE ========= */
	//     $sheet->mergeCells('A1:N1');
	//     $sheet->setCellValue('A1', 'OPEN ORDER STATUS - CKP');
	//     $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
	//     $sheet->getStyle('A1')->getAlignment()
	//           ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	//     /* ========= HEADERS ========= */
	//     $headers = [
	//         'S.No', 'Order No', 'Order Date', 'Customer',
	//         'Item', 'Color', 'Size',
	//         'Qty', 'Rate', 'Amount',
	//         'Delivered Qty', 'Bal Qty',
	//         'Bal Amount', 'Remarks'
	//     ];

	//     $col = 'A';
	//     foreach ($headers as $header) {
	//         $sheet->setCellValue($col.'4', $header);
	//         $sheet->getStyle($col.'4')->getFont()->setBold(true);
	//         $sheet->getStyle($col.'4')->getBorders()
	//               ->getAllBorders()
	//               ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	//         $col++;
	//     }

	//     /* ========= DATA ========= */
	//     $sheet->setCellValue('A5', 1);
	//     $sheet->setCellValue('B5', 'ORD-001');
	//     $sheet->setCellValue('C5', '11-12-2025');
	//     $sheet->setCellValue('D5', 'WCB');
	//     $sheet->setCellValue('E5', 'Shirt');
	//     $sheet->setCellValue('F5', 'Blue');
	//     $sheet->setCellValue('G5', 'L');
	//     $sheet->setCellValue('H5', 28);
	//     $sheet->setCellValue('I5', 30);
	//     $sheet->setCellValue('J5', '=H5*I5');
	//     $sheet->setCellValue('K5', 10);
	//     $sheet->setCellValue('L5', '=H5-K5');
	//     $sheet->setCellValue('M5', '=L5*I5');
	//     $sheet->setCellValue('N5', '');

	//     foreach (range('A', 'N') as $column) {
	//         $sheet->getColumnDimension($column)->setAutoSize(true);
	//     }

	//     $filename = 'Open_Order_Status.xls';

	//     /* ========= HEADERS ========= */
	//     header('Content-Type: application/vnd.ms-excel');
	//     header('Content-Disposition: attachment; filename="'.$filename.'"');
	//     header('Cache-Control: max-age=0');
	//     header('Pragma: public');

	//     require_once APPPATH.'third_party/PHPExcel/PHPExcel/IOFactory.php';

	//     $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	//     $writer->save('php://output');

	//     ob_end_flush();
	//     exit;
	// }


	public function pending_search_reports()
	{
		$fromdate = $this->input->post('fromdate');
		$todate = $this->input->post('todate');
		$cusname = $this->input->post('cusname');

		$data = array(
			'rcbio_fromdate' => $fromdate,
			'rcbio_todate' => $todate,
			'rcbio_cusname' => $cusname,
			'rcbio_bill_format' => 'download',
		);

		$this->session->set_userdata($data);
	}

	public function excel_download()
	{
		// Temporarily suppress deprecation warnings for this specific function
		error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE & ~E_WARNING);

		$result = $this->Sup_purchaseorder_pending_model->search_billing();

		$this->load->library('excel');
		$sheet = $this->excel->setActiveSheetIndex(0);
		$sheet->setTitle('Open Order Status');

		/* ================= PAGE SETUP FOR A4 ================= */
		$sheet->getPageSetup()
			->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)
			->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4)
			->setFitToWidth(1)
			->setFitToHeight(0);

		// Set print area for A4 sheet
		$sheet->getPageSetup()->setPrintArea('A1:V100');

		// Set margins for better printing
		$sheet->getPageMargins()->setTop(0.5);
		$sheet->getPageMargins()->setRight(0.25);
		$sheet->getPageMargins()->setLeft(0.25);
		$sheet->getPageMargins()->setBottom(0.5);

		/* ================= ADD LOGO ================= */
		$logoPath = FCPATH . 'upload/ckprime.png';

		if (file_exists($logoPath)) {
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('Logo');
			$objDrawing->setDescription('Company Logo');
			$objDrawing->setPath($logoPath);

			// Smaller logo for A4
			$objDrawing->setHeight(80);
			$objDrawing->setWidth(80);

			$objDrawing->setCoordinates('B2');
			$objDrawing->setOffsetX(5);
			$objDrawing->setOffsetY(5);

			$objDrawing->setWorksheet($sheet);
		}

		/* ================= TITLE ================= */
		$sheet->setCellValue('D2', 'CK PRIME OPEN ORDER STATUS');
		$sheet->mergeCells('D2:V2');

		$titleStyle = $sheet->getStyle('D2');
		$titleStyle->getFont()
			->setName('Times New Roman')
			->setSize(16) // Smaller font for A4
			->setBold(true);

		$titleStyle->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		/* ================= VENDOR ================= */
		$vendorName = $this->input->post('cusname') ?: '';
		$sheet->setCellValue('B4', 'VENDOR NAME : ' . $vendorName);
		$sheet->mergeCells('B4:V4');

		$vendorStyle = $sheet->getStyle('B4');
		$vendorStyle->getFont()->setBold(true)->setSize(11);
		$vendorStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		/* ================= HEADERS ================= */
		$headers = [
			'B6' => 'S.NO',
			'C6' => 'DATE',
			'D6' => 'PO NO',
			'E6' => 'DESCRIPTION',
			'F6' => 'DRG NO',
			'G6' => 'GRADE',
			'H6' => 'C.WEIGHT',
			'I6' => 'ORDER QTY',
			'J6' => 'ORDER WEIGHT',
			'K6' => 'POURED QTY',
			'L6' => 'DISPATCH QTY',
			'M6' => 'DISPATCH WEIGHT',
			'N6' => 'BALANCE QTY',
			'O6' => 'WIP',
			'P6' => 'WIP WEIGHT',
			'Q6' => 'TO POUR QTY',
			'R6' => 'TO POUR WT',
			'S6' => 'TARGET DT',
			'T6' => 'DL. DATE',
			'U6' => 'STATUS',
			'V6' => 'REMARKS'
		];

		// First, set all header values
		foreach ($headers as $cell => $value) {
			$sheet->setCellValue($cell, $value);
		}

		// Now apply styles to the entire header row (B6:V6)
		$headerRange = 'B6:V6';
		$headerStyle = $sheet->getStyle($headerRange);

		// Font and alignment
		$headerStyle->getFont()->setBold(true)->setSize(9);
		$headerStyle->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
			->setWrapText(true);

		// Background color for all headers
		$headerStyle->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFD9D9D9');

		// Borders for all headers
		$headerStyle->getBorders()->getAllBorders()
			->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		// Set specific text wrapping for longer headers
		$longHeaders = ['J6', 'M6', 'P6', 'R6']; // Columns with longer text
		foreach ($longHeaders as $cell) {
			$sheet->getStyle($cell)->getAlignment()->setWrapText(true);
		}

		/* ================= DATA ================= */
		$row = 7; // Start data from row 7
		$sno = 1;

		// Variables for totals
		$totalOrderQty = 0;
		$totalOrderWeight = 0;
		$totalPouredQty = 0;
		$totalDispatchQty = 0;
		$totalDispatchWeight = 0;
		$totalBalanceQty = 0;
		$totalToPourQty = 0;
		$totalToPourWeight = 0;

		// Track previous purchase date and PO number for grouping
		$prevPurchaseDate = '';
		$prevPurchaseNo = '';

		foreach ($result as $rowData) {
			$getgrade = $this->db->where('id', $rowData['grade'])->get('grade')->row();
			$getpurchasedetails = $this->db->select_sum('qty')->where('purchaseorderno', $rowData['purchaseorderno'])->where('supplierId', $rowData['supplierid'])->where('itemid', $rowData['itemid'])->get('purchase_reports')->row();

			// Format date properly
			$purchaseDate = !empty($rowData['purchasedate']) ? date('d-m-Y', strtotime($rowData['purchasedate'])) : '';
			$deliverydate = !empty($rowData['deliverydate']) ? date('d-m-Y', strtotime($rowData['deliverydate'])) : '';

			// Current values
			$currentPurchaseDate = $purchaseDate;
			$currentPurchaseNo = $rowData['purchaseorderno'] ?? '';
			$currentItemName = $rowData['itemname'] ?? '';

			// Calculate with proper type casting
			$weight = floatval($rowData['weight'] ?? 0);
			$qty = floatval($rowData['qty'] ?? 0);
			$orderWeight = $weight * $qty;

			// Ensure numeric values are properly formatted
			$pouredQty = floatval($rowData['poured_qty'] ?? 0);
			$dispatchQty = isset($getpurchasedetails->qty) ? (float) $getpurchasedetails->qty : 0;
			$dispatchWeight = floatval($dispatchQty * $weight);
			$balanceQty = floatval($rowData['balaceqty'] ?? 0);
			$wipQty = floatval($rowData['wip_qty'] ?? 0);
			$wipWeight = floatval($rowData['wip_weight'] ?? 0);
			$toPourQty = floatval($rowData['to_pour_qty'] ?? 0);
			$toPourWeight = floatval($rowData['to_pour_weight'] ?? 0);

			// Accumulate totals
			$totalOrderQty += $qty;
			$totalOrderWeight += $orderWeight;
			$totalPouredQty += $pouredQty;
			$totalDispatchQty += $dispatchQty;
			$totalDispatchWeight += $dispatchWeight;
			$totalBalanceQty += $balanceQty;
			$totalToPourQty += $toPourQty;
			$totalToPourWeight += $toPourWeight;

			// Check if we should show purchase date and PO number
			$showDate = ($currentPurchaseDate != $prevPurchaseDate || $currentPurchaseNo != $prevPurchaseNo);
			$showPONo = $showDate;

			// Set cell values with proper formatting
			$sheet->setCellValue('B' . $row, $sno++);

			// Purchase Date - only show when it changes
			if ($showDate) {
				$sheet->setCellValue('C' . $row, $currentPurchaseDate);
				$prevPurchaseDate = $currentPurchaseDate;
			} else {
				$sheet->setCellValue('C' . $row, '');
			}

			// PO Number - only show when it changes
			if ($showPONo) {
				$sheet->setCellValue('D' . $row, $currentPurchaseNo);
				$prevPurchaseNo = $currentPurchaseNo;
			} else {
				$sheet->setCellValue('D' . $row, '');
			}

			// Always show description
			$sheet->setCellValue('E' . $row, $currentItemName);

			// Rest of the columns
			$sheet->setCellValue('F' . $row, $rowData['drawingno'] ?? '');
			$sheet->setCellValue('G' . $row, $getgrade ? $getgrade->grade : '');
			$sheet->setCellValue('H' . $row, number_format($weight, 2));
			$sheet->setCellValue('I' . $row, $qty);
			$sheet->setCellValue('J' . $row, number_format($orderWeight, 2));
			$sheet->setCellValue('K' . $row, $pouredQty);
			$sheet->setCellValue('L' . $row, $dispatchQty);
			$sheet->setCellValue('M' . $row, number_format($dispatchWeight, 2));
			$sheet->setCellValue('N' . $row, $balanceQty);
			$sheet->setCellValue('O' . $row, $wipQty);
			$sheet->setCellValue('P' . $row, number_format($wipWeight, 2));
			$sheet->setCellValue('Q' . $row, $toPourQty);
			$sheet->setCellValue('R' . $row, number_format($toPourWeight, 2));
			$sheet->setCellValue('S' . $row, $deliverydate);
			$sheet->setCellValue('T' . $row, '');
			$sheet->setCellValue('U' . $row, '');
			$sheet->setCellValue('V' . $row, '');

			// Set alignment for all data cells
			$alignmentStyle = $sheet->getStyle('B' . $row . ':V' . $row);
			$alignmentStyle->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

			// Special alignment for text columns
			$sheet->getStyle('E' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$sheet->getStyle('V' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

			// Set smaller font for data
			$sheet->getStyle('B' . $row . ':V' . $row)->getFont()->setSize(9);

			// Set number format for numeric columns
			$sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode('0.00');
			$sheet->getStyle('J' . $row)->getNumberFormat()->setFormatCode('0.00');
			$sheet->getStyle('M' . $row)->getNumberFormat()->setFormatCode('0.00');
			$sheet->getStyle('P' . $row)->getNumberFormat()->setFormatCode('0.00');
			$sheet->getStyle('R' . $row)->getNumberFormat()->setFormatCode('0.00');

			// Add borders to data rows
			$borderStyle = $sheet->getStyle('B' . $row . ':V' . $row);
			$borderStyle->getBorders()->getAllBorders()
				->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			// Alternate row color for better readability
			if ($row % 2 == 0) {
				$fillStyle = $sheet->getStyle('B' . $row . ':V' . $row);
				$fillStyle->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getStartColor()->setARGB('FFF2F2F2');
			}

			$row++;
		}

		/* ================= TOTALS ROW ================= */
		$totalRow = $row + 1; // Leave one blank row after data

		// Label cell
		$sheet->setCellValue('G' . $totalRow, 'TOTAL');
		$sheet->mergeCells('G' . $totalRow . ':H' . $totalRow);
		$sheet->getStyle('G' . $totalRow)->getFont()->setBold(true)->setSize(10);
		$sheet->getStyle('G' . $totalRow)->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		// Order Qty total
		$sheet->setCellValue('I' . $totalRow, $totalOrderQty);

		// Order Weight total
		$sheet->setCellValue('J' . $totalRow, number_format($totalOrderWeight, 2));

		// Poured Qty total
		$sheet->setCellValue('K' . $totalRow, $totalPouredQty);

		// Dispatch Qty total
		$sheet->setCellValue('L' . $totalRow, $totalDispatchQty);

		// Dispatch Weight total
		$sheet->setCellValue('M' . $totalRow, number_format($totalDispatchWeight, 2));

		// Balance Qty total
		$sheet->setCellValue('N' . $totalRow, $totalBalanceQty);

		// To Pour Qty total
		$sheet->setCellValue('Q' . $totalRow, $totalToPourQty);

		// To Pour Weight total
		$sheet->setCellValue('R' . $totalRow, number_format($totalToPourWeight, 2));

		// Style the totals row
		$totalsStyle = $sheet->getStyle('I' . $totalRow . ':R' . $totalRow);
		$totalsStyle->getFont()->setBold(true)->setSize(10);
		$totalsStyle->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		// Number format for totals
		$sheet->getStyle('J' . $totalRow)->getNumberFormat()->setFormatCode('0.00');
		$sheet->getStyle('M' . $totalRow)->getNumberFormat()->setFormatCode('0.00');
		$sheet->getStyle('R' . $totalRow)->getNumberFormat()->setFormatCode('0.00');

		// Background color for totals row
		$totalsFill = $sheet->getStyle('G' . $totalRow . ':R' . $totalRow);
		$totalsFill->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFB8CCE4'); // Light blue background

		// Borders for totals row
		$totalsBorder = $sheet->getStyle('G' . $totalRow . ':R' . $totalRow);
		$totalsBorder->getBorders()->getAllBorders()
			->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		/* ================= COLUMN WIDTHS FOR A4 ================= */
		// Set optimized widths for A4 landscape
		$columnWidths = [
			'A' => 8,   // Logo column
			'B' => 6,   // S.NO
			'C' => 10,  // DATE
			'D' => 12,  // PO NO
			'E' => 25,  // DESCRIPTION
			'F' => 12,  // DRG NO
			'G' => 10,  // GRADE
			'H' => 10,  // C.WEIGHT
			'I' => 10,  // ORDER QTY
			'J' => 12,  // ORDER WEIGHT
			'K' => 10,  // POURED QTY
			'L' => 12,  // DISPATCH QTY
			'M' => 14,  // DISPATCH WEIGHT
			'N' => 12,  // BALANCE QTY
			'O' => 8,   // WIP
			'P' => 12,  // WIP WEIGHT
			'Q' => 12,  // TO POUR QTY
			'R' => 12,  // TO POUR WT
			'S' => 12,  // TARGET DT
			'T' => 10,  // DL. DATE
			'U' => 10,  // STATUS
			'V' => 15   // REMARKS
		];

		foreach ($columnWidths as $column => $width) {
			$sheet->getColumnDimension($column)->setWidth($width);
		}

		// Wrap text for description column
		$sheet->getStyle('E7:E' . ($row - 1))->getAlignment()->setWrapText(true);

		/* ================= ROW HEIGHTS ================= */
		$sheet->getRowDimension(2)->setRowHeight(60); // Title row with logo
		$sheet->getRowDimension(6)->setRowHeight(35); // INCREASED HEADER HEIGHT (was 20)
		for ($i = 7; $i < $row; $i++) {
			$sheet->getRowDimension($i)->setRowHeight(18); // Data rows
		}
		$sheet->getRowDimension($totalRow)->setRowHeight(20); // Totals row

		/* ================= BORDERS ================= */
		$lastDataRow = $row - 1;
		if ($lastDataRow >= 6) {
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);
			$sheet->getStyle('B6:V' . $lastDataRow)->applyFromArray($styleArray);
		}

		/* ================= DOWNLOAD ================= */
		$filename = 'Open_Order_Status_' . date('d-m-Y') . '.xls';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		// Force download with proper error handling
		try {
			$writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			$writer->save('php://output');
		} catch (Exception $e) {
			log_message('error', 'Excel download error: ' . $e->getMessage());
			echo "Error generating Excel file. Please try again.";
		}

		exit;
	}

	public function ajax_delete($id)
	{
		$this->sup_purchaseorder_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function autocomplete_customername()
	{
		$orderno = $this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('customer_details');
		$this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
		$this->db->like('name', $orderno);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) {
			$json_array             = array();
			$json_array['label']    = $d->name;
			$json_array['value']    = $d->name;
			$json_array['address']    = $d->address1 . ', ' . $d->address2 . ', ' . $d->city . ', ' . $d->state;
			$json_array['supplierid'] = $d->id;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}

	public function autocomplete_itemcode()
	{
		$orderno = $this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('itemno', $orderno);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) {
			$json_array             = array();
			$json_array['label']    = $d->itemno;
			$json_array['value']    = $d->itemno;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}

	public function get_itemcode()
	{
		$itemcode = $this->input->post('name');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->where('itemno', $itemcode);
		$query = $this->db->get();
		$result = $query->result();
		foreach ($result as $h) {
			$vob['itemname'] = $h->itemname;
			$vob['price'] = $h->price;
			$vob['hsnno'] = $h->hsnno;
		}
		echo json_encode($vob);
	}

	public function get_hsnno()
	{
		$itemcode = $this->input->post('name');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->where('hsnno', $itemcode);
		$query = $this->db->get();
		$result = $query->result();
		foreach ($result as $h) {
			$vob['itemname'] = $h->itemname;
			$vob['price'] = $h->price;
			$vob['sgst'] = $h->sgst;
			$vob['cgst'] = $h->cgst;
			$vob['igst'] = $h->igst;
		}
		echo json_encode($vob);
	}


	public function get_itemnames()
	{
		$itemcode = $this->input->post('name');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->where('itemname', $itemcode);
		$query = $this->db->get();
		$result = $query->result();
		foreach ($result as $h) {
			$uom = $this->db->select('uom')->where('id', $h->uom)->get('uom')->row()->uom;
			$vob['hsnno'] = $h->hsnno;
			$vob['price'] = $h->price;
			$vob['priceType'] = $h->priceType;
			$vob['sgst'] = $h->sgst;
			$vob['cgst'] = $h->cgst;
			$vob['igst'] = $h->igst;
			$vob['uom'] = $uom;
		}
		echo json_encode($vob);
	}

	public function autocomplete_itemname()
	{
		$orderno = $this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('itemname', $orderno);
		$this->db->where('itemtype', 'Raw Material');
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) {
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
		$orderno = $this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('hsnno', $orderno);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) {
			$json_array             = array();
			$json_array['label']    = $d->hsnno;
			$json_array['value']    = $d->hsnno;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}

	public function edit()
	{
		$id = base64_decode($this->uri->segment(3));
		$data['result'] = $this->db->where('id', $id)->get('sup_purchaseorder_details')->result_array();


		// echo"<prE>";
		// print_r($data['result']);
		$this->load->view('header');
		$this->load->view('sup_purchaseOrder_edit', $data);
		$this->load->view('footer');
	}

	public function getsupplier()
	{
		$name = $_POST['name'];
		$data = $this->db->where('name', $name)->where("(type = 'Intra supplier' OR type = 'Inter supplier')")->get('customer_details')->result();
		echo $count = count($data);
	}

	public function autocomplete_invoiceno()
	{
		$name = $this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('sup_purchaseorder_details');
		$this->db->like('purchaseno', $name);
		$this->db->where('purchasetype', 'Direct purchaseorder');
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) {
			$json_array             = array();
			$json_array['value']    = $d->purchaseno;
			$json_array['label']    = $d->purchaseno;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}

	public function autocomplete_purchaseorderno()
	{
		$name = $this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('sup_purchaseorder_details');
		$this->db->like('purchaseorderno', $name);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) {
			$json_array             = array();
			$json_array['value']    = $d->purchaseorderno;
			$json_array['label']    = $d->purchaseorderno;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}


	public function autocomplete_no()
	{
		$name = $this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('itemno', $name);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) {
			$json_array             = array();
			$json_array['value']    = $d->itemno;
			$json_array['label']    = $d->itemno;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}


	public function autocomplete_item()
	{
		$itemname = $this->input->post('keyword');
		//$cusname='ram';
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('itemname', $itemname);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) {
			$json_array             = array();
			$json_array['value']    = $d->itemname;
			$json_array['label']    = $d->itemname;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}

	public function get_itemno()
	{
		$itemno = $this->input->post('itemno');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->where('itemno', $itemno);
		$query = $this->db->get();
		$result = $query->result();
		foreach ($result as $s) {
			$vob['itemname'] = $s->itemname;
			$vob['price'] = $s->price;
		}
		echo json_encode($vob);
	}

	public function get_itemname()
	{
		$itemname = $this->input->post('itemname');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->where('itemname', $itemname);
		$query = $this->db->get();
		$result = $query->result();
		foreach ($result as $s) {
			$vob['itemno'] = $s->itemno;
			$vob['price'] = $s->price;
		}
		echo json_encode($vob);
	}

	public function update()
	{
		//print_r($this->input->post());
		//exit;
		/*Array ( [hiddenDiscountBy] => percent_wise [purchasedate] => 21-12-2017 [invoicedate] => 21-12-2017 [suppliername] => Supplier [supplierid] => 2 [gsttype] => intrastate [address] => Aasath Nagar, SMM Flour Mill, Virudhunagar, Tamil Nadu [hsnno] => Array ( [0] => 004 [1] => 005 ) [itemno] => Array ( [0] => [1] => ) [itemname] => Array ( [0] => 100MM Sheet [1] => 200MM Sheet ) [priceType] => Array ( [0] => Exclusive [1] => Exclusive ) [qty] => Array ( [0] => 10 [1] => 10 ) [qtys] => Array ( [0] => 10 [1] => 10 ) [uom] => Array ( [0] => PCs [1] => PCs ) [rate] => Array ( [0] => 150 [1] => 150 ) [amount] => Array ( [0] => 1500.00 [1] => 1500.00 ) [gstcal] => Array ( [0] => [1] => ) [discount] => Array ( [0] => 0 [1] => 0 ) [taxableamount] => Array ( [0] => 1500.00 [1] => 1500.00 ) [discountamount] => Array ( [0] => [1] => ) [cgst] => Array ( [0] => 6 [1] => 6 ) [cgstamount] => Array ( [0] => 90.00 [1] => 90.00 ) [sgst] => Array ( [0] => 6 [1] => 6 ) [sgstamount] => Array ( [0] => 90.00 [1] => 90.00 ) [total] => Array ( [0] => 1680.00 [1] => 1680.00 ) [freightamount] => 100 [freightcgst] => 5 [freightcgstamount] => 5.00 [freightsgst] => 5 [freightsgstamount] => 5.00 [freighttotal] => 110.00 [loadingamount] => 50 [loadingcgst] => 5 [loadingcgstamount] => 2.50 [loadingsgst] => 5 [loadingsgstamount] => 2.50 [loadingtotal] => 55.00 [subtotal] => 3525.00 [roundOff] => 0 [othercharges] => 0 [grandtotal] => 3525.00 [taxtotal] => [purchaseorderno] => P001 [id] => 1 )*/
		$id = $this->input->post('id');

		$hsnno          = is_array($_POST['hsnno']) ? implode('||', $_POST['hsnno']) : $_POST['hsnno'];
		$itemid         = is_array($_POST['itemid']) ? implode('||', $_POST['itemid']) : $_POST['itemid'];
		$itemcode       = is_array($_POST['itemcode']) ? implode('||', $_POST['itemcode']) : $_POST['itemcode'];
		$itemnamess       = is_array($_POST['itemname']) ? implode('||', $_POST['itemname']) : $_POST['itemname'];
		$item_desc       = is_array($_POST['item_desc']) ? implode('||', $_POST['item_desc']) : $_POST['item_desc'];
		$weight       = is_array($_POST['weight']) ? implode('||', $_POST['weight']) : $_POST['weight'];
		$drawingno       = is_array($_POST['drawingno']) ? implode('||', $_POST['drawingno']) : $_POST['drawingno'];
		$quantity            = is_array($_POST['qty']) ? implode('||', $_POST['qty']) : $_POST['qty'];
		$uom            = is_array($_POST['uom']) ? implode('||', $_POST['uom']) : $_POST['uom'];
		$rate           = is_array($_POST['rate']) ? implode('||', $_POST['rate']) : $_POST['rate'];
		$amount         = is_array($_POST['amount']) ? implode('||', $_POST['amount']) : $_POST['amount'];
		$grade         = is_array($_POST['grade']) ? implode('||', $_POST['grade']) : $_POST['grade'];
		$discount       = (isset($_POST['discount']) && is_array($_POST['discount'])) ? implode('||', $_POST['discount']) : ($_POST['discount'] ?? '');
		$discountamount = (isset($_POST['discountamount']) && is_array($_POST['discountamount'])) ? implode('||', $_POST['discountamount']) : ($_POST['discountamount'] ?? '');
		$taxableamount  = is_array($_POST['taxableamount']) ? implode('||', $_POST['taxableamount']) : $_POST['taxableamount'];
		$cgst           = is_array($_POST['cgst']) ? implode('||', $_POST['cgst']) : $_POST['cgst'];
		$cgstamount     = is_array($_POST['cgstamount']) ? implode('||', $_POST['cgstamount']) : $_POST['cgstamount'];
		$sgst           = is_array($_POST['sgst']) ? implode('||', $_POST['sgst']) : $_POST['sgst'];
		$sgstamount     = is_array($_POST['sgstamount']) ? implode('||', $_POST['sgstamount']) : $_POST['sgstamount'];
		$igst           = (isset($_POST['igst']) && is_array($_POST['igst'])) ? implode('||', $_POST['igst']) : ($_POST['igst'] ?? '');
		$igstamount     = (isset($_POST['igstamount']) && is_array($_POST['igstamount'])) ? implode('||', $_POST['igstamount']) : ($_POST['igstamount'] ?? '');
		$total          = is_array($_POST['total']) ? implode('||', $_POST['total']) : $_POST['total'];
		$workorderidss          = is_array($_POST['workorderid']) ? implode('||', $_POST['workorderid']) : $_POST['workorderid'];

	    $deliverydates          = is_array($_POST['deliverydates']) ? implode('||', $_POST['deliverydates']) : $_POST['deliverydates'];

		$subtotal       = $this->input->post('subtotal');
		$potype       = $this->input->post('potype');

		$freightamount = $this->input->post('freightamount');
		$freightcgst = $this->input->post('freightcgst');
		$freightcgstamount = $this->input->post('freightcgstamount');
		$freightsgst = $this->input->post('freightsgst');
		$freightsgstamount = $this->input->post('freightsgstamount');
		$freightigst = $this->input->post('freightigst');
		$freightigstamount = $this->input->post('freightigstamount');
		$freighttotal = $this->input->post('freighttotal');
		$loadingamount = $this->input->post('loadingamount');
		$loadingcgst = $this->input->post('loadingcgst');
		$loadingcgstamount = $this->input->post('loadingcgstamount');
		$loadingsgst = $this->input->post('loadingsgst');
		$loadingsgstamount = $this->input->post('loadingsgstamount');
		$loadingigst = $this->input->post('loadingigst');
		$loadingigstamount = $this->input->post('loadingigstamount');
		$loadingtotal = $this->input->post('loadingtotal');
		$roundOff = $this->input->post('roundOff');
		$othercharges = $this->input->post('othercharges');
		$hiddenDiscountBy = $this->input->post('hiddenDiscountBy');
		$grandtotal = $this->input->post('grandtotal');


		$pcode = $_POST['hsnno'];
		$count7 = count($pcode);
		for ($i = 0; $i < $count7; $i++) {
			$res[] = "0";
			$ret[] = "1";
		}

		$billtype = $_POST['gsttype'];
		if ($billtype == 'intrastate') {
			$sgst       = (isset($_POST['sgst']) && is_array($_POST['sgst'])) ? implode('||', $_POST['sgst']) : ($_POST['sgst'] ?? '');
			$cgst       = (isset($_POST['cgst']) && is_array($_POST['cgst'])) ? implode('||', $_POST['cgst']) : ($_POST['cgst'] ?? '');
			$igst       = (isset($res) && is_array($res)) ? implode('||', $res) : '';
			$sgstamount = (isset($_POST['sgstamount']) && is_array($_POST['sgstamount'])) ? implode('||', $_POST['sgstamount']) : ($_POST['sgstamount'] ?? '');
			$cgstamount = (isset($_POST['cgstamount']) && is_array($_POST['cgstamount'])) ? implode('||', $_POST['cgstamount']) : ($_POST['cgstamount'] ?? '');
			$igstamount = (isset($res) && is_array($res)) ? implode('||', $res) : '';

			$sgsts = 'sgst';
			$cgsts = 'cgst';
			$igsts = '';
		}

		if ($billtype == 'interstate') {
			$sgst       = (isset($res) && is_array($res)) ? implode('||', $res) : '';
			$cgst       = (isset($res) && is_array($res)) ? implode('||', $res) : '';
			$igst       = (isset($_POST['igst']) && is_array($_POST['igst'])) ? implode('||', $_POST['igst']) : ($_POST['igst'] ?? '');
			$sgstamount = (isset($res) && is_array($res)) ? implode('||', $res) : '';
			$cgstamount = (isset($res) && is_array($res)) ? implode('||', $res) : '';
			$igstamount = (isset($_POST['igstamount']) && is_array($_POST['igstamount'])) ? implode('||', $_POST['igstamount']) : ($_POST['igstamount'] ?? '');

			$igsts = 'igst';
			$sgsts = '';
			$cgsts = '';
		}

		$customerid = $_POST['customerid'];
		if ($potype == 'workorder') {

			$workorderid = $this->input->post('workorderid');
			$qty = $this->input->post('qty');
			$balanceqty = $this->input->post('balanceqty');

			$counts = count($workorderid);

			for ($z = 0; $z < $counts; $z++) {

				$po_row = $this->db->select('workorderbalance')
					->from('purchaseorder_reports')
					->where('id', $workorderid[$z])
					->get()
					->row();

				if ($po_row) {

					$currentBalance = floatval($po_row->workorderbalance);
					// print_r($currentBalance);
					$oldQty = floatval($balanceqty[$z]);
					// print_r($oldQty);
					$newQty = floatval($qty[$z]);
					// print_r($newQty);    

					$newBalance = $currentBalance + $oldQty - $newQty;
					// print_r($newBalance);die;
					if ($newBalance < 0) {
						$newBalance = 0;
					}

					$this->db->where('id', $workorderid[$z])
						->update('purchaseorder_reports', [
							'workorderbalance' => $newBalance
						]);
				}
			}
		}


		$data = array(
			// 'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
			'customerId' => $customerid,
			'potype' => $_POST['potype'],
			'customername' => $_POST['customername'],
			'supplierid' => $_POST['supplierid'],
			'suppliername' => $_POST['suppliername'],
			'address' => $_POST['address'],
			'workorderno' => $_POST['workorderno'],
			'workorderid' => $workorderidss,
			'purchaseorderno' => $_POST['purchaseorderno'],
			'purchaseorder' => $_POST['purchaseorder'],
			'billtype' => $_POST['gsttype'],
			'gsttype' => $_POST['gsttype'],
			'tcctype'   => $_POST['tcctype'],
			'requirements' => $_POST['requirements'],
			'deliverydates' => $deliverydates,
			'vendor_quot' => $_POST['vendor_quot'],
			'quot_date' => $_POST['quot_date'],
			'typesgst' => $sgsts,
			'typecgst' => $cgsts,
			'typeigst' => $igsts,
			'itemid' => $itemid,
			'hsnno' => $hsnno,
			'itemcode' => $itemcode,
			'itemname' => $itemnamess,
			'item_desc' => $item_desc,
			'uom' => $uom,
			'weight' => $weight,
			'grade' => $grade,
			'drawingno' => $drawingno,
			'rate' => $rate,
			'qty' => $quantity,
			'amount' => $amount,
			'discount' => $discount,
			'discountamount' => $discountamount,
			'taxableamount' => $taxableamount,
			'sgst' => $sgst,
			'sgstamount' => $sgstamount,
			'cgst' => $cgst,
			'cgstamount' => $cgstamount,
			'igst' => $igst,
			'igstamount' => $igstamount,
			'total' => $total,
			'subtotal' => $_POST['subtotal'],
			'freightamount' => $freightamount,
			'freightcgst' => $freightcgst,
			'freightcgstamount' => $freightcgstamount,
			'freightsgst' => $freightsgst,
			'freightsgstamount' => $freightsgstamount,
			'freightigst' => $freightigst,
			'freightigstamount' => $freightigstamount,
			'freighttotal' => $freighttotal,
			'loadingamount' => $loadingamount,
			'loadingcgst' => $loadingcgst,
			'loadingcgstamount' => $loadingcgstamount,
			'loadingsgst' => $loadingsgst,
			'loadingsgstamount' => $loadingsgstamount,
			'loadingigst' => $loadingigst,
			'loadingigstamount' => $loadingigstamount,
			'loadingtotal' => $loadingtotal,
			'roundOff' => $roundOff,
			'othercharges' => $othercharges,
			'discountBy' => $hiddenDiscountBy,
			'return_status' => implode('||', $ret),
			'grandtotal' => $grandtotal,
			'edit_status' => 1
		);
		$this->db->where('id', $id);
		$result = $this->db->update('sup_purchaseorder_details', $data);
		// $results=$this->sup_purchaseorder_model->update_invoice($data,$id);
		if ($result) {
			$this->db->where('purchaseid', $id)->delete('sup_purchaseorder_reports');
			$purchaseid = $_POST['id'];
			$purchasenoyear = $_POST['purchaseorderno'] . '' . date('-Y') . '';
			$purchasenodate = $_POST['purchaseorderno'] . '' . date('dmy') . '';
			$item_descs = $_POST['item_desc'];
			$itemids = $_POST['itemid'];
			$itemcodes = $_POST['itemcode'];
			$hsnnoss = $_POST['hsnno'];
			$grades = $_POST['grade'];
			$drawingnos = $_POST['drawingno'];
			$weights = $_POST['weight'];
			$postItemName = $_POST['itemname'];
			$deliverydatess = $_POST['deliverydates'];
			$uom = $_POST['uom'];
			$rates = $_POST['rate'];
			$qtys = $_POST['qty'];
			$total = $_POST['total'];
			$potype = $_POST['potype'];
			$customerid = $_POST['customerid'];
			$workid = $_POST['workorderid'];
			// print_r($workid);die;
			$count = count($postItemName);

			for ($j = 0; $j <  $count; $j++) {

				$podatass = array(
					'date' => date('Y-m-d'),
					'purchasedate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
					'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
					'purchaseorderno' => $_POST['purchaseorderno'],
					'purchaseorder' => $_POST['purchaseorder'],
					'potype' => $_POST['potype'],
					'workorderno' => $_POST['workorderno'],
					'workorderid' => $workid[$j] ?? '',
					'customerId' => $customerid,
					'customername' => $_POST['customername'],
					'supplierid' => $_POST['supplierid'],
					'suppliername' => $_POST['suppliername'],
					'invoiceno' => $_POST['invoiceno'],
					'deliverydates' => $deliverydatess[$j],
					'itemid' => $itemids[$j],
					'itemcode' => $itemcodes[$j],
					'itemname' => $postItemName[$j],
					'item_desc' => $item_descs[$j],
					'uom' => $uom[$j],
					'rate' => $rates[$j],
					'qty' => $qtys[$j],
					'balaceqty' => $qtys[$j],
					'grade' => $grades[$j],
					'drawingno' => $drawingnos[$j],
					'weight' => $weights[$j],
					'total' => $total[$j],
					'hsnno' => $hsnnoss[$j],
					'address' => $_POST['address'],
					'subtotal' => $_POST['subtotal'],
					'grandtotal' => $_POST['grandtotal'],
					'purchasenodate' => $purchasenodate,
					'purchasenoyear' => $purchasenoyear,
					'purchaseid' => $purchaseid,
					'status' => 1
				);
				$this->db->insert('sup_purchaseorder_reports', $podatass);
			}


			$this->session->set_flashdata('msg', 'purchaseorder Updated Successfully');
			redirect('supplier_purchaseorder');
		} else {
			$this->session->set_flashdata('msg1', 'No Changes');
			redirect('supplier_purchaseorder');
		}
	}

	public function search()
	{
		$fromdate = $this->input->post('fromdate');
		$todate = $this->input->post('todate');
		$customername = $this->input->post('customername');
		$purchaseorderno = $this->input->post('purchaseorderno');

		$data = array(
			'rcbio_fromdate' => $fromdate,
			'rcbio_todate' => $todate,
			'rcbio_customername' => $customername,
			'rcbio_purchaseorderno' => $purchaseorderno,
			'rcbio_bill_format' => 'Print',
		);
		$this->session->set_userdata($data);
	}


	public function search_reports()
	{
		$bill_format = $this->session->userdata('rcbio_bill_format');
		$data['purchase'] = $this->sup_purchaseorder_model->search_billing();
		$data['fromdate'] = $this->session->userdata('rcbio_fromdate');
		$data['todate'] = $this->session->userdata('rcbio_todate');
		$data['customername'] = $this->session->userdata('rcbio_customername');
		$data['purchaseorderno'] = $this->session->userdata('rcbio_purchaseorderno');
		$this->load->view('purchaseOrder_searchreports', $data);
	}


	public function delete()
	{
		$del = base64_decode($this->input->post('id'));

		$getdetails = $this->db->where('id', $del)->get('sup_purchaseorder_details')->result();

		foreach ($getdetails as $row) {

			$purchaseorderno = $row->purchaseorderno;
			$workorderno     = $row->workorderno;

			$this->db->where('purchaseorderno', $workorderno)
				->update('purchaseorder_details', ['edit_status' => 1]);

			$items = $this->db->where('purchaseid', $del)->get('sup_purchaseorder_reports')->result();

			foreach ($items as $it) {

				$po_row = $this->db->select('workorderbalance')
					->where('id', $it->workorderid)
					->get('purchaseorder_reports')
					->row();

				if ($po_row) {

					$restoreBalance = floatval($po_row->workorderbalance) + floatval($it->qty);

					$this->db->where('id', $it->workorderid)
						->update('purchaseorder_reports', [
							'workorderbalance' => $restoreBalance
						]);
				}
			}
		}

		$data = $this->db->where('id', $del)->delete('sup_purchaseorder_details');

		if ($data) {
			$this->db->where('purchaseid', $del)->delete('sup_purchaseorder_reports');
			echo 'yes';
		} else {
			echo 'no';
		}
	}



	public function pending_search()
	{
		$data['pending'] = $this->sup_purchaseorder_model->search_reports();
		$this->load->view('header');
		$this->load->view('purchase_pending_view', $data);
		$this->load->view('footer1');
	}


	public function purchase_reports()
	{
		@$suppliername = $_POST['suppliername'];
		@$fromdate = $_POST['fromdate'];
		@$todate = $_POST['todate'];
		$data['pending'] = $this->sup_purchaseorder_model->search_pending();
		// echo"<pre>";
		// print_r($data);
		$this->load->view('purchase_reports', $data, $fromdate, $todate, $suppliername);
	}

	public function reports()
	{
		@$suppliername = $_POST['suppliername'];
		@$fromdate = $_POST['fromdate'];
		@$todate = $_POST['todate'];
		$data['pending'] = $this->sup_purchaseorder_model->search_reports();
		$this->load->view('purchase_reports2', $data, $fromdate, $todate);
	}

	public function reports1()
	{
		@$suppliername = $_POST['suppliername'];
		@$fromdate = $_POST['fromdate'];
		@$todate = $_POST['todate'];
		$data['pending'] = $this->sup_purchaseorder_model->search_pending();
		$this->load->view('purchase_reports1', $data, $fromdate, $todate);
	}

	public function get_supplier()
	{
		$name = $_POST['name'];
		$data = $this->db->where('name', $name)->get('customer_details')->result();
		echo $count = count($data);
	}

	public function check_hsnno()
	{
		$name = $_POST['name'];
		$data = $this->db->where('hsnno', $name)->get('additem')->result();
		echo $count = count($data);
	}
	public function autocomplete_vendorname()
	{
		$orderno = $this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('vendor_details');
		$this->db->like('vendorname', $orderno);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) {
			$json_array             = array();
			$json_array['label']    = $d->vendorname;
			$json_array['value']    = $d->vendorname;
			$json_array['id']    = 	$d->id;
			$json_array['vendordetails']    = 	$d->address1 . ', ' . $d->address2;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}

	public function check_vendors()
	{
		$name = $_POST['vendors'];
		$data = $this->db->where('vendorname', $name)->get('vendor_details')->result();
		echo $count = count($data);
	}

	public function get_bomno()
	{
		$query = $this->db->where('status', 1)->group_by('bomno')->get('bom_details');
		$result = $query->result();
		$data = array();
		if ($result) {
			foreach ($result as $r) {
				$data['value'] = $r->bomno;
				$data['label'] = $r->bomno;
				$json[] = $data;
			}
		}
		echo json_encode($json);
	}

	public function getbomdetails()
	{
		$selected_bom = $this->input->post('selected_bom');
		if ($selected_bom == '') {
			$html = '<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select BOM No</span></div>';
		} else {
			$result = "'" . implode("', '", $selected_bom) . "'";

			/*$count=count($selected_bom);
	for ($i=0; $i < $count; $i++) { 
	$data[]=$this->db->where('joborderno',$jobOrder[$i])->get('job_data_returnable')->result_array();//->where('balanceqty >',0)
	}*/
			$query = "SELECT SUM(qty) AS totQty,itemname,hsnno,uom,price FROM  `bom_reports` WHERE bomno IN (" . $result . ") GROUP BY hsnno";
			$queryRes = $this->db->query($query);
			$data = $queryRes->result_array();
			$discountBy = $this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
			if ($discountBy == 'percent_wise') {
				$discType = '%';
			} else {
				$discType = '';
			}

			$html = '
	<div class="table-responsive myform" >
	<table class="responsive table" width="100%">
	<thead> 
	<tr>
	<th>HSN Code</th>
	<th>Item Name</th>
	<th>Qty</th>
	<th>UOM</th>
	<th>Rate</th>
	<th>Amount</th>
	<th>Disc ' . $discType . '</th>
	<th>&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
	<th class="sgst">&nbsp;&nbsp;&nbsp;CGST</th>
	<th class="sgst">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
	<th class="sgst">&nbsp;&nbsp;&nbsp;SGST</th>
	<th class="sgst">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
	<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
	<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
	<th>Total</th>
	<th>&nbsp;</th>
	</tr>  
	</thead>
	<tbody>';
			$k = 0;
			foreach ($data as $rows) {
				//foreach ($datas as $rows) 
				//{
				//$amount = 
				$itemDet = $this->db->select('*')->where('hsnno', $rows['hsnno'])->where('itemname', $rows['itemname'])->get('additem')->row();
				$html .= '
	<tr>
	<td><input class="" id="hsnno' . $k . '" parsley-trigger="change"  readonly type="text" name="hsnno[]" value="' . $rows['hsnno'] . '" ><div id="hsnno_valid' . $k . '"></div><input type="hidden" name="priceType[]" id="priceType' . $k . '" value="' . $itemDet->priceType . '"/></td>

	<td><input class="itemname_class" data-id="' . $k . '" id="itemname' . $k . '" parsley-trigger="change" required  type="text" name="itemname[]" value="' . $rows['itemname'] . '" ><div id="itemname_valid' . $k . '"></div></td>

	<td><input class="qty_class decimals" id="qty' . $k . '" data-id="' . $k . '" parsley-trigger="change" required type="text" name="qty[]"  autocomplete="off" value=""><div id="qty_valid' . $k . '"></div><input type="hidden" name="bomqty[]" id="bomqty' . $k . '" value="' . $rows['totQty'] . '" ><div style="color:green;">BOM Qty : ' . $rows['totQty'] . '</div></td>  

	<td><input class="" id="uom' . $k . '" parsley-trigger="change"  readonly  type="text" name="uom[]"  autocomplete="off" value="' . $rows['uom'] . '"><div id="uom_valid' . $k . '"></div></td>

	<td><input class="rate_class decimals" data-id="' . $k . '" parsley-trigger="change"  id="rate' . $k . '" required type="text" name="rate[]"   autocomplete="off" value="' . $rows['price'] . '"><div id="rate_valid' . $k . '"></div></td>

	<td><input class="decimals" id="amount' . $k . '" parsley-trigger="change"  readonly type="text" name="amount[]" value=""  autocomplete="off"><div id="amount_valid' . $k . '"></div></td>

	<td><input class="discount_class decimals" id="discount' . $k . '" data-id="' . $k . '"  type="text" name="discount[]" maxlength="2" onkeypress="return isNumber(event)" value=""  autocomplete="off"><div id="discount_valid' . $k . '"></div></td>

	<td><input class="decimals" id="taxableamount' . $k . '" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount' . $k . '"><div id="taxableamount_valid' . $k . '"></div></td>

	<td class="sgst"><input class="decimals" readonly id="cgst' . $k . '"  type="text" name="cgst[]" onkeypress="return isNumberKey(event)" autocomplete="off" value="' . $itemDet->cgst . '"><div id="cgst_valid' . $k . '"></div></td>

	<td class="sgst"><input class="decimals" readonly id="cgstamount' . $k . '"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td class="sgst"><input class="decimals" id="sgst' . $k . '" readonly  type="text" name="sgst[]" value="' . $itemDet->sgst . '" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid' . $k . '"></div></td>

	<td class="sgst"><input class="decimals" id="sgstamount' . $k . '"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td class="igst" style="display:none;"><input class="decimals" id="igst' . $k . '"  type="text" name="igst[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" value="' . $itemDet->sgst . '"><div id="igst_valid' . $k . '"></div></td>

	<td class="igst" style="display:none;"><input class="decimals" id="igstamount' . $k . '"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td><input class="" id="total' . $k . '" type="text" name="total[]" value=""  readonly ></td>
	<td style="width:10px;">&nbsp;</td>
	';

				if ($k == 0) {
					$html .= '<td>&nbsp;</td>';
				} else {
					$html .= '<td><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td>';
				}
				$html .= '
	</tr>';
				$k++;
				//}
			}
			$html .= '
	</tbody>
	</table>

	<script>
	$(".remove").click(function(){
	$(this).parents("tr").remove();
	});
	</script>';

			$html .= '
	<script>
	$(".qty_class").keyup(function(){
	var id=$(this).attr(\'data-id\');
	if($(this).val()==\'\') { $(this).val("0"); }
	var qty=(isNaN($("#qty"+id).val())) ? 0 : $("#qty"+id).val();
	var bomqty=$("#bomqty"+id).val();
	if(parseFloat(qty) > parseFloat(bomqty))
	{
	alert("Invalid Qty");
	$(this).val("0");
	$(this).focus();
	}
	});
	</script>
	';
		}
		echo $html;
	}
	function getaddpurchasedetails()
	{
		$discountBy = $this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
		if ($discountBy == 'percent_wise') {
			$discType = '%';
		} else {
			$discType = '';
		}
		$html = '
	<div class="table-responsive myform directPurchaseDet" >
	<table class="table two">
	<thead> 
	<tr>
	<th style="width:70px">HSN Code</th>
	<th style="width:150px">Item Name <!--<a target="_blank" href="<?php echo base_url();?>itemmaster">(Add Item)</a>--></th>
	<th style="width:50px">Qty</th>
	<th style="width:50px">UOM</th>
	<th style="width:70px">Rate</th>
	<th style="width:100px">Amount</th>
	<th style="width:40px">Disc ' . $discType . '</th>
	<th style="width:100px">&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
	<th class="sgst" style="width:45px">&nbsp;&nbsp;&nbsp;CGST</th>
	<th class="sgst" style="width:80px">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
	<th class="sgst" style="width:45px">&nbsp;&nbsp;&nbsp;SGST</th>
	<th class="sgst" style="width:80px">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
	<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
	<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
	<th style="width:110px">Total</th>
	<th style="width:10px;">&nbsp;</th>
	</tr>   
	</thead>
	<tbody>
	<tr>
	<td><input class="" id="hsnno0" parsley-trigger="change"  readonly type="text" name="hsnno[]" value="" ><div id="hsnno_valid0"></div><input type="hidden" name="priceType[]" id="priceType0" /></td>

	<td><input class="itemname_class" data-id="0" id="itemname0" parsley-trigger="change" required  type="text" name="itemname[]" value="" ><div id="itemname_valid0"></div></td>

	<td><input class="qty_class decimals" id="qty0" data-id="0" parsley-trigger="change" required type="text" name="qty[]"  autocomplete="off" ><div id="qty_valid0"></div><input type="hidden" name="bomqty[]" value="0"></td>  

	<td><input class="" id="uom0" parsley-trigger="change"  readonly  type="text" name="uom[]"  autocomplete="off"><div id="uom_valid0"></div></td>

	<td><input class="rate_class decimals" data-id="0" parsley-trigger="change"  id="rate0" required type="text" name="rate[]"   autocomplete="off"><div id="rate_valid0"></div></td>

	<td><input class="decimals" id="amount0" parsley-trigger="change"  readonly type="text" name="amount[]" value=""  autocomplete="off"><div id="amount_valid0"></div></td>

	<td><input class="discount_class decimals" id="discount0" data-id="0"  type="text" name="discount[]" onkeypress="return isNumberKey_With_Dot(event)" value=""  autocomplete="off"><div id="discount_valid0"></div></td>

	<td><input class="decimals" id="taxableamount0" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount0"><div id="taxableamount_valid0"></div></td>

	<td class="sgst"><input class="decimals" readonly id="cgst0"  type="text" name="cgst[]" value="" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="cgst_valid0"></div></td>

	<td class="sgst"><input class="decimals" readonly id="cgstamount0"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td class="sgst"><input class="decimals" id="sgst0" readonly  type="text" name="sgst[]" value="" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid0"></div></td>

	<td class="sgst"><input class="decimals" id="sgstamount0"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td class="igst" style="display:none;"><input class="decimals" id="igst0"  type="text" name="igst[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid0"></div></td>

	<td class="igst" style="display:none;"><input class="decimals" id="igstamount0"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td><input class="" id="total0" type="text" name="total[]" value=""  readonly ></td>
	<td style="width:10px;"><div class="col-sm-offset-11">
<button type="button" class="btn btn-info add pull-right" style="margin-right: 10px;"><i class="fa fa-plus"></i></button>
<input type="hidden"  id="hide" value="1">
</div></td>

	</tr>
	</tbody>
	<tbody id="append"></tbody> 
	</table> 
	</div>


	';
		echo $html;
	}

	public function invoice()
	{
		$id = base64_decode($this->uri->segment(3));
		// $this->load->library('mpdf'); 
		$data['pre'] = $this->db->where('id', $id)->get('sup_purchaseorder_details')->result();

		foreach ($data['pre'] as $b) {
			$number = $b->grandtotal;
		}
		$no = round($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array(
			'0' => '',
			'1' => 'One',
			'2' => 'Two',
			'3' => 'Three',
			'4' => 'Four',
			'5' => 'Five',
			'6' => 'Six',
			'7' => 'Seven',
			'8' => 'Eight',
			'9' => 'Nine',
			'10' => 'Ten',
			'11' => 'Eleven',
			'12' => 'Twelve',
			'13' => 'Thirteen',
			'14' => 'Fourteen',
			'15' => 'Fifteen',
			'16' => 'Sixteen',
			'17' => 'Seventeen',
			'18' => 'Eighteen',
			'19' => 'Nineteen',
			'20' => 'Twenty',
			'30' => 'Thirty',
			'40' => 'Forty',
			'50' => 'Fifty',
			'60' => 'Sixty',
			'70' => 'Seventy',
			'80' => 'Eighty',
			'90' => 'Ninety'
		);
		$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
		while ($i < $digits_1) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += ($divider == 10) ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str[] = ($number < 21) ? $words[$number] .
					" " . $digits[$counter] . $plural . " " . $hundred
					:
					$words[floor($number / 10) * 10]
					. " " . $words[$number % 10] . " "
					. @$digits[$counter] . $plural . " " . $hundred;
			} else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$data['fin'] = $result;
		$data['profile'] = $this->db->get('profile')->result();
		$data['invoice'] = $this->db->where('id', $id)->get('sup_purchaseorder_details')->result();
		$this->load->view('supplierpurchaseOrder_bill', $data);
		// $this->load->view('sup_purchaseOrder_bill', $data);
	}

	public function directPrint()
	{
		$data['pre'] = $this->db->order_by('id', 'desc')->limit(1)->get('sup_purchaseorder_details')->result();
		foreach ($data['pre'] as $b) {
			$number = $b->grandtotal;
		}
		$no = round($number);
		// $point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array(
			'0' => '',
			'1' => 'One',
			'2' => 'Two',
			'3' => 'Three',
			'4' => 'Four',
			'5' => 'Five',
			'6' => 'Six',
			'7' => 'Seven',
			'8' => 'Eight',
			'9' => 'Nine',
			'10' => 'Ten',
			'11' => 'Eleven',
			'12' => 'Twelve',
			'13' => 'Thirteen',
			'14' => 'Fourteen',
			'15' => 'Fifteen',
			'16' => 'Sixteen',
			'17' => 'Seventeen',
			'18' => 'Eighteen',
			'19' => 'Nineteen',
			'20' => 'Twenty',
			'30' => 'Thirty',
			'40' => 'Forty',
			'50' => 'Fifty',
			'60' => 'Sixty',
			'70' => 'Seventy',
			'80' => 'Eighty',
			'90' => 'Ninety'
		);
		$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
		while ($i < $digits_1) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += ($divider == 10) ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str[] = ($number < 21) ? $words[$number] .
					" " . $digits[$counter] . $plural . " " . $hundred
					:
					$words[floor($number / 10) * 10]
					. " " . $words[$number % 10] . " "
					. @$digits[$counter] . $plural . " " . $hundred;
			} else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$data['fin'] = $result;
		$data['profile'] = $this->db->get('profile')->result();
		$data['invoice'] = $data['pre'];

		$this->load->view('sup_purchaseOrder_bill', $data);
		//$this->load->view('invoicebill',$data);
		// $this->load->view('invoice_bill',$data);


	}


	public function getworkorderno()
	{
		$customerid = $this->input->post('customerid');

		$this->db->select('DISTINCT(purchaseorderno), purchaseorder');
		$this->db->from('purchaseorder_reports');
		$this->db->where('customerId', $customerid);
		$this->db->where('workorderbalance >', 0);
		$this->db->where('oa_status', 2);
		$query = $this->db->get();
		$result = $query->result();

		echo json_encode($result);
	}

	public function getworkordernoformtc()
	{
		$customerid = $this->input->post('customerid');

		$this->db->select('DISTINCT(purchaseorderno), purchaseorder');
		$this->db->from('purchaseorder_reports');
		$this->db->where('customerId', $customerid);
		$query = $this->db->get();
		$result = $query->result();

		echo json_encode($result);
	}



	public function getworkorder()
	{
		$workorder = $this->input->post('workorder');
		if ($workorder) {
			$data['workorder'] = $workorder;
			$data['grade'] = $this->db->where('status', 1)->get('grade')->result();
			$this->load->view('againstworkorder', $data);
		} else {
			$html = '<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select Workorder No</span></div>';
			echo $html;
		}
	}


	public function ajax_pending_list()
	{
		$list = $this->Sup_purchaseorder_pending_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i = 1;
		foreach ($list as $person) {

			$getgrade = $this->db->where('id', $person->grade)->get('grade')->row();

			$no++;
			$row = array();
			$row[] = $i++;
			$row[] = date('d-m-Y', strtotime($person->purchasedate));
			$row[] = $person->customername;
			$row[] = $person->purchaseorderno;
			$row[] = $person->suppliername;
			$row[] = $person->itemname;
			$row[] = $getgrade->grade;
			$row[] = $person->qty;
			$row[] = $person->balaceqty;

			if ($person->balaceqty > 0) {
				$row[] = '<button class="btn btn-warning btn-custom btn-rounded">Pending</button>';
			} else {
				$row[] = '<button class="btn btn-success btn-custom btn-rounded">Delivery</button>';
			}

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Sup_purchaseorder_pending_model->count_all(),
			"recordsFiltered" => $this->Sup_purchaseorder_pending_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
}


ob_flush();

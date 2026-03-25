 <?php if (! defined('BASEPATH')) exit('No direct script access allowed');
	ob_start();
	error_reporting(0);
	class Invoice extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			date_default_timezone_set('Asia/Kolkata');
			$this->load->model('invoice_model');
			if ($this->session->userdata('rcbio_login') == '') {
				$this->session->set_flashdata('msg', 'Please Login to continue!');
				redirect('login');
			}
		}
		public function index()
		{
			$query_update1 = $this->db->where('status', 1)->order_by('id', 'desc')->limit(1)->get('invoice_details')->result_array();
			foreach ($query_update1 as $row) {
				$quotationnos = $row['invoiceno'];
				$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->invoicePrefix;
				@$quotationnos = str_replace($new_bond_prefix, '', $quotationnos);
			}

			if (date('m') == '04') {
				$month = date('m');
				$year = date('Y');
				$old = $this->db->where('month(date)', $month)->where('year(date) ', $year)->get('invoice_details')->result_array();
				if ($old) {
					@$bond_no = $quotationnos;
					if (is_null($bond_no)) {
						$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
						$new_bond_prefix = $default_bond->invoicePrefix;
						$new_bond_noo = $new_bond_prefix . $default_bond->invoice;
						//$new_bond_noo = '100001'; 
					} else {
						$default_bond = $this->db->where('id', 1)->where('invoice !=', '')->get('preference_settings')->row();
						if ($default_bond) {
							$bond_no = $default_bond->invoice;
							$bondLen = strlen($bond_no);
							$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
							$new_bond_prefix = $default_bond->invoicePrefix;
							$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
						} else {
							$bondLen = strlen($bond_no);
							$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
							$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
							$new_bond_prefix = $default_bond->invoicePrefix;
							$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (float)$bondOnlyNum + 1);
						}
					}
				} else {
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->invoicePrefix;
					$new_bond_noo = $new_bond_prefix . $default_bond->invoice;
					//$new_bond_noo = '100001';
				}
			} else {
				@$bond_no = $quotationnos;
				if (is_null($bond_no)) {
					$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->invoicePrefix;
					$new_bond_noo = $new_bond_prefix . $default_bond->invoice;
					//$new_bond_noo = '100001'; 
				} else {
					$default_bond = $this->db->where('id', 1)->where('invoice !=', '')->get('preference_settings')->row();
					if ($default_bond) {
						@$bond_no = $default_bond->invoice;
						$new_bond_prefix = $default_bond->invoicePrefix;
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', $bondOnlyNum);
					} else {
						$bondLen = strlen($bond_no);
						$default_bond = $this->db->where('id', 1)->get('preference_settings')->row();
						$new_bond_prefix = $default_bond->invoicePrefix;
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_noo = $new_bond_prefix . sprintf('%0' . $bondLen . 'd', (int)$bondOnlyNum + 1);
					}
				}
			}
			$data['invoiceno'] = $new_bond_noo;

			$this->load->view('header');
			$this->load->view('invoice1', $data);
			$this->load->view('footer');
		}

		public function insert()
		{

 			// print_r($this->input->post('orderno'));die;
			$grandtotal = $_POST['grandtotal'];
			$customerid = $_POST['customerid'];
			$data1 = $this->db->where('id', $customerid)->get('customer_details')->result_array();

			foreach ($data1 as $a) {
				$openingbalance = $a['openingbal'];
				$balance = $a['balanceamount'];
				$salesamounts = $a['salesamount'];
				$paidamounts = $a['paidamount'];
			}
			if ($balance) {
				$balanceamount = $balance + $grandtotal;
			} else {
				$balanceamount = ($openingbalance + $grandtotal) - $paidamounts;
			}
			if ($salesamounts == '') {
				$salesamount = $grandtotal;
			} else {
				$salesamount = $salesamounts + $grandtotal;
			}

			$datass = array('salesamount' => $salesamount, 'balanceamount' => $balanceamount);
			$this->db->where('id', $customerid)->update('customer_details', $datass);

			$insertid = $this->input->post('insertid');
			// @$deliveryid=implode('||',$_POST['id']);

			@$deliveryid = is_array($_POST['id'] ?? null) ? implode('||', $_POST['id']) : ($_POST['id'] ?? '');

			$invoicetype = $this->input->post('invoicetype');
			$bill_type = $this->input->post('bill_type');
			// @$dcno=implode('||',$_POST['dcno']);
			// @$dcnos=implode('||',$_POST['dcnos']);

			@$dcno = is_array($_POST['dcno'] ?? null) ? implode('||', $_POST['dcno']) : ($_POST['dcno'] ?? '');


			@$dcnos = is_array($_POST['dcnos'] ?? null) ? implode('||', $_POST['dcnos']) : ($_POST['dcnos'] ?? '');

			// @$pono=implode('||',$_POST['pono']);

			@$pono = is_array($_POST['pono'] ?? null) ? implode('||', $_POST['pono']) : ($_POST['pono'] ?? '');
			@$purchaseordernos = is_array($_POST['purchaseorderno'] ?? null) ? implode('||', $_POST['purchaseorderno']) : ($_POST['purchaseorderno'] ?? '');
			@$purchaseorder = is_array($_POST['purchaseorder'] ?? null) ? implode('||', $_POST['purchaseorder']) : ($_POST['purchaseorder'] ?? '');

			@$workorderid = is_array($_POST['workorderid'] ?? null) ? implode('||', $_POST['workorderid']) : ($_POST['workorderid'] ?? '');

			// @$purchaseordernos=implode('||',$_POST['purchaseordernos']);
			$hsnno = implode('||', $_POST['hsnno']);
			@$itemcode = implode('||', $_POST['itemcode']);
			@$itemid = implode('||', $_POST['itemid']);

			$itemname = implode('||', $_POST['itemname']);
			$item_desc = implode('||', $_POST['item_desc']);
			$qty = implode('||', $_POST['qty']);
			$weight = implode('||', $_POST['weight']);
			$uom = implode('||', $_POST['uom']);
			$grade = implode('||', $_POST['grade']);
			$rate = implode('||', $_POST['rate']);
			$amount = implode('||', $_POST['amount']);
			@$discount = implode('||', $_POST['discount']);
			@$discountamount = is_array($_POST['discountamount'] ?? null) ? implode('||', $_POST['discountamount']) : ($_POST['discountamount'] ?? '');

			// @$discountamount = implode('||', $_POST['discountamount']);
			@$taxableamount = implode('||', $_POST['taxableamount']);
			// @$total=implode('||',$_POST['total']);

			@$total = is_array($_POST['total'] ?? null) ? implode('||', $_POST['total']) : ($_POST['total'] ?? '');

			$subtotal = $this->input->post('subtotal');
			$totalqty = $this->input->post('totalqty');

			$sales_bill_type = $this->db->select('bill_type')->where('id', '1')->get('preference_settings')->row()->bill_type;
			if ($sales_bill_type == 'Overall Tax') {
				$sgst = $this->input->post('sgst');
				$sgstamount = $this->input->post('sgstamount');
				$cgst = $this->input->post('cgst');
				$cgstamount = $this->input->post('cgstamount');
				$igst = $this->input->post('igst');
				$igstamount = $this->input->post('igstamount');
			} else {
				$cgst = implode('||', $_POST['cgst']);
				$cgstamount = implode('||', $_POST['cgstamount']);
				$sgst = implode('||', $_POST['sgst']);
				$sgstamount = implode('||', $_POST['sgstamount']);
				$igst = implode('||', $_POST['igst']);
				$igstamount = implode('||', $_POST['igstamount']);
			}
			@$freightamount = $this->input->post('freightamount');
			@$freightcgst = $this->input->post('freightcgst');
			@$freightcgstamount = $this->input->post('freightcgstamount');
			@$freightsgst = $this->input->post('freightsgst');
			@$freightsgstamount = $this->input->post('freightsgstamount');
			@$freightigst = $this->input->post('freightigst');
			@$freightigstamount = $this->input->post('freightigstamount');
			@$freighttotal = $this->input->post('freighttotal');
			@$loadingamount = $this->input->post('loadingamount');
			@$loadingcgst = $this->input->post('loadingcgst');
			@$loadingcgstamount = $this->input->post('loadingcgstamount');
			@$loadingsgst = $this->input->post('loadingsgst');
			@$loadingsgstamount = $this->input->post('loadingsgstamount');
			@$loadingigst = $this->input->post('loadingigst');
			@$loadingigstamount = $this->input->post('loadingigstamount');
			@$loadingtotal = $this->input->post('loadingtotal');
			$roundOff = $this->input->post('roundOff');
			$othercharges = $this->input->post('othercharges');
			$hiddenDiscountBy = $this->input->post('hiddenDiscountBy');
			$grandtotal = $this->input->post('grandtotal');

			$invoicenoyear = $_POST['invoiceno'] . '' . date('-Y') . '';
			$invoicenodate = $_POST['invoiceno'] . '' . date('dmy') . '';

			$pcode = $_POST['hsnno'];
			$count7 = count($pcode);
			for ($i = 0; $i < $count7; $i++) {
				$res[] = "0";
				$ret[] = "1";
			}



			$billtype = $_POST['gsttype'];
			if ($billtype == 'intrastate') {
				/*$sgst = $_POST['sgst'];
$cgst = $_POST['cgst'];
//$igst = implode('||',$res);
$igst = $_POST['igst'];
$sgstamount = $_POST['sgstamount'];
$cgstamount = $_POST['cgstamount'];
$igstamount = $_POST['igstamount'];*/
				//$igstamount = implode('||',$res);
				$sgsts = 'sgst';
				$cgsts = 'cgst';
				$igsts = '';
			}

			if ($billtype == 'interstate') {
				/*$sgst = $_POST['sgst'];
$cgst = $_POST['cgst'];
$igst = $_POST['igst'];
$sgstamount = $_POST['sgstamount'];
$cgstamount = $_POST['cgstamount'];
$igstamount = $_POST['igstamount'];*/
				$igsts = 'igst';
				$sgsts = '';
				$cgsts = '';
			}

			$data = array(
				'date' => date('Y-m-d'),
				'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
				'orderdate' => date('Y-m-d', strtotime($_POST['orderdate'])),
				'invoicetype' => $invoicetype,
				'bill_type' => $bill_type,
				'dcno' => $dcno,
				'pono' => $pono,
				'invoiceno' => $_POST['invoiceno'],
				'insertid' => $insertid,
				'customerId' => $customerid,
				'customername' => $_POST['customername'],
				'address' => $_POST['address'],
				'orderno' => $_POST['orderno'] ?? '',
				'billtype' => $_POST['gsttype'],
				'gsttype' => $_POST['gsttype'],
				'deliveryat' => @$_POST['deliveryat'],
				'vehicleno' => $_POST['vehicleno'],
				'transportmode' => @$_POST['transportmode'],
				'removalDate' => date('Y-m-d', strtotime($_POST['removalDate'])),
				'time' => $_POST['time'],
				'shipTo' => $_POST['shipTo'],
				'shipToId' => $_POST['shipToId'],
				'shipToAddress' => $_POST['shipToAddress'],
				'mobileNo' => @$_POST['mobileNo'],
				'typesgst' => $sgsts,
				'typecgst' => $cgsts,
				'typeigst' => $igsts,
				'hsnno' => $hsnno,

				'itemid' => $itemid,
				'itemcode' => $itemcode,
				'dcnos' => $dcnos,
				'purchaseordernos' => $purchaseordernos,
				'purchaseorder' => $purchaseorder,
				'deliveryid' => $deliveryid,
				'workorderid' => $workorderid ?? '',
				'itemname' => $itemname,
				'item_desc' => $item_desc,
				'uom' => $uom,
				'grade' => $grade,
				'rate' => $rate,
				'qty' => $qty,
				'weight' => $weight,
				'amount' => $amount,
				'totalqty' => $totalqty,
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
				//'othercharges' =>$othercharges,
				'discountBy' => $hiddenDiscountBy,
				'return_status' => implode('||', $ret),
				'grandtotal' => $grandtotal,
				'invoicenodate' => $invoicenodate,
				'invoicenoyear' => $invoicenoyear,
				'status' => 1,
				'einvoice_status' => 0,
				'eway_status' => 0,
				'balance' => $grandtotal,
				'vou_status' => 1,
				'edit_status' => 1
			);
			// echo "<pre>";
			// print_r($data);die;
			$result = $this->db->insert('invoice_details', $data);
			// print_r($data);exit;
			if ($result == true) {
				$invoiceid = $this->db->insert_id();
				$this->db->query("UPDATE preference_settings SET invoice='' WHERE id=1");

				// foreach ($purchaseordernos as $po) {
				// 	$this->db->where('purchaseorderno', trim($po))
				// 			->update('purchaseorder_details', ['invoice_status' => 2]);
				// }

				$sparename = $_POST['itemname'];
				$item_desca = $_POST['item_desc'];
				$qty = $_POST['qty'];
				$weight = $_POST['weight'];
				$hsnnos = $_POST['hsnno'];
				$itemids = $_POST['itemid'];
				$grades = $_POST['grade'];
				$heatnos = $_POST['heatno'];

				$sgsts = $_POST['sgst'];
				$cgsts = $_POST['cgst'];
				$igsts = $_POST['igst'];
				$count = count($sparename);
				for ($i = 0; $i < $count; $i++) {

					$data = $this->db->where('itemname', $sparename[$i])
						->where('hsnno', $hsnnos[$i])
						->get('stock')->row();

					if ($data) {

						$bal = $data->balance;  // current stock
						$usedQty = $qty[$i];    // qty used

						// Prevent negative
						$newBal = $bal - $usedQty;
						if ($newBal < 0) {
							$newBal = 0;   // OR return error message
						}

						// Update stock
						$this->db->where('itemname', $sparename[$i])
							->where('hsnno', $hsnnos[$i])
							->update('stock', [
								'date' => date('Y-m-d'),
								'balance' => $newBal
							]);
					}
				}


				$itemnames = $_POST['itemname'];
				$qtys = $_POST['qty'];
				$weights = $_POST['weight'];
				$hsnnoss = $_POST['hsnno'];
				$itemcodes = $_POST['itemcode'];
				$itemids = $_POST['itemid'];
				$grades = $_POST['grade'];

				$workorderid = $_POST['workorderid'] ?? '';
				$totals = $_POST['total'] ?? '';

				$count = count($sparename);
				for ($j = 0; $j <  $count; $j++) {
					$podatass = array(
						'date' => date('Y-m-d'),
						'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
						'orderdate' => date('Y-m-d', strtotime($_POST['orderdate'])),
						'invoiceno' => $_POST['invoiceno'],
						'customerId' => $customerid,
						'customername' => $_POST['customername'],
						'address' => $_POST['address'],
						'orderno' => $_POST['orderno'] ?? '',
						'purchaseordernos' => $purchaseordernos,
						'purchaseorder' => $purchaseorder,
						'billtype' => $_POST['gsttype'],
						'gsttype' => $_POST['gsttype'],
						'deliveryat' => $_POST['deliveryat'] ?? '',
						'vehicleno' => $_POST['vehicleno'],
						'itemname' => $sparename[$j],
						'itemid' => $itemids[$j],
						'item_desc' => $item_desca[$j],
						'rate' => $rate[$j],
						'qty' => $qtys[$j],
						'weight' => $weights[$j],
						'total' => $totals[$j] ?? '',
						'hsnno' => $hsnnoss[$j],
						'heatno' => $heatnos[$j] ?? '',
						'grade' => $grades[$j],
						'itemcode' => $itemcodes[$j],
						'address' => $_POST['address'],
						'subtotal' => $_POST['subtotal'],
						'grandtotal' => $_POST['grandtotal'],
						'invoicenodate' => $invoicenodate,
						'invoicenoyear' => $invoicenoyear,
						'invoiceid' => $invoiceid,
						'workorderid' => $workorderid[$j] ?? '',
						'status' => 1
					);
					$this->db->insert('invoice_reports', $podatass);
				}

				@$receiptno = '-';
				@$paymentdetails = '-';
				@$paymentmodes = '-';
				@$throughchecks = '-';
				@$banktransfers = '-';
				@$chamounts = '-';
				@$bankamounts = '-';
				@$chequeno = '-';
				@$receiptamt = '-';
				@$receiptid = '-';

				$dd = array(
					'date' => date('Y-m-d', strtotime($_POST['invoicedate'])),
					'receiptdate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
					'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
					'invoiceno' => $_POST['invoiceno'],
					'payment' => $paymentdetails,
					'customerId' => $customerid,
					'customername' => $_POST['customername'],
					'paymentmode' => $paymentmodes,
					'throughcheck' => $throughchecks,
					'banktransfer' => $banktransfers,
					'chamount' => $chamounts,
					'bankamount' => $bankamounts,
					'chequeno' => $chequeno,
					'itemname' => $itemname,
					'item_desc' => $item_desc,
					'paymentdetails' => $paymentdetails,
					'overallamount' => $_POST['grandtotal'],
					'receiptamt' => '-',
					'receiptno' => $receiptid,
					// 'qty'=>$qty,
					'paid' => $paymentdetails,
					'totalamount' => $_POST['grandtotal'],
					'invoiceamt' => $_POST['grandtotal'],
					'invoicenoyear' => $invoicenoyear,
					'invoicenodate' => $invoicenodate,
					'balance' => $balanceamount,
					'invoiceid' => $invoiceid,
					'status' => 1
				);
				$this->db->insert('invoice_party_statement', $dd);



				$invoicetype = $this->input->post('invoicetype');
				if ($invoicetype == 'Against DC') {
					$insertid = $this->input->post('insertid');
					$itemname = $this->input->post('itemname');
					$qty = $this->input->post('qty');
					$balanceqty = $this->input->post('balanceqty');
					$id = $this->input->post('dc_id');
					$count = count($itemname);

					for ($j = 0; $j < $count; $j++) {
						$balanceQtys = $balanceqty[$j] - $qty[$j];

						if ($balanceQtys == 0) {
							$status = 0;
						} else {
							$status = 1;
						}
						$datas = array('balanceqty' => $balanceQtys, 'status' => $status);
						$this->db->where('id', $id[$j]);
						$this->db->update('dc_delivery', $datas);
					}
				} else if ($invoicetype == 'Against PO') {
					$insertid = $this->input->post('insertid');
					$itemname = $this->input->post('itemname');
					$ponos = $this->input->post('pono');
					$qty = $this->input->post('qty');
					$balanceqty = $this->input->post('balanceqty');

					$id = $this->input->post('workorderid');
					$counts = count((array)$itemname);

					$count = count((array)$ponos);
					for ($i = 0; $i < $count; $i++) {

						$datas = array('invoice_status' => 2);
						$this->db->where('purchaseorderno', $ponos[$i]);
						$this->db->update('purchaseorder_details', $datas);
					}
					for ($j = 0; $j < $counts; $j++) {
						$balanceQtys = $balanceqty[$j] - $qty[$j];

						if ($balanceQtys == 0) {
							$status = 0;
						} else {
							$status = 1;
						}


						$datass = array('balaceqty' => $balanceQtys, 'status' => $status);
						$this->db->where('id', $id[$j]);
						$this->db->update('purchaseorder_reports', $datass);
					}
				}
				// else if ($invoicetype == 'Direct Invoice') {
				// 	$insertid = $this->input->post('insertid');
				// 	$itemname = $this->input->post('itemname');
				// 	$pono = $this->input->post('orderno');
				// 	$qty = $this->input->post('qty');
				// 	$balanceqty = $this->input->post('balanceqty');


				// 	$id = $this->input->post('id');
				// 	$counts = count($itemname);

				// 	$count = count($pono);
				// 	for ($i = 0; $i < $count; $i++) {

				// 		$datas = array('edit_status' => 0);
				// 		$this->db->where('purchaseorderno', $pono[$i]);
				// 		$this->db->update('purchaseorder_details', $datas);
				// 	}
				// 	for ($j = 0; $j < $counts; $j++) {
				// 		$balanceQtys = $balanceqty[$j] - $qty[$j];

				// 		if ($balanceQtys == 0) {
				// 			$status = 0;
				// 		} else {
				// 			$status = 1;
				// 		}


				// 		$datass = array('balaceqty' => $balanceQtys, 'status' => $status);
				// 		$this->db->where('id', $id[$j]);
				// 		$this->db->update('purchaseorder_reports', $datass);
				// 	}
				// }

				$this->session->set_flashdata('msg', 'Invoice Added Successfully');
				if ($_POST['print'] == 'print') {
					redirect('invoice/bill');
				}
				if ($_POST['save'] == 'save') {
					redirect('invoice');
				}
			} else {
				$this->session->set_flashdata('msg1', 'Invoice Added Unsuccessfully');
				redirect('invoice');
			}
		}

		public function view()
		{

			$data['invoice'] = $this->invoice_model->select();
			$data['vat'] = $this->db->get('vat_details')->result_array();
			$payMethod = $this->db->select('voucher_receivable')->where('id', 1)->get('preference_settings')->row()->voucher_receivable;
			if ($payMethod == 'Without Invoice') {

				$this->load->view('header');
				$this->load->view('invoice_view', $data);
				$this->load->view('footer1');
			} else {
				$this->load->view('header');
				$this->load->view('invoiceview_aganistinvoice', $data);
				$this->load->view('footer1');
			}
		}

		public function views()
		{

			$id = base64_decode($this->uri->segment(3));
			$data['result'] = $this->db->where('id', $id)->get('invoice_details')->result_array();
			$this->load->view('header');
			$sales_bill_type = $this->db->select('bill_type')->where('id', '1')->get('preference_settings')->row()->bill_type;

			if ($sales_bill_type == 'Overall Tax') {

				$this->load->view('view_invoice', $data);
			} elseif ($sales_bill_type == 'Multiple Tax') {

				$this->load->view('multipletax_view12', $data);
				$this->load->view('footer');
			}
		}


		public function ajax_list()
		{
			$list = $this->invoice_model->get_datatables();
			$data = array();
			$no = $_POST['start'];
			$i = 1;
			foreach ($list as $person) {

				@$gstin = $this->db->select('gstno')->where('name', $person->customername)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->gstno;

				@$phoneno = $this->db->select('phoneno')->where('name', $person->customername)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->phoneno;


				$preference = $this->db->where('status', 1)->get('preference_settings')->row();
				$startTimeStamp = strtotime($person->invoicedate);
				$endTimeStamp = strtotime(date('Y-m-d'));
				$timeDiff = abs($endTimeStamp - $startTimeStamp);
				$numberDays = $timeDiff / 86400;  // 86400 seconds in one day
				$numberDays = intval($numberDays);

				$no++;
				$row = array();
				$code = base64_encode($person->id);
				$row[] = $i++;
				$row[] = date('d-m-Y', strtotime($person->invoicedate));
				$row[] = $person->invoiceno;
				$row[] = $person->invoicetype;
				$row[] = $person->customername;
				$row[] = $gstin;
				$row[] = $numberDays . ' Days';
				$row[] = $person->grandtotal;


				if ($preference->einvoice == 1) {
					if ($person->einvoice_status == 0) {
						$row[] = '<a href="' . base_url('invoice/einvoice/' . $code) . '"><button class="btn btn-primary "  >e-Invoice</button></a>';
					} else {
						$row[] = '<a href="' . base_url('invoice/rebill/' . $code) . '"><button class="btn" style="background-color:#2477c9;color:white; "   >Print</button></a>';
					}
				}


				if ($preference->eway == 1) {
					if ($person->eway_status == 0) {
						$row[] = '<a href="' . base_url('invoice/eway/' . $code) . '"><button class="btn btn-primary "  >e-way</button></a>';
					} else {
						$row[] = '<a href="' . base_url('invoice/rebill/' . $code) . '"><button class="btn" style="background-color:#2477c9;color:white; "   >Print</button></a>';
					}
				}

				$return_status = explode("||", $person->return_status);



				if (in_array(0, $return_status)) {
					$deleteOptn = '<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:alert(\'Sorry! You cannot able to delete!\');" title="Hapus" >Delete</a>';
				} else {
					$deleteOptn = '<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person(' . "'" . $code . "'" . ')">Delete</a>';
				}
				if ($person->edit_status == '0') {

					$row[] = '
						<div class="btn-group">
						<button type="button" class="btn
						btn-info dropdown-toggle waves-effect waves-light"
						data-toggle="dropdown" aria-expanded="false">Manage <span
						class="caret"></span></button>
						<ul class="dropdown-menu"
						role="menu" style="background: #23BDCF none repeat scroll
						0% 0%;width:14px;min-width: 100%;">

						<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('invoice/views/' . $code) . '" title="Hapus" >View</a></li>
						<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('invoice/edit/' . $code) . '" title="Hapus" >Edit</a></li>
						<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="' . base_url('invoice/rebill/' . $code) . '" title="Hapus" >Print</a></li>
						<li>' . $deleteOptn . '</li>

						</ul>
						</div>';
				} else {

					$row[] = '
						<div class="btn-group">
						<button type="button" class="btn
						btn-info dropdown-toggle waves-effect waves-light"
						data-toggle="dropdown" aria-expanded="false">Manage <span
						class="caret"></span></button>
						<ul class="dropdown-menu"
						role="menu" style="background: #23BDCF none repeat scroll
						0% 0%;width:14px;min-width: 100%;">

						<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('invoice/views/' . $code) . '" title="Hapus" >View</a></li>
						<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('invoice/edit/' . $code) . '" title="Hapus" >Edit</a></li>

						<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="' . base_url('invoice/rebill/' . $code) . '" title="Hapus" >Print</a></li>
						<li>' . $deleteOptn . '</li>

						</ul>
						</div>';
				}
				//add html for action
				if ($person->balance == 0) {
					$row[] = '<button type="button" class="btn btn-success btn-rounded">Paid</button>';
				} elseif ($person->balance > 0) {
					$row[] = '<button type="button" class="btn btn-warning btn-rounded">Pending</button>';
				}
				// <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('invoice/edit/'.$code).'" title="Edit" >Edit</a></li>

				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->invoice_model->count_all(),
				"recordsFiltered" => $this->invoice_model->count_filtered(),
				"data" => $data,
			);
			//output to json format
			echo json_encode($output);
		}

		public function ajax_delete($id)
		{
			$this->invoice_model->delete_by_id($id);
			echo json_encode(array("status" => TRUE));
		}

		// public function autocomplete_customername()
		// {
		// 	$orderno = $this->input->post('keyword');

		// 	$this->db->select("
		// 		customer_details.*, 
		// 		GROUP_CONCAT(purchaseorder_reports.purchaseorder) AS purchaseorders,
		// 		GROUP_CONCAT(purchaseorder_reports.purchaseorderno) AS purchaseordernos
		// 	");
		// 	$this->db->from('customer_details');
		// 	$this->db->join('purchaseorder_reports', 'purchaseorder_reports.customerId = customer_details.id', 'left');
		// 	$this->db->where('purchaseorder_reports.balaceqty >', 0);
		// 	$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')");
		// 	$this->db->like('name', $orderno);
		// 	$this->db->group_by('customer_details.id');

		// 	$query = $this->db->get()->result();

		// 	$name = array();
		// 	foreach ($query as $d) {
		// 		$json_array = array();
		// 		$json_array['label']    = $d->name;
		// 		$json_array['value']    = $d->name;
		// 		$json_array['address']  = $d->address1 . ', ' . $d->address2 . ', ' . $d->city . ', ' . $d->state;
		// 		$json_array['customerid'] = $d->id;
		// 		$json_array['gstno']    = $d->gstno;
		// 		$json_array['type']     = $d->type;
		// 		$json_array['purchaseorders'] = $d->purchaseorders;
		// 		$json_array['purchaseordernos'] = $d->purchaseordernos;
		// 		$name[] = $json_array;
		// 	}

		// 	echo json_encode($name);
		// }


		public function autocomplete_customername()
		{
			$orderno = $this->input->post('keyword');
			$this->db->select('*');
			$this->db->from('customer_details');
			$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')");
			$this->db->like('name', $orderno);
			$query = $this->db->get();
			$result = $query->result();
			$name       =  array();
			foreach ($result as $d) {
				$json_array             = array();
				$json_array['label']    = $d->name;
				$json_array['value']    = $d->name;
				$json_array['address']    = $d->address1 . ', ' . $d->address2 . ', ' . $d->city . ', ' . $d->state;
				$json_array['customerid'] = $d->id;
				$json_array['gstno']    = $d->gstno;
				$json_array['type']    = $d->type;
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
				// $grade = $this->db->select('grade')->where('id', $h->grade)->get('grade')->row()->grade;
				$vob['hsnno'] = $h->hsnno ?? '';
				$vob['itemcode'] = $h->itemcode;
				$vob['price'] = $h->price;
				$vob['priceType'] = $h->priceType;
				$vob['sgst'] = $h->sgst;
				$vob['cgst'] = $h->cgst;
				$vob['igst'] = $h->igst;
				$vob['uom'] = $uom;
				$vob['weight'] = $h->casting_weight;
				// $vob['grade'] = $grade;
				$vob['itemid'] = $h->id;

				$checkInvoiceType = $this->db->select('invoiceBy')->where('id', 1)->get('preference_settings')->row()->invoiceBy;
				if ($checkInvoiceType == 'without_stock') {
					$vob['balance'] = 0;
				} else {
					$this->db->select('*');
					$this->db->from('stock');
					$this->db->where('itemname', $itemcode);
					$query2 = $this->db->get();
					$result = $query2->row();
					$vob['balance'] = @$result->balance;
				}
			}
			echo json_encode($vob);
		}

		public function get_itemcodes()
		{
			$itemcode = $this->input->post('name');
			$this->db->select('*');
			$this->db->from('additem');
			$this->db->where('itemcode', $itemcode);
			$query = $this->db->get();
			$result = $query->result();
			foreach ($result as $h) {


				$uom = $this->db->select('uom')->where('id', $h->uom)->get('uom')->row()->uom;
				$vob['hsnno'] = $h->hsnno ?? '';
				$vob['itemname'] = $h->itemname;
				$vob['id'] = $h->id;
				$vob['price'] = $h->price;
				$vob['priceType'] = $h->priceType;
				$vob['sgst'] = $h->sgst;
				$vob['cgst'] = $h->cgst;
				$vob['igst'] = $h->igst;
				$vob['uom'] = $uom;
				$vob['weight'] = $h->casting_weight;

				$checkInvoiceType = $this->db->select('invoiceBy')->where('id', 1)->get('preference_settings')->row()->invoiceBy;
				if ($checkInvoiceType == 'without_stock') {
					$vob['balance'] = 0;
				} else {
					$this->db->select('*');
					$this->db->from('stock');
					$this->db->where('itemcode', $itemcode);
					$query2 = $this->db->get();
					$result = $query2->row();
					$vob['balance'] = $result->balance;
				}
			}
			echo json_encode($vob);
		}

		public function autocomplete_itemcode()
		{
			$orderno = $this->input->post('keyword');
			$this->db->select('*');
			$this->db->from('additem');
			$this->db->like('itemcode', $orderno);
			$query = $this->db->get();
			$result = $query->result();
			$name       =  array();
			foreach ($result as $d) {
				$json_array             = array();
				$json_array['label']    = $d->itemcode;
				$json_array['value']    = $d->itemcode;
				$json_array['price']    = $d->price;
				$json_array['sgst']    = $d->sgst;
				$json_array['cgst']    = $d->cgst;
				$json_array['igst']    = $d->igst;


				// $json_array['advanceamount'] = $d->voucheramount;
				$name[]             = $json_array;
			}
			echo json_encode($name);
		}

		public function get_hsnnos()
		{
			$grade = $this->input->post('grade');
			$gethsn = $this->db->where('id', $grade)->get('grade')->row();
			echo json_encode($gethsn);
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
				$json_array['price']    = $d->price;
				$json_array['sgst']    = $d->sgst;
				$json_array['cgst']    = $d->cgst;
				$json_array['igst']    = $d->igst;


				// $json_array['advanceamount'] = $d->voucheramount;
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
				// $json_array['advanceamount'] = $d->voucheramount;
				$name[]             = $json_array;
			}
			echo json_encode($name);
		}


		public function autocomplete_heatno()
		{
			$orderno = $this->input->post('keyword');
			$this->db->select('*');
			$this->db->from('stock');
			$this->db->like('heatno', $orderno);
			$query = $this->db->get();
			$result = $query->result();
			$name       =  array();
			foreach ($result as $d) {
				$json_array             = array();
				$json_array['label']    = $d->heatno;
				$json_array['value']    = $d->heatno;
				$json_array['balance']    = $d->balance;
				$name[]             = $json_array;
			}
			echo json_encode($name);
		}

		public function get_heatno_purchase()
		{
			$pos = $this->input->post('pos');
			$itemcode = $this->input->post('itemcode');
			$itemid = $this->input->post('itemid');



			$this->db->select('*');
			$this->db->from('purchase_reports');
			$this->db->where('purchaseorder', $pos);
			$this->db->where('itemid', $itemid);
			$query = $this->db->get();
			$result = $query->result();

			$vob = array();

			foreach ($result as $h) {
				$vob[] = [
					'heatno' => $h->heatno,
					'qty' => $h->qty
				];
			}

			echo json_encode($vob);
		}



		public function get_heatno()
		{
			$heatno = $this->input->post('name');

			$this->db->select('*');
			$this->db->from('stock');
			$this->db->where('heatno', $heatno);
			$this->db->where('balance >', 0);
			$query = $this->db->get();
			$result = $query->result();

			$vob = array();
			foreach ($result as $h) {
				$vob['heatno'] = $h->heatno;
				$vob['balance'] = $h->balance;
			}
			echo json_encode($vob);
		}



		public function edit()
		{
			$id = base64_decode($this->uri->segment(3));
			$data['result'] = $this->db->where('id', $id)->get('invoice_details')->result_array();
			// echo '<pre>';
			// print_r($data);die;
			$this->load->view('header');

			$sales_bill_type = $this->db->select('bill_type')->where('id', '1')->get('preference_settings')->row()->bill_type;

			if ($sales_bill_type == 'Overall Tax') {

				$this->load->view('edit12', $data);
			} elseif ($sales_bill_type == 'Multiple Tax') {
				//$this->load->view('directinvoice_multipletax',$data);
				$this->load->view('edit_multipletax12', $data);
				$this->load->view('footer');
			}
		}

		public function autocomplete_invoiceno()
		{
			$name = $this->input->post('keyword');
			$this->db->select('*');
			$this->db->from('purchase_details');
			$this->db->like('purchaseno', $name);
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

			//  echo '<pre>';
			// print_r($_POST);die;
			$id = $this->input->post('id');
			$getpurchase = $this->db->where('id', $id)->get('invoice_details')->result();
			foreach ($getpurchase as $getp)
				$grandtotals = $getp->grandtotal;

			$ite = explode('||', $getp->itemname);
			$qtyss = explode('||', $getp->qty);
			$hsnnos = explode('||', $getp->hsnno);
			$itemcodes = explode('||', $getp->itemcode);

			$count = count($ite);
			for ($i = 0; $i < $count; $i++) {
				$stock = $this->db->where('itemname', $ite[$i])->where('hsnno', $hsnnos[$i])->get('stock')->result_array();
				foreach ($stock as $s) {
					$ite[$i];
					$cur = $s['balance'];
					$qtyss[$i];
					$tot = $cur + $qtyss[$i];
					$this->db->where('itemname', $ite[$i])->where('itemcode', $itemcodes[$i])->where('hsnno', $hsnnos[$i])->update('stock', array('balance' => $tot));
				}
			}
			//$grandtotal = $_POST['grandtotal'];
			$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')");
			$data11 = $this->db->where('name', $_POST['customername'])->get('customer_details')->result_array();

			foreach ($data11 as $a1) {
				$openingbalance = $a1['openingbal'];
				$balance = $a1['balanceamount'];
				$salesamounts = $a1['salesamount'];
			}

			if ($balance) {
				$balanceamount = $balance - $grandtotals;
			} else {
				$balanceamount = '0.00';
			}
			$this->db->where('id', $a1['id'])->update('customer_details', array('balanceamount' => $balanceamount));


			$grandtotal = $_POST['grandtotal'];
			$data1 = $this->db->where('id', $a1['id'])->get('customer_details')->result_array();



			foreach ($data1 as $a) {
				$openingbalance = $a['openingbal'];
				$balance = $a['balanceamount'];
				$salesamounts = $a['salesamount'];
			}


			if ($balance) {
				$balanceamount = $balance + $grandtotal;
			} else {
				$balanceamount = $openingbalance + $grandtotal;
			}
			if ($salesamounts == '') {
				$salesamount = $grandtotal;
			} else {
				$salesamount = $salesamounts - $grandtotal;
			}

			$datass = array('salesamount' => $salesamount, 'balanceamount' => $balanceamount);

			$this->db->where('id', $a['id'])->update('customer_details', $datass);



			$hsnno = implode('||', $_POST['hsnno']);
			$itemname = implode('||', $_POST['itemname']);
			// 		$heatno = implode('||', $_POST['heatno']) ?? '';
			$itemcode = implode('||', $_POST['itemcode']);
			$item_desc = implode('||', $_POST['item_desc']);
			$qty = implode('||', $_POST['qty']);
			$uom = implode('||', $_POST['uom']);
			$weight = implode('||', $_POST['weight']);
			$grade = implode('||', $_POST['grade']);
			$itemid = implode('||', $_POST['itemid']);
			$rate = implode('||', $_POST['rate']);
			$amount = implode('||', $_POST['amount']);
			@$discount = implode('||', $_POST['discount']);
			@$discountamount = implode('||', $_POST['discountamount']);
			$taxableamount = implode('||', $_POST['taxableamount']);


			$subtotal = $this->input->post('subtotal');
			$sales_bill_type = $this->db->select('bill_type')->where('id', '1')->get('preference_settings')->row()->bill_type;
			if ($sales_bill_type == 'Overall Tax') {
				$sgst = $this->input->post('sgst');
				$sgstamount = $this->input->post('sgstamount');
				$cgst = $this->input->post('cgst');
				$cgstamount = $this->input->post('cgstamount');
				$igst = $this->input->post('igst');
				$igstamount = $this->input->post('igstamount');
			} else {
				$cgst = implode('||', $_POST['cgst']);
				$cgstamount = implode('||', $_POST['cgstamount']);
				$sgst = implode('||', $_POST['sgst']);
				$sgstamount = implode('||', $_POST['sgstamount']);
				$igst = implode('||', $_POST['igst']);
				$igstamount = implode('||', $_POST['igstamount']);
			}
			$freightamount = $this->input->post('freightamount');
			$loadingamount = $this->input->post('loadingamount');
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



			$billtype = $this->input->post('gsttype');
			// print_r($billtype);die;
			if ($billtype == 'intrastate') {
				$sgsts = 'sgst';
				$cgsts = 'cgst';
				$igsts = '';
			}

			if ($billtype == 'interstate') {

				$igsts = 'igst';
				$sgsts = '';
				$cgsts = '';
			}

			$invoicetype = $this->input->post('invoicetype');
			if ($invoicetype == 'Against DC') {
				$deliveryid = $this->input->post('deliveryid');
				$itemnamedc = $this->input->post('itemname');
				$qtydc = $this->input->post('qty');
				$balanceqtydc = $this->input->post('balanceqty');
				$id = $this->input->post('id');
				$count = count($itemnamedc);


				for ($j = 0; $j < $count; $j++) {
					$balanceQtys = $balanceqtydc[$j] - $qtydc[$j];


					if ($balanceQtys == 0) {
						$status = 0;
					} else {
						$status = 1;
					}
					$datas = array('balanceqty' => $balanceQtys, 'status' => $status);
					$this->db->where('id', $deliveryid[$j]);
					$this->db->update('dc_delivery', $datas);
				}
			} else if ($invoicetype == 'Against PO') {
				$purchaseorder = $this->input->post('insertid');
				$itemnamepo = $this->input->post('itemname');
				$pono = $this->input->post('pono');
				$qtypo = $this->input->post('qty');
				$balanceqty = $this->input->post('balanceqty');

				$id = $this->input->post('workorderid');
				$counts = count((array)$itemnamepo);

				for ($j = 0; $j < $counts; $j++) {
					$po_row = $this->db->select('qty')
						->from('purchaseorder_reports')
						->where('id', $id[$j])
						->get()
						->row();

					if ($po_row) {
						$currentBalance = floatval($po_row->qty);
						// $oldQty = floatval($balanceqty[$j]); 
						$newQty = floatval($qtypo[$j]);
						$balanceQtys = $currentBalance - $newQty;

						if ($balanceQtys == 0) {
							$status = 0;
						} else {
							$status = 1;
						}
						$datass = array('balaceqty' => $balanceQtys);
						$this->db->where('id', $id[$j]);
						$this->db->update('purchaseorder_reports', $datass);
					}
				}
			}

			$data = array(
				'date' => date('Y-m-d'),
				'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
				'invoiceno' => $_POST['invoiceno'],
				'bill_type' => $_POST['bill_type'],
				'customername' => $_POST['customername'],
				'customerId' => $_POST['customerid'],
				'address' => $_POST['address'],
				'orderno' => $_POST['orderno'],
				'orderdate' => date('Y-m-d', strtotime($_POST['orderdate'])),
				'billtype' => $_POST['gsttype'],
				'gsttype' => $_POST['gsttype'],
				'vehicleno' => $_POST['vehicleno'],
				'typesgst' => $sgsts,
				'typecgst' => $cgsts,
				'typeigst' => $igsts,
				'hsnno' => $hsnno,
				// 			'heatno' => $heatno,
				'itemname' => $itemname,
				'itemcode' => $itemcode,
				'itemid' => $itemid,
				'item_desc' => $item_desc,
				'uom' => $uom,
				'grade' => $grade,
				'rate' => $rate,
				'qty' => $qty,
				'weight' => $weight,
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
				'subtotal' => $_POST['subtotal'],
				'freightamount' => $freightamount,
				'loadingamount' => $loadingamount,
				'roundOff' => $roundOff,
				'discountBy' => $hiddenDiscountBy,
				'return_status' => implode('||', $ret),
				'grandtotal' => $grandtotal,
				'balance' => $grandtotal,
				'status' => 1,
				'invoice_status' => 1
			);
			// print_r($data);die;
			$this->db->where('id', $_POST['id']);
			$result = $this->db->update('invoice_details', $data);
			if ($result == true) {
				$invoiceid = $_POST['id'];


				$this->db->where('invoiceid', $_POST['id'])->delete('invoice_reports');
				$this->db->where('invoiceid', $_POST['id'])->delete('invoice_party_statement');
				$sparename   = $_POST['itemname'];
				$qtyss         = $_POST['qty'];
				$weight      = $_POST['weight'];
				$hsnnos      = $_POST['hsnno'];
				$itemcodess  = $_POST['itemcode'];
				$itemids     = $_POST['itemid'];
				$grades      = $_POST['grade'];
				$heatnos     = $_POST['heatno'];
				$sgsts       = $_POST['sgst'];
				$cgsts       = $_POST['cgst'];
				$igsts       = $_POST['igst'];

				$count = count($sparename);

				$oldDetails = $this->db->where('id', $_POST['id'])->get('invoice_details')->result();

				for ($i = 0; $i < $count; $i++) {

					$stockRow = $this->db
						->where('itemname', $sparename[$i])
						// ->where('heatno', $heatnos[$i])
						->where('itemcode', $itemcodess[$i])
						->where('hsnno', $hsnnos[$i])
						->get('stock')
						->row();

					if (!$stockRow) {
						continue;
					}

					$oldqty = isset($oldDetails[$i]) ? $oldDetails[$i]->qty : 0;
					// print_r($oldqty);
					$currentBalance = $stockRow->balance;
					// print_r($currentBalance);
					$currentBalance = floatval($currentBalance);
					$oldqty         = floatval($oldqty);
					$qty_i          = isset($qtyss[$i]) ? floatval($qtyss[$i]) : 0;

					$newBalance = ($currentBalance + $oldqty) - $qty_i;
					if ($newBalance < 0) {
						$newBalance = 0;
					}
					// print_r($newBalance);die;
					$this->db
						// ->where('heatno', $heatnos[$i])
						->where('itemcode', $itemcodess[$i])
						->where('hsnno', $hsnnos[$i])
						->update('stock', [
							'date'     => date('Y-m-d'),
							'balance'  => $newBalance
						]);
				}



				$itemnames = $_POST['itemname'];
				$item_descs = $_POST['item_desc'];
				$qtys = $_POST['qty'];
				$weights = $_POST['weight'];
				$hsnnoss = $_POST['hsnno'];
				$itemcodes = $_POST['itemcode'];
				$heatnos = $_POST['heatno'];
				$invoicenoyear = $_POST['invoiceno'] . '' . date('-Y') . '';
				$invoicenodate = $_POST['invoiceno'] . '' . date('dmy') . '';

				$count = count($sparename);
				for ($j = 0; $j <  $count; $j++) {
					$podatass = array(
						'date' => date('Y-m-d'),
						'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
						'orderdate' => date('Y-m-d', strtotime($_POST['orderdate'])),
						'invoiceno' => $_POST['invoiceno'],
						'customername' => $_POST['customername'],
						'address' => $_POST['address'],
						'orderno' => $_POST['orderno'],
						'billtype' => $_POST['gsttype'],
						'gsttype' => $_POST['gsttype'],
						'deliveryat' => $_POST['deliveryat'],
						'vehicleno' => $_POST['vehicleno'],
						'itemname' => $itemnames[$j],
						'itemid' => $itemids[$j],
						'item_desc' => $item_descs[$j],
						'rate' => $_POST['rate'][$j],
						'qty' => $qtys[$j],
						'weight' => $weights[$j],
						'total' => $_POST['total'][$j],
						'hsnno' => $hsnnoss[$j],
						// 	'heatno' => $heatnos[$j],
						'grade' => $grades[$j],
						'itemcode' => $itemcodes[$j],
						'address' => $_POST['address'],
						'subtotal' => $_POST['subtotal'],
						'grandtotal' => $_POST['grandtotal'],
						'invoicenodate' => $invoicenodate,
						'invoicenoyear' => $invoicenoyear,
						'invoiceid' => $invoiceid,
						'status' => 1
					);
					$this->db->insert('invoice_reports', $podatass);
				}


				//$itemname=$this->input->post('itemname');
				@$receiptno = '-';
				@$paymentdetails = '-';
				@$paymentmodes = '-';
				@$throughchecks = '-';
				@$banktransfers = '-';
				@$chamounts = '-';
				@$bankamounts = '-';
				@$chequeno = '-';
				@$receiptamt = '-';
				@$receiptid = '-';

				$dd = array(
					'date' => date('Y-m-d', strtotime($_POST['invoicedate'])),
					'receiptdate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
					'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
					'invoiceno' => $_POST['invoiceno'],
					'payment' => $paymentdetails,
					'customerId' => $_POST['customerid'],
					'customername' => $_POST['customername'],
					'paymentmode' => $paymentmodes,
					'throughcheck' => $throughchecks,
					'banktransfer' => $banktransfers,
					'chamount' => $chamounts,
					'bankamount' => $bankamounts,
					'chequeno' => $chequeno,
					'itemname' => $itemname,
					'item_desc' => $item_desc,
					'paymentdetails' => $paymentdetails,
					'overallamount' => $_POST['grandtotal'],
					'receiptamt' => '-',
					'receiptno' => $receiptid,
					// 'qty'=>$qty,
					'paid' => $paymentdetails,
					'totalamount' => $_POST['grandtotal'],
					'invoiceamt' => $_POST['grandtotal'],
					'invoicenoyear' => $invoicenoyear,
					'invoicenodate' => $invoicenodate,
					'balance' => $balanceamount,
					'invoiceid' => $invoiceid,
					'status' => 1
				);

				$this->db->insert('invoice_party_statement', $dd);

				$this->session->set_flashdata('msg', 'Invoice Update Successfully');

				if ($_POST['save'] == 'save') {
					redirect('invoice/view');
				} else {
					redirect('invoice/bill');
				}
			} else {
				$this->session->set_flashdata('msg1', 'Invoice Update Unsuccessfully');
				redirect('invoice/view');
			}
		}


		public function delete()
		{
			$del = base64_decode($this->input->post('id'));
			$deletedata = $this->db->where('id', $del)->where('einvoice_status', 1)->or_where('eway_status', 1)->get('invoice_details')->result();
			if ($deletedata) {
				echo 'einvoice';
			} else {

				//$del=$this->input->post('id');  
				$getdetails = $this->db->where('id', $del)->get('invoice_details')->result();

				if ($getdetails) {
					foreach ($getdetails as $row) {

						$customer_details = $this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('name', $row->customername)->get('customer_details')->result();

						foreach ($customer_details as $c)
						$updates = $c->balanceamount - $row->grandtotal;
						$salesamt = $c->salesamount - $row->grandtotal;

						$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('name', $row->customername)->update('customer_details', array('balanceamount' => $updates, 'salesamount' => $salesamt));

						$itemname = explode('||', $row->itemname);
						$rate = explode('||', $row->rate);
						$qty = explode('||', $row->qty);
						$hsnno = explode('||', $row->hsnno);
						$invcount = count($itemname);
						for ($j = 0; $j < $invcount; $j++) {
							$invwq = $this->db->where('itemname', $itemname[$j])->where('hsnno', $hsnno[$j])->get('stock')->result();
							if ($invwq) {
								foreach ($invwq as $w)
									@$old = $w->balance;
								$qty[$j];
								@$bal = $old + $qty[$j];
								$this->db->where('itemname', $itemname[$j])->where('hsnno', $hsnno[$j])->update('stock', array('balance' => $bal));
							}
						}
					}
				}

				$checkdata = $this->db->where('id', $del)->get('invoice_details')->result_array();

				if ($checkdata) {
					foreach ($checkdata as $rows) {
						$invoicetype = $rows['invoicetype'];
						$dcno = $rows['dcno'];
						$pono = $rows['pono'];
						$dcnos = explode('||', $rows['dcnos']);
						$deliveryid = explode('||', $rows['deliveryid']);
						$workorderid = explode('||', $rows['workorderid']);
						$qtyss = explode('||', $rows['qty']);
					}


					$counts = count($deliveryid);
					$countss = count($workorderid);

					if ($invoicetype == 'Against DC') {
						for ($i = 0; $i < $counts; $i++) {

							$getbalanceqty = $this->db->where('id', $deliveryid[$i])->get('dc_delivery')->row();

							if (!empty($getbalanceqty)) {
								$original_balance = $getbalanceqty->balanceqty;
								$balanceqty = $original_balance + $qtyss[$i];
							} else {
								$balanceqty = $qtyss[$i]; // fallback in case no record found
							}

							$datass = array(
								'balanceqty' => $balanceqty,
								'dc_status' => 1
							);

							$this->db->where('id', $deliveryid[$i]);
							$this->db->update('dc_delivery', $datass);
						}


						$datass = array('delete_status' => 1);
						$this->db->where('dcno', $dcno);
						$this->db->update('dcbill_details', $datass);
					}

					if ($invoicetype == 'Against PO') {

						for ($j = 0; $j < $countss; $j++) {
							$balqty = $this->db->select('balaceqty')->where('id', $workorderid[$j])->get('purchaseorder_reports')->row()->balaceqty;
							$finallqty = $balqty + $qtyss[$j];
 							// print_r($invoicetype);
							// print_r($balqty);
							// print_r($finallqty);
							// print_r($workorderid[$j]);die;
							$podata = array('balaceqty' => $finallqty);
							$this->db->where('id', $workorderid[$j]);
							$this->db->update('purchaseorder_reports', $podata);
						}

						$podatas = array('invoice_status' => 1);
						$this->db->where('purchaseorderno', $pono);
						$this->db->update('purchaseorder_details', $podatas);
					}
				}

				$data = $this->db->where('id', $del)->delete('invoice_details');
				if ($data) {
					$this->db->where('invoiceid', $del)->delete('invoice_reports');
					$this->db->where('invoiceid', $del)->delete('invoice_party_statement');


					$this->session->set_flashdata('msg', 'Invoice Details  Deleted successfully!');
					echo 'yes';
				} else {
					//$this->session->set_flashdata('msg1','Invoice Details  Deleted unsuccessfully');
					echo 'no';
				}
			}
		}

		public function pending_view()
		{
			$data['pending'] = $this->invoice_model->pending();
			$this->load->view('header');
			$this->load->view('pending_view', $data);
			$this->load->view('footer1');
		}


		public function pending()
		{

			$data['pending'] = $this->invoice_model->pending_select();


			$this->load->view('header');
			$this->load->view('purchase_pending_view', $data);
			$this->load->view('footer1');
		}


		public function pending_search()
		{
			$data['pending'] = $this->invoice_model->search_reports();


			$this->load->view('header');
			$this->load->view('purchase_pending_view', $data);
			$this->load->view('footer1');
		}


		public function purchase_reports()
		{
			@$suppliername = $_POST['suppliername'];
			@$fromdate = $_POST['fromdate'];
			@$todate = $_POST['todate'];
			$data['pending'] = $this->invoice_model->search_pending();

			// echo"<pre>";
			// print_r($data);
			$this->load->view('purchase_reports', $data, $fromdate, $todate, $suppliername);
		}

		public function reports()
		{
			@$suppliername = $_POST['suppliername'];
			@$fromdate = $_POST['fromdate'];
			@$todate = $_POST['todate'];
			$data['pending'] = $this->invoice_model->search_reports();


			$this->load->view('purchase_reports2', $data, $fromdate, $todate);
		}


		public function reports1()
		{
			@$suppliername = $_POST['suppliername'];
			@$fromdate = $_POST['fromdate'];
			@$todate = $_POST['todate'];
			$data['pending'] = $this->invoice_model->search_pending();


			$this->load->view('purchase_reports1', $data, $fromdate, $todate);
		}

		public function getcustomer()
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

		public function gets()
		{
			$name = $_POST['name'];
			$data = $this->db->where('itemname', $name)->get('additem')->result();
			echo $count = count($data);
		}

		public function getss()
		{
			$name = $_POST['name'];
			$data = $this->db->where('itemcode', $name)->get('additem')->result();
			echo $count = count($data);
		}

		public function get_heatdetails()
		{
			$name = $_POST['name'];
			$data = $this->db->where('heatno', $name)->get('stock')->result();
			echo $count = count($data);
		}


		public function bill()
		{
			$data['pre'] = $this->db->where('status', 1)->order_by('id', 'desc')->limit(1)->get('invoice_details')->result();
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
			//print_r($taxPercent);
			/* CALCULATION NO.OF ITEMS FOR EACH TAX % */
			//$this->load->view('invoicebill',$data);
			// $this->load->view('invoice_bill',$data);
			$sales_bill_type = $this->db->select('bill_type')->where('id', '1')->get('preference_settings')->row()->bill_type;
			if ($sales_bill_type == 'Overall Tax') {
				$data['pre'] = $this->db->where('status', 1)->order_by('id', 'desc')->limit(1)->get('invoice_details')->result();
				foreach ($data['pre'] as $b) {
					if ($b->gsttype == 'intrastate') {

						$cgst = $b->cgstamount;
						$sgst = $b->sgstamount;
						$taxamt = $cgst + $sgst;
						$no = round($taxamt);
					}

					if ($b->gsttype == 'interstate') {
						$igsts = $b->igstamount;
						$taxamt = $igsts;
						$no = round($taxamt);
					}
				}

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
				$data['fins'] = $result;
				$data['profile'] = $this->db->get('profile')->result();
				$data['fromDirectBill'] = 1;
				$this->load->view('invoicebill_overalltax', $data);
			} else {
				/* CALCULATION NO.OF ITEMS FOR EACH TAX %*/
				$taxesList1 = $this->db->select('sgst,cgst,igst')->get('vat_details')->result();
				if (count($taxesList1) > 0) {
					foreach ($taxesList1 as $tl1) {
						$taxPercent[$tl1->igst] = 0;
						$grossAmount[$tl1->igst] = 0;
						$NetValue[$tl1->igst] = 0;
					}
				}
				//print_r($taxPercent);Array ( [18] => 0 [28] => 0 [5] => 0 [12] => 0 )
				//exit;
				$invoiceDet = $this->db->select('gsttype,qty,sgst,cgst,igst,amount,cgstamount,sgstamount,igstamount')->where('status', 1)->order_by('id', 'desc')->limit(1)->get('invoice_details')->row();
				if (@count($invoiceDet) > 0) {
					$gstType = $invoiceDet->gsttype;
					$sgstPer = explode("||", $invoiceDet->sgst);
					$cgstPer = explode("||", $invoiceDet->cgst);
					$igstPer = explode("||", $invoiceDet->igst);
					$quantit = explode("||", $invoiceDet->qty);
					$amount = explode("||", $invoiceDet->amount);
					$cgstAmt = explode("||", $invoiceDet->cgstamount);
					$sgstAmt = explode("||", $invoiceDet->sgstamount);
					$igstAmt = explode("||", $invoiceDet->igstamount);

					$taxesList = $this->db->select('sgst,cgst,igst')->get('vat_details')->result();
					if (count($taxesList) > 0) {
						foreach ($taxesList as $tl) {
							if ($gstType == 'interstate') {
								for ($i = 0; $i < count($quantit); $i++) {
									if ($igstPer[$i] == $tl->igst) {
										$grossAmount[$tl->igst] += $amount[$i];
										$taxPercent[$tl->igst] += $igstAmt[$i];
										$NetValue[$tl->igst] += $igstAmt[$i] + $amount[$i];
									}
								}
							} else {
								for ($i = 0; $i < count($quantit); $i++) {
									if (@$cgstPer[$i] == @$tl->cgst) {
										$grossAmount[$tl->igst] += $amount[$i];
										$taxPercent[$tl->igst] += ($sgstAmt[$i] + $cgstAmt[$i]);
										$NetValue[$tl->igst] += ($sgstAmt[$i] + $cgstAmt[$i]) + $amount[$i];
										//$taxPercent[$tl->igst] +=($cgstAmt[$i]+$sgstAmt[$i]);
									}
								}
							}
						}
					}
				}
				$data['taxPercent'] = $taxPercent;
				$data['grossAmount'] = $grossAmount;
				$data['NetValue'] = $NetValue;
				$data['fromDirectBill'] = 1;
				$this->load->view('invoicebill_multipletax', $data);
			}
		}
		public function rebill()
		{
			$id = base64_decode($this->uri->segment(3));
			// $this->load->library('mpdf'); 
			$data['pre'] = $this->db->where('id', $id)->get('invoice_details')->result();

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

			$data['pre'] = $this->db->where('id', $id)->get('invoice_details')->result();

			$sales_bill_type = $this->db->select('bill_type')->where('id', '1')->get('preference_settings')->row()->bill_type;
			if ($sales_bill_type == 'Overall Tax') {
				$data['pre'] = $this->db->where('id', $id)->get('invoice_details')->result();
				foreach ($data['pre'] as $b) {
					if ($b->gsttype == 'intrastate') {

						$cgst = $b->cgstamount;
						$sgst = $b->sgstamount;
						(float)$taxamt = (float)$cgst + (float)$sgst;
						$no = round($taxamt);

						$invoicetype = $b->invoicetype;
					}

					if ($b->gsttype == 'interstate') {
						$igsts = $b->igstamount;
						$taxamt = $igsts;
						$no = round($taxamt);
						$invoicetype = $b->invoicetype;
					}
				}

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
				$data['fins'] = $result;
				$data['profile'] = $this->db->get('profile')->result();
				$data['fromDirectBill'] = 1;

				// $this->load->view('invoicebill_overalltax', $data);
 				if ($invoicetype == "Against PO"){
				$this->load->view('invoicebill_overalltax', $data);
				} else {
				$this->load->view('invoicebill_overalltax_direct', $data);
				}
				//print_r($data);exit;
			} else {
				/* CALCULATION NO.OF ITEMS FOR EACH TAX %*/
				$taxesList1 = $this->db->select('sgst,cgst,igst')->get('vat_details')->result();
				if (count($taxesList1) > 0) {
					foreach ($taxesList1 as $tl1) {
						$taxPercent[$tl1->igst] = 0;
						$grossAmount[$tl1->igst] = 0;
						$NetValue[$tl1->igst] = 0;
					}
				}
				//print_r($taxPercent);Array ( [18] => 0 [28] => 0 [5] => 0 [12] => 0 )
				//exit;
				$invoiceDet = $this->db->select('gsttype,qty,sgst,cgst,igst,amount,cgstamount,sgstamount,igstamount')->where('id', $id)->get('invoice_details')->row();
				if (@count($invoiceDet) > 0) {
					$gstType = $invoiceDet->gsttype;
					$sgstPer = explode("||", $invoiceDet->sgst);
					$cgstPer = explode("||", $invoiceDet->cgst);
					$igstPer = explode("||", $invoiceDet->igst);
					$quantit = explode("||", $invoiceDet->qty);
					$amount = explode("||", $invoiceDet->amount);
					$cgstAmt = explode("||", $invoiceDet->cgstamount);
					$sgstAmt = explode("||", $invoiceDet->sgstamount);
					$igstAmt = explode("||", $invoiceDet->igstamount);

					$taxesList = $this->db->select('sgst,cgst,igst')->get('vat_details')->result();
					if (count($taxesList) > 0) {
						foreach ($taxesList as $tl) {
							if ($gstType == 'interstate') {
								for ($i = 0; $i < count($quantit); $i++) {
									if ($igstPer[$i] == $tl->igst) {
										$grossAmount[$tl->igst] += $amount[$i];
										$taxPercent[$tl->igst] += $igstAmt[$i];
										$NetValue[$tl->igst] += $igstAmt[$i] + $amount[$i];
									}
								}
							} else {
								for ($i = 0; $i < count($quantit); $i++) {
									if (@$cgstPer[$i] == @$tl->cgst) {
										$grossAmount[$tl->igst] += $amount[$i];
										$taxPercent[$tl->igst] += ($sgstAmt[$i] + $cgstAmt[$i]);
										$NetValue[$tl->igst] += ($sgstAmt[$i] + $cgstAmt[$i]) + $amount[$i];
										//$taxPercent[$tl->igst] +=($cgstAmt[$i]+$sgstAmt[$i]);
									}
								}
							}
						}
					}
				}
				$data['taxPercent'] = $taxPercent;
				$data['grossAmount'] = $grossAmount;
				$data['NetValue'] = $NetValue;
				$data['fromDirectBill'] = 1;
				$this->load->view('invoicebill_multipletax', $data);
			}
		}

		public function search()
		{

			$fromdate = $this->input->post('fromdate');
			$todate = $this->input->post('todate');
			$cusname = $this->input->post('cusname');
			$invoiceno = $this->input->post('invoiceno');
			$gsttype = $this->input->post('gsttype');

			$data = array(
				'rcbio_fromdate' => $fromdate,
				'rcbio_todate' => $todate,
				'rcbio_cusname' => $cusname,
				'rcbio_invoiceno' => $invoiceno,
				'rcbio_gsttype' => $gsttype,
				'rcbio_bill_format' => 'Print',
			);
			$this->session->set_userdata($data);
		}


		public function search_reports()
		{
			$bill_format = $this->session->userdata('rcbio_bill_format');

			if ($bill_format == 'Print') {
				$data['invoice'] = $this->invoice_model->search_billing();

				$data['fromdate'] = $this->session->userdata('rcbio_fromdate');
				$data['todate'] = $this->session->userdata('rcbio_todate');
				$data['cusname'] = $this->session->userdata('rcbio_cusname');
				$data['invoiceno'] = $this->session->userdata('rcbio_invoiceno');
				$data['gsttype'] = $this->session->userdata('rcbio_gsttype');


				$this->load->view('invoice_reports', $data);
			}
		}
		public function download()
		{
			$fromdate = $this->input->post('fromdate');
			$todate = $this->input->post('todate');
			$cusname = $this->input->post('cusname');
			$invoiceno = $this->input->post('invoiceno');
			$gsttype = $this->input->post('gsttype');

			$data = array(
				'rcbio_fromdate' => $fromdate,
				'rcbio_todate' => $todate,
				'rcbio_cusname' => $cusname,
				'rcbio_invoiceno' => $invoiceno,
				'rcbio_gsttype' => $gsttype,
				'rcbio_bill_format' => 'Excel',
			);
			$this->session->set_userdata($data);
		}
		public function excel_download()
		{

			$bill_format = $this->session->userdata('rcbio_bill_format');
			if ($bill_format == 'Excel') {
				$val = $this->invoice_model->search_billing();
				$this->load->library('excel');
				$this->excel->setActiveSheetIndex(0);
				//name the worksheet
				$this->excel->getActiveSheet()->setTitle('Invoice Reports');
				//set cell A1 content with some text
				$this->excel->getActiveSheet()->setCellValue('A1', 'INVOICE DETAILS');
				$this->excel->getActiveSheet()->setCellValue('A2', 'DATE');
				$this->excel->getActiveSheet()->setCellValue('B2', 'INVOICE NO');
				$this->excel->getActiveSheet()->setCellValue('C2', 'COMPANY NAME');
				$this->excel->getActiveSheet()->setCellValue('D2', 'MOBILE NO');
				$this->excel->getActiveSheet()->setCellValue('E2', 'GSTIN');
				$this->excel->getActiveSheet()->setCellValue('F2', 'BILL AGE');
				$this->excel->getActiveSheet()->setCellValue('G2', 'TOTAL');



				//merge cell A1 until C1
				$this->excel->getActiveSheet()->mergeCells('A1:H1');
				//set aligment to center for that merged cell (A1 to C1)
				$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
				$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

				for ($col = ord('A'); $col <= ord('H'); $col++) {
					//set column dimension
					$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
					//change the font size
					$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

					$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}
				//retrive contries table data

				//$rs = $this->db->get('countries');

				$exceldata = array();
				foreach ($val as $row) {
					@$gstin = $this->db->select('gstno')->where('name', $row['customername'])->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->gstno;

					@$phoneno = $this->db->select('phoneno')->where('name', $row['customername'])->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->phoneno;

					$startTimeStamp = strtotime($row['invoicedate']);
					$endTimeStamp = strtotime(date('d-m-Y'));
					$timeDiff = abs($endTimeStamp - $startTimeStamp);
					$numberDays = $timeDiff / 86400;  // 86400 seconds in one day
					$numberDays = intval($numberDays);

					$data['date'] = date('d-m-Y', strtotime($row['date']));
					$data['invoiceno'] = $row['invoiceno'];
					$data['customername'] = $row['customername'];
					$data['mobileno'] = $phoneno;
					$data['gstin'] = $gstin;
					$data['billage'] = $numberDays . 'Days';
					$data['grandtotal'] = $row['grandtotal'];
					$exceldata[] = $data;
					$gtotal[] = $row['grandtotal'];
				}
				//Fill data 
				$overalltotal = array_sum($gtotal);
				if (count($exceldata) > 0) {
					$data['date'] = "";
					$data['invoiceno'] = "";
					$data['customername'] = "";
					$data['mobileno'] = "";
					$data['gstin'] = "";
					$data['billage'] = "";
					$data['grandtotal'] = number_format($overalltotal, 2);
					$exceldata[] = $data;
					$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');
				}


				$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$filename = 'Invoice Reports-' . date('d/m/y') . '.xls'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache

				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			}
		}

		public function get_stockqty()
		{
			$itemcode = $this->input->post('name');
			$this->db->select('*');
			$this->db->from('stock');
			$this->db->where('itemname', $itemcode);
			$query = $this->db->get();
			$result = $query->result();

			foreach ($result as $h) {

				$vob['balance'] = $h->balance;
			}
			echo json_encode($vob);
		}

		public function get_stockqtys()
		{
			$itemcode = $this->input->post('name');
			$this->db->select('*');
			$this->db->from('stock');
			$this->db->where('itemcode', $itemcode);
			$query = $this->db->get();
			$result = $query->result();

			foreach ($result as $h) {

				$vob['balance'] = $h->balance;
			}
			echo json_encode($vob);
		}


		public function get_dcno()
		{
			$cusname = $_POST['id'];
			$query = $this->db->where('status', 1)->where('cusname', $cusname)->where('balanceqty >', 0)->group_by('dcno')->get('dc_delivery');
			$result = $query->result();
			$data = array();
			foreach ($result as $r) {
				$data['value'] = $r->dcno;
				$data['label'] = $r->dcno;
				$json[] = $data;
			}
			echo json_encode($json);
		}

		public function getdc_item()
		{
			$cusname = $_POST['id'];
			$querys = $this->db->where('status', 1)->where('cusname', $cusname)->where('balanceqty >', 0)->get('dc_delivery');
			$results = $querys->result();
			$datas = array();

			foreach ($results as $row) {
				$datas['label'] = $row->dcno;
				$datas['value'] = $row->inwardno . ' - ' . $row->itemname . ' - ' . $row->qty . ' - ' . date('d-m-Y', strtotime($row->dcdate));
				$jsons[] = $datas;
			}
			echo json_encode($jsons);
		}

		public function get_pono()
		{
			$cusname = $_POST['id'];
			$query = $this->db->where('status', 1)->where('customername', $cusname)->where('balaceqty >', 0)->group_by('purchaseorderno')->get('purchaseorder_reports');
			$result = $query->result();
			$data = array();
			foreach ($result as $r) {
				$data['value'] = $r->purchaseorderno;
				$data['label'] = $r->purchaseorderno . '-' . $r->purchaseorder;
				$json[] = $data;
			}
			echo json_encode($json);
		}

		public function getpodetails()
		{
			$pono = $this->input->post('pono');
			$gsttype = $this->input->post('gsttype');
			$customerid = $this->input->post('customerid');
			if ($pono == '') {
				$html = '<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select PO No</span></div>';
				echo $html;
			} else {
				$data['pono'] = $pono;
				$data['gsttype'] = $gsttype;
				$data['customerid'] = $customerid;
				$this->load->view('againstpo', $data);
			}
		}

		public function getdc_details()
		{
			$invoicetype = $this->input->post('invoicetype');
			$gsttype = $this->input->post('gsttype');
			$data['gsttype'] = $gsttype;
			if ($invoicetype == 'Against DC') {
				$html = '<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select DC No</span></div>';
				echo $html;
			} else {
				$checkItemType = $this->db->select('itemType')->where('id', 1)->get('preference_settings')->row()->itemType;
				$sales_bill_type = $this->db->select('bill_type')->where('id', '1')->get('preference_settings')->row()->bill_type;
				if ($checkItemType == 'with_item') {
					if ($sales_bill_type == 'Overall Tax') {
						$this->load->view('directinvoice_overalltax', $data);
					} elseif ($sales_bill_type == 'Multiple Tax') {
						$this->load->view('directinvoice_multipletax', $data);
					}
				} else {
					$this->load->view('invoiceWithoutItem', $data);
				}
			}
		}

		public function getdcdetails()
		{
			$dcno = $this->input->post('dcno');
			$gsttype = $this->input->post('gsttype');
			if ($dcno == '') {
				$html = '<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select DC No</span></div>';
				echo $html;
			} else {
				$data['dcno'] = $dcno;
				$data['gsttype'] = $gsttype;
				$this->load->view('againstdc', $data);
			}
		}


		public function einvoice()
		{


			$id = base64_decode($this->uri->segment(3));
			$result = $this->db->where('id', $id)->get('invoice_details')->result_array();
			$profile = $this->db->where('status', 1)->get('profile')->row();

			$authtoken = $this->db->where('status', 1)->order_by('id', 'desc')->limit(1)->get('einvoicetoken')->row();


			$date = date('Y-m-d H:i:s');

			if ($date >= $authtoken->tokenexpiry) {
				$url = "https://api.mastergst.com/einvoice/authenticate?email=jp@idreamdevelopers.com";

				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				$headers = array(
					"accept: */*",
					"username: mastergst",
					"password: Malli#123",
					"ip_address: 103.224. 35.181",
					"client_id: e05ac7b6-ddcf-4294-80d4-453827fba2cf",
					"client_secret: 1c1ade41-e062-499d-be41-1d89a1b29de2",
					"gstin: 29AABCT1332L000",
				);
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				//for debug only!
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

				$response = curl_exec($curl);
				curl_close($curl);

				if ($response) {

					$decodeArray = json_decode($response, true);

					$expiry = $decodeArray['data']['TokenExpiry'];
					$token  = $decodeArray['data']['AuthToken'];
					$sek    = $decodeArray['data']['Sek'];

					$datas = array(

						'tokenexpiry' => $expiry,
						'authtoken'   => $token,
						'sek'         => $sek,
						'status'       => 1
					);
					$update =   $this->db->update('einvoicetoken', $datas);

					if ($update) {
						$resp =    $this->generate($result, $profile, $token);
						$response = $resp;

						$decodedArray = json_decode($response, true);

						if ($decodedArray != null) {
							$acno = $decodedArray['data']['AckNo'];
							$acdate = $decodedArray['data']['AckDt'];
							$irn = $decodedArray['data']['Irn'];
							$signedinvoice = $decodedArray['data']['SignedInvoice'];
							$signedqrcode = $decodedArray['data']['SignedQRCode'];
							$status = $decodedArray['data']['Status'];
							$ewayno = $decodedArray['data']['EwbNo'];
							$ewaydate = $decodedArray['data']['EwbDt'];
							$remarks = $decodedArray['data']['Remarks'];
							$status_cd = $decodedArray['data']['status_cd'];
							$status_desc = $decodedArray['data']['status_desc'];
						}

						$data = array(
							'acno' => $acno,
							'acdate' => $acdate,
							'irn' => $irn,
							'signedinvoice' => $signedinvoice,
							'signedqrcode' => $signedqrcode,
							'status_ein' => $status,
							'ewayno' => $ewayno,
							'ewaydate' => $ewaydate,
							'remarks' => $remarks,
							'status_cd' => $status_cd,
							'status_desc' => $status_desc,
							'einvoice_status' => 1
						);

						$this->db->where('id', $id);
						$result =    $this->db->update('invoice_details', $data);
						if ($result == true) {
							$this->session->set_flashdata('msg', 'Einvoice generated Successfully');
							redirect('invoice/view');
						} else {
							$this->session->set_flashdata('msg', 'Einvoice generated UnSuccessfully');
							redirect('invoice/view');
						}
					}
				}
			} else {
				$token = $authtoken->authtoken;
				$resp =    $this->generate($result, $profile, $token);
				$response = $resp;
				$decodedArray = json_decode($response, true);


				if ($decodedArray != null) {
					$acno = $decodedArray['data']['AckNo'];
					$acdate = $decodedArray['data']['AckDt'];
					$irn = $decodedArray['data']['Irn'];
					$signedinvoice = $decodedArray['data']['SignedInvoice'];
					$signedqrcode = $decodedArray['data']['SignedQRCode'];
					$status = $decodedArray['data']['Status'];
					$ewayno = $decodedArray['data']['EwbNo'];
					$ewaydate = $decodedArray['data']['EwbDt'];
					$remarks = $decodedArray['data']['Remarks'];
					$status_cd = $decodedArray['data']['status_cd'];
					$status_desc = $decodedArray['data']['status_desc'];
				}

				$datas = array(
					'acno' => $acno,
					'acdate' => $acdate,
					'irn' => $irn,
					'signedinvoice' => $signedinvoice,
					'signedqrcode' => $signedqrcode,
					'status_ein' => $status,
					'ewayno' => $ewayno,
					'ewaydate' => $ewaydate,
					'remarks' => $remarks,
					'status_cd' => $status_cd,
					'status_desc' => $status_desc,
					'einvoice_status' => 1
				);

				$this->db->where('id', $id);
				$result =  $this->db->update('invoice_details', $datas);
				if ($result == true) {
					$this->session->set_flashdata('msg', 'Einvoice generated Successfully');
					redirect('invoice/view');
				} else {
					$this->session->set_flashdata('msg', 'Einvoice generated UnSuccessfully');
					redirect('invoice/view');
				}
			}
		}

		public function eway()
		{
			$id = base64_decode($this->uri->segment(3));

			$datas = $this->db->where('id', $id)->get('invoice_details')->result_array();

			$profiles = $this->db->where('status', 1)->get('profile')->row();

			$authtoken = $this->db->where('status', 1)->order_by('id', 'desc')->limit(1)->get('einvoicetoken')->row();


			$date = date('Y-m-d H:i:s');
			if ($date >= $authtoken->tokenexpiry) {
				$url = "https://api.mastergst.com/einvoice/authenticate?email=jp@idreamdevelopers.com";

				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				$headers = array(
					"accept: */*",
					"username: mastergst",
					"password: Malli#123",
					"ip_address: 103.224. 35.181",
					"client_id: e05ac7b6-ddcf-4294-80d4-453827fba2cf",
					"client_secret: 1c1ade41-e062-499d-be41-1d89a1b29de2",
					"gstin: 29AABCT1332L000",
				);
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				//for debug only!
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

				$response = curl_exec($curl);
				curl_close($curl);

				if ($response) {

					$decodeArray = json_decode($response, true);

					$expiry = $decodeArray['data']['TokenExpiry'];
					$token  = $decodeArray['data']['AuthToken'];
					$sek    = $decodeArray['data']['Sek'];

					$datas = array(

						'tokenexpiry' => $expiry,
						'authtoken'   => $token,
						'sek'         => $sek,
						'status'       => 1
					);
					$update =   $this->db->update('einvoicetoken', $datas);

					if ($update) {
						$resp =    $this->generate($datas, $profiles, $token);
						$response = $resp;

						$decodeArray = json_decode($response, true);

						if ($decodeArray != null) {
							$ewayno = $decodeArray['data']['EwbNo'];
							$ewaydate = $decodeArray['data']['EwbDt'];
							$ewayvalid = $decodeArray['data']['EwbValidTill'];
							$statuscode = $decodeArray['data']['status_cd'];
							$statusdesc = $decodeArray['data']['status_desc'];
						}

						$data = array(

							'ewayno' => $ewayno,
							'ewaydate' => $ewaydate,
							'ewbvalidtill' => $ewayvalid,
							'status_cd' => $statuscode,
							'status_desc' => $statusdesc,
							'eway_status' => 1
						);

						$this->db->where('id', $id);
						$result =    $this->db->update('invoice_details', $data);
						if ($result == true) {
							$this->session->set_flashdata('msg', 'Einvoice generated Successfully');
							redirect('invoice/view');
						} else {
							$this->session->set_flashdata('msg', 'Einvoice generated UnSuccessfully');
							redirect('invoice/view');
						}
					}
				}
			} else {

				$token = $authtoken->authtoken;
				$ewayres = $this->generateeway($datas, $profiles, $token);

				$responses = $ewayres;

				$decodeArray = json_decode($responses, true);
				if ($decodeArray != null) {
					$ewayno = $decodeArray['data']['EwbNo'];
					$ewaydate = $decodeArray['data']['EwbDt'];
					$ewayvalid = $decodeArray['data']['EwbValidTill'];
					$statuscode = $decodeArray['data']['status_cd'];
					$statusdesc = $decodeArray['data']['status_desc'];
				}

				$details = array(

					'ewayno' => $ewayno,
					'ewaydate' => $ewaydate,
					'ewbvalidtill' => $ewayvalid,
					'status_cd' => $statuscode,
					'status_desc' => $statusdesc,
					'eway_status' => 1
				);
				$this->db->where('id', $id);
				$result = $this->db->update('invoice_details', $details);
				if ($result == true) {
					$this->session->set_flashdata('msg', 'Eway Bill generated Successfully');
					redirect('invoice/view');
				} else {
					$this->session->set_flashdata('msg', 'Eway  generated UnSuccessfully');
					redirect('invoice/view');
				}
			}
		}



		public function einvoice_cancel()
		{
			$id = base64_decode($this->uri->segment(3));

			$results = $this->db->where('id', $id)->get('invoice_details')->result_array();
			$authtokens = $this->db->where('status', 1)->order_by('id', 'desc')->limit(1)->get('einvoicetoken')->row();

			$date = date('y-m-d H:i:s');
			if ($date >= $authtokens->tokenexpiry) {
				$url = "https://api.mastergst.com/einvoice/authenticate?email=jp@idreamdevelopers.com";

				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				$headers = array(
					"accept: */*",
					"username: mastergst",
					"password: Malli#123",
					"ip_address: 103.224. 35.181",
					"client_id: e05ac7b6-ddcf-4294-80d4-453827fba2cf",
					"client_secret: 1c1ade41-e062-499d-be41-1d89a1b29de2",
					"gstin: 29AABCT1332L000",
				);
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				//for debug only!
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

				$response = curl_exec($curl);
				curl_close($curl);

				if ($response) {

					$decodeArray = json_decode($response, true);

					$expiry = $decodeArray['data']['TokenExpiry'];
					$token  = $decodeArray['data']['AuthToken'];
					$sek    = $decodeArray['data']['Sek'];

					$datas = array(

						'tokenexpiry' => $expiry,
						'authtoken'   => $token,
						'sek'         => $sek,
						'status'       => 1
					);
					$update =   $this->db->update('einvoicetoken', $datas);

					if ($update) {
						$resp = $this->cancel($results, $token);
						$response = $resp;

						$decodeArray = json_encode($response, true);
						if ($decodeArray != null) {
							$irn = $decodeArray['data']['irn'];
							$canceldate = $decodeArray['data']['CancelDate'];
						}
						$update = array(
							'canceldate' => $canceldate,
							'acno'      => "",
							'acdate'    => "",
							'signedinvoice' => "",
							'irn'          => "",
							'signedqrcode' => "",
							'status_ein' => "",
							'ewayno' => "",
							'ewaydate' => "",
							'ewbvalidtill' => "",
							'einvoice_status' => 0,
							'eway_status' => 0
						);
						$this->db->where('id', $id);
						$results = $this->db->update('invoice_details', $update);
						if ($results == true) {
							$this->session->set_flashdata('msg', 'Einvoice Cancelled Successfully');
							redirect('invoice/view');
						} else {
							$this->session->set_flashdata('msg', 'Einvoice Cancelled UnSuccessfully');
							redirect('invoice/view');
						}
					}
				}
			} else {
				$token = $authtokens->authtoken;
				$resp = $this->cancel($results, $token);
				$response = $resp;

				$decodeArray = json_encode($response, true);
				if ($decodeArray != null) {
					$irn = $decodeArray['data']['irn'];
					$canceldate = $decodeArray['data']['CancelDate'];
				}
				$update = array(
					'canceldate' => $canceldate,
					'acno'      => "",
					'acdate'    => "",
					'signedinvoice' => "",
					'irn'          => "",
					'signedqrcode' => "",
					'status_ein' => "",
					'ewayno' => "",
					'ewaydate' => "",
					'ewbvalidtill' => "",
					'einvoice_status' => 0,
					'eway_status' => 0
				);
				$this->db->where('id', $id);
				$results = $this->db->update('invoice_details', $update);
				if ($results == true) {
					$this->session->set_flashdata('msg', 'Einvoice Cancelled Successfully');
					redirect('invoice/view');
				} else {
					$this->session->set_flashdata('msg', 'Einvoice Cancelled UnSuccessfully');
					redirect('invoice/view');
				}
			}
		}


		public function generate($result, $profile, $token)
		{
			foreach ($result as $r)

				$statecode = $this->db->select('stateCode')->where('state', $profile->stateCode)->get('statecode')->row()->stateCode;

			$stateid = $this->db->where('id', $r['customerId'])->get('customer_details')->row();

			$billtype = $this->db->select('bill_type')->where('status', 1)->get('preference_settings')->row()->bill_type;


			$date = date('d/m/Y', strtotime($r['date']));
			$mainquantity = [];
			$mainrate = [];

			$cgstAmounts = 0;
			$sgstAmounts = 0;
			$igstAmounts = 0;

			$cgstAmount = 0;
			$sgstAmount = 0;
			$igstAmount = 0;
			$subTotal   = 0;

			if ($billtype == 'Overall Tax') {
				foreach ($result as $res) {

					$hsnno = explode('||', $res['hsnno']);
					$qty = explode('||', $res['qty']);
					$uom = explode('||', $res['uom']);
					$rate = explode('||', $res['rate']);
					$amount = explode('||', $res['amount']);
					$taxamount = explode('||', $res['taxableamount']);
					$discountamount = explode('||', $res['discountamount']);
					$itemname = explode('||', $res['itemname']);
					$count = count($itemname);


					$no = 0;
					for ($i = 0; $i < $count; $i++) {


						if ($r['gsttype'] == "intrastate") {

							$amt = $taxamount[$i];

							$tax = $res['igst'];

							$gst = ($amt * $tax) / 100;
							$sgsts = $gst / 2;
							$total = $amt + $gst;




							$cgstAmounts = (int)$sgsts;
							$sgstAmounts = (int)$sgsts;
							$igstAmounts = 0;
						} else {

							$amt = $taxamount[$i];

							$tax = $res['igst'];

							$gst = ($amt * $tax) / 100;
							$total = $amt + $gst;



							$cgstAmounts = 0;
							$sgstAmounts = 0;
							$igstAmounts = (int)$gst;
						}

						$no = $no + 1;
						$quanty = [
							"SlNo" => (string)$no,
							"IsServc" => "N",
							"HsnCd" => $hsnno[$i],
							"Qty" => (int)$qty[$i],
							"Unit" => $uom[$i],
							"UnitPrice" => (int)$rate[$i],
							"TotAmt" => (int)$amount[$i],
							"Discount" => (int)$discountamount[$i],
							"AssAmt" => (int)$amount[$i],
							"GstRt" => (int)$res['igst'],
							"SgstAmt" => $sgstAmounts,
							"IgstAmt" => $igstAmounts,
							"CgstAmt" => $cgstAmounts,
							"TotItemVal" => (int)$total,

						];
						array_push($mainquantity, $quanty);
					}
				}
			} else {
				foreach ($result as $res) {

					$hsnno = explode('||', $res['hsnno']);
					$qty = explode('||', $res['qty']);
					$uom = explode('||', $res['uom']);
					$rate = explode('||', $res['rate']);
					$amount = explode('||', $res['amount']);
					$taxamount = explode('||', $res['taxableamount']);
					$discountamount = explode('||', $res['discountamount']);
					$itemname = explode('||', $res['itemname']);
					$igst = explode('||', $res['igst']);
					$cgstamount = explode('||', $res['cgstamount']);
					$sgstamount = explode('||', $res['sgstamount']);
					$igstamount = explode('||', $res['igstamount']);
					$total = explode('||', $res['total']);
					$count = count($itemname);
					$no = 0;
					for ($i = 0; $i < $count; $i++) {

						if ($r['gsttype'] == "intrastate") {


							$cgstAmounts = $cgstamount[$i];
							$sgstAmounts  = $sgstamount[$i];
							$igstAmounts = 0;
						} else {
							$igstAmounts = $igstamount[$i];
							$cgstAmounts = 0;
							$sgstAmounts = 0;
						}


						$no = $no + 1;
						$quanty = [
							"SlNo" => (string)$no,
							"IsServc" => "N",
							"HsnCd" => $hsnno[$i],
							"Qty" => (int)$qty[$i],
							"Unit" => $uom[$i],
							"UnitPrice" => (int)$rate[$i],
							"TotAmt" => (int)$amount[$i],
							"Discount" => (int)$discountamount[$i],
							"AssAmt" => (int)$amount[$i],
							"GstRt" => (int)$igst[$i],
							"SgstAmt" => $sgstAmounts,
							"IgstAmt" => $igstAmounts,
							"CgstAmt" => $cgstAmounts,
							"TotItemVal" => (int)$total[$i],
						];
						array_push($mainquantity, (object)$quanty);
						//   array_push($mainrate, (object)$rate);
					}
				}
			}

			if ($r['gsttype'] == "intrastate") {
				foreach ($result as $tax) {
					if ($billtype == 'Overall tax') {
						$cgstAmount = $tax['cgstamount'];
						$sgstAmount = $tax['sgstamount'];
						$igstAmount = 0;
						$subTotal   = $tax['subtotal'];
					} else {
						$itemnames  = explode('||', $res['itemname']);
						$cgstamounts = explode('||', $tax['cgstamount']);
						$sgstamounts = explode('||', $tax['sgstamount']);
						$igstamounts = explode('||', $tax['igstamount']);
						$subtotals   = explode('||', $tax['taxableamount']);


						$count = count($itemnames);
						for ($i = 0; $i < $count; $i++) {
							$c_amount  = $cgstamounts[$i];
							$s_amount  = $sgstamounts[$i];
							$sb_amount = $subtotals[$i];


							$cgstAmount += $c_amount;
							$sgstAmount += $s_amount;
							$subTotal   += $sb_amount;
							$igstAmount = 0;
						}
					}
				}
			} else {
				foreach ($result as $tax) {
					if ($billtype == 'Overall tax') {
						$cgstAmount = 0;
						$sgstAmount = 0;
						$igstAmount = $tax['igstamount'];
						$subTotal   = $tax['subtotal'];
					} else {
						$itemnames = explode('||', $res['itemname']);
						$cgstamounts = explode('||', $tax['cgstamount']);
						$sgstamounts = explode('||', $tax['sgstamount']);
						$igstamounts = explode('||', $tax['igstamount']);

						$subtotals = explode('||', $tax['amount']);

						$count = count($itemnames);

						$igstAmount = 0; // Initialize igstAmount variable
						$subTotal = 0; // Initialize subTotal variable

						for ($j = 0; $j < $count; $j++) {
							$i_amount = $igstamounts[$j];

							$sb_amount = $subtotals[$j];

							$cgstAmount = 0;
							$sgstAmount = 0;

							$igstAmount += $i_amount;


							$subTotal += $sb_amount;
						}
					}
				}
			}


			$jayParsedAry = [
				"Version" => "1.1",
				"TranDtls" => [
					"TaxSch" => "GST",
					"SupTyp" => "B2B",

					"EcmGstin" => null,
					"IgstOnIntra" => "N"
				],
				"DocDtls" => [
					"Typ" => "INV",
					"No" => $r['invoiceno'],
					"Dt" => $date
				],
				"SellerDtls" => [
					"Gstin" => $profile->gstin,
					"LglNm" => $profile->companyname,

					"Addr1" => $profile->address1,
					"Addr2" => $profile->address2,
					"Loc" => $profile->city,
					"Pin" => (int)$profile->pincode,
					"Stcd" => $statecode,
					// 	  "Ph" => $profile->phoneno, 
					// 	  "Em" => $profile->emailid 
				],
				"BuyerDtls" => [
					"Gstin" => $stateid->gstno,
					"LglNm" => $r['customername'],
					"Pos" => $stateid->statecode,
					"Addr1" => $stateid->address1,
					"Addr2" => $stateid->address2,
					"Loc" => $stateid->city,
					"Pin" => (int)$stateid->pincode,
					"Stcd" => $stateid->statecode,
					// 		 "Ph" => $stateid->phoneno, 
					// 		 "Em" => $stateid->email 
				],


				"ItemList" => $mainquantity,



				"ValDtls" => [


					"AssVal" => number_format((float)$subTotal, 2, '.', ''),
					"CgstVal" => $cgstAmount,
					"SgstVal" => $sgstAmount,
					"IgstVal" => number_format((float)$igstAmount, 2, '.', ''),
					"OthChrg" => 0,
					"RndOffAmt" => 0,
					"TotInvVal" => (int)$r['grandtotal']

				],

				"AddlDocDtls" => [
					[
						"Url" => "https://einv-apisandbox.nic.in",
						"Docs" => "Test Doc",
						"Info" => "Document Test"
					]
				],

			];


			$url = "https://api.mastergst.com/einvoice/type/GENERATE/version/V1_03?email=jp@idreamdevelopers.com";

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
				"accept: */*",
				"ip_address: 103.224. 35.181",
				"client_id: e05ac7b6-ddcf-4294-80d4-453827fba2cf",
				"client_secret: 1c1ade41-e062-499d-be41-1d89a1b29de2",
				"username: mastergst",
				"auth-token: $token",
				"gstin: 29AABCT1332L000",
				"Content-Type: application/json",
			);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			// 		print_r($jayParsedAry);die;

			$data = json_encode($jayParsedAry);

			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

			//for debug only!
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			$resp = curl_exec($curl);
			curl_close($curl);
			print_r($resp);
			die;
			return $resp;
		}


		public function generateeway($datas, $profiles, $token)
		{

			foreach ($datas as $d) {

				$statecode = $this->db->select('stateCode')->where('state', $profiles->stateCode)->get('statecode')->row()->stateCode;

				$stateid = $this->db->where('id', $d['customerId'])->get('customer_details')->row();
				$date =  date('d/m/Y', strtotime($d['date']));
				$irn = $d['irn'];
				$distance = $d['distance'];
				// $transid = $profiles[0]->transid;
				// $transname = $profiles[0]->transname;
				$docno     = $d['invoiceno'];
				$docdate   = $date;
				$vechno    = $d['vehicleno'];
			}

			$ewayArray = [

				"Irn" => $irn,
				"Distance" => $distance,
				"TransMode" => "1",
				//  "TransId" =>"12AWGPV7107B1Z1",
				//  "TransName"=>"trans name",
				"TransDocDt" => $date,
				"TransDocNo" => $docno,
				"VehNo" => $vechno,
				"VehType" => "R",

				"ExpShipDtls" => [
					"Addr1" => $stateid->address1,
					"Addr2" => $stateid->address2,
					"Loc" => $stateid->city,
					"Pin" => (int)$stateid->pincode,
					"Stcd" => $stateid->statecode,

				],

				"DispDtls" => [
					"Nm" => $d['customername'],
					"Addr1" => $stateid->address1,
					"Addr2" => $stateid->address2,
					"Loc" => $stateid->city,
					"Pin" => (int)$stateid->pincode,
					"Stcd" => $stateid->statecode,

				],

			];

			$url = "https://api.mastergst.com/einvoice/type/GENERATE_EWAYBILL/version/V1_03?email=jp@idreamdevelopers.com";

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
				"accept: */*",
				"email:jp@idreamdevelopers.com",
				"ip_address: 103.224. 35.181",
				"client_id: e05ac7b6-ddcf-4294-80d4-453827fba2cf",
				"client_secret: 1c1ade41-e062-499d-be41-1d89a1b29de2",
				"username: mastergst",
				"auth-token: $token",
				"gstin: 29AABCT1332L000",
				"Content-Type: application/json",
			);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			$data = json_encode($ewayArray);

			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

			//for debug only!
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			$resp = curl_exec($curl);

			curl_close($curl);
			return $resp;
		}


		public function cancel($results, $token)
		{
			foreach ($results as $r) {
				$irn = $r['irn'];
			}


			$cancelinvoice = [
				"Irn"    => $irn,
				"CnlRsn" =>  "1",
				"CnlRem" => "Wrong entry"
			];


			$url = "https://api.mastergst.com/einvoice/type/CANCEL/version/V1_03?email=jp@idreamdevelopers.com";

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
				"accept:*/*",
				"email:jp@idreamdevelopers.com",
				"ip_address:103.224.35.181",
				"client_id: e05ac7b6-ddcf-4294-80d4-453827fba2cf",
				"client_secret: 1c1ade41-e062-499d-be41-1d89a1b29de2",
				"username: mastergst",
				"auth-token: $token",
				"gstin: 29AABCT1332L000",
				"Content-Type: application/json",
			);

			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

			$data = json_encode($cancelinvoice);


			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

			//for debug only!
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			$resp = curl_exec($curl);
			curl_close($curl);

			return $resp;
		}



		public function generate_invoice_qr_code()
		{
			$invoice_data = "eyJhbGciOiJSUzI1NiIsImtpZCI6IjE1MTNCODIxRUU0NkM3NDlBNjNCODZFMzE4QkY3MTEwOTkyODdEMUYiLCJ4NXQiOiJGUk80SWU1R3gwbW1PNGJqR0w5eEVKa29mUjgiLCJ0eXAiOiJKV1QifQ.eyJkYXRhIjoie1wiU2VsbGVyR3N0aW5cIjpcIjI5QUFCQ1QxMzMyTDAwMFwiLFwiQnV5ZXJHc3RpblwiOlwiMzNBRFhQVDMyOTFOMlpKXCIsXCJEb2NOb1wiOlwiSU5WLzIzLTI0Ly0wNTdcIixcIkRvY1R5cFwiOlwiSU5WXCIsXCJEb2NEdFwiOlwiMDQvMDgvMjAyM1wiLFwiVG90SW52VmFsXCI6MjM2MCxcIkl0ZW1DbnRcIjoxLFwiTWFpbkhzbkNvZGVcIjpcIjcyMDRcIixcIklyblwiOlwiZTI2ZmJlMTc1ZTcxYzc3MzAxNzU2NWExZGQ2MmZkYjIxMDI3MDdhYWE2Yjc4MzBjMmU0YzNkZjZhOTZjOTdiM1wiLFwiSXJuRHRcIjpcIjIwMjMtMDgtMDQgMTU6NTc6MDBcIn0iLCJpc3MiOiJOSUMgU2FuZGJveCJ9.KBNENzjnvH3f8jLotjZDWTrQ-twsSXjDAdwPi2lxxHHvs0CpvTSiHS_O1zcAqB-2-55Xg1UOxyJ2yfUqNjwTPoSyrGPHfLWB1C0wUXGiiiBNNG64NFDlzoNzbyUpJ1NRdTIAdOTXri3bdtwlNqNKBD817ChkW0-DKm2xBV7feZh3J5j4v93WEljlD2Mftm3tbOsEhGS6L5CEwttgvOUM0uKbccetatHEaL3ABmgDMZO94MG0w6QyUegOj7QIJ6H_k9CPmCl5u5ImVW8GY_HD-yi_H_4M4aqJym5On1kGpPFHwu6eT0zyh2zStav7JiG0QAIPJdTvhABv_aTsKWUtrA";
			$this->load->helper('qr_code_helper');
			$qr_code_url = generate_qr_code($invoice_data);
			$data['qr_code_url'] = $qr_code_url;
			$this->load->view('invoice_qr_code_view', $data);
		}
	}

	ob_flush();

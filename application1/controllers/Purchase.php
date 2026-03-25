<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Purchase extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('purchase_model');
        if ($this->session->userdata('rcbio_login') == '') {
            $this->session->set_flashdata('msg', 'Please Login to continue!');
            redirect('login');
        }
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index()
    {

     $prefs   = $this->db->where('id', 1)->get('preference_settings')->row();
$prefix  = $prefs->purchasePrefix;  
$current = $prefs->purchase;      

if ($current == "" || $current == null) {

    $last = $this->db->select('purchaseno')
        ->order_by('id', 'DESC')
        ->limit(1)
        ->get('purchase_details')
        ->row();

    if ($last) {
        $parts = explode('/', $last->purchaseno);
        $lastNum = (int) end($parts);  // ✅ get only 004
        $num = $lastNum + 1;
    } else {
        $num = 1;
    }

} else {
    $num = (int)$current;  
}

$data['invoiceno'] = $prefix . sprintf('%03d', $num);

        $this->load->view('header');
        $this->load->view('add_purchase', $data);
        $this->load->view('footer');
    }

    public function insert()
    {
        $grandtotal = $_POST['grandtotal'];
        $customerid = $_POST['supplierid'];

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
            $balanceamount = ($openingbalance + $grandtotal) - (float)$paidamounts;
        }
        if ($salesamounts == '') {
            $salesamount = $grandtotal;
        } else {
            $salesamount = $salesamounts + $grandtotal;
        }

        $datass = array('salesamount' => $salesamount, 'balanceamount' => $balanceamount);
        $this->db->where('id', $customerid)->update('customer_details', $datass);

        // ========== FILTER EMPTY ROWS ==========
        $validRows = [];
        $itemCount = count($_POST['itemcode'] ?? []);

        for ($i = 0; $i < $itemCount; $i++) {
            // Check if row has essential data (qty and heatno)
            $qty = $_POST['qty'][$i] ?? '';
            $heatno = $_POST['heatno'][$i] ?? '';

            // If both qty and heatno are empty, skip this row
            if (empty($qty) && empty($heatno)) {
                continue;
            }

            // Add valid row data
            $validRows[] = [
                'hsnno' => $_POST['hsnno'][$i] ?? '',
                'heatno' => $heatno,
                'itemid' => $_POST['itemid'][$i] ?? '',
                'itemcode' => $_POST['itemcode'][$i] ?? '',
                'grade' => $_POST['grade'][$i] ?? '',
                'itemname' => $_POST['itemname'][$i] ?? '',
                'qty' => $qty,
                'uom' => $_POST['uom'][$i] ?? '',
                'weight' => $_POST['weight'][$i] ?? '',
                'rate' => $_POST['rate'][$i] ?? '',
                'amount' => $_POST['amount'][$i] ?? '',
                'discount' => $_POST['discount'][$i] ?? '',
                'discountamount' => $_POST['discountamount'][$i] ?? '',
                'taxableamount' => $_POST['taxableamount'][$i] ?? '',
                'cgst' => $_POST['cgst'][$i] ?? '',
                'cgstamount' => $_POST['cgstamount'][$i] ?? '',
                'sgst' => $_POST['sgst'][$i] ?? '',
                'sgstamount' => $_POST['sgstamount'][$i] ?? '',
                'igst' => $_POST['igst'][$i] ?? '',
                'igstamount' => $_POST['igstamount'][$i] ?? '',
                'total' => $_POST['total'][$i] ?? '',
                'inwNo' => $_POST['inwNo'][$i] ?? '',
                'purchaseorder' => $_POST['purchaseorder'][$i] ?? '',
                'poRecordId' => $_POST['poRecordId'][$i] ?? '',
                'priceType' => $_POST['priceType'][$i] ?? ''
            ];
        }

        // If no valid rows, return error
        if (empty($validRows)) {
            $this->session->set_flashdata('msg1', 'No valid purchase items to save');
            redirect('purchase');
        }

        // Prepare data for implode from valid rows only
        $hsnno = implode('||', array_column($validRows, 'hsnno'));
        $heatno = implode('||', array_column($validRows, 'heatno'));
        $itemid = implode('||', array_column($validRows, 'itemid'));
        $itemcode = implode('||', array_column($validRows, 'itemcode'));
        $grade = implode('||', array_column($validRows, 'grade'));
        $itemname = implode('||', array_column($validRows, 'itemname'));
        $qty = implode('||', array_column($validRows, 'qty'));
        $uom = implode('||', array_column($validRows, 'uom'));
        $weight = implode('||', array_column($validRows, 'weight'));
        $rate = implode('||', array_column($validRows, 'rate'));
        $amount = implode('||', array_column($validRows, 'amount'));
        $discount = implode('||', array_column($validRows, 'discount'));
        $discountamount = implode('||', array_column($validRows, 'discountamount'));
        $taxableamount = implode('||', array_column($validRows, 'taxableamount'));
        $cgst = implode('||', array_column($validRows, 'cgst'));
        $cgstamount = implode('||', array_column($validRows, 'cgstamount'));
        $sgst = implode('||', array_column($validRows, 'sgst'));
        $sgstamount = implode('||', array_column($validRows, 'sgstamount'));
        $igst = implode('||', array_column($validRows, 'igst'));
        $igstamount = implode('||', array_column($validRows, 'igstamount'));
        $total = implode('||', array_column($validRows, 'total'));

        $inwNoStr = implode('||', array_column($validRows, 'inwNo'));
        $purchaseorderStr = implode('||', array_column($validRows, 'purchaseorder'));
        $poRecordIdStr = implode('||', array_column($validRows, 'poRecordId'));

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
        $purchasenoyear = $_POST['purchaseno'] . '' . date('-Y') . '';
        $purchasenodate = $_POST['purchaseno'] . '' . date('dmy') . '';

        $pcode = array_column($validRows, 'hsnno');
        $count7 = count($pcode);
        for ($i = 0; $i < $count7; $i++) {
            $res[] = "0";
            $ret[] = "1";
        }

        $billtype = $_POST['gsttype'];
        if ($billtype == 'intrastate') {
            $sgst = implode('||', array_column($validRows, 'sgst'));
            $cgst = implode('||', array_column($validRows, 'cgst'));
            $igst = implode('||', array_column($validRows, 'igst'));
            $sgstamount = implode('||', array_column($validRows, 'sgstamount'));
            $cgstamount = implode('||', array_column($validRows, 'cgstamount'));
            $igstamount = implode('||', array_column($validRows, 'igstamount'));
            $sgsts = 'sgst';
            $cgsts = 'cgst';
            $igsts = '';
        }

        if ($billtype == 'interstate') {
            $sgst = implode('||', array_column($validRows, 'sgst'));
            $cgst = implode('||', array_column($validRows, 'cgst'));
            $igst = implode('||', array_column($validRows, 'igst'));
            $sgstamount = implode('||', array_column($validRows, 'sgstamount'));
            $cgstamount = implode('||', array_column($validRows, 'cgstamount'));
            $igstamount = implode('||', array_column($validRows, 'igstamount'));
            $igsts = 'igst';
            $sgsts = '';
            $cgsts = '';
        }

        $data = array(
            'date' => date('Y-m-d'),
            'purchasedate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
            'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
            'purchaseno' => $_POST['purchaseno'],
            'supplierId' => $customerid,
            'suppliername' => $_POST['suppliername'],
            'address' => $_POST['address'],
            'invoiceno' => $_POST['invoiceno'],
            'purchaseorderno' => $inwNoStr,
            'purchaseorder' => $purchaseorderStr,
            'poRecordId' => $poRecordIdStr,
            'billtype' => $_POST['gsttype'],
            'gsttype' => $_POST['gsttype'],
            'purchasetype' => $_POST['purchasetype'],
            'typesgst' => $sgsts,
            'typecgst' => $cgsts,
            'typeigst' => $igsts,
            'hsnno' => $hsnno,
            'heatno' => $heatno,
            'itemid' => $itemid,
            'itemcode' => $itemcode,
            'itemname' => $itemname,
            'uom' => $uom,
            'grade' => $grade,
            'weight' => $weight,
            'rate' => $rate,
            'qty' => $qty,
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
            'balance' => $grandtotal,
            'vou_status' => 1,
            'edit_status' => 1
        );

        //  echo '<pre>';
        // print_r($data);die;

        $result = $this->db->insert('purchase_details', $data);
        if ($result == true) {

            $purchaseid = $this->db->insert_id();
            $this->db->query("UPDATE preference_settings SET purchase='' WHERE id=1");
            if (!empty($inwNoStr)) {
                // Split the string into individual purchase order numbers
                $purchaseOrderNumbers = explode('||', $inwNoStr);

                // Remove duplicates and empty values
                $uniquePurchaseOrders = array_unique(array_filter($purchaseOrderNumbers));

                // Update each purchase order
                foreach ($uniquePurchaseOrders as $purchaseOrderNo) {
                    if (!empty(trim($purchaseOrderNo))) {
                        $this->db->where('purchaseorderno', trim($purchaseOrderNo))
                            ->update('sup_purchaseorder_details', ['edit_status' => 2]);
                    }
                }
            }
            // Use validRows for stock operations
            foreach ($validRows as $row) {
                $data = $this->db->where('itemcode', $row['itemcode'])
                    ->where('hsnno', $row['hsnno'])
                    ->where('heatno', $row['heatno'])
                    ->get('stock')
                    ->result();

                foreach ($data as $v) {
                    $bal = $v->balance;
                }

                if ($data) {
                    $this->db->where('itemcode', $row['itemcode'])
                        ->where('hsnno', $row['hsnno'])
                        ->where('heatno', $row['heatno'])
                        ->update(
                            'stock',
                            array(
                                'updatestock' => $row['qty'],
                                'stockdate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
                                'quantity' => $row['qty'],
                                'heatno' => $row['heatno'],
                                'itemid' => $row['itemid'],
                                'hsnno' => $row['hsnno'],
                                'itemcode' => $row['itemcode'],
                                'sgst' => $row['sgst'],
                                'cgst' => $row['cgst'],
                                'igst' => $row['igst'],
                                'date' => date('Y-m-d'),
                                'balance' => intval($bal) + intval($row['qty'])
                            )
                        );

                    $this->db->insert(
                        'stock_reports',
                        array(
                            'hsnno' => $row['hsnno'],
                            'itemcode' => $row['itemcode'],
                            'heatno' => $row['heatno'],
                            'itemid' => $row['itemid'],
                            'date' => date('Y-m-d'),
                            'itemname' => $row['itemname'],
                            'purchaseid' => $purchaseid,
                            'updatestock' => $row['qty'],
                            'priceType' => $row['priceType']
                        )
                    );
                } else {
                    $this->db->insert(
                        'stock',
                        array(
                            'hsnno' => $row['hsnno'],
                            'heatno' => $row['heatno'],
                            'itemid' => $row['itemid'],
                            'itemcode' => $row['itemcode'],
                            'stockdate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
                            'date' => date('Y-m-d'),
                            'itemname' => $row['itemname'],
                            'sgst' => $row['sgst'],
                            'cgst' => $row['cgst'],
                            'igst' => $row['igst'],
                            'quantity' => $row['qty'],
                            'rate' => $row['rate'],
                            'priceType' => $row['priceType'],
                            'updatestock' => $row['qty'],
                            'balance' => $row['qty']
                        )
                    );

                    $this->db->insert(
                        'stock_reports',
                        array(
                            'stockdate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
                            'purchaseid' => $purchaseid,
                            'date' => date('Y-m-d'),
                            'itemname' => $row['itemname'],
                            'hsnno' => $row['hsnno'],
                            'heatno' => $row['heatno'],
                            'itemid' => $row['itemid'],
                            'itemcode' => $row['itemcode'],
                            'updatestock' => $row['qty'],
                            'priceType' => $row['priceType']
                        )
                    );
                }
            }

            // Use validRows for purchase_reports
            foreach ($validRows as $row) {
                $podatass = array(
                    'date' => date('Y-m-d'),
                    'purchasedate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
                    'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
                    'purchaseno' => $_POST['purchaseno'],
                    'supplierId' => $customerid,
                    'suppliername' => $_POST['suppliername'],
                    'invoiceno' => $_POST['invoiceno'],
                    'purchaseorderno' => $row['inwNo'],
                    'purchaseorder' => $row['purchaseorder'],
                    'poRecordId' => $row['poRecordId'],
                    'itemname' => $row['itemname'],
                    'rate' => $row['rate'],
                    'grade' => $row['grade'],
                    'qty' => $row['qty'],
                    'total' => $row['total'],
                    'hsnno' => $row['hsnno'],
                    'heatno' => $row['heatno'],
                    'weight' => $row['weight'],
                    'itemid' => $row['itemid'],
                    'itemcode' => $row['itemcode'],
                    'address' => $_POST['address'],
                    'subtotal' => $_POST['subtotal'],
                    'grandtotal' => $_POST['grandtotal'],
                    'purchasenodate' => $purchasenodate,
                    'purchasenoyear' => $purchasenoyear,
                    'purchaseid' => $purchaseid,
                    'status' => 1,
                    'create_mtc_status' => 1,
                );
                $this->db->insert('purchase_reports', $podatass);
            }


            @$receiptno = '-';
            @$paymentdetails = '-';
            @$paymentmodes = '-';
            @$throughchecks = '-';
            @$banktransfers = '-';
            @$chamounts = '-';
            @$bankamounts = '-';
            @$purpose = '-';
            @$amount = '-';
            @$chequeno = '-';

            $dd = array(
                'date' => date('Y-m-d', strtotime($_POST['invoicedate'])),
                'receiptno' => $receiptno,
                'purchaseno' => $_POST['purchaseno'],
                'supplierId' => $customerid,
                'suppliername' => $_POST['suppliername'],
                'payment' => $paymentdetails,
                'purchasedate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
                'itemname' => $itemname,
                'amount' => $total,
                'purpose' => $purpose,
                'chamount' => $chamounts,
                'banktransfer' => $banktransfers,
                'bankamount' => $bankamounts,
                'chequeno' => $chequeno,
                'throughcheck' => $throughchecks,
                'paymentdetails' => $paymentdetails,
                'total' => $_POST['grandtotal'],
                'paid' => $paymentmodes,
                'paidamount' => $paymentdetails,
                'currentpaid' => $paymentdetails,
                'receiptamt' => $paymentdetails,
                'balance' => $balanceamount,
                'purchaseamt' => $_POST['grandtotal'],
                'invoiceno' => $_POST['invoiceno'],
                'purchasenodate' => $purchasenodate,
                'purchasenoyear' => $purchasenoyear,
                'purchaseid' => $purchaseid,
                'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
                'status' => 1
            );

            $this->db->insert('po_party_statements', $dd);

            $purchasetype = $this->input->post('purchasetype');
            if ($purchasetype == 'purchase Order') {
                $itemname = $this->input->post('itemname');
                $itemcode = $this->input->post('itemcode');
                $qty = $this->input->post('qty');
                $balanceqty = $this->input->post('balaceqty');
                $poRecordIds = $this->input->post('poRecordId'); // Get the specific record IDs

                $count = count($itemname);

                for ($j = 0; $j < $count; $j++) {
                    $recordId = $poRecordIds[$j];
                    $currentQty = $qty[$j];

                    if ($recordId) {
                        // Get the current record
                        $currentPO = $this->db->where('id', $recordId)
                            ->get('sup_purchaseorder_reports')
                            ->row_array();

                        if ($currentPO) {
                            $newBalanceQty = intval($currentPO['balaceqty']) - intval($currentQty);
                            if ($newBalanceQty < 0) {
                                $newBalanceQty = 0; // Prevent negative balance
                            }

                            $status = ($newBalanceQty == 0) ? 0 : 1;

                            $datas = array(
                                'balaceqty' => $newBalanceQty,
                                // 'status' => $status
                            );

                            // Update the specific record by its ID
                            $this->db->where('id', $recordId);
                            $this->db->update('sup_purchaseorder_reports', $datas);
                        }
                    }
                }
            }

            $this->session->set_flashdata('msg', 'Purchase Added Successfully');
            redirect('purchase');
        } else {
            $this->session->set_flashdata('msg1', 'Purchase Added Unsuccessfully');
            redirect('purchase');
        }
    }
    public function view()
    {
        $data['purchase'] = $this->purchase_model->select();
        $data['vat'] = $this->db->get('vat_details')->result_array();
        $this->load->view('header');
        $this->load->view('purchase_view', $data);
        $this->load->view('footer1');
    }

    public function views()
    {
        $id = base64_decode($this->uri->segment(3));
        $data['result'] = $this->db->where('id', $id)->get('purchase_details')->result_array();
        $this->load->view('header');
        $this->load->view('view_purchase', $data);
        $this->load->view('footer');
    }

    public function ajax_list()
    {
        $list = $this->purchase_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $i = 1;
        foreach ($list as $person) {
            $startTimeStamp = strtotime($person->invoicedate);
            $endTimeStamp = strtotime(date('Y-m-d'));
            $timeDiff = abs($endTimeStamp - $startTimeStamp);
            $numberDays = $timeDiff / 86400;  // 86400 seconds in one day
            $numberDays = intval($numberDays);

            $no++;
            $row = array();
            $row[] = $i++;
            $row[] = date('d-m-Y', strtotime($person->invoicedate));
            $row[] = $person->purchaseno;
            $row[] = $person->invoiceno;
            $row[] = $person->suppliername;
            $row[] = $numberDays . ' Days';
            $row[] = $person->grandtotal;
            $code = base64_encode($person->id);
            //add html for action
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

                    <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('purchase/views/' . $code) . '" title="View" >View</a></li>
                    <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('purchase/edit/' . $code) . '" title="Edit" >Edit</a></li>

                    <li>' . $deleteOptn . '</li>
                    </ul>
                    </div>
                    ';
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

                    <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('purchase/views/' . $code) . '" title="View" >View</a></li>
                    <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="' . base_url('purchase/edit/' . $code) . '" title="Edit" >Edit</a></li>
                    <li>' . $deleteOptn . '</li>
                    </ul>
                    </div>
                    ';
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->purchase_model->count_all(),
            "recordsFiltered" => $this->purchase_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_delete($id)
    {
        $this->purchase_model->delete_by_id($id);
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

            $vob['itemcode'] = $h->itemcode;
            $vob['price'] = $h->price;
            $vob['priceType'] = $h->priceType;
            $vob['sgst'] = $h->sgst;
            $vob['cgst'] = $h->cgst;
            $vob['igst'] = $h->igst;
            $vob['uom'] = $uom;
            $vob['drawingno'] = $h->drawingno;
            $vob['weight'] = $h->casting_weight;
            $vob['itemid'] = $h->id;
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

            $vob['itemname'] = $h->itemname;
            $vob['price'] = $h->price;
            $vob['priceType'] = $h->priceType;
            $vob['sgst'] = $h->sgst;
            $vob['cgst'] = $h->cgst;
            $vob['igst'] = $h->igst;
            $vob['uom'] = $uom;
            $vob['drawingno'] = $h->drawingno;
            $vob['weight'] = $h->casting_weight;
        }
        echo json_encode($vob);
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


    public function edit()

    {

        $id = base64_decode($this->uri->segment(3));
        $data['result'] = $this->db->where('id', $id)->get('purchase_details')->result_array();
        // echo"<prE>";
        // print_r($data['result']);
        $this->load->view('header');
        $this->load->view('purchase_edit', $data);
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
    public function autocomplete_invoiceno1()
    {
        $name = $this->input->post('keyword');
        $this->db->select('*');
        $this->db->from('purchase_details');
        $this->db->like('invoiceno', $name);
        $query = $this->db->get();
        $result = $query->result();
        $name       =  array();
        foreach ($result as $d) {
            $json_array             = array();
            $json_array['value']    = $d->invoiceno;
            $json_array['label']    = $d->invoiceno;
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




    // public function edit()
    // {


    //       $data['vat']=$this->db->get('vat_details')->result_array(); 

    //   $id=base64_decode($this->uri->segment(3));

    //     $data['edit']=$this->purchase_model->invoice_edit($id);
    //     $this->load->view('header');
    //     $this->load->view('edit_invoice',$data);
    //        $this->load->view('footer');


    // }

    public function update()
    {

        $id = $this->input->post('id');
        $getpurchase = $this->db->where('id', $id)->get('purchase_details')->result();
        foreach ($getpurchase as $getp)
            $grandtotals = $getp->grandtotal;

        $ite = explode('||', $getp->itemname);
        $qtyss = explode('||', $getp->qty);
        $hsnnos = explode('||', $getp->hsnno);
        $itemcodes = explode('||', $getp->itemcode);
        /*$updatableitemName = $_POST['itemname'];
$updatableitemNo = $_POST['hsnno'];
$updatableQty = $_POST['hsnno'];
print_r($updatableitemName);
echo '<hr>';
print_r($updatableitemNo);
exit;
Array ( [0] => let us c [1] => Let Us C++ )
Array ( [0] => 0001 [1] => 0002 )*/
        //

        $count = count($ite);
        for ($i = 0; $i < $count; $i++) {
            $stock = $this->db->where('itemname', $ite[$i])->where('itemcode', $itemcodes[$i])->where('hsnno', $hsnnos[$i])->get('stock')->result_array();
            foreach ($stock as $s) {
                $ite[$i];
                $cur = $s['balance'];
                $tot = $cur - $qtyss[$i];
                $this->db->where('itemname', $ite[$i])->where('itemcode', $itemcodes[$i])->where('hsnno', $hsnnos[$i])->update('stock', array('balance' => $tot));
            }
        }
        //$grandtotal = $_POST['grandtotal'];

        $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
        $data1 = $this->db->where('name', $_POST['suppliername'])->get('customer_details')->result_array();
        foreach ($data1 as $a) {
            $openingbalance = $a['openingbal'];
            $balance = $a['balanceamount'];
            $salesamounts = $a['salesamount'];
        }

        if ($balance) {
            $balanceamount = $balance - $grandtotals;
        } else {
            $balanceamount = '0.00';
        }
        $this->db->where('id', $a['id'])->update('customer_details', array('balanceamount' => $balanceamount));
        $data11 = $this->db->where('id', $a['id'])->get('customer_details')->result_array();
        $grandtotal = $_POST['grandtotal'];
        $customerid = $_POST['supplierid'];
        foreach ($data11 as $a1) {
            $openingbalance = $a1['openingbal'];
            $balance = $a1['balanceamount'];
            $salesamounts = $a1['salesamount'];
        }


        if ($balance) {
            $balanceamount = $balance + $grandtotal;
        } else {
            $balanceamount = $openingbalance + $grandtotal;
        }
        if ($salesamounts == '') {
            $salesamount = $grandtotal;
        } else {
            $salesamount = $salesamounts + $grandtotal;
        }
        $datass = array('salesamount' => $salesamount, 'balanceamount' => $balanceamount);
        $this->db->where('id', $a1['id'])->update('customer_details', $datass);



        $hsnno = implode('||', $_POST['hsnno']);
        $heatno = implode('||', (array) ($_POST['heatno'] ?? []));
        $itemid = implode('||', (array)($_POST['itemid'] ?? []));
        $itemcode = implode('||', (array)($_POST['itemcode'] ?? []));
        $grade = implode('||', (array)($_POST['grade'] ?? []));
        $itemname = implode('||', $this->db->escape_str($_POST['itemname']));
        $qty = implode('||', $_POST['qty']);
        $uom = implode('||', $_POST['uom']);
        $weight = implode('||', $_POST['weight']);
        $rate = implode('||', $_POST['rate']);
        $amount = implode('||', $_POST['amount']);
        @$discount = implode('||', $_POST['discount']);
        @$discountamount = implode('||', $_POST['discountamount']);
        $taxableamount = implode('||', $_POST['taxableamount']);
        $cgst = implode('||', $_POST['cgst']);
        $cgstamount = implode('||', $_POST['cgstamount']);
        $sgst = implode('||', $_POST['sgst']);
        $sgstamount = implode('||', $_POST['sgstamount']);
        @$igst = implode('||', $_POST['igst']);
        @$igstamount = implode('||', $_POST['igstamount']);
        $total = implode('||', $_POST['total']);
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
        $roundOff = $this->input->post('roundOff');
        $othercharges = $this->input->post('othercharges');
        $hiddenDiscountBy = $this->input->post('hiddenDiscountBy');
        $grandtotal = $this->input->post('grandtotal');
        $purchasenoyear = $_POST['purchaseno'] . '' . date('-Y') . '';
        $purchasenodate = $_POST['purchaseno'] . '' . date('dmy') . '';

        $pcode = $_POST['hsnno'];
        $count7 = count($pcode);
        for ($i = 0; $i < $count7; $i++) {
            $res[] = "0";
            $ret[] = "1";
        }

        $billtype = $_POST['gsttype'];
        if ($billtype == 'intrastate') {
            $sgst = implode('||', $_POST['sgst']);
            $cgst = implode('||', $_POST['cgst']);
            $igst = implode('||', $_POST['igst']);
            //$igst = implode('||',$res);
            $sgstamount = implode('||', $_POST['sgstamount']);
            $cgstamount = implode('||', $_POST['cgstamount']);
            $igstamount = implode('||', $_POST['igstamount']);
            //$igstamount = implode('||',$res);
            $sgsts = 'sgst';
            $cgsts = 'cgst';
            $igsts = '';
        }
        if ($billtype == 'interstate') {
            //$sgst =implode('||',$res);
            //$cgst = implode('||',$res);
            $sgst = implode('||', $_POST['sgst']);
            $cgst = implode('||', $_POST['cgst']);
            $igst = implode('||', $_POST['igst']);
            //$sgstamount = implode('||',$res);
            //$cgstamount = implode('||',$res);
            $sgstamount = implode('||', $_POST['sgstamount']);
            $cgstamount = implode('||', $_POST['cgstamount']);
            $igstamount = implode('||', $_POST['igstamount']);
            $igsts = 'igst';
            $sgsts = '';
            $cgsts = '';
        }

        $data = array(
            'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
            'suppliername' => $_POST['suppliername'],
            'supplierId' => $customerid,
            'address' => $_POST['address'],
            'invoiceno' => $_POST['invoiceno'],
            'billtype' => $_POST['gsttype'],
            'gsttype' => $_POST['gsttype'],
            'typesgst' => $sgsts,
            'typecgst' => $cgsts,
            'typeigst' => $igsts,
            'hsnno' => $hsnno,
            'heatno' => $heatno,
            'itemid' => $itemid,
            'itemcode' => $itemcode,
            'itemname' => $itemname,
            'uom' => $uom,
            'grade' => $grade,
            'weight' => $weight,
            'rate' => $rate,
            'qty' => $qty,
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
        $result = $this->db->update('purchase_details', $data);
        // $results=$this->purchase_model->update_invoice($data,$id);
        if ($result) {


            $this->db->where('purchaseid', $id)->delete('purchase_collection');
            $this->db->where('purchaseid', $id)->delete('po_party_statements'); //ok
            $this->db->where('purchaseid', $id)->delete('purchase_reports');
            $this->db->where('purchaseid', $id)->delete('stock_reports');
            //UPDATING STOCK INTO STOCK TABLE AND STOCK_REPORT TABLE
            $purchaseid = $_POST['id'];
            $sparename = $_POST['itemname'];
            $qty = $_POST['qty'];
            $pocode = $_POST['hsnno'];
            $itemcodess = $_POST['itemcode'];
            $heatnos = $_POST['heatno'];
            $weights = $_POST['weight'];
            $itemids = $_POST['itemid'];
            $sgsts = $_POST['sgst'];
            $cgsts = $_POST['cgst'];
            $igsts = $_POST['igst'];
            $priceTypes = $_POST['priceType'];
            $rates = $_POST['rate'];
            $count = count($sparename);
            for ($i = 0; $i <  $count; $i++) {
                @$dt = $this->db->where('itemname', $sparename[$i])->where('itemcode', $itemcodess[$i])->where('hsnno', $pocode[$i])->where('heatno', $heatnos[$i])->get('stock')->result();
                foreach ($dt as $v) {
                    $bal = $v->balance;
                }
                if ($dt) {
                    $this->db->where('itemname', $sparename[$i])->where('itemcode', $itemcodess[$i])->where('hsnno', $pocode[$i])->where('heatno', $heatnos[$i])->update('stock', array('updatestock' => $qty[$i], 'hsnno' => $pocode[$i], 'date' => date('Y-m-d'), 'balance' => $bal + $qty[$i]));
                } else {
                    $this->db->insert(
                        'stock',
                        array(
                            'hsnno' => $pocode[$i],
                            'itemcode' => $itemcodess[$i],
                            'stockdate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
                            'date' => date('Y-m-d'),
                            'itemname' => $sparename[$i],
                            'heatno' => $heatnos[$i],
                            'weight' => $weights[$i],
                            'itemid' => $itemids[$i],
                            'sgst' => $sgsts[$i],
                            'cgst' => $cgsts[$i],
                            'igst' => $igsts[$i],
                            'quantity' => $qty[$i],
                            'rate'    => $rates[$i],
                            'priceType'    => $priceTypes[$i],
                            'updatestock' => $qty[$i],
                            'balance' => $qty[$i]
                        )
                    );
                }
                $this->db->insert(
                    'stock_reports',
                    array(
                        'stockdate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
                        'purchaseid' => $purchaseid,
                        'heatno' => $heatnos[$i],
                        'itemid' => $itemid[$i],
                        'date' => date('Y-m-d'),
                        'itemname' => $sparename[$i],
                        'hsnno' => $pocode[$i],
                        'itemcode' => $itemcodess[$i],
                        'updatestock' => $qty[$i],
                        'priceType'    => $priceTypes[$i]
                    )
                );
            }

            $itemnames = $_POST['itemname'];
            $qtys = $_POST['qty'];
            $heatnos = $_POST['heatno'];
            $itemids = $_POST['itemid'];
            $weights = $_POST['weight'];
            $hsnnoss = $_POST['hsnno'];
            $grades = $_POST['grade'];
            $pscode = $_POST['itemcode'];
            $postItemName = $_POST['itemname'];
            $count = count($postItemName);

            for ($j = 0; $j <  $count; $j++) {

                $podatass = array(
                    'date' => date('Y-m-d'),
                    'purchasedate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
                    'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
                    'purchaseno' => $_POST['purchaseno'],
                    'suppliername' => $_POST['suppliername'],
                    'supplierId' => $customerid,
                    'invoiceno' => $_POST['invoiceno'],
                    'itemname' => $postItemName[$j],
                    'heatno' => $heatnos[$i],
                    'weight' => $weights[$j],
                    'itemid' => $itemids[$i],
                    'rate' => $rate[$j],
                    'grade' => $grades[$j],
                    'qty' => $qty[$j],
                    'total' => $total[$j],
                    'hsnno' => $hsnnoss[$j],
                    'itemcode' => $pscode[$j],
                    'address' => $_POST['address'],
                    'subtotal' => $_POST['subtotal'],
                    'grandtotal' => $_POST['grandtotal'],
                    'purchasenodate' => $purchasenodate,
                    'purchasenoyear' => $purchasenoyear,
                    'purchaseid' => $purchaseid,
                    'status' => 1
                );
                $this->db->insert('purchase_reports', $podatass);
            }

            @$receiptno = '-';
            @$paymentdetails = '-';
            @$paymentmodes = '-';
            @$throughchecks = '-';
            @$banktransfers = '-';
            @$chamounts = '-';
            @$bankamounts = '-';
            @$purpose = '-';
            @$amount = '-';
            @$chequeno = '-';


            $dd = array(
                'date' => date('Y-m-d', strtotime($_POST['invoicedate'])),
                'receiptno' => $receiptno,
                'purchaseno' => $_POST['purchaseno'],
                'suppliername' => $_POST['suppliername'],
                'payment' => $paymentdetails,
                'purchasedate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
                'itemname' => $itemname,
                'amount' => $total,
                'purpose' => $purpose,
                'chamount' => $chamounts,
                'banktransfer' => $banktransfers,
                'bankamount' => $bankamounts,
                'chequeno' => $chequeno,
                'throughcheck' => $throughchecks,
                'paymentdetails' => $paymentdetails,
                'total' => $_POST['grandtotal'],
                'paid' => $paymentmodes,
                'paidamount' => $paymentdetails,
                'currentpaid' => $paymentdetails,
                'receiptamt' => $paymentdetails,
                'balance' => $balanceamount,
                'purchaseamt' => $_POST['grandtotal'],
                'invoiceno' => $_POST['invoiceno'],
                'purchasenodate' => $purchasenodate,
                'purchasenoyear' => $purchasenoyear,
                'purchaseid' => $purchaseid,
                'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
                'status' => 1
            );

            $this->db->insert('po_party_statements', $dd);

            $this->session->set_flashdata('msg', 'Purchase Updated Successfully');
            redirect('purchase/view');
        } else {
            $this->session->set_flashdata('msg1', 'No Changes');
            redirect('purchase/view');
        }
    }

    //     public function update()
    //     {

    //         $id = $this->input->post('id');
    //         $getpurchase = $this->db->where('id', $id)->get('purchase_details')->result();
    //         foreach ($getpurchase as $getp)
    //             $grandtotals = $getp->grandtotal;

    //         $ite = explode('||', $getp->itemname);
    //         $qtyss = explode('||', $getp->qty);
    //         $hsnnos = explode('||', $getp->hsnno);
    //         $itemcodes = explode('||', $getp->itemcode);
    //         /*$updatableitemName = $_POST['itemname'];
    // $updatableitemNo = $_POST['hsnno'];
    // $updatableQty = $_POST['hsnno'];
    // print_r($updatableitemName);
    // echo '<hr>';
    // print_r($updatableitemNo);
    // exit;
    // Array ( [0] => let us c [1] => Let Us C++ )
    // Array ( [0] => 0001 [1] => 0002 )*/
    //         //

    //         $count = count($ite);
    //         for ($i = 0; $i < $count; $i++) {
    //             $stock = $this->db->where('itemname', $ite[$i])->where('itemcode', $itemcodes[$i])->where('hsnno', $hsnnos[$i])->get('stock')->result_array();
    //             foreach ($stock as $s) {
    //                 $ite[$i];
    //                 $cur = $s['balance'];
    //                 $tot = $cur - $qtyss[$i];
    //                 $this->db->where('itemname', $ite[$i])->where('itemcode', $itemcodes[$i])->where('hsnno', $hsnnos[$i])->update('stock', array('balance' => $tot));
    //             }
    //         }
    //         //$grandtotal = $_POST['grandtotal'];

    //         $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
    //         $data1 = $this->db->where('name', $_POST['suppliername'])->get('customer_details')->result_array();
    //         foreach ($data1 as $a) {
    //             $openingbalance = $a['openingbal'];
    //             $balance = $a['balanceamount'];
    //             $salesamounts = $a['salesamount'];
    //         }

    //         if ($balance) {
    //             $balanceamount = $balance - $grandtotals;
    //         } else {
    //             $balanceamount = '0.00';
    //         }
    //         $this->db->where('id', $a['id'])->update('customer_details', array('balanceamount' => $balanceamount));
    //         $data11 = $this->db->where('id', $a['id'])->get('customer_details')->result_array();
    //         $grandtotal = $_POST['grandtotal'];
    //         $customerid = $_POST['supplierid'];
    //         foreach ($data11 as $a1) {
    //             $openingbalance = $a1['openingbal'];
    //             $balance = $a1['balanceamount'];
    //             $salesamounts = $a1['salesamount'];
    //         }


    //         if ($balance) {
    //             $balanceamount = $balance + $grandtotal;
    //         } else {
    //             $balanceamount = $openingbalance + $grandtotal;
    //         }
    //         if ($salesamounts == '') {
    //             $salesamount = $grandtotal;
    //         } else {
    //             $salesamount = $salesamounts + $grandtotal;
    //         }
    //         $datass = array('salesamount' => $salesamount, 'balanceamount' => $balanceamount);
    //         $this->db->where('id', $a1['id'])->update('customer_details', $datass);



    //         $hsnno = implode('||', $_POST['hsnno']);
    //         $heatno = implode('||', (array) ($_POST['heatno'] ?? []));
    //         $itemid = implode('||', (array)($_POST['itemid'] ?? []));
    //         $itemcode = implode('||', (array)($_POST['itemcode'] ?? []));
    //         $grade = implode('||', (array)($_POST['grade'] ?? []));
    //         $itemname = implode('||', $this->db->escape_str($_POST['itemname']));
    //         $qty = implode('||', $_POST['qty']);
    //         $uom = implode('||', $_POST['uom']);
    //         $weight = implode('||', $_POST['weight']);
    //         $rate = implode('||', $_POST['rate']);
    //         $amount = implode('||', $_POST['amount']);
    //         @$discount = implode('||', $_POST['discount']);
    //         @$discountamount = implode('||', $_POST['discountamount']);
    //         $taxableamount = implode('||', $_POST['taxableamount']);
    //         $cgst = implode('||', $_POST['cgst']);
    //         $cgstamount = implode('||', $_POST['cgstamount']);
    //         $sgst = implode('||', $_POST['sgst']);
    //         $sgstamount = implode('||', $_POST['sgstamount']);
    //         @$igst = implode('||', $_POST['igst']);
    //         @$igstamount = implode('||', $_POST['igstamount']);
    //         $total = implode('||', $_POST['total']);
    //         $subtotal = $this->input->post('subtotal');
    //         $freightamount = $this->input->post('freightamount');
    //         $freightcgst = $this->input->post('freightcgst');
    //         $freightcgstamount = $this->input->post('freightcgstamount');
    //         $freightsgst = $this->input->post('freightsgst');
    //         $freightsgstamount = $this->input->post('freightsgstamount');
    //         $freightigst = $this->input->post('freightigst');
    //         $freightigstamount = $this->input->post('freightigstamount');
    //         $freighttotal = $this->input->post('freighttotal');
    //         $loadingamount = $this->input->post('loadingamount');
    //         $loadingcgst = $this->input->post('loadingcgst');
    //         $loadingcgstamount = $this->input->post('loadingcgstamount');
    //         $loadingsgst = $this->input->post('loadingsgst');
    //         $loadingsgstamount = $this->input->post('loadingsgstamount');
    //         $loadingigst = $this->input->post('loadingigst');
    //         $loadingigstamount = $this->input->post('loadingigstamount');
    //         $loadingtotal = $this->input->post('loadingtotal');
    //         $roundOff = $this->input->post('roundOff');
    //         $othercharges = $this->input->post('othercharges');
    //         $hiddenDiscountBy = $this->input->post('hiddenDiscountBy');
    //         $grandtotal = $this->input->post('grandtotal');
    //         $purchasenoyear = $_POST['purchaseno'] . '' . date('-Y') . '';
    //         $purchasenodate = $_POST['purchaseno'] . '' . date('dmy') . '';

    //         $pcode = $_POST['hsnno'];
    //         $count7 = count($pcode);
    //         for ($i = 0; $i < $count7; $i++) {
    //             $res[] = "0";
    //             $ret[] = "1";
    //         }

    //         $billtype = $_POST['gsttype'];
    //         if ($billtype == 'intrastate') {
    //             $sgst = implode('||', $_POST['sgst']);
    //             $cgst = implode('||', $_POST['cgst']);
    //             $igst = implode('||', $_POST['igst']);
    //             //$igst = implode('||',$res);
    //             $sgstamount = implode('||', $_POST['sgstamount']);
    //             $cgstamount = implode('||', $_POST['cgstamount']);
    //             $igstamount = implode('||', $_POST['igstamount']);
    //             //$igstamount = implode('||',$res);
    //             $sgsts = 'sgst';
    //             $cgsts = 'cgst';
    //             $igsts = '';
    //         }
    //         if ($billtype == 'interstate') {
    //             //$sgst =implode('||',$res);
    //             //$cgst = implode('||',$res);
    //             $sgst = implode('||', $_POST['sgst']);
    //             $cgst = implode('||', $_POST['cgst']);
    //             $igst = implode('||', $_POST['igst']);
    //             //$sgstamount = implode('||',$res);
    //             //$cgstamount = implode('||',$res);
    //             $sgstamount = implode('||', $_POST['sgstamount']);
    //             $cgstamount = implode('||', $_POST['cgstamount']);
    //             $igstamount = implode('||', $_POST['igstamount']);
    //             $igsts = 'igst';
    //             $sgsts = '';
    //             $cgsts = '';
    //         }

    //         $data = array(
    //             'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
    //             'suppliername' => $_POST['suppliername'],
    //             'supplierId' => $customerid,
    //             'address' => $_POST['address'],
    //             'invoiceno' => $_POST['invoiceno'],
    //             'billtype' => $_POST['gsttype'],
    //             'gsttype' => $_POST['gsttype'],
    //             'typesgst' => $sgsts,
    //             'typecgst' => $cgsts,
    //             'typeigst' => $igsts,
    //             'hsnno' => $hsnno,
    //             'heatno' => $heatno,
    //             'itemid' => $itemid,
    //             'itemcode' => $itemcode,
    //             'itemname' => $itemname,
    //             'uom' => $uom,
    //             'grade' => $grade,
    //             'weight' => $weight,
    //             'rate' => $rate,
    //             'qty' => $qty,
    //             'amount' => $amount,
    //             'discount' => $discount,
    //             'discountamount' => $discountamount,
    //             'taxableamount' => $taxableamount,
    //             'sgst' => $sgst,
    //             'sgstamount' => $sgstamount,
    //             'cgst' => $cgst,
    //             'cgstamount' => $cgstamount,
    //             'igst' => $igst,
    //             'igstamount' => $igstamount,
    //             'total' => $total,
    //             'subtotal' => $_POST['subtotal'],
    //             'freightamount' => $freightamount,
    //             'freightcgst' => $freightcgst,
    //             'freightcgstamount' => $freightcgstamount,
    //             'freightsgst' => $freightsgst,
    //             'freightsgstamount' => $freightsgstamount,
    //             'freightigst' => $freightigst,
    //             'freightigstamount' => $freightigstamount,
    //             'freighttotal' => $freighttotal,
    //             'loadingamount' => $loadingamount,
    //             'loadingcgst' => $loadingcgst,
    //             'loadingcgstamount' => $loadingcgstamount,
    //             'loadingsgst' => $loadingsgst,
    //             'loadingsgstamount' => $loadingsgstamount,
    //             'loadingigst' => $loadingigst,
    //             'loadingigstamount' => $loadingigstamount,
    //             'loadingtotal' => $loadingtotal,
    //             'roundOff' => $roundOff,
    //             'othercharges' => $othercharges,
    //             'discountBy' => $hiddenDiscountBy,
    //             'return_status' => implode('||', $ret),
    //             'grandtotal' => $grandtotal,
    //             'edit_status' => 1
    //         );
    //         $this->db->where('id', $id);
    //         $result = $this->db->update('purchase_details', $data);
    //         // $results=$this->purchase_model->update_invoice($data,$id);
    //         if ($result) {


    //             $this->db->where('purchaseid', $id)->delete('purchase_collection');
    //             $this->db->where('purchaseid', $id)->delete('po_party_statements'); //ok
    //             $this->db->where('purchaseid', $id)->delete('purchase_reports');
    //             $this->db->where('purchaseid', $id)->delete('stock_reports');
    //             //UPDATING STOCK INTO STOCK TABLE AND STOCK_REPORT TABLE
    //             $purchaseid = $_POST['id'];
    //             $sparename = $_POST['itemname'];
    //             $qty = $_POST['qty'];
    //             $pocode = $_POST['hsnno'];
    //             $itemcodess = $_POST['itemcode'];
    //             $heatnos = $_POST['heatno'];
    //             $weights = $_POST['weight'];
    //             $sgsts = $_POST['sgst'];
    //             $cgsts = $_POST['cgst'];
    //             $igsts = $_POST['igst'];
    //             $priceTypes = $_POST['priceType'];
    //             $rates = $_POST['rate'];
    //             $count = count($sparename);
    //             for ($i = 0; $i <  $count; $i++) {
    //                 @$dt = $this->db->where('itemname', $sparename[$i])->where('itemcode', $itemcodess[$i])->where('hsnno', $pocode[$i])->where('heatno', $heatnos[$i])->get('stock')->result();
    //                 foreach ($dt as $v) {
    //                     $bal = $v->balance;
    //                 }
    //                 if ($dt) {
    //                     $this->db->where('itemname', $sparename[$i])->where('itemcode', $itemcodess[$i])->where('hsnno', $pocode[$i])->where('heatno', $heatnos[$i])->update('stock', array('updatestock' => $qty[$i], 'hsnno' => $pocode[$i], 'date' => date('Y-m-d'), 'balance' => $bal + $qty[$i]));
    //                 } else {
    //                     $this->db->insert(
    //                         'stock',
    //                         array(
    //                             'hsnno' => $pocode[$i],
    //                             'itemcode' => $itemcodess[$i],
    //                             'stockdate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
    //                             'date' => date('Y-m-d'),
    //                             'itemname' => $sparename[$i],
    //                             'heatno' => $heatnos[$i],
    //                             'weight' => $weights[$i],
    //                             'itemid' => $itemid[$i],
    //                             'sgst' => $sgsts[$i],
    //                             'cgst' => $cgsts[$i],
    //                             'igst' => $igsts[$i],
    //                             'quantity' => $qty[$i],
    //                             'rate'    => $rates[$i],
    //                             'priceType'    => $priceTypes[$i],
    //                             'updatestock' => $qty[$i],
    //                             'balance' => $qty[$i]
    //                         )
    //                     );
    //                 }
    //                 $this->db->insert(
    //                     'stock_reports',
    //                     array(
    //                         'stockdate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
    //                         'purchaseid' => $purchaseid,
    //                         'heatno' => $heatnos[$i],
    //                         'itemid' => $itemid[$i],
    //                         'date' => date('Y-m-d'),
    //                         'itemname' => $sparename[$i],
    //                         'hsnno' => $pocode[$i],
    //                         'itemcode' => $itemcodess[$i],
    //                         'updatestock' => $qty[$i],
    //                         'priceType'    => $priceTypes[$i]
    //                     )
    //                 );
    //             }

    //             $itemnames = $_POST['itemname'];
    //             $qtys = $_POST['qty'];
    //             $heatnos = $_POST['heatno'];
    //             $weights = $_POST['weight'];
    //             $hsnnoss = $_POST['hsnno'];
    //             $grades = $_POST['grade'];
    //             $pscode = $_POST['itemcode'];
    //             $postItemName = $_POST['itemname'];
    //             $count = count($postItemName);

    //             for ($j = 0; $j <  $count; $j++) {

    //                 $podatass = array(
    //                     'date' => date('Y-m-d'),
    //                     'purchasedate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
    //                     'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
    //                     'purchaseno' => $_POST['purchaseno'],
    //                     'suppliername' => $_POST['suppliername'],
    //                     'supplierId' => $customerid,
    //                     'invoiceno' => $_POST['invoiceno'],
    //                     'itemname' => $postItemName[$j],
    //                     'heatno' => $heatnos[$i],
    //                     'weight' => $weights[$j],
    //                     'itemid' => $itemid[$i],
    //                     'rate' => $rate[$j],
    //                     'grade' => $grades[$j],
    //                     'qty' => $qty[$j],
    //                     'total' => $total[$j],
    //                     'hsnno' => $hsnnoss[$j],
    //                     'itemcode' => $pscode[$j],
    //                     'address' => $_POST['address'],
    //                     'subtotal' => $_POST['subtotal'],
    //                     'grandtotal' => $_POST['grandtotal'],
    //                     'purchasenodate' => $purchasenodate,
    //                     'purchasenoyear' => $purchasenoyear,
    //                     'purchaseid' => $purchaseid,
    //                     'status' => 1
    //                 );
    //                 $this->db->insert('purchase_reports', $podatass);
    //             }

    //             @$receiptno = '-';
    //             @$paymentdetails = '-';
    //             @$paymentmodes = '-';
    //             @$throughchecks = '-';
    //             @$banktransfers = '-';
    //             @$chamounts = '-';
    //             @$bankamounts = '-';
    //             @$purpose = '-';
    //             @$amount = '-';
    //             @$chequeno = '-';


    //             $dd = array(
    //                 'date' => date('Y-m-d', strtotime($_POST['invoicedate'])),
    //                 'receiptno' => $receiptno,
    //                 'purchaseno' => $_POST['purchaseno'],
    //                 'suppliername' => $_POST['suppliername'],
    //                 'payment' => $paymentdetails,
    //                 'purchasedate' => date('Y-m-d', strtotime($_POST['purchasedate'])),
    //                 'itemname' => $itemname,
    //                 'amount' => $total,
    //                 'purpose' => $purpose,
    //                 'chamount' => $chamounts,
    //                 'banktransfer' => $banktransfers,
    //                 'bankamount' => $bankamounts,
    //                 'chequeno' => $chequeno,
    //                 'throughcheck' => $throughchecks,
    //                 'paymentdetails' => $paymentdetails,
    //                 'total' => $_POST['grandtotal'],
    //                 'paid' => $paymentmodes,
    //                 'paidamount' => $paymentdetails,
    //                 'currentpaid' => $paymentdetails,
    //                 'receiptamt' => $paymentdetails,
    //                 'balance' => $balanceamount,
    //                 'purchaseamt' => $_POST['grandtotal'],
    //                 'invoiceno' => $_POST['invoiceno'],
    //                 'purchasenodate' => $purchasenodate,
    //                 'purchasenoyear' => $purchasenoyear,
    //                 'purchaseid' => $purchaseid,
    //                 'invoicedate' => date('Y-m-d', strtotime($_POST['invoicedate'])),
    //                 'status' => 1
    //             );

    //             $this->db->insert('po_party_statements', $dd);

    //             $this->session->set_flashdata('msg', 'Purchase Updated Successfully');
    //             redirect('purchase/view');
    //         } else {
    //             $this->session->set_flashdata('msg1', 'No Changes');
    //             redirect('purchase/view');
    //         }
    //     }

    public function search()
    {
        $fromdate = $this->input->post('fromdate');
        $todate = $this->input->post('todate');
        $suppliername = $this->input->post('suppliername');
        $invoiceno = $this->input->post('invoiceno');

        $data = array(
            'rcbio_fromdate' => $fromdate,
            'rcbio_todate' => $todate,
            'rcbio_suppliername' => $suppliername,
            'rcbio_invoiceno' => $invoiceno,
            'rcbio_bill_format' => 'Print',
        );
        $this->session->set_userdata($data);
    }

    public function search_reports()
    {
        $bill_format = $this->session->userdata('rcbio_bill_format');
        $data['purchase'] = $this->purchase_model->search_billing();
        $data['fromdate'] = $this->session->userdata('rcbio_fromdate');
        $data['todate'] = $this->session->userdata('rcbio_todate');
        $data['suppliername'] = $this->session->userdata('rcbio_suppliername');
        $data['invoiceno'] = $this->session->userdata('rcbio_invoiceno');
        $this->load->view('purchase_reports2', $data);
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
            $val = $this->purchase_model->search_billing();
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Purchase Reports');
            //set cell A1 content with some text
            $this->excel->getActiveSheet()->setCellValue('A1', 'INVOICE DETAILS');
            $this->excel->getActiveSheet()->setCellValue('A2', 'DATE');
            $this->excel->getActiveSheet()->setCellValue('B2', 'INVOICE NO');
            $this->excel->getActiveSheet()->setCellValue('C2', 'COMPANY NAME');
            $this->excel->getActiveSheet()->setCellValue('D2', 'BILL AGE');
            $this->excel->getActiveSheet()->setCellValue('E2', 'TOTAL');

            //merge cell A1 until C1
            $this->excel->getActiveSheet()->mergeCells('A1:E1');
            //set aligment to center for that merged cell (A1 to C1)
            $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //make the font become bold
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
            $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

            for ($col = ord('A'); $col <= ord('E'); $col++) {
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            }
            //retrive contries table data

            //$rs = $this->db->get('countries');

            $exceldata = "";
            foreach ($val as $row) {

                $startTimeStamp = strtotime($row['invoicedate']);
                $endTimeStamp = strtotime(date('Y-m-d'));
                $timeDiff = abs($endTimeStamp - $startTimeStamp);
                $numberDays = $timeDiff / 86400;  // 86400 seconds in one day
                $numberDays = intval($numberDays);

                $data['date'] = date('d-m-Y', strtotime($row['date']));
                $data['invoiceno'] = $row['invoiceno'];
                $data['suppliername'] = $row['suppliername'];
                $data['billage'] = $numberDays . 'Days';
                $data['grandtotal'] = $row['grandtotal'];
                $datas[] = $data;
                $gtotal[] = $row['grandtotal'];
            }
            //Fill data 
            $overalltotal = array_sum($gtotal);
            if (count($datas) > 0) {
                $data['date'] = "";
                $data['invoiceno'] = "";
                $data['suppliername'] = "";
                $data['billage'] = "";
                $data['grandtotal'] = number_format($overalltotal, 2);

                @$datas[] = $data;
                $this->excel->getActiveSheet()->fromArray($datas, null, 'A3');
            }


            $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $filename = 'Purchase Reports-' . date('d/m/y') . '.xls'; //save our workbook as this file name
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

 public function delete()
{
    $del = base64_decode($this->input->post('id'));
    $getdetails = $this->db->where('id', $del)->get('purchase_details')->result();

    foreach ($getdetails as $row) {
        $purchasetypes = $row->purchasetype;

        // Update customer details
        $customer_details = $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')")->where('name', $row->suppliername)->get('customer_details')->result();
        foreach ($customer_details as $c) {
            $updates = $c->balanceamount - $row->grandtotal;
            $salesamt = $c->salesamount - $row->grandtotal;
            $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')")->where('name', $row->suppliername)->update('customer_details', array('balanceamount' => $updates, 'salesamount' => $salesamt));
        }

        $itemname = explode('||', $row->itemname);
        $rate = explode('||', $row->rate);
        $heatno = explode('||', $row->heatno);
        $qty = explode('||', $row->qty);
        $hsnno = explode('||', $row->hsnno);
        $purchaseorderno = explode('||', $row->purchaseorderno);
        $purchaseorders = explode('||', $row->purchaseorder);
        $itemcode = explode('||', $row->itemcode); // Add itemcode
        
        // Correct variable name - should be joborder_No not workorder_No
        $joborder_no = explode('||', $row->joborder_No); // Fixed variable name

        $invcount = count($itemname);

        for ($j = 0; $j < $invcount; $j++) {
            // Update stock
            $invwq = $this->db->where('itemname', $itemname[$j])->where('hsnno', $hsnno[$j])->get('stock')->result();
            foreach ($invwq as $w) {
                $old = $w->balance;
            }
            $bal = $old - $qty[$j];
            $this->db->where('itemname', $itemname[$j])->where('hsnno', $hsnno[$j])->update('stock', array('balance' => $bal));

            $invwq1 = $this->db->where('itemname', $itemname[$j])->where('hsnno', $hsnno[$j])->get('stock_reports')->result();
            foreach ($invwq1 as $w1) {
                $old1 = $w1->updatestock;
            }
            $ba1l = $old1 - $qty[$j];
            $this->db->where('itemname', $itemname[$j])->where('hsnno', $hsnno[$j])->update('stock_reports', array('updatestock' => $ba1l));

            if ($purchasetypes == 'purchase Order') {
                $currentPOs = $this->db->where('purchaseorderno', $purchaseorderno[$j])
                    ->where('purchaseorder', $purchaseorders[$j])
                    ->where('itemname', $itemname[$j]) // Add itemname to filter
                    ->where('hsnno', $hsnno[$j]) // Add hsnno to filter
                    ->get('sup_purchaseorder_reports')
                    ->result_array();

                if (!empty($currentPOs)) {
                    $currentPO = $currentPOs[0];

                    $newBalanceQty = intval($currentPO['balaceqty']) + intval($qty[$j]);

                    $status = ($newBalanceQty > 0) ? 1 : 0;

                    $datas = array(
                        'balaceqty' => $newBalanceQty,
                        // 'status' => $status
                    );

                    $this->db->where('id', $currentPO['id'])
                        ->update('sup_purchaseorder_reports', $datas);
                }
                
                // Update edit_status in sup_purchaseorder_details
                $this->db->where('purchaseorderno', $purchaseorderno[$j])
                    ->update('sup_purchaseorder_details', array('edit_status' => 1));
            }

            else if ($purchasetypes == 'Job Order') {
                // Check if joborder_no exists for this item
                if (!empty($joborder_no[$j])) {
                    // Debug: Check what we're looking for
                    // error_log("Looking for JO: DC No = {$joborder_no[$j]}, Itemcode = {$itemcode[$j]}, HSN = {$hsnno[$j]}");
                    
                    $currentJOs = $this->db->where('dcno', $joborder_no[$j])
                        ->where('itemcode', $itemcode[$j]) // Add itemcode filter
                        ->where('hsnno', $hsnno[$j])
                        ->get('jobworkdc_delivery')
                        ->result_array();

                    if (!empty($currentJOs)) {
                        $currentJO = $currentJOs[0];
                        
                        // Debug: Check current balance
                        // error_log("Found JO Record - Current Balance: {$currentJO['balanceqty']}, Adding Qty: {$qty[$j]}");

                        $newBalanceQty = intval($currentJO['balanceqty']) + intval($qty[$j]);
                        
                        // Ensure balance doesn't exceed original quantity
                        $originalQty = isset($currentJO['qty']) ? intval($currentJO['qty']) : 
                                      (isset($currentJO['balanceqty']) ? intval($currentJO['balanceqty']) : 0);
                        
                        if ($originalQty > 0 && $newBalanceQty > $originalQty) {
                            $newBalanceQty = $originalQty;
                        }
                        
                        $status = ($newBalanceQty > 0) ? 1 : 0;
                        
                        $datas = array(
                            'balanceqty' => $newBalanceQty,
                            // 'status' => $status
                        );
                        
                        // Debug: Log update
                        // error_log("Updating JO Record ID: {$currentJO['id']} with new balance: $newBalanceQty");
                        
                        $this->db->where('id', $currentJO['id'])
                            ->update('jobworkdc_delivery', $datas);
                        
                        // Also update jobworkdc_details edit_status
                        $this->db->where('dcno', $joborder_no[$j])
                            ->update('jobworkdc_details', array('edit_status' => 1));
                    } else {
                        // Debug: Record not found
                        // error_log("JO Record not found for DC No: {$joborder_no[$j]}, Itemcode: {$itemcode[$j]}");
                    }
                }
            }
        }

        $data = $this->db->where('id', $del)->delete('purchase_details');

        if ($data) {
            $this->db->where('purchaseid', $del)->delete('purchase_reports');
            $this->db->where('purchaseid', $del)->delete('po_party_statements');
            $this->db->where('purchaseid', $del)->delete('stock_reports');
            echo 'yes';
        } else {
            echo 'no';
        }
    }
}

    public function pending()
    {
        $data['pending'] = $this->purchase_model->pending_select();
        $this->load->view('header');
        $this->load->view('purchase_pending_view', $data);
        $this->load->view('footer1');
    }

    public function pending_search()
    {
        $data['pending'] = $this->purchase_model->search_reports();
        $this->load->view('header');
        $this->load->view('purchase_pending_view', $data);
        $this->load->view('footer1');
    }


    public function purchase_reports()
    {
        @$suppliername = $_POST['suppliername'];
        @$fromdate = $_POST['fromdate'];
        @$todate = $_POST['todate'];
        $data['pending'] = $this->purchase_model->search_pending();
        // echo"<pre>";
        // print_r($data);
        $this->load->view('purchase_reports', $data, $fromdate, $todate, $suppliername);
    }

    public function reports()
    {
        @$suppliername = $_POST['suppliername'];
        @$fromdate = $_POST['fromdate'];
        @$todate = $_POST['todate'];
        $data['pending'] = $this->purchase_model->search_reports();
        $this->load->view('purchase_reports2', $data, $fromdate, $todate);
    }


    public function reports1()
    {
        @$suppliername = $_POST['suppliername'];
        @$fromdate = $_POST['fromdate'];
        @$todate = $_POST['todate'];
        $data['pending'] = $this->purchase_model->search_pending();


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

    public function get_purchaseorderno()
    {
        $suppliers = $_POST['supplier'];
        $query = $this->db->where('status', 1)->where('suppliername', $suppliers)->group_by('purchaseorderno')->get('sup_purchaseorder_reports');

        $result = $query->result();
        $data = array();
        if ($result) {
            foreach ($result as $r) {
                $data['value'] = $r->purchaseorderno;
                $data['label'] = $r->purchaseorderno;
                $json[] = $data;
            }
        }
        echo json_encode($json);
    }

    public function get_vendorjoborderno()
    {
        $suppliers = $_POST['supplier'];
        $query = $this->db->where('status', 1)->where('cusname', $suppliers)->group_by('dcno')->get('jobworkdc_delivery');

        $result = $query->result();
        $data = array();
        if ($result) {
            foreach ($result as $r) {
                $data['value'] = $r->dcno;
                $data['label'] = $r->dcno;
                $json[] = $data;
            }
        }
        echo json_encode($json);
    }

    public function getaddpurchasedetails()
    {
        $discountBy = $this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;

        $discType = ($discountBy == 'percent_wise') ? '%' : '';

        $html = '
    <div class="table-responsive myform directPurchaseDet1">
        <table class="table two">
            <thead> 
                <tr>
                    <th style="width:70px">HSN Code</th>
                    <th style="width:150px">Items Name</th>
                    <th style="width:40px">UOM</th>
                    <th style="width:60px">Heat No</th>
                    <th style="width:50px">Grade</th>
                    <th style="width:50px">weight</th>
                    <th style="width:50px">Qty</th>
                    <th style="width:70px">Rate</th>
                    <th style="width:100px">Amount</th>
                    <th style="width:40px">Disc ' . $discType . '</th>
                    <th style="width:100px">Taxable Amount</th>
                    <th class="sgst" style="width:45px">CGST</th>
                    <th class="sgst" style="width:80px">CGST Amount</th>
                    <th class="sgst" style="width:45px">SGST</th>
                    <th class="sgst" style="width:80px">SGST Amount</th>
                    <th style="display:none;" class="igst">IGST</th>
                    <th style="display:none;" class="igst">IGST Amount</th>
                    <th style="width:110px">Total</th>
                    <th style="width:10px;"></th>
                </tr>  
            </thead>
            <tbody>
                <tr>
                    <td><input id="hsnno0" readonly type="text" name="hsnno[]"><input type="hidden" name="priceType[]" id="priceType0"></td>

                    <td><input class="itemname_class" data-id="0" id="itemname0" required type="text" name="itemname[]">
                    <input type ="hidden" data-id="0" id="itemcode0" name="itemcode[]">
                    <input type ="hidden" data-id="0" id="itemid0" name="itemid[]">
                    </td>

                    <td><input id="uom0" readonly type="text" name="uom[]"></td>
                    
                    <td><input id="heatno0"  type="text" name="heatno[]"></td>

                    <td>
                        <select name="grade[]" id="grade0" data-id="0" class="form-control grade_class" style="width: 120px;">
                            <option value="">Select Grade</option>';

        // ✔ Append Grade Options Here
        $grade = $this->db->where('status', 1)->get('grade')->result();
        foreach ($grade as $g) {
            $html .= '<option value="' . $g->id . '">' . $g->grade . '</option>';
        }

        // Continue HTML
        $html .= '
                        </select>
                    </td>

                    <td><input id="weight0" type="text" name="weight[]"></td>

                    <td><input class="qty_class decimals" id="qty0" data-id="0" required type="text" name="qty[]"></td>

                    <td><input class="rate_class decimals" id="rate0" data-id="0" required type="text" name="rate[]"></td>

                    <td><input id="amount0" readonly type="text" name="amount[]"></td>

                    <td><input class="discount_class decimals" id="discount0" data-id="0" type="text" name="discount[]" value="0"></td>

                    <td><input id="taxableamount0" readonly type="text" name="taxableamount[]"><input type="hidden" name="discountamount[]" id="discountamount0"></td>

                    <td class="sgst"><input id="cgst0" readonly type="text" name="cgst[]"></td>

                    <td class="sgst"><input id="cgstamount0" readonly type="text" name="cgstamount[]"></td>

                    <td class="sgst"><input id="sgst0" readonly type="text" name="sgst[]"></td>

                    <td class="sgst"><input id="sgstamount0" readonly type="text" name="sgstamount[]"></td>

                    <td class="igst" style="display:none;"><input id="igst0" readonly type="text" name="igst[]"></td>

                    <td class="igst" style="display:none;"><input id="igstamount0" readonly type="text" name="igstamount[]"></td>

                    <td><input id="total0" readonly type="text" name="total[]"></td>

                    <td></td>
                </tr>
            </tbody>
            <tbody id="append"></tbody>
        </table>
    </div>';

        echo $html;
    }



    // public function getpodetails()
    // {
    // 	$gsttype=$this->input->post('gsttype');
    //     $supplierid=$this->input->post('supplierid');
    // 	$purchaseOrder=$this->input->post('purchaseOrder');
    // 	// print_r($purchaseOrder);die;
    // 	if($purchaseOrder=='')
    // 	{$html='<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select PO No</span></div>';}
    // 	else
    // 	{
    // 		$count=count($purchaseOrder);
    // 		for ($i=0; $i < $count; $i++) { 
    // 			$data[]=$this->db->where('purchaseorderno',$purchaseOrder[$i])->where('balaceqty >',0)->get('sup_purchaseorder_reports')->result_array();//
    // 		}
    // 		$discountBy=$this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
    // 		if($discountBy=='percent_wise') { $discType= '%'; } else { $discType=''; }

    // 		$html='
    // 		<div class="table-responsive myform" >
    // 		<table class="responsive table" width="100%">
    // 			<thead> 
    // 				<tr>
    // 					<th -style="width:70px">HSN Code</th>
    // 					<th -style="width:70px">Item Code</th>
    // 					<th -style="width:150px">Item Name</th>
    // 					<th -style="width:150px">Heat No</th>
    // 					<th -style="width:50px">Qty</th>
    // 					<th -style="width:50px">UOM</th>
    // 					<th -style="width:50px">weight</th>
    // 					<th -style="width:70px">Rate</th>
    // 					<th -style="width:100px">Amount</th>
    // 					<th -style="width:40px">Disc '.$discType.'</th>
    // 					<th -style="width:100px">&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
    // 					<th class="sgst" -style="width:45px">&nbsp;&nbsp;&nbsp;CGST</th>
    // 					<th class="sgst" -style="width:80px">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
    // 					<th class="sgst" -style="width:45px">&nbsp;&nbsp;&nbsp;SGST</th>
    // 					<th class="sgst" -style="width:80px">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
    // 					<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
    // 					<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
    // 					<th -style="width:110px">Total</th>
    // 					<th -style="width:10px;">&nbsp;</th>
    // 				</tr>  
    // 			</thead>
    // 			<tbody>';
    // 		$k=0;
    // 		foreach ($data as $datas) 
    // 		{foreach ($datas as $rows) 
    // 			{$itemDet=$this->db->select('*')->where('itemcode',$rows['itemcode'])->get('additem')->row();
    // 			$html.='
    // 				<tr>
    // 					<td><input class="" id="hsnno'.$k.'" parsley-trigger="change"  readonly type="text" name="hsnno[]" value="'.$rows['hsnno'].'" ><div id="hsnno_valid'.$k.'"></div><input type="hidden" name="priceType[]" id="priceType'.$k.'" value="'.$itemDet->priceType.'"/><input type="hidden" name="inwNo[]" value="'.$rows['purchaseorderno'].'" /></td>				
    // 					<td><input class="itemcode_class" data-id="'.$k.'" id="itemcode'.$k.'" parsley-trigger="change" required  type="text" name="itemcode[]" value="'.$rows['itemcode'].'" ><div id="itemcode_valid'.$k.'"></div></td>
    // 					<td><input class="itemname_class" data-id="'.$k.'" id="itemname'.$k.'" parsley-trigger="change" required  type="text" name="itemname[]" value="'.htmlentities($rows['itemname']).'" ><div id="itemname_valid'.$k.'"></div></td>
    // 					<td><input class="" data-id="'.$k.'" id="heatno'.$k.'" parsley-trigger="change" required  type="text" name="heatno[]" value="" ><input type="hidden" name="itemid[]" id="itemid'.$k.'" value="'.$itemDet->id.'"></td>
    // 					<td><input class="qty_class decimals" id="qty'.$k.'" data-id="'.$k.'" parsley-trigger="change" required type="text" name="qty[]"  autocomplete="off" value=""><div id="qty_valid'.$k.'"></div><div style="color:green;">Purchase Order Qty : '.$rows['balaceqty'].'</div><input type="hidden" name="balaceqty[]" id="balaceqty'.$k.'" value="'.$rows['balaceqty'].'"/></td>  
    // 					<td><input class="" id="uom'.$k.'" parsley-trigger="change"  readonly  type="text" name="uom[]"  autocomplete="off" value="'.$rows['uom'].'"><div id="uom_valid'.$k.'"></div></td>	
    // 					<td><input class="" id="weight'.$k.'" parsley-trigger="change"  readonly  type="text" name="weight[]"  autocomplete="off" value="'.$rows['weight'].'"></td>
    // 					<td><input class="rate_class decimals" data-id="'.$k.'" parsley-trigger="change"  id="rate'.$k.'"  type="text" name="rate[]"   autocomplete="off" value="'.$itemDet->price.'"><div id="rate_valid'.$k.'"></div></td>
    // 					<td><input class="decimals" id="amount'.$k.'" parsley-trigger="change"  readonly type="text" name="amount[]" value=""  autocomplete="off"><div id="amount_valid'.$k.'"></div></td>
    // 					<td><input class="discount_class decimals" id="discount'.$k.'" data-id="'.$k.'"  type="text" name="discount[]" onkeypress="return isNumberKey_With_Dot(event)" value="0"  autocomplete="off"><div id="discount_valid'.$k.'"></div></td>
    // 					<td><input class="decimals" id="taxableamount'.$k.'" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount'.$k.'"><div id="taxableamount_valid'.$k.'"></div></td>
    // 					<td class="sgst"><input class="decimals" readonly id="cgst'.$k.'"  type="text" name="cgst[]" onkeypress="return isNumberKey(event)" autocomplete="off" value="'.$itemDet->cgst.'"><div id="cgst_valid'.$k.'"></div></td>
    // 					<td class="sgst"><input class="decimals" readonly id="cgstamount'.$k.'"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>
    // 					<td class="sgst"><input class="decimals" id="sgst'.$k.'" readonly  type="text" name="sgst[]" value="'.$itemDet->sgst.'" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid'.$k.'"></div></td>
    // 					<td class="sgst"><input class="decimals" id="sgstamount'.$k.'"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>
    // 					<td class="igst" style="display:none;"><input class="decimals" id="igst'.$k.'"  type="text" name="igst[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" value="'.$itemDet->sgst.'"><div id="igst_valid'.$k.'"></div></td>
    // 					<td class="igst" style="display:none;"><input class="decimals" id="igstamount'.$k.'"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>
    // 					<td><input class="" id="total'.$k.'" type="text" name="total[]" value=""  readonly ></td>	
    // 					<td><input  data-id="'.$k.'" id="stockType'.$k.'" parsley-trigger="change"   type="hidden" name="stockType[]" value="" >
    // 					<td style="width:10px;">&nbsp;<input class="form-control" parsley-trigger="change" readonly id="purchaseid" type="hidden" name="purchaseid" value="'.$rows['purchaseid'].'"><input class="form-control" parsley-trigger="change" readonly id="id" type="hidden" name="id[]" value="'.$rows['id'].'"> </td>
    // 					';
    // 					if($k==0)
    // 					{$html .= '<td>&nbsp;</td>';}
    // 					else
    // 					{$html .='<td><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td>';}
    // 				$html .='</tr>';$k++;
    // 			}
    // 		}
    // 		$html.='
    // 			</tbody>
    // 		</table>
    // 		<script>
    // 		$(".remove").click(function(){
    // 			$(this).parents("tr").remove();
    // 		});
    // 		</script>';
    // 	}
    // 	echo $html;
    // }

    public function getpodetails()
    {
        $gsttype = $this->input->post('gsttype');
        $supplierid = $this->input->post('supplierid');
        $purchaseOrder = $this->input->post('purchaseOrder');

        if ($purchaseOrder == '') {
            $html = '<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select PO No</span></div>';
        } else {
            $count = count($purchaseOrder);
            $data = [];
            for ($i = 0; $i < $count; $i++) {
                $data[] = $this->db->where('purchaseorderno', $purchaseOrder[$i])
                    ->where('balaceqty >', 0)
                    ->get('sup_purchaseorder_reports')
                    ->result_array();
            }

            $discountBy = $this->db->select('discountBy')
                ->where('id', '1')
                ->get('preference_settings')
                ->row()->discountBy;
            $discType = ($discountBy == 'percent_wise') ? '%' : '';

            $html = '
        <div class="table-responsive myform" style="margin-top:10px;">
        <table class="responsive table" width="100%">
            <thead> 
                <tr>
                    <th>HSN Code</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Heat No</th>
                    <th>Qty</th>
                    <th>UOM</th>
                    <th>Grade</th>
                    <th>Weight</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Disc ' . $discType . '</th>
                    <th>Taxable Amount</th>
                    <th class="sgst">CGST</th>
                    <th class="sgst">CGST Amount</th>
                    <th class="sgst">SGST</th>
                    <th class="sgst">SGST Amount</th>
                    <th class="igst" style="display:none;">IGST</th>
                    <th class="igst" style="display:none;">IGST Amount</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>  
            </thead>
            <tbody>';

            $k = 0;
            foreach ($data as $datas) {
                foreach ($datas as $rows) {
                    $itemDet = $this->db->select('*')
                        ->where('itemcode', $rows['itemcode'])
                        ->get('additem')->row();

                    $html .= '
                <tr data-original="1">
                    <td style="width:100px;">
                        <input id="hsnno' . $k . '" readonly type="text" name="hsnno[]" value="' . $rows['hsnno'] . '">
                        <input type="hidden" name="priceType[]" id="priceType' . $k . '" value="' . $itemDet->priceType . '"/>
                        <input type="hidden" name="inwNo[]" value="' . $rows['purchaseorderno'] . '" />
                        <input type="hidden" name="purchaseorder[]" value="' . $rows['purchaseorder'] . '" />
                        <input type="hidden" name="poRecordId[]" value="' . $rows['id'] . '" />
                    </td>				
                    <td style="width:100px;"><input class="itemcode_class" data-id="' . $k . '" id="itemcode' . $k . '" required type="text" name="itemcode[]" value="' . $rows['itemcode'] . '"></td>
                    <td style="width:180px;"><input class="itemname_class" data-id="' . $k . '" id="itemname' . $k . '" required type="text" name="itemname[]" value="' . htmlentities($rows['itemname']) . '"></td>
                 <td style="width:100px;">
                    <input id="heatno' . $k . '" data-id="' . $k . '"  type="text" name="heatno[]" value="">
                    <div class="heatno-warning" id="heatno-warning' . $k . '" style="color:red;font-size:11px;display:none;"></div>
                    <input type="text" name="itemid[]" id="itemid' . $k . '" data-id="' . $k . '" value="' . $rows['itemid']. '">
                </td>
                    <td style="width:30px;">
                        <input class="qty_class decimals" id="qty' . $k . '" data-id="' . $k . '"  type="text" name="qty[]" autocomplete="off" value="">
                        <div style="color:green;">Purchase Order Qty : <span class="balLabel">' . $rows['balaceqty'] . '</span></div>
                        <input type="hidden" name="balaceqty[]" id="balaceqty' . $k . '" value="' . $rows['balaceqty'] . '"/>
                    </td>  
                    <td style="width:100px;"><input id="uom' . $k . '" readonly type="text" name="uom[]" value="' . $rows['uom'] . '"></td>	
 <td style="width:100px;">
        <select class="form-control" id="grade' . $k . '" name="grade[]">';

                    // Get grades from database
                    $grades = $this->db->where('status', 1)->get('grade')->result();

                    // Generate options
                    $html .= '<option value="">Select Grade</option>';
                    foreach ($grades as $grade) {
                        $selected = ($grade->id == $rows['grade']) ? 'selected' : '';
                        $html .= '<option value="' . $grade->id . '" ' . $selected . '>' . $grade->grade . '</option>';
                    }

                    $html .= '
        </select>
    </td>
                    <td style="width:100px;"><input class="weight_class" id="weight' . $k . '" type="text" name="weight[]" value="' . $rows['weight'] . '"></td>
                    <td style="width:120px;"><input class="rate_class decimals" data-id="' . $k . '" id="rate' . $k . '" type="text" name="rate[]" value="' . $rows['rate'] . '"></td>
                    <td style="width:140px;"><input class="decimals" id="amount' . $k . '" readonly type="text" name="amount[]" value=""></td>
                    <td style="width:100px;"><input class="discount_class decimals" id="discount' . $k . '" data-id="' . $k . '" type="text" name="discount[]" value="0"></td>
                    <td style="width:150px;"><input class="decimals" id="taxableamount' . $k . '" readonly type="text" name="taxableamount[]" value=""><input type="hidden" name="discountamount[]" id="discountamount' . $k . '"></td>
                    <td class="sgst" style="width:20px;"><input class="decimals" readonly id="cgst' . $k . '" type="text" name="cgst[]" value="' . $itemDet->cgst . '"></td>
                    <td class="sgst" style="width:120px;"><input class="decimals" readonly id="cgstamount' . $k . '" type="text" name="cgstamount[]" value=""></td>
                    <td class="sgst" style="width:20px;"><input class="decimals" readonly id="sgst' . $k . '" type="text" name="sgst[]" value="' . $itemDet->sgst . '"></td>
                    <td class="sgst" style="width:120px;"><input class="decimals" readonly id="sgstamount' . $k . '" type="text" name="sgstamount[]" value=""></td>
                    <td class="igst" style="display:none;width:20px;"><input class="decimals" readonly id="igst' . $k . '" type="text" name="igst[]" value="' . $itemDet->igst . '"></td>
                    <td class="igst" style="display:none;width:120px;"><input class="decimals" readonly id="igstamount' . $k . '" type="text" name="igstamount[]" value=""></td>
                    <td style="width:160px;"><input id="total' . $k . '" type="text" name="total[]" value="" readonly></td>
                    <td>
                        <button type="button" class="btn btn-success addRow"><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>';
                    $k++;
                }
            }

            $html .= "</tbody></table></div>

        <script>
        $(document).ready(function() {

    // Disable remove button for original rows
    $('tr[data-original=\"1\"]').find('.remove').prop('disabled', true).css('opacity','0.5');

 

    // ========== Remove Row ==========
    $(document).on('click', '.remove', function() {
        var tr = $(this).closest('tr');
        if(tr.attr('data-original') != '1') {
            // Find the previous row before removing
            var prevRow = tr.prev('tr');
            
            // Get the deleted row's quantity and add it back to previous row's balance
            var deletedQty = parseFloat(tr.find('[name=\"qty[]\"]').val()) || 0;
            var prevBalance = parseFloat(prevRow.find('[name=\"balaceqty[]\"]').val()) || 0;
            
            // Calculate new balance for previous row
            var newPrevBalance = prevBalance + deletedQty;
            
            tr.remove();
            recalculateGrandTotal();
            
            // Show the append button on the previous row and update balance
            if (prevRow.length) {
                prevRow.find('.addRow').show();
                prevRow.find('[name=\"balaceqty[]\"]').val(newPrevBalance);
                prevRow.find('.balLabel').text(newPrevBalance);
            }
        }
    });

    // ========== Add Row ==========
$(document).on('click', '.addRow', function() {
    var currentRow = $(this).closest('tr');
    var oldBalance = parseFloat(currentRow.find('[name=\"balaceqty[]\"]').val()) || 0;
    var enteredQty = parseFloat(currentRow.find('[name=\"qty[]\"]').val()) || 0;
    var newBalance = oldBalance - enteredQty;
    if (newBalance < 0) newBalance = 0;

    if (oldBalance <= 0) {
        alert('No balance quantity available to add a new row!');
        return false;
    }
    if (newBalance <= 0) {
        alert('You have reached the full Purchase Order quantity.');
        currentRow.find('.addRow').prop('disabled', true)
            .css({'opacity':'0.5','cursor':'not-allowed'});
    }

    if (newBalance > 0) {
        var newRow = currentRow.clone();
        var newIndex = $('table tbody tr').length;
        newRow.removeAttr('data-original');

        // Update all IDs & data-id attributes
        newRow.find('*').each(function() {
            // Update ID attributes
            var oldId = $(this).attr('id');
            if(oldId){
                var newId = oldId.replace(/[0-9]+$/, newIndex);
                $(this).attr('id', newId);
            }
            
            // Update data-id attributes
            var dataId = $(this).attr('data-id');
            if(dataId !== undefined){
                $(this).attr('data-id', newIndex);
            }
            
            // Update for attributes
            var oldFor = $(this).attr('for');
            if(oldFor){
                var newFor = oldFor.replace(/[0-9]+$/, newIndex);
                $(this).attr('for', newFor);
            }
        });

        // IMPORTANT: Keep the same poRecordId value as the original row
        // Don't change the poRecordId value when cloning
        var originalPoRecordId = currentRow.find('[name=\"poRecordId[]\"]').val();
        newRow.find('[name=\"poRecordId[]\"]').val(originalPoRecordId);

        // Clear numeric fields and reset warnings
        newRow.find('input[type=text]').each(function() {
            var name = $(this).attr('name');
            if(name == 'heatno[]' || name == 'qty[]' || name == 'amount[]' || 
            name == 'taxableamount[]' || name == 'cgstamount[]' || 
            name == 'sgstamount[]' || name == 'igstamount[]' || name == 'total[]') {
                $(this).val('');
            }
        });
        
        // Clear and hide warning messages
        newRow.find('.heatno-warning').hide().html('');
        newRow.find('input[name=\"heatno[]\"]').css('border-color', '');

        // Update balance qty
        newRow.find('[name=\"balaceqty[]\"]').val(newBalance);
        newRow.find('div:contains(\"Purchase Order Qty\")').html('Purchase Order Qty : <span class=\"balLabel\">' + newBalance + '</span>');
        newRow.find('.remove').prop('disabled', false).css('opacity','1');
        newRow.insertAfter(currentRow);
        
        // Hide the plus button on the original row after appending new row
        currentRow.find('.addRow').hide();
    }

    currentRow.find('[name=\"balaceqty[]\"]').val(newBalance);
    currentRow.find('div:contains(\"Purchase Order Qty\")').html('Purchase Order Qty : <span class=\"balLabel\">' + newBalance + '</span>');
});


    // ========== Live Calculation ==========
    $(document).on('keyup change', '.qty_class,.weight_class, .rate_class, .discount_class', function() {
        var row = $(this).closest('tr');
        calculateRow(row);
        recalculateGrandTotal();
        
        // Update Purchase Order Qty display when qty changes
        if ($(this).hasClass('qty_class')) {
            updateBalanceDisplay(row);
        }
    });

    function updateBalanceDisplay(row) {
        var originalBalance = parseFloat(row.find('[name=\"balaceqty[]\"]').val()) || 0;
        var enteredQty = parseFloat(row.find('[name=\"qty[]\"]').val()) || 0;
        var newBalance = originalBalance - enteredQty;
        
        if (newBalance < 0) newBalance = 0;
        
        // Update the display
        row.find('.balLabel').text(newBalance);
    }

    function calculateRow(row){
        var qty = parseFloat(row.find('[name=\"qty[]\"]').val()) || 0;
        var rate = parseFloat(row.find('[name=\"rate[]\"]').val()) || 0;
        var discount = parseFloat(row.find('[name=\"discount[]\"]').val()) || 0;
        var weight = parseFloat(row.find('[name=\"weight[]\"]').val()) || 0;

        var cgst = parseFloat(row.find('[name=\"cgst[]\"]').val()) || 0;
        var sgst = parseFloat(row.find('[name=\"sgst[]\"]').val()) || 0;
        var igst = parseFloat(row.find('[name=\"igst[]\"]').val()) || 0;

        var gsttype = $('#gsttype').val();
    

        var amount = weight * qty * rate;
        var discountAmount = (amount * discount) / 100;
        var taxable = amount - discountAmount;

        var cgstAmount = (taxable * cgst) / 100;
        var sgstAmount = (taxable * sgst) / 100;
        var igstAmount = (taxable * igst) / 100;


        if(gsttype == 'intrastate')
        {
            var total = taxable + cgstAmount + sgstAmount;
            }
            else{
                var total = taxable + igstAmount;
            }

        row.find('[name=\"amount[]\"]').val(amount.toFixed(2));
        row.find('[name=\"discountamount[]\"]').val(discountAmount.toFixed(2));
        row.find('[name=\"taxableamount[]\"]').val(taxable.toFixed(2));
        row.find('[name=\"cgstamount[]\"]').val(cgstAmount.toFixed(2));
        row.find('[name=\"sgstamount[]\"]').val(sgstAmount.toFixed(2));
        row.find('[name=\"igstamount[]\"]').val(igstAmount.toFixed(2));
        row.find('[name=\"total[]\"]').val(total.toFixed(2));
    }

    function recalculateGrandTotal(){
        var grand = 0;
        $('[name=\"total[]\"]').each(function(){
            grand += parseFloat($(this).val()) || 0;
        });
        $('#subtotal').val(grand.toFixed(2));
        $('#grandtotal').val(grand.toFixed(2));
    }

});
        </script>";
        }

        echo $html;
    }


    public function check_heatno_exists()
    {
        $heatno = $this->input->post('heatno');

        // Replace 'your_stock_table' with your actual stock table name
        $exists = $this->db->where('heatno', $heatno)
            ->get('stock')
            ->num_rows() > 0;

        echo json_encode(['exists' => $exists]);
    }

    public function getjoborderdetails()
    {
        $joborderNo = $this->input->post('jobOrder');
        $gsttype = $this->input->post('gsttype');

        if ($joborderNo == '') {
            $html = '<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select Job Order No</span></div>';
            echo $html;
        } else {
            $count = count($joborderNo);
            $data = [];
            for ($i = 0; $i < $count; $i++) {
                $result = $this->db->where('dcno', $joborderNo[$i])
                    ->where('balanceqty >', 0)
                    ->get('jobworkdc_delivery')
                    ->result_array();

                if (!empty($result)) {
                    $data = array_merge($data, $result);
                }
            }

            // Get discount type
            $discountBy = $this->db->select('discountBy')
                ->where('id', '1')
                ->get('preference_settings')
                ->row()->discountBy;
            $discType = ($discountBy == 'percent_wise') ? '%' : '';

            // Pass data to view
            $view_data['items'] = $data;
            $view_data['gsttype'] = $gsttype;
            $view_data['discType'] = $discType;

            $this->load->view('against_joborder', $view_data);
        }
    }

    // public function getpodetails()
    // {
    // 	$gsttype=$this->input->post('gsttype');

    //     $supplierid=$this->input->post('supplierid');
    // 	$purchaseOrder=$this->input->post('purchaseOrder');
    // 	// print_r($purchaseOrder);die;
    // 	if($purchaseOrder=='')
    // 	{
    // 		$html='<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select PO No</span></div>';
    // 	    echo $html;
    // 	}
    // 	else
    // 	{
    // 		$data['purchaseOrder']=$purchaseOrder;
    // 		$data['gsttype']=$gsttype;
    // 		$data['supplierid']=$supplierid;
    // 		$this->load->view('against_supplierpo',$data);
    // 	}
    // }


    public function purchaseorderpending()
    {
        $this->load->view('header');
        $this->load->view('purchaseorder_pending');
        $this->load->view('footer1');
    }
    public function get_hsnnos()
    {
        $grade = $this->input->post('grade');
        $gethsn = $this->db->where('id', $grade)->get('grade')->row();
        echo json_encode($gethsn);
    }
}

ob_flush();

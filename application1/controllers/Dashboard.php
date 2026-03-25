<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('backup_model');
		// $this->load->model('login_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}

	public function index()
	{


		//$dateIs = date('29-03-Y');
		//if(date('d-m-Y')==$dateIs)
		$monthIs='13';
		if(date('m')==$monthIs)
{

//CHECK BACKUP ARE DONE.

$checkbackupDetails=$this->db->select('last_backup')->where('month(last_backup)', $monthIs)->where('year(last_backup) ', date('Y'))->get('preference_settings')->num_rows();

if($checkbackupDetails == 0)
{
//IF NOT BACKEDUP THEN DO BACKUP
$this->backup_model->create_Yearbackup('fullbackup');
//MOVE party statement to new party statement
$this->db->query("INSERT INTO po_party_statements_backup (date,purchasedate,receiptno,purchaseno,supplierId,suppliername,mobileno,address,itemname,qty,total,currentpaid,purpose,payment,paid,paidamount,balance,paymentmode,throughcheck,chequeno,chamount,banktransfer,bankamount,amount,paymentdetails,openingbalance,receiptamt,returnamount,purchaseamt,formtype,invoiceno,invoicedate,status,purchasenodate,purchasenoyear,purchaseid) SELECT date,purchasedate,receiptno,purchaseno,supplierId,suppliername,mobileno,address,itemname,qty,total,currentpaid,purpose,payment,paid,paidamount,balance,paymentmode,throughcheck,chequeno,chamount,banktransfer,bankamount,amount,paymentdetails,openingbalance,receiptamt,returnamount,purchaseamt,formtype,invoiceno,invoicedate,status,purchasenodate,purchasenoyear,purchaseid FROM   po_party_statements  ");

//INSERT INTO po_party_stmt_bakcup SELECT * FROM po_party_statements
$this->db->query("INSERT INTO invoice_party_statement_backup(receiptno,paid,receiptid,date,invoiceno,customerId,customername,cstno,phoneno,tinno,itemname,rate,qty,credit,debit,amount,total,status,receiptdate,invoicedate,totalamount,payment,throughcheck,balanceamount,payamount,paymentmode,chamount,paidamount,balance,banktransfer,bankamount,chequeno,paymentdetails,overallamount,receiptamt,invoiceamt,returnamount,formtype,invoicenoyear,invoicenodate,invoiceid) SELECT receiptno,paid,receiptid,date,invoiceno,customerId,customername,cstno,phoneno,tinno	,itemname,rate,qty,credit,debit,amount,total,status,receiptdate,invoicedate,totalamount,payment,throughcheck,balanceamount,payamount,paymentmode,chamount,paidamount,balance,banktransfer,bankamount,chequeno,paymentdetails,overallamount,receiptamt,invoiceamt,returnamount,formtype,invoicenoyear,invoicenodate,invoiceid FROM invoice_party_statement");

//INSERT INTO invoice_details_backup TABLE
$this->db->query("INSERT INTO invoice_details_backup  (date,invoicedate,orderno,orderdate,invoiceno,dcno,pono,pino,purchaseordernos,bill_type,invoicetype,customerdcnos,customerId,customername,address,deliveryat,transportmode,vehicleno,removalDate,time,shipTo,shipToId,shipToAddress,deliveryAddress1,deliveryAddress2,mobileNo,billtype,gsttype,typesgst,typecgst,typeigst,dcnos,insertid,deliveryid,hsnno,itemid,itemcode,heatno,itemname,item_desc,uom,grade,rate,qty,amount,discount,discountBy,discountamount,taxableamount,sgst,sgstamount,cgst,cgstamount,igst,igstamount,total,subtotal,freightamount,freightcgst,freightcgstamount,freightsgst,freightsgstamount,freightigst,freightigstamount,freighttotal,loadingamount,loadingcgst,loadingcgstamount,loadingsgst,loadingsgstamount,loadingigst,loadingigstamount,loadingtotal,roundOff,othercharges,return_status,grandtotal,balance,vou_status,invoicenodate,invoicenoyear,status,edit_status,totalqty,acno,acdate,irn,signedinvoice,signedqrcode,status_ein,ewayno,ewaydate,ewbvalidtill,remarks,status_cd,status_desc,einvoice_status,eway_status) SELECT date,invoicedate,orderno,orderdate,invoiceno,dcno,pono,pino,purchaseordernos,bill_type,invoicetype,customerdcnos,customerId,customername,address,deliveryat,transportmode,vehicleno,removalDate,time,shipTo,shipToId,shipToAddress,deliveryAddress1,deliveryAddress2,mobileNo,billtype,gsttype,typesgst,typecgst,typeigst,dcnos,insertid,deliveryid,hsnno,itemcode,heatno,itemid,itemname,item_desc,uom,grade,rate,qty,amount,discount,discountBy,discountamount,taxableamount,sgst,sgstamount,cgst,cgstamount,igst,igstamount,total,subtotal,freightamount,freightcgst,freightcgstamount,freightsgst,freightsgstamount,freightigst,freightigstamount,freighttotal,loadingamount,loadingcgst,loadingcgstamount,loadingsgst,loadingsgstamount,loadingigst,loadingigstamount,loadingtotal,roundOff,othercharges,return_status,grandtotal,balance,vou_status,invoicenodate,invoicenoyear,status,edit_status,totalqty,acno,acdate,irn,signedinvoice,signedqrcode,status_ein,ewayno,ewaydate,ewbvalidtill,remarks,status_cd,status_desc,einvoice_status,eway_status FROM invoice_details");

//INSERT INTO purchase_details_backup TABLE
$this->db->query("INSERT INTO purchase_details_backup  (date,purchasedate,invoicedate,purchaseno,supplierId,suppliername,address,invoiceno,billtype,gsttype,typesgst,typecgst,typeigst,hsnno,itemcode,itemname,uom,rate,qty,amount,discount,discountBy,discountamount,taxableamount,sgst,sgstamount,cgst,cgstamount,igst,igstamount,total,subtotal,freightamount,freightcgst,freightcgstamount,freightsgst,freightsgstamount,freightigst,freightigstamount,freighttotal,loadingamount,loadingcgst,loadingcgstamount,loadingsgst,loadingsgstamount,loadingigst,loadingigstamount,loadingtotal,othercharges,roundOff,return_status,grandtotal,purchasenodate,purchasenoyear,status,edit_status) SELECT date,purchasedate,invoicedate,purchaseno,supplierId,suppliername,address,invoiceno,billtype,gsttype,typesgst,typecgst,typeigst,hsnno,itemcode,itemname,uom,rate,qty,amount,discount,discountBy,discountamount,taxableamount,sgst,sgstamount,cgst,cgstamount,igst,igstamount,total,subtotal,freightamount,freightcgst,freightcgstamount,freightsgst,freightsgstamount,freightigst,freightigstamount,freighttotal,loadingamount,loadingcgst,loadingcgstamount,loadingsgst,loadingsgstamount,loadingigst,loadingigstamount,loadingtotal,othercharges,roundOff,return_status,grandtotal,purchasenodate,purchasenoyear,status,edit_status FROM purchase_details");

$this->db->query("INSERT INTO inward_details_backup  (date,inwarddate,inwardno,cusname,address,customerdcno,customerdcdate,itemname,itemid,heatno,item_desc,qty,remarks,hsnno,grade,itemcode,uom,inwardnoyear,inwardnodate,status,delete_status,inward_delivery_id) SELECT date,inwarddate,inwardno,cusname,address,customerdcno,customerdcdate,itemname,itemid,item_desc,qty,remarks,hsnno,heatno,itemcode,uom,grade,inwardnoyear,inwardnodate,status,delete_status,inward_delivery_id FROM inward_details");

//INSERT INTO dc_details_backup TABLE
$this->db->query("INSERT INTO dcbill_details_backup  (date,dcdate,dctype,dcno,customerId,cusname,dispatchthrough,time,purpose,process,remarkss,approximate_value,address,inwardno,customerdcno,customerdcdate,itemname,itemid,heatno,item_desc,qty,remarks,hsnno,itemcode,uom,grade,weight,dcnoyear,dcnodate,status,delete_status,billtype) SELECT date,dcdate,dctype,dcno,customerId,cusname,dispatchthrough,time,purpose,process,remarkss,approximate_value,address,inwardno,customerdcno,customerdcdate,itemname,itemid,item_desc,qty,remarks,hsnno,heatno,itemcode,uom,grade,weight,dcnoyear,dcnodate,status,delete_status,billtype FROM dcbill_details");

$this->db->query("INSERT INTO jobworkdc_details_backup  (date,dcdate,dctype,dcno,customerId,cusname,dispatchthrough,time,purpose,process,remarkss,approximate_value,address,inwardno,customerdcno,customerdcdate,itemname,item_desc,qty,remarks,hsnno,itemcode,uom,dcnoyear,dcnodate,status,delete_status,billtype) SELECT date,dcdate,dctype,dcno,customerId,cusname,dispatchthrough,time,purpose,process,remarkss,approximate_value,address,inwardno,customerdcno,customerdcdate,itemname,item_desc,qty,remarks,hsnno,itemcode,uom,dcnoyear,dcnodate,status,delete_status,billtype FROM jobworkdc_details");


$this->db->query("INSERT INTO materialdc_details_backup  (date,dcdate,dctype,dcno,customerId,cusname,dispatchthrough,time,purpose,process,remarkss,approximate_value,address,inwardno,customerdcno,customerdcdate,itemname,item_desc,qty,remarks,hsnno,itemcode,uom,dcnoyear,dcnodate,status,delete_status,billtype) SELECT date,dcdate,dctype,dcno,customerId,cusname,dispatchthrough,time,purpose,process,remarkss,approximate_value,address,inwardno,customerdcno,customerdcdate,itemname,item_desc,qty,remarks,hsnno,itemcode,uom,dcnoyear,dcnodate,status,delete_status,billtype FROM materialdc_details");


$this->db->query("INSERT INTO proforma_invoice_details_backup  (date,invoicedate,orderno,orderdate,invoiceno,dcno,invoicetype,customerId,customername,address,deliveryat,transportmode,vehicleno,billtype,gsttype,typesgst,typecgst,typeigst,dcnos,insertid,deliveryid,hsnno,itemname,uom,rate,qty,amount,discount,discountBy,discountamount,taxableamount,sgst,sgstamount,cgst,cgstamount,igst,igstamount,total,subtotal,freightamount,freightcgst,freightcgstamount,freightsgst,freightsgstamount,freightigst,freightigstamount,freighttotal,loadingamount,loadingcgst,loadingcgstamount,loadingsgst,loadingsgstamount,loadingigst,loadingigstamount,loadingtotal,roundOff,othercharges,return_status,grandtotal,invoicenodate,invoicenoyear,status,edit_status) SELECT date,invoicedate,orderno,orderdate,invoiceno,dcno,invoicetype,customerId,customername,address,deliveryat,transportmode,vehicleno,billtype,gsttype,typesgst,typecgst,typeigst,dcnos,insertid,deliveryid,hsnno,itemname,uom,rate,qty,amount,discount,discountBy,discountamount,taxableamount,sgst,sgstamount,cgst,cgstamount,igst,igstamount,total,subtotal,freightamount,freightcgst,freightcgstamount,freightsgst,freightsgstamount,freightigst,freightigstamount,freighttotal,loadingamount,loadingcgst,loadingcgstamount,loadingsgst,loadingsgstamount,loadingigst,loadingigstamount,loadingtotal,roundOff,othercharges,return_status,grandtotal,invoicenodate,invoicenoyear,status,edit_status FROM proforma_invoice_details");

$this->db->query("INSERT INTO purchaseorder_details_backup  (date,purchasedate,invoicedate,potype,purchaseorderno,purchaseorder,selected_bom,customerId,customername,address,invoiceno,billtype,gsttype,typesgst,typecgst,typeigst,hsnno,itemcode,itemname,uom,rate,qty,amount,discount,discountBy,discountamount,taxableamount,sgst,sgstamount,cgst,cgstamount,igst,igstamount,total,subtotal,freightamount,freightcgst,freightcgstamount,freightsgst,freightsgstamount,freightigst,freightigstamount,freighttotal,loadingamount,loadingcgst,loadingcgstamount,loadingsgst,loadingsgstamount,loadingigst,loadingigstamount,loadingtotal,othercharges,roundOff,return_status,grandtotal,purchasenodate,purchasenoyear,status,edit_status) SELECT date,purchasedate,invoicedate,potype,purchaseorderno,purchaseorder,selected_bom,customerId,customername,address,invoiceno,billtype,gsttype,typesgst,typecgst,typeigst,hsnno,itemcode,itemname,uom,rate,qty,amount,discount,discountBy,discountamount,taxableamount,sgst,sgstamount,cgst,cgstamount,igst,igstamount,total,subtotal,freightamount,freightcgst,freightcgstamount,freightsgst,freightsgstamount,freightigst,freightigstamount,freighttotal,loadingamount,loadingcgst,loadingcgstamount,loadingsgst,loadingsgstamount,loadingigst,loadingigstamount,loadingtotal,othercharges,roundOff,return_status,grandtotal,purchasenodate,purchasenoyear,status,edit_status FROM purchaseorder_details");

$this->db->query("INSERT INTO quotation_details_backup  (date,quotationdate,invoicedate,gstinno,quotationno,customerId,customername,address,invoiceno,billtype,gsttype,typesgst,typecgst,typeigst,hsnno,itemname,uom,rate,qty,amount,discount,discountamount,taxableamount,sgst,sgstamount,cgst,cgstamount,igst,igstamount,total,subtotal,othercharges,return_status,grandtotal,purchasenodate,purchasenoyear,status,edit_status) SELECT date,quotationdate,invoicedate,gstinno,quotationno,customerId,customername,address,invoiceno,billtype,gsttype,typesgst,typecgst,typeigst,hsnno,itemname,uom,rate,qty,amount,discount,discountamount,taxableamount,sgst,sgstamount,cgst,cgstamount,igst,igstamount,total,subtotal,othercharges,return_status,grandtotal,purchasenodate,purchasenoyear,status,edit_status FROM quotation_details");

//INSERT INTO OLD_SALES RETURN
$this->db->query("INSERT INTO sales_return_backup  (date,returndate,types,time,dateofissue,customername,customerid,supplierid,gsttype,suppliername,openingbal,outstandingamount,returnno,description,invoiceno,purchaseno,itemno,hsnno,itemname,rate,qty,uom,amount,discount,taxableamount,discountamount,cgst,cgstamount,sgst,sgstamount,igst,igstamount,total,subtotal,freightamount,freightcgst,freightcgstamount,freightsgst,freightsgstamount,freightigst,freightigstamount,freighttotal,loadingamount,loadingcgst,loadingcgstamount,loadingsgst,loadingsgstamount,loadingigst,loadingigstamount,loadingtotal,othercharges,grandtotal,status) SELECT date,returndate,types,time,dateofissue,customername,customerid,supplierid,gsttype,suppliername,openingbal,outstandingamount,returnno,description,invoiceno,purchaseno,itemno,hsnno,itemname,rate,qty,uom,amount,discount,taxableamount,discountamount,cgst,cgstamount,sgst,sgstamount,igst,igstamount,total,subtotal,freightamount,freightcgst,freightcgstamount,freightsgst,freightsgstamount,freightigst,freightigstamount,freighttotal,loadingamount,loadingcgst,loadingcgstamount,loadingsgst,loadingsgstamount,loadingigst,loadingigstamount,loadingtotal,othercharges,grandtotal,status FROM sales_return");

//INSERT INTO OLD_VOUCHER
$this->db->query("INSERT INTO voucher_backup  (date,voucherid,cus_suppId,name,voucherdate,vouchertype,purpose,paymentmode,throughcheck,chequeno,chamount,banktransfer,bamount,amount,paymentdetails,transactionid,chequedate,overallamount,voucheramount,status,invoiceno,purchaseno,balance_amt) SELECT date,voucherid,cus_suppId,name,voucherdate,vouchertype,purpose,paymentmode,throughcheck,chequeno,chamount,banktransfer,bamount,amount,paymentdetails,transactionid,chequedate,overallamount,voucheramount,status,invoiceno,purchaseno,balance_amt FROM voucher");

$this->db->query("INSERT INTO expenses_backup  (date,expensesid,name,expensesdate,purpose,throughcheck,chequeno,chamount,banktransfer,bamount,amount,paymentdetails,cardtype,transactionid,overallamount,headers,status) SELECT date,expensesid,name,expensesdate,purpose,throughcheck,chequeno,chamount,banktransfer,bamount,amount,paymentdetails,cardtype,transactionid,overallamount,headers,status FROM expenses");

$id='1';
$d=array(
'quotation' =>'001',
'expenses' =>'001',
'dc' =>'001',
'materialdc' =>'001',
'jobworkdc' => '001',
'voucher' =>'001',
'debit' =>'001',
'credit' =>'001',
'purchase' =>'001',
'purchaseorder' =>'001',
'supplierpurchaseorder' =>'001',
'invoice' =>'0001',
'proforma_invoice' =>'001',
'inward' => '001',
'cashbill_invoice'=>'001',
'last_backup'=>date('Y-m-d')
);
$this->db->where('id',$id);
$this->db->update('preference_settings',$d);
$this->db->query("UPDATE customer_details SET old_openingBal=openingbal,openingbal=balanceamount,salesamount='',paidamount='',balanceamount='',returnamount=''");

$databaseName = $this->db->database;
$query = $this->db->query("SELECT t.TABLE_NAME AS stud_tables FROM INFORMATION_SCHEMA.TABLES AS t WHERE t.TABLE_SCHEMA =  '".$databaseName."' AND t.TABLE_NAME NOT LIKE  '%company_logo' AND t.TABLE_NAME NOT LIKE  '%login_details' AND t.TABLE_NAME NOT LIKE  '%preference_details' AND t.TABLE_NAME NOT LIKE  '%preference_settings' AND t.TABLE_NAME NOT LIKE  '%profile' AND t.TABLE_NAME NOT LIKE  '%card' AND t.TABLE_NAME NOT LIKE '%additem'  AND t.TABLE_NAME NOT LIKE '%category' AND t.TABLE_NAME NOT LIKE '%customer_details' AND t.TABLE_NAME NOT LIKE '%uom' AND t.TABLE_NAME NOT LIKE '%vat_details'  AND t.TABLE_NAME NOT LIKE '%user_menu' AND t.TABLE_NAME NOT LIKE '%vendor_details' AND t.TABLE_NAME NOT LIKE '%operator_details' AND t.TABLE_NAME NOT LIKE '%headers' AND t.TABLE_NAME NOT LIKE '%po_party_statements_backup' AND t.TABLE_NAME NOT LIKE '%invoice_party_statement_backup'  AND t.TABLE_NAME NOT LIKE '%stock' AND t.TABLE_NAME NOT LIKE '%stock_reports' AND t.TABLE_NAME NOT LIKE '%invoice_details_backup' AND t.TABLE_NAME NOT LIKE '%voucher_backup' AND t.TABLE_NAME NOT LIKE '%sales_return_backup' AND t.TABLE_NAME NOT LIKE '%purchase_details_backup' AND t.TABLE_NAME NOT LIKE '%expenses_backup' AND t.TABLE_NAME NOT LIKE '%dcbill_details_backup' AND t.TABLE_NAME NOT LIKE '%inward_details_backup' AND t.TABLE_NAME NOT LIKE '%jobworkdc_details_backup' AND t.TABLE_NAME NOT LIKE '%materialdc_details_backup' AND t.TABLE_NAME NOT LIKE '%proforma_invoice_details_backup' AND t.TABLE_NAME NOT LIKE '%purchaseorder_details_backup' AND t.TABLE_NAME NOT LIKE '%quotation_details_backup' AND t.TABLE_NAME NOT LIKE '%dc_delivery' AND t.TABLE_NAME NOT LIKE '%hsnMaster'
	 AND t.TABLE_NAME NOT LIKE '%inward_delivery' AND t.TABLE_NAME NOT LIKE '%einvoicetoken' AND t.TABLE_NAME NOT LIKE '%ewaytoken' AND t.TABLE_NAME NOT LIKE '%statecode' AND t.TABLE_NAME NOT LIKE '%statecode' AND t.TABLE_NAME NOT LIKE '%jobworkdc_delivery' AND t.TABLE_NAME NOT LIKE '%materialdc_delivery' AND t.TABLE_NAME NOT LIKE '%purchaseorder_reports' AND t.TABLE_NAME NOT LIKE '%materialdc_delivery' ");
$res = $query->num_rows();
if($res > 0)
{
$result = $query->result();
foreach($result as $r)
{
//echo "TRUNCATE TABLE `".$r->stud_tables."`<br>";
$this->db->query("TRUNCATE TABLE `".$r->stud_tables."`");
}
}

}
else
{

}
//ELSE STAY SUMMA.
}

		$first_day_this_month = date('Y-m-01');//date('m-01-Y'); // hard-coded '01' for first day
		$last_day_this_month  = date('Y-m-t');//date('m-t-Y');
		$data['first_day']=$first_day_this_month;
		$data['last_day']=$last_day_this_month;
		$data['cus']=$this->db->where('type','customer')->get('customer_details')->result_array();
		$data['sup']=$this->db->where('type','supplier')->get('customer_details')->result_array();
		//SALES
		$totalSales = $this->db->select_sum('grandtotal')->get('invoice_details')->row()->grandtotal;
		$totalReturn = $this->db->select_sum('grandtotal')->where('types','Debit')->get('sales_return')->row()->grandtotal;
		$totalReceived = $this->db->select_sum('overallamount')->where('vouchertype','payment')->get('voucher')->row()->overallamount;
		$data['sales'] = $totalSales-$totalReturn;
		$data['receivable'] = $totalReceived;
		$data['salesBalance']=$data['sales']-$totalReceived;
		$curMonthSales = $this->db->select_sum('grandtotal')->where('invoicedate >= ',$first_day_this_month)->where('invoicedate <= ',$last_day_this_month)->get('invoice_details')->row()->grandtotal;
		$curMonthReturn = $this->db->select_sum('grandtotal')->where('types','Debit')->where('returndate >= ',$first_day_this_month)->where('returndate <= ',$last_day_this_month)->get('sales_return')->row()->grandtotal;
		$data['curMonthSales']=$curMonthSales-$curMonthReturn;
		//PURCHASE
		$totalPurchase = $this->db->select_sum('grandtotal')->get('purchase_details')->row()->grandtotal;
		$totalPReturn = $this->db->select_sum('grandtotal')->get('sales_return')->row()->grandtotal;
		$totalPaid = $this->db->select_sum('overallamount')->where('vouchertype','receipt')->get('voucher')->row()->overallamount;
		$data['purchase'] = $totalPurchase-$totalPReturn;
		$data['payable'] = $totalPaid;
		$data['purchaseBalance']=$data['purchase']-$totalPaid;
		$curMonthPurchase = $this->db->select_sum('grandtotal')->where('invoicedate >= ',$first_day_this_month)->where('invoicedate <= ',$last_day_this_month)->get('purchase_details')->row()->grandtotal;
		$curMonthPReturn = $this->db->select_sum('grandtotal')->where('types','Credit')->where('returndate >= ',$first_day_this_month)->where('returndate <= ',$last_day_this_month)->get('sales_return')->row()->grandtotal;
		$data['curMonthpurchase'] = $curMonthPurchase-$curMonthPReturn;
		
		//echo $totalReceived;
		//exit;
		$data['totalExpenses'] = $this->db->select_sum('overallamount')->get('expenses')->row()->overallamount;
		$data['currExpenses'] = $this->db->select_sum('overallamount')->where('expensesdate >= ',$first_day_this_month)->where('expensesdate <= ',$last_day_this_month)->get('expenses')->row()->overallamount;
		
		$data['invoice']=$this->db->get('invoice_details')->result_array();
		//$data['purchase']=$this->db->get('purchase_details')->result_array();
		$this->load->view('header');
		$this->load->view('content',$data);
		$this->load->view('footer');
	}
}
ob_flush();
?>
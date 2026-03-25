<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Old_purchase_statement extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('old_postmt_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
    date_default_timezone_set('Asia/Kolkata');		
	}
	public function index()
	{
			
        $data['view']=$this->old_postmt_model->select();

			$this->load->view('header');
			$this->load->view('poview_partystatement');
			$this->load->view('footer');
	}
	


  public function view()
  {

    $data['view']=$this->old_postmt_model->select();

    $this->load->view('header');
    $this->load->view('old_poview_partystmt',$data);
    $this->load->view('footer1');
  }

      public function autocomplete_name()
  {
    $name=$this->input->post('keyword');
//$cusname='ram';
    $this->db->select('*');
    $this->db->from('purchase_details');
    $this->db->like('invoiceno',$name);
    $this->db->group_by('invoiceno');

    $query = $this->db->get();
    $result = $query->result();
    $name       =  array();
    foreach ($result as $d) 
    {
      $json_array             = array();
      $json_array['value']    = $d->invoiceno;
      $json_array['label']    = $d->invoiceno;
      $name[]             = $json_array;
    }
    echo json_encode($name);
  }

  public function ajax_list()
  {
    $list = $this->old_postmt_model->get_datatables();
    $data = array();
    $no = $_POST['start'];
    $a=1;
     $totalamount[]=array();
    foreach ($list as $person) {
      // $noofitemss=explode('||',$person->itemname);
      // $noofitems=count($noofitemss);
      // $totalamount[]=$person->totalamount;
      $no++;
      $row = array();
      $row[] = $a++;
      $row[] = date('d/m/Y',strtotime(str_replace('-','/',$person->date)));
      $row[] =$person->invoiceno;
      $row[] =$person->receiptno;
      $row[] = $person->suppliername;
      $row[] = $person->purchaseamt;
      $row[] = $person->returnamount;

      
      $row[] = $person->receiptamt;
     
      // $row[] = $noofitems;
      $row[] = ucfirst($person->paymentdetails);
      // $row[] = number_format($person->balance,2);
          
          
   
      $data[] = $row;
    }

    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->old_postmt_model->count_all(),
            "recordsFiltered" => $this->old_postmt_model->count_filtered(),
            "data" => $data,
        );
    //output to json format
    echo json_encode($output);
  }

public function autocomplete_invoiceno()
{
	  $name=$this->input->post('keyword');
	  $this->db->select('*');
	  $this->db->from('purchase_details');
	  $this->db->like('invoiceno',$name);
	  $this->db->where('purchasetype','Direct Purchase');
	  $query = $this->db->get();
	  $result = $query->result();
	  $name       =  array();
	  foreach ($result as $d) 
	  {
		$json_array             = array();
		$json_array['value']    = $d->invoiceno;
		$json_array['label']    = $d->invoiceno;
		$name[]             = $json_array;
	  }
	  echo json_encode($name);
}
  		public function search()
              { 

                $fromdate=$this->input->post('fromdate');
                $todate=$this->input->post('todate');
                $suppliername=$this->input->post('suppliername');
                $invoiceno=$this->input->post('invoiceno');

               $data=array(
                        'rcbio_fromdate' => $fromdate,
                        'rcbio_todate' => $todate,
                        'rcbio_suppliername' => $suppliername,
                        'rcbio_invoiceno' => $invoiceno,
                        'rcbio_bill_format' =>'Print',
                       );
               $this->session->set_userdata($data);

              }

              public function billing_reportdownload()
              { 

                $fromdate=$this->input->post('fromdate');
                $todate=$this->input->post('todate');
                $suppliername=$this->input->post('suppliername');
                $invoiceno=$this->input->post('invoiceno');

              $data=array(
                        'rcbio_fromdate' => $fromdate,
                        'rcbio_todate' => $todate,
                        'rcbio_suppliername' => $suppliername,
                        'rcbio_invoiceno' => $invoiceno,
                        'rcbio_bill_format' =>'Excel_Download',
                       );
               $this->session->set_userdata($data);

              }

	public function search_reports()
	{   
		$bill_format=$this->session->userdata('rcbio_bill_format');                
		if($bill_format=='Print')
		{
			$data['fromdate']=$this->session->userdata('rcbio_fromdate');
			$data['todate']=$this->session->userdata('rcbio_todate');
			$data['suppliername']=$this->session->userdata('rcbio_suppliername');
			$data['invoiceno']=$this->session->userdata('rcbio_invoiceno');
			if($data['fromdate']=='' && $data['todate']=='' && $data['suppliername']=='' && $data['invoiceno']=='')
			{
	
				$this->load->view('oldpurchasestmt_overall_rpts',$data);
			}
			else
			{
				$data['purchase']=$this->old_postmt_model->search_billing();
				$this->load->view('old_postmt_rpts',$data);
			}
			
		}
		elseif($bill_format=='Excel_Download')
		{
			//echo 'here';
			//exit;
			$data['fromdate']=$this->session->userdata('rcbio_fromdate');
			$data['todate']=$this->session->userdata('rcbio_todate');
			$data['suppliername']=$this->session->userdata('rcbio_suppliername');
			$data['invoiceno']=$this->session->userdata('rcbio_invoiceno');
			/* LOAD EXCEL LIBRARY AND SET TITLE */ 
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Purchase Party Statement');
			$this->excel->getActiveSheet()->setCellValue('A1', 'PURCHASE PARTY STATEMENT');
			$this->excel->getActiveSheet()->mergeCells('A1:E1');
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
			$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
			/* EOF LOAD EXCEL LIBRARY AND SET TITLE */ 
			
			if($data['fromdate']=='' && $data['todate']=='' && $data['suppliername']=='' && $data['invoiceno']=='')
			{
				$custId_query=$this->db->query("SELECT supplierId,suppliername FROM purchase_details_backup WHERE purchasetype='Direct Purchase' GROUP BY supplierId");
				$this->excel->getActiveSheet()->setCellValue('A2', 'Company Name');
				$this->excel->getActiveSheet()->setCellValue('B2', 'Purchase Amount');
				$this->excel->getActiveSheet()->setCellValue('C2', 'Return Amount');
				$this->excel->getActiveSheet()->setCellValue('D2', 'Receipt Amount');
				$this->excel->getActiveSheet()->setCellValue('E2', 'Balance Amount');
				$this->excel->getActiveSheet()->getStyle('A2:E2')->getFont()->setBold(true); 
				$this->excel->getActiveSheet()->getStyle('A2:E2')->getFont()->setSize(14);

				for($col = ord('A'); $col <= ord('E'); $col++){
					$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
					$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}
			
				$exceldata="";
				if($custId_query->num_rows() > 0 )
				{
					$custIdRes = $custId_query->result();
					$i=3;
					$totalInvAmt = 0;
					$totalRetAmt = 0;
					$totalRecAmt = 0;
					$totalBalAmt = 0;
					$grandBalAmt = 0;
					foreach($custIdRes as $cR)
					{
						$i++;
						//GET INVOICE AMOUNT	
						$grandInvoiceAmt = $this->db->query("SELECT SUM(`grandtotal`) AS invoiceAmt FROM `purchase_details_backup` WHERE `supplierId`='".$cR->supplierId."' AND purchasetype='Direct Purchase' ");
						if($grandInvoiceAmt->num_rows() > 0 )
						{
							$grandInvoiceAmtRes = $grandInvoiceAmt->row();
							$totalInvAmt +=$grandInvoiceAmtRes->invoiceAmt;
							$purchaseamt_print =  number_format($grandInvoiceAmtRes->invoiceAmt,2);
						}
						else
						{
							$purchaseamt_print='0.00';
						}
						//GET RETURN AMOUNT
						$grandRetAmt = $this->db->query("SELECT SUM(`grandtotal`) AS returnAmt FROM `sales_return_backup` WHERE `supplierid`='".$cR->supplierId."' ");
						if($grandRetAmt->num_rows() > 0 )
						{
							$grandRetAmtRes = $grandRetAmt->row();
							$totalRetAmt +=$grandRetAmtRes->returnAmt;
							$retrunamt_print = number_format($grandRetAmtRes->returnAmt,2);
						}
						else
						{
							$retrunamt_print = '0.00';
						}
						
						//GET RECEIPT AMOUNT
						$grandReceiptAmt = $this->db->query("SELECT SUM(`voucheramount`) AS receiptAmt FROM `voucher_backup` WHERE vouchertype='Payable' AND paymentTo = 'Supplier' AND `cus_suppId`='".$cR->supplierId."' ");
						if($grandReceiptAmt->num_rows() > 0 )
						{
							$grandReceiptAmtRes = $grandReceiptAmt->row();
							$totalRecAmt +=$grandReceiptAmtRes->receiptAmt;
							$receiptamt_print = number_format($grandReceiptAmtRes->receiptAmt,2);
						}
						else
						{
							$receiptamt_print = '0.00';
						}
						$totalBalAmt = $grandInvoiceAmtRes->invoiceAmt-($grandRetAmtRes->returnAmt+$grandReceiptAmtRes->receiptAmt);
						$grandBalAmt +=$totalBalAmt;
						$data1['suppliername']=$cR->suppliername;
						$data1['purchaseamt_print']=' '.$purchaseamt_print;
						$data1['retrunamt_print']=' '.$retrunamt_print;
						$data1['receiptamt_print']=' '.$receiptamt_print;
						$data1['totalBalAmt']=' '.number_format($totalBalAmt,2);
						$exceldata[] = $data1;
					}
				}
	
				//Fill data 
				if(count($exceldata) > 0)
				{
					$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');
				}

				$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
								
				$this->excel->getActiveSheet()->setCellValue('A'.$i, 'GRAND TOTAL');
				$this->excel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				$this->excel->getActiveSheet()->setCellValue('B'.$i, ' '.number_format($totalInvAmt,2));
				$this->excel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				$this->excel->getActiveSheet()->setCellValue('C'.$i, ' '.number_format($totalRetAmt,2));
				$this->excel->getActiveSheet()->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				$this->excel->getActiveSheet()->setCellValue('D'.$i, ' '.number_format($totalRecAmt,2));
				$this->excel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				$this->excel->getActiveSheet()->setCellValue('E'.$i, ' '.number_format($grandBalAmt,2));
				$this->excel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				$this->excel->getActiveSheet()->getStyle('A'.$i.':E'.$i)->getFont()->setBold(true); 
				$this->excel->getActiveSheet()->getStyle('A'.$i.':E'.$i)->getFont()->setSize(14);
				
			}
			else
			{
				if($this->session->userdata('rcbio_invoiceno')!="") 	{ $head_invoiceno = $this->session->userdata('rcbio_invoiceno'); 	} else { $head_invoiceno='-'; 	}
				if($this->session->userdata('rcbio_suppliername')!="") 	{ $head_supplier = $this->session->userdata('rcbio_suppliername'); 	} else { $head_supplier='-'; 	}
				if($this->session->userdata('rcbio_fromdate')!="") 		{ $head_fromdate = $this->session->userdata('rcbio_fromdate'); 		} else { $head_fromdate='-'; 	}
				if($this->session->userdata('rcbio_todate')!="") 		{ $head_todate = $this->session->userdata('rcbio_todate'); 			} else { $head_todate='-'; 		}
				
				@$suppliername=$this->session->userdata('rcbio_suppliername');
				$topSuppliername = $suppliername;
				if($suppliername)
				{
					$openingbalance=$this->db->select('old_openingBal')->where('name',$suppliername)->where("(type = 'Inter supplier' OR type = 'Intra supplier')")->get('customer_details')->row()->old_openingBal;
					//echo $openingbalance;
					//exit;
					if(!$openingbalance) { $openingbalance=0; }
					$balanceamount=$this->db->select('balanceamount')->where('name',$suppliername)->where("(type = 'Inter supplier' OR type = 'Intra supplier')")->get('customer_details')->row()->balanceamount;
				}
		
				$purchase=$this->old_postmt_model->search_billing();
				$this->excel->getActiveSheet()->setCellValue('A2', 'Invoice No.');
				$this->excel->getActiveSheet()->setCellValue('B2', $head_invoiceno);
				$this->excel->getActiveSheet()->setCellValue('C2', 'Company Name');
				$this->excel->getActiveSheet()->setCellValue('D2', $head_supplier);
				$this->excel->getActiveSheet()->setCellValue('E2', 'From Date');
				$this->excel->getActiveSheet()->setCellValue('F2', $head_fromdate);
				$this->excel->getActiveSheet()->setCellValue('G2', 'To Date');
				$this->excel->getActiveSheet()->setCellValue('H2', $head_todate);
				$this->excel->getActiveSheet()->getStyle('A2:E2')->getFont()->setBold(true); 
				$this->excel->getActiveSheet()->getStyle('A2:E2')->getFont()->setSize(14);
				
				$this->excel->getActiveSheet()->setCellValue('A3', 'Date');
				$this->excel->getActiveSheet()->setCellValue('B3', 'Invoice No.');
				$this->excel->getActiveSheet()->setCellValue('C3', 'Receipt No.');
				$this->excel->getActiveSheet()->setCellValue('D3', 'Company Name');
				$this->excel->getActiveSheet()->setCellValue('E3', 'Purchase Amount');
				$this->excel->getActiveSheet()->setCellValue('F3', 'Return Amount');
				$this->excel->getActiveSheet()->setCellValue('G3', 'Receipt Amount');
				$this->excel->getActiveSheet()->setCellValue('H3', 'Payment Details');
				$this->excel->getActiveSheet()->getStyle('A3:H3')->getFont()->setBold(true); 
				$this->excel->getActiveSheet()->getStyle('A3:H3')->getFont()->setSize(12);

				for($col = ord('A'); $col <= ord('H'); $col++){
					$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
					$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}
			
				$exceldata="";
				$i=4; 
				foreach ($purchase as $row) {
					$i++;
					$date=date('d-m-Y',strtotime($row['date']));
					$suppliername=$row['suppliername'];
					$invoiceno=$row['invoiceno'];
					$receiptno=$row['receiptno'];
					// $grandtotal=$row['totalamount'];
					$paymentdetails=$row['paymentdetails'];
					$paid=$row['paid'];
					$purchaseamt=$row['purchaseamt'];
					$returnamount=$row['returnamount'];
					$receiptamt=$row['receiptamt'];
					$balance=$row['balance'];

					$purchases[]=$purchaseamt;
					$pur=array_sum($purchases);

					$returns[]=$returnamount;
					$ret=array_sum($returns);

					$receiptamts[]=$receiptamt;
					$rec=array_sum($receiptamts);

					$pay[]=$paid;
					$p=array_sum($pay);

					$unpaid=$pur-$rec;
					if($topSuppliername=='')
					{
						$openingbalance=$this->db->select('old_openingBal')->where('name',$row['suppliername'])->where("(type = 'Inter supplier' OR type = 'Intra supplier')")->get('customer_details')->row()->old_openingBal;

						if(!$openingbalance) { $openingbalance=0; }
						$balanceamount=$this->db->select('balanceamount')->where('name',$row['suppliername'])->where("(type = 'Inter supplier' OR type = 'Intra supplier')")->get('customer_details')->row()->balanceamount;
					}
					$data1['date']=$date;
					$data1['invoiceno']=' '.$invoiceno;
					$data1['receiptno']=' '.$receiptno;
					$data1['suppliername']=ucfirst($suppliername);
					$data1['purchaseamt']=' '.$purchaseamt;
					$data1['returnamount']=' '.$returnamount;
					$data1['receiptamt']=' '.$receiptamt;
					$data1['paymentdetails']=ucfirst($paymentdetails);
					$exceldata[] = $data1;
					
					$this->excel->getActiveSheet()->getStyle('A'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle('B'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle('C'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle('D'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle('E'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle('F'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle('G'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle('H'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}
				//Fill data 
				//print_r($exceldata);
				//exit;
				if(count($exceldata) > 0)
				{
					$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A4');
				}
				
				
				$rowCount = $i++;
				$this->excel->getActiveSheet()->setCellValue('A'.$rowCount, 'Opening Balance : ');
				$this->excel->getActiveSheet()->mergeCells('A'.$rowCount.':G'.$rowCount);
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$this->excel->getActiveSheet()->setCellValue('H'.$rowCount, ' '.number_format($openingbalance,2));
				$this->excel->getActiveSheet()->getStyle('H'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':H'.$rowCount)->getFont()->setBold(true); 
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':H'.$rowCount)->getFont()->setSize(12);
				
				$rowCount = $i++;
				$this->excel->getActiveSheet()->setCellValue('A'.$rowCount, 'Purchase Amount : ');
				$this->excel->getActiveSheet()->mergeCells('A'.$rowCount.':G'.$rowCount);
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$this->excel->getActiveSheet()->setCellValue('H'.$rowCount, ' '.number_format($pur,2));
				$this->excel->getActiveSheet()->getStyle('H'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':H'.$rowCount)->getFont()->setBold(true); 
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':H'.$rowCount)->getFont()->setSize(12);
				
				$rowCount = $i++;
				$this->excel->getActiveSheet()->setCellValue('A'.$rowCount, 'Return Amount : ');
				$this->excel->getActiveSheet()->mergeCells('A'.$rowCount.':G'.$rowCount);
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$this->excel->getActiveSheet()->setCellValue('H'.$rowCount, ' '.number_format($ret,2));
				$this->excel->getActiveSheet()->getStyle('H'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':H'.$rowCount)->getFont()->setBold(true); 
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':H'.$rowCount)->getFont()->setSize(12);
				
				
				$rowCount = $i++;
				$this->excel->getActiveSheet()->setCellValue('A'.$rowCount, 'Receipt Amount : ');
				$this->excel->getActiveSheet()->mergeCells('A'.$rowCount.':G'.$rowCount);
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$this->excel->getActiveSheet()->setCellValue('H'.$rowCount, ' '.number_format($rec,2));
				$this->excel->getActiveSheet()->getStyle('H'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':H'.$rowCount)->getFont()->setBold(true); 
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':H'.$rowCount)->getFont()->setSize(12);
				
				$calculatedBalanceAmt = ($openingbalance+$pur)-($ret+$rec);
				$rowCount = $i++;
				$this->excel->getActiveSheet()->setCellValue('A'.$rowCount, 'Balance Amount : ');
				$this->excel->getActiveSheet()->mergeCells('A'.$rowCount.':G'.$rowCount);
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$this->excel->getActiveSheet()->setCellValue('H'.$rowCount, ' '.number_format($calculatedBalanceAmt,2));
				$this->excel->getActiveSheet()->getStyle('H'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':H'.$rowCount)->getFont()->setBold(true); 
				$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':H'.$rowCount)->getFont()->setSize(12);
			}
			$filename='Purchase Party Statment-'.date('d/m/y h_i_s A').'.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
				
		}
		elseif($bill_format=='Bill_Download')
		{
			$this->load->helper('download');
			$this->load->library('mpdf');
			$purchase=$this->old_postmt_model->search_billing();
			$fromdate=$this->session->userdata('realty_fromdate');
			$todate=$this->session->userdata('realty_todate');
			$suppliername=$this->session->userdata('realty_suppliername');
			$invoiceno=$this->session->userdata('realty_invoiceno');

			$mpdf = new mPDF('L',  // mode - default ''
			'A4',    // format - A4, for example, default ''
			0,     // font size - default 0
			'',    // default font family
			10,    // margin_left
			10,    // margin right
			16,     // margin top
			16,    // margin bottom
			9,     // margin header
			9,     // margin footer
			'L'); 

			$profilesgetdata=$this->db->where('status',1)->get('profile')->result_array();
			foreach ($profilesgetdata as $key => $profilesgetdatas) {
				$title=$profilesgetdatas['companyname'];
				$logo=$profilesgetdatas['logo'];
				$address1=$profilesgetdatas['address1'];
				$address2=$profilesgetdatas['address2'];
				$mobileno=$profilesgetdatas['phoneno'];
				$email=$profilesgetdatas['emailid'];
			}

			$html='
			<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
				<tr>
					<td height="80" align="center" style=""><p><img src="'.base_url().'logouploads/'. $logo.'" alt="DDD"></p>
					<p style="margin-top: -22px; font-size: 12px;"><h2><strong>'. $title.'</strong></h2></p>
					<p style="margin-top: -22px; font-size: 12px;"><strong>'. $address1.','. $address2.',</strong></p>
					<p style="margin-top: -10px; font-size: 12px;"><strong>Mobile :&nbsp;'. $mobileno.', E-Mail:&nbsp;'.$email.' </strong></p></td>
				</tr>
			</table>

			<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
				<tr style="font-size: 14px;">
					<td height="35" width="222" align="left" style="border-bottom:1px solid black;"><strong>Purchase Party Statement </strong></td>';
						if(@$suppliername) { $sup=ucfirst($suppliername); } else { $sup="All Reports"; }
						if(@$fromdate) { $frm='From Date :&nbsp;'. $fromdate.''; } else { }
						if(@$todate){ $to='To Date :&nbsp;'. $todate.''; } else { }
						$html.=' <td height="35" width="424" align="center" style="border-bottom:1px solid black;"><strong>'.$sup.'&nbsp;&nbsp;&nbsp; '.$frm.' &nbsp;&nbsp;'.$to.'
						</strong>
					</td>
					<td height="35" width="64" align="right" style="border-bottom:1px solid black;"><strong></strong></td>
				</tr>
			</table>

			<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 18;">
				<tr>
					<td width="90" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
					<td width="97" align="center" style="border-bottom:1px solid black;"><strong>INV No</strong></td>
					<td width="100" align="left" style="border-bottom:1px solid black;"><strong>Receipt No</strong></td>
					<td width="144" align="left" style="border-bottom:1px solid black;"><strong>Supplier Name</strong></td>
					<td width="100" align="right" style="border-bottom:1px solid black;"><strong>Purchase</strong></td>
					<td width="60" align="right" style="border-bottom:1px solid black;"><strong>Receipt</strong></td>
					<td width="60" align="center" style="border-bottom:1px solid black;"><strong>Balance</strong></td>
					<td width="120" align="right" style="border-bottom:1px solid black;"><strong>Payment Details</strong></td>
				</tr>';

			$i=1;
			$totalamount[]=array();
			foreach ($purchase as $row) {
				$invoiceno=$row['invoiceno'];
				$receiptno=$row['receiptno'];
				$suppliername=$row['suppliername'];
				$paymentdetails=$row['paymentdetails'];
				$paid=$row['paid'];
				$receiptdate=date('d-m-Y',strtotime($row['purchasedate']));
				$balance=$row['balance'];
				$purchaseamt=$row['purchaseamt'];
				$receiptamt=$row['receiptamt'];
				$paymentdetails=$row['paymentdetails'];

				$purchases[]=$purchaseamt;
				$pur=array_sum($purchases);
				$receiptamts[]=$receiptamt;
				$rec=array_sum($receiptamts);

				$pay[]=$paid;
				$p=array_sum($pay);

				$unpaid=$pur-$rec;

				$html.='
				<tr>
					<td align="left" style="border-bottom:1px dotted black;">'.$receiptdate.'</td>
					<td align="center" style="border-bottom:1px dotted black;">'.$invoiceno.'</td>
					<td align="left" style="border-bottom:1px dotted black;">'.$receiptno.'</td>
					<td align="left" style="border-bottom:1px dotted black;">'. ucfirst($suppliername).'</td>
					<td align="right" style="border-bottom:1px dotted black;">'.$purchaseamt.'</td>
					<td align="right" style="border-bottom:1px dotted black;">'.number_format($receiptamt
					,2).'</td>
					<td align="center" style="border-bottom:1px dotted black;">'.number_format($balance,2).'</td>
					<td align="right" style="border-bottom:1px dotted black;">'.$paymentdetails.'</td>
				</tr>';
			}
			$html.='
				<tfoot>
				<tr>
					<td width="43" height="29" align="left"><strong></strong></td>
					<td width="116" align="left" ><strong></strong></td>
					<td width="97" align="left" ><strong></strong></td>
					<td width="186" align="left" ><strong></strong></td>
					<td width="144" align="left" ><strong>&nbsp;</strong></td>
					<td width="112" align="center" ><strong>&nbsp;</strong></td>
					<td width="186" align="left" ><strong></strong></td>
				</tr>
				</tfoot>
			</table>

			<table>
				<tr>
					<td width="43" height="29" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="116" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="97" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="144" align="left" style="border-bottom:1px solid black;"><strong>Purchase Amount</strong></td>
					<td width="112" align="center" style="border-bottom:1px solid black;"><strong>'. number_format($pur,2).'</strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
				</tr>
				
				<tr>
					<td width="43" height="29" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="116" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="97" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="144" align="left" style="border-bottom:1px solid black;"><strong>Receipt Amount</strong></td>
					<td width="112" align="center" style="border-bottom:1px solid black;"><strong>'. number_format($rec,2).'</strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
				</tr>
				
				<tr>
					<td width="43" height="29" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="116" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="97" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="144" align="left" style="border-bottom:1px solid black;"><strong>Balance Amount</strong></td>
					<td width="112" align="center" style="border-bottom:1px solid black;"><strong>'. number_format($unpaid,2).'</strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
				</tr>
			</table>'; 
			$suppliername=$this->session->userdata('realty_suppliername');
			if(@$suppliername)
			{
				$sups=$suppliername;
			} 
			else
			{
				
			}
			
			$mpdf->WriteHTML($html);  
			$mpdf->Output($sups.' '.'Purchase Party Statement'.' '.date('d-m-Y').'.pdf','d');

		}
	}  

}

ob_flush();
?>
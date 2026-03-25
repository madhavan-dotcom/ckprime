<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Voucher extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('voucher_model');
    if($this->session->userdata('rcbio_login')=='')
    {

      $this->session->set_flashdata('msg','Please Login to continue!');
      redirect('login');
    } 
    date_default_timezone_set('Asia/Kolkata');

  }

  public function pay()
  {
    $this->db->order_by('id','desc');
    $this->db->limit(1);
    $num=$this->db->get('voucher')->result_array();

    @$invoice=$num[0]['voucherid'];
    $count=count($invoice);
    if($count=='0')
    {
      $gg="R00001";
      $invoiceno=$gg;
    }
    else
    {
      $old_user_no = str_split($invoice,2);
      @$va = (string)($old_user_no[1].$old_user_no[2].$old_user_no[3].$old_user_no[4].$old_user_no[5])+1; 
      @$sales_length = strlen($va);
      if(@$sales_length == 1)
      {
        $invoiceno = "R0000".$va;  
      }
      else if(@$sales_length == 2)
      {
        $invoiceno = "R000".$va;      
      }
      else if(@$sales_length == 3)
      {   
        $invoiceno = "R00".$va;   
      }
      else if(@$sales_length == 4)
      {    
        $invoiceno = "R0".$va; 
      }
    }
    $data['voucherid']=$invoiceno;
    $id=$this->uri->segment(3);
    $data['pay']=$this->voucher_model->pay_amount($id);


    $this->load->view('header');
    $this->load->view('voucherpay_amount',$data);
    $this->load->view('footer');

  }

  public function index()
  { 
    $query_update1 =$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('voucher')->result_array();
foreach($query_update1 as $row)
{
$quotationnos=$row['voucherid'];
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_prefix = $default_bond->voucherPrefix;
@$quotationnos=str_replace($new_bond_prefix,'',$quotationnos);
}

if(date('m')=='14')
{
$month=date('m');
$year=date('Y');
$old=$this->db->where('month(date)', $month)->where('year(date) ', $year)->get('voucher')->result_array();
if($old)
{
@$bond_no = $quotationnos;
if(is_null($bond_no))
{
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_prefix = $default_bond->voucherPrefix;
$new_bond_noo = $new_bond_prefix.$default_bond->voucher;
//$new_bond_noo = '100001'; 
} 
else 
{
$default_bond=$this->db->where('id',1)->where('voucher !=','')->get('preference_settings')->row();
if($default_bond)
{
$bond_no=$default_bond->voucher;
$bondLen = strlen($bond_no);
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_prefix = $default_bond->voucherPrefix;
$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d',$bondOnlyNum);
}
else
{
$bondLen = strlen($bond_no);
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_prefix = $default_bond->invoicePrefix;
$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', (float)$bondOnlyNum + 1);
}

}
}
else
{
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_prefix = $default_bond->voucherPrefix;
$new_bond_noo = $new_bond_prefix.$default_bond->voucher;
//$new_bond_noo = '100001';
}

}
else
{
@$bond_no = $quotationnos;
if(is_null($bond_no))
{
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_prefix = $default_bond->voucherPrefix;
$new_bond_noo = $new_bond_prefix.$default_bond->voucher;
//$new_bond_noo = '100001'; 
} 
else
{
$default_bond=$this->db->where('id',1)->where('voucher !=','')->get('preference_settings')->row();
if($default_bond)
{
@$bond_no=$default_bond->voucher;
$new_bond_prefix = $default_bond->voucherPrefix;
$bondLen = strlen($bond_no);
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
}
else
{
$bondLen = strlen($bond_no);
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_prefix = $default_bond->voucherPrefix;
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d',(float) $bondOnlyNum + 1);
}
}
}
    
$data['voucherid']=$new_bond_noo;


    $this->load->view('header');
    $this->load->view('addvoucher',$data);
    $this->load->view('footer');
 

  }

Public function getinvoiceno()
{
	@$username=$_POST['username'];
	$getdetails=$this->db->where('balance >',0)->where('customername',$username)->where('vou_status',1)->get('invoice_details')->result_array();
	if(count($getdetails) > 0)
	{
		foreach($getdetails as $invoicedetails)
		{
// if($invoicedetails['balance'] > 0)
// {
			$data['label']=$invoicedetails['invoiceno'];
			$data['value']=$invoicedetails['invoiceno'];
			$json[]=$data;
//  }else{
// $json[]="";
// }

		}
// echo json_encode($json);
	}
	$getdetails=$this->db->where('balance >',0)->where('customername',$username)->where('vou_status',1)->get('invoice_details_backup')->result_array();
	if(count($getdetails) > 0)
	{
		foreach($getdetails as $invoicedetails)
		{
// if($invoicedetails['balance'] > 0)
// {
			$data['label']=$invoicedetails['invoiceno'];
			$data['value']=$invoicedetails['invoiceno'];
			$json[]=$data;
//  }else{
// $json[]="";
// }

		}
	}
	echo json_encode($json);
}
Public function getbalance()
{

	$invoiceno=$_POST['invoiceno'];
	$counts=count($invoiceno);
	$balance=0;
	for ($i=0; $i < $counts; $i++) { 
		if($this->db->where('invoiceno',@$invoiceno[$i])->get('invoice_details')->num_rows()>0){
			$getdetails=$this->db->select('sum(balance)as balance')->where('invoiceno',@$invoiceno[$i])->get('invoice_details')->row()->balance;
			$balance+=$getdetails ;
		}else{
			$getdetails=$this->db->select('sum(balance)as balance')->where('invoiceno',@$invoiceno[$i])->get('invoice_details_backup')->row()->balance;
			$balance+=$getdetails ;
		}
	}
	echo $balance;
}
Public function getpurchaseno()
{
	@$username=$_POST['username'];
	$getdetails=$this->db->where('balance >',0)->where('suppliername',$username)->where('vou_status',1)->get('purchase_details')->result_array();
	if(count($getdetails) > 0)
	{
		foreach($getdetails as $invoicedetails)
		{
// if($invoicedetails['balance'] > 0)
// {
			$data['label']=$invoicedetails['purchaseno'];
			$data['value']=$invoicedetails['purchaseno'];
			$json[]=$data;
//  }else{
// $json[]="";
// }

		}
		// echo json_encode($json);
	}
	$getdetails=$this->db->where('balance >',0)->where('suppliername',$username)->where('vou_status',1)->get('purchase_details_backup')->result_array();
	if(count($getdetails) > 0)
	{
		foreach($getdetails as $invoicedetails)
		{
// if($invoicedetails['balance'] > 0)
// {
			$data['label']=$invoicedetails['purchaseno'];
			$data['value']=$invoicedetails['purchaseno'];
			$json[]=$data;
//  }else{
// $json[]="";
// }

		}
	}
		echo json_encode($json);
}
Public function get_purchase_balance()
{
    // print_r($_POST);exit;

	$purchaseno=$_POST['purchaseno'];
	$counts=count($purchaseno);
	$balance=0;
	for ($i=0; $i < $counts; $i++) {
		
			$getdetails=$this->db->select('sum(balance)as balance')->where('purchaseno',@$purchaseno[$i])->get('purchase_details')->row()->balance;
			$balance+=$getdetails ;
	
			$getdetails=$this->db->select('sum(balance)as balance')->where('purchaseno',@$purchaseno[$i])->get('purchase_details_backup')->row()->balance;
			$balance+=$getdetails ;
		
	}
	echo $balance;
}

	Public function insert()
	{
	   // print_r($_POST);exit;
	  $invoiceno=implode('||',$_POST['invoiceno']);
		$purchaseno=implode('||',$_POST['purchaseno']);
		$otherBank=0;
		if($_POST['throughcheck']!='') { $throughcheck=$_POST['throughcheck'];  if($throughcheck=='Other') { $otherBank=1; $throughcheck=$_POST['tcbankName']; }  } else { $throughcheck=''; }
		if($_POST['chequeno']!='') { $chequeno=$_POST['chequeno']; } else { $chequeno=''; }
		if($_POST['chamount']!='') { $chamount=$_POST['chamount']; } else { $chamount=''; }
		if($_POST['banktransfer']!='') { $banktransfer=$_POST['banktransfer']; if($banktransfer=='Other') { $otherBank=1; $banktransfer=$_POST['ssbankName']; }   } else { $banktransfer=''; }

		if($_POST['bamount']!='') { $bamount=$_POST['bamount']; } else { $bamount=''; }
		if($_POST['amount']!='') { $amount=$_POST['amount']; } else { $amount=''; }
    if($_POST['tdsamount']!='') { $tdsamount=$_POST['tdsamount']; } else { $tdsamount=''; }
		$payment=$_POST['paymentmode'];

		if($payment=='Cash')
		{
			$paymentdetails=$payment;
		}
		else if($payment=='Cheque')
		{
			$paymentdetails=$payment.' '.$throughcheck.' '.$_POST['chequeno'];
			$chequedate=$_POST['chequedate'];
		}
		else if($payment=='Bank')
		{
			$paymentdetails=$payment.' '.$banktransfer;
			@$transactionid=$_POST['transactionid'];
		} 
		else if($payment=='TDS')
		{
			$paymentdetails=$payment;
		} 

		if($_POST['amount'])
		{
			$overallamount=$_POST['amount'];
			$voucheramount=$_POST['amount'];
		}
		elseif($_POST['bamount'])
		{
			$overallamount=$_POST['bamount'];
			$voucheramount=$_POST['bamount'];
		}
		elseif($_POST['chamount'])
		{
			$overallamount=$_POST['chamount'];
			$voucheramount=$_POST['chamount'];
		}
		elseif($_POST['tdsamount'])
		{
			$overallamount=$_POST['tdsamount'];
			$voucheramount=$_POST['tdsamount'];
		}

		$voucherid=$_POST['voucherid'];

// Customer Pay The voucher Amount Function
		if($_POST['vouchertype']=='payment')
		{
			$cus_suppId = $_POST['customerId'];
			$name=$_POST['name'];
			$balance = $_POST['balance'];
				$this->db->where("(type = 'Inter customer' OR type = 'Intra customer')");
				$this->db->where('name',$_POST['name']);
				$getcus=$this->db->get('customer_details')->result();
				if(count($getcus) > 0)
				{
					foreach($getcus as $g)
						// if($_POST['year']=='Current year'){
							$balanceamount=$g->balanceamount-$voucheramount;
							$this->db->where('id',$g->id)->update('customer_details',array('paidamount'=>$voucheramount,'balanceamount'=>$balanceamount));
						// }else{
							/*$balanceamount=$g->openingbal-$voucheramount;
							$this->db->where('id',$g->id)->update('customer_details',array('paidamount'=>$voucheramount,'openingbal'=>$balanceamount));*/
						// }
				}else{
					$balanceamount='0.00';
				}
			$datas = array(
				'date'=>date('Y-m-d'),
				'receiptdate'=>date('Y-m-d',strtotime($_POST['voucherdate'])),
				'receiptno'=>$voucherid,
				'customername'=>$_POST['name'],
				'paid'=>$overallamount,
				'paymentdetails'=>$paymentdetails,
				'status'=>1
			);
			$this->db->insert('collection_details',$datas);

			@$invoiceamt='-';
			$da = array(
				'date'=>date('Y-m-d',strtotime($_POST['voucherdate'])),
				'receiptdate'=>date('Y-m-d',strtotime($_POST['voucherdate'])),
				'invoiceno'=>'-',
				'receiptno'=>$voucherid,
				'customername'=>$_POST['name'],
				'invoiceamt'=>$invoiceamt,
				'receiptamt'=>$overallamount,
				'paymentdetails'=>$paymentdetails,
				'balance'=>$balanceamount,
				'status'=>1
			);      
			$this->db->insert('invoice_party_statement',$da);
		}

// Supplier Pay The voucher Amount Function
		else
		{
			$cus_suppId = $_POST['supplierId'];
			$name=$_POST['name1'];
			$balance = $_POST['balance1'];
			// if($_POST['year']=='Current year'){
				$this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
				$this->db->where('name',$_POST['name1']);
				$getcus=$this->db->get('customer_details')->result();
				if(count($getcus) > 0)
				{
					foreach($getcus as $g)
						$balanceamount=$g->balanceamount-$voucheramount;
					$this->db->where('id',$g->id)->update('customer_details',array('paidamount'=>$voucheramount,'balanceamount'=>$balanceamount));
				}else{
					$balanceamount='0.00';
				}
			/*}else{
				$balanceamount='0.00';
			}*/

			$datas = array(
				'date'=>date('Y-m-d'),
				'receiptdate'=>date('Y-m-d',strtotime($_POST['voucherdate'])),
				'receiptno'=>$voucherid,
				'suppliername'=>$_POST['name1'],
				'paid'=>$overallamount,
				'paymentdetails'=>$paymentdetails,
				'status'=>1
			);
			$this->db->insert('purchase_collection',$datas);

			@$invoiceamt='-';
			$da = array(
				'date'=>date('Y-m-d',strtotime($_POST['voucherdate'])),
				'date'=>date('Y-m-d',strtotime($_POST['voucherdate'])),
				'invoiceno'=>'-',
				'receiptno'=>$voucherid,
				'suppliername'=>$_POST['name1'],
				'purchaseamt'=>$invoiceamt,
				'receiptamt'=>$overallamount,
				'paymentdetails'=>$paymentdetails,
				'balance'=>$balanceamount,
				'status'=>1
			);      
			$this->db->insert('po_party_statements',$da);
		}




		$data=array(
			'date'=>date('Y-m-d'),  
			'voucherid'=>$voucherid,
			'purpose' => $_POST['purpose'],
			'cus_suppId' => $cus_suppId,
			'name'=>$name,
			'vouchertype'=>$_POST['vouchertype'],
			// 'year'=>$_POST['year'],
			'voucherdate'=>date('Y-m-d',strtotime($_POST['voucherdate'])),
			'paymentmode'=>$_POST['paymentmode'],
			'throughcheck'=>$throughcheck,
			'chequeno'=>$chequeno,
			'chamount'=>$chamount,
			'banktransfer'=>$banktransfer,
			'bamount'=>$bamount,
			'amount'=>$amount,
			'invoiceno'=>$invoiceno,
			'purchaseno'=>$purchaseno,
			'paymentdetails'=>$paymentdetails,
			'transactionid'=>@$transactionid,
			'chequedate'=>@$chequedate,
			'overallamount'=>$overallamount,
			'voucheramount'=>$voucheramount,
			'otherBank'=>$otherBank,
			'status'=>1
		);  
		$result=$this->db->insert('voucher',$data);
		if($result==true)
		{
			$insert_id=$this->db->insert_id();
			if($_POST['vouchertype']=='payment')
			{
				$invoicenos=implode('||',$_POST['invoiceno']);
				$invoicenoss=explode('||',$invoicenos);
				$voch=$voucheramount;
				$count=count($invoicenoss);
				for ($j=0; $j <  $count; $j++) 
				{
					if($this->db->where('invoiceno',@$invoicenoss[$j])->get('invoice_details')->num_rows()>0){
						$balnc=$this->db->where('invoiceno',$invoicenoss[$j])->select('balance')->get('invoice_details')->row_array();
					}else{
						$balnc=$this->db->where('invoiceno',$invoicenoss[$j])->select('balance')->get('invoice_details_backup')->row_array();
					}
					if($balnc['balance']==$voucheramount){
						$datass=array('vou_status'=>0,'balance'=>0);
						$diff=$voucheramount;
					}elseif($balnc['balance']<$voucheramount){
						if($voch>$balnc['balance']){
							$voch=$voch-$balnc['balance'];
							$datass=array('vou_status'=>0,'balance'=>0);
							$diff=$balnc['balance'];
						}elseif($voch<$balnc['balance']){
							$diff=$voch;
							$voch=$balnc['balance']-$voch;
							$datass=array('vou_status'=>1,'balance'=>$voch);
						}elseif($voch==$balnc['balance']){
							$datass=array('vou_status'=>0,'balance'=>0);
							$diff=$balnc['balance'];	
						}
					}elseif($balnc['balance']>$voucheramount){
						$vocher=$balnc['balance']-$voch;
						$datass=array('vou_status'=>1,'balance'=>$vocher);
						$diff=$voch;
					}
					$diff_array[]=$diff;
					if($this->db->where('invoiceno',@$invoicenoss[$j])->get('invoice_details')->num_rows()>0){
						$this->db->where('invoiceno',$invoicenoss[$j])->update('invoice_details',$datass);
					}else{
						$this->db->where('invoiceno',$invoicenoss[$j])->update('invoice_details_backup',$datass);
					}
				}
				$this->db->where('id',$insert_id)->set('balance_amt',implode('||', $diff_array))->update('voucher');
			}else{

				$purchasenos=implode('||',$_POST['purchaseno']);
				$purchasenoss=explode('||',$purchasenos);
				$voch=$voucheramount;
				$count=count($purchasenoss);
				for ($j=0; $j <  $count; $j++) 
				{
					if($this->db->where('purchaseno',$purchasenoss[$j])->get('purchase_details')->num_rows()>0){
						$balnc=$this->db->where('purchaseno',$purchasenoss[$j])->select('balance')->get('purchase_details')->row_array();
					}else{
						$balnc=$this->db->where('purchaseno',$purchasenoss[$j])->select('balance')->get('purchase_details_backup')->row_array();
					}
					if($balnc['balance']==$voucheramount){
						$datass=array('vou_status'=>0,'balance'=>0);
						$diff=$voucheramount;
					}elseif($balnc['balance']<$voucheramount){
						if($voch>$balnc['balance']){
							$voch=$voch-$balnc['balance'];
							$datass=array('vou_status'=>0,'balance'=>0);
							$diff=$balnc['balance'];
						}elseif($voch<$balnc['balance']){
							$diff=$voch;
							$voch=$balnc['balance']-$voch;
							$datass=array('vou_status'=>1,'balance'=>$voch);
						}elseif($voch==$balnc['balance']){
							$datass=array('vou_status'=>0,'balance'=>0);
							$diff=$balnc['balance'];	
						}
					}elseif($balnc['balance']>$voucheramount){
						$vocher=$balnc['balance']-$voch;
						$datass=array('vou_status'=>1,'balance'=>$vocher);
						$diff=$voch;
					}
					$diff_array[]=$diff;
//echo $invoicenos;
// $datass=array('vou_status'=>0);
					if($this->db->where('purchaseno',$purchasenoss[$j])->get('purchase_details')->num_rows()>0){
						$this->db->where('purchaseno',$purchasenoss[$j])->update('purchase_details',$datass);
					}else{
						$this->db->where('purchaseno',$purchasenoss[$j])->update('purchase_details_backup',$datass);
					}
				}
				$this->db->where('id',$insert_id)->set('balance_amt',implode('||', $diff_array))->update('voucher');

			}
// echo $this->db->last_query();
// exit();

			$this->db->query("UPDATE preference_settings SET voucher='' WHERE id=1");
			$this->session->set_flashdata('msg','voucher Added Successfully');
//Save Function and Redirect
			if($_POST['save']=='save')
			{
				redirect('voucher');
			}
			else
			{
//Print Function and Redirect
				redirect('voucher/bill');
			}
		}
		else
		{
			$this->session->set_flashdata('msg1','voucher Added Failed');
			redirect('voucher');
		}
	}



 Public function update()
  {
    //print_r($_POST);
	//exit;
    $id=$this->input->post('id');
	$otherBank=0;

	if($_POST['throughcheck']!='0') { $throughcheck=$_POST['throughcheck'];   if($throughcheck=='Other') { $otherBank=1; $throughcheck=$_POST['tcbankName']; } else { $otherBank=0; } } else { $throughcheck=''; }
	//exit;
	if($_POST['chequeno']!='') { $chequeno=$_POST['chequeno']; } else { $chequeno=''; }
	if($_POST['chamount']!='') { $chamount=$_POST['chamount']; } else { $chamount=''; }
	if($_POST['banktransfer']!='0') { $banktransfer=$_POST['banktransfer']; if($banktransfer=='Other') { $otherBank=1; $banktransfer=$_POST['ssbankName']; } else { $otherBank=0; }   } else { $banktransfer=''; }
 

    if($_POST['bamount']!='')
    {
      $bamount=$_POST['bamount'];
    }
    else
    {
      $bamount='';
    }
    if($_POST['amount']!='')
    {
      $amount=$_POST['amount'];
    }
    else
    {
      $amount='';
    }

    $payment=$_POST['paymentmode'];




    if($payment=='Cash')
    {
      $paymentdetails=$payment;
    }
    else if($payment=='Cheque')
    {
      $paymentdetails=$payment.' '.$throughcheck.' '.$_POST['chequeno'];
      $chequedate=$_POST['chequedate'];
    }
    else if($payment=='Bank')
    {
      $paymentdetails=$payment.' '.$banktransfer;
      $transactionid=$_POST['transactionid'];
    } 
    else if($payment=='Card')
    {
      $paymentdetails=$_POST['cardtype'];
    } 




    if($_POST['amount'])
    {
      $overallamount=$_POST['amount'];
      $voucheramount=$_POST['amount'];


    }

    else  if($_POST['bamount'])
    {
      $overallamount=$_POST['bamount'];
      $voucheramount=$_POST['bamount'];


    }

    else if($_POST['chamount'])
    {
      $overallamount=$_POST['chamount'];
      $voucheramount=$_POST['chamount'];

    }
    else if($_POST['cardamount'])
    {
      $overallamount=$_POST['cardamount'];
      $voucheramount=$_POST['cardamount'];

    }

  $voucherid=$_POST['voucherid'];
  $oldamount=$_POST['oldamount'];

  echo $voucheramount;

    // Customer Pay The voucher Amount Function
  if($_POST['vouchertype']=='payment')
  {
    $name=$_POST['name'];
    $balance = $_POST['balance'];
     $this->db->where("(type = 'Inter customer' OR type = 'Intra customer')");
     $this->db->where('name',$_POST['name']);
     $getcus=$this->db->get('customer_details')->result();
     if(count($getcus) > 0)
     {
      foreach($getcus as $g)
        $paid_amount=$g->paidamount-$oldamount;
        $paidamount=$paid_amount+$voucheramount;

        $balance_amount=$g->balanceamount+$oldamount;
        $balanceamount=$balance_amount-$voucheramount;

      $this->db->where('id',$g->id)->update('customer_details',array('paidamount'=>$paidamount,'balanceamount'=>$balanceamount));
     }
      else
     {
      $balanceamount='0.00';
     }

     
     

      @$invoiceamt='-';
      $da = array(

        'invoiceno'=>'-',
        'receiptno'=>$voucherid,
        'customername'=>$_POST['name'],
        'invoiceamt'=>$invoiceamt,
        'receiptamt'=>$overallamount,
        'paymentdetails'=>$paymentdetails,
        'balance'=>$balanceamount,
        'status'=>1
        ); 
        $this->db->where('receiptno',$voucherid);     
      $this->db->update('invoice_party_statement',$da);
   


  }

// Supplier Pay The voucher Amount Function
  else
  {
    $name=$_POST['name1'];
    $balance = $_POST['balance1'];
     $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
     $this->db->where('name',$_POST['name1']);
     $getcus=$this->db->get('customer_details')->result();
     if(count($getcus) > 0)
     {
      foreach($getcus as $g)
        $paid_amount=$g->paidamount-$oldamount;
        $paidamount=$paid_amount+$voucheramount;

        $balance_amount=$g->balanceamount+$oldamount;
        $balanceamount=$balance_amount-$voucheramount;

      $this->db->where('id',$g->id)->update('customer_details',array('paidamount'=>$paidamount,'balanceamount'=>$balanceamount));
     }
     else
     {
      $balanceamount='0.00';
     }

     

      @$invoiceamt='-';
      $da = array(

        'invoiceno'=>'-',
        'receiptno'=>$voucherid,
        'suppliername'=>$_POST['name1'],
        'purchaseamt'=>$invoiceamt,
        'receiptamt'=>$overallamount,
        'paymentdetails'=>$paymentdetails,
        'balance'=>$balanceamount,
        'status'=>1
        );
        $this->db->where('receiptno',$voucherid);      
      $this->db->update('po_party_statements',$da);
  }


  
    
    $data=array(
      'date'=>date('Y-m-d'),  
      'voucherid'=>$_POST['voucherid'],
      'name'=>$name,
      'vouchertype'=>$_POST['vouchertype'],
      'voucherdate'=>date('Y-m-d',strtotime($_POST['voucherdate'])),
	  'purpose'	=> $_POST['purpose'],
      'paymentmode'=>$_POST['paymentmode'],
      'throughcheck'=>$throughcheck,
      'chequeno'=>$chequeno,
      'chamount'=>$chamount,
      'banktransfer'=>$banktransfer,
      'bamount'=>$bamount,
      'amount'=>$amount,
      'paymentdetails'=>$paymentdetails,
      'transactionid'=>$transactionid,
      'chequedate'=>$chequedate,
      'overallamount'=>$overallamount,
      'voucheramount'=>$voucheramount,
	  'otherBank'=>$otherBank,
      'status'=>1
      );  

      $this->db->where('id',$id);
      $result=$this->db->update('voucher',$data);
      if($result==true)
      {
            $this->session->set_flashdata('msg','voucher update Successfully');
                 redirect('voucher/reports');
           
        
      }
      else
      {
        $this->session->set_flashdata('msg1','voucher Added Failed');
                redirect('voucher/reports');
      }
    

  }


  Public function add()
  {

    if($_POST['throughcheck']!='')
    {
      $throughcheck=$_POST['throughcheck'];
    }
    else
    {
      $throughcheck='';
    }
    if($_POST['chequeno']!='')
    {
      $chequeno=$_POST['chequeno'];
    }
    else
    {
      $chequeno='';
    }
    if($_POST['chamount']!='')
    {
      $chamount=$_POST['chamount'];
    }
    else
    {
      $chamount='';
    }
    if($_POST['banktransfer']!='')
    {
      $banktransfer=$_POST['banktransfer'];
    }
    else
    {
      $banktransfer='';
    }

    if($_POST['bamount']!='')
    {
      $bamount=$_POST['bamount'];
    }
    else
    {
      $bamount='';
    }
    if($_POST['amount']!='')
    {
      $amount=$_POST['amount'];
    }
    else
    {
      $amount='';
    }

    $payment=$_POST['paymentmode'];




    if($payment=='Cash')
    {
      $paymentdetails=$payment;
    }
    else if($payment=='Cheque')
    {
      $paymentdetails=$payment.' '.$throughcheck.' '.$_POST['chequeno'];
    }
    else if($payment=='Bank')
    {
      $paymentdetails=$payment.' '.$_POST['banktransfer'];
    } 




    if($_POST['amount'])
    {
      $overallamount=$_POST['amount'];
      $voucheramount=$_POST['amount'];


    }

    else  if($_POST['bamount'])
    {
      $overallamount=$_POST['bamount'];
      $voucheramount=$_POST['bamount'];


    }

    else if($_POST['chamount'])
    {
      $overallamount=$_POST['chamount'];
      $voucheramount=$_POST['chamount'];


    }


    if($overallamount == 0)

    {

      $this->session->set_flashdata('msg1','Added unsuccessfully');
      redirect('voucher');


    }

    $voucherid=$_POST['voucherid'];



    $total = $_POST['totalamount'];


    $paidamount = $_POST['paidamount'];


    $balance = $_POST['balance'];


    $pay = $overallamount;


    $paid=$paidamount+$pay;

    $balances=$balance-$pay;

    $data1=array('paidamount'=>$paid,'balanceamount'=>$balances);




    $datas = array(

      'date'=>date('Y-m-d'),
      'receiptdate'=>date('Y-m-d',strtotime($_POST['voucherdate'])),
      'receiptno'=>$voucherid,
      'customername'=>$_POST['name'],
      'paid'=>$overallamount,
      'paymentdetails'=>$paymentdetails,
      'status'=>1
      );

    @$invoiceamt='-';




    $da = array(

      'date'=>date('Y-m-d'),
      'receiptdate'=>date('Y-m-d',strtotime($_POST['voucherdate'])),
      'invoiceno'=>'-',
      'receiptno'=>$voucherid,
      'customername'=>$_POST['name'],
      'invoiceamt'=>$invoiceamt,
      'receiptamt'=>$overallamount,
      'paymentdetails'=>$paymentdetails,
      'status'=>1
      );



    $data=array(
      'date'=>date('Y-m-d'),  
      'voucherid'=>$_POST['voucherid'],
      'name'=>$_POST['name'],
      'vouchertype'=>$_POST['vouchertype'],
      'voucherdate'=>date('Y-m-d',strtotime($_POST['voucherdate'])),
      'purpose'=>$_POST['purpose'],
      'paymentmode'=>$_POST['paymentmode'],
// 'billno'=>$_POST['billno'],
// 'tinno'=>$_POST['tinno'],
// 'remarks'=>$_POST['remarks'],
      'throughcheck'=>$throughcheck,
      'chequeno'=>$chequeno,
      'chamount'=>$chamount,
      'banktransfer'=>$banktransfer,
      'bamount'=>$bamount,
      'amount'=>$amount,
      'paymentdetails'=>$paymentdetails,
      'overallamount'=>$overallamount,
      'voucheramount'=>$voucheramount,
      'status'=>1
      );  



    if($_POST['save']=='save')
    {
      $result=$this->db->insert('voucher',$data);
      if($result==true)
      {

        $this->db->where('id',$_POST['id'])->update('customer_details',$data1);
        $this->db->insert('collection_details',$datas);
        $this->db->insert('invoice_party_statement',$da);

        $this->session->set_flashdata('msg','voucher Added Successfully');

        redirect('invoice/pending_view');
      }
      else
      {
        $this->session->set_flashdata('msg1','voucher Added Failed');
        redirect('invoice/pending_view');
      }
    }

    if($_POST['print']=='print')
    {

      $result=$this->db->insert('voucher',$data);


      if($result==true)
      {
        $this->db->where('id',$_POST['id'])->update('customer_details',$data1);
        $this->db->insert('collection_details',$datas);
        $this->db->insert('invoice_party_statement',$da);

        $this->session->set_flashdata('msg','voucher Added Successfully');
        redirect('voucher/bill');
      }
      else
      {
        $this->session->set_flashdata('msg1','voucher Added Failed');
        redirect('voucher/bill');
      }
    }

  }


  public function bill()
  {
    $data['pre']=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('voucher')->result();
    foreach($data['pre'] as $b)
    {
      $totalamount= $b->voucheramount;
    }
    $number = $totalamount;
    $no = round($number);
// $point = round($number - $no, 2) * 100;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array('0' => '', '1' => 'One', '2' => 'Two',
      '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
      '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
      '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
      '13' => 'Thirteen', '14' => 'Fourteen',
      '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
      '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
      '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
      '60' => 'Sixty', '70' => 'Seventy',
      '80' => 'Eighty', '90' => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_1) {
      $divider = ($i == 2) ? 10 : 100;
      $number = floor($no % $divider);
      $no = floor($no / $divider);
      $i += ($divider == 10) ? 1 : 2;
      if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
        " " . $digits[$counter] . $plural . " " . $hundred
        :
        $words[floor($number / 10) * 10]
        . " " . $words[$number % 10] . " "
        . @$digits[$counter] . $plural . " " . $hundred;
      } 
      else $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
    $data['fin']=$result;
   $this->load->view('voucherbill',$data);
//$this->load->view('invoicebill',$data);
// $this->load->view('invoice_bill',$data);
  }

  public function reprint()
  {
    $id=$this->uri->segment(3);
// $this->load->library('mpdf'); 
    $data['pre']=$this->db->where('id',$id)->get('voucher')->result();

    foreach($data['pre'] as $b)
    {
      $number= $b->voucheramount;
    }
    $no = round($number);
// $point = round($number - $no, 2) * 100;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array('0' => '', '1' => 'One', '2' => 'Two',
      '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
      '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
      '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
      '13' => 'Thirteen', '14' => 'Fourteen',
      '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
      '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
      '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
      '60' => 'Sixty', '70' => 'Seventy',
      '80' => 'Eighty', '90' => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_1) {
      $divider = ($i == 2) ? 10 : 100;
      $number = floor($no % $divider);
      $no = floor($no / $divider);
      $i += ($divider == 10) ? 1 : 2;
      if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
        " " . $digits[$counter] . $plural . " " . $hundred
        :
        $words[floor($number / 10) * 10]
        . " " . $words[$number % 10] . " "
        . @$digits[$counter] . $plural . " " . $hundred;
      } 
      else $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
    $data['fin']=$result;

    $data['profile']=$this->db->get('profile')->result();
    $data['invoice']=$this->db->where('id',$id)->get('voucher')->result();
    $this->load->view('voucherbill',$data);
  }
  Public function reports()
  {
    $datass = $this->db->where('status',1)->get('preference_settings')->row();
   

    if($datass->voucher_receivable =='Without Invoice' && $datass->voucher_payable=='Without Purchase')
    {
    $data['voucher']=$this->voucher_model->select();
    $this->load->view('header');
    $this->load->view('voucher_view',$data);
    $this->load->view('footer1');
    }
    else
    {
      $data['voucher']=$this->voucher_model->select();
      $this->load->view('header');
      $this->load->view('voucher_againstview',$data);
      $this->load->view('footer1');
    }
  }

  public function ajax_list()
  {
    $dataz = $this->db->where('status',1)->get('preference_settings')->row();
    if($dataz->voucher_receivable=='Without Invoice' && $dataz->voucher_payable=='Without Purchase')
    {
    $list = $this->voucher_model->get_datatables();
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
      $row[] = date('d-m-Y',strtotime($person->voucherdate));
	  if($person->vouchertype=='receipt') { $row[] = 'Payable'; } else { $row[] = 'Receivable'; }
      $row[] =$person->voucherid;
      $row[] =$person->name;
      
      $row[] = $person->voucheramount;
	  if($person->paymentmode=='Cash')
	  {
		  $row[] = $person->paymentdetails.'('.date('d-m-Y',strtotime($person->voucherdate)).')';
	  }
	  elseif($person->paymentmode=='Cheque')
	  {
		  $row[] = $person->paymentdetails.'('.date('d-m-Y',strtotime($person->chequedate)).')';
	  }
	  else
	  {
		$row[] = $person->paymentdetails.'('.date('d-m-Y',strtotime($person->voucherdate)).')';// ('.$person->transactionid.')';  
	  }
      
      $row[] = '<div class="btn-group">
          <button type="button" class="btn
          btn-info dropdown-toggle waves-effect waves-light"
          data-toggle="dropdown" aria-expanded="false">Manage <span
          class="caret"></span></button>
          <ul class="dropdown-menu"
          role="menu" style="background: #23BDCF none repeat scroll
          0% 0%;width:14px;min-width: 100%;">

          <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('voucher/reprint/'.$person->id).'" title="Hapus" >Print</a></li>
          <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('voucher/edit/'.base64_encode($person->id)).'">Edit</a></li>
          <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('.$person->id.')">Delete</a></li>
        </ul>
      </div>';
     

      $data[] = $row;
    }
  }
  else
  {
    $list = $this->voucher_model->get_datatables();
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
      $row[] = date('d-m-Y',strtotime($person->voucherdate));
	  if($person->vouchertype=='receipt') { $row[] = 'Payable'; } else { $row[] = 'Receivable'; }
      $row[] = $person->purchaseno;
      $row[] = $person->invoiceno;
      $row[] =$person->voucherid;
      $row[] =$person->name;
      
      $row[] = $person->voucheramount;
	  if($person->paymentmode=='Cash')
	  {
		  $row[] = $person->paymentdetails.'('.date('d-m-Y',strtotime($person->voucherdate)).')';
	  }
	  elseif($person->paymentmode=='Cheque')
	  {
		  $row[] = $person->paymentdetails.'('.date('d-m-Y',strtotime($person->chequedate)).')';
	  }
	  else
	  {
		$row[] = $person->paymentdetails.'('.date('d-m-Y',strtotime($person->voucherdate)).')';// ('.$person->transactionid.')';  
	  }
      
      $row[] = '<div class="btn-group">
          <button type="button" class="btn
          btn-info dropdown-toggle waves-effect waves-light"
          data-toggle="dropdown" aria-expanded="false">Manage <span
          class="caret"></span></button>
          <ul class="dropdown-menu"
          role="menu" style="background: #23BDCF none repeat scroll
          0% 0%;width:14px;min-width: 100%;">

          <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('voucher/reprint/'.$person->id).'" title="Hapus" >Print</a></li>
          <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('voucher/edit/'.base64_encode($person->id)).'">Edit</a></li>
          <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('.$person->id.')">Delete</a></li>
        </ul>
      </div>';
     

      $data[] = $row;
    }
  }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->voucher_model->count_all(),
      "recordsFiltered" => $this->voucher_model->count_filtered(),
      "data" => $data,
      );
//output to json format
    echo json_encode($output);
  }

  public function edit()
{

  $id=base64_decode($this->uri->segment(3));
  $data['result']=$this->db->where('id',$id)->get('voucher')->result_array(); 
  $this->load->view('header');
  $this->load->view('edit_voucher',$data);
  $this->load->view('footer');

}

  public function autocomplete_name()
  {
    $name=$this->input->post('keyword');
//$cusname='ram';
    $this->db->select('*');
    $this->db->from('voucher');
    $this->db->like('name',$name);
	$this->db->group_by('name');
    $query = $this->db->get();
    $result = $query->result();
    $name       =  array();
    foreach ($result as $d) 
    {
      $json_array             = array();
      $json_array['value']    = $d->name;
      $json_array['label']    = $d->name;
      $name[]             = $json_array;
    }
    echo json_encode($name);
  }



  public function autocomplete_username()
  {
    $orderno=$this->input->post('keyword');
    $this->db->select('*');
    $this->db->from('customer_details');
    $this->db->where("(type = 'Inter customer' OR type = 'Intra customer')");

    $this->db->like('name',$orderno);
    $query = $this->db->get();
    $result = $query->result();
    $name       =  array();
    foreach ($result as $d)
    {
      $json_array             = array();
      $json_array['label']    = $d->name;
      $json_array['value']    = $d->name;
		$openingbalance = $d->openingbal;
		$pur=0;
		$ret=0;
		$rec=0;
		$balanceRes = $this->db->select('invoiceamt,returnamount,receiptamt,paid')->where('customername',$d->name)->get('invoice_party_statement')->result_array();
		if(count($balanceRes) > 0 )
		{
			foreach($balanceRes as $row)
			{
				$purchaseamt=$row['invoiceamt'];
				$purchases[]=$purchaseamt;
				$returnamount=$row['returnamount'];
				$returns[]=$returnamount;
				$receiptamt=$row['receiptamt'];
				$receiptamt = ($receiptamt!='')?$receiptamt:'0';
				$receiptamts[]=str_replace(",", "", $receiptamt);
				$paid=$row['paid'];
				$pay[]=$paid;

			}
			$pur=array_sum($purchases);
			$ret=array_sum($returns);
			$rec=array_sum($receiptamts);
			$p=array_sum($pay);
		}
		$balance=($openingbalance+$pur)-($ret+$rec);
		
		
      $json_array['customername'] = $d->name;
      // $json_array['totalamount'] = $d->salesamount;
      // $json_array['paidamount'] = $d->paidamount;
      $json_array['balance'] = $balance;//$openingbalance.'/'.$pur.'/'.$ret.'/'.$rec;
      $json_array['customerid'] = $d->id;
      $name[]             = $json_array;
    }
    unset($pur);
    unset($ret);
    unset($rec);
    unset($p);
    echo json_encode($name);
  }


  public function autocomplete_usernames()
  {
    $orderno=$this->input->post('keyword');
    $this->db->select('*');
    $this->db->from('customer_details');
    $this->db->where("(type = 'Inter customer' OR type = 'Intra customer')");

    $this->db->like('name',$orderno);
    $query = $this->db->get();
    $result = $query->result();
    $name       =  array();
    foreach ($result as $d)
    {
        $data['balance'] = $d->balanceamount;
     
     
    }
    echo json_encode($data);
  }



  public function autocomplete_username1()
  {
    $orderno=$this->input->post('keyword');
    $this->db->select('*');
    $this->db->from('customer_details');
    $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
    $this->db->like('name',$orderno);
    $query = $this->db->get();
    $result = $query->result();
    $name       =  array();
    foreach ($result as $d)
    {
      $json_array             = array();
      $json_array['label']    = $d->name;
      $json_array['value']    = $d->name;
      $json_array['customername'] = $d->name;
      // $json_array['totalamount'] = $d->salesamount;
      // $json_array['paidamount'] = $d->paidamount;
      $json_array['balance'] = $d->balanceamount;
      $json_array['customerid'] = $d->id;
      $name[]             = $json_array;
    }
    echo json_encode($name);
  }


  public function autocomplete_username1s()
  {
    $orderno=$this->input->post('keyword');
    $this->db->select('*');
    $this->db->from('customer_details');
    $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
    $this->db->like('name',$orderno);
    $query = $this->db->get();
    $result = $query->result();
    $name       =  array();
    foreach ($result as $d)
    {
      $data['balance'] = $d->balanceamount;
      
    }
    echo json_encode($data);
  }

  public function search()
  { 

    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');
    $name=$this->input->post('name');
	$type= $this->input->post('type');
    $data=array(
      'rcbio_fromdate' => $fromdate,
      'rcbio_todate' => $todate,
      'rcbio_name' => $name,
      'rcbio_bill_format' =>'Print',
	  'type' => $type,
      );
    $this->session->set_userdata($data);
  }


  public function billing_reportdownload()
  { 

    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');
    $name=$this->input->post('name');

    $data=array(
      'rcbio_fromdate' => $fromdate,
      'rcbio_todate' => $todate,
      'rcbio_name' => $name,
      'rcbio_bill_format' =>'Bill_Download',
      );
    $this->session->set_userdata($data);

  }


public function download()
  { 

    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');
    $name=$this->input->post('name');
    $type=$this->input->post('type');

    $data=array(
      'rcbio_fromdate' => $fromdate,
      'rcbio_todate' => $todate,
      'rcbio_name' => $name,
      'rcbio_type' => $type,
      'rcbio_bill_format' =>'Excel',
      );
    $this->session->set_userdata($data);

  }

public function excel_download(){
    
     $bill_format=$this->session->userdata('rcbio_bill_format'); 
     if($bill_format=='Excel'){
    $val=$this->voucher_model->search_billing();
$this->load->library('excel');
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('Voucher Reports');
//set cell A1 content with some text
$this->excel->getActiveSheet()->setCellValue('A1', 'Voucher DETAILS');
$this->excel->getActiveSheet()->setCellValue('A2', 'DATE');
$this->excel->getActiveSheet()->setCellValue('B2', 'TYPE');
$this->excel->getActiveSheet()->setCellValue('C2', 'VOUCHER ID');
$this->excel->getActiveSheet()->setCellValue('D2', 'NAME');
$this->excel->getActiveSheet()->setCellValue('E2', 'PAYMENT MODE');
$this->excel->getActiveSheet()->setCellValue('F2', 'AMOUNT');




//merge cell A1 until C1
$this->excel->getActiveSheet()->mergeCells('A1:F1');
//set aligment to center for that merged cell (A1 to C1)
$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//make the font become bold
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

for($col = ord('A'); $col <= ord('F'); $col++){
//set column dimension
$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
//change the font size
$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}
//retrive contries table data

//$rs = $this->db->get('countries');

$exceldata=array();
foreach ($val as $row)
{


$data['date']=date('d-m-Y',strtotime($row['date']));
$data['vouchertype']=$row['vouchertype'];
$data['voucherid']=$row['voucherid'];
$data['name']=$row['name'];
$data['paymentmode']=$row['paymentmode'];
$data['voucheramount']=$row['voucheramount'];

@$exceldata[] = $data;
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
$filename='Voucher Reports-'.date('d/m/y').'.xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache

//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
}
}



  public function getcustomer()
  {
    $name=$_POST['name'];
    $data=$this->db->where('name',$name)->where("(type = 'Inter customer' OR type = 'Intra customer')")->get('customer_details')->result();
    echo $count=count($data);

  }

  public function getsupplier()
  {
    $name=$_POST['name'];
    $data=$this->db->where('name',$name)->where("(type = 'Intra supplier' OR type = 'Inter supplier')")->get('customer_details')->result();
    echo $count=count($data);

  }



  public function search_reports()
  {   
    $bill_format=$this->session->userdata('rcbio_bill_format');                

    if($bill_format=='Print')
    {
      $data['purchase']=$this->voucher_model->search_billing();
      $data['fromdate']=$this->session->userdata('rcbio_fromdate');
      $data['todate']=$this->session->userdata('rcbio_todate');
      $data['name']=$this->session->userdata('rcbio_name');
	  $data['type']	 = $this->session->userdata('type');

      $this->load->view('voucher_reports',$data);

    }

    elseif($bill_format=='Bill_Download')
    {
      $this->load->helper('download');
      $this->load->library('mpdf');
      $purchase=$this->voucher_model->search_billing();
      $fromdate=$this->session->userdata('rcbio_fromdate');
      $todate=$this->session->userdata('rcbio_todate');
      $name=$this->session->userdata('rcbio_name');

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

$html='<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
<tr>
  <td height="80" align="center" style=""><p><img src="'.base_url().'logouploads/'. $logo.'" alt="DDD"></p>
    <p style="margin-top: -22px; font-size: 12px;"><h2><strong>'. $title.'</strong></h2></p>
    <p style="margin-top: -22px; font-size: 12px;"><strong>'. $address1.','. $address2.',</strong></p>
    <p style="margin-top: -10px; font-size: 12px;"><strong>Mobile :&nbsp;'. $mobileno.', E-Mail:&nbsp;'.$email.' </strong></p></td>
  </tr>

</table>

<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
  <tr style="font-size: 12px;">
    <td height="35" width="222" align="left" style="border-bottom:1px solid black;"><strong>Voucher Reports </strong></td>';


    if(@$name)
    {
      $sup=ucfirst($name);

    } 

    else
    {

      $sup="All Reports";

    }


    if(@$fromdate)
    {
      $frm='From Date :&nbsp;'. $fromdate.'';
    } 
    else
    {

    }
    if(@$todate){

      $to='To Date :&nbsp;'. $todate.''; 

    } 

    else
    {

    }
    $html.=' <td height="35" width="424" align="left" style="border-bottom:1px solid black;"><strong style="font-size:14px;">'.$sup.'&nbsp;&nbsp;&nbsp; '.$frm.' &nbsp;&nbsp;'.$to.'


  </strong></td>
</tr>
</table>

<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 12;">
  <tr>

    <td width="120" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
    <td width="120" align="left" style="border-bottom:1px solid black;"><strong>Name</strong></td>
    <td width="100" align="left" style="border-bottom:1px solid black;"><strong>Purpose</strong></td>
    <td width="144" align="left" style="border-bottom:1px solid black;"><strong>Payment Details</strong></td>

    <td width="60" align="right" style="border-bottom:1px solid black;"><strong>Amount</strong></td>



  </tr>';

  $i=1;
  $totalamount[]=array();
  foreach ($purchase as $row) {

    $suppliername=$row['name'];
    $paymentdetails=$row['paymentdetails'];
    $purpose=$row['purpose'];
    $overallamount=$row['overallamount'];
    $receiptdate=date('d-m-Y',strtotime($row['voucherdate']));



    $purchases[]=$overallamount;
    $pur=array_sum($purchases);

    $html.='<tr>


    <td align="left" style="border-bottom:1px dotted black;">'.$receiptdate.'</td>
    <td align="left" style="border-bottom:1px dotted black;">'. ucfirst($suppliername).'</td>
    <td align="left" style="border-bottom:1px dotted black;">'.$purpose.'</td>
    <td align="left" style="border-bottom:1px dotted black;">'.$paymentdetails.'</td>

    <td align="right" style="border-bottom:1px dotted black;">'.number_format($overallamount
      ,2).'</td>


  </tr>';
}
$html.='<tfoot>
<tr>
  <td width="43" height="29" align="left"><strong></strong></td>
  <td width="116" align="left" ><strong></strong></td>
  <td width="97" align="left" ><strong></strong></td>
  <td width="186" align="left" ><strong></strong></td>
  <td width="144" align="left" ><strong>&nbsp;</strong></td>

</tr>
</tfoot>

</table>


<table>
  <tr>
    <td width="43" height="29" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
    <td width="116" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
    <td width="97" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
    <td width="144" align="right" style="border-bottom:1px solid black;"><strong>Total Amount</strong></td>
    <td width="112" align="right" style="border-bottom:1px solid black;"><strong>'. number_format($pur,2).'</strong></td>
    <td width="186" align="right" style="border-bottom:1px solid black;"><strong></strong></td>

  </tr>


</table>'; 
$customername=$this->session->userdata('rcbio_name');

if(@$customername)

{
  $sups=$customername;
} 

else
{
// $sups='All';
}
// echo $html;
$mpdf->WriteHTML($html);  
// $mpdf->Output();
// $filename=date('d-m-Y').'Purchase Collection Reports.pdf';
//  $content = $mpdf->Output($filename,$sup, 'D');

$mpdf->Output($sups.' '.'voucher Reports'.' '.date('d-m-Y').'.pdf','d');

//   force_download($filename,$content); 
}

}


public function delete()
{
 $del=$this->input->post('id');
//   $del=base64_decode('Ng==');
  

   //$del=$this->input->post('id');  
  $getdetails=$this->db->where('id',$del)->get('voucher')->result_array();

      if($getdetails)
      {
        foreach ($getdetails as $rows) 
        {
          $voucherid=$rows['voucherid'];
          $name=$rows['name'];
          $vouchertype=$rows['vouchertype'];
          $voucheramount=$rows['voucheramount'];
        }

        if($vouchertype=='payment')
        {
           $this->db->where("(type = 'Inter customer' OR type = 'Intra customer')");
           $this->db->where('name',$name);
           $getcus=$this->db->get('customer_details')->result();
           
            foreach($getcus as $g)
            {
              $balanceamount=$g->balanceamount+$voucheramount;
              $paidamount=$g->paidamount-$voucheramount;
            }

            $invoice_no=explode("||",$rows['invoiceno']);
            for($j=0;$j<count($invoice_no);$j++){
                $in=$this->db->where('invoiceno',$invoice_no[$j])->get('invoice_details')->row()->grandtotal;
               $this->db->where('invoiceno',$invoice_no[$j])->update('invoice_details',array('balance'=>$in,'vou_status'=>1));
            }

            $this->db->where("(type = 'Inter customer' OR type = 'Intra customer')");
            $this->db->where('name',$name);
            $this->db->update('customer_details',array('paidamount'=>$paidamount,'balanceamount'=>$balanceamount));
            $this->db->where('receiptno',$voucherid);
            $this->db->delete('invoice_party_statement');

           
        }
        else
        {

          $purchase_no=explode("||",$rows['purchaseno']);
          for($k=0;$k<count($purchase_no);$k++){
              $in=$this->db->where('purchaseno',$purchase_no[$k])->get('purchase_details')->row()->grandtotal;
             $this->db->where('purchaseno',$purchase_no[$k])->update('purchase_details',array('balance'=>$in,'vou_status'=>1));
          }
            $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
             $this->db->where('name',$name);
             $getcus=$this->db->get('customer_details')->result();
             
              foreach($getcus as $g)
              {
                $balanceamount=$g->balanceamount+$voucheramount;
                $paidamount=$g->paidamount-$voucheramount;
              }
              $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
              $this->db->where('name',$name);
              $this->db->update('customer_details',array('paidamount'=>$paidamount,'balanceamount'=>$balanceamount));
              $this->db->where('receiptno',$voucherid);
              $this->db->delete('po_party_statements');
        }


      }
          



  $data=$this->db->where('id',$del)->delete('voucher');
       if($data)
       {
            

            //$this->session->set_flashdata('msg','Invoice Details  Deleted successfully!');
            echo'yes';
      }
      else
      {
        //$this->session->set_flashdata('msg1','Invoice Details  Deleted unsuccessfully');
        echo'no';   
          
      }

} 











}
ob_flush();
?>

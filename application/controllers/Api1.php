<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Api extends CI_Controller {



function validate()
{

$username=$_POST['username'];
$password=$_POST['password'];

$where=array('username' =>$username,
'password' =>$password);

$data1=$this->db->get_where('login_details',$where)->result_array();
if($data1)
{
$datas['result']='yes';

}

else
{
$datas['result']='no';
}

echo json_encode($datas);

}

 public function salesinvoice()
  {
  
    $this->db->select("*");
    $this->db->from("invoice_details");   
    $query= $this->db->get()->result_array();
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
         $data['result']='Success';
         $data['id']=$final['id'];
         $data['invoiceno']=$final['invoiceno'];
         $data['invoicedate']=$final['invoicedate'];
         $data['customername']=$final['customername'];
         $data['grandtotal']=$final['grandtotal'];
        
        $s[]=$data;
      }
    }
    else
    {
       $data['result']='Failed';
       $data['id']='';
       $data['invoiceno']='';
       $data['invoicedate']='';
       $data['customername']='';
       $data['grandtotal']='';
      $s[]=$data;
    }
    // $s=array($s);
     echo json_encode($s);
  
}



  public function bill()
  {
   $id=$this->uri->segment(3);


    $this->db->select("*");
    $this->db->from("invoice_details");        
    $this->db->where('id',$id);
    $query= $this->db->get()->result_array();
    
    $datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
    foreach ($datas as $profileimage) {
    $images=$profileimage->image;
    }
    
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
          $data['result']='Success';
        $data['id']=$final['id'];
        $data['date']=date('d-m-Y',strtotime($final['invoicedate']));
        //$data['gstinno']=$final['gstinno'];
        $data['invoiceno']=$final['invoiceno'];
        $data['customerId']=$final['customerId'];
        $data['customername']=$final['customername'];
        $cusname=$final['customername'];
        $cusid=$final['customerId'];
        $data['address']=$final['address'];
        $data['invoiceno']=$final['invoiceno'];
        $data['orderno']=$final['orderno'];
        $data['orderdate']=date('d-m-Y',strtotime($final['orderdate']));
        $data['billtype']=$final['billtype'];
        $data['gsttype']=$final['gsttype'];
        $data['typesgst']=$final['typesgst'];
        $data['typecgst']=$final['typecgst'];
        $data['typeigst']=$final['typeigst'];
        $data['hsnno']=$final['hsnno'];
        $data['itemname']=$final['itemname'];
        $data['item_desc']=$final['item_desc'];
        $data['uom']=$final['uom'];
        $data['rate']=$final['rate'];
        $data['qty']=$final['qty'];
        $data['amount']=$final['amount'];
        $data['discount']=$final['discount'];
        $data['discountamount']=$final['discountamount'];
        $data['taxableamount']=$final['taxableamount'];
        $data['sgst']=$final['sgst'];
        $data['sgstamount']=$final['sgstamount'];
        $data['cgst']=$final['cgst'];
        $data['cgstamount']=$final['cgstamount'];
        $data['igst']=$final['igst'];
    	$data['igstamount']=$final['igstamount'];
    	$data['total']=$final['total'];
    	$data['subtotal']=$final['subtotal'];
	    $data['freightamount']=$final['freightamount'];
	    $data['freightcgstamount']=$final['freightcgstamount'];
	    $data['freightsgstamount']=$final['freightsgstamount'];
	    $data['freightigstamount']=$final['freightigstamount'];
	    $data['freightcgst']=$final['freightcgst'];
	    $data['freightsgst']=$final['freightsgst'];
	    $data['freightigst']=$final['freightigst'];
	    $data['freighttotal']=$final['freighttotal'];
     	$data['loadingamount']=$final['loadingamount'];
     	$data['loadingcgstamount']=$final['loadingcgstamount'];
     	$data['loadingsgstamount']=$final['loadingsgstamount'];
     	$data['loadingigstamount']=$final['loadingigstamount'];
     	$data['loadingcgst']=$final['loadingcgst'];
     	$data['loadingsgst']=$final['loadingsgst'];
     	$data['loadingigst']=$final['loadingigst'];
     	$data['loadingtotal']=$final['loadingtotal'];
    	$data['othercharges']=$final['othercharges'];
    	$data['roundOff']=$final['roundOff'];
    	$data['grandtotal']=$final['grandtotal'];
    	$grandtotal=$final['grandtotal'];
    	
    	$no = round($grandtotal);
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

        $sd[]=$data;
      }
    }
    else
    {
        $data['result']='Failed';
       $data['id']='';
        $data['date']='';
      //  $data['gstinno']='';
        $data['invoiceno']='';
        $data['customerId']='';
        $data['customername']='';
        $data['address']='';
        $data['invoiceno']='';
        $data['billtype']='';
        $data['gsttype']='';
        $data['typesgst']='';
        $data['typecgst']='';
        $data['typeigst']='';
        $data['hsnno']='';
        $data['itemname']='';
        $data['item_desc']='';
        $data['uom']='';
        $data['rate']='';
        $data['qty']='';
        $data['amount']='';
        $data['discount']='';
        $data['discountamount']='';
        $data['taxableamount']='';
        $data['sgst']='';
        $data['sgstamount']='';
        $data['cgst']='';
        $data['cgstamount']='';
        $data['igst']='';
	$data['igstamount']='';
	$data['total']='';
	$data['subtotal']='';
	$data['freightamount']='';
	$data['loadingamount']='';
	$data['othercharges']='';
	$data['grandtotal']='';
        $sd[]=$data;
    } 
    
    $this->db->select("*");
    $this->db->from("profile");   
    $query= $this->db->get()->result_array();
     if(count($query) > 0)
    {
  
      foreach($query as $final)
      {
          $data1['result']='Success';
         $data1['companyname']=$final['companyname'];
         $data1['id']=$final['id'];
         $data1['phoneno']=$final['phoneno'];
         $data1['mobileno']=$final['mobileno'];
         $data1['address1']=$final['address1'];
         $data1['address2']=$final['address2'];
         $data1['city']=$final['city'];
         $data1['email']=$final['emailid'];
         $data1['pincode']=$final['pincode'];
         $data1['stateCode']=$final['stateCode'];
         $data1['gstin']=$final['gstin'];
         $data1['bankname']=$final['bankname'];
         $data1['accountno']=$final['accountno'];
         $data1['bankbranch']=$final['bankbranch'];
         $data1['ifsccode']=$final['ifsccode'];
        
        $cd[]=$data1;
      }
      }
      
    else
    {
        $data1['result']='Failed';
       $data1['companyname']='';
       $data1['id']='';
       $data1['phoneno']='';
       $data1['address1']='';
       $data1['address2']='';
       $data1['pincode']='';
       $data1['stateCode']='';
       $data1['email']='';
       $data1['gstin']='';
       $data1['bankname']='';
       $data1['accountno']='';
       $data1['bankbranch']='';
       $data1['ifsccode']='';
      $cd[]=$data1;
    }
   
    // $sd=array('bill'=>$sd,'address'=>$cd);
    // echo json_encode($sd);
    
    $this->db->select("*");
    $this->db->where('name',$cusname);
    $this->db->where('id',$cusid);
    $this->db->from("customer_details");   
    $querys= $this->db->get()->result_array();
     if(count($querys) > 0)
    {
  
      foreach($querys as $final)
      {
          $data2['result']='Success';
         $data2['cusaddress1']=$final['address1'];
         $data2['cusaddress2']=$final['address2'];
         $data2['cuscity']=$final['city'];
         $data2['cusstate']=$final['state'];
         $data2['cuspincode']=$final['pincode'];
         $data2['cusphoneno']=$final['phoneno'];
         $data2['cusstateCode']=$final['statecode'];
         $data2['cusgstin']=$final['gstno'];
        
        $cusdata[]=$data2;
      }
      }
      
    else
    {
        $data2['result']='Failed';
       $data2['cusphoneno']='';
       $data2['cusaddress1']='';
       $data2['cusaddress2']='';
       $data2['cuscity']='';
       $data2['cusstateCode']='';
       $data2['cusgstin']='';
       $data2['cuspincode']='';
      
      $cusdata[]=$data2;
    }
   
    $sd=array('bill'=>$sd,'address'=>$cd,'cusdetail'=>$cusdata);
    echo json_encode($sd);
 
  }
  
  
   public function dcreport()
  {
  
    $this->db->select("*");
    $this->db->from("dcbill_details");   
    $query= $this->db->get()->result_array();
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
         $data['result']='Success';
         $data['id']=$final['id'];
         $data['dctype']=$final['dctype'];
         $data['dcno']=$final['dcno'];
         $data['dcdate']=date('d-m-Y',strtotime($final['dcdate']));
         $data['inwardno']=$final['inwardno'];
         $data['cusname']=$final['cusname'];
        
        $s[]=$data;
      }
    }
    else
    {
      $data['result']='Failed'; 
       $data['id']='';
       $data['dctype']='';
       $data['dcno']='';
       $data['dcdate']='';
       $data['inwardno']='';
       $data['cusname']='';
      $s[]=$data;
    }
    // $s=array($s);
     echo json_encode($s);
  
}


public function dcbill()
  {
   $id=$this->uri->segment(3);


    $this->db->select("*");
    $this->db->from("dcbill_details");        
    $this->db->where('id',$id);
    $query= $this->db->get()->result_array();
    
    
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
          $data['result']='Success';
        $data['id']=$final['id'];
        $data['date']=date('d-m-Y',strtotime($final['dcdate']));
        //$data['gstinno']=$final['gstinno'];
        $data['dcno']=$final['dcno'];
        $data['customerId']=$final['customerId'];
        $data['cusname']=$final['cusname'];
        $cusname=$final['cusname'];
        $cusid=$final['customerId'];
        $data['address']=$final['address'];
        $data['inwardno']=$final['inwardno'];
        $data['customerdcno']=$final['customerdcno'];
        $data['hsnno']=$final['hsnno'];
        $data['itemname']=$final['itemname'];
        $data['item_desc']=$final['item_desc'];
        $data['uom']=$final['uom'];
        $data['qty']=$final['qty'];
        $data['remarks']=$final['remarks'];



        $sd[]=$data;
      }
    }
    else
    {
        $data['result']='Failed';
       $data['id']='';
        $data['date']='';
      //  $data['gstinno']='';
        $data['dcno']='';
        $data['customerId']='';
        $data['cusname']='';
        $data['address']='';
        $data['inwardno']='';
        $data['customerdcno']='';
        $data['hsnno']='';
        $data['itemname']='';
        $data['item_desc']='';
        $data['uom']='';
        $data['rate']='';
        $data['qty']='';
        $data['remarks']='';

        $sd[]=$data;
    } 
    
    $this->db->select("*");
    $this->db->from("profile");   
    $query= $this->db->get()->result_array();
     if(count($query) > 0)
    {
  
      foreach($query as $final)
      {
          $data1['result']='Success';
         $data1['companyname']=$final['companyname'];
         $data1['id']=$final['id'];
         $data1['phoneno']=$final['phoneno'];
         $data1['mobileno']=$final['mobileno'];
         $data1['address1']=$final['address1'];
         $data1['address2']=$final['address2'];
         $data1['city']=$final['city'];
         $data1['email']=$final['emailid'];
         $data1['pincode']=$final['pincode'];
         $data1['stateCode']=$final['stateCode'];
         $data1['gstin']=$final['gstin'];
         $data1['bankname']=$final['bankname'];
         $data1['accountno']=$final['accountno'];
         $data1['bankbranch']=$final['bankbranch'];
         $data1['ifsccode']=$final['ifsccode'];
        
        $cd[]=$data1;
      }
      }
      
    else
    {
        $data1['result']='Failed';
       $data1['companyname']='';
       $data1['id']='';
       $data1['phoneno']='';
       $data1['address1']='';
       $data1['address2']='';
       $data1['pincode']='';
       $data1['stateCode']='';
       $data1['email']='';
       $data1['gstin']='';
       $data1['bankname']='';
       $data1['accountno']='';
       $data1['bankbranch']='';
       $data1['ifsccode']='';
      $cd[]=$data1;
    }
   
    // $sd=array('bill'=>$sd,'address'=>$cd);
    // echo json_encode($sd);
    
    $this->db->select("*");
    $this->db->where('name',$cusname);
    $this->db->where('id',$cusid);
    $this->db->from("customer_details");   
    $querys= $this->db->get()->result_array();
     if(count($querys) > 0)
    {
  
      foreach($querys as $final)
      {
          $data2['result']='Success';
         $data2['cusaddress1']=$final['address1'];
         $data2['cusaddress2']=$final['address2'];
         $data2['cuscity']=$final['city'];
         $data2['cusstate']=$final['state'];
         $data2['cuspincode']=$final['pincode'];
         $data2['cusphoneno']=$final['phoneno'];
         $data2['cusstateCode']=$final['statecode'];
         $data2['cusgstin']=$final['gstno'];
        
        $cusdata[]=$data2;
      }
      }
      
    else
    {
        $data2['result']='Failed';
       $data2['cusphoneno']='';
       $data2['cusaddress1']='';
       $data2['cusaddress2']='';
       $data2['cuscity']='';
       $data2['cusstateCode']='';
       $data2['cusgstin']='';
       $data2['cuspincode']='';
      
      $cusdata[]=$data2;
    }
   
    $sd=array('bill'=>$sd,'address'=>$cd,'cusdetail'=>$cusdata);
    echo json_encode($sd);
 
  }
  
  
    public function stock_detail()
  {
  
    $this->db->select("*");
    $this->db->from("stock");   
    $query= $this->db->get()->result_array();
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
          $data['result']='Success';
        $data['id']=$final['id'];
        $data['date']=date('d-m-Y',strtotime($final['date']));
        $data['itemname']=$final['itemname'];
        $data['rate']=$final['rate'];
        $data['hsnno']=$final['hsnno'];
        $data['balance']=$final['balance'];
        $s[]=$data;
      }
    }
    else
    {
        $data['result']='Failed';
      $data['id']='';
      $data['date']='';
      $data['itemname']='';
      $data['rate']='';
      $data['hsnno']='';
      $data['balance']='';
      $s[]=$data;
    }
    
    echo json_encode($s);
  }


    public function voucher_report()
  {
  
    $this->db->select("*");
    $this->db->from("voucher");   
    $query= $this->db->get()->result_array();
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
          $data['result']='Success';
        $data['id']=$final['id'];
        $data['date']=date('d-m-Y',strtotime($final['voucherdate']));
        $data['vouchertype']=$final['vouchertype'];
        $data['vouchertype']=$final['voucherid'];
        $data['name']=$final['name'];
        $data['voucheramount']=$final['voucheramount'];
        $data['paymentdetails']=$final['paymentdetails'];
        $s[]=$data;
      }
    }
    else
    {
        $data['result']='Failed';
      $data['id']='';
      $data['date']='';
      $data['vouchertype']='';
      $data['voucherid']='';
      $data['name']='';
      $data['voucheramount']='';
      $data['paymentdetails']='';
      $s[]=$data;
    }
    
    echo json_encode($s);
  }
  
   public function expense_report()
  {
  
    $this->db->select("*");
    $this->db->from("expenses");   
    $query= $this->db->get()->result_array();
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
          $data['result']='Success';
        $data['id']=$final['id'];
        $data['date']=date('d-m-Y',strtotime($final['expensesdate']));
        $data['headers']=$final['headers'];
        $data['purpose']=$final['purpose'];
        $data['name']=$final['name'];
        $data['paymentdetails']=$final['paymentdetails'];
        $data['overallamount']=$final['overallamount'];
        $s[]=$data;
      }
    }
    else
    {
        $data['result']='Failed';
      $data['id']='';
      $data['date']='';
      $data['headers']='';
      $data['purpose']='';
      $data['name']='';
      $data['overallamount']='';
      $data['paymentdetails']='';
      $s[]=$data;
    }
   
    echo json_encode($s);
  }
  

  public function inwardreport()
  {
  
    $this->db->select("*");
    $this->db->from("inward_details");   
    $query= $this->db->get()->result_array();
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
         $data['result']='Success';
         $data['id']=$final['id'];
         $data['inwarddate']=date('d-m-Y',strtotime($final['inwarddate']));
         $data['inwardno']=$final['inwardno'];
         $data['cusname']=$final['cusname'];
          $data['customerdcno']=$final['customerdcno'];
         $data['date']=date('d-m-Y',strtotime($final['customerdcdate']));

        
        $s[]=$data;
      }
    }
    else
    {
       $data['result']='Failed';
       $data['id']='';
       $data['dcdate']='';
       $data['inwardno']='';
       $data['cusname']='';
       $data['customerdcno']='';
       $data['customerdcdate']='';
    }
    // $s=array($s);
     echo json_encode($s);
  
}

 public function purchase_report()
  {
  
    $this->db->select("*");
    $this->db->from("purchase_details");   
    $query= $this->db->get()->result_array();
    if(count($query) > 0)
    {
        
      foreach($query as $final)
      {
         $data['result']='Success';
         $data['id']=$final['id'];
         $data['purchaseno']=$final['purchaseno'];
         $data['invoicedate']=$final['invoicedate'];
         $data['suppliername']=$final['suppliername'];
         $data['grandtotal']=$final['grandtotal'];
        
        $s[]=$data;
      }
    }
    else
    {
       $data['result']='Failed';
       $data['id']='';
       $data['purchaseno']='';
       $data['invoicedate']='';
       $data['suppliername']='';
       $data['grandtotal']='';
      $s[]=$data;
    }
    // $s=array($s);
     echo json_encode($s);
  
}

public function quotationreport()
{
    
    
    $data=$this->db->order_by("date","desc")->get('quotation_details')->result_array();
   
    if($data)
    {
        foreach($data as $row)
        {
            $datas['result']='Success';
            $datas['date']=$row['date'];
            $datas['quotationdate']=$row['quotationdate'];
                        $datas['quotationno']=$row['quotationno'];

            $datas['customername']=$row['customername'];
            $datas['total']=$row['total'];
            $datas['id']=$row['id'];
              $results[]=$datas;
        }
    }
    else
    {
        $datas['result']='Failed';
         $datas['date']='';
            $datas['quotationdate']='';
            $datas['customername']='';
                        $datas['quotationno']='';

            $datas['total']='';
            $datas['id']='';
              $results[]=$datas;
    }
  
    echo json_encode($results);
}

public function quotationbill()
  {
   $id=$this->uri->segment(3);


    $this->db->select("*");
    $this->db->from("quotation_details");        
    $this->db->where('id',$id);
    $query= $this->db->get()->result_array();
    //   print_r($query);die;
    $datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
    foreach ($datas as $profileimage) {
    $images=$profileimage->image;
    }
    
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
        
         $data['result']='Success';
        $data['id']=$final['id'];
        $data['date']=date('d-m-Y',strtotime($final['quotationdate']));
        //$data['gstinno']=$final['gstinno'];
        $data['quotationno']=$final['quotationno'];
        $data['customerId']=$final['customerId'];
        $data['customername']=$final['customername'];
        $cusname=$final['customername'];
        $cusid=$final['customerId'];
        $data['address']=$final['address'];
        $data['billtype']=$final['billtype'];
        $data['gsttype']=$final['gsttype'];
        $data['typesgst']=$final['typesgst'];
        $data['typecgst']=$final['typecgst'];
        $data['typeigst']=$final['typeigst'];
        $data['hsnno']=$final['hsnno'];
        $data['itemname']=$final['itemname'];
        $data['uom']=$final['uom'];
        $data['rate']=$final['rate'];
        $data['qty']=$final['qty'];
        $data['amount']=$final['amount'];
        $data['discount']=$final['discount'];
        $data['discountamount']=$final['discountamount'];
        $data['taxableamount']=$final['taxableamount'];
        $data['sgst']=$final['sgst'];
        $data['sgstamount']=$final['sgstamount'];
        $data['cgst']=$final['cgst'];
        $data['cgstamount']=$final['cgstamount'];
        $data['igst']=$final['igst'];
        $data['igstamount']=$final['igstamount'];
        $data['total']=$final['total'];
        $data['subtotal']=$final['subtotal'];
        $data['othercharges']=$final['othercharges'];
        $data['grandtotal']=$final['grandtotal'];
        $grandtotal=$final['grandtotal'];
  
      $no = round($grandtotal);
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

        $sd[]=$data;
      }
    }
    else
    {
        $data['result']='Failed';
       $data['id']='';
        $data['date']='';
      //  $data['gstinno']='';
        $data['invoiceno']='';
        $data['customerId']='';
        $data['customername']='';
        $data['address']='';
        $data['billtype']='';
        $data['gsttype']='';
        $data['typesgst']='';
        $data['typecgst']='';
        $data['typeigst']='';
        $data['hsnno']='';
        $data['itemname']='';
        $data['uom']='';
        $data['rate']='';
        $data['qty']='';
        $data['amount']='';
        $data['discount']='';
        $data['discountamount']='';
        $data['taxableamount']='';
        $data['sgst']='';
        $data['sgstamount']='';
        $data['cgst']='';
        $data['cgstamount']='';
        $data['igst']='';
        $data['igstamount']='';
        $data['total']='';
        $data['subtotal']='';
        $data['othercharges']='';
        $data['grandtotal']='';
        $sd[]=$data;
    } 
    
    $this->db->select("*");
    $this->db->from("profile");   
    $query= $this->db->get()->result_array();
     if(count($query) > 0)
    {
  
      foreach($query as $final)
      {
          $data1['result']='Success';
         $data1['companyname']=$final['companyname'];
         $data1['id']=$final['id'];
         $data1['phoneno']=$final['phoneno'];
         $data1['mobileno']=$final['mobileno'];
         $data1['address1']=$final['address1'];
         $data1['address2']=$final['address2'];
         $data1['city']=$final['city'];
         $data1['email']=$final['emailid'];
         $data1['pincode']=$final['pincode'];
         $data1['stateCode']=$final['stateCode'];
         $data1['gstin']=$final['gstin'];
         $data1['bankname']=$final['bankname'];
         $data1['accountno']=$final['accountno'];
         $data1['bankbranch']=$final['bankbranch'];
         $data1['ifsccode']=$final['ifsccode'];
        
        $cd[]=$data1;
      }
      }
      
    else
    {
        $data1['result']='Failed';
       $data1['companyname']='';
       $data1['id']='';
       $data1['phoneno']='';
       $data1['address1']='';
       $data1['address2']='';
       $data1['pincode']='';
       $data1['stateCode']='';
       $data1['email']='';
       $data1['gstin']='';
       $data1['bankname']='';
       $data1['accountno']='';
       $data1['bankbranch']='';
       $data1['ifsccode']='';
      $cd[]=$data1;
    }
   
    // $sd=array('bill'=>$sd,'address'=>$cd);
    // echo json_encode($sd);
    
    $this->db->select("*");
    $this->db->where('name',$cusname);
    $this->db->where('id',$cusid);
    $this->db->from("customer_details");   
    $querys= $this->db->get()->result_array();
     if(count($querys) > 0)
    {
  
      foreach($querys as $final)
      {
         $data2['result']='Success';
         $data2['cusaddress1']=$final['address1'];
         $data2['cusaddress2']=$final['address2'];
         $data2['cuscity']=$final['city'];
         $data2['cusstate']=$final['state'];
         $data2['cuspincode']=$final['pincode'];
         $data2['cusphoneno']=$final['phoneno'];
         $data2['cusstateCode']=$final['statecode'];
         $data2['cusgstin']=$final['gstno'];
        
        $cusdata[]=$data2;
      }
      }
      
    else
    {
        $data2['result']='Failed';
       $data2['cusphoneno']='';
       $data2['cusaddress1']='';
       $data2['cusaddress2']='';
       $data2['cuscity']='';
       $data2['cusstateCode']='';
       $data2['cusgstin']='';
       $data2['cuspincode']='';
      
      $cusdata[]=$data2;
    }
   
    $sd=array('bill'=>$sd,'address'=>$cd,'cusdetail'=>$cusdata);
    echo json_encode($sd);
 
  }
  
  public function proforma()
   {
  
    $this->db->select("*");
    $this->db->from("proforma_invoice_details");   
    $query= $this->db->get()->result_array();
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
         $data['result']='Success';
         $data['id']=$final['id'];
         $data['invoiceno']=$final['invoiceno'];
         $data['invoicedate']=$final['invoicedate'];
         $data['customername']=$final['customername'];
         $data['grandtotal']=$final['grandtotal'];
        
        $s[]=$data;
      }
    }
    else
    {
       $data['result']="Failed";
       $data['id']='';
       $data['invoiceno']='';
       $data['invoicedate']='';
       $data['customername']='';
       $data['grandtotal']='';
      $s[]=$data;
    }
    // $s=array($s);
     echo json_encode($s);
  
}

public function party_statement()
   {
  
    $this->db->select("*");
    $this->db->from("invoice_party_statement");   
    $query= $this->db->get()->result_array();
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
         $data['result']='Success';
         $data['date']=$final['date'];
         $data['invoiceno']=$final['invoiceno'];
         $data['receiptno']=$final['receiptno'];
         $data['customername']=$final['customername'];
         $data['amt']=$final['overallamount'];
         $data['receiptamt']=$final['receiptamt'];
         $data['paymentmode']=$final['paymentdetails'];
         $data['return']=$final['returnamount'];
         
        
        $s[]=$data;
      }
    }
    else
    {
       $data['result']='Failed';
         $data['date']='';
         $data['invoiceno']='';
         $data['receiptno']='';
         $data['customername']='';
         $data['amt']='';
         $data['receiptamt']='';
         $data['paymentmode']='';
         $data['return']='';
    }
    // $s=array($s);
     echo json_encode($s);
  
}

public function profile()
{
      {
  
    $this->db->select("*");
    $this->db->from("profile");   
    $query= $this->db->get()->result_array();
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
         $data['result']='Success';
         $data['companyname']=$final['companyname'];
         $data['softwarename']=$final['softwarename'];
         $data['mobileno']=$final['mobileno'];
         $data['email']=$final['emailid'];
         $data['address1']=$final['address1'];
         $data['address2']=$final['address2'];
         $data['city']=$final['city'];
         $data['pincode']=$final['pincode'];
         $data['state']=$final['stateCode'];
         
        
        $s[]=$data;
      }
    }
    else
    {
         $data['result']='Failed';
         $data['companyname']='';
         $data['softwarename']='';
         $data['mobileno']='';
         $data['email']='';
         $data['address1']='';
         $data['address2']='';
         $data['city']='';
         $data['pincode']='';
         $data['state']='';
    }
    // $s=array($s);
     echo json_encode($s);
  
}
}


public function tax_report()
{
      {
  
    $this->db->select("*");
    $this->db->from("invoice_reports");   
    $query= $this->db->get()->result_array();
    if(count($query) > 0)
    {
      foreach($query as $final)
      {
         $data['result']='Success';
         $data['date']=$final['date'];
         $data['invoiceno']=$final['invoiceno'];
         $data['customername']=$final['customername'];
         $data['mobileno']=$final['mobileno'];
         $data['gsttype']=$final['gsttype'];
         $data['grandtotal']=$final['grandtotal'];
       
        
        $s[]=$data;
      }
    }
    else
    {
         $data['result']='Failed';
       $data['date']='';
         $data['invoiceno']='';
         $data['customername']='';
         $data['mobileno']='';
         $data['gsttype']='';
         $data['grandtotal']='';
    }
    // $s=array($s);
     echo json_encode($s);
  
}
}

public function chart()
{
    
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
		
		if($totalReceived > 0)
		{
		    $received = $totalReceived;
		}
		else
		{
		    $received = 0;
		}
		$data['sales'] = $totalSales-$totalReturn;
		$sales = $totalSales-$totalReturn;
		$data['receivable'] = $totalReceived;
		$data['salesBalance']=$data['sales']-$totalReceived;
		$salesBalance = $sales-$totalReceived;
		$curMonthSales = $this->db->select_sum('grandtotal')->where('invoicedate >= ',$first_day_this_month)->where('invoicedate <= ',$last_day_this_month)->get('invoice_details')->row()->grandtotal;
		$curMonthReturn = $this->db->select_sum('grandtotal')->where('types','Debit')->where('returndate >= ',$first_day_this_month)->where('returndate <= ',$last_day_this_month)->get('sales_return')->row()->grandtotal;
		$data['curMonthSales']=$curMonthSales-$curMonthReturn;
		
      $curMonthSales = $curMonthSales-$curMonthReturn;
      
		//PURCHASE
		$totalPurchase = $this->db->select_sum('grandtotal')->get('purchase_details')->row()->grandtotal;
		$totalPReturn = $this->db->select_sum('grandtotal')->get('sales_return')->row()->grandtotal;
		$totalPaid = $this->db->select_sum('overallamount')->where('vouchertype','receipt')->get('voucher')->row()->overallamount;
			if($totalPaid > 0)
		{
		    $paid = $totalPaid;
		}
		else
		{
		    $paid = 0;
		}
	
		$data['purchase'] = $totalPurchase-$totalPReturn;
		$purchase = $totalPurchase-$totalPReturn;
		$data['payable'] = $totalPaid;
		$data['purchaseBalance']=$data['purchase']-$totalPaid;
		$purchaseBalance = $purchase-$totalPaid;
		$curMonthPurchase = $this->db->select_sum('grandtotal')->where('invoicedate >= ',$first_day_this_month)->where('invoicedate <= ',$last_day_this_month)->get('purchase_details')->row()->grandtotal;
		$curMonthPReturn = $this->db->select_sum('grandtotal')->where('types','Credit')->where('returndate >= ',$first_day_this_month)->where('returndate <= ',$last_day_this_month)->get('sales_return')->row()->grandtotal;
		$data['curMonthpurchase'] = $curMonthPurchase-$curMonthPReturn;
		$curMonthpurchase = $curMonthPurchase-$curMonthPReturn;
		
		//echo $totalReceived;
		//exit;
		$totalExpenses = $this->db->select_sum('overallamount')->get('expenses')->row()->overallamount;
		$currExpenses= $this->db->select_sum('overallamount')->where('expensesdate >= ',$first_day_this_month)->where('expensesdate <= ',$last_day_this_month)->get('expenses')->row()->overallamount;
				if($currExpenses > 0)
		{
		    $expenses = $currExpenses;
		}
		else
		{
		    $expenses = 0;
		}
		
		
		$data['invoice']=$this->db->get('invoice_details')->result_array();
		
		$datas['curMonthSales']= strval($curMonthSales);
		$datas['curMonthpurchase'] = strval($curMonthpurchase);
		$datas['curMonthreceivable'] = strval($received);
		$datas['curMonthpayable'] = strval($paid);
		$datas['salesBalance'] = strval($salesBalance);
		$datas['purchaseBalance']= strval($purchaseBalance);
		$datas['expense'] = strval($expenses);
		
		$s[] = $datas;
    

		echo json_encode($s);
	
}
 

}  
ob_flush();
?>

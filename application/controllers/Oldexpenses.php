<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Oldexpenses extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('oldexpense_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}	
    date_default_timezone_set('Asia/Kolkata');

	}
		
	Public function reports()
	{
		$data['expenses']=$this->oldexpense_model->select();;
		$this->load->view('header');
		$this->load->view('oldexpensesview',$data);
		$this->load->view('footer1');
	}

	public function ajax_list()
	{
		$list = $this->oldexpense_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$a=1;
		$totalamount[]=array();
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $a++;
			$row[] = date('d-m-Y',strtotime($person->expensesdate));
			$row[] =$person->name;
			$row[] =$person->headers;
			$row[] =$person->purpose;
			$row[] = $person->paymentmode;
			$row[] = $person->paymentdetails;
			$row[] = $person->overallamount;
			 $row[] = '
			 <div class="btn-group">
				<button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light"  data-toggle="dropdown" aria-expanded="false">Manage <span class="caret"></span></button>
				<ul class="dropdown-menu"  role="menu" style="background: #23BDCF none repeat scroll 0% 0%;width:14px;min-width: 100%;">
					<li><a class="btn btn-sm btn-success" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('oldexpenses/reprint/'.$person->id).'" title="Print" ><i class="glyphicon glyphicon-print"></i>&nbsp;Print</a></li>
					
				</ul>
			</div>
			';
			//$row[] = '<a class="btn btn-sm btn-success" target="_blank" href="'.base_url('expenses/reprint/'.$person->id).'" title="Print" ><i class="glyphicon glyphicon-print"></i></a>';
			$data[] = $row;
		}
		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $this->oldexpense_model->count_all(),
		"recordsFiltered" => $this->oldexpense_model->count_filtered(),
		"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	
  public function bill()
  {
    $data['pre']=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('expenses_backup')->result();
    foreach($data['pre'] as $b)
    {
      $totalamount= $b->overallamount;
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

    $this->load->view('expensesbill',$data);
    //$this->load->view('invoicebill',$data);
// $this->load->view('invoice_bill',$data);
  }

  public function reprint()
  {
   $id=$this->uri->segment(3);
  // $this->load->library('mpdf'); 
  $data['pre']=$this->db->where('id',$id)->get('expenses_backup')->result();
  
  foreach($data['pre'] as $b)
  {
    $number= $b->overallamount;
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
  $data['invoice']=$this->db->where('id',$id)->get('expenses_backup')->result();
  $this->load->view('expensesbill',$data);
  }


       public function autocomplete_name()
  {
    $name=$this->input->post('keyword');
//$cusname='ram';
    $this->db->select('*');
    $this->db->from('expenses_backup');
    $this->db->like('name',$name);
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

    		public function search()
              { 

                $fromdate=$this->input->post('fromdate');
                $todate=$this->input->post('todate');
                $name=$this->input->post('name');

               $data=array(
                        'rcbio_fromdate' => $fromdate,
                        'rcbio_todate' => $todate,
                        'rcbio_name' => $name,
                        'rcbio_bill_format' =>'Print',
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




				public function search_reports()
    {   
        $bill_format=$this->session->userdata('rcbio_bill_format');                
                
                if($bill_format=='Print')
                {
                  $data['purchase']=$this->oldexpense_model->search_billing();
                  $data['fromdate']=$this->session->userdata('rcbio_fromdate');
                  $data['todate']=$this->session->userdata('rcbio_todate');
                  $data['name']=$this->session->userdata('rcbio_name');

                  $this->load->view('expnses_reports',$data);
                  
                 }

                                  elseif($bill_format=='Bill_Download')
                {
                  $this->load->helper('download');
                  $this->load->library('mpdf');
                  $purchase=$this->oldexpense_model->search_billing();
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
  <tr style="font-size: 14px;">
    <td height="35" width="222" align="left" style="border-bottom:1px solid black;"><strong>Expenses Reports </strong></td>';



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

<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
  <tr style="font-size: 12px;">
   
    <td width="120" align="left" style="border-bottom:1px solid black;"><b>Date</b></td>
    <td width="120" align="left" style="border-bottom:1px solid black;"><b>Name</b></td>
    <td width="100" align="left" style="border-bottom:1px solid black;"><b>Purpose</b></td>
     <td width="144" align="left" style="border-bottom:1px solid black;"><b>Payment Details</b></td>

          <td width="60" align="right" style="border-bottom:1px solid black;"><b>Amount</b></td>



  </tr>';
 
    $i=1;
     $totalamount[]=array();
    foreach ($purchase as $row) {
  
      $suppliername=$row['name'];
      $paymentdetails=$row['paymentdetails'];
      $purpose=$row['purpose'];
      $overallamount=$row['overallamount'];
      $receiptdate=date('d-m-Y',strtotime($row['expensesdate']));
   
     	
      
   $purchases[]=$overallamount;
   $pur=array_sum($purchases);

   $html.='<tr style="font-size: 12px;">

    
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

            $mpdf->Output($sups.' '.'Expenses Reports'.' '.date('d-m-Y').'.pdf','d');

                  //   force_download($filename,$content); 
        }

                 }

}
ob_flush();
?>
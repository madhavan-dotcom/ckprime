<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class OldInvoiceReports extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('old_invoice_model');
    if($this->session->userdata('rcbio_login')=='')
    {
      $this->session->set_flashdata('msg','Please Login to continue!');
      redirect('login');
    }     
  }
	public function index()
	{
		$this->load->view('header');
		$this->load->view('old_invoice_view');
		$this->load->view('footer1');
	}


 public function views()
  {

     $id=base64_decode($this->uri->segment(3));
	 //echo $id;exit;
     $data['result']=$this->db->where('id',$id)->get('invoice_details_backup')->result_array();  
     $this->load->view('header');
     $this->load->view('view_invoice',$data);
     $this->load->view('footer');

  }


  

//   public function edit()
// {

//   $id=base64_decode($this->uri->segment(3));
//   $data['result']=$this->db->where('id',$id)->get('invoice_details_backup')->result_array(); 
//   $this->load->view('header');
//   $this->load->view('edit_invoices',$data);
//   $this->load->view('footer');

// }


public function ajax_list()
  {
    $list = $this->old_invoice_model->get_datatables();
    $data = array();
    $no = $_POST['start'];
    $i=1;
    foreach ($list as $person) {

       @$gstin=$this->db->select('gstno')->where('name',$person->customername)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->gstno;

       @$phoneno=$this->db->select('phoneno')->where('name',$person->customername)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->phoneno;

    $startTimeStamp = strtotime($person->invoicedate);
    $endTimeStamp = strtotime(date('Y-m-d'));
    $timeDiff = abs($endTimeStamp - $startTimeStamp);
    $numberDays = $timeDiff/86400;  // 86400 seconds in one day
    $numberDays = intval($numberDays);

      $no++;
      $row = array();
      $row[] = $i++;
      $row[] =date('d-m-Y',strtotime($person->invoicedate));
      $row[] = $person->invoiceno;
      $row[] = $person->customername;
      $row[] = $phoneno;
      $row[] = $gstin;
      $row[] = $numberDays.' Days';
      $row[] = $person->grandtotal;
    $return_status=explode("||",$person->return_status);
      $code=base64_encode($person->id);
    if(in_array(0,$return_status))
    {
      $deleteOptn='<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:alert(\'Sorry! You cannot able to delete!\');" title="Hapus" >Delete</a>';
      
    }
    else
    {
      $deleteOptn='<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$code."'".')">Delete</a>';
    }
      if($person->edit_status=='0')
      {

        $row[] = '
        <div class="btn-group">
          <button type="button" class="btn
          btn-info dropdown-toggle waves-effect waves-light"
          data-toggle="dropdown" aria-expanded="false">Manage <span
          class="caret"></span></button>
          <ul class="dropdown-menu"
          role="menu" style="background: #23BDCF none repeat scroll
          0% 0%;width:14px;min-width: 100%;">

          <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('oldInvoiceReports/views/'.$code).'" title="Hapus" >View</a></li>
          

          <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('oldInvoiceReports/rebill/'.$code).'" title="Hapus" >Print</a></li>
        
        </ul>
      </div>';

    }

    else
    {

      $row[] = '
      <div class="btn-group">
        <button type="button" class="btn
        btn-info dropdown-toggle waves-effect waves-light"
        data-toggle="dropdown" aria-expanded="false">Manage <span
        class="caret"></span></button>
        <ul class="dropdown-menu"
        role="menu" style="background: #23BDCF none repeat scroll
        0% 0%;width:14px;min-width: 100%;">

        <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('oldInvoiceReports/views/'.$code).'" title="Hapus" >View</a></li>
        
      
        <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('oldInvoiceReports/rebill/'.$code).'" title="Hapus" >Print</a></li>
       
      </ul>
    </div>';
  }
      //add html for action

    // <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('invoice/edit/'.$code).'" title="Edit" >Edit</a></li>
  
  $data[] = $row;
}
$output = array(
  "draw" => $_POST['draw'],
  "recordsTotal" => $this->old_invoice_model->count_all(),
  "recordsFiltered" => $this->old_invoice_model->count_filtered(),
  "data" => $data,);
    //output to json format
echo json_encode($output);
}

public function ajax_delete($id)
{
  $this->old_invoice_model->delete_by_id($id);
  echo json_encode(array("status" => TRUE));
}

public function autocomplete_customername()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('customer_details');
  $this->db->where("(type = 'Intra customer' OR type = 'Inter customer')");
  $this->db->like('name',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->name;
    $json_array['value']    = $d->name;
    $json_array['address']    = $d->address1.', '.$d->address2.', '.$d->city.', '.$d->state;
    $json_array['customerid'] = $d->id;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}






public function autocomplete_itemcode()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('itemno',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->itemno;
    $json_array['value']    = $d->itemno;
    // $json_array['itemname']    = $d->itemname;
    // $json_array['price']    = $d->price;
    // $json_array['hsnno']    = $d->hsnno;


    // $json_array['advanceamount'] = $d->voucheramount;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}

public function get_itemcode()
{
  $itemcode=$this->input->post('name');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->where('itemno',$itemcode);
  $query = $this->db->get();
  $result = $query->result();
  foreach($result as $h)
  {   
    $vob['itemname']=$h->itemname;
    $vob['price']=$h->price;
    $vob['hsnno']=$h->hsnno;

  }
  echo json_encode($vob);
}

public function get_hsnno()
{
  $itemcode=$this->input->post('name');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->where('hsnno',$itemcode);
  $query = $this->db->get();
  $result = $query->result();
  foreach($result as $h)
  {   
    $vob['itemname']=$h->itemname;
    $vob['price']=$h->price;
    $vob['sgst']=$h->sgst;
    $vob['cgst']=$h->cgst;
    $vob['igst']=$h->igst;

  }
  echo json_encode($vob);
}


public function get_itemnames()
{
  $itemcode=$this->input->post('name');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->where('itemname',$itemcode);
  $query = $this->db->get();
  $result = $query->result();
  foreach($result as $h)
  {   
	
	
    $uom=$this->db->select('uom')->where('id',$h->uom)->get('uom')->row()->uom;
    $vob['hsnno']=$h->hsnno;
    $vob['price']=$h->price;
    $vob['priceType']=$h->priceType;
    $vob['hsnno']=$h->hsnno;
    $vob['sgst']=$h->sgst;
    $vob['cgst']=$h->cgst;
    $vob['igst']=$h->igst;
    $vob['uom']=$uom;
	
	$checkInvoiceType = $this->db->select('invoiceBy')->where('id',1)->get('preference_settings')->row()->invoiceBy;
	if($checkInvoiceType=='without_stock')
	{
		$vob['balance']=0;
	}
	else
	{
		$this->db->select('*');
		$this->db->from('stock');
		$this->db->where('itemname',$itemcode);
		$query2 = $this->db->get();	
		$result = $query2->row();
		$vob['balance']=$result->balance;
	}
	

  }
  echo json_encode($vob);
}



public function autocomplete_itemname()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('itemname',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
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


public function autocomplete_hsnno()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('hsnno',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
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

  $id=base64_decode($this->uri->segment(3));
  $data['result']=$this->db->where('id',$id)->get('invoice_details')->result_array(); 
  $this->load->view('header');
  $this->load->view('edit_invoices',$data);
  $this->load->view('footer');

}


public function autocomplete_invoiceno()
{
  $name=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('purchase_details');
  $this->db->like('purchaseno',$name);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d) 
  {
    $json_array             = array();
    $json_array['value']    = $d->purchaseno;
    $json_array['label']    = $d->purchaseno;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}


public function autocomplete_no()
{
  $name=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('itemno',$name);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d) 
  {
    $json_array             = array();
    $json_array['value']    = $d->itemno;
    $json_array['label']    = $d->itemno;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}


public function autocomplete_item()
{
  $itemname=$this->input->post('keyword');
//$cusname='ram';
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('itemname',$itemname);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d) 
  {
    $json_array             = array();
    $json_array['value']    = $d->itemname;
    $json_array['label']    = $d->itemname;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}
public function get_itemno()
{
  $itemno=$this->input->post('itemno');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->where('itemno',$itemno);
  $query = $this->db->get();
  $result = $query->result();
  foreach($result as $s)
  {   
    $vob['itemname']=$s->itemname;
    $vob['price']=$s->price;
  }
  echo json_encode($vob);
}
public function get_itemname()
{
  $itemname=$this->input->post('itemname');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->where('itemname',$itemname);
  $query = $this->db->get();
  $result = $query->result();
  foreach($result as $s)
  {   
    $vob['itemno']=$s->itemno;
    $vob['price']=$s->price;
  }
  echo json_encode($vob);
}




  // public function edit()
  // {


  //       $data['vat']=$this->db->get('vat_details')->result_array(); 

  //   $id=base64_decode($this->uri->segment(3));

  //     $data['edit']=$this->old_invoice_model->invoice_edit($id);
  //     $this->load->view('header');
  //     $this->load->view('edit_invoice',$data);
  //        $this->load->view('footer');


  // }

public function update()
{

// echo "<pre>";
// print_r($_POST);
// exit;
	$id=$this->input->post('id');
   $getpurchase=$this->db->where('id',$id)->get('invoice_details')->result();
   foreach($getpurchase as $getp)
   $grandtotals=$getp->grandtotal;  

   $ite=explode('||',$getp->itemname);
  $qtyss=explode('||',$getp->qty);
  $hsnnos=explode('||',$getp->hsnno);
  
  $count=count($ite);
  for ($i=0; $i < $count; $i++) 
  { 
    $stock=$this->db->where('itemname',$ite[$i])->where('hsnno',$hsnnos[$i])->get('stock')->result_array();
    foreach ($stock as $s) 
    {
      $ite[$i];
      $cur=$s['balance'];
      $qtyss[$i]; 
      $tot=$cur+$qtyss[$i]; 
      $this->db->where('itemname',$ite[$i])->where('hsnno',$hsnnos[$i])->update('stock',array('balance'=>$tot));   
    }

  }
   //$grandtotal = $_POST['grandtotal'];
    $this->db->where("(type = 'Intra customer' OR type = 'Inter customer')");
    $data11=$this->db->where('name',$_POST['customername'])->get('customer_details')->result_array();
    foreach ($data11 as $a1) 
    {
      $openingbalance=$a1['openingbal'];
      $balance=$a1['balanceamount'];
        $salesamounts=$a1['salesamount'];  
    } 

    if($balance)
    {
      $balanceamount=$balance -$grandtotals;
    }
    else
    {
      $balanceamount='0.00';
    }    
    $this->db->where('id',$a1['id'])->update('customer_details',array('balanceamount'=>$balanceamount));

    
     $grandtotal = $_POST['grandtotal'];
      $data1=$this->db->where('id',$a1['id'])->get('customer_details')->result_array();


  
    foreach ($data1 as $a) 
    {
      $openingbalance=$a['openingbal'];
      $balance=$a['balanceamount'];
      $salesamounts=$a['salesamount'];  
    }


    if($balance)
    {
      $balanceamount=$balance + $grandtotal;
    }

    else
    {
      $balanceamount=$openingbalance+$grandtotal;
    }
    if($salesamounts=='')
    {
      $salesamount=$grandtotal;
    }
    else
    {
      $salesamount=$salesamounts-$grandtotal;
    }

    $datass = array('salesamount'=>$salesamount,'balanceamount'=>$balanceamount);

     $this->db->where('id',$a['id'])->update('customer_details',$datass);

 
	$orderdate=($this->input->post('orderdate')!="")?date('Y-m-d',strtotime($this->input->post('orderdate'))):"NULL";
    $hsnno=implode('||',$_POST['hsnno']);
    $itemname=implode('||',$_POST['itemname']);
    $item_desc=implode('||',$_POST['item_desc']);
    $qty=implode('||',$_POST['qty']);
    $uom=implode('||',$_POST['uom']);
    $rate=implode('||',$_POST['rate']);
    $amount=implode('||',$_POST['amount']);
    @$discount=implode('||',$_POST['discount']);
    @$discountamount=implode('||',$_POST['discountamount']);
    $taxableamount=implode('||',$_POST['taxableamount']);
    $cgst=implode('||',$_POST['cgst']);
    $cgstamount=implode('||',$_POST['cgstamount']);
    $sgst=implode('||',$_POST['sgst']);
    $sgstamount=implode('||',$_POST['sgstamount']);
    $igst=implode('||',$_POST['igst']);
    $igstamount=implode('||',$_POST['igstamount']);
    $total=implode('||',$_POST['total']);
    $subtotal=$this->input->post('subtotal');
    $freightamount=$this->input->post('freightamount');
    $freightcgst=$this->input->post('freightcgst');
    $freightcgstamount=$this->input->post('freightcgstamount');
    $freightsgst=$this->input->post('freightsgst');
    $freightsgstamount=$this->input->post('freightsgstamount');
    $freightigst=$this->input->post('freightigst');
    $freightigstamount=$this->input->post('freightigstamount');
    $freighttotal=$this->input->post('freighttotal');
    $loadingamount=$this->input->post('loadingamount');
    $loadingcgst=$this->input->post('loadingcgst');
    $loadingcgstamount=$this->input->post('loadingcgstamount');
    $loadingsgst=$this->input->post('loadingsgst');
    $loadingsgstamount=$this->input->post('loadingsgstamount');
    $loadingigst=$this->input->post('loadingigst');
    $loadingigstamount=$this->input->post('loadingigstamount');
    $loadingtotal=$this->input->post('loadingtotal');
    $roundOff=$this->input->post('roundOff');
    $othercharges=$this->input->post('othercharges');
    $hiddenDiscountBy=$this->input->post('hiddenDiscountBy');
    $grandtotal=$this->input->post('grandtotal');
 
  
    $pcode=$_POST['hsnno'];
	
    $count7=count($pcode);
    for ($i=0; $i < $count7; $i++) 

    {
      $res[]="0";

      $ret[]="1";


    }
	


     $billtype=$_POST['gsttype'];
    if($billtype=='intrastate')
    {
      $sgst = implode('||',$_POST['sgst']);
      $cgst = implode('||',$_POST['cgst']);
      //$igst = implode('||',$res);
	  $igst = implode('||',$_POST['igst']);
      $sgstamount = implode('||',$_POST['sgstamount']);
      $cgstamount = implode('||',$_POST['cgstamount']);
      //$igstamount = implode('||',$res);
	  $igstamount = implode('||',$_POST['igstamount']);
      $sgsts='sgst';
      $cgsts='cgst';
      $igsts='';



    }

    if($billtype=='interstate')
    {

      //$sgst =implode('||',$res);
      //$cgst = implode('||',$res);
	  $sgst = implode('||',$_POST['sgst']);
      $cgst = implode('||',$_POST['cgst']);
      $igst = implode('||',$_POST['igst']);
      //$sgstamount = implode('||',$res);
      //$cgstamount = implode('||',$res);
	  $sgstamount = implode('||',$_POST['sgstamount']);
      $cgstamount = implode('||',$_POST['cgstamount']);
      $igstamount = implode('||',$_POST['igstamount']);
      $igsts='igst';
      $sgsts='';
      $cgsts='';
    }


   
    $data=array('bill_type' => $_POST['bill_type'],
      'date'=>date('Y-m-d'),
	  'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])),
      'invoiceno' =>$_POST['invoiceno'], 
      'customername' =>$_POST['customername'], 
      'address' =>$_POST['address'], 
      'orderno' =>$_POST['orderno'], 
	  'orderdate' => $orderdate,
      'billtype' =>$_POST['gsttype'], 
      'gsttype' =>$_POST['gsttype'],
      'deliveryat' =>$_POST['deliveryat'],
      'vehicleno' =>$_POST['vehicleno'],
      'transportmode' =>$_POST['transportmode'],
      'typesgst'=>$sgsts,
      'typecgst'=>$cgsts,
      'typeigst'=>$igsts,
      'hsnno'=>$hsnno,
      'itemname'=>$itemname,
      'item_desc'=>$item_desc,
      'uom'=>$uom,
      'rate'=>$rate,
      'qty'=>$qty,
      'amount'=>$amount,
      'discount'=>$discount,
      'discountamount'=>$discountamount,
      'taxableamount'=>$taxableamount,
      'sgst'=>$sgst,
      'sgstamount'=>$sgstamount,
      'cgst'=>$cgst,
      'cgstamount'=>$cgstamount,
      'igst'=>$igst,
      'igstamount'=>$igstamount,
      'total'=>$total,
      'subtotal' =>$_POST['subtotal'], 
      'freightamount'=>$freightamount,
      'freightcgst'=>$freightcgst,
      'freightcgstamount'=>$freightcgstamount,
      'freightsgst'=>$freightsgst,
      'freightsgstamount'=>$freightsgstamount,
      'freightigst'=>$freightigst,
      'freightigstamount'=>$freightigstamount,
      'freighttotal'=>$freighttotal,
      'loadingamount'=>$loadingamount,
      'loadingcgst'=>$loadingcgst,
      'loadingcgstamount'=>$loadingcgstamount,
      'loadingsgst'=>$loadingsgst,
      'loadingsgstamount'=>$loadingsgstamount,
      'loadingigst'=>$loadingigst,
      'loadingigstamount'=>$loadingigstamount,
      'loadingtotal'=>$loadingtotal,
      'roundOff' =>$roundOff,
      'othercharges' =>$othercharges,
      'discountBy' =>$hiddenDiscountBy,
      'return_status'=>implode('||',$ret),
      'grandtotal' =>$grandtotal, 
      'invoicenodate' =>$invoicenodate, 
      'invoicenoyear' =>$invoicenoyear, 
      'status'=>1,
      'edit_status'=>1);
    $this->db->where('id',$_POST['id']);
	//print_r($data);
	//exit;
    $result=$this->db->update('invoice_details',$data);
	//echo $this->db->last_query();
	//exit;
    if($result==true)
    { 
        $invoiceid=$_POST['id'];


        $this->db->where('invoiceid',$_POST['id'])->delete('invoice_reports');
        $this->db->where('invoiceid',$_POST['id'])->delete('invoice_party_statement');


      $sparename=$_POST['itemname'];
      $qty=$_POST['qty'];
      $hsnnos=$_POST['hsnno'];
      $sgsts=$_POST['sgst'];
      $cgsts=$_POST['cgst'];
      $igsts=$_POST['igst'];
      $count=count($sparename);

      for ($i=0; $i <  $count; $i++) 
      { 
        $data=$this->db->where('itemname',$sparename[$i])->where('hsnno',$hsnnos[$i])->get('stock')->result();
        foreach($data as $v)
        {
          $bal=$v->balance;


        }

    
        if($data)
        {
          $this->db->where('itemname',$sparename[$i])->where('hsnno',$hsnnos[$i])->update('stock',
            array(
              'date'=>date('Y-m-d'),
              'balance'=>$bal-$qty[$i]
              ));
        }
       
      }


      $itemnames=$_POST['itemname'];
      $item_descs=$_POST['item_desc'];
      $qtys=$_POST['qty'];
      $hsnnoss=$_POST['hsnno'];

      $count=count($sparename);
      for ($j=0; $j <  $count; $j++) 
      {
        $podatass=array(
						'date'=>date('Y-m-d'),
						'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
						'orderdate' =>$orderdate, 
						'invoiceno' =>$_POST['invoiceno'], 
						'customername' =>$_POST['customername'], 
						'address' =>$_POST['address'], 
						'orderno' =>$_POST['orderno'], 
						'billtype' =>$_POST['gsttype'], 
						'gsttype' =>$_POST['gsttype'],
						'deliveryat' =>$_POST['deliveryat'],
						'vehicleno' =>$_POST['vehicleno'], 
						'itemname'=>$itemnames[$j],
						'item_desc'=>$item_descs[$j],
						'rate'=>$_POST['rate'][$j],
						'qty'=>$qtys[$j],
						'total'=>$_POST['total'][$j],
						'hsnno'=>$hsnnoss[$j],
						'address' =>$_POST['address'],  
						'subtotal' =>$_POST['subtotal'], 
						'grandtotal' =>$_POST['grandtotal'], 
						'invoicenodate' =>$invoicenodate, 
						'invoicenoyear' =>$invoicenoyear,
						'invoiceid' =>$invoiceid,
						'status'=>1
						);
        $this->db->insert('invoice_reports',$podatass);
      }


    
        @$receiptno='-';
        @$paymentdetails='-';
        @$paymentmodes='-';
        @$throughchecks='-';
        @$banktransfers='-';
        @$chamounts='-';
        @$bankamounts='-';
        @$chequeno='-';
        @$receiptamt='-';
        @$receiptid='-';

        $dd=array(
          'date'=>date('Y-m-d',strtotime($_POST['invoicedate'])),
          'receiptdate'=>date('Y-m-d',strtotime($_POST['invoicedate'])),  
          'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
          'invoiceno'=>$_POST['invoiceno'],
          'payment'=>$paymentdetails,
		  'customerId' => $_POST['customerid'],
          'customername' =>$_POST['customername'], 
          'paymentmode'=>$paymentmodes,
          'throughcheck'=>$throughchecks,
          'banktransfer'=>$banktransfers,
          'chamount'=>$chamounts,
          'bankamount'=>$bankamounts,
          'chequeno'=>$chequeno,
          'itemname'=>$itemname,
          'item_desc'=>$item_desc,
          'paymentdetails'=>$paymentdetails,
          'overallamount'=>$_POST['grandtotal'],
          'receiptamt'=>'-',          
          'receiptno'=>$receiptid,
          // 'qty'=>$qty,
          'paid'=>$paymentdetails,
          'totalamount'=>$_POST['grandtotal'],
          'invoiceamt'=>$_POST['grandtotal'],
          'invoicenoyear' =>$invoicenoyear, 
          'invoicenodate' =>$invoicenodate, 
          'balance'=>$balanceamount,
          'invoiceid' =>$invoiceid,
          'status'=>1);


  

      $this->db->insert('invoice_party_statement',$dd);
      $this->session->set_flashdata('msg','Invoice Update Successfully');
       
          if($_POST['save']=='save')
            {
                redirect('invoice/view');
            }
            else
            {
              redirect('invoice/bill');
            }
    }
    else
    {
      $this->session->set_flashdata('msg1','Invoice Update Unsuccessfully');
      redirect('invoice/view');
    }

}





public function delete()
{
 $del=base64_decode($this->input->post('id'));
//   $del=base64_decode('Ng==');
  

   //$del=$this->input->post('id');  
  $getdetails=$this->db->where('id',$del)->get('invoice_details')->result();

  if($getdetails)
  {
  foreach($getdetails as $row)
  {



    $customer_details=$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('name',$row->customername)->get('customer_details')->result();
 
      foreach($customer_details as $c)
    $updates=$c->balanceamount-$row->grandtotal;
	$salesamt = $c->salesamount-$row->grandtotal;

    $this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('name',$row->customername)->update('customer_details',array('balanceamount'=>$updates,'salesamount'=>$salesamt));

        $itemname =explode('||',$row->itemname);
        $rate =explode('||',$row->rate);
        $qty =explode('||',$row->qty);
        $hsnno =explode('||',$row->hsnno);
        $invcount=count($itemname);
        for ($j=0; $j < $invcount; $j++)
         { 
			$invwq=$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->get('stock')->result();
			if($invwq)
			{ 
				foreach($invwq as $w)
				@$old=$w->balance;  
				$qty[$j];
				@$bal=$old+$qty[$j];
				$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->update('stock',array('balance'=>$bal)); 
			}
			/*$invwq1=$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->get('stock_reports')->result();
			foreach($invwq1 as $w1)
			$old1=$w1->updatestock;
			$ba1l=$old1+$qty[$j];
			$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->update('stock_reports',array('updatestock'=>$ba1l));		
			*/
              
          } 

        }

      }
          $checkdata=$this->db->where('id',$del)->get('invoice_details')->result_array();
                if($checkdata)
                {
                  foreach ($checkdata as $rows) 
                  {
                        $invoicetype=$rows['invoicetype'];
                        $deliveryid=explode('||',$rows['deliveryid']);
                        $qtyss=explode('||',$rows['qty']);

                   }     
                        $counts=count($deliveryid);
                        
                        if($invoicetype=='Against DC')
                      {
                            for ($i=0; $i <$counts ; $i++) { 

                              $datass=array('balanceqty'=>$qtyss[$i],
                                         'dc_status'=>1);
                            $this->db->where('id',$deliveryid[$i]);
                            $this->db->update('dc_delivery',$datass);
                              
                            } 

                            

                            // $datass=array('delete_status'=>0);
                            // $this->db->where('id',$insertid);
                            // $this->db->update('inward_details',$datass);
               
                        }


                    

                  }







  $data=$this->db->where('id',$del)->delete('invoice_details');
 if($data)
 {
      $this->db->where('invoiceid',$del)->delete('invoice_reports');
      $this->db->where('invoiceid',$del)->delete('invoice_party_statement');


      //$this->session->set_flashdata('msg','Invoice Details  Deleted successfully!');
      echo'yes';
}
else
{
  //$this->session->set_flashdata('msg1','Invoice Details  Deleted unsuccessfully');
  echo'no';   
    
}

} 

   public function pending_view()
    {
        $data['pending']=$this->old_invoice_model->pending();
        $this->load->view('header');
        $this->load->view('pending_view',$data);
        $this->load->view('footer1');
    }


public function pending()
{

  $data['pending']=$this->old_invoice_model->pending_select();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function pending_search()
{
  $data['pending']=$this->old_invoice_model->search_reports();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function purchase_reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->old_invoice_model->search_pending();

    // echo"<pre>";
    // print_r($data);
  $this->load->view('purchase_reports',$data,$fromdate,$todate,$suppliername);

}

public function reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->old_invoice_model->search_reports();

  
  $this->load->view('purchase_reports2',$data,$fromdate,$todate);

}


public function reports1()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->old_invoice_model->search_pending();

  
  $this->load->view('purchase_reports1',$data,$fromdate,$todate);

}

  public function getcustomer()
{
  $name=$_POST['name'];
  $data=$this->db->where('name',$name)->get('customer_details')->result();
  echo $count=count($data);

}

public function check_hsnno()
{
 $name=$_POST['name'];
 $data=$this->db->where('hsnno',$name)->get('additem')->result();

 echo $count=count($data);

}

public function gets()
{
  $name=$_POST['name'];
  $data=$this->db->where('itemname',$name)->get('additem')->result();
  echo $count=count($data);

}

public function bill()
{
	$id=base64_decode($this->uri->segment(3));
		//$this->load->library('mpdf'); 
		$bil=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('invoice_details')->row(); 
		//$this->db->where('id',$id)->get('invoice_details')->row();
		$number= $bil->grandtotal;
		$no = round($number);
		$point = round($number - $no, 2) * 100;
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
		$fin=$result;
		$cmpLogo=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->row();
		$profile=$this->db->get('profile')->row();
		
		$getcusname=$this->db->where('name',$bil->customername)->where('id',$bil->customerId)->get('customer_details')->result();
		foreach($getcusname as $cus)
		{
			$addresss1=$cus->address1;
			$addresss2=$cus->address2;
			$citys=$cus->city;
			$states=$cus->state;
			$gstnos=$cus->gstno;
			$mobileno=$cus->phoneno;
			$pincode=$cus->pincode;
			$statecode=$cus->statecode;
		}
		$discountBy = $bil->discountBy;
		$discountss=explode('||',$bil->discount);
		$diccount=array_sum($discountss);
		$itemwidth=10;
		$columnCount = 5;
		//$bil->gsttype='interstate';
		//$diccount=1;
		if($diccount <= 0)
		{
			$itemwidth +=16;
			$diccount_header = '';
			$diccount_empty = '';
		}
		else
		{
			$columnCount +=2;
			$diccount_header = '
			<td width="8%">Disc</td>
			<td width="8%">Taxable Amount</td>';
			$diccount_empty = '<td>&nbsp;</td><td>&nbsp;</td>';
		}
		
		
		if($bil->gsttype=='intrastate')
		{
			$itemwidth +=8;
			$igst_header = ''; $igst_empty='';
			$columnCount +=2;
			$cgst_header = '<td width="8%">cgst</td>
			<td width="8%">sgst</td>';
			$cgst_empty='<td>&nbsp;</td><td>&nbsp;</td>';
		}
		if($bil->gsttype=='interstate')
		{
			$itemwidth +=16;
			$columnCount += 1;
			$cgst_header = ''; $cgst_empty='';
			$igst_header = '<td width="8%">igst</td>';
			$igst_empty='<td>&nbsp;</td>';
		}
		
		//print_r($datas);
		//exit;

		$html = '
		<html>
			<head>
				<style>
					body {font-family: sans-serif;
					font-size: 10pt;
					}
					p {	margin: 0pt; }
					table.items {
					border: 0.1mm solid #000000;
					}
					td { vertical-align: top; }
					.items td {
					border-left: 0.1mm solid #000000;
					border-right: 0.1mm solid #000000;
					}
					table thead td { background-color: #EEEEEE;
					text-align: center;
					border: 0.1mm solid #000000;
					font-variant: small-caps;
					}
					.items td.blanktotal {
					background-color: #EEEEEE;
					border: 0.1mm solid #000000;
					background-color: #FFFFFF;
					border: 0mm none #000000;
					border-top: 0.1mm solid #000000;
					border-right: 0.1mm solid #000000;
					}
					.items td.totals {
					text-align: right;
					border: 0.1mm solid #000000;
					}
					.items td.cost {
					text-align: "." right;
					}
					.hide_this_field{
						display:none;
					}
				</style>
			</head>
			<body>
				<!--mpdf
				<htmlpageheader name="myheader">
					<table width="100%" >
						<tr>
							<td width="30%" align="center" style="font-size:20px;font-weight:bold;"></td>
							<td width="35%" align="center" style="font-size:20px;font-weight:bold;text-transform:uppercase">'.$bil->bill_type.'</td>
							<td width="35%" align="center" style="font-size:15px;font-weight:bold;">Original / Duplicate / Triplicate</td>
						</tr>
					</table>

					<table width="100%" style="border:1px solid #000;border-collapse: collapse;" cellpadding="5" cellspacing="0">
						<tr>
							<td width="20%"><img src="'.base_url().'upload/'.$cmpLogo->image.'" width="200" height="80" alt="logo" /></td>
							<td align="right" valign="top" width="80%">
								<strong style="font-size: 24px;">'.$profile->companyname.'</strong>
								<br>'.$profile->address1.'
								<br>'.$profile->address2.', '.$profile->city.' - '.$profile->pincode.'
								<br><b>GSTIN: '.$profile->gstin.'</b>
								<br>Phone : '.$profile->phoneno.',&nbsp;Mobile : '.$profile->mobileno.'<br>Email id : '.$profile->emailid.', Website : '.$profile->website.'
							</td>
						</tr>
					</table>
				</htmlpageheader>

				<htmlpagefooter name="myfooter">
					<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
						Page {PAGENO} of {nb}
					</div>
				</htmlpagefooter>

				<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
				<sethtmlpagefooter name="myfooter" value="on" />
				mpdf-->

				<table width="100%" style="border:1px solid #000;border-collapse: collapse;margin-top:-24px;margin-bottom:2px;" cellpadding="5" cellspacing="0">
					<tr>
						<td width="65%" style="border-top: 0.1mm solid #000;border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000; ">
							<span style="font-size: 10pt; color: #555555; font-family: sans;">TO:</span><br /><span style="font-family: sans;font-size:9pt;font-weight:bold;">'.$bil->customername.'</span><br />'.@$addresss1.', '.@$addresss2.'<br />'.@$citys.'<br />'.@$states.' - '.@$pincode.'<br />Mobile No : '.@$mobileno.'
							<br />
							<br />
							<span style="font-weight:bold;">GSTIN : '.@$gstnos.'<br />State Code : '.@$statecode.'</span>

						</td>
						<td width="20%" style="border-top: 0.1mm solid #000;border-bottom:0.1mm solid #000;border-right:0.1mm solid #000;">
							<span style="font-size: 7pt; color: #555555; font-family: sans;">INVOICE NO:</span><br />'.$bil->invoiceno.'<br /><br />
							<span style="font-size: 7pt; color: #555555; font-family: sans;">INVOICE DATE:</span><br />'.date('d/m/Y',strtotime($bil->invoicedate)).'<br /><br />
							<span style="font-size: 7pt; color: #555555; font-family: sans;">TRANSPORT MODE:</span><br />'.$bil->transportmode.'
						</td>	
						<td width="20%" style="border-top: 0.1mm solid #000;border-bottom:0.1mm solid #000;border-right:0.1mm solid #000;">
							<span style="font-size: 7pt; color: #555555; font-family: sans;">ORDER NO:</span><br />'.$bil->orderno.'<br /><br />
							<span style="font-size: 7pt; color: #555555; font-family: sans;">DELIVERY AT:</span><br />'.$bil->deliveryat.'<br /><br />
							<span style="font-size: 7pt; color: #555555; font-family: sans;">VEHICLE NO:</span><br />'.$bil->vehicleno.'
						</td>
					</tr>
				</table>
				<!--<br />-->
				<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
					<thead>
						<tr>
							<td width="8%">S.No</td>
							<td width="'.$itemwidth.'%">Item Description</td>
							<td width="6%">UOM</td>
							<td width="8%">Quantity</td>
							<td width="8%">Rate</td>
							<td width="8%">Amount</td>
							'.$diccount_header.
							$cgst_header.
							$igst_header.'
							<td width="12%">total</td>
						</tr>
					</thead>
					<tbody>
					';
					//foreach ($pre  as  $vob)
					//{
						$vob=$bil;
						$itemname=explode('||',$vob->itemname);
						$item_desc=explode('||',$vob->item_desc);
						$rate=explode('||',$vob->rate);
						$qty=explode('||',$vob->qty);
						// $amount=explode('||',$vob->total);
						$total=explode('||',$vob->total);
						$amount=explode('||',$vob->amount);
						$uom=explode('||',$vob->uom);
						$discounts=explode('||',$vob->discount);
						$disamounts=explode('||',$vob->discountamount);
						$taxableamt=explode('||',$vob->taxableamount);
						$hsnno=explode('||',$vob->hsnno);
						$sgsts=explode('||',$vob->sgst);
						$igsts=explode('||',$vob->igst);
						$cgsts=explode('||',$vob->cgst);
						$sgstamts=explode('||',$vob->sgstamount);
						$igstamts=explode('||',$vob->igstamount);
						$cgstamts=explode('||',$vob->cgstamount);
						$overalltotal=explode('||',$vob->total);
						$dcnos=explode('||',$vob->dcnos);

						$count=count($itemname);
						for($i=0; $i< $count; $i++){
							$j=$i+1;
							if(@$item_desc[$i]=='')
							{
								@$itemDet_desc='';
							}
							else
							{
								@$itemDet_desc='<span align="center" style="font-size:12px;">(Description :&nbsp;'.$item_desc[$i].')</span>';
							}
							if($discounts[$i]==0 || $discounts[$i]=='')
							{
								$discount=0;
							}
							else
							{
								$discount=$discounts[$i];
							}

							if($disamounts[$i]==0 || $disamounts[$i]=='')
							{
								$disamount=0;
							}
							else
							{
								$disamount=$disamounts[$i];
							}

							if($sgsts[$i]==0 || $sgsts[$i]=='')
							{
								$sgst=0;
							}
							else
							{
								$sgst=$sgsts[$i];
							}

							if($igsts[$i]==0 || $igsts[$i]=='')
							{
								$igst=0;
							}
							else
							{
								$igst=$igsts[$i];
							}

							if($cgsts[$i]==0 || $cgsts[$i]=='')
							{
								$cgst=0;
							}
							else
							{
								$cgst=$cgsts[$i];
							}

							if($sgstamts[$i]==0 || $sgstamts[$i]=='')
							{
								$sgstamt=0;
							}
							else
							{
								$sgstamt=$sgstamts[$i];
							}

							if($igstamts[$i]==0 || $igstamts[$i]=='')
							{
								$igstamt=0;
							}
							else
							{
								$igstamt=$igstamts[$i];
							}

							if($cgstamts[$i]==0 || $cgstamts[$i]=='')
							{
								$cgstamt=0;
							}
							else
							{
								$cgstamt=$cgstamts[$i];
							}

							if(@$dcnos[$i]=='')
							{
								$dc_details='';
							}
							else
							{
								@$dcdates=$this->db->select('dcdate')->where('dcno',$dcnos[$i])->get('dcbill_details')->row()->dcdate;
								@$dc_details='&nbsp;&nbsp;<span align="center" style="font-size:9px;">Dcno: '.$dcnos[$i].' Dt: '.date('d-m-y',strtotime($dcdates)).'</span>';
							}

							$dis[]=$disamount;
							$over[]=$overalltotal[$i];
							$taxam[]=$taxableamt[$i];
							$qtyh[]=$qty[$i];
							$totalh[]=$total[$i];
							$sgsth[]=$sgstamt;
							$igsth[]=$igstamt;
							$cgsth[]=$cgstamt;
							$totamt[]=$amount[$i];
							$bottomTot =array_sum($totamt);	
							$grandTotCgsth = array_sum($cgsth);
							$grandTotSgsth = array_sum($sgsth);
							$grandTotIgsth = array_sum($igsth);
							if($discountBy=="percent_wise") { $percent_sign =' <br>  <span style="font-size:13px;">'.number_format($discount,2).'%</span>'; } else { $percent_sign=''; }
							if($diccount >0)
							{
								$diccount_amount = '<td class="cost">'.number_format($disamount,2).$percent_sign.'</td><td class="cost">'.number_format($taxableamt[$i],2).'</td>';
							}
							else
							{
								$diccount_amount = '';
							}
							if($bil->gsttype=='intrastate')
							{
								$cgst_rowAmt = '<td class="cost">'.number_format($cgstamt,2).'<br><span style="font-size:13px;">@'.number_format($cgst,2).'%</span></td>
								<td class="cost">'.number_format($sgstamt,2).'<br><span style="font-size:13px;">@'.number_format($sgst,2).'%</span></td>';
								$igst_rowAmt='';
							}
							if($bil->gsttype=='interstate')
							{
								$igst_rowAmt='<td class="cost">'.number_format($igstamt,2).'<br><span style="font-size:13px;">@'.number_format($igst,2).'%</span></td>';
								$cgst_rowAmt='';
							 } 

							$html .='
								<tr>
									<td align="center">'.$j.'</td>
									<td align="left">'.$itemname[$i].'<br><span align="center" style="font-size:12px;">(HSN/SAC :&nbsp;'.$hsnno[$i].')</span>'.$dc_details.$itemDet_desc.'</td>
									<td>'.$uom[$i].'</td>
									<td class="cost">'.$qty[$i].'</td>
									<td class="cost">'.number_format($rate[$i],2).'</td>
									<td class="cost">'.number_format($amount[$i],2).'</td>
									'.$diccount_amount.
									$cgst_rowAmt.
									$igst_rowAmt.'
									<td class="cost">'.number_format($overalltotal[$i],2).'</td>
								</tr>';
								}
							//}
						for($i=0;$i<=5;$i++) {
						$html .='
						<tr>
							<td><p style="min-height:216px;">&nbsp;</p></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							'.$diccount_empty.
							$cgst_empty.
							$igst_empty.'
							<td>&nbsp;</td>
						</tr>';
						}
						$freight_row='';
						if($vob->freightamount)
						{
							$bottomTot +=$vob->freightamount;
							$freight_row .= '
							<tr style="height:1px;">
								<td></td>
								<td class="align-right">Freight Charges</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td class="cost">'.number_format(@$vob->freightamount,2).'</td>';
							
								if($diccount >0)
								{
									$freight_row .='<td>&nbsp;</td><td>&nbsp;</td>'; 
								}
							if($bil->gsttype=='intrastate')
							{
								$grandTotCgsth +=$vob->freightcgstamount;
								$grandTotSgsth +=$vob->freightsgstamount;
								$freight_row .='<td class="cost">'.number_format(@$vob->freightcgstamount,2).'<br><span style="font-size:13px;">@'.number_format(@$vob->freightcgst,2).'%</span></td>
								<td class="cost"><strong>'.number_format(@$vob->freightsgstamount,2).'<br><span style="font-size:13px;">@'.number_format(@$vob->freightsgst,2).'%</span></td>';
							}
							if($bil->gsttype=='interstate')
							{
								$grandTotIgsth +=$vob->freightigstamount;
								$freight_row .='<td class="cost">'.number_format(@$vob->freightigstamount,2).'<br><span style="font-size:13px;">@'.number_format(@$vob->freightigst,2).'%</span></td>';
							}
							$freight_row .='<td class="cost">'.number_format(@$vob->freighttotal,2).'</td>                 
							</tr>';
						} 
						$loadingRow='';
						if($vob->loadingamount)
						{
							$bottomTot +=$vob->loadingamount;
							$loadingRow .= '
								<tr style="height:1px;">
									<td>&nbsp;</td>
									<td class="align-right">Loading & Packing Charges</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="cost">'.number_format(@$vob->loadingamount,2).'</td>';
							if($diccount >0)
							{
								$loadingRow .='<td>&nbsp;</td><td>&nbsp;</td>';
							}
							
							if($bil->gsttype=='intrastate')
							{
								$grandTotCgsth +=$vob->loadingcgstamount;
								$grandTotSgsth +=$vob->loadingsgstamount;
								$loadingRow .='<td class="cost">'.number_format(@$vob->loadingcgstamount,2).'<br><span style="font-size:13px;">@'.number_format(@$vob->loadingcgst,2).'%</span></td>
								<td class="cost">'.number_format(@$vob->loadingsgstamount,2).'<br><span style="font-size:13px;">@'.number_format(@$vob->loadingsgst,2).'%</span></td>';
							}
							if($bil->gsttype=='interstate')
							{
								$grandTotIgsth +=$vob->loadingigstamount;
								$loadingRow .='<td class="cost">'.number_format(@$vob->loadingigstamount,2).'<br><span style="font-size:13px;">@'. number_format(@$vob->loadingigst,2).'%</span></td>';
							} 
							$loadingRow .='<td class="cost">'.number_format(@$vob->loadingtotal,2).'</td>                 
						</tr>';
						} 
						$html .=$freight_row.$loadingRow;
						$html .='
						<tr >
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>     
						<td>&nbsp;</td> 
						<td class="align-right"><small>Basic Amount</small></td>';
						if($diccount >0)
						{
							$html .='<td class="align-right"><small>Discount</small></td><td class="align-right"><small>Taxable Amount</small></td>  ';
						}
						if($bil->gsttype=='intrastate')
						{
							$html .='<td class="align-right"><small>CGST</small></td><td class="align-right"><small>SGST</small></td> ';
						}
						if($bil->gsttype=='interstate')
						{
							$html .='<td class="align-right"><small>IGST</small></td>';
						}
						$html .='<td class="align-right"><small>Total</small></td>
						</tr>
						<tr >
						  <td colspan="5" align="right" style="border-top:1px solid #888888;font-size:18px;font-weight:bold;">Total</td>
						  <td align="right" style="border-top:1px solid #888888;font-size:14px;font-weight:bold;">&nbsp;'.number_format($bottomTot,2).'</td>';
						  if($diccount >0)
						  {
							$html .='<td align="right" style="border-top:1px solid #888888;font-size:14px;font-weight:bold;">&nbsp;'.number_format(array_sum($dis),2).'</td>
									<td align="right" style="border-top:1px solid #888888;padding:5px;font-size:14px;font-weight:bold;">&nbsp;'.number_format(array_sum($taxam),2).'</td> ';
						  }
						  if($bil->gsttype=='intrastate')
						  {
							$html .='<td align="right" style="border-top:1px solid #888888;padding:5px;font-size:14px;font-weight:bold;">&nbsp;'.number_format($grandTotCgsth,2).'</td>     
									<td align="right" style="border-top:1px solid #888888;padding:5px;font-size:14px;font-weight:bold;">&nbsp;'.number_format($grandTotSgsth,2).'</td>'; 
						  }
						  if($bil->gsttype=='interstate')
						  {
							$html .='<td align="right" style="border-top:1px solid #888888;padding:5px;font-size:14px;font-weight:bold;">'.number_format($grandTotIgsth,2).'</td>';
						  }
						  $html .='<td align="right" style="border-top:1px solid #888888;padding:5px;font-size:14px;font-weight:bold;">&nbsp;'.number_format($bil->subtotal,2).'</td>
						</tr>';
						$html .='
						<tr>
						<td class="blanktotal" colspan="'.($columnCount-2).'" rowspan="3"><span style="font-size:13px;">Rupees :<b style="font-size:13px;">'.$fin.' only</b></span></td>
						<td class="totals" colspan="3"><span style="font-size:16px;font-weight:bold;">Sub Total&nbsp;&nbsp;:</span></td>
						<td class="totals cost"><span style="font-size:14px;font-weight:bold;">'.number_format($bil->subtotal,2).'</span></td>
						</tr>
						<tr>
						<td class="totals"  colspan="3"><span style="font-size:16px;font-weight:bold;">Round Off&nbsp;&nbsp;:</span></td>
						<td class="totals cost"><span style="font-size:14px;font-weight:bold;">'.number_format($bil->roundOff,2).'</span></td>
						</tr>
						<tr>
						<td class="totals"  colspan="3"><span style="font-size:16px;font-weight:bold;">Other Charges&nbsp;&nbsp;:</span></td>
						<td class="totals cost"><span style="font-size:14px;font-weight:bold;">'.number_format($bil->othercharges,2).'</span></td>
						</tr>
						<tr>
						<td class="totals" style="border:none" colspan="'.($columnCount-2).'">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td align="left" colspan="4" style="border:none"><span style="font-size:14px;font-weight:bold;">Bank Details</span></td>
								</tr>
								 <tr>
									<td width="25%" align="left" style="font-size:14px;border:none" ><span style="font-size:14px;">Bank Name&nbsp;:</span></td>
									<td width="25%" align="left" style="border:none"><span style="font-size:14px;">'.$profile->bankname.'</span></td>
									<td width="25%" align="left" style="border:none"><span style="font-size:14px;">Bank Branch:</span></td>
									<td width="25%" align="left" style="border:none"><span style="font-size:14px;">'.$profile->bankbranch.'</span></td>
								  </tr>
								  <tr>
									<td  align="left" style="font-size:14px;border:none"><span style="font-size:14px;">Account No&nbsp;:</span></td>
									<td style="border:none"><span style="font-size:14px;">'.$profile->accountno.'</span></td>
									<td align="left" style="border:none"><span style="font-size:14px;">&nbsp;IFSC Code&nbsp;&nbsp;&nbsp;&nbsp;:</span></td>
									<td align="left" style="border:none"><span style="font-size:14px;">'.$profile->ifsccode.'</span></td>
								  </tr> 
							</table>
							</td>
						<td class="totals"  colspan="3"><span style="font-size:16px;font-weight:bold;">Invoice Amount &nbsp;&nbsp;:</span></td>
						<td class="totals cost" ><span style="font-size:14px;font-weight:bold;">'.number_format(round($bil->grandtotal),2).'</strong>&nbsp;</td>
					  </tr>
					  <tr>
						<td colspan="'.($columnCount+2).'"><p style="font-size:12px;padding:2px;">Certified that the particulars given are true and correct the amount indicated represents the price actually charged and  there is no flow of additional consideration directly or indirectly from the buyer.</p></td>
					  </tr>
						<tr>
						<td colspan="'.($columnCount+2).'">
							<table width="100%"  align="center" style="border-collapse:collapse;border:1px solid #888888;">
								<tr>
									<td width="34%" style="font-size:13px;border-right:1px solid #888888;"><b>&nbsp;&nbsp;TERMS AND CONDITIONS</b></td>
									<td width="33%" style="font-size:13px;border-right:1px solid #888888;">&nbsp;</td>  
									<td width="33%" style="font-size:13px;border-right:1px solid #888888;" align="center">For <b style="font-size:15px;">Myoffice Solutions</b></td>
									</tr>
									<tr>
									<td height="95" valign="top" style="font-size:11px;border-right:1px solid #888888;">&nbsp;&nbsp;1.No Claim For breakage or Loss during transit.<br>&nbsp;&nbsp;2.All disputes subject to Coimbatore Jurisdiction only.<br>&nbsp;&nbsp;3.Our Responsibility Ceases after the goods have been<br>&nbsp;&nbsp;delivered to carriers.</td>
									<td style="font-size:13px;border-right:1px solid #888888;" valign="bottom" align="center"><b>Receiver\'s Signature</b></td>
									<td style="font-size:14px;border-right:1px solid #888888;" align="center" valign="bottom"><b>Authorised Signatory</b></td>
								</tr>    
							</table>
						</td>
					  </tr>
					  </tbody>
				</table>
				
			</body>
		</html>
		';
		$invoice_waterMark=$this->db->select('invoice_waterMark')->where('id', '1')->get('preference_settings')->row()->invoice_waterMark;
		
		require_once(APPPATH.'libraries/mpdf/mpdf.php');
		$mpdf=new mPDF('c','A4','','',20,15,48,25,10,10); 
		$mpdf->SetProtection(array('print'));
		//$mpdf->SetTitle(' - Invoice');
		//$mpdf->SetAuthor(' + Invoice');
		$mpdf->SetTitle($profile->companyname.' - Invoice');
		$mpdf->SetAuthor($profile->companyname);
		if($invoice_waterMark=='1')
		{
			$mpdf->SetWatermarkText(strtoupper($profile->companyname));
			$mpdf->showWatermarkText = true;
		}
		
		$mpdf->watermark_font = 'DejaVuSansCondensed';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->WriteHTML($html);
		$mpdf->Output(); exit;
}
public function bill2()
{
    $data['pre']=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('invoice_details')->result();
    foreach($data['pre'] as $b)
    {
      $number= $b->grandtotal;
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
    $this->load->view('invoicebill',$data);
    //$this->load->view('invoicebill',$data);
// $this->load->view('invoice_bill',$data);
  }
   public function rebill3()
   {
	   $html = '
<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
<table width="100%"><tr>
<td width="50%" style="color:#0000BB; "><span style="font-weight: bold; font-size: 14pt;">Acme Trading Co.</span><br />123 Anystreet<br />Your City<br />GD12 4LP<br /><span style="font-family:dejavusanscondensed;">&#9742;</span> 01777 123 567</td>
<td width="50%" style="text-align: right;">Invoice No.<br /><span style="font-weight: bold; font-size: 12pt;">0012345</span></td>
</tr></table>
</htmlpageheader>

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

<div style="text-align: right">Date: 13th November 2008</div>

<table width="100%" style="font-family: serif;" cellpadding="10"><tr>
<td width="45%" style="border: 0.1mm solid #888888; "><span style="font-size: 7pt; color: #555555; font-family: sans;">SOLD TO:</span><br /><br />345 Anotherstreet<br />Little Village<br />Their City<br />CB22 6SO</td>
<td width="10%">&nbsp;</td>
<td width="45%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt; color: #555555; font-family: sans;">SHIP TO:</span><br /><br />345 Anotherstreet<br />Little Village<br />Their City<br />CB22 6SO</td>
</tr></table>

<br />

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="15%">Ref. No.</td>
<td width="10%">Quantity</td>
<td width="45%">Description</td>
<td width="15%">Unit Price</td>
<td width="15%">Amount</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<tr>
<td align="center">MF1234567</td>
<td align="center">10</td>
<td>Large pack Hoover bags</td>
<td class="cost">&pound;2.56</td>
<td class="cost">&pound;25.60</td>
</tr>
<tr>
<td align="center">MX37801982</td>
<td align="center">1</td>
<td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
<td class="cost">&pound;102.11</td>
<td class="cost">&pound;102.11</td>
</tr>
<tr>
<td align="center">MR7009298</td>
<td align="center">25</td>
<td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
<td class="cost">&pound;12.26</td>
<td class="cost">&pound;325.60</td>
</tr>
<tr>
<td align="center">MF1234567</td>
<td align="center">10</td>
<td>Large pack Hoover bags</td>
<td class="cost">&pound;2.56</td>
<td class="cost">&pound;25.60</td>
</tr>
<tr>
<td align="center">MX37801982</td>
<td align="center">1</td>
<td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
<td class="cost">&pound;102.11</td>
<td class="cost">&pound;102.11</td>
</tr>
<tr>
<td align="center">MR7009298</td>
<td align="center">25</td>
<td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
<td class="cost">&pound;12.26</td>
<td class="cost">&pound;325.60</td>
</tr>
<tr>
<td align="center">MF1234567</td>
<td align="center">10</td>
<td>Large pack Hoover bags</td>
<td class="cost">&pound;2.56</td>
<td class="cost">&pound;25.60</td>
</tr>
<tr>
<td align="center">MX37801982</td>
<td align="center">1</td>
<td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
<td class="cost">&pound;102.11</td>
<td class="cost">&pound;102.11</td>
</tr>
<tr>
<td align="center">MR7009298</td>
<td align="center">25</td>
<td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
<td class="cost">&pound;12.26</td>
<td class="cost">&pound;325.60</td>
</tr>
<tr>
<td align="center">MF1234567</td>
<td align="center">10</td>
<td>Large pack Hoover bags</td>
<td class="cost">&pound;2.56</td>
<td class="cost">&pound;25.60</td>
</tr>
<tr>
<td align="center">MX37801982</td>
<td align="center">1</td>
<td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
<td class="cost">&pound;102.11</td>
<td class="cost">&pound;102.11</td>
</tr>
<tr>
<td align="center">MR7009298</td>
<td align="center">25</td>
<td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
<td class="cost">&pound;12.26</td>
<td class="cost">&pound;325.60</td>
</tr>
<tr>
<td align="center">MF1234567</td>
<td align="center">10</td>
<td>Large pack Hoover bags</td>
<td class="cost">&pound;2.56</td>
<td class="cost">&pound;25.60</td>
</tr>
<tr>
<td align="center">MX37801982</td>
<td align="center">1</td>
<td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
<td class="cost">&pound;102.11</td>
<td class="cost">&pound;102.11</td>
</tr>
<tr>
<td align="center">MF1234567</td>
<td align="center">10</td>
<td>Large pack Hoover bags</td>
<td class="cost">&pound;2.56</td>
<td class="cost">&pound;25.60</td>
</tr>
<tr>
<td align="center">MX37801982</td>
<td align="center">1</td>
<td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
<td class="cost">&pound;102.11</td>
<td class="cost">&pound;102.11</td>
</tr>
<tr>
<td align="center">MR7009298</td>
<td align="center">25</td>
<td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
<td class="cost">&pound;12.26</td>
<td class="cost">&pound;325.60</td>
</tr>
<tr>
<td align="center">MR7009298</td>
<td align="center">25</td>
<td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
<td class="cost">&pound;12.26</td>
<td class="cost">&pound;325.60</td>
</tr>
<tr>
<td align="center">MF1234567</td>
<td align="center">10</td>
<td>Large pack Hoover bags</td>
<td class="cost">&pound;2.56</td>
<td class="cost">&pound;25.60</td>
</tr>
<tr>
<td align="center">MX37801982</td>
<td align="center">1</td>
<td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
<td class="cost">&pound;102.11</td>
<td class="cost">&pound;102.11</td>
</tr>
<tr>
<td align="center">MR7009298</td>
<td align="center">25</td>
<td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
<td class="cost">&pound;12.26</td>
<td class="cost">&pound;325.60</td>
</tr>
<!-- END ITEMS HERE -->
<tr>
<td class="blanktotal" colspan="3" rowspan="6"></td>
<td class="totals">Subtotal:</td>
<td class="totals cost">&pound;1825.60</td>
</tr>
<tr>
<td class="totals">Tax:</td>
<td class="totals cost">&pound;18.25</td>
</tr>
<tr>
<td class="totals">Shipping:</td>
<td class="totals cost">&pound;42.56</td>
</tr>
<tr>
<td class="totals"><b>TOTAL:</b></td>
<td class="totals cost"><b>&pound;1882.56</b></td>
</tr>
<tr>
<td class="totals">Deposit:</td>
<td class="totals cost">&pound;100.00</td>
</tr>
<tr>
<td class="totals"><b>Balance due:</b></td>
<td class="totals cost"><b>&pound;1782.56</b></td>
</tr>
</tbody>
</table>


<div style="text-align: center; font-style: italic;">Payment terms: payment due in 30 days</div>


</body>
</html>
';
	require_once(APPPATH.'libraries/mpdf/mpdf.php');
		$mpdf=new mPDF('c','A4','','',20,15,48,25,10,10); 
		$mpdf->SetProtection(array('print'));
		//$mpdf->SetTitle($contactName." - Invoice");
		$mpdf->SetAuthor('Golden Eagle Insurance');
		$mpdf->SetWatermarkText('GOLDEN EAGLE INSURANCE');
		$mpdf->showWatermarkText = true;
		$mpdf->watermark_font = 'DejaVuSansCondensed';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
   }


   public function rebill()
{
$id=base64_decode($this->uri->segment(3));
// $this->load->library('mpdf'); 
$data['pre']=$this->db->where('id',$id)->get('invoice_details_backup')->result();

foreach($data['pre'] as $b)
{
$number= $b->grandtotal;

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

$data['pre']=$this->db->where('id',$id)->get('invoice_details_backup')->result();
foreach($data['pre'] as $b)
{
if ($b->gsttype=='intrastate') {

$cgst= $b->cgstamount;
$sgst= $b->sgstamount;
$taxamt = $cgst + $sgst;
$no = round($taxamt);

}
 
if ($b->gsttype=='interstate') {
  $igsts= $b->igstamount;
  $taxamt = $igsts;
  $no = round($taxamt);
}

}
$no = round($taxamt);
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
$data['fins']=$result;

$data['profile']=$this->db->get('profile')->result();

$data['fromDirectBill']=0;
$this->load->view('invoicebill',$data);
}

	public function rebill5()
	{
		//$this->load->library('mpdf'); 
		
		$id=base64_decode($this->uri->segment(3));
		//$this->load->library('mpdf'); 
		$bil=$this->db->where('id',$id)->get('invoice_details_backup')->row();
		$number= $bil->grandtotal;
		$no = round($number);
		$point = round($number - $no, 2) * 100;
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
		$fin=$result;
		$cmpLogo=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->row();
		$profile=$this->db->get('profile')->row();
		
		$getcusname=$this->db->where('name',$bil->customername)->where('id',$bil->customerId)->get('customer_details')->result();
		foreach($getcusname as $cus)
		{
			$addresss1=$cus->address1;
			$addresss2=$cus->address2;
			$citys=$cus->city;
			$states=$cus->state;
			$gstnos=$cus->gstno;
			$mobileno=$cus->phoneno;
			$pincode=$cus->pincode;
			$statecode=$cus->statecode;
		}
		$discountBy = $bil->discountBy;
		$discountss=explode('||',$bil->discount);
		$diccount=array_sum($discountss);
		$itemwidth=10;
		$columnCount = 5;
		//$bil->gsttype='interstate';
		//$diccount=1;
		if($diccount <= 0)
		{
			$itemwidth +=16;
			$diccount_header = '';
			$diccount_empty = '';
		}
		else
		{
			$columnCount +=2;
			$diccount_header = '
			<td width="8%">Disc</td>
			<td width="8%">Taxable Amount</td>';
			$diccount_empty = '<td>&nbsp;</td><td>&nbsp;</td>';
		}
		
		
		if($bil->gsttype=='intrastate')
		{
			$itemwidth +=8;
			$igst_header = ''; $igst_empty='';
			$columnCount +=2;
			$cgst_header = '<td width="8%">cgst</td>
			<td width="8%">sgst</td>';
			$cgst_empty='<td>&nbsp;</td><td>&nbsp;</td>';
		}
		if($bil->gsttype=='interstate')
		{
			$itemwidth +=16;
			$columnCount += 1;
			$cgst_header = ''; $cgst_empty='';
			$igst_header = '<td width="8%">igst</td>';
			$igst_empty='<td>&nbsp;</td>';
		}
		
		//print_r($datas);
		//exit;

		$html = '
		<html>
			<head>
				<style>
					body {font-family: sans-serif;
					font-size: 10pt;
					}
					p {	margin: 0pt; }
					table.items {
					border: 0.1mm solid #000000;
					}
					td { vertical-align: top; }
					.items td {
					border-left: 0.1mm solid #000000;
					border-right: 0.1mm solid #000000;
					}
					table thead td { background-color: #EEEEEE;
					text-align: center;
					border: 0.1mm solid #000000;
					font-variant: small-caps;
					}
					.items td.blanktotal {
					background-color: #EEEEEE;
					border: 0.1mm solid #000000;
					background-color: #FFFFFF;
					border: 0mm none #000000;
					border-top: 0.1mm solid #000000;
					border-right: 0.1mm solid #000000;
					}
					.items td.totals {
					text-align: right;
					border: 0.1mm solid #000000;
					}
					.items td.cost {
					text-align: "." right;
					}
					.hide_this_field{
						display:none;
					}
				</style>
			</head>
			<body>
				<!--mpdf
				<htmlpageheader name="myheader">
					<table width="100%" >
						<tr>
							<td width="30%" align="center" style="font-size:20px;font-weight:bold;"></td>
							<td width="35%" align="center" style="font-size:20px;font-weight:bold;text-transform:uppercase">'.$bil->bill_type.'</td>
							<td width="35%" align="center" style="font-size:15px;font-weight:bold;">Original / Duplicate / Triplicate</td>
						</tr>
					</table>

					<table width="100%" style="border:1px solid #000;border-collapse: collapse;" cellpadding="5" cellspacing="0">
						<tr>
							<td width="20%"><img src="'.base_url().'upload/'.$cmpLogo->image.'" width="200" height="80" alt="logo" /></td>
							<td align="right" valign="top" width="80%">
								<strong style="font-size: 24px;">'.$profile->companyname.'</strong>
								<br>'.$profile->address1.'
								<br>'.$profile->address2.', '.$profile->city.' - '.$profile->pincode.'
								<br><b>GSTIN: '.$profile->gstin.'</b>
								<br>Phone : '.$profile->phoneno.',&nbsp;Mobile : '.$profile->mobileno.'<br>Email id : '.$profile->emailid.', Website : '.$profile->website.'
							</td>
						</tr>
					</table>
				</htmlpageheader>

				<htmlpagefooter name="myfooter">
					<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
						Page {PAGENO} of {nb}
					</div>
				</htmlpagefooter>

				<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
				<sethtmlpagefooter name="myfooter" value="on" />
				mpdf-->

				<table width="100%" style="border:1px solid #000;border-collapse: collapse;margin-top:-24px;margin-bottom:2px;" cellpadding="5" cellspacing="0">
					<tr>
						<td width="65%" style="border-top: 0.1mm solid #000;border-bottom:0.1mm solid #000;border-left:0.1mm solid #000;border-right:0.1mm solid #000; ">
							<span style="font-size: 10pt; color: #555555; font-family: sans;">TO:</span><br /><span style="font-family: sans;font-size:9pt;font-weight:bold;">'.$bil->customername.'</span><br />'.@$addresss1.', '.@$addresss2.'<br />'.@$citys.'<br />'.@$states.' - '.@$pincode.'<br />Mobile No : '.@$mobileno.'
							<br />
							<br />
							<span style="font-weight:bold;">GSTIN : '.@$gstnos.'<br />State Code : '.@$statecode.'</span>

						</td>
						<td width="20%" style="border-top: 0.1mm solid #000;border-bottom:0.1mm solid #000;border-right:0.1mm solid #000;">
							<span style="font-size: 7pt; color: #555555; font-family: sans;">INVOICE NO:</span><br />'.$bil->invoiceno.'<br /><br />
							<span style="font-size: 7pt; color: #555555; font-family: sans;">INVOICE DATE:</span><br />'.date('d/m/Y',strtotime($bil->invoicedate)).'<br /><br />
							<span style="font-size: 7pt; color: #555555; font-family: sans;">TRANSPORT MODE:</span><br />'.$bil->transportmode.'
						</td>	
						<td width="20%" style="border-top: 0.1mm solid #000;border-bottom:0.1mm solid #000;border-right:0.1mm solid #000;">
							<span style="font-size: 7pt; color: #555555; font-family: sans;">ORDER NO:</span><br />'.$bil->orderno.'<br /><br />
							<span style="font-size: 7pt; color: #555555; font-family: sans;">DELIVERY AT:</span><br />'.$bil->deliveryat.'<br /><br />
							<span style="font-size: 7pt; color: #555555; font-family: sans;">VEHICLE NO:</span><br />'.$bil->vehicleno.'
						</td>
					</tr>
				</table>
				<!--<br />-->
				<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
					<thead>
						<tr>
							<td width="8%">S.No</td>
							<td width="'.$itemwidth.'%">Item Description</td>
							<td width="6%">UOM</td>
							<td width="8%">Quantity</td>
							<td width="8%">Rate</td>
							<td width="8%">Amount</td>
							'.$diccount_header.
							$cgst_header.
							$igst_header.'
							<td width="12%">total</td>
						</tr>
					</thead>
					<tbody>
					';
					//foreach ($pre  as  $vob)
					//{
						$vob=$bil;
						$itemname=explode('||',$vob->itemname);
						$item_desc=explode('||',$vob->item_desc);
						$rate=explode('||',$vob->rate);
						$qty=explode('||',$vob->qty);
						// $amount=explode('||',$vob->total);
						$total=explode('||',$vob->total);
						$amount=explode('||',$vob->amount);
						$uom=explode('||',$vob->uom);
						$discounts=explode('||',$vob->discount);
						$disamounts=explode('||',$vob->discountamount);
						$taxableamt=explode('||',$vob->taxableamount);
						$hsnno=explode('||',$vob->hsnno);
						$sgsts=explode('||',$vob->sgst);
						$igsts=explode('||',$vob->igst);
						$cgsts=explode('||',$vob->cgst);
						$sgstamts=explode('||',$vob->sgstamount);
						$igstamts=explode('||',$vob->igstamount);
						$cgstamts=explode('||',$vob->cgstamount);
						$overalltotal=explode('||',$vob->total);
						$dcnos=explode('||',$vob->dcnos);

						$count=count($itemname);
						for($i=0; $i< $count; $i++){
							$j=$i+1;
							if(@$item_desc[$i]=='')
							{
								@$itemDet_desc='';
							}
							else
							{
								@$itemDet_desc='<span align="center" style="font-size:12px;">(Description :&nbsp;'.$item_desc[$i].')</span>';
							}
							if($discounts[$i]==0 || $discounts[$i]=='')
							{
								$discount=0;
							}
							else
							{
								$discount=$discounts[$i];
							}

							if($disamounts[$i]==0 || $disamounts[$i]=='')
							{
								$disamount=0;
							}
							else
							{
								$disamount=$disamounts[$i];
							}

							if($sgsts[$i]==0 || $sgsts[$i]=='')
							{
								$sgst=0;
							}
							else
							{
								$sgst=$sgsts[$i];
							}

							if($igsts[$i]==0 || $igsts[$i]=='')
							{
								$igst=0;
							}
							else
							{
								$igst=$igsts[$i];
							}

							if($cgsts[$i]==0 || $cgsts[$i]=='')
							{
								$cgst=0;
							}
							else
							{
								$cgst=$cgsts[$i];
							}

							if($sgstamts[$i]==0 || $sgstamts[$i]=='')
							{
								$sgstamt=0;
							}
							else
							{
								$sgstamt=$sgstamts[$i];
							}

							if($igstamts[$i]==0 || $igstamts[$i]=='')
							{
								$igstamt=0;
							}
							else
							{
								$igstamt=$igstamts[$i];
							}

							if($cgstamts[$i]==0 || $cgstamts[$i]=='')
							{
								$cgstamt=0;
							}
							else
							{
								$cgstamt=$cgstamts[$i];
							}

							if(@$dcnos[$i]=='')
							{
								$dc_details='';
							}
							else
							{
								@$dcdates=$this->db->select('dcdate')->where('dcno',$dcnos[$i])->get('dcbill_details')->row()->dcdate;
								@$dc_details='&nbsp;&nbsp;<span align="center" style="font-size:9px;">Dcno: '.$dcnos[$i].' Dt: '.date('d-m-y',strtotime($dcdates)).'</span>';
							}

							$dis[]=$disamount;
							$over[]=$overalltotal[$i];
							$taxam[]=$taxableamt[$i];
							$qtyh[]=$qty[$i];
							$totalh[]=$total[$i];
							$sgsth[]=$sgstamt;
							$igsth[]=$igstamt;
							$cgsth[]=$cgstamt;
							$totamt[]=$amount[$i];
							$bottomTot =array_sum($totamt);	
							$grandTotCgsth = array_sum($cgsth);
							$grandTotSgsth = array_sum($sgsth);
							$grandTotIgsth = array_sum($igsth);
							if($discountBy=="percent_wise") { $percent_sign =' <br>  <span style="font-size:13px;">'.number_format($discount,2).'%</span>'; } else { $percent_sign=''; }
							if($diccount >0)
							{
								$diccount_amount = '<td class="cost">'.number_format($disamount,2).$percent_sign.'</td><td class="cost">'.number_format($taxableamt[$i],2).'</td>';
							}
							else
							{
								$diccount_amount = '';
							}
							if($bil->gsttype=='intrastate')
							{
								$cgst_rowAmt = '<td class="cost">'.number_format($cgstamt,2).'<br><span style="font-size:13px;">@'.number_format($cgst,2).'%</span></td>
								<td class="cost">'.number_format($sgstamt,2).'<br><span style="font-size:13px;">@'.number_format($sgst,2).'%</span></td>';
								$igst_rowAmt='';
							}
							if($bil->gsttype=='interstate')
							{
								$igst_rowAmt='<td class="cost">'.number_format($igstamt,2).'<br><span style="font-size:13px;">@'.number_format($igst,2).'%</span></td>';
								$cgst_rowAmt='';
							 } 

							$html .='
								<tr>
									<td align="center">'.$j.'</td>
									<td align="left">'.$itemname[$i].'<br><span align="center" style="font-size:12px;">(HSN/SAC :&nbsp;'.$hsnno[$i].')</span>'.$dc_details.$itemDet_desc.'</td>
									<td>'.$uom[$i].'</td>
									<td class="cost">'.$qty[$i].'</td>
									<td class="cost">'.number_format($rate[$i],2).'</td>
									<td class="cost">'.number_format($amount[$i],2).'</td>
									'.$diccount_amount.
									$cgst_rowAmt.
									$igst_rowAmt.'
									<td class="cost">'.number_format($overalltotal[$i],2).'</td>
								</tr>';
								}
							//}
						for($i=0;$i<=5;$i++) {
						$html .='
						<tr>
							<td><p style="min-height:216px;">&nbsp;</p></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							'.$diccount_empty.
							$cgst_empty.
							$igst_empty.'
							<td>&nbsp;</td>
						</tr>';
						}
						$freight_row='';
						if($vob->freightamount)
						{
							$bottomTot +=$vob->freightamount;
							$freight_row .= '
							<tr style="height:1px;">
								<td></td>
								<td class="align-right">Freight Charges</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td class="cost">'.number_format(@$vob->freightamount,2).'</td>';
							
								if($diccount >0)
								{
									$freight_row .='<td>&nbsp;</td><td>&nbsp;</td>'; 
								}
							if($bil->gsttype=='intrastate')
							{
								$grandTotCgsth +=$vob->freightcgstamount;
								$grandTotSgsth +=$vob->freightsgstamount;
								$freight_row .='<td class="cost">'.number_format(@$vob->freightcgstamount,2).'<br><span style="font-size:13px;">@'.number_format(@$vob->freightcgst,2).'%</span></td>
								<td class="cost"><strong>'.number_format(@$vob->freightsgstamount,2).'<br><span style="font-size:13px;">@'.number_format(@$vob->freightsgst,2).'%</span></td>';
							}
							if($bil->gsttype=='interstate')
							{
								$grandTotIgsth +=$vob->freightigstamount;
								$freight_row .='<td class="cost">'.number_format(@$vob->freightigstamount,2).'<br><span style="font-size:13px;">@'.number_format(@$vob->freightigst,2).'%</span></td>';
							}
							$freight_row .='<td class="cost">'.number_format(@$vob->freighttotal,2).'</td>                 
							</tr>';
						} 
						$loadingRow='';
						if($vob->loadingamount)
						{
							$bottomTot +=$vob->loadingamount;
							$loadingRow .= '
								<tr style="height:1px;">
									<td>&nbsp;</td>
									<td class="align-right">Loading & Packing Charges</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="cost">'.number_format(@$vob->loadingamount,2).'</td>';
							if($diccount >0)
							{
								$loadingRow .='<td>&nbsp;</td><td>&nbsp;</td>';
							}
							
							if($bil->gsttype=='intrastate')
							{
								$grandTotCgsth +=$vob->loadingcgstamount;
								$grandTotSgsth +=$vob->loadingsgstamount;
								$loadingRow .='<td class="cost">'.number_format(@$vob->loadingcgstamount,2).'<br><span style="font-size:13px;">@'.number_format(@$vob->loadingcgst,2).'%</span></td>
								<td class="cost">'.number_format(@$vob->loadingsgstamount,2).'<br><span style="font-size:13px;">@'.number_format(@$vob->loadingsgst,2).'%</span></td>';
							}
							if($bil->gsttype=='interstate')
							{
								$grandTotIgsth +=$vob->loadingigstamount;
								$loadingRow .='<td class="cost">'.number_format(@$vob->loadingigstamount,2).'<br><span style="font-size:13px;">@'. number_format(@$vob->loadingigst,2).'%</span></td>';
							} 
							$loadingRow .='<td class="cost">'.number_format(@$vob->loadingtotal,2).'</td>                 
						</tr>';
						} 
						$html .=$freight_row.$loadingRow;
						$html .='
						<tr >
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>     
						<td>&nbsp;</td> 
						<td class="align-right"><small>Basic Amount</small></td>';
						if($diccount >0)
						{
							$html .='<td class="align-right"><small>Discount</small></td><td class="align-right"><small>Taxable Amount</small></td>  ';
						}
						if($bil->gsttype=='intrastate')
						{
							$html .='<td class="align-right"><small>CGST</small></td><td class="align-right"><small>SGST</small></td> ';
						}
						if($bil->gsttype=='interstate')
						{
							$html .='<td class="align-right"><small>IGST</small></td>';
						}
						$html .='<td class="align-right"><small>Total</small></td>
						</tr>
						<tr >
						  <td colspan="5" align="right" style="border-top:1px solid #888888;font-size:18px;font-weight:bold;">Total</td>
						  <td align="right" style="border-top:1px solid #888888;font-size:14px;font-weight:bold;">&nbsp;'.number_format($bottomTot,2).'</td>';
						  if($diccount >0)
						  {
							$html .='<td align="right" style="border-top:1px solid #888888;font-size:14px;font-weight:bold;">&nbsp;'.number_format(array_sum($dis),2).'</td>
									<td align="right" style="border-top:1px solid #888888;padding:5px;font-size:14px;font-weight:bold;">&nbsp;'.number_format(array_sum($taxam),2).'</td> ';
						  }
						  if($bil->gsttype=='intrastate')
						  {
							$html .='<td align="right" style="border-top:1px solid #888888;padding:5px;font-size:14px;font-weight:bold;">&nbsp;'.number_format($grandTotCgsth,2).'</td>     
									<td align="right" style="border-top:1px solid #888888;padding:5px;font-size:14px;font-weight:bold;">&nbsp;'.number_format($grandTotSgsth,2).'</td>'; 
						  }
						  if($bil->gsttype=='interstate')
						  {
							$html .='<td align="right" style="border-top:1px solid #888888;padding:5px;font-size:14px;font-weight:bold;">'.number_format($grandTotIgsth,2).'</td>';
						  }
						  $html .='<td align="right" style="border-top:1px solid #888888;padding:5px;font-size:14px;font-weight:bold;">&nbsp;'.number_format($bil->subtotal,2).'</td>
						</tr>';
						$html .='
						<tr>
						<td class="blanktotal" colspan="'.($columnCount-2).'" rowspan="3"><span style="font-size:13px;">Rupees :<b style="font-size:13px;">'.$fin.' only</b></span></td>
						<td class="totals" colspan="3"><span style="font-size:16px;font-weight:bold;">Sub Total&nbsp;&nbsp;:</span></td>
						<td class="totals cost"><span style="font-size:14px;font-weight:bold;">'.number_format($bil->subtotal,2).'</span></td>
						</tr>
						<tr>
						<td class="totals"  colspan="3"><span style="font-size:16px;font-weight:bold;">Round Off&nbsp;&nbsp;:</span></td>
						<td class="totals cost"><span style="font-size:14px;font-weight:bold;">'.number_format($bil->roundOff,2).'</span></td>
						</tr>
						<tr>
						<td class="totals"  colspan="3"><span style="font-size:16px;font-weight:bold;">Other Charges&nbsp;&nbsp;:</span></td>
						<td class="totals cost"><span style="font-size:14px;font-weight:bold;">'.number_format($bil->othercharges,2).'</span></td>
						</tr>
						<tr>
						<td class="totals" style="border:none" colspan="'.($columnCount-2).'">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td align="left" colspan="4" style="border:none"><span style="font-size:14px;font-weight:bold;">Bank Details</span></td>
								</tr>
								 <tr>
									<td width="25%" align="left" style="font-size:14px;border:none" ><span style="font-size:14px;">Bank Name&nbsp;:</span></td>
									<td width="25%" align="left" style="border:none"><span style="font-size:14px;">'.$profile->bankname.'</span></td>
									<td width="25%" align="left" style="border:none"><span style="font-size:14px;">Bank Branch:</span></td>
									<td width="25%" align="left" style="border:none"><span style="font-size:14px;">'.$profile->bankbranch.'</span></td>
								  </tr>
								  <tr>
									<td  align="left" style="font-size:14px;border:none"><span style="font-size:14px;">Account No&nbsp;:</span></td>
									<td style="border:none"><span style="font-size:14px;">'.$profile->accountno.'</span></td>
									<td align="left" style="border:none"><span style="font-size:14px;">&nbsp;IFSC Code&nbsp;&nbsp;&nbsp;&nbsp;:</span></td>
									<td align="left" style="border:none"><span style="font-size:14px;">'.$profile->ifsccode.'</span></td>
								  </tr> 
							</table>
							</td>
						<td class="totals"  colspan="3"><span style="font-size:16px;font-weight:bold;">Invoice Amount &nbsp;&nbsp;:</span></td>
						<td class="totals cost" ><span style="font-size:14px;font-weight:bold;">'.number_format(round($bil->grandtotal),2).'</strong>&nbsp;</td>
					  </tr>
					  <tr>
						<td colspan="'.($columnCount+2).'"><p style="font-size:12px;padding:2px;">Certified that the particulars given are true and correct the amount indicated represents the price actually charged and  there is no flow of additional consideration directly or indirectly from the buyer.</p></td>
					  </tr>
						<tr>
						<td colspan="'.($columnCount+2).'">
							<table width="100%"  align="center" style="border-collapse:collapse;border:1px solid #888888;">
								<tr>
									<td width="34%" style="font-size:13px;border-right:1px solid #888888;"><b>&nbsp;&nbsp;TERMS AND CONDITIONS</b></td>
									<td width="33%" style="font-size:13px;border-right:1px solid #888888;">&nbsp;</td>  
									<td width="33%" style="font-size:13px;border-right:1px solid #888888;" align="center">For <b style="font-size:15px;">Myoffice Solutions</b></td>
									</tr>
									<tr>
									<td height="95" valign="top" style="font-size:11px;border-right:1px solid #888888;">&nbsp;&nbsp;1.No Claim For breakage or Loss during transit.<br>&nbsp;&nbsp;2.All disputes subject to Coimbatore Jurisdiction only.<br>&nbsp;&nbsp;3.Our Responsibility Ceases after the goods have been<br>&nbsp;&nbsp;delivered to carriers.</td>
									<td style="font-size:13px;border-right:1px solid #888888;" valign="bottom" align="center"><b>Receiver\'s Signature</b></td>
									<td style="font-size:14px;border-right:1px solid #888888;" align="center" valign="bottom"><b>Authorised Signatory</b></td>
								</tr>    
							</table>
						</td>
					  </tr>
					  </tbody>
				</table>
				
			</body>
		</html>
		';
		@$invoice_waterMark=$this->db->select('invoice_waterMark')->where('id', '1')->get('preference_settings')->row()->invoice_waterMark;
		require_once(APPPATH.'libraries/mpdf/mpdf.php');
		$mpdf=new mPDF('c','A4','','',20,15,48,25,10,10); 
		$mpdf->SetProtection(array('print'));
		//$mpdf->SetTitle(' - Invoice');
		//$mpdf->SetAuthor(' + Invoice');
		$mpdf->SetTitle($profile->companyname.' - Invoice');
		$mpdf->SetAuthor($profile->companyname);
		//$mpdf->SetWatermarkText(strtoupper($profile->companyname));
		
		if($invoice_waterMark=='1')
		{
		$mpdf->SetWatermarkText(strtoupper($profile->companyname));
		$mpdf->showWatermarkText = true;
		}
		
		$mpdf->watermark_font = 'DejaVuSansCondensed';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->WriteHTML($html);
		$mpdf->Output(); exit;

	}
  public function rebill2()
  {
    $id=base64_decode($this->uri->segment(3));
    $this->load->library('mpdf'); 
    $data['pre']=$this->db->where('id',$id)->get('invoice_details')->result();

    foreach($data['pre'] as $b)
    {
      $number= $b->grandtotal;
    }
    $no = round($number);
    $point = round($number - $no, 2) * 100;
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
    $data['invoice']=$this->db->where('id',$id)->get('invoice_details')->result();
    $this->load->view('invoicebill',$data);
  }

  public function search()
  { 

    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');
    $cusname=$this->input->post('cusname');
    $invoiceno=$this->input->post('invoiceno');
    $gsttype=$this->input->post('gsttype');

    $data=array(
      'rcbio_fromdate' => $fromdate,
      'rcbio_todate' => $todate,
      'rcbio_cusname' => $cusname,
      'rcbio_invoiceno' => $invoiceno,
      'rcbio_gsttype' => $gsttype,
      'rcbio_bill_format' =>'Print',
      );

    $this->session->set_userdata($data);

  }
	public function billing_reportdownload()
	{ 
		$fromdate=$this->input->post('fromdate');
		$todate=$this->input->post('todate');
		$cusname=$this->input->post('cusname');
		$invoiceno=$this->input->post('invoiceno');
		$gsttype=$this->input->post('gsttype');
		$data=array(
		'rcbio_fromdate' => $fromdate,
		'rcbio_todate' => $todate,
		'rcbio_cusname' => $cusname,
		'rcbio_invoiceno' => $invoiceno,
		'rcbio_gsttype' => $gsttype,
		'rcbio_bill_format' =>'Excel_Download',
		);
		$this->session->set_userdata($data);

	}

  public function search_reports()
  {   
    $bill_format=$this->session->userdata('rcbio_bill_format');                

    if($bill_format=='Print')
    {
      $data['invoice']=$this->old_invoice_model->search_billing();

      $data['fromdate']=$this->session->userdata('rcbio_fromdate');
      $data['todate']=$this->session->userdata('rcbio_todate');
      $data['cusname']=$this->session->userdata('rcbio_cusname');
      $data['invoiceno']=$this->session->userdata('rcbio_invoiceno');
      $data['gsttype']=$this->session->userdata('rcbio_gsttype');


      $this->load->view('invoice_reports',$data);

    }
	if($bill_format=='Excel_Download')
	{
		$data['fromdate']=$this->session->userdata('rcbio_fromdate');
		$data['todate']=$this->session->userdata('rcbio_todate');
		$data['cusname']=$this->session->userdata('rcbio_cusname');
		$data['invoiceno']=$this->session->userdata('rcbio_invoiceno');
		$data['gsttype']=$this->session->userdata('rcbio_gsttype');
		 
		//if($this->session->userdata('rcbio_invoiceno')!="") 	{ $head_invoiceno = $this->session->userdata('rcbio_invoiceno'); 	} else { $head_invoiceno='-'; 	}
		if($this->session->userdata('rcbio_cusname')!="") 		{ $head_customer = $this->session->userdata('rcbio_cusname'); 		} else { $head_customer='-'; 	}
		if($this->session->userdata('rcbio_fromdate')!="") 		{ $head_fromdate = $this->session->userdata('rcbio_fromdate'); 		} else { $head_fromdate='-'; 	}
		if($this->session->userdata('rcbio_todate')!="") 		{ $head_todate = $this->session->userdata('rcbio_todate'); 			} else { $head_todate='-'; 		}
		/* LOAD EXCEL LIBRARY AND SET TITLE */ 
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Invoice Party Statement');
		$this->excel->getActiveSheet()->setCellValue('A1', 'INVOICE  PARTY STATEMENT');
		$this->excel->getActiveSheet()->mergeCells('A1:G1');
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
		
		$invoice=$this->old_invoice_model->search_billing();
		$this->excel->getActiveSheet()->setCellValue('A2', 'Customer Name : ');
		$this->excel->getActiveSheet()->setCellValue('B2', $head_customer);
		$this->excel->getActiveSheet()->setCellValue('C2', 'From Date : ');
		$this->excel->getActiveSheet()->setCellValue('D2', $head_fromdate);
		$this->excel->getActiveSheet()->setCellValue('E2', 'To Date : ');
		$this->excel->getActiveSheet()->setCellValue('F2', $head_todate);
		$this->excel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true); 
		$this->excel->getActiveSheet()->getStyle('A2:F2')->getFont()->setSize(14);
		
		$this->excel->getActiveSheet()->setCellValue('A3', 'Date');
		$this->excel->getActiveSheet()->setCellValue('B3', 'Invoice No.');
		$this->excel->getActiveSheet()->setCellValue('C3', 'Customer Name');
		$this->excel->getActiveSheet()->setCellValue('D3', 'GSTIN');
		$this->excel->getActiveSheet()->setCellValue('E3', 'Basic Amount');
		$this->excel->getActiveSheet()->setCellValue('F3', 'Invoice Amount');
		$this->excel->getActiveSheet()->getStyle('A3:F3')->getFont()->setSize(12);

		for($col = ord('A'); $col <= ord('F'); $col++){
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
		$i=4;
		$total[]=array(); 
		$sgst_amounts[]=array(); 
		$igst_amounts[]=array(); 
		$cgst_amounts[]=array(); 
		$de_amounts[]=array(); 
		foreach ($invoice as $row) {
			$i++;
			$total[]=array(); 
			$sgst_amounts[]=array(); 
			$igst_amounts[]=array(); 
			$cgst_amounts[]=array(); 
			$de_amounts[]=array(); 
			if($row['sgstamount']!="")
			{
				$sgstamount=explode('||',$row['sgstamount']);
				$sgst_amount=array_sum($sgstamount);
				$sgst_amounts[]=array_sum($sgstamount);
			}
			else
			{
				$sgst_amount=0;
			}
			
			if($row['igstamount']!="")
			{
				$igstamount=explode('||',$row['igstamount']);
				$igst_amount=array_sum($igstamount);
				$igst_amounts[]=array_sum($igstamount);
			}
			else
			{
				$igst_amount=0;
			}
			
			if($row['cgstamount']!="")
			{
				$cgstamount=explode('||',$row['cgstamount']);
				$cgst_amount=array_sum($cgstamount);
				$cgst_amounts[]=array_sum($cgstamount);
			}
			else
			{
				$cgst_amount=0;
			}
			if($row['amount']!="")
			{
				$amount=explode('||',$row['amount']);
				// print_r($amount);
				//echo '<br>';
				$de_amount=array_sum($amount);
				$de_amounts[]=array_sum($amount);
			}
			else
			{
				$de_amount=0;
			}
			$total[]=$row['grandtotal'];
			$grandtotal = $row['grandtotal'];
			$date=date('d-m-Y',strtotime($row['invoicedate']));
			@$gstin=$this->db->select('gstno')->where('id',$row['customerId'])->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->gstno;
			/*@$phoneno=$this->db->select('phoneno')->where('id',$row['customerId'])->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->phoneno;*/
			$data1['invoicedate']=date('d-m-Y',strtotime($row['invoicedate']));
			$data1['invoiceno']=' '.$row['invoiceno'];
			$data1['customername']=' '.ucfirst($row['customername']);
			$data1['gstin']=$gstin;
			$data1['de_amount']=' '.number_format($de_amount,2);
			$data1['grandtotal']=' '.number_format($grandtotal,2);
			$exceldata[] = $data1;
			
			$this->excel->getActiveSheet()->getStyle('A'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('B'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('C'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('D'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('E'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$this->excel->getActiveSheet()->getStyle('F'.($i-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		}
		$totals=array_sum($total);
		if(count($exceldata) > 0)
		{
			$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A4');
		}
		$rowCount = $i++;
		$this->excel->getActiveSheet()->setCellValue('A'.$rowCount, 'Grand Total ');
		$this->excel->getActiveSheet()->mergeCells('A'.$rowCount.':D'.$rowCount);
		$this->excel->getActiveSheet()->getStyle('A'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->excel->getActiveSheet()->setCellValue('E'.$rowCount, ' '.number_format(array_sum($de_amounts),2));
		$this->excel->getActiveSheet()->getStyle('E'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->excel->getActiveSheet()->setCellValue('F'.$rowCount, ' '.number_format($totals,2));
		$this->excel->getActiveSheet()->getStyle('F'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':F'.$rowCount)->getFont()->setBold(true); 
		$this->excel->getActiveSheet()->getStyle('A'.$rowCount.':F'.$rowCount)->getFont()->setSize(12);
		$filename='Invoice Party Statment-'.date('d/m/y h_i_s A').'.xls'; //save our workbook as this file name
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


public function get_stockqty()
{
  $itemcode=$this->input->post('name');
  $this->db->select('*');
  $this->db->from('stock');
  $this->db->where('itemname',$itemcode);
  $query = $this->db->get();  
  $result = $query->result();

  foreach($result as $h)
  {   

    $vob['balance']=$h->balance;

  }
  echo json_encode($vob);
}


Public function get_dcno()
  {
    $cusname=$_POST['id'];
   $query=$this->db->where('status',1)->where('cusname',$cusname)->where('balanceqty >',0)->group_by('dcno')->get('dc_delivery');
    $result= $query->result();
    $data=array();
    foreach($result as $r)
    {
      $data['value']=$r->dcno;
      $data['label']=$r->dcno;
      $json[]=$data;


    }
    echo json_encode($json);


  }

	public function getdc_details()
	{
		$invoicetype=$this->input->post('invoicetype');
		$gsttype=$this->input->post('gsttype');
		$data['gsttype']=$gsttype;
		if($invoicetype=='Against DC')
		{
			$html='<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select DC No</span></div>';
			echo $html; 
		}
		else
		{
			$this->load->view('directinvoice',$data);
		}
	}

	public function getdcdetails()
	{
		$dcno=$this->input->post('dcno');
		$gsttype=$this->input->post('gsttype');
		if($dcno=='')
		{
			$html='<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select DC No</span></div>';
			echo $html; 
		}
		else
		{
			$data['dcno']=$dcno;
			$data['gsttype']=$gsttype;
			$this->load->view('againstdc',$data);
		}
	}
  
}

ob_flush();
?>
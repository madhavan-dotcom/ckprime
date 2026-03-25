<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class OldPurchaseReports extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('old_purchase_model');
    if($this->session->userdata('rcbio_login')=='')
    {

      $this->session->set_flashdata('msg','Please Login to continue!');
      redirect('login');
    } 
    date_default_timezone_set('Asia/Kolkata');    
  }

	public function index()
	{
		$this->load->view('header');
		$this->load->view('old_purchase_view');
		$this->load->view('footer1');
	}
	public function views()
	{
		$id=base64_decode($this->uri->segment(3));
		$data['result']=$this->db->where('id',$id)->get('purchase_details_backup')->result_array(); 
		$this->load->view('header');
		$this->load->view('oldpurchaserpt_view',$data);
		$this->load->view('footer');
	}
	public function ajax_list()
	{
		$list = $this->old_purchase_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i=1;
		foreach ($list as $person) {
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
			$row[] = $person->suppliername;
			$row[] = $numberDays.' Days';
			$row[] = $person->grandtotal;
			$code=base64_encode($person->id);
			//add html for action
			/*$return_status=explode("||",$person->return_status);
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


				<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchase/views/'.$code).'" title="View" >View</a></li>
				<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchase/edit/'.$code).'" title="Edit" >Edit</a></li>
				
				<li>'.$deleteOptn.'</li>
				</ul>
				</div>

				'; 
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


			<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchase/views/'.$code).'" title="View" >View</a></li>



			<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchase/edit/'.$code).'" title="Edit" >Edit</a></li>

			<li>'.$deleteOptn.'</li>
			</ul>
			</div>

			';
			}
			*/
			$row[]='<a class="btn btn-info" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('oldPurchaseReports/views/'.$code).'" title="View" >View</a>';
			$data[] = $row;
		}

		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $this->old_purchase_model->count_all(),
		"recordsFiltered" => $this->old_purchase_model->count_filtered(),
		"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}



	public function ajax_delete($id)
	{
	  $this->old_purchase_model->delete_by_id($id);
	  echo json_encode(array("status" => TRUE));
	}


public function autocomplete_customername()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('customer_details');
  $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
  $this->db->like('name',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->name;
    $json_array['value']    = $d->name;
    $json_array['address']    = $d->address1.', '.$d->address2.', '.$d->city.', '.$d->state;
    $json_array['supplierid'] = $d->id;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}

public function autocomplete_customername1()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('customer_details');
  $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
  $this->db->like('name',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->name;
    $json_array['value']    = $d->name;
    $json_array['address']    = $d->address1.', '.$d->address2.', '.$d->city.', '.$d->state;
    $json_array['supplierid'] = $d->id;
    $name[]             = $json_array;
  }
  
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('vendor_details');
  $this->db->like('vendorname',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->vendorname;
    $json_array['value']    = $d->vendorname;
    $json_array['address']    = $d->address1.', '.$d->address2.', '.$d->city.', '.$d->state;
    $json_array['supplierid'] = $d->id;
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
    $vob['sgst']=$h->sgst;
    $vob['cgst']=$h->cgst;
    $vob['igst']=$h->igst;
    $vob['uom']=$uom;

  }
  echo json_encode($vob);
}



public function autocomplete_itemname()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('itemname',$orderno);
  $this->db->where('itemtype','Raw Material/Spares');
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


public function getsupplier()
{
  $name=$_POST['name'];
  $data=$this->db->where('name',$name)->where("(type = 'Intra supplier' OR type = 'Inter supplier')")->get('customer_details')->result();
  echo $count=count($data);

}


public function autocomplete_invoiceno()
{
  $name=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('purchase_details');
  $this->db->like('purchaseno',$name);
  $this->db->where('purchasetype','Direct Purchase');
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
public function autocomplete_invoiceno1()
{
  $name=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('purchase_details');
  $this->db->like('invoiceno',$name);
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


	public function search_reports()
	{   
		$bill_format=$this->session->userdata('rcbio_bill_format');                
		$data['purchase']=$this->old_purchase_model->search_billing();
		$data['fromdate']=$this->session->userdata('rcbio_fromdate');
		$data['todate']=$this->session->userdata('rcbio_todate');
		$data['suppliername']=$this->session->userdata('rcbio_suppliername');
		$data['invoiceno']=$this->session->userdata('rcbio_invoiceno');
		$this->load->view('purchase_reports2',$data);
	}  


public function delete()
{
	$del=base64_decode($this->input->post('id'));
	//$del=$this->input->post('id');  
	$getdetails=$this->db->where('id',$del)->get('purchase_details')->result();
	foreach($getdetails as $row)

	// $getsuppliers='Intra supplier';
	// $getsuppliers1='Inter supplier';
	$joborderno = $row->joborderno;
	if($joborderno != '0')
	{
		//echo $joborderno;
		//exit;
		$itemname =explode('||',$row->itemname);
		$rate =explode('||',$row->rate);
		$qty =explode('||',$row->qty);
		$hsnno =explode('||',$row->hsnno);
		$invcount=count($itemname);
		for ($j=0; $j < $invcount; $j++)
		{ 
			$invwq=$this->db->where('returnitemname',$itemname[$j])->where('hsnno',$hsnno[$j])->get('sales_stock')->result();
			foreach($invwq as $w)
			$old=$w->balanceqty;  
			$bal=$old-$qty[$j];
			if($bal==0)
			{
				$this->db->where('returnitemname',$itemname[$j])->where('hsnno',$hsnno[$j])->delete('sales_stock');
			}
			else
			{
				$this->db->where('returnitemname',$itemname[$j])->where('hsnno',$hsnno[$j])->update('sales_stock',array('balanceqty'=>$bal));
			}
			
		} 
	}
	else
	{
		//echo 'else'.$joborderno;
		//exit;
		$customer_details=$this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')")->where('name',$row->suppliername)->get('customer_details')->result();
		foreach($customer_details as $c)
		$updates=$c->balanceamount-$row->grandtotal;
		$salesamt = $c->salesamount-$row->grandtotal;
		$this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')")->where('name',$row->suppliername)->update('customer_details',array('balanceamount'=>$updates,'salesamount'=>$salesamt));
		$itemname =explode('||',$row->itemname);
		$rate =explode('||',$row->rate);
		$qty =explode('||',$row->qty);
		$hsnno =explode('||',$row->hsnno);
		$invcount=count($itemname);
		for ($j=0; $j < $invcount; $j++)
		{ 
			$invwq=$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->get('stock')->result();
			foreach($invwq as $w)
			$old=$w->balance;  
			//$qty[$j];
			$bal=$old-$qty[$j];
			$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->update('stock',array('balance'=>$bal));

			$invwq1=$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->get('stock_reports')->result();
			foreach($invwq1 as $w1)
			$old1=$w1->updatestock;
			$ba1l=$old1-$qty[$j];
			$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->update('stock_reports',array('updatestock'=>$ba1l));		
		} 
	}
	
	$data=$this->db->where('id',$del)->delete('purchase_details');
	if($data)
	{
		//$this->db->where('purchaseid',$del)->delete('purchase_collection');
		$this->db->where('purchaseid',$del)->delete('po_party_statements');
		//$this->session->set_flashdata('msg','Purchase  Deleted successfully!');
		echo'yes';
	}
	else
	{
		//$this->session->set_flashdata('msg1','Purchase  Deleted unsuccessfully');
		echo'no';   

	}
}



public function pending()
{

  $data['pending']=$this->old_purchase_model->pending_select();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function pending_search()
{
  $data['pending']=$this->old_purchase_model->search_reports();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function purchase_reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->old_purchase_model->search_pending();

    // echo"<pre>";
    // print_r($data);
  $this->load->view('purchase_reports',$data,$fromdate,$todate,$suppliername);

}

public function reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->old_purchase_model->search_reports();

  
  $this->load->view('purchase_reports2',$data,$fromdate,$todate);

}


public function reports1()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->old_purchase_model->search_pending();

  
  $this->load->view('purchase_reports1',$data,$fromdate,$todate);

}

public function get_supplier()
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
		public function autocomplete_vendorname()
		{
			$orderno=$this->input->post('keyword');
			$this->db->select('*');
			$this->db->from('vendor_details');
			$this->db->like('vendorname',$orderno);
			$query = $this->db->get();
			$result = $query->result();
			$name       =  array();
			foreach ($result as $d){
				$json_array             = array();
				$json_array['label']    = $d->vendorname;
				$json_array['value']    = $d->vendorname;
				$json_array['id']    = 	$d->id;
				$json_array['vendordetails']    = 	$d->address1.', '.$d->address2;
				$name[]             = $json_array;
			}
			echo json_encode($name);
		}
		public function check_vendors()
		{
			$name=$_POST['vendors'];
			$data=$this->db->where('vendorname',$name)->get('vendor_details')->result();
			echo $count=count($data);
		}
		Public function get_vendorjoborderno()
		{
			$vendors=$_POST['vendors'];
			$query=$this->db->where('status',1)->where('vendors',$vendors)->group_by('joborderno')->get('job_details');
			$result= $query->result();
			$data=array(); 
			if($result)
			{
				foreach($result as $r)
				{
					$havingjobData = $this->db->where('joborderno',$r->joborderno)->where('balanceqty >',0)->get('job_data_returnable')->result_array();
					if(count($havingjobData) > 0)
					{
						$data['value']=$r->joborderno;
						$data['label']=$r->joborderno;
						$json[]=$data;
					}
				}
			}
			echo json_encode($json);
		}
		public function getjoborderdetails()
		{
			$jobOrder=$this->input->post('jobOrder');
			if($jobOrder=='')
			{
				$html='<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select Job Order No</span></div>';
			}
			else
			{
				$count=count($jobOrder);
				for ($i=0; $i < $count; $i++) { 
					$data[]=$this->db->where('joborderno',$jobOrder[$i])->where('balanceqty >',0)->get('job_data_returnable')->result_array();//
				}
				$discountBy=$this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
				if($discountBy=='percent_wise') { $discType= '%'; } else { $discType=''; }
			
				$html='
				<div class="table-responsive myform" >
				<table class="responsive table" width="100%">
					<thead> 
						<tr>
							<th -style="width:70px">HSN Code</th>
							<th -style="width:150px">Item Name</th>
							<th -style="width:50px">Qty</th>
							<th -style="width:50px">UOM</th>
							<th -style="width:70px">Rate</th>
							<th -style="width:100px">Amount</th>
							<th -style="width:40px">Disc '.$discType.'</th>
							<th -style="width:100px">&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
							<th class="sgst" -style="width:45px">&nbsp;&nbsp;&nbsp;CGST</th>
							<th class="sgst" -style="width:80px">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
							<th class="sgst" -style="width:45px">&nbsp;&nbsp;&nbsp;SGST</th>
							<th class="sgst" -style="width:80px">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
							<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
							<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
							<th -style="width:110px">Total</th>
							<th -style="width:10px;">&nbsp;</th>
						</tr>  
					</thead>
					<tbody>';
				$k=0;
				foreach ($data as $datas) 
				{
					foreach ($datas as $rows) 
					{
							$itemDet=$this->db->select('*')->where('hsnno', $rows['hsnno'])->where('itemname',$rows['returnitemname'])->get('additem')->row();
					$html.='
						<tr>
							<td><input class="" id="hsnno'.$k.'" parsley-trigger="change"  readonly type="text" name="hsnno[]" value="'.$rows['hsnno'].'" ><div id="hsnno_valid'.$k.'"></div><input type="hidden" name="priceType[]" id="priceType'.$k.'" value="'.$itemDet->priceType.'"/><input type="hidden" name="scrap[]" id="scrap'.$k.'" value="'.$rows['scrap'].'" /></td>
															
							<td><input class="itemname_class" data-id="'.$k.'" id="itemname'.$k.'" parsley-trigger="change" required  type="text" name="itemname[]" value="'.$rows['returnitemname'].'" ><div id="itemname_valid'.$k.'"></div></td>

							<td><input class="qty_class decimals" id="qty'.$k.'" data-id="'.$k.'" parsley-trigger="change" required type="text" name="qty[]"  autocomplete="off" value=""><div id="qty_valid'.$k.'"></div><div style="color:green;">Job Order Qty : '.$rows['balanceqty'].'</div></td>  

							<td><input class="" id="uom'.$k.'" parsley-trigger="change"  readonly  type="text" name="uom[]"  autocomplete="off" value="'.$rows['returnuom'].'"><div id="uom_valid'.$k.'"></div></td>

							<td><input class="rate_class decimals" data-id="'.$k.'" parsley-trigger="change"  id="rate'.$k.'" required type="text" name="rate[]"   autocomplete="off" value="'.$itemDet->price.'"><div id="rate_valid'.$k.'"></div></td>

							<td><input class="decimals" id="amount'.$k.'" parsley-trigger="change"  readonly type="text" name="amount[]" value=""  autocomplete="off"><div id="amount_valid'.$k.'"></div></td>

							<td><input class="discount_class decimals" id="discount'.$k.'" data-id="'.$k.'"  type="text" name="discount[]" onkeypress="return isNumberKey_With_Dot(event)" value="0"  autocomplete="off"><div id="discount_valid'.$k.'"></div></td>

							<td><input class="decimals" id="taxableamount'.$k.'" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount'.$k.'"><div id="taxableamount_valid'.$k.'"></div></td>

							<td class="sgst"><input class="decimals" readonly id="cgst'.$k.'"  type="text" name="cgst[]" onkeypress="return isNumberKey(event)" autocomplete="off" value="'.$itemDet->cgst.'"><div id="cgst_valid'.$k.'"></div></td>

							<td class="sgst"><input class="decimals" readonly id="cgstamount'.$k.'"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

							<td class="sgst"><input class="decimals" id="sgst'.$k.'" readonly  type="text" name="sgst[]" value="'.$itemDet->sgst.'" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid'.$k.'"></div></td>

							<td class="sgst"><input class="decimals" id="sgstamount'.$k.'"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

							<td class="igst" style="display:none;"><input class="decimals" id="igst'.$k.'"  type="text" name="igst[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" value="'.$itemDet->sgst.'"><div id="igst_valid'.$k.'"></div></td>

							<td class="igst" style="display:none;"><input class="decimals" id="igstamount'.$k.'"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

							<td><input class="" id="total'.$k.'" type="text" name="total[]" value=""  readonly ></td>
							<td style="width:10px;">&nbsp;<input class="form-control" parsley-trigger="change" readonly id="insertid" type="hidden" name="insertid" value="'.$rows['insertid'].'"><input class="form-control" parsley-trigger="change" readonly id="id" type="hidden" name="id[]" value="'.$rows['id'].'"> </td>
							';
							
							if($k==0)
							{
								$html .= '<td>&nbsp;</td>';
							}
							else
							{
								$html .='<td><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td>';
							}
						$html .='
						</tr>';
						$k++;
					}
				}
				$html.='
					</tbody>
				</table>
				
				<script>
				$(".remove").click(function(){
					$(this).parents("tr").remove();
				});
				</script>';
				/*foreach ($data as $datas) 
				{
					foreach ($datas as $rows) 
					{
						$html.='
						<script>
							$(".qty_class").keyup(function(){
								if($(this).val()==\'\') { $(this).val("0"); }
								var qty=(isNaN($("#qty'.$rows['id'].'").val())) ? 0 : $("#qty'.$rows['id'].'").val();
								var inwardqty=$("#inwardqty'.$rows['id'].'").val();
								var rejected_qty = (isNaN($("#rejected_qty'.$rows['id'].'").val())) ? 0 : $("#rejected_qty'.$rows['id'].'").val();
								var damaged_qty = (isNaN($("#damaged_qty'.$rows['id'].'").val())) ? 0 : $("#damaged_qty'.$rows['id'].'").val();
								var total_qty = parseFloat(qty)+parseFloat(rejected_qty)+parseFloat(damaged_qty);
								if(parseFloat(total_qty) > parseFloat(inwardqty))
								{
									alert("Invalid Qty");
									$(this).val("0");
									$(this).focus();
								}
							});
							$(".decimal").keyup(function(){
							var val = $(this).val();
							if(isNaN(val)){
							val = val.replace(/[^0-9\.-]/g,\'\');
							if(val.split(\'.\').length>2)
							val =val.replace(/\.-+$/,"");
							}
							$(this).val(val);
						});
						</script>';
					}
				}*/
			}
			echo $html;
		}
		function getaddpurchasedetails()
		{
			$discountBy=$this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
			if($discountBy=='percent_wise') { $discType= '%'; } else { $discType=''; }
			$html ='
			<div class="table-responsive myform directPurchaseDet" >
				<table class="table two">
					<thead> 
						<tr>
							<th style="width:70px">HSN Code</th>
							<th style="width:150px">Item Name <a target="_blank" href="<?php echo base_url();?>itemmaster">(Add Item)</a></th>
							<th style="width:50px">Qty</th>
							<th style="width:50px">UOM</th>
							<th style="width:70px">Rate</th>
							<th style="width:100px">Amount</th>
							<th style="width:40px">Disc '.$discType.'</th>
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

							<td><input class="qty_class decimals" id="qty0" data-id="0" parsley-trigger="change" required type="text" name="qty[]"  autocomplete="off" ><div id="qty_valid0"></div></td>  

							<td><input class="" id="uom0" parsley-trigger="change"  readonly  type="text" name="uom[]"  autocomplete="off"><div id="uom_valid0"></div></td>

							<td><input class="rate_class decimals" data-id="0" parsley-trigger="change"  id="rate0" required type="text" name="rate[]"   autocomplete="off"><div id="rate_valid0"></div></td>

							<td><input class="decimals" id="amount0" parsley-trigger="change"  readonly type="text" name="amount[]" value=""  autocomplete="off"><div id="amount_valid0"></div></td>

							<td><input class="discount_class decimals" id="discount0" data-id="0"  type="text" name="discount[]" onkeypress="return isNumberKey_With_Dot(event)" value="0"  autocomplete="off"><div id="discount_valid0"></div></td>

							<td><input class="decimals" id="taxableamount0" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount0"><div id="taxableamount_valid0"></div></td>

							<td class="sgst"><input class="decimals" readonly id="cgst0"  type="text" name="cgst[]" value="" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="cgst_valid0"></div></td>

							<td class="sgst"><input class="decimals" readonly id="cgstamount0"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

							<td class="sgst"><input class="decimals" id="sgst0" readonly  type="text" name="sgst[]" value="" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid0"></div></td>

							<td class="sgst"><input class="decimals" id="sgstamount0"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

							<td class="igst" style="display:none;"><input class="decimals" id="igst0"  type="text" name="igst[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid0"></div></td>

							<td class="igst" style="display:none;"><input class="decimals" id="igstamount0"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

							<td><input class="" id="total0" type="text" name="total[]" value=""  readonly ></td>
							<td style="width:10px;">&nbsp;</td>
						</tr>
				</tbody>
				<tbody id="append"></tbody> 
			</table> 
			</div>
			
			
			';
			echo $html;
		}
}

ob_flush();
?>
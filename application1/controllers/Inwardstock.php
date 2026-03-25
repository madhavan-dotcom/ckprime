<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Inwardstock extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('inwardstock_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}

	public function index()
	{
		$data['inwardstock']=$this->inwardstock_model->select();
		$this->load->view('header');
		$this->load->view('inwardstockview',$data);
		$this->load->view('footer1');
	}

	public function search()
	{
		$data['inwardstock']=$this->inwardstock_model->search_stock();
		$this->load->view('header');
		$this->load->view('inwardstockview',$data);
		$this->load->view('footer1');
	}

	public function insert()
	{
		$ic = $this->db->where('hsnno',$_POST['hsnno'])->where('itemname',$_POST['itemname'])->get('additem')->result();
		$co =count($ic);
		if($co==1)
		{
			$item=$this->db->where('itemname',$_POST['itemname'])->where('hsnno',$_POST['hsnno'])->get('inwardstock')->result();
			//print_r($item);
			//exit;
			if($item)
			{
				foreach($item as $i)
				{
					$qty=$i->quantity;
					$currentstock=$i->balance;
					$id=$i->id;
					$priceType=$i->priceType;
				}

				$total=$currentstock+$_POST['qty'];
				$itemname=$_POST['itemname'];
				$itemno=$_POST['itemno'];

				$data=array(
				'date'=>date('Y-m-d'),
				'itemname'=>$_POST['itemname'],
				'hsnno'=>$_POST['hsnno'],
				'balance'=>$total,
				'updatestock'=>$_POST['qty'],
				'stockdate'=>date('Y-m-d',strtotime($_POST['date'])),
				'status'=>1,
				'priceType' => $priceType);
				$result=$this->inwardstock_model->stock_update($itemname,$data);
				if($result==true)
				{
					$datas=array(
								'date'=>date('Y-m-d'),
								'stockdate'=>date('Y-m-d',strtotime($_POST['date'])),
								'itemname'=>$_POST['itemname'],
								'updatestock'=>$_POST['qty'],			
								'hsnno'=>$_POST['hsnno'],			
								'status'=>1,
								'priceType'	=> $priceType
								);
					$this->db->insert('inward_details',$datas);
					$this->session->set_flashdata('msg','Stock Update successfully');
					redirect('inwardstock');
				}
				else
				{
				$this->session->set_flashdata('msg1','Stock Update unsuccessfully');
				redirect('inwardstock');
				}
			}
			else
			{
				$itemDet = $this->db->where('hsnno',$_POST['hsnno'])->where('itemname',$_POST['itemname'])->get('additem')->row();
				$itemname=$_POST['itemname'];
				$qty=$_POST['qty'];
				$data=array(
				'date'=>date('Y-m-d'),
				'hsnno'=>$_POST['hsnno'],
				'sgst' => $itemDet->sgst,
				'cgst' => $itemDet->cgst,
				'igst' => $itemDet->igst,
				'itemname'=>$itemname,
				'quantity'=>$qty,
				'rate'	=> $itemDet->price,
				'updatestock'=>$_POST['qty'],
				'status'=>1,
				'balance'=>$qty,
				'stockdate'=>date('Y-m-d',strtotime($_POST['date'])),
				'priceType' => $itemDet->priceType
				);
				$result=$this->inwardstock_model->add($data);
				if($result==true)
				{
					$datas=array(
					'date'=>date('Y-m-d'),
					'hsnno'=>$_POST['hsnno'],
					'itemname'=>$_POST['itemname'],
					'status'=>1,
					'updatestock'=>$_POST['qty'],
					'stat' => 'FromAddStock',
					'stockdate'=>date('Y-m-d',strtotime($_POST['date'])),
					'priceType' => $itemDet->priceType								
					);
					$this->db->insert('inward_details',$datas);
					$this->session->set_flashdata('msg','Stock added successfully');
					redirect('inwardstock');
				}
				else
				{
					$this->session->set_flashdata('msg1','Stock added unsuccessfully');
					redirect('inwardstock');
				}
			}
		}
		else
		{
			$this->session->set_flashdata('msg1','Stock added unsuccessfully');
			redirect('inwardstock');
		}
	}

	public function overallreports()
	{
		$data['inwardstock']=$this->inwardstock_model->overallreports();
		$this->load->view('overallstock',$data);
	}


	public function reports()
	{
		$fromdate=$_POST['fromdate'];
		$todate=$_POST['todate'];
		$customername = $_POST['customername'];
		$itemname = $_POST['itemname'];
		$data['inwardstock']=$this->inwardstock_model->search_stock();
		$this->load->view('inwardstock_reports',$data,$fromdate,$todate,$customername,$itemname);
	}


	public function autocomplete_itemname()
	{
		$itemname=$this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('itemname',$itemname);
		$this->db->where('status',1);
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
$json_array['gstno']    = $d->gstno;
$json_array['type']    = $d->type;
$name[]             = $json_array;
}
echo json_encode($name);
}

	public function autocomplete_itemcode()
	{
		$itemcode=$this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('hsnno',$itemcode);
		$this->db->where('status',1);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) 
		{
			$json_array             = array();
			$json_array['value']    = $d->hsnno;
			$json_array['label']    = $d->hsnno;
			$name[]             = $json_array;
		}
		echo json_encode($name);	
	}

	public function get_itemname()
	{
		$itemname=$this->input->post('itemname');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->where('itemname',$itemname);
		$query=$this->db->get();
		$result=$query->result_array();
		if($result)
		{
			foreach ($result as $row) {
				$vob['hsnno']=$row['hsnno'];
			}
			echo json_encode($vob);
		}
	}

	public function get_itemcode()
	{
		$itemcode=$this->input->post('itemcode');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->where('hsnno',$itemcode);
		$query=$this->db->get();
		$result=$query->result_array();
		if($result)
		{
			foreach ($result as $row) {
				$vob['itemname']=$row['itemname'];
				$vob['hsnno']=$row['hsnno'];
			}
			echo json_encode($vob);
		}
	}

	public function update()
	{
		$id=$_POST['id'];
		$item=$this->db->where('itemname',$_POST['itemname'])->get('inwardstock')->result();
		foreach($item as $i)
		{
			$qty=$i->quantity;
			$oldqty=$i->oldqty;
			$currentstock=$i->currentstock;
			$id=$i->id;
		}
		$updateqty=$_POST['quantity']+$qty;
		$total=$currentstock+$_POST['quantity'];
		$data=array('date'=>date('Y-m-d'),
					'itemname'=>$_POST['itemname'],
					'quantity'=>$_POST['quantity'],
					'balance'=>$updateqty,
					'updatestock'=>$_POST['quantity'],
					'currentstock'=>$total,		
					'oldqty'=>$currentstock,		
					'status'=>1
					);

		$result=$this->inwardstock_model->header($data,$id);
		if($result==true)
		{
			$this->session->set_flashdata('msg','Stock Update Successfully !');
			redirect('inwardstock');
		}
		else
		{
			$this->session->set_flashdata('msg1','No changes  !');
			redirect('inwardstock');
		}
	}



	public function delete()
	{
		$del=$this->input->post('id');
		$data=$this->db->where('id',$del)->delete('inwardstock');
		if($data)
		{
			$this->session->set_flashdata('msg','Stock  Deleted Successfully!');
			redirect('inwardstock');
		}
		else
		{
			$this->session->set_flashdata('msg1','Stock  Deleted Unsuccessfully');
			redirect('inwardstock');
		}
	}


	public function autocomplete_partname()
	{
		$itemname=$this->input->post('keyword');
		//$cusname='ram';
		$this->db->select('*');
		$this->db->from('inwardstockview');
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


	public function get_item()
	{
		$item=$this->input->post('itemname');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->where('itemname',$item);
		$query=$this->db->get();
		$result=$query->result();
		$count=count($result);
		if($count==1)
		{
			echo'1';
		}
		else
		{
			echo'0';
		}
	}


	public function ajax_list()
	{
		$list = $this->inwardstock_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i=1;
		foreach ($list as $person) 
		{
			//if($person->balanceqty > 0 )
			//{
				$no++;
				$row = array();
				$row[] = $i++;
				$row[] = date('d-m-Y',strtotime($person->inwarddate));
			//  $row[] = $person->itemcode;
			//	$row[] = $person->hsnno;
				$row[] = $person->cusname;
				$row[] = $person->itemname;
			//	$row[] = $person->rate;
			//	$row[] = $person->sgst;
			//	$row[] = $person->cgst;
			//	$row[] = $person->igst;
				$row[] = $person->lastupdatedqty;
				$row[] = $person->balanceqty;
				$code=base64_encode($person->id);
				$data[] = $row;
			//	}
		}

		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $this->inwardstock_model->count_all(),
		"recordsFiltered" => $this->inwardstock_model->count_filtered(),
		"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_delete($id)
	{
		$this->inwardstock_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	Public function download()
	{
		// date_default_timezone_set('Asia/calcutta');

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Item List');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Item Details');
		$this->excel->getActiveSheet()->setCellValue('A2', 'HSN No');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Item Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Qty');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Rate');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Stock Value');

		//merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:E1');
		//set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

		for($col = ord('A'); $col <= ord('E'); $col++){
		//set column dimension
		$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
		//change the font size
		$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

		$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
		//retrive contries table data
		$sql = "SELECT hsnno,itemname,quantity from inwardstock ";        
		$rs = $this->db->query($sql);
		//$rs = $this->db->get('countries');
		$exceldata="";
		foreach ($rs->result_array() as $row)
		{
			$data['hsnno']=$row['hsnno'];
			$data['itemname']=$row['itemname'];
			$data['qty']=$row['quantity'];
			$data['rate']='';
			$data['stock']='';
			$exceldata[] = $data;
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
		$filename='Itemlist-'.date('d/m/y').'.xls'; //save our workbook as this file name
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

ob_flush();
?>

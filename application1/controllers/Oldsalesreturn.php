<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Oldsalesreturn extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('salesreturn_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		$this->load->model('oldsalesreturn_model');
		date_default_timezone_set('Asia/Kolkata');
	}
	 
	

	public function views()
	{
		$id=$this->uri->segment(3);
		$data['result']=$this->db->where('id',$id)->get('sales_return_backup')->result_array(); 
		$this->load->view('header');
		$this->load->view('oldview_salesreturn',$data);
		$this->load->view('footer');
	}
	//DEBIT OR CREDIT NOTE REPORTS
	Public function view()
	{
		$data['view']=$this->oldsalesreturn_model->select();
		$this->load->view('header');
		$this->load->view('oldsalesreturn_reports',$data);
		$this->load->view('footer1');
	}

	public function ajax_list()
	{
		$list = $this->oldsalesreturn_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$a=1;
		$totalamount[]=array();
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $a++;
			$row[] = date('d-m-Y',strtotime($person->date));
			$row[] = $person->types;
			if($person->types=='Credit')
			{
				$row[] = $person->purchaseno;
			}
			else
			{
				$row[] =$person->invoiceno;
			}
			
			$row[] =$person->returnno;
			if($person->types=='Credit')
			{
				$row[] = $person->suppliername;
			}
			else
			{
				$row[] =$person->customername;
			}
			$row[] =$person->grandtotal;
			$row[] = '<a class="btn btn-sm btn-primary" href="'.base_url('oldsalesreturn/views/'.$person->id).'" title="View" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>&nbsp;<a class="btn btn-sm btn-primary" href="'.base_url('oldsalesreturn/bill_download/'.$person->id).'" title="View" target="_blank" ><i class="glyphicon glyphicon-download"></i>&nbsp;Print </a>';
			$data[] = $row;
		}

		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $this->oldsalesreturn_model->count_all(),
		"recordsFiltered" => $this->oldsalesreturn_model->count_filtered(),
		"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	Public function getinvoiceno()
	{
		$cusname=$this->input->post('cusname');
		$data=$this->db->where('status',1)->where('customername',$cusname)->get('invoice_details')->result_array(); 
		$count=count($data);
		if($count>0)
		{
			foreach ($data as $r)
			{
				$returnsta=$r['return_status'];
			}
			$return_count=explode('||',$returnsta);
			$resu=array_sum($return_count);
			if($resu==0)
			{

			}
			else
			{
				foreach ($data as $c)
				{
					$f['value']=$c['invoiceno'];
					$f['label']=$c['invoiceno']; 
					$v[]=$f;        
				}
			}
			echo json_encode($v);
		}   
	}

	Public function getpurchaseno()
	{
		$cusname=$this->input->post('suppliername');
		$data=$this->db->where('status',1)->where('suppliername',$cusname)->get('purchase_details')->result_array(); 
		$count=count($data);
		if($count>0)
		{
			foreach ($data as $r)
			{
				$returnsta=$r['return_status'];
			}
			$return_count=explode('||',$returnsta);
			$resu=array_sum($return_count);
			if($resu==0)
			{

			}
			else
			{
				foreach ($data as $c)
				{
					$f['value']=$c['purchaseno'];
					$f['label']=$c['purchaseno']; 
					$v[]=$f;        
				}
			} 
			echo json_encode($v);
		}   
	}

	public function getdetails()
	{
		$invoiceno=$this->input->post('invoiceno');
		$this->db->select('*');
		$this->db->from('invoice_details');
		$this->db->where('status',1);
		$this->db->where('invoiceno',$invoiceno);
		// $this->db->where('return_status',1);
		$query = $this->db->get();
		$data= $query->result_array();
		foreach ($data as $ue) 
		{
		$html=' <div class="table-responsive">
		<table class="responsive table">
		<thead> 
		<tr>
		<th>HSN Code</th>
		<th>Item Name</th>
		<th>Qty</th>
		<th>UOM</th>
		<th>Rate</th>
		<th>Amount</th>
		<th>Disc %</th>
		<th>&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
		<th class="sgst">&nbsp;&nbsp;&nbsp;CGST</th>
		<th class="sgst">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
		<th class="sgst">&nbsp;&nbsp;&nbsp;SGST</th>
		<th class="sgst">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
		<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
		<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
		<th>Total</th>
		</tr>  
		</thead>
		<tbody>';
		$hsnno=explode('||', $ue['hsnno']);
		$itemname=explode('||', $ue['itemname']);
		$rate=explode('||', $ue['rate']);
		$qty=explode('||', $ue['qty']);
		$amount=explode('||', $ue['amount']);
		$discount=explode('||', $ue['discount']); 
		$discountamount=explode('||', $ue['discountamount']); 
		$taxableamount=explode('||', $ue['taxableamount']);   
		$sgst=explode('||', $ue['sgst']); 
		$cgst=explode('||', $ue['cgst']); 
		$igst=explode('||', $ue['igst']); 
		$sgstamount=explode('||', $ue['sgstamount']); 
		$cgstamount=explode('||', $ue['cgstamount']); 
		$igstamount=explode('||', $ue['igstamount']); 
		$uom=explode('||', $ue['uom']); 
		$total=explode('||', $ue['total']); 
		$returnstatus=explode('||', $ue['return_status']); 
		/* START */
		$freightamount=$ue['freightamount'];
		$freightcgst=$ue['freightcgst'];
		$freightcgstamount=$ue['freightcgstamount'];
		$freightsgst=$ue['freightsgst'];
		$freightsgstamount=$ue['freightsgstamount'];
		$freightigst=$ue['freightigst']; 
		$freightigstamount=$ue['freightigstamount']; 
		$freighttotal=$ue['freighttotal'];   
		$loadingamount=$ue['loadingamount']; 
		$loadingcgst=$ue['loadingcgst']; 
		$loadingcgstamount=$ue['loadingcgstamount']; 
		$loadingsgst=$ue['loadingsgst']; 
		$loadingsgstamount=$ue['loadingsgstamount'];   
		$loadingigst=$ue['loadingigst']; 
		$loadingigstamount=$ue['loadingigstamount']; 
		$loadingtotal=$ue['loadingtotal']; 
		/* END */
		$count=count($itemname);
		for($i=0; $i< $count; $i++){
			if($returnstatus[$i]==0)
			{
				$hide="style='display:none'";
			}
			else
			{
				$hide='';
			}
			$this->db->select('*');
			$this->db->from('additem');
			$this->db->where('itemname',$itemname[$i]);
			$item_query = $this->db->get();
			$item_result = $item_query->row();
			
		//if($ue['gsttype']=='intrastate') { $cgst } else { }
		$html.='<tr '.$hide.'>
		<td><input type="hidden" id="hiddenIgst'.$i.'" value="'.$item_result->igst.'" /><input class="" id="hsnno'.$i.'"  readonly style="border:1px solid #605f5f;" type="text" name="hsnno[]" value="'.$hsnno[$i].'" ><div id="hsnno_valid"></div></td>
		<td><input class="" id="itemname'.$i.'" style="border:1px solid #605f5f;" type="text" name="itemname[]" readonly value="'.$itemname[$i].'" >
		<div id="itemname_valid"></div>
		<input type="hidden" id="priceType'.$i.'" name="priceType[]" value="'.$item_result->priceType.'" />
		</td>
		<td><input class="" id="qty'.$i.'"   parsley-trigger="change"  type="text" name="qty[]"   onkeypress="return isNumberKey(event)" autocomplete="off" style="border:1px solid #605f5f;"><input type="hidden" id="qtys'.$i.'" value="'.$qty[$i].'"><div id="qty_valid" style="color:green">Purchase Qty : '.$qty[$i].'</div></td>  

		<td><input class="" id="uom'.$i.'"  readonly  style="border:1px solid #605f5f;" type="text" name="uom[]" value="'.$uom[$i].'"  autocomplete="off"><div id="rate_valid"></div></td>

		<td><input class=" decimals"  readonly id="rate'.$i.'"  style="border:1px solid #605f5f;" value="'.$rate[$i].'" type="text" name="rate[]"   autocomplete="off"><div id="rate_valid"></div></td>

		<td><input class="decimals" id="amount'.$i.'"  readonly style="border:1px solid #605f5f;" type="text" name="amount[]" value="'.$amount[$i].'"  autocomplete="off"><div id="rate_valid"></div></td>

		<td><input class="decimals" id="discount'.$i.'"  style="border:1px solid #605f5f;" type="text" name="discount[]" readonly value="'.$discount[$i].'" onkeypress="return isNumber(event)" autocomplete="off"><div id="rate_valid"></div></td>

		<td><input class="decimals" id="taxableamount'.$i.'" readonly style="border:1px solid #605f5f;" type="text" name="taxableamount[]" value="'.$taxableamount[$i].'"  autocomplete="off"><input type="hidden" value="'.$discountamount[$i].'" name="discountamount[]" id="discountamount'.$i.'"><div id="rate_valid"></div></td>

		<td class="sgst"><input class="decimals" readonly id="cgst'.$i.'"  type="text" value="'.$cgst[$i].'" name="cgst[]" value="'.$cgst[$i].'" style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="cgst_valid"></div></td>

		<td class="sgst"><input class="decimals" readonly id="cgstamount'.$i.'"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$cgstamount[$i].'"></td>

		<td class="sgst"><input class="decimals" id="sgst'.$i.'" readonly  type="text" value="'.$sgst[$i].'" name="sgst[]" style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid"></div></td>

		<td class="sgst"><input class="decimals" id="sgstamount'.$i.'"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$sgstamount[$i].'"></td>

		<td class="igst" style="display:none;"><input class="decimals" value="'.$igst[$i].'" id="igst'.$i.'"  type="text" name="igst[]" readonly  style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid"></div></td>

		<td class="igst" style="display:none;"><input class="decimals" id="igstamount'.$i.'"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$igstamount[$i].'"></td>

		<td><input class="" id="total'.$i.'" type="text" name="total[]" value="'.$total[$i].'"  readonly style="border:1px solid #605f5f;"></td>

		</tr>';
		}

		$html.='</tbody>
		</table>
		</div>
		<div class="clearfix">&nbsp;</div>
		<div class="row">
			<table class="table myform">
				<tr>
					<td>Freight Charges</td>
					
					<td><input class="decimals" id="freightamount" parsley-trigger="change"  placeholder="Amount" style="" type="text" name="freightamount" value="'.$freightamount.'" readonly  autocomplete="off"></td>
					
					<td class="sgst"><input class="decimals"  id="freightcgst"  type="text" name="freightcgst" placeholder="CGST"  value="'.$freightcgst.'" readonly  style=""   autocomplete="off" ></td>
					
					<td class="sgst"><input class="decimals" readonly id="freightcgstamount" placeholder="CGST Amount"  type="text" name="freightcgstamount"   autocomplete="off" value="'.$freightcgstamount.'" readonly ></td>
					
					<td class="sgst"><input class="decimals" id="freightsgst" placeholder="SGST"  type="text" name="freightsgst" value="'.$freightsgst.'" readonly    autocomplete="off" ><div id="sgst_valid"></div></td>
					
					<td class="sgst"><input class="decimals" id="freightsgstamount"  type="text" name="freightsgstamount" placeholder="SGST Amount" readonly  autocomplete="off" value="'.$freightsgstamount.'" readonly ></td>
					
					<td class="igst" style="display:none;"><input class="decimals" id="freightigst"  type="text" name="freightigst"  placeholder="IGST"  style=""   autocomplete="off" value="'.$freightigst.'" readonly ><div id="igst_valid"></div></td>
					
					<td class="igst" style="display:none;"><input class="decimals" id="freightigstamount"  type="text" name="freightigstamount"  placeholder="IGST Amount"  autocomplete="off" value="'.$freightigstamount.'" readonly ></td>
					
					<td><input class="" id="freighttotal" placeholder="Total" type="text" name="freighttotal" value="'.$freighttotal.'" readonly ></td>
				</tr>

				<tr>
					<td>Loading & Packing Charges</td>
					
					<td><input class="decimals" id="loadingamount" parsley-trigger="change" placeholder="Amount"  style="" type="text" name="loadingamount" value="'.$loadingamount.'" readonly  autocomplete="off"><div id="rate_valid"></div></td>
					
					<td class="sgst"><input class="decimals"  id="loadingcgst"  type="text" name="loadingcgst" placeholder="CGST" value="'.$loadingcgst.'" readonly  autocomplete="off" ><div id="cgst_valid"></div></td>
					
					<td class="sgst"><input class="decimals" readonly id="loadingcgstamount"  type="text" name="loadingcgstamount"   placeholder="CGST Amount" autocomplete="off" value="'.$loadingcgstamount.'" readonly></td>
					
					<td class="sgst"><input class="decimals" id="loadingsgst" placeholder="SGST"  type="text" name="loadingsgst" value="'.$loadingsgst.'" readonly  style=""   autocomplete="off" ><div id="sgst_valid"></div></td>
					
					<td class="sgst"><input class="decimals" id="loadingsgstamount"  type="text" name="loadingsgstamount" readonly  placeholder="SGST Amount" autocomplete="off" readonly value="'.$loadingsgstamount.'" readonly ></td>
					
					<td class="igst" style="display:none;"><input class="decimals" id="loadingigst"  type="text" name="loadingigst" placeholder="IGST"   style=""   autocomplete="off" value="'.$loadingigst.'" readonly ><div id="igst_valid"></div></td>
					
					<td class="igst" style="display:none;"><input class="decimals" id="loadingigstamount" placeholder="IGST Amount" type="text" name="loadingigstamount"    autocomplete="off" value="'.$loadingigstamount.'" readonly ></td>
						
					<td><input class="" id="loadingtotal" type="text" placeholder="Total" name="loadingtotal" value="'.$loadingtotal.'" readonly ></td>
				</tr>
			</table>
		</div>
		<div class="col-md-12">

		<br>
		<br>

		<div class="col-sm-offset-5">
		<label class="col-sm-5  control-label" >Sub Total</label>
		<div class="col-sm-7">
		<input class="form-control"  type="text" name="subtotal" id="subtotal" readonly  placeholder="0" value="'.$ue['subtotal'].'">
		</div>
		</div>
		<br>
		<br>    

		<div class="col-sm-offset-5">
		<label class="col-sm-5  control-label" >Round Off</label>
		<div class="col-sm-7">
		<input class="form-control"  type="text" name="othercharges" id="othercharges" readonly  placeholder="0" value="'.$ue['othercharges'].'">
		</div>
		</div>
		<br>
		<br>  

		<div class=" col-sm-offset-5">
		<label class="col-sm-5  control-label" >Grand Total</label>
		<div class="col-sm-7">
		<input class="form-control" readonly type="text" value="'.$ue['grandtotal'].'" name="grandtotal" id="grandtotal" >

		<input class="form-control" readonly type="hidden" value="'.$ue['gsttype'].'" name="gsttypes" id="gsttypes" >


		</div>                      
		</div>
		<br>
		<br>
		</div> 
		</div></div>';

		}
		for($i=0;$i<$count;$i++)
		{
		$html.='
		<script>
			var gsttype=$("#gsttypes").val();
			if(gsttype=="interstate")
			{
				$(".sgst").hide();
				$(".igst").show();
			}
			else  if(gsttype=="intrastate")
			{
				$(".sgst").show();
				$(".igst").hide();
			}

			$("#qty'.$i.'").keyup(function(){
				var qty=$("#qty'.$i.'").val();
				var rate=$("#rate'.$i.'").val();
				var qtys=$("#qtys'.$i.'").val();
				var gsttype=$("#gsttypes").val();
				if(parseFloat(qty) > parseFloat(qtys))
				{
					alert("Your Required Qty is : "+qtys+"");
					$("#qty'.$i.'").val("");
					$("#qty'.$i.'").focus("");
				}

				if(qty)
				{
					var amo=parseFloat(rate)*parseFloat(qty);
					var amou=amo.toFixed(2);
					var discount=$("#discount'.$i.'").val();
					var cgst=$("#cgst'.$i.'").val();
					var sgst=$("#sgst'.$i.'").val();
					var igst=$("#igst'.$i.'").val(); 
					var taxableamount=$("#taxableamount'.$i.'").val(); 
					var gsttype=$("#gsttype").val(); 
					var othercharges=$("#othercharges").val();
					var a=0;
					var b=0; 
					var c=0;
					var d=0;
					var e=0;
					var f=0;
					var g=0;
					var h=0;
					var i=0;
					var j=0;
					taxableamount = amou;
						
					var priceType = $("#priceType'.$i.'").val();
					var hiddenIgst = $("#hiddenIgst'.$i.'").val();
					if(priceType=="Inclusive")
					{
						var taxableamount=0;
						var discountamount=0;
						var total="'.$i.'";
						taxableamount = amou;
						if(discount > 0)
						{
							a=(parseFloat(amo)-parseFloat(discount));
							var discountamount=a.toFixed(2);
							var a2=parseFloat(amo)-parseFloat(discount);
							taxableamount=a2.toFixed(2);
						}
						k = taxableamount;
						$("#discountamount'.$i.'").val(discountamount);
						$("#taxableamount'.$i.'").val(taxableamount);
						if(gsttype=="intrastate")
						{
							if(cgst > 0)
							{
								var divideBy = parseFloat(hiddenIgst)+100;
								b=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
								var b1=b.toFixed(2);
								$("#cgstamount'.$i.'").val(b1);
								var b2=parseFloat(k)-parseFloat(b);
								var b3=b2.toFixed(2);
								$("#amount'.$i.'").val(b3);
								var totalVal = (parseFloat(b3)+parseFloat(b)).toFixed(2);
								$("#total'.$i.'").val(totalVal);
							}

							if(sgst > 0)
							{
								var divideBy = parseFloat(hiddenIgst)+100;
								c=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
								var c1=c.toFixed(2);
								$("#sgstamount'.$i.'").val(c1);
								var c2=parseFloat(k)-(parseFloat(b)+parseFloat(c));
								var c3=c2.toFixed(2);
								$("#amount'.$i.'").val(c3);
								var totalVal = (parseFloat(c3)+(parseFloat(b)+parseFloat(c))).toFixed(2);
								$("#total'.$i.'").val(totalVal);
							}
						}
						else  if(gsttype=="interstate")
						{
							if(igst > 0)
							{
								var divideBy = parseFloat(hiddenIgst)+100;
								d=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy);
								var d1=d.toFixed(2);
								$("#igstamount'.$i.'").val(d1);
								var d2=parseFloat(k)-parseFloat(d);
								var d3=d2.toFixed(2);
								$("#amount'.$i.'").val(d3);
								var totalVal = (parseFloat(d3)+parseFloat(d)).toFixed(2);
								$("#total'.$i.'").val(totalVal);
							}
						}
					}
					else
					{
						var k=taxableamount;
						$("#amount'.$i.'").val(amou);
						$("#taxableamount'.$i.'").val(amou);
						$("#total'.$i.'").val(amou);
						
						

						if(discount > 0)
						{
							a=((parseFloat(amo)*parseFloat(discount))/100);
							var a1=a.toFixed(2);
							var a2=parseFloat(amo)-parseFloat(a1);
							var a3=a2.toFixed(2);
							k=a3;
							$("#discountamount'.$i.'").val(a1);
							$("#taxableamount'.$i.'").val(a3);
							$("#total'.$i.'").val(a3);
						}

						if(gsttype=="intrastate")
						{
							if(cgst > 0)
							{
								b=((parseFloat(k)*parseFloat(cgst))/100);
								var b1=b.toFixed(2);
								$("#cgstamount'.$i.'").val(b1);
								var b2=parseFloat(k)+parseFloat(b);
								var b3=b2.toFixed(2);
								$("#total'.$i.'").val(b3);
							}
							if(sgst > 0)
							{
								c=((parseFloat(k)*parseFloat(sgst))/100);
								var c1=c.toFixed(2);
								$("#sgstamount'.$i.'").val(c1);
								var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
								var c3=c2.toFixed(2);
								$("#total'.$i.'").val(c3);
							}
						}
						else  if(gsttype=="interstate")
						{
							if(igst > 0)
							{
								d=((parseFloat(k)*parseFloat(igst))/100);
								var d1=d.toFixed(2);
								$("#igstamount'.$i.'").val(d1);
								var d2=parseFloat(k)+parseFloat(d);
								var d3=d2.toFixed(2);
								$("#total'.$i.'").val(d3);
							}
						}
					}
					var othercharges=$("#othercharges").val();
					var sub_tot=0;
					sub_tot +=Number($("#freighttotal").val());
					sub_tot +=Number($("#loadingtotal").val());  
					$("input[name^=total]").each(function(){
						sub_tot +=Number($(this).val()); 
						var fina=sub_tot.toFixed(2);         
						$("#subtotal").val(fina);
						$("#grandtotal").val(fina); 
					});

					if(othercharges)
					{
						l=parseFloat(sub_tot)+parseFloat(othercharges);
						var l1=l.toFixed(2);
						$("#grandtotal").val(l1);
					}
				}
			});
		</script>';





		}


		echo $html;
	}

	
	public function getpodetails()
	{
		$invoiceno=$this->input->post('purchaseno');
		$this->db->select('*');
		$this->db->from('purchase_details');
		$this->db->where('status',1);
		$this->db->where('purchaseno',$invoiceno);
		// $this->db->where('return_status',1);
		$query = $this->db->get();
		$data= $query->result_array();
		foreach ($data as $ue) 
		{
			$html=' 
			<div class="table-responsive">
				<table class="responsive table">
					<thead> 
						<tr>
							<th>HSN Code</th>
							<th>Item Name</th>
							<th>Qty</th>
							<th>UOM</th>
							<th>Rate</th>
							<th>Total</th>
							<th>Disc </th>
							<th>&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
							<th class="sgst">&nbsp;&nbsp;&nbsp;CGST</th>
							<th class="sgst">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
							<th class="sgst">&nbsp;&nbsp;&nbsp;SGST</th>
							<th class="sgst">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
							<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
							<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
							<th>Total</th>
						</tr>  
					</thead>
					<tbody>';
			$hsnno=explode('||', $ue['hsnno']);
			$itemname=explode('||', $ue['itemname']);
			$rate=explode('||', $ue['rate']);
			$qty=explode('||', $ue['qty']);
			$amount=explode('||', $ue['amount']);
			$discount=explode('||', $ue['discount']); 
			$discountamount=explode('||', $ue['discountamount']); 
			$taxableamount=explode('||', $ue['taxableamount']);   
			$sgst=explode('||', $ue['sgst']); 
			$cgst=explode('||', $ue['cgst']); 
			$igst=explode('||', $ue['igst']); 
			$sgstamount=explode('||', $ue['sgstamount']); 
			$cgstamount=explode('||', $ue['cgstamount']); 
			$igstamount=explode('||', $ue['igstamount']); 
			$uom=explode('||', $ue['uom']); 
			$total=explode('||', $ue['total']); 
			$returnstatus=explode('||', $ue['return_status']); 
			$count=count($itemname);
			for($i=0; $i< $count; $i++){
			if($returnstatus[$i]==0)
			{
				$hide="style='display:none'";
			}
			else
			{
				$hide='';
			}
			
			$this->db->select('*');
			$this->db->from('additem');
			$this->db->where('itemname',$itemname[$i]);
			$item_query = $this->db->get();
			$item_result = $item_query->row();
			
			//FRIEGHT CHARGES
			if($ue['gsttype']=='intrastate') 
			{
				$cgstHidStatus='';
				$igstHidStatus='style="display:none;"';
			} 
			else 
			{
				$cgstHidStatus='style="display:none;"';
				$igstHidStatus='';
			}
			//END OF FRIEGHT CHARGES
			$html.='
					<tr '.$hide.'>
						<td><input type="hidden" id="hiddenIgst'.$i.'" value="'.$item_result->igst.'" /><input class="" id="hsnno'.$i.'"  readonly style="width:70px;border:1px solid #605f5f;" type="text" name="hsnno[]" value="'.$hsnno[$i].'" ></td>

						<td><input class="" id="itemname'.$i.'" style="border:1px solid #605f5f;" type="text" name="itemname[]" readonly value="'.$itemname[$i].'" ><input type="hidden" id="priceType'.$i.'" name="priceType[]" value="'.$item_result->priceType.'" /></td>

						<td><input class="" id="qty'.$i.'"   parsley-trigger="change" required  type="text" name="qty[]"   onkeypress="return isNumberKey(event)" autocomplete="off" style="border:1px solid #605f5f;"><input type="hidden" id="qtys'.$i.'" value="'.$qty[$i].'"><div id="qty_valid" style="color:green">Purchase Qty : '.$qty[$i].'</div></td>  

						<td><input class="" id="uom'.$i.'"  readonly  style="border:1px solid #605f5f;" type="text" name="uom[]" value="'.$uom[$i].'"  autocomplete="off"></td>

						<td><input class=" decimals"  readonly id="rate'.$i.'"  style="border:1px solid #605f5f;" value="'.$rate[$i].'" type="text" name="rate[]"   autocomplete="off"></td>

						<td><input class="decimals" id="amount'.$i.'"  readonly style="border:1px solid #605f5f;" type="text" name="amount[]" value="0"  autocomplete="off"></td>

						<td><input class="decimals" id="discount'.$i.'"  style="border:1px solid #605f5f;" type="text" name="discount[]" readonly value="'.$discount[$i].'" onkeypress="return isNumber(event)" autocomplete="off"></td>

						<td><input class="decimals" id="taxableamount'.$i.'" readonly style="border:1px solid #605f5f;" type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" value="0" name="discountamount[]" id="discountamount'.$i.'"></td>

						<td class="sgst"><input class="decimals" readonly id="cgst'.$i.'"  type="text" value="'.$cgst[$i].'" name="cgst[]" value="" style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ></td>

						<td class="sgst"><input class="decimals" readonly id="cgstamount'.$i.'"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" style="border:1px solid #605f5f;" value=""></td>

						<td class="sgst"><input class="decimals" id="sgst'.$i.'" readonly  type="text" value="'.$sgst[$i].'" name="sgst[]" value="" style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ></td>

						<td class="sgst"><input class="decimals" id="sgstamount'.$i.'"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="border:1px solid #605f5f;" value=""></td>

						<td class="igst" style="display:none;"><input class="decimals" value="'.$igst[$i].'" id="igst'.$i.'"  type="text" name="igst[]" readonly  style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ></td>

						<td class="igst" style="display:none;"><input class="decimals" id="igstamount'.$i.'"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="border:1px solid #605f5f;" value=""></td>

						<td><input class="" id="total'.$i.'" type="text" name="total[]" value=""  readonly style="border:1px solid #605f5f;"></td>
					</tr>';
			}

			$html.='
				</tbody>
			</table>
			</div>
			<div class="row">&nbsp;</div>
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>Charges</th>
						<th>Amount</th>
						<th '.$cgstHidStatus.'>CGST</th>
						<th '.$cgstHidStatus.'>CGST Amount</th>
						<th '.$cgstHidStatus.'>SGST</th>
						<th '.$cgstHidStatus.'>SGST Amount</th>
						<th '.$igstHidStatus.'>IGST</th>
						<th '.$igstHidStatus.'>IGST Amount</th>
						<th>Total</th>
					</tr>
					<tr>
						<td>Freight Charges</td>
						<td><input readonly class="decimals" id="freightamount" parsley-trigger="change"  placeholder="Amount" style="border:1px solid #605f5f;" type="text" name="freightamount" value="'.$ue['freightamount'].'"  autocomplete="off"></td>
						<td '.$cgstHidStatus.'><input class="decimals"  readonly id="freightcgst"  type="text" name="freightcgst" placeholder="CGST"  value="'.$ue['freightcgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td '.$cgstHidStatus.'><input class="decimals" readonly id="freightcgstamount" placeholder="CGST Amount"  type="text" name="freightcgstamount"   autocomplete="off"  style="border:1px solid #605f5f;" value="'.$ue['freightcgstamount'].'"></td>
						<td '.$cgstHidStatus.'><input class="decimals" id="freightsgst" placeholder="SGST"  type="text" name="freightsgst" readonly value="'
						.$ue['freightsgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td '.$cgstHidStatus.'><input class="decimals" id="freightsgstamount"  type="text" name="freightsgstamount" placeholder="SGST Amount" readonly  autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['freightsgstamount'].'"></td>
						<td '.$igstHidStatus.'><input readonly class="decimals" id="freightigst"  type="text" name="freightigst"  placeholder="IGST" value="'.$ue['freightigst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td '.$igstHidStatus.'><input class="decimals" id="freightigstamount"  type="text" name="freightigstamount"  placeholder="IGST Amount"  autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['freightigstamount'].'"></td>
						<td><input class="" id="freighttotal" placeholder="Total" type="text" name="freighttotal" value="'.$ue['freighttotal'].'"  readonly style="border:1px solid #605f5f;"></td>
						
					</tr>
					<tr>
						<td>Loading & Packing Charges</td>
						<td><input readonly class="decimals" id="loadingamount" parsley-trigger="change" placeholder="Amount"  style="border:1px solid #605f5f;" type="text" name="loadingamount" value="'.$ue['loadingamount'].'"  autocomplete="off"></td>
						<td '.$cgstHidStatus.'><input readonly class="decimals"  id="loadingcgst"  type="text" name="loadingcgst" placeholder="CGST" value="'.$ue['loadingcgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td '.$cgstHidStatus.'><input class="decimals" readonly id="loadingcgstamount"  type="text" name="loadingcgstamount"   placeholder="CGST Amount" autocomplete="off"  style="border:1px solid #605f5f;" value="'.$ue['loadingcgstamount'].'"></td>
						<td  '.$cgstHidStatus.'><input  class="decimals" id="loadingsgst" placeholder="SGST"  type="text" name="loadingsgst" readonly value="'.$ue['loadingsgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td  '.$cgstHidStatus.'><input class="decimals" id="loadingsgstamount"  type="text" name="loadingsgstamount"   placeholder="SGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['loadingsgstamount'].'"></td>
						<td  '.$igstHidStatus.'><input readonly class="decimals" id="loadingigst"  type="text" name="loadingigst" placeholder="IGST" value="'.$ue['loadingigst'].'"  style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td  '.$igstHidStatus.'><input class="decimals" id="loadingigstamount" placeholder="IGST Amount" type="text" name="loadingigstamount"    autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['loadingigstamount'].'"></td>
						<td><input class="" id="loadingtotal" type="text" placeholder="Total" name="loadingtotal" value="'.$ue['loadingtotal'].'"  readonly style="border:1px solid #605f5f;"></td>
					</tr>
					
				</table>
			</div>
			<div class="col-md-12">
			<div class="col-sm-offset-5">
			<label class="col-sm-5  control-label" >Sub Total</label>
			<div class="col-sm-7">
			<input class="form-control"  type="text" name="subtotal" id="subtotal" readonly  placeholder="0" value="'.$ue['subtotal'].'">
			</div>
			</div>
			<br>
			<br>    

			<div class="col-sm-offset-5">
			<label class="col-sm-5  control-label" >Round Off</label>
			<div class="col-sm-7">
			<input class="form-control"  type="text" name="othercharges" id="othercharges" readonly  placeholder="0" value="'.$ue['othercharges'].'">
			</div>
			</div>
			<br>
			<br>  

			<div class=" col-sm-offset-5">
			<label class="col-sm-5  control-label" >Grand Total</label>
			<div class="col-sm-7">
			<input class="form-control" readonly type="text" value="'.$ue['grandtotal'].'" name="grandtotal" id="grandtotal" >
			<input class="form-control" readonly type="hidden" value="'.$ue['gsttype'].'" name="gsttypes" id="gsttypes" >


			</div>                      
			</div>
			<br>
			<br>
			</div> 
			</div></div>';

		}
		for($i=0;$i<$count;$i++)
		{
			$html.='
				<script>
				var gsttype=$("#gsttypes").val();
				if(gsttype=="interstate")
				{
					$(".sgst").hide();
					$(".igst").show();
				}
				else  if(gsttype=="intrastate")
				{
					$(".sgst").show();
					$(".igst").hide();
				}

				$("#qty'.$i.'").keyup(function(){
					var qty=$("#qty'.$i.'").val();
					var rate=$("#rate'.$i.'").val();
					var qtys=$("#qtys'.$i.'").val();
					var gsttype=$("#gsttypes").val();
					if(parseFloat(qty) > parseFloat(qtys))
					{
						alert("Your Required Qty is : "+qtys+"");
						$("#qty'.$i.'").val("");
						$("#qty'.$i.'").focus("");
					}

					if(qty)
					{
						var amo=parseFloat(rate)*parseFloat(qty);
						var amou=amo.toFixed(2);
						var discount=$("#discount'.$i.'").val();
						var cgst=$("#cgst'.$i.'").val();
						var sgst=$("#sgst'.$i.'").val();
						var igst=$("#igst'.$i.'").val(); 
						var taxableamount=$("#taxableamount'.$i.'").val(); 
						var gsttype=$("#gsttype").val(); 
						var othercharges=$("#othercharges").val();
						var a=0;
						var b=0; 
						var c=0;
						var d=0;
						var e=0;
						var f=0;
						var g=0;
						var h=0;
						var i=0;
						var j=0;
						taxableamount = amou;
							
						var priceType = $("#priceType'.$i.'").val();
						var hiddenIgst = $("#hiddenIgst'.$i.'").val();
						if(priceType=="Inclusive")
						{
							var taxableamount=0;
							var discountamount=0;
							var total="'.$i.'";
							taxableamount = amou;
							if(discount > 0)
							{
								a=(parseFloat(amo)-parseFloat(discount));
								var discountamount=a.toFixed(2);
								var a2=parseFloat(amo)-parseFloat(discount);
								taxableamount=a2.toFixed(2);
							}
							k = taxableamount;
							$("#discountamount'.$i.'").val(discountamount);
							$("#taxableamount'.$i.'").val(taxableamount);
							if(gsttype=="intrastate")
							{
								if(cgst > 0)
								{
									var divideBy = parseFloat(hiddenIgst)+100;
									b=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
									var b1=b.toFixed(2);
									$("#cgstamount'.$i.'").val(b1);
									var b2=parseFloat(k)-parseFloat(b);
									var b3=b2.toFixed(2);
									$("#amount'.$i.'").val(b3);
									var totalVal = (parseFloat(b3)+parseFloat(b)).toFixed(2);
									$("#total'.$i.'").val(totalVal);
								}

								if(sgst > 0)
								{
									var divideBy = parseFloat(hiddenIgst)+100;
									c=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
									var c1=c.toFixed(2);
									$("#sgstamount'.$i.'").val(c1);
									var c2=parseFloat(k)-(parseFloat(b)+parseFloat(c));
									var c3=c2.toFixed(2);
									$("#amount'.$i.'").val(c3);
									var totalVal = (parseFloat(c3)+(parseFloat(b)+parseFloat(c))).toFixed(2);
									$("#total'.$i.'").val(totalVal);
								}
							}
							else  if(gsttype=="interstate")
							{
								if(igst > 0)
								{
									var divideBy = parseFloat(hiddenIgst)+100;
									d=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy);
									var d1=d.toFixed(2);
									$("#igstamount'.$i.'").val(d1);
									var d2=parseFloat(k)-parseFloat(d);
									var d3=d2.toFixed(2);
									$("#amount'.$i.'").val(d3);
									var totalVal = (parseFloat(d3)+parseFloat(d)).toFixed(2);
									$("#total'.$i.'").val(totalVal);
								}
							}
						}
						else
						{
							var k=taxableamount;
							$("#amount'.$i.'").val(amou);
							$("#taxableamount'.$i.'").val(amou);
							$("#total'.$i.'").val(amou);
							
							

							if(discount > 0)
							{
								a=((parseFloat(amo)*parseFloat(discount))/100);
								var a1=a.toFixed(2);
								var a2=parseFloat(amo)-parseFloat(a1);
								var a3=a2.toFixed(2);
								k=a3;
								$("#discountamount'.$i.'").val(a1);
								$("#taxableamount'.$i.'").val(a3);
								$("#total'.$i.'").val(a3);
							}

							if(gsttype=="intrastate")
							{
								if(cgst > 0)
								{
									b=((parseFloat(k)*parseFloat(cgst))/100);
									var b1=b.toFixed(2);
									$("#cgstamount'.$i.'").val(b1);
									var b2=parseFloat(k)+parseFloat(b);
									var b3=b2.toFixed(2);
									$("#total'.$i.'").val(b3);
								}
								if(sgst > 0)
								{
									c=((parseFloat(k)*parseFloat(sgst))/100);
									var c1=c.toFixed(2);
									$("#sgstamount'.$i.'").val(c1);
									var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
									var c3=c2.toFixed(2);
									$("#total'.$i.'").val(c3);
								}
							}
							else  if(gsttype=="interstate")
							{
								if(igst > 0)
								{
									d=((parseFloat(k)*parseFloat(igst))/100);
									var d1=d.toFixed(2);
									$("#igstamount'.$i.'").val(d1);
									var d2=parseFloat(k)+parseFloat(d);
									var d3=d2.toFixed(2);
									$("#total'.$i.'").val(d3);
								}
							}
						}
						var othercharges=$("#othercharges").val();
						var sub_tot=0;
						sub_tot +=Number($("#freighttotal").val());
						sub_tot +=Number($("#loadingtotal").val());  
						$("input[name^=total]").each(function(){
							sub_tot +=Number($(this).val()); 
							var fina=sub_tot.toFixed(2);         
							$("#subtotal").val(fina);
							$("#grandtotal").val(fina); 
						});

						if(othercharges)
						{
							l=parseFloat(sub_tot)+parseFloat(othercharges);
							var l1=l.toFixed(2);
							$("#grandtotal").val(l1);
						}
					}
				});
				var othercharges=$("#othercharges").val();
				var sub_tot=0;
				sub_tot +=Number($("#freighttotal").val());
				sub_tot +=Number($("#loadingtotal").val());  
				$("input[name^=total]").each(function(){
					sub_tot +=Number($(this).val()); 
					var fina=sub_tot.toFixed(2);         
					$("#subtotal").val(fina);
					$("#grandtotal").val(fina); 
				});

				if(othercharges)
				{
					l=parseFloat(sub_tot)+parseFloat(othercharges);
					var l1=l.toFixed(2);
					$("#grandtotal").val(l1);
				}
				</script>
			';
		}
		echo $html;
	}


	public function search()
	{ 
		$fromdate=$this->input->post('fromdate');
		$todate=$this->input->post('todate');
		$suppliername=$this->input->post('suppliername');
		$invoiceno=$this->input->post('invoiceno');
		$data=array(
		'mac_fromdate' => $fromdate,
		'mac_todate' => $todate,
		'mac_suppliername' => $suppliername,
		'mac_invoiceno' => $invoiceno,
		'mac_bill_format' =>'Print',
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
		'mac_fromdate' => $fromdate,
		'mac_todate' => $todate,
		'mac_suppliername' => $suppliername,
		'mac_invoiceno' => $invoiceno,
		'mac_bill_format' =>'Bill_Download',
		);
		$this->session->set_userdata($data);
	}


	public function viewbilling()
	{
		$id=$this->input->post('id');
		$data=$this->db->where('id',$id)->get('addvehicle')->result_array();
		if($data)
		{
			foreach ($data as $row) {
				$html='
				<div class="row">
					<table class="table m-0">
						<thead>
							<tr>
								<th>Vehicle Name</th>
								<th>Reg No</th>
								<th>Mfg Year</th>
								<th>Starting Km</th>
								<th>Mileage</th>
								<th>Fueltype</th>
								<th>insurance</th>
							</tr>   
						</thead>
						<tbody>';
				$vehiclename=$row['vehiclename'];
				$regno=$row['regno'];
				$mfg=$row['mfgyear'];
				$startingkm=$row['startingkm'];
				$mileage=$row['mileage'];
				$fueltype=$row['fueltype'];
				$insurancetype=$row['insurancetype'];

				$html.='
							<tr>
								<td>'.$vehiclename.'</td>
								<td>'.$regno.'</td>
								<td>'.$mfg.'</td>
								<td>'.$startingkm.'</td>
								<td>'.$mileage.'</td>
								<td>'.$fueltype.'</td>
								<td>'.$insurancetype.'</td>
							</tr>';

				$html.='
						</tbody>
					</table>
				</div>
				<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
				</div>
				</div>';
			}
		}
		else
		{
			$html='';
		}
		echo $html;
	}

	Public function delete()
	{     
		echo  $this->db->where('id',$_POST['id'])->delete('inward_details');
	}

	public function gets()
	{
		$name=$_POST['name'];
		$data=$this->db->where('itemname',$name)->get('godownstock')->result();
		echo $count=count($data);
	}

	public function getss()
	{
		$name=$_POST['name'];
		$data=$this->db->where('itemcode',$name)->get('godownstock')->result();
		echo $count=count($data);
	}

	public function bill()
	{
		$data['pre']=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('sales_return_backup')->result();
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
		$this->load->view('creditbill',$data);
		//$this->load->view('invoicebill',$data);
		// $this->load->view('invoice_bill',$data);
	}

	//DEBIT OR CREDIT NOTE REPORTS PRINT
	public function bill_download()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$data['pre']=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('sales_return_backup')->result();
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
		$this->load->view('oldcreditbill',$data);
		//$this->load->view('invoicebill',$data);
		// $this->load->view('invoice_bill',$data);
	}


	public function get_returnno()
	{
		$taxtype=$this->input->post('types');
		if($taxtype=='Debit')
		{
			$this->db->where('types',$taxtype);
			$this->db->order_by('id','desc');
			$this->db->limit(1);
			$num=$this->db->get('sales_return')->result_array();
			@$cusid=$num[0]['returnno'];
			$count=count($cusid);
			if($count=='0')
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$gg = 'D'.$default_bond->debit;
				$sales_no= $gg;
				//$gg="D00001";     
				//$sales_no= $gg;
			}
			else 
			{
				$default_bond=$this->db->where('id',1)->where('debit !=','')->get('preference_settings')->row();
				if($default_bond)
				{
					@$bond_no='D'.$default_bond->debit;
					$bondLen = strlen($bond_no)-1;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$sales_no = 'D'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
				}
				else
				{
					$bondLen = strlen($cusid)-1;
					$bondOnlyNum = filter_var($cusid, FILTER_SANITIZE_NUMBER_INT);
					$sales_no = 'D'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
				}
				/*$old_user_no = str_split($cusid,2);
				@$va = (string)($old_user_no[1].$old_user_no[2].$old_user_no[3].$old_user_no[4].$old_user_no[5].$old_user_no[6])+1; 
				@$sales_length = strlen($va);
				if(@$sales_length == 1)
				{
					$sales_no = "D0000".$va;  
				}
				else if(@$sales_length == 2)
				{
					$sales_no = "D000".$va;      
				}
				else if(@$sales_length == 3)
				{   
					$sales_no = "D00".$va;   
				}
				else if(@$sales_length == 4)
				{    
					$sales_no = "D0".$va; 
				}
				else if(@$sales_length == 5)
				{    
					$sales_no = "D".$va; 
				}*/
			}
			echo $sales_no;
		}
		else if($taxtype=='Credit')
		{
			$this->db->where('types',$taxtype);
			$this->db->order_by('id','desc');
			$this->db->limit(1);
			$num=$this->db->get('sales_return')->result_array();
			@$cusid=$num[0]['returnno'];
			$count=count($cusid);
			if($count=='0')
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$gg = 'C'.$default_bond->credit;
				$sales_no= $gg;
				//$gg="C00001";     
				//$sales_no= $gg;
			}
			else 
			{
				$default_bond=$this->db->where('id',1)->where('credit !=','')->get('preference_settings')->row();
				if($default_bond)
				{
					@$bond_no='C'.$default_bond->credit;
					$bondLen = strlen($bond_no)-1;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$sales_no = 'C'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
				}
				else
				{
					$bondLen = strlen($cusid)-1;
					$bondOnlyNum = filter_var($cusid, FILTER_SANITIZE_NUMBER_INT);
					$sales_no = 'C'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
				}
				/*$old_user_no = str_split($cusid,2);
				@$va = (string)($old_user_no[1].$old_user_no[2].$old_user_no[3].$old_user_no[4].$old_user_no[5].$old_user_no[6])+1; 
				@$sales_length = strlen($va);
				if(@$sales_length == 1)
				{
					$sales_no = "C0000".$va;  
				}
				else if(@$sales_length == 2)
				{
					$sales_no = "C000".$va;      
				}
				else if(@$sales_length == 3)
				{   
					$sales_no = "C00".$va;   
				}
				else if(@$sales_length == 4)
				{    
					$sales_no = "C0".$va; 
				}
				else if(@$sales_length == 5)
				{    
					$sales_no = "C".$va; 
				}*/
			}
			echo $sales_no;
		}
	}


	public function autocomplete_customername()
	{
		$orderno=$this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('customer_details');
		$this->db->where("(type = 'Inter customer' OR type = 'Intra customer')");
		$this->db->like('name',$orderno);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d){
			$json_array             = array();
			$json_array['label']    = $d->name;
			$json_array['value']    = $d->name;
			$json_array['tinno']    = $d->tinno;
			$json_array['cstno']    = $d->cstno;
			$json_array['mobileno']    = $d->phoneno;
			$json_array['address']    = $d->address1.''.$d->address2;
			$json_array['id']    = $d->id;
			$json_array['balance']    = $d->balanceamount;
			// $json_array['advanceamount'] = $d->voucheramount;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}


	public function autocomplete_suppliername()
	{
		$orderno=$this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('customer_details');
		$this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
		// $this->db->where('type','supplier');

		$this->db->like('name',$orderno);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d){
			$json_array             = array();
			$json_array['label']    = $d->name;
			$json_array['value']    = $d->name;
			$json_array['tinno']    = $d->tinno;
			$json_array['cstno']    = $d->cstno;
			$json_array['mobileno']    = $d->phoneno;
			$json_array['address']    = $d->address1.''.$d->address2;
			$json_array['id']    = $d->id;
			$json_array['balance']    = $d->balanceamount;
			// $json_array['advanceamount'] = $d->voucheramount;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}


	public function get_type()
	{
		$invoiceno=$this->input->post('invoiceno');
		$this->db->select('*');
		$this->db->from('invoice_details');
		$this->db->where('invoiceno',$invoiceno);
		$query = $this->db->get();
		$result = $query->result();

		foreach($result as $h)
		{   
			$vob['billtype']=$h->billtype;
		}
		echo json_encode($vob);
	}


	public function get_typepo()
	{
		$invoiceno=$this->input->post('purchaseno');
		$this->db->select('*');
		$this->db->from('purchase_details');
		$this->db->where('purchaseno',$invoiceno);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $h)
		{   
			$vob['billtype']=$h->billtype;
		}
		echo json_encode($vob);
	}

}

ob_flush(); 
?>
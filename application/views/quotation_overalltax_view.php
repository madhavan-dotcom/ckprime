<?php $data=$this->db->get('profile')->result(); 
  foreach($data as $d)
    ?>
<title> <?php echo $d->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<style type="text/css">
		.forms{ }
		.forms input{ width: 95%; }
		.uppercase { text-transform: uppercase; }
		td,th { font-size: 12px; color:black; }
		textarea.form-control { min-height: 40px !important; }
		.myform {}
		.myform input[type="text"]{ width:100%; border: 1px solid #c1c1c1; border-radius: 4px; padding:8px; color: #435966;}
		.myform input[type="hidden"]{ background:#626262;}
		.parsley-required { color:#f00 !important; }
	</style>
<div class="content-page">
  <div class="content">
    <div class="container">
      <?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
      <div class="alert btn-primary alert-micro btn-rounded pastel light dark" >
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <?php print_r($msg); ?>
      </div>
      <?php } ?>

      <?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
      <div class="alert alert-micro btn-rounded alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <?php print_r($msg); ?>
      </div>
      <?php } ?>
	   <?php foreach($result as $vi)  ?> 
      <div class="row">
        <div class="col-sm-12">
          <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
            <header class="panel-heading" style="color:rgb(255, 255, 255)">
              <i class="zmdi zmdi-shopping-cart">&nbsp;View Quotation - <?php echo $vi['quotationno'];?></i>
            </header>
            <div class="card-box">
              <div class="row">
                
            <div class="card-box">
              <div class="row">
                 <form class="form-horizontal"  method="post" action="<?php echo base_url();?>quotation/update" data-parsley-validate>
             <div class="form-group ">
                      <div class="col-md-8 forms">

                           <div class="col-md-4" hidden>
                        <div class="form-group">
                          <label>Quotation No</label>
                          <input type="text" class="form-control" name="quotationno" id="invoiceno" value="<?php echo $vi['quotationno'];?>"  readonly>
                        </div>
                      </div>

					 <input type="hidden" name="quotationno" id="invoiceno" value="<?php echo $vi['quotationno'];?>" >
                      <input type="hidden" name="id" value="<?php echo $vi['id'];?>">
                        
                        <div class="col-md-3">
                          <div class="form-group">
                            <label >Date</label>
                            <input type="text" readonly class="form-control datepicker-autoclose" name="quotationdate" parsley-trigger="change" id="datepicker-autoclose" required value="<?php echo date('d-m-Y',strtotime($vi['quotationdate']));?>" style="width:148px;">
                          </div>
                        </div>
                     
                        <div class="col-md-5">
                          <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" readonly class="form-control" parsley-trigger="change" required name="customername" id="customername" value="<?php echo $vi['customername'];?>">
                               <input type="hidden" class="form-control"  name="supplierid" id="supplierid" value="">
							   <input type="hidden" name="customerId" id="customerId" value="<?php echo $vi['customerId'];?>" />
								<input type="hidden" name="oldAddress" id="oldAddress" />
                            <div id="cusname_valid" style="position: absolute;">
                            </div>
                          </div>
                        </div>
	
						<div class="col-md-3">
							<div class="form-group">
								<label>GST Type</label>
								<select class="form-control" disabled parsley-trigger="change" required name="gsttype" id="gsttype">
								  <option value="intrastate" <?php if($vi['gsttype']=='intrastate') { echo 'selected="selected"'; } ?>>INTRA-STATE</option>
								  <option value="interstate" <?php if($vi['gsttype']=='interstate') { echo 'selected="selected"'; } ?>>INTER-STATE</option>
								</select>
							</div>
						</div>
                           <!--<div class="col-md-4">
                        <div class="form-group">
                          <label>GSTIN</label>
                          <input type="text" class="form-control" name="gstinno" readonly id="" value="<?php echo $vi['gstinno'];?>" >
                        </div>
                      </div>-->
					<input type="hidden" name="gstinno" value="<?php echo $vi['gstinno'];?>" />
                     
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Address</label>
                          <textarea type="text" readonly class="form-control" name="address" id="address"  rows="4"><?php echo $vi['address'];?></textarea>
                        </div>
                      </div>
                    </div>
				
                  <table class="table myform">
                      <thead> 
                        <tr>
							<th -style="width:70px">HSN Code</th>
							<th >Item Name</th>
							<th -style="width:50px">Qty</th>
							<th -style="width:50px">UOM</th>
							<th -style="width:70px">Rate</th>
							<th -style="width:100px">Amount</th>
							<th -style="width:110px">Total</th>
							<th style="width:10px">&nbsp;</th>
                        </tr>  
                      </thead>
                      <tbody>
                      <?php 
					   
                      $hsnno=explode('||',$vi['hsnno']);
                      $itemname=explode('||',$vi['itemname']);
                      $description=explode('||',$vi['description']);
                      $qty=explode('||',$vi['qty']);
                      $uom=explode('||',$vi['uom']);
                      $rate=explode('||',$vi['rate']);
                      $amount=explode('||',$vi['amount']);
                      $taxableamount=explode('||',$vi['taxableamount']);
                      $discount=explode('||',$vi['discount']);
                      $discountamount=explode('||',$vi['discountamount']);
                     
                      $total=explode('||',$vi['total']);

                      for($i=0;$i<count($itemname);$i++) { 
					  
						$this->db->select('*');
						$this->db->from('additem');
						$this->db->where('itemname',$itemname[$i]);
						$item_query = $this->db->get();
						$item_result = $item_query->row();
						
                      ?>
                        <tr>
                          <td><input class="" id="hsnno<?php echo $i;?>" readonly  type="text" name="hsnno[]" value="<?php echo $hsnno[$i];?>">
                          <input type="hidden" name="priceType[]" id="priceType<?php echo $i;?>" value="<?php echo $item_result->priceType;?>" />
                            <div id="hsnno_valid<?php echo $i;?>"></div>
                          </td>
                          <td><input class="itemname_class" readonly required data-id="<?php echo $i;?>" id="itemname<?php echo $i;?>" value="<?php echo $itemname[$i];?>"  type="text" name="itemname[]" value="" >
                         
                            <div id="itemname_valid<?php echo $i;?>"></div>
                          </td>

                          <input class="discount_class decimals" data-id="0" id="discount0"  type="hidden"  name="discount[]" onkeypress="return isNumberKey_With_Dot(event)" value="0"  autocomplete="off"><div id="discount_valid0"></div>

                           <td><input class="qty_class" id="qty<?php echo $i;?>"  data-id="<?php echo $i;?>" readonly required type="text" name="qty[]" value="<?php echo $qty[$i];?>"   autocomplete="off" style="width:100px;">
                            <input type="hidden" name="qtys" id="qtys" value="">
                            <div id="qty_valid<?php echo $i;?>"></div>
                          </td>  

                          <td><input class="" value="<?php echo $uom[$i];?>" id="uom<?php echo $i;?>" readonly style="width:80px;" type="text" name="uom[]"   autocomplete="off">
                          </td>

                          <td><input class="rate_class decimals" data-id="<?php echo $i;?>"  readonly value="<?php echo $rate[$i];?>" id="rate<?php echo $i;?>" required type="text" name="rate[]"   autocomplete="off">
                            <div id="rate_valid<?php echo $i;?>"></div>
                          </td>
							
							<!-- START -->
							<td><input class="decimals" id="amount<?php echo $i;?>" value="<?php echo $amount[$i];?>" readonly  type="text" name="amount[]" value=""  autocomplete="off"><div id="amount_valid<?php echo $i;?>"></div></td>
														
							<td>
								<input class="" id="total<?php echo $i;?>" type="hidden" value="<?php echo @$total[$i];?>" name="total[]" readonly >
							
								<input class="decimals" id="taxableamount<?php echo $i;?>" value="<?php echo $taxableamount[$i];?>" readonly type="text" name="taxableamount[]" autocomplete="off">
							
							</td>
							
							<!-- END -->
                                      
                      </tr>
                  
                      <?php } ?>
                    </tbody>
                     
				
                  </table> 
                 <br>
                       
                     <div class="col-sm-offset-5">
                    <label class="col-sm-5  control-label" >Sub Total</label>
                    <div class="col-sm-7">
                      <input class="form-control"  type="text" value="<?php echo $vi['subtotal'];?>" name="subtotal" id="subtotal" readonly  placeholder="0">
                    </div>
                  </div>
                  <br>
               <div class="clearfix"></div>
<div class="sgst col-sm-offset-7" <?php if($vi['gsttype']!='intrastate') { echo 'style="display:none"'; } ?>>
<label class="sgst col-sm-5  control-label" >CGST </label>
<div class="col-sm-2">
<input class="sgst decimals form-control"   readonly type="text" name="cgst" id="cgst"  value="<?php echo $vi['cgst'];?>">
</div>
<div class="col-sm-5">
<input class="sgst decimals form-control" value="<?php echo $vi['cgstamount'];?>"  type="text" readonly name="cgstamount" id="cgstamount"   placeholder="0">
</div>
</div>
<br>

<div class="clearfix"></div>
<div class="sgst col-sm-offset-7"<?php if($vi['gsttype']!='intrastate') { echo 'style="display:none"'; } ?>>
<label class="sgst col-sm-5  control-label" >SGST </label>
<div class="col-sm-2">
<input class="sgst_class form-control" readonly  type="text" name="sgst" id="sgst"  value="<?php echo $vi['sgst'];?>">
</div>
<div class="col-sm-5">
<input class="sgst decimals form-control"  value="<?php echo $vi['sgstamount'];?>"  type="text" readonly name="sgstamount" id="sgstamount"   placeholder="0">
</div>
</div>

<div class="igst col-sm-offset-7"<?php if($vi['gsttype']!='interstate') { echo 'style="display:none"'; } ?>>
<label class="igst col-sm-5  control-label" >IGST </label>
<div class="col-sm-2">
<input class="igst decimals form-control" readonly  type="text" name="igst" id="igst"  value="<?php echo $vi['igst'];?>">
</div>
<div class="col-sm-5">
<input class="igst decimals form-control"  type="text" readonly name="igstamount" id="igstamount" value="<?php echo $vi['igstamount'];?>"   placeholder="0">
</div>
</div>
<br>

               <div class="col-sm-offset-5" hidden>
                    <label class="col-sm-5  control-label" >Freight Charges</label>
                    <div class="col-sm-7">
                      <input class="form-control"  type="text" name="freightcharges" value="<?php echo $vi['freightcharges'];?>" id="freightcharges"   placeholder="0" value="0">
                    </div>
                  </div>
                  <br>
                  <br>               

                   <div class="col-sm-offset-5" hidden>
                    <label class="col-sm-5  control-label" >Loading & Packing  Charges</label>
                    <div class="col-sm-7">
                      <input class="form-control"  type="text" value="<?php echo $vi['packingcharges'];?>" name="packingcharges" id="packingcharges"   placeholder="0" value="0">
                    </div>
                  </div>
                 
                   <div class="col-sm-offset-5" hidden>
                    <label class="col-sm-5  control-label" >Round Off</label>
                    <div class="col-sm-7">
                      <input class="form-control"  type="text" name="roundOff" id="roundOff"  autocomplete="off" value="<?php echo @$vi['roundoff'];?>" placeholder="0">
                    </div>
                  </div>
                
                                       
                        <div class=" col-sm-offset-5">
                          <label class="col-sm-5  control-label" > Total</label>
                          <div class="col-sm-7">
                            <input class="form-control"  type="text" value="<?php echo $vi['grandtotal'];?>" readonly name="grandtotal" id="grandtotal" >
                            <input class="form-control"  type="hidden" name="taxtotal" id="grandtotal1" value="">
                           
                          </div>                      
                        </div>
                        <div class="col-sm-offset-4">
                         
                         
                        </div>
                      </form>
                    </div>
                  </div>
                </section>
              </div>
            </div><!-- end col -->
          </div>
        </div>
        <script>
          var resizefunc = [];
        </script>
        
        <script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$('form').parsley();
			$('.decimal').keyup(function(){
				var val = $(this).val();
				if(isNaN(val)){
					val = val.replace(/[^0-9\.-]/g,'');
					if(val.split('.').length>2)
					val =val.replace(/\.-+$/,"");
				}
				$(this).val(val);
			});
		});
		$('.colorpicker-default').colorpicker({ format: 'hex' });
		$('.colorpicker-rgba').colorpicker();
		// Date Picker
		jQuery('#datepicker').datepicker();
		jQuery('.datepicker-autoclose').datepicker({ autoclose: true, todayHighlight: true });
		function isNumberKey(evt)
		{
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
			return true;
		}
		
		function call_keyup()
{
	$('.decimals').keyup(function(){
		var val = $(this).val();
		if(isNaN(val)){
			val = val.replace(/[^0-9\.-]/g,'');
			if(val.split('.').length>2)
				val =val.replace(/\.-+$/,"");
		}
		$(this).val(val);
	});

	$(".itemname_class").blur(function(){
		var total = $(this).attr('data-id');
		if($("#itemname"+total).val()=='')
		{
			$('#hsnno'+total).val('');
			$('#priceType'+total).val('');
			$('#itemno'+total).val('');
			$('#rate'+total).val('');
			$('#sgst'+total).val('');
			$('#cgst'+total).val('');
			$('#igst'+total).val('');
			$('#uom'+total).val('');
		}
	});

	$(".itemname_class").keyup(function(){
		var total = $(this).attr('data-id');

		$( "#itemname"+total).autocomplete({
			source: function(request, response) {
				$.ajax({ 
					url: "<?php echo base_url();?>invoice/autocomplete_itemname",
					data: { keyword: $("#itemname"+total).val()},
					dataType: "json",
					type: "POST",
					success: function(data){ 
						$('#hsnno'+total).val('');
						$('#priceType'+total).val('');
						$('#itemno'+total).val('');
						$('#rate'+total).val('');
						$('#sgst'+total).val('');
						$('#cgst'+total).val('');
						$('#igst'+total).val('');
						$('#uom'+total).val('');
						response(data);
					}            
				});
			},
			select: function (event, ui) {
				var name=ui.item.value;
				$('#itemname'+total).val(ui.item.value);
				$.post('<?php echo base_url();?>invoice/get_itemnames',{name:name},function(rest){
				    
					var obj=jQuery.parseJSON(rest);
					$('#hsnno'+total).val(obj.hsnno);
					$('#itemcode'+total).val(obj.itemcode);
					$('#priceType'+total).val(obj.priceType);
					$('#itemno'+total).val(obj.itemno);
					$('#rate'+total).val(obj.price);
					$('#sgst').val(obj.sgst);
					$('#cgst').val(obj.cgst);
					$('#igst').val(obj.igst);
					$('#uom'+total).val(obj.uom);
					$('#qtys'+total).val(obj.balance);
					$('#qty'+total).val('');
					$('#qty'+total).focus();
				});            
				if(name !='')
				{
					$.post('<?php echo base_url();?>invoice/gets',{name:name},function(res){
						if(res > 0)
						{
							$('#itemname_valid'+total).html('<span><font color="green">Available!</span>');
							$('#submit').attr('disabled',false);
							$('#print').attr('disabled',false);
						}
						else
						{
							$('#itemname_valid'+total).html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
					return false;
				}
			}
		});
	});


	$(".itemcode_class").blur(function(){

		var total = $(this).attr('data-id');
		if($("#itemcode"+total).val()=='')
		{
			$('#hsnno'+total).val('');
			$('#priceType'+total).val('');
			$('#itemno'+total).val('');
			$('#itemname'+total).val('');
			$('#rate'+total).val('');
			$('#sgst'+total).val('');
			$('#cgst'+total).val('');
			$('#igst'+total).val('');
			$('#uom'+total).val('');
		}
	});

	$(".itemcode_class").keyup(function(){
		var total = $(this).attr('data-id');

		$( "#itemcode"+total).autocomplete({
			source: function(request, response) {
				$.ajax({ 	
					url: "<?php echo base_url();?>invoice/autocomplete_itemcode",
					data: { keyword: $("#itemcode"+total).val()},
					dataType: "json",
					type: "POST",
					success: function(data){ 
						$('#hsnno'+total).val('');
						$('#priceType'+total).val('');
						$('#itemno'+total).val('');
						$('#itemname'+total).val('');
						$('#rate'+total).val('');
						$('#sgst'+total).val('');
						$('#cgst'+total).val('');
						$('#igst'+total).val('');
						$('#uom'+total).val('');
						response(data);
					}            
				});
			},
			select: function (event, ui) {
				var name=ui.item.value;
				$('#itemcode'+total).val(ui.item.value);
				$.post('<?php echo base_url();?>invoice/get_itemcodes',{name:name},function(rest){
					var obj=jQuery.parseJSON(rest);
					$('#hsnno'+total).val(obj.hsnno);
					$('#priceType'+total).val(obj.priceType);
					$('#itemno'+total).val(obj.itemno);
					$('#itemname'+total).val(obj.itemname);
					$('#rate'+total).val(obj.price);
					$('#sgst'+total).val(obj.sgst);
					$('#cgst'+total).val(obj.cgst);
					$('#igst'+total).val(obj.igst);
					$('#uom'+total).val(obj.uom);
					$('#qtys'+total).val(obj.balance);
					$('#qty'+total).val('');
					$('#qty'+total).focus();
				});            
				if(name !='')
				{
					$.post('<?php echo base_url();?>invoice/getss',{name:name},function(res){
						if(res > 0)
						{
							$('#itemcode_valid'+total).html('<span><font color="green">Available!</span>');
							$('#submit').attr('disabled',false);
							$('#print').attr('disabled',false);
						}
						else
						{
							$('#itemcode_valid'+total).html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
					return false;
				}
			}
		});
	});

	$('.qty_class').keyup(function(){
				var rowNumber = $(this).attr('data-id');
				var priceType = $("#priceType"+rowNumber).val();
			
				var qty=$('#qty'+rowNumber+'').val();
				if(qty != "")
				{
					if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
				// 	frieght_calculation();
					totalAmt_calculation();
				}
				else
				{
				
					if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
				}
				
			});
//RATE CHANGE FUNCTION
$('.rate_class').keyup(function(){
	var rowNumber = $(this).attr('data-id');
	var priceType = $("#priceType"+rowNumber).val();
	var rate=$('#rate'+rowNumber+'').val();
	$('#rate_valid'+rowNumber+'').html('');

	if(parseFloat(rate) > 0)
	{
		if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
// frieght_calculation();
totalAmt_calculation();
}
else
{
	$('#rate_valid'+rowNumber+'').html('<span><font color="red">Invalid Rate !</span>');
	$('#rate_valid'+rowNumber+'').val('');
}
});
// DISCOUNT CHANGE FUNCTION
		$('.discount_class').keyup(function(){
				var rowNumber = $(this).attr('data-id');
				var priceType = $("#priceType"+rowNumber).val();
				$('#discount_valid'+rowNumber+'').html('');
				var discount=$('#discount'+rowNumber+'').val();
				if(discount!='')
				{
					if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
					frieght_calculation();
					totalAmt_calculation();
				}
				else
				{
					$('#discount_valid'+rowNumber+'').html('<span><font color="red">Invalid Discount !</span>');
					$('#discount'+rowNumber+'').val('0');
					$('#discount_valid'+rowNumber+'').html('');
					if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
					totalAmt_calculation();
				}
			});
//calculation--------------------------------------------------

$('#freightamount').keyup(function(){
	totalAmt_calculation();
});

$('#loadingamount').keyup(function(){
	totalAmt_calculation();
});


$('#roundOff').keyup(function(){
	totalAmt_calculation();
});

$('#othercharges').keyup(function(){
	totalAmt_calculation();
});

$('.sgst').keyup(function(){
	var cgst = $('#cgst').val();
	$('#sgst').val(cgst);
	totalAmt_calculation();
});

$('.igst').keyup(function(){
	
	totalAmt_calculation();
});

$('.remove').click(function(){
	$(this).parents('tr').remove();
	totalAmt_calculation(); 
});
}
function amount_calculation(rowNumber)
{
	var qty=$('#qty'+rowNumber).val();
	var rate=$('#rate'+rowNumber).val();

	if(qty!='' && rate!='')
		var amo=parseFloat(rate)*parseFloat(qty);
	var amou=amo.toFixed(2);
	$('#amount'+rowNumber).val(amou);
	$('#taxableamount'+rowNumber).val(amou);
	$('#total'+rowNumber).val(amou);

	var discount=$('#discount'+rowNumber).val();
	var taxableamount=$('#taxableamount'+rowNumber).val(); 
	var gsttype=$('#gsttype').val(); 
	var discountBy = $("#discountBy").val();
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
	var k=taxableamount;
	var l=0;

	if(discount != '')
	{
		if(discountBy=='percent_wise')
		{	
			a=((parseFloat(amo)*parseFloat(discount))/100);
			var a1=a.toFixed(2);
			var a2=parseFloat(amo)-parseFloat(a1);
			var a3=a2.toFixed(2);
			var discountamount=a1;
			taxableamount=a3;
		}
		else
		{
			a=(parseFloat(amo)-parseFloat(discount));
			var discountamount=discount;
//alert(discountamount);
taxableamount=a.toFixed(2);
}
$('#discountamount'+rowNumber).val(discountamount);
$('#taxableamount'+rowNumber).val(taxableamount);
$('#total'+rowNumber).val(k);
}
k=taxableamount;

}

function Inc_amount_calculation(total)
{
	var qty=$('#qty'+total).val();
	var rate=$('#rate'+total).val();

	if(qty!='' && rate!='')
		var amo=parseFloat(rate)*parseFloat(qty);
	var amou=amo.toFixed(2);

	var discount=$('#discount'+total).val(); 
	var gsttype=$('#gsttype').val();
	var discountBy = $("#discountBy").val();		
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
	var k=0;
	var l=0;
	var taxableamount=0;
	var discountamount=0;
	taxableamount = amou;

	if(discount != '')
	{
		if(discountBy=='percent_wise')
		{
			a=((parseFloat(amo)*parseFloat(discount))/100);
			var a1=a.toFixed(2);
			var a2=parseFloat(amo)-parseFloat(a1);
			var a3=a2.toFixed(2);
			var discountamount=a1;
			taxableamount=a3;

		}
		else
		{

			a=(parseFloat(amo)-parseFloat(discount));
			var discountamount=discount;
			taxableamount=a.toFixed(2);
		}
	}
	k = taxableamount;
	$('#discountamount'+total+'').val(discountamount);
	$('#taxableamount'+total+'').val(taxableamount);
}



function totalAmt_calculation()
{
	var freightamount=$('#freightamount').val();
	if(freightamount=='') { freightamount=0; }
	var loadingamount=$('#loadingamount').val();
	if(loadingamount=='') { loadingamount=0; }
	var cgstamount=$('#cgstamount').val();
	if(cgstamount=='') { cgstamount=0; }
	var sgstamount=$('#sgstamount').val();
	if(sgstamount=='') { sgstamount=0; }
	var igstamount=$('#igstamount').val();
	if(igstamount=='') { igstamount=0; }
	var roundOff=$('#roundOff').val();
	var gsttype=$('#gsttype').val();
	var cgst=$('#cgst').val();
	var sgst=$('#sgst').val();
	var igst=$('#igst').val();
	var sub_tot=0;
	var s=0;
	var p=0;
	var m=0;
	var m1=0;
	var n=0;
	var n1=0;
	var l = 0;
	var l1=0;
	var freightamount=0;
	var loadingamount=0;
	
	$('input[name^="taxableamount"]').each(function(){
		sub_tot +=Number($(this).val()); 
		var fina=sub_tot.toFixed(2);         
		$('#subtotal').val(fina);
		$('#grandtotal').val(fina); 

		var tot=parseFloat(sub_tot)+parseFloat(loadingamount)+parseFloat(freightamount);
	});


	if(gsttype=='intrastate')
	{
var totamt=parseFloat(sub_tot)+parseFloat(freightamount)+parseFloat(loadingamount);
if(cgst != '')
{
	var s=((parseFloat((sub_tot)+parseFloat(loadingamount)+parseFloat(freightamount))*parseFloat(cgst))/100);
	var s1=s.toFixed(2);
	$('#cgstamount').val(s1);
	$('#sgstamount').val(s1);

	m = parseFloat(sub_tot)+parseFloat(s1)+parseFloat(s1);
	var m1 = m.toFixed(2);
	$('#grandtotal').val(m1);

}

if(loadingamount > 0 )
{
	//alert(loadingamount);
	l=parseFloat(sub_tot)+parseFloat(s1)+parseFloat(s1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
	l1=l.toFixed(2);
	$('#grandtotal').val(l1);
}
if(freightamount > 0 )
{
	l=parseFloat(sub_tot)+parseFloat(s1)+parseFloat(s1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
	l1=l.toFixed(2);
	$('#grandtotal').val(l1);
}

if(roundOff > 0)
{
	l=parseFloat(sub_tot)+parseFloat(s1)+parseFloat(s1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
	l1=l.toFixed(2);
	$('#grandtotal').val(l1);
}


}
else  if(gsttype=='interstate')
{
	if(igst != '')
	{
		var h=((parseFloat((sub_tot)+parseFloat(loadingamount)+parseFloat(freightamount))*parseFloat(igst))/100);
		var h1=h.toFixed(2);
		$('#igstamount').val(h1);

		n = parseFloat(sub_tot)+parseFloat(h1);
		var n1 = n.toFixed(2);
		$('#grandtotal').val(n1);
	}

	if(loadingamount > 0 )
	{
	//alert(loadingamount);
	l=parseFloat(sub_tot)+parseFloat(h1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
	l1=l.toFixed(2);
	$('#grandtotal').val(l1);
}
if(freightamount > 0 )
{
	l=parseFloat(sub_tot)+parseFloat(h1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
	l1=l.toFixed(2);
	$('#grandtotal').val(l1);
}

if(roundOff > 0)
{
	l=parseFloat(sub_tot)+parseFloat(h1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
	l1=l.toFixed(2);
	$('#grandtotal').val(l1);
}




}
}	

var gsttype=$('#gsttype').val();
if(gsttype=='interstate')
{
	$('.sgst').hide();
	$('.igst').show();
	$('#sgst').attr('required',false);
	$('#sgstamount').attr('required',false);
	$('#cgst').attr('required',false);
	$('#cgstamount').attr('required',false);
}
else  if(gsttype=='intrastate')
{
	$('.sgst').show();
	$('.igst').hide();
	$('#igst').attr('required',false);
	$('#igstamount').attr('required',false);
}



$(document).ready(function(){
	call_keyup();
	$('#gsttype').change(function(){
		var gsttype=$('#gsttype').val();

		if(gsttype=='interstate')
		{
			$('.sgst').hide();
			$('.igst').show();
			$('#sgst').attr('required',false);
			$('#sgstamount').attr('required',false);
			$('#cgst').attr('required',false);
			$('#cgstamount').attr('required',false);
		}
		else  if(gsttype=='intrastate')
		{
			$('.sgst').show();
			$('.igst').hide();
			$('#igst').attr('required',false);
			$('#igstamount').attr('required',false);
		}
	});

	$('.add').click(function(){
		var start=$('#hide').val();
		console.log(start);
		var total=Number(start)+1;
		$('#hide').val(total);
		var tbody=$('#append');


		var mod = $('#gsttype').val();
		var samples,samples1;
		if (mod == 'intrastate') {
			samples = "none";
			samples1 = "nones";
		} else {
			samples = "nones";
			samples1 = "none";
		}


		$(' <tr>'
			+'<td><input class="" id="hsnno'+total+'" readonly type="text" name="hsnno[]" value=""><div id="hsnno_valid'+total+'"></div></td>'
//+'<td><input class="itemcode_class" data-id="'+total+'" id="itemcode'+total+'" type="text" name="itemcode[]" value=""><div id="itemcode_valid'+total+'"></div></td>'
+'<td><input class="itemname_class" data-id="'+total+'"  parsley-trigger="change" required id="itemname'+total+'"  type="text" name="itemname[]" value=""><div id="itemname_valid'+total+'"></div><input type="text" name="item_desc[]" value="" style="margin-top: 2px;" ><input type="hidden" name="priceType[]" id="priceType'+total+'" /></td>'
+'<td><input class="qty_class decimals" data-id="'+total+'" id="qty'+total+'"    parsley-trigger="change" required type="text" name="qty[]"  autocomplete="off"><div id="qty_valid'+total+'"></div><input class="" id="qtys'+total+'" type="hidden" name="qtys[]"></td>'
+'<td><input class="" readonly id="uom'+total+'" type="text" name="uom[]"   autocomplete="off"></td>'
+'<td><input class="rate_class decimals" data-id="'+total+'" id="rate'+total+'"  type="text" name="rate[]" required autocomplete="off"><div id="rate_valid'+total+'"></div></td>'
+'<td><input class="decimals" id="amount'+total+'" readonly type="text" name="amount[]" value=""  autocomplete="off"><input type="hidden" name="gstcal[]" id="gstcal'+total+'" value=""></td>'
+'<td hidden><input class="discount_class decimals" data-id="'+total+'" id="discount'+total+'"  type="hidden" name="discount[]" value="0"  autocomplete="off"  onkeypress="return isNumberKey_With_Dot(event)"></td>'
+'<td hidden><input class="decimals" id="total'+total+'" readonly type="hidden" name="total[]" value=""  data-id="'+total+'" autocomplete="off"></td>'
+'<td><input class="decimals" id="taxableamount'+total+'" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount'+total+'"></td>'

+'<td style="width: 10px;"><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td></tr>').appendTo(tbody);
		call_keyup();



	});
});

</script>

<script type="text/javascript">
	$('#document').ready(function(){
		$('#checkbox').click(function(){
			if($(this).prop("checked")==true)
			{
				$('#check').show();
				$('#imaddress').show();

			}
			else if($(this).prop("checked")==false)
			{
				$('#check').hide();
				$('#imaddress').hide();
			}
		});
	});   


	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
	function isNumber(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
	function isNumberKey_With_Dot(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57)){
			if(charCode == 46)
				return true;
			else
				return false;
		}
		else
			return true;
	}
	function onlyAlphabets(evt) {
		var charCode;
		if (window.event)
charCode = window.event.keyCode;  //for IE
else
charCode = evt.which;  //for firefox
if (charCode == 32) //for &lt;space&gt; symbol
return true;
if (charCode > 31 && charCode < 65) //for characters before 'A' in ASCII Table
	return false;
if (charCode > 90 && charCode < 97) //for characters between 'Z' and 'a' in ASCII Table
	return false;
if (charCode > 122) //for characters beyond 'z' in ASCII Table
	return false;
return true;
}
		
		function call_keyup()
		{
			$(".itemname_class").keyup(function(){
				var total = $(this).attr('data-id');
				$('#itemname'+total).autocomplete({
					source: function(request, response) {
						$.ajax({ 
							url: "<?php echo base_url();?>purchase/autocomplete_itemname",
							data: { keyword: $('#itemname'+total).val()},
							dataType: "json",
							type: "POST",
							success: function(data){ 
								response(data);
							}            
						});
					},
					select: function (event, ui) {
						var name=ui.item.value;
						$('#itemname'+total).val(ui.item.value);
						$.post('<?php echo base_url();?>purchase/get_itemnames',{name:name},function(rest){
							var obj=jQuery.parseJSON(rest);
							$('#hsnno'+total).val(obj.hsnno);
							$('#priceType'+total).val(obj.priceType);
							$('#itemno'+total).val(obj.itemno);
							$('#rate'+total).val(obj.price);
							$('#sgst'+total).val(obj.sgst);
							$('#cgst'+total).val(obj.cgst);
							$('#igst'+total).val(obj.igst);
							$('#uom'+total).val(obj.uom);
							$('#qty'+total).val('');
							$('#qty'+total).focus();
						});            
						if(name !='')
						{
							$.post('<?php echo base_url();?>invoice/gets',{name:name},function(res){
								if(res > 0)
								{
									$('#itemname_valid'+total).html('<span><font color="green">Available!</span>');
									$('#submit').attr('disabled',false);
									$('#print').attr('disabled',false);
								}
								else
								{
									$('#itemname_valid'+total).html('<span><font color="red"> Not Available !</span>');
									$('#submit').attr('disabled',true); //set button enable 
									$('#print').attr('disabled',true); //set button enable 
									//set button enable     
								}
							});
							return false;
						}
					}
				});
			});
			$('.qty_class').keyup(function(){
				var rowNumber = $(this).attr('data-id');
				var priceType = $("#priceType"+rowNumber).val();
				
				var qty=$('#qty'+rowNumber+'').val();
				if(qty != "")
				{
					if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
				// 	frieght_calculation();
					totalAmt_calculation();
				}
				else
				{
					$('#qty_valid'+rowNumber+'').html('<span><font color="red">Invalid Qty !</span>');
					$('#qty'+rowNumber+'').val('0');
					$('#qty_valid'+rowNumber+'').html('');
					if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
				}
				
			});
			//RATE CHANGE FUNCTION
			$('.rate_class').keyup(function(){
				var rowNumber = $(this).attr('data-id');
				var priceType = $("#priceType"+rowNumber).val();
				var rate=$('#rate'+rowNumber+'').val();
				$('#rate_valid'+rowNumber+'').html('');
				
				if(parseFloat(rate) > 0)
				{
					if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
					//frieght_calculation();
					totalAmt_calculation();
				}
				else
				{
					$('#rate_valid'+rowNumber+'').html('<span><font color="red">Invalid Rate !</span>');
					$('#rate_valid'+rowNumber+'').val('');
				}
			});
			// DISCOUNT CHANGE FUNCTION
			$('.discount_class').keyup(function(){
				var rowNumber = $(this).attr('data-id');
				var priceType = $("#priceType"+rowNumber).val();
				$('#discount_valid'+rowNumber+'').html('');
				var discount=$('#discount'+rowNumber+'').val();
				if(discount!='')
				{
					if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
					//frieght_calculation();
					totalAmt_calculation();
				}
				else
				{
					$('#discount_valid'+rowNumber+'').html('<span><font color="red">Invalid Discount !</span>');
					$('#discount'+rowNumber+'').val('0');
					$('#discount_valid'+rowNumber+'').html('');
					if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
					totalAmt_calculation();
				}
			});
				//calculation--------------------------------------------------
		
$('#roundOff').keyup(function(){
		amount_calculation();
			totalAmt_calculation();
});
			$('#othercharges').keyup(function(){
				amount_calculation();
				frieght_calculation();
				totalAmt_calculation();
			});
			$('.cgst_class').keyup(function(){
				var rowNumber = $(this).attr('data-id');
				var priceType = $("#priceType"+rowNumber).val();
				if($("#cgst"+rowNumber).val()=='')  { $("#cgst"+rowNumber).val('0') }
				if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
				totalAmt_calculation();
			});
			
			$('.sgst_class').keyup(function(){
				var rowNumber = $(this).attr('data-id');
				var priceType = $("#priceType"+rowNumber).val();
				if($("#sgst"+rowNumber).val()=='')  { $("#sgst"+rowNumber).val('0') }
				if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
				totalAmt_calculation();
			});
			
			$('.igst_class').keyup(function(){
				var rowNumber = $(this).attr('data-id');
				var priceType = $("#priceType"+rowNumber).val();
				if($("#igst"+rowNumber).val()=='')  { $("#igst"+rowNumber).val('0') }
				if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
				totalAmt_calculation();
			});
			//REMOVE FUNCTION
			 $('.remove').click(function(){
				$(this).parents('tr').remove();
				totalAmt_calculation();
			 });
			
		}
		
		function Inc_amount_calculation(total)
		{
			var qty=$('#qty'+total).val();
			var rate=$('#rate'+total).val();

			if(qty!='' && rate!='')
			var amo=parseFloat(rate)*parseFloat(qty);
			var amou=amo.toFixed(2);

			var discount=$('#discount'+total).val();
			var cgst=$('#cgst'+total).val();
			var sgst=$('#sgst'+total).val();
			var igst=$('#igst'+total).val(); 
			var gsttype=$("#gsttype").val();
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
			var k=0;
			var l=0;
			var taxableamount=0;
			var discountamount=0;
			taxableamount = amou;


			if(discount != '')
			{
				a=(parseFloat(amo)-parseFloat(discount));
				//alert(amo+'\n'+discount);
				var discountamount=a.toFixed(2);
				var a2=parseFloat(amo)-parseFloat(discount);
				taxableamount=a2.toFixed(2);
			}
			k = taxableamount;
			$('#discountamount'+total+'').val(discountamount);
			$('#taxableamount'+total+'').val(taxableamount);
			if(gsttype=='intrastate')
			{
				if(cgst != '')
				{
					var divideBy = parseFloat(cgst)+100;
					b=((parseFloat(k)*parseFloat(cgst))/divideBy);
					var b1=b.toFixed(2);
					$('#cgstamount'+total+'').val(b1);
					var b2=parseFloat(k)-parseFloat(b);
					var b3=b2.toFixed(2);
					$('#amount'+total+'').val(b3);
					var totalVal = (parseFloat(b3)+parseFloat(b)).toFixed(2);
					$("#total"+total).val(totalVal);
				}

				if(sgst != '')
				{
					var divideBy = parseFloat(sgst)+100;
					c=((parseFloat(k)*parseFloat(sgst))/divideBy);
					var c1=c.toFixed(2);
					$('#sgstamount'+total+'').val(c1);
					var c2=parseFloat(k)-(parseFloat(b)+parseFloat(c));
					var c3=c2.toFixed(2);
					$('#amount'+total+'').val(c3);
					var totalVal = (parseFloat(c3)+(parseFloat(b)+parseFloat(c))).toFixed(2);
					$("#total"+total).val(totalVal);
				}
			}
			else  if(gsttype=='interstate')
			{
				if(igst != '')
				{
					
					var divideBy = parseFloat(igst)+100;
					d=((parseFloat(k)*parseFloat(igst))/divideBy);
					var d1=d.toFixed(2);
					$('#igstamount'+total+'').val(d1);
					var d2=parseFloat(k)-parseFloat(d);
					var d3=d2.toFixed(2);
					$('#amount'+total+'').val(d3);
					var totalVal = (parseFloat(d3)+parseFloat(d)).toFixed(2);
					$("#total"+total).val(totalVal);
				}
			}
		}
		function amount_calculation(rowNumber)
		{
			var qty=$('#qty'+rowNumber).val();
			var rate=$('#rate'+rowNumber).val();

			if(qty!='' && rate!='')
			var amo=parseFloat(rate)*parseFloat(qty);
			var amou=amo.toFixed(2);
			$('#amount'+rowNumber).val(amou);
			$('#taxableamount'+rowNumber).val(amou);
			$('#total'+rowNumber).val(amou);

			var discount=$('#discount'+rowNumber).val();
			var cgst=$('#cgst'+rowNumber).val(); 
			var sgst=$('#sgst'+rowNumber).val();
			var igst=$('#igst'+rowNumber).val(); 
			var taxableamount=$('#taxableamount'+rowNumber).val(); 
			var gsttype=$('#gsttype').val(); 
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
			var k=taxableamount;
			var l=0;


			if(discount != '')
			{
				a=((parseFloat(amo)*parseFloat(discount))/100);
				var a1=a.toFixed(2);
				var a2=parseFloat(amo)-parseFloat(a1);
				var a3=a2.toFixed(2);
				k=a3;
				$('#discountamount'+rowNumber).val(a1);
				$('#taxableamount'+rowNumber).val(a3);
				$('#total'+rowNumber).val(a3);
			}
			if(gsttype=='intrastate')
			{
				if(cgst != '')
				{
					b=((parseFloat(k)*parseFloat(cgst))/100);
					var b1=b.toFixed(2);
					$('#cgstamount'+rowNumber).val(b1);
					var b2=parseFloat(k)+parseFloat(b);
					var b3=b2.toFixed(2);
					$('#total'+rowNumber).val(b3);
				}

				if(sgst != "")
				{
					c=((parseFloat(k)*parseFloat(sgst))/100);
					var c1=c.toFixed(2);
					$('#sgstamount'+rowNumber).val(c1);
					var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
					var c3=c2.toFixed(2);
					$('#total'+rowNumber).val(c3);
				}
			}
			else  if(gsttype=='interstate')
			{
				if(igst != '')
				{
					h=((parseFloat(k)*parseFloat(igst))/100);
					var h1=h.toFixed(2);
					$('#igstamount'+rowNumber).val(h1);
					var h2=parseFloat(k)+parseFloat(h);
					var h3=h2.toFixed(2);
					$('#total'+rowNumber).val(h3);
				}
			}
		}
		function totalAmt_calculation()
		{

		    	var roundOff=$('#roundOff').val();
			var othercharges=$('#othercharges').val();
			var sub_tot=0;
			$('input[name^="taxableamount"]').each(function(){
				sub_tot +=Number($(this).val()); 
				var fina=sub_tot.toFixed(2);         
				$('#subtotal').val(fina);
				$('#grandtotal').val(fina); 
			});


if(roundOff)
{
	l=parseFloat(sub_tot)+parseFloat(roundOff);
	l1=l.toFixed(2);
	$('#grandtotal').val(l1);
}
			if(othercharges)
			{
				l=parseFloat(sub_tot)+parseFloat(othercharges);
				var l1=l.toFixed(2);
				$('#grandtotal').val(l1);
			}
		}	
		$(document).ready(function(){
			call_keyup();
			$('#gsttype').change(function(){
				var gsttype=$('#gsttype').val();
				$('input[name^="hsnno"]').val('');
				$('input[name^="itemname"]').val('');
				$('input[name^="qty"]').val('');
				$('input[name^="uom"]').val('');
				$('input[name^="rate"]').val('');
				$('input[name^="amount"]').val('');
				$('input[name^="discount"]').val('');
				$('input[name^="taxableamount"]').val('');
				$('input[name^="discountamount"]').val('');
				$('input[name^="cgst"]').val('');
				$('input[name^="cgstamount"]').val('');
				$('input[name^="sgst"]').val('');
				$('input[name^="sgstamount"]').val('');   
				$('input[name^="igst"]').val('');        
				$('input[name^="igstamount"]').val('');
				$('input[name^="total"]').val('');

				$('#hsnno').val('');
				$('#itemname').val('');
				$('#qty').val('');
				$('#uom').val('');
				$('#rate').val('');
				$('#amount').val('');
				$('#discount').val('');
				$('#taxableamount').val('');
				$('#discountamount').val('');
				$('#cgst').val('');
				$('#cgstamount').val('');
				$('#sgst').val('');
				$('#sgstamount').val('');
				$('#igst').val('');
				$('#igstamount').val('');
				$('#total').val('');

				if(gsttype=='interstate')
				{
					$('.sgst').hide();
					$('.igst').show();
					$('#sgst').val('0');
					$('#sgstamount').val('0.00');
					$('#cgst').val('0');
					$('#cgstamount').val('0.00');
				}
				else  if(gsttype=='intrastate')
				{
					$('.sgst').show();
					$('.igst').hide();
					$('#igst').val('0');
					$('#igstamount').val('0.00');
				}
			});
			CUSTOMER NAME AUTO COMPLETE
			$( "#customername" ).autocomplete({
				source: function(request, response) {
					$.ajax({ 
						url: "<?php echo base_url();?>invoice/autocomplete_customername",
						data: { keyword: $("#customername").val()},
						dataType: "json",
						type: "POST",
						success: function(data){ 
							response(data);
						}            
					});
				}, select: function (event, ui) {
					$("#customername").val(ui.item.label); 
					$('#address').val(ui.item.address); 
					$('#oldAddress').val(ui.item.address);
					$('#tinno').val(ui.item.tinno); 
					$('#cstno').val(ui.item.cstno); 
					$('#customerId').val(ui.item.customerid); 
					var name = $('#customername').val();
					if(name !='')
					{
						$.post('<?php echo base_url();?>invoice/getcustomer',{name:name},function(res){
							if(res > 0)
							{
								$('#cusname_valid').html('<span><font color="green">Available!</span>');
								$('#submit').attr('disabled',false);
								$('#print').attr('disabled',false);
							}
							else
							{
								$('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
								$('#submit').attr('disabled',true); //set button enable 
								$('#print').attr('disabled',true); //set button enable 
								//set button enable     
							}
						});
						return false;
					}
				}
			});

			$('#customername').on('keyup blur', function(e) {
				var name = $('#customername').val();
				if(name !='')
				{
					$.post('<?php echo base_url();?>invoice/getcustomer',{name:name},function(res){
						if(res > 0)
						{
							$('#cusname_valid').html('<span><font color="green">Available!</span>');
							$('#submit').attr('disabled',false);
							$('#print').attr('disabled',false);
						}
						else
						{
							$('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
							$('#submit').attr('disabled',true); //set button enable 
							$('#print').attr('disabled',true); //set button enable 
							//set button enable     
						}
					});
					return false;
				}
			}); 
			
		
});
	</script>*/?>

  <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });


        
    </script>

        <script>
          $('.colorpicker-default').colorpicker({
            format: 'hex'
          });
          $('.colorpicker-rgba').colorpicker();
// Date Picker
jQuery('#datepicker').datepicker();
jQuery('.datepicker-autoclose').datepicker({
  autoclose: true,
  todayHighlight: true
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
    

    $('#gsttype').change(function(){

        var gsttype=$('#gsttype').val();

         $('input[name^="hsnno"]').val('');
        $('input[name^="itemname"]').val('');
        $('input[name^="qty"]').val('');
        $('input[name^="uom"]').val('');
        $('input[name^="rate"]').val('');
        $('input[name^="amount"]').val('');
        $('input[name^="discount"]').val('');
        $('input[name^="taxableamount"]').val('');
        $('input[name^="discountamount"]').val('');
        $('input[name^="cgst"]').val('');
        $('input[name^="cgstamount"]').val('');
        $('input[name^="sgst"]').val('');
        $('input[name^="sgstamount"]').val('');   
        $('input[name^="igst"]').val('');        
        $('input[name^="igstamount"]').val('');
        $('input[name^="total"]').val('');


        // $('#form1')[0].reset();
          $('#hsnno').val('');
          $('#itemname').val('');
          $('#qty').val('');
          $('#uom').val('');
          $('#rate').val('');
          $('#amount').val('');
          $('#discount').val('');
          $('#taxableamount').val('');
          $('#discountamount').val('');
          $('#cgst').val('');
          $('#cgstamount').val('');
          $('#sgst').val('');
          $('#sgstamount').val('');
          $('#igst').val('');
          $('#igstamount').val('');
          $('#total').val('');

          if(gsttype=='interstate')
          {

            $('.sgst').hide();
            $('.igst').show();
         

             $('#sgst').val('0');
            $('#sgstamount').val('0.00');
            $('#cgst').val('0');
            $('#cgstamount').val('0.00');
            
          }

          else  if(gsttype=='intrastate')

          {

            $('.sgst').show();
            $('.igst').hide();
              

            $('#igst').val('0');
            $('#igstamount').val('0.00');
           
           
          }
        });



    $( "#customername" ).autocomplete({
  source: function(request, response) {
    $.ajax({ 
      url: "<?php echo base_url();?>invoice/autocomplete_customername",
      data: { keyword: $("#customername").val()},
      dataType: "json",
      type: "POST",
      success: function(data){ 
        response(data);
      }            
    });
  }, select: function (event, ui) {
    $("#customername").val(ui.item.label); 

    $('#address').val(ui.item.address); 
    $('#tinno').val(ui.item.tinno); 
    $('#cstno').val(ui.item.cstno); 
    $('#customerid').val(ui.item.customerid); 



       var name = $('#customername').val();


    if(name !='')
    {

      $.post('<?php echo base_url();?>invoice/getcustomer',{name:name},function(res){

        if(res > 0)
        {

          $('#cusname_valid').html('<span><font color="green">Available!</span>');

          $('#submit').attr('disabled',false);
          $('#print').attr('disabled',false);

        }

        else
        {

         $('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
                                        $('#submit').attr('disabled',true); //set button enable 
                                        $('#print').attr('disabled',true); //set button enable 
                                       //set button enable     
                                     }
                                   });

      return false;

    }



  }
});


  $('#customername').keyup(function(){


     var name = $('#customername').val();


    if(name !='')
    {

      $.post('<?php echo base_url();?>invoice/getcustomer',{name:name},function(res){

        if(res > 0)
        {

          $('#cusname_valid').html('<span><font color="green">Available!</span>');

          $('#submit').attr('disabled',false);
          $('#print').attr('disabled',false);

        }

        else
        {

         $('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
                                        $('#submit').attr('disabled',true); //set button enable 
                                        $('#print').attr('disabled',true); //set button enable 
                                       //set button enable     
                                     }
                                   });

      return false;

    }



  }); 
 $('#customername').blur(function(){ 
  var name=$(this).val();

  if(name !='')
  {
    $.post('<?php echo base_url();?>invoice/get_supplier',{name:name},function(res){
      if(res > 0)
      {
        $('#cusname_valid').html('<span><font color="green">Available!</span>');
        $('#submit').attr('disabled',false);
        $('#print').attr('disabled',false);
      }
      else
      {
        $('#customername').focus();
        $('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
                                        $('#submit').attr('disabled',true); //set button enable 
                                        $('#print').attr('disabled',true); //set button enable 
                                       //set button enable     
                                     }
                                   });
    return false;
  }
});






 






 $( "#itemname" ).autocomplete({
  source: function(request, response) {
    $.ajax({ 
      url: "<?php echo base_url();?>purchase/autocomplete_itemname",
      data: { keyword: $("#itemname").val()},
      dataType: "json",
      type: "POST",
      success: function(data){ 
        response(data);
      }            
    });
  },
  select: function (event, ui) {

var name=ui.item.value;
 $('#itemname').val(ui.item.value);
  $.post('<?php echo base_url();?>purchase/get_itemnames',{name:name},function(rest){
    var obj=jQuery.parseJSON(rest);
    $('#hsnno').val(obj.hsnno);
    $('#itemno').val(obj.itemno);
    $('#rate').val(obj.price);
    $('#sgst').val(obj.sgst);
    $('#cgst').val(obj.cgst);
    $('#igst').val(obj.igst);
    $('#uom').val(obj.uom);
    $('#qty').val('');
    $('#qty').focus();

  });            
  if(name !='')
  {
    $.post('<?php echo base_url();?>invoice/gets',{name:name},function(res){
      if(res > 0)
      {
        $('#itemname_valid').html('<span><font color="green">Available!</span>');
        $('#submit').attr('disabled',false);
        $('#print').attr('disabled',false);
      }
      else
      {

       $('#itemname_valid').html('<span><font color="red"> Not Available !</span>');
                                        $('#submit').attr('disabled',true); //set button enable 
                                        $('#print').attr('disabled',true); //set button enable 
                                       //set button enable     
                                     }
                                   });
    return false;
  }
          

           }

});



 
 //calculation--------------------------------------------------

$('#qty').keyup(function(){
   var qty=$('#qty').val();
   var rate=$('#rate').val();

   if(qty)
    var amo=parseFloat(rate)*parseFloat(qty);
      var amou=amo.toFixed(2);
      $('#amount').val(amou);
      $('#taxableamount').val(amou);
      $('#total').val(amou);


    var discount=$('#discount').val();
    var cgst=$('#cgst').val();
    var sgst=$('#sgst').val();
    var igst=$('#igst').val(); 
    var taxableamount=$('#taxableamount').val(); 
    var gsttype=$('#gsttype').val(); 
    var freightcharges=$('#freightcharges').val();
    var packingcharges=$('#packingcharges').val();
    var othercharges=$('#othercharges').val();
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
         var k=taxableamount;

           if(discount > 0)
           {
            
             a=((parseFloat(amo)*parseFloat(discount))/100);
            var a1=a.toFixed(2);
            var a2=parseFloat(amo)-parseFloat(a1);
            var a3=a2.toFixed(2);
            k=a3;
            $('#discountamount').val(a1);
             $('#taxableamount').val(a3);
             $('#total').val(a3);
           }

           

          if(gsttype=='intrastate')

          {

                if(cgst > 0)
               {
                   b=((parseFloat(k)*parseFloat(cgst))/100);
                  var b1=b.toFixed(2);
                  $('#cgstamount').val(b1);
                  var b2=parseFloat(k)+parseFloat(b);
                  var b3=b2.toFixed(2);
                   $('#total').val(b3);
                  
               }

               if(sgst > 0)
               {
                   c=((parseFloat(k)*parseFloat(sgst))/100);
                  var c1=c.toFixed(2);
                  $('#sgstamount').val(c1);
                  var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
                  var c3=c2.toFixed(2);
                   $('#total').val(c3);
                  
               }

           
          }

         else  if(gsttype=='interstate')
          {

              if(igst > 0)
             {
              
                 d=((parseFloat(k)*parseFloat(igst))/100);
                var d1=d.toFixed(2);
                $('#igstamount').val(d1);
                var d2=parseFloat(k)+parseFloat(d);
                var d3=d2.toFixed(2);
                 $('#total').val(d3);
                
             }
            
          }

       
        var sub_tot=0;
          
           $('input[name^="total"]').each(function(){
                   sub_tot +=Number($(this).val());          
                  var fina=sub_tot.toFixed(2);         
                  $('#subtotal').val(fina);
                  $('#grandtotal').val(fina); 
                                                
                  });


        if(freightcharges)
       {
          h=freightcharges;
         e=parseFloat(sub_tot)+parseFloat(freightcharges);
        var e1=e.toFixed(2);
         $('#grandtotal').val(e1);
         
       }

      if(packingcharges)
       {

         i=packingcharges;        
         f=parseFloat(sub_tot)+parseFloat(h)+parseFloat(packingcharges);
        var f1=f.toFixed(2);
         $('#grandtotal').val(f1);
         
       }

       if(othercharges)
       {
      
         g=parseFloat(sub_tot)+parseFloat(h)+parseFloat(i)+parseFloat(othercharges);
        var g1=g.toFixed(2);
         $('#grandtotal').val(g1);
         
       }



});

$('#rate').keyup(function(){
   var qty=$('#qty').val();
   var rate=$('#rate').val();

   if(qty!='' && rate!='')
    var amo=parseFloat(rate)*parseFloat(qty);
      var amou=amo.toFixed(2);
      $('#amount').val(amou);
      $('#taxableamount').val(amou);
      $('#total').val(amou);


    var discount=$('#discount').val();
    var cgst=$('#cgst').val();
    var sgst=$('#sgst').val();
    var igst=$('#igst').val(); 
    var taxableamount=$('#taxableamount').val(); 
    var gsttype=$('#gsttype').val(); 
    var freightcharges=$('#freightcharges').val();
    var packingcharges=$('#packingcharges').val();
    var othercharges=$('#othercharges').val();
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
         var k=taxableamount;

        

           if(discount > 0)
           {
            
             a=((parseFloat(amo)*parseFloat(discount))/100);
            var a1=a.toFixed(2);
            var a2=parseFloat(amo)-parseFloat(a1);
            var a3=a2.toFixed(2);
            k=a3;
            $('#discountamount').val(a1);
             $('#taxableamount').val(a3);
             $('#total').val(a3);
           }

           

          if(gsttype=='intrastate')

          {

                if(cgst > 0)
               {
                   b=((parseFloat(k)*parseFloat(cgst))/100);
                  var b1=b.toFixed(2);
                  $('#cgstamount').val(b1);
                  var b2=parseFloat(k)+parseFloat(b);
                  var b3=b2.toFixed(2);
                   $('#total').val(b3);
                  
               }

               if(sgst > 0)
               {
                   c=((parseFloat(k)*parseFloat(sgst))/100);
                  var c1=c.toFixed(2);
                  $('#sgstamount').val(c1);
                  var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
                  var c3=c2.toFixed(2);
                   $('#total').val(c3);
                  
               }

           
          }

         else  if(gsttype=='interstate')
          {

              if(igst > 0)
             {
              
                 d=((parseFloat(k)*parseFloat(igst))/100);
                var d1=d.toFixed(2);
                $('#igstamount').val(d1);
                var d2=parseFloat(k)+parseFloat(d);
                var d3=d2.toFixed(2);
                 $('#total').val(d3);
                
             }
            
          }

       
        var sub_tot=0;
          
           $('input[name^="total"]').each(function(){
                   sub_tot +=Number($(this).val());          
                  var fina=sub_tot.toFixed(2);         
                  $('#subtotal').val(fina);
                  $('#grandtotal').val(fina); 
                                                
                  });


        if(freightcharges)
       {
          h=freightcharges;
         e=parseFloat(sub_tot)+parseFloat(freightcharges);
        var e1=e.toFixed(2);
         $('#grandtotal').val(e1);
         
       }

      if(packingcharges)
       {

         i=packingcharges;        
         f=parseFloat(sub_tot)+parseFloat(h)+parseFloat(packingcharges);
        var f1=f.toFixed(2);
         $('#grandtotal').val(f1);
         
       }

       if(othercharges)
       {
      
         g=parseFloat(sub_tot)+parseFloat(h)+parseFloat(i)+parseFloat(othercharges);
        var g1=g.toFixed(2);
         $('#grandtotal').val(g1);
         
       }



});

$('#discount').keyup(function(){
   var qty=$('#qty').val();
   var rate=$('#rate').val();


    var amo=parseFloat(rate)*parseFloat(qty);
      var amou=amo.toFixed(2);
      $('#amount').val(amou);
      $('#taxableamount').val(amou);
      $('#total').val(amou);


    var discount=$('#discount').val();
    var cgst=$('#cgst').val();
    var sgst=$('#sgst').val();
    var igst=$('#igst').val(); 
    var taxableamount=$('#taxableamount').val(); 
    var gsttype=$('#gsttype').val(); 
    var freightcharges=$('#freightcharges').val();
    var packingcharges=$('#packingcharges').val();
    var othercharges=$('#othercharges').val();
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
         var k=taxableamount;

         if(discount=='')
         {
            $('#discountamount').val('');
         }

           if(discount > 0)
           {
            
             a=((parseFloat(amo)*parseFloat(discount))/100);
            var a1=a.toFixed(2);
            var a2=parseFloat(amo)-parseFloat(a1);
            var a3=a2.toFixed(2);
            k=a3;
            $('#discountamount').val(a1);
             $('#taxableamount').val(a3);
             $('#total').val(a3);
           }

           

          if(gsttype=='intrastate')

          {

                if(cgst > 0)
               {
                   b=((parseFloat(k)*parseFloat(cgst))/100);
                  var b1=b.toFixed(2);
                  $('#cgstamount').val(b1);
                  var b2=parseFloat(k)+parseFloat(b);
                  var b3=b2.toFixed(2);
                   $('#total').val(b3);
                  
               }

               if(sgst > 0)
               {
                   c=((parseFloat(k)*parseFloat(sgst))/100);
                  var c1=c.toFixed(2);
                  $('#sgstamount').val(c1);
                  var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
                  var c3=c2.toFixed(2);
                   $('#total').val(c3);
                  
               }

           
          }

         else  if(gsttype=='interstate')
          {

              if(igst > 0)
             {
              
                 d=((parseFloat(k)*parseFloat(igst))/100);
                var d1=d.toFixed(2);
                $('#igstamount').val(d1);
                var d2=parseFloat(k)+parseFloat(d);
                var d3=d2.toFixed(2);
                 $('#total').val(d3);
                
             }
            
          }

       
        var sub_tot=0;
          
           $('input[name^="total"]').each(function(){
                   sub_tot +=Number($(this).val());          
                  var fina=sub_tot.toFixed(2);         
                  $('#subtotal').val(fina);
                  $('#grandtotal').val(fina); 
                                                
                  });


        if(freightcharges)
       {
          h=freightcharges;
         e=parseFloat(sub_tot)+parseFloat(freightcharges);
        var e1=e.toFixed(2);
         $('#grandtotal').val(e1);
         
       }

      if(packingcharges)
       {

         i=packingcharges;        
         f=parseFloat(sub_tot)+parseFloat(h)+parseFloat(packingcharges);
        var f1=f.toFixed(2);
         $('#grandtotal').val(f1);
         
       }

       if(othercharges)
       {
      
         g=parseFloat(sub_tot)+parseFloat(h)+parseFloat(i)+parseFloat(othercharges);
        var g1=g.toFixed(2);
         $('#grandtotal').val(g1);
         
       }



});

$('#freightcharges').keyup(function(){
   var qty=$('#qty').val();
   var rate=$('#rate').val();


    var amo=parseFloat(rate)*parseFloat(qty);
      var amou=amo.toFixed(2);
      $('#amount').val(amou);
      $('#taxableamount').val(amou);
      $('#total').val(amou);


    var discount=$('#discount').val();
    var cgst=$('#cgst').val();
    var sgst=$('#sgst').val();
    var igst=$('#igst').val(); 
    var taxableamount=$('#taxableamount').val(); 
    var gsttype=$('#gsttype').val(); 
    var freightcharges=$('#freightcharges').val();
    var packingcharges=$('#packingcharges').val();
    var othercharges=$('#othercharges').val();
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
         var k=taxableamount;

           if(discount > 0)
           {
            
             a=((parseFloat(amo)*parseFloat(discount))/100);
            var a1=a.toFixed(2);
            var a2=parseFloat(amo)-parseFloat(a1);
            var a3=a2.toFixed(2);
            k=a3;
            $('#discountamount').val(a1);
             $('#taxableamount').val(a3);
             $('#total').val(a3);
           }

           

          if(gsttype=='intrastate')

          {

                if(cgst > 0)
               {
                   b=((parseFloat(k)*parseFloat(cgst))/100);
                  var b1=b.toFixed(2);
                  $('#cgstamount').val(b1);
                  var b2=parseFloat(k)+parseFloat(b);
                  var b3=b2.toFixed(2);
                   $('#total').val(b3);
                  
               }

               if(sgst > 0)
               {
                   c=((parseFloat(k)*parseFloat(sgst))/100);
                  var c1=c.toFixed(2);
                  $('#sgstamount').val(c1);
                  var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
                  var c3=c2.toFixed(2);
                   $('#total').val(c3);
                  
               }

           
          }

         else  if(gsttype=='interstate')
          {

              if(igst > 0)
             {
              
                 d=((parseFloat(k)*parseFloat(igst))/100);
                var d1=d.toFixed(2);
                $('#igstamount').val(d1);
                var d2=parseFloat(k)+parseFloat(d);
                var d3=d2.toFixed(2);
                 $('#total').val(d3);
                
             }
            
          }

       
        var sub_tot=0;
          
           $('input[name^="total"]').each(function(){
                   sub_tot +=Number($(this).val());          
                  var fina=sub_tot.toFixed(2);         
                  $('#subtotal').val(fina);
                  $('#grandtotal').val(fina); 
                                                
                  });


        if(freightcharges)
       {
          h=freightcharges;
         e=parseFloat(sub_tot)+parseFloat(freightcharges);
        var e1=e.toFixed(2);
         $('#grandtotal').val(e1);
         
       }

      if(packingcharges)
       {

         i=packingcharges;        
         f=parseFloat(sub_tot)+parseFloat(h)+parseFloat(packingcharges);
        var f1=f.toFixed(2);
         $('#grandtotal').val(f1);
         
       }

       if(othercharges)
       {
      
         g=parseFloat(sub_tot)+parseFloat(h)+parseFloat(i)+parseFloat(othercharges);
        var g1=g.toFixed(2);
         $('#grandtotal').val(g1);
         
       }



});

$('#packingcharges').keyup(function(){
   var qty=$('#qty').val();
   var rate=$('#rate').val();


    var amo=parseFloat(rate)*parseFloat(qty);
      var amou=amo.toFixed(2);
      $('#amount').val(amou);
      $('#taxableamount').val(amou);
      $('#total').val(amou);


    var discount=$('#discount').val();
    var cgst=$('#cgst').val();
    var sgst=$('#sgst').val();
    var igst=$('#igst').val(); 
    var taxableamount=$('#taxableamount').val(); 
    var gsttype=$('#gsttype').val(); 
    var freightcharges=$('#freightcharges').val();
    var packingcharges=$('#packingcharges').val();
    var othercharges=$('#othercharges').val();
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
         var k=taxableamount;

           if(discount > 0)
           {
            
             a=((parseFloat(amo)*parseFloat(discount))/100);
            var a1=a.toFixed(2);
            var a2=parseFloat(amo)-parseFloat(a1);
            var a3=a2.toFixed(2);
            k=a3;
            $('#discountamount').val(a1);
             $('#taxableamount').val(a3);
             $('#total').val(a3);
           }

           

          if(gsttype=='intrastate')

          {

                if(cgst > 0)
               {
                   b=((parseFloat(k)*parseFloat(cgst))/100);
                  var b1=b.toFixed(2);
                  $('#cgstamount').val(b1);
                  var b2=parseFloat(k)+parseFloat(b);
                  var b3=b2.toFixed(2);
                   $('#total').val(b3);
                  
               }

               if(sgst > 0)
               {
                   c=((parseFloat(k)*parseFloat(sgst))/100);
                  var c1=c.toFixed(2);
                  $('#sgstamount').val(c1);
                  var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
                  var c3=c2.toFixed(2);
                   $('#total').val(c3);
                  
               }

           
          }

         else  if(gsttype=='interstate')
          {

              if(igst > 0)
             {
              
                 d=((parseFloat(k)*parseFloat(igst))/100);
                var d1=d.toFixed(2);
                $('#igstamount').val(d1);
                var d2=parseFloat(k)+parseFloat(d);
                var d3=d2.toFixed(2);
                 $('#total').val(d3);
                
             }
            
          }

       
        var sub_tot=0;
          
           $('input[name^="total"]').each(function(){
                   sub_tot +=Number($(this).val());          
                  var fina=sub_tot.toFixed(2);         
                  $('#subtotal').val(fina);
                  $('#grandtotal').val(fina); 
                                                
                  });


        if(freightcharges)
       {
          h=freightcharges;
         e=parseFloat(sub_tot)+parseFloat(freightcharges);
        var e1=e.toFixed(2);
         $('#grandtotal').val(e1);
         
       }

      if(packingcharges)
       {

         i=packingcharges;        
         f=parseFloat(sub_tot)+parseFloat(h)+parseFloat(packingcharges);
        var f1=f.toFixed(2);
         $('#grandtotal').val(f1);
         
       }

       if(othercharges)
       {
      
         g=parseFloat(sub_tot)+parseFloat(h)+parseFloat(i)+parseFloat(othercharges);
        var g1=g.toFixed(2);
         $('#grandtotal').val(g1);
         
       }



});

$('#othercharges').keyup(function(){
   var qty=$('#qty').val();
   var rate=$('#rate').val();


    var amo=parseFloat(rate)*parseFloat(qty);
      var amou=amo.toFixed(2);
      $('#amount').val(amou);
      $('#taxableamount').val(amou);
      $('#total').val(amou);


    var discount=$('#discount').val();
    var cgst=$('#cgst').val();
    var sgst=$('#sgst').val();
    var igst=$('#igst').val(); 
    var taxableamount=$('#taxableamount').val(); 
    var gsttype=$('#gsttype').val(); 
    var freightcharges=$('#freightcharges').val();
    var packingcharges=$('#packingcharges').val();
    var othercharges=$('#othercharges').val();
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
         var k=taxableamount;

           if(discount > 0)
           {
            
             a=((parseFloat(amo)*parseFloat(discount))/100);
            var a1=a.toFixed(2);
            var a2=parseFloat(amo)-parseFloat(a1);
            var a3=a2.toFixed(2);
            k=a3;
            $('#discountamount').val(a1);
             $('#taxableamount').val(a3);
             $('#total').val(a3);
           }

           

          if(gsttype=='intrastate')

          {

                if(cgst > 0)
               {
                   b=((parseFloat(k)*parseFloat(cgst))/100);
                  var b1=b.toFixed(2);
                  $('#cgstamount').val(b1);
                  var b2=parseFloat(k)+parseFloat(b);
                  var b3=b2.toFixed(2);
                   $('#total').val(b3);
                  
               }

               if(sgst > 0)
               {
                   c=((parseFloat(k)*parseFloat(sgst))/100);
                  var c1=c.toFixed(2);
                  $('#sgstamount').val(c1);
                  var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
                  var c3=c2.toFixed(2);
                   $('#total').val(c3);
                  
               }

           
          }

         else  if(gsttype=='interstate')
          {

              if(igst > 0)
             {
              
                 d=((parseFloat(k)*parseFloat(igst))/100);
                var d1=d.toFixed(2);
                $('#igstamount').val(d1);
                var d2=parseFloat(k)+parseFloat(d);
                var d3=d2.toFixed(2);
                 $('#total').val(d3);
                
             }
            
          }

       
        var sub_tot=0;
          
           $('input[name^="total"]').each(function(){
                   sub_tot +=Number($(this).val());          
                  var fina=sub_tot.toFixed(2);         
                  $('#subtotal').val(fina);
                  $('#grandtotal').val(fina); 
                                                
                  });


        if(freightcharges)
       {
          h=freightcharges;
         e=parseFloat(sub_tot)+parseFloat(freightcharges);
        var e1=e.toFixed(2);
         $('#grandtotal').val(e1);
         
       }

      if(packingcharges)
       {

         i=packingcharges;        
         f=parseFloat(sub_tot)+parseFloat(h)+parseFloat(packingcharges);
        var f1=f.toFixed(2);
         $('#grandtotal').val(f1);
         
       }

       if(othercharges)
       {
      
         g=parseFloat(sub_tot)+parseFloat(h)+parseFloat(i)+parseFloat(othercharges);
        var g1=g.toFixed(2);
         $('#grandtotal').val(g1);
         
       }



});

});
</script>

<script type="text/javascript">
  $('#document').ready(function(){
    $('#checkbox').click(function(){
      if($(this).prop("checked")==true)
      {
        $('#check').show();
        $('#imaddress').show();

      }
      else if($(this).prop("checked")==false)
      {
        $('#check').hide();
        $('#imaddress').hide();
      }
    });
  });   


  function isNumberKey(evt)
  {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }
  function onlyAlphabets(evt) {
    var charCode;
    if (window.event)
          charCode = window.event.keyCode;  //for IE
        else
          charCode = evt.which;  //for firefox
          if (charCode == 32) //for &lt;space&gt; symbol
          return true;
          if (charCode > 31 && charCode < 65) //for characters before 'A' in ASCII Table
            return false;
          if (charCode > 90 && charCode < 97) //for characters between 'Z' and 'a' in ASCII Table
            return false;
          if (charCode > 122) //for characters beyond 'z' in ASCII Table
            return false;
          return true;
        }
        $('.decimal').keyup(function(){
          var val = $(this).val();
          if(isNaN(val)){
            val = val.replace(/[^0-9\.-]/g,'');
            if(val.split('.').length>2)
              val =val.replace(/\.-+$/,"");
          }
          $(this).val(val);
        });
      </script>


      


      

<script type="text/javascript">

 

      function focs()
      {
        if(this.value == '0') { this.value = ''; }
        
      }
      function blrs()
      {
        if(this.value == '') { this.value = '0'; }
        //alert();
      }
</script>

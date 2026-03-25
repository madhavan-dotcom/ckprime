<?php $data = $this->db->get('profile')->result();
$discountBy = $this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
$checkInvoiceType = $this->db->select('invoiceBy')->where('id', 1)->get('preference_settings')->row()->invoiceBy;
if ($discountBy == 'percent_wise') {
	$discType = '%';
} else {
	$discType = '';
}
foreach ($data as $r)
?>
<title> <?php echo $r->companyname; ?></title>
<link href="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/multiselect/css/bootstrap-select.css">
<style type="text/css">
	textarea[readonly] {
		background-color: #e8e8e8 !important;
	}

	input[readonly] {
		background-color: #e8e8e8 !important;
	}

	.forms input {
		width: 95%;
	}

	.uppercase {
		text-transform: uppercase;
	}

	td,
	th {
		font-size: 12px;
		color: black;
	}

	textarea.form-control {
		min-height: 40px !important;
	}

	.myform input[type="text"] {
		width: 100%;
		border: 1px solid #dcdcdc;
		border-radius: 4px;
		padding: 8px;
		color: #435966;
	}

	.myform input[type="hidden"] {
		background: #626262;
	}

	.parsley-required {
		color: #f00 !important;
	}

	.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
		width: 89%;
	}
</style>
<div class="content-page">
	<div class="content">
		<div class="container">
			<?php $msg = $this->session->flashdata('msg');
			if ((isset($msg)) && (!empty($msg))) { ?>
				<div class="alert btn-primary alert-micro btn-rounded pastel light dark">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php print_r($msg); ?>
				</div>
			<?php } ?>

			<?php $msg = $this->session->flashdata('msg1');
			if ((isset($msg)) && (!empty($msg))) { ?>
				<div class="alert alert-micro btn-rounded alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php print_r($msg); ?>
				</div>
			<?php } ?>
			<div class="row">
				<div class="col-sm-12">
					<section>
						<header class="panel-heading" style="color:rgb(255, 255, 255);background: #2477c9;">
							<i class="zmdi zmdi-shopping-cart"><span style="font-family: 'Quicksand', sans-serif;padding-left: 6px;">Work Order - <?php echo $invoiceno; ?></span></i>
						</header>
						<div class="card-box">
							<div class="row">
								<form class="form-horizontal" method="post" name="logoForm" id="myform" onsubmit="setTimeout(function () { location.href = '<?php echo base_url(); ?>purchaseorder';},2000)" action="<?php echo base_url(); ?>purchaseorder/insert" data-parsley-validate novalidate><!---->
									<input type="hidden" class="form-control" name="purchaseorderno" id="purchaseorderno" value="<?php echo $invoiceno; ?>"
										readonly>
									<input type="hidden" id="discountBy" name="hiddenDiscountBy" value="<?php echo $discountBy; ?>" />
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-12 row">
													<div class="col-md-2">
														<label>Date</label>
														<input type="text" class="form-control datepicker-autoclose" name="purchasedate" parsley-trigger="change" id="datepicker-autoclose" required value="<?php echo date('d-m-Y'); ?>">
													</div>

													<input type="hidden" name="potype" id="potype" value="Direct PO" />
													<!--<div class="col-md-2">
<label>PO Type</label>
<select  class="form-control" parsley-trigger="change" required name="potype" id="potype" >
<option value="Direct PO">Direct PO</option>
<option value="BOM">BOM</option>
</select>
</div>-->

													<div class="col-md-6">
														<div class="form-group">
															<label>Customer Name </label>
															<input type="text" class="form-control" parsley-trigger="change" required name="customername" id="customername" value="">
															<input type="hidden" class="form-control" name="customerid" id="customerid" value="">
															<div id="cusname_valid" style="position: absolute;">
															</div>
														</div>
													</div>

													<!-- <div class="col-md-4">
<label>GST Type</label>
<select  class="form-control" parsley-trigger="change" required name="gsttype" id="gsttype" >
<option value="intrastate" selected>INTRA-STATE</option>
<option value="interstate">INTER-STATE</option>
</select>
</div> -->


													<div class="col-md-4">
														<label>GST Type</label>

														<input type="text" name="gsttype" id="gsttype" class="form-control" readonly>
													</div>


												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Customer Work Order No </label>
													<input type="text" class="form-control" parsley-trigger="change" required name="purchaseorder" id="purchaseorder" value="">
													<div id="purchaseorder_valid" style="position: absolute;"></div>
												</div>
											</div>
											<div class="col-md-3">
												<label>Work Order Date</label>
												<input type="text" auotocomplete="off" class="form-control datepicker-autoclose" required name="invoicedate" id="invoicedate" value="<?php echo date('d-m-Y'); ?>">
											</div>


											<div class="col-md-3">
												<label>Delivery Date</label>
												<input type="text" auotocomplete="off" class="form-control datepicker-autoclose" required name="deliverydate" id="deliverydate" value="<?php echo date('d-m-Y'); ?>">
											</div>

										</div>

										<div class="col-md-4">
											<label>Address</label>
											<textarea type="text" class="form-control" readonly name="address" id="address" required rows="4"></textarea>
										</div>
									</div>
									<div class="clearfix">
										<hr />
									</div>


									<div id="inwarddetailsss"></div>
									<?php
									$itemcode = $this->db->select('itemcode')->where('id', 1)->get('preference_settings')->row()->itemcode;
									$hidden = '';
									if ($itemcode == '') {
										$hidden = 'hidden';
									}

									$discountBy = $this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
									if ($discountBy == 'percent_wise') {
										$discType = '%';
									} else {
										$discType = '';
									}
									?>
									<div class="table-responsive myform directPurchaseDet">
										<table class="table two">
											<thead>
												<tr>
													<th -style="width:70px">HSN Code</th>
													<th -style="width:70px">Product Code</th>
													<th style="width:150px;color:red">Item Name <a target="_blank" href="<?php echo base_url(); ?>itemmaster">(Add Item)</a></th>
													<th -style="width:50px">Drawing No</th>
													<th -style="width:50px">Grade</th>
													<th -style="width:50px">Qty</th>
													<th -style="width:50px">UOM</th>
													<th -style="width:50px">Weight</th>
													<th -style="width:70px">Rate</th>
													<th -style="width:100px">Amount</th>
													<th -style="width:40px">Disc <?php if ($discountBy == 'percent_wise') {
																						echo '%';
																					} ?></th>
													<th -style="width:110px">Total</th>
													<th style="width:10px">&nbsp;</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input class="" id="hsnno0" parsley-trigger="change" required readonly type="text" name="hsnno[]" value="">
														<div id="hsnno_valid0"></div>
													</td>


													<td><input class="itemcode_class" data-id="0" id="itemcode0" parsley-trigger="change" required type="text" name="itemcode[]" value="">
														 <input type="hidden" data-id="0" name="itemid[]" id="itemid0" class="form-control"><div id="itemcode_valid0"></div>
													</td>

													<td><input class="itemname_class" style="width: 250px;" data-id="0" id="itemname0" parsley-trigger="change" required type="text" name="itemname[]" value="">
														<div id="itemname_valid0"></div><input type="text" name="item_desc[]" value="" placeholder="Description" style="margin-top: 2px;"><input type="hidden" name="priceType[]" id="priceType0" />
													</td>

													<td><input class="" data-id="0" id="drawingno0" parsley-trigger="change" required type="text" name="drawingno[]" value=""></td>

													<td><select name="grade[]" id="grade0" data-id="0" class="form-control grade_class" style="width: 120px;">
															<option value="">Select Grade</option>
															<?php foreach ($grade as $g) { ?>
																<option value="<?php echo $g->id; ?>"><?php echo $g->grade; ?></option>

															<?php } ?>


														</select></td>

													<td><input class="qty_class decimals" data-id="0" id="qty0" parsley-trigger="change" required type="text" name="qty[]" autocomplete="off"><input class="" id="qtys0" type="hidden" name="qtys[]">
														<div id="qty_valid0"></div>
													</td>

													<td><input class="" id="uom0" parsley-trigger="change" required readonly type="text" name="uom[]" autocomplete="off"></td>

													<td><input class="weight_class" id="weight0" data-id="0" parsley-trigger="change" required type="text" name="weight[]" autocomplete="off"></td>

													<td><input class="rate_class decimals" data-id="0" parsley-trigger="change" required id="rate0" type="text" name="rate[]" autocomplete="off">
														<div id="rate_valid0"></div>
													</td>

													<td><input class="decimals" id="amount0" parsley-trigger="change" required readonly type="text" name="amount[]" value="" autocomplete="off">
														<div id="amount_valid0"></div>
													</td>

													<td><input class="discount_class decimals" data-id="0" id="discount0" type="text" name="discount[]" maxlength="2" onkeypress="return isNumberKey_With_Dot(event)" value="0" autocomplete="off">
														<div id="discount_valid0"></div>
													</td>

													<td><input class="decimals" id="taxableamount0" readonly type="text" name="taxableamount[]" value="" autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount0"></td>


													<td style="width:10px;">&nbsp;</td>
													<td style="width:10px;">&nbsp;</td>
													<td>
														<div class="col-sm-offset-11">
															<button type="button" class="btn btn-info add pull-right"><i class="fa fa-plus"></i></button>
															<input type="hidden" id="hide" value="1">
														</div>
													</td>
												</tr>
											</tbody>
											<tbody id="append"></tbody>
										</table>
									</div>


									<!-- 
<div class="col-sm-offset-8">
<label class="col-sm-7 control-label" >Sub Total</label>
<div class="col-sm-5">
<input class="form-control" style="background-color: #eee !important;"  type="text" name="subtotal" id="subtotal" readonly  placeholder="0" value="0">
</div>
</div>
<br>
<br>    -->


									<!-- <div class="col-sm-offset-8">
<label class="col-sm-7  control-label" >Frieght Charges</label>
<div class="col-sm-5">
<input class="form-control decimals"  type="text" name="freightamount" id="freightamount"  value="0">
</div>
</div>
<br>
<br>   -->


									<!-- <div class="clearfix"></div>
<div class="col-sm-offset-8">
<label class="col-sm-7  control-label" >Loading & Packing Charges</label>
<div class="col-sm-5">
<input class="form-control decimals"  type="text" name="loadingamount" id="loadingamount"   value="0">
</div>
</div>
<br>
<br>  -->


									<!-- 
<div class="clearfix"></div>
<div class="sgst col-sm-offset-8">
<label class="sgst col-sm-5  control-label" >CGST </label>
<div class="col-sm-2">
<input class="sgst decimals form-control" required  type="text" name="cgst" id="cgst"  value="">
</div>
<div class="col-sm-5">
<input class="sgst decimals form-control"  required type="text" readonly name="cgstamount" id="cgstamount"   placeholder="0">
</div>
</div> -->

									<!-- <div class="clearfix"></div> 
<div class="sgst col-sm-offset-8">
<label class="sgst col-sm-5 control-label"  >SGST </label>
<div class="col-sm-2">
<input class="sgst decimals form-control"  type="text" required readonly name="sgst" id="sgst"  value="">
</div>
<div class="col-sm-5">
<input class="sgst decimals form-control"  type="text" required readonly name="sgstamount" id="sgstamount"   placeholder="0">
</div>
</div> -->

									<!-- 
<div class="clearfix"></div> 
<div class="col-sm-offset-8">
<label class="igst  col-sm-5 control-label" >IGST </label>
<div class="col-sm-2">
<input class="igst decimals form-control"  required type="text"  name="igst" id="igst"  value="">
</div>
<div class="col-sm-5">
<input class="igst decimals form-control" readonly required type="text" name="igstamount" id="igstamount"   placeholder="0">
</div>
</div> -->


									<!-- <div class="col-sm-offset-8">
<label class="col-sm-7  control-label" >Round Off</label>
<div class="col-sm-5">
<input class="form-control decimals"  type="text" name="roundOff" id="roundOff"   placeholder="0" value="0" onfocus="if(this.value == '0') { this.value = ''; }" onblur="if(this.value == '') { this.value = '0'; }">
</div>
</div>
<br>
<br>    -->


									<!-- <div class="clearfix"></div>
<div class=" col-sm-offset-8">
<label class="col-sm-7  control-label" >Invoice Total</label>
<div class="col-sm-5">
<input class="form-control" readonly type="text" style="background-color: #eee !important;"  name="grandtotal" id="grandtotal" >
</div>                      
</div> -->

									<div class="clearfix"></div>



									<br><br><br>


									<div class="clearfix"></div>

									<div class="col-sm-offset-4">
										<button class="btn btn-info" name="save" id="submit">Add Work Order</button>
										<!--<button  class="btn btn-default" type="submit"  name="print" id="print" value="print">Print Purchase Order</button>-->
									</div>
								</form>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div><!-- end col -->
	</div>
</div>
<script>
	var resizefunc = [];
</script>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/multiselect/js/bootstrap-select.js"></script>
<script type="text/javascript">
	$("#print").click(function(event) {
		//alert("not enguage item");
		$("#myform").attr("target", "_blank");
	});

	// $(document).ready(function() {

	// $('#purchaseorder').keyup(function(){
	// var name = $('#customername').val();
	// var pono = $('#purchaseorder').val();
	// $.post('<?php echo base_url(); ?>purchaseorder/getpono',{pono:pono,name:name},function(res){
	// if(res > 0)
	// {
	// $('#purchaseorder_valid').html('<span><font color="green">Pono Already Taken!</span>');
	// $('#submit').attr('disabled',true);
	// $('#print').attr('disabled',true);
	// }
	// else {
	// $('#purchaseorder_valid').html('<span><font color="green">Available!</span>');
	// $('#submit').attr('disabled',false);
	// $('#print').attr('disabled',false);
	// }

	// });
	// });
	// var gotVal = $('#potype').val();
	// getDetails(gotVal);
	// $('#potype').change(function(){
	// getDetails($(this).val());
	// });
	// $('form').parsley();
	// $("input").keyup(function(){
	// $(this).parent().removeClass('has-error');
	// $(this).next().empty();
	// });
	// $('#bomsearch').click(function(){
	// var selected_bom=$('#selected_bom').val();
	// if(selected_bom=='null')
	// {
	// alert('Please Select BOM No');
	// $('#selected_bom').focus();
	// }
	// else
	// {
	// $.post('<?php echo base_url(); ?>purchaseorder/getbomdetails',{'selected_bom':selected_bom},function(data){
	// $('#inwarddetails').html(data);
	// call_keyup();
	// });
	// }
	// });
	// });
	// function getDetails(gotVal)
	// {

	// if(gotVal=='Direct PO')
	// {
	// $.post('<?php echo base_url(); ?>purchaseorder/getaddpurchasedetails',{'jobOrder':'jobOrder'},function(data){
	// $('#inwarddetails').html(data);
	// call_keyup();

	// });
	// $('#inwarddetails').html('');
	// $('.bomClass').hide();
	// $('.directPurchaseDet').show();
	// $("#selected_bom").removeAttr('data-live-search').removeAttr('data-actions-box').removeAttr('data-parsley-required').parsley().destroy();
	// $('.add').show();
	// /*$("input[name=cusname]").attr('data-parsley-required', 'true').parsley();
	// $("input[name=vendorname]").css('display', 'block').removeAttr('data-parsley-required').parsley();//.destroy();
	// */
	// }
	// else
	// {
	// $.ajax({
	// type: "POST",
	// url: "<?php echo base_url(); ?>purchaseorder/get_bomno",
	// data:{vendors:'vendors'}, 
	// beforeSend :function(){
	// $("#selected_bom option:gt(0)").remove(); 
	// $('#selected_bom').selectpicker('refresh');
	// $('#selected_bom').find("option:eq(0)").html("Please wait..");
	// $('#selected_bom').selectpicker('refresh');
	// },                         
	// success: function (data) {   
	// $('#selected_bom').selectpicker('refresh');       
	// $('#selected_bom').find("option:eq(0)").html("");
	// $('#selected_bom').selectpicker('refresh');
	// var obj=jQuery.parseJSON(data);       
	// $('#selected_bom').selectpicker('refresh');
	// $(obj).each(function(){
	// var option = $('<option />');
	// option.attr('value', this.value).text(this.label);           
	// $('#selected_bom').append(option);
	// });       
	// $('#selected_bom').selectpicker('refresh');
	// }
	// });
	// //$("input[name=cusname]").css('display', 'block').removeAttr('data-parsley-required').parsley();//.destroy();
	// //$("input[name=vendorname]").attr('data-parsley-required','true').parsley();
	// $('.bomClass').show();
	// $('.directPurchaseDet').hide();
	// $("#selected_bom").attr('data-live-search','true').attr('data-actions-box','true').attr('data-parsley-required','true').parsley();
	// $('#selected_bom').selectpicker();$('#selected_bom').val('').selectpicker('refresh');
	// $('.add').hide();

	// }
	// }
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

	$(document).ready(function() {
		call_keyup();

		$('#gsttype').change(function() {
			var gsttype = $('#gsttype').val();
			console.log(gsttype);
			if (gsttype == 'interstate') {
				$('.sgst').hide();
				$('.igst').show();
				$('#sgst').attr('required', false);
				$('#sgstamount').attr('required', false);
				$('#cgst').attr('required', false);
				$('#cgstamount').attr('required', false);
			} else if (gsttype == 'intrastate') {
				$('.sgst').show();
				$('.igst').hide();
				$('#igst').attr('required', false);
				$('#igstamount').attr('required', false);
			} else if (gsttype == 'export') {
				$('.sgst').hide();
				$('.igst').hide();
				$('#igst').attr('required', false);
				$('#igstamount').attr('required', false);
			}
		});

		$("#customername").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: "<?php echo base_url(); ?>invoice/autocomplete_customername",
					data: {
						keyword: $("#customername").val()
					},
					dataType: "json",
					type: "POST",
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				$("#customername").val(ui.item.label);
				$('#address').val(ui.item.address);
				$('#tinno').val(ui.item.tinno);
				$('#cstno').val(ui.item.cstno);
				if (ui.item.type == "Intra customer") {
					$('#gsttype').val('intrastate');
					var gsttypes = 'intrastate';
				} else if (ui.item.type == "Inter customer") {
					$('#gsttype').val('interstate');
					var gsttypes = 'interstate';
				}

				$('#customerid').val(ui.item.customerid);


				if (gsttypes == 'interstate') {
					$('.sgst').hide();
					$('.igst').show();
					$('#sgst').attr('required', false);
					$('#sgstamount').attr('required', false);
					$('#cgst').attr('required', false);
					$('#cgstamount').attr('required', false);
				} else if (gsttypes == 'intrastate') {
					$('.sgst').show();
					$('.igst').hide();
					$('#igst').attr('required', false);
					$('#igstamount').attr('required', false);
				}
				var name = $('#customername').val();
				if (name != '') {
					$.post('<?php echo base_url(); ?>invoice/getcustomer', {
						name: name
					}, function(res) {
						if (res > 0) {
							$('#cusname_valid').html('<span><font color="green">Available!</span>');
							$('#submit').attr('disabled', false);
							$('#print').attr('disabled', false);
						} else {
							$('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
							$('#submit').attr('disabled', true); //set button enable 
							$('#print').attr('disabled', true); //set button enable 
							//set button enable     
						}
					});
					return false;
				}
			}
		});

		$('#customername').keyup(function() {
			var name = $('#customername').val();
			if (name != '') {
				$.post('<?php echo base_url(); ?>invoice/getcustomer', {
					name: name
				}, function(res) {
					if (res > 0) {
						$('#cusname_valid').html('<span><font color="green">Available!</span>');
						$('#submit').attr('disabled', false);
						$('#print').attr('disabled', false);
					} else {
						$('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
						$('#submit').attr('disabled', true); //set button enable 
						$('#print').attr('disabled', true); //set button enable 
						//set button enable     
					}
				});
				return false;
			}
		});


		$('#suppliername').blur(function() {
			var name = $(this).val();
			if (name != '') {
				$.post('<?php echo base_url(); ?>purchase/get_supplier', {
					name: name
				}, function(res) {
					if (res > 0) {
						$('#cusname_valid').html('<span><font color="green">Available!</span>');
						$('#submit').attr('disabled', false);
						$('#print').attr('disabled', false);
					} else {
						$('#suppliername').focus();
						$('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
						$('#submit').attr('disabled', true); //set button enable 
						$('#print').attr('disabled', true); //set button enable 
						//set button enable     
					}
				});
				return false;
			}
		});


		var gsttype = $('#gsttype').val();
		if (gsttype == 'interstate') {
			$('.sgst').hide();
			$('.igst').show();
			$('#sgst').attr('required', false);
			$('#sgstamount').attr('required', false);
			$('#cgst').attr('required', false);
			$('#cgstamount').attr('required', false);
		} else if (gsttype == 'intrastate') {
			$('.sgst').show();
			$('.igst').hide();
			$('#igst').attr('required', false);
			$('#igstamount').attr('required', false);
		}


		$('.add').click(function() {
			var start = $('#hide').val();
			console.log(start);
			var total = Number(start) + 1;
			$('#hide').val(total);
			var tbody = $('#append');


			var mod = $('#gsttype').val();
			var samples, samples1;
			if (mod == 'intrastate') {
				samples = "none";
				samples1 = "nones";
			} else {
				samples = "nones";
				samples1 = "none";
			}

			<?php
			$itemcode = $this->db->select('itemcode')->where('id', 1)->get('preference_settings')->row()->itemcode;
			$hidden = '';
			if ($itemcode == '') {
				$hidden = 'hidden';
			}
			?>

			$(' <tr>' +
				'<td><input class="" id="hsnno' + total + '" readonly type="text" name="hsnno[]" value=""><div id="hsnno_valid' + total + '"></div></td>'

				+
				'<td><input class="itemcode_class" data-id="' + total + '" id="itemcode' + total + '" type="text" name="itemcode[]" value=""><input type="hidden" data-id="' + total + '" name="itemid[]" id="itemid' + total + '" class="form-control"><div id="itemcode_valid' + total + '"></div></td>'

				+
				'<td><input class="itemname_class" data-id="' + total + '"  parsley-trigger="change" required id="itemname' + total + '"  type="text" name="itemname[]" value=""><div id="itemname_valid' + total + '"></div><input placeholder="Description" type="text" name="item_desc[]" value="" style="margin-top: 2px;" ><input type="hidden" name="priceType[]" id="priceType' + total + '" /></td>'

				+
				'<td><input class="" data-id="' + total + '" id="drawingno' + total + '" parsley-trigger="change" required type="text" name="drawingno[]" value=""></td>'

				+
				'<td><select name="grade[]" id="grade' + total + '" data-id="' + total + '" class="form-control grade_class"style="width: 120px;"><option value="">Select Grade</option><?php foreach ($grade as $g) { ?><option value="<?php echo $g->id; ?>"><?php echo $g->grade; ?></option><?php } ?></select></td>' +
				'<td><input class="qty_class decimals" data-id="' + total + '" id="qty' + total + '"    parsley-trigger="change" required type="text" name="qty[]"  autocomplete="off"><div id="qty_valid' + total + '"></div><input class="" id="qtys' + total + '" type="hidden" name="qtys[]"></td>' +
				'<td><input class="" readonly id="uom' + total + '" type="text" name="uom[]"   autocomplete="off"></td>' +
				'<td><input class="weight_class" data-id="' + total + '"  id="weight' + total + '" type="text" name="weight[]"   autocomplete="off"></td>' +
				'<td><input class="rate_class decimals" data-id="' + total + '" id="rate' + total + '"  type="text" name="rate[]" required autocomplete="off"><div id="rate_valid' + total + '"></div></td>' +
				'<td><input class="decimals" id="amount' + total + '" readonly type="text" name="amount[]" value=""  autocomplete="off"><input type="hidden" name="gstcal[]" id="gstcal' + total + '" value=""></td>' +
				'<td><input class="discount_class decimals" data-id="' + total + '" id="discount' + total + '"  type="text" name="discount[]" maxlength="2" value="0"  autocomplete="off"  onkeypress="return isNumberKey_With_Dot(event)"></td>' +
				'<td><input class="decimals" id="taxableamount' + total + '" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount' + total + '"></td>'
				// +'<td class="sgst" style="display:'+samples1+';"><input class="decimals" readonly id="cgst'+total+'"  type="text" name="cgst[]" value="" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="cgst_valid'+total+'"></div></td>'
				// +'<td class="sgst" style="display:'+samples1+';"><input class="decimals" id="cgstamount'+total+'"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>'
				// +'<td class="sgst" style="display:'+samples1+';"><input class="decimals" id="sgst'+total+'"  type="text" name="sgst[]" readonly value=""  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid'+total+'"></div></td>'
				// +'<td class="sgst" style="display:'+samples1+';"><input class="decimals" id="sgstamount'+total+'"  type="text" name="sgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>'
				// +'<td class="igst" style="display:'+samples+';"><input class="decimals" id="igst'+total+'"  type="text" name="igst[]"  readonly onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid'+total+'"></div></td>'
				// +'<td class="igst" style="display:'+samples+';"><input class="decimals" id="igstamount'+total+'" readonly type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>'
				//+'<td><input class="" id="total'+total+'" type="text" name="total[]" value=""  readonly ></td>'
				+
				'<td style="width: 10px;"><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td></tr>').appendTo(tbody);
			call_keyup();



		});
	});
</script>

<script type="text/javascript">
	$('#document').ready(function() {
		$('#checkbox').click(function() {
			if ($(this).prop("checked") == true) {
				$('#check').show();
				$('#imaddress').show();

			} else if ($(this).prop("checked") == false) {
				$('#check').hide();
				$('#imaddress').hide();
			}
		});
	});


	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}

	function isNumber(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}

	function onlyAlphabets(evt) {
		var charCode;
		if (window.event)
			charCode = window.event.keyCode; //for IE
		else
			charCode = evt.which; //for firefox
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

	function isNumberKey_With_Dot(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			if (charCode == 46)
				return true;
			else
				return false;
		} else
			return true;
	}


	function call_keyup() {
		$('.decimals').keyup(function() {
			var val = $(this).val();
			if (isNaN(val)) {
				val = val.replace(/[^0-9\.-]/g, '');
				if (val.split('.').length > 2)
					val = val.replace(/\.-+$/, "");
			}
			$(this).val(val);
		});

		//Grade Change Function

		$('.grade_class').change(function() {
			var total = $(this).attr('data-id');
			var grade = $(this).val();
			$.post('<?php echo base_url(); ?>Purchase/get_hsnnos', {
				grade: grade
			}, function(datas) {
				var obj = jQuery.parseJSON(datas);

				$('#hsnno' + total).val(obj.hsnno);
			});

		});

		$(".itemcode_class").keyup(function() {
			var total = $(this).attr('data-id');
			$("#itemcode" + total).autocomplete({
				source: function(request, response) {
					$.ajax({
						url: "<?php echo base_url(); ?>purchase/autocomplete_itemcode",
						data: {
							keyword: $("#itemcode" + total).val()
						},
						dataType: "json",
						type: "POST",
						success: function(data) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					var name = ui.item.value;
					$('#itemcode' + total).val(ui.item.value);
					$.post('<?php echo base_url(); ?>purchase/get_itemcodes', {
						name: name
					}, function(rest) {
						var obj = jQuery.parseJSON(rest);

						$('#itemname' + total).val(obj.itemname);
						// $('#itemcode' + total).val(obj.itemcode);
						$('#rate' + total).val(obj.price);
						$('#sgst').val(obj.sgst);
						$('#cgst').val(obj.cgst);
						$('#igst').val(obj.igst);
						$('#uom' + total).val(obj.uom);
						$('#weight' + total).val(obj.weight);
						$('#drawingno' + total).val(obj.drawingno)
						$('#qty' + total).val('');
						$('#qty' + total).focus();
					});
					if (name != '') {
						$.post('<?php echo base_url(); ?>invoice/getss', {
							name: name
						}, function(res) {
							if (res > 0) {
								$('#itemcode_valid' + total).html('<span><font color="green">Available!</span>');
								$('#submit').attr('disabled', false);
								$('#print').attr('disabled', false);
							} else {
								$('#itemcode_valid' + total).html('<span><font color="red"> Not Available !</span>');
								$('#submit').attr('disabled', true); //set button enable 
								$('#print').attr('disabled', true); //set button enable 
								//set button enable     
							}
						});
						return false;
					}
				}
			});
		});

		$(".itemname_class").keyup(function() {
			var total = $(this).attr('data-id');
			$("#itemname" + total).autocomplete({
				source: function(request, response) {
					$.ajax({
						url: "<?php echo base_url(); ?>purchase/autocomplete_itemname",
						data: {
							keyword: $("#itemname" + total).val()
						},
						dataType: "json",
						type: "POST",
						success: function(data) {
							response(data);
						}
					});
				},
				select: function(event, ui) {
					var name = ui.item.value;
					$('#itemname' + total).val(ui.item.value);
					$.post('<?php echo base_url(); ?>purchase/get_itemnames', {
						name: name
					}, function(rest) {
						var obj = jQuery.parseJSON(rest);


						$('#itemcode' + total).val(obj.itemcode);
						$('#itemid' + total).val(obj.itemid);
						$('#priceType' + total).val(obj.priceType);
						$('#rate' + total).val(obj.price);
						$('#drawingno' + total).val(obj.drawingno);
						$('#weight' + total).val(obj.weight);

						$('#uom' + total).val(obj.uom);
						$('#qty' + total).val('');
						$('#qty' + total).focus();
					});
					if (name != '') {
						$.post('<?php echo base_url(); ?>invoice/gets', {
							name: name
						}, function(res) {
							if (res > 0) {
								$('#itemname_valid' + total).html('<span><font color="green">Available!</span>');
								$('#submit').attr('disabled', false);
								$('#print').attr('disabled', false);
							} else {
								$('#itemname_valid' + total).html('<span><font color="red"> Not Available !</span>');
								$('#submit').attr('disabled', true); //set button enable 
								$('#print').attr('disabled', true); //set button enable 
								//set button enable     
							}
						});
						return false;
					}
				}
			});
		});

		$('.qty_class').keyup(function() {
			var totalqty = 0;
			$('input[name^="qty"]').each(function() {
				totalqty += Number($(this).val());
				var fina = totalqty.toFixed(2);
				$('#totalqty').val(fina);
				//$('#grandtotal').val(fina); 

				//var tot=parseFloat(totalqty)+parseFloat(loadingamount)+parseFloat(freightamount);
			});

			var rowNumber = $(this).attr('data-id');
			var priceType = $("#priceType" + rowNumber).val();
			var qty = $('#qty' + rowNumber + '').val();
			var qtys = $('#qtys' + rowNumber + '').val();
			var checkInvoiceType = '<?php echo $checkInvoiceType; ?>';
			if (checkInvoiceType == 'without_stock') {
				if (qty == '') {
					$('#qty_valid' + rowNumber + '').html('<span><font color="red">Invalid Qty!</span>');
					$('#qty' + rowNumber + '').val();
				} else {
					if (priceType == "Inclusive") {
						Inc_amount_calculation(rowNumber);
					} else {
						amount_calculation(rowNumber);
					}
					totalAmt_calculation();
				}
			} else {
				if (parseFloat(qty) > parseFloat(qtys)) {
					alert('Only ' + qtys + ' quantities are available!');
					$('#qty_valid' + rowNumber + '').html('<span><font color="red">Invalid Qty!</span>');
					$('#qty' + rowNumber + '').val('0');

				} else {
					if (priceType == "Inclusive") {
						Inc_amount_calculation(rowNumber);
					} else {
						amount_calculation(rowNumber);
					}
					totalAmt_calculation();
				}
			}

		});
		//RATE CHANGE FUNCTION
		$('.rate_class').keyup(function() {
			var rowNumber = $(this).attr('data-id');
			var priceType = $("#priceType" + rowNumber).val();
			var rate = $('#rate' + rowNumber + '').val();
			$('#rate_valid' + rowNumber + '').html('');

			if (parseFloat(rate) > 0) {
				if (priceType == "Inclusive") {
					Inc_amount_calculation(rowNumber);
				} else {
					amount_calculation(rowNumber);
				}
				//frieght_calculation();
				totalAmt_calculation();
			} else {
				$('#rate_valid' + rowNumber + '').html('<span><font color="red">Invalid Rate !</span>');
				$('#rate_valid' + rowNumber + '').val('');
			}
		});

		//Weight Change Function

		$('.weight_class').keyup(function() {
			var rowNumber = $(this).attr('data-id');
			var priceType = $("#priceType" + rowNumber).val();
			var weight = $('#weight' + rowNumber + '').val();
			$('#weight_valid' + rowNumber + '').html('');

			if (parseFloat(weight) > 0) {
				if (priceType == "Inclusive") {
					Inc_amount_calculation(rowNumber);
				} else {
					amount_calculation(rowNumber);
				}
				//frieght_calculation();
				totalAmt_calculation();
			} else {
				$('#weight_valid' + rowNumber + '').html('<span><font color="red">Invalid Rate !</span>');
				$('#weight_valid' + rowNumber + '').val('');
			}
		});
		// DISCOUNT CHANGE FUNCTION
		$('.discount_class').keyup(function() {
			var rowNumber = $(this).attr('data-id');
			var priceType = $("#priceType" + rowNumber).val();
			$('#discount_valid' + rowNumber + '').html('');
			var discount = $('#discount' + rowNumber + '').val();
			if (discount != '') {
				if (priceType == "Inclusive") {
					Inc_amount_calculation(rowNumber);
				} else {
					amount_calculation(rowNumber);
				}
				//frieght_calculation();
				totalAmt_calculation();
			} else {
				$('#discount_valid' + rowNumber + '').html('<span><font color="red">Invalid Discount !</span>');
				$('#discount_valid' + rowNumber + '').val('');
			}
		});
		//calculation--------------------------------------------------

		$('#freightamount').keyup(function() {

			totalAmt_calculation();
		});

		$('#loadingamount').keyup(function() {
			totalAmt_calculation();
		});


		$('#roundOff').keyup(function() {
			totalAmt_calculation();
		});

		$('#othercharges').keyup(function() {
			totalAmt_calculation();
		});

		$('.sgst').keyup(function() {
			var cgst = $('#cgst').val();
			$('#sgst').val(cgst);
			totalAmt_calculation();
		});

		$('.igst').keyup(function() {

			totalAmt_calculation();
		});

		$('.remove').click(function() {
			$(this).parents('tr').remove();
			totalAmt_calculation(total);
		});
	}


	function amount_calculation(rowNumber) {
		var qty = $('#qty' + rowNumber).val();
		var rate = $('#rate' + rowNumber).val();
		var weight = $('#weight' + rowNumber).val();

		if (qty != '' && rate != '' && weight != '')
			var amo = parseFloat(rate) * parseFloat(qty) * parseFloat(weight);
		var amou = amo.toFixed(2);
		$('#amount' + rowNumber).val(amou);
		$('#taxableamount' + rowNumber).val(amou);
		$('#total' + rowNumber).val(amou);

		var discount = $('#discount' + rowNumber).val();
		var taxableamount = $('#taxableamount' + rowNumber).val();
		var gsttype = $('#gsttype').val();
		var discountBy = $("#discountBy").val();
		var a = 0;
		var b = 0;
		var c = 0;
		var d = 0;
		var e = 0;
		var f = 0;
		var g = 0;
		var h = 0;
		var i = 0;
		var j = 0;
		var k = taxableamount;
		var l = 0;

		if (discount != '') {
			if (discountBy == 'percent_wise') {
				a = ((parseFloat(amo) * parseFloat(discount)) / 100);
				var a1 = a.toFixed(2);
				var a2 = parseFloat(amo) - parseFloat(a1);
				var a3 = a2.toFixed(2);
				var discountamount = a1;
				taxableamount = a3;
			} else {
				a = (parseFloat(amo) - parseFloat(discount));
				var discountamount = discount;
				//alert(discountamount);
				taxableamount = a.toFixed(2);
			}
			$('#discountamount' + rowNumber).val(discountamount);
			$('#taxableamount' + rowNumber).val(taxableamount);
			$('#total' + rowNumber).val(k);
		}
		k = taxableamount;

	}

	if (gsttype == 'intrastate') {
		//alert();
		if (cgst > 0) {
			//alert(cgst);
			var divideBy = parseFloat(igst) + 100;
			b = ((parseFloat(k) * parseFloat(igst)) / divideBy) / 2;
			var b1 = b.toFixed(2);
			$('#cgstamount').val(b1);
			var b2 = parseFloat(k) - parseFloat(b);
			var b3 = b2.toFixed(2);
			$('#amount' + total + '').val(b3);
			var totalVal = (parseFloat(b3) + parseFloat(b)).toFixed(2);
			$("#total" + total).val(totalVal);
		}

		if (sgst > 0) {
			var divideBy = parseFloat(igst) + 100;
			c = ((parseFloat(k) * parseFloat(igst)) / divideBy) / 2;
			var c1 = c.toFixed(2);
			$('#sgstamount').val(c1);
			var c2 = parseFloat(k) - (parseFloat(b) + parseFloat(c));
			var c3 = c2.toFixed(2);
			$('#amount' + total + '').val(c3);
			var totalVal = (parseFloat(c3) + (parseFloat(b) + parseFloat(c))).toFixed(2);
			$("#total" + total).val(totalVal);
		}
	} else if (gsttype == 'interstate') {
		if (igst > 0) {
			var divideBy = parseFloat(igst) + 100;
			d = ((parseFloat(k) * parseFloat(igst)) / divideBy);
			//alert(k+'*'+igst+'/'+divideBy+'\n'+d);
			var d1 = d.toFixed(2);
			$('#igstamount').val(d1);
			var d2 = parseFloat(k) - parseFloat(d);
			var d3 = d2.toFixed(2);
			$('#amount' + total + '').val(d3);
			var totalVal = (parseFloat(d3) + parseFloat(d)).toFixed(2);
			$("#total" + total).val(totalVal);
		}
	}

	function Inc_amount_calculation(total) {
		var qty = $('#qty' + total).val();
		var rate = $('#rate' + total).val();

		if (qty != '' && rate != '')
			var amo = parseFloat(rate) * parseFloat(qty);
		var amou = amo.toFixed(2);

		var discount = $('#discount' + total).val();
		var gsttype = $('#gsttype').val();
		var discountBy = $("#discountBy").val();
		var a = 0;
		var b = 0;
		var c = 0;
		var d = 0;
		var e = 0;
		var f = 0;
		var g = 0;
		var h = 0;
		var i = 0;
		var j = 0;
		var k = 0;
		var l = 0;
		var taxableamount = 0;
		var discountamount = 0;
		taxableamount = amou;

		if (discount != '') {
			if (discountBy == 'percent_wise') {
				a = ((parseFloat(amo) * parseFloat(discount)) / 100);
				var a1 = a.toFixed(2);
				var a2 = parseFloat(amo) - parseFloat(a1);
				var a3 = a2.toFixed(2);
				var discountamount = a1;
				taxableamount = a3;

			} else {

				a = (parseFloat(amo) - parseFloat(discount));
				var discountamount = discount;
				taxableamount = a.toFixed(2);
			}
		}
		k = taxableamount;
		$('#discountamount' + total + '').val(discountamount);
		$('#taxableamount' + total + '').val(taxableamount);
	}
	if (gsttype == 'intrastate') {
		//alert();
		if (cgst > 0) {
			//alert(cgst);
			var divideBy = parseFloat(igst) + 100;
			b = ((parseFloat(k) * parseFloat(igst)) / divideBy) / 2;
			var b1 = b.toFixed(2);
			$('#cgstamount').val(b1);
			var b2 = parseFloat(k) - parseFloat(b);
			var b3 = b2.toFixed(2);
			$('#amount' + total + '').val(b3);
			var totalVal = (parseFloat(b3) + parseFloat(b)).toFixed(2);
			$("#total" + total).val(totalVal);
		}

		if (sgst > 0) {
			var divideBy = parseFloat(igst) + 100;
			c = ((parseFloat(k) * parseFloat(igst)) / divideBy) / 2;
			var c1 = c.toFixed(2);
			$('#sgstamount').val(c1);
			var c2 = parseFloat(k) - (parseFloat(b) + parseFloat(c));
			var c3 = c2.toFixed(2);
			$('#amount' + total + '').val(c3);
			var totalVal = (parseFloat(c3) + (parseFloat(b) + parseFloat(c))).toFixed(2);
			$("#total" + total).val(totalVal);
		}
	} else if (gsttype == 'interstate') {
		if (igst > 0) {
			var divideBy = parseFloat(igst) + 100;
			d = ((parseFloat(k) * parseFloat(igst)) / divideBy);
			//alert(k+'*'+igst+'/'+divideBy+'\n'+d);
			var d1 = d.toFixed(2);
			$('#igstamount').val(d1);
			var d2 = parseFloat(k) - parseFloat(d);
			var d3 = d2.toFixed(2);
			$('#amount' + total + '').val(d3);
			var totalVal = (parseFloat(d3) + parseFloat(d)).toFixed(2);
			$("#total" + total).val(totalVal);
		}
	}


	function totalAmt_calculation() {
		var freightamount = $('#freightamount').val();
		if (freightamount == '') {
			freightamount = 0;
		}
		var loadingamount = $('#loadingamount').val();
		if (loadingamount == '') {
			loadingamount = 0;
		}
		var cgstamount = $('#cgstamount').val();
		if (cgstamount == '') {
			cgstamount = 0;
		}
		var sgstamount = $('#sgstamount').val();
		if (sgstamount == '') {
			sgstamount = 0;
		}
		var igstamount = $('#igstamount').val();
		if (igstamount == '') {
			igstamount = 0;
		}
		var roundOff = $('#roundOff').val();
		var gsttype = $('#gsttype').val();
		var cgst = $('#cgst').val();
		var sgst = $('#sgst').val();
		var igst = $('#igst').val();
		var sub_tot = 0;
		var s = 0;
		var p = 0;
		var m = 0;
		var m1 = 0;
		var n = 0;
		var n1 = 0;
		var l = 0;
		var l1 = 0;
		$('input[name^="taxableamount"]').each(function() {
			sub_tot += Number($(this).val());
			var fina = sub_tot.toFixed(2);
			$('#subtotal').val(fina);
			$('#grandtotal').val(fina);

			var tot = parseFloat(sub_tot) + parseFloat(loadingamount) + parseFloat(freightamount);
		});


		if (gsttype == 'intrastate') {
			// var totamt=parseFloat(sub_tot)+parseFloat(freightamount)+parseFloat(loadingamount);
			if (cgst != '') {
				var s = ((parseFloat((sub_tot) + parseFloat(loadingamount) + parseFloat(freightamount)) * parseFloat(cgst)) / 100);
				var s1 = s.toFixed(2);
				$('#cgstamount').val(s1);
				$('#sgstamount').val(s1);

				m = parseFloat(sub_tot) + parseFloat(s1) + parseFloat(s1);
				var m1 = m.toFixed(2);
				$('#grandtotal').val(m1);

			}

			if (loadingamount > 0) {
				//alert(loadingamount);
				l = parseFloat(sub_tot) + parseFloat(s1) + parseFloat(s1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
				l1 = l.toFixed(2);
				$('#grandtotal').val(l1);
			}
			if (freightamount > 0) {
				l = parseFloat(sub_tot) + parseFloat(s1) + parseFloat(s1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
				l1 = l.toFixed(2);
				$('#grandtotal').val(l1);
			}

			if (roundOff > 0) {
				l = parseFloat(sub_tot) + parseFloat(s1) + parseFloat(s1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
				l1 = l.toFixed(2);
				$('#grandtotal').val(l1);
			}


		} else if (gsttype == 'interstate') {
			if (igst != '') {
				var h = ((parseFloat((sub_tot) + parseFloat(loadingamount) + parseFloat(freightamount)) * parseFloat(igst)) / 100);
				var h1 = h.toFixed(2);
				$('#igstamount').val(h1);

				n = parseFloat(sub_tot) + parseFloat(h1);
				var n1 = n.toFixed(2);
				$('#grandtotal').val(n1);
			}

			if (loadingamount > 0) {
				//alert(loadingamount);
				l = parseFloat(sub_tot) + parseFloat(h1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
				l1 = l.toFixed(2);
				$('#grandtotal').val(l1);
			}
			if (freightamount > 0) {
				l = parseFloat(sub_tot) + parseFloat(h1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
				l1 = l.toFixed(2);
				$('#grandtotal').val(l1);
			}

			if (roundOff > 0) {
				l = parseFloat(sub_tot) + parseFloat(h1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
				l1 = l.toFixed(2);
				$('#grandtotal').val(l1);
			}

			if (roundOff > 0) {
				l = parseFloat(sub_tot) + parseFloat(h1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
				l1 = l.toFixed(2);
				$('#grandtotal').val(l1);
			}


		}

		// else  if(gsttype=='export')
		// {
		// if(igst != '')
		// {
		// var h=((parseFloat((sub_tot)+parseFloat(loadingamount)+parseFloat(freightamount))*parseFloat(igst))/100);
		// var h1=h.toFixed(2);
		// $('#igstamount').val(h1);

		// 	n = parseFloat(sub_tot)+parseFloat(h1);
		// 	var n1 = n.toFixed(2);
		// 	$('#grandtotal').val(n1);
		// }


	}


	function isNumberKey_With_Dot(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			if (charCode == 46)
				return true;
			else
				return false;
		} else
			return true;
	}
</script>
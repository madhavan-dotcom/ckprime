<?php $data = $this->db->get('profile')->result();
$discountBy = $this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;

foreach ($data as $r)
?>
<title> <?php echo $r->companyname; ?></title>
<link href="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/multiselect/css/bootstrap-select.css">
<style type="text/css">
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

	/*.radio input[type=radio], .radio-inline input[type=radio] {
				position: absolute;
				margin-left: -68px;
			}*/
	.checkbox-inline,
	.radio-inline {
		font-weight: bold;
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
					<section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
						<header class="panel-heading" style="color:rgb(255, 255, 255)">
							<i class="zmdi zmdi-shopping-cart"><span style="font-family: 'Quicksand', sans-serif;padding-left: 6px;">Purchase Receipt - <?php echo $invoiceno; ?>
								</span></i>
						</header>
						<div class="card-box">
							<div class="row">
								<form class="form-horizontal" method="post" name="logoForm" id="logoForm" action="<?php echo base_url(); ?>purchase/insert" data-parsley-validate novalidate><!---->
									<input type="hidden" class="form-control" name="purchaseno" id="purchaseno" value="<?php echo $invoiceno; ?>"
										readonly>
									<input type="hidden" id="discountBy" name="hiddenDiscountBy" value="<?php echo $discountBy; ?>" />
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-2">
														<label>Date</label>
														<input type="text" class="form-control datepicker-autoclose" name="purchasedate" parsley-trigger="change" id="datepicker-autoclose" required value="<?php echo date('d-m-Y'); ?>">
													</div>

													<div class="col-md-4">
														<label>Purchase Type</label>
														<select class="form-control" parsley-trigger="change" required name="purchasetype" id="purchasetype">
															<option value="Direct Purchase">Direct Purchase</option>
															<option value="purchase Order">Against purchase Order</option>
															<option value="Job Order">Against Job Order</option>
															<!-- <option value="Job Order Inward">Against Job Order Inward</option> -->
														</select>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label>Supplier Name</label>
															<input type="text" class="form-control" name="suppliername" id="suppliername" value="">
															<input type="hidden" name="supplierid" id="supplierid" value="" />
															<div id="cusname_valid" style="position: absolute;"></div>
														</div>
													</div>

													<!-- <div class="col-md-6 directPurchaseDet">
														<label>Supplier Name</label>
														<input type="text" class="form-control" name="suppliername" id="suppliername" value="">
														<input type="hidden" class="form-control" name="supplierid" id="supplierid" value="">
														<div id="cusname_valid" style="position: absolute;"></div>
													</div> -->


												</div>
											</div>
											<div class="row" style="margin-top: 10px;">
												<div class="col-md-12">
													<div class="col-md-2">
														<label>Invoice No</label>
														<input type="text" class="form-control" name="invoiceno" id="invoiceno" required value="" style="width:148px;">
														<div id="invoiceno_valid"></div>
													</div>
													<div class="col-md-2">
														<label>Invoice Date</label>
														<input type="text" auotocomplete="off" class="form-control datepicker-autoclose" required name="invoicedate" id="invoicedate" value="<?php echo date('d-m-Y'); ?>">
													</div>

													<div class="col-md-2">
														<label>GST Type</label>
														<input type="text" class="form-control" parsley-trigger="change" readonly name="gsttype" id="gsttype">
														<!-- <select  class="form-control" parsley-trigger="change" required name="gsttype" id="gsttype" >
																	<option value="intrastate">INTRA-STATE</option>
																	<option value="interstate">INTER-STATE</option>
																</select> -->
													</div>
													<!--<div class="col-md-6" id="stockDiv">-->
													<!--    <label class="radio-inline">-->
													<!--	  <input type="radio" name="stockType" value="Godown Stock">Godown Stock-->
													<!--	</label>-->
													<!--	<label class="radio-inline">-->
													<!--	  <input type="radio" name="stockType" value="Semi Finished">Semi Finished-->
													<!--	</label>-->
													<!--	<label class="radio-inline">-->
													<!--	  <input type="radio" name="stockType" value="Part">Parts-->
													<!--	</label>-->
													<!--</div>-->
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<label>Address</label>
											<textarea type="text" class="form-control" name="address" id="address" required rows="4"></textarea>
										</div>
									</div>
									<div class="clearfix">
										<hr />
									</div>
									<div class="row jobOrderClass">
										<div class="col-md-12">
											<div class="col-md-6">
												<label>Job Order No</label>
												<div class="clearfix"></div>
												<select class="selectpicker" name="jobOrder[]" id="jobOrder" multiple data-live-search-placeholder="Search">
												</select>
												<button class="btn" type="button" id="jobOrdersearch"><i class="fa fa-search" aria-hidden="true"></i></button>
											</div>
										</div>
									</div>
									<div class="row jobOrderInwardClass">
										<div class="col-md-12">
											<div class="col-md-6">
												<label>Inward No</label>
												<div class="clearfix"></div>
												<select class="selectpicker" name="inwardNo[]" id="inwardNo" multiple data-live-search-placeholder="Search">
												</select>
												<button class="btn" type="button" id="inwardsearch"><i class="fa fa-search" aria-hidden="true"></i></button>
											</div>
										</div>
									</div>
									<div class="row purchaseOrderClass">
										<div class="col-md-12">
											<div class="col-md-6">
												<label>purchase Order No</label>
												<div class="clearfix"></div>
												<select class="selectpicker" name="purchaseOrder[]" id="purchaseOrder" multiple data-live-search-placeholder="Search">
												</select>
												<button class="btn" type="button" id="purchaseOrdersearch"><i class="fa fa-search" aria-hidden="true"></i></button>
											</div>
										</div>
									</div>

									<div class="clearfix"></div>
									<div id="inwarddetails"></div>
									<div class="col-sm-offset-11">
										<button type="button" class="btn btn-info add pull-right" style="margin-right: 10px;"><i class="fa fa-plus"></i></button>
										<input type="hidden" id="hide" value="1">
									</div>
									<br>

									<table class="table myform">
										<tr>
											<td>Freight Charges</td>
											<td><input class="decimals" id="freightamount" parsley-trigger="change" placeholder="Amount" type="text" name="freightamount" value="" autocomplete="off"></td>

											<td class="sgst"><input class="decimals" id="freightcgst" type="text" name="freightcgst" placeholder="CGST" value="0" autocomplete="off"></td>

											<td class="sgst"><input class="decimals" readonly id="freightcgstamount" placeholder="CGST Amount" type="text" name="freightcgstamount" autocomplete="off" readonly value=""></td>

											<td class="sgst"><input class="decimals" id="freightsgst" placeholder="SGST" type="text" name="freightsgst" readonly value="0" autocomplete="off">
												<div id="sgst_valid"></div>
											</td>

											<td class="sgst"><input class="decimals" id="freightsgstamount" type="text" name="freightsgstamount" placeholder="SGST Amount" readonly autocomplete="off" readonly value=""></td>

											<td class="igst" style="display:none;"><input class="decimals" id="freightigst" type="text" name="freightigst" placeholder="IGST" autocomplete="off" value="0">
												<div id="igst_valid"></div>
											</td>

											<td class="igst" style="display:none;"><input class="decimals" id="freightigstamount" type="text" name="freightigstamount" placeholder="IGST Amount" autocomplete="off" readonly value=""></td>

											<td><input class="" id="freighttotal" placeholder="Total" type="text" name="freighttotal" value="" readonly></td>
										</tr>

										<tr>
											<td>Loading & Packing Charges
							</div>
							</td>

							<td><input class="decimals" id="loadingamount" parsley-trigger="change" placeholder="Amount" type="text" name="loadingamount" value="" autocomplete="off">
								<div id="rate_valid"></div>
							</td>

							<td class="sgst"><input class="decimals" id="loadingcgst" type="text" name="loadingcgst" placeholder="CGST" value="0" autocomplete="off">
								<div id="cgst_valid"></div>
							</td>

							<td class="sgst"><input class="decimals" readonly id="loadingcgstamount" type="text" name="loadingcgstamount" placeholder="CGST Amount" autocomplete="off" readonly value=""></td>

							<td class="sgst"><input class="decimals" id="loadingsgst" placeholder="SGST" type="text" name="loadingsgst" readonly value="0" autocomplete="off">
								<div id="sgst_valid"></div>
							</td>

							<td class="sgst"><input class="decimals" id="loadingsgstamount" type="text" name="loadingsgstamount" readonly placeholder="SGST Amount" autocomplete="off" readonly value=""></td>

							<td class="igst" style="display:none;"><input class="decimals" id="loadingigst" type="text" name="loadingigst" placeholder="IGST" autocomplete="off" value="0">
								<div id="igst_valid"></div>
							</td>

							<td class="igst" style="display:none;"><input class="decimals" id="loadingigstamount" placeholder="IGST Amount" type="text" name="loadingigstamount" autocomplete="off" readonly value=""></td>

							<td><input class="" id="loadingtotal" type="text" placeholder="Total" name="loadingtotal" value="" readonly></td>
							</tr>
							</table>

							<div class="col-sm-offset-9">
								<label class="col-sm-5  control-label">Sub Total</label>
								<div class="col-sm-7">
									<input class="form-control" type="text" name="subtotal" id="subtotal" readonly placeholder="0" value="0">
								</div>
							</div>
							<br>
							<br>
							<div class="clearfix"></div>

							<div class="col-sm-offset-9">
								<label class="col-sm-5  control-label">Round Off</label>
								<div class="col-sm-7">
									<input class="form-control decimals" type="text" name="roundOff" id="roundOff" placeholder="0" value="0" onfocus="if(this.value == '0') { this.value = ''; }" onblur="if(this.value == '') { this.value = '0'; }">
								</div>
							</div>
							<br>
							<br>
							<div class="clearfix"></div>

							<div class="col-sm-offset-9">
								<label class="col-sm-5  control-label">Other Charges</label>
								<div class="col-sm-7">
									<input class="form-control decimals" type="text" name="othercharges" id="othercharges" placeholder="0" value="0" onfocus="if(this.value == '0') { this.value = ''; }" onblur="if(this.value == '') { this.value = '0'; }">
								</div>
							</div>
							<br>
							<br>
							<div class="clearfix"></div>

							<div class=" col-sm-offset-9">
								<label class="col-sm-5  control-label">Purchase Total</label>
								<div class="col-sm-7">
									<input class="form-control" readonly type="text" name="grandtotal" id="grandtotal">
								</div>
							</div>
							<div class="clearfix"></div>

							<div class="col-sm-offset-4">
								<button class="btn btn-info" id="submit">Add Purchase</button>
								<button type="reset" class="btn btn-default" id="">Reset</button>
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
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/multiselect/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var gotVal = $('#purchasetype').val();
		getDetails(gotVal);
		$('form').parsley();
		$("input").keyup(function() {
			$(this).parent().removeClass('has-error');
			$(this).next().empty();
		});
		$('#purchasetype').change(function() {
			getDetails($(this).val());
		});
		$("#suppliername").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: "<?php echo base_url(); ?>purchase/autocomplete_customername",
					data: {
						keyword: $("#suppliername").val()
					},
					dataType: "json",
					type: "POST",
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				$("#suppliername").val(ui.item.label);
				$('#address').val(ui.item.address);
				$('#tinno').val(ui.item.tinno);
				$('#cstno').val(ui.item.cstno);
				if (ui.item.type == "Intra supplier") {
					$('#gsttype').val('intrastate');
					var gsttypes = 'intrastate';
				} else if (ui.item.type == "Inter supplier") {
					$('#gsttype').val('interstate');
					var gsttypes = 'interstate';
				}
				$('#supplierid').val(ui.item.supplierid);
				// $('#supplierid').val(ui.item.supplierid);

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
			}
		});
		$('#suppliername').blur(function() {
			var supplier = $('#suppliername').val();
			var purchasetype = $('#purchasetype').val();
			if (purchasetype == 'purchase Order') {
				var getNum = 'get_purchaseorderno';
			} else if (purchasetype == 'Job Order') {
				var getNum = 'get_vendorjoborderno';
			}
			if (supplier != '' && purchasetype == 'purchase Order') {
				// $('#inwarddetails').hide();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>purchase/" + getNum,
					data: {
						supplier: supplier
					},
					beforeSend: function() {
						$("#purchaseOrder option:gt(0)").remove();
						$('#purchaseOrder').selectpicker('refresh');
						$('#purchaseOrder').find("option:eq(0)").html("Please wait..");
						$('#purchaseOrder').selectpicker('refresh');

					},
					success: function(data) {
						if (purchasetype == 'purchase Order') {
							$('#purchaseOrder').selectpicker('refresh');
							$('#purchaseOrder').find("option:eq(0)").html("");
							$('#purchaseOrder').selectpicker('refresh');
							var obj = jQuery.parseJSON(data);
							$('#purchaseOrder').selectpicker('refresh');
							$(obj).each(function() {
								var option = $('<option />');
								option.attr('value', this.value).text(this.label);
								$('#purchaseOrder').append(option);
							});
							$('#purchaseOrder').selectpicker('refresh');
						}
					}
				});
				return false;
			} else if (supplier != '' && purchasetype == 'Job Order') {
				// $('#inwarddetails').hide();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>purchase/" + getNum,
					data: {
						supplier: supplier
					},
					beforeSend: function() {
						$("#jobOrder option:gt(0)").remove();
						$('#jobOrder').selectpicker('refresh');
						$('#jobOrder').find("option:eq(0)").html("Please wait..");
						$('#jobOrder').selectpicker('refresh');

					},
					success: function(data) {
						if (purchasetype == 'Job Order') {
							$('#jobOrder').selectpicker('refresh');
							$('#jobOrder').find("option:eq(0)").html("");
							$('#jobOrder').selectpicker('refresh');
							var obj = jQuery.parseJSON(data);
							$('#jobOrder').selectpicker('refresh');
							$(obj).each(function() {
								var option = $('<option />');
								option.attr('value', this.value).text(this.label);
								$('#jobOrder').append(option);
							});
							$('#jobOrder').selectpicker('refresh');
						}
					}
				});
				return false;
			}



		});
		$("#vendorname").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: "<?php echo base_url(); ?>purchase/autocomplete_vendorname",
					data: {
						keyword: $("#vendorname").val()
					},
					dataType: "json",
					type: "POST",
					success: function(data) {
						response(data);
					}
				});
			},
			select: function(event, ui) {
				var vendors = ui.item.value;
				$('#vendorname').val(ui.item.value);
				$('#vendorId').val(ui.item.id);
				$('#address').val(ui.item.vendordetails);
				if (ui.item.gsttype == "Intra supplier") {
					$('#gsttype').val('intrastate');
					var gsttypes = 'intrastate';
				} else if (ui.item.gsttype == "Inter supplier") {
					$('#gsttype').val('interstate');
					var gsttypes = 'interstate';

				}
			}
		});

		$('#vendorname').blur(function() {
			var vendors = $('#vendorname').val();
			var purchasetype = $('#purchasetype').val();
			if (purchasetype == 'Job Order') {
				var getNum = 'get_vendorjoborderno';
			} else {
				var getNum = 'get_vendorinwardno';
			}
			if (vendors != '') {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>purchase/" + getNum,
					data: {
						vendors: vendors
					},
					beforeSend: function() {
						if (purchasetype == 'Job Order') {
							$("#jobOrder option:gt(0)").remove();
							$('#jobOrder').selectpicker('refresh');
							$('#jobOrder').find("option:eq(0)").html("Please wait..");
							$('#jobOrder').selectpicker('refresh');
						} else {
							$("#inwardNo option:gt(0)").remove();
							$('#inwardNo').selectpicker('refresh');
							$('#inwardNo').find("option:eq(0)").html("Please wait..");
							$('#inwardNo').selectpicker('refresh');
						}
					},
					success: function(data) {
						if (purchasetype == 'Job Order') {
							$('#jobOrder').selectpicker('refresh');
							$('#jobOrder').find("option:eq(0)").html("");
							$('#jobOrder').selectpicker('refresh');
							var obj = jQuery.parseJSON(data);
							$('#jobOrder').selectpicker('refresh');
							$(obj).each(function() {
								var option = $('<option />');
								option.attr('value', this.value).text(this.label);
								$('#jobOrder').append(option);
							});
							$('#jobOrder').selectpicker('refresh');
						} else {
							$('#inwardNo').selectpicker('refresh');
							$('#inwardNo').find("option:eq(0)").html("");
							$('#inwardNo').selectpicker('refresh');
							var obj = jQuery.parseJSON(data);
							$('#inwardNo').selectpicker('refresh');
							$(obj).each(function() {
								var option = $('<option />');
								option.attr('value', this.value).text(this.label);
								$('#inwardNo').append(option);
							});
							$('#inwardNo').selectpicker('refresh');
						}
					}
				});
				return false;
			}
		});
		$('#jobOrdersearch').click(function() {
			var jobOrder = $('#jobOrder').val();
			var gsttype = $('#gsttype').val();
			if (jobOrder == 'null') {
				alert('Please Select job order no');
				$('#jobOrder').focus();
			} else {
				$.post('<?php echo base_url(); ?>purchase/getjoborderdetails', {
					'jobOrder': jobOrder,
					'gsttype': gsttype
				}, function(data) {
					$('#inwarddetails').html(data);
					call_keyup();
				});
			}
		});
		$('#inwardsearch').click(function() {
			var inwardNo = $('#inwardNo').val();
			if (inwardNo == 'null') {
				alert('Please Select inward no');
				$('#inwardNo').focus();
			} else {
				$.post('<?php echo base_url(); ?>purchase/getinwarddetails', {
					'inwardNo': inwardNo
				}, function(data) {
					$('#inwarddetails').html(data);
					call_keyup();
				});
			}
		});
		$('#purchaseOrdersearch').click(function() {
			var purchaseOrder = $('#purchaseOrder').val();
			if (purchaseOrder == 'null') {
				alert('Please Select purchase Order no');
				$('#purchaseOrder').focus();
			} else {
				$.post('<?php echo base_url(); ?>purchase/getpodetails', {
					'purchaseOrder': purchaseOrder
				}, function(data) {
					$('#inwarddetails').html(data);
					call_keyup();
				});
			}
		});
		//VALIDATION
		$("#logoForm").validate({
			onfocusout: function(element) {
				this.element(element);
			},
			"onkeyup": false,
			"rules": {
				"purchasedate": {
					"required": true
				},
				"suppliername": {
					"required": true
				},
				"invoiceno": {
					"required": true
				},
				"invoicedate": {
					"required": true
				},
				"address": {
					"required": true
				}

			},
			"messages": {
				"purchasedate": {
					"required": "Purchase date cannot be blank."
				},
				"suppliername": {
					"required": "Supplier name cannot be blank."
				},
				"invoiceno": {
					"required": "Invoice No cannot be blank."
				},
				"invoicedate": {
					"required": "Invoice date cannot be blank."
				}
			}

		});
	});

	function getDetails(gotVal) {

		if (gotVal == 'Direct Purchase') {
			$('#stockDiv').show();
			$.post('<?php echo base_url(); ?>purchase/getaddpurchasedetails', {
				'jobOrder': 'jobOrder'
			}, function(data) {
				$('#inwarddetails').html(data);
				call_keyup();

			});
			$("input[name=cusname]").attr('data-parsley-required', 'true').parsley();
			$("input[name=vendorname]").css('display', 'block').removeAttr('data-parsley-required').parsley(); //.destroy();			
			$('#inwarddetails').html('');
			$('.jobOrderClass').hide();
			$('#vendorDiv').hide();
			$('.jobOrderInwardClass').hide();
			$('.purchaseOrderClass').hide();
			$('.directPurchaseDet').show();
			$('.directPurchaseDet1').show();
			$("#jobOrder").removeAttr('data-live-search').removeAttr('data-actions-box').removeAttr('data-parsley-required').parsley().destroy();
			$("#inwardNo").removeAttr('data-live-search').removeAttr('data-actions-box').removeAttr('data-parsley-required').parsley().destroy();
			$('.add').show();
		} else {
			$('#vendorDiv').show();
			$('#stockDiv').hide();
			$("input[name=cusname]").css('display', 'block').removeAttr('data-parsley-required').parsley(); //.destroy();			
			//$("input[name=stockType]").css('display', 'block').removeAttr('data-parsley-required').parsley();//.destroy();
			$("input[name=vendorname]").attr('data-parsley-required', 'true').parsley();
			$('.directPurchaseDet').hide();
			$('.directPurchaseDet1').hide();
			if (gotVal == 'Job Order') {
				$('.jobOrderClass').show();
				$('.jobOrderInwardClass').hide();
				$('.purchaseOrderClass').hide();
				$("#inwardNo").removeAttr('data-live-search').removeAttr('data-actions-box').removeAttr('data-parsley-required').parsley().destroy();
				$("#jobOrder").attr('data-live-search', 'true').attr('data-actions-box', 'true').attr('data-parsley-required', 'true').parsley();
				$('#jobOrder').selectpicker();
				$('#jobOrder').val('').selectpicker('refresh');
			} else if (gotVal == 'Job Order Inward') {
				$('.jobOrderInwardClass').show();
				$('.jobOrderClass').hide();
				$('.purchaseOrderClass').hide();
				$("#jobOrder").removeAttr('data-live-search').removeAttr('data-actions-box').removeAttr('data-parsley-required').parsley().destroy();
				$("#inwardNo").attr('data-live-search', 'true').attr('data-actions-box', 'true').attr('data-parsley-required', 'true').parsley();
				$('#inwardNo').selectpicker();
				$('#jobOrder').val('').selectpicker('refresh');
			} else {
				$('.purchaseOrderClass').show();
				$('.directPurchaseDet').show();
				$('.directPurchaseDet1').hide();
				$('#vendorDiv').hide();
				$('.jobOrderClass').hide();
				$('.jobOrderInwardClass').hide();
				$("input[name=cusname]").css('display', 'block').removeAttr('data-parsley-required').parsley(); //.destroy();			
				//$("input[name=stockType]").css('display', 'block').removeAttr('data-parsley-required').parsley();//.destroy();
				$("input[name=vendorname]").css('display', 'block').removeAttr('data-parsley-required').parsley(); //.destroy();
				$("#jobOrder").removeAttr('data-live-search').removeAttr('data-actions-box').removeAttr('data-parsley-required').parsley().destroy();
				$("#inwardNo").removeAttr('data-live-search').removeAttr('data-actions-box').removeAttr('data-parsley-required').parsley().destroy();
				$("#purchaseorder").attr('data-live-search', 'true').attr('data-actions-box', 'true').attr('data-parsley-required', 'true').parsley();
				$('#purchaseorder').selectpicker();
				$('#purchaseorder').val('').selectpicker('refresh');
			}
			$('.add').hide();

		}
	}
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
			if (gsttype == 'interstate') {
				$('.sgst').hide();
				$('.igst').show();
				/*$('#sgst').val('0');
				$('#sgstamount').val('0.00');
				$('#cgst').val('0');
				$('#cgstamount').val('0.00');*/
			} else if (gsttype == 'intrastate') {
				$('.sgst').show();
				$('.igst').hide();
				//$('#igst').val('0');
				//$('#igstamount').val('0.00');
			}
		});
		$('.add').click(function() {
			var start = $('#hide').val();
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


			$(' <tr>' +
				'	<td><input class="" id="hsnno' + total + '" parsley-trigger="change"  readonly type="text" name="hsnno[]" value="" ><div id="hsnno_valid' + total + '"></div><input type="hidden" name="priceType[]" id="priceType0" /></td>'

				+
				'	<td><input class="itemname_class" data-id="' + total + '" id="itemname' + total + '" parsley-trigger="change" required  type="text" name="itemname[]" value=""><input type="hidden" name="itemcode[]" id="itemcode' + total + '" data-id="' + total + '"><input type="hidden" name="itemid[]" id="itemid' + total + '" data-id="' + total + '"><div id="itemname_valid' + total + '"></div></td>'


				+
				'	<td><input class="" id="uom' + total + '" parsley-trigger="change"  readonly  type="text" name="uom[]"  autocomplete="off"><div id="uom_valid' + total + '"></div></td>'
				
				+
				'	<td><input class="" id="heatno' + total + '" parsley-trigger="change"    type="text" name="heatno[]"  autocomplete="off"><div id="heatno_valid' + total + '"></div></td>'

				+
				'<td><select class="form-control grade_class" data-id="' + total + '" id="grade' + total + '" name="grade[]" style="width: 120px;"><option value="">Select Grade</option><?php $grade = $this->db->where('status', 1)->get('grade')->result();
																																															foreach ($grade as $g) { ?><option value="<?php echo $g->id; ?>"><?php echo $g->grade; ?></option><?php } ?></select></td>'

				+
				'	<td><input class="" id="weight' + total + '" parsley-trigger="change"   type="text" name="weight[]"  autocomplete="off"></td>' +
				'<td><input class="qty_class decimals" id="qty' + total + '" data-id="' + total + '" parsley-trigger="change" required type="text" name="qty[]"  autocomplete="off" ><div id="qty_valid' + total + '"></div></td> ' +
				'	<td><input class="rate_class decimals" data-id="' + total + '" parsley-trigger="change"  id="rate' + total + '" required type="text" name="rate[]"   autocomplete="off"><div id="rate_valid' + total + '"></div></td>'

				+
				'	<td><input class="decimals" id="amount' + total + '" parsley-trigger="change"  readonly type="text" name="amount[]" value=""  autocomplete="off"><div id="amount_valid' + total + '"></div></td>'

				+
				'	<td><input class="discount_class decimals" id="discount' + total + '" data-id="' + total + '"  type="text" name="discount[]" onkeypress="return isNumberKey_With_Dot(event)" value="0"  autocomplete="off"><div id="discount_valid' + total + '"></div></td>'

				+
				'	<td><input class="decimals" id="taxableamount' + total + '" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount' + total + '"><div id="taxableamount_valid' + total + '"></div></td>'

				+
				'	<td class="sgst" style="display:' + samples1 + ';"><input class="decimals" readonly id="cgst' + total + '"  type="text" name="cgst[]" value="" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="cgst_valid' + total + '"></div></td>'

				+
				'<td class="sgst" style="display:' + samples1 + ';"><input class="decimals" readonly id="cgstamount' + total + '"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>'

				+
				'	<td class="sgst" style="display:' + samples1 + ';"><input class="decimals" id="sgst' + total + '" readonly  type="text" name="sgst[]" value="" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid' + total + '"></div></td>'

				+
				'<td class="sgst" style="display:' + samples1 + ';"><input class="decimals" id="sgstamount' + total + '"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>'

				+
				'	<td class="igst" style="display:' + samples + ';"><input class="decimals" id="igst' + total + '"  type="text" name="igst[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid' + total + '"></div></td>'

				+
				'<td class="igst" style="display:' + samples + ';"><input class="decimals" id="igstamount' + total + '"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>'

				+
				'	<td><input class="" id="total' + total + '" type="text" name="total[]" value=""  readonly ></td>'


				+
				'<td style="width:10px;"><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td></tr>').appendTo(tbody);
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


	function call_keyup() {
		var onload_stocktype = $("input[name='stockType']:checked").val();
		$('.decimals').keyup(function() {
			var val = $(this).val();
			if (isNaN(val)) {
				val = val.replace(/[^0-9\.-]/g, '');
				if (val.split('.').length > 2)
					val = val.replace(/\.-+$/, "");
			}
			$(this).val(val);
		});

		$('.grade_class').change(function() {
			var total = $(this).attr('data-id');
			var grade = $(this).val();
			$.post('<?php echo base_url(); ?>Invoice/get_hsnnos', {
				grade: grade
			}, function(datas) {
				var obj = jQuery.parseJSON(datas);
				$('#hsnno' + total).val(obj.hsnno);
			});

		});

		$(".partno_class").keyup(function() {
			// if($("input:radio[name='stockType']").is(":checked")) 
			// {
			// var stocktype = $("input[name='stockType']:checked").val();				
			var total = $(this).attr('data-id');
			$("#partno" + total).autocomplete({
				source: function(request, response) {
					$.ajax({
						url: "<?php echo base_url(); ?>purchase/autocomplete_partno",
						data: {
							keyword: $("#partno" + total).val()
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
					$('#partno' + total).val(ui.item.value);
					$.post('<?php echo base_url(); ?>purchase/get_partno_details', {
						name: name
					}, function(rest) {
						var obj = jQuery.parseJSON(rest);
						$('#hsnno' + total).val(obj.hsnno);
						$('#itemname' + total).val(obj.itemname);
						$('#priceType' + total).val(obj.priceType);
						$('#itemno' + total).val(obj.itemno);
						$('#rate' + total).val(obj.price);
						$('#sgst' + total).val(obj.sgst);
						$('#cgst' + total).val(obj.cgst);
						$('#igst' + total).val(obj.igst);
						$('#uom' + total).val(obj.uom);
						$('#stockType' + total).val(obj.stockType);
						$('#qty' + total).val('');
						$('#qty' + total).focus();
					});

				}
			});
			//}
			// else
			// {
			// alert('Please select Godown Stock / Semi Finished / Parts');
			// $(this).val('');
			// $("input:radio[name='stockType']").focus();
			// return false;
			// }
		});

		$(".itemname_class").keyup(function() {
			// if($("input:radio[name='stockType']").is(":checked")) 
			// {
			// var stocktype = $("input[name='stockType']:checked").val();				
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
						$('#hsnno' + total).val(obj.hsnno);
						$('#partno' + total).val(obj.partnumber);
						$('#priceType' + total).val(obj.priceType);
						$('#itemno' + total).val(obj.itemno);
						$('#itemcode' + total).val(obj.itemcode);
						$('#itemid' + total).val(obj.itemid);
						$('#rate' + total).val(obj.price);
						$('#sgst' + total).val(obj.sgst);
						$('#cgst' + total).val(obj.cgst);
						$('#igst' + total).val(obj.igst);
						$('#uom' + total).val(obj.uom);
						$('#stockType' + total).val(obj.stockType);
						$('#qty' + total).val('');
						$('#weight' + total).focus();
					});

				}
			});
			//}
			// else
			// {
			// alert('Please select Godown Stock / Semi Finished / Parts');
			// $(this).val('');
			// $("input:radio[name='stockType']").focus();
			// return false;
			// }
		});

		$('.qty_class').keyup(function() {
			var rowNumber = $(this).attr('data-id');
			var priceType = $("#priceType" + rowNumber).val();
			var qty = $('#qty' + rowNumber + '').val();
			if (qty != "") {
				if (priceType == "Inclusive") {
					Inc_amount_calculation(rowNumber);
				} else {
					amount_calculation(rowNumber);
				}
				//frieght_calculation();
				totalAmt_calculation();
			} else {
				$('#qty_valid' + rowNumber + '').html('<span><font color="red">Invalid Qty !</span>');
				// $('#qty' + rowNumber + '').val('0');
				$('#qty_valid' + rowNumber + '').html('');
				if (priceType == "Inclusive") {
					Inc_amount_calculation(rowNumber);
				} else {
					amount_calculation(rowNumber);
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
				$('#discount' + rowNumber + '').val('0');
				$('#discount_valid' + rowNumber + '').html('');
				if (priceType == "Inclusive") {
					Inc_amount_calculation(rowNumber);
				} else {
					amount_calculation(rowNumber);
				}
				totalAmt_calculation();
			}
		});
		//calculation--------------------------------------------------

		$('#freightamount').keyup(function() {
			frieght_calculation();
			totalAmt_calculation();
		});

		$('#freightcgst').keyup(function() {
			var freightcgst = $('#freightcgst').val();
			$('#freightsgst').val(freightcgst);
			frieght_calculation();
			totalAmt_calculation();
		});

		$('#freightigst').keyup(function() {
			frieght_calculation();
			totalAmt_calculation();
		});

		$('#loadingamount').keyup(function() {
			frieght_calculation();
			totalAmt_calculation();
		});

		$('#loadingcgst').keyup(function() {
			var loadingcgst = $('#loadingcgst').val();
			$('#loadingsgst').val(loadingcgst);
			frieght_calculation();
			totalAmt_calculation();
		});

		$('#loadingigst').keyup(function() {
			frieght_calculation();
			totalAmt_calculation();
		});

		$('#roundOff').keyup(function() {
			//amount_calculation();
			//frieght_calculation();
			totalAmt_calculation();
		});

		$('#othercharges').keyup(function() {
			//amount_calculation();
			//frieght_calculation();
			totalAmt_calculation();
		});
		//REMOVE FUNCTION
		$('.remove').click(function() {
			$(this).parents('tr').remove();
			totalAmt_calculation();
		});

	}

	function amount_calculation(rowNumber) {
		var qty = $('#qty' + rowNumber).val();
		var rate = $('#rate' + rowNumber).val();

		var weight = $('#weight' + rowNumber).val();
		var purchasetype = $('#purchasetype').val();

		if (qty != '' && rate != '')
			var amo = parseFloat(rate) * parseFloat(qty);
		var amou = amo.toFixed(2);

		var wamo = parseFloat(rate) * parseFloat(qty) * parseFloat(weight);
		var wamou = wamo.toFixed(2);

		if (purchasetype == "purchase Order" || purchasetype == "Direct Purchase") {
			$('#amount' + rowNumber).val(wamou);
			$('#taxableamount' + rowNumber).val(wamou);
			$('#total' + rowNumber).val(wamou);
		} else {
			$('#amount' + rowNumber).val(amou);
			$('#taxableamount' + rowNumber).val(amou);
			$('#total' + rowNumber).val(amou);
		}

		var discount = $('#discount' + rowNumber).val();
		var cgst = $('#cgst' + rowNumber).val();
		var sgst = $('#sgst' + rowNumber).val();
		var igst = $('#igst' + rowNumber).val();
		var taxableamount = $('#taxableamount' + rowNumber).val();
		var gsttype = $('#gsttype').val();
		var discountBy = $("#discountBy").val();
		//alert(discountBy);
		var a = 0;
		var wa = 0;
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
			if (discountBy == 'percent_wise') { //alert(discountBy);

				if (purchasetype !== "purchase Order" || purchasetype == "Direct Purchase") {
					a = ((parseFloat(amo) * parseFloat(discount)) / 100);
					var a1 = a.toFixed(2);
					var a2 = parseFloat(amo) - parseFloat(a1);
					var a3 = a2.toFixed(2);
					var discountamount = a1;
					taxableamount = a3;
				} else {
					wa = ((parseFloat(wamo) * parseFloat(discount)) / 100);
					var wa1 = wa.toFixed(2);
					var wa2 = parseFloat(wamo) - parseFloat(wa1);
					var a3 = a2.toFixed(2);
					var weight_discountamount = wa1;
					taxableamount = wa3;
				}

			} else {
				if (purchasetype == "purchase Order" || purchasetype == "Direct Purchase") {
					wa = (parseFloat(wamo) - parseFloat(discount));
					var weight_discountamount = discount;
					taxableamount = wa.toFixed(2);
					$('#discountamount' + rowNumber).val(weight_discountamount);
					$('#taxableamount' + rowNumber).val(taxableamount);
					$('#total' + rowNumber).val(k);
				} else {
					a = (parseFloat(amo) - parseFloat(discount));
					var discountamount = discount;
					taxableamount = a.toFixed(2);
					$('#discountamount' + rowNumber).val(discountamount);
					$('#taxableamount' + rowNumber).val(taxableamount);
					$('#total' + rowNumber).val(k);
				}

			}

		}
		k = taxableamount;

		if (gsttype == 'intrastate') {
			if (cgst != '') {
				b = ((parseFloat(k) * parseFloat(cgst)) / 100);
				var b1 = b.toFixed(2);
				$('#cgstamount' + rowNumber).val(b1);
				var b2 = parseFloat(k) + parseFloat(b);
				var b3 = b2.toFixed(2);
				$('#total' + rowNumber).val(b3);
			}

			if (sgst != '') {
				c = ((parseFloat(k) * parseFloat(sgst)) / 100);
				var c1 = c.toFixed(2);
				$('#sgstamount' + rowNumber).val(c1);
				var c2 = parseFloat(k) + parseFloat(b) + parseFloat(c);
				var c3 = c2.toFixed(2);
				$('#total' + rowNumber).val(c3);
			}
			if (igst != '') {
				h = ((parseFloat(k) * parseFloat(igst)) / 100);
				var h1 = h.toFixed(2);
				$('#igstamount' + rowNumber).val(h1);
			}
		} else if (gsttype == 'interstate') {
			if (cgst != '') {
				b = ((parseFloat(k) * parseFloat(cgst)) / 100);
				var b1 = b.toFixed(2);
				$('#cgstamount' + rowNumber).val(b1);
			}

			if (sgst != '') {
				c = ((parseFloat(k) * parseFloat(sgst)) / 100);
				var c1 = c.toFixed(2);
				$('#sgstamount' + rowNumber).val(c1);
			}
			if (igst != '') {
				h = ((parseFloat(k) * parseFloat(igst)) / 100);
				var h1 = h.toFixed(2);
				$('#igstamount' + rowNumber).val(h1);
				var h2 = parseFloat(k) + parseFloat(h);
				var h3 = h2.toFixed(2);
				$('#total' + rowNumber).val(h3);
			}
		}
	}

	function Inc_amount_calculation(total) {
		var qty = $('#qty' + total).val();
		var weight = $('#weight' + total).val();
		var purchasetype = $('#purchasetype').val();
		var rate = $('#rate' + total).val();

		if (qty != '' && rate != '')
			var amo = parseFloat(rate) * parseFloat(qty);
		var amou = amo.toFixed(2);

		var weightamo = parseFloat(rate) * parseFloat(qty) * parseFloat(weight);
		var weightamou = weightamo.toFixed(2); // for weight

		var discount = $('#discount' + total).val();
		var cgst = $('#cgst' + total).val();
		var sgst = $('#sgst' + total).val();
		var igst = $('#igst' + total).val();
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

		var wa = 0;

		var taxableamount = 0;
		var discountamount = 0;

		var weight_taxableamount = 0;
		var weight_discountamount = 0;

		taxableamount = amou;
		weight_taxableamount = weightamou;


		if (discount != '') {
			if (discountBy == 'percent_wise') {
				a = ((parseFloat(amo) * parseFloat(discount)) / 100);
				var a1 = a.toFixed(2);
				var a2 = parseFloat(amo) - parseFloat(a1);
				var a3 = a2.toFixed(2);
				var discountamount = a2;
				taxableamount = a3;

				// for weight
				wa = ((parseFloat(weightamo) * parseFloat(discount)) / 100);
				var wa1 = wa.toFixed(2);
				var wa2 = parseFloat(weightamo) - parseFloat(wa1);
				var wa3 = wa2.toFixed(2);
				var weight_discountamount = wa2;
				weight_taxableamount = wa3;

			} else {

				a = (parseFloat(amo) - parseFloat(discount));
				var discountamount = a.toFixed(2);
				taxableamount = a.toFixed(2);

				// for weight
				wa = (parseFloat(weightamo) - parseFloat(discount));
				var weight_discountamount = wa.toFixed(2);
				weight_taxableamount = wa.toFixed(2);
			}
		}
		k = taxableamount;
		wk = weight_taxableamount;

		if (purchasetype == "purchase Order") {
			$('#discountamount' + total + '').val(weight_discountamount);
			$('#taxableamount' + total + '').val(weight_taxableamount);
		} else {
			$('#discountamount' + total + '').val(discountamount);
			$('#taxableamount' + total + '').val(taxableamount);
		}

		if (gsttype == 'intrastate') {
			if (cgst != '') {
				var divideBy = parseFloat(igst) + 100;
				b = ((parseFloat(k) * parseFloat(igst)) / divideBy) / 2;
				//alert(k+'*'+igst+'/'+divideBy+'\n'+b);
				var b1 = b.toFixed(2);
				$('#cgstamount' + total + '').val(b1);
				var b2 = parseFloat(k) - parseFloat(b);
				var b3 = b2.toFixed(2);
				$('#amount' + total + '').val(b3);
				var totalVal = (parseFloat(b3) + parseFloat(b)).toFixed(2);
				$("#total" + total).val(totalVal);
			}

			if (sgst != '') {
				var divideBy = parseFloat(igst) + 100;
				c = ((parseFloat(k) * parseFloat(igst)) / divideBy) / 2;
				var c1 = c.toFixed(2);
				$('#sgstamount' + total + '').val(c1);
				var c2 = parseFloat(k) - (parseFloat(b) + parseFloat(c));
				var c3 = c2.toFixed(2);
				$('#amount' + total + '').val(c3);
				var totalVal = (parseFloat(c3) + (parseFloat(b) + parseFloat(c))).toFixed(2);
				$("#total" + total).val(totalVal);
			}
			if (igst != '') {
				var divideBy = parseFloat(igst) + 100;
				d = ((parseFloat(k) * parseFloat(igst)) / divideBy);
				var d1 = d.toFixed(2);
				$('#igstamount' + total + '').val(d1);
			}
		} else if (gsttype == 'interstate') {
			if (cgst != '') {
				var divideBy = parseFloat(igst) + 100;
				b = ((parseFloat(k) * parseFloat(igst)) / divideBy) / 2;
				//alert(k+'*'+igst+'/'+divideBy+'\n'+b);
				var b1 = b.toFixed(2);
				$('#cgstamount' + total + '').val(b1);
			}

			if (sgst != '') {
				var divideBy = parseFloat(igst) + 100;
				c = ((parseFloat(k) * parseFloat(igst)) / divideBy) / 2;
				var c1 = c.toFixed(2);
				$('#sgstamount' + total + '').val(c1);
			}
			if (igst != '') {
				var divideBy = parseFloat(igst) + 100;
				d = ((parseFloat(k) * parseFloat(igst)) / divideBy);
				var d1 = d.toFixed(2);
				$('#igstamount' + total + '').val(d1);
				var d2 = parseFloat(k) - parseFloat(d);
				var d3 = d2.toFixed(2);
				$('#amount' + total + '').val(d3);
				var totalVal = (parseFloat(d3) + parseFloat(d)).toFixed(2);
				$("#total" + total).val(totalVal);
			}
		}
	}


	function frieght_calculation() {

		var gsttype = $('#gsttype').val();
		var freightamount = $('#freightamount').val();
		var freightcgst = $('#freightcgst').val();
		var freightsgst = $('#freightsgst').val();
		var freightigst = $('#freightigst').val();
		var loadingamount = $('#loadingamount').val();
		var loadingcgst = $('#loadingcgst').val();
		var loadingsgst = $('#loadingsgst').val();
		var loadingigst = $('#loadingigst').val();

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
		//var k=taxableamount;
		var l = 0;

		if (freightamount == '') {
			var fa = 0;
			$('#freightcgst').val('0');
			$('#freightsgst').val('0');
			$('#freightigst').val('0');

			$('#freightcgstamount').val('0');
			$('#freightsgstamount').val('0');
			$('#freightigstamount').val('0');
		} else {
			var fa = freightamount;
		}

		if (loadingamount == '') {
			var la = 0;
			$('#loadingcgst').val('0');
			$('#loadingsgst').val('0');
			$('#loadingigst').val('0');

			$('#loadingcgstamount').val('0');
			$('#loadingsgstamount').val('0');
			$('#loadingigstamount').val('0');
		} else {
			var la = loadingamount;
		}

		if (gsttype == 'intrastate') {
			if (freightcgst != '') {
				d = ((parseFloat(fa) * parseFloat(freightcgst)) / 100);
				var d1 = d.toFixed(2);
				$('#freightcgstamount').val(d1);
				var d2 = parseFloat(fa) + parseFloat(d);
				var d3 = d2.toFixed(2);
				$('#freighttotal').val(d3);
			} else {
				$('#freighttotal').val(0);
			}

			if (freightsgst != '') {
				e = ((parseFloat(fa) * parseFloat(freightsgst)) / 100);
				var e1 = e.toFixed(2);
				$('#freightsgstamount').val(e1);
				var e2 = parseFloat(fa) + parseFloat(d) + parseFloat(e);
				var e3 = e2.toFixed(2);
				$('#freighttotal').val(e3);
			} else {
				$('#freighttotal').val(0);
			}

			if (loadingcgst != '') {
				f = ((parseFloat(la) * parseFloat(loadingcgst)) / 100);
				var f1 = f.toFixed(2);
				$('#loadingcgstamount').val(f1);
				var f2 = +parseFloat(la) + parseFloat(f);
				var f3 = f2.toFixed(2);
				$('#loadingtotal').val(f3);
			} else {
				$('#loadingtotal').val(0);
			}

			if (loadingsgst != '') {
				g = ((parseFloat(la) * parseFloat(loadingsgst)) / 100);
				var g1 = g.toFixed(2);
				$('#loadingsgstamount').val(g1);
				var g2 = parseFloat(la) + parseFloat(f) + parseFloat(g);
				var g3 = g2.toFixed(2);
				$('#loadingtotal').val(g3);
			} else {
				$('#loadingtotal').val(0);
			}
			if (freightcgst != '') {
				var freightigst = parseFloat(freightcgst) + parseFloat(freightsgst);
				$("#freightigst").val(freightigst);
				i = ((parseFloat(fa) * parseFloat(freightigst)) / 100);
				var i1 = i.toFixed(2);
				$('#freightigstamount').val(i1);
			}
			if (loadingcgst != '') {
				var loadingigst = parseFloat(loadingcgst) + parseFloat(loadingsgst);
				$('#loadingigst').val(loadingigst);
				j = ((parseFloat(la) * parseFloat(loadingigst)) / 100);
				var j1 = j.toFixed(2);
				$('#loadingigstamount').val(j1);
			}
		} else if (gsttype == 'interstate') {

			if (freightigst != '') {
				var freightcgst = (parseFloat(freightigst) / 2);
				$('#freightcgst').val(freightcgst);
				d = ((parseFloat(fa) * parseFloat(freightcgst)) / 100);
				var d1 = d.toFixed(2);
				$('#freightcgstamount').val(d1);

				var freightsgst = (parseFloat(freightigst) / 2);
				$('#freightsgst').val(freightsgst);
				e = ((parseFloat(fa) * parseFloat(freightsgst)) / 100);
				var e1 = e.toFixed(2);
				$('#freightsgstamount').val(e1);


				i = ((parseFloat(fa) * parseFloat(freightigst)) / 100);
				var i1 = i.toFixed(2);
				$('#freightigstamount').val(i1);
				var i2 = parseFloat(fa) + parseFloat(i);
				var i3 = i2.toFixed(2);
				$('#freighttotal').val(i3);
			} else {
				$('#freighttotal').val(0);
			}

			if (loadingigst != '') {
				var loadingcgst = ((parseFloat(loadingigst)) / 2);
				$('#loadingcgst').val(loadingsgst);
				f = ((parseFloat(la) * parseFloat(loadingcgst)) / 100);
				var f1 = f.toFixed(2);
				$('#loadingcgstamount').val(f1);

				var loadingsgst = loadingcgst;
				$('#loadingsgst').val(loadingsgst);
				g = ((parseFloat(la) * parseFloat(loadingsgst)) / 100);
				var g1 = g.toFixed(2);
				$('#loadingsgstamount').val(g1);


				j = ((parseFloat(la) * parseFloat(loadingigst)) / 100);
				var j1 = j.toFixed(2);
				$('#loadingigstamount').val(j1);
				var j2 = parseFloat(la) + parseFloat(j);
				var j3 = j2.toFixed(2);
				$('#loadingtotal').val(j3);
			} else {
				$('#loadingtotal').val(0);
			}
		}
	}

	function totalAmt_calculation() {
		var othercharges = $('#othercharges').val();
		if (othercharges == '') {
			othercharges = 0;
		}
		var roundOff = $('#roundOff').val();
		var sub_tot = 0;
		var l = 0;
		var l1 = 0;
		sub_tot += Number($('#freighttotal').val());
		sub_tot += Number($('#loadingtotal').val());
		$('input[name^="total"]').each(function() {
			sub_tot += Number($(this).val());
			var fina = sub_tot.toFixed(2);
			$('#subtotal').val(fina);
			$('#grandtotal').val(fina);
		});

		if (othercharges) {
			l = parseFloat(sub_tot) + parseFloat(othercharges);
			l1 = l.toFixed(2);
			$('#grandtotal').val(l1);
		}
		if (roundOff) {
			l = parseFloat(sub_tot) + parseFloat(othercharges) + parseFloat(roundOff);
			l1 = l.toFixed(2);
			$('#grandtotal').val(l1);
		}
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
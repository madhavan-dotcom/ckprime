<?php
$data[] = $this->db->where('purchaseorderno', $workorder)->where('workorderbalance >', 0)->get('purchaseorder_reports')->result();
?>


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

<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">




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
				<!-- <th -style="width:40px">Disc <?php if ($discountBy == 'percent_wise') {
														echo '%';
													} ?></th> -->
				<th -style="width:110px">Total</th>
				<th -style="width:110px">Delivery Date</th>
				<th style="width:10px">&nbsp;</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach ($data as $datas) {
				foreach ($datas as $rows) {

			?>
					<tr>
						<td>

							<input class="form-control" id="workorderno" type="text" name="workorderno" value="<?php echo $rows->purchaseorderno; ?>" readonly>
							<input class="form-control" id="purchaseorder" type="text" name="purchaseorder" value="<?php echo $rows->purchaseorder; ?>" readonly>
							<input class="form-control" parsley-trigger="change" readonly id="id<?php echo $rows->id; ?>" type="text" name="id[]" value="<?php echo $rows->id; ?>">
							<input class="form-control" parsley-trigger="change" readonly id="itemid<?php echo $rows->id; ?>" type="text" name="itemid[]" value="<?php echo $rows->itemid; ?>">
							<input class="" id="hsnno<?php echo $rows->id; ?>" parsley-trigger="change" required readonly type="text" name="hsnno[]" value="<?php echo $rows->hsnno; ?>">
							<div id="hsnno_valid0"></div>
						</td>
						<td><input class="itemcode_class" data-id="<?php echo $rows->id; ?>" id="itemcode<?php echo $rows->id; ?>" parsley-trigger="change" required type="text" name="itemcode[]" value="<?php echo $rows->itemcode; ?>"></td>
						<td><input class="itemname_class" style="width: 250px;" data-id="<?php echo $rows->id; ?>" id="itemname<?php echo $rows->id; ?>" parsley-trigger="change" required type="text" name="itemname[]" value="<?php echo htmlspecialchars($rows->itemname); ?>">
							<div id="itemname_valid<?php echo $rows->id; ?>"></div><input type="text" name="item_desc[]" value="<?php echo $rows->item_desc; ?>" placeholder="Description" style="margin-top: 2px;"><input type="hidden" name="priceType[]" id="priceType0" />
						</td>
						<td><input class="" data-id="<?php echo $rows->id; ?>" id="drawingno<?php echo $rows->id; ?>" parsley-trigger="change" required type="text" name="drawingno[]" value="<?php echo $rows->drawingno; ?>"></td>

						<td><select name="grade[]" id="grade<?php echo $rows->id; ?>" data-id="<?php echo $rows->id; ?>" class="form-control grade_class" style="width: 120px;" required>
								<?php foreach ($grade as $g) { ?>
									<option value="<?php echo $g->id; ?>" <?php if ($g->id == $rows->grade) echo 'selected'; ?>><?php echo $g->grade; ?></option>

								<?php } ?>
							</select></td>
						<td><input class="qty_class decimals" data-id="<?php echo $rows->qty; ?>" id="qty<?php echo $rows->id; ?>" parsley-trigger="change" required type="text" name="qty[]" value="" autocomplete="off">
							<input class="" id="balanceqty<?php echo $rows->id; ?>" type="hidden" name="balanceqty[]" value="<?php echo $rows->workorderbalance; ?>">
							<div id="qty_valid<?php echo $rows->id; ?>"></div>
							<div id="qty_valid" style="color:green;">Qty : <?php echo $rows->workorderbalance; ?></div>
						</td>

						<td><input class="" id="uom<?php echo $rows->id; ?>" parsley-trigger="change" required readonly type="text" name="uom[]" autocomplete="off" value="<?php echo $rows->uom; ?>"></td>

						<td><input class="" id="weight<?php echo $rows->id; ?>" parsley-trigger="change" required type="text" name="weight[]" autocomplete="off" value="<?php echo $rows->weight; ?>"></td>

						<td><input class="rate_class decimals" data-id="<?php echo $rows->id; ?>" parsley-trigger="change" required id="rate<?php echo $rows->id; ?>" type="text" name="rate[]" value="<?php echo $rows->rate; ?>" autocomplete="off">
							<div id="rate_valid<?php echo $rows->id; ?>"></div>
						</td>

						<td><input class="decimals" id="amount<?php echo $rows->id; ?>" parsley-trigger="change" required readonly type="text" name="amount[]" value="<?php echo $rows->amount; ?>" autocomplete="off">
							<div id="amount_valid<?php echo $rows->id; ?>"></div>
						</td>

						<!-- <td><input class="discount_class decimals" data-id="<?php echo $rows->id; ?>" id="discount<?php echo $rows->id; ?>" type="text" name="discount[]" maxlength="2" onkeypress="return isNumberKey_With_Dot(event)" value="<?php echo $rows->discount; ?>" autocomplete="off">
							<div id="discount_valid<?php echo $rows->id; ?>"></div>
						</td> -->

						<td><input class="decimals" id="taxableamount<?php echo $rows->id; ?>" readonly type="text" name="taxableamount[]" autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount<?php echo $rows->id; ?>"></td>
					
						
						<td><input class="form-control datepicker-autoclose" id="deliverydates<?php echo $rows->id; ?>"  type="text" name="deliverydates[]" autocomplete="off"></td>
						<td style="width:10px;">&nbsp;</td>
						
						
						
						
						<td>
							<button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button>
						</td>

					</tr>
			<?php }
			} ?>


		</tbody>

	</table>
</div>


<div class="row">
    <div class="col-md-12" style="margin-top: 25px;">
                                                <h4 style="margin-bottom: 17px;color: #000;">Test Requirements</h4>
                                                <textarea rows="5" name="requirements" style="width:30%;"></textarea>
                                            </div>
    
</div>



                             




<div class="col-sm-offset-8">
	<label class="col-sm-7 control-label">Sub Total</label>
	<div class="col-sm-5">
		<input class="form-control" style="background-color: #eee !important;" type="text" name="subtotal" id="subtotal" readonly placeholder="0" value="0">
	</div>
</div>
<br>
<br>


<div class="col-sm-offset-8">
	<label class="col-sm-7  control-label">Frieght Charges</label>
	<div class="col-sm-5">
		<input class="form-control decimals" type="text" name="freightamount" id="freightamount" value="0">
	</div>
</div>
<br>
<br>


<div class="clearfix"></div>
<div class="col-sm-offset-8">
	<label class="col-sm-7  control-label">Loading & Packing Charges</label>
	<div class="col-sm-5">
		<input class="form-control decimals" type="text" name="loadingamount" id="loadingamount" value="0">
	</div>
</div>
<br>
<br>



<div class="clearfix"></div>
<div class="sgst col-sm-offset-8">
	<label class="sgst col-sm-5  control-label">CGST </label>
	<div class="col-sm-2">
		<input class="sgst decimals form-control" type="text" name="cgst" id="cgst" value="9">
	</div>
	<div class="col-sm-5">
		<input class="sgst decimals form-control" type="text" readonly name="cgstamount" id="cgstamount" placeholder="0">
	</div>
</div>

<div class="clearfix"></div>
<div class="sgst col-sm-offset-8 sgst">
	<label class="sgst col-sm-5 control-label">SGST </label>
	<div class="col-sm-2">
		<input class="sgst decimals form-control" type="text" readonly name="sgst" id="sgst" value="9">
	</div>
	<div class="col-sm-5">
		<input class="sgst decimals form-control" type="text" readonly name="sgstamount" id="sgstamount" placeholder="0">
	</div>
</div>


<div class="clearfix"></div>
<div class="col-sm-offset-8 igst">
	<label class="igst  col-sm-5 control-label">IGST </label>
	<div class="col-sm-2">
		<input class="igst decimals form-control" type="text" name="igst" id="igst" value="">
	</div>
	<div class="col-sm-5">
		<input class="igst decimals form-control" readonly type="text" name="igstamount" id="igstamount" placeholder="0">
	</div>
</div>


<div class="col-sm-offset-8">
	<label class="col-sm-7  control-label">Round Off</label>
	<div class="col-sm-5">
		<input class="form-control decimals" type="text" name="roundOff" id="roundOff" placeholder="0" value="0" onfocus="if(this.value == '0') { this.value = ''; }" onblur="if(this.value == '') { this.value = '0'; }">
	</div>
</div>
<br>
<br>


<div class="clearfix"></div>
<div class=" col-sm-offset-8">
	<label class="col-sm-7  control-label">Invoice Total</label>
	<div class="col-sm-5">
		<input class="form-control" readonly type="text" style="background-color: #eee !important;" name="grandtotal" id="grandtotal">
	</div>
</div>

<br>
<br>



<div class="col-sm-offset-4">
	<button class="btn btn-info" id="submit" name="save" value="save">Add Supplier Purchase Order</button>

</div>


<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>


<!-- Datepicker -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>






<script>
    jQuery('#datepicker').datepicker();
jQuery('.datepicker-autoclose').datepicker({ autoclose: true, todayHighlight: true });

</script>






<?php
foreach ($data as $datas) {
	foreach ($datas as $rows) {
?>
		<script>
			$(document).ready(function() {

				var gsttype = $('#gsttype').val();
				if (gsttype == 'interstate') {
					$('.sgst').hide();
					$('.igst').show();

				} else if (gsttype == 'intrastate') {

					$('.sgst').show();
					$('.igst').hide();

				}


				$('.remove').click(function() {
					$(this).parents('tr').remove();
				});


				$('#qty<?php echo $rows->id; ?>').keyup(function() {

					var totals = $('#id<?php echo $rows->id; ?>').val();

					console.log(totals);
					var qty = $('#qty<?php echo $rows->id; ?>').val();
					var balanceqty = $('#balanceqty<?php echo $rows->id; ?>').val();
					var qtys = parseFloat(qty);
					if (qtys > balanceqty) {
						alert('Invalid Qty');
						$('#qty<?php echo $rows->id; ?>').val('');
					} else {
						calculations(totals);
					}


				});





				$('#rate<?php echo $rows->id; ?>').keyup(function() {
					var totals = $('#id<?php echo $rows->id; ?>').val();
					calculations(totals);

				});


				$('#weight<?php echo $rows->id; ?>').keyup(function() {
					var totals = $('#id<?php echo $rows->id; ?>').val();
					calculations(totals);

				});

				$('#discount<?php echo $rows->id; ?>').keyup(function() {
					var discount = $('#discount<?php echo $rows->id; ?>').val();
					if (discount == '') {
						$('#discountamount<?php echo $rows->id; ?>').val('');
					}
					var totals = $('#id').val();
					calculations(totals);

				});


				$('#othercharges').keyup(function() {
					var totals = $('#id<?php echo $rows->id; ?>').val();
					calculations(totals);
				});

				$('#freightamount').keyup(function() {
					calculations();
				});

				$('#loadingamount').keyup(function() {

					calculations();
				});

				$('#cgst').keyup(function() {
					var cgst = $('#cgst').val();
					$('#sgst').val(cgst);
					calculations();
				});


				$('#igst').keyup(function() {

					calculations();
				});

			});
		</script>

<?php }
} ?>


<script type="text/javascript">
	function calculations(totals) {

		var qty = $('#qty' + totals + '').val();
		var rate = $('#rate' + totals + '').val();
		var weight = $('#weight' + totals + '').val();



		if (qty != '' && rate != '' && weight != '')

			var amo = parseFloat(rate) * parseFloat(qty) * parseFloat(weight);
		var amou = amo.toFixed(2);
		$('#amount' + totals + '').val(amou);
		$('#taxableamount' + totals + '').val(amou);
		$('#total' + totals + '').val(amou);


		var discount = $('#discount' + totals + '').val();
		// var cgst=$('#cgst'+totals+'').val();
		// var sgst=$('#sgst'+totals+'').val();
		// var igst=$('#igst'+totals+'').val(); 
		var taxableamount = $('#taxableamount' + totals + '').val();
		var gsttype = $('#gsttype').val();

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
		var cgst = $('#cgst').val();
		var sgst = $('#sgst').val();
		var igst = $('#igst').val();
		var roundOff = $('#roundOff').val();
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





		if (discount > 0) {

			a = ((parseFloat(amo) * parseFloat(discount)) / 100);
			var a1 = a.toFixed(2);
			var a2 = parseFloat(amo) - parseFloat(a1);
			var a3 = a2.toFixed(2);
			k = a3;
			$('#discountamount' + totals + '').val(a1);
			$('#taxableamount' + totals + '').val(a3);
			$('#total' + totals + '').val(a3);
		}


		var sub_tot = 0;
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

				n = parseFloat(sub_tot) + parseFloat(h1) + parseFloat(loadingamount) + parseFloat(freightamount);
				var n1 = n.toFixed(2);
				$('#grandtotal').val(n1);
			}


			if (roundOff > 0) {
				l = parseFloat(sub_tot) + parseFloat(h1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
				l1 = l.toFixed(2);
				$('#grandtotal').val(l1);
			}


		}

	}




	// $('#document').ready(function(){
	// $('#checkbox').click(function(){
	// if($(this).prop("checked")==true)
	// {
	// $('#check').show();
	// $('#imaddress').show();

	// }
	// else if($(this).prop("checked")==false)
	// {
	// $('#check').hide();
	// $('#imaddress').hide();
	// }
	// });
	// });   


	function isNumberKey(evt) {
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
	$('.decimal').keyup(function() {
		var val = $(this).val();
		if (isNaN(val)) {
			val = val.replace(/[^0-9\.-]/g, '');
			if (val.split('.').length > 2)
				val = val.replace(/\.-+$/, "");
		}
		$(this).val(val);
	});
</script>
<table class="responsive table" width="100%">
	<thead>
		<tr>
			<th>&nbsp;&nbsp;&nbsp;&nbsp;HSN Code</th>

			<?php
			error_reporting(0);
			$itemcode = $this->db->select('itemcode')->where('id', 1)->get('preference_settings')->row()->itemcode;
			if ($itemcode == 1) { ?>
				<th>&nbsp;&nbsp;&nbsp;&nbsp;Item Code</th>
			<?php } ?>

			<th>&nbsp;&nbsp;&nbsp;&nbsp;Item Name</th>
			<th>&nbsp;&nbsp;UOM</th>
			<th>&nbsp;&nbsp;Grade</th>
			<th>&nbsp;&nbsp;Weight</th>
			<th>&nbsp;&nbsp;Qty</th>
			<th>&nbsp;&nbsp;Value</th>
			<th>&nbsp;&nbsp;Remarks</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($result as $rows) {
			$hsnno = explode('||', $rows['hsnno']);
			$itemcodes = explode('||', $rows['itemcode']);
			$heatno = explode('||', $rows['heatno']);
			$itemid = explode('||', $rows['itemid']);
			$itemname = explode('||', $rows['itemname']);
			$item_desc = explode('||', $rows['item_desc']);
			$uom = explode('||', $rows['uom']);
			$selectedGrades = explode('||', $rows['grade']);
			$weight = explode('||', $rows['weight']);
			$qty = explode('||', $rows['qty']);
			$price = explode('||', $rows['price']);
			$remarks = explode('||', $rows['remarks']);

			$count = count($itemname);
			for ($i = 0; $i < $count; $i++) {


		?>
				<tr>
					<!-- <td><input class="form-control" id="itemno" type="text" name="itemno[]" value="">
<div id="itemno_valid"></div>
</td> -->
					<td><input class="form-control clear" parsley-trigger="change" readonly id="hsnnoa<?php echo $i; ?>" type="text" name="hsnno[]" value="<?php echo $hsnno[$i]; ?>">
						<div id="hsnno_valid"></div>
					</td>
					<?php $itemcode = $this->db->select('itemcode')->where('id', 1)->get('preference_settings')->row()->itemcode;
					if ($itemcode == 1) { ?>
						<td><input class="form-control clear" parsley-trigger="change" id="itemcodea<?php echo $i; ?>" type="text" name="itemcode[]" value="<?php echo $itemcodes[$i]; ?>">
							<div id="itemcode_valid"></div>
						</td>
					<?php } ?>


					<td><input class="form-control clear" parsley-trigger="change" required id="itemnamea<?php echo $i; ?>" type="text" name="itemname[]" value="<?php echo $itemname[$i]; ?>">
						<div id="itemname_valida<?php echo $i; ?>"></div><input class="form-control" type="text" name="item_desc[]" value="<?php echo $item_desc[$i]; ?>" style="margin-top: 2px;"><input type="hidden" name="itemid[]" id="itemid<?php echo $i; ?>" value="<?php echo $itemid[$i]; ?>">
					</td>
					<td><input class="form-control clear" value="<?php echo $uom[$i]; ?>" readonly id="uoma<?php echo $i; ?>" type="text" name="uom[]" autocomplete="off"></td>

					<td>
						<!-- <input class="form-control clear" value="<?php echo $grade[$i]; ?>" readonly id="gradea<?php echo $i; ?>" type="text" name="grade[]"  autocomplete="off"> -->

						<select name="grade[]" id="gradea<?php echo $i; ?>" data-id="<?php echo $i; ?>"
							class="form-control grade_class" style="width: 120px;">
							<option value="">Select Grade</option>
							<?php
							$grades = $this->db->where('status', 1)->get('grade')->result();
							foreach ($grades as $g) { ?>
								<option value="<?php echo $g->id; ?>"
									<?php if (isset($selectedGrades[$i]) && $g->id == $selectedGrades[$i]) echo 'selected'; ?>>
									<?php echo $g->grade; ?>
								</option>
							<?php } ?>
						</select>


					</td>


					<td><input class="form-control clear" parsley-trigger="change" required id="weight<?php echo $i; ?>" type="text" name="weight[]" value="<?php echo $weight[$i]; ?>" autocomplete="off"></td>
					<td><input class="form-control clear" parsley-trigger="change" required id="qtya<?php echo $i; ?>" type="text" name="qty[]" value="<?php echo $qty[$i]; ?>" autocomplete="off"></td>
					<td><input class="form-control clear" parsley-trigger="change" required id="price<?php echo $i; ?>" type="text" name="price[]" value="<?php echo $price[$i]; ?>" autocomplete="off"></td>
					<td><input class="form-control clear" id="remarks" type="text" name="remarks[]" value="<?php echo $remarks[$i]; ?>" autocomplete="off"></td>
					<td><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td>
				</tr>
		<?php
			}
		}
		?>
	</tbody>
	<tbody id="append"></tbody>
	<tfoot>
		<tr>
			<td colspan="6">&nbsp;</td>
			<td><button type="button" class="btn btn-info addappend"><i class="fa fa-plus"></i></button><input type="hidden" id="hide" value="1"></td>
		</tr>
	</tfoot>
</table>

<div class="col-sm-offset-10">
	<label>Approximate Value</label>
	<input type="text" required class="form-control" name="approximate_value" id="approximate_value" value="<?php echo $rows['approximate_value']; ?>" style="width:150px;">
</div>
<br>

<div class="col-sm-offset-4">
	<button class="btn btn-info" id="submit" name="save" value="save">Update</button>
	<!-- <button  class="btn btn-primary"  name="print" id="print" value="print">Print</button>
<button type="reset"  class="btn btn-default" id="">Reset</button> -->
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.remove').click(function() {
			$(this).parents('tr').remove();
		});

		<?php
		foreach ($result as $rows) {
			$hsnno = explode('||', $rows['hsnno']);
			$itemcode = explode('||', $rows['itemcode']);
			$itemname = explode('||', $rows['itemname']);
			$uom = explode('||', $rows['uom']);
			$qty = explode('||', $rows['qty']);
			$remarks = explode('||', $rows['remarks']);


			$count = count($itemname);
			for ($i = 0; $i < $count; $i++) {
		?>

				$("#itemnamea<?php echo $i; ?>").autocomplete({
					source: function(request, response) {
						$.ajax({
							url: "<?php echo base_url(); ?>dcbill/autocomplete_itemname",
							data: {
								keyword: $("#itemnamea<?php echo $i; ?>").val()
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
						$('#itemnamea<?php echo $i; ?>').val(ui.item.value);
						$.post('<?php echo base_url(); ?>dcbill/get_itemnames', {
							name: name
						}, function(rest) {
							var obj = jQuery.parseJSON(rest);
							$('#hsnnoa<?php echo $i; ?>').val(obj.hsnno);
							$('#itemcodea<?php echo $i; ?>').val(obj.itemcode);
							$('#uoma<?php echo $i; ?>').val(obj.uom);
							$('#itemid<?php echo $i; ?>').val(obj.itemid);
							$('#gradea<?php echo $i; ?>').val(obj.grade);
							$('#qtya<?php echo $i; ?>').val('');
							$('#qtya<?php echo $i; ?>').focus();
						});

						if (name != '') {
							$.post('<?php echo base_url(); ?>dcbill/check_itemname', {
								itemname: name
							}, function(res) {
								if (res > 0) {
									$('#itemname_valida<?php echo $i; ?>').html('<span><font color="green">Available!</span>');
									$('#submit').attr('disabled', false);
									$('#print').attr('disabled', false);
								} else {
									$('#itemname_valida<?php echo $i; ?>').html('<span><font color="red"> Not Available !</span>');
									$('#submit').attr('disabled', true); //set button enable 
									$('#print').attr('disabled', true); //set button enable 
									//set button enable     
								}
							});
							return false;
						}
					}
				});

				$('#itemnamea<?php echo $i; ?>').blur(function() {
					var itemname = $('#itemnamea<?php echo $i; ?>').val();
					var mobileno = $('#mobileno').val();
					// var qty=$('#qty').val();
					if (itemname != '') {
						$.post('<?php echo base_url(); ?>dcbill/check_itemname', {
							itemname: itemname
						}, function(res) {
							if (res > 0) {
								$('#itemname_valida<?php echo $i; ?>').html('<span><font color="green">Available!</span>');
								$('#submit').attr('disabled', false);
								$('#print').attr('disabled', false);
							} else {
								$('#itemnamea<?php echo $i; ?>').focus();
								$('#itemname_valida<?php echo $i; ?>').html('<span><font color="red"> Not Available !</span>');
								$('#submit').attr('disabled', true); //set button enable 
								$('#print').attr('disabled', true); //set button enable 
							}
						});
						return false;
					}
				});


				$("#itemcodea<?php echo $i; ?>").autocomplete({
					source: function(request, response) {
						$.ajax({
							url: "<?php echo base_url(); ?>dcbill/autocomplete_itemcode",
							data: {
								keyword: $("#itemcodea<?php echo $i; ?>").val()
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
						$('#itemcodea<?php echo $i; ?>').val(ui.item.value);
						$.post('<?php echo base_url(); ?>dcbill/get_itemcodes', {
							name: name
						}, function(rest) {
							var obj = jQuery.parseJSON(rest);
							$('#hsnnoa<?php echo $i; ?>').val(obj.hsnno);
							$('#itemnamea<?php echo $i; ?>').val(obj.itemname);
							$('#uoma<?php echo $i; ?>').val(obj.uom);
							$('#itemid<?php echo $i; ?>').val(obj.itemid);
							$('#qtya<?php echo $i; ?>').val('');
							$('#qtya<?php echo $i; ?>').focus();
						});

						if (name != '') {
							$.post('<?php echo base_url(); ?>dcbill/check_itemcode', {
								itemcode: name
							}, function(res) {
								if (res > 0) {
									$('#itemcode_valida<?php echo $i; ?>').html('<span><font color="green">Available!</span>');
									$('#submit').attr('disabled', false);
									$('#print').attr('disabled', false);
								} else {
									$('#itemcode_valida<?php echo $i; ?>').html('<span><font color="red"> Not Available !</span>');
									$('#submit').attr('disabled', true); //set button enable 
									$('#print').attr('disabled', true); //set button enable 
									//set button enable     
								}
							});
							return false;
						}
					}
				});

				$('#itemcodea<?php echo $i; ?>').blur(function() {
					var itemcode = $('#itemcodea<?php echo $i; ?>').val();
					var mobileno = $('#mobileno').val();
					// var qty=$('#qty').val();
					if (itemcode != '') {
						$.post('<?php echo base_url(); ?>dcbill/check_itemcode', {
							itemcode: itemcode
						}, function(res) {
							if (res > 0) {
								$('#itemcode_valida<?php echo $i; ?>').html('<span><font color="green">Available!</span>');
								$('#submit').attr('disabled', false);
								$('#print').attr('disabled', false);
							} else {
								$('#itemcodea<?php echo $i; ?>').focus();
								$('#itemcode_valida<?php echo $i; ?>').html('<span><font color="red"> Not Available !</span>');
								$('#submit').attr('disabled', true); //set button enable 
								$('#print').attr('disabled', true); //set button enable 
							}
						});
						return false;
					}
				});

				$('.grade_class').change(function(){
				    // alert();
					 var grade = $('#gradea<?php echo $i; ?>').val();
					 console.log(grade);
					 $.post('<?php echo base_url(); ?>Purchase/get_hsnnos',{grade:grade},function(datas){
						 var obj=jQuery.parseJSON(datas);
						 $('#hsnnoa<?php echo $i; ?>').val(obj.hsnno);
					 });
				});

		<?php }
		} ?>


		$('.addappend').click(function() {
			var start = $('#hide').val();
			var total = Number(start) + 1;
			$('#hide').val(total);
			var tbody = $('#append');
			$('<tr class="clears"><td><input class="form-control clear" readonly id="hsnno' + total + '" parsley-trigger="change" required type="text" name="hsnno[]" required value=""><div id="hsnno_valid' + total + '"></td>'
				<?php $itemcode = $this->db->select('itemcode')->where('id', 1)->get('preference_settings')->row()->itemcode;
				if ($itemcode == 1) { ?> +
					'<td><input class="form-control clear" parsley-trigger="change" id="itemcode' + total + '" type="text" name="itemcode[]" value="">'
				<?php } ?>

				+
				'<td><input class="form-control clear" parsley-trigger="change" required id="itemname' + total + '" type="text" name="itemname[]" value=""><div id="itemname_valid' + total + '"></div><input class="form-control" type="text" name="item_desc[]" value="" style="margin-top: 2px;" ><input type="hidden" id="itemid' + total + '" name="itemid[]" value=""></td> <td><input class="form-control clear" readonly id="uom' + total + '" type="text" name="uom[]"  autocomplete="off"><div id="qty_valid"></div></td><td><select name="grade[]" id="grade' + total + '" data-id="' + total + '" class="form-control grade_class"style="width: 120px;"><option value="">Select Grade</option><?php foreach ($grades as $g) { ?><option value="<?php echo $g->id; ?>"><?php echo $g->grade; ?></option><?php } ?></select></td><td><input class="form-control clear decimal" required id="weight' + total + '" type="text" name="weight[]" autocomplete="off" value="" onkeypress="return isNumberKey(event)" required ></td><td><input class="form-control clear decimal" required id="qty' + total + '" type="text" parsley-trigger="change" required name="qty[]" autocomplete="off" value="" onkeypress="return isNumberKey(event)" required ><div id="qty_valid' + total + '"></td>' +
				'<td><input class="form-control clear"  id="price' + total + '" type="text" name="price[]" autocomplete="off" ></td>' +
				'<td><input class="form-control clear"  id="remarks' + total + '" type="text" name="remarks[]" autocomplete="off" ><div id="qty_valid' + total + '"></td>' +
				'<td><button type="button" class="btn btn-danger remove"> <i class="fa fa-remove"></i></button></td></tr><div id="table' + total + '"></div>').appendTo(tbody);
			$('#itemno' + total + '').focus();

			$('.remove').click(function() {
				$(this).parents('tr').remove();
			});

			$("#itemname" + total + "").autocomplete({
				source: function(request, response) {
					$.ajax({
						url: "<?php echo base_url(); ?>dcbill/autocomplete_itemname",
						data: {
							keyword: $("#itemname" + total + "").val()
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
					$('#itemname' + total + '').val(ui.item.value);
					$.post('<?php echo base_url(); ?>dcbill/get_itemnames', {
						name: name
					}, function(rest) {
						var obj = jQuery.parseJSON(rest);
						$('#hsnno' + total + '').val(obj.hsnno);
						$('#itemcode' + total + '').val(obj.itemcode);
						$('#uom' + total + '').val(obj.uom);
						$('#itemid' + total + "").val(obj.itemid);
						$('#grade' + total + "").val(obj.grade);
						$('#qty' + total + '').val('');
						$('#qty' + total + '').focus();
					});

					if (name != '') {
						$.post('<?php echo base_url(); ?>dcbill/check_itemname', {
							itemname: name
						}, function(res) {
							if (res > 0) {
								$('#itemname_valid' + total + '').html('<span><font color="green">Available!</span>');
								$('#submit').attr('disabled', false);
								$('#print').attr('disabled', false);
							} else {
								$('#itemname_valid' + total + '').html('<span><font color="red"> Not Available !</span>');
								$('#submit').attr('disabled', true); //set button enable 
								$('#print').attr('disabled', true); //set button enable 
								//set button enable     
							}
						});
						return false;
					}
				}
			});

			$('#itemname' + total + '').blur(function() {
				var itemname = $('#itemname' + total + '').val();
				if (itemname != '') {
					$.post('<?php echo base_url(); ?>dcbill/check_itemname', {
						itemname: itemname
					}, function(res) {
						if (res > 0) {
							$('#itemname_valid' + total + '').html('<span><font color="green">Available!</span>');
							$('#submit').attr('disabled', false);
							$('#print').attr('disabled', false);
						} else {
							$('#itemname_valid' + total + '').html('<span><font color="red"> Not Available !</span>');
							$('#submit').attr('disabled', true); //set button enable 
							$('#print').attr('disabled', true); //set button enable 
							//set button enable     
						}
					});
					return false;
				}
			});

			$("#itemcode" + total + "").autocomplete({
				source: function(request, response) {
					$.ajax({
						url: "<?php echo base_url(); ?>dcbill/autocomplete_itemcode",
						data: {
							keyword: $("#itemcode" + total + "").val()
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
					$('#itemcode' + total + '').val(ui.item.value);
					$.post('<?php echo base_url(); ?>dcbill/get_itemcodes', {
						name: name
					}, function(rest) {
						var obj = jQuery.parseJSON(rest);
						$('#hsnno' + total + '').val(obj.hsnno);
						$('#itemname' + total + '').val(obj.itemname);
						$('#uom' + total + '').val(obj.uom);
						$('#qty' + total + '').val('');
						$('#qty' + total + '').focus();
					});

					if (name != '') {
						$.post('<?php echo base_url(); ?>dcbill/check_itemcode', {
							itemcode: name
						}, function(res) {
							if (res > 0) {
								$('#itemcode_valid' + total + '').html('<span><font color="green">Available!</span>');
								$('#submit').attr('disabled', false);
								$('#print').attr('disabled', false);
							} else {
								$('#itemcode_valid' + total + '').html('<span><font color="red"> Not Available !</span>');
								$('#submit').attr('disabled', true); //set button enable 
								$('#print').attr('disabled', true); //set button enable 
								//set button enable     
							}
						});
						return false;
					}
				}
			});


			$('.grade_class').change(function() {
				// alert();
				var total = $(this).attr('data-id');
				var grade = $(this).val();
				$.post('<?php echo base_url(); ?>Purchase/get_hsnnos', {
					grade: grade
				}, function(datas) {
					var obj = jQuery.parseJSON(datas);

					$('#hsnno' + total).val(obj.hsnno);
				});

			});


			$('#itemcode' + total + '').blur(function() {
				var itemcode = $('#itemcode' + total + '').val();
				if (itemcode != '') {
					$.post('<?php echo base_url(); ?>dcbill/check_itemcode', {
						itemcode: itemcode
					}, function(res) {
						if (res > 0) {
							$('#itemcode_valid' + total + '').html('<span><font color="green">Available!</span>');
							$('#submit').attr('disabled', false);
							$('#print').attr('disabled', false);
						} else {
							$('#itemcode_valid' + total + '').html('<span><font color="red"> Not Available !</span>');
							$('#submit').attr('disabled', true); //set button enable 
							$('#print').attr('disabled', true); //set button enable 
							//set button enable     
						}
					});
					return false;
				}
			});

		});
	});
</script>
<?php $data=$this->db->get('profile')->result();
	foreach($data as $r)
	?>
		<title> <?php echo $r->companyname;?></title>
		<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">

		<style type="text/css">
			.forms{ }
			.forms input{ width: 95%; }
			.uppercase { text-transform: uppercase; }
			.success{ display: none; }
			.unsuccess{ display: none; }
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

		<div class="alert btn-info alert-micro btn-rounded pastel light dark success" >
		<a href="#" class="close" data-dismiss="alert">&times;</a>Purchase Deleted Successfully !
		</div>

		<div class="alert btn-info alert-micro btn-rounded pastel light dark unsuccess" >
		<a href="#" class="close" data-dismiss="alert">&times;</a>Purchase Deleted Unsuccessfully 
		</div>
		<div class="row">
			<div class="col-sm-12">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
					<header class="panel-heading" style="color:rgb(255, 255, 255)">
						<i class="zmdi zmdi-shopping-cart">&nbsp;Staff List</i>
					</header>
					<div class="card-box table-responsive">
						<div class="dropdown pull-right"><a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false"></a></div>
						<!-- <form name="from" id="form-filter" method="post" >
						<table >
						<tr>
						<input type="hidden" name="invoiceno" id="invoiceno" value="">
						<td>
						<div class="col-sm-12">
						<input type="text" class="form-control" name="invoiceno" id="invoiceno" style="font-size:16px;width: 140px;" value="" placeholder="Invoice No">
						</div>
						</td>

						<td>
						<div class="col-sm-12">
						<input type="text" class="form-control" name="Staffname" id="Staffname" style="font-size:16px;width: 255px;" value="" placeholder="Staff Name">
						</div>
						</td>
						<td>
						<div class="col-sm-12">
						<input type="text" class="form-control  datepicker-autoclose" name="fromdate" id="fromdate" style="font-size:16px;width:143px;" value="" placeholder="From Date">
						</div>
						</td>
						<td>
						<input type="text" class="form-control datepicker-autoclose" name="todate" id="todate" style="font-size:16px;width:143px;" value="" Placeholder="To Date">
						</td>
						<td>&nbsp;</td>       
						<td>
						</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>

						<button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
						<button type="button" id="btn-reset" class="btn btn-default">Reset</button>

						</td>
						</tr>
						</table>
						</form> -->
						<br>
						<table id="staff" class="table table-striped table-bordered">
						<thead>
						<tr>
						<th>S.No</th>
						<th>Date</th>
						<th>Staff Id</th>
						<th>Staff Name</th>
						<th>Mobile No</th>
						<th>Age</th>
                        <th>Salary</th>
						<th>Action</th>
						</tr>
						</thead>
						<tbody>
							<?php
							$i=1;
							foreach($staff as $s){?>
							<tr>
								<td><?php echo $i++;?></td>
								<td><?php echo $s->date;?></td>
								<td><?php echo $s->staff_id;?></td>
								<td><?php echo $s->staff_name;?></td>
								<td><?php echo $s->mobileno;?></td>
								<td><?php echo $s->age;?></td>
								<td><?php echo $s->salary;?></td>
								
								<td>
								<div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Manage
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                <li><a href="" >View</a></li>
                                                <li><a href="<?php echo base_url();?>attendance/edit/<?php echo $s->id;?>">Edit</a></li>
                                                <li><a class="delete" onclick="return confirmDelete()" href="<?php echo base_url();?>attendance/delete/<?php echo $s->id;?>	">Delete</a></li>
                                                <!-- <td><a class='delete' id='del_".$row->id."' href='delete_table.php?lang=".LANG."&id=" . $row->id . "' onclick="return confirmDelete()">Delete</a></td>
                                           -->
                                           
                                               
                                                </ul>
                                                </div></td>

							</tr>

							
						</tbody>
						<?php }?>
						</table><br><br><br>
						<!-- <div align="center">
							<button id="print" class="btn btn-info" value="Print">Print</button>
						</div> -->
					</div>
				</section>
			</div>
		</div>
		</div>


		<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
		<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
		<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> 


	<script>
		function confirmDelete(){
			if(confirm("Are You Sure You Want To  Delete a Staff Record ?")==true)
			{
				alert("Staff Deleted Successfully");
				return true;
			}
			else
			{
				alert('Staff Deleted Cancelled by User..!!!');
				return false;
			}
		}
	</script>
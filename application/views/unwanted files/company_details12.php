	<!-- DataTables -->


	<?php $data=$this->db->get('profile')->result();
	foreach($data as $r)
	?>
	<title>  <?php echo $r->companyname;?></title>
	<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
	<style type="text/css">
		.uppercase{	text-transform: uppercase; }
	</style>


	<div class="content-page">
		<div class="content">
			<div class="container">
				<?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
				<div class="alert btn-info alert-micro btn-rounded pastel light dark" >
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

				<?php 
				foreach($profile as $row)
					foreach($login as $lo)
					{
				?>
				<div class="row">
					<div class="col-sm-12">
						<section>
							<header class="panel-heading" style="color:rgb(255, 255, 255);background: #2477c9;">
								<i class="zmdi zmdi-account"><span style="font-family: 'Quicksand', sans-serif;padding-left: 6px;">Company Profile</span></i>
							</header>

							<div class="card-box">
								<div class="row">
									<form class="form-horizontal"  method="post" action="<?php echo base_url();?>profile/insert">
										<div class="form-group">
											<label class="col-md-2 control-label">Company Name</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="companyname"  value="<?php echo $row['companyname'];?>" id="alloptions"  maxlength="35" onkeypress="return onlyAlphabets(event)">
											</div>
											<label class="col-md-2 control-label">Phone No</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="phoneno" id="moreoptions" maxlength="12"  value="<?php echo $row['phoneno'];?>" >
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Software Name</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="softwarename"  value="<?php echo $row['softwarename'];?>" id="alloptions"  maxlength="35" onkeypress="return onlyAlphabets(event)">
											</div>
											<label class="col-md-2 control-label">Mobile No</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="mobileno" id="moreoptions" maxlength="10"  value="<?php echo $row['mobileno'];?>" >
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Address Line1</label>
											<div class="col-md-4">
												<input type="text" class="form-control" style="font-size10px" name="address1" value="<?php echo $row['address1'];?>">
											</div>
											<label class="col-md-2 control-label">Address Line2</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="address2" id="address2" value="<?php echo $row['address2'];?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-2 control-label">Location</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="city" value="<?php echo $row['city'];?>">
											</div>
											<label class="col-md-2 control-label">Pincode</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo $row['pincode'];?>" onkeypress="return isNumberKey(event)">
											</div>
										</div>


										<div class="form-group">
											<label class="col-md-2 control-label" for="inputPassword">State</label>
											<div class="col-md-4">
												<select  autocomplete="off"  class="form-control decimal" value="<?php echo $row['state'];?>"  name="state" id="state">
										



											<option value="">Select state</option>
											<?php
											$state=$this->db->where('status',1)->get('stateCode')->result_array();
											foreach ($state as $rows)
											{
											echo'<option value="'.$rows['state'].'">'.$rows['state'].'</option>';
											}
											?>
											</select>
											</div>
							
                                            <div class="form-group">
											<label class="col-md-2 control-label" for="inputPassword">State Code</label>
											<div class="col-md-4">
												<input type="text" name="statecode" class="form-control" id="statecode" parsley-trigger="change" readonly required placeholder="Enter State Code" value="">
											</div>
										</div>



										
										<div class="form-group">
											<label class="col-md-2 control-label">Website</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="website" value="<?php echo $row['website'];?>">
											</div>
											<label class="col-md-2 control-label">GSTIN</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="gstin" value="<?php echo $row['gstin'];?>">
											</div>
											
										</div>

										<div class="form-group">
											<label class="col-md-2 control-label">Pan No</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="aadharno" value="<?php echo $row['aadharno'];?>">
											</div>
											<label class="col-md-2 control-label">User Name<span style="color:red;">*</span></label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="username" value="<?php echo $lo['username'];?>" >
												<input type="hidden" name="id" class="form-control" id="" placeholder="" value="<?php echo $lo['id'];?>" required>
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-2 control-label">Password<span style="color:red;">*</span></label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="password" id="password" value="<?php echo $lo['password'];?>" >
											</div>
											<label class="col-md-2 control-label">Bank Name</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="bankname" value="<?php echo $row['bankname'];?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-2 control-label">Account Number</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="accountno" id="pincode" value="<?php echo $row['accountno'];?>" onkeypress="return isNumberKey(event)">
											</div>
											<label class="col-md-2 control-label">Bank Branch</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="bankbranch" value="<?php echo $row['bankbranch'];?>">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">IFSC Code</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="ifsccode" id="pincode" value="<?php echo $row['ifsccode'];?>" >
											</div>
										</div>
										<div class="col-sm-offset-6">
											<button  class="btn btn-info" id="submit">Add Profile</button>
										</div>
									</form>
								</div>
							</div>
						</section>
					</div><!-- sm-12 -->
				</div><!--row-->
				<?php }?>
				<!-- end col -->

				<div class="row">
					<div class="col-sm-12">
						<section>
							<header class="panel-heading" style="color:rgb(255, 255, 255);background: #2477c9;">
								<i class="zmdi zmdi-account"><span style="font-family: 'Quicksand', sans-serif;padding-left: 6px;">Upload Logo</span></i>
							</header>
							<div class="card-box">
								<form class="form-horizontal" name="form" id="form" action="<?php echo base_url();?>profile/upload" method="post" enctype="'multipart/form-data'" method="post" enctype='multipart/form-data' >        
									<div class="form-group last">
										<label class="control-label col-md-3">Upload Logo</label>
										<div class="col-md-6">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
													<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
												<div>
													<span class="btn btn-white btn-file">
														<span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
														<span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
														<input type="file" name="file" class="default" required/>
													</span>
													<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
												</div>
											</div>
										</div>
										<?php foreach($logo as $key) 
										?>
										<div class="col-md-3">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 300px; height: 180px;">
													<img src="<?php echo base_url();?>upload/<?php echo @$key->image;?>">
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
												<div>&nbsp;</div>
											</div>
										</div>
										<?php ?>
									</div>
								

									<button type="submit" class="btn btn-info col-sm-offset-3" id="submit">Upload Logo</button>
								</form>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>


	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script>
	var resizefunc = [];
	</script>
	<!-- jQuery  -->
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/detect.js"></script>
	<script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
	<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
	<!-- Datatables-->
	<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
	<!-- App js -->
	<script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>  
	<script src="<?php echo base_url();?>assets/plugins/fileuploads/js/dropify.min.js"></script>
	<script type="text/javascript">
	$('.dropify').dropify({
		messages: {
			'default': 'Drag and drop a file here or click',
			'replace': 'Drag and drop or click to replace',
			'remove': 'Remove',
			'error': 'Ooops, something wrong appended.'
		},
		error: {
			'fileSize': 'The file size is too big (1M max).'
		}
	});
	</script>      


	<script type="text/javascript">

		$('#state').click(function() {
var state = $('#state').val();
if (state !== '') {
$.post('<?php echo base_url();?>customer/get_stateCode', {
state: state
}, 
function(data) {

var obj=jQuery.parseJSON(data);
$('#statecode').val(obj.stateCode);
});
}
});
	$(document).ready(function()
	{
		$(".select2").select2();
		$(".select2-limiting").select2({ placeholder: "Select a state" });
	})

	$('input#defaultconfig').maxlength()

	$('input#alloptions').maxlength({
		alwaysShow: true,
		warningClass: "label label-success",
		limitReachedClass: "label label-danger",
		separator: ' out of ',
		preText: 'You typed ',
		postText: ' chars available.',
		validate: true
	});

	$('input#moreoptions').maxlength({
		alwaysShow: true,
		warningClass: "label label-success",
		limitReachedClass: "label label-danger"
	});

	</script>

	<script type="text/javascript">
	//   //number..........................
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
		return true;
	}
	$('.decimal').keyup(function(){
		var val = $(this).val();
		if(isNaN(val)){
			val = val.replace(/[^0-9\.]/g,'');
			if(val.split('.').length>2)
				val =val.replace(/\.+$/,"");
		}
		$(this).val(val);
	});
	</script>
<?php $data=$this->db->get('profile')->result();
                        foreach($data as $r)
                        ?>
<title>
  <?php echo $r->companyname;?>
</title>
<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<style type="text/css">
.forms {}

.forms input {
  width: 95%;
}

.forms select {
  width: 95%;
}

.uppercase {
  text-transform: uppercase;
}
</style>
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container">
      <!--                                                         <h4 class="page-title">Tax Type</h4>
-->
      <?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
      <div class="alert btn-info alert-micro btn-rounded pastel light dark">
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
      <div class="row">
      <?php foreach($staff as $s){?>
        <div class="col-sm-12">
          <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
            <header class="panel-heading" style="color:rgb(255, 255, 255)">
              <i class="zmdi zmdi-account">&nbsp;Edit Staff -(<?php echo $s->staff_id;?>)</i> <span style="float: right;"  >
          
            </header>
            <div class="card-box">
              <div class="row">
            
                <form class="form-horizontal" role="form" data-parsley-validate novalidate method="post" action="<?php echo base_url();?>attendance/update">
                <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $s->id;?>">
                <input type="hidden" id="staff_id" name="staff_id" value="<?php echo $s->staff_id;?>" >
                <div class="forms">
				  <!--ROW 1 -->
                  <div class="col-lg-4">
                      <div class="form-group">
                      <label for="inputStandard">Staff Name<span style="color:red;">&nbsp;*</span></label>
                      
                      <input type="text" name="staff_name" id="staff_name" class="form-control" required parsley-trigger="change" value="<?php echo $s->staff_name;?>" placeholder="Staff Name" required>
                        <div id="type_valid"></div>
                      </div>
                    </div>
                    <div class="col-lg-4">

                    <div class="form-group">
                        <label for="inputPassword">Mobile No</label><span style="color:red;">&nbsp;*</span></label>
                        <input type="text" name="mobileno" class="form-control" id="mobileno" value="<?php echo $s->mobileno;?>" placeholder="Enter The Mobile Number" data-parsley-type="number"  required data-parsley-length="[10,12]" >
                       
                      </div>
                     
                    </div>
                    <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputPassword">Alternate Mobile No</label><span style="color:red;">&nbsp;*</span></label>
                        <input type="text" name="amobileno" class="form-control" id="amobileno" value="<?php echo $s->amobileno;?>"  required data-parsley-length="[10,12]"    placeholder="Enter the  Mobile Number">
                       
                      </div>
                      
                    </div>
					<div class="clearfix"></div>
					
					<!--ROW 2 -->
                    <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputStandard">Date Of Birth<span style="color:red;">&nbsp;*</span></label>
                        <input type="text" name="dob" id="dob"  value="<?php echo $s->dob;?>" class="form-control" required parsley-trigger="change" placeholder=" Enter Dob" required>
                        <div id="type_valid"></div>
                      </div>
                    </div>

                    <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputStandard">Age<span style="color:red;">&nbsp;*</span></label>
                        <input type="text" name="age" id="age" class="form-control" value="<?php echo $s->age;?>"  parsley-trigger="change" placeholder=" Enter Dob" required>
                        <div id="type_valid"></div>
                      </div>
                    </div>
					<div class="col-lg-4">
          <div class="form-group">
                        <label for="inputPassword">E-Mail</label>
                        <input type="email"   name="email"  value="<?php echo $s->email;?>" class="form-control" id="email" placeholder="Enter The E-Mail">
                      </div>
                    </div>
			
                    <div class="clearfix"></div>
                  
					<!--ROW 3 -->

          <div class="col-lg-4">
                      <div class="form-group">
                        <label for="inputPassword">Address Line 1<span style="color:red;">&nbsp;*</span></label>
                        <input type="text" name="address1" class="form-control" id="address1" value="<?php echo $s->address1;?>" parsley-trigger="change" required placeholder="Enter The Address">
                       
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="inputPassword">Address Line 2<span style="color:red;">&nbsp;*</span></label>
                        <input type="text" name="address2" class="form-control" id="address2" value="<?php echo $s->address2;?>"  parsley-trigger="change" required placeholder="Enter The Address">
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="inputPassword">City<span style="color:red;">&nbsp;*</span></label>
                        <input type="text" parsley-trigger="change" required name="city" value="<?php echo $s->city;?>"  class="form-control" id="city" placeholder="Enter The City">
                      </div>
                    </div>
                 
                   
                 
					<div class="clearfix"></div>
					
					<!--ROW 4 -->
          <div class="col-lg-4">
                      <div class="form-group">
                        <label for="inputPassword">State<span style="color:red;">&nbsp;*</span></label>
                        <input type="text" name="state" class="form-control" id="state" value="<?php echo $s->state;?>"  placeholder="Enter The State"  parsley-trigger="change" required >
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="inputPassword">Pincode<span style="color:red;">&nbsp;*</span></label>
                        <input type="text" name="pincode" class="form-control" value="<?php echo $s->pincode;?>"  onkeypress="return isNumberKey(event)" id="pincode" parsley-trigger="change" required placeholder="Enter The Pincode">
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="inputPassword">Referred By</label>
                        <input type="text" name="referred" class="form-control" value="<?php echo $s->referred;?>"  id="referred" parsley-trigger="change"  placeholder="Enter The referred name">
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="inputPassword">Salary<span style="color:red;">&nbsp;*</span></label>
                        <input type="text" name="salary" class="form-control"  id="salary" value="<?php echo $s->salary;?>"  parsley-trigger="change" required placeholder="Enter The Salary">
                      </div>
                    </div>

                    <!-- <ROW 5> -->
                    
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="inputPassword">Salary Type</label>
                        <select name="salarytype" id="salarytype" required parsley-trigger="change"   placeholder="" class="form-control">
                        <option value="<?php echo $s->salarytype;?>"><?php echo $s->salarytype;?></option>
                        <option value="">Select</option>
                          <option value="Daily">Daily</option>
                          <option value="Weekly">Weekly</option>
                          <option value="Monthly">Monthly</option>

                        </select>
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="inputPassword">Salary Per Day </label>
                        <input type="text" name="perdaysalary" class="form-control" value="<?php echo $s->perdaysalary;?>"  id="perdaysalary" parsley-trigger="change"  placeholder="Enter The salary ">
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="inputPassword">OT(Over Time)</label>
                        <input type="text" name="ot" class="form-control" id="ot" value="<?php echo $s->ot;?>"  parsley-trigger="change"  placeholder="Enter The over time hours ">
                      </div>
                    </div>
                   
					
					
                     
                  </div>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <div class="col-lg-12" align="center">
                    
                    <button type="submit" id="submit" class="btn btn-primary">Update Staff</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                  <?php }?>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>
      <!-- end col -->
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
  <!-- App js -->
  <script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

  <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

  <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });


        
    </script>

  <script type="text/javascript">
 
    $('#phoneno').blur(function() {
      var phoneno = $('#phoneno').val();
      if (phoneno !== '') {
        $.post('<?php echo base_url();?>customer/get_phoneno', {
          phoneno: phoneno
        }, function(res) {
          if (res == 'yes') {
            alert("already exists");
            $('#phoneno').val('');
            $('#phoneno').focus();
          }
        });
      }
    });

    $('#accountname').blur(function(){
        var accountname=$(this).val();
        if(accountname!="")
        {
          $('#printname').val(accountname);
        }
        else
        {
          //$('#accountname').focus();
        }
    });

  
function upload_excel()
{
    $('#myModal').modal('show');
}
  //
  </script>
  <script type="text/javascript">
  $('#customername').keyup(function() {
    var name = $(this).val();
    var partytype = $('#partytype').val();
     if (partytype == '') {
        $('#partytype').focus();
        $('#type_valid').html('<div><font color="red">Select the party type</font></div>');
        $('#partytype').change(function() {
          $('#type_valid').html('');
        });
        return false
      }
    if (name != '') {
      $.post('<?php echo base_url();?>customer/getname', {
        name: name,partytype:partytype
      }, function(res) {


        if (res > 0) {

          $('#customername').focus();
          $('#name_valid').html('<span><font color="red">Name already taken!</span>');
          $('#submit').attr('disabled', true); //set button enable 
        } else {

          $('#name_valid').html('<span><font color="green">Available !</span>');
          $('#submit').attr('disabled', false); //set button enable     
        }
      });
      return false;
    }
  });

  //   //number..........................
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
      val = val.replace(/[^a-z^A-Z\.&-]/g, '');
      if (val.split('.').length > 2)
        val = val.replace(/\.&-+$/, "");
    }
    $(this).val(val);
  });
  </script>
  



	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Upload Party Details In Excel</h4>
				</div>
				<form action="<?php echo base_url();?>customer/upload_excel" method="post" class="form-horizontal" enctype='multipart/form-data'>
					<div class="modal-body form">
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">upload</label>
								<div class="col-md-9">
									<input name="file" id="resume" type="file">
									<span id="resume_valid"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary reg">Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>


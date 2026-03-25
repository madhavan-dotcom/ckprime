<?php 
	$data=$this->db->get('profile')->result();
	$discountBy=$this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
	$checkInvoiceType = $this->db->select('invoiceBy')->where('id',1)->get('preference_settings')->row()->invoiceBy;
	foreach($data as $r)
	?>
	<title> <?php echo $r->companyname;?></title>
	
	
	<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multiselect/css/bootstrap-select.css">
	<link href="<?php echo base_url();?>site_assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
         <link href="<?php echo base_url();?>site_assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<style type="text/css">
	input:read-only { background-color: rgba(169, 169, 169, 0.21);	color: #000;	}
	.forms{ }
	.forms input{ width: 95%; }
	.uppercase {text-transform: uppercase;}
	td,th	{	font-size: 12px;	color:black;	}
	.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
	width: 89%;
	}
	.againstdc	{	display: none;	}
	</style>
	<style type="text/css">
	textarea.form-control { min-height: 40px !important; }
	.myform {}
	.myform input[type="text"]{ width:100%; border: 1px solid #dcdcdc; border-radius: 4px; padding:8px; color: #435966;}
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
	<div class="row">
	<div class="col-sm-12">
	<section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
	<header class="panel-heading" style="color:rgb(255, 255, 255)">
	<i class="zmdi zmdi-shopping-cart">&nbsp;Daily Attendance Entry</i>
	</header>
	<div class="card-box" style="min-height: 500px;">
	<div class="row">
	<form class="form-horizontal"  method="post" action="<?php echo base_url();?>attendance/makeattendance"  >

	<div class="form-group ">
	<div class="col-md-8 forms">

	

	
    



	




	</div>
	
	</div>
	<div class="clearfix"></div>
   

	<table class="table">
	<tr>
                             
	<td style="width: 235px;"><input type="text" placeholder="Date" name="attendancedate" id="attendancedate" class="form-control date"></td>
                            
                             <td><button type="button" id="searchs" class="btn btn-success btn-custom" >Search</button></td>
                           </tr>
                           </table>
	<br>

                           <div class="attendancelist"></div>
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
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/multiselect/js/bootstrap-select.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

	<script src="<?php echo base_url();?>site_assets/plugins/timepicker/bootstrap-timepicker.js"></script>
       <script src="<?php echo base_url();?>site_assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

	   

	<script type="text/javascript">
	$('.colorpicker-default').colorpicker({ format: 'hex' });
	$('.colorpicker-rgba').colorpicker();
	
    // Time Picker
    $('.time').timepicker({
        defaultTime : ''
    });

    $('.date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format:'dd/mm/yyyy',
        endDate: "+d",
    });


	$( "#attendance" ).addClass( "active" );
        $('#attendance1').attr("class","active");
        $('.attendance').attr("style","display: block;");
	

	</script>

<script type="text/javascript">
  $(document).ready(function(){
      $('#attendances').change(function(){
        var attendances=$(this).val();
        if(attendances=='Present' || attendances=='Half Day')
        {
          $('#intime').attr('disabled',false);
          $('#outtime').attr('disabled',false);
		  $('#ot').attr('disables',false);

        }
        else
        {
          $('#intime').attr('disabled',true);
          $('#outtime').attr('disabled',true);
		  $('#ot').attr('disabled',true);
          $('#intime').val('');
          $('#outtime').val('');
		  $('#ot').val('');
        }

     });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#searchs').click(function(){
      var attendancedate=$('#attendancedate').val();
      if(attendancedate=='')
      {
        alert('Please Choose date');
        $('#attendancedate').focus();
        return false;
      }
      $('#searchs').text('Processing...');
      $('#searchs').attr('disabled',true);
      $.post('<?php echo base_url();?>attendance/entry',{'attendancedate':attendancedate},function(data){
        $('#searchs').text('Search');
        $('#searchs').attr('disabled',false);
          $('.attendancelist').html(data);
          $('.time').timepicker({
           defaultTime : ''
          });
      });

    });

  });
</script>



	
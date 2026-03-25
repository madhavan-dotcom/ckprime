  <?php $data=$this->db->get('profile')->result();
                        foreach($data as $r)
                        ?>
        <title> <?php echo $r->companyname;?></title>

<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

<style type="text/css">
    .uppercase{
        text-transform: uppercase;
    }
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
            <div class="alert btn-info btn-rounded alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print_r($msg); ?>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-sm-12">
                    <section>
                        <header class="panel-heading" style="color:rgb(255, 255, 255);background: #2477c9;">
                            <i class="fa  fa-cloud-download "></i><span style="font-family: 'Quicksand', sans-serif;padding-left: 6px;">Backup</span></header>
                            <div class="card-box">
                                <div class="row">
                                      <?php 
            for($i = 1; $i<= 1; $i++){
            
              if($i ==  1)  $type = 'fullbackup';
              // else if($i ==  2)$type = 'dcbill';
              
              // else if($i ==  3)$type = 'expense';
              // else if($i ==  4)$type = 'invoice';
            
              // else if($i ==  5)$type = 'quotation';
              // else if($i ==  6)$type = 'stock';
              // else if($i ==  7)$type = 'vat';
              // else if($i ==  8)$type=  'item';
              // else if($i ==  9)$type=  'membership';
            
              // else if($i ==  10)$type= 'collection';
              //else if($i  ==  11)$type= 'all';
              ?>
                                                
                            <!--        <form action="<?php echo base_url();?>admin/add_users/addusers" method="post" id="add_users" name="add_users" >
          --> 
<!--                           <td><?php echo ($type);?></td>
 -->
                    <div class="button-list">
                    <label>&nbsp;</label>
                    <label>&nbsp;</label>
                    <label>&nbsp;</label>
                     <a href="<?php echo base_url();?>backup/create/<?php echo $type;?>"><button type="button" class="btn btn-info btn-rounded waves-effect waves-light">
                        <span class="btn-label"><i class="zmdi zmdi-download"></i>
                        </span>Download</button></a> 
                      </div>
                 
                    
                     
                                    <!--    <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                                                Cancel
                                            </button>
                                        </div> -->
                                            <?php 
            }
            ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            
            
                    </div>




                    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
                    <script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
                    <script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('.decimal').keyup(function(){
                                var val = $(this).val();
                                if(isNaN(val)){
                                    val = val.replace(/[^0-9\.]/g,'');
                                    if(val.split('.').length>2)
                                        val =val.replace(/\.+$/,"");
                                }
                                $(this).val(val);
                            });
                            $('#submit').click(function(){
                                var taxtype=$('#taxtype');
                                var taxname=$('#taxname');
                                if(taxtype.val()=='')
                                {
                                    taxtype.focus();
                                    $('#tax_valid').html('<span><font color="red"> Enter the taxtype</span>');
                                    taxtype.keyup(function(){
                                        $('#tax_valid').html('');
                                    });
                                    return false;
                                }
                                if(taxname.val()=='')
                                {
                                    taxname.focus();
                                    $('#taxname_valid').html('<span><font color="red"> Enter the tax</span>');
                                    taxname.keyup(function(){
                                        $('#taxname_valid').html('');
                                    });
                                    return false;
                                }
                            });
});
</script>
<script type="text/javascript">
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
</script>

<title> <?php ?></title>

<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

<style type="text/css">
    .uppercase{
        text-transform: uppercase;
    }
</style>
<div class="content-page">
    <div class="content">
        <div class="container">
            <?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
            <div class="alert btn-info alert-micro btn-rounded pastel light dark" >
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php ?>
            </div>
            <?php } ?>

            <?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
            <div class="alert btn-info btn-rounded alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print_r($msg); ?>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-sm-12">
                    <section>
                        <header class="panel-heading" style="color:rgb(255, 255, 255);background: #2477c9;">
                            <i class="fa  fa-cloud-download "></i><span style="font-family: 'Quicksand', sans-serif;padding-left: 6px;"></span></header>
                            <div class="card-box">
                                <div class="row">



	<title> <?php ?></title>
	<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
	<style>     
		#cash,#mamount,#through,#bank,#cards { display:none; }
		input[type=checkbox], input[type=radio] {
    margin: 9px 6px 0;
    margin-top: 1px\9;
    line-height: normal;
}
	</style>

	<div class="content-page">
		<div class="content">
			<div class="container">
         
        	<div class="col-md-3"></div>			                              
		<form method="post" action="<?php echo base_url()?>backup/savebackup" enctype="multipart/form-data">		                              
		<div class="controls col-sm-1">
			<input type="radio" name="backup_mode" value="offline" onchange="backup()" checked>
		Offline</div>
											
		<div class="controls col-sm-1">
		    <input type="radio" name="backup_mode" id="optionsRadios1" value="online" onchange="backup1()" >Online
		</div><br><br>
				<div class="col-md-3"></div>
				<div id="email">
		<label class="control-label col-sm-1" style="text-align:center;    margin-top: 7px;">Email<span style="color:red;"></span></label>
				<div class="col-lg-4">
					<input type="email"  name="email" class="form-control" id="email" name="chequeno" data-provide="typeahead"  placeholder="Enter Your Email"><span id="chequeno_valid" placeholder="Enter Your Email"></span>
		</div>
		</div><br>
	                                        <div class="col-md-3"></div>
                                        		<div id="url">
										<label class="control-label col-sm-1" style="text-align:center;margin-top: 7px;">URL Path<span style="color:red;"></span></label>
												<?php $data = $this->db->where('status',1)->get('backup_url')->row();?>
                                        <div class="col-lg-4">
													<input type="text" name="url" class="form-control"  id="url" value="<?php echo $data->url;?>"  placeholder="Enter Your Url">
												</div>
											</div><br><br><br>
											
										<div class="text-center" align="center">
											<button  class="btn btn-info" type="submit" id="submit" name="save" value="save">save </button>
											</div>
                                          <div class="col-md-3"></div>
									</form>
									<!-- end of form -->
								</div>
							</div>
						</section>
					</div>
				</div><!-- end col -->
			</div>
		</div>


<script type="text/javascript">
$(document).ready(function(){
    jQuery('#email').hide();
});

//Check Show

function backup(){
jQuery('#url').show();
jQuery('#email').hide();

}
function backup1(){
jQuery('#url').hide();
jQuery('#email').show();
}


function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}

</script>


<script type="text/javascript">

function ontime() {
now=new Date();
hour=now.getHours();
min=now.getMinutes();
sec=now.getSeconds();

if (min<=9) { min="0"+min; }
if (sec<=9) { sec="0"+sec; }
if (hour>12) { hour=hour-12; add="PM"; }
else { hour=hour; add="AM"; }
if (hour==12) { add="PM"; }

$("#times").val (((hour<=9) ? "0"+hour : hour) + ":" + min + ":" + sec + " " + add);

setTimeout("ontime()", 1000);
}
window.onload = ontime;
</script>


<script type="text/javascript">
$( "#username" ).autocomplete({
source: function(request, response) {
//alert($('input[name=vouchertype]:checked').val());
$.ajax({ 
url: "<?php echo base_url();?>voucher/autocomplete_username",
data: { keyword: $("#username").val()},
dataType: "json",
type: "POST",
success: function(data){ 
response(data);
}            
});
}, select: function (event, ui) {
$("#username").val(ui.item.label); 
$('#totalamount').val(ui.item.totalamount); 
$('#paidamount').val(ui.item.paidamount); 
$('#balance').val(ui.item.balance); 
$('#username').val(ui.item.customername); 
$('#customerId').val(ui.item.customerid); 
var name=$(this).val();
if(name !='')
{
$.post('<?php echo base_url();?>voucher/getcustomer',{name:name},function(res){
if(res > 0)
{
$('#username_valid').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
$.post('<?php echo base_url();?>voucher/getinvoiceno',{username:name},function(res){
$("#invoiceno option:gt(0)").remove(); 
var obj=jQuery.parseJSON(res);
$(obj).each(function()
{
var option = $('<option />');

option.attr('value', this.value).text(this.label);           
$('#invoiceno').append(option);
});
});
}
else
{
$('#username_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
}
});

// $('#username').blur(function(){ 
// var name=$(this).val();           
// if(name !='')
// {              

// $.post('<?php echo base_url();?>voucher/getinvoiceno',{username:name},function(res){
// $("#invoiceno option:gt(0)").remove(); 
// var obj=jQuery.parseJSON(res);
// $(obj).each(function()
// {
// var option = $('<option />');

// option.attr('value', this.value).text(this.label);           
// $('#invoiceno').append(option);
// });
// });

// return false;

// }
// });

$('#dcsearch').click(function(){
	//alert();
var invoiceno=$('#invoiceno').val();
if(invoiceno!="")
{
$.post('<?php echo base_url();?>voucher/getbalance',{invoiceno:invoiceno},function(res){
$('#balamt').val(res);
});
}
});

 $('#purchase_search').click(function(){
	//alert();
	var year=$("#year").val();
var purchaseno=$('#purchaseno').val();
if(purchaseno!="")
{
$.post('<?php echo base_url();?>voucher/get_purchase_balance',{purchaseno:purchaseno,year:year},function(res){
$('#bal_purchase_amt').val(res);
});
}
});


$( "#username1" ).autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>voucher/autocomplete_username1",
data: { keyword: $("#username1").val()},
dataType: "json",
type: "POST",
success: function(data){ 
response(data);
}            
});
}, select: function (event, ui) {
$("#username1").val(ui.item.label); 
$('#totalamount1').val(ui.item.totalamount); 
$('#paidamount1').val(ui.item.paidamount); 
$('#balance1').val(ui.item.balance); 
$('#username1').val(ui.item.customername); 
$('#supplierId').val(ui.item.customerid); 
var name=$(this).val();
if(name !='')
{
$.post('<?php echo base_url();?>voucher/getsupplier',{name:name},function(res){
if(res > 0)
{
$('#username1_valid').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
$.post('<?php echo base_url();?>voucher/getpurchaseno',{username:name},function(res){
$("#purchaseno option:gt(0)").remove(); 
var obj=jQuery.parseJSON(res);
$(obj).each(function()
{
var option = $('<option />');

option.attr('value', this.value).text(this.label);           
$('#purchaseno').append(option);
});
});
}
else
{
$('#username1_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
}
});




</script>


<script type="text/javascript">

$(document).ready(function(){

$('#username1').on('keyup blur', function(e) {
// e.type is the type of event fired
var name=$(this).val();
if(name !='')
{
$.post('<?php echo base_url();?>voucher/getsupplier',{name:name},function(res){
if(res > 0)
{
$('#username1_valid').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#username1_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
});

$('#username').keyup(function(){ 
var name=$(this).val();
if(name !='')
{
$.post('<?php echo base_url();?>voucher/getcustomer',{name:name},function(res){
if(res > 0)
{
$('#username_valid').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#username_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
});

// $('#username').blur(function(){ 
// var name=$(this).val();
// if(name !='')
// {
// $.post('<?php echo base_url();?>voucher/getinvoiceno',{name:name},function(res){
// });
// return false;
// }
// });
$('#chequedate').datepicker();
});
</script>







                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            
            
                    </div>




                    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
                    <script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
                    <script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
                   <script>
$(document).ready(function () { 
    $('.myButton').hide();

    $('a.tab1').click(function() {
        $('.myButton').show();
        return false;
    });
    $('.myButton').hide(); // hide again once clicked off the tab.
});
                   </script>




 
        
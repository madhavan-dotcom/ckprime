<?php $data=$this->db->get('profile')->result();
foreach($data as $r)
?>
<title> <?php echo $r->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
<style>     
#cash,#mamount,#through,#bank,#cards { display:none; }
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
<i class="zmdi zmdi-money-box">&nbsp;Sales Return</i> (<?php echo $creditnoteid;?>)
</header>
<div class="card-box">
<div class="row">
<form class="form-horizontal" role="form" method="post" onsubmit="setTimeout(function () { location.href = '<?php echo base_url();?>creditnote';},2000)" target="_blank" action="<?php echo base_url();?>creditnote/insert">
<input type="hidden" name="creditnoteid" id="creditnoteid" value="<?php echo $creditnoteid;?>">

<div class="form-group">
<label class="control-label col-sm-3">Type</label>
<div class="controls col-sm-2">
<input type="radio" name="vouchertype" style="width:50px;" checked onchange="payment()" id="optionsRadios33" value="payment"  required>Sales Return                                
</div>
<div class="controls col-sm-2">
<input type="radio" onchange="receipt()" style="width:50px;" name="vouchertype" id="optionsRadios5" value="receipt"  required>Purchase Return
</div>
</div>

<div class="form-group">
<label for="inputPassword" class="col-lg-3 control-label">Date</label>
<div class="col-lg-2">
<input type="text" name="creditnotedate" class="form-control datepicker-autoclose" id="datepicker-autoclose" placeholder=""  value="<?php echo date('d-m-Y');?>" required>
</div>
<label for="inputPassword" class="col-lg-1 control-label" style="text-align:left;width: 38px;">Time</label>
<div class="col-lg-1" style="width: 177px;">
<input class="form-control" name="time" id="times" type="text" readonly="">
</div>
</div>
<div class="form-group">
<label for="inputPassword" class="col-lg-3 control-label">Invoice No</label>
<div class="col-lg-3">
<input type="text" name="invoiceno" class="form-control" id="invoiceno" placeholder="" >
<div id="invoiceno_valid"></div>
</div>
</div>
<?php /* 
<div class="form-group">
<label for="inputPassword" class="col-lg-3 control-label">Time</label>
<div class="col-lg-4">
<input class="form-control" name="time" id="times" type="text" readonly>
</div>
</div>


<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label">Voucher Id</label>
<div class="col-lg-4">
<input type="text" name="voucherid" id="voucherid" value="<?php echo $voucherid;?>" class="form-control" placeholder=""  readonly><span id="name_valid"></span>
</div>
</div>
*/ ?>

<div id="receipt" style="display:none;">
<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label">Supplier/Company</label>
<div class="col-lg-4">
<input type="text" name="name1"   id="username1" class="form-control character" placeholder="" >
<input type="hidden" name="supplierId"  id="supplierId" class="form-control character" placeholder="" >
<span id="username1_valid"></span>
</div>
</div>


<!--
<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label">Total Amount</label>
<div class="col-lg-4">
<input type="text" name="totalamount1" id="totalamount"  class="form-control" placeholder="" readonly><span id="name_valid"></span>
</div>
</div>

<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label"> Paid Amount</label>
<div class="col-lg-4">
<input type="text" name="paidamount1" id="paidamount1"  class="form-control" placeholder="" readonly><span id="name_valid"></span>
</div>
</div> -->

<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label">Balance</label>
<div class="col-lg-4">
<input type="text" name="balance1" id="balance1"  class="form-control" placeholder="" readonly><span id="name_valid"></span>
</div>
</div>
</div>

<div id="payment">
<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label">Customer/Company</label>
<div class="col-lg-4">
<input type="text" name="name"  id="username" class="form-control character" placeholder="" >
<input type="hidden" name="customerId" id="customerId" value="" /> 
<span id="username_valid"></span>
</div>
</div>

<!-- 
<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label">Total Amount</label>
<div class="col-lg-4">
<input type="text" name="totalamount" id="totalamount"  class="form-control" placeholder="" readonly>
<input type="hidden" name="customerid"  id="customerid" class="form-control character" placeholder="" >
<span id="name_valid"></span>
</div>
</div>

<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label"> Paid Amount</label>
<div class="col-lg-4">
<input type="text" name="paidamount" id="paidamount"  class="form-control" placeholder="" readonly><span id="name_valid"></span>
</div>
</div> -->

<div class="form-group" hidden>
<label for="inputStandard" class="col-lg-3 control-label">Balance</label>
<div class="col-lg-4">
<input type="text" name="balance" id="balance"  class="form-control" placeholder="" readonly><span id="name_valid"></span>
</div>
</div>


<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label">Amount</label>
<div class="col-lg-4">
<input type="text" name="debitAmount" id="debitAmount"  class="form-control" placeholder="">
</div>
</div>
</div>


<!--   <div class="form-group">
<label for="inputPassword" class="col-lg-3 control-label">Remarks</label>
<div class="col-lg-4">
<textarea type="text" name="remarks" class="form-control" id="remarks" placeholder="" ></textarea>
</div>
</div> -->



<div class="col-sm-offset-4">
<button  class="btn btn-info" id="submit" name="save" value="save">Add </button>
<!-- <button  class="btn btn-success"  name="print" id="print" value="print">Print </button> -->
<button type="reset"  class="btn btn-default" id="">Reset</button>
</div>
</form>
<!-- end of form -->
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

<script>
$('.colorpicker-default').colorpicker({
format: 'hex'
});
$('.colorpicker-rgba').colorpicker();

// Date Picker
jQuery('#datepicker').datepicker();
jQuery('#datepicker-autoclose').datepicker({
autoclose: true,
todayHighlight: true
});
</script>

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

var amount=$('#amount').val();
var tc=$('#tc').val();
var chequeno=$('#chequeno').val();
var chamount=$('#chamount').val();
var bank=$('#ss').val();
var bamount=$('#bamount').val();
var username = $('#username').val();

var username1 = $('#username1').val();





});



$('#print').click(function(){

var amount=$('#amount').val();
var tc=$('#tc').val();
var chequeno=$('#chequeno').val();
var chamount=$('#chamount').val();
var bank=$('#ss').val();
var bamount=$('#bamount').val();
var username = $('#username').val();

var username1 = $('#username1').val();









}




});



});
</script>


<script type="text/javascript">

function receipt()
{
jQuery('#receipt').show();
jQuery('#payment').hide();
}
function payment()
{
jQuery('#receipt').hide();
jQuery('#payment').show();
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
url: "<?php echo base_url();?>creditnote/autocomplete_username",
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
$.post('<?php echo base_url();?>creditnote/getcustomer',{name:name},function(res){
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
}
});


$( "#username1" ).autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>creditnote/autocomplete_username1",
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
$.post('<?php echo base_url();?>creditnote/getsupplier',{name:name},function(res){
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
$.post('<?php echo base_url();?>creditnote/getsupplier',{name:name},function(res){
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

$.post('<?php echo base_url();?>creditnote/getcustomer',{name:name},function(res){

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




$('#username').blur(function(){ 




var name=$(this).val();


if(name !='')
{

$.post('<?php echo base_url();?>creditnote/getinvoiceno',{name:name},function(res){

if(res > 0)
{

$('#invoiceno_valid').html('<span><font color="green">Available!</span>');

$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);

}

else
{

$('#invoiceno_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});

return false;

}
});


$('#chequedate').datepicker();

});



</script>



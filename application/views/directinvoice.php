<?php 
$discountBy=$this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy; 
$checkInvoiceType = $this->db->select('invoiceBy')->where('id',1)->get('preference_settings')->row()->invoiceBy;
?>
<style>
.myform {}
.myform input[type="text"]{ width:100%; border: 1px solid #dcdcdc; border-radius: 4px; padding:8px; color: #435966;}
</style>

<input class="" id="gsttypes"  type="hidden" value="<?php echo $gsttype;?>" style="width:70px;">
<div class="table-responsive myform table-striped">
<table class="table myform">
<thead> 
<tr>
<th -style="width:70px">HSN Code</th>
<!-- <th -style="width:70px">Item Code</th> -->
<th style="width:150px;color:red;">Item Name <a target="_blank" href="<?php echo base_url();?>itemmaster">(Add Item)</a></th>
<th -style="width:50px">Qty</th>
<th -style="width:50px">UOM</th>
<th -style="width:70px">Rate</th>
<th -style="width:100px">Amount</th>
<th -style="width:40px">Disc <?php if($discountBy=='percent_wise') { echo '%'; } ?></th>
<th -style="width:110px">Total</th>
<th style="width:10px">&nbsp;</th>
</tr>  
</thead>
<tbody>
<tr>
<td><input class="" id="hsnno0" parsley-trigger="change" required readonly type="text" name="hsnno[]" value=""><div id="hsnno_valid0"></div></td>

<!-- <td><input class="itemcode_class" data-id="0" id="itemcode0" parsley-trigger="change" required type="text" name="itemcode[]" value=""><div id="itemcode_valid0"></div></td> -->

<td><input class="itemname_class" style="width: 250px;" data-id="0" id="itemname0" parsley-trigger="change" required  type="text" name="itemname[]" value="" ><div id="itemname_valid0"></div><input type="text" name="item_desc[]" value="" style="margin-top: 2px;" ><input type="hidden" name="priceType[]" id="priceType0" /></td>

<td><input class="qty_class decimals" data-id="0" id="qty0"   parsley-trigger="change" required type="text" name="qty[]"   autocomplete="off" ><input class="" id="qtys0" type="hidden" name="qtys[]"><div id="qty_valid0"></div></td>  

<td><input class="" id="uom0" parsley-trigger="change" required readonly  type="text" name="uom[]"  autocomplete="off"></td>

<td><input class="rate_class decimals"  data-id="0" parsley-trigger="change" required id="rate0"  type="text" name="rate[]"   autocomplete="off"><div id="rate_valid0"></div></td>

<td><input class="decimals" id="amount0" parsley-trigger="change" required readonly type="text" name="amount[]" value=""  autocomplete="off"><div id="amount_valid0"></div></td>

<td><input class="discount_class decimals" data-id="0" id="discount0"  type="text" name="discount[]" onkeypress="return isNumberKey_With_Dot(event)" value="0"  autocomplete="off"><div id="discount_valid0"></div></td>

<td><input class="decimals" id="taxableamount0" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount0"></td>


<td style="width:10px;">&nbsp;</td>
</tr>
</tbody>
<tbody id="append"></tbody> 
</table> 
</div>
<div class="col-sm-offset-11">
<button type="button" class="btn btn-info add pull-right"><i class="fa fa-plus"></i></button>
<input type="hidden"  id="hide" value="1">
</div>
<br>


<br>
<br>

<div class="col-sm-offset-8">
<label class="col-sm-7 control-label" >Sub Total</label>
<div class="col-sm-5">
<input class="form-control" style="background-color: #eee !important;"  type="text" name="subtotal" id="subtotal" readonly  placeholder="0" value="0">
</div>
</div>
<br>
<br>   

   
 <div class="col-sm-offset-8">
<label class="col-sm-7  control-label" >Frieght Charges</label>
<div class="col-sm-5">
<input class="form-control decimals"  type="text" name="freightamount" id="freightamount"  value="0">
</div>
</div>
<br>
<br>  
<div class="clearfix"></div>
<div class="col-sm-offset-8">
<label class="col-sm-7  control-label" >Loading & Packing Charges</label>
<div class="col-sm-5">
<input class="form-control decimals"  type="text" name="loadingamount" id="loadingamount"   value="0">
</div>
</div>
<br>
<br> 
<div class="clearfix"></div>
<div class="sgst col-sm-offset-8">
<label class="sgst col-sm-5  control-label" >CGST </label>
<div class="col-sm-2">
<input class="sgst decimals" required  type="text" name="cgst" id="cgst"  value="">
</div>
<div class="col-sm-5">
<input class="sgst decimals"  required type="text" readonly name="cgstamount" id="cgstamount"   placeholder="0">
</div>
</div>
   
<div class="sgst col-sm-offset-8">
<label class="sgst col-sm-5" >SGST </label>
<div class="col-sm-2">
<input class="sgst decimals"  type="text" required readonly name="sgst" id="sgst"  value="">
</div>
<div class="col-sm-5">
<input class="sgst decimals"  type="text" required readonly name="sgstamount" id="sgstamount"   placeholder="0">
</div>
</div>
<div class="col-sm-offset-8">
<label class="igst  col-sm-5" >IGST </label>
<div class="col-sm-2">
<input class="igst decimals"  required type="text"  name="igst" id="igst"  value="">
</div>
<div class="col-sm-5">
<input class="igst decimals" readonly required type="text" name="igstamount" id="igstamount"   placeholder="0">
</div>
</div>
 <div class="col-sm-offset-8">
<label class="col-sm-7  control-label" >Round Off</label>
<div class="col-sm-5">
<input class="form-control decimals"  type="text" name="roundOff" id="roundOff"   placeholder="0" value="0" onfocus="if(this.value == '0') { this.value = ''; }" onblur="if(this.value == '') { this.value = '0'; }">
</div>
</div>
<br>
<br>   
<div class="clearfix"></div>
<div class=" col-sm-offset-8">
<label class="col-sm-7  control-label" >Invoice Total</label>
<div class="col-sm-5">
<input class="form-control" readonly type="text" style="background-color: #eee !important;"  name="grandtotal" id="grandtotal" >
</div>                      
</div>
<div class="col-md-4"></div>
<div class="col-md-4 text-center">
<button  class="btn btn-info" id="submit" name="save" value="save">Save & Add Invoice</button>
<button  class="btn btn-primary"  name="print" id="print" value="print">Print Invoice</button>
</div>
<div class="col-md-4"></div>
<script type="text/javascript">
$("#print").click(function(event){
  $("#myform").attr("target", "_blank");
});

$(document).ready(function() {
$('form').parsley();
});

$('.colorpicker-default').colorpicker({ format: 'hex' });
$('.colorpicker-rgba').colorpicker();
// Date Picker
jQuery('#datepicker').datepicker();
jQuery('.datepicker-autoclose').datepicker({ autoclose: true, todayHighlight: true });

function call_keyup()
{
$('.decimals').keyup(function(){
var val = $(this).val();
if(isNaN(val)){
val = val.replace(/[^0-9\.-]/g,'');
if(val.split('.').length>2)
val =val.replace(/\.-+$/,"");
}
$(this).val(val);
});

$(".itemname_class").blur(function(){
var total = $(this).attr('data-id');
if($("#itemname"+total).val()=='')
{
$('#hsnno'+total).val('');
$('#priceType'+total).val('');
$('#itemno'+total).val('');
$('#rate'+total).val('');
$('#sgst'+total).val('');
$('#cgst'+total).val('');
$('#igst'+total).val('');
$('#uom'+total).val('');
}
});

$(".itemname_class").keyup(function(){
var total = $(this).attr('data-id');

$( "#itemname"+total).autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>invoice/autocomplete_itemname",
data: { keyword: $("#itemname"+total).val()},
dataType: "json",
type: "POST",
success: function(data){ 
$('#hsnno'+total).val('');
$('#priceType'+total).val('');
$('#itemno'+total).val('');
$('#rate'+total).val('');
$('#sgst'+total).val('');
$('#cgst'+total).val('');
$('#igst'+total).val('');
$('#uom'+total).val('');
response(data);
}            
});
},
select: function (event, ui) {
var name=ui.item.value;
$('#itemname'+total).val(ui.item.value);
$.post('<?php echo base_url();?>invoice/get_itemnames',{name:name},function(rest){
var obj=jQuery.parseJSON(rest);
$('#hsnno'+total).val(obj.hsnno);
$('#itemcode'+total).val(obj.itemcode);
$('#priceType'+total).val(obj.priceType);
$('#itemno'+total).val(obj.itemno);
$('#rate'+total).val(obj.price);
$('#sgst').val(obj.sgst);
$('#cgst').val(obj.cgst);
$('#igst').val(obj.igst);
$('#uom'+total).val(obj.uom);
$('#qtys'+total).val(obj.balance);
$('#qty'+total).val('');
$('#qty'+total).focus();
});            
if(name !='')
{
$.post('<?php echo base_url();?>invoice/gets',{name:name},function(res){
if(res > 0)
{
$('#itemname_valid'+total).html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#itemname_valid'+total).html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
}
});
});


$(".itemcode_class").blur(function(){

var total = $(this).attr('data-id');
if($("#itemcode"+total).val()=='')
{
$('#hsnno'+total).val('');
$('#priceType'+total).val('');
$('#itemno'+total).val('');
$('#itemname'+total).val('');
$('#rate'+total).val('');
$('#sgst'+total).val('');
$('#cgst'+total).val('');
$('#igst'+total).val('');
$('#uom'+total).val('');
}
});

$(".itemcode_class").keyup(function(){
var total = $(this).attr('data-id');

$( "#itemcode"+total).autocomplete({
source: function(request, response) {
$.ajax({ 	
url: "<?php echo base_url();?>invoice/autocomplete_itemcode",
data: { keyword: $("#itemcode"+total).val()},
dataType: "json",
type: "POST",
success: function(data){ 
$('#hsnno'+total).val('');
$('#priceType'+total).val('');
$('#itemno'+total).val('');
$('#itemname'+total).val('');
$('#rate'+total).val('');
$('#sgst'+total).val('');
$('#cgst'+total).val('');
$('#igst'+total).val('');
$('#uom'+total).val('');
response(data);
}            
});
},
select: function (event, ui) {
var name=ui.item.value;
$('#itemcode'+total).val(ui.item.value);
$.post('<?php echo base_url();?>invoice/get_itemcodes',{name:name},function(rest){
var obj=jQuery.parseJSON(rest);
$('#hsnno'+total).val(obj.hsnno);
$('#priceType'+total).val(obj.priceType);
$('#itemno'+total).val(obj.itemno);
$('#itemname'+total).val(obj.itemname);
$('#rate'+total).val(obj.price);
$('#sgst'+total).val(obj.sgst);
$('#cgst'+total).val(obj.cgst);
$('#igst'+total).val(obj.igst);
$('#uom'+total).val(obj.uom);
$('#qtys'+total).val(obj.balance);
$('#qty'+total).val('');
$('#qty'+total).focus();
});            
if(name !='')
{
$.post('<?php echo base_url();?>invoice/getss',{name:name},function(res){
if(res > 0)
{
$('#itemcode_valid'+total).html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#itemcode_valid'+total).html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
}
});
});

$('.qty_class').keyup(function(){
var rowNumber = $(this).attr('data-id');
var priceType = $("#priceType"+rowNumber).val();
var qty=$('#qty'+rowNumber+'').val();
var qtys = $('#qtys'+rowNumber+'').val();
var checkInvoiceType = '<?php echo $checkInvoiceType;?>';
if(checkInvoiceType=='without_stock')
{
if(qty=='')
{
$('#qty_valid'+rowNumber+'').html('<span><font color="red">Invalid Qty!</span>');
$('#qty'+rowNumber+'').val();
}
else
{
if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
totalAmt_calculation();
}
}
else
{	
if(parseFloat(qty) > parseFloat(qtys))
{
alert('Only '+qtys+' quantities are available!');
$('#qty_valid'+rowNumber+'').html('<span><font color="red">Invalid Qty!</span>');
$('#qty'+rowNumber+'').val('0');

}
else
{
if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
totalAmt_calculation();
}
}

});
//RATE CHANGE FUNCTION
$('.rate_class').keyup(function(){
var rowNumber = $(this).attr('data-id');
var priceType = $("#priceType"+rowNumber).val();
var rate=$('#rate'+rowNumber+'').val();
$('#rate_valid'+rowNumber+'').html('');

if(parseFloat(rate) > 0)
{
if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
//frieght_calculation();
totalAmt_calculation();
}
else
{
$('#rate_valid'+rowNumber+'').html('<span><font color="red">Invalid Rate !</span>');
$('#rate_valid'+rowNumber+'').val('');
}
});
// DISCOUNT CHANGE FUNCTION
$('.discount_class').keyup(function(){
var rowNumber = $(this).attr('data-id');
var priceType = $("#priceType"+rowNumber).val();
$('#discount_valid'+rowNumber+'').html('');
var discount=$('#discount'+rowNumber+'').val();
if(discount!='')
{
if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else {  amount_calculation(rowNumber); }
//frieght_calculation();
totalAmt_calculation();
}
else
{
$('#discount_valid'+rowNumber+'').html('<span><font color="red">Invalid Discount !</span>');
$('#discount_valid'+rowNumber+'').val('');
}
});
//calculation--------------------------------------------------

$('#freightamount').keyup(function(){
totalAmt_calculation();
});

$('#loadingamount').keyup(function(){
totalAmt_calculation();
});


$('#roundOff').keyup(function(){
totalAmt_calculation();
});

$('#othercharges').keyup(function(){
totalAmt_calculation();
});

$('.sgst').keyup(function(){
	var cgst = $('#cgst').val();
	$('#sgst').val(cgst);
totalAmt_calculation();
});

$('.igst').keyup(function(){
	
totalAmt_calculation();
});

$('.remove').click(function(){
$(this).parents('tr').remove();
totalAmt_calculation(total); 
});
}
function amount_calculation(rowNumber)
{
var qty=$('#qty'+rowNumber).val();
var rate=$('#rate'+rowNumber).val();

if(qty!='' && rate!='')
var amo=parseFloat(rate)*parseFloat(qty);
var amou=amo.toFixed(2);
$('#amount'+rowNumber).val(amou);
$('#taxableamount'+rowNumber).val(amou);
$('#total'+rowNumber).val(amou);

var discount=$('#discount'+rowNumber).val();
var taxableamount=$('#taxableamount'+rowNumber).val(); 
var gsttype=$('#gsttype').val(); 
var discountBy = $("#discountBy").val();
var a=0;
var b=0; 
var c=0;
var d=0;
var e=0;
var f=0;
var g=0;
var h=0;
var i=0;
var j=0;
var k=taxableamount;
var l=0;

if(discount != '')
{
if(discountBy=='percent_wise')
{	
a=((parseFloat(amo)*parseFloat(discount))/100);
var a1=a.toFixed(2);
var a2=parseFloat(amo)-parseFloat(a1);
var a3=a2.toFixed(2);
var discountamount=a1;
taxableamount=a3;
}
else
{
a=(parseFloat(amo)-parseFloat(discount));
var discountamount=discount;
//alert(discountamount);
taxableamount=a.toFixed(2);
}
$('#discountamount'+rowNumber).val(discountamount);
$('#taxableamount'+rowNumber).val(taxableamount);
$('#total'+rowNumber).val(k);
}
k=taxableamount;

}

function Inc_amount_calculation(total)
{
var qty=$('#qty'+total).val();
var rate=$('#rate'+total).val();

if(qty!='' && rate!='')
var amo=parseFloat(rate)*parseFloat(qty);
var amou=amo.toFixed(2);

var discount=$('#discount'+total).val(); 
var gsttype=$('#gsttype').val();
var discountBy = $("#discountBy").val();		
var a=0;
var b=0; 
var c=0;
var d=0;
var e=0;
var f=0;
var g=0;
var h=0;
var i=0;
var j=0;
var k=0;
var l=0;
var taxableamount=0;
var discountamount=0;
taxableamount = amou;

if(discount != '')
{
if(discountBy=='percent_wise')
{
a=((parseFloat(amo)*parseFloat(discount))/100);
var a1=a.toFixed(2);
var a2=parseFloat(amo)-parseFloat(a1);
var a3=a2.toFixed(2);
var discountamount=a1;
taxableamount=a3;

}
else
{

a=(parseFloat(amo)-parseFloat(discount));
var discountamount=discount;
taxableamount=a.toFixed(2);
}
}
k = taxableamount;
$('#discountamount'+total+'').val(discountamount);
$('#taxableamount'+total+'').val(taxableamount);
}



function totalAmt_calculation()
{
var freightamount=$('#freightamount').val();
if(freightamount=='') { freightamount=0; }
var loadingamount=$('#loadingamount').val();
if(loadingamount=='') { loadingamount=0; }
var cgstamount=$('#cgstamount').val();
if(cgstamount=='') { cgstamount=0; }
var sgstamount=$('#sgstamount').val();
if(sgstamount=='') { sgstamount=0; }
var igstamount=$('#igstamount').val();
if(igstamount=='') { igstamount=0; }
var roundOff=$('#roundOff').val();
var gsttype=$('#gsttype').val();
var cgst=$('#cgst').val();
var sgst=$('#sgst').val();
var igst=$('#igst').val();
var sub_tot=0;
var s=0;
var p=0;
var m=0;
var m1=0;
var n=0;
var n1=0;
var l = 0;
var l1=0;
$('input[name^="taxableamount"]').each(function(){
sub_tot +=Number($(this).val()); 
var fina=sub_tot.toFixed(2);         
$('#subtotal').val(fina);
$('#grandtotal').val(fina); 

var tot=parseFloat(sub_tot)+parseFloat(loadingamount)+parseFloat(freightamount);
});


if(gsttype=='intrastate')
{
// var totamt=parseFloat(sub_tot)+parseFloat(freightamount)+parseFloat(loadingamount);
if(cgst != '')
{
var s=((parseFloat((sub_tot)+parseFloat(loadingamount)+parseFloat(freightamount))*parseFloat(cgst))/100);
var s1=s.toFixed(2);
$('#cgstamount').val(s1);
$('#sgstamount').val(s1);

	m = parseFloat(sub_tot)+parseFloat(s1)+parseFloat(s1);
	var m1 = m.toFixed(2);
	$('#grandtotal').val(m1);

}

if(loadingamount > 0 )
{
	//alert(loadingamount);
l=parseFloat(sub_tot)+parseFloat(s1)+parseFloat(s1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
l1=l.toFixed(2);
$('#grandtotal').val(l1);
}
if(freightamount > 0 )
{
l=parseFloat(sub_tot)+parseFloat(s1)+parseFloat(s1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
l1=l.toFixed(2);
$('#grandtotal').val(l1);
}

if(roundOff > 0)
{
l=parseFloat(sub_tot)+parseFloat(s1)+parseFloat(s1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
l1=l.toFixed(2);
$('#grandtotal').val(l1);
}


}
else  if(gsttype=='interstate')
{
if(igst != '')
{
var h=((parseFloat((sub_tot)+parseFloat(loadingamount)+parseFloat(freightamount))*parseFloat(igst))/100);
var h1=h.toFixed(2);
$('#igstamount').val(h1);

	n = parseFloat(sub_tot)+parseFloat(h1);
	var n1 = n.toFixed(2);
	$('#grandtotal').val(n1);
}

if(loadingamount > 0 )
{
	//alert(loadingamount);
l=parseFloat(sub_tot)+parseFloat(h1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
l1=l.toFixed(2);
$('#grandtotal').val(l1);
}
if(freightamount > 0 )
{
l=parseFloat(sub_tot)+parseFloat(h1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
l1=l.toFixed(2);
$('#grandtotal').val(l1);
}

if(roundOff > 0)
{
l=parseFloat(sub_tot)+parseFloat(h1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
l1=l.toFixed(2);
$('#grandtotal').val(l1);
}

if(roundOff > 0)
{
l=parseFloat(sub_tot)+parseFloat(h1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
l1=l.toFixed(2);
$('#grandtotal').val(l1);
}


}
}	

var gsttype=$('#gsttype').val();
if(gsttype=='interstate')
{
$('.sgst').hide();
$('.igst').show();
$('#sgst').attr('required',false);
$('#sgstamount').attr('required',false);
$('#cgst').attr('required',false);
$('#cgstamount').attr('required',false);
}
else  if(gsttype=='intrastate')
{
$('.sgst').show();
$('.igst').hide();
$('#igst').attr('required',false);
$('#igstamount').attr('required',false);
}



$(document).ready(function(){
call_keyup();
$('#gsttype').change(function(){
var gsttype=$('#gsttype').val();

if(gsttype=='interstate')
{
$('.sgst').hide();
$('.igst').show();
$('#sgst').attr('required',false);
$('#sgstamount').attr('required',false);
$('#cgst').attr('required',false);
$('#cgstamount').attr('required',false);
}
else  if(gsttype=='intrastate')
{
$('.sgst').show();
$('.igst').hide();
$('#igst').attr('required',false);
$('#igstamount').attr('required',false);
}
});

$('.add').click(function(){
var start=$('#hide').val();
console.log(start);
var total=Number(start)+1;
$('#hide').val(total);
var tbody=$('#append');


var mod = $('#gsttype').val();
var samples,samples1;
if (mod == 'intrastate') {
samples = "none";
samples1 = "nones";
} else {
samples = "nones";
samples1 = "none";
}


$(' <tr>'
+'<td><input class="" id="hsnno'+total+'" readonly type="text" name="hsnno[]" value=""><div id="hsnno_valid'+total+'"></div></td>'
//+'<td><input class="itemcode_class" data-id="'+total+'" id="itemcode'+total+'" type="text" name="itemcode[]" value=""><div id="itemcode_valid'+total+'"></div></td>'
+'<td><input class="itemname_class" data-id="'+total+'"  parsley-trigger="change" required id="itemname'+total+'"  type="text" name="itemname[]" value=""><div id="itemname_valid'+total+'"></div><input type="text" name="item_desc[]" value="" style="margin-top: 2px;" ><input type="hidden" name="priceType[]" id="priceType'+total+'" /></td>'
+'<td><input class="qty_class decimals" data-id="'+total+'" id="qty'+total+'"    parsley-trigger="change" required type="text" name="qty[]"  autocomplete="off"><div id="qty_valid'+total+'"></div><input class="" id="qtys'+total+'" type="hidden" name="qtys[]"></td>'
+'<td><input class="" readonly id="uom'+total+'" type="text" name="uom[]"   autocomplete="off"></td>'
+'<td><input class="rate_class decimals" data-id="'+total+'" id="rate'+total+'"  type="text" name="rate[]" required autocomplete="off"><div id="rate_valid'+total+'"></div></td>'
+'<td><input class="decimals" id="amount'+total+'" readonly type="text" name="amount[]" value=""  autocomplete="off"><input type="hidden" name="gstcal[]" id="gstcal'+total+'" value=""></td>'
+'<td><input class="discount_class decimals" data-id="'+total+'" id="discount'+total+'"  type="text" name="discount[]" value="0"  autocomplete="off"  onkeypress="return isNumberKey_With_Dot(event)"></td>'
+'<td><input class="decimals" id="taxableamount'+total+'" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount'+total+'"></td>'
// +'<td class="sgst" style="display:'+samples1+';"><input class="decimals" readonly id="cgst'+total+'"  type="text" name="cgst[]" value="" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="cgst_valid'+total+'"></div></td>'
// +'<td class="sgst" style="display:'+samples1+';"><input class="decimals" id="cgstamount'+total+'"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>'
// +'<td class="sgst" style="display:'+samples1+';"><input class="decimals" id="sgst'+total+'"  type="text" name="sgst[]" readonly value=""  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid'+total+'"></div></td>'
// +'<td class="sgst" style="display:'+samples1+';"><input class="decimals" id="sgstamount'+total+'"  type="text" name="sgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>'
// +'<td class="igst" style="display:'+samples+';"><input class="decimals" id="igst'+total+'"  type="text" name="igst[]"  readonly onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid'+total+'"></div></td>'
// +'<td class="igst" style="display:'+samples+';"><input class="decimals" id="igstamount'+total+'" readonly type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>'
//+'<td><input class="" id="total'+total+'" type="text" name="total[]" value=""  readonly ></td>'
+'<td style="width: 10px;"><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td></tr>').appendTo(tbody);
call_keyup();



});
});

</script>

<script type="text/javascript">
$('#document').ready(function(){
$('#checkbox').click(function(){
if($(this).prop("checked")==true)
{
$('#check').show();
$('#imaddress').show();

}
else if($(this).prop("checked")==false)
{
$('#check').hide();
$('#imaddress').hide();
}
});
});   


function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}
function isNumber(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}
function isNumberKey_With_Dot(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57)){
if(charCode == 46)
return true;
else
return false;
}
else
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

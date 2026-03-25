<?php
$count=count($pino);
for ($i=0; $i < $count; $i++) { 
$data[]=$this->db->where('invoiceno',$pino[$i])->get('proforma_invoice_reports')->result_array();

}


?>

<input class="" id="gsttypes"  type="hidden" value="<?php echo $gsttype;?>" style="width:70px;">
<div class="table-responsive">
<table class="table">
<thead> 
<tr>
<th>HSN Code</th>
<th>Item Code</th>
<th>Item Name</th>
<th>Qty</th>
<th>UOM</th>
<th>Rate</th>
<th>Amount</th>
<th>Disc </th>
<th>Total</th>



</tr>  
</thead>
<tbody>

<?php
foreach ($data as $datas) {
foreach ($datas as $rows) {
?>
<tr>

<td>
<!--<input class="form-control" parsley-trigger="change" readonly id="purchaseordernos" type="hidden" name="invoiceno" >	-->
<input class="form-control" parsley-trigger="change" readonly id="id<?php echo $rows['id'];?>" type="hidden" name="id" value="<?php echo $rows['id'];?>"> 

<input class="" id="hsnno" parsley-trigger="change"  readonly style="width:100px;border:1px solid #605f5f;" type="text" name="hsnno[]" value="<?php echo $rows['hsnno'];?>" style="width:70px;">

<div id="hsnno_valid"></div>
</td>
<td><input class="" id="itemcode<?php echo $rows['id'];?>" parsley-trigger="change"  readonly style="width:120px;border:1px solid #605f5f;" type="text" name="itemcode[]" value="<?php echo $rows['itemno'];?>" style="width:70px;">

<div id="itemcode_valid"></div>
</td>
<td><input class="" id="itemname<?php echo $rows['id'];?>" parsley-trigger="change" readonly  style="width:250px;border:1px solid #605f5f;" type="text" name="itemname[]" value="<?php echo $rows['itemname'];?>" >
<div id="itemname_valid"></div><input type="text" name="item_desc[]" value="" style="width:250px;border:1px solid #605f5f;margin-top: 2px;" >
</td>

<td><input class="" id="qty<?php echo $rows['id'];?>" value="0"  parsley-trigger="change" type="text" name="qty[]"   autocomplete="off" style="width:80px;border:1px solid #605f5f;">
<input class="" type="hidden" id="balanceqty<?php echo $rows['id'];?>" value="<?php echo $rows['qty'];?>"  parsley-trigger="change" type="text" name="qty[]"   autocomplete="off" style="width:80px;border:1px solid #605f5f;">
<div id="qty_valid" style="color:green;">Qty : <?php echo @$rows['qty'];?></div>
<div id="qty_valid"></div>
<input type="hidden" name="balanceqty[]" id="balanceqty" value="<?php echo $rows['qty']?>;"
</td>  

<td><input class="" id="uom" parsley-trigger="change"  readonly  style="width:80px;border:1px solid #605f5f;" type="text" name="uom[]" value="<?php echo @$rows['uom'];?>"  autocomplete="off">

</td>

<td><input class=" decimals" parsley-trigger="change" required id="rate<?php echo $rows['id'];?>"  style="width:100px;border:1px solid #605f5f;" type="text" name="rate[]" value="<?php echo @$rows['rate'];?>"  autocomplete="off">
<div id="rate_valid"></div>
</td>


<td><input class="decimals" id="amount<?php echo $rows['id'];?>" parsley-trigger="change" required readonly style="width:120px;border:1px solid #605f5f;" type="text" name="amount[]" value=""  autocomplete="off">
<div id="rate_valid"></div>
</td>

<td><input class="decimals" id="discount<?php echo $rows['id'];?>"  style="width:40px;border:1px solid #605f5f;" type="text" name="discount[]" onkeypress="return isNumberKey_With_Dot(event)" value="0"  autocomplete="off">
<div id="rate_valid"></div>
</td>


<td>
<input class="" id="taxableamount<?php echo $rows['id'];?>" type="text" name="taxableamount[]" value=""  readonly style="width:110px;border:1px solid #605f5f;">
</td>

  <td>
<button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button>
</td>
</tr>
<?php
} 
}
?>
</tbody>

</table> 
</div>

<br>
<br>


<div class="col-sm-offset-8">
<label class="col-sm-7  control-label" >Sub Total</label>
<div class="col-sm-5">
<input class="form-control"  type="text" name="subtotal" id="subtotal" readonly  placeholder="0" value="0">
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
<input class="sgst decimals"  type="text" name="cgst" id="cgst"  value="9">
</div>
<div class="col-sm-5">
<input class="sgst decimals"  type="text" readonly name="cgstamount" id="cgstamount"   placeholder="0">
</div>
</div>
   
<div class="sgst col-sm-offset-8">
<label class="sgst col-sm-5" >SGST </label>
<div class="col-sm-2">
<input class="sgst decimals"  type="text" readonly name="sgst" id="sgst"  value="9">
</div>
<div class="col-sm-5">
<input class="sgst decimals"  type="text" readonly name="sgstamount" id="sgstamount"   placeholder="0">
</div>
</div>
<div class="col-sm-offset-8">
<label class="igst  col-sm-5" >IGST </label>
<div class="col-sm-2">
<input class="igst decimals"  type="text" name="igst" id="igst"  value="18">
</div>
<div class="col-sm-5">
<input class="igst decimals"  readonly type="text" name="igstamount" id="igstamount"   placeholder="0">
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

<div class=" col-sm-offset-8">
<label class="col-sm-7  control-label" >Invoice Total</label>
<div class="col-sm-5">
<input class="form-control" readonly type="text" name="grandtotal" id="grandtotal" >


</div>                      
</div>
<br>
<br>
<div class="col-sm-offset-4">
<button  class="btn btn-info" id="submit" name="save" value="save">Add Invoice</button>
<button  class="btn btn-primary"  name="print" id="print" value="print">Print Invoice</button>
</div>

<?php
foreach ($data as $datas) {
foreach ($datas as $rows) {
?>
<script type="text/javascript">
$(document).ready(function(){

var gsttype=$('#gsttypes').val(); 
if(gsttype=='interstate')
{
$('.sgst').hide();
$('.igst').show();

}
else  if(gsttype=='intrastate')
{

$('.sgst').show();
$('.igst').hide();

}

$('.remove').click(function(){
$(this).parents('tr').remove();
});


var name=$('#itemname<?php echo $rows['id'];?>').val();
$.post('<?php echo base_url();?>invoice/get_itemnames',{name:name},function(rest){
var obj=jQuery.parseJSON(rest);
// $('#sgst<?php echo $rows['id'];?>').val(obj.sgst);
// $('#cgst<?php echo $rows['id'];?>').val(obj.cgst);
// $('#igst<?php echo $rows['id'];?>').val(obj.igst);
//$('#rate<?php echo $rows['id'];?>').val(obj.price);


var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);

});


$('#qty<?php echo $rows['id'];?>').keyup(function(){


var totals=$('#id<?php echo $rows['id'];?>').val();
var qty=$('#qty<?php echo $rows['id'];?>').val();
var balanceqty=$('#balanceqty<?php echo $rows['id'];?>').val();
var qtys = parseFloat(qty);
if(qtys > balanceqty) {
alert('Invalid Qty');
$('#qty<?php echo $rows['id'];?>').val('');
} else {
	calculations(totals);
}


});

$('#rate<?php echo $rows['id'];?>').keyup(function(){


var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);

});

$('#discount<?php echo $rows['id'];?>').keyup(function(){
var discount=$('#discount<?php echo $rows['id'];?>').val(); 
if(discount =='')
{ 
$('#discountamount<?php echo $rows['id'];?>').val('');
}
var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);

});



$('#othercharges').keyup(function(){
var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);
});

$('#freightamount').keyup(function(){
calculations();
});

$('#loadingamount').keyup(function(){

calculations();
});

$('#cgst').keyup(function(){
var cgst = $('#cgst').val();
$('#sgst').val(cgst);
calculations();
});


$('#igst').keyup(function(){

calculations();
});



});
</script>

<?php } } ?>

<script type="text/javascript">

function calculations(totals)
{

var qty=$('#qty'+totals+'').val();
var rate=$('#rate'+totals+'').val();

if(qty!='' && rate!='') 

var amo=parseFloat(rate)*parseFloat(qty);
var amou=amo.toFixed(2);
$('#amount'+totals+'').val(amou);
$('#taxableamount'+totals+'').val(amou);
$('#total'+totals+'').val(amou);


var discount=$('#discount'+totals+'').val();
// var cgst=$('#cgst'+totals+'').val();
// var sgst=$('#sgst'+totals+'').val();
// var igst=$('#igst'+totals+'').val(); 
var taxableamount=$('#taxableamount'+totals+'').val(); 
var gsttype=$('#gsttype').val(); 

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
var cgst=$('#cgst').val();
var sgst=$('#sgst').val();
var igst=$('#igst').val();
var roundOff=$('#roundOff').val();
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





if(discount > 0)
{

a=((parseFloat(amo)*parseFloat(discount))/100);
var a1=a.toFixed(2);
var a2=parseFloat(amo)-parseFloat(a1);
var a3=a2.toFixed(2);
k=a3;
$('#discountamount'+totals+'').val(a1);
$('#taxableamount'+totals+'').val(a3);
$('#total'+totals+'').val(a3);
}


var sub_tot=0; 
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

	n = parseFloat(sub_tot)+parseFloat(h1)+parseFloat(loadingamount)+parseFloat(freightamount);
	var n1 = n.toFixed(2);
	$('#grandtotal').val(n1);
}


if(roundOff > 0)
{
l=parseFloat(sub_tot)+parseFloat(h1)+parseFloat(loadingamount)+parseFloat(freightamount)+parseFloat(roundOff);
l1=l.toFixed(2);
$('#grandtotal').val(l1);
}


}

}




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
$('.decimal').keyup(function(){
var val = $(this).val();
if(isNaN(val)){
val = val.replace(/[^0-9\.-]/g,'');
if(val.split('.').length>2)
val =val.replace(/\.-+$/,"");
}
$(this).val(val);
});
</script>


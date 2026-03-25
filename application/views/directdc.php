<table class="responsive table" width="100%">
<thead style="background: #ebf1f8;"> 
<tr>
<th>&nbsp;&nbsp;&nbsp;&nbsp;HSN Code</th>
<?php 	$itemcode = $this->db->select('itemcode')->where('id',1)->get('preference_settings')->row()->itemcode;
											if($itemcode==1){?>
<th>&nbsp;&nbsp;&nbsp;&nbsp;Item Code</th>
<?php }?>

<th>&nbsp;Item Name<a target="_blank" href="<?php echo base_url();?>itemmaster">(Add Item)</a></th>
<th>&nbsp;&nbsp;UOM</th>
<th>&nbsp;&nbsp;Grade</th>
<th>&nbsp;&nbsp;Weight</th>
<th>&nbsp;&nbsp;Qty</th>
<th>&nbsp;&nbsp;Value</th>
<th>&nbsp;&nbsp;Remarks</th>
</tr>  
</thead>
<tbody>
<tr>
<!-- <td><input class="form-control" id="itemno" type="text" name="itemno[]" value="">
<div id="itemno_valid"></div>
</td> -->
<td><input class="form-control clear" parsley-trigger="change" readonly id="hsnno"  type="text" name="hsnno[]" value="">
<div id="hsnno_valid"></div></td>
<?php 	$itemcode = $this->db->select('itemcode')->where('id',1)->get('preference_settings')->row()->itemcode;
											if($itemcode==1){?>
<td><input class="form-control clear" parsley-trigger="change" id="itemcode" type="text" name="itemcode[]" value="">
<div id="itemcode_valid"></div></td>
<?php }?>
<!--<td><input class="form-control clear" parsley-trigger="change" id="heatno" type="text" name="heatno[]" value="">-->

<td><input class="form-control clear" parsley-trigger="change" required id="itemname" type="text" name="itemname[]" value="">
				<div id="itemname_valid"></div><input class="form-control" type="text" name="item_desc[]" value="" style="margin-top: 2px;" ><input type="hidden" id="itemid" name="itemid[]" value=""></td>
<td><input class="form-control clear" readonly id="uom" type="text" name="uom[]"  autocomplete="off">
<div id="qty_valid"></div></td>
<td>
    <select name="grade[]" id="grade" data-id="0" class="form-control grade_class"style="width: 120px;">
	<option value="">Select Grade</option>
	<?php 
	$grade = $this->db->where('status',1)->get('grade')->result();
	foreach($grade as $g){?>
		<option value="<?php echo $g->id;?>"><?php echo $g->grade;?></option>

		<?php }?>


    </select>
</td>
<td>
    <input class="form-control clear" id="weight0" type="text" data-id="0" name="weight[]" automcomplete="off"> 
</td>
<td><input class="form-control clear decimal" parsley-trigger="change" required id="qty0" data-id="0" type="text" name="qty[]" value=""   autocomplete="off">
<div id="qty_valid"></div></td>

<td><input class="form-control clear decimal" parsley-trigger="change" required id="price" data-id="0" type="text" name="price[]" value=""   autocomplete="off">
<div id="qty_valid"></div></td>
<td><input class="form-control clear" id="remarks0" type="text" name="remarks[]" data-id="0"  autocomplete="off">
<div id="qty_valid"></div></td>
<td><!--<button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button>-->&nbsp;</td>
<td><button type="button" class="btn btn-info add"><i class="fa fa-plus"></i></button><input type="hidden"  id="hide" value="1"></td>
</tr>
</tbody>
<tbody id="append"></tbody> 
<tfoot>
<tr>
<td colspan="6">&nbsp;</td>

</tr>
</tfoot>
</table>

<br>
<div class="col-sm-offset-10">
<label>Approximate Value</label>
<input type="text"  class="form-control" name="approximate_value" id="approximate_value" value="" style="width:250px;">	
</div>
<br>

<div class="col-sm-offset-4">
<button  class="btn btn-info" id="submit" name="save" value="save">Add & Save DC</button>
<button  class="btn btn-primary"  name="print" type="submit" id="print" value="print">Print DC</button>
<button type="reset"  class="btn btn-default" id="">Reset</button>
</div>

<script type="text/javascript">

$("#print").click(function(event){
    //alert("not enguage item");
  $("#myform").attr("target", "_blank");
});

$(document).ready(function(){


$('.grade_class').change(function(){
		 var grade = $(this).val();
	 $.post('<?php echo base_url();?>Purchase/get_hsnnos',{grade:grade},function(datas){
		 var obj=jQuery.parseJSON(datas);

		 $('#hsnno').val(obj.hsnno);
	 });

});




$( "#itemname" ).autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>dcbill/autocomplete_itemname",
data: { keyword: $("#itemname").val()},
dataType: "json",
type: "POST",
success: function(data){              
response(data);
}    
});
},
select: function (event, ui) {
var name=ui.item.value;
$('#itemname').val(ui.item.value);
$.post('<?php echo base_url();?>dcbill/get_itemnames',{name:name},function(rest){
var obj=jQuery.parseJSON(rest);
$('#hsnno').val(obj.hsnno);
$('#itemcode').val(obj.itemcode);
$('#uom').val(obj.uom);
$('#itemid').val(obj.itemid);
$('#grade').val(obj.grade);
$('#qty').val('');
$('#qty').focus();
}); 
if(name !='')
{
$.post('<?php echo base_url();?>dcbill/check_itemname',{itemname:name},function(res){
if(res > 0)
{
$('#itemname_valid').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#itemname_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
}
});

$('#itemname').blur(function(){
var itemname=$('#itemname').val();
var mobileno=$('#mobileno').val();
// var qty=$('#qty').val();
if(itemname !='')
{
$.post('<?php echo base_url();?>dcbill/check_itemname',{itemname:itemname},function(res){
if(res > 0)
{
$('#itemname_valid').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{ 
$('#itemname').focus();
$('#itemname_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
}
});
return false;
}
});



$( "#itemcode" ).autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>dcbill/autocomplete_itemcode",
data: { keyword: $("#itemcode").val()},
dataType: "json",
type: "POST",
success: function(data){              
response(data);
}    
});
},
select: function (event, ui) {
var name=ui.item.value;
$('#itemcode').val(ui.item.value);
$.post('<?php echo base_url();?>dcbill/get_itemcodes',{name:name},function(rest){
var obj=jQuery.parseJSON(rest);
$('#hsnno').val(obj.hsnno);
$('#itemname').val(obj.itemname);
$('#uom').val(obj.uom);
$('#itemid').val(obj.itemid);

$('#qty').val('');
$('#qty').focus();
}); 
if(name !='')
{
$.post('<?php echo base_url();?>dcbill/check_itemcode',{itemcode:name},function(res){
if(res > 0)
{
$('#itemcode_valid').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#itemcode_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
}
});

$('#itemcode').blur(function(){
var itemcode=$('#itemcode').val();
if(itemcode !='')
{
$.post('<?php echo base_url();?>dcbill/check_itemcode',{itemcode:itemcode},function(res){
if(res > 0)
{
$('#itemcode_valid').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{ 
$('#itemcode').focus();
$('#itemcode_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
}
});
return false;
}
});

$('.add').click(function(){
var start=$('#hide').val();
var total=Number(start)+1;
$('#hide').val(total);
var tbody=$('#append');
			$('<tr class="clears"><td><input class="form-control clear" readonly id="hsnno'+total+'" parsley-trigger="change" required type="text" name="hsnno[]" required value=""><div id="hsnno_valid'+total+'"></td>'
			<?php 	$itemcode = $this->db->select('itemcode')->where('id',1)->get('preference_settings')->row()->itemcode;
											if($itemcode==1){?>
			+'<td><input class="form-control clear" parsley-trigger="change" id="itemcode'+total+'" type="text" name="itemcode[]" value="">'
			   <?php }?>

			  
			+'<td><input class="form-control clear" parsley-trigger="change" required id="itemname'+total+'" type="text" name="itemname[]" value=""><div id="itemname_valid'+total+'"></div><input class="form-control" type="text" name="item_desc[]" value="" style="margin-top: 2px;" ><input type="hidden" id="itemid'+total+'" name="itemid[]" value=""></td> <td><input class="form-control clear" readonly id="uom'+total+'" type="text" name="uom[]"  autocomplete="off"><div id="qty_valid"></div></td><td><select name="grade[]" id="grade'+total+'" data-id="'+total+'" class="form-control grade_class"style="width: 120px;"><option value="">Select Grade</option><?php foreach($grade as $g){?><option value="<?php echo $g->id;?>"><?php echo $g->grade;?></option><?php }?></select></td><td><input class="form-control clear decimal" required id="weight'+total+'" type="text" name="weight[]" autocomplete="off" value=""  required ></td><td><input class="form-control clear decimal" required id="qty'+total+'" type="text" parsley-trigger="change" required name="qty[]" autocomplete="off" value="" onkeypress="return isNumberKey(event)" required ><div id="qty_valid'+total+'"></td>'
			+'<td><input class="form-control clear"  id="price'+total+'" type="text" name="price[]" autocomplete="off" ><div id="price_valid'+total+'"></td>'
			+'<td><input class="form-control clear"  id="remarks'+total+'" type="text" name="remarks[]" autocomplete="off" ><div id="qty_valid'+total+'"></td>'
			
			+'<td><button type="button" class="btn btn-danger remove"> <i class="fa fa-remove"></i></button></td></tr><div id="table'+total+'"></div>').appendTo(tbody);
$('#itemno'+total+'').focus();

$('.remove').click(function(){
$(this).parents('tr').remove();
});

$( "#itemname"+total+"").autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>dcbill/autocomplete_itemname",
data: { keyword: $("#itemname"+total+"").val()},
dataType: "json",
type: "POST",
success: function(data){              
response(data);
}    
});
},
select: function (event, ui) {
var name=ui.item.value;
$('#itemname'+total+'').val(ui.item.value);
$.post('<?php echo base_url();?>dcbill/get_itemnames',{name:name},function(rest){
var obj=jQuery.parseJSON(rest);
$('#hsnno'+total+'').val(obj.hsnno);
$('#itemcode'+total+'').val(obj.itemcode);
$('#uom'+total+'').val(obj.uom);
$('#itemid'+total+'').val(obj.itemid);
$('#grade'+total+'').val(obj.grade);
$('#qty'+total+'').val('');
$('#qty'+total+'').focus();
}); 

if(name !='')
{
$.post('<?php echo base_url();?>dcbill/check_itemname',{itemname:name},function(res){
if(res > 0)
{
$('#itemname_valid'+total+'').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#itemname_valid'+total+'').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
}
});


$('#itemname'+total+'').blur(function(){
var itemname=$('#itemname'+total+'').val();
if(itemname !='')
{
$.post('<?php echo base_url();?>dcbill/check_itemname',{itemname:itemname},function(res){
if(res > 0)
{
$('#itemname_valid'+total+'').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#itemname_valid'+total+'').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
});


$( "#itemcode"+total+"").autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>dcbill/autocomplete_itemcode",
data: { keyword: $("#itemcode"+total+"").val()},
dataType: "json",
type: "POST",
success: function(data){              
response(data);
}    
});
},
select: function (event, ui) {
var name=ui.item.value;
$('#itemcode'+total+'').val(ui.item.value);
$.post('<?php echo base_url();?>dcbill/get_itemcodes',{name:name},function(rest){
var obj=jQuery.parseJSON(rest);
$('#hsnno'+total+'').val(obj.hsnno);
$('#itemname'+total+'').val(obj.itemname);
$('#uom'+total+'').val(obj.uom);
$('#qty'+total+'').val('');
$('#qty'+total+'').focus();
}); 

if(name !='')
{
$.post('<?php echo base_url();?>dcbill/check_itemcode',{itemcode:name},function(res){
if(res > 0)
{
$('#itemcode_valid'+total+'').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#itemcode_valid'+total+'').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
}
});


$('#itemcode'+total+'').blur(function(){
var itemcode=$('#itemcode'+total+'').val();
if(itemcode !='')
{
$.post('<?php echo base_url();?>dcbill/check_itemcode',{itemcode:itemcode},function(res){
if(res > 0)
{
$('#itemcode_valid'+total+'').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#itemcode_valid'+total+'').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
});





$('.grade_class').change(function(){
	 var total = $(this).attr('data-id');
	 var grade = $(this).val();
	 $.post('<?php echo base_url();?>Purchase/get_hsnnos',{grade:grade},function(datas){
		 var obj=jQuery.parseJSON(datas);

		 $('#hsnno'+total).val(obj.hsnno);
	 });

});

$('.decimal').keyup(function(){
var val = $(this).val();
if(isNaN(val)){
val = val.replace(/[^0-9\.-]/g,'');
if(val.split('.').length>2)
val =val.replace(/\.-+$/,"");
}
$(this).val(val);
});
});
$('.decimal').keyup(function(){
var val = $(this).val();
if(isNaN(val)){
val = val.replace(/[^0-9\.-]/g,'');
if(val.split('.').length>2)
val =val.replace(/\.-+$/,"");
}
$(this).val(val);
});
});
</script>
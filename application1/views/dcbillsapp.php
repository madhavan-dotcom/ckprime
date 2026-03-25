<?php foreach($pre as $bil) {
$getcusname=$this->db->where('id',$bil->customerId)->get('customer_details')->result();

foreach($getcusname as $cus)
{


$addresss1=$cus->address1;
$addresss2=$cus->address2;
$citys=$cus->city;
$states=$cus->state;
$gstnos=$cus->gstno;
$mobileno=$cus->phoneno;
$pincode=$cus->pincode;
$statecode=$cus->statecode;
}
$data=$this->db->get('profile')->result();
foreach($data as $profile)
$datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage)?>
<title>Dc Bill</title>
<table width="750" border="0" style="" align="center">
<tr>
<td width="250" align="center" style="font-size:20px;font-weight:bold;"></td>
<td width="250" align="center" style="font-size:20px;font-weight:bold;text-transform:uppercase"></td>
<td width="250" align="right" style="font-size:15px;font-weight:bold;"></td>
</tr>
</table>
<table width="750" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
<tr>
<td width="150" ><img src="<?php echo base_url();?>upload/<?php echo $profileimage->image;?>" width="130" height="70" alt="logo" /></td>
<td width="450" align="center" valign="top" style="font-size:14px;"><strong style="font-size: 24px;"><?php echo $profile->companyname;?></strong><br><?php echo $profile->address1;?>, <?php echo $profile->address2;?>, <br><?php echo $profile->city;?> - <?php echo $profile->pincode;?>, Tamilnadu, India<br><b>GSTIN : <?php echo $profile->gstin;?> | PAN No :   <?php echo $profile->aadharno;?> </b><br>Phone : <?php echo $profile->phoneno;?>&nbsp;<br>Email id: <?php echo $profile->emailid;?> </td>
<td width="200" align="center"></td>
</tr>
</table>
<table width="750" border="0" align="center" style="border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;border-bottom: 1px solid black;">
<tr>
<td width="6%" height="37" valign="bottom">To :</td>
<td width="461" valign="bottom" ><b><?php echo ucfirst($bil->cusname);?></b></td>
<td colspan="2" align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; font-size: 22px;"><strong>Delivery Challan</strong></td>
</tr>
<tr>
<td height="30">&nbsp;</td>
<td rowspan="3" valign="top"><p><?php echo $addresss1;?>,<?php echo $addresss2;?><br><?php echo $citys;?>,<?php echo $states;?>-<?php echo $pincode;?><b>&nbsp;</b></p>
<p><b>GSTIN:<?php echo @$gstnos;?><span style="float:right">State Code : <?php echo @$statecode;?></span></b></p>
</td>
<td width="83" style="border-left: 1px solid black;">&nbsp;&nbsp;DC  No</td>
<td width="109"><b style="font-size: 17px;">:&nbsp;&nbsp;&nbsp;<?php echo $bil->dcno;?></b></td>
</tr>
<tr>
<td height="30"></td>
<td style="border-left: 1px solid black;">&nbsp;&nbsp;Date</td>
<td><b>:&nbsp;&nbsp;&nbsp;<?php {$a=$bil->dcdate; $d=date('d/m/Y',strtotime($a)); echo $d;};?></b></td>
</tr>

<tr>
<td height="30"></td>
<td style="border-left: 1px solid black;">&nbsp;&nbsp;Time</td>
<td><b>:&nbsp;&nbsp;&nbsp;<?php echo  $bil->time;?></b></td>
</tr>
</table>
<?php
if($bil->inwardno)
{
?>
<table width="750" border="0" style="border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;" align="center">
<tr>
<td  height="21" style="font-size: 11px;">Inward No & Date :<b>
<?php
$inwardno=explode('||',$bil->inwardno);
$counts=count($inwardno);


for ($j=0; $j < $counts; $j++) { 
$getdate=$this->db->select('inwarddate')->where('inwardno',$inwardno[$j])->get('inward_details')->row()->inwarddate;
$inwarddate=date('d/m/Y',strtotime(str_replace('-', '/', $getdate)));

echo $inwardno[$j].' - '.$inwarddate.', ';
}


?>
</b></td>
</tr>
</table>
<?php } ?>
<table width="750"   height="600" align="center" style="border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
<tr>
<td width="38" height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;" scope="row"><strong>S.No</strong></td>
<td width="77" style="border-right:1px solid black;border-bottom:1px solid black;" align="center"><strong>HSN / SAC</strong></td>
<td width="300" style="border-right:1px solid black;border-bottom:1px solid black;" align="center"><strong>Particular</strong></td>
<td width="77" style="border-right:1px solid black;border-bottom:1px solid black;" align="center"><strong>UOM</strong></td>
<td width="77" style="border-right:1px solid black;border-bottom:1px solid black;" align="center"><strong>Qty</strong></td>


</tr>
<?php foreach ($pre  as  $vob)
{
$itemname=explode('||',$vob->itemname);
$item_desc=explode('||',$vob->item_desc);
//print_r($item_desc);

$qty=explode('||',$vob->qty);
$uom=explode('||',$vob->uom);
$hsnno=explode('||',$vob->hsnno);
$customerdcno=explode('||',$vob->customerdcno);
$customerdcdate=explode('||',$vob->customerdcdate);
//	$remarksTd=explode('||',$vob->remarks);
$count=count($itemname);
$qtyCount = count($qty);
$diffcount=$count-$qtyCount;
for ($i=0; $i < $diffcount; $i++) 
{
$qty[]="0";
}

for($i=0; $i< $count; $i++){
$j=$i+1;

if(@$customerdcno[$i]=='')
{
$dc_details='';
}
else
{ 

if(@$customerdcdate[$i]=='')
{
$customerdcdates='';
}
else
{
$customerdcdates=date('d-m-y',strtotime($customerdcdate[$i]));
}

@$dc_details='<br> &nbsp;&nbsp;&nbsp;&nbsp;<span align="center" style="font-size:9px;">Dcno: '.$customerdcno[$i].' Dt: '.$customerdcdates.'</span>';

}
if($item_desc[$i]=='')
{

$item_descs='';
}
else
{
$item_descs='&nbsp;( <b>Description : </b>'.$item_desc[$i].')';
}
if($qty[$i] > 0)
{

?>
<tr height="1">
<td  align="center" style="border-right: 1px solid black;"><strong><?php echo $j;?></strong></td>
<td align="center" style="border-right: 1px solid black;"><strong><?php echo $hsnno[$i];?></strong></td>
<td align="left" style="border-right: 1px solid black;font-size: 14px;"><strong>&nbsp;&nbsp;&nbsp;<?php echo $itemname[$i];?></strong><?php echo $dc_details.$item_descs;?></small></td>
<td align="center" style="border-right: 1px solid black;"><strong><?php echo $uom[$i];?></strong></td>
<td align="center" style="border-right: 1px solid black;"><strong><?php if($qty[$i]) { echo $qty[$i]; } else { echo '0'; } ?></strong></td>

<!--  <td align="left" style="border-right: 1px solid black;"><?php echo $remarksTd[$i];?></td> -->
</tr>
<?php } } }?>
<tr height="1">
<td  style="border-right: 1px solid black;">&nbsp;</td>
<td  style="border-right: 1px solid black;">&nbsp;</td>
<td style="border-right: 1px solid black;">&nbsp;</td>
<td style="border-right: 1px solid black;">&nbsp;</td> 
<td style="border-right: 1px solid black;">&nbsp;</td>         
<!-- <td style="border-right: 1px solid black;">&nbsp;</td>   -->       
</tr>
<tr>
<td  style="border-right: 1px solid black;">&nbsp;</td>
<td  style="border-right: 1px solid black;">&nbsp;</td>
<td style="border-right: 1px solid black;">&nbsp;</td>
<td style="border-right: 1px solid black;">&nbsp;<b></b></td> 
<td style="border-right: 1px solid black;">&nbsp;</td>         
<!--  <td style="border-right: 1px solid black;">&nbsp;</td>  -->        
</tr>
<tr height="1">
<td  style="border-right: 1px solid black;">&nbsp;</td>
<td  style="border-right: 1px solid black;">&nbsp;</td>
<td style="border-right: 1px solid black;"> </td>
<td style="border-right: 1px solid black;">&nbsp;</td>  
<td style="border-right: 1px solid black;">&nbsp;</td>        
<!-- <td style="border-right: 1px solid black;">&nbsp;</td>  -->       
</tr>
</table>
<table width="750" height="80" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
<tr>  <td width="500" style="font-size: 14px; border-right: 1px solid black; padding: 3px;"  >Purpose of Transport &nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $bil->purpose; ?><br> Process Details &nbsp;&nbsp;:&nbsp;&nbsp; <?php echo $bil->process; ?><br>Vehicle No &nbsp;:&nbsp;<?php echo $bil->dispatchthrough; ?> <br> Remarks &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $bil->remarkss; ?></td>
<?php if($bil->approximate_value!=""){?>
<td width="250" valign="top" align="right" ><b>Value (Approx) : Rs. <?php echo $bil->approximate_value; ?>&nbsp;&nbsp;</b> </td><?php }?>
</tr>

</table>
<table width="750" height="80" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
<tr>  
<td width="380" valign="top" align="right" >For <b><?php echo $profile->companyname;?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
</tr>

</tr>

<td align="right"   valign="bottom">Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>


<?php }?>
<script type="text/javascript" src="<?php echo base_url();?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
window.print();
</script>



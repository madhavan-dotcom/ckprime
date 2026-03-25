<?php  
foreach($pre as $bil) 
$data=$this->db->get('profile')->result();
$datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage)
foreach ($data as $profile)

?>
<style>
@media print {
#backButon {
visibility: hidden;
}
}
.btn {
display: inline-block;
padding: 6px 12px;
margin-bottom: 0;
font-size: 14px;
font-weight: 400;
line-height: 1.42857143;
text-align: center;
white-space: nowrap;
vertical-align: middle;
-ms-touch-action: manipulation;
touch-action: manipulation;
cursor: pointer;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
background-image: none;
border: 1px solid transparent;
border-radius: 4px;
color: #fff;
background-color: #5bc0de;
border-color: #46b8da;
}
</style>
<?php $page_width=700; ?>
<table width="<?php echo $page_width;?>" border="0" id="backButon" align="center">
<tr>
<td align="right" style="position:absolute;"><a -class="btn btn-success" href="<?php echo base_url().'invoice';?>">Go back to Add Invoice</a><?php if($fromDirectBill==0) { ?>&nbsp;<a -class="btn btn-primary" href="javascript:window.close();">Close</a> <?php } ?></td>
</tr>
</table>
<?php
$copy[0]='Original';
$copy[1]='Duplicate ';
$copy[2]='Triplicate ';
//$copy[3]='Trip ';

 for($z=0;$z<3;$z++) {?>
<table width="<?php echo $page_width;?>" border="0" style="" align="center">
<tr>
<td width="250" align="center" style="font-size:20px;font-weight:bold;"></td>
<td width="250" align="center" style="font-size:20px;font-weight:bold;text-transform:uppercase"><?php echo $bil->bill_type;?></td>
<td width="250" align="right" style="font-size:15px;font-weight:bold;"><?php echo $copy[$z]; ?></td>
</tr>
</table>
<table width="<?php echo $page_width;?>" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
<tr>
<td width="100" ><img src="<?php echo base_url();?>upload/<?php echo $profileimage->image;?>" width="100" height="50" alt="logo" /></td>
<td width="450" align="center" valign="top" style="font-size:14px;">
<strong style="font-size: 18px;color:#0186bc"><?php echo $profile->companyname;?></strong><br><?php echo $profile->address1;?><br><?php echo $profile->address2;?> <?php echo $profile->city;?> - <?php echo $profile->pincode;?>, Tamilnadu<br><b>GSTIN: <?php echo $profile->gstin;?></b>
<br>Phone : <?php echo $profile->phoneno;?>,<?php echo $profile->mobileno;?>, &nbsp;Email id : <?php echo $profile->emailid;?> </td>
<td width="50"></td>
</tr>
</table>


<?php 

$shipToadd1='';
$shipToadd2='';
$shipTocity='';
$shipTostate='';
$shipgstno='';
$shipTomobileno='';
$shipTopincode='';
$shipTostatecode='';

$addresss1="";
$addresss2="";
$citys="";
$states="";
$gstnos="";
$mobileno="";
$pincode="";
$statecode="";

$getcusname=$this->db->where('name',$bil->customername)->where('id',$bil->customerId)->get('customer_details')->result();

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
$discountBy = $bil->discountBy;
?>

<?php 

 $getshipTo=$this->db->where('name',$bil->customername)->where('id',$bil->customerId)->get('customer_details')->result();


foreach($getshipTo as $to)
{


$shipToadd1=$to->address1;
$shipToadd2=$to->address2;
$shipTocity=$to->city;
$shipTostate=$to->state;
$shipgstno=$to->gstno;
$shipTomobileno=$to->phoneno;
$shipTopincode=$to->pincode;
$shipTostatecode=$cus->statecode;
}
foreach ($pre  as  $vob)
{
  $pono = $vob->pono;
  
}
if ($pono != '') {
@$orderno=$this->db->select('purchaseorder')->where('purchaseorderno',$pono)->get('purchaseorder_details')->row()->purchaseorder;	
@$orderdate=$this->db->select('invoicedate')->where('purchaseorderno',$pono)->get('purchaseorder_details')->row()->invoicedate;
}
else
{
$orderno = $bil->orderno;	
$orderdate = $bil->orderdate;
}

?>

<table width="<?php echo $page_width;?>" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="1">
<tr>
	<td width="434" style="font-size:14px;border-right:1px solid black;">
		<table>
			<tr>
				<td width="500" style="font-size:14px;" ><b>&nbsp;Bill To <br>&nbsp;<?php echo $bil->customername;?></b></td>
			</tr>
			<tr>
	<td width="500"  valign="top" style="font-size:14px;">&nbsp;<?php echo @$addresss1;?>,<br>&nbsp;<?php echo @$addresss2;?></td>
	</tr>
	<tr>
	<td width="500"  style="font-size:14px;">&nbsp;<?php echo @$citys;?>&nbsp;,&nbsp;<?php echo $states; ?>-<?php echo @$pincode;?>,<?php echo @$mobileno;?></td>
	</tr>
	<tr>
<td width="500" style="font-size:14px;"><b>&nbsp;GSTIN:<?php echo @$gstnos;?><span style="float:right">State Code : <?php echo @$statecode;?></span></b></td>
</table>
	</td>
	<td style="font-size:14px;border-right:1px solid black;">
	<table style="margin-top: -25px !important;">
		<tr>
			<td width="250" style="font-size:12px;">&nbsp;&nbsp;&nbsp;Invoice No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo $bil->invoiceno;?></b></td>
			</tr>
			<tr>
			<td width="250" style="font-size:12px;" >&nbsp;&nbsp;&nbsp;Invoice Date<b>
&nbsp;&nbsp;:&nbsp;
<?php {$a=$bil->invoicedate; $d=date('d/m/Y',strtotime($a)); echo $d;};?>
</b></td>
</tr>
<tr>

</tr>
<tr>

</tr>
<tr>
<td style="font-size:12px;">&nbsp;&nbsp;&nbsp;Vehicle No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b>&nbsp;
<?php echo $bil->vehicleno;?></b></td>
		</tr>
		<!-- <tr>
			<td style="font-size:14px;" >&nbsp;&nbsp;&nbsp;Date Of Removal&nbsp;:&nbsp;<b><?php $removal=$bil->removalDate; if($removal == '1970-01-01'){echo "";}else{ $removaldate=date('d/m/Y',strtotime($removal)); echo $removaldate;}?></b></td>
		</tr> -->
		<!-- <tr>
		<td style="font-size:14px;" >&nbsp;&nbsp;&nbsp;Time Of Removal&nbsp;:&nbsp;<b><?php echo $bil->time;?></b></td>
</tr> -->
		</table>
	</td>
</tr>
</table>

<?php
$discountss=explode('||',$bil->discount);
$diccount=array_sum($discountss);
$itemwidth=208;
if($diccount <= 0)
{
$itemwidth=95+$itemwidth;
}
if($bil->gsttype=='intrastate')
{
$itemwidth=94+$itemwidth;
$tot_width = 440;
}
if($bil->gsttype=='interstate')
{
$itemwidth=91+$itemwidth;
$tot_width = 470;
}
?>
<!-- <?php //echo $tot_width;?> -->

<table width="<?php echo $page_width;?>"   height="500" align="center"  style="border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
<tr style="font-size: 13px;">   
<td width="80" height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" ><b>S.No</b></td>
<td width="180" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>HSN</strong></td>
<td width="1100" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Description</b></td>
<td width="80" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Units</strong></td>
<td width="80" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>UOM</strong></td>
<td width="80" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Qty</b></td>
<td width="80" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Rate</b></td>


<!-- <td width="66" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Amount</b></td> -->
<?php

if($diccount >0)
{
?>
<td width="80" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Disc</strong></td>

<!-- <td width="55" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Taxable Value</strong></td> -->
<?php } ?>

<td width="80" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Amount</b></td>
</tr>          
<?php
$j=0;
 foreach ($pre  as  $vob)
{

// echo"<pre>";
// print_r($vob);
// exit;

$itemname=explode('||',$vob->itemname);
$item_desc=explode('||',$vob->item_desc);
$rate=explode('||',$vob->rate);
$qty=explode('||',$vob->qty);
$amount=explode('||',$vob->amount);
$uom=explode('||',$vob->uom);
$discounts=explode('||',$vob->discount);
$disamounts=explode('||',$vob->discountamount);
$taxableamt=explode('||',$vob->taxableamount);
$hsnno=explode('||',$vob->hsnno);
$itemcode=explode('||',$vob->itemcode);
$totalqty=$vob->totalqty;
$dcnos=explode('||',$vob->dcnos);
$deliveryid=explode('||',$vob->deliveryid);


$count=count($itemname);
for($i=0; $i< $count; $i++){


if($discounts[$i]==0 || $discounts[$i]=='')
{
$discount=0;
}
else
{
$discount=$discounts[$i];
}

if(@$disamounts[$i]==0 || @$disamounts[$i]=='')
{
@$disamount=0;
}
else
{
$disamount=$disamounts[$i];
}

/*
if(@$dcnos[$i]=='')
{
$dc_details='';
}
else
{
@$dcdates=$this->db->select('dcdate')->where('dcno',$dcnos[$i])->get('dcbill_details')->row()->dcdate;
@$dc_details='&nbsp;&nbsp;<span align="center" style="font-size:11px;">DC No: '.$dcnos[$i].' Dt: '.date('d-m-y',strtotime($dcdates)).'</span>';

}*/

          if(@$deliveryid[$i]=='')
          {
            $dc_details='';
          }
          else
          {   
               @$dcno=$this->db->select('customerdcno')->where('id',$deliveryid[$i])->get('dc_delivery')->row()->customerdcno;
            // @$dcno=$bil->dcno;
              @$dcdates=$this->db->select('customerdcdate')->where('id',$deliveryid[$i])->get('dc_delivery')->row()->customerdcdate;
              @$dc_details='&nbsp;&nbsp;<span align="center" style="font-size:14px;"> Dcno: '.$dcno.' Dt: '.date('d-m-y',strtotime($dcdates)).'</span>';

          }
if(@$item_desc[$i]!='')
{
$descDet = '<span style="font-size:12px;">&nbsp;('.$item_desc[$i].')</span>';
}
else
{
$descDet = '';
}


$dis[]=$disamount;
//$over[]=$overalltotal[$i];
$taxam[]=$taxableamt[$i];
$qtyh[]=$qty[$i];
//$totalh[]=$total[$i];
// $sgsth[]=$sgstamt;
// $igsth[]=$igstamt;
// $cgsth[]=$cgstamt;
$totamt[]=$amount[$i];
$bottomTot =array_sum($totamt);	
// $grandTotCgsth = array_sum($cgsth);
// $grandTotSgsth = array_sum($sgsth);
// $grandTotIgsth = array_sum($igsth);
$tqty=array_sum($qtyh);


 if($qty[$i] > 0)
		  {
$j=$j+1;
?>
<tr style="height:1px;">
<td  align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $j;?></td>
<td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;text-transform: capitalize;">&nbsp;<?php echo $hsnno[$i];?></td>
<td align="left" style="border-right: 1px solid black;padding:3px;font-size:14px;"><?php echo $itemname[$i];?>
</td>
<td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;text-transform: capitalize;"><?php echo $descDet;?></td>
<td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;text-transform: capitalize;">&nbsp;<?php echo $uom[$i];?></td>
<td align="center" style="border-right: 1px solid black;padding:3px;font-size:13px;"><?php echo $qty[$i];?></td>
<td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;"><?php echo number_format($rate[$i],2);?></strong></td>


<!-- <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format($amount[$i],2);?></strong></td> -->
<?php
if($diccount >0)
{
?>
<td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;">&nbsp;<?php echo number_format($disamount,2);?><?php if($discountBy=="percent_wise") { ?><br><span style="font-size:13px;"><?php echo number_format($discount,2);?>%</span><?php } ?></td>
<!-- <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;">&nbsp;<strong><?php echo number_format($taxableamt[$i],2);?></strong></td> -->
<?php 
}

?>


<td align="right" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo number_format($taxableamt[$i],2);?></td>                 
</tr>
<?php } } }?>    
<?php //if($count < 5) { ?>  

<tr >
<td  style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td  style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td align="center" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td align="center" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
 <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
<?php
if($diccount >0)
{
?>
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>

<?php 
//}
?>       


<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
</tr>

<tr >
<td  style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td  style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td align="center" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td align="center" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
 <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
<?php
if($diccount >0)
{
?>
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>

<?php 
}
?>       


<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
</tr>
<?php } else { } ?>
<tfoot>
<tr >
<td valign="bottom"  style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td valign="bottom"  style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td align="center" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td align="center" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
<td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 

<?php
if($diccount >0)
{
?>
<td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>Discount</small></td>
 
<?php 
}

?>      


<td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small></small></td>
</tr>
<tr>
<td   style="border-bottom:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td   style="border-bottom:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td   style="border-bottom:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td   style="border-bottom:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td   style="border-bottom:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td   style="border-bottom:1px solid black;padding:5px;font-size:18px;font-weight:bold;"></td>
<td  align="right" style="border-bottom:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;&nbsp;Total&nbsp; </td>
<!-- <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo  number_format($bottomTot,2); ?></td> -->
<?php
if($diccount >0)
{
?>
<td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo   number_format(array_sum($dis),2); ?></td>
<!-- <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo   number_format(array_sum($taxam),2); ?></td>  -->
<?php 
}
if($bil->gsttype=='intrastate')
{
?>            

<?php }
if($bil->gsttype=='interstate')
{
?>      

<?php } ?>
<td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo number_format($bottomTot,2); ?></td>
</tr>
</tfoot>
</table>

<table width="700" border="0" align="center" style="border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;border-bottom: 1px solid #000;">
    <tbody>
        <tr>
            <td style="padding: 3px 10px;font-size:14px">Descriptions: <?php echo $orderno;?></td>
        </tr>
    </tbody>
</table>

<table width="<?php echo $page_width?>" border="0" align="center" style="border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">

<?php 
if($bil->gsttype=='intrastate')
{
$taxcgst = $bil->cgstamount;
$taxsgst = $bil->sgstamount;
@$taxAmt = @$taxcgst + @$taxsgst;
}
if($bil->gsttype=='interstate')
{
$taxigst = $bil->igstamount;
$taxAmt = $taxigst;
}
?>


<tr>
    <!--<td colspan="3"  valign="top" style="font-size:14px;font-weight:bold; border-right: 1px solid black;border-bottom: 1px solid black;">Descriptions: <?php echo $orderno;?></td>-->
<td colspan="3"  valign="top" style="font-size:14px;font-weight:bold; border-right: 1px solid black;"></td>

<td width="155" align="right" style=""><span style="font-size:14px;font-weight:bold;">Sub Total&nbsp;&nbsp;:</span></td>
<td width="90" align="right">&nbsp;<b><?php echo number_format($bottomTot,2); ?></b></td>
</tr>
<tr>

<td colspan="3" valign="top" style="font-size:14px;font-weight:bold; border-right: 1px solid black;padding: 0px 10px;">Grand Total in words<br><span style="font-size:13px;">Rupees : <b style="font-size:13px;"><?php echo $fin;?> only</span></td>
<td align="right" style="margin-top:10px !important;"><span style="font-size:14px;font-weight:bold;">Frieght Charges&nbsp;&nbsp;:</span></td>
<td align="right" ><b><?php echo  number_format((float)$bil->freightamount,2);?></b></td>
</tr>
<tr>
    
<td colspan="3" style="border-right: 1px solid #000;"><b>&nbsp;&nbsp;<u>Bank Details</b></u></td>
<td align="right" style=""><span style="font-size:14px;font-weight:bold;">P & F Charges&nbsp;&nbsp;:</span></td>
<td align="right" ><b><?php echo  number_format((float)$bil->loadingamount,2);?></b></td>
</tr>

<tr>
<td colspan="3" style="border-right: 1px solid #000;font-size:13px;">&nbsp;&nbsp;A/c Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b><?php echo $profile->aname;?></b></td>
 
    <td align="right" style=""><span style="font-size:14px;font-weight:bold;">Round Off&nbsp;&nbsp;:</span></td>
<td align="right" ><b><?php echo  number_format($bil->roundOff,2);?></b></td>
 </tr>
 
 <tr>
     <td colspan="3" style="border-right: 1px solid #000;font-size:13px;">&nbsp;&nbsp;Account No &nbsp;: <b><?php echo $profile->accountno;?></b></td>


<?php if($bil->gsttype=='intrastate') { ?> 

<td align="right" style=""><span style="font-size:14px;font-weight:bold;">&nbsp;&nbsp;CGST&nbsp;&nbsp;<?php echo $bil->cgst;?>%:</span></td>
<td align="right" ><b><?php echo number_format((float)$bil->cgstamount,2);?></b></td>
</tr>

<tr>
<td colspan="3" style="border-right: 1px solid #000;font-size:13px;">&nbsp;&nbsp;Bank Name &nbsp;: <b><?php echo $profile->bankname;?></b> </td>
    <td align="right" style=""><span style="font-size:14px;font-weight:bold;">&nbsp;&nbsp;SGST&nbsp;&nbsp;<?php echo $bil->sgst;?>%:</span></td>

<td align="right" ><b><?php echo number_format((float)$bil->sgstamount,2);?></b></td>
<?php }
if($bil->gsttype=='interstate')
{
?>   
</tr>

<tr>
    
 <td colspan="3" style="border-right: 1px solid #000;">&nbsp;&nbsp;Branch &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b><?php echo $profile->bankbranch;?></b> </td>
<td align="right" style=""><span style="font-size:14px;font-weight:bold;">&nbsp;&nbsp;IGST&nbsp;&nbsp;@<?php echo $bil->igst;?>%:</span></td>
<td align="right" ><b><?php echo  number_format($bil->igstamount,2);?></b></td>
<?php } ?>
</tr>

<tr>
 <td colspan="3" style="border-right: 1px solid #000;font-size:13px;">&nbsp;&nbsp;Branch &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b><?php echo $profile->bankbranch;?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IFSC:<b><?php echo $profile->ifsccode;?></b></td>

    
    
    <td align="right" style="border-bottom: 1px solid black"><span style="font-size:14px;font-weight:bold;">Grand Total &nbsp;&nbsp;:</span></td>
<td align="right" style="border-bottom: 1px solid black"><strong><?php echo number_format(round($bil->grandtotal),2);?></strong></td>



</tr>




<tr>
<td colspan="3" style="border-right: 1px solid #000;border-bottom:1px solid #000"></td>

    
    
    <!--<td align="right" style="border-bottom: 1px solid black"><span style="font-size:16px;font-weight:bold;">FOR &nbsp;&nbsp;:</span></td>-->
<td colspan="2" align="right" style="border-bottom: 1px solid black;font-size:12px;font-weight:bold;color:#0186bc">For MJK STEELS INDIA [P] LIMITED 
<table>
    <tbody>
        <tr>
            <td> </td>
        </tr>
    </tbody>
</table>

<table>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>

<table>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>

<table>
    <tbody>
        <tr>
            <td style="font-size:12px;align:right;color:#0186bc;">Authorised Signatory</td>
        </tr>
    </tbody>
</table>

</td>


</tr>





  

<!--<tr>-->
<!--    <td colspan="3">&nbsp;&nbsp;IFSC Code &nbsp;&nbsp;: <b><?php echo $profile->ifsccode;?></b></td>-->

<!--</tr>-->

</table>



<!--<table width="<?php echo $page_width;?>"  align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">-->
    
<!--<tr>-->
<!--<td colspan="3" style="border-right: 1px solid #000;">&nbsp;&nbsp;IFSC Code &nbsp;&nbsp;: <b><?php echo $profile->ifsccode;?></b></td>-->
 
<!--<td width="280" style="font-size:13px;border-right:1px solid black;" align="right">For <b style="font-size:14px;"><?php echo $profile->companyname;?></b></td>-->
<!--</tr>-->
<!--<tr> -->
<!--<td colspan="3" style="border-right: 1px solid #000;"></td>-->

<!--<td width="280" style="font-size:14px;border-right:1px solid black;" align="right" valign="bottom"><b>Authorised Signatory</b></td>-->
<!--</tr>    -->
<!--</table>-->
<br>
<?php 
unset($totamt);
unset($cgsth);
unset($sgsth);
unset($igsth);

} ?>
<script type="text/javascript" src="<?php echo base_url();?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
window.print(); 
</script>

<style type="text/css">
table tr td
{
padding: 3px;
}
</style>

<?php 
if($bil->gsttype=='interstate')
{
?>      
<br>
<?php } ?>


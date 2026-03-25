<?php  
error_reporting(0);
foreach($pre as $bil) 
$data=$this->db->get('profile')->result();
$datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage)
foreach ($data as $profile)
?>

<link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">




<style>

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

 @font-face {
        font-family: 'Bgothm';
        src: url('<?php echo base_url(); ?>assets/fonts/bankgothic-md-bt.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'verdana';
        src: url('<?php echo base_url(); ?>assets/fonts/verdana.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    td,
    th {
        font-family: 'verdana', sans-serif;
    }

</style>
<!--<table width="750" border="0" style="" align="center">-->
<!--<tr>-->
<!--<td id="backButon" align="right" width="250"><a class="btn btn-success" href="<?php echo base_url().'purchaseorder';?>">Go back to Add Purchase Order</a></td>-->
<!--<td id="backButon" align="right"><a class="btn btn-success" href="javascript:window.close();">Close</a></td>-->
<!--<td width="250" align="center" style="font-size:20px;font-weight:bold;">&nbsp;</td>-->
<!--<td width="250" align="center" style="font-size:15px;font-weight:bold;"></td>-->
<!--</tr>-->
<!--</table>-->
<table width="750" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
<tr>
<td width="80" style="border-right: 1px solid black;"><img src="<?php echo base_url();?>upload/<?php echo $profileimage->image;?>" width="120" height="100" alt="logo" /></td>
<td width="590" align="center" valign="top" style="font-size:12px;">
    <strong style="font-size: 42px;color:#FF070B;font-family: 'Bgothm', sans-serif;"><?php echo $profile->companyname;?></strong>

<br><?php echo $profile->address1;?>
<br><?php echo $profile->address2;?>, <?php echo $profile->city;?> - <?php echo $profile->pincode;?>

<br>Phone : <?php echo $profile->phoneno;?>,&nbsp;Mobile : <?php echo $profile->mobileno;?><br>Email id : <?php echo $profile->emailid;?>, marketing@ckprimealloys.com <br>Website : <?php echo $profile->website;?> </td>
<td width="180" style="border-left: 1px solid black;"></td>
</tr>
</table>

<table width="750" border="0" style="border:1px solid black;border-collapse: collapse;border-top: none;" align="center">
    <tr>
        <td align="center" style="font-size:24px;font-weight:bold;padding: 6px;">Order Acceptance</td>
    </tr>
</table>

<?php 
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
$discountBy = $bil->discountBy;
?>
<table width="750" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="1">
<tr>
<td width="650" style="font-size:12px;border-right:1px solid black;"><b>&nbsp;To: <?php echo $bil->customername;?></b></td>
<td width="250" style="font-size:12px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;Workorder No</td>
<td width="100" style="font-size:12px;" >&nbsp;&nbsp;&nbsp;Date</td>
</tr>
<tr>
<td width="650" rowspan="4" valign="top" style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @$addresss1;?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @$addresss2;?>, <?php echo @$citys;?>, <?php echo @$states;?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pin Code : <?php echo @$pincode;?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile No : <?php echo @$mobileno;?></td>
<td width="250" style="font-size:12px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;<b><?php echo $bil->purchaseorderno;?></b></td>
<td width="100" style="font-size:12px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;<b><?php {$a=$bil->purchasedate; $d=date('d/m/Y',strtotime($a)); echo $d;};?></b></td>
</tr>
<tr>
<td width="250" style="font-size:12px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;P.O No</td>
<!--<td width="150" style="font-size:12px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;Date</td>-->
</tr>
<tr>
<td style="font-size:12px;border-right:1px solid black;" ><b>&nbsp;&nbsp;&nbsp;<?php echo $bil->purchaseorder;?></b></td>
<!--<td style="font-size:12px;border-right:1px solid black;" >&nbsp;<b><?php {$a=$bil->invoicedate; $d=date('d/m/Y',strtotime($a)); echo $d;};?></b></td>-->
</tr>
<tr>
<td style="font-size:12px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;Cus Delivery Date</td>
<td style="font-size:12px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;</td>
</tr>


<tr>
<td width="700" style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GSTIN: <?php echo @$gstnos;?><span style="float:right">State Code : <?php echo @$statecode;?></span></td>
<td width="150" style="font-size:12px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;<b><?php echo $bil->deliverydate;?></b></td>
<td width="150" style="font-size:12px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;</td>
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
}
if($bil->gsttype=='interstate')
{
$itemwidth=91+$itemwidth;
}


?>


<table width="750"   height="600" align="center"  style="border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
<tr style="font-size: 13px;">   
<td width="35" height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" ><b>S.No</b></td>
<td width="70" height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" ><b>Product</b></td>
<td width="<?php echo $itemwidth;?>" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Item Description</b></td>
<td width="250" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Drg / Part No</strong></td>
<td width="60" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Grade</b></td>
<td width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Qty</b></td>
<td width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Rate</b></td>
<td width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>C.Wt</b></td>
<td width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>T.Wt</b></td>
<!--<td width="42" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px" align="center"><b>Status</b></td>-->
<td width="100" style="border-bottom:1px solid black;padding:5px;" align="center"><b>Delivery <br> Date</b></td>


</tr>          
<?php foreach ($pre  as  $vob)
{

// echo"<pre>";
// print_r($vob);

$itemname=explode('||',$vob->itemname);
$itemdesc=explode('||',$vob->item_desc);
$rate=explode('||',$vob->rate);
$qty=explode('||',$vob->qty);
// $amount=explode('||',$vob->total);
$total=explode('||',$vob->total);
$amount=explode('||',$vob->amount);
$uom=explode('||',$vob->uom);
$discounts=explode('||',$vob->discount);
$disamounts=explode('||',$vob->discountamount);
$taxableamt=explode('||',$vob->taxableamount);
$hsnno=explode('||',$vob->hsnno);
$itemcode=explode('||',$vob->itemcode);
$drawingno =explode('||',$vob->drawingno);
$weight=explode('||',$vob->weight);
$grade = explode('||',$vob->grade);
$sgsts=explode('||',$vob->sgst);
$igsts=explode('||',$vob->igst);
$cgsts=explode('||',$vob->cgst);
$sgstamts=explode('||',$vob->sgstamount);
$igstamts=explode('||',$vob->igstamount);
$cgstamts=explode('||',$vob->cgstamount);
$overalltotal=explode('||',$vob->total);
$deliverydate=explode('||',$vob->oa_deliverydate);
//$dcnos=explode('||',$vob->dcnos);



$count=count($itemname);
for($i=0; $i< $count; $i++){
$j=$i+1;

$totalweight = $weight[$i] * $qty[$i];



if($discounts[$i]==0 || $discounts[$i]=='')
{
$discount=0;
}
else
{
$discount=$discounts[$i];
}

if($disamounts[$i]==0 || $disamounts[$i]=='')
{
$disamount=0;
}
else
{
$disamount=$disamounts[$i];
}

if($sgsts[$i]==0 || $sgsts[$i]=='')
{
$sgst=0;
}
else
{
$sgst=$sgsts[$i];
}

if($igsts[$i]==0 || $igsts[$i]=='')
{
$igst=0;
}
else
{
$igst=$igsts[$i];
}

if($cgsts[$i]==0 || $cgsts[$i]=='')
{
$cgst=0;
}
else
{
$cgst=$cgsts[$i];
}

if($sgstamts[$i]==0 || $sgstamts[$i]=='')
{
$sgstamt=0;
}
else
{
$sgstamt=$sgstamts[$i];
}

if($igstamts[$i]==0 || $igstamts[$i]=='')
{
$igstamt=0;
}
else
{
$igstamt=$igstamts[$i];
}

if($cgstamts[$i]==0 || $cgstamts[$i]=='')
{
$cgstamt=0;
}
else
{
$cgstamt=$cgstamts[$i];
}

/*if(@$dcnos[$i]=='')
{
$dc_details='';
}
else
{
@$dcdates=$this->db->select('dcdate')->where('dcno',$dcnos[$i])->get('dcbill_details')->row()->dcdate;
@$dc_details='&nbsp;&nbsp;<span align="center" style="font-size:9px;">Dcno: '.$dcnos[$i].' Dt: '.date('d-m-y',strtotime($dcdates)).'</span>';

}
*/



$dis[]=$disamount;
$over[]=$overalltotal[$i];
$taxam[]=$taxableamt[$i];
$qtyh[]=$qty[$i];
$totalh[]=$total[$i];
$sgsth[]=$sgstamt;
$igsth[]=$igstamt;
$cgsth[]=$cgstamt;
$totamt[]=$amount[$i];
$bottomTot =array_sum($totamt);	
$grandTotCgsth = array_sum($cgsth);
$grandTotSgsth = array_sum($sgsth);
$grandTotIgsth = array_sum($igsth);


$getgradename = $this->db->where('id',$grade[$i])->get('grade')->row();
$getliquidweight = $this->db->where('itemcode',$itemcode[$i])->get('additem')->row();


?>
<tr style="height:1px;">
<td  align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $j;?></td>

<td align="left" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo @$itemcode[$i];?></td>
<td align="left" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $itemname[$i];?><br>
 <?php echo $itemdesc[$i];?></td>
<td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;text-transform: capitalize;">&nbsp;<?php echo $drawingno[$i];?></td>
<td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;"><?php echo $getgradename->grade;?> </td>

<td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $qty[$i];?></td>
<td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $rate[$i];?></td>
<td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $weight[$i];?></td>
<td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $totalweight;?></td>
<!--<td align="right" style="border-right: 1px solid black;padding:3px;font-size:12px;">DA<br>PA</td>-->
<!--<td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;">&nbsp;</td>-->
<td align="center" style="padding:3px;font-size:12px;"><?php echo $deliverydate[$i];?></td>




              
</tr>
<?php } }?>      
<tr >
<td  style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td align="center" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
<!--<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>-->
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>


</tr>

<tr >
<td  style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td align="center" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>    
<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>   
<!--<td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>  -->

</tr>





</table>







<table width="750" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;" cellspacing="5">  
<tr>
<td style="font-size:12px;padding:2px;"><p>We acknowlegde with thanks the receipt of your above order and are pleased to accept it as per the terms & conditions mentioned here under. Please refer our W.O. No. in all your future correspondences.</p>        
</td>
</tr>
</table>
<table width="750"  align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
<tr>
<td width="375" height="130" rowspan="2" style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;1. Delivery dates as per our OA.<br>&nbsp;&nbsp;2. Excise, Sales Tax & Other Levies shall be applicable on <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;actual basis prevailing at the time of despatch as per <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Government's notification.<br>&nbsp;&nbsp;3. Supplies will be made as per general Terms & Condition <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mentioned in our Quotation / as agreed up on <br>&nbsp;&nbsp;4. Subject To Coimbatore Jurisdiction.</td>
<td width="375" align="center" colspan="2" style="font-size:15px;border-right:1px solid black;font-weight: 600;"> <span style="margin-top: -10px;font-size:20px;font-family: 'Bgothm', sans-serif;">M/S <?php echo $profile->companyname;?></span></td>  
</tr>
<td style="font-size:12px;" valign="bottom" align="center"><b>Reviewed By</b></td>
<td style="font-size:12px;" valign="bottom" align="center"><b>Authorized By</b></td>
</tr>    
</table>
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





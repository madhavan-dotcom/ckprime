
<?php

$profilesgetdata=$this->db->where('status',1)->get('profile')->result_array();
foreach ($profilesgetdata as $key => $profilesgetdatas) {
$title=$profilesgetdatas['companyname'];
// $logo=$profilesgetdatas['logo'];
$address1=$profilesgetdatas['address1'];
$address2=$profilesgetdatas['address2'];
$emailid=$profilesgetdatas['emailid'];
$phoneno=$profilesgetdatas['phoneno'];
$gstin=$profilesgetdatas['gstin'];
}

?>

<title><?php echo $title;?></title>

<table width="1066" border="0" align="center" style="border-collapse:collapse; font-family:Calibri ;font-size:18px;">
<tr >
<td class="heading1"style="font-size:20px;" width="1060" ><div align="center"><strong><?php echo $title;?></strong></div></td>
<tr align="center">
<td class="padding" style="font-size:18px;" width="1060"><b><?php echo $address1;?> <?php echo $address2;?>
<br>Mobile No :&nbsp;<?php echo $phoneno;?>,&nbsp; Email:&nbsp;<?php echo $emailid;?></b><br><b>GSTIN :&nbsp;<?php echo $gstin;?></b><br><strong style="font-size:22px;border-bottom:1px solid black;"> Inward-DC Closed Report</strong></td><br>


</tr>
</tr>

</table>


<table width="1066" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
<tr style="font-size: 16px;">
<!--<td height="35" width="273" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>DC Reports </strong></td>-->
<td height="35" width="300" align="left" style="border-bottom:1px solid black;"><strong>Company :<?php echo $this->session->userdata('rcbio_customername');?></strong>     </td>
<td height="35" width="400" align="left" style="border-bottom:1px solid black;"><strong>Inward No: <?php echo $this->session->userdata('rcbio_inwardno');?></strong>     </td>

<!-- <td height="35" width="400" align="left" style="border-bottom:1px solid black;"><strong>Inward Qty:</strong>     </td> -->
<td height="40" width="250" align="left" style="border-bottom:1px solid black;"><strong>From : <?php echo $this->session->userdata('rcbio_fromdate');?></strong>     </td>
<td height="40" width="220" align="left" style="border-bottom:1px solid black;"><strong>To :<?php echo $this->session->userdata('rcbio_todate');?></strong></td>

</tr>
</table>

<table width="1200" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
<tr>

<td width=300" align="left" style="border-bottom:1px solid black;"><strong> DC Date</strong></td>


<td width="300" align="left" style="border-bottom:1px solid black;"><strong>Company Name</strong></td>
<td width="60" align="right" style="border-bottom:1px solid black;"><strong>Dc Type </strong></td>
<td width="250" align="right" style="border-bottom:1px solid black;text-align:center;"><strong>Inward No </strong></td>
<td width="250" align="right" style="border-bottom:1px solid black;text-align:center;"><strong>DC No</strong></td>

<td width="100" align="right" style="border-bottom:1px solid black;"><strong>Quantity</strong></td>


</tr>



<?php
$i=1; 
foreach ($purchase as $row) {



$date=date('d-m-Y',strtotime($row['date']));
$customername=$row['cusname'];
$dctype=$row['dctype'];
$dcno=$row['dcno'];
$inwardno=$row['inwardno'];
$qty[]=$row['qty'];


?>
<tr>

<td align="left" style="border-bottom:1px dotted black;"><?php echo $date;?></td>


<td align="left" style="border-bottom:1px dotted black;"><?php echo ucfirst($customername);?></td>

<td align="right" style="border-bottom:1px dotted black;text-align:center;"><?php echo $dctype;?></td> 

<td align="right" style="border-bottom:1px dotted black;text-align:center;"><?php echo $inwardno;?></td> 

<td align="right" style="border-bottom:1px dotted black;text-align:center;"><?php echo $dcno;?></td>


<td align="right" style="border-bottom:1px dotted black;"><?php echo @number_format($row['qty'],2)?></td> 



</tr>
<?php }

  $totals=array_sum($qty);
 
  

?>
  <tr style="font-size: 17px;">
    <td  height="20" style="border-bottom:1px solid black; border-top:1px solid black;">&nbsp</td>
    <td  style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td  style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td  style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    
	<td  style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
 
  
 
    <td  align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo number_format($totals,2);?></strong></td>
  </tr>


</table>





<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

// window.print();



});

</script>

<link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
<style>
    

@font-face {
  font-family: 'Bgothm';
  src: url('<?php echo base_url();?>assets/fonts/bankgothic-md-bt.ttf') format('truetype');
  font-weight: normal;
  font-style: normal;
}

@font-face {
  font-family: 'verdana';
  src: url('<?php echo base_url();?>assets/fonts/verdana.ttf') format('truetype');
  font-weight: normal;
  font-style: normal;
}

td, th {
  font-family: 'verdana', sans-serif;
}
</style>

<?php foreach($pre as $bil) 
$data=$this->db->get('profile')->result();
$datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage)
  foreach ($data as $profile)
  //   $taxamount= $bil->taxamount;
  // if($taxamount=="")
  // {
  //   $taxamount=0.00;
  // }
  // $charges=$bil->charges;
  // if($charges=="")
  // {
  //   $charges=0.00;
  // }
  // $charges1=$bil->charges1;
  // if($charges1=="")
  // {
  //   $charges1=0.00;
  // }
  // $adjustment=$bil->adjustment;
  // if($adjustment=="")
  // {
  //   $adjustment=0.00;
  // }
  ?>
  
  <table width="750" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
<tr>
<td width="80" style="border-right: 1px solid black;"><img src="<?php echo base_url();?>upload/<?php echo $profileimage->image;?>" width="120" height="100" alt="logo" /></td>
<td width="590" align="center" valign="center" style="font-size:12px;">
    <p style="font-size: 42px;color:#FF070B;font-family: 'Bgothm', sans-serif;margin-bottom: -13px;font-weight:600;"><?php echo $profile->companyname;?></p>
    <p style="margin-top: 21px;margin-bottom: -5px;"><b><?php echo $profile->address1;?>,</b></p>
    <p><b><?php echo $profile->address2;?>, <?php echo $profile->city;?> - <?php echo $profile->pincode;?></b></p>
    <p style="margin-top:-7px;margin-bottom: -11px;"> Email id: <?php echo $profile->emailid;?>&nbsp; Phone : <?php echo $profile->phoneno;?>, <?php echo $profile->mobileno;?></p><br>
</td>
<td width="20"></td>
</tr>
</table>

<table width="750" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
      <td width="250" align="center" style="font-size:20px;font-weight:bold;"></td>
      <td width="250" align="center" style="font-size:20px;font-weight:bold;">Quotation</td>
      <td width="250" align="center" style="font-size:15px;font-weight:bold;"></td>
    </tr>
  </table>
<!--   <table width="700" border="0" style="border-bottom:1px solid black;border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="2">
    <tr>
      <td align="center" style="font-size:17px;font-weight:bold; text-transform:uppercase;"><?php echo $bil->paymenttype;?>&nbsp; BILL</td>
    </tr>
  </table> -->

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

  ?>
<table width="750" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="1">
    <tr>
      <td width="700" style="font-size:14px;border-right:1px solid black;"><b>&nbsp;To: <?php echo $bil->customername;?></b></td>
      <td width="150" style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;Quotation No</td>
      <td width="150" style="font-size:14px;" >&nbsp;&nbsp;&nbsp;Date</td>
    </tr>
    <tr>
        <td width="700" rowspan="4"  valign="top" style="font-size:14px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @$addresss1;?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @$addresss2;?>, <?php echo @$citys;?>, <?php echo @$states;?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pin Code : <?php echo @$pincode;?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile No : <?php echo @$mobileno;?>
		<br>
		<br><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GSTIN : <?php echo @$gstnos;?><span style="float:right">State Code : <?php echo @$statecode;?></span></b>
		</td>
        <td width="150" style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;<b><?php echo $bil->quotationno;?></b></td>
        <td width="150" style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;<b><?php {$a=$bil->quotationdate; $d=date('d/m/Y',strtotime($a)); echo $d;};?></b></td>
    </tr>
    <tr>
    <td style="font-size:14px;border-right:1px solid black;">&nbsp;</td>
    <td style="font-size:14px;border-right:1px solid black;">&nbsp;</td>
    </tr>
    
    <tr>
    <td style="font-size:14px;border-right:1px solid black;">&nbsp;</td>
    <td style="font-size:14px;border-right:1px solid black;">&nbsp;</td>
    </tr>


<tr>
    <td style="font-size:14px;border-right:1px solid black;">&nbsp;</td>
    <td style="font-size:14px;border-right:1px solid black;">&nbsp;</td>
    </tr>

   
     
     
</table>
    
    <?php
       $discountss=explode('||',$bil->discount);
        $diccount=array_sum($discountss);
        $itemwidth=208;
         if($diccount <= 0)
        {
            $itemwidth=7+$itemwidth;
        }
         if($bil->gsttype=='intrastate')
        {
          $itemwidth=94+$itemwidth;
        }
         if($bil->gsttype=='interstate')
        {
          $itemwidth=91+$itemwidth;
        }

//215
    ?>


    <table width="750"   height="470" align="center"  style="border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
      <tr style="font-size: 13px;">   
        <td width="35" rowspan="2" height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" ><b>S.No</b></td>
        <td rowspan="2" height="30" width="<?php echo $itemwidth;?>" colspan="2" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Description</b></td>
		<td rowspan="2" height="30" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Drawing No</b></td>
        <td rowspan="2" height="30" width="60" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Grade</strong></td>
         <td rowspan="2" height="30" width="29" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Qty</b></td>
        <td rowspan="2" height="30" width="42" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Pattern Cost   </b></td>
        <td rowspan="2" height="30" width="42" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Rate/Kg</b></td>
        <td colspan="2" height="30" width="42" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Batch Qty Price</b></td>
        <td rowspan="2" height="30" width="42" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Remarks</b></td>
      </tr> 
      
      <tr style="font-size: 13px;">
        <td width="42" height="30" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Gauge Cost   </b></td>
        <td width="42" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>10Nos</b></td>
      </tr>
      <?php foreach ($pre  as  $vob)
      {

        // echo"<pre>";
        // print_r($vob);

        $itemname=explode('||',$vob->itemname);
        $description=explode('||',$vob->description);
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
        $sgsts=explode('||',$vob->sgst);
        $igsts=explode('||',$vob->igst);
        $cgsts=explode('||',$vob->cgst);
        $sgstamts=explode('||',$vob->sgstamount);
        $igstamts=explode('||',$vob->igstamount);
        $cgstamts=explode('||',$vob->cgstamount);
        $overalltotal=explode('||',$vob->total);
    
        $count=count($itemname);
        for($i=0; $i< $count; $i++){
          $j=$i+1;

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
            @$disamount=@$disamounts[$i];
          }

         
          if(@$dcnos[$i]=='')
          {
            @$dc_details='';
          }
          else
          {
              @$dcdates=$this->db->select('dcdate')->where('dcno',@$dcnos[$i])->get('dcbill_details')->row()->dcdate;
              @$dc_details='&nbsp;&nbsp;<span align="center" style="font-size:9px;">Dcno: '.$dcnos[$i].' Dt: '.date('d-m-y',strtotime($dcdates)).'</span>';

          }




          @$dis[]=$disamount;
          @$over[]=$overalltotal[$i];
          @$taxam[]=$taxableamt[$i];
          @$qtyh[]=$qty[$i];
          @$totalh[]=$total[$i];
          @$sgsth[]=@$sgstamt;
          @$igsth[]=@$igstamt;
         @$cgsth[]=@$cgstamt;
          @$totamt[]=@$amount[$i];





          ?>
          <tr style="height:1px;">
            <td  align="center" style="border-right: 1px solid black;padding:3px;font-size:13px;"><?php echo $j;?></td>
            <td align="left"  colspan="2" style="border-right: 1px solid black;padding:3px;font-size:13px;"> <?php echo $itemname[$i];?><br> <span align="center" style="font-size:11px;">(HSN:&nbsp;<?php echo $hsnno[$i];?>)</span><?php echo $dc_details;?></td>
             <td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;">2.067398</td>
            <td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;text-transform: capitalize;">A148 GR 60-90</td>
            <td align="center" style="border-right: 1px solid black;padding:3px;font-size:13px;"><?php echo$qty[$i];?></td>
             <td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;">-</td>
             <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><?php echo number_format($rate[$i],2);?></td>
             <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;">18000.00</td>
             <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;">5750.00</td>
             <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;">&nbsp;</td>
              
      </tr>
            <?php } }?>      
            <tr>
              <td  style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td colspan="2" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td align="center" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
            </tr>
            

            <?php /*<tfoot>
            <tr >
              <td valign="bottom"  style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td valign="bottom" colspan="2" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <!--<td align="center" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>-->
              <td valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small></small></td>
               <?php
              if($diccount >0)
              {
            ?>
             <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>Discount</small></td>
            <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>Taxable Amount</small></td>  
             <?php 
              }
              if($bil->gsttype=='intrastate')
              {
              ?>      
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>CGST</small></td>     
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>SGST</small></td>  
               <?php }
              if($bil->gsttype=='interstate')
              {
                ?>   
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>IGST</small></td>
              <?php } ?>
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>Total</small></td>
            </tr>
             <tr >
              <td  style="border-bottom:1px padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td colspan="5" align="right" style="border-bottom:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp; </td>
              
               <?php
              if($diccount >0)
              {
            ?>
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo   number_format(array_sum($dis),2); ?></td>
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo   number_format(array_sum($taxam),2); ?></td> 
                 <?php 
               }
              if($bil->gsttype=='intrastate')
              {
              ?>            
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo  number_format(array_sum($cgsth),2); ?></td>     
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo  number_format(array_sum($sgsth),2); ?></td>  
               <?php }
              if($bil->gsttype=='interstate')
              {
                ?>      
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;"><?php echo  number_format(array_sum($igsth),2); ?></td>
               <?php } ?>
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo  number_format($bil->subtotal,2); ?></td>
            </tr>
          </tfoot>*/?>
</table>
    <table width="750" border="0" align="center" style="border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">



      <tr>
            <td colspan="3" rowspan="1" valign="top" style="font-size:14px;font-weight:bold;"><span style="font-size:13px;">Rupees :<b style="font-size:13px;"><?php echo $fin;?> only</b></span></td>
            <td align="right" style=""><span style="font-size:16px;font-weight:bold;">Sub Total&nbsp;&nbsp;:</span></td>
            <td align="right">&nbsp;<b><?php echo number_format($bil->subtotal,2); ?></b></td>
      </tr>
      <?php if($bil->gsttype=='intrastate')
              {
              ?> 
     <tr>
			<td style="font-size:14px;font-weight:bold;">&nbsp;<!--Bank Details--></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right" style=""><span style="font-size:16px;font-weight:bold;">Cgst&nbsp;&nbsp;@<?php echo $bil->cgst;?>%:</span></td>
            <td align="right">&nbsp;<b><?php if($bil->cgstamount=='') { echo "0.00"; } else { echo  number_format($bil->cgstamount,2); } ?></b></td>
          </tr>
               <tr>
			<td style="font-size:14px;font-weight:bold;">&nbsp;<!--Bank Details--></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right" style=""><span style="font-size:16px;font-weight:bold;">Sgst&nbsp;&nbsp;@<?php echo $bil->sgst;?>%:</span></td>
            <td align="right">&nbsp;<b><?php if($bil->sgstamount=='') { echo "0.00"; } else { echo  number_format($bil->sgstamount,2); } ?></b></td>
          </tr>
          <?php }?>
          <?php  if($bil->gsttype=='interstate')
              {
              ?> ?>
               <tr>
			<td style="font-size:14px;font-weight:bold;">&nbsp;<!--Bank Details--></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right" style=""><span style="font-size:16px;font-weight:bold;">Igst&nbsp;&nbsp;@<?php echo $bil->igst;?>%:</span></td>
            <td align="right">&nbsp;<b><?php if($bil->igstamount=='') { echo "0.00"; } else { echo  number_format($bil->igstamount,2); } ?></b></td>
          </tr>
          <?php }?>
          <tr>
			<td style="font-size:14px;font-weight:bold;">&nbsp;<!--Bank Details--></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
           <td align="right" style=""><span style="font-size:16px;font-weight:bold;">Total Amount &nbsp;&nbsp;:</span></td>
            <td align="right"><strong><?php echo number_format($bil->grandtotal,2);?></strong></td>
          </tr>
      
		  <?php /* 
          <tr>
            <td style="font-size:14px;"><span style="font-size:14px;">&nbsp;<!--Account No&nbsp;&nbsp;&nbsp;:--></span></td>
            <td><span style="font-size:14px;"><?php echo $profile->accountno;  ?></span></td>
            <td align="right" style="">&nbsp;</td>
            <td align="right" style="">&nbsp;</td>
            <td align="right">&nbsp;<b></td>
          </tr>
          <tr>
            <td width="114" style="font-size:14px;"><span style="font-size:14px;">&nbsp;<!--Bank Branch&nbsp;:--></span></td>
            <td width="195"><span style="font-size:14px;"><?php echo $profile->bankbranch;  ?></span></td>
            <td align="right" style="">&nbsp;</td>
            <td align="right" style=""></td>
            <td align="right"></td>
          </tr>
          <tr>
            <td style="font-size:14px;">&nbsp;IFSC Code&nbsp;&nbsp;&nbsp;&nbsp;:</td>
            <td style="font-size:14px;"><?php echo $profile->ifsccode;?></td>
            <td align="right" style="">&nbsp;&nbsp;</td>  
                    <td width="240" align="right" style="">&nbsp;</td>
            <td width="90" align="right"><strong></strong>&nbsp;&nbsp;</td>
          </tr>
		  */ ?>
          <!--<tr>

            <td style="font-size:14px;">&nbsp;IFSC Code&nbsp;&nbsp;&nbsp;&nbsp;:</td>
            <td style="font-size:14px;"><?php echo $profile->ifsccode;?></td>
            <td align="" colspan="1" style="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</td>
            <td width="240" align="right" style="">&nbsp;</td>

            <td align="right" style="border-right:1px solid black;"><strong></strong>&nbsp;&nbsp;</td>
          </tr>-->
		  <tr>
			<td colspan="4">&nbsp;</td>
			<td align="right" style="border-right:1px solid black;"><strong></strong>&nbsp;&nbsp;</td>
		  </tr>

</table>






        <table width="750" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;" cellspacing="5">  
          <tr>
            <td style="font-size:12px;padding:2px;"><p>Certified that the particulars given are true and correct the amount indicated represents the price actually charged and  there is no flow of additional consideration directly or indirectly from the buyer.</p>        
            </td>
          </tr>
</table>
<table width="750"  align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
          <tr>
            <td width="200" style="font-size:13px;border-right:1px solid black;"><b>&nbsp;&nbsp;TERMS AND CONDITIONS</b></td>
            <td width="150" style="font-size:13px;border-right:1px solid black;">&nbsp;</td>  
            <td width="170" style="font-size:13px;border-right:1px solid black;font-family: 'Bgothm', sans-serif;" align="center">For <b style="font-size:15px;"><?php echo $profile->companyname;?></b></td>
          </tr>
          <td width="260" height="95" valign="top" style="font-size:11px;border-right:1px solid black;">&nbsp;&nbsp;1.No Claim For breakage or Loss during transit.<br>&nbsp;&nbsp;2.All disputes subject to Coimbatore Jurisdiction only.<br>&nbsp;&nbsp;3.Our Responsibility Ceases after the goods have been<br>&nbsp;&nbsp;delivered to carriers.</td>
          <td width="90" style="font-size:13px;border-right:1px solid black;" valign="bottom" align="center"><b>Receiver's Signature</b></td>
          <td width="170" style="font-size:14px;border-right:1px solid black;" align="center" valign="bottom"><b>Authorised Signatory</b></td>
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




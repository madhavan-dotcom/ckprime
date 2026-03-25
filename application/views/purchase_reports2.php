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

    td,
    th {
        font-family: 'verdana', sans-serif;
        font-size:14px;
    }
    .main-table-datas tr th, .main-table-datas tr td{
        padding:4px;
    }
</style>

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
<table width="1000" border="0" align="center" style="border-collapse:collapse;font-size:18px;">
 <tr >
      <td class="heading1" width="316"><div align="center" style="font-family: 'Bgothm', sans-serif;font-size: 24px;"><strong><?php echo $title;?></strong></div></td>
      <tr align="center">
        <td class="padding" style="font-size:12px;" width="134"><b><?php echo $address1;?><?php echo $address2;?>
          <br>Mobile No :&nbsp;<?php echo $phoneno;?>,&nbsp; Email:&nbsp;<?php echo $emailid;?></b><br><b>TIN No :&nbsp;<?php echo $gstin;?></b></td>
        </tr>
      </tr>

</table>
<table width="1000" border="0" align="center" style="border-collapse:collapse;margin-top:15px;">
  <tr style="font-size: 16px;">
    <td height="35" width="187" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>Purchase Reports </strong></td>
    <td height="35" width="443" align="left" style="border-bottom:1px solid black;"><strong>Company Name:<?php echo $this->session->userdata('rcbio_suppliername');?></strong>     </td>
    <td height="35" width="180" align="left" style="border-bottom:1px solid black;"><strong>From Date:<?php echo $this->session->userdata('rcbio_fromdate');?></strong>     </td>
    <td height="35" width="172" align="left" style="border-bottom:1px solid black;"><strong>To Date:<?php echo $this->session->userdata('rcbio_todate');?></strong></td>
  </tr>
</table>

<table width="1000" border="0" align="center" class="main-table-datas" style="border-collapse:collapse; font-size: 15px;">
  <tr>
     <td width="80" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
     <td width="160" align="left" style="border-bottom:1px solid black;"><strong>Invoice  No</strong></td>
     <td width="120" align="left" style="border-bottom:1px solid black;"><strong>Supplier Name</strong></td>
     <td width="120" align="right" style="border-bottom:1px solid black;"><strong>Weight</strong></td>
     <td width="120" align="right" style="border-bottom:1px solid black;"><strong>Qty</strong></td>
     <td width="200" align="right" style="border-bottom:1px solid black;"><strong>Purchase Amt</strong></td>   
  </tr>
  <?php
  $i=1; 
  $pur=0;
         $finalWeight = 0;
     $finalQty    = 0;

  foreach ($purchase as $row) {
     $date=date('d-m-Y',strtotime($row['invoicedate']));
     $suppliername=$row['suppliername'];
     $invoiceno=$row['invoiceno'];
     $purchaseamt=$row['grandtotal'];
     $weight = explode('||',$row['weight']);
     $qty = explode('||',$row['qty']); 
     $purchases[]=$purchaseamt;
     $pur=array_sum($purchases);
     $finalWeight += array_sum( array_map('floatval', explode('||', $row['weight'])));
     $finalQty += array_sum(array_map('floatval', explode('||', $row['qty'])));
   ?>
  <tr>
    <td align="left" style=""><?php echo $date;?></td>
    <td align="left" style=""><?php echo $invoiceno;?></td>
    <td align="left" style=""><?php echo ucfirst($suppliername);?></td>
    <td align="right" style=""><?php echo array_sum($weight);?></td>
    <td align="right" style=""><?php echo array_sum($qty);?></td>
    <td align="right" style=""><?php echo $purchaseamt;?></td>    
  </tr>
  <?php }?>

  <tr style="font-size: 15px;">
    
     <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;" colspan="3"><strong>&nbsp;Total : </strong></td>
     <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;<?php echo $finalWeight;?></strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo $finalQty;?></strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo number_format($finalWeight,2);?></strong></td>

    
  </tr>
</table>

<!-- <table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">

    <tr style="font-size: 15px;">
    
     <td style="border-bottom:1px solid black;  border-top:1px solid black;" colspan="3"><strong>&nbsp;Total : </strong></td>
     <td style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;<?php echo $finalWeight;?></strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo $finalQty;?></strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo number_format($finalWeight,2);?></strong></td>

    
  </tr> 
  </table> -->
 <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
 // window.print();
  });
</script>
<?php
error_reporting(0);
foreach ($pre as $bil)
    $data = $this->db->get('profile')->result();
$datas = $this->db->order_by('id', 'desc')->limit(1)->get('company_logo')->result();
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
    .purchase_order_p tr td p{
        font-size:12px;
        margin: 8px 5px;
    }
</style>
<table width="750" border="0" style="" align="center">
    <tr>
        <td id="backButon" align="right" width="250"><a class="btn btn-success" href="<?php echo base_url() . 'purchaseorder'; ?>">Go back to Add Purchase Order</a></td>
        <td id="backButon" align="right"><a class="btn btn-success" href="javascript:window.close();">Close</a></td>
        <td width="250" align="center" style="font-size:20px;font-weight:bold;">&nbsp;</td>
        <td width="250" align="center" style="font-size:15px;font-weight:bold;"></td>
    </tr>
</table>
<table width="750" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
    <tr>
        <td width="80" style="border-right: 1px solid black;"><img
                src="<?php echo base_url();?>upload/<?php echo $profileimage->image;?>" width="120" height="100"
                alt="logo" /></td>
        <td width="590" align="center" valign="top" style="font-size:13px;">
            <strong style="font-size: 42px;color:#FF070B;font-family: 'Bgothm', sans-serif;">
                <?php echo $profile->companyname;?>
            </strong>
            <br>
            <?php echo $profile->address1;?>
            <br>
            <?php echo $profile->address2;?>,
            <?php echo $profile->city;?> -
            <?php echo $profile->pincode;?>
            <!--<br><b>GSTIN:-->
            <!--    <?php echo $profile->gstin;?>-->
            <!--    <?php echo $profile->cstno;?>-->
            <!--</b>-->
            <br>Phone :
            <?php echo $profile->phoneno;?>,&nbsp;Mobile :
            <?php echo $profile->mobileno;?>
            <!--<br>Email id :-->
            <!--<?php echo $profile->emailid;?>, Website :-->
            <!--<?php echo $profile->website;?>-->
        </td>
        <td width="180" style="border-left: 1px solid black;"></td>
    </tr>
</table>

<table width="750" border="0" height="25"
    style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;"
    align="center">
    <tr>
        <td align="center" valign="center" style="font-size:19px;font-weight:600;">PURCHASE ORDER
        </td>
    </tr>
    <tr>
        <td align="right" valign="center" style="font-size:12px;font-weight:600;padding-right: 15px;">GSTIN.NO : <?php echo $profile->gstin;?>        </td>
    </tr>
</table>

<table width="750" border="0" height="25"
    style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;"
    align="center" valign="top" class="purchase_order_p">
    <tr>
        <td Width="270" style="font-size:14px;font-weight:600;border-right:1px solid black;">SUPPLIER DETAILS</td>
        <td Width="270" style="font-size:14px;font-weight:600;border-right:1px solid black;">BILLING ADDRESS </td>
        <td Width="210" rowspan="2" valign="top">
            <div>
                
                <?php $getworkorderdate = $this->db->where('purchaseorder',$bil->purchaseorder)->get('purchaseorder_details')->row();?>
                <p><b>PO.NO :</b> <?php echo $bil->purchaseorderno;?></p>
                <p><b>Date :</b> <?php echo date('d-m-Y',strtotime($bil->purchasedate));?></p>
                <p><b>Customer PO Ref :</b> <?php echo $bil->purchaseorder;?></p>
                <p><b>Date :</b> <?php echo date('d-m-Y',strtotime($getworkorderdate->purchasedate));?></p>
                <p><b>Vendor Quotation Ref :</b> <?php echo $bil->vendor_quot;?> </p>
                <p><b>Date :</b> <?php echo $bil->quot_date;?> </p>
            </div>
        </td>
    </tr>
    <tr>
        <td Width="270" valign="top" style="border-right:1px solid black;">
            <div>

        <?php $getsupplier = $this->db->where('id',$bil->supplierid)->get('customer_details')->row();?>
                <p><?php echo $getsupplier->name;?></p>
                <p><?php echo $getsupplier->address1;?>,</p>
                <p><?php echo $getsupplier->address2;?>,<?php echo $getsupplier->city;?>,<?php echo $getsupplier->state;?>-<?php echo $getsupplier->pincode;?>.</p>
                <p>Contact : <?php echo $getsupplier->contactperson;?> </p>
                <p>Contact Number : <?php echo $getsupplier->phoneno;?></p>
            </div>
        </td>
        <td Width="270" valign="top" style="border-right:1px solid black;">
            <div>
                <p>M/S CK prime Alloys</p>
                <p>SF.NO:845B,Door.No:1J(4)Annur Road</p>
                <p>Rayarpalayam, Karumathampatti, CBE-641659</p>
                <p>Contact: 9159531600, 9790153461 </p>
                <p>ckprimealloys@gmail.com</p>
            </div>
        </td>
        
    </tr>
</table>


<table width="750" height="410" align="center" style="border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
    <tr style="font-size: 13px;">
        <td width="35" height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;"><b>S.No</b></td>
        <td width="250" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b> Description</b></td>
        <td width="120" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Grade</b></td>
        <td width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Qty in Nos</b></td>
        <td width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Weight (Kg)</b></td>
        <td width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Rate / Kg</b></td>
        <td width="100" style="border-bottom:1px solid black;padding:5px;border-right:1px solid black;" align="center"><b>Value</b></td>
        <td width="100" style="border-bottom:1px solid black;padding:5px;" align="center"><b>Remarks</b></td>


    </tr>
    <?php foreach ($pre  as  $vob) {

        // echo"<pre>";
        // print_r($vob);

        $itemname = explode('||', $vob->itemname);
        $itemdesc = explode('||', $vob->item_desc);
        $rate = explode('||', $vob->rate);
        $qty = explode('||', $vob->qty);
        // $amount=explode('||',$vob->total);
        $total = explode('||', $vob->total);
        $amount = explode('||', $vob->amount);
        $uom = explode('||', $vob->uom);
        $discounts = explode('||', $vob->discount);
        $disamounts = explode('||', $vob->discountamount);
        $taxableamt = explode('||', $vob->taxableamount);
        $hsnno = explode('||', $vob->hsnno);
        $itemcode = explode('||', $vob->itemcode);
        $drawingno = explode('||', $vob->drawingno);
        $weight = explode('||', $vob->weight);
        $grade = explode('||', $vob->grade);
        $sgsts = explode('||', $vob->sgst);
        $igsts = explode('||', $vob->igst);
        $cgsts = explode('||', $vob->cgst);
        $sgstamts = explode('||', $vob->sgstamount);
        $igstamts = explode('||', $vob->igstamount);
        $cgstamts = explode('||', $vob->cgstamount);
        $overalltotal = explode('||', $vob->total);
        $deliverydate = explode('||', $vob->deliverydates);
        //$dcnos=explode('||',$vob->dcnos);

        $count = count($itemname);
        for ($i = 0; $i < $count; $i++) {

            $totalweight = $qty[$i] * $weight[$i];
            $j = $i + 1;

            if ($discounts[$i] == 0 || $discounts[$i] == '') {
                $discount = 0;
            } else {
                $discount = $discounts[$i];
            }

            if ($disamounts[$i] == 0 || $disamounts[$i] == '') {
                $disamount = 0;
            } else {
                $disamount = $disamounts[$i];
            }

            if ($sgsts[$i] == 0 || $sgsts[$i] == '') {
                $sgst = 0;
            } else {
                $sgst = $sgsts[$i];
            }

            if ($igsts[$i] == 0 || $igsts[$i] == '') {
                $igst = 0;
            } else {
                $igst = $igsts[$i];
            }

            if ($cgsts[$i] == 0 || $cgsts[$i] == '') {
                $cgst = 0;
            } else {
                $cgst = $cgsts[$i];
            }

            if ($sgstamts[$i] == 0 || $sgstamts[$i] == '') {
                $sgstamt = 0;
            } else {
                $sgstamt = $sgstamts[$i];
            }

            if ($igstamts[$i] == 0 || $igstamts[$i] == '') {
                $igstamt = 0;
            } else {
                $igstamt = $igstamts[$i];
            }

            if ($cgstamts[$i] == 0 || $cgstamts[$i] == '') {
                $cgstamt = 0;
            } else {
                $cgstamt = $cgstamts[$i];
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



            $dis[] = $disamount;
            $over[] = $overalltotal[$i];
            $taxam[] = $taxableamt[$i];
            $qtyh[] = $qty[$i];
            $totalh[] = $total[$i];
            $sgsth[] = $sgstamt;
            $igsth[] = $igstamt;
            $cgsth[] = $cgstamt;
            $totamt[] = $amount[$i];
            $bottomTot = array_sum($totamt);
            $grandTotCgsth = array_sum($cgsth);
            $grandTotSgsth = array_sum($sgsth);
            $grandTotIgsth = array_sum($igsth);


            $getgradename = $this->db->where('id', $grade[$i])->get('grade')->row();
            $getliquidweight = $this->db->where('itemcode', $itemcode[$i])->get('additem')->row();


    ?>
            <tr style="height:1px;">
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $j; ?></td>
                <td align="left" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $itemname[$i]; ?><br>
                         <?php echo $itemdesc[$i]; ?></td>
                <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;"><?php echo $getgradename->grade; ?> </td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $qty[$i]; ?></td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $weight[$i]; ?></td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $totalweight; ?></td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $taxableamt[$i];?></td>

                <!--<td align="right" style="padding:3px;font-size:12px;">DA<br>PA</td>-->
                <td align="left" style="padding:3px;font-size:12px;"><?php echo $deliverydate[$i];?></td>





            </tr>
    <?php }
    } ?>
    <tr>
        <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>



    </tr>

    <tr>
        <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>

    </tr>
<tr>
    <td height="30" style="border-right:1px solid black;">&nbsp;</td>
    <td colspan="2" rowspan="5" style="padding:8px;font-size:12px;vertical-align:top;border-right: 1px solid black;">
        <b>NOTE :<br>
        1. Carbon content shall not exceed 0.23%<br>
        2. Carbon Equivalent shall not exceed 0.43%<br>
        3. Must comply with NACE MR0175<br>
        4. MPI required<br>
        5. Test Bar: 300 X 50 X 50mm Required -2nos</b>
    </td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b>&nbsp;</b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b>SGST @</b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b><?php echo $bil->sgst;?>%</b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b><?php echo $bil->sgstamount;?></b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b>&nbsp;</b></td>
</tr>
<tr>
    <td height="30" style="border-right:1px solid black;">&nbsp;</td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b>&nbsp;</b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b>CGST @</b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b><?php echo $bil->cgst;?>%</b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b><?php echo $bil->cgstamount;?></b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b>&nbsp;</b></td>
</tr>
<tr>
    <td height="30" style="border-right:1px solid black;">&nbsp;</td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b>&nbsp;</b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b>&nbsp;</b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b>Total</b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b><?php echo $bil->grandtotal;?></b></td>
    <td align="center" height="30" style="border-right: 1px solid black;padding:3px;font-size:12px;"><b>&nbsp;</b></td>
</tr>






</table>


<table width="750" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;height: 30px;" cellspacing="5">
    <tr>
        <td style="font-size:12px;padding:2px;">
            <!-- <p><?php echo $vob->requirements;?></p> -->
        </td>
    </tr>
</table>
<table width="750" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
  <?php if($vob->tctype == 1){?>
    <td rowspan="6" width="510"  valign="top" style="font-size:12px;border-right:1px solid black;"><b>&nbsp;&nbsp;TERMS AND CONDITIONS</b><br>&nbsp;&nbsp;1. Delivery 4 Weeks from the date of purchase order.<br>&nbsp;&nbsp;2. Casting should be free from surface defect like Crack, Porosity, Pinholes etc.<br>&nbsp;&nbsp;3. Identification and tracability should be embossed or punched the heat number, Grade etc. <br>&nbsp;&nbsp;4.  Testing certificate, Dimension report, NDT reports should submited along with dispatch. <br>&nbsp;&nbsp;5. Casting which is not upto the standard requirements it has to be rejected and replaced free of cost. <br>&nbsp;&nbsp;6. Payment Terms: 30days from the date of dispatch. <br>&nbsp;&nbsp;7.  Purchaser have rights to hold and cancel the purchase order any time if not meeting the requirments.  </td>
     <?php }else if($vob->tctype == 2){?>
       <td rowspan="6" width="510"  valign="top" style="font-size:12px;border-right:1px solid black;"><b>&nbsp;&nbsp;TERMS AND CONDITIONS</b><br>&nbsp;&nbsp;1. Delivery 2 weeks from the date of purchase order.<br>&nbsp;&nbsp;2. 3d model, Dimension report, report should submited along with dispatch.<br>&nbsp;&nbsp;3. Delivery your scope. <br>&nbsp;&nbsp;4.  Payment Terms : 45days from the date of dispatch. <br>&nbsp;&nbsp;5. Purchaser have rights to hold and cancel the purchase order any time if not meeting the requirements.  </td>
     <?php }else if($vob->tctype == 3){?>
       <td rowspan="6" width="510"  valign="top" style="font-size:12px;border-right:1px solid black;"><b>&nbsp;&nbsp;TERMS AND CONDITIONS</b><br>&nbsp;&nbsp;1. All inspection document should be signed with sealed .<br>&nbsp;&nbsp;2. Inspection should be carried as per the inspection call instruction.<br>&nbsp;&nbsp;3.Should not share the drgs and credentials to others. <br>&nbsp;&nbsp;4.  Payment Terms : 30days from the date of invoice <br>&nbsp;&nbsp;5. Purchaser have rights to hold and cancel the purchase order any time if not meeting the requirements.  </td>
     <?php } else {?>
      <td rowspan="6" width="510"  valign="top" style="font-size:12px;border-right:1px solid black;"><b>&nbsp;&nbsp;TERMS AND CONDITIONS</b><br>&nbsp;&nbsp;1. Delivery 4 Weeks from the date of purchase order.<br>&nbsp;&nbsp;2. Casting should be free from surface defect like Crack, Porosity, Pinholes etc.<br>&nbsp;&nbsp;3. Identification and tracability should be embossed or punched the heat number, Grade etc. <br>&nbsp;&nbsp;4.  Testing certificate, Dimension report, NDT reports should submited along with dispatch. <br>&nbsp;&nbsp;5. Casting which is not upto the standard requirements it has to be rejected and replaced free of cost. <br>&nbsp;&nbsp;6. Payment Terms: 30days from the date of dispatch. <br>&nbsp;&nbsp;7.  Purchaser have rights to hold and cancel the purchase order any time if not meeting the requirments.  </td>
     <?php }?>
    </tr>
    
</table>


<table width="750" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
    <tr>
        <td  style="font-size:13px;border-right:1px solid black;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Regards,</b></td>
    </tr>
    <tr>
        <td  style="font-size:13px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b style="font-size:17px;font-family: 'Bgothm', sans-serif;">M/S <?php echo $profile->companyname; ?></b></td>
    </tr>
    <tr>
        <td width="170" height="85" style="font-size:14px;border-right:1px solid black;" valign="bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Authorised Signatory</b></td>
    </tr>
    
</table>
<script type="text/javascript" src="<?php echo base_url(); ?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    window.print();
</script>

<style type="text/css">
    table tr td {
        padding: 3px;
    }
</style>
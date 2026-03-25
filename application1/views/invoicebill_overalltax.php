<?php

foreach ($pre as $qr) {
    $invoice_data = $qr->signedqrcode;
    $this->load->helper('qr_code_helper');
    $qr_code_url = generate_qr_code($invoice_data);
}

?>

<?php $preference = $this->db->where('status', 1)->get('preference_settings')->row();

?>

<?php

foreach ($pre as $bil)
    $data = $this->db->get('profile')->result();
$datas = $this->db->order_by('id', 'desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage)
    foreach ($data as $profile)

?>

<link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">


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
</style>
<?php $page_width = 700; ?>
<table width="<?php echo $page_width; ?>" border="0" id="backButon" align="center">
    <tr>
        <td align="right" style="position:absolute;"><a -class="btn btn-success" href="<?php echo base_url() . 'invoice'; ?>">Go back to Add Invoice</a><?php if ($fromDirectBill == 0) { ?>&nbsp;<a -class="btn btn-primary" href="javascript:window.close();">Close</a> <?php } ?></td>
    </tr>
</table>
<?php
$copy[0] = 'Original';
$copy[1] = 'Duplicate ';
$copy[2] = 'Triplicate ';
//$copy[3]='Trip ';

for ($z = 0; $z < 3; $z++) { ?>
    <table width="<?php echo $page_width; ?>" border="0" style="" align="center">
        <tr>
            <td width="250" align="center" style="font-size:20px;font-weight:bold;"></td>
            <td width="250" align="center" style="font-size:20px;font-weight:bold;text-transform:uppercase">&nbsp;</td>
            <td width="250" align="right" style="font-size:15px;font-weight:bold;"><?php echo $copy[$z]; ?></td>
        </tr>
    </table>


    <table width="<?php echo $page_width; ?>" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
        <tr>
            <td width="80" style="border-right: 1px solid black;"><img src="<?php echo base_url(); ?>upload/<?php echo $profileimage->image; ?>" width="120" height="100" alt="logo" /></td>
            <td width="590" align="center" valign="center" style="font-size:12px;">
                <p style="font-size: 42px;color:#FF070B;font-family: 'Bgothm', sans-serif;margin-bottom: -13px;font-weight:600;"><?php echo $profile->companyname; ?></p>
                <p style="margin-top: 21px;margin-bottom: -5px;"><b><?php echo $profile->address1; ?>,</b></p>
                <p><b><?php echo $profile->address2; ?>, <?php echo $profile->city; ?> - <?php echo $profile->pincode; ?></b></p>
                <p style="margin-top:-7px;margin-bottom: -11px;"> Email id: <?php echo $profile->emailid; ?>, marketing@ckprimealloys.com</p>
                <p style="margin-top:15px;margin-bottom: -2px;"> Phone : <?php echo $profile->phoneno; ?>, <?php echo $profile->mobileno; ?></p>
            </td>
            <td width="20"></td>
        </tr>
    </table>

    <table width="<?php echo $page_width; ?>" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;border-bottom:1px solid black;" align="center">
        <tr>
            <td rowspan="4" width="400" align="right" valign="center" style="font-size:22px;font-weight:600;"> INVOICE</td>
        </tr>
        <tr>
            <td width="300" align="right" style="font-size:12px;">&nbsp;&nbsp;&nbsp;Invoice No&nbsp;:&nbsp;&nbsp;<?php echo $bil->invoiceno; ?></td>
        </tr>
        <tr>
            <td width="100" align="center" style="font-size:12px;padding-left: 53px;">&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php {
                                                                                                                        $a = $bil->invoicedate;
                                                                                                                        $d = date('d/m/Y', strtotime($a));
                                                                                                                        echo $d;
                                                                                                                    }; ?></td>
        </tr>
        <tr>
            <td width="300" align="right" style="font-size:12px;">&nbsp;GSTIN&nbsp;:&nbsp;&nbsp;<?php echo @$profile->gstin; ?></td>
        </tr>

    </table>


    <?php

    $shipToadd1 = '';
    $shipToadd2 = '';
    $shipTocity = '';
    $shipTostate = '';
    $shipgstno = '';
    $shipTomobileno = '';
    $shipTopincode = '';
    $shipTostatecode = '';

    $addresss1 = "";
    $addresss2 = "";
    $citys = "";
    $states = "";
    $gstnos = "";
    $mobileno = "";
    $pincode = "";
    $statecode = "";

    $getcusname = $this->db->where('name', $bil->customername)->where('id', $bil->customerId)->get('customer_details')->result();

    foreach ($getcusname as $cus) {


        $addresss1 = $cus->address1;
        $addresss2 = $cus->address2;
        $citys = $cus->city;
        $states = $cus->state;
        $gstnos = $cus->gstno;
        $mobileno = $cus->phoneno;
        $pincode = $cus->pincode;
        $statecode = $cus->statecode;
        $contactperson = $cus->contactperson;
    }
    $discountBy = $bil->discountBy;
    ?>

    <?php

    $getshipTo = $this->db->where('name', $bil->customername)->where('id', $bil->customerId)->get('customer_details')->result();


    foreach ($getshipTo as $to) {


        $shipToadd1 = $to->address1;
        $shipToadd2 = $to->address2;
        $shipTocity = $to->city;
        $shipTostate = $to->state;
        $shipgstno = $to->gstno;
        $shipTomobileno = $to->phoneno;
        $shipTopincode = $to->pincode;
        $shipTostatecode = $cus->statecode;
    }
    foreach ($pre  as  $vob) {
        $pono = $vob->pono;
     
       $orderno = $vob->orderno;
        
    }
    if ($orderno == '') {
        @$orderno = $this->db->select('purchaseorder')->where('purchaseorderno', $pono)->get('purchaseorder_details')->row()->purchaseorder;
        @$orderdate = $this->db->select('invoicedate')->where('purchaseorderno', $pono)->get('purchaseorder_details')->row()->invoicedate;
    } else {
        $orderno = $bil->orderno;
        $orderdate = $bil->orderdate;
    }

    ?>

    <?php if ($preference->einvoice == 1) { ?>
        <table width="<?php echo $page_width; ?>" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="1">
            <tr>
                <td style="font-size:12px;border-bottom:1px solid black">
                    <p> IRN No:<b><?php echo $pre[0]->irn; ?></b></p>
                </td>
            </tr>
        </table>

    <?php } ?>

    <table width="<?php echo $page_width; ?>" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;border-bottom:1px solid black;" align="center" cellpadding="1">
        <tr>
            <td width="350" style="border-right:1px solid black;font-size:12px;"><b>Billing Address</b></td>
            <td width="350" style="font-size:12px;"><b>Shipping Address</b></td>
        </tr>
    </table>

    <table width="<?php echo $page_width; ?>" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="1">
        <tr>
            <td width="350" style="border-right:1px solid black; font-size:12px;">
                <div style="padding-left:15px;padding-top: 3px;"><?php echo $bil->customername; ?>,</div>
                <div style="padding-left:15px;padding-top: 3px;"><?php echo @$addresss1; ?>,</div>
                <div style="padding-left:15px;padding-top: 3px;"><?php echo @$addresss2; ?></div>
                <div style="padding-left:15px;padding-top: 3px;"><?php echo @$citys; ?> - <?php echo @$pincode; ?>,</div>
                <div style="padding-left:15px;padding-top: 3px;">GSTIN: <?php echo @$gstnos; ?></div>
                <div style="padding-left:15px;padding-top: 3px;">Contact : <?php echo $contactperson;?> , Ph.No: <?php echo @$mobileno; ?></div>
            </td>

            <td width="350" style="font-size:12px;">
                <div style="padding-left:15px;padding-top: 3px;"><?php echo $bil->customername; ?>,</div>
                <div style="padding-left:15px;padding-top: 3px;"><?php echo @$addresss1; ?>,</div>
                <div style="padding-left:15px;padding-top: 3px;"><?php echo @$addresss2; ?></div>
                <div style="padding-left:15px;padding-top: 3px;"><?php echo @$citys; ?> - <?php echo @$pincode; ?>,</div>
                <div style="padding-left:15px;padding-top: 3px;">GSTIN: <?php echo @$gstnos; ?></div>
                <div style="padding-left:15px;padding-top: 3px;">Contact : <?php echo $contactperson;?>, Ph.No: <?php echo @$mobileno; ?></div>
            </td>

        </tr>
    </table>



    <?php
    $discountss = explode('||', $bil->discount);
    $diccount = array_sum($discountss);
    $itemwidth = 208;
    if ($diccount <= 0) {
        $itemwidth = 95 + $itemwidth;
    }
    if ($bil->gsttype == 'intrastate') {
        $itemwidth = 94 + $itemwidth;
        $tot_width = 440;
    }
    if ($bil->gsttype == 'interstate') {
        $itemwidth = 91 + $itemwidth;
        $tot_width = 470;
    }
    ?>
    <!-- <?php //echo $tot_width;
            ?> -->

    <table width="<?php echo $page_width; ?>" height="370" align="center" style="border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
        <tr style="font-size: 13px;">
            <td height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;"><b>S.No</b></td>
            <!-- <td width="<?php echo $itemwidth; ?>" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Description</strong></td> -->
            <td width="250" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Description</strong></td>
            <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>HSN</b></td>
            <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Grade</strong></td>
            <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Qty Nos</b></td>
            <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Weight in Kg</b></td>
            <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Rate/<br>Kg</b></td>
            <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Value</b></td>
            <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Remarks</b></td>

        </tr>
        <?php
        $j = 0;
        foreach ($pre  as  $vob) {

            // echo"<pre>";
            // print_r($vob);
            // exit;

            $itemname = explode('||', $vob->itemname);
            $item_desc = explode('||', $vob->item_desc);
            $rate = explode('||', $vob->rate);
            $qty = explode('||', $vob->qty);
            $amount = explode('||', $vob->amount);
            $uom = explode('||', $vob->uom);
            $discounts = explode('||', $vob->discount);
            $disamounts = explode('||', $vob->discountamount);
            $taxableamt = explode('||', $vob->taxableamount);
            $hsnno = explode('||', $vob->hsnno);
            $grade = explode('||', $vob->grade);
            $weight = explode('||', $vob->weight);
            $remarks = explode('||', $vob->remarks);
            $itemcode = explode('||', $vob->itemcode);
            $totalqty = $vob->totalqty;
            $dcnos = explode('||', $vob->dcnos);
            $deliveryid = explode('||', $vob->deliveryid);

            $subtotal = $vob->subtotal;
            $count = count($itemname);
            for ($i = 0; $i < $count; $i++) {


                if ($discounts[$i] == 0 || $discounts[$i] == '') {
                    $discount = 0;
                } else {
                    $discount = $discounts[$i];
                }

                if (@$disamounts[$i] == 0 || @$disamounts[$i] == '') {
                    @$disamount = 0;
                } else {
                    $disamount = $disamounts[$i];
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

                if (@$deliveryid[$i] == '') {
                    $dc_details = '';
                } else {
                    @$dcno = $this->db->select('customerdcno')->where('id', $deliveryid[$i])->get('dc_delivery')->row()->customerdcno;
                    // @$dcno=$bil->dcno;
                    @$dcdates = $this->db->select('customerdcdate')->where('id', $deliveryid[$i])->get('dc_delivery')->row()->customerdcdate;
                    @$dc_details = '&nbsp;&nbsp;<span align="center" style="font-size:12px;"> Dcno: ' . $dcno . ' Dt: ' . date('d-m-y', strtotime($dcdates)) . '</span>';
                }
                if (@$item_desc[$i] != '') {
                    $descDet = '<span style="font-size:12px;">&nbsp;(' . $item_desc[$i] . ')</span>';
                } else {
                    $descDet = '';
                }


                $dis[] = $disamount;
                //$over[]=$overalltotal[$i];
                $taxam[] = $taxableamt[$i];
                $qtyh[] = $qty[$i];
                //$totalh[]=$total[$i];
                // $sgsth[]=$sgstamt;
                // $igsth[]=$igstamt;
                // $cgsth[]=$cgstamt;
                $totamt[] = $amount[$i];
                $bottomTot = array_sum($totamt);
                // $grandTotCgsth = array_sum($cgsth);
                // $grandTotSgsth = array_sum($sgsth);
                // $grandTotIgsth = array_sum($igsth);
                $tqty = array_sum($qtyh);


                if ($qty[$i] > 0) {
                    $j = $j + 1;
                    $gradeid = $this->db->where('id', $grade[$i])->get('grade')->row();
                    $gd =  $gradeid->grade ?? '';

                    ?>

                    <tr style="height:1px;">
                        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $j; ?></td>
                        <td align="left" style="border-right:1px solid black;padding:3px;font-size:12px;text-transform: capitalize;"><?php if($bil->orderdate!=''){?>
                        Customer Po Ref:<br><?php echo $orderno;?> <?php echo date('d-m-Y',strtotime($orderdate));?>
                        <?php }?>
                        
                        <br><?php echo htmlspecialchars($itemname[$i]); ?><br>
                        <?php if($grade[$i]!= 6){?>
                        <?php echo $dc_details . $descDet; ?>
                        <?php }else{?>
                           
                            
                        <?php }?>
                        
                        
                        </td>
                        <td align="left" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $hsnno[$i]; ?></td>
                        <?php if($grade[$i]!= 6){?>
                        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $gd ?? ''; ?></td>
                        <?php }else{?>
                         <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;">-</td>
                        <?php }?>
                        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $qty[$i]; ?></td>
                        
                        <?php if($grade[$i]!= 6){?>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;text-transform: capitalize;"><?php echo number_format((float)$weight[$i], 2, '.', ''); ?></td>
                        <?php }else{?>
                                                <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;text-transform: capitalize;">-</td>
                        <?php }?>
                        
                        <?php if($grade[$i]!= 6){?>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;"><?php echo number_format((float)$rate[$i], 2, '.', ''); ?></strong></td>
                        <?php }else{?>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;">-</strong></td>
                        <?php }?>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;"><?php echo $amount[$i]; ?></strong></td>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;"><?php echo $remarks[$i] ?? ''; ?></strong></td>


                    </tr>
        <?php }
            }
        } ?>
        <?php //if($count < 5) { 
        ?>

        <tr>
            <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
            <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
            <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
            <td align="center" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
            <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
            <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
            <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
            <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
            <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
        </tr>
        
        

        <tfoot>


        </tfoot>
    </table>

    <table width="<?php echo $page_width ?>" border="0" align="center" style="border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">

        <?php
        if ($bil->gsttype == 'intrastate') {
            $taxcgst = $bil->cgstamount;
            $taxsgst = $bil->sgstamount;
            @$taxAmt = @$taxcgst + @$taxsgst;
        }
        if ($bil->gsttype == 'interstate') {
            $taxigst = $bil->igstamount;
            $taxAmt = $taxigst;
        }
        ?>


        <tr>
            <td colspan="3" valign="top" style="font-size:12px;font-weight:bold; border-right: 1px solid black;">Grand Total in words<br><span style="font-size:12px;">Rupees :<b style="font-size:12px;"><?php echo $fin; ?> only</span></td>

            <td width="155" align="right" style=""><span style="font-size:12px;">Sub Total&nbsp;&nbsp;:</span></td>
            <td width="90" align="right" style="font-size:12px;">&nbsp;<?php echo number_format($subtotal, 2); ?></td>
        </tr>
        <tr style="margin-top:10px !important;">
            <td colspan="3" style="border-right: 1px solid #000;font-size:12px;"><b>&nbsp;&nbsp;<u>Bank Details</b></u></td>
            <td align="right" style="margin-top:10px !important;"><span style="font-size:12px;">Frieght Charges&nbsp;&nbsp;:</span></td>
            <td align="right" style="font-size:12px;"><?php echo  number_format((float)$bil->freightamount, 2); ?></td>
        </tr>
        <tr>
            <td colspan="3" style="border-right: 1px solid #000;font-size:12px;">&nbsp;&nbsp;Bank Name &nbsp;: <?php echo $profile->bankname; ?></td>
            <td align="right" style=""><span style="font-size:12px;">P & F Charges&nbsp;&nbsp;:</span></td>
            <td align="right" style="font-size:12px;"><?php echo  number_format((float)$bil->loadingamount, 2); ?></td>
        </tr>

        <tr>
            <td colspan="3" style="border-right: 1px solid #000;font-size:12px;">&nbsp;&nbsp;Branch &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $profile->bankbranch; ?> </td>

            <td align="right" style=""><span style="font-size:12px;">Round Off&nbsp;&nbsp;:</span></td>
            <td align="right" style="font-size:12px;"><?php echo  number_format($bil->roundOff, 2); ?></td>
        </tr>

        <tr>
            <td colspan="3" style="border-right: 1px solid #000;font-size:12px;">&nbsp;&nbsp;Account No &nbsp;: <?php echo $profile->accountno; ?></td>
            <?php if ($bil->gsttype == 'intrastate') { ?>

                <td align="right" style=""><span style="font-size:12px;">&nbsp;&nbsp;CGST&nbsp;&nbsp;<?php echo $bil->cgst; ?>%:</span></td>
                <td align="right" style="font-size:12px;"><?php echo number_format((float)$bil->cgstamount, 2); ?></td>
        </tr>

        <tr>
            <td colspan="3" style="border-right: 1px solid #000;font-size:12px;">&nbsp;&nbsp;IFSC Code &nbsp;&nbsp;: <?php echo $profile->ifsccode; ?></td>
            <td align="right" style=""><span style="font-size:12px;">&nbsp;&nbsp;SGST&nbsp;&nbsp;<?php echo $bil->sgst; ?>%:</span></td>

            <td align="right" style="font-size:12px;"><?php echo number_format((float)$bil->sgstamount, 2); ?></td>
        <?php }
            if ($bil->gsttype == 'interstate') {
        ?>
        </tr>

        <tr>
            <td colspan="3" style="border-right: 1px solid #000;font-size:12px;">&nbsp;&nbsp;IFSC Code &nbsp;&nbsp;: <b><?php echo $profile->ifsccode; ?></b></td>
            <td align="right" style=""><span style="font-size:12px;">&nbsp;&nbsp;IGST&nbsp;&nbsp;@<?php echo $bil->igst; ?>%:</span></td>
            <td align="right" style="font-size:12px;"><?php echo  number_format($bil->igstamount, 2); ?></td>
        <?php } ?>
        </tr>

        <tr>
            <td colspan="3" style="border-bottom: 1px solid #000;border-right: 1px solid #000;font-size:12px;"></td>
            <td align="right" style="border-bottom: 1px solid black;"><span style="font-size:12px;">Grand Total &nbsp;&nbsp;:</span></td>
            <td align="right" style="border-bottom: 1px solid black;font-size:12px;" ><?php echo number_format(round($bil->grandtotal), 2); ?></td>

        </tr>

        <!--<tr>
    <td colspan="3">&nbsp;&nbsp;IFSC Code &nbsp;&nbsp;: <b><?php echo $profile->ifsccode; ?></b></td>

</tr>-->

    </table>


    <table width="<?php echo $page_width; ?>" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">

        <tr>
            <td width="495" style="font-size:12px;border-right:1px solid black; ">
                TERMS AND CONDITIONS &nbsp;&nbsp;:&nbsp; <br></td>

            <td width="280" style="font-size:14px;border-right:1px solid black;font-family: 'Bgothm', sans-serif;font-weight:900;" align="right">For <b style="font-size:18px;"><?php echo $profile->companyname; ?></b></td>
        </tr>
        <td width="180" height="5" valign="top" style="font-size:12px;border-right:1px solid black;"><span style="font-size:12px;">1.No Claim For breakage or Loss during transit.<br>2.All disputes subject to Coimbatore Jurisdiction only.<br>3.Our Responsibility Ceases after the goods have been delivered to carriers.</span></td>

        <td width="280" style="font-size:12px;border-right:1px solid black;" align="right" valign="bottom"><b>Authorised Signatory</b></td>
        </tr>
    </table>
    <br>
<?php
    unset($totamt);
    unset($cgsth);
    unset($sgsth);
    unset($igsth);
} ?>
<script type="text/javascript" src="<?php echo base_url(); ?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    window.print();
</script>

<style type="text/css">
    table tr td {
        padding: 3px;
    }
</style>

<?php
if ($bil->gsttype == 'interstate') {
?>
    <br>
<?php } ?>
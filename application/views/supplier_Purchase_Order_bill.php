<?php
// Get data from controller
$pre = $pre; // Purchase order data
$profile = $profile[0] ?? null; // Company profile
$preference = $preference ?? null; // Preference settings
$page_width = 700;

// Get company logo
$datas = $this->db->order_by('id', 'desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage) {
    $company_logo = $profileimage;
}

// Get first purchase order item
$bil = $pre[0] ?? null;
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
    
    table tr td {
        padding: 3px;
    }
</style>

<table width="<?php echo $page_width; ?>" border="0" id="backButon" align="center">
    <tr>
        <td align="right" style="position:absolute;">
            <a class="btn btn-success" href="<?php echo base_url() . 'invoice'; ?>">Go back to Add Invoice</a>
        </td>
    </tr>
</table>
<br>
<br>
<table width="<?php echo $page_width; ?>" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
    <tr>
        <td width="80" style="border-right: 1px solid black;">
            <img src="<?php echo base_url(); ?>upload/<?php echo $company_logo->image; ?>" width="120" height="100" alt="logo" />
        </td>
        <td width="590" align="center" valign="center" style="font-size:12px;">
            <p style="font-size: 42px;color:#FF070B;font-family: 'Bgothm', sans-serif;margin-bottom: -13px;font-weight:600;">
                <?php echo $profile->companyname; ?>
            </p>
            <p style="margin-top: 21px;margin-bottom: -5px;">
                <b><?php echo $profile->address1; ?>,</b>
            </p>
            <p>
                <b><?php echo $profile->address2; ?>, <?php echo $profile->city; ?> - <?php echo $profile->pincode; ?></b>
            </p>
            <p style="margin-top:-7px;margin-bottom: -11px;">
                Email id: <?php echo $profile->emailid; ?>&nbsp; Phone : <?php echo $profile->phoneno; ?>, <?php echo $profile->mobileno; ?>
            </p>
            <br>
        </td>
        <td width="20"></td>
    </tr>
</table>

<table width="<?php echo $page_width; ?>" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="center" valign="center" style="font-size:14px;font-weight:600;">
            PURCHASE ORDER
        </td>
    </tr>
    <tr>
        <td align="right" style="font-size:11px;">
            &nbsp;&nbsp;&nbsp;GSTIN&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $profile->gstin; ?>
        </td>
    </tr>
</table>

<?php if($bil): 
    // Get customer details
    $customer = $this->db
                         ->where('id', $bil->supplierid)
                         ->get('customer_details')
                         ->row();
                         
    $getworkorderno = $this->db->where('purchaseorder',$bil->purchaseorder)->get('sup_purchaseorder_details')->row();
?>

<?php if($preference && $preference->einvoice == 1 && isset($pre[0]->irn)): ?>
<table width="<?php echo $page_width; ?>" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="1">
    <tr>
        <td style="font-size:14px;border-bottom:1px solid black">
            <p>IRN No:<b><?php echo $pre[0]->irn; ?></b></p>
        </td>
    </tr>
</table>
<?php endif; ?>

<table width="<?php echo $page_width; ?>" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="1">
    <tr>
        <td width="240" align="top" valign="top" style="border-right:1px solid black; font-size:12px;">
            <div style="padding-left:10px;padding-top: 10px;font-size:14px;"><b>Supplier Details</b></div>
            <div style="padding-left:15px;padding-top: 5px;"><?php echo $bil->suppliername; ?>,</div>
            <div style="padding-left:15px;padding-top: 5px;"><?php echo $customer->address1 ?? ''; ?>,</div>
            <div style="padding-left:15px;padding-top: 5px;"><?php echo $customer->address2 ?? ''; ?></div>
            <div style="padding-left:15px;padding-top: 5px;"><?php echo $customer->city ?? ''; ?> - <?php echo $customer->pincode ?? ''; ?>,</div>
            <div style="padding-left:15px;padding-top: 5px;">GSTIN: <?php echo $customer->gstno ?? ''; ?></div>
            <div style="padding-left:15px;padding-top: 5px;">Contact : Murugan,</div>
            <div style="padding-left:15px;padding-top: 5px;">Ph.No: <?php echo $customer->phoneno ?? ''; ?></div>
        </td>

        <td width="240" align="top" valign="top" style="font-size:12px;border-right:1px solid black;">
            <div style="padding-left:10px;padding-top: 5px;font-size:14px;"><b>Billing Address</b></div>
            <div style="padding-left:15px;padding-top: 10px;"><?php echo $bil->suppliername; ?>,</div>
            <div style="padding-left:15px;padding-top: 5px;"><?php echo $customer->address1 ?? ''; ?>,</div>
            <div style="padding-left:15px;padding-top: 5px;"><?php echo $customer->address2 ?? ''; ?></div>
            <div style="padding-left:15px;padding-top: 5px;"><?php echo $customer->city ?? ''; ?> - <?php echo $customer->pincode ?? ''; ?>,</div>
            <div style="padding-left:15px;padding-top: 5px;">GSTIN: <?php echo $customer->gstno ?? ''; ?></div>
            <div style="padding-left:15px;padding-top: 5px;">Contact : Murugan,</div>
            <div style="padding-left:15px;padding-top: 5px;">Ph.No: <?php echo $customer->phoneno ?? ''; ?></div>
        </td>
        
        <td width="220" align="top" valign="top" style="font-size:11px;">
            <div style="padding-left:10px;padding-top: 10px;">PO.NO: <b><?php echo $bil->purchaseorderno; ?></b></div>
            <div style="padding-left:10px;padding-top: 5px;">Date: <b><?php echo $bil->purchasedate; ?></b></div>
            <div style="padding-left:10px;padding-top: 5px;">Customer PO Ref: <b><?php echo $getworkorderno->purchaseorder;?></b></div>
            <div style="padding-left:10px;padding-top: 5px;">Date:<?php echo date('d-m-Y',strtotime($getworkorderno->invoicedate));?> <b></b></div>
            <div style="padding-left:10px;padding-top: 5px;">Vendor Quotation Ref: <b></b></div>
            <div style="padding-left:10px;padding-top: 5px;">Date: <b></b></div>
        </td>
    </tr>
</table>

<?php
// Initialize totals
$total_qty = 0;
$total_weight = 0;
$totalweights = 0;
$total_value = 0;
$item_count = 0;
?>

<table width="<?php echo $page_width; ?>" align="center" style="border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
    <tr style="font-size: 13px;">
        <td height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;"><b>S.No</b></td>
        <td width="200" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Description</strong></td>
        <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Grade</strong></td>
        <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Qty Nos</b></td>
        <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Weight in Kg</b></td>
        <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Rate/Kg</b></td>
        <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Value</b></td>
        <td style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Remarks</b></td>
    </tr>
    
    <?php
    $j = 0;
    foreach($pre as $vob):
        $itemname = explode('||', $vob->itemname);
        $item_desc = explode('||', $vob->item_desc);
        $rate = explode('||', $vob->rate);
        $qty = explode('||', $vob->qty);
        $amount = explode('||', $vob->amount);
        $grade = explode('||', $vob->grade);
        $weight = explode('||', $vob->weight);
        $remarks = explode('||', $vob->remarks);
        
        $count = count($itemname);
        
        for($i = 0; $i < $count; $i++):
            if($qty[$i] > 0):
                $j++;
                $total_qty += $qty[$i];
                $total_weight = $qty[$i] * $weight[$i];
                $totalweights +=$total_weight;
                
                $total_value += $amount[$i];
                $item_count++;
                
                // Get grade name
                $grade_data = $this->db->where('id', $grade[$i])->get('grade')->row();
                $grade_name = $grade_data->grade ?? '';
                
                // Description with item details if exists
                $description = $itemname[$i];
                if(!empty($item_desc[$i])) {
                    $description .= '<span style="font-size:12px;">&nbsp;(' . $item_desc[$i] . ')</span>';
                }
    ?>
    
    <tr style="height:1px;">
        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $j; ?></td>
        <td align="left" style="border-right:1px solid black;padding:3px;font-size:13px;text-transform: capitalize;">
            <?php echo $description; ?>
        </td>
        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:14px;">
            <?php echo $grade_name; ?>
        </td>
        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:13px;">
            <?php echo $qty[$i]; ?>
        </td>
        <td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;text-transform: capitalize;">
            <?php echo $weight[$i]; ?>
        </td>
        <td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;">
            <?php echo number_format($rate[$i], 2); ?>
        </td>
        <td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;">
            <?php echo number_format($amount[$i], 2); ?>
        </td>
        <td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;">
            <?php echo $remarks[$i] ?? ''; ?>
        </td>
    </tr>
    
    <?php
            endif;
        endfor;
    endforeach;
    
    // Add empty rows if less than minimum items
    for($k = $item_count; $k < 5; $k++):
    ?>
    <tr style="height:1px;">
        <td style="border-right:1px solid black;padding:3px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td style="border-right:1px solid black;padding:3px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="center" style="border-right:1px solid black;padding:3px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td style="border-right:1px solid black;padding:3px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:3px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:3px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:3px;font-size:18px;font-weight:bold;">&nbsp;</td>
        <td align="right" style="border-right:1px solid black;padding:3px;font-size:18px;font-weight:bold;">&nbsp;</td>
    </tr>
    <?php endfor; ?>
    
    <!-- Total Row -->
    <tr style="height:1px;">
        <td colspan="2" align="right" style="border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;border-top: 1px solid black;">
            Total
        </td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;border-top: 1px solid black;">
            &nbsp;
        </td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;border-top: 1px solid black;">
            <?php echo $total_qty; ?>
        </td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;border-top: 1px solid black;">
            <?php echo number_format($totalweights, 2); ?>
        </td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;border-top: 1px solid black;">
            &nbsp;
        </td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;border-top: 1px solid black;">
            <?php echo number_format($total_value, 2); ?>
        </td>
        <td align="right" style="border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;border-top: 1px solid black;">
            &nbsp;
        </td>
    </tr>
</table>

<?php
// Calculate taxes based on GST type
$taxable_amount = $total_value;
$gst_type = $bil->gsttype ?? 'intrastate'; // Default to intrastate

if ($gst_type == 'intrastate') {
    // Intrastate - CGST & SGST
    $sgst_percent = $bil->sgst ?? 9;
    $cgst_percent = $bil->cgst ?? 9;
    $sgst_amount = ((float)$taxable_amount * (float)$sgst_percent) / 100;
    $cgst_amount = ((float)$taxable_amount * (float)$cgst_percent) / 100;
    $tax_amount = (float)$sgst_amount + (float)$cgst_amount;
    $igst_amount = 0;
} else {
    // Interstate - IGST
    $igst_percent = $bil->igst ?? 18;
    $igst_amount = ((float)$taxable_amount * (float)$igst_percent) / 100;
    $sgst_amount = 0;
    $cgst_amount = 0;
    $tax_amount = $igst_amount;
}

$grand_total = $taxable_amount + $tax_amount;
$rounded_total = round($grand_total);
$round_off = $rounded_total - $grand_total;
?>

<table width="<?php echo $page_width; ?>" border="0" align="center" style="border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;border-bottom:1px solid black;">
    <tr>
        <td align="right" width="600" valign="top" style="font-size:12px;">
            <div style="padding-left:10px;padding-top: 10px;">Sub Total:</div>
            
            <?php if ($gst_type == 'intrastate'): ?>
                <div style="padding-left:15px;padding-top: 5px;">SGST <?php echo $sgst_percent; ?>%:</div>
                <div style="padding-left:15px;padding-top: 5px;">CGST <?php echo $cgst_percent; ?>%:</div>
            <?php else: ?>
                <div style="padding-left:15px;padding-top: 5px;">IGST <?php echo $igst_percent; ?>%:</div>
                <div style="padding-left:15px;padding-top: 5px;">&nbsp;</div> <!-- Empty row for alignment -->
            <?php endif; ?>
            
            <div style="padding-left:15px;padding-top: 5px;">Round Off:</div>
            <div style="padding-left:15px;padding-top: 5px;">Grand Total:</div>
        </td>
        
        <td align="right" valign="top" style="border-right:1px solid black; font-size:12px;">
            <div style="padding-left:10px;padding-top: 10px;"><b><?php echo number_format($taxable_amount, 2); ?></b></div>
            
            <?php if ($gst_type == 'intrastate'): ?>
                <div style="padding-left:15px;padding-top: 5px;"><b><?php echo number_format($sgst_amount, 2); ?></b></div>
                <div style="padding-left:15px;padding-top: 5px;"><b><?php echo number_format($cgst_amount, 2); ?></b></div>
            <?php else: ?>
                <div style="padding-left:15px;padding-top: 5px;"><b><?php echo number_format($igst_amount, 2); ?></b></div>
                <div style="padding-left:15px;padding-top: 5px;"><b>&nbsp;</b></div> <!-- Empty row for alignment -->
            <?php endif; ?>
            
            <div style="padding-left:15px;padding-top: 5px;"><b><?php echo number_format($round_off, 2); ?></b></div>
            <div style="padding-left:15px;padding-top: 5px;"><b><?php echo number_format($rounded_total, 2); ?></b></div>
        </td>
    </tr>
</table>

<table width="<?php echo $page_width; ?>" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
    <tr>
        <td width="600" style="font-size:13px;border-right:1px solid black;font-weight:600;">
            TERMS AND CONDITIONS &nbsp;&nbsp;:&nbsp; <br>
        </td>
        <td width="280" style="font-size:13px;border-right:1px solid black;font-family: 'Bgothm', sans-serif;font-weight: 600;" align="right">
            <span style="font-family: 'verdana', sans-serif;font-size:14px;font-weight: 600;">Regards,</span><br>
            M/s <b style="font-size:14px;"><?php echo $profile->companyname; ?></b>
        </td>
    </tr>
    <tr>
        <td width="420" valign="top" style="font-size:13px;border-right:1px solid black;">
            <span style="font-size:11px;">
                1. Delivery as per purchase order schedule.<br>
                2. Casting should be free from surface defect like Crack, Porosity, Pinholes etc.<br>
                3. Identification and tracability should be embossed or punched the heat number, Grade etc.<br>
                4. Testing certificate, Dimension report, NDT reports should submitted along with dispatch.<br>
                5. Casting which is not upto the standard requirements it has to be rejected and replaced free of cost.<br>
                6. Payment Terms: 45 days from the date of dispatch.<br>
                7. Purchaser have rights to hold and cancel the purchase order any time if not meeting the requirements.
            </span>
        </td>
        <td width="280" style="font-size:14px;border-right:1px solid black;" align="right" valign="bottom">
            <b>Authorised Signatory</b>
        </td>
    </tr>
</table>
<br>

<?php endif; ?>

<script type="text/javascript" src="<?php echo base_url(); ?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    window.print();
</script>
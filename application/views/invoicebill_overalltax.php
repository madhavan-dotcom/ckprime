<?php
error_reporting(0);

/* ================= BASIC DATA ================= */
foreach ($pre as $bil) {
}

$profile = $this->db->get('profile')->row();
$profileimage = $this->db->order_by('id', 'desc')->limit(1)->get('company_logo')->row();
$customer = $this->db->where('id', $bil->customerId)->get('customer_details')->row();

$page_width = 700;
$ROWS_PER_PAGE = 5; // Items per page

/* ================= BUILD ITEM LIST ================= */
$items = [];
$totalTaxableAmount = 0;
$totalDiscount = 0;

foreach ($pre as $vob) {
    $itemname = explode('||', $vob->itemname);
    $item_desc = explode('||', $vob->item_desc);
    $rate = explode('||', $vob->rate);
    $qty = explode('||', $vob->qty);
    $uom = explode('||', $vob->uom);
    $hsnno = explode('||', $vob->hsnno);
    $itemcode = explode('||', $vob->itemcode);
    $taxableamt = explode('||', $vob->taxableamount);
    $discounts = explode('||', $vob->discount);
    $grade = explode('||', $vob->grade);
    $weight = explode('||', $vob->weight);
    $remarks = explode('||', $vob->remarks);
    $deliveryid = explode('||', $vob->deliveryid);

    for ($i = 0; $i < count($itemname); $i++) {
        if ($qty[$i] <= 0) continue;

        // Get grade name
        $gradeid = $this->db->where('id', $grade[$i])->get('grade')->row();
        $gd = $gradeid->grade ?? '';

        // Get DC details if exists
        $dc_details = '';
        if (!empty($deliveryid[$i])) {
            $dcno = $this->db->select('customerdcno')->where('id', $deliveryid[$i])->get('dc_delivery')->row()->customerdcno ?? '';
            $dcdates = $this->db->select('customerdcdate')->where('id', $deliveryid[$i])->get('dc_delivery')->row()->customerdcdate ?? '';
            if ($dcno && $dcdates) {
                $dc_details = 'Dcno: ' . $dcno . ' Dt: ' . date('d-m-y', strtotime($dcdates));
            }
        }

        $descDet = !empty($item_desc[$i]) ? '(' . $item_desc[$i] . ')' : '';

        $items[] = [
            'itemname' => $itemname[$i],
            'item_desc' => $descDet,
            'hsnno' => $hsnno[$i],
            'grade' => $gd,
            'grade_id' => $grade[$i],
            'qty' => $qty[$i],
            'weight' => $weight[$i] ?? 0,
            'rate' => $rate[$i],
            'amount' => $taxableamt[$i] ?? ($qty[$i] * $rate[$i]),
            'remarks' => $remarks[$i] ?? '',
            'dc_details' => $dc_details,
            'orderno' => $vob->orderno ?? '',
            'orderdate' => $vob->orderdate ?? ''
        ];
    }
}

// Calculate totals
$subtotal = $bil->subtotal ?? 0;
$freightCharges = $bil->freightamount ?? 0;
$loadingCharges = $bil->loadingamount ?? 0;
$roundOff = $bil->roundOff ?? 0;

// Calculate GST
$cgstAmount = $bil->cgstamount ?? 0;
$sgstAmount = $bil->sgstamount ?? 0;
$igstAmount = $bil->igstamount ?? 0;
$totalGST = (float)$cgstAmount + (float)$sgstAmount + (float)$igstAmount;

// Grand total
$grandTotal = $bil->grandtotal ?? ($subtotal + $freightCharges + $loadingCharges + $totalGST + $roundOff);

// Number to words function
function numberToWords($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        0 => '',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety'
    );

    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');

    while ($i < $digits_length) {
        $divider = ($i == 2) ? 5 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 5 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred :
                $words[floor($number / 5) * 5] . ' ' . $words[$number % 5] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else $str[] = null;
    }

    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? " and " . ($words[$decimal / 5] . " " . $words[$decimal % 5]) . ' Paise' : '';

    $result = trim($Rupees) . $paise;
    if (empty($result)) {
        $result = 'Zero';
    }

    return ucfirst($result) . ' Only';
}

$amountInWords = numberToWords(round($grandTotal));

/* ================= SPLIT INTO PAGES ================= */
$pages = array_chunk($items, $ROWS_PER_PAGE);
$totalPages = count($pages);
$copies = ['Original', 'Duplicate', 'Triplicate'];

// Get customer details
$addresss1 = $addresss2 = $citys = $states = $gstnos = $mobileno = $pincode = $statecode = $contactperson = '';
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

// Get order details
$orderno = $orderdate = '';
foreach ($pre as $vob) {
    $pono = $vob->pono;
    $orderno = $vob->orderno;
}
if (empty($orderno) && !empty($pono)) {
    $orderData = $this->db->select('purchaseorder, invoicedate')->where('purchaseorderno', $pono)->get('purchaseorder_details')->row();
    $orderno = $orderData->purchaseorder ?? '';
    $orderdate = $orderData->invoicedate ?? '';
} else {
    $orderno = $bil->orderno ?? '';
    $orderdate = $bil->orderdate ?? '';
}

$preference = $this->db->where('status', 1)->get('preference_settings')->row();
$fin = $amountInWords;
?>

<!-- Styles -->
<link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">

<style>
    @media print {
        #backButon {
            visibility: hidden;
        }
        thead {
            display: table-header-group;
        }
        tfoot {
            display: table-footer-group;
        }
        tbody tr {
            page-break-inside: avoid;
        }
        tr {
            page-break-inside: avoid;
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
        cursor: pointer;
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

    td, th {
        font-family: 'verdana', sans-serif;
    }
    
    .invoice-table td, .invoice-table th {
        padding: 5px;
        vertical-align: top;
    }
</style>

<!-- Back Button -->
<table width="<?php echo $page_width; ?>" border="0" id="backButon" align="center">
    <tr>
        <td align="right" style="position:absolute;">
            <a class="btn btn-success" href="<?php echo base_url() . 'invoice'; ?>">Go back to Add Invoice</a>
            <?php if ($fromDirectBill == 0) { ?>
                &nbsp;<a class="btn btn-primary" href="javascript:window.close();">Close</a>
            <?php } ?>
        </td>
    </tr>
</table>

<?php
// Generate invoices for each copy (Original, Duplicate, Triplicate)
for ($z = 0; $z < 3; $z++) {
    foreach ($pages as $pageIndex => $pageItems) { 
        $currentPageNum = $pageIndex + 1;
        $isLastPage = ($pageIndex == $totalPages - 1);
        $isFirstPage = ($pageIndex == 0);
?>
        <!-- Invoice Header -->
        <table width="<?php echo $page_width; ?>" border="0" align="center">
            <tr>
                <td width="250" align="center" style="font-size:20px;font-weight:bold;"></td>
                <td width="250" align="center" style="font-size:20px;font-weight:bold;text-transform:uppercase">&nbsp;</td>
                <td width="250" align="right" style="font-size:15px;font-weight:bold;"><?php echo $copies[$z]; ?></td>
            </tr>
        </table>

        <!-- Company Logo and Info -->
        <table width="<?php echo $page_width; ?>" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
            <tr>
                <td width="80" style="border-right: 1px solid black;">
                    <img src="<?php echo base_url(); ?>upload/<?php echo $profileimage->image; ?>" width="120" height="100" alt="logo" />
                </td>
                <td width="590" align="center" valign="center" style="font-size:12px;">
                    <p style="font-size: 42px;color:#FF070B;font-family: 'Bgothm', sans-serif;margin-bottom: -13px;font-weight:600;"><?php echo $profile->companyname; ?></p>
                    <p style="margin-top: 21px;margin-bottom: -5px;"><b><?php echo $profile->address1; ?>,</b></p>
                    <p><b><?php echo $profile->address2; ?>, <?php echo $profile->city; ?> - <?php echo $profile->pincode; ?></b></p>
                    <p style="margin-top:-7px;margin-bottom: -11px;">Email id: <?php echo $profile->emailid; ?>, marketing@ckprimealloys.com</p>
                    <p style="margin-top:15px;margin-bottom: -2px;">Phone : <?php echo $profile->phoneno; ?>, <?php echo $profile->mobileno; ?></p>
                </td>
                <td width="20"></td>
            </tr>
        </table>

        <!-- Invoice Details -->
        <table width="<?php echo $page_width; ?>" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;border-bottom:1px solid black;" align="center">
            <tr>
                <td rowspan="4" width="400" align="right" valign="center" style="font-size:22px;font-weight:600;">INVOICE</td>
            </tr>
            <tr>
                <td width="300" align="right" style="font-size:12px;">&nbsp;&nbsp;&nbsp;Invoice No&nbsp;:&nbsp;&nbsp;<?php echo $bil->invoiceno; ?></td>
            </tr>
            <tr>
                <td width="100" align="center" style="font-size:12px;padding-left: 53px;">&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($bil->invoicedate)); ?></td>
            </tr>
            <tr>
                <td width="300" align="right" style="font-size:12px;">&nbsp;GSTIN&nbsp;:&nbsp;&nbsp;<?php echo @$profile->gstin; ?></td>
            </tr>
        </table>

        <!-- E-invoice IRN if enabled (only on first page) -->
        <?php if ($isFirstPage && $preference->einvoice == 1 && isset($pre[0]->irn)) { ?>
            <table width="<?php echo $page_width; ?>" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="1">
                <tr>
                    <td style="font-size:12px;border-bottom:1px solid black">
                        <p>IRN No:<b><?php echo $pre[0]->irn; ?></b></p>
                    </td>
                </tr>
            </table>
        <?php } ?>

        <!-- Address Section - ONLY ON FIRST PAGE -->
        <?php if ($isFirstPage) { ?>
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
                        <div style="padding-left:15px;padding-top: 3px;">Contact : <?php echo $contactperson; ?> , Ph.No: <?php echo @$mobileno; ?></div>
                    </td>
                    <td width="350" style="font-size:12px;">
                        <div style="padding-left:15px;padding-top: 3px;"><?php echo $bil->customername; ?>,</div>
                        <div style="padding-left:15px;padding-top: 3px;"><?php echo @$addresss1; ?>,</div>
                        <div style="padding-left:15px;padding-top: 3px;"><?php echo @$addresss2; ?></div>
                        <div style="padding-left:15px;padding-top: 3px;"><?php echo @$citys; ?> - <?php echo @$pincode; ?>,</div>
                        <div style="padding-left:15px;padding-top: 3px;">GSTIN: <?php echo @$gstnos; ?></div>
                        <div style="padding-left:15px;padding-top: 3px;">Contact : <?php echo $contactperson; ?> , Ph.No: <?php echo @$mobileno; ?></div>
                    </td>
                </tr>
            </table>
        <?php } else { ?>
            <!-- For subsequent pages, add a spacer or nothing -->
            <div style="height: 5px;"></div>
        <?php } ?>

        <!-- Items Table -->
        <table width="<?php echo $page_width; ?>" align="center" style="border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
            <thead>
                <tr style="font-size: 13px; background-color: #f5f5f5;">
                    <th width="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;"><b>S.No</b></th>
                    <th width="200" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Description</strong></th>
                    <th width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>HSN</b></th>
                    <th width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Grade</strong></th>
                    <th width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Qty Nos</b></th>
                    <th width="70" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Weight in Kg</b></th>
                    <th width="60" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Rate/<br>Kg</b></th>
                    <th width="70" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Value</b></th>
                    <th width="80" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Remarks</b></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sn = ($pageIndex * $ROWS_PER_PAGE) + 1;
                $pageSubTotal = 0;
                
                foreach ($pageItems as $row) {
                    $pageSubTotal += $row['amount'];
                ?>
                    <tr style="height:1px;">
                        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $sn++; ?></td>
                        <td align="left" style="border-right:1px solid black;padding:3px;font-size:12px;text-transform: capitalize;">
                            <?php if(!empty($orderno) && $row['grade_id'] != 6){ ?>
                                Customer Po Ref:<br><?php echo $orderno; ?> <?php echo !empty($orderdate) ? date('d-m-Y', strtotime($orderdate)) : ''; ?><br>
                            <?php } ?>
                            <?php echo htmlspecialchars($row['itemname']); ?><br>
                            <?php if($row['grade_id'] != 6){ ?>
                                <?php if(!empty($row['dc_details'])) echo $row['dc_details'] . '<br>'; ?>
                                <?php echo $row['item_desc']; ?>
                            <?php } ?>
                        </td>
                        <td align="left" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $row['hsnno']; ?></td>
                        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo ($row['grade_id'] != 6) ? $row['grade'] : '-'; ?></td>
                        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $row['qty']; ?></td>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;"><?php echo ($row['grade_id'] != 6) ? number_format((float)$row['weight'], 2, '.', '') : '-'; ?></td>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;"><?php echo ($row['grade_id'] != 6) ? number_format((float)$row['rate'], 2, '.', '') : '-'; ?></td>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;"><?php echo number_format((float)$row['amount'], 2); ?></td>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;"><?php echo $row['remarks']; ?></td>
                    </tr>
                <?php } ?>
                
                <!-- Fill empty rows to maintain consistent height -->
                <?php
                $rowsOnThisPage = count($pageItems);
                $emptyRows = $ROWS_PER_PAGE - $rowsOnThisPage;
                for ($e = 0; $e < $emptyRows; $e++) {
                ?>
                    <tr style="height:1px;">
                        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                        <td align="left" style="border-right:1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                        <td align="left" style="border-right: 1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                        <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                        <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" align="right" style="border-top:1px solid black;border-right:1px solid black;padding:5px;font-weight:bold;">
                        <?php echo $isLastPage ? 'Total' : 'Page Total'; ?>:
                    </td>
                    <td align="center" style="border-top:1px solid black;border-right:1px solid black;padding:5px;font-weight:bold;">
                        <?php echo number_format($pageSubTotal, 2); ?>
                    </td>
                    <td style="border-top:1px solid black;border-right:1px solid black;padding:5px;">&nbsp;</td>
                </tr>
            </tfoot>
        </table>

        <!-- Totals Section (Only on Last Page) -->
        <?php if ($isLastPage) { ?>
            <table width="<?php echo $page_width; ?>" border="0" align="center" style="border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
                <tr>
                    <td colspan="3" valign="top" style="font-size:12px;font-weight:bold; border-right: 1px solid black;">
                        Grand Total in words<br>
                        <span style="font-size:12px;">Rupees :<b style="font-size:12px;"><?php echo $fin; ?> only</b></span>
                    </td>
                    <td width="155" align="right"><span style="font-size:12px;">Sub Total&nbsp;&nbsp;:</span></td>
                    <td width="90" align="right" style="font-size:12px;">&nbsp;<?php echo number_format($subtotal, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="border-right: 1px solid #000;font-size:12px;"><b>&nbsp;&nbsp;<u>Bank Details</u></b></td>
                    <td align="right"><span style="font-size:12px;">Freight Charges&nbsp;&nbsp;:</span></td>
                    <td align="right" style="font-size:12px;"><?php echo number_format((float)$freightCharges, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="border-right: 1px solid #000;font-size:12px;">&nbsp;&nbsp;Bank Name &nbsp;: <?php echo $profile->bankname; ?></td>
                    <td align="right"><span style="font-size:12px;">P & F Charges&nbsp;&nbsp;:</span></td>
                    <td align="right" style="font-size:12px;"><?php echo number_format((float)$loadingCharges, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="border-right: 1px solid #000;font-size:12px;">&nbsp;&nbsp;Branch &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $profile->bankbranch; ?></td>
                    <td align="right"><span style="font-size:12px;">Round Off&nbsp;&nbsp;:</span></td>
                    <td align="right" style="font-size:12px;"><?php echo number_format($roundOff, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="border-right: 1px solid #000;font-size:12px;">&nbsp;&nbsp;Account No &nbsp;: <?php echo $profile->accountno; ?></td>
                    <?php if ($bil->gsttype == 'intrastate') { ?>
                        <td align="right"><span style="font-size:12px;">&nbsp;&nbsp;CGST&nbsp;&nbsp;<?php echo $bil->cgst; ?>%:</span></td>
                        <td align="right" style="font-size:12px;"><?php echo number_format((float)$cgstAmount, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="border-right: 1px solid #000;font-size:12px;">&nbsp;&nbsp;IFSC Code &nbsp;&nbsp;: <?php echo $profile->ifsccode; ?></td>
                    <td align="right"><span style="font-size:12px;">&nbsp;&nbsp;SGST&nbsp;&nbsp;<?php echo $bil->sgst; ?>%:</span></td>
                    <td align="right" style="font-size:12px;"><?php echo number_format((float)$sgstAmount, 2); ?></td>
                <?php } ?>
                <?php if ($bil->gsttype == 'interstate') { ?>
                        <td align="right"><span style="font-size:12px;">&nbsp;&nbsp;IGST&nbsp;&nbsp;@<?php echo $bil->igst; ?>%:</span></td>
                        <td align="right" style="font-size:12px;"><?php echo number_format((float)$igstAmount, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="border-right: 1px solid #000;font-size:12px;">&nbsp;&nbsp;IFSC Code &nbsp;&nbsp;: <b><?php echo $profile->ifsccode; ?></b></td>
                <?php } ?>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom: 1px solid #000;border-right: 1px solid #000;font-size:12px;"></td>
                    <td align="right" style="border-bottom: 1px solid black;"><span style="font-size:12px;">Grand Total &nbsp;&nbsp;:</span></td>
                    <td align="right" style="border-bottom: 1px solid black;font-size:12px;"><?php echo number_format(round($grandTotal), 2); ?></td>
                </tr>
            </table>

            <!-- Terms and Conditions -->
            <table width="<?php echo $page_width; ?>" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
                <tr>
                    <td width="495" style="font-size:12px;border-right:1px solid black;">
                        TERMS AND CONDITIONS &nbsp;&nbsp;:&nbsp; <br>
                    </td>
                    <td width="280" style="font-size:14px;border-right:1px solid black;font-family: 'Bgothm', sans-serif;font-weight:900;" align="right">
                        For <b style="font-size:18px;"><?php echo $profile->companyname; ?></b>
                    </td>
                </tr>
                <tr>
                    <td width="180" height="5" valign="top" style="font-size:12px;border-right:1px solid black;">
                        <span style="font-size:12px;">1.No Claim For breakage or Loss during transit.<br>2.All disputes subject to Coimbatore Jurisdiction only.<br>3.Our Responsibility Ceases after the goods have been delivered to carriers.</span>
                    </td>
                    <td width="280" style="font-size:12px;border-right:1px solid black;" align="right" valign="bottom">
                        <b>Authorised Signatory</b>
                    </td>
                </tr>
            </table>
        <?php } ?>

        <!-- Page Break (except after last page) -->
        <?php if ($pageIndex < $totalPages - 1) { ?>
            <div style="page-break-after: always;"></div>
        <?php } ?>
        <br>
    <?php } // End of pages loop 
} // End of copies loop ?>

<script type="text/javascript" src="<?php echo base_url(); ?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    window.print();
</script>

<style type="text/css">
    table tr td {
        padding: 3px;
    }
</style>

<?php if ($bil->gsttype == 'interstate') { ?>
    <br>
<?php } ?>
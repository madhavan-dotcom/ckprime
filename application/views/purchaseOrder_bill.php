<?php
error_reporting(0);
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
        .page-break {
            page-break-before: always;
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
    
    table {
        page-break-inside: avoid;
    }
</style>

<?php
// Collect all items data first
$allItems = [];
foreach ($pre as $vob) {
    $itemname = explode('||', $vob->itemname);
    $itemdesc = explode('||', $vob->item_desc);
    $itemcode = explode('||', $vob->itemcode);
    $drawingno = explode('||', $vob->drawingno);
    $weight = explode('||', $vob->weight);
    $grade = explode('||', $vob->grade);
    $qty = explode('||', $vob->qty);
    
    $count = count($itemname);
    for ($i = 0; $i < $count; $i++) {
        $totalweight = (float)$qty[$i] * (float)$weight[$i];
        $allItems[] = [
            'itemcode' => $itemcode[$i],
            'itemname' => $itemname[$i],
            'itemdesc' => $itemdesc[$i],
            'drawingno' => $drawingno[$i],
            'grade' => $grade[$i],
            'qty' => $qty[$i],
            'weight' => $weight[$i],
            'totalweight' => $totalweight
        ];
    }
}

// Pagination settings
$itemsPerPage = 10;
$totalItems = count($allItems);
$totalPages = ceil($totalItems / $itemsPerPage);

// Get customer and other data
$getcusname = $this->db->where('id', $bil->customerId)->get('customer_details')->result();
foreach ($getcusname as $cus) {
    $addresss1 = $cus->address1;
    $addresss2 = $cus->address2;
    $citys = $cus->city;
    $states = $cus->state;
    $gstnos = $cus->gstno;
    $mobileno = $cus->phoneno;
    $pincode = $cus->pincode;
    $statecode = $cus->statecode;
}
$discountBy = $bil->discountBy;

// Function to render header
function renderHeader($profileimage, $profile, $bil, $addresss1, $addresss2, $citys, $states, $pincode, $mobileno, $gstnos, $statecode) {
    ?>
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
            <td width="80" style="border-right: 1px solid black;"><img src="<?php echo base_url(); ?>upload/<?php echo $profileimage->image; ?>" width="120" height="100" alt="logo" /></td>
            <td width="590" align="center" valign="center" style="font-size:12px;">
                <strong style="font-size: 42px;color:#FF070B;font-family: 'Bgothm', sans-serif;"><?php echo $profile->companyname; ?></strong>
            </td>
            <td width="180" style="border-left: 1px solid black;"></td>
        </tr>
    </table>

    <table width="750" border="0" style="border:1px solid black;border-collapse: collapse;border-top: none;" align="center">
        <tr>
            <td align="center" style="font-size:24px;font-weight:bold;padding: 6px;">Work Order</td>
        </tr>
    </table>

    <table width="750" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="1">
        <tr>
            <td width="700" style="font-size:12px;border-right:1px solid black;"><b>&nbsp;To: <?php echo $bil->customername; ?></b></td>
            <td width="250" style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;Workorder No</td>
            <td width="100" style="font-size:12px;">&nbsp;&nbsp;&nbsp;Date</td>
        </tr>
        <tr>
            <td width="700" rowspan="4" valign="top" style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @$addresss1; ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @$addresss2; ?>, <?php echo @$citys; ?>, <?php echo @$states; ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pin Code : <?php echo @$pincode; ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile No : <?php echo @$mobileno; ?></td>
            <td width="250" style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;<b><?php echo $bil->purchaseorderno; ?></b></td>
            <td width="100" style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;<b><?php {
                                                                                                            $a = $bil->date;
                                                                                                            $d = date('d/m/Y', strtotime($a));
                                                                                                            echo $d;
                                                                                                        }; ?></b></td>
        </tr>
        <tr>
            <td width="250" style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;P.O No</td>
        </tr>
        <tr>
            <td style="font-size:12px;border-right:1px solid black;"><b>&nbsp;&nbsp;&nbsp;<?php echo $bil->purchaseorder; ?></b></td>
        </tr>
        <tr>
            <td style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;Delivery Date</td>
            <td style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td width="700" style="font-size:12px;border-right:1px solid black;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GSTIN:<?php echo @$gstnos; ?><span style="float:right">State Code : <?php echo @$statecode; ?></span></b></td>
            <td width="150" style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;<b><?php echo $bil->deliverydate; ?></b></td>
            <td width="150" style="font-size:12px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </table>
    <?php
}

// Function to render footer (only for last page)
function renderFooter($profile, $totalPages, $currentPage) {
    if ($currentPage == $totalPages) {
        ?>
        <table width="750" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
            <tr>
                <td width="250" style="font-size:12px;border-right:1px solid black;"><b>&nbsp;&nbsp;</b></td>
                <td width="250" style="font-size:12px;border-right:1px solid black;" align="center"><b>&nbsp;</b></td>
                <td width="250" style="font-size:14px;border-right:1px solid black;font-weight:900;font-family: 'Bgothm', sans-serif;" align="center">For <b style="font-size:19px;font-family: 'Bgothm', sans-serif;"><?php echo $profile->companyname; ?></b></td>
            </tr>
            <tr>
                <td width="250" height="100" valign="bottom" align="center" style="font-size:12px;border-right:1px solid black;"><b>&nbsp;&nbsp;Prepared By:</b></td>
                <td width="250" style="font-size:12px;border-right:1px solid black;" valign="bottom" align="center"><b>&nbsp;&nbsp;Checked By:</b></td>
                <td width="250" style="font-size:12px;border-right:1px solid black;" align="center" valign="bottom"><b>&nbsp;&nbsp;Approved By:</b></td>
            </tr>
        </table>
        <?php
    }
}

// Loop through pages
for ($page = 1; $page <= $totalPages; $page++) {
    // Add page break for pages after first
    if ($page > 1) {
        echo '<div class="page-break"></div>';
    }
    
    // Render header for each page
    renderHeader($profileimage, $profile, $bil, $addresss1, $addresss2, $citys, $states, $pincode, $mobileno, $gstnos, $statecode);
    
    // Calculate items for current page
    $startIndex = ($page - 1) * $itemsPerPage;
    $endIndex = min($startIndex + $itemsPerPage, $totalItems);
    $pageItems = array_slice($allItems, $startIndex, $endIndex - $startIndex);
    ?>
    
    <table width="750" height="650" align="center" style="border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
        <tr style="font-size: 13px;">
            <td width="35" height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;"><b>S.No</b></td>
            <td width="70" height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;"><b>Product</b></td>
            <td width="180" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Item Description</b></td>
            <td width="150" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Drg / Part No</strong></td>
            <td width="60" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Grade</b></td>
            <td width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Qty</b></td>
            <td width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>C.Wt</b></td>
            <td width="50" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>T.Wt</b></td>
            <td width="42" style="border-bottom:1px solid black;padding:5px;" align="center"><b>Remarks</b></td>
        </tr>
        
        <?php
        $itemNumber = $startIndex;
        foreach ($pageItems as $item) {
            $itemNumber++;
            $getgradename = $this->db->where('id', $item['grade'])->get('grade')->row();
            ?>
            <tr style="height:1px;">
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $itemNumber; ?></td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo @$item['itemcode']; ?></td>
                <td align="left" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $item['itemname']; ?><br> <?php echo $item['itemdesc']; ?></td>
                <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;text-transform: capitalize;">&nbsp;<?php echo $item['drawingno']; ?></td>
                <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;"><?php echo @$getgradename->grade; ?></td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $item['qty']; ?></td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $item['weight']; ?></td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><?php echo $item['totalweight']; ?></td>
                <td align="right" style="padding:3px;font-size:12px;">&nbsp;</td>
            </tr>
        <?php } ?>
        
        <!-- Fill empty rows if needed to maintain consistent table height -->
        <?php
        $emptyRowsNeeded = $itemsPerPage - count($pageItems);
        for ($i = 0; $i < $emptyRowsNeeded; $i++) {
            ?>
            <tr style="height:1px;">
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                <td align="left" style="border-right: 1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                <td align="center" style="border-right:1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                <td align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;">&nbsp;</td>
                <td align="right" style="padding:3px;font-size:12px;">&nbsp;</td>
            </tr>

            
        <?php } ?>
    </table>
    
    <?php
    // Render footer for last page only
    renderFooter($profile, $totalPages, $page);
}
?>

<script type="text/javascript" src="<?php echo base_url(); ?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    window.print();
</script>

<style type="text/css">
    table tr td {
        padding: 3px;
    }
</style>
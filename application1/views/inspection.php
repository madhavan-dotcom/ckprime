<link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
<style>
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

    @media print {
        .profile-image {
            border-right: 1px solid black !important;
        }

        th,
        td {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }

    .dimension tbody tr td {
        padding: 3px;
    }
</style>

<?php $data = $this->db->get('profile')->result();
foreach ($data as $profile)
    $datas = $this->db->order_by('id', 'desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage) ?>

<table width="750" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
    <tr>
        <td width="80" align="center" valign="center" rowspan="3" class="profile-image" style="border-right: 1px solid black;"><img src="<?php echo base_url(); ?>upload/<?php echo $profileimage->image; ?>" width="120" height="100" alt="logo" /></td>
        <td width="500" height="80" align="center" colspan="2" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">
            <p style="font-size: 42px;color:#FF070B;font-family: 'Bgothm', sans-serif;font-weight:600;"><?php echo $profile->companyname; ?></p>
        </td>
        <td width="120" align="center" valign="center" style="font-size:14px;border-bottom:1px solid black;">Page No: <br>1</td>
    </tr>
    <tr>
        <td rowspan="2" align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">FINAL INSPECTION REPORT</td>
        <td align="right" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">REPORT NO:</td>
        <td align="right" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $report->insno; ?></td>
    </tr>
    <tr>
        <td align="right" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">DATE:</td>
        <td align="right" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $report->inspection_date; ?></td>
    </tr>
</table>

<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">

    <tr>
        <td align="center" width="120" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">CUSTOMER:</td>
        <td align="center" width="344" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $report->customername; ?></td>
        <td align="right" width="153" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;">&nbsp;</td>
        <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;">&nbsp;</td>
    </tr>
    <tr>
        <td align="center" width="120" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">DESCRIPTION:</td>
        <td align="center" width="344" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $report->itemname; ?></td>
        <td align="right" width="153" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">DRG NO:</td>
        <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $report->drawingno; ?></td>
    </tr>
</table>

<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;" align="center">
    <tr>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;">PRODUCT CODE:</td>
        <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;"><?php echo $report->product_code; ?></td>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;">GRADE:</td>
        <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;"><?php echo $grade; ?></td>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;">DIMENSION IN :</td>
        <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;"><?php echo $report->dimension_in; ?></td>
    </tr>
</table>

<table width="750" border="0" class="dimension" style="border:1px solid black;border-collapse: collapse;" align="center">
    <thead>
        <tr>
            <td align="center" rowspan="3" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">S.No</td>
            <td align="center" rowspan="3" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">View</td>
            <td align="center" rowspan="2" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">HEAT NO</td>
            <td align="center" colspan="5" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">ACTUAL DIMENSION</td>
        </tr>
        <tr>
            <td align="center" width="90" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $report->heatno1; ?></td>
            <td align="center" width="90" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $report->heatno2; ?></td>
            <td align="center" width="90" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $report->heatno3; ?></td>
            <td align="center" width="90" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $report->heatno4; ?></td>
            <td align="center" width="90" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;">REMARKS</td>
        </tr>
        <tr>
            <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">DRG.DIM</td>
            <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">1</td>
            <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">2</td>
            <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">3</td>
            <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">4</td>
            <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">&nbsp;</td>
        </tr>
    </thead>
    <tbody>

        <?php

        $sno    = explode(',', $report->sno);
        $view    = explode(',', $report->view);
        $length    = explode(',', $report->length);
        $inspection1 = explode(',', $report->inspection1);
        $inspection2 = explode(',', $report->inspection2);
        $inspection3 = explode(',', $report->inspection3);
        $inspection4 = explode(',', $report->inspection4);
        $remark = explode(',', $report->remark);

        $count = count($sno);

        for ($i = 0; $i < $count; $i++) {

        ?>
            <tr>
                <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $sno[$i]; ?></td>
                <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $view[$i]; ?></td>
                <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $length[$i]; ?></td>
                <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $inspection1[$i]; ?></td>
                <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $inspection2[$i]; ?></td>
                <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $inspection3[$i]; ?></td>
                <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $inspection4[$i]; ?></td>
                <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $remark[$i]; ?></td>
            </tr>
        <?php } ?>

        <tr>
            <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">NOTE: </td>
            <td align="center" colspan="6" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">&nbsp;</td>
            <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;">&nbsp;</td>
        </tr>

        <tr>
            <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">&nbsp; </td>
            <td align="center" colspan="6" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">&nbsp;</td>
            <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;">&nbsp;</td>
        </tr>

        <tr>
            <td align="center" colspan="2" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">TYPE OF NDT</td>
            <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;">QTY</td>
            <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;">RESULT</td>
            <td align="center" colspan="4" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">REMARKS</td>
        </tr>

        <?php

        $ndt    = explode(',', $report->ndt);
        $qty    = explode(',', $report->qty);
        $result    = explode(',', $report->result);
        $ndt_remarks = explode(',', $report->ndt_remarks);

        $count = count($ndt);

        for ($i = 0; $i < $count; $i++) {

        ?>

            <tr>
                <td align="center" colspan="2" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $ndt[$i]; ?></td>
                <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $qty[$i]; ?></td>
                <td align="center" valign="center" style="font-size:12px;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $result[$i]; ?></td>
                <td align="center" colspan="4" valign="center" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;"><?php echo $ndt_remarks[$i]; ?></td>
            </tr>

        <?php } ?>


    </tbody>
</table>

<table width="750" border="0" height="150" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="center" width="250" valign="bottom" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">INSPECTED BY (QC)</td>
        <td align="center" width="250" valign="bottom" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">QUALITY ASSURANCE (QA)</td>
        <td align="center" width="250" valign="bottom" style="font-size:12px;font-weight:600;border-right: 1px solid black;border-bottom:1px solid black;">EXTERNAL INSPECTOR</td>
    </tr>
</table>







<script type="text/javascript" src="<?php echo base_url(); ?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    window.print();
</script>
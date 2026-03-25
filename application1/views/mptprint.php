<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magnetic Particle Inspection Report</title>
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

        body {
            margin: 0;
            padding: 0;
            font-family: 'verdana', sans-serif;
            font-size: 12px;
        }

        .page {
            width: 750px;
            margin: 0 auto;
            page-break-after: always;
        }

        .page:last-child {
            page-break-after: auto;
        }

        td,
        th {
            font-family: 'verdana', sans-serif;
        }

        .uttable tr th,
        .uttable tr td {
            border: 1px solid #000;
            padding: 5px;
        }

        .uttable tr th {
            border-top: 0px solid;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .page {
                width: 750px;
                margin: 0 auto;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <?php $data = $this->db->get('profile')->result();
    foreach ($data as $profile)
        $datas = $this->db->order_by('id', 'desc')->limit(1)->get('company_logo')->result();
    foreach ($datas as $profileimage) ?>
    <?php
    // Sample data - in your actual code, this would come from your database


    // Sample items data - in your actual code, this would come from your database


    $description = explode(',',$mpt->description);
    $pono   = explode(',',$mpt->po_no_dt);
    $drawingno   = explode(',',$mpt->drawing_no);
    $heatno      = explode(',',$mpt->heat_no);
    $mpino       = explode(',',$mpt->mpi_no);
    $despqty     = explode(',',$mpt->desp_qty);

    $count = count($description);



    $items = [];
    for ($i = 0; $i < $count; $i++) {
   

        $items[] = [
            'sl_no' => $i+1 ,
            'po_no' => $pono[$i],
            'description' => $description[$i],
            'drawing_no' => $drawingno[$i],
            'heat_no' => $heatno[$i],
            'mpi_no' => $mpino[$i],
            'qty' => $despqty[$i]
        ];
    }

    // Split items into chunks of 10 for pagination
    $itemChunks = array_chunk($items, 10);



    // Generate pages
    foreach ($itemChunks as $pageNum => $pageItems) {
    ?>
        <div class="page">
            <table width="750" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
                <tr>
                    <td width="80" style="border-right: 1px solid black;">
                        <!-- Logo would go here -->
                        <div style="width: 120px; height: 100px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                            <img src="<?php echo base_url(); ?>upload/<?php echo $profileimage->image; ?>" width="120" height="100" alt="logo" />
                        </div>
                    </td>
                    <td width="590" align="center" valign="top" style="font-size:11px;">
                        <strong style="font-size: 30px;color:#FF070B;font-family: 'Bgothm', sans-serif;">
                            <?php echo $profile->companyname; ?>
                        </strong>
                        <br>
                        <br>
                        <?php echo $profile->address1; ?>
                        <br>
                        <?php echo $profile->address2; ?>,
                        <?php echo $profile->city; ?> -
                        <?php echo $profile->pincode; ?>
                        <!--<br><b>GSTIN:-->
                        <!--    <?php echo $profile->gstin; ?>-->
                        <!--</b>-->
                        <br>Phone :
                        <?php echo $profile->phoneno; ?>,&nbsp;Mobile :
                        <?php echo $profile->mobileno; ?>
                        <!--<br>Email id :-->
                        <!--<?php echo $profile->emailid; ?>, Website :-->
                        <!--<?php echo $profile->website; ?>-->
                    </td>
                    <td width="180" style="border-left: 1px solid black;"></td>
                </tr>
            </table>

            <table width="750" border="0" height="30" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
                <tr>
                    <td align="center" valign="center" style="font-size:14px;font-weight:600;">MAGNETIC PARTICLE INSPECTION REPORT
                    </td>
                </tr>
            </table>

            <table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;font-size:12px;" align="center">
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>Customer</b> <span style="margin-left: 84px;">:<?php echo $mpt->customername;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;"><b>Report No</b> <span style="margin-left: 128px;">: <?php echo $mpt->mpt_report_no;?></span></p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>GRADE</b> <span style="margin-left: 101px;">: <?php echo $mpt->grade;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;"><b>Date</b><span style="margin-left: 169px;">: <?php echo $mpt->mpt_date;?></span></p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>EQUIPMENT MAKE </b><span style="margin-left: 25px;">: <?php echo $mpt->equipment_make;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;"><b>MAGNETIC POWDER COLOUR</b> <span style="margin-left: 0px;">: <?php echo $mpt->magnetic_powder_color;?></span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>TYPE OF EQUIPMENT</b> <span style="margin-left: 7px;">: <?php echo $mpt->equipment_type;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;"><b>PROD SPACING </b><span style="margin-left: 98px;">: <?php echo $mpt->prod_spacing;?></span></p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>PROCEDURE REF </b> <span style="margin-left: 37px;">: <?php echo $mpt->procedure_ref;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;"><b>CURRENT AMPS </b><span style="margin-left: 91px;">: <?php echo $mpt->current_amps;?></span></p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>STAGE OF TEST </b> <span style="margin-left: 47px;">: <?php echo $mpt->stage_of_test;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;"><b>MAGNETISATION </b><span style="margin-left: 80px;">: <?php echo $mpt->magnetisation;?></span></p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>PROCESS </b> <span style="margin-left: 88px;">: <?php echo $mpt->process;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;"><b>SURFACE CONDITION </b><span style="margin-left: 50px;">: <?php echo $mpt->surface_condition;?></span></p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>DATE OF INSPECTION </b> <span style="margin-left: 3px;">: <?php echo $mpt->inspection_date;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;"><b>ACCEPTANCE STANDARD </b><span style="margin-left: 29px;">: <?php echo $mpt->acceptance_standard;?></span></p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>CURRENT </b> <span style="margin-left: 87px;">: <?php echo $mpt->current;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 8px 0 19px 0;"><b>MEDIUM </b><span style="margin-left: 140px;">: <?php echo $mpt->medium;?></span></p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>LIGHT INDENSITY </b> <span style="margin-left: 27px;">: <?php echo $mpt->light_indensity;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;"><b>NON - FLUOSRECENT (OR) FLUOSRECENT</b><span style="margin-left: 104px;">:<?php echo $mpt->fluosrecent;?></span></p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>AREA OF TEST </b> <span style="margin-left: 55px;">:<?php echo $mpt->area_of_test;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>CASTING TEMP </b> <span style="margin-left: 49px;">: <?php echo $mpt->casting_temp;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td width="375" style="padding-left: 15px;border-right: 1px solid #000;">
                        <p style="margin: 4px 0;"><b>DEMAGNETIZATION </b> <span style="margin-left: 16px;">: <?php echo $mpt->demagnetization;?></span></p>
                    </td>
                    <td width="375" style="padding-left: 15px;">
                        <p style="margin: 4px 0;">&nbsp;</p>
                    </td>
                </tr>
            </table>

            <table width="750" border="0" class="uttable" style="border-top:1px solid black;border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;font-size:12px;" align="center">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>PO.No/Dt</th>
                        <th>Description</th>
                        <th>Drawing No</th>
                        <th>Heat No</th>
                        <th>MPI No</th>
                        <th>Desp Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pageItems as $item) : ?>
                        <tr>
                            <td align="center"><?php echo $item['sl_no']; ?></td>
                            <td align="center"><?php echo $item['po_no']; ?></td>
                            <td class="description"><?php echo $item['description']; ?></td>
                            <td align="center"><?php echo $item['drawing_no']; ?></td>
                            <td align="center"><?php echo $item['heat_no']; ?></td>
                            <td align="center"><?php echo $item['mpi_no']; ?></td>
                            <td align="center"><?php echo $item['qty']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <table width="750" border="0" height="40" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
                <tr>
                    <td valign="center" style="font-size:12px;">
                        <p style="margin: 8px 0 8px 9px;"><b>Observation </b> <span style="margin-left: 37px;">: <?php echo $mpt->observation;?>
                          </span></p>
                    </td>
                </tr>
            </table>

            <table width="750" border="0" height="120" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
                <tr>
                    <td align="right" valign="top" style="font-size:12px;font-family: 'Bgothm', sans-serif; ">
                        <p style="margin-right:50px;margin-top: 7px;"><b>For CK PRIME ALLOYS</b></p>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="bottom" style="font-size:12px;">
                        <p style="margin-right:83px;"><b>Authorised</b></p>
                    </td>
                </tr>
            </table>

            <!-- Page number -->
            <div style="text-align: center; margin-top: 10px; font-size: 12px;">
                Page <?php echo $pageNum + 1; ?> of <?php echo count($itemChunks); ?>
            </div>
        </div>
    <?php } ?>

    <script type="text/javascript">
        // Auto-print when page loads
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
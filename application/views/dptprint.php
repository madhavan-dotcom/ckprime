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
</style>

<?php $data=$this->db->get('profile')->result();
foreach($data as $profile)
$datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage)?>

<table width="750" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
    <tr>
        <td width="80" style="border-right: 1px solid black;"><img
                src="<?php echo base_url();?>upload/<?php echo $profileimage->image;?>" width="120" height="100"
                alt="logo" /></td>
        <td width="590" align="center" valign="top" style="font-size:11px;">
            <strong style="font-size: 30px;color:#FF070B;font-family: 'Bgothm', sans-serif;">
                <?php echo $profile->companyname;?>
            </strong>
            <br>
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
        <td align="center" valign="center" style="font-size:12px;font-weight:600;">DYE - PENETRANT INSPECTION REPORT
        </td>
    </tr>
</table>


<table width="750" border="0"
    style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;font-size:12px;"
    align="center">
    <tr>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Customer</b> <span style="margin-left: 77px;">: <?php echo $dpt->customername;?></span></p>
        </td>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Report</b> <span style="margin-left: 152px;">: <?php echo $dpt->dpt_report_no;?></span></p>
        </td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Stage of Test</b> <span style="margin-left: 53px;">:<?php echo $dpt->stage_of_test;?></span>
            </p>
        </td>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Date</b><span style="margin-left: 171px;">: <?php echo $dpt->dpt_date;?></span></p>
        </td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Grade </b><span style="margin-left: 102px;">: <?php echo $dpt->grade;?></span></p>
        </td>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Type of Penetrant</b> <span style="margin-left: 77px;">: <?php echo $dpt->type_of_penetrant;?></span></p>
        </td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Casting Temperature </b> <span style="margin-left: 0px;">: <?php echo $dpt->casting_temperature;?></span>
            </p>
        </td>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Type of Developer </b><span style="margin-left: 75px;">: <?php echo $dpt->type_of_developer;?></span></p>
        </td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Surface Condition </b> <span style="margin-left: 23px;">: <?php echo $dpt->surface_condition;?></span>
            </p>
        </td>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Date of Testing </b><span style="margin-left: 95px;">: <?php echo $dpt->testing_date;?></span></p>
        </td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Acceptance Standard </b> <span style="margin-left: 0px;">: <?php echo $dpt->acceptance_standard;?></span></p>
        </td>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>DWELL TIME </b><span style="margin-left: 112px;">: <?php echo $dpt->dwell_time;?></span></p>
        </td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Procedure Ref </b> <span style="margin-left: 47px;">:<?php echo $dpt->procedure_ref;?></span></p>
        </td>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Fluorecent / Non Fluorecent </b><span style="margin-left: 7px;">: <?php echo $dpt->fluosrecent;?></span></p>
        </td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Area Method of Test </b> <span style="margin-left: 6px;">: <?php echo $dpt->area_method_of_test;?></span></p>
        </td>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Method of Applying Penetrant </b><span style="margin-left: 0px;">: <?php echo $dpt->penetrant_apply_method;?></span>
            </p>
        </td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Precleaning Method </b> <span style="margin-left: 8px;">: <?php echo $dpt->precleaning_method;?></span></p>
        </td>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0;"><b>Post of Test Cleaning </b><span style="margin-left: 56px;">: <?php echo $dpt->post_of_test_cleaning;?>
               </span></p>
        </td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0 19px 0;"><b>Light Indensity </b> <span style="margin-left: 39px;">: <?php echo $dpt->light_indensity;?></span>
            </p>
        </td>
        <td width="375" style="padding-left: 15px;">
            <p style="margin: 4px 0 19px 0;"><b>Background </b><span style="margin-left: 118px;">: <?php echo $dpt->background;?></span></p>
        </td>
    </tr>
</table>
<table width="750" border="0" class="uttable"
    style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;font-size:12px;"
    align="center">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Description</th>
            <th>Drawing</th>
            <th>Heat No</th>
            <th>DP No</th>
            <th>Qty</th>
        </tr>
    </thead>
    <tbody>


         <?php 
         $description = explode(',',$dpt->description);
         $drawingno = explode(',',$dpt->drawing_no);
         $heatno = explode(',',$dpt->heat_no);
         $dpno = explode(',',$dpt->dp_no);
         $qty = explode(',',$dpt->qty);

         $count  = count($description);

         for($i=0;$i<$count;$i++){



?>
        <tr>
            <td align="center"><?php echo $i+1;?></td>
            <td><?php echo $description[$i];?> </td>
            <td align="center"><?php echo $drawingno[$i];?></td>
            <td align="center"><?php echo $heatno[$i];?></td>
            <td align="center"><?php echo $dpno[$i];?></td>
            <td align="center"><?php echo $qty[$i];?></td>
        </tr>
        <?php }?>
    
    </tbody>
</table>

<table width="750" border="0"
    style=" height:30%;border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;font-size:12px;"
    align="center">
    <tr>
        <td valign="top" style="font-size:12px;">
            <p style="margin: 8px 0 8px 9px;"><b>Result </b> <span style="margin-left: 7px;">: <?php echo $dpt->result;?></span></p>
        </td>
        <td height="150">&nbsp;</td>
    </tr>
</table>

<table width="750" border="0" height="150"
    style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;"
    align="center">
    <tr>
        <td width="250" rowspan="2">&nbsp;</td>
        <td width="250" rowspan="2">&nbsp;</td>
        <td width="250" align="center" valign="top" style="font-size:12px;font-family: 'Bgothm', sans-serif; "><b>For CK
                PRIME ALLOYS</b></td>
    </tr>
    <tr>
        <td width="250" align="center" valign="bottom" style="font-size:12px;"><b>Authorised</b></td>
    </tr>
</table>










<script type="text/javascript" src="<?php echo base_url();?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">window.print();</script>


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

.uttable tr th, .uttable tr td{
    border: 1px solid #000;
    padding:5px;
}
.uttable tr th{
    border-top:0px solid;
}
</style>

<?php $data=$this->db->get('profile')->result();
foreach($data as $profile)
$datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage)?>

<table width="750" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
<tr>
<td width="80" style="border-right: 1px solid black;"><img src="<?php echo base_url();?>upload/<?php echo $profileimage->image;?>" width="120" height="100" alt="logo" /></td>
<td width="590" align="center" valign="top" style="font-size:11px;">
    <strong style="font-size: 30px;color:#FF070B;font-family: 'Bgothm', sans-serif;"><?php echo $profile->companyname;?></strong>
<br>
<br><?php echo $profile->address1;?>
<br><?php echo $profile->address2;?>, <?php echo $profile->city;?> - <?php echo $profile->pincode;?>
<!--<br><b>GSTIN: <?php echo $profile->gstin;?>-->
<!--  | CST No : --> <!-- <?php echo $profile->cstno;?> --> </b>
<br>Phone : <?php echo $profile->phoneno;?>,&nbsp;Mobile : <?php echo $profile->mobileno;?>
<!--<br>Email id : <?php echo $profile->emailid;?>, Website : <?php echo $profile->website;?> -->
</td>
<td width="180" style="border-left: 1px solid black;"></td>
</tr>
</table>



<table width="750" border="0" height="25" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;">ULTROSONIC TEST REPORT</td>
    </tr>
</table>

<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;font-size:12px;" align="center">
    <tr>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Customer</b> <span style="margin-left: 72px;">: <?php echo $ut->customername;?></span></p></td>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Report No</b> <span style="margin-left: 75px;">: <?php echo $ut->ut_report_no;?></span></p></td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;">&nbsp;</p></td>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Date</b><span style="margin-left: 116px;">: <?php echo $ut->ut_date;?></span></p></td>
    </tr>
</table>

<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;font-size:12px;" align="center">
    <tr>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Stage Of Test </b><span style="margin-left: 45px;">: <?php echo $ut->stage_of_test;?></span></p></td>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Date of Test</b> <span style="margin-left: 60px;">: <?php echo $ut->test_date;?></span></p></td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Surface Condition  </b> <span style="margin-left: 16px;">: <?php echo $ut->surface_condition;?></span></p></td>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Calibration Block </b><span style="margin-left: 28px;">: <?php echo $ut->calibration_block;?></span></p></td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Equipment  </b> <span style="margin-left: 63px;">: <?php echo $ut->equipment;?></span></p></td>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Couplant  </b><span style="margin-left: 83px;">: <?php echo $ut->couplant;?></span></p></td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Probe  </b> <span style="margin-left: 96px;">: <?php echo $ut->probe;?></span></p></td>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Range of CRT  </b><span style="margin-left: 53px;">: <?php echo $ut->range_of_crt;?></span></p></td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Frequency </b> <span style="margin-left: 65px;">: <?php echo $ut->frequency;?></span></p></td>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Gain </b><span style="margin-left: 113px;">: <?php echo $ut->gain;?></span></p></td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Area Coverage </b> <span style="margin-left: 37px;">: <?php echo $ut->area_coverage;?></span></p></td>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;"><b>Procedure Ref  </b><span style="margin-left: 49px;">: <?php echo $ut->procedure_ref;?></span></p></td>
    </tr>
    <tr>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0;">&nbsp;</p></td>
        <td width="375" style="padding-left: 15px;"><p style="margin: 8px 0 19px 0;"><b>Acceptance Standard </b><span style="margin-left: 3px;">: <?php echo $ut->acceptance_standard;?></span></p></td>
    </tr>
</table>
<table width="750" border="0" class="uttable" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;font-size:12px;" align="center">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Description</th>
            <th>Drawing</th>
            <th>Grade</th>
            <th>Heat No</th>
            <th>U.T. No</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center">1</td>
            <td><?php echo $ut->description;?> </td>
            <td align="center"><?php echo $ut->drawing;?></td>

            <?php $grade = $this->db->where('id',$ut->grade)->get('grade')->row();?>
            <td align="center"><?php echo $grade->grade;?></td>
            <td align="center"><?php echo $ut->heat_no;?></td>
            <td align="center"><?php echo $ut->ut_no;?></td>
        </tr>
    </tbody>
</table>

<table width="750" border="0" height="350" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;font-size:12px;" align="center">
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>

<table width="750" border="0" height="40" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td valign="center" style="font-size:12px;"><p style="margin: 8px 0 8px 9px;"><b>Result </b> <span style="margin-left: 37px;">: <?php echo $ut->result;?></span></p></td>
    </tr>
</table>

<table width="750" border="0" height="150" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td width="250" rowspan="2" style="border-right:1px solid #000;">&nbsp;</td>
        <td width="250" rowspan="2" style="border-right:1px solid #000;">&nbsp;</td>
        <td width="250" align="center" valign="top" style="font-size:12px;font-family: 'Bgothm', sans-serif; "><b>For CK PRIME ALLOYS</b></td>
    </tr>
    <tr>
        <td width="250" align="center" valign="bottom" style="font-size:12px;"><b>Authorised</b></td>
    </tr>
</table>










<script type="text/javascript" src="<?php echo base_url();?>vendor/jquery/jquery-1.11.1.min.js"></script>
<!--<script type="text/javascript">window.print();</script>-->
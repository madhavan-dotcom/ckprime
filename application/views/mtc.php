

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
</style>

<?php $data=$this->db->get('profile')->result();
foreach($data as $profile)
$datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage)?>

<table width="750" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
<tr>
<td width="80" style="border-right: 1px solid black;"><img src="<?php echo base_url();?>upload/<?php echo $profileimage->image;?>" width="120" height="100" alt="logo" /></td>
<td width="590" align="center" valign="center" style="font-size:12px;">
    <p style="font-size: 42px;color:#FF070B;font-family: 'Bgothm', sans-serif;margin-bottom: -13px;font-weight:600;"><?php echo $profile->companyname;?></p>
    <p style="margin-top: 21px;margin-bottom: -5px;"><b><?php echo $profile->address1;?>,</b></p>
    <p><b><?php echo $profile->address2;?>, <?php echo $profile->city;?> - <?php echo $profile->pincode;?>, Email id: <?php echo $profile->emailid;?></b></p>
    
</td>
<td width="20"></td>
</tr>
</table>



<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;">MATERIAL TEST CERTIFICATE</td>
    </tr>
</table>

<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;">AS PER EN 10204-3.1</td>
    </tr>
</table>

<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td width="150" rowspan="2" align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">CUSTOMER</td>
        <td width="450" rowspan="2" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;"><?php echo $report->customername; ?></td>
        <td width="100" align="left" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">TC NO</td>
        <td width="150" align="left" valign="center" style="font-size:12px;border-bottom:1px solid black;border-bottom:1px solid black;"><?php echo $report->tcno; ?></td>
    </tr>
    <tr>
        <td width="100" align="left" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">TC DATE</td>
        <td width="150" align="left" valign="center" style="font-size:12px;border-bottom:1px solid black;"><?php echo $report->tcdate; ?></td>
    </tr>
    <tr>
        <td width="150" rowspan="2" align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">P.ORDER NO</td>
        
           <?php $getworkorderno = $this->db->where('status',1)->where('purchaseorder',$report->purchaseorderno)->get('purchaseorder_details')->row();?>
        <td width="450" rowspan="2" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;"><?php echo $getworkorderno->purchaseorder; ?></td>
        <td width="100" align="left" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">HEAT NO</td>
        <td width="150" align="left" valign="center" style="font-size:12px;border-bottom:1px solid black;border-bottom:1px solid black;"><?php echo $report->heatno; ?></td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="bottom" style="font-size:9px;border-right:1px solid black;">&nbsp;</td>
    </tr>
    <tr>
        <td width="150" rowspan="2" align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">SPECIFICATION</td>
        <?php $grade = $this->db->select('grade')->where('id', $report->grade)->get('grade')->row()->grade; ?>
        <td width="450" rowspan="2" align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;"><?php echo $grade; ?></td>
        <td width="100" align="left" valign="center" style="font-size:12px;">&nbsp;</td>
        <td width="150" align="left" valign="center" style="font-size:12px;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" align="left" valign="bottom" style="font-size:9px;border-right:1px solid black;">CASTING PROCESSED BY INDUCTION MELTING <br> FOUNDRY INDENTIFICATION :CK</td>
    </tr>
</table>

<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="center" valign="center" style="font-size:16px;font-weight:600;">CHEMICAL COMPOSITION-%</td>
    </tr>
</table>
<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="center" valign="center" style="font-size:10px;font-weight:600;">&nbsp;</td>
    </tr>
</table>


<?php
$chemical_elements    = explode(',', $report->chemical_element);
$chemical_minvalue    = explode(',', $report->chemical_minvalue);
$chemical_maxvalue    = explode(',', $report->chemical_maxvalue);
$chemical_actualvalue = explode(',', $report->chemical_actualvalue);

// Find the maximum count among all arrays to decide total td
$max_cells = max(
    count(array_filter($chemical_elements, fn($v) => trim($v) !== '')),
    count(array_filter($chemical_minvalue, fn($v) => trim($v) !== '')),
    count(array_filter($chemical_maxvalue, fn($v) => trim($v) !== '')),
    count(array_filter($chemical_actualvalue, fn($v) => trim($v) !== ''))
);
?>

<table width="750" border="0" style="border-right:1px solid black;border-collapse:collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">

    <!-- ELEMENT Row -->
    <tr>
        <td width="100" colspan="2" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">ELEMENT</td>
        <?php
        foreach($chemical_elements as $el) {
            echo '<td width="45" align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">' . ($el != '' ? $el : '&nbsp;') . '</td>';
        }
        // fill remaining empty cells to match max_cells
        $remaining = $max_cells - count($chemical_elements);
        for($i=0;$i<$remaining;$i++){
            echo '<td width="45" align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">&nbsp;</td>';
        }
        ?>
    </tr>

    <!-- MIN Row -->
    <tr>
        <td width="100" rowspan="2" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">REQ</td>
        <td width="45" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">MIN</td>
        <?php
        foreach($chemical_minvalue as $min) {
            echo '<td width="45" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">' . ($min != '' ? $min : '&nbsp;') . '</td>';
        }
        $remaining = $max_cells - count($chemical_minvalue);
        for($i=0;$i<$remaining;$i++){
            echo '<td width="45" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">&nbsp;</td>';
        }
        ?>
    </tr>

    <!-- MAX Row -->
    <tr>
        <td width="45" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">MAX</td>
        <?php
        foreach($chemical_maxvalue as $max) {
            echo '<td width="45" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">' . ($max != '' ? $max : '&nbsp;') . '</td>';
        }
        $remaining = $max_cells - count($chemical_maxvalue);
        for($i=0;$i<$remaining;$i++){
            echo '<td width="45" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">&nbsp;</td>';
        }
        ?>
    </tr>

    <!-- ACTUAL Row -->
    <tr>
        <td width="45" colspan="2" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">ACTUAL</td>
        <?php
        foreach($chemical_actualvalue as $act) {
            echo '<td width="45" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">' . ($act != '' ? $act : '&nbsp;') . '</td>';
        }
        $remaining = $max_cells - count($chemical_actualvalue);
        for($i=0;$i<$remaining;$i++){
            echo '<td width="45" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">&nbsp;</td>';
        }
        ?>
    </tr>

</table>



<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" height="120" align="center">
    <tr>
        <td align="Left" height="10" valign="top" style="font-size:12px;font-weight:600;padding-left:5px;padding-top: 7px;">HEAT TREATMENT</td>
    </tr>
    <tr>
        <td align="Left" valign="top" style="font-size:12px;">
            <div style="padding-left:142px;padding-top: 5px;">
                <span style="font-size:12px;"><?php echo $report->heat_treatment; ?></span> 
            </div>
        </td>
    </tr>
</table>
<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="center" valign="center" style="font-size:16px;font-weight:600;">MECHANICAL PROPERTIES</td>
    </tr>
</table>
<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="center" valign="center" style="font-size:10px;font-weight:600;">&nbsp;</td>
    </tr>
</table>

<?php
$mechanical_element     = explode(',', $report->mechanical_element);
$mechanical_minvalue    = explode(',', $report->mechanical_minvalue);
$mechanical_maxvalue    = explode(',', $report->mechanical_maxvalue);
$mechanical_actualvalue = explode(',', $report->mechanical_actualvalue);

// sanitize (remove trailing empty values)
$mechanical_element     = array_filter(array_map('trim', $mechanical_element));
$mechanical_minvalue    = array_map('trim', $mechanical_minvalue);
$mechanical_maxvalue    = array_map('trim', $mechanical_maxvalue);
$mechanical_actualvalue = array_map('trim', $mechanical_actualvalue);
?>

<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td rowspan="3" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">REQUIREMENTS</td>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">YIELD STRENGTH</td>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">TENSILE STRENGTH</td>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">% ELONGATION</td>
        <td rowspan="2" align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">% REDUCTION OF AREA</td>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">HARDNESS</td>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">BEND TEST</td>
        <td colspan="4" align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">IMPACT TEST IN JOULES</td>
    </tr>
    <tr>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">Mpa</td>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">Mpa</td>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">GL:50 mm</td>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">BHN</td>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">D=3T</td>
        <td colspan="4" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">(10mmX10mmX55mm)</td>
    </tr>
    <tr>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">0.2% PROOF STRESS</td>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">...</td>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">...</td>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">...</td>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">&nbsp;</td>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">&nbsp;</td>
        <td colspan="4" align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">IMPACT AT -40°C & 20jmin</td>
    </tr>

    <!-- ✅ MINIMUM Row -->
    <tr>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">MINIMUM</td>
        <?php foreach ($mechanical_minvalue as $min): ?>
            <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">
                <?= ($min != '' ? $min : '&nbsp;') ?>
            </td>
        <?php endforeach; ?>
    </tr>

    <!-- ✅ MAXIMUM Row -->
    <tr>
        <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">MAXIMUM</td>
        <?php foreach ($mechanical_maxvalue as $max): ?>
            <td align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">
                <?= ($max != '' ? $max : '&nbsp;') ?>
            </td>
        <?php endforeach; ?>
    </tr>

    <!-- ✅ ACTUAL Row -->
    <tr>
        <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">ACTUAL</td>
        <?php foreach ($mechanical_actualvalue as $act): ?>
            <td align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">
                <?= ($act != '' ? $act : '&nbsp;') ?>
            </td>
        <?php endforeach; ?>
    </tr>
</table>


<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="center" valign="center" style="font-size:16px;font-weight:600;">ITEM DESCRIPTION</td>
    </tr>
</table>
<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="center" valign="center" style="font-size:10px;font-weight:600;">&nbsp;</td>
    </tr>
</table>

<table width="750" border="0" height="150" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr height="1">
        <td width="50"  align="center" valign="center" style="font-size:12px;border-right:1px solid black;border-bottom:1px solid black;">SI NO</td>
        <td  align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">PRODUCT</td>
        <td  align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">DESCRIPTION</td>
        <td  align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">DRAWING NO</td>
        <td  align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">PART NO</td>
        <td  align="center" valign="center" style="font-size:12px;font-weight:600;border-right:1px solid black;border-bottom:1px solid black;">POURED QTY</td>
    </tr>
    <tr height="50">
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;">1</td>
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;"><?php echo $report->product_code; ?></td>
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;"><?php echo $report->itemname; ?></td>
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;"><?php echo $report->drawing_no; ?></td>
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;"><?php echo $report->partno; ?></td>
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;"><?php echo $report->poured_qty; ?></td>
    </tr>
    <tr>
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;">&nbsp;</td>
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;">&nbsp;</td>
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;">&nbsp;</td>
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;">&nbsp;</td>
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;">&nbsp;</td>
        <td  align="center" valign="center" style="font-size:12px;border-right:1px solid black;">&nbsp;</td>
    </tr>
</table>



<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" height="120" align="center">
    <tr>
        <td align="Left" height="10" valign="top" style="font-size:12px;font-weight:600;padding-left:5px;padding-top: 7px;">REMARKS</td>
    </tr>
    <tr>
        <td align="Left" valign="top" style="font-size:12px;">
            <div style="padding-left:80px;padding-top: 5px;">
                <?php echo $report->remarks; ?>
            </div>
        </td>
    </tr>
</table>

<table width="750" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td align="left" valign="center" style="font-size:12px;"> We here by certify that the items mentioned above have been tested, inspected and found to be in accordance with customer's drawing, specification, purchase order and satisfy the requirements of <?php echo $grade; ?>,
    </td>
    </tr>
</table>

<table width="750" height="100" border="0" style="border-right:1px solid black;border-collapse: collapse;border-left:1px solid black;border-bottom:1px solid black;" align="center">
    <tr>
        <td width="300" align="center" valign="bottom" style="font-size:12px;">
            <div>
                R.PRAKASH <br> <span>Prepared By</span>
            </div> 
        </td>
        <td width="550">&nbsp;</td>
        <td width="300" align="center" valign="bottom" style="font-size:12px;">
            <div>
                C.KARTHIK <br> <span>QUALITY ASSURANCE</span>
            </div> 
        </td>
    </tr>
</table>


<script type="text/javascript" src="<?php echo base_url();?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
window.print();
</script>
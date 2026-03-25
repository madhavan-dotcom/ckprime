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
        padding:4px;
    }
    p{
        margin-bottom:2px;
        font-weight:500;
        margin-top: 4px;
    }
</style>



<?php
error_reporting(0);
foreach ($pre as $bil) {

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
  $data = $this->db->get('profile')->result();
  foreach ($data as $profile)
    $datas = $this->db->order_by('id', 'desc')->limit(1)->get('company_logo')->result();
  foreach ($datas as $profileimage) ?>
  <title>Dc Bill</title>
  <table width="750" border="0" style="" align="center">
    <tr>
      <td width="250" align="center" style="font-size:20px;font-weight:bold;"></td>
      <td width="250" align="center" style="font-size:20px;font-weight:bold;text-transform:uppercase"></td>
      <td width="250" align="right" style="font-size:15px;font-weight:bold;"></td>
    </tr>
  </table>
  <!--<table width="750" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">-->
  <!--<tr>-->
  <!--<td width="150" ><img src="<?php echo base_url(); ?>upload/<?php echo $profileimage->image; ?>" width="120" height="100" alt="logo" /></td>-->
  <!--<td width="450" align="center" valign="top" style="font-size:14px;"><strong style="font-size: 24px;"><?php echo $profile->companyname; ?></strong><br><?php echo $profile->address1; ?>, <?php echo $profile->address2; ?>, <br><?php echo $profile->city; ?> - <?php echo $profile->pincode; ?>, Tamilnadu, India<br><b>GSTIN : <?php echo $profile->gstin; ?> | PAN No :   <?php echo $profile->aadharno; ?> </b><br>Phone : <?php echo $profile->phoneno; ?>&nbsp;<br>Email id: <?php echo $profile->emailid; ?></p> </td>-->
  <!--<td width="200" align="center"></td>-->
  <!--</tr>-->
  <!--</table>-->

  <table width="750" border="0" height="140" style="border:1px solid black;border-collapse: collapse;" align="center">
    <tr>
      <td width="80" style="border-right: 1px solid black;"><img src="<?php echo base_url(); ?>upload/<?php echo $profileimage->image; ?>" width="120" height="100" alt="logo" /></td>
      <td width="590" align="center" valign="center" style="font-size:12px;">
        <p style="font-size: 42px;color:#FF070B;font-family: 'Bgothm', sans-serif;margin-bottom: -13px;font-weight:600;"><?php echo $profile->companyname; ?></p>
        <p style="margin-top: 21px;margin-bottom: -5px;"><b><?php echo $profile->address1; ?>,</b></p>
        <p style="margin-top:6px;"><b><?php echo $profile->address2; ?>, <?php echo $profile->city; ?> - <?php echo $profile->pincode; ?></b></p>
        <p style="margin-top:0px;margin-bottom: -11px;font-weight:600;"> Email id: <?php echo $profile->emailid; ?>, marketing@ckprimealloys.com</p>
        <p style="margin-top:13px;margin-bottom: -11px;font-weight:600;"> Phone : <?php echo $profile->phoneno; ?>, <?php echo $profile->mobileno; ?></p>
        
      </td>
      <td width="20"></td>
    </tr>
  </table>

  <table width="750" border="0" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;" align="center">
    <tr align="center">
      <td>
        <p style="margin-top: 5px;font-weight: 600;font-size: 14px;">DELIVERY CHALLAN</p>
      </td>
    </tr>
    <tr align="center">
      <td>
        <p style="margin-top: 5px;font-weight: 600;font-size: 14px;">(NOT FOR SALE)</p>
      </td>
    </tr>
    <tr align="end">
      <td>
        <p style="margin-right:5px;font-size: 14px;">GSTIN: <?php echo $profile->gstin; ?></p>
      </td>
    </tr>
  </table>


  <table width="750" border="0" align="center" style="border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;border-bottom: 1px solid black;">
    <tr>
      <td width="7%" valign="center"><b>&nbsp;To :</b></td>
      <td width="300" valign="bottom"></td>
      <td width="83" style="border-left: 1px solid black;">&nbsp;&nbsp;DC No</td>
      <td width="109"><b style="font-size: 14px;">:&nbsp;&nbsp;&nbsp;<?php echo $bil->dcno; ?></b></td>
    </tr>
    <tr>
      <td height="30"> &nbsp; </td>
      <td valign="top">
        <p style="font-size:14px;font-weight:600;"><?php echo ucfirst($bil->cusname); ?></p>
      </td>
      <td style="border-left: 1px solid black;">&nbsp;&nbsp;Date</td>
      <td><b style="font-size: 14px;">:&nbsp;&nbsp;&nbsp;<?php {
                                                            $a = $bil->dcdate;
                                                            $d = date('d/m/Y', strtotime($a));
                                                            echo $d;
                                                          }; ?></b></td>
    </tr>
    <tr>
      <td height="30"></td>
      <td rowspan="2" valign="top">
        <p style="font-size:14px;"><?php echo $addresss1; ?>,<?php echo $addresss2; ?><br></p>
        <p style="font-size:14px;"><?php echo $citys; ?>,<?php echo $states; ?>-<?php echo $pincode; ?><b>&nbsp;</b></p>
        <p style="font-size:14px;">Party's GSTIN: <?php echo @$gstnos; ?></p>
      </td>
      <td style="border-left: 1px solid black;">&nbsp;&nbsp;Vehicle No</td>
      <td><b style="font-size: 14px;">:&nbsp;&nbsp;&nbsp;<?php echo $bil->vehicleno;?></b></td>
    </tr>

    <tr>
      <td height="30">&nbsp;</td>
      <td style="border-left: 1px solid black;">&nbsp;&nbsp;Time Out</td>
      <td><b style="font-size: 14px;">:&nbsp;&nbsp;&nbsp;<?php echo  $bil->time; ?></b></td>
    </tr>
  </table>
  <?php
  if ($bil->inwardno) {
  ?>
    <table width="750" border="0" style="border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;" align="center">
      <tr>
        <td height="21" style="font-size: 11px;">
        </td>
      </tr>
    </table>
  <?php } ?>
  <table width="750" height="530" align="center" style="border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
    <tr>
      <td width="38" height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;font-size: 14px;" scope="row"><strong>S.No</strong></td>
      <td width="100" style="border-right:1px solid black;border-bottom:1px solid black;font-size: 14px;" align="center"><strong>HSN No</strong></td>
      <td width="300" style="border-right:1px solid black;border-bottom:1px solid black;font-size: 14px;" align="center"><strong>Description</strong></td>
      <td width="77" style="border-right:1px solid black;border-bottom:1px solid black;font-size: 14px;" align="center"><strong>Quantity</strong></td>
      <td width="77" style="border-right:1px solid black;border-bottom:1px solid black;font-size: 14px;" align="center"><strong>Value</strong></td>
      <td width="77" style="border-right:1px solid black;border-bottom:1px solid black;font-size: 14px;" align="center"><strong>Weight</strong></td>
      <td width="77" style="border-right:1px solid black;border-bottom:1px solid black;font-size: 14px;" align="center"><strong>Remarks</strong></td>

    </tr>
    <?php foreach ($pre  as  $vob) {
      $itemname = explode('||', $vob->itemname);
      $item_desc = explode('||', $vob->item_desc);

      $hsnnos = explode('||', $vob->hsnno);
      $app_value = $vob->approximate_value;
      //print_r($item_desc);

      $qty = explode('||', $vob->qty);

      $uom = explode('||', $vob->uom);
      $price = explode('||', $vob->price);
      $hsnno = explode('||', $vob->hsnno);
      $weight = explode('||', $vob->weight);
      $customerdcno = explode('||', $vob->customerdcno);
      $customerdcdate = explode('||', $vob->customerdcdate);
      $remarksTd = explode('||', $vob->remarks);
      $count = count($itemname);
      $qtyCount = count($qty);
      $diffcount = $count - $qtyCount;
      for ($i = 0; $i < $diffcount; $i++) {
        $qty[] = "0";
      }

      for ($i = 0; $i < $count; $i++) {
        $j = $i + 1;

        if (@$customerdcno[$i] == '') {
          $dc_details = '';
        } else {

          if (@$customerdcdate[$i] == '') {
            $customerdcdates = '';
          } else {
            $customerdcdates = date('d-m-y', strtotime($customerdcdate[$i]));
          }

          @$dc_details = '<br> &nbsp;&nbsp;&nbsp;&nbsp;<span align="center" style="font-size:9px;">Dcno: ' . $customerdcno[$i] . ' Dt: ' . $customerdcdates . '</span>';
        }
        if ($item_desc[$i] == '') {

          $item_descs = '';
        } else {
          $item_descs = '<br>&nbsp;&nbsp;(<b></b>'. $item_desc[$i] . ')';
        }
        if ($qty[$i] > 0) {

    ?>
          <tr height="30">
            <td align="center" style="border-right: 1px solid black;font-size: 14px;"><?php echo $j; ?></td>
            <td align="center" style="border-right: 1px solid black;font-size: 14px;"><?php echo $hsnnos[$i]; ?></td>
            <td align="left" style="border-right: 1px solid black;font-size: 14px;">&nbsp;&nbsp;&nbsp;<?php echo $itemname[$i]; ?><?php echo $dc_details . $item_descs; ?></td>
            <td align="center" style="border-right: 1px solid black;font-size: 14px;"><?php if ($qty[$i]) {
                                                                                        echo $qty[$i];
                                                                                      } else {
                                                                                        echo '0';
                                                                                      } ?></td>
            <td align="center" style="border-right: 1px solid black;font-size: 14px;"><?php echo number_format($price[$i],2,'.',''); ?></td>
            <td align="center" style="border-right: 1px solid black;font-size: 14px;"><?php echo $weight[$i]; ?></td>

            <td align="left" style="border-right: 1px solid black;"><?php echo $remarksTd[$i]; ?></td>
          </tr>
    <?php }
      }
    } ?>
    <tr height="1">
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
    </tr>
    <tr>
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;<b></b></td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
    </tr>
    <tr height="40">
      <td colspan="2" style="border-top: 1px solid black;">&nbsp;</td>
      <td style="border-top: 1px solid black;">&nbsp; </td>
      <td style="border-top: 1px solid black;">&nbsp;</td>
      <td style="border-top: 1px solid black;">Approximate</td>
      <td style="border-top: 1px solid black;" align="center">Value : </td>
      <td style="border-top: 1px solid black;border-right: 1px solid black;" align="right"><?php echo $app_value; ?></td>
    </tr>
  </table>
  <table width="750" height="50" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
    <tr>
      <td style="font-size: 14px; border-right: 1px solid black; padding: 3px;"> For Movement of inputs or partially processed goods from one factory to another factory for further processing / operation.</td>
    </tr>
  </table>
  <table width="750" height="120" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
    <tr>
      <td width="370" valign="top" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
      <td width="380" valign="top" align="right" style="font-family: 'Bgothm', sans-serif; font-size:20px;">For <b><?php echo $profile->companyname; ?></b>&nbsp;&nbsp; </td>
    </tr>

    </tr>
    <td width="370" valign="bottom" align="center">Received By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
    <td width="380" align="right" valign="bottom">Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
  </table>


<?php } ?>
<script type="text/javascript" src="<?php echo base_url(); ?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  window.print();
</script>
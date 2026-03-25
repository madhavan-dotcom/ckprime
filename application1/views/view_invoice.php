<?php
error_reporting(0);
$discountBy = $this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
$checkInvoiceType = $this->db->select('invoiceBy')->where('id', 1)->get('preference_settings')->row()->invoiceBy;
$checkItemType = $this->db->select('itemType')->where('id', 1)->get('preference_settings')->row()->itemType;
?>
<?php $data = $this->db->get('profile')->result();
foreach ($data as $r)
?>
<title> <?php echo $r->companyname; ?></title>
<link href="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.css">
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<style type="text/css">
    .forms {}

    .forms input {
        width: 95%;
    }

    .uppercase {
        text-transform: uppercase;
    }

    td,
    th {
        font-size: 12px;
        color: black;
    }

    textarea.form-control {
        min-height: 40px !important;
    }

    .myform {}

    .myform input[type="text"] {
        width: 100%;
        border: 1px solid #dcdcdc;
        border-radius: 4px;
        padding: 8px;
        color: #435966;
    }

    .myform input[type="hidden"] {
        background: #626262;
    }

    .parsley-required {
        color: #f00 !important;
    }
</style>
<div class="content-page">
    <div class="content">
        <div class="container">
            <?php $msg = $this->session->flashdata('msg');
            if ((isset($msg)) && (!empty($msg))) { ?>
                <div class="alert btn-primary alert-micro btn-rounded pastel light dark">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print_r($msg); ?>
                </div>
            <?php } ?>

            <?php $msg = $this->session->flashdata('msg1');
            if ((isset($msg)) && (!empty($msg))) { ?>
                <div class="alert alert-micro btn-rounded alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print_r($msg); ?>
                </div>
            <?php } ?>
            <?php
            //print_r($result);
            foreach ($result as $r) ?>
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
                        <header class="panel-heading" style="color:rgb(255, 255, 255)">
                            <i class="zmdi zmdi-shopping-cart"><span style="font-family: 'Quicksand', sans-serif;padding-left: 6px;">View Invoice - <?php echo $r['invoiceno']; ?></span></i>
                        </header>
                        <div class="card-box">
                            <div class="row">
                                <form class="horizontal-form" name="editForm" method="post" action="<?php echo base_url(); ?>invoice/update" data-parsley-validate novalidate>
                                    <input type="hidden" id="discountBy" name="hiddenDiscountBy" value="<?php echo $discountBy; ?>" />
                                    <input type="hidden" name="invoiceno" id="invoiceno" value="<?php echo $r['invoiceno']; ?>">
                                    <div class="form-group forms">
                                        <div class="col-md-8">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="">Bill Type</label>
                                                    <select name="bill_type" id="bill_type" required class="form-control" style="padding:5px;" disabled>
                                                        <option value="Tax Invoice">Tax Invoice</option>
                                                        <option value="Labour Bill">Labour Bill</option>
                                                    </select>
                                                    <script>
                                                        document.editForm.bill_type.value = '<?php echo $r['bill_type']; ?>';
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Invoice Type</label>
                                                    <input type="text" class="form-control"  name="invoicetype" id="invoicetype" value="<?php echo $r['invoicetype']; ?>" readonly>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <input type="text" class="form-control  datepicker-autoclose" readonly name="invoicedate" id="datepicker-autoclose" value="<?php echo date('d-m-Y', strtotime($r['invoicedate'])); ?>">
                                                </div>
                                            </div>

                                            <!--<div class="col-md-6">-->
                                            <!--<div class="form-group">-->
                                            <!--<label>Customer Name&nbsp;<span style="color:red;">*</span></label>-->
                                            <!--<input type="text" class="form-control" name="customername" value="<?php echo $r['customername']; ?>" id="customername" value="" >-->
                                            <!--<input type="hidden" class="form-control" name="customerid"  id="customerid" value="<?php echo $r['customerId']; ?>" >-->
                                            <!--<div id="cusname_valid" style="position:absolute;"></div>-->
                                            <!--</div>-->
                                            <!--</div>-->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Customer Name&nbsp;<span style="color:blue;">(Add Customer)</span></label>
                                                    <input type="text" class="form-control" name="customername" readonly value="<?php echo $r['customername']; ?>" id="customername" value="">
                                                    <input type="hidden" class="form-control" name="customerid" id="customerid" value="<?php echo $r['customerId']; ?>">
                                                    <div id="cusname_valid" style="position:absolute;"></div>
                                                </div>
                                            </div>
                                            <?php $gstnoo = $this->db->where('id', $r['customerId'])->get('customer_details')->row(); ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>GST No</label>
                                                    <input readonly type="text" class="form-control" name="gstno" value="<?php echo $gstnoo->gstno ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>GST Type</label>
                                                    <input type="text" class="form-control" parsley-trigger="change" required name="gsttype" id="gsttype" readonly value="<?php echo $r['gsttype']; ?>">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Order No/PO No/DC No</label>
                                                    <input type="text" class="form-control" readonly name="orderno" value="<?php echo $r['orderno']; ?>">
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Order/PO/DC Date</label>
                                                    <input type="text" auotocomplete="off" readonly class="form-control datepicker-autoclose" name="orderdate" id="orderdate" value="<?php if ($r['orderdate'] == '1970-01-01' || '1969-12-31') {
                                                                                                                                                                            } else {
                                                                                                                                                                                echo date('d-m-Y', strtotime($r['orderdate']));
                                                                                                                                                                            } ?>">
                                                </div>
                                            </div>

                                            <!--<div class="col-md-4">-->
                                            <!--<div class="form-group">-->
                                            <!--<label>GST Type</label>-->
                                            <!--<select  class="form-control" name="gsttype" id="gsttype" readonly>-->
                                            <!--<option value="intrastate">INTRA-STATE</option>-->
                                            <!--<option value="interstate">INTER-STATE</option>-->
                                            <!--</select>-->
                                            <!--<script>document.editForm.gsttype.value='<?php echo $r['gsttype']; ?>';</script>-->
                                            <!--</div>-->
                                            <!--</div>-->

                                            <!-- <div class="col-md-4">
<div class="form-group"> 
<label>Delivery At</label>
<input type="text" class="form-control " name="deliveryat"    value="<?php echo $r['deliveryat']; ?>" >
</div>
</div> -->

                                            <!--<div class="col-md-4">
<div class="form-group">
<label>Time</label>
<input type="text" class="form-control" name="time" id="time" value="<?php echo $r['time']; ?>">
<div id="invoiceno_valid"></div>
</div>
</div>-->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Vehicle No</label>
                                                    <input type="text" class="form-control " readonly name="vehicleno" value="<?php echo $r['vehicleno']; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date of Removal</label>
                                                    <input type="text" class="form-control " readonly name="removalDate" value="<?php echo $r['removalDate']; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Ship To&nbsp;<span style="color:blue;">(Company Name)</label>
                                                    <input type="text" class="form-control" readonly name="shipTo" id="shipTo" value="<?php echo $r['shipTo']; ?>">
                                                    <input type="hidden" class="form-control" name="shipToId" id="shipToId" value="<?php echo $r['shipToId']; ?>">
                                                    <div id="invoiceno_valid"></div>
                                                </div>
                                            </div>

                                            <!--<div class="col-md-3">-->
                                            <!--<div class="form-group">-->
                                            <!--<label>Workorder No/Date</label>-->
                                            <!--<input type="text" auotocomplete="off" class="form-control " name="transportmode" id="transportmode" value="<?php echo $r['transportmode'] ?>" >-->
                                            <!--</div>-->
                                            <!--</div>-->



                                            <?php
                                            if ($r['invoicetype'] == 'Against DC') {
                                            ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>DC No</label>
                                                        <input type="text" readonly="" class="form-control "  name="purchaseordernos" value="<?php echo str_replace('||', ', ', $r['purchaseordernos']); ?>">
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <?php
                                            if ($r['invoicetype'] == 'Against PO') {
                                            ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>PO No</label>
                                                        <input type="text" readonly="" class="form-control " name="pono" value="<?php echo str_replace('||', ', ', $r['pono']); ?>">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea type="text" readonly class="form-control" name="address" id="address" rows="4"><?php echo $r['address']; ?></textarea>
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Ship To Address</label>
                                                <textarea type="text" readonly class="form-control" name="shipToAddress" id="shipToAddress" rows="4"> <?php echo $r['shipToAddress']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="table-responsive myform">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>HSN Code</th>
                                                    <?php $itemcode = $this->db->select('itemcode')->where('id', 1)->get('preference_settings')->row()->itemcode;
                                                    if ($itemcode == 1) { ?>
                                                        <th>Item Code</th>
                                                    <?php } ?>
                                                    <!-- <th>Heat No</th> -->
                                                    <th>Item Name</th>
                                                    <th>Qty</th>
                                                    <th>weight</th>
                                                    <th>UOM</th>
                                                    <th>Grade</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                    <th>Disc <?php if ($discountBy == 'percent_wise') {
                                                                    echo '%';
                                                                } ?></th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $hsnno = explode('||', $r['hsnno']);
                                                $dcno = explode('||', $r['dcno']);
                                                $deliveryid = explode('||', $r['deliveryid']);
                                                $itemid = explode('||', $r['itemid']);
                                                $itemcodes = explode('||', $r['itemcode']);
                                                $heatno = explode('||', $r['heatno']);
                                                $itemname = explode('||', htmlspecialchars(stripslashes($r['itemname'])));
                                                $item_desc = explode('||', $r['item_desc']);
                                                $qty = explode('||', $r['qty']);
                                                $weight = explode('||', $r['weight']);
                                                $uom = explode('||', $r['uom']);
                                                $grade = explode('||', $r['grade']);
                                                $rate = explode('||', $r['rate']);
                                                $totalamount = explode('||', $r['amount']);
                                                $discount = explode('||', $r['discount']);
                                                $disamount = explode('||', $r['discountamount']);
                                                $taxableamount = explode('||', $r['taxableamount']);

                                                $workorderid = explode('||', $r['workorderid']);



                                                if ($r['invoicetype'] == 'Against DC') {
                                                    $readonly = "readonly";
                                                } else if ($r['invoicetype'] == 'Against PO') {
                                                    $readonly = "readonly";
                                                } else {
                                                    $readonly = '';
                                                }

                                                for ($i = 0; $i < count($itemname); $i++) {

                                                    if ($checkItemType == 'without_item') {
                                                        $vob_balance = 0;
                                                    } else {
                                                        $this->db->select('*');
                                                        $this->db->from('additem');
                                                        $this->db->where('itemname', $itemname[$i]);
                                                        $item_query = $this->db->get();
                                                        $item_result = $item_query->row();
                                                        $checkInvoiceType = $this->db->select('invoiceBy')->where('id', 1)->get('preference_settings')->row()->invoiceBy;
                                                        if ($checkInvoiceType == 'without_stock') {
                                                            $vob_balance = 0;
                                                        } else {
                                                            $this->db->select('*');
                                                            $this->db->from('stock');
                                                            $this->db->where('itemname', $itemname[$i]);
                                                            $query2 = $this->db->get();
                                                            $result = $query2->row();
                                                            $vob_balance = (isset($result->balance) ? $result->balance : 0) + ($qty[$i]);
                                                        }
                                                    }
                                                    if ($qty[$i] > 0) {

                                                ?>
                                                        <tr>
                                                            <td><input class="" id="hsnno<?php echo $i; ?>" parsley-trigger="change" required readonly type="text" name="hsnno[]" value="<?php echo $hsnno[$i]; ?>">
                                                                <div id="hsnno_valid<?php echo $i; ?>"></div>
                                                            </td>
                                                            <?php $itemcode = $this->db->select('itemcode')->where('id', 1)->get('preference_settings')->row()->itemcode;
                                                            if ($itemcode == 1) { ?>
                                                                <td><input class="itemcode_class" readonly data-id="<?php echo $i; ?>" id="itemcode<?php echo $i; ?>" parsley-trigger="change" required type="text" name="itemcode[]" value="<?php echo $itemcodes[$i]; ?>">
                                                                    <div id="itemcode_valid<?php echo $i; ?>"></div>
                                                                </td>
                                                            <?php } ?>

                                                            <!-- <td>
                                                                <input class="heatno_class" data-id="<?php echo $i; ?>" id="heatno<?php echo $i; ?>" value="<?php echo $heatno[$i]; ?>" <?php echo $readonly; ?> style="border:1px solid #605f5f;" type="text" name="heatno[]">
                                                                <div id="heat_valid<?php echo $i; ?>"></div>
                                                            </td> -->

                                                            <input type="hidden" name="workorderid[]" value="<?php echo $workorderid[$i]; ?>" style="margin-top: 2px;border:1px solid #605f5f;">
                                                            <input type="hidden" name="deliveryid[]" value="<?php echo $deliveryid[$i]; ?>" style="margin-top: 2px;border:1px solid #605f5f;">
                                                            <input type="hidden" name="itemid[]" value="<?php echo $itemid[$i]; ?>" style="margin-top: 2px;border:1px solid #605f5f;">

                                                            <td style="width:200px;"><input class="itemname_class" data-id="<?php echo $i; ?>" id="itemname<?php echo $i; ?>" value="<?php echo $itemname[$i]; ?>" <?php echo $readonly; ?> style="border:1px solid #605f5f;" required type="text" name="itemname[]" value="">
                                                                <div id="itemname_valid<?php echo $i; ?>"></div><input type="text" readonly name="item_desc[]" value="<?php echo @$item_desc[$i]; ?>" style="margin-top: 2px;border:1px solid #605f5f;"><?php if ($checkItemType == 'without_item') {
                                                                                                                                                                                                                                                } else { ?><input type="hidden" id="priceType<?php echo $i; ?>" name="priceType[]" value="<?php echo @$item_result->priceType; ?>" /><?php } ?>
                                                            </td>



                                                            <?php if ($r['invoicetype'] == 'Against DC') {
                                                                $balqty = $this->db->select('balanceqty')->where('itemname', $itemname[$i])->where('dcno', $dcno[$i])->get('dc_delivery')->row()->balanceqty;
                                                                $balanceqty = $balqty + $qty[$i];
                                                            }
                                                            ?>

                                                            <td><input class="qty_class" readonly data-id="<?php echo $i; ?>" id="qty<?php echo $i; ?>" required type="text" name="qty[]" value="<?php echo $qty[$i]; ?>" autocomplete="off" style="border:1px solid #605f5f;"><input type="hidden" id="prevQty<?php echo $i; ?>" value="<?php echo $qty[$i]; ?>" /><input type="hidden" name="qtys" id="qtys<?php echo $i; ?>" value="<?php echo $vob_balance; ?>"><?php if ($r['invoicetype'] == 'Against DC') { ?><input class="" type="hidden" name="balanceqty[]" id="balanceqty<?php echo $i; ?>" value="<?php echo $balanceqty; ?>"><?php } ?><div id="qty_valid<?php echo $i; ?>"></div>
                                                            </td>

                                                            <td><input class="weight_class" readonly data-id="<?php echo $i; ?>" value="<?php echo $weight[$i]; ?>" id="weight<?php echo $i; ?>" style="border:1px solid #605f5f;" type="text" name="weight[]" autocomplete="off"></td>


                                                            <td><input class="" value="<?php echo $uom[$i]; ?>" readonly id="uom<?php echo $i; ?>" style="border:1px solid #605f5f;" type="text" name="uom[]" autocomplete="off"></td>

                                                            <td>
                                                                <select disabled name="grade[]" id="grade<?php echo $i; ?>" data-id="<?php echo $i; ?>"
                                                                    class="form-control grade_class" style="width: 120px;">
                                                                    <option value="">Select Grade</option>
                                                                    <?php
                                                                    $grades = $this->db->where('status', 1)->get('grade')->result();
                                                                    foreach ($grades as $g) {
                                                                        $selected = ($g->id == $grade[$i]) ? 'selected' : '';
                                                                    ?>
                                                                        <option value="<?php echo $g->id; ?>" <?php echo $selected; ?>>
                                                                            <?php echo $g->grade; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>


                                                            <td><input readonly class="rate_class decimals" data-id="<?php echo $i; ?>" value="<?php echo $rate[$i]; ?>" id="rate<?php echo $i; ?>" required style="border:1px solid #605f5f;" type="text" name="rate[]" autocomplete="off">
                                                                <div id="rate_valid<?php echo $i; ?>"></div>
                                                            </td>

                                                            <td><input class="decimals" id="amount<?php echo $i; ?>" value="<?php echo $totalamount[$i]; ?>" readonly style="border:1px solid #605f5f;" type="text" name="amount[]" value="" autocomplete="off">
                                                                <div id="rate_valid<?php echo $i; ?>"></div>
                                                            </td>

                                                            <td><input readonly class="discount_class decimals" data-id="<?php echo $i; ?>" id="discount<?php echo $i; ?>" value="<?php echo $discount[$i]; ?>" style="border:1px solid #605f5f;" type="text" name="discount[]" value="0" autocomplete="off" onkeypress="return isNumberKey_With_Dot(event)">
                                                                <div id="discount_valid<?php echo $i; ?>"></div>
                                                            </td>

                                                            <td><input class="decimals" id="taxableamount<?php echo $i; ?>" value="<?php echo $taxableamount[$i]; ?>" readonly style="border:1px solid #605f5f;" type="text" name="taxableamount[]" autocomplete="off"><input type="hidden" value="<?php echo @$disamount[$i]; ?>" name="discountamount[]" id="discountamount<?php echo $i; ?>"></td>

                                                            <?php
                                                            if ($r['invoicetype'] == 'Against DC' || $r['invoicetype'] == 'Against PO') {
                                                            } else {
                                                                if ($i == 0) {
                                                                } else {
                                                                    echo '<td><button type="button" id="remove' . $i . '" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td>';
                                                                }
                                                            }
                                                            ?>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                            <tbody id="append"></tbody>
                                        </table>
                                    </div>

                                    <?php
                                    if ($r['invoicetype'] == 'Against DC' || $r['invoicetype'] == 'Against PO') {
                                    } else {
                                    ?>
                                        <div class="col-sm-offset-11">
                                            <!-- <button type="button" class="btn btn-info add pull-right" style="margin-right:10px;"><i class="fa fa-plus"></i></button> -->

                                        </div>
                                    <?php } ?>

                                    <br>
                                    <br>

                                    <div class="col-sm-offset-7">
                                        <label class="col-sm-5  control-label">Sub Total</label>
                                        <div class="col-sm-7">
                                            <input class="form-control" type="text" name="subtotal" value="<?php echo $r['subtotal']; ?>" id="subtotal" readonly placeholder="0">
                                        </div>
                                    </div>


                                    <div class="col-sm-offset-7">
                                        <label class="col-sm-5  control-label">Frieght Charges</label>
                                        <div class="col-sm-7">
                                            <input class="form-control decimals" type="text" name="freightamount" id="freightamount" value="<?php echo $r['freightamount']; ?>">
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="col-sm-offset-7">
                                        <label class="col-sm-5  control-label">Loading & Packing Charges</label>
                                        <div class="col-sm-7">
                                            <input class="form-control decimals" type="text" name="loadingamount" id="loadingamount" value="<?php echo $r['loadingamount']; ?>">
                                        </div>
                                    </div>


                                    <div class="clearfix"></div>
                                    <div class="sgst col-sm-offset-7" <?php if ($r['gsttype'] != 'intrastate') {
                                                                            echo 'style="display:none"';
                                                                        } ?>>
                                        <label class="sgst col-sm-5  control-label">CGST </label>
                                        <div class="col-sm-2">
                                            <input class="sgst decimals form-control" type="text" name="cgst" id="cgst" value="<?php echo $r['cgst']; ?>">
                                        </div>
                                        <div class="col-sm-5">
                                            <input class="sgst decimals form-control" value="<?php echo $r['cgstamount']; ?>" type="text" readonly name="cgstamount" id="cgstamount" placeholder="0">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="clearfix"></div>
                                    <div class="sgst col-sm-offset-7" <?php if ($r['gsttype'] != 'intrastate') {
                                                                            echo 'style="display:none"';
                                                                        } ?>>
                                        <label class="sgst col-sm-5  control-label">SGST </label>
                                        <div class="col-sm-2">
                                            <input class="sgst decimals form-control" readonly type="text" name="sgst" id="sgst" value="<?php echo $r['sgst']; ?>">
                                        </div>
                                        <div class="col-sm-5">
                                            <input class="sgst decimals form-control" value="<?php echo $r['sgstamount']; ?>" type="text" readonly name="sgstamount" id="sgstamount" placeholder="0">
                                        </div>
                                    </div>

                                    <div class="igst col-sm-offset-7" <?php if ($r['gsttype'] != 'interstate') {
                                                                            echo 'style="display:none"';
                                                                        } ?>>
                                        <label class="igst col-sm-5  control-label">IGST </label>
                                        <div class="col-sm-2">
                                            <input class="igst decimals form-control" type="text" name="igst" id="igst" value="<?php echo $r['igst']; ?>">
                                        </div>
                                        <div class="col-sm-5">
                                            <input class="igst decimals form-control" type="text" readonly name="igstamount" id="igstamount" value="<?php echo $r['igstamount']; ?>" placeholder="0">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="col-sm-offset-7">
                                        <label class="col-sm-5  control-label">Round Off</label>
                                        <div class="col-sm-7">
                                            <input class="form-control decimals" type="text" name="roundOff" id="roundOff" placeholder="0" value="<?php echo $r['roundOff']; ?>" onfocus="if(this.value == '0') { this.value = ''; }" onblur="if(this.value == '') { this.value = '0'; }">
                                        </div>
                                    </div>
                                    <!-- <br>
<br>  
<div class="clearfix"></div>

<div class="col-sm-offset-7">
<label class="col-sm-5  control-label" >Other Charges</label>
<div class="col-sm-7">
<input class="form-control"  type="text" value="<?php echo $r['othercharges']; ?>" name="othercharges" id="othercharges"   placeholder="0" onkeypress="return isNumber(event)" value="0" onfocus="if(this.value == '0') { this.value = ''; }" onblur="if(this.value == '') { this.value = '0'; }">
</div>
</div> -->
                                    <br>
                                    <br>

                                    <div class=" col-sm-offset-7">
                                        <label class="col-sm-5  control-label">Invoice Total</label>
                                        <div class="col-sm-7">
                                            <input class="form-control" readonly value="<?php echo $r['grandtotal']; ?>" type="text" name="grandtotal" id="grandtotal">
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-4">
                                        <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                                        <input type="hidden" id="hide" value="<?php echo ($i - 1); ?>">
                                        <a href="<?php echo base_url(); ?>invoice/view" class="btn btn-info">Go Back</a>
                                        <!-- <button  class="btn btn-primary"  name="print" id="print" value="print">Print Invoice</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div><!-- end col -->
        </div>
    </div>
</div>
</div>

<script>
    var resizefunc = [];
</script>

<script src="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
        call_keyup();

        $('#gsttype').change(function() {
            var gsttype = $('#gsttype').val();
            // $('#form1')[0].reset();
            /*$('#hsnno'+total+'').val('');
            $('#itemname'+total+'').val('');
            $('#qty'+total+'').val('');
            $('#uom'+total+'').val('');
            $('#rate'+total+'').val('');
            $('#amount').val('');
            $('#discount').val('');
            $('#taxableamount').val('');
            $('#discountamount').val('');
            $('#cgst'+total+'').val('');
            $('#cgstamount'+total+'').val('');
            $('#sgst'+total+'').val('');
            $('#sgstamount'+total+'').val('');
            $('#igst'+total+'').val('');
            $('#igstamount'+total+'').val('');
            $('#total'+total+'').val('');*/

            if (gsttype == 'interstate') {
                $('.sgst').hide();
                $('.igst').show();
                /*$('#sgst'+total+'').val('0');
                $('#sgstamount'+total+'').val('0.00');
                $('#cgst'+total+'').val('0');
                $('#cgstamount'+total+'').val('0.00');*/
            } else if (gsttype == 'intrastate') {
                $('.sgst').show();
                $('.igst').hide();
                //$('#igst'+total+'').val('0');
                //$('#igstamount'+total+'').val('0.00');
            }
        });

        $("#shipTo").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo base_url(); ?>invoice/autocomplete_customername",
                    data: {
                        keyword: $("#shipTo").val()
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $("#shipTo").val(ui.item.label);
                $('#shipToAddress').val(ui.item.address);
                $('#tinno').val(ui.item.tinno);
                $('#cstno').val(ui.item.cstno);
                $('#shipToId').val(ui.item.customerid);
                //  $('#gstno').val(ui.item.gstno);
                //   $('#gsttype').val(ui.item.type);
                var name = $('#shipTo').val();
            }
        });

        $('#customername').keyup(function() {
            var name = $('#customername').val();
            if (name != '') {
                $.post('<?php echo base_url(); ?>invoice/getcustomer', {
                    name: name
                }, function(res) {
                    if (res > 0) {
                        $('#cusname_valid').html('<span><font color="green">Available!</span>');
                        $('#submit').attr('disabled', false);
                        $('#print').attr('disabled', false);
                    } else {
                        $('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
                        $('#submit').attr('disabled', true); //set button enable 
                        $('#print').attr('disabled', true); //set button enable 
                        //set button enable     
                    }
                });
                return false;
            }
        });

        $("#customername").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo base_url(); ?>invoice/autocomplete_customername",
                    data: {
                        keyword: $("#customername").val()
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $("#customername").val(ui.item.label);
                $('#address').val(ui.item.address);
                $('#tinno').val(ui.item.tinno);
                $('#cstno').val(ui.item.cstno);
                $('#customerid').val(ui.item.customerid);
                var name = $('#customername').val();
                if (name != '') {
                    $.post('<?php echo base_url(); ?>invoice/getcustomer', {
                        name: name
                    }, function(res) {
                        if (res > 0) {
                            $('#cusname_valid').html('<span><font color="green">Available!</span>');
                            $('#submit').attr('disabled', false);
                            $('#print').attr('disabled', false);
                        } else {
                            $('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
                            $('#submit').attr('disabled', true); //set button enable 
                            $('#print').attr('disabled', true); //set button enable 
                            //set button enable     
                        }
                    });
                    return false;
                }
            }
        });
        $('.add').click(function() {
            var start = $('#hide').val();
            var total = Number(start) + 1;
            $('#hide').val(total);
            var tbody = $('#append');


            var mod = $('#gsttype').val();
            var samples, samples1;
            if (mod == 'intrastate') {
                samples = "none";
                samples1 = "nones";
            } else {
                samples = "nones";
                samples1 = "none";
            }

            $(' <tr>' +
                '<td><input class="" <?php if ($checkItemType == 'without_item') {
                                        } else {
                                            echo 'readonly';
                                        } ?>  id="hsnno' + total + '" style="border:1px solid #605f5f;" type="text" name="hsnno[]" value="" style="border:1px solid #605f5f;"><div id="hsnno_valid"></div></td>'
                <?php $itemcode = $this->db->select('itemcode')->where('id', 1)->get('preference_settings')->row()->itemcode;
                if ($itemcode == 1) { ?> +
                    '<td><input class="itemcode_class" data-id="' + total + '" id="itemcode' + total + '" style="border:1px solid #605f5f;" type="text" name="itemcode[]" value="" style="border:1px solid #605f5f;"><div id="itemcode_valid"></div></td>'
                <?php } ?>

                +
                '<td><input class="heatno_class" data-id="' + total + '" parsley-trigger="change" required id="heatno' + total + '" style="border:1px solid #605f5f;" type="text" name="heatno[]" value=""><div id="heatno_valid' + total + '"></div><input type="hidden" name="itemid[]" id="itemid' + total + '" value="" style="margin-top: 2px;border:1px solid #605f5f;" >'


                +
                '<td><input class="itemname_class" data-id="' + total + '" parsley-trigger="change" required id="itemname' + total + '" style="border:1px solid #605f5f;" type="text" name="itemname[]" value=""><div id="itemname_valid' + total + '"></div><input type="text" name="item_desc[]" value="" style="margin-top: 2px;border:1px solid #605f5f;" ><input type="hidden" name="priceType[]" id="priceType' + total + '" /></td>'

                +
                '<td><input class="qty_class" data-id="' + total + '" id="qty' + total + '"  parsley-trigger="change" required type="text" name="qty[]"    autocomplete="off" style="border:1px solid #605f5f;"><div id="qty_valid' + total + '"></div><input type="hidden" id="prevQty' + total + '" value="0" /><input class="" id="qtys' + total + '" type="hidden" name="qtys[]"></td>'

                +
                '<td><input class="weight_class decimals" data-id="' + total + '" id="weight' + total + '"   parsley-trigger="change" required type="text" name="weight[]" autocomplete="off" ></td>'

                +
                '<td><input class="" id="uom' + total + '"  style="border:1px solid #605f5f;" type="text" name="uom[]" readonly  autocomplete="off"></td>'

                +
                '<td><select class="form-control grade_class" data-id="' + total + '" id="grade' + total + '" name="grade[]" style="width: 120px;"><option value="">Select Grade</option><?php $grade = $this->db->where('status', 1)->get('grade')->result();
                                                                                                                                                                                            foreach ($grade as $g) { ?><option value="<?php echo $g->id; ?>"><?php echo $g->grade; ?></option><?php } ?></select></td>'


                +
                '<td><input class="rate_class decimals" data-id="' + total + '"  id="rate' + total + '"  style="border:1px solid #605f5f;" type="text" name="rate[]" required autocomplete="off"><div id="rate_valid' + total + '"></div></td>' +
                '<td><input class="decimals" id="amount' + total + '" readonly style="border:1px solid #605f5f;" type="text" name="amount[]" value=""  autocomplete="off"><input type="hidden" name="gstcal[]" id="gstcal' + total + '" value=""></td>' +
                '<td><input class="discount_class decimals" data-id="' + total + '" id="discount' + total + '"  style="border:1px solid #605f5f;" type="text" name="discount[]" value="0"  autocomplete="off"></td>' +
                '<td><input class="decimals" id="taxableamount' + total + '" readonly style="border:1px solid #605f5f;" type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount' + total + '"></td>' +
                '<td><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td></tr>').appendTo(tbody);
            call_keyup();
        });
        $('#customername').on('keyup blur', function(e) {
            var name = $('#customername').val();
            if (name != '') {
                $.post('<?php echo base_url(); ?>invoice/getcustomer', {
                    name: name
                }, function(res) {
                    if (res > 0) {
                        $('#cusname_valid').html('<span><font color="green">Available!</span>');
                        $('#submit').attr('disabled', false);
                        $('#print').attr('disabled', false);
                    } else {
                        $('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
                        $('#submit').attr('disabled', true); //set button enable 
                        $('#print').attr('disabled', true); //set button enable 
                    }
                });
                return false;
            }
        });
        $('#freightamount').keyup(function() {
            frieght_calculation();
            totalAmt_calculation();
        });

        $('#freightcgst').keyup(function() {
            var freightcgst = $('#freightcgst').val();
            $('#freightsgst').val(freightcgst);
            frieght_calculation();
            totalAmt_calculation();
        });

        $('#freightigst').keyup(function() {
            frieght_calculation();
            totalAmt_calculation();
        });

        $('#loadingamount').keyup(function() {
            frieght_calculation();
            totalAmt_calculation();
        });

        $('#loadingcgst').keyup(function() {
            var loadingcgst = $('#loadingcgst').val();
            $('#loadingsgst').val(loadingcgst);
            frieght_calculation();
            totalAmt_calculation();
        });

        $('#loadingigst').keyup(function() {
            frieght_calculation();
            totalAmt_calculation();
        });

        $('#roundOff').keyup(function() {
            //amount_calculation();
            //frieght_calculation();
            totalAmt_calculation();
        });

        $('#othercharges').keyup(function() {
            //amount_calculation();
            //frieght_calculation();
            totalAmt_calculation();
        });

        $('#cgst').keyup(function() {
            var cgst = $('#cgst').val();
            $('#sgst').val(cgst);
            totalAmt_calculation();
        });

        $('.igst').keyup(function() {
            totalAmt_calculation();
        });

    });

    function call_keyup() {
        //CGST CHANGE FUNCTION
        $('.cgstClass').keyup(function() {
            var rowNumber = $(this).attr('data-id');
            var priceType = $("#priceType" + rowNumber).val();
            var cgst = $('#cgst' + rowNumber + '').val();
            if (cgst == '') {
                $('#cgst' + rowNumber + '').val(0);
                $('#sgst' + rowNumber).val(0);
            } else {
                $('#sgst' + rowNumber).val(cgst);
            }
            if (priceType == "Inclusive") {
                Inc_amount_calculation(rowNumber);
            } else {
                amount_calculation(rowNumber);
            }
        });

        $('.grade_class').change(function() {
            var total = $(this).attr('data-id');
            var grade = $(this).val();
            $.post('<?php echo base_url(); ?>Invoice/get_hsnnos', {
                grade: grade
            }, function(datas) {
                var obj = jQuery.parseJSON(datas);
                $('#hsnno' + total).val(obj.hsnno);
            });

        });

        //IGSST CHANGE FUNCTION
        $('.igstClass').keyup(function() {
            var rowNumber = $(this).attr('data-id');
            var priceType = $("#priceType" + rowNumber).val();
            var igst = $('#igst' + rowNumber + '').val();
            if (igst == '') {
                $('#igst' + rowNumber + '').val(0);
            }
            if (priceType == "Inclusive") {
                Inc_amount_calculation(rowNumber);
            } else {
                amount_calculation(rowNumber);
            }
        });

        $(".itemname_class").blur(function() {
            var total = $(this).attr('data-id');
            if ($("#itemname" + total).val() == '') {
                $('#hsnno' + total).val('');
                $('#priceType' + total).val('');
                $('#itemcode' + total).val('');
                $('#itemno' + total).val('');
                $('#itemid' + total).val('');
                $('#grade' + total).val('');
                $('#rate' + total).val('');
                $('#sgst' + total).val('');
                $('#cgst' + total).val('');
                $('#igst' + total).val('');
                $('#uom' + total).val('');
            }
        });


        $(".itemname_class").keyup(function() {
            var total = $(this).attr('data-id');
            $("#itemname" + total).autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>invoice/autocomplete_itemname",
                        data: {
                            keyword: $("#itemname" + total).val()
                        },
                        dataType: "json",
                        type: "POST",
                        success: function(data) {
                            $('#hsnno' + total).val('');
                            $('#priceType' + total).val('');
                            $('#itemno' + total).val('');
                            $('#itemid' + total).val('');
                            $('#rate' + total).val('');
                            $('#weight' + total).val('');
                            $('#sgst').val('');
                            $('#cgst').val('');
                            $('#igst').val('');
                            $('#uom' + total).val('');
                            $('#grade' + total).val('');
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    var name = ui.item.value;
                    $('#itemname' + total).val(ui.item.value);
                    $.post('<?php echo base_url(); ?>invoice/get_itemnames', {
                        name: name
                    }, function(rest) {
                        var obj = jQuery.parseJSON(rest);
                        // $('#hsnno' + total).val(obj.hsnno);
                        $('#priceType' + total).val(obj.priceType);
                        $('#itemcode' + total).val(obj.itemcode);
                        $('#itemno' + total).val(obj.itemno);
                        $('#itemid' + total).val(obj.itemid);
                        // $('#grade' + total).val(obj.grade);
                        $('#rate' + total).val(obj.price);
                        $('#weight' + total).val(obj.weight);
                        $('#sgst').val(obj.sgst);
                        $('#cgst').val(obj.cgst);
                        $('#igst').val(obj.igst);
                        $('#uom' + total).val(obj.uom);
                        $("#qtys" + total).val(obj.balance);
                        $('#qty' + total).val('');
                        $('#qty' + total).focus();
                    });
                    $.post('<?php echo base_url(); ?>invoice/get_stockqty', {
                        name: name
                    }, function(resst) {
                        var obj = jQuery.parseJSON(resst);
                        $('#qtys').val(obj.balance);
                    });
                    if (name != '') {
                        $.post('<?php echo base_url(); ?>invoice/gets', {
                            name: name
                        }, function(res) {
                            if (res > 0) {
                                $('#itemname_valid' + total).html('<span><font color="green">Available!</span>');
                                $('#submit').attr('disabled', false);
                                $('#print').attr('disabled', false);
                            } else {
                                $('#itemname_valid' + total).html('<span><font color="red"> Not Available !</span>');
                                $('#submit').attr('disabled', true); //set button enable 
                                $('#print').attr('disabled', true); //set button enable 
                                //set button enable     
                            }
                        });
                        return false;
                    }
                }
            });
        });

        $(".itemcode_class").blur(function() {
            var total = $(this).attr('data-id');
            if ($("#itemcode" + total).val() == '') {
                $('#hsnno' + total).val('');
                $('#priceType' + total).val('');
                $('#itemno' + total).val('');
                $('#itemid' + total).val('');
                $('#itemname' + total).val('');
                $('#rate' + total).val('');
                $('#sgst' + total).val('');
                $('#cgst' + total).val('');
                $('#igst' + total).val('');
                $('#uom' + total).val('');
                $('#grade' + total).val('');
            }
        });

        $(".itemcode_class").keyup(function() {
            var total = $(this).attr('data-id');

            $("#itemcode" + total).autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>invoice/autocomplete_itemcode",
                        data: {
                            keyword: $("#itemcode" + total).val()
                        },
                        dataType: "json",
                        type: "POST",
                        success: function(data) {
                            $('#hsnno' + total).val('');
                            $('#priceType' + total).val('');
                            $('#itemno' + total).val('');
                            $('#itemid' + total).val('');
                            $('#itemname' + total).val('');
                            $('#rate' + total).val('');
                            $('#weight' + total).val('');
                            $('#sgst').val('');
                            $('#cgst').val('');
                            $('#igst').val('');
                            $('#uom' + total).val('');
                            $('#grade' + total).val('');
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    var name = ui.item.value;
                    $('#itemcode' + total).val(ui.item.value);
                    $.post('<?php echo base_url(); ?>invoice/get_itemcodes', {
                        name: name
                    }, function(rest) {
                        var obj = jQuery.parseJSON(rest);
                        $('#priceType' + total).val(obj.priceType);
                        $('#itemno' + total).val(obj.itemno);
                        $('#itemname' + total).val(obj.itemname);
                        $('#itemid' + total).val(obj.id);
                        $('#rate' + total).val(obj.price);
                        $('#weight' + total).val(obj.weight);
                        $('#sgst').val(obj.sgst);
                        $('#cgst').val(obj.cgst);
                        $('#igst').val(obj.igst);
                        $('#uom' + total).val(obj.uom);
                        $('#grade' + total).val(obj.grade);
                        $('#qtys' + total).val(obj.balance);
                        $('#qty' + total).val('');
                        $('#heatno' + total).focus();
                    });
                    if (name != '') {
                        $.post('<?php echo base_url(); ?>invoice/getss', {
                            name: name
                        }, function(res) {
                            if (res > 0) {
                                $('#itemcode_valid' + total).html('<span><font color="green">Available!</span>');
                                $('#submit').attr('disabled', false);
                                $('#print').attr('disabled', false);
                            } else {
                                $('#itemcode_valid' + total).html('<span><font color="red"> Not Available !</span>');
                                $('#submit').attr('disabled', true); //set button enable 
                                $('#print').attr('disabled', true); //set button enable 
                                //set button enable     
                            }
                        });
                        return false;
                    }
                }
            });
        });

        $(".heatno_class").keyup(function() {
            var total = $(this).attr('data-id');

            $("#heatno" + total).autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>invoice/autocomplete_heatno",
                        data: {
                            keyword: $("#heatno" + total).val()
                        },
                        dataType: "json",
                        type: "POST",
                        success: function(data) {
                            response(data);
                        }
                    });
                },

                select: function(event, ui) {
                    var name = ui.item.value;
                    console.log(name);
                    $('#heatno' + total).val(ui.item.value);
                    $.post('<?php echo base_url(); ?>invoice/get_heatno', {
                        name: name
                    }, function(rest) {
                        var obj = jQuery.parseJSON(rest);
                        var balanceqty = obj.balance;
                        $('#qty_valid' + total).html('<span><font color="green"> Qty :' + balanceqty + '</font></span>');
                    });
                    $.post('<?php echo base_url(); ?>invoice/get_heatdetails', {
                        name: name
                    }, function(res) {
                        if (res > 0) {
                            $('#heat_valid' + total).html('<span><font color="green">Available!</span>');
                            $('#submit').attr('disabled', false);
                            $('#print').attr('disabled', false);
                        } else {
                            $('#heat_valid' + total).html('<span><font color="red">Not Available!</span>');
                            $('#submit').attr('disabled', true);
                            $('#print').attr('disabled', true);
                        }
                    });

                    return false;
                }
            });
        });


        $('.qty_class').keyup(function() {

            var totalqty = 0;
            $('input[name^="qty"]').each(function() {
                totalqty += Number($(this).val());
                var fina = totalqty.toFixed(2);
                $('#totalqty').val(fina);
                //$('#grandtotal').val(fina); 

                //var tot=parseFloat(totalqty)+parseFloat(loadingamount)+parseFloat(freightamount);
            });
            var rowNumber = $(this).attr('data-id');
            var priceType = $("#priceType" + rowNumber).val();
            var qty = $('#qty' + rowNumber + '').val();
            var oldQty = $("#qtys" + rowNumber).val();
            var balanceqty = $("#balanceqty" + rowNumber).val();
            var checkInvoiceType = '<?php echo $checkInvoiceType; ?>';
            if (checkInvoiceType == 'without_stock') {
                if (parseFloat(qty) > parseFloat(balanceqty)) {

                    $('#qty' + rowNumber + '').val('0');
                    if (priceType == "Inclusive") {
                        Inc_amount_calculation(rowNumber);
                    } else {
                        amount_calculation(rowNumber);
                    }
                    totalAmt_calculation();
                } else {
                    // $('#qty_valid' + rowNumber + '').html('');
                    if (priceType == "Inclusive") {
                        Inc_amount_calculation(rowNumber);
                    } else {
                        amount_calculation(rowNumber);
                    }
                    totalAmt_calculation();
                }
            } else {
                if (qty != '') {
                    <?php if ($checkItemType == 'with_item') { ?>
                        if (parseFloat(qty) > parseFloat(balanceqty)) {
                            $('#qty' + rowNumber + '').val('');
                            $('#qty_valid' + rowNumber + '').html('<span><font color="red">Invalid Qty!' + oldQty + ' qunatity only available.</span>');
                            $('#submit').attr('disabled', true);
                        } else {
                            $('#submit').attr('disabled', false);
                            $('#qty_valid' + rowNumber + '').html('');
                            if (priceType == "Inclusive") {
                                Inc_amount_calculation(rowNumber);
                            } else {
                                amount_calculation(rowNumber);
                            }
                            totalAmt_calculation();
                        }
                    <?php } ?>
                } else {
                    $('#qty' + rowNumber + '').val('0');

                    if (priceType == "Inclusive") {
                        Inc_amount_calculation(rowNumber);
                    } else {
                        amount_calculation(rowNumber);
                    }
                    totalAmt_calculation();
                }
            }
        });



        //Weight Change Function

        $('.weight_class').keyup(function() {



            var rowNumber = $(this).attr('data-id');

            var priceType = $("#priceType" + rowNumber).val();
            var weight = $('#weight' + rowNumber + '').val();
            var checkInvoiceType = '<?php echo $checkInvoiceType; ?>';
            if (checkInvoiceType == 'without_stock') {
                if (weight == '') {
                    $('#weight_valid' + rowNumber + '').html('<span><font color="red">Invalid Qty!</span>');
                    $('#weight' + rowNumber + '').val();
                } else {
                    if (priceType == "Inclusive") {
                        Inc_amount_calculation(rowNumber);
                    } else {
                        amount_calculation(rowNumber);
                    }
                    totalAmt_calculation();
                }
            } else {
                if (priceType == "Inclusive") {
                    Inc_amount_calculation(rowNumber);
                } else {
                    amount_calculation(rowNumber);
                }
                totalAmt_calculation();
            }

        });
        //RATE CHANGE FUNCTION
        $('.rate_class').keyup(function() {
            var rowNumber = $(this).attr('data-id');
            var priceType = $("#priceType" + rowNumber).val();
            var rate = $('#rate' + rowNumber + '').val();
            $('#rate_valid' + rowNumber + '').html('');

            if (parseFloat(rate) > 0) {
                if (priceType == "Inclusive") {
                    Inc_amount_calculation(rowNumber);
                } else {
                    amount_calculation(rowNumber);
                }
                //frieght_calculation();
                totalAmt_calculation();
            } else {
                $('#rate_valid' + rowNumber + '').html('<span><font color="red">Invalid Rate !</span>');
                $('#rate_valid' + rowNumber + '').val('');
            }
        });
        // DISCOUNT CHANGE FUNCTION
        $('.discount_class').keyup(function() {
            var rowNumber = $(this).attr('data-id');
            var priceType = $("#priceType" + rowNumber).val();
            $('#discount_valid' + rowNumber + '').html('');
            var discount = $('#discount' + rowNumber + '').val();
            //alert(rowNumber+'\n'+priceType+'\n'+discount);
            if (discount != '') {
                if (priceType == "Inclusive") {
                    Inc_amount_calculation(rowNumber);
                } else {
                    amount_calculation(rowNumber);
                }
                //frieght_calculation();
                totalAmt_calculation();
            } else {
                $('#discount_valid' + rowNumber + '').html('<span><font color="red">Invalid Discount !</span>');
                var oldDisc = $("#oldDisc" + rowNumber).val();
                $('#discount' + rowNumber + '').val(oldDisc);
                $('#discount_valid' + rowNumber + '').html('');
                if (priceType == "Inclusive") {
                    Inc_amount_calculation(rowNumber);
                } else {
                    amount_calculation(rowNumber);
                }
                totalAmt_calculation();
            }
        });

        $('#freightamount').keyup(function() {
            totalAmt_calculation();
        });

        $('#loadingamount').keyup(function() {
            totalAmt_calculation();
        });


        $('#roundOff').keyup(function() {
            totalAmt_calculation();
        });

        $('#othercharges').keyup(function() {
            totalAmt_calculation();
        });

        //REMOVE FUNCTION
        $('.remove').click(function() {
            $(this).parents('tr').remove();
            totalAmt_calculation();
        });
    }


    function amount_calculation(rowNumber) {
        var qty = $('#qty' + rowNumber).val();
        var weight = $('#weight' + rowNumber).val();
        var rate = $('#rate' + rowNumber).val();

        if (qty != '' && rate != '' && weight != '')
            var amo = parseFloat(rate) * parseFloat(qty) * parseFloat(weight);
        var amou = amo.toFixed(2);
        $('#amount' + rowNumber).val(amou);
        $('#taxableamount' + rowNumber).val(amou);

        var discount = $('#discount' + rowNumber).val();
        var taxableamount = $('#taxableamount' + rowNumber).val();
        var gsttype = $('#gsttype').val();
        var discountBy = $("#discountBy").val();
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var e = 0;
        var f = 0;
        var g = 0;
        var h = 0;
        var i = 0;
        var j = 0;
        var k = taxableamount;
        var l = 0;


        if (discount != '') {
            if (discountBy == 'percent_wise') {
                a = ((parseFloat(amo) * parseFloat(discount)) / 100);
                var a1 = a.toFixed(2);
                var a2 = parseFloat(amo) - parseFloat(a1);
                var a3 = a2.toFixed(2);
                var discountamount = a1;
                taxableamount = a3;
            } else {
                a = (parseFloat(amo) - parseFloat(discount));
                var discountamount = discount;

                taxableamount = a.toFixed(2);
            }
            $('#discountamount' + rowNumber).val(discountamount);
            $('#taxableamount' + rowNumber).val(taxableamount);

        }
        k = taxableamount;

    }

    function Inc_amount_calculation(total) {
        var qty = $('#qty' + total).val();
        var rate = $('#rate' + total).val();

        if (qty != '' && rate != '')
            var amo = parseFloat(rate) * parseFloat(qty);
        var amou = amo.toFixed(2);

        var discount = $('#discount' + total).val();
        var gsttype = $('#gsttype').val();
        var discountBy = $("#discountBy").val();
        var a = 0;
        var b = 0;
        var c = 0;
        var d = 0;
        var e = 0;
        var f = 0;
        var g = 0;
        var h = 0;
        var i = 0;
        var j = 0;
        var k = 0;
        var l = 0;
        var taxableamount = 0;
        var discountamount = 0;
        taxableamount = amou;


        if (discount != '') {
            if (discountBy == 'percent_wise') {
                a = ((parseFloat(amo) * parseFloat(discount)) / 100);
                var a1 = a.toFixed(2);
                var a2 = parseFloat(amo) - parseFloat(a1);
                var a3 = a2.toFixed(2);
                var discountamount = a2;
                taxableamount = a3;
            } else {

                a = (parseFloat(amo) - parseFloat(discount));
                var discountamount = a.toFixed(2);
                taxableamount = a.toFixed(2);
            }
        }
        k = taxableamount;
        $('#discountamount' + total + '').val(discountamount);
        $('#taxableamount' + total + '').val(taxableamount);

    }



    function totalAmt_calculation() {
        var freightamount = $('#freightamount').val();
        if (freightamount == '') {
            freightamount = 0;
        }
        var loadingamount = $('#loadingamount').val();
        if (loadingamount == '') {
            loadingamount = 0;
        }
        var cgstamount = $('#cgstamount').val();
        if (cgstamount == '') {
            cgstamount = 0;
        }
        var sgstamount = $('#sgstamount').val();
        if (sgstamount == '') {
            sgstamount = 0;
        }
        var igstamount = $('#igstamount').val();
        if (igstamount == '') {
            igstamount = 0;
        }
        var roundOff = $('#roundOff').val();
        var gsttype = $('#gsttype').val();
        var cgst = $('#cgst').val();
        var sgst = $('#sgst').val();
        var igst = $('#igst').val();
        var sub_tot = 0;
        var s = 0;
        var p = 0;
        var m = 0;
        var m1 = 0;
        var n = 0;
        var n1 = 0;
        var l = 0;
        var l1 = 0;
        $('input[name^="taxableamount"]').each(function() {
            sub_tot += Number($(this).val());
            var fina = sub_tot.toFixed(2);
            $('#subtotal').val(fina);
            $('#grandtotal').val(fina);

            var tot = parseFloat(sub_tot) + parseFloat(loadingamount) + parseFloat(freightamount);
        });


        if (gsttype == 'intrastate') {
            // var totamt=parseFloat(sub_tot)+parseFloat(freightamount)+parseFloat(loadingamount);
            if (cgst != '') {
                var s = ((parseFloat((sub_tot) + parseFloat(loadingamount) + parseFloat(freightamount)) * parseFloat(cgst)) / 100);
                var s1 = s.toFixed(2);
                $('#cgstamount').val(s1);
                $('#sgstamount').val(s1);

                m = parseFloat(sub_tot) + parseFloat(s1) + parseFloat(s1);
                var m1 = m.toFixed(2);
                $('#grandtotal').val(m1);

            }

            if (loadingamount > 0) {
                //alert(loadingamount);
                l = parseFloat(sub_tot) + parseFloat(s1) + parseFloat(s1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
                l1 = l.toFixed(2);
                $('#grandtotal').val(l1);
            }
            if (freightamount > 0) {
                l = parseFloat(sub_tot) + parseFloat(s1) + parseFloat(s1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
                l1 = l.toFixed(2);
                $('#grandtotal').val(l1);
            }

            if (roundOff > 0) {
                l = parseFloat(sub_tot) + parseFloat(s1) + parseFloat(s1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
                l1 = l.toFixed(2);
                $('#grandtotal').val(l1);
            }


        } else if (gsttype == 'interstate') {
            if (igst != '') {
                var h = ((parseFloat((sub_tot) + parseFloat(loadingamount) + parseFloat(freightamount)) * parseFloat(igst)) / 100);
                var h1 = h.toFixed(2);
                $('#igstamount').val(h1);

                n = parseFloat(sub_tot) + parseFloat(h1);
                var n1 = n.toFixed(2);
                $('#grandtotal').val(n1);
            }


            if (loadingamount > 0) {
                //alert(loadingamount);
                l = parseFloat(sub_tot) + parseFloat(h1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
                l1 = l.toFixed(2);
                $('#grandtotal').val(l1);
            }
            if (freightamount > 0) {
                l = parseFloat(sub_tot) + parseFloat(h1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
                l1 = l.toFixed(2);
                $('#grandtotal').val(l1);
            }

            if (roundOff > 0) {
                l = parseFloat(sub_tot) + parseFloat(h1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
                l1 = l.toFixed(2);
                $('#grandtotal').val(l1);
            }


        }
    }
</script>



<script>
    $('.colorpicker-default').colorpicker({
        format: 'hex'
    });
    $('.colorpicker-rgba').colorpicker();
    // Date Picker
    jQuery('#datepicker').datepicker();
    jQuery('.datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
</script>

<script type="text/javascript">
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function onlyAlphabets(evt) {
        var charCode;
        if (window.event)
            charCode = window.event.keyCode; //for IE
        else
            charCode = evt.which; //for firefox

        if (charCode == 32) //for &lt;space&gt; symbol
            return true;
        if (charCode > 31 && charCode < 65) //for characters before 'A' in ASCII Table
            return false;
        if (charCode > 90 && charCode < 97) //for characters between 'Z' and 'a' in ASCII Table
            return false;
        if (charCode > 122) //for characters beyond 'z' in ASCII Table
            return false;
        return true;
    }

    $('.decimal').keyup(function() {
        var val = $(this).val();
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.-]/g, '');
            if (val.split('.').length > 2)
                val = val.replace(/\.-+$/, "");
        }
        $(this).val(val);
    });

    function isNumberKey_With_Dot(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            if (charCode == 46)
                return true;
            else
                return false;
        } else
            return true;
    }
</script>
<?php $data = $this->db->get('profile')->result();
error_reporting(0);
$discountBy = $this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
foreach ($data as $d)
?>
<title> <?php echo $d->companyname; ?></title>
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

            <div class="row">
                <div class="col-sm-12">
                    <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
                        <header class="panel-heading" style="color:rgb(255, 255, 255)">
                            <i class="zmdi zmdi-shopping-cart"><span style="font-family: 'Quicksand', sans-serif;padding-left: 6px;">View Work Order - <?php echo $result->purchaseorderno; ?></span></i>
                        </header>

                                <div class="card-box">
                                    <div class="row">
                                        <form class="horizontal-form myform" id="dc_forms" method="post" action="<?php echo base_url(); ?>purchaseorder/view" data-parsley-validate novalidate>
                                            <input type="hidden" id="discountBy" name="hiddenDiscountBy" value="<?php echo $discountBy; ?>" />
                                            <div class="form-group ">
                                                <div class="col-md-8 forms">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Date</label>
                                                                    <input type="text" class="form-control" readonly name="purchasedate" parsley-trigger="change" id="datepicker-autoclose" required="" value="<?php echo date('d-m-Y', strtotime($result->purchasedate)); ?>" style="width:148px;">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Invoice Date</label>
                                                                    <input type="text" auotocomplete="off" class="form-control datepicker-autoclose" name="invoicedate" id="invoicedate" value="<?php echo date('d-m-Y', strtotime($result->invoicedate)); ?>">
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-md-2">
<label>PO Type</label>
<select  class="form-control" parsley-trigger="change" required name="potype" id="potype" >
<option value="<?php echo $vi['potype']; ?>"><?php echo $vi['potype']; ?></option>
</select>
</div> -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Supplier Name</label>
                                                                    <input type="text" class="form-control" name="customername" id="customername" value="<?php echo $result->customername; ?>">
                                                                    <input type="hidden" class="form-control" name="customerid" id="customerid" value="<?php echo $result->customerId; ?>">
                                                                    <div id="cusname_valid" style="position: absolute;"></div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-left:0px;">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label>GST Type</label>
                                                                <input type="text" name="gsttype" id="gsttype" class="form-control" value="<?php echo $result->gsttype; ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <textarea type="text" class="form-control" name="address" id="address" rows="4"><?php echo $result->address; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix">
                                                <hr />
                                            </div>
                                            <div class="row bomClass" <?php if ($vi['potype'] != 'BOM') {
                                                                            echo 'style="display:none"';
                                                                        } ?>>
                                                <div class="col-md-12">
                                                    <div class="col-md-6">
                                                        <label>BOM No</label>
                                                        <div class="clearfix"></div>
                                                        <input type="text" readonly name="selected_bom[]" id="selected_bom" value="<?php echo str_replace('||', ',', $vi['selected_bom']); ?>" />
                                                    </div>
                                                </div>
                                            </div>

                                            <table class="table two">
                                                <thead>
                                                    <tr>
                                                        <th -style="width:70px">HSN Code</th>
                                                        <th -style="width:70px">Product Code</th>
                                                        <th style="width:150px;color:red">Item Name <a target="_blank" href="<?php echo base_url(); ?>itemmaster">(Add Item)</a></th>
                                                        <th -style="width:50px">Drawing No</th>
                                                        <th -style="width:50px">Grade</th>
                                                        <th -style="width:50px">Qty</th>
                                                        <th -style="width:50px">UOM</th>
                                                        <th -style="width:50px">weight</th>
                                                        <th -style="width:70px">Rate</th>
                                                        <th -style="width:100px">Amount</th>
                                                        <th -style="width:40px">Disc <?php if ($discountBy == 'percent_wise') {
                                                                                            echo '%';
                                                                                        } ?></th>
                                                        <th -style="width:110px">Total</th>
                                                        <th style="width:10px">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $hsnno = explode('||', $result->hsnno);
                                                    $itemcode = explode('||', $result->itemcode);
                                                    $itemname = explode('||', htmlspecialchars($result->itemname));
                                                    $itemdesc = explode('||', $result->item_desc);
                                                    $drawingno = explode('||', $result->drawingno);
                                                    $grade     = explode('||', $result->grade);
                                                    $qty = explode('||', $result->qty);
                                                    $weight = explode('||', $result->weight);
                                                    $uom = explode('||', $result->uom);
                                                    $rate = explode('||', $result->rate);
                                                    $amount = explode('||', $result->amount);
                                                    $discount = explode('||', $result->discount);
                                                    $total = explode('||', $result->taxableamount);

                                                    $count = count($itemname);
                                                    for ($i = 0; $i < $count; $i++) { ?>




                                                        <tr>
                                                            <td><input class="" id="hsnno<?php echo $i; ?>" parsley-trigger="change" required readonly type="text" name="hsnno[]" value="<?php echo $hsnno[$i]; ?>">
                                                                <div id="hsnno_valid<?php echo $i; ?>"></div>
                                                            </td>


                                                            <td><input class="itemcode_class" data-id="<?php echo $i; ?>" id="itemcode<?php echo $i; ?>" parsley-trigger="change" required type="text" name="itemcode[]" value="<?php echo $itemcode[$i]; ?>">
                                                                <div id="itemcode_valid0"></div>
                                                            </td>

                                                            <td><input class="itemname_class" style="width: 250px;" data-id="<?php echo $i; ?>" id="itemname<?php echo $i; ?>" parsley-trigger="change" required type="text" name="itemname[]" value="<?php echo $itemname[$i]; ?>">
                                                                <div id="itemname_valid<?php echo $i; ?>"></div><input type="text" name="item_desc[]" value="<?php echo $itemdesc[$i]; ?>" placeholder="Description" style="margin-top: 2px;"><input type="hidden" name="priceType[]" id="priceType<?php echo $i; ?>" />
                                                            </td>

                                                            <td><input class="" data-id="<?php echo $i; ?>" id="drawingno<?php echo $i; ?>" parsley-trigger="change" required type="text" name="drawingno[]" value="<?php echo $drawingno[$i]; ?>"></td>

                                                            <td>
                                                                <select name="grade[]" id="grade<?= $i ?>" data-id="<?= $i ?>" class="form-control grade_class" style="width:120px;">
                                                                    <option value="">Select Grade</option>
                                                                    <?php
                                                                    $grades = $this->db->where('status', 1)->get('grade')->result(); // all grade list
                                                                    $selected_grades = explode('||', $result->grade); // stored grades
                                                                    ?>
                                                                    <?php foreach ($grades as $g) { ?>
                                                                        <option value="<?= $g->id; ?>" <?php if (isset($selected_grades[$i]) && $g->id == $selected_grades[$i]) echo 'selected'; ?>>
                                                                            <?= $g->grade; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>


                                                            <td><input class="qty_class decimals" data-id="<?php echo $i; ?>" id="qty<?php echo $i; ?>" parsley-trigger="change" required type="text" name="qty[]" value="<?php echo $qty[$i]; ?>" autocomplete="off"><input class="" id="qtys<?php echo $i; ?>" type="hidden" name="qtys[]">
                                                                <div id="qty_valid<?php echo $i; ?>"></div>
                                                            </td>

                                                            <td><input class="" id="uom<?php echo $i; ?>" parsley-trigger="change" required readonly type="text" name="uom[]" value="<?php echo $uom[$i]; ?>" autocomplete="off"></td>

                                                            <td><input class="" id="weight<?php echo $i; ?>" parsley-trigger="change" required type="text" name="weight[]" value="<?php echo $weight[$i]; ?>" autocomplete="off"></td>

                                                            <td><input class="rate_class decimals" data-id="<?php echo $i; ?>" parsley-trigger="change" required id="rate<?php echo $i; ?>" type="text" name="rate[]" value="<?php echo $rate[$i]; ?>" autocomplete="off">
                                                                <div id="rate_valid<?php echo $i; ?>"></div>
                                                            </td>

                                                            <td><input class="decimals" id="amount<?php echo $i; ?>" parsley-trigger="change" required readonly type="text" name="amount[]" value="<?php echo $amount[$i]; ?>" autocomplete="off">
                                                                <div id="amount_valid<?php echo $i; ?>"></div>
                                                            </td>

                                                            <td><input class="discount_class decimals" data-id="<?php echo $i; ?>" id="discount<?php echo $i; ?>" type="text" name="discount[]" maxlength="2" onkeypress="return isNumberKey_With_Dot(event)" value="<?php echo $discount[$i]; ?>" autocomplete="off">
                                                                <div id="discount_valid0"></div>
                                                            </td>

                                                            <td><input class="decimals" id="taxableamount<?php echo $i; ?>" readonly type="text" name="taxableamount[]" value="<?php echo $total[$i]; ?>" autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount0"></td>


                                                            <td style="width:10px;">&nbsp;</td>
                                                            <td style="width:10px;">&nbsp;</td>

                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                                <tbody id="append"></tbody>
                                            </table>
                                            <div class="col-sm-offset-11">
                                                <button type="button" class="btn btn-info add pull-right" style="margin-right: 10px;"><i class="fa fa-plus"></i></button>
                                                <input type="hidden" id="hide" value="<?php echo ($i - 1); ?>">
                                            </div>
                                            <br>








                                            <div class="col-sm-offset-4">
                                                <a class="btn btn-info" href="javascript:reportFun();"><i class="fa fa-chevron-left"></i> Back to Reports</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                    </section>
                </div>
            </div><!-- end col -->
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
            $("#dc_forms :input").prop("disabled", true);
            $('#dc_forms :input[type="reset"]').hide();
            //$('#submit').html('<i class="fa fa-chevron-left"></i> Back to Reports').attr('type','button').prop('disabled',false).attr('onclick', 'reportFun()');
            $(".add").hide();
        });

        function reportFun() {
            window.location.href = "<?php echo base_url() . 'purchaseorder/view'; ?>";
        }
    </script>
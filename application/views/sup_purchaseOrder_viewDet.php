<?php $data = $this->db->get('profile')->result();
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
            <?php foreach ($result as $vi)  ?>
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
                        <header class="panel-heading" style="color:rgb(255, 255, 255)">
                            <i class="zmdi zmdi-shopping-cart"><span style="font-family: 'Quicksand', sans-serif;padding-left: 6px;">View Supplier Purchase Order - <?php echo $vi['purchaseorderno']; ?></span></i>
                        </header>
                        <!-- <div class="card-box">
                            <div class="row"> -->

                                <div class="card-box">
                                    <div class="row">
                                        <form class="horizontal-form myform" id="myform" method="post" action="<?php echo base_url(); ?>supplier_purchaseorder/update" data-parsley-validate novalidate>
                                            <input type="hidden" id="discountBy" name="hiddenDiscountBy" value="<?php echo $discountBy; ?>" />
                                            <input type="hidden" id="id" name="id" value="<?php echo $vi['id']; ?>" />
                                            <div class="form-group ">
                                                <div class="col-md-8 forms">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Date</label>
                                                                    <input type="text" class="form-control" readonly name="purchasedate" parsley-trigger="change" id="datepicker-autoclose" required="" value="<?php echo date('d-m-Y', strtotime($vi['purchasedate'])); ?>" style="width:148px;">
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-2">
<div class="form-group">
<label>Invoice Date</label>
<input type="text" auotocomplete="off" class="form-control datepicker-autoclose" name="invoicedate" id="invoicedate" value="<?php echo date('d-m-Y', strtotime($vi['invoicedate'])); ?>" >
</div>
</div> -->
                                                            <!-- <div class="col-md-2">
<label>PO Type</label>
<select  class="form-control" parsley-trigger="change" required name="potype" id="potype" >
<option value="<?php echo $vi['potype']; ?>"><?php echo $vi['potype']; ?></option>
</select>
</div> -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Supplier Name</label>
                                                                    <input type="text" class="form-control" name="suppliername" id="suppliername" value="<?php echo $vi['suppliername']; ?>">
                                                                    <input type="hidden" class="form-control" name="supplierid" id="supplierid" value="<?php echo $vi['supplierid']; ?>">
                                                                    <div id="cusname_valid" style="position: absolute;"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>GST Type</label>
                                                                    <input type="text" name="gsttype" id="gsttype" value="<?php echo $vi['gsttype']; ?>" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Reference Work Order Customer </label>
                                                            <input type="text" class="form-control" name="customername" id="customername" value="<?php echo $vi['customername']; ?>">
                                                            <input type="hidden" class="form-control" name="customerid" id="customerid" value="<?php echo $vi['customerid']; ?>">
                                                            <div id="purchaseorder_valid" style="position: absolute;"></div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <label>Pending Po</label>
                                                        <select name="workorderno" id="workorderno" class="form-control">
                                                            <option value="<?php echo $vi['workorderno']; ?>"><?php echo $vi['workorderno']; ?></option>
                                                        </select>
                                                    </div>
                                                    <!-- <div class="row">


<div class="col-md-3">
<div class="form-group">
<label>Purchase Order </label>
<input type="text" class="form-control" parsley-trigger="change" required name="purchaseorder" id="purchaseorder" value="<?php echo $vi['purchaseorder']; ?>">
<div id="purchaseorder_valid" style="position: absolute;"></div>
</div>
</div>
<div class="col-md-3">
<label>Purchase Order Date</label>
<input type="text" auotocomplete="off" class="form-control datepicker-autoclose" name="invoicedate" id="invoicedate" value="<?php echo date('d-m-Y', strtotime($vi['invoicedate'])); ?>" >
</div>
</div> -->
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <textarea type="text" class="form-control" name="address" id="address" rows="4"><?php echo $vi['address']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix">
                                                <hr />
                                            </div>
                                            <!--<div id="inwarddetails"></div>-->
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>HSN Code</th>
                                                        <th -style="width:70px">Product Code</th>
                                                        <th>Item Name</th>
                                                        <th -style="width:50px">Drawing No</th>
                                                        <th -style="width:50px">Grade</th>
                                                        <th -style="width:50px">Qty</th>
                                                        <th -style="width:50px">UOM</th>
                                                        <th -style="width:50px">Weight</th>
                                                        <th>Rate</th>
                                                        <th>Amount</th>
                                                        <!-- <th>Disc <?php if ($discountBy == 'percent_wise') {
                                                                            echo '%';
                                                                        } ?></th> -->


                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $hsnno = explode('||', $vi['hsnno']);
                                                    $itemcode = explode('||', $vi['itemcode']);
                                                    $itemname = explode('||', htmlspecialchars($vi['itemname']));
                                                    $itemdesc = explode('||', $vi['item_desc']);
                                                    $drawingno = explode('||', $vi['drawingno']);
                                                    $grade = explode('||', $vi['grade']);
                                                    $qty = explode('||', $vi['qty']);
                                                    $weight = explode('||', $vi['weight']);
                                                    $uom = explode('||', $vi['uom']);
                                                    $rate = explode('||', $vi['rate']);
                                                    $amount = explode('||', $vi['amount']);
                                                    $taxableamount = explode('||', $vi['taxableamount']);


                                                    for ($i = 0; $i < count($itemname); $i++) {
                                                        $this->db->select('*');
                                                        $this->db->from('additem');
                                                        $this->db->where('itemname', $itemname[$i]);
                                                        $item_query = $this->db->get();
                                                        $item_result = $item_query->row();
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <input class="" id="hsnno<?php echo $i; ?>" readonly style="width:70px;border:1px solid #605f5f;" type="text" name="hsnno[]" value="<?php echo $hsnno[$i]; ?>">
                                                                <input class="form-control" id="id<?php echo $i; ?>" type="hidden" value="<?php echo $i; ?>">
                                                                <div id="hsnno_valid<?php echo $i; ?>"></div>
                                                            </td>

                                                            <td><input class="itemcode_class" data-id="<?php echo $rows->id; ?>" id="itemcode<?php echo $rows->id; ?>" parsley-trigger="change" required type="text" name="itemcode[]" value="<?php echo $itemcode[$i]; ?>"></td>
                                                            <td>
                                                                <input class="itemname_class" data-id="<?php echo $i; ?>" id="itemname<?php echo $i; ?>" value="<?php echo $itemname[$i]; ?>" style="border:1px solid #605f5f;" type="text" name="itemname[]">
                                                                <input type="text" name="item_desc[]" value="<?php echo $itemdesc[$i]; ?>" placeholder="Description" style="margin-top: 2px;">
                                                                <div id="itemname_valid<?php echo $i; ?>"></div><input type="hidden" id="priceType<?php echo $i; ?>" name="priceType[]" value="<?php echo @$item_result->priceType; ?>" />
                                                            </td>

                                                            <td><input class="" data-id="<?php echo $i; ?>" id="drawingno<?php echo $i; ?>" parsley-trigger="change" required type="text" name="drawingno[]" value="<?php echo $drawingno[$i]; ?>"></td>
                                                            <td><select name="grade[]" id="grade<?php echo $i; ?>" data-id="<?php echo $i; ?>" class="form-control grade_class" style="width: 120px;" required>
                                                                    <?php $grade =  $this->db->where('status', 1)->get('grade')->result();  ?>

                                                                    <?php foreach ($grade as $g) { ?>
                                                                        <option value="<?php echo $g->id; ?>" <?php if ($g->id == $grade[$i]) echo 'selected'; ?>><?php echo $g->grade; ?></option>

                                                                    <?php } ?>
                                                                </select></td>
                                                            <td>
                                                                <input class="qty_class" data-id="<?php echo $i; ?>" id="qty<?php echo $i; ?>" required type="text" name="qty[]" value="<?php echo $qty[$i]; ?>" autocomplete="off" style="width:50px;border:1px solid #605f5f;"><input type="hidden" name="qtys[]" id="qtys<?php echo $i; ?>" value="<?php echo $qty[$i]; ?>">

                                                            </td>
                                                            <td><input class="" value="<?php echo $uom[$i]; ?>" id="uom<?php echo $i; ?>" readonly style="width:50px;border:1px solid #605f5f;" type="text" name="uom[]" autocomplete="off"></td>

                                                            <td><input class="weight_class" id="weight<?php echo $i; ?>" parsley-trigger="change" data-id="<?php echo $i;?>" required type="text" name="weight[]" autocomplete="off" value="<?php echo $weight[$i]; ?>"></td>
                                                            <td><input class="rate_class decimals" data-id="<?php echo $i; ?>" value="<?php echo $rate[$i]; ?>" id="rate<?php echo $i; ?>" required style="width:70px;border:1px solid #605f5f;" type="text" name="rate[]" autocomplete="off">
                                                                <div id="rate_valid<?php echo $i; ?>"></div>
                                                            </td>
                                                            <td><input class="decimals" id="amount<?php echo $i; ?>" value="<?php echo $amount[$i]; ?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="amount[]" value="" autocomplete="off"><input type="hidden" name="gstcal[]" id="gstcal<?php echo $i; ?>" value="">
                                                                <div id="rate_valid<?php echo $i; ?>"></div>
                                                            </td>

                                                            <td><input class="decimals" id="taxableamount<?php echo $i; ?>" value="<?php echo $taxableamount[$i]; ?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="taxableamount[]" value="" autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount<?php echo $i; ?>"></td>



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

                                            <div class="col-sm-offset-5">
                                                <label class="col-sm-5  control-label">Sub Total</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control" type="text" value="<?php echo $vi['subtotal']; ?>" name="subtotal" id="subtotal" readonly placeholder="0" value="0">
                                                </div>
                                            </div>
                                            <br>
                                            <br>

                                            <div class="col-sm-offset-5">
                                                <label class="col-sm-5  control-label">Freight Charges</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control" type="text" value="<?php echo $vi['freightamount']; ?>" name="freightamount" id="freightamount" placeholder="0">
                                                </div>
                                            </div>
                                            <br>
                                            <br>

                                            <div class="clearfix"></div>
                                            <div class="col-sm-offset-5">
                                                <label class="col-sm-5  control-label">Loading & Packing Charges</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control decimals" type="text" name="loadingamount" id="loadingamount" value="<?php echo $vi['loadingamount']; ?>">
                                                </div>
                                            </div>
                                            <br>
                                            <br>



                                            <div class="clearfix"></div>
                                            <div class="sgst col-sm-offset-5">
                                                <label class="sgst col-sm-5  control-label">CGST </label>
                                                <div class="col-sm-2">
                                                    <input class="sgst decimals form-control" type="text" name="cgst" id="cgst" value="<?php echo $vi['cgst'];?>">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input class="sgst decimals form-control" type="text" readonly name="cgstamount" id="cgstamount" placeholder="0" value="<?php echo $vi['cgstamount'];?>">
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="sgst col-sm-offset-5 sgst">
                                                <label class="sgst col-sm-5 control-label">SGST </label>
                                                <div class="col-sm-2">
                                                    <input class="sgst decimals form-control" type="text" readonly name="sgst" id="sgst" value="<?php echo $vi['sgst'];?>">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input class="sgst decimals form-control" type="text" readonly name="sgstamount" id="sgstamount" placeholder="0" value="<?php echo $vi['sgstamount'];?>">
                                                </div>
                                            </div>


                                            <div class="clearfix"></div>
                                            <div class="col-sm-offset-5 igst">
                                                <label class="igst  col-sm-5 control-label">IGST </label>
                                                <div class="col-sm-2">
                                                    <input class="igst decimals form-control" type="text" name="igst" id="igst" value="<?php echo $vi['igst'];?>">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input class="igst decimals form-control" readonly type="text" name="igstamount" id="igstamount" placeholder="0" value="<?php echo $vi['igstamount'];?>">
                                                </div>
                                            </div>

                                            <div class="col-sm-offset-5">
                                                <label class="col-sm-5  control-label">Round Off</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control decimals" type="text" name="roundOff" id="roundOff" placeholder="0" value="<?php echo $vi['roundOff']; ?>" onfocus="if(this.value == '0') { this.value = ''; }" onblur="if(this.value == '') { this.value = '0'; }">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="clearfix"></div>

                                            <div class="col-sm-offset-5">
                                                <label class="col-sm-5  control-label">Other Charges</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control" type="text" name="othercharges" id="othercharges" value="<?php echo $vi['othercharges']; ?>" placeholder="0" value="0">
                                                </div>
                                            </div>
                                            <br>
                                            <br>

                                            <div class=" col-sm-offset-5">
                                                <label class="col-sm-5  control-label">Purchase Total</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control" type="text" value="<?php echo $vi['grandtotal']; ?>" readonly name="grandtotal" id="grandtotal">
                                                    <input class="form-control" type="hidden" name="taxtotal" id="grandtotal1" value="">
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <!-- <div class="col-sm-offset-4">
                                                <input type="hidden" name="purchaseorderno" value="<?php echo $vi['purchaseorderno']; ?>">
                                                <input type="hidden" name="id" value="<?php echo $vi['id']; ?>">
                                                <button class="btn btn-info" id="submit">Update</button>
                                                <button class="btn btn-primary" id="backtoReport"><i class="fa fa-chevron-left"></i> Back to Reports</button>
                                            </div> -->
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
            /*var gotVal = $('#potype').val();
            getDetails(gotVal);
            $('#potype').change(function(){
            getDetails($(this).val());
            });*/
            $('#backtoReport').click(function() {
                window.location.href = '<?php echo base_url() . 'supplier_purchaseorder/view'; ?>';
            });
            $('form').parsley();
        });
        /*function getDetails(gotVal)
        {
        if(gotVal=='Direct PO')
        {
        $.post('<?php echo base_url(); ?>supplier_purchaseorder/getaddpurchasedetails',{'jobOrder':'jobOrder'},function(data){
        $('#inwarddetails').html(data);
        call_keyup();

        });
        $('#inwarddetails').html('');
        $('.bomClass').hide();
        $('.directPurchaseDet').show();
        $('.add').show();
        }
        else
        {
        var po_id=$("#id").val();
        var selected_bom = $("#selected_bom").val().split(",");
        $.post('<?php echo base_url(); ?>supplier_purchaseorder/getbomdetails_edit',{'po_id':po_id,'selected_bom':selected_bom},function(data){
        $('#inwarddetails').html(data);
        call_keyup();
        });
        $('.bomClass').show();
        $('.directPurchaseDet').hide();
        $('.add').hide();

        }
        }*/
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

        $(document).ready(function() {

            	var gsttype = $('#gsttype').val();
				if (gsttype == 'interstate') {
					$('.sgst').hide();
					$('.igst').show();

				} else if (gsttype == 'intrastate') {

					$('.sgst').show();
					$('.igst').hide();

				}
            call_keyup();
            $('#gsttype').change(function() {
                var gsttype = $('#gsttype').val();
                $('input[name^="hsnno"]').val('');
                $('input[name^="itemname"]').val('');
                $('input[name^="qty"]').val('');
                $('input[name^="uom"]').val('');
                $('input[name^="rate"]').val('');
                $('input[name^="amount"]').val('');
                $('input[name^="discount"]').val('');
                $('input[name^="taxableamount"]').val('');
                $('input[name^="discountamount"]').val('');
                $('input[name^="cgst"]').val('');
                $('input[name^="cgstamount"]').val('');
                $('input[name^="sgst"]').val('');
                $('input[name^="sgstamount"]').val('');
                $('input[name^="igst"]').val('');
                $('input[name^="igstamount"]').val('');
                $('input[name^="total"]').val('');

                $('#hsnno').val('');
                $('#itemname').val('');
                $('#qty').val('');
                $('#uom').val('');
                $('#rate').val('');
                $('#amount').val('');
                $('#discount').val('');
                $('#taxableamount').val('');
                $('#discountamount').val('');
                $('#cgst').val('');
                $('#cgstamount').val('');
                $('#sgst').val('');
                $('#sgstamount').val('');
                $('#igst').val('');
                $('#igstamount').val('');
                $('#total').val('');

                if (gsttype == 'interstate') {
                    $('.sgst').hide();
                    $('.igst').show();
                    $('#sgst').val('0');
                    $('#sgstamount').val('0.00');
                    $('#cgst').val('0');
                    $('#cgstamount').val('0.00');
                } else if (gsttype == 'intrastate') {
                    $('.sgst').show();
                    $('.igst').hide();
                    $('#igst').val('0');
                    $('#igstamount').val('0.00');
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


            $('#suppliername').blur(function() {
                var name = $(this).val();
                if (name != '') {
                    $.post('<?php echo base_url(); ?>purchase/get_supplier', {
                        name: name
                    }, function(res) {
                        if (res > 0) {
                            $('#cusname_valid').html('<span><font color="green">Available!</span>');
                            $('#submit').attr('disabled', false);
                            $('#print').attr('disabled', false);
                        } else {
                            $('#suppliername').focus();
                            $('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
                            $('#submit').attr('disabled', true); //set button enable 
                            $('#print').attr('disabled', true); //set button enable 
                            //set button enable     
                        }
                    });
                    return false;
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
                    '<td><input class="" id="hsnno' + total + '" style="width:70px;border:1px solid #605f5f;" readonly type="text" name="hsnno[]" value="" style="width:70px;border:1px solid #605f5f;"><div id="hsnno_valid' + total + '"></div></td>' +
                    '<td><input class="itemname_class" data-id="' + total + '"  parsley-trigger="change" required id="itemname' + total + '"  style="width:150px;border:1px solid #605f5f;" type="text" name="itemname[]" value=""><div id="itemname_valid' + total + '"></div><input type="hidden" name="priceType[]" id="priceType' + total + '" /></td>' +
                    '<td><input class="qty_class" data-id="' + total + '" id="qty' + total + '"    parsley-trigger="change" required type="text" name="qty[]"   onkeypress="return isNumberKey(event)" autocomplete="off" style="width:50px;border:1px solid #605f5f;"><div id="qty_valid' + total + '"></div><input type="hidden" id="qtys' + total + '" value="0" /></td>' +
                    '<td><input class="" readonly id="uom' + total + '"  style="width:50px;border:1px solid #605f5f;" type="text" name="uom[]"   autocomplete="off"></td>' +
                    '<td><input class="rate_class decimals" data-id="' + total + '" id="rate' + total + '"  style="width:70px;border:1px solid #605f5f;" type="text" name="rate[]" required autocomplete="off"><div id="rate_valid' + total + '"></div></td>' +
                    '<td><input class="decimals" id="amount' + total + '" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="amount[]" value=""  autocomplete="off"><input type="hidden" name="gstcal[]" id="gstcal' + total + '" value=""></td>' +
                    '<td><input class="discount_class decimals" data-id="' + total + '" id="discount' + total + '"  style="width:40px;border:1px solid #605f5f;" type="text" name="discount[]" value="0"  autocomplete="off" onkeypress="return isNumberKey_With_Dot(event)"><input type="hidden" id="oldDisc' + total + '" value="0" ></td>' +
                    '<td><input class="decimals" id="taxableamount' + total + '" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount' + total + '"></td>' +
                    '<td class="sgst" style="display:' + samples1 + ';"><input class="decimals" readonly id="cgst' + total + '"  type="text" name="cgst[]" value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="cgst_valid' + total + '"></div></td>' +
                    '<td class="sgst" style="display:' + samples1 + ';"><input class="decimals" id="cgstamount' + total + '"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>' +
                    '<td class="sgst" style="display:' + samples1 + ';"><input class="decimals" id="sgst' + total + '"  type="text" name="sgst[]" readonly value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid' + total + '"></div></td>' +
                    '<td class="sgst" style="display:' + samples1 + ';"><input class="decimals" id="sgstamount' + total + '"  type="text" name="sgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>' +
                    '<td class="igst" style="display:' + samples + ';"><input class="decimals" id="igst' + total + '"  type="text" name="igst[]"  style="width:45px;border:1px solid #605f5f;" readonly onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid' + total + '"></div></td>' +
                    '<td class="igst" style="display:' + samples + ';"><input class="decimals" id="igstamount' + total + '" readonly type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>' +
                    '<td><input class="" id="total' + total + '" type="text" name="total[]" value=""  readonly style="width:110px;border:1px solid #605f5f;"></td>' +
                    '<td><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td></tr>').appendTo(tbody);
                call_keyup();



            });
        });
    </script>

    <script type="text/javascript">
        $('#document').ready(function() {
            $('#checkbox').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#check').show();
                    $('#imaddress').show();

                } else if ($(this).prop("checked") == false) {
                    $('#check').hide();
                    $('#imaddress').hide();
                }
            });
        });


        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function isNumber(evt) {
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
        $('.decimals').keyup(function() {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.-]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.-+$/, "");
            }
            $(this).val(val);
        });

        function call_keyup() {
            $(".itemname_class").keyup(function() {
                var total = $(this).attr('data-id');
                $("#itemname" + total).autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "<?php echo base_url(); ?>purchase/autocomplete_itemname",
                            data: {
                                keyword: $("#itemname" + total).val()
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
                        $('#itemname' + total).val(ui.item.value);
                        $.post('<?php echo base_url(); ?>purchase/get_itemnames', {
                            name: name
                        }, function(rest) {
                            var obj = jQuery.parseJSON(rest);
                            $('#hsnno' + total).val(obj.hsnno);
                            $('#priceType' + total).val(obj.priceType);
                            $('#itemno' + total).val(obj.itemno);
                            $('#rate' + total).val(obj.price);
                            $('#sgst' + total).val(obj.sgst);
                            $('#cgst' + total).val(obj.cgst);
                            $('#igst' + total).val(obj.igst);
                            $('#uom' + total).val(obj.uom);
                            $('#qty' + total).val('');
                            $('#qty' + total).focus();
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
            $('.qty_class').keyup(function() {
                var rowNumber = $(this).attr('data-id');
                var priceType = $("#priceType" + rowNumber).val();
                var qty = $('#qty' + rowNumber + '').val();
                var potype = $("#potype").val();
                if (potype == 'BOM') {
                    var qty = (isNaN($("#qty" + rowNumber).val())) ? 0 : $("#qty" + rowNumber).val();
                    var bomqty = $("#bomqty" + rowNumber).val();
                    if (parseFloat(qty) > parseFloat(bomqty)) {
                        alert("Invalid Qty");
                        $(this).val("0");
                        $(this).focus();
                    }
                }
                if (qty != '') {
                    if (priceType == "Inclusive") {
                        Inc_amount_calculation(rowNumber);
                    } else {
                        calculations(rowNumber);
                    }
                    //frieght_calculation();
                    // totalAmt_calculation();
                } else {
                    $('#qty_valid' + rowNumber + '').html('<span><font color="red">Invalid Qty !</span>');
                    var oldQty = $("#qtys" + rowNumber).val();
                    $('#qty' + rowNumber + '').val(oldQty);
                    $('#qty_valid' + rowNumber + '').html('');
                    if (priceType == "Inclusive") {
                        Inc_amount_calculation(rowNumber);
                    } else {
                        calculations(rowNumber);
                    }
                    // totalAmt_calculation();
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
                        calculations(rowNumber);
                    }
                    //frieght_calculation();
                    // totalAmt_calculation();
                } else {
                    $('#rate_valid' + rowNumber + '').html('<span><font color="red">Invalid Rate !</span>');
                    $('#rate_valid' + rowNumber + '').val('');
                }
            });

            //Weight Change Function

              $('.weight_class').keyup(function() {
                var rowNumber = $(this).attr('data-id');
                var priceType = $("#priceType" + rowNumber).val();
                var rate = $('#rate' + rowNumber + '').val();
             

                if (parseFloat(rate) > 0) {
                    if (priceType == "Inclusive") {
                        Inc_amount_calculation(rowNumber);
                    } else {
                        calculations(rowNumber);
                    }
                    //frieght_calculation();
                    // totalAmt_calculation();
                }
            });
            // DISCOUNT CHANGE FUNCTION
            $('.discount_class').keyup(function() {
                var rowNumber = $(this).attr('data-id');
                var priceType = $("#priceType" + rowNumber).val();
                $('#discount_valid' + rowNumber + '').html('');
                var discount = $('#discount' + rowNumber + '').val();
                if (discount != '') {
                    if (priceType == "Inclusive") {
                        Inc_amount_calculation(rowNumber);
                    } else {
                        calculations(rowNumber);
                    }
                    //frieght_calculation();
        
                } else {
                    $('#discount_valid' + rowNumber + '').html('<span><font color="red">Invalid Discount !</span>');
                    var oldDisc = $("#oldDisc" + rowNumber).val();
                    $('#discount' + rowNumber + '').val('0');
                    $('#discount_valid' + rowNumber + '').html('');
                    if (priceType == "Inclusive") {
                        Inc_amount_calculation(rowNumber);
                    } else {
                        calculations(rowNumber);
                    }
                 
                }
            });
            //calculation--------------------------------------------------

            $('#freightamount').keyup(function() {     
                calculations();
            });



            $('#loadingamount').keyup(function() {           
                calculations();
            });


            	$('#cgst').keyup(function() {
					var cgst = $('#cgst').val();
					$('#sgst').val(cgst);
					calculations();
				});

                
				$('#igst').keyup(function() {
					calculations();
				});


            $('#roundOff').keyup(function() {
                calculations();
            });

            $('#othercharges').keyup(function() {
                //amount_calculation();
                //frieght_calculation();
                calculations();
            });
            //REMOVE FUNCTION
            $('.remove').click(function() {
                $(this).parents('tr').remove();
                calculations();
            });
        }

        function calculations(rowNumber) {
            var qty = $('#qty' + rowNumber).val();
            var rate = $('#rate' + rowNumber).val();
            var weight = $('#weight' + rowNumber).val();

            console.log(weight);

            if (qty != '' && rate != '' && weight!='')
                var amo = parseFloat(rate) * parseFloat(qty) * parseFloat(weight);
            var amou = amo.toFixed(2);
            $('#amount' + rowNumber).val(amou);
            $('#taxableamount' + rowNumber).val(amou);
            $('#total' + rowNumber).val(amou);

            var discount = $('#discount' + rowNumber).val();
            // var cgst = $('#cgst' + rowNumber).val();
            // var sgst = $('#sgst' + rowNumber).val();
            // var igst = $('#igst' + rowNumber).val();


       var taxableamount = $('#taxableamount' + rowNumber + '').val();
		var gsttype = $('#gsttype').val();

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
		var cgst = $('#cgst').val();
		var sgst = $('#sgst').val();
		var igst = $('#igst').val();
		var roundOff = $('#roundOff').val();
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





		if (discount > 0) {

			a = ((parseFloat(amo) * parseFloat(discount)) / 100);
			var a1 = a.toFixed(2);
			var a2 = parseFloat(amo) - parseFloat(a1);
			var a3 = a2.toFixed(2);
			k = a3;
			$('#discountamount' + rowNumber + '').val(a1);
			$('#taxableamount' + rowNumber + '').val(a3);
			$('#total' + rowNumber + '').val(a3);
		}


		var sub_tot = 0;
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

				n = parseFloat(sub_tot) + parseFloat(h1) + parseFloat(loadingamount) + parseFloat(freightamount);
				var n1 = n.toFixed(2);
				$('#grandtotal').val(n1);
			}


			if (roundOff > 0) {
				l = parseFloat(sub_tot) + parseFloat(h1) + parseFloat(loadingamount) + parseFloat(freightamount) + parseFloat(roundOff);
				l1 = l.toFixed(2);
				$('#grandtotal').val(l1);
			}


		}
        }




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


<script>
$(document).ready(function(){

    // Make text-like inputs and textarea readonly + grey background
    $("#myform input[type='text'], #myform input[type='number'],  #myform input[type='email'],  #myform input[type='password'],  #myform textarea")
        .prop("readonly", true)
        .css("background-color", "#e0e0e0"); // light grey

    // Disable selects, radio buttons, checkboxes, file inputs, and buttons
    $("#myform select,  #myform input[type='radio'],   #myform input[type='checkbox'],  #myform input[type='file'],  #myform button,  #myform input[type='button'],  #myform input[type='submit']")
        .prop("disabled", true);

});



</script>




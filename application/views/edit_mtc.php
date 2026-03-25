<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.css">
<style>
    #compositionModal,
    #mechanicalModal {
        margin-top: 17px;
    }

    #compositionModal table,
    #mechanicalModal table {
        border-collapse: collapse;
        border: 1px solid #000;
    }

    #compositionModal tr th,
    #compositionModal tr td,
    #mechanicalModal tr th,
    #mechanicalModal tr td {
        border: 1px solid #000;
        border-collapse: collapse;
    }

    #compositionModal tr td,
    #mechanicalModal tr td {
        padding: 0;
    }

    #compositionModal .form-control,
    #mechanicalModal .form-control {
        border: none !important;
        background-color: #fff !important;
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i>Edit MTC
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <form id="gradeForm">
                                <input type="hidden" name="id" id="id" value="<?php echo $edit->id; ?>">
                                <div class="row" style="margin:10px 0;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">TCNO</label>
                                            <input type="text" class="form-control" name="tcno" autocomplete="off" id="tcno" value="<?php echo $edit->tcno; ?>" readonly>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">TC Date</label>
                                            <input type="text" class="form-control" name="tc_date" autocomplete="off" id="tc_Date" value="<?php echo $edit->tcdate; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Customer Name</label>
                                            <input type="text" class="form-control" name="customername" autocomplete="off" id="customername" value="<?php echo $edit->customername; ?>">
                                            <input type="hidden" class="form-control" name="customerid" id="customerid" value="<?php echo $edit->customerid; ?>">
                                            <div id="cusname_valid" style="position: absolute;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Purchase Order No</label>
                                            <select name="purchase_order_no" id="purchase_order_no" class="form-control" onchange="getpurchaseorderdetails()"></select>
                                        </div>
                                
                                        
                                         <input type="hidden" class="form-control" name="purchase_order" id="purchase_order" value="<?php echo $edit->purchaseorder; ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Specification / Grade</label>
                                            <?php $grades = $this->db->get('grade')->result(); ?>
                                            <select name="grade" id="grade" class="form-control" onchange="getgradedetails()">
                                                <option value="">Select Grade</option>
                                                <?php foreach ($grades as $g) { ?>
                                                    <option value="<?php echo $g->id; ?>"><?php echo $g->grade; ?></option>
                                                <?php } ?>
                                            </select>
                                            <script>
                                                document.getElementById('grade').value = "<?php echo $edit->grade; ?>";
                                            </script>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Heat No</label>
                                            <input type="text" class="form-control" name="heat_no" autocomplete="off" id="heat_no" value="<?php echo $edit->heatno; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Heat Treatment</label>
                                            <input type="text" class="form-control" name="heat_treatment" autocomplete="off" id="heat_treatment" value="<?php echo $edit->heat_treatment; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Product Code</label>
                                            <input type="text" class="form-control" name="product_code" autocomplete="off" id="product_code" value="<?php echo $edit->product_code; ?>">

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <input type="text" class="form-control" name="itemname" autocomplete="off" id="itemname" value="<?php echo htmlspecialchars($edit->itemname); ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Drawing No</label>
                                            <input type="text" class="form-control" name="drawingno" autocomplete="off" id="drawingno" value="<?php echo $edit->drawing_no; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Part No</label>
                                            <input type="text" class="form-control" name="partno" autocomplete="off" id="partno" value="<?php echo $edit->partno; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Poured Qty</label>
                                            <input type="text" class="form-control" name="poured_qty" autocomplete="off" id="poured_qty" value="<?php echo $edit->poured_qty; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div id="compositionModal">
                                            <div>
                                                <h4 style="margin-bottom: 17px;color: #000;">Chemical Composition Details
                                                </h4>
                                            </div>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Element</th>
                                                        <th>Min Value</th>
                                                        <th>Max Value</th>
                                                        <th>Actual</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $chemicalelement = explode(',', $edit->chemical_element);
                                                    $chemicalminvalue = explode(',', $edit->chemical_minvalue);
                                                    $chemicalmaxvalue = explode(',', $edit->chemical_maxvalue);
                                                    $chemicalactualvalue = explode(',', $edit->chemical_actualvalue);
                                                    $count = count($chemicalelement);

                                                    for ($i = 0; $i < $count; $i++) { ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="chemical_element[]" id="chemicalelement<?php echo $i; ?>" value="<?php echo $chemicalelement[$i]; ?>"></td>
                                                            <td><input type="text" class="form-control" name="chemical_minvalue[]" id="minvalue<?php echo $i; ?>" value="<?php echo $chemicalminvalue[$i]; ?>"></td>
                                                            <td><input type="text" class="form-control" name="chemical_maxvalue[]" id="maxvalue<?php echo $i; ?>" value="<?php echo $chemicalmaxvalue[$i]; ?>"></td>
                                                            <td><input type="text" class="form-control" name="chemical_actualvalue[]" id="actualvalue<?php echo $i; ?>" value="<?php echo $chemicalactualvalue[$i]; ?>"></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div id="mechanicalModal">
                                            <div>
                                                <h4 style="margin-bottom: 17px;color: #000;">Mechanical Properties Details
                                                </h4>
                                            </div>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Element</th>
                                                        <th>Min Value</th>
                                                        <th>Max Value</th>
                                                        <th>Actual</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="mechanicalTableBody">
                                                    <?php
                                                    $mechanicalelement = explode(',', $edit->mechanical_element);
                                                    $mechanical_minvalue = explode(',', $edit->mechanical_minvalue);
                                                    $mechanicalmaxvalue = explode(',', $edit->mechanical_maxvalue);
                                                    $mechanicalactualvalue = explode(',', $edit->mechanical_actualvalue);
                                                    $count = count($mechanicalelement);

                                                    for ($i = 0; $i < $count; $i++) { ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="mechanical_element[]" id="mechanicalelement<?php echo $i; ?>" value="<?php echo $mechanicalelement[$i]; ?>" readonly></td>
                                                            <td><input type="text" class="form-control" name="mechanical_minvalue[]" id="mechanicalminvalue<?php echo $i; ?>" value="<?php echo $mechanical_minvalue[$i]; ?>"></td>
                                                            <td><input type="text" class="form-control" name="mechanical_maxvalue[]" id="mechanicalmaxvalue<?php echo $i; ?>" value="<?php echo $mechanicalmaxvalue[$i]; ?>"></td>
                                                            <td><input type="text" class="form-control" name="mechanical_actualvalue[]" id="mechanicalactualvalue<?php echo $i; ?>" value="<?php echo $mechanicalactualvalue[$i]; ?>"></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="margin: 25px 0 30px 0;">
                                        <h4 style="margin-bottom: 17px;color: #000;">Remarks</h4>
                                        <textarea id="summernote" name="remarks"><?php echo $edit->remarks; ?></textarea>
                                    </div> <br><br>

                                    <div class="col-md-12 text-center mt-5">
                                        <button class="btn btn-info" id="submit" name="save" value="save">Update MTC</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $('#tc_Date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 200,
            placeholder: 'Remarks...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            lineHeights: [
                '0.3', '0.4', '0.5', '1.0', '1.5', '2.0', '2.5', '3.0'
            ]
        });
    });
</script>

<script>
    $(document).ready(function() {

            var name = $(this).val();
            var customerid = $('#customerid').val();

            if (customerid != "") {
                $.ajax({
                    url: "<?php echo base_url(); ?>Supplier_purchaseorder/getworkorderno",
                    type: "POST",
                    dataType: "json",
                    data: {
                        name: name,
                        customerid: customerid
                    },
                    success: function(data) {
                        var options = '<option value="">Select Purchase Order</option>';
                        $.each(data, function(index, item) {
                            options += '<option value="' + item.purchaseorderno + '">' + item.purchaseorderno + '</option>';
                        });
                        $('#purchase_order_no').html(options);
                            var selectedVal = "<?php echo $edit->purchaseorderno; ?>";
                            $('#purchase_order_no').val(selectedVal);                        
                    }
                });
            }

        $("#customername").autocomplete({
            appendTo: '#cusname_valid',
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
                            $('#submit').attr('disabled', true); 
                            $('#print').attr('disabled', true); 
                        }
                    });
                    return false;
                }
            }
        });


        $('#customername').blur(function() {
            var name = $(this).val();
            var customerid = $('#customerid').val();
            if (customerid != "") {
                $.ajax({
                    url: "<?php echo base_url(); ?>Supplier_purchaseorder/getworkorderno",
                    type: "POST",
                    dataType: "json",
                    data: {
                        name: name,
                        customerid: customerid
                    },
                    success: function(data) {
                        var options = '<option value="">Select Purchase Order</option>';
                        $.each(data, function(index, item) {
                            options += '<option value="' + item.purchaseorderno + '">' + item.purchaseorderno + '</option>';
                        });
                        $('#purchase_order_no').html(options);
                    }
                });
            }
        });

    });

    function getpurchaseorderdetails() {
        var pono = $('#purchase_order_no').val();
        if (pono != "") {
            $.post('<?php echo base_url(); ?>Mtc/getpodetails', {
                pono: pono
            }, function(res) {
                var obj = jQuery.parseJSON(res);
                $('#product_code').val(obj.itemcode);
                $('#itemname').val(obj.itemname);
                $('#drawingno').val(obj.drawingno);
            });
        }
    }

    function getgradedetails() {
        var grade = $('#grade').val();
        if (grade != "") {
            $.post('<?php echo base_url(); ?>Mtc/getgradedetails', {
                grade: grade
            }, function(data) {
                var obj = jQuery.parseJSON(data);
                $('#heat_treatment').val(obj.heat_treatment);
                if ($('#summernote').length && typeof $().summernote === 'function') {
                    $('#summernote').summernote('code', obj.remarks);
                } else {
                    $('#summernote').val(obj.remarks); 
                }

                var elements = obj.element.split(',');
                var min_values = obj.min_value.split(',');
                var max_values = obj.max_value.split(',');
                var actual_values = obj.actual_value ? obj.actual_value.split(',') : [];

                for (var i = 0; i < 15; i++) {
                    var rowIndex = i + 1;
                    $('#element' + rowIndex).val(elements[i] || '');
                    $('#minvalue' + rowIndex).val(min_values[i] || '');
                    $('#maxvalue' + rowIndex).val(max_values[i] || '');
                    $('#actualvalue' + rowIndex).val(actual_values[i] || '');
                }
                populateMechanicalProperties(obj);
            });
        }
    }


    function populateMechanicalProperties(obj) {
        var elements = obj.mechanicalelement.split(',');
        var min_values = obj.mechanicalminvalue.split(',');
        var max_values = obj.mechanicalmaxvalue.split(',');
        var actual_values = obj.mechanicalactualvalue ? obj.mechanicalactualvalue.split(',') : [];

        for (var i = 0; i < elements.length; i++) {
            var rowIndex = i + 1;
            $('#mechanicalelement' + rowIndex).val(elements[i] || '');
            $('#mechanicalminvalue' + rowIndex).val(min_values[i] || '');
            $('#mechanicalmaxvalue' + rowIndex).val(max_values[i] || '');
            $('#mechanicalactualvalue' + rowIndex).val(actual_values[i] || '');
        }
    }


    $('#submit').click(function(e) {
        e.preventDefault(); 
        $('#summernote').val($('#summernote').summernote('code'));

        $.ajax({
            url: '<?php echo base_url(); ?>Mtc/update_mtc',
            type: 'POST',
            data: $('#gradeForm').serialize(),
            success: function(res) {
                alert('MTC saved successfully!');
                window.location.href = "<?php echo base_url(); ?>Mtc/reports_mtc";
            },
            error: function() {
                alert('Error saving MTC. Please try again.');
            }
        });
    });

</script>



<script>
      $(document).ready(function(){
    var customerid = $('#customerid').val();
    var editPurchaseOrder = "<?php echo $edit->purchaseorderno; ?>";

    if (customerid != "") {
        $.ajax({
            url: "<?php echo base_url(); ?>Supplier_purchaseorder/getworkordernoformtc",
            type: "POST",
            dataType: "json",
            data: { customerid: customerid },
            success: function(data) {

                var options = '<option value="">Select Purchase Order</option>';
                $.each(data, function(index, item) {
                    options += '<option value="' + item.purchaseorder + '">' + item.purchaseorder + '</option>';
                });

                $('#purchase_order_no').html(options);

                // ✅ SET VALUE AFTER OPTIONS EXIST
                $('#purchase_order_no').val(editPurchaseOrder);
            }
        });
    }
});

</script>
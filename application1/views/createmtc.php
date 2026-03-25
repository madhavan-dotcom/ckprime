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
        border: 1px solid #d3d3d3;
    }

    #compositionModal tr th,
    #compositionModal tr td,
    #mechanicalModal tr th,
    #mechanicalModal tr td {
        border: 1px solid #d3d3d3;
        border-collapse: collapse;
    }

    #compositionModal tr td,
    #mechanicalModal tr td {
        padding: 5px;
        text-align: -webkit-center;
        background: #f0f0f1;
        border: 1px solid #d3d3d3;

    }

    #compositionModal .form-control,
    #mechanicalModal .form-control {
        background-color: #fff !important;
        width: 98%;
    }

    .note-btn-group .dropdown-menu {
        background-color: #fff !important;
        padding: 3px !important;
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
                                <i class="fa fa-reorder"></i>Create MTC
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <form id="gradeForm">
                                <div class="row" style="margin:10px 0;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">TCNO</label>
                                            <input type="text" class="form-control" name="tcno" autocomplete="off" id="tcno" value="<?php echo $tcno; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">TC Date</label>
                                            <input type="text" class="form-control" name="tc_date" autocomplete="off" id="tc_Date">
                                        </div>
                                    </div>





                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Customer Name</label>
                                            <input type="text" class="form-control" name="customername" autocomplete="off" id="customername">
                                            <input type="hidden" class="form-control" name="customerid" id="customerid" value="">
                                            <div id="cusname_valid" style="position: absolute;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Purchase Order No</label>
                                            <select name="purchase_order_no" id="purchase_order_no" class="form-control" onchange="getpurchaseorderdetails()">

                                            </select>
                                            <input type="hidden" class="form-control" name="purchase_order" id="purchase_order">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Specification / Grade</label>
                                            <?php $grade = $this->db->where('status', 1)->get('grade')->result(); ?>

                                            <select name="grade" id="grade" class="form-control" onchange="getgradedetails()">
                                                <option value="">Select Grade</option>
                                                <?php foreach ($grade as $g) { ?>
                                                    <option value="<?php echo $g->id; ?>"><?php echo $g->grade; ?></option>

                                                <?php } ?>


                                            </select>


                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Heat No</label>
                                            <select name="heat_no" id="heat_no" class="form-control" onchange="get_heatno()">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Heat Treatment</label>
                                            <input type="text" class="form-control" name="heat_treatment" autocomplete="off" id="heat_treatment">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Product Code</label>
                                            <input type="text" class="form-control" name="product_code" autocomplete="off" id="product_code">

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <input type="text" class="form-control" name="itemname" autocomplete="off" id="itemname">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Drawing No</label>
                                            <input type="text" class="form-control" name="drawingno" autocomplete="off" id="drawingno">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Part No</label>
                                            <input type="text" class="form-control" name="partno" autocomplete="off" id="partno">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Poured Qty</label>
                                            <input type="text" class="form-control" name="poured_qty" autocomplete="off" id="poured_qty">

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
                                                <tbody id="compositionTableBody">
                                                    <?php for ($i = 1; $i <= 15; $i++) { ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="chemical_element[]" id="element<?php echo $i; ?>"></td>
                                                            <td><input type="text" class="form-control" name="chemical_minvalue[]" id="min_value<?php echo $i; ?>"></td>
                                                            <td><input type="text" class="form-control" name="chemical_maxvalue[]" id="max_value<?php echo $i; ?>"></td>
                                                            <td><input type="text" class="form-control" name="chemical_actualvalue[]" id="actual_value<?php echo $i; ?>"></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <?php
                                    $mechanicalElements = [
                                        "Yield Strength",
                                        "Tensile Strength",
                                        "% Elongation",
                                        "% Reduction of Area",
                                        "Hardness",
                                        "Bend Test",
                                        "Impact Test in Joules"
                                    ];
                                    ?>

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
                                                    <?php foreach ($mechanicalElements as $i => $element) { ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="mechanical_element[]" id="mechanicalelement<?php echo $i + 1; ?>" value="<?php echo $element; ?>" readonly></td>
                                                            <td><input type="text" class="form-control" name="mechanical_minvalue[]" id="mechanicalminvalue<?php echo $i + 1; ?>"></td>
                                                            <td><input type="text" class="form-control" name="mechanical_maxvalue[]" id="mechanicalmaxvalue<?php echo $i + 1; ?>"></td>

                                                            <td><input type="text" class="form-control" name="mechanical_actualvalue[]" id="mechanicalactualvalue<?php echo $i + 1; ?>"></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="margin: 25px 0 30px 0;">
                                        <h4 style="margin-bottom: 17px;color: #000;">Remarks</h4>
                                        <textarea id="summernote" name="remarks"></textarea>
                                    </div> <br><br>




                                    <div class="col-md-12 text-center mt-5">
                                        <button class="btn btn-info" id="submit" name="save" value="save">Save MTC</button>

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
            ],
            callbacks: {
                onInit: function() {
                    // Set default font size to 12px
                    $('#summernote').summernote('fontSize', 12);
                }
            }
        });
    });
    
    
    $(window).on('load', function () {
    $('html, body').scrollTop(0);
    });
    

</script>

<script>
    $(document).ready(function() {
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
                            $('#submit').attr('disabled', true); //set button enable 
                            $('#print').attr('disabled', true); //set button enable 
                            //set button enable     
                        }
                    });
                    return false;
                }
            }
        });


        $('#customername').blur(function() {
            var customerid = $('#customerid').val();

            if (customerid != "") {
                $.ajax({
                    url: "<?php echo base_url(); ?>Supplier_purchaseorder/getworkordernoformtc",
                    type: "POST",
                    dataType: "json",
                    data: {
                        customerid: customerid
                    },
                    success: function(data) {
                        var options = '<option value="">Select Purchase Order</option>';
                        $.each(data, function(index, item) {
                            console.log(item.purchaseorder);
                            console.log(item.purchaseorderno);
                            options += '<option value="' + item.purchaseorder + '">' + item.purchaseorder + '</option>';
                            $('#purchase_order').val(item.purchaseorderno);
                        });
                        $('#purchase_order_no').html(options);
                    }
                });
            }
        });





    });
    
    

</script>



<script>
    function getpurchaseorderdetails() {
        var pono = $('#purchase_order_no').val();

        if (pono != "") {
            $.post('<?php echo base_url(); ?>Mtc/getpodetails', {
                pono: pono,
            }, function(res) {
                var data = JSON.parse(res);

                var options = '<option value="">Select Heat No</option>';
                $.each(data, function(index, item) {
                    options += '<option value="' + item.heatno + '">' + item.heatno + '</option>';
                });

                $('#heat_no').html(options);

                if (data.length > 0) {
                    // $('#product_code').val(data[0].itemcode);
                    // $('#itemname').val(data[0].itemname);
                    // $('#drawingno').val(data[0].drawingno);
                }
            });
        }
    }

    function get_heatno() {
        var heatno = $('#heat_no').val();
        console.log(heatno);

        $.post("<?php echo base_url(); ?>Mtc/get_heatno", {
            name: heatno
        }, function(rest) {

            var obj = jQuery.parseJSON(rest);

            if (obj.balance !== undefined) {
                $("#poured_qty").val(obj.balance);
                $('#product_code').val(obj.itemcode);
                $('#itemname').val(obj.itemname);
                $('#drawingno').val(obj.drawingno);
            } else {
                $("#poured_qty").val('');
            }
        });
    }



    function getgradedetails() {
        var grade = $('#grade').val();
        if (grade != "") {
            $.post('<?php echo base_url(); ?>Mtc/getgradedetails', {
                grade: grade
            }, function(data) {
                var obj = jQuery.parseJSON(data);

                // Populate heat treatment
                $('#heat_treatment').val(obj.heat_treatment);

                // Populate Summernote textarea
                if ($('#summernote').length && typeof $().summernote === 'function') {
                    $('#summernote').summernote('code', obj.remarks);
                } else {
                    $('#summernote').val(obj.remarks); // fallback
                }

                // Split the comma-separated values
                var elements = obj.element.split(',');
                var min_values = obj.min_value.split(',');
                var max_values = obj.max_value.split(',');
                var actual_values = obj.actual_value ? obj.actual_value.split(',') : [];

                // Fill the table rows
                for (var i = 0; i < 15; i++) {
                    var rowIndex = i + 1;

                    $('#element' + rowIndex).val(elements[i] || '');
                    $('#min_value' + rowIndex).val(min_values[i] || '');
                    $('#max_value' + rowIndex).val(max_values[i] || '');
                    $('#actual_value' + rowIndex).val(actual_values[i] || '');
                }


                populateMechanicalProperties(obj);
            });
        }
    }



    function populateMechanicalProperties(obj) {
        // Split the comma-separated values
        var elements = obj.mechanicalelement.split(',');
        var min_values = obj.mechanicalminvalue.split(',');
        var max_values = obj.mechanicalmaxvalue.split(',');
        var actual_values = obj.mechanicalactualvalue ? obj.mechanicalactualvalue.split(',') : [];

        // Fill the table rows
        for (var i = 0; i < elements.length; i++) {
            var rowIndex = i + 1;

            $('#mechanicalelement' + rowIndex).val(elements[i] || '');
            $('#mechanicalminvalue' + rowIndex).val(min_values[i] || '');
            $('#mechanicalmaxvalue' + rowIndex).val(max_values[i] || '');
            $('#mechanicalactualvalue' + rowIndex).val(actual_values[i] || '');
        }
    }



    $('#submit').click(function(e) {
        e.preventDefault(); // prevent normal form submit
        // Update summernote textarea
        $('#summernote').val($('#summernote').summernote('code'));

        $.ajax({
            url: '<?php echo base_url(); ?>Mtc/save_mtc',
            type: 'POST',
            data: $('#gradeForm').serialize(),
            success: function(res) {
                alert('MTC saved successfully!');
                location.reload(); // or redirect
            }
        });
    });
</script>
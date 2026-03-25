<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.css">
<style>
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
                                <i class="fa fa-reorder"></i>Create Ultrosonic Test Report
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <form id="gradeForm">
                                <div class="row" style="margin:10px 0;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">UT Report No</label>
                                            <input type="text" class="form-control" name="ut_report_no" autocomplete="off" id="ut_report_no" value="<?php echo $edit->ut_report_no; ?>">
                                            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $edit->id;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Date</label>
                                            <input type="text" class="form-control" name="ut_date" autocomplete="off" id="ut_Date" value="<?php echo $edit->ut_date; ?>">
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
                                            <label class="control-label">Stage of Test</label>
                                            <input type="text" class="form-control" name="stage_of_test" autocomplete="off" id="stage_of_test" value="<?php echo $edit->stage_of_test; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Date of Test</label>
                                            <input type="text" class="form-control" name="test_date" autocomplete="off" id="test_date" value="<?php echo $edit->test_date; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Surface Condition</label>
                                            <input type="text" class="form-control" name="surface_condition" autocomplete="off" id="surface_condition" value="<?php echo $edit->surface_condition; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Calibration Block</label>
                                            <input type="text" class="form-control" name="calibration_block" autocomplete="off" id="calibration_block" value="<?php echo $edit->calibration_block; ?>">

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Equipment</label>
                                            <input type="text" class="form-control" name="equipment" autocomplete="off" id="equipment" value="<?php echo $edit->equipment; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Couplant</label>
                                            <input type="text" class="form-control" name="couplant" autocomplete="off" id="couplant" value="<?php echo $edit->couplant; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Probe</label>
                                            <input type="text" class="form-control" name="probe" autocomplete="off" id="probe" value="<?php echo $edit->probe; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Range of CRT</label>
                                            <input type="text" class="form-control" name="range_of_crt" autocomplete="off" id="range_of_crt" value="<?php echo $edit->range_of_crt; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Frequency</label>
                                            <input type="text" class="form-control" name="frequency" autocomplete="off" id="frequency" value="<?php echo $edit->frequency; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Gain</label>
                                            <input type="text" class="form-control" name="gain" autocomplete="off" id="gain" value="<?php echo $edit->gain; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Area Coverage</label>
                                            <input type="text" class="form-control" name="area_coverage" autocomplete="off" id="area_coverage" value="<?php echo $edit->area_coverage; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Procedure Ref</label>
                                            <input type="text" class="form-control" name="procedure_ref" autocomplete="off" id="procedure_ref" value="<?php echo $edit->procedure_ref; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Acceptance Standard</label>
                                            <input type="text" class="form-control" name="acceptance_standard" autocomplete="off" id="acceptance_standard" value="<?php echo $edit->acceptance_standard; ?>">

                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin:50px 0 10px 0;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <input type="text" class="form-control" name="description" autocomplete="off" id="itemname" value="<?php echo $edit->description; ?>">
                                            <input type="hidden" class="form-control" name="itemid" autocomplete="off" id="itemid" value="<?php echo $edit->itemid; ?>">
                                            <div id="itemname_valid" style="position: absolute;"></div>



                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Drawing</label>
                                            <input type="text" class="form-control" name="drawing" autocomplete="off" id="drawingno" value="<?php echo $edit->drawing; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Grade</label>
                                            <?php $grade = $this->db->where('status', 1)->get('grade')->result(); ?>


                                            <select class="form-control" name="grade" id="grade">
                                                <option value="">Select Grade</option>
                                                <?php foreach ($grade as $g) { ?>
                                                    <option value="<?php echo $g->id; ?>" <?php echo ($g->id == $edit->grade) ? 'selected' : ''; ?>><?php echo $g->grade; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Heat No</label>
                                            <input type="text" class="form-control" name="heat_no" autocomplete="off" id="heat_no" value="<?php echo $edit->heat_no; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">U.T. No</label>
                                            <input type="text" class="form-control" name="ut_no" autocomplete="off" id="ut_no" value="<?php echo $edit->ut_no; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Result</label>
                                            <input type="text" class="form-control" name="result" autocomplete="off" id="result" value="<?php echo $edit->result; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-info" id="submit" name="save" value="save">Save UT</button>
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
<script src="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $('#ut_Date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom auto"
        });
    });

    $(document).ready(function() {
        $('#test_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom auto"
        });
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



        $("#itemname").autocomplete({
            appendTo: '#itemname_valid',
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo base_url(); ?>Mtc/autocomplete_itemname",
                    data: {
                        keyword: $("#itemname").val()
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $("#itemname").val(ui.item.label);
                $('#itemid').val(ui.item.itemid);
                $('#drawingno').val(ui.item.drawingno);


            }
        });


        $('#submit').click(function(e) {
            e.preventDefault();



            $.ajax({
                url: '<?php echo base_url(); ?>Mtc/update_ut',
                type: 'POST',
                data: $('#gradeForm').serialize(),
                success: function(res) {
                    alert('Ut Updated successfully !');
                    window.location.href = "<?php echo base_url(); ?>Mtc/ut_reports";
                }
            })
        });


    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.css">
<style>
    .note-btn-group .dropdown-menu {
        /*background-color: #fff !important;*/
        padding: 3px !important;
    }

    .add-btn {
        background-color: #28a745;
        color: white;
    }

    .delete-btn {
        background-color: #dc3545;
        color: white;
    }

    .add-btn:hover,
    .delete-btn:hover,
    .add-btn:focus,
    .delete-btn:focus {
        color: #fff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"] {
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }

    table input {
        border: none;
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
                                <i class="fa fa-reorder"></i>Create DYE - Penetrant Inspection Report
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <form id="dptForm">
                                <div class="row" style="margin:10px 0;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">DPT Report No</label>
                                            <input type="text" class="form-control" name="dpt_report_no" autocomplete="off" id="dpt_report_no" value="<?php echo $dptno;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Date</label>
                                            <input type="text" class="form-control" name="dpt_date" autocomplete="off" id="dpt_date">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Customer</label>
                                            <input type="text" class="form-control" name="customername" autocomplete="off" id="customername">
                                            <input type="hidden" class="form-control" name="customerid" id="customerid" value="">
                                            <div id="cusname_valid" style="position: absolute;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Report</label>
                                            <input type="text" class="form-control" name="report_no" autocomplete="off" id="report_no">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Stage of Test</label>
                                            <input type="text" class="form-control" name="stage_of_test" autocomplete="off" id="stage_of_test">
                                        </div>
                                    </div>

                  <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Grade</label>
                                           <?php $grade = $this->db->where('status',1)->get('grade')->result();?>

                                           
                                            <select class="form-control" name="grade"  id="grade">
                                                 <option value="">Select Grade</option>
                                              <?php foreach($grade as $g){?>
                                                   <option value="<?php echo $g->id;?>"><?php echo $g->grade;?></option>
                                                <?php }?>
                                             </select>
                                             

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Type of Penetrant</label>
                                            <input type="text" class="form-control" name="type_of_penetrant" autocomplete="off" id="type_of_penetrant">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Casting Temperature</label>
                                            <input type="text" class="form-control" name="casting_temperature" autocomplete="off" id="casting_temperature">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Type of Developer</label>
                                            <input type="text" class="form-control" name="type_of_developer" autocomplete="off" id="type_of_developer">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Surface Condition</label>
                                            <input type="text" class="form-control" name="surface_condition" autocomplete="off" id="surface_condition">

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Date of Testing</label>
                                            <input type="text" class="form-control" name="testing_date" autocomplete="off" id="testing_date">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Acceptance Standard</label>
                                            <input type="text" class="form-control" name="acceptance_standard" autocomplete="off" id="acceptance_standard">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Dwell Time</label>
                                            <input type="text" class="form-control" name="dwell_time" autocomplete="off" id="dwell_time">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Procedure Ref</label>
                                            <input type="text" class="form-control" name="procedure_ref" autocomplete="off" id="procedure_ref">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Non Fluosrecent / Fluosrecent</label>
                                            <select name="fluosrecent" id="fluosrecent" class="form-control">
                                                <option selected disabled>Select Fluosrecent Type</option>
                                                <option value="Fluosrecent">Fluosrecent</option>
                                                <option value="Non Fluosrecent">Non Fluosrecent</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Area Method of Test</label>
                                            <input type="text" class="form-control" name="area_method_of_test" autocomplete="off" id="area_method_of_test">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Method of Applying Penetrant</label>
                                            <input type="text" class="form-control" name="penetrant_apply_method" autocomplete="off" id="penetrant_apply_method">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Precleaning Method</label>
                                            <input type="text" class="form-control" name="precleaning_method" autocomplete="off" id="precleaning_method">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Post of Test Cleaning</label>
                                            <input type="text" class="form-control" name="post_of_test_cleaning" autocomplete="off" id="post_of_test_cleaning">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Light Indensity</label>
                                            <input type="text" class="form-control" name="light_indensity" autocomplete="off" id="light_indensity">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Background</label>
                                            <input type="text" class="form-control" name="background" autocomplete="off" id="background">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Result</label>
                                            <input type="text" class="form-control" name="result" autocomplete="off" id="result">
                                        </div>
                                    </div>

                                </div>

                                <div class="row" style="margin:50px 0 10px 0;">

                                    <table id="dptTable">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Drawing No</th>
                                                <th>Heat No</th>
                                                <th>DP No</th>
                                                <th>Qty</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="description[]" class="itemname" placeholder="Description"><div class="itemname_valid" style="position: absolute;"></div></td>
                                                <td><input type="text" name="drawing_no[]" placeholder="Drawing No" class="drawingno"></td>
                                                <td><input type="text" name="heat_no[]" placeholder="Heat No"></td>
                                                <td><input type="text" name="dp_no[]" placeholder="DP No"></td>
                                                <td><input type="text" name="qty[]" placeholder="Qty"></td>
                                                <td>
                                                    <button type="button" class="btn add-btn">Add</button>
                                                    <button type="button" class="btn delete-btn">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="col-md-12 text-center" style="margin-top:21px;">
                                        <button class="btn btn-info" id="submit" name="save" value="save">Save
                                            DPT</button>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $('#dpt_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom auto"
        });
    });

    $(document).ready(function() {
        $('#testing_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom auto"
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.add-btn', function() {
            let row = $(this).closest('tr').clone();
            row.find('input').val('');
            $('#formTable tbody').append(row);
        });

        $(document).on('click', '.delete-btn', function() {
            if ($('#formTable tbody tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert("At least one row is required!");
            }
        });
    });
</script>




<script>
 $(document).ready(function() {

    // Function to initialize autocomplete on .itemname fields
    function initAutocomplete(elem) {
        elem.autocomplete({
            appendTo: elem.siblings('.itemname_valid'),
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo base_url(); ?>Mtc/autocomplete_itemname",
                    type: "POST",
                    dataType: "json",
                    data: { keyword: request.term },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                elem.val(ui.item.label);
                elem.closest('tr').find('.drawingno').val(ui.item.drawingno);
            }
        });
    }

    // Initialize autocomplete for the first row
    initAutocomplete($('.itemname'));

    // Add new row
    $(document).on('click', '.add-btn', function() {
        let row = $(this).closest('tr').clone();
        row.find('input').val('');
        $('#dptTable tbody').append(row);

        // Initialize autocomplete for new row’s itemname field
        initAutocomplete(row.find('.itemname'));
    });

    // Delete row
    $(document).on('click', '.delete-btn', function() {
        if ($('#dptTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
        } else {
            alert("At least one row is required!");
        }
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




           $('#submit').click(function(e){
        e.preventDefault();

       

        $.ajax({
            url : '<?php echo base_url(); ?>Mtc/save_dpt',
            type : 'POST',
            data : $('#dptForm').serialize(),
            success : function(res){
                alert('DPT saved successfully !');
                window.location.href = "<?php echo base_url(); ?>Mtc/dpt_reports";
            }
        })
    });    


    });

</script>
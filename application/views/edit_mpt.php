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
                                <i class="fa fa-reorder"></i>Create Magnetic Particle Inspection Report
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <form id="mtcForm">
                                <div class="row" style="margin:10px 0;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">MPT Report No</label>
                                            <input type="text" class="form-control" name="mpt_report_no" autocomplete="off" id="mpt_report_no" value="<?php echo $edit->mpt_report_no;?>">
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $edit->id;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Date</label>
                                            <input type="text" class="form-control" name="mpt_date" autocomplete="off" id="mpt_date" value="<?php echo $edit->mpt_date;?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Customer Name</label>
                                            <input type="text" class="form-control" name="customername" autocomplete="off" id="customername" value="<?php echo $edit->customername;?>"> 
                                            <input type="hidden" class="form-control" name="customerid" id="customerid" value="<?php echo $edit->customerid;?>">
                                            <div id="cusname_valid" style="position: absolute;">
                                            </div>
                                        </div>
                                    </div>

                        

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Grade</label>
                                           <?php $grade = $this->db->where('status',1)->get('grade')->result();?>

                                           
                                            <select class="form-control" name="grade"  id="grade">
                                                 <option value="">Select Grade</option>
                                              <?php foreach($grade as $g){?>
                                                   <option value="<?php echo $g->id;?>" <?php if($g->id == $edit->grade) echo 'selected';?>><?php echo $g->grade;?></option>
                                             </select>
                                             <?php }?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Equipment Make</label>
                                            <input type="text" class="form-control" name="equipment_make" autocomplete="off" id="equipment_make" value="<?php echo $edit->equipment_make;?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Magnetic Powder Color</label>
                                            <input type="text" class="form-control" name="magnetic_powder_color" autocomplete="off" id="magnetic_powder_color" value="<?php echo $edit->magnetic_powder_color;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Type of Equipment</label>
                                            <input type="text" class="form-control" name="equipment_type" autocomplete="off" id="equipment_type" value="<?php echo $edit->equipment_type;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Prod Spacing</label>
                                            <input type="text" class="form-control" name="prod_spacing" autocomplete="off" id="prod_spacing" value="<?php echo $edit->prod_spacing;?>">

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Procedure Ref</label>
                                            <input type="text" class="form-control" name="procedure_ref" autocomplete="off" id="procedure_ref" value="<?php echo $edit->procedure_ref;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Current AMPS</label>
                                            <input type="text" class="form-control" name="current_amps" autocomplete="off" id="current_amps" value="<?php echo $edit->current_amps;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Stage of Test</label>
                                            <input type="text" class="form-control" name="stage_of_test" autocomplete="off" id="stage_of_test" value="<?php echo $edit->stage_of_test;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Magnetisation</label>
                                            <input type="text" class="form-control" name="magnetisation" autocomplete="off" id="magnetisation" value="<?php echo $edit->magnetisation;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Process</label>
                                            <input type="text" class="form-control" name="process" autocomplete="off" id="process" value="<?php echo $edit->process;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Surface Condition</label>
                                            <input type="text" class="form-control" name="surface_condition" autocomplete="off" id="surface_condition" value="<?php echo $edit->surface_condition;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Date of Inspection</label>
                                            <input type="text" class="form-control" name="inspection_date" autocomplete="off" id="inspection_date" value="<?php echo $edit->inspection_date;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Acceptance Standard</label>
                                            <input type="text" class="form-control" name="acceptance_standard" autocomplete="off" id="acceptance_standard" value="<?php echo $edit->acceptance_standard;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Current</label>
                                            <input type="text" class="form-control" name="current" autocomplete="off" id="current" value="<?php echo $edit->current;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Medium</label>
                                            <input type="text" class="form-control" name="medium" autocomplete="off" id="medium" value="<?php echo $edit->medium;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Light Indensity</label>
                                            <input type="text" class="form-control" name="light_indensity" autocomplete="off" id="light_indensity" value="<?php echo $edit->light_indensity;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Non Fluosrecent / Fluosrecent</label>
                                            <select name="fluosrecent" id="fluosrecent" class="form-control">
                                                <option >Select Fluosrecent Type</option>
                                                <option value="Flourecent">Fluosrecent</option>
                                                <option value="Non Fluosrecent">Non Fluosrecent</option>
                                            </select>

                                            <script>document.getElementById('fluosrecent').value = "<?php echo $edit->fluosrecent;?>"</script>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Area of Test</label>
                                            <input type="text" class="form-control" name="area_of_test" autocomplete="off" id="area_of_test" value="<?php echo $edit->area_of_test;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Casting Temp</label>
                                            <input type="text" class="form-control" name="casting_temp" autocomplete="off" id="casting_temp" value="<?php echo $edit->casting_temp;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Demagnetization</label>
                                            <input type="text" class="form-control" name="demagnetization" autocomplete="off" id="demagnetization" value="<?php echo $edit->demagnetization;?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Observation</label>
                                            <input type="text" class="form-control" name="observation" autocomplete="off" id="observation" value="<?php echo $edit->observation;?>">
                                        </div>
                                    </div>

                                </div>

                                <div class="row" style="margin:50px 0 10px 0;">

                                  <table id="mtcTable">
    <thead>
        <tr>
            <th>PO No/Dt</th>
            <th>Description</th>
            <th>Drawing No</th>
            <th>Heat No</th>
            <th>MPI No</th>
            <th>Desp Qty</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $description = explode(',',$edit->description);
    $pono   = explode(',',$edit->po_no_dt);
    $drawingno   = explode(',',$edit->drawing_no);
    $heatno      = explode(',',$edit->heat_no);
    $mpino       = explode(',',$edit->mpi_no);
    $despqty     = explode(',',$edit->desp_qty);

    $count = count($description);

     for ($i = 0; $i < $count; $i++) {?>







    
        <tr>
            <td><input type="text" name="po_no_dt[]" placeholder="PO No/Dt" value="<?php echo $pono[$i];?>"></td>
            <td>
                <input type="text" name="description[]" class="itemname" placeholder="Description" value="<?php echo $description[$i];?>">
                <div class="itemname_valid" style="position: absolute;"></div>
            </td>
            <td><input type="text" name="drawing_no[]" class="drawingno" placeholder="Drawing No" value="<?php echo $drawingno[$i];?>"></td>
            <td><input type="text" name="heat_no[]" placeholder="Heat No" value="<?php echo $heatno[$i];?>"></td>
            <td><input type="text" name="mpi_no[]" placeholder="MPI No" value="<?php echo $mpino[$i];?>"></td>
            <td><input type="text" name="desp_qty[]" placeholder="Desp Qty" value="<?php echo $despqty[$i];?>"></td>
            <td>
                <button type="button" class="btn add-btn">Add</button>
                <button type="button" class="btn delete-btn">Delete</button>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>


                                    <div class="col-md-12 text-center" style="margin-top:21px;">
                                        <button class="btn btn-info" id="submit" name="save" value="save">Save
                                            MPT</button>
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
        $('#mpt_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom auto"
        });
    });

    $(document).ready(function() {
        $('#inspection_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom auto"
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
        $('#mtcTable tbody').append(row);

        // Initialize autocomplete for new row’s itemname field
        initAutocomplete(row.find('.itemname'));
    });

    // Delete row
    $(document).on('click', '.delete-btn', function() {
        if ($('#mtcTable tbody tr').length > 1) {
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
            url : '<?php echo base_url(); ?>Mtc/update_mpt',
            type : 'POST',
            data : $('#mtcForm').serialize(),
            success : function(res){
                alert('MTC saved successfully !');
                window.location.href = "<?php echo base_url(); ?>Mtc/mpt_reports";
            }
        })
    });    


    });

</script>
<?php $data = $this->db->get('profile')->result();
foreach ($data as $r)
?>
<title><?php echo $r->companyname; ?></title>

<link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.css">

<style type="text/css">
    .uppercase {
        text-transform: uppercase;
    }
    .centered-input {
        text-align: center;
    }
    #dimensionModal table {
        width: 100%;
    }
    #dimensionModal th, #dimensionModal td {
        padding: 5px;
        text-align: center;
    }
    .well.collapse.in {
        display: block;
    }
    .well.collapse:not(.in) {
        display: none;
    }
    .table-bordered {
        border: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > td {
        border: 1px solid #ddd;
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container">
            <?php $msg = $this->session->flashdata('msg');
            if ((isset($msg)) && (!empty($msg))) { ?>
                <div class="alert btn-info alert-micro btn-rounded pastel light dark">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print_r($msg); ?>
                </div>
            <?php } ?>

            <?php $msg = $this->session->flashdata('err');
            if ((isset($msg)) && (!empty($msg))) { ?>
                <div class="alert btn-info btn-rounded alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print_r($msg); ?>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption" style="padding-top:8px;">
                                <i class="fa fa-reorder"></i>Edit Inspection Master
                            </div>
                            <div class="tools">
                                <a href="<?php echo base_url('Inspectionmaster'); ?>" class="btn btn" style="color:white;margin-bottom:20px;">
                                    <i class="fa fa-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <div class="well collapse in" id="form_div">
                                <form class="horizontal-form" id="form" method="post" action="<?php echo base_url(); ?>Inspectionmaster/update">
                                    <div class="form-body">
                                        <div class="row">
                                            <input type="hidden" name="id" value="<?php echo $edit['id']; ?>">
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Product code</label>
                                                    <input type="text" class="form-control" name="product_code" autocomplete="off" id="product_code" readonly value="<?php echo htmlspecialchars($edit['product_code']); ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Item Name</label>
                                                    <input type="text" class="form-control" name="itemname" autocomplete="off" id="itemname" value="<?php echo htmlspecialchars($edit['itemname']); ?>">
                                                    <input type="hidden" id="itemid" name="itemid" class="form-control" value="<?php echo htmlspecialchars($edit['itemid']); ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Date</label>
                                                    <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($edit['date'])); ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-12" style="margin-top:10px;">
                                                <div id="dimensionModal">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th width="30%">S.no</th>
                                                                <th width="35%">View</th>
                                                                <th width="35%">Drg.Dim</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="dimensionTableBody">
                                                            <?php 
                                                            // Explode the saved data
                                                            $sno_array = !empty($edit['sno']) ? explode(',', $edit['sno']) : array();
                                                            $view_array = !empty($edit['view']) ? explode(',', $edit['view']) : array();
                                                            $length_array = !empty($edit['length']) ? explode(',', $edit['length']) : array();
                                                            
                                                            // Get the count based on the longest array
                                                            $count = max(count($sno_array), count($view_array), count($length_array));
                                                            
                                                            // If no data exists, create 50 empty rows
                                                            if ($count == 0) {
                                                                $count = 50;
                                                            }
                                                            
                                                            for($i = 0; $i < $count; $i++): 
                                                                $sno_value = isset($sno_array[$i]) ? $sno_array[$i] : ($i + 1);
                                                                $view_value = isset($view_array[$i]) ? $view_array[$i] : '';
                                                                $length_value = isset($length_array[$i]) ? $length_array[$i] : '';
                                                            ?>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" class="form-control centered-input" name="sno[]" value="<?php echo htmlspecialchars($sno_value); ?>" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control centered-input" name="view[]" value="<?php echo htmlspecialchars($view_value); ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control centered-input" name="length[]" value="<?php echo htmlspecialchars($length_value); ?>">
                                                                    </td>
                                                                </tr>
                                                            <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <!--/row-->

                                    </div>
                                    <div class="form-actions fluid">
                                        &nbsp;
                                    </div>
                                    <div class="form-actions text-center">
                                        <button class="btn btn-primary" id="submit" type="submit">Update Inspection Master</button>
                                        <a href="<?php echo base_url('Inspectionmaster'); ?>" class="btn btn-default">Cancel</a>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF EDIT INSPECTION MASTER -->
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/custombox/dist/legacy.min.js"></script>
<script src="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.decimal').keyup(function() {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });

        // Form validation
        $('#submit').click(function(e) {
            var itemname = $('#itemname');
            if (itemname.val() == '') {
                itemname.focus();
                alert('Please enter Item Name');
                return false;
            }
            return true;
        });
    });

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
            $('#product_code').val(ui.item.itemcode);
            return false;
        }
    });
</script>
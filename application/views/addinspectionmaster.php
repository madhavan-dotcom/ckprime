<?php $data = $this->db->get('profile')->result();
foreach ($data as $r)
?>
<title>
    <?php echo $r->companyname; ?>
</title>

<link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.css">

<style type="text/css">
    .uppercase {
        text-transform: uppercase;
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

            <?php $msg = $this->session->flashdata('msg1');
            if ((isset($msg)) && (!empty($msg))) { ?>
                <div class="alert btn-info btn-rounded alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php print_r($msg); ?>
                </div>
            <?php } ?>

            <!-- ADD Grade -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i>Inspection Master Reports
                            </div>
                            <div class="tools">
                                <a href="javascript:void();" data-toggle="collapse" data-target="#form_div" style="color:white;"> <i class="fa fa-plus"></i> Add Inspectionmaster</a>&nbsp;
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <div class="well collapse <?php //if ($id != ""){ echo " in";} 
                                                        ?>" id="form_div">
                                <form class="horizontal-form" id="form" method="post" action="<?php echo base_url(); ?>Inspectionmaster/insert">
                                    <div class="form-body">
                                        <div class="row">


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Product code</label>
                                                    <input type="text" class="form-control" name="product_code" autocomplete="off" id="product_code" readonly>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Item Name</label>
                                                    <input type="text" class="form-control" name="itemname" autocomplete="off" id="itemname">
                                                    <input type="hidden" id="itemid" name="itemid" class="form-control">

                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div id="dimensionModal">

                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>S.no</th>
                                                                <th>View</th>
                                                                <th>Drg.Dim </th>
                                                            </tr>
                                                        </thead>

                                                        <?php
                                                        // Example data (replace this array with data fetched from your database)
                                                        $rows = [
                                                            ['sno' => 1, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 2, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 3, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 4, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 5, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 6, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 7, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 8, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 9, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 10, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 11, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 12, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 13, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 14, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 15, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 16, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 17, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 18, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 19, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 20, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 21, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 22, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 23, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 24, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 25, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 26, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 27, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 28, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 29, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 30, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 31, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 32, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 33, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 34, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 35, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 36, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 37, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 38, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 39, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 40, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 41, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 42, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 43, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 44, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 45, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 46, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 47, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 48, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 49, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                            ['sno' => 50, 'view' => '', 'length' => '', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                        ];

                                                        ?>

                                                        <tbody id="dimensionTableBody">
                                                            <?php foreach ($rows as $row) : ?>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" class="form-control centered-input" name="sno[]" value="<?= htmlspecialchars($row['sno']) ?>" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control centered-input" name="view[]" value="<?= htmlspecialchars($row['view']) ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control centered-input" name="length[]" value="<?= htmlspecialchars($row['length']) ?>">
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
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
                                        <button class="btn btn-primary" id="submit" type="submit">Add Inspection Master</button>
                                        <input type="button" class="btn btn-default" value="Cancel" data-toggle="collapse" data-target="#form_div" />
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>


                            <div class="card-box table-responsive">

                                <br>
                                <table id="datatable-keytable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Itemname </th>
                                            <th>Itemcode</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($inspection as  $row) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i++; ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d-m-Y', strtotime($row['date'])); ?>
                                                </td>
                                                <td class="uppercase">
                                                    <?php echo $row['itemname']; ?>&nbsp;&nbsp;
                                                </td>
                                                <td>
                                                    <?php echo $row['product_code']; ?>
                                                </td>
                                                <td>
                                                 <a href="<?php echo base_url('Inspectionmaster/edit/' . base64_encode($row['id'])); ?>"
                                                       class="btn btn-success btn-xs"
                                                       style="font-weight:bold; background-color:#57C5A5; color:white;">
                                                       <i class="fa fa-pencil"></i>
                                                   </a>

                                                   <a href="#delete<?php echo $row['id']; ?>" data-toggle="modal"
                                                       style="color:white; font-weight: bold; background-color: #57C5A5"
                                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <!-- END OF ADD grade-->

        </div>
    </div>
</div>


<?php if(!empty($inspection)) {
    foreach ($inspection as $r) { ?>
<div id="delete<?php echo $r['id']; ?>" class="modal fade">
    <div class="modal-dialog" style="width:40%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete </h4>
            </div>
            <div class="modal-text">
                <br>
                <p align="center">Are you sure you want to delete this inspection master?</p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form name="form" action="<?php echo base_url(); ?>Inspectionmaster/delete" method="post" id="form1">
                        <input type="hidden" value="<?php echo $r['id']; ?>" name="id">
                        <div class="col-offset-4" align="center"></div>

                        <div align="center">
                            <button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
                            <button id="dialogCancel" data-dismiss="modal"
                                class="btn btn-default waves-effect">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } 
}?>


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

        $('#submit').click(function() {
            var grade = $('#grade');
            if (grade.val() == '') {
                grade.focus();
                $('#grade_valid').html('<span><font color="red"> Enter the Grade  </span>');
                grade.keyup(function() {
                    $('#grade_valid').html('');
                });
                return false;
            } else {
                var gradeVal = $("#isValidgrade").val();
                if (gradeVal > 0) {
                    $('#grade').focus();
                    $('#grade_valid').html('<span><font color="red"> Grade Already Exists!</span>');
                    return false;
                }
            }
        });

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

        }
    });
</script>


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
        background-color: #f0f0f1 !important;
    }

    .note-btn-group .dropdown-menu {
        background-color: #fff !important;
        padding: 3px !important;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

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
</script>
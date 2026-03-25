<?php $data = $this->db->get('profile')->result();
foreach ($data as $r)
?>
<title>
    <?php echo $r->companyname; ?>
</title>

<link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">

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
                                <i class="fa fa-reorder"></i>Grade Reports
                            </div>
                            <div class="tools">
                                <a href="javascript:void();" data-toggle="collapse" data-target="#form_div"
                                    style="color:white;"> <i class="fa fa-plus"></i> Add grade</a>&nbsp;
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <div class="well collapse <?php //if ($id != ""){ echo " in";} ?>" id="form_div">
                                <form class="horizontal-form" id="form" method="post"
                                    action="<?php echo base_url(); ?>Grade/insert">
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Grades</label>
                                                    <input type="text" class="form-control" name="grade"
                                                        autocomplete="off" id="grade">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Heat Treatment Details</label>
                                                    <input type="text" class="form-control" name="heat_treatment"
                                                        autocomplete="off" id="heat_treatment">
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">HSN No</label>
                                                    <input type="text" class="form-control" name="hsnno"
                                                        autocomplete="off" id="hsnno">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div id="compositionModal">
                                                    <div>
                                                        <h4 style="margin-bottom: 17px;color: #000;">Chemical
                                                            Composition Details</h4>
                                                    </div>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Element</th>
                                                                <th>Min Value</th>
                                                                <th>Max Value</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="compositionTableBody">
                                                            <?php for ($i = 1; $i <= 15; $i++) { ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control"
                                                                        name="element[]" id="element<?php echo $i; ?>">
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                        name="min_value[]"
                                                                        id="min_value<?php echo $i; ?>"></td>
                                                                <td><input type="text" class="form-control"
                                                                        name="max_value[]"
                                                                        id="max_value<?php echo $i; ?>"></td>
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
                                                        <h4 style="margin-bottom: 17px;color: #000;">Mechanical
                                                            Properties Details</h4>
                                                    </div>

                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Element</th>
                                                                <th>Min Value</th>
                                                                <th>Max Value</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="mechanicalTableBody">
                                                            <?php foreach ($mechanicalElements as $i => $element) { ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control"
                                                                        name="mechanicalelement[]"
                                                                        id="mechanicalelement<?php echo $i + 1; ?>"
                                                                        value="<?php echo $element; ?>" readonly></td>
                                                                <td><input type="text" class="form-control"
                                                                        name="mechanicalminvalue[]"
                                                                        id="mechanicalminvalue<?php echo $i + 1; ?>">
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                        name="mechanicalmaxvalue[]"
                                                                        id="mechanicalmaxvalue<?php echo $i + 1; ?>">
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-md-12" style="margin-top: 25px;">
                                                <h4 style="margin-bottom: 17px;color: #000;">Remarks</h4>
                                                <textarea id="summernote" name="remarks"></textarea>
                                            </div>

                                        </div>
                                        <!--/row-->

                                    </div>
                                    <div class="form-actions fluid">
                                        &nbsp;
                                    </div>
                                    <div class="form-actions col-sm-offset-4">
                                        <button class="btn btn-primary" id="submit" type="submit">Add Grade</button>
                                        <input type="button" class="btn btn-default" value="Cancel"
                                            data-toggle="collapse" data-target="#form_div" />
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                            <!--<div class="row">&nbsp;</div>
							<div class="row">&nbsp;</div>-->
                            <div class="card-box table-responsive">
                                <!-- START HERE-->
                                <?php /* 
							<form method="post" action="<?php echo base_url();?>stockmaster/search">
                                <table>
                                    <td style="width: 88px;">From Date</td>
                                    <td><input type="text" class="form-control  datepicker-autoclose" name="fromdate"
                                            style="font-size:16px;width:143px;" value="<?php echo date('d-m-Y');?>">
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;To Date &nbsp;&nbsp;</td>
                                    <td><input type="text" class="form-control datepicker-autoclose" name="todate"
                                            style="font-size:16px;width:143px;" value="<?php echo date('d-m-Y');?>">
                                    </td>
                                    <td> &nbsp;&nbsp; &nbsp;&nbsp;<input type="submit" class="btn btn-info"
                                            value="Search"></td>
                                </table>
                                </form> */ ?>
                                <br>
                                <table id="datatable-keytable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Grade </th>

                                            <th>Heat Treatment Details</th>
                                            <th>HSN No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$i = 1;
										foreach ($grade as  $row) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $i++; ?>
                                            </td>
                                            <td>
                                                <?php echo date('d-m-Y', strtotime($row['date'])); ?>
                                            </td>
                                            <td class="uppercase">
                                                <?php echo $row['grade']; ?>&nbsp;&nbsp;
                                            </td>

                                            <td>
                                                <?php echo $row['heat_treatment']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['hsnno']; ?>
                                            </td>

                                            <td>
                                                <a href="<?php echo base_url('Grade/editgrade/' . $row['id']); ?>"
                                                    class="btn btn-success btn-xs"
                                                    style="font-weight:bold; background-color:#57C5A5; color:white;">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                <a href="#delete<?php echo $row['id']; ?>" 
                                                    data-toggle="modal"
                                                    class="btn btn-danger btn-xs"
                                                    style="font-weight:bold; background-color:#57C5A5; color:white;">
                                                    <i class="fa fa-trash"></i>
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


<?php foreach ($grade as $r) { ?>
<div id="delete<?php echo $r['id']; ?>" class="modal fade">
    <div class="modal-dialog" style="width:40%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete </h4>
            </div>
            <div class="modal-text">
                <br>
                <p align="center">Are you sure to delete this data?</p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form name="form" action="<?php echo base_url(); ?>grade/delete" method="post" id="form1">
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
<?php } ?>



<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/custombox/dist/legacy.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.decimal').keyup(function () {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });
        $('#submit').click(function () {
            var grade = $('#grade');
            if (grade.val() == '') {
                grade.focus();
                $('#grade_valid').html('<span><font color="red"> Enter the Grade  </span>');
                grade.keyup(function () {
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
        $('#grade').change(function () {
            var grade = $('#grade').val();
            $.post('<?php echo base_url(); ?>grade/checkgrade', {
                'grade': grade
            }, function (data) {
                $("#isValidgrade").val(data);
                if (data > 0) {
                    $('#grade').focus();
                    $('#grade_valid').html('<span><font color="red"> grade Already Exists!</span>');
                } else {
                    $('#grade_valid').html('');
                }
            });
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
    
    .note-btn-group .dropdown-menu{
        background-color: #fff !important;
        padding: 3px !important;
    }    
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function () {
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
<?php $data = $this->db->get('profile')->result();
foreach ($data as $r)
?>
<title>
    <?php echo $r->companyname; ?> - Edit Grade
</title>

<link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">

<style type="text/css">
    .uppercase {
        text-transform: uppercase;
    }
    
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

            <!-- EDIT Grade -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-edit"></i>Edit Grade
                            </div>
                            <div class="tools">
                                <a href="<?php echo base_url('Grade'); ?>" style="color:white;">
                                    <i class="fa fa-arrow-left"></i> Back to Grade List
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <div class="well">
                                <form class="horizontal-form" id="form" method="post"
                                    action="<?php echo base_url(); ?>Grade/update">
                                    <input type="hidden" name="id" value="<?php echo $grade_data['id']; ?>">
                                    
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Grades</label>
                                                    <input type="text" class="form-control" name="grade"
                                                        autocomplete="off" id="grade" value="<?php echo $grade_data['grade']; ?>">
                                                    <span id="grade_valid"></span>
                                                    <input type="hidden" id="isValidgrade" value="0">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Heat Treatment Details</label>
                                                    <input type="text" class="form-control" name="heat_treatment"
                                                        autocomplete="off" id="heat_treatment" value="<?php echo $grade_data['heat_treatment']; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">HSN No</label>
                                                    <input type="text" class="form-control" name="hsnno"
                                                        autocomplete="off" id="hsnno" value="<?php echo $grade_data['hsnno']; ?>">
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
                                                            <?php 
                                                            $element = explode(',',$grade_data['element']);
                                                            $min_value = explode(',',$grade_data['min_value']);
                                                            $max_value = explode(',',$grade_data['max_value']);
                                                            $count   = count($element);
                                                            for ($i = 0; $i < $count; $i++) { 

                                                            ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control"
                                                                        name="element[]" id="element<?php echo $i; ?>"
                                                                        value="<?php echo $element[$i]; ?>">
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                        name="min_value[]"
                                                                        id="min_value<?php echo $i; ?>"
                                                                        value="<?php echo $min_value[$i]; ?>"></td>
                                                                <td><input type="text" class="form-control"
                                                                        name="max_value[]"
                                                                        id="max_value<?php echo $i; ?>"
                                                                        value="<?php echo $max_value[$i]; ?>"></td>
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
                                                            <?php 
                                                            $m_element = explode(',',$grade_data['mechanicalelement']);
                                                            $mechanicalminvalue = explode(',',$grade_data['mechanicalminvalue']);
                                                            $mechanicalmaxvalue = explode(',',$grade_data['mechanicalmaxvalue']);
                                                            $counts   = count($m_element);
                                                            for ($j = 0; $j < $counts; $j++) { 
                                                            ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control"
                                                                        name="mechanicalelement[]"
                                                                        id="mechanicalelement<?php echo $j ?>"
                                                                        value="<?php echo $m_element[$j]; ?>" readonly></td>
                                                                <td><input type="text" class="form-control"
                                                                        name="mechanicalminvalue[]"
                                                                        id="mechanicalminvalue<?php echo $j ?>"
                                                                        value="<?php echo $mechanicalminvalue[$j]; ?>">
                                                                </td>
                                                                <td><input type="text" class="form-control"
                                                                        name="mechanicalmaxvalue[]"
                                                                        id="mechanicalmaxvalue<?php echo $j ?>"
                                                                        value="<?php echo $mechanicalmaxvalue[$j]; ?>">
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-md-12" style="margin-top: 25px;">
                                                <h4 style="margin-bottom: 17px;color: #000;">Remarks</h4>
                                                <textarea id="summernote" name="remarks"><?php echo $grade_data['remarks']; ?></textarea>
                                            </div>

                                        </div>
                                        <!--/row-->

                                    </div>
                                    <div class="form-actions fluid">
                                        &nbsp;
                                    </div>
                                    <div class="form-actions col-sm-offset-4">
                                        <button class="btn btn-primary" id="submit" type="submit">Update Grade</button>
                                        <a href="<?php echo base_url('Grade'); ?>" class="btn btn-default">Cancel</a>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF EDIT grade-->

        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/custombox/dist/legacy.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

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
            var currentId = $('input[name="id"]').val();
            
            $.post('<?php echo base_url(); ?>grade/checkgrade_edit', {
                'grade': grade,
                'id': currentId
            }, function (data) {
                $("#isValidgrade").val(data);
                if (data > 0) {
                    $('#grade').focus();
                    $('#grade_valid').html('<span><font color="red"> Grade Already Exists!</span>');
                } else {
                    $('#grade_valid').html('');
                }
            });
        });
        
        // Initialize Summernote
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
<link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.css">



<style type="text/css">
    .forms {}

    .forms input {
        width: 95%;
    }

    .uppercase {
        text-transform: uppercase;
    }

    .success {
        display: none;
    }

    .unsuccess {
        display: none;
    }

    .success1 {
        display: none;
    }

    .footer {
        border-top: 1px solid rgba(154, 157, 160, 0.2);
        bottom: 0;
        color: #f5f5f5;
        text-align: left !important;
        padding: 19px 30px 20px;
        position: relative;
        right: 0;
        /* left: 240px; */
        background: #100f0f;
    }

    @media only screen and (max-width: 500px) {
        .btn {
            border-radius: 2px;
            padding: 6px 4px;
        }

        .card-box {
            padding: 15px 20px 20px 20px;
            background-color: #ffffff;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            background-clip: padding-box;
            margin-bottom: 7px;
            /* border: 1px solid #f5f5f5; */
            border: 0px solid #bae2ff;
            background: #fff;
        }
    }
</style>
<title>Inspection Reports</title>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <?php $msg = $this->session->flashdata('msg');
            if ((isset($msg)) && (!empty($msg))) { ?>
                <div class="alert btn-primary alert-micro btn-rounded pastel light dark">
                    <a href="#" class="close" id="delete" data-dismiss="alert">&times;</a>
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

            <div class="alert btn-info alert-micro btn-rounded pastel light dark success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>Inspection Report Deleted Successfully !
            </div>

            <div class="alert btn-info alert-micro btn-rounded pastel light dark unsuccess">
                <a href="#" class="close" data-dismiss="alert">&times;</a>Inspection Report Deleted Unsuccessfully
            </div>

            <div class="alert btn-info alert-micro btn-rounded pastel light dark success1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>e-Invoice Generated Bill cannot be Deleted
            </div>
            <div class="row">
                <div class="col-sm-12">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
                        <header class="panel-heading" style="color:rgb(255, 255, 255)">
                            <i class="zmdi zmdi-view-headline"><span style="font-family: 'Quicksand', sans-serif;padding-left: 6px;">Inspection Reports</span></i>
                        </header>
                        <div class="card-box table-responsive">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                </a>
                            </div>

                            <form name="from" id="form-filter" method="post">
                                <table style="margin: 0 auto;">
                                    <tr>


                                        <input type="hidden" name="invoiceno" id="invoiceno" value="">
                                        <!--<td>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" name="invoiceno" id="invoiceno" style="font-size:16px;width: 115px;" value="" placeholder="Invoice No">
                                        </div>
                                        </td>-->

                                        <td>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="customername" id="name" style="font-size:16px;width: 185px;" placeholder="Customer Name" autocomplete="off">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control  datepicker-autoclose" name="fromdate" id="fromdate" style="font-size:16px;width:123px;" placeholder="From Date" autocomplete="off">
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control datepicker-autoclose" name="todate" id="todate" style="font-size:16px;width:123px;" Placeholder="To Date" autocomplete="off">
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                        </td>
                                        <td>&nbsp;&nbsp;&nbsp;</td>
                                        <td style="display: inline-flex;">

                                            <button type="button" id="btn-filter" class="btn btn-primary" style="display: inline-block;margin-right:10px;">Search</button>
                                            <button type="button" id="btn-reset" class="btn btn-default" style="display: inline-block;">Reset</button>

                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <!-- <form method="post" action="<?php echo base_url(); ?>invoice/search">
<table>
<td style="width: 88px;">
From Date
</td>
<td>
<input type="text" class="form-control  datepicker-autoclose" name="fromdate" id="autoclose" style="font-size:16px;width:143px;" value="<?php echo date('d-m-Y'); ?>">
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;
To Date &nbsp;&nbsp;
</td>
<td>    
<input type="text" class="form-control datepicker-autoclose" name="todate" id="datepicker2" style="font-size:16px;width:143px;" value="<?php echo date('d-m-Y'); ?>">
</td>
<td> &nbsp;&nbsp; &nbsp;&nbsp;<input type="submit" class="btn btn-info" value="Search"></td>
</table>
</form> -->


                            <?php $preference = $this->db->where('status', 1)->get('preference_settings')->row(); ?>
                            <br>
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Inspection No</th>
                                        <th>Company Name</th>
                                        <th>Drawing No</th>
                                        <th>Manage</th>

                                    </tr>
                                </thead>

                                </tbody>


                            </table>

                            <!-- <div align="center">
<button id="print" class="btn btn-info" value="Print">Print Reports</button>
 <input type="submit" id="excel" name="excel" class="btn btn-primary" value="Download as Excel">
</div> -->
                        </div>
                </div>
            </div>
        </div>


        <div id="delete_billing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <form id="delete_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Delete Inspection</h4>
                        </div>
                        <div class="modal-text">
                            <p>Are you sure to delete this data?</p>
                        </div>
                        <input type="hidden" id="hidden_delete_id">
                        <div class="modal-body">
                            <div class="delete"></div>
                        </div>
                        <div align="center">
                            <button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
                            <button id="dialogCancel" data-dismiss="modal" class="btn btn-primary waves-effect">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js') ?>"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script>
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

            $("#name").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>dcbill/autocomplete_name",
                        data: {
                            keyword: $("#name").val()
                        },
                        dataType: "json",
                        type: "POST",
                        success: function(data) {
                            response(data);
                        }
                    });
                },
            });


            $("#invoiceno").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>invoice_statement/autocomplete_name",
                        data: {
                            keyword: $("#invoiceno").val()
                        },
                        dataType: "json",
                        type: "POST",
                        success: function(data) {
                            response(data);
                        }
                    });
                },
            });
        </script>

        <script type="text/javascript">
            var table;

            $(document).ready(function() {

                //datatables
                table = $('#table').DataTable({

                    "processing": true, //Feature control the processing indicator.
                    'bnDestroy': true,
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('Mtc/ajaxlist_inspection') ?>",
                        "type": "POST",
                        "data": function(data) {
                            data.invoiceno = $('#invoiceno').val();
                            data.gsttype = $('#gsttype').val();
                            data.cusname = $('#name').val();
                            data.fromdate = $('#fromdate').val();
                            data.todate = $('#todate').val();


                        }
                    },

                    //Set column definition initialisation properties.
                    "columnDefs": [{
                        "targets": [0], //first column / numbering column
                        "orderable": false, //set not orderable
                    }, ],

                });

                $('#btn-filter').click(function() { //button filter event click
                    table.ajax.reload(null, false); //just reload table
                });
                $('#btn-reset').click(function() { //button reset event click
                    $('#form-filter')[0].reset();
                    table.ajax.reload(null, false); //just reload table
                });



                $('#print').click(function() {
                    var fromdate = $('#fromdate').val();
                    var todate = $('#todate').val();
                    var cusname = $('#name').val();
                    var invoiceno = $('#invoiceno').val();
                    var gsttype = $('#gsttype').val();

                    $.post('<?php echo base_url(); ?>invoice/search', {
                        'fromdate': fromdate,
                        'cusname': cusname,
                        'todate': todate,
                        'invoiceno': invoiceno,
                        gsttype: gsttype
                    }, function(data) {

                        window.open('<?php echo base_url(); ?>invoice/search_reports', '_blank');

                    });

                });
                $('#excel').click(function() {
                    var fromdate = $('#fromdate').val();
                    var todate = $('#todate').val();
                    var cusname = $('#name').val();
                    var invoiceno = $('#invoiceno').val();
                    var gsttype = $('#gsttype').val();

                    $.post('<?php echo base_url(); ?>invoice/download', {
                        'fromdate': fromdate,
                        'cusname': cusname,
                        'todate': todate,
                        'invoiceno': invoiceno,
                        gsttype: gsttype
                    }, function(data) {

                        window.open('<?php echo base_url(); ?>invoice/excel_download', '_blank');

                    });

                });


                $('#delete_form').submit(function() {
                    var id = $('#hidden_delete_id').val();
                    $('#dialogConfirm').text('Processing...');
                    $('#dialogConfirm').attr('disabled', true);
                    $.post('<?php echo base_url(); ?>Mtc/delete_inspection', {
                        id: id
                    }, function(res) {
                        $('#dialogConfirm').text('Confirm');
                        $('#dialogConfirm').attr('disabled', false);
                        // console.log(res);
                        if (res == 'yes') {
                            $('#delete_billing').modal('hide');
                            $('.success').show();
                            reload_table();
                        } else if (res == 'no') {
                            $('#delete_billing').modal('hide');
                            $('.success').show();
                            reload_table();
                        } 

                    });
                    return false;
                });


                // $('#download').click(function(){
                //  var fromdate = $('#fromdate').val();
                //   var todate = $('#todate').val();
                //   var itemno = $('#itemno').val();
                //   var itemname = $('#itemname').val();

                //   $.post('<?php echo base_url(); ?>daily_stockreports/billing_reportdownload',{'fromdate':fromdate,'todate':todate,'itemno':itemno,'itemname':itemname},function(data){

                //     window.open('<?php echo base_url(); ?>daily_stockreports/search_reports', '_blank');

                //   });

                // });

            });

            function reload_table() {
                table.ajax.reload(null, false); //reload datatable ajax 
            }

            function delete_inspection(id) {

                $('#hidden_delete_id').val(id);
                $('#delete_billing').modal('show');

            }


            function edit_person(id) {

                //alert(id);

                $.post('<?php echo base_url(); ?>admin/add_billing/viewbilling', {
                    'id': id
                }, function(data) {

                    $('.viewdetails').html(data);

                    $('#view_billing').modal('show');

                });
            }
        </script>
<link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.css">

<?php error_reporting(0); ?>
<style type="text/css">
  .forms input {
    width: 95%;
  }

  .uppercase {
    text-transform: uppercase;
  }

  .card-box {
    padding: 0px 20px 20px 20px;
    background-color: #ffffff;
    -webkit-border-radius: 5px;
    border-radius: 0px;
    -moz-border-radius: 5px;
    background-clip: padding-box;
    margin-bottom: 20px;
    border: 1px solid #f5f5f5;
    border-bottom: 3px solid #2477c9;
  }

  .navbar-nav>li>a {
    padding-top: 0px;
    padding-bottom: 0px;
  }
</style>

<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">

      <?php $msg = $this->session->flashdata('msg');
      if ((isset($msg)) && (!empty($msg))) { ?>
        <div class="alert btn-primary alert-micro btn-rounded pastel light dark">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
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

      <div class="row">
        <div class="col-sm-12">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
            <header class="panel-heading" style="color:rgb(255, 255, 255)">
              <i class="zmdi zmdi-view-headline"><span style="font-family: 'Quicksand', sans-serif;padding-left: 6px;">Supplier Po Order Pending</span></i>
            </header>
            <div class="card-box table-responsive">
              <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                </a>
              </div>
              <br><br>

              <form name="from" id="form-filter" method="post" style="margin-left:350px;">
                <table>
                  <tr>
                    <td>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="suppliername" id="suppliername" style="font-size:16px;width: 255px;" value="" placeholder="Party Name">
                      </div>
                    </td>
                    <td>
                      <div class="col-sm-12">
                        <input type="text" class="form-control  datepicker-autoclose" name="fromdate" id="fromdate" style="font-size:16px;width:143px;" value="" placeholder="From Date">
                      </div>
                    </td>
                    <td>
                      <input type="text" class="form-control datepicker-autoclose" name="todate" id="todate" style="font-size:16px;width:143px;" value="" Placeholder="To Date">
                    </td>
                    <td>&nbsp;</td>
                    <td>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td>

                    <td>
                      <button type="button" id="btn-filter" class="btn btn-primary">Search</button>
                      <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                    </td>

                    </td>
                  </tr>
                </table>
              </form>
              <br>
              <table id="table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Wo Company Name</th>
                    <th>PO No</th>
                    <th>Supplier Name</th>
                    <th>Item Name</th>
                    <th>Grade</th>
                    <th>Qty</th>
                    <th>Balance Qty</th>
                    <th>Status</th>
                  </tr>
                </thead>

              </table>

              <div align="center">
                <button id="download" class="btn btn-primary" value="Print"><i class="fa fa-bar-chart-o"></i>Download</button>
              </div>

            </div>
        </div>
      </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.js"></script>

    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
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
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        $("#suppliername").autocomplete({
          source: function(request, response) {
            $.ajax({
              url: "<?php echo base_url(); ?>purchase/autocomplete_customername",
              data: {
                keyword: $("#suppliername").val()
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
              url: "<?php echo base_url(); ?>purchase_statement/autocomplete_name",
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

        // $('#download').click(function() {
        //   window.open('<?php echo base_url(); ?>Supplier_purchaseorder/excel_download', '_blank');
        // });

      });
    </script>

    <script type="text/javascript">
      $(document).ready(function() {

        table = $('#table').DataTable({
          "processing": true, //Feature control the processing indicator.
          'bnDestroy': true,
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [], //Initial no order.
          // Load data for the table's content from an Ajax source
          "ajax": {
            "url": "<?php echo site_url('Supplier_purchaseorder/ajax_pending_list') ?>",
            "type": "POST",
            "data": function(data) {

              data.cusname = $('#suppliername').val();
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

        $('#download').click(function() {
          var fromdate = $('#fromdate').val();
          var todate = $('#todate').val();
          var cusname = $('#suppliername').val();

          // Create a hidden form to submit POST data
          var form = document.createElement('form');
          form.method = 'POST';
          form.action = '<?php echo base_url(); ?>Supplier_purchaseorder/excel_download';
          form.target = '_blank';

          var input1 = document.createElement('input');
          input1.type = 'hidden';
          input1.name = 'fromdate';
          input1.value = fromdate;
          form.appendChild(input1);

          var input2 = document.createElement('input');
          input2.type = 'hidden';
          input2.name = 'todate';
          input2.value = todate;
          form.appendChild(input2);

          var input3 = document.createElement('input');
          input3.type = 'hidden';
          input3.name = 'cusname';
          input3.value = cusname;
          form.appendChild(input3);

          document.body.appendChild(form);
          form.submit();
          document.body.removeChild(form);
        });

      });
    </script>
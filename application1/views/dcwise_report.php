
<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">


<style type="text/css">
  .forms{ }
  .forms input{ width: 95%; }

  .uppercase {
    text-transform: uppercase;
}
</style>


<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container">
<!--                                                         <h4 class="page-title">Tax Type</h4>
-->

<?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
<div class="alert btn-primary alert-micro btn-rounded pastel light dark" >
  <a href="#" class="close" data-dismiss="alert">&times;</a>
  <?php print_r($msg); ?>
</div>
<?php } ?>


<?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
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
        <i class="zmdi zmdi-view-headline">&nbsp;Inwardwise Dc Reports</i>
    </header>
    <div class="card-box table-responsive">
        <div class="dropdown pull-right">
          <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
          </a>
      </div>
      <form name="from" id="form-filter" method="post" >
          <table >
            <tr>
            <td>
            <div class="col-sm-12">
              <input type="text" class="form-control" name="customername" id="customername" style="font-size:16px;width: 255px;" value="" placeholder="Party Name">
          </div>
      </td>

      <td>
            <div class="col-sm-12">
              <input type="text" class="form-control" name="inwardno" id="inwardno" style="font-size:16px;width: 255px;" value="" placeholder="Inward No">
          </div>
      </td>

      <td>
            <div class="col-sm-12">
              <input type="text" class="form-control" name="dcno" id="dcno" style="font-size:16px;width: 255px;" value="" placeholder="Dc No">
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

    <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
    <button type="button" id="btn-reset" class="btn btn-default">Reset</button>

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
      <th>Inward No</th>
      <th>Company Name</th>
      <th>Dc No</th>
      <th>Qty</th>
    
      
  </tr>
</thead>
<tbody>

</tbody>
</table>




<form name="form" method="post" action="<?php echo base_url();?>inward/reports" target="_blank" >
									<table>
									  <tr>
									  <td><input type="hidden" name="customername" id="pcustomername" class="form-control" value="<?php if($this->input->post('customername')){echo $this->input->post('customername');}?>"></td>
									  <td><input type="hidden" name="dcno" id="pdcno" class="form-control" value="<?php if($this->input->post('dcno')){echo $this->input->post('dcno');}?>"></td>
										<td><input type="hidden" name="fromdate" id="pfromdate" class="form-control" value="<?php if($this->input->post('fromdate')){echo $this->input->post('fromdate');}?>"></td>
										  <td><input type="hidden" name="todate" id="ptodate" class="form-control" value="<?php if($this->input->post('todate')){echo $this->input->post('todate');}?>"></td>
                      <td><input type="hidden" name="inwardno" id="pinwardno" class="form-control" value="<?php if($this->input->post('inwardno')){echo $this->input->post('inwardno');}?>"></td>
										  <td><input type="submit" class="btn btn-info" name="submit" value="Print Reports" style="margin-left:400px;"></td>
										</tr>
									  </table>
									</form>
</div>
</div>
</div>
</div>
</div>




<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>

<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

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
  $(document).ready(function(){

    $( "#customername" ).autocomplete({
      source: function(request, response) {
        $.ajax({ 
          url: "<?php echo base_url();?>invoice/autocomplete_customername",
          data: { keyword: $("#customername").val()},
          dataType: "json",
          type: "POST",
          success: function(data){              
            response(data);
        }    
    });
    },
});


    $( "#invoiceno" ).autocomplete({
      source: function(request, response) {
        $.ajax({ 
          url: "<?php echo base_url();?>purchase_statement/autocomplete_name",
          data: { keyword: $("#invoiceno").val()},
          dataType: "json",
          type: "POST",
          success: function(data){              
            response(data);
        }    
    });
    },
});


});

</script>


<script type="text/javascript">

  var table;

  $(document).ready(function() {

//datatables
table = $('#table').DataTable({ 

"processing": true, //Feature control the processing indicator.
'bnDestroy' :true,
"serverSide": true, //Feature control DataTables' server-side processing mode.
"order": [], //Initial no order.

// Load data for the table's content from an Ajax source
"ajax": {
  "url": "<?php echo site_url('inward/dcwise_ajax_list')?>",
  "type": "POST",
  "data": function ( data ) {
    data.dcno = $('#dcno').val();
    data.customername = $('#customername').val();
    data.fromdate = $('#fromdate').val();
    data.todate = $('#todate').val();
    data.inwardno = $('#inwardno').val();

}
},

//Set column definition initialisation properties.
"columnDefs": [
{ 
"targets": [ 0 ], //first column / numbering column
"orderable": false, //set not orderable
},
],

});

$('#btn-filter').click(function(){ //button filter event click

  $('#pcustomername').val($('#customername').val());
  $('#pdcno').val($('#dcno').val());
  $('#pfromdate').val($('#fromdate').val());
  $('#ptodate').val($('#todate').val());
  $('#pinwardno').val($('#inwardno').val());

table.ajax.reload(null,false);  //just reload table
});
$('#btn-reset').click(function(){ //button reset event click
  $('#form-filter')[0].reset();
table.ajax.reload(null,false);  //just reload table
});

// $('#download').click(function(){
//    var fromdate = $('#fromdate').val();
//    var todate = $('#todate').val();
//    var invoiceno = $('#invoiceno').val();
//    var suppliername = $('#suppliername').val();

//    $.post('<?php echo base_url();?>purchase_statement/billing_reportdownload',{'fromdate':fromdate,'todate':todate,'invoiceno':invoiceno,'suppliername':suppliername},function(data){

//     window.open('<?php echo base_url();?>purchase_statement/search_reports', '_blank');

// });

// }); // download ends 



// form delete 



});

// function printDownload(){
//  alert();
//   var fromdate = $('#fromdate').val();
//   var todate = $('#todate').val();
//   var dccno = $('#dcno').val();
//   var customername = $('#customername').val();

//   $.post('<?php echo base_url();?>dcbill/searchdc',{'fromdate':fromdate,'todate':todate,'customername':customername,'dcno':dcno},function(data){

//     window.open('<?php echo base_url();?>inward/search_dcreports', '_blank');


//   });

// }
// function reload_table()
// {
// table.ajax.reload(null,false); //reload datatable ajax 
// }



</script>      


<?php $data=$this->db->get('profile')->result();
foreach($data as $r)
  ?>
<title> <?php echo $r->companyname;?></title>
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
  <div class="content">
    <div class="container">
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
              <i class="zmdi zmdi-view-headline">&nbsp;Dc Reports</i>
            </header>
            <div class="card-box table-responsive">
              <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                </a>
              </div>
                      <form class="form-horizontal" name="forms" method="post" action="<?php echo base_url();?>dcbill/inwards" role="form" data-parsley-validate novalidate enctype="multipart/form-data">
                <table >
                  <tr>
              
                    
                    <td>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="inwardno" id="inwardno" style="font-size:16px;width: 255px;"  placeholder="Inward no">
                      </div>
                    </td>
         
                    <td>&nbsp;</td>       
                    <td>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td>
                      <button type="submit" id="submit" value="submit" class="btn btn-primary">Filter</button>
                      <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                    </td>
                  </tr>
                </table>
              </form>
              <br>
              <table id="table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                     <th>S.no</th>
                    <th>Date</th>
                   
                    <th>DC No</th>
                    <th>Inward NO</th>
                    <th>Uom</th>
                    <th>Qty</th>
                     
                    <th>Scrap/Finished</th>
                       
                  </tr>
                </thead>
                <tbody>
                    <?php 
                   $cnt=1;
                    foreach($inward as $i)
                    {?>
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $i->date;?></td>
                        <td><?php echo $i->dcno;?></td>
                        <td><?php echo $i->inwardno;?></td>
                        <td><?php echo $i->uom;?></td>
                        <td><?php echo $i->qty;?></td>
                        <td><?php echo $i->goodscondition;?></td>
                        
                    </tr>
                        
                   <?php } ?>
                </tbody>
              </table>
              
              
              <div align="center">
                 <!--<button id="print" class="btn btn-info" value="Print">Print</button> -->
<!--                 <button id="download" class="btn btn-primary" value="Download">Download</button>
 -->              </div>
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

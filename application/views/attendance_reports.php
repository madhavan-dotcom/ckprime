<!-- DataTables -->

<link href="<?php echo base_url();?>site_assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url();?>site_assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>


        <link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

        <link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">

        <link href="<?php echo base_url();?>site_assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>site_assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>site_assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />


    <style type="text/css">
    
    .uppercase{

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
					<div class="alert btn-primary alert-micro btn-rounded pastel light dark success" style="display:none" >
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        Data deleted successfully!
                    </div>

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
									<i class="zmdi zmdi-money-box">&nbsp;Attendance Reports</i>
                                </header>
                                <div class="card-box table-responsive" style="height:500px;">
                                    

                                    <form name="from" id="form-filter" method="post" >
                                        <table id="table"  >
                                            <tr>
                                            <td style="width: 200px; text-align:center;">
                                                    <div class="col-sm-12">
                                                    <select  name="staff_name" class="selectpicker form-control"  data-live-search="true" title="Select Staff" id="staff_name"  style="font-size:16px;width: 255px;">
                                                    </select></div></td>
                                                    <td style="width: 90px;">
                              
                              <?php
                                  $month=date('m');
                                  $fromyear=date('Y',strtotime("- 2 Years"));
                                  $toyear=date('Y');
                                 ?>
                              <select class="selectpicker form-control " data-live-search="true"  name="month" id="month">
                                <option value="01" <?php if($month=='01') echo 'selected';?>>Jan</option>
                                <option value="02" <?php if($month=='02') echo 'selected';?>>Feb</option>
                                <option value="03" <?php if($month=='03') echo 'selected';?>>Mar</option>
                                <option value="04" <?php if($month=='04') echo 'selected';?>>Apr</option>
                                <option value="05" <?php if($month=='05') echo 'selected';?>>May</option>
                                <option value="06" <?php if($month=='06') echo 'selected';?>>Jun</option>
                                <option value="07" <?php if($month=='07') echo 'selected';?>>Jul</option>
                                <option value="08" <?php if($month=='08') echo 'selected';?>>Aug</option>
                                <option value="09" <?php if($month=='09') echo 'selected';?>>Sep</option>
                                <option value="10" <?php if($month=='10') echo 'selected';?>>Oct</option>
                                <option value="11" <?php if($month=='11') echo 'selected';?>>Nov</option>
                                <option value="12" <?php if($month=='12') echo 'selected';?>>Dec</option>
                              </select>
                              </td>
                              <td style="width: 100px;">
 
                               <select class="selectpicker form-control " data-live-search="true"  name="year" id="year"> 
                              <?php 
                               for ($i=$fromyear; $i <= $toyear; $i++) { 
                               ?> 
                                <option value="<?php echo $i;?>" <?php if($toyear==$i) echo 'selected';?>><?php echo $i;?></option>
                               <?php 
                               }
                             ?>
                           </select>
 
                              </td>
                                    
                                                    <td><button type="button" id="searchs" class="btn btn-success btn-custom" >Search</button></td>
                                                 
                                                       
                                                        
                                                    </tr>
                                        </table>
                                        <br>
                                            

                                                <div class="attendancelist"></div>
                                            
                                    </form>
                                    <br>

                                    <div align="center">
                            <form method="post" target="_blank" action="<?php echo base_url();?>attendance/print_reports">
                              <input type="hidden" name="staff_name" id="hidden_staff">
                              <input type="hidden" name="month" id="hidden_month">
                              <input type="hidden" name="year" id="hidden_year">
                            <button class="btn btn-info" id="print">Print</button>
                            </form>
                          </div>

                        
                                </div>
                            </div>
                        </div>
                    </div>


           

        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>


         <script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>

 <script src="<?php echo base_url();?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>        

 <script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


<script src="<?php echo base_url();?>site_assets/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url();?>site_assets/plugins/datatables/dataTables.bootstrap.js"></script>

      <script type="text/javascript" src="<?php echo base_url();?>site_assets/plugins/multiselect/js/jquery.multi-select.js"></script>
            <script src="<?php echo base_url();?>site_assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
            <script src="<?php echo base_url();?>site_assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>



      <script type="text/javascript">
            $(document).ready(function() {
                $('.selectpicker').selectpicker();
            });
        </script>
      <script type="text/javascript">
    $(document).ready(function(){
        /*Get the city list */
     $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>attendance/get_staffs",
        data:{id:$(this).val()}, 
         beforeSend :function(){
          $("#staff_name option:gt(0)").remove(); 
          // $('#staff_name').selectpicker('refresh');
          // $('#staff_name').find("option:eq(0)").html("Please wait..");
          // $('#staff_name').selectpicker('refresh');
        },                         
        success: function (data) {
       
         $('#staff_name').selectpicker('refresh');
          $('#staff_name').find("option:eq(0)").html("Select Staff");
          $('#staff_name').selectpicker('refresh');
          var obj=jQuery.parseJSON(data);       
          $(obj).each(function(){
            var option = $('<option />');
            option.attr('value', this.value).text(this.label);           
            $('#staff_name').append(option);
          });
           $('#staff_name').selectpicker('refresh');
        }                     
        
      });

    });

    </script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#searchs').click(function(){
      var staff_name=$('#staff_name').val();
      var month=$('#month').val();
      var year=$('#year').val();
    
      if(staff_name=='')
      {
        alert('Please Select Staff name');
        $('#staff_name').focus();
        return false;
      }
      $('#searchs').text('Processing...');
      $('#searchs').attr('disabled',true);
      $.post('<?php echo base_url();?>attendance/report',{'staff_name':staff_name,'month':month,'year':year},function(data){
        $('#searchs').text('Search');
        $('#searchs').attr('disabled',false);
          $('.attendancelist').html(data);
  
    });
  });

  $('#print').click(function(){
      var staff_name=$('#staff_name').val();
      var month=$('#month').val();
      var year=$('#year').val();
      if(staff_name=='')
      {
        alert('Please Select Staff name');
        $('#staff_name').focus();
        return false;
      }else{
        $('#hidden_staff').val(staff_name);
        $('#hidden_month').val(month);
        $('#hidden_year').val(year);
      }
      // $('#print').text('Processing...');
      // $('#print').attr('disabled',true);
      // $.post('<?php echo base_url();?>ad/attendance/print_reports',{'staff_name':staff_name,'month':month,'year':year},function(data){
        // $('#print').text('Print');
        // $('#print').attr('disabled',false);
          // window.open('<?php echo base_url();?>ad/attendance/print_reports','_blank',data);
      // });

    });
});
  </script>

<script type="text/javascript">
        $(document).ready(function(){
          $('#table').DataTable();
        });
      </script>




<script type="text/javascript">
    // Time Picker
    $('.time').timepicker({
        defaultTIme : false
    });

    $('.date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format:'dd/mm/yyyy'
    });
</script> 







      <?php $data=$this->db->get('profile')->result();
                        foreach($data as $r)
                        ?>
   
	<?php 
	$this->db->select('*');
	$this->db->from('preference_settings');
	$row=$this->db->get()->row_array();
	?>
    <footer class="footer" style="text-align: center !important;">
    
   <span class="text-center"> Software Maintained by : <a  class="text-muted" style="color:#fff !important;font-size: 14px;">&nbsp;<?php echo $row['cmp_companyname'];?></a>  ©  <?php echo date('Y');?>  &nbsp;&nbsp; <i class="fa fa-phone"></i> <?php echo $row['cmp_phoneno'];?> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-mobile"></i> <?php echo $row['cmp_mobileno'];?></span>
</footer>

<a href="https://api.whatsapp.com/send?phone=7373333321&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202." class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>

        <script>
            var resizefunc = [];
        </script>


        <!-- jQuery  -->


        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/detect.js"></script>
        <script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo base_url();?>assets/js/waves.js"></script>
        <script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>

         

        <!--Morris Chart-->
      <!-- **  // <script src="<?php echo base_url();?>assets/plugins/morris/morris.min.js"></script> -->
        <!-- ** <script src="<?php echo base_url();?>assets/plugins/raphael/raphael-min.js"></script> -->


        <!-- Counter Up  -->
        <script src="<?php echo base_url();?>assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- Dashboard init -->
<!-- **        <script src="<?php echo base_url();?>assets/pages/jquery.dashboard.js"></script> -->


        
        <!-- App js -->
        <script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
        
        
        <!--<script src="https://demos.creative-tim.com/now-ui-dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>-->
        <script src="<?php echo base_url();?>assets/js/chartjs.min.js"></script>
        <!--<script src="https://demos.creative-tim.com/now-ui-dashboard/assets/js/plugins/bootstrap-notify.js"></script>-->
        <!--<script src="https://demos.creative-tim.com/now-ui-dashboard/assets/js/now-ui-dashboard.min.js?v=1.5.0"></script>-->
        <script src="<?php echo base_url();?>assets/js/demo_chart.js"></script>
 
<script>
$('.dropdown-toggle').click(function(e) {
  if ($(document).width() > 768) {
    e.preventDefault();

    var url = $(this).attr('href');

       
    if (url !== '#') {
    
      window.location.href = url;
    }

  }
});
</script>
  
</body>

    </body>

<!-- Mirrored from coderthemes.com/flacto_1.3/green_1_light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Sep 2016 06:39:54 GMT -->
</html>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Coderthemes">
		<!-- App title -->
		<?php $data=$this->db->get('profile')->result();
		foreach($data as $r)
		?>
		<title> <?php echo $r->companyname;?></title>
		<!-- App CSS -->
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		 <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/images/favicon-90.ico">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>assets/images/favicon.png" type="image/jpg">
		<link href="<?php echo base_url();?>assets/css/core.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/components.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/pages.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/menu.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
		<style>
		    body {
    background: transparent;
    font-family: 'Quicksand', sans-serif !important;
    margin: 0;
    padding-bottom: 60px;
    overflow-x: hidden;
    color: #797979;
}
.login-logo
{
    padding: 0 15px;
}
.login-logo .media h3
{
    margin: 0px;
    font-size: 22px;
    color: #060606;
    margin-top: 19px;
    margin-bottom: 5px;
}
.login-logo .media h4
{
    margin: 7px 0 0;
    font-size: 24px;
    color: #0098da;
}
.panel-body {
    padding: 8px 15px 0px;
}
.login-logo .media img
{
    width: 70px;
    border-radius: 5px;
    padding: 0px;
    box-shadow: 2px 2px 11px #76b6e8;
    margin: 5px 8px 10px 0px;
}
.input-group-addon {
padding: 11px 15px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #fff;
    text-align: center;
    background-color: #0098da;
    border: 0px solid #0098da;
    border-radius: 5px 0 0 5px;
}
.input-group-addon1 {
    border-left: 0px solid #f5f5f5 !important;
    border-top: 1px solid #0098da;
    border-bottom: 1px solid #0098da;
    border-right: 1px solid #0098da;
    padding: 11px 15px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #fff;
    text-align: center;
    background-color: #f5f5f5;
    border: 1px solid #0098da;
    border-radius: 0px 5px 5px 0px;
    position: absolute;
    z-index: 999;
    right: 0;
    top: 0;
}
.form-control {
    background-color: #ffffff !important;
    border: 1px solid #2196f3;
    border-radius: 4px;
    color: #626262;
    padding: 7px 12px;
    height: 38px;
    max-width: 100%;
    -webkit-box-shadow: none;
    box-shadow: none;
    -webkit-transition: all 300ms linear;
    -moz-transition: all 300ms linear;
    -o-transition: all 300ms linear;
    -ms-transition: all 300ms linear;
    transition: all 300ms linear;
}
.log-footer p
{
    color: #fff;
    font-size: 17px;
    font-weight: 400;
    margin-bottom: 4px;
}
.log-footer p a
{
    color: #2196F3;
}
.btn-custom {
    background-color: #070707 !important;
    border-color: #070707 !important;
    border-radius: 5px;
}
.input-group .form-control:not(:first-child):not(:last-child), .input-group-addon:not(:first-child):not(:last-child), .input-group-btn:not(:first-child):not(:last-child) {
    border-radius: 0 5px 5px 0px;
}
.card-box {
    padding: 25px 20px 20px 20px;
    background-color: #ffffff;
    -webkit-border-radius: 5px;
    border-radius: 0px;
    -moz-border-radius: 5px;
    background-clip: padding-box;
    margin-bottom: 20px;
    border: 1px solid #f5f5f5;
    border-bottom: 3px solid #2477c9;
}
</style>
	</head>
	<body style="padding-bottom: 450px;background-image: url(<?php echo base_url();?>assets/images/log-back.png);background-size: contain;overflow-y: hidden;background-color: #022242;">

		<!--<div class="text-center logo-alt-box">-->
		<!--	<a href="#" class="logo"><span><span> &nbsp;</span></span></a>-->
		<!--</div>-->
		<div class="wrapper-page" style="margin-top: -40px;">
		    <br class="hide-br"><br class="hide-br"><br class="hide-br"><br class="hide-br"><br><br><br><br>
			<div class="m-t-30 card-box">
				<div class="text-left login-logo">
				 <!--   <div class="row">-->
				 <!--       <div class="col-md-3">-->
				 <!--   <img src="<?php echo base_url()?>upload/login_logo.png" style="float:left;" width="90px" height="80px">-->
				 <!--   </div>-->
				 <!--    <div class="col-md-6">-->
				    
					<!--</div>-->
					<!--</div>-->
					
					<div class="media" style="margin-left: 0px;">
                        <div class="media-left">
                    <img src="<?php echo base_url()?>upload/login_logo.png" class="media-object" style="width:85px">
                        </div>
                        <div class="media-body">
                    <h3>WELCOME TO</h3>
					<h4 style="font-family: 'Playfair Display SC', serif;"><?php echo $r->softwarename;?> <span style="font-size: 17px;color: red;">V 2.0</span></h4> 
                    </div>
                </div>
					
				</div>
				
				<?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
				<div class="alert alert-micro alert-info pastel light dark" >
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php print_r($msg); ?>
				</div>
				<?php } ?>
				<?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
				<div class="alert alert-danger alert-micro">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php print_r($msg); ?>
				</div>
				<?php } ?>
				<div class="panel-body" id="pad-mob">
					<form class="form-horizontal m-t-10" method="post" action="<?php echo base_url();?>login/validate" >

						<div class="form-group ">
							<div class="col-xs-12">
								<!--<input class="form-control" type="text"  name="username" id="username" placeholder="Username">-->
								<!--<span id="username_valid"></span>-->
							<div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-user"></i></span>
                             <input id="text" type="text" class="form-control" name="username" id="username" placeholder="Username">
                             <span id="username_valid"></span>
                           </div>
                         </div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<!--<input class="form-control" type="password" name="password" id="password"  placeholder="Password">-->
								<!--<div id="password_valid"></div>-->
								
								
								<div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                             <div id="show_hide_password">
                             <input id="password" type="password" class="form-control" name="password" placeholder="Password" style="border-radius: 0px 5px 5px 0px;border-right: 0px;">
                             <div id="password_valid"></div>
                              <div class="input-group-addon1">
                             <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                           </div>
                          
                              </div>
                           
							</div>
						</div>

						<div class="form-group ">
							<div class="col-xs-12">
								<div class="checkbox checkbox-custom">
									<input id="remember" type="checkbox">
									<label for="checkbox-signup">
										Remember me
									</label>
								</div>

							</div>
						</div>

						<div class="form-group text-center m-t-30">
							<div class="col-xs-12">
								<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light text-uppercase" id="submit" type="submit"><b>Log In</b></button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<p style="text-align: center;font-size: 17px;color: #e8e7e7;font-weight: 400;margin-top: -4px;margin-bottom: 11px;">Powered By - <a href="#" style="color:#2196F3;"> Myoffice Solutions</a></p>
			<div class="text-center log-footer">
			    <p>for sales & enquiry +91 7373 333 321 - +91 860 870 1222</p>
			    <p>Visit : <a href="https://myoffice.ind.in/" target="_blank">myoffice.ind.in</a></p>
			</div>
		</div>
		<script>
		var resizefunc = [];
		</script>

		<!-- jQuery  -->
		<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/detect.js"></script>
		<script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script>
		<script src="<?php echo base_url();?>assets/js/waves.js"></script>
		<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>

		<!-- App js -->
		<script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
		
		<script>
		    $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
		</script>
		
		<script type="text/javascript">
		$(document).ready(function(){
			$('#submit').click(function(){
				var username=$('#username');
				var password=$('#password');
				if(username.val()=='')
				{
					username.focus();
					$('#username_valid').html('<span><font color="red">Please Enter the Username</span>');
					username.keyup(function(){ $('#username_valid').html(''); });
					return false;
				}
				if(password.val()=='')
				{
					password.focus();
					$('#password_valid').html('<span><font color="red">Please Enter The Password');
					password.keyup(function(){ $('#password_valid').html(''); });
					return false;
				}

			});
		});
		
		
		$(function() {
			if (localStorage.chkbx && localStorage.chkbx != '') {
				$('#remember').attr('checked', 'checked');
				$('#username').val(localStorage.usrname);
				$('#password').val(localStorage.pass);
			} 
			else
			{
				$('#remember').removeAttr('checked');
				$('#username').val('');
				$('#password').val('');
			}

			$('#remember').click(function() {
				if ($('#remember').is(':checked')) {
					// save username and password
					localStorage.usrname = $('#username').val();
					localStorage.pass = $('#password').val();
					localStorage.chkbx = $('#remember').val();
				} 
				else 
				{
					localStorage.usrname = '';
					localStorage.pass = '';
					localStorage.chkbx = '';
				}
			});
		});
		</script>
	</body>
</html>
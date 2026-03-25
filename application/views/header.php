<?php $data = $this->db->get('profile')->result();
foreach ($data as $r)
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="author" content="Myoffice Billing">


	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/menu.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/portlet.css" rel="stylesheet" type="text/css" />

	<!--<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/png">  -->
	<!--<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/png">-->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon-90.ico">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates&display=swap" rel="stylesheet">
	<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">-->
	<link href="<?php echo base_url(); ?>assets/css/demo_chart.css" rel="stylesheet">

	<style>
		#topnav {
			position: relative;
			right: 0;
			left: 0;
			top: 0px;
			z-index: 998;
			background-color: transparent;
			border: 0;
			-webkit-transition: all .5s ease;
			transition: all .5s ease;
			min-height: 0;
		}

		.topbar {
			left: 0px;
			position: relative;
			right: 0;
			top: 0px;
			z-index: 1000;
		}

		@media only screen and (max-width: 500px) {
			.topbar {
				left: 0pxpx;
				position: relative;
				right: 0;
				top: 0;
				z-index: 1000;
			}

			.hide-mob {
				display: block;
			}
		}

		.hide-mob {
			display: none;
		}

		.content-page>.content {
			margin-top: 0px;
			padding: 5px 5px 15px 5px;
		}

		@media only screen and (min-width: 768px) {
			.dropdown:hover .dropdown-menu {
				display: block;
			}
		}

		@media (max-width: 767px) {
			.navbar-nav .open .dropdown-menu {
				background-color: #ffffff;
				box-shadow: 0 2px 5px 0 rgb(0 0 0 / 26%);
				left: auto;
				position: relative;
				right: 0;
			}
		}


		textarea[readonly] {
			background-color: #e8e8e8 !important;
		}

		input[readonly] {
			background-color: #e8e8e8 !important;
		}

		.profile-in-header .dropdown-toggle {
			background: #0291DD;
		}

		.profile-in-header .dropdown-toggle {
			border-style: none solid;
		}

		.navbar-right .dropdown-menu {
			right: 0;
			width: 100%;
			border-radius: 0px;
			margin-top: 1px;
		}

		.widget-profile .dropdown-toggle {
			padding: 9px 10px;
			-moz-border-radius: 0;
			-webkit-border-radius: 0;
			border-radius: 0;
			-moz-box-shadow: none;
			-webkit-box-shadow: none;
			box-shadow: none;
		}

		.profile-in-header .name {
			width: 130px;
		}

		.widget-profile .name {
			display: inline-block;
			padding-right: 10px;
			vertical-align: middle;
			font-size: 15px;
			font-weight: bold;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			color: #fff;
		}

		.widget-profile img {
			max-width: 38px;
			-moz-border-radius: 50%;
			-webkit-border-radius: 50%;
			border-radius: 50%;
		}

		.float {
			position: fixed;
			width: 60px;
			height: 60px;
			bottom: 20px;
			right: 20px;
			background-color: #25d366;
			color: #FFF;
			border-radius: 50px;
			text-align: center;
			font-size: 30px;
			box-shadow: 2px 2px 3px #999;
			z-index: 100;
		}

		.my-float {
			margin-top: 16px;
		}

		.datepicker table thead {
			background: #2477c9 !important;
		}

		.datepicker table tr td span:hover {
			background: #4492e3 !important;
		}
	</style>
</head>

<body class="fixed-left">
	<div id="wrapper">

		<section style="background: #2477c9;">
			<div class="container">
				<div class="row">

					<?php $userType =  $this->session->userdata('rcbio_usertype');
					if ($userType == 'A') {
						$dashboardLink = 'dashboard';
					} else {
						$logMenus = $this->db->where('login_id', $this->session->userdata('rcbio_userid'))->get('user_menu')->row();
						$dashboardLink = $logMenus->sub_menu_link;
					}
					?>
					<div class="col-md-4">
						<a href="<?php echo base_url() . $dashboardLink; ?>"><img class="head-logo" src="<?php echo base_url() ?>assets/images/logo.PNG" style="vertical-align: initial;"></a>

						<!--<a href="<?php echo base_url() . $dashboardLink; ?>" class="logo"><img src="<?php echo base_url() ?>assets/images/logo-white.png" style="width: 35px;">-->
						<!--<span style="font-size: 19px;position: relative;top: 3px;font-weight: 600;font-family: 'Playfair Display SC', serif;"><?php echo $r->softwarename; ?>  <span style="font-family: 'Quicksand', sans-serif;font-size: 13px;">V 1.6.0</span></span>-->
						<!--<span><img src="assets/images/logo.png" alt="logo" style="height: 20px;"></span>-->
					</div>

					<div class="col-md-8">

						<!-- <div class="pull-left">
<button class="button-menu-mobile open-left waves-effect waves-light">
<i class="zmdi zmdi-menu"></i>
</button>
<span class="clearfix"></span>
</div -->

						<div class="top-nav">

							<?php $userType =  $this->session->userdata('rcbio_usertype');
							if ($userType == 'A') {
							?>
					<li style="color:white;margin-top:15px">Welcome ! <?php echo $this->session->userdata('rcbio_username'); ?></li>
								<li id="hide-new-mob"><a href="<?php echo base_url(); ?>customer"><i class="zmdi zmdi-account"></i> <span>Add Supplier / Customer</span> </a></li>
								<!-- <li><a href="<?php echo base_url(); ?>dcbill"><i class="zmdi zmdi-assignment-o"></i> <span>Add DC</span> </a></li> -->
								<li id="hide-new-mob"><a href="<?php echo base_url(); ?>expenses"><i class="zmdi zmdi-money-box"></i> <span>Add Expenses</span> </a></li>
								<li id="hide-new-mob"><a href="<?php echo base_url(); ?>quotation"><i class="zmdi zmdi-assignment-o"></i> <span>Add Quotation</span> </a></li>

								<li><a href="<?php echo base_url(); ?>login/logout"><i  class="zmdi zmdi-power"></i> <span style="font-size:15px;">Logout</span> </a></li>
							<?php
							} else {
								$topMenu = $this->db->where('id', $this->session->userdata('rcbio_userid'))->get('login_details')->row();
								if (count($topMenu) > 0) {
									if ($topMenu->add_party == '1') {
										echo '<li><a href="' . base_url() . 'customer"><i class="zmdi zmdi-account"></i> <span>Add Party </span> </a></li>';
									}
									if ($topMenu->add_expenses == '1') {
										echo '<li><a href="' . base_url() . 'expenses"><i class="zmdi zmdi-money-box"></i> <span>Add Expenses </span> </a></li>';
									}
									if ($topMenu->add_quotation == '1') {
										echo '<li><a href="' . base_url() . 'quotation"><i class="zmdi zmdi-assignment-o"></i> <span>Add Quotation </span> </a></li>';
									}
								}
							}
							?>
							<li>

								<!-- <div class="widget-profile profile-in-header">
									<button type="button" >Logout</span></button>
									<ul role="menu" class="dropdown-menu">

										<li class="power"><a href="<?php echo base_url(); ?>login/logout"><i class="fa fa-power-off"></i> &nbsp; Log Out</a></li>
									</ul>
								</div> -->
							</li>
						</div>


					</div>
				</div>

			</div>
		</section>



		<header id="topnav">


			<div class="navbar-custom">
				<div class="container-fluid">
					<div id="navigation">
						<!-- Navigation Menu-->
						<?php $userType =  $this->session->userdata('rcbio_usertype');
						if ($userType == 'A') {
						?>
							<ul class="navigation-menu">
								<li class="has-submenu" id="attendance"> <a href="<?php echo base_url(); ?>dashboard"><i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span> </a></li>

								<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-view-headline"></i> <span>Sales</span> </a>
									<ul class="submenu">
										<li><a href="<?php echo base_url(); ?>invoice">Add Invoice</a></li>
										<li><a href="<?php echo base_url(); ?>invoice/view">Invoice Reports</a></li>
										<!-- <li><a href="<?php echo base_url(); ?>invoice/pending_view">Pending Amount</a></li>
<li><a href="<?php echo base_url(); ?>collection_amount/view">Collection Amount</a></li> -->
										<li><a href="<?php echo base_url(); ?>invoice_statement/view">Party statement</a></li>
										<li><a href="<?php echo base_url(); ?>tax/view">GST Reports</a></li>
										<li><a href="<?php echo base_url(); ?>proforma_invoice">Add Proforma Invoice</a></li>
										<li><a href="<?php echo base_url(); ?>proforma_invoice/view">Proforma Invoice Reports</a></li>
										<li><a href="<?php echo base_url(); ?>purchaseorder">Work  Order</a></li>
										<li><a href="<?php echo base_url(); ?>purchaseorder/view">Work Order  Reports</a></li>
										<li><a href="<?php echo base_url(); ?>purchaseorder/pending">Work Order Pending</a></li>
										<!-- <li><a href="<?php echo base_url(); ?>Qrcode">Qrcode</a></li> -->
									</ul>
								</li>


								<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-cart"></i> <span>Purchase</span> </a>
									<ul class="submenu">
										<li><a href="<?php echo base_url(); ?>purchase">Purchase Inward</a></li>
										<li><a href="<?php echo base_url(); ?>purchase/view">Purchase Reports</a></li>
										<!-- <li><a href="<?php echo base_url(); ?>purchase/pending">Pending Amount</a></li>
<li><a href="<?php echo base_url(); ?>purchase_pending/view">Paid Amount</a></li> -->
										<li><a href="<?php echo base_url(); ?>purchase_statement/view">Party Statement</a></li>
										<li><a href="<?php echo base_url(); ?>purchasetax/view">GST Reports</a></li>
										<li><a href="<?php echo base_url(); ?>supplier_purchaseorder">Supplier Purchase Order</a></li>
										<li><a href="<?php echo base_url(); ?>supplier_purchaseorder/view">Supplier Purchase Order Reports</a></li>
										<li><a href="<?php echo base_url(); ?>Supplier_purchaseorder/pending">Supplier Purchase Order Pending</a></li>

									</ul>
								</li>
								<?php $withsel = $this->db->get('preference_settings')->row();
								if ($withsel->cashbill_add == 'With Cashbill') {
								?>
									<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-view-headline"></i> <span>Cash Bill</span> </a>
										<ul class="submenu">
											<li><a href="<?php echo base_url(); ?>cashbill">Add Cash Bill</a></li>
											<li><a href="<?php echo base_url(); ?>cashbill/listing">Cash Bill Reports</a></li>
										</ul>
									</li>
								<?php } ?>
								<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-assignment-o"></i><span>Voucher</span> </a>
									<ul class="submenu">
										<li><a href="<?php echo base_url(); ?>voucher">Add Voucher</a></li>
										<li><a href="<?php echo base_url(); ?>voucher/reports">Voucher Reports</a></li>
										<li><a href="<?php echo base_url(); ?>salesreturn">Debit (or) Credit Note</a></li>
										<li><a href="<?php echo base_url(); ?>salesreturn/view">Debit (or) Credit Note Reports</a></li>
									</ul>
								</li>
								<?php
								if ($withsel->inward_add == 'With Inward') { ?>
									<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="fa fa-bars"></i> <span>Inward</span> </a>
										<ul class="submenu">
											<li><a href="<?php echo base_url(); ?>inward">Add Inward</a></li>
											<li><a href="<?php echo base_url(); ?>inward/view">Inward Reports</a></li>
											<li><a href="<?php echo base_url(); ?>inward/pending">Inward Pending</a></li>

											<!-- <li><a href="<?php echo base_url(); ?>inwardstock">Inward Stock</a></li> -->
											<li><a href="<?php echo base_url(); ?>inward/itemwise_report">Itemwise Inward Reports</a></li>
											<li><a href="<?php echo base_url(); ?>inward/dcwise_report">InwardWise Dc Reports</a></li>
										</ul>
									</li>
								<?php } ?>
								<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="fa fa-paw"></i> <span>DC</span> </a>
									<ul class="submenu">
										<?php $prefer = $this->db->where('id', 1)->get('preference_settings')->row();
										if ($prefer->sales_dc == 1) {
										?>
											<li><a href="<?php echo base_url(); ?>dcbill">Add Sales DC</a></li>
											<li><a href="<?php echo base_url(); ?>dcbill/view">Sales DC Reports</a></li>
											<li><a href="<?php echo base_url(); ?>dcbill/pending">DC Pending</a></li>
											 <!--<li><a href="<?php echo base_url(); ?>dcbill/inwards">DC Inwardreports</a></li> -->
										<?php  }
										if ($prefer->material_dc == 2) { ?>
											<li><a href="<?php echo base_url(); ?>material_dc">Add Material DC</a></li>
											<li><a href="<?php echo base_url(); ?>material_dc/view">Material DC Reports</a></li>
										<?php  }
										if ($prefer->jobwork_dc == 3) { ?>
											<li><a href="<?php echo base_url(); ?>joborder_dc">Add Jobwork DC</a></li>
											<li><a href="<?php echo base_url(); ?>joborder_dc/view">Jobwork DC Reports</a></li>
											<li><a href="<?php echo base_url(); ?>joborder_dc/pending">Jobwork DC Pending</a></li>
										<?php } ?>
									</ul>
								</li>


								<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <span>Stock</span> </a>
									<ul class="submenu">
										<li><a href="<?php echo base_url(); ?>stockmaster">Add Stock</a></li>
										<li><a href="<?php echo base_url(); ?>daily_stockreports">Daily Stock Reports</a></li>
										<li><a href="<?php echo base_url(); ?>itemwise_report" target="_blank">Itemwise Reports</a></li>
									</ul>
								</li>


								<?php if ($withsel->attendance == '1') { ?>
									<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-filter-list"></i><span>Attendance</span> </a>
										<ul class="submenu">
											<li><a href="<?php echo base_url(); ?>attendance">Create Staff</a></li>
											<li><a href="<?php echo base_url(); ?>attendance/view">Staff List</a></li>
											<li><a href="<?php echo base_url(); ?>attendance/dailyentry">Daily Attendance</a></li>
											<li><a href="<?php echo base_url(); ?>attendance/reports">Attendance Report</a></li>
										</ul>
									</li>
								<?php } ?>

								<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-filter-list"></i><span>Reports</span> </a>
									<ul class="submenu">
										<li><a href="<?php echo base_url(); ?>customer/view">Supplier / Customer Reports</a></li>

										<li><a href="<?php echo base_url(); ?>expenses/reports">Expenses Reports</a></li>
										<li><a href="<?php echo base_url(); ?>quotation/view">Quotation Reports</a></li>
									</ul>
								</li>

								<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-settings"></i> <span>Old Reports</span></a>
									<ul class="submenu">
										<li><a href="<?php echo base_url(); ?>oldPurchaseReports">Purchase Reports</a></li>
										<li><a href="<?php echo base_url(); ?>old_purchase_statement/view">Purchase Party Statement</a></li>
										<li><a href="<?php echo base_url(); ?>oldInvoiceReports">Invoice Reports</a></li>
										<li><a href="<?php echo base_url(); ?>old_invoice_statement/view">Invoice Party statement</a></li>
										<li><a href="<?php echo base_url(); ?>olddcbill/view">Sales DC Reports</a></li>
										<li><a href="<?php echo base_url(); ?>oldmaterial_dc/view">Material DC Reports</a></li>
										<li><a href="<?php echo base_url(); ?>oldjoborder_dc/view">Jobwork DC Reports</a></li>
										<li><a href="<?php echo base_url(); ?>oldpurchaseOrder/view">Purchase Order Reports</a></li>
										<li><a href="<?php echo base_url(); ?>old_voucher/reports">Voucher Reports</a></li>
										<li><a href="<?php echo base_url(); ?>oldsalesreturn/view">Salesreturn Reports</a></li>
										<li><a href="<?php echo base_url(); ?>oldexpenses/reports">Expenses Reports</a></li>
									</ul>
								</li>
								
								<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <span>Report Creation</span> </a>
									<ul class="submenu">
										<li><a href="<?php echo base_url(); ?>Mtc/create_mtc">Create MTC</a></li>
										<li><a href="<?php echo base_url(); ?>Mtc/reports_mtc">Reports MTC</a></li>
										<li><a href="<?php echo base_url(); ?>Mtc/create_inspection">Create Inspection</a></li>
										<li><a href="<?php echo base_url(); ?>Mtc/reports_inspection">Reports Inspection</a></li>
										<li><a href="<?php echo base_url(); ?>Mtc/ut">Create UT</a></li>
										<li><a href="<?php echo base_url(); ?>Mtc/ut_reports">UT Reports</a></li>
										<li><a href="<?php echo base_url(); ?>Mtc/mpt">Create MPT</a></li>
										<li><a href="<?php echo base_url(); ?>Mtc/mpt_reports">MPT Reports</a></li>
										<li><a href="<?php echo base_url(); ?>Mtc/dpt">Create DPT</a></li>
										<li><a href="<?php echo base_url(); ?>Mtc/dpt_reports">DPT Reports</a></li>
									</ul>
								</li>

								<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-settings"></i> <span>Settings</span></a>
									<ul class="submenu">
										<li><a href="<?php echo base_url(); ?>taxtype">Tax Type</a></li>
										<li><a href="<?php echo base_url(); ?>uom">Add UOM</a></li>
										<li><a href="<?php echo base_url(); ?>Grade">Add Grade</a></li>
										<!-- <li><a href="<?php echo base_url(); ?>hsnMaster">Add HSNNO</a></li> -->
										<li><a href="<?php echo base_url(); ?>itemmaster">Add Item</a></li>
											<li><a href="<?php echo base_url(); ?>Inspectionmaster">Add Inspection Master</a></li>
										<!--   <li><a href="<?php echo base_url(); ?>card">Add Card</a></li> -->
										<li><a href="<?php echo base_url(); ?>headers">Account Headers</a></li>
										<li><a href="<?php echo base_url(); ?>profile">Company Profile</a></li>
										<!--  <li><a href="<?php echo base_url(); ?>user">Create User</a></li>
<li><a href="<?php echo base_url(); ?>category">Add Category</a></li> -->
										<li><a href="<?php echo base_url(); ?>backup ">Backup Settings</a></li>
										<li><a href="<?php echo base_url(); ?>support ">Help Desk</a></li>
										<li><a href="<?php echo base_url(); ?>usermaster ">User Manager</a></li>
									</ul>
								</li>
							</ul>
						<?php
						} else {
							$havingMenus = $this->db->where('login_id', $this->session->userdata('rcbio_userid'))->order_by("id", "asc")->get('user_menu')->result();
							if (count($havingMenus) > 0) {
								echo '<ul class="navigation-menu">';
								$mainMenuQuery = $this->db->where('login_id', $this->session->userdata('rcbio_userid'))->order_by("id", "asc")->group_by('main_menu')->get('user_menu')->result();
								if (count($mainMenuQuery) > 0) {
									foreach ($mainMenuQuery as $mm) {
										/*$subMenuQueryq = $this->db->where('login_id',$this->session->userdata('rcbio_userid'))->where('main_menu',$mm->main_menu)->get('user_menu')->result();
if(count($subMenuQueryq) > 1 )
{
$mainMenuLink = 'javascript:void(0);';
}
else
{
$mainMenuLink = $mm->sub_menu;
}*/
										echo '<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-view-headline"></i> <span>' . $mm->main_menu . '</span> </a>';
										$subMenuQuery = $this->db->where('login_id', $this->session->userdata('rcbio_userid'))->where('main_menu', $mm->main_menu)->get('user_menu')->result();
										if (count($subMenuQuery) > 0) {
											echo '<ul class="submenu">';
											foreach ($subMenuQuery as $sm) {
												echo '<li><a href="' . base_url() . $sm->sub_menu_link . '">' . $sm->sub_menu . '</a></li>';
											}
											echo '</ul>';
										}
										echo '</li>';
									}
								}
								echo '</ul>';
							}
						}
						?>
						<!-- End navigation menu -->
					</div> <!-- end #navigation -->
				</div> <!-- end container -->
			</div> <!-- end navbar-custom -->
		</header>




		<!-- Static navbar -->
		<nav class="navbar navbar-default" id="hide-mob">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sales <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>invoice">Add Invoice</a></li>
								<li><a href="<?php echo base_url(); ?>invoice/view">Invoice Reports</a></li>
								<!-- <li><a href="<?php echo base_url(); ?>invoice/pending_view">Pending Amount</a></li>
<li><a href="<?php echo base_url(); ?>collection_amount/view">Collection Amount</a></li> -->
								<li><a href="<?php echo base_url(); ?>invoice_statement/view">Party statement</a></li>
								<li><a href="<?php echo base_url(); ?>tax/view">GST Reports</a></li>
								<li><a href="<?php echo base_url(); ?>proforma_invoice">Add Proforma Invoice</a></li>
								<li><a href="<?php echo base_url(); ?>proforma_invoice/view">Proforma Invoice Reports</a></li>
								<li><a href="<?php echo base_url(); ?>purchaseorder">Customer Purchase Order</a></li>
								<li><a href="<?php echo base_url(); ?>purchaseorder/view">Customer Purchase Order Reports</a></li>
								<li><a href="<?php echo base_url(); ?>purchaseorder/pending">Customer Purchase Order Pending</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Purchase <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>purchase">Purchase Inward</a></li>
								<li><a href="<?php echo base_url(); ?>purchase/view">Purchase Reports</a></li>
								<!-- <li><a href="<?php echo base_url(); ?>purchase/pending">Pending Amount</a></li>
<li><a href="<?php echo base_url(); ?>purchase_pending/view">Paid Amount</a></li> -->
								<li><a href="<?php echo base_url(); ?>purchase_statement/view">Party Statement</a></li>
								<li><a href="<?php echo base_url(); ?>purchasetax/view">GST Reports</a></li>
								<li><a href="<?php echo base_url(); ?>supplier_purchaseorder">Supplier Purchase Order</a></li>
								<li><a href="<?php echo base_url(); ?>supplier_purchaseorder/view">Supplier Purchase Order Reports</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cashbill <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>cashbill">Add Cash Bill</a></li>
								<li><a href="<?php echo base_url(); ?>cashbill/listing">Cash Bill Reports</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Voucher <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>voucher">Add Voucher</a></li>
								<li><a href="<?php echo base_url(); ?>voucher/reports">Voucher Reports</a></li>
								<li><a href="<?php echo base_url(); ?>salesreturn">Debit (or) Credit Note</a></li>
								<li><a href="<?php echo base_url(); ?>salesreturn/view">Debit (or) Credit Note Reports</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inward <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>inward">Add Inward</a></li>
								<li><a href="<?php echo base_url(); ?>inward/view">Inward Reports</a></li>
								<li><a href="<?php echo base_url(); ?>inward/pending">Inward Pending</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dc <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>dcbill">Add Sales DC</a></li>
								<li><a href="<?php echo base_url(); ?>dcbill/view">Sales DC Reports</a></li>
								<li><a href="<?php echo base_url(); ?>dcbill/pending">DC Pending</a></li>
								<li><a href="<?php echo base_url(); ?>material_dc">Add Material DC</a></li>
								<li><a href="<?php echo base_url(); ?>material_dc/view">Material DC Reports</a></li>
								<li><a href="<?php echo base_url(); ?>joborder_dc">Add Jobwork DC</a></li>
								<li><a href="<?php echo base_url(); ?>joborder_dc/view">Jobwork DC Reports</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stock <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>stockmaster">Add Stock</a></li>
								<li><a href="<?php echo base_url(); ?>daily_stockreports">Daily Stock Reports</a></li>
								<li><a href="<?php echo base_url(); ?>itemwise_report" target="_blank">Itemwise Reports</a></li>
							</ul>
						</li>


						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>customer/view">Supplier / Customer Reports</a></li>

								<li><a href="<?php echo base_url(); ?>expenses/reports">Expenses Reports</a></li>
								<li><a href="<?php echo base_url(); ?>quotation/view">Quotation Reports</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Old Reports <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>oldPurchaseReports">Purchase Reports</a></li>
								<li><a href="<?php echo base_url(); ?>old_purchase_statement/view">Purchase Party Statement</a></li>
								<li><a href="<?php echo base_url(); ?>oldInvoiceReports">Invoice Reports</a></li>
								<li><a href="<?php echo base_url(); ?>old_invoice_statement/view">Invoice Party statement</a></li>
								<li><a href="<?php echo base_url(); ?>olddcbill/view">Sales DC Reports</a></li>
								<li><a href="<?php echo base_url(); ?>oldmaterial_dc/view">Material DC Reports</a></li>
								<li><a href="<?php echo base_url(); ?>oldjoborder_dc/view">Jobwork DC Reports</a></li>
								<li><a href="<?php echo base_url(); ?>oldpurchaseOrder/view">Purchase Order Reports</a></li>
								<li><a href="<?php echo base_url(); ?>old_voucher/reports">Voucher Reports</a></li>
								<li><a href="<?php echo base_url(); ?>oldsalesreturn/view">Salesreturn Reports</a></li>
								<li><a href="<?php echo base_url(); ?>oldexpenses/reports">Expenses Reports</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>taxtype">Tax Type</a></li>
								<li><a href="<?php echo base_url(); ?>uom">Add UOM</a></li>
								<!-- <li><a href="<?php echo base_url(); ?>hsnMaster">Add HSNNO</a></li> -->
								<li><a href="<?php echo base_url(); ?>itemmaster">Add Item</a></li>
								<!--   <li><a href="<?php echo base_url(); ?>card">Add Card</a></li> -->
								<li><a href="<?php echo base_url(); ?>headers">Account Headers</a></li>
								<li><a href="<?php echo base_url(); ?>profile">Company Profile</a></li>
								<!--  <li><a href="<?php echo base_url(); ?>user">Create User</a></li>
<li><a href="<?php echo base_url(); ?>category">Add Category</a></li> -->
								<li><a href="<?php echo base_url(); ?>backup ">Backup Settings</a></li>
								<li><a href="<?php echo base_url(); ?>support ">Help Desk</a></li>
								<li><a href="<?php echo base_url(); ?>usermaster ">User Manager</a></li>
							</ul>
						</li>

					</ul>

				</div>
				<!--/.nav-collapse -->
			</div>
			<!--/.container-fluid -->
		</nav>

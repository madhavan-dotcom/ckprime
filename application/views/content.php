	
	<style>
		.mci
		{
			color: #fcfcfc;
			border: 1px solid #d4d4d4;
			padding: 12px;
			background-color: #0291dd;
		}
		.card-box h3
		{
		    font-size: 19px;
            margin-bottom: 0px;
		}
		.m-t-30 {
    margin-top: 20px !important;
}
.card-box {
    padding: 15px 20px 10px 20px;
    background-color: #ffffff;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-border-radius: 5px;
    background-clip: padding-box;
    margin-bottom: 7px;
    border-bottom: 5px solid #c1e0ff;
}
		.panel-header 
		{
		        padding-top: 80px;
    padding-bottom: 45px;
    background: #141e30;
    background: linear-gradient(90deg,#0c2646 0,#204065 60%,#2a5788);
    position: relative;
    overflow: hidden;
		}
		.card-chart
		{
		 background: #fff;
         padding: 15px 0px 16px 0px;
         margin-top: 26px;
         margin-bottom: 26px;
		}
		.card-header
		{
		  margin-left: 10px;
		}
		.card-footer{
		  margin-left: 10px;
		}
		.chartjs-render-monitor
		{
		   display: block;
           width: 1319px;
           height: 220px;
		}
		.card {
    border: 0;
    border-radius: .1875rem;
    display: inline-block;
    position: relative;
    width: 100%;
    margin-bottom: 20px;
    box-shadow: 0 1px 15px 1px rgba(39,39,39,.1);
}
	</style>
	<?php 
	error_reporting(0);	
	$data=$this->db->get('profile')->result();
	foreach($data as $r)
	?>
	<title> <?php echo $r->companyname;?></title>
	<div class="content-page">
	<div class="content">
	<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<ul class="nav nav-pills nav-pills-custom display-xs-none pull-right">
				<li role="presentation"><a href="#">Today</a></li>
				<li role="presentation" class="active"><a href="#"><?php  echo date('l jS \of F Y');?></a></li>
			</ul>
			<!--<h4 class="page-title">Dashboard</h4>-->
		</div>
	</div>
	<?php 
	$count=count($cus);
	$count1=count($sup);?>
	<div class="row" style="margin-bottom:10px;">
		<?php
	/*
		foreach ($invoice as $row) {
			@$sales[]=$row['grandtotal'];
			@$paid[]=$row['paid'];
			@$balance[]=$row['balance'];
		}
		@$sales1=array_sum($sales);
		@$paid1=array_sum($paid);
		@$balance1=array_sum($balance);*/
		?>
		<div class="col-lg-5">
			<div class="card-box">
				<div class="dropdown pull-right"></div>
				<h4 class="header-title m-t-0">Total Sales</h4>
				<div class="row text-left m-t-30">
					<div class="col-xs-3">
						<h3 ><?php echo number_format($sales);?></h3>
						<p class="text-muted text-overflow">Sales</p>
					</div>
					<div class="col-xs-3">
						<h3 style="color: #31991e !important;"><?php echo number_format($receivable);?></h3>
						<p style="color: #31991e !important;" class="text-muted text-overflow" title="Receivable">Receivable</p>
					</div>
					<div class="col-xs-2">
						<h3 style="color:#f81604;"><?php echo number_format($salesBalance);?></h3>
						<p style="color:#f81604 !important;" class="text-muted text-overflow">Balance</p>
					</div>
					<div class="col-xs-4">
						<h3 ><?php echo number_format($curMonthSales);?></h3>
						<p class="text-muted text-overflow">Current Month</p>
					</div>
				</div>
			</div>
		</div>

		<?php
		/*foreach ($purchase as $row) {
			@$saless[]=$row['grandtotal'];
			@$paids[]=$row['paid'];
			@$balances[]=$row['balance'];
		}
		@$sales11=array_sum($saless);
		@$paid11=array_sum($paids);
		@$balance11=array_sum($balances);*/
		?>
		<div class="col-lg-4">
			<div class="card-box">
				<div class="dropdown pull-right"></div>
				<h4 class="header-title m-t-0">Total Purchase</h4>
				<div class="row text-left m-t-30">
					<div class="col-xs-3">
						<h3 ><?php echo number_format($purchase);?></h3>
						<p class="text-muted text-overflow"> Purchase</p>
					</div>
					<div class="col-xs-2" style="padding: 0px;">
						<h3 style="color:#f81604;"><?php echo number_format($payable);?></h3>
						<p style="color:#f81604 !important;" class="text-muted text-overflow" title="Payable">Payable</p>
					</div>
					<div class="col-xs-3">
						<h3 style="color: #31991e !important;"><?php echo number_format($purchaseBalance);?></h3>
						<p style="color: #31991e !important;" class="text-muted text-overflow">Balance</p>
					</div>
					<div class="col-xs-4" style="padding: 0px;">
						<h3 ><?php echo number_format($curMonthpurchase);?></h3>
						<p class="text-muted text-overflow">Current Month</p>
					</div>
				</div>
			</div>
		</div>
		
		
			<div class="col-lg-3">
			<div class="card-box">
				<div class="dropdown pull-right"></div>
				<h4 class="header-title m-t-0">Expenses</h4>
				<div class="row text-left m-t-30">
					<div class="col-xs-6">
						<h3 ><?php echo number_format($totalExpenses);?></h3>
						<p class="text-muted text-overflow"> Total Expenses</p>
					</div>
					<div class="col-xs-6">
						<h3 ><?php echo number_format($currExpenses);?></h3>
						<p class="text-muted text-overflow" title="This Month Expenses">Current Month</p>
					</div>
				</div>
			</div>
		</div>
		
		
		<!---->
	</div>

		<div class="container-fluid" style="padding: 0px;">
	    <h3 style="position: absolute;z-index: 999;color: #fff;margin-left: 30px;margin-top: 20px;width: 100%;padding-bottom: 7px;"><?php echo date("Y");?>-<?php echo date("Y",strtotime("+1 year"));?> Sales Report</h3>
	<div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
      </div>
      <div class="content">
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-chart" style="background-color:#242e3691">
              <div class="card-header">
                <h5 class="card-category" style="color:#fff"><?php echo date("Y");?>-<?php echo date("Y",strtotime("+1 year"));?></h5>
                <h4 class="card-title" style="color:#fff;font-size:26px;">Purchase Report</h4>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="lineChartExample" style="height: 250px;"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card card-chart" style="background-color:black" >
              <div class="card-header">
                <h5 class="card-category" style="color:white"><?php echo date("Y");?>-<?php echo date("Y",strtotime("+1 year"));?></h5>
                <h4 class="card-title" style="color:white">Voucher  Report</h4>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="lineChartExampleWithNumbersAndGrid" style="height: 250px;"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="col-lg-4 col-md-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category"><?php echo date("Y");?>-<?php echo date("Y",strtotime("+1 year"));?></h5>
                <h4 class="card-title">Sales Report</h4>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="barChartSimpleGradientsNumbers" style="height: 250px;"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
</div>
	
	
	<div class="row">
	<div class="col-lg-4">
		<div class="card-box">
			<div class="dropdown pull-right"></div>
			<h4 class="header-title m-t-0">Expenses</h4>
			<div class="row text-center m-t-30">
				<a href="<?php echo base_url();?>expenses">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-money-box mci"></i></h2>
						<p class="text-muted text-overflow">Expenses</p>
					</div>
				</a>
				<a href="<?php echo base_url();?>expenses/reports">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-collection-text mci"></i></h2>
						<p class="text-muted text-overflow">Reports</p>
					</div>
				</a>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="card-box">
			<div class="dropdown pull-right"></div>
			<h4 class="header-title m-t-0">Delivery Challan</h4>
			<div class="row text-center m-t-30">
				<a href="<?php echo base_url();?>dcbill">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-assignment-o mci"></i></h2>
						<p class="text-muted text-overflow">Delivery Challan</p>
					</div>
				</a>
				<a href="<?php echo base_url();?>dcbill/view">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-collection-text mci"></i></h2>
						<p class="text-muted text-overflow">Reports</p>
					</div>
				</a>
			</div>
		</div>
	</div>
	
	<div class="col-lg-4">
		<div class="card-box">
			<div class="dropdown pull-right"></div>
			<h4 class="header-title m-t-0">Quotation</h4>
			<div class="row text-center m-t-30">
				<a href="<?php echo base_url();?>quotation">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-shopping-basket mci"></i></h2>
						<p class="text-muted text-overflow">Quotation</p>
					</div>
				</a>
				<a href="<?php echo base_url();?>quotation/view">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-collection-text mci"></i></h2>
						<p class="text-muted text-overflow">Reports</p>
					</div>
				</a>
			</div>
		</div>
	</div>

	</div>
	</div> 
	</div> 
	
	
	<div class="container">
	
		<div class="col-lg-4">
			<div class="card-box">
				<div class="dropdown pull-right"></div>
				<h4 class="header-title m-t-0">Sales</h4>
				<div class="row text-center m-t-30">
					<a href="<?php echo base_url();?>invoice">
						<div class="col-xs-6">
							<h2><i class="zmdi zmdi-assignment-o mci"></i></h2>
							<p class="text-muted text-overflow">Sales</p>
						</div>
					</a>
					<a href="<?php echo base_url();?>invoice/view">
						<div class="col-xs-6">
							<h2 ><i class="zmdi zmdi-collection-text mci"></i></h2>
							<p class="text-muted text-overflow">Reports</p>
						</div>
					</a>
				</div>
			</div>
		</div>
		
		<div class="col-lg-4">
			<div class="card-box">
				<h4 class="header-title m-t-0">Purchase</h4>
				<div class="row text-center m-t-30">
					<a href="<?php echo base_url();?>purchase">
						<div class="col-xs-6">
							<h2><i class="zmdi zmdi-shopping-cart mci"></i></h2>
							<p class="text-muted text-overflow">Purchase</p>
						</div>
					</a>
					<a href="<?php echo base_url();?>purchase/view">
						<div class="col-xs-6">
							<h2><i class="zmdi zmdi-collection-text mci"></i></h2>
							<p class="text-muted text-overflow">Reports</p>
						</div>
					</a>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="card-box">
				<h4 class="header-title m-t-0">Voucher</h4>
				<div class="row text-center m-t-30">
					<a href="<?php echo base_url();?>voucher">
						<div class="col-xs-6">
							<h2><i class="zmdi zmdi-money-box mci"></i></h2>
							<p class="text-muted text-overflow">Voucher</p>
						</div>
					</a>
					<a href="<?php echo base_url();?>voucher/reports">
						<div class="col-xs-6">
							<h2><i class="zmdi zmdi-collection-text mci"></i></h2>
							<p class="text-muted text-overflow">Reports</p>
						</div>
					</a>
				  <div>
			</div>
		</div>
	</div> 

	</div>

	</div>
	
	<br>
	<br>
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>


  <script src="https://demos.creative-tim.com/now-ui-dashboard/assets/js/plugins/chartjs.min.js"></script>
        <script src="https://demos.creative-tim.com/now-ui-dashboard/assets/js/plugins/bootstrap-notify.js"></script>
        <script src="https://demos.creative-tim.com/now-ui-dashboard/assets/demo/demo.js"></script>
        <script src="https://demos.creative-tim.com/now-ui-dashboard/assets/js/now-ui-dashboard.min.js?v=1.5.0"></script>
        
        <script src="https://demos.creative-tim.com/now-ui-dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
                <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
	
  </script>
  <?php
   $year  = date('Y');
   //var_dump($year);
   $query  = $this->db->query("SELECT SUM(amount) as amt,MONTH(date) as monthno FROM invoice_details WHERE YEAR(date) = $year group by MONTH(date) order by MONTH(date) Asc")->result_array();
   //echo'<pre>';
   $graphvalall = [];
   foreach($query as $graphval){
	$labe[$graphval['monthno']] = $graphval['amt'];
	//$vall[] = $graphval['monthname'];
   }
   //echo'<pre>';
   //var_dump($vall);
   $start_month	=1;
   $allvall=array();
   for($m=$start_month; $m<=12; $m++){
	foreach($labe as $key=>$singval){
		//echo "montno".$m;
		$monnam = date('M', mktime(0, 0, 0, $m, 10));
		//echo $monnam;
		//echo "key".$key;
		//echo "<br>"."----------";
		if(intVal($m)==intVal($key)){
			$allval[$monnam]= intVal($singval);
			break;
		}
		else{
			$allval[$monnam] = 0;
		}
	}
   }
   $lbl = array();
   $va = [];
   foreach($allval as $k=>$sing)
   {
	$lbl[] = $k;
	$va[] = $sing;
   }

?>
  <script>
	var labe = <?php echo json_encode($lbl); ?>;
	var val = <?php echo json_encode($va); ?>;
	


		var ctx = document.getElementById('bigDashboardChart').getContext("2d");
		chartColor = "#FFFFFF";

var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
gradientStroke.addColorStop(0, '#80b6f4');
gradientStroke.addColorStop(1, chartColor);

var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");




var myChart = new Chart(ctx, {
	type: 'line',
	data: {
		//labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
		//labels:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
		labels: labe,
		
		datasets: [{
			label: "Data",
			borderColor: chartColor,
			pointBorderColor: chartColor,
			pointBackgroundColor: "#1e3d60",
			pointHoverBackgroundColor: "#1e3d60",
			pointHoverBorderColor: chartColor,
			pointBorderWidth: 1,
			pointHoverRadius: 7,
			pointHoverBorderWidth: 2,
			pointRadius: 5,
			fill: true,
			backgroundColor: gradientFill,
			borderWidth: 2,
			//data: [50, 150, 100, 190, 130, 90, 150, 160, 120, 140, 190, 95]
			data:val,
		}]
	},
	options: {
		layout: {
			padding: {
				left: 20,
				right: 20,
				top: 0,
				bottom: 0
			}
		},
		maintainAspectRatio: false,
		tooltips: {
		  backgroundColor: '#fff',
		  titleFontColor: '#333',
		  bodyFontColor: '#666',
		  bodySpacing: 4,
		  xPadding: 12,
		  mode: "nearest",
		  intersect: 0,
		  position: "nearest"
		},
		legend: {
			position: "bottom",
			fillStyle: "#FFF",
			display: false
		},
		scales: {
			yAxes: [{
				ticks: {
					fontColor: "rgba(255,255,255,0.4)",
					fontStyle: "bold",
					beginAtZero: true,
					maxTicksLimit: 5,
					padding: 10
				},
				gridLines: {
					drawTicks: true,
					drawBorder: false,
					display: true,
					color: "rgba(255,255,255,0.1)",
					zeroLineColor: "transparent"
				}

			}],
			xAxes: [{
				gridLines: {
					zeroLineColor: "transparent",
					display: false,

				},
				ticks: {
					padding: 10,
					fontColor: "rgba(255,255,255,0.4)",
					fontStyle: "bold"
				}
			}]
		}
	}
});

		</script>

<?php 

$year = date('Y');

$queries = $this->db->query("SELECT SUM(total)as amt,MONTH(date)as monthno FROM purchase_details WHERE YEAR(date) = $year group by month(date) order by MONTH(date) Asc")->result_array();
// print_r($queries);

$barvalall = [];
foreach($queries as $barval){
 $labe[$barval['monthno']] = $barval['amt'];

}

$start_month	=1;
$allvall=array();
for($m=$start_month; $m<=12; $m++){
 foreach($labe as $key=>$singleval){
	 $monnamm = date('M', mktime(0, 0, 0, $m, 10));
	 if(intVal($m)==intVal($key)){
		 $allval[$monnamm]= intVal($singleval);
		 break;
	 }
	 else{
		 $allval[$monnamm] = 0;
	 }
 }
}
$lbl = array();
$va = [];
foreach($allval as $k=>$single)
{
 $label[] = $k;
 $val[] = $single;
}
//var_dump($va);
//die;
?>

<script>
	var labvalue = <?php echo json_encode($label);?>;
	var value = <?php echo json_encode($val);?>;

	

     var ctx = document.getElementById('lineChartExample').getContext("2d");
		chartColor = "black";

var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
gradientStroke.addColorStop(0, '#80b6f4');
gradientStroke.addColorStop(1, chartColor);

var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		//labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
		//labels:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
		labels: labvalue,
		
		datasets: [{
			label: "Data",
			borderColor: chartColor,
			pointBorderColor: chartColor,
			pointBackgroundColor: "#1e3d60",
			pointHoverBackgroundColor: "#1e3d60",
			pointHoverBorderColor: chartColor,
			pointBorderWidth: 1,
			pointHoverRadius: 7,
			pointHoverBorderWidth: 2,
			pointRadius: 5,
			fill: true,
			backgroundColor: gradientFill,
			borderWidth: 2,
			//data: [50, 150, 100, 190, 130, 90, 150, 160, 120, 140, 190, 95]
			data:value,
		}]
	},
	options: {
		layout: {
			padding: {
				left: 20,
				right: 20,
				top: 0,
				bottom: 0
			}
		},
		maintainAspectRatio: false,
		tooltips: {
		  backgroundColor: '#fff',
		  titleFontColor: '#333',
		  bodyFontColor: '#666',
		  bodySpacing: 4,
		  xPadding: 12,
		  mode: "nearest",
		  intersect: 0,
		  position: "nearest"
		},
		legend: {
			position: "bottom",
			fillStyle: "#FFF",
			display: false
		},
		scales: {
			yAxes: [{
				ticks: {
					fontColor: "rgba(255,255,255,0.4)",
					fontStyle: "bold",
					beginAtZero: true,
					maxTicksLimit: 5,
					padding: 10
				},
				gridLines: {
					drawTicks: true,
					drawBorder: false,
					display: true,
					color: "rgba(255,255,255,0.1)",
					zeroLineColor: "transparent"
				}

			}],
			xAxes: [{
				gridLines: {
					zeroLineColor: "transparent",
					display: false,

				},
				ticks: {
					padding: 10,
					fontColor: "rgba(255,255,255,0.4)",
					fontStyle: "bold"
				}
			}]
		}
	}
});


</script>

<?php
   $year  = date('Y');
   //var_dump($year);
   $getquery  = $this->db->query("SELECT SUM(amount) as amt,MONTH(date) as monthno FROM voucher WHERE YEAR(date) = $year group by MONTH(date) order by MONTH(date) Asc")->result_array();
//    print_r($getquery);die;
   $graphvalsall = [];
   foreach($getquery as $graphsval){
	$lab[$graphsval['monthno']] = $graphsval['amt'];
	//$vall[] = $graphval['monthname'];
   }
   //echo'<pre>';
   //var_dump($vall);
   $start_month	=1;
   $allsvall=array();
   for($m=$start_month; $m<=12; $m++){
	foreach($lab as $key=>$singsval){
		//echo "montno".$m;
		$monnams = date('M', mktime(0, 0, 0, $m, 10));
		//echo $monnam;
		//echo "key".$key;
		//echo "<br>"."----------";
		if(intVal($m)==intVal($key)){
			$allsval[$monnams]= intVal($singsval);
			break;
		}
		else{
			$allsval[$monnams] = 0;
		}
	}
   }
   $lbls = array();
   $vas = [];
   foreach($allsval as $k=>$sings)
   {
	$lbls[] = $k;
	$vas[] = $sings;
   }
   //var_dump($va);
   //die;
?>

<script>

var xaxis= <?php echo json_encode($lbls);?>;
	var yaxis = <?php echo json_encode($vas);?>;

	// console.log(xaxis);
	// console.log(yaxis);
	var ctx = document.getElementById('lineChartExampleWithNumbersAndGrid').getContext("2d");
		chartColor = "black";

var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
gradientStroke.addColorStop(0, '#18ce0f');
gradientStroke.addColorStop(1, chartColor);

var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];


var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		//labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
		//labels:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
		labels: xaxis,
		
		datasets: [{
			label: "Data",
			borderColor: chartColor,
			pointBorderColor: chartColor,
			pointBackgroundColor: "red",
			pointHoverBackgroundColor: "red",
			pointHoverBorderColor: chartColor,
			pointBorderWidth: 1,
			pointHoverRadius: 7,
			pointHoverBorderWidth: 2,
			pointRadius: 5,
			fill: true,
			backgroundColor: barColors,
			borderWidth: 2,
			//data: [50, 150, 100, 190, 130, 90, 150, 160, 120, 140, 190, 95]
			data:yaxis,
		}]
	},
	options: {
		layout: {
			padding: {
				left: 20,
				right: 20,
				top: 0,
				bottom: 0
			}
		},
		maintainAspectRatio: false,
		tooltips: {
		  backgroundColor: '#fff',
		  titleFontColor: '#333',
		  bodyFontColor: '#666',
		  bodySpacing: 4,
		  xPadding: 12,
		  mode: "nearest",
		  intersect: 0,
		  position: "nearest"
		},
		legend: {
			position: "bottom",
			fillStyle: "#FFF",
			display: false
		},
		scales: {
			yAxes: [{
				ticks: {
				
					fontColor: "rgba(255,255,255,0.4)",
					fontStyle: "bold",
					beginAtZero: true,
					maxTicksLimit: 5,
					padding: 10
				},
				gridLines: {
					drawTicks: true,
					drawBorder: false,
					display: true,
					color: "rgba(255,255,255,0.1)",
					zeroLineColor: "transparent"
				}

			}],
			xAxes: [{
				gridLines: {
					zeroLineColor: "transparent",
					display: false,

				},
				ticks: {
					padding: 10,
					fontColor: "rgba(255,255,255,0.4)",
					fontStyle: "bold"
				}
			}]
		}
	}
});
</script>

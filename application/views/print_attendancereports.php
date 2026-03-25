<style>
	table tr td{padding: 3px;text-align: center;font-size:14;}
	table tr th{padding: 3px;text-align: center;font-size:14;}
</style>
<?php 
$staff=$this->db->where('id',$staff_name)->get('add_staff')->row();
$nfp=$this->db->where('month(attendancedate)', $month)->where('year(attendancedate)', $year)->where('staff',$staff_name)->where('attendances','Present')->get('attendance')->result_array();
		$nfa=$this->db->where('month(attendancedate)', $month)->where('year(attendancedate)', $year)->where('staff',$staff_name)->where('attendances','Absent')->get('attendance')->result_array();
		$reports=$this->db->where('month(attendancedate)', $month)->where('year(attendancedate)', $year)->where('staff',$staff_name)->order_by('attendancedate','ASC')->get('attendance')->result_array();
		$mm='January';

			if($month=="01")
			{
				$mm='January';
			}
			else if($month=="02")
			{
				$mm='February';
			}
			else if($month=="03")
			{
				$mm='March';
			}
			else if($month=="04")
			{
				$mm='April';
			}
			else if($month=="05")
			{
				$mm='May';
			}
			else if($month=="06")
			{
				$mm='Jun';
			}
			else if($month=="07")
			{
				$mm='July';
			}
			else if($month=="08")
			{
				$mm='August';
			}
			else if($month=="09")
			{
				$mm='September';
			}
			else if($month=="10")
			{
				$mm='October';
			}
			else if($month=="11")
			{
				$mm='November';
			}
			else if($month=="12")
			{
				$mm='December';
			}

$html='<table width="650" >
	<td style="font-size:18px;">Report Date :<b>'.date('d-m-Y').'</b></td>
	<td style="font-size:18px;">Staff Name :<b>'.$staff->staff_name.'</b></td>
	
	<td style="font-size:18px;">Roll No :<b>'.$staff->staff_id.'</b></td>
	<td style="font-size:18px;">Month:<b>'.$mm.'</b></td>
</table><br><br>';
		$html.='<table   width="650" height="300" border="1px solid black">
		<thead>
		<tr>
		<th style="font-size:18px;">S.NO&nbsp;</th>
		<th style="font-size:18px;">Date&nbsp;</th>
		<th style="font-size:18px;">In Time&nbsp;</th>
		<th style="font-size:18px;">Out Time&nbsp;</th>
		<th style="font-size:18px;">Total Hour&nbsp;</th>
		<th style="font-size:18px;">Extra Hour&nbsp;</th>
	
		</tr>
		</thead>
		<tbody>';
		$i=1;
		$extra_hours=array();
		$totalhourss=array();
		// $month31=[1,3,5,7,8,10,12];
		// $month30=[4,6,9,11];
		// if(in_array($month, $month31)){
		// 	$day_count=31;
		// }elseif (in_array($month, $month30)){
		// 	$day_count=30;
		// }else{
		// 	if($year%4==0){
		// 		$day_count=29;
		// 	}else{
		// 		$day_count=28;
		// 	}
		// }
		// print_r($month31);
		if($reports)
		{
			// for ($q=1; $q <($day_count) ; $q++) { 
			// 	$data['sno']=$q;
			// 	$data['date']=$q.'-'.$month.'-'.$year;
			// }
			foreach ($reports as $rows) 
			{
				if($rows['outtime']=='-'){
					$out='';
				}else{
					$out=$rows['outtime'];
				}
				$startdats=$rows['date'].' '.$rows['intime'];
				$enddats=$rows['date'].' '.$out;
				$time_one = new DateTime($startdats);
				$time_two = new DateTime( $enddats);
				$difference = $time_one->diff($time_two);
				$days= $difference->format('%D');
				$hours= $difference->format('%H');
				$minutes= $difference->format('%I');
				$seconds= $difference->format('%S');
				$totadys=$days*24;
				$tothours=$totadys+$hours;
				if($rows['outtime']=='-'){
					$totalhours='-';
				}else{
					$totalhours=''.sprintf("%02d",$tothours).':'.$minutes.':'.$seconds.'';
				}
				if($totalhours=='-'){
					$ex_hour = '0:00:0';
				}else{
					$date1 = strtotime("09:30:00");
					$date2 = strtotime($totalhours);
					$interval = $date2 - $date1;
					$seconds = $interval % 60;
					$minutes = floor(($interval % 3600) / 60);
					$hours = floor($interval / 3600);
					$prefix='';
					if($hours<0){
						$hours=$hours+1;
						if($hours<0){
							$prefix='';
						}else{
							$prefix='-';
						}
					}
					$ex_hour1= $prefix."".$hours.":".$minutes.":".$seconds;
					if($minutes<0){
						$minutes=str_replace('-','',$minutes);
					}
					$ex_hour= $prefix."".$hours.":".$minutes.":".$seconds;
				}
				// if($rows['project_status']>0){
				// 	// $style='background-color:dodgerblue;color:white;';
				// 	$place=$rows['project'];
				// }else{
				// 	$place='';
				// 	// $style='';
				// }
				$html.='<tr >
				<td>'.$i++.'</td>
				<td>'.date('d/m/Y',strtotime(str_replace('-', '/', $rows['attendancedate']))).'</td>
				<td>'.$rows['intime'].'&nbsp;</td>
				<td>'.$rows['outtime'].'&nbsp;</td>
				<td>'.$totalhours.'&nbsp;</td>
				<td>'.$ex_hour.'&nbsp;</td>
			
				</tr>';
				$extra_hours[]=$ex_hour1;
				$totalhourss[]=$totalhours;
			}
		}
		$time = 0;
		$time_arr =  $extra_hours;
		foreach ($time_arr as $time_val) {
			$time +=explode_time($time_val); // this fucntion will convert all hh:mm to seconds
		}
		$time1 = 0;
		$time_arr1 =  $totalhourss;
		foreach ($time_arr1 as $time_val1) {
			$time1 +=explode_time($time_val1); // this fucntion will convert all hh:mm to seconds
		}
		$html.='</tbody>
		</table><br><br>
		<div class="dayscounts">
		<div><span style="font-size:18px;font-weight:bold;">No of Days Present:</span> <b>'.count($nfp).'</b></div>
		<div><span style="font-size:18px;font-weight:bold;">No of Days Absent:</span> <b>'.count($nfa).'</b></div>
		<div><span style="font-size:18px;font-weight:bold;">Total Working Hour:</span> <b>'.second_to_hhmm($time1).'</b></div>
		<div><span style="font-size:18px;font-weight:bold;">Total Extra Hour:</span> <b>'.second_to_hhmm($time).'</b></div>
		</div>
		<style>
		.dayscounts {
			text-align: justify;
			font-size: 14px;
		}
		<style>';
		 function explode_time($time) { //explode time and convert into seconds
		@$time = explode(':', $time);
		@$time = $time[0] * 3600 + $time[1] * 60;
		return $time;
	}
	 function second_to_hhmm($time) { //convert seconds to hh:mm
		$hour = floor($time / 3600);
		$minute = strval(floor(($time % 3600) / 60));
		if ($minute == 0) {
			$minute = "00";
		} else {
			$minute = $minute;
		}
		$time = $hour . ":" . str_replace('-','',$minute);
		return $time;
	}
		echo $html;


 ?>
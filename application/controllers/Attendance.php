<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
// error_reporting(0);
class Attendance extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
   
    if($this->session->userdata('rcbio_login')=='')
    {
      $this->session->set_flashdata('msg','Please Login to continue!');
      redirect('login');
    }  
	$this->load->model('punch_model');
    date_default_timezone_set('Asia/Kolkata');
  }
	public function index()
	{
	$get_data = $this->db->order_by('id','desc')->limit(1)->get('add_staff')->result();
  foreach($get_data as $s){
    $bond_no = $s->staff_id;
  }

  if(empty($bond_no))
  {
    $new_bond_noo = "S001";
  }
  else{
    $new_bond_prefix = "S";
    $bondlen = strlen($bond_no)-1;
    $bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
    $new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondlen.'d',$bondOnlyNum + 1);
  }

  $sid['cid'] = $new_bond_noo;
		
		$this->load->view('header');
		$this->load->view('add_staff',$sid);
		$this->load->view('footer');
	}

  public function insert(){

    $dateofbirth = $this->input->post('dob');
    $today       = date('Y-m-d');
    $diff = date_diff(date_create($dateofbirth), date_create($today));
    $age = $diff->format('%y');
    

    $data = array(
      'staff_id'   => $this->input->post('staff_id'),
      'date'       => date('Y-m-d'),
      'time'       => date('Y-m-d h:i:s'),
      'staff_name' => $this->input->post('staff_name'),
      'mobileno'   => $this->input->post('mobileno'),
      'amobileno'  => $this->input->post('amobileno'),
      'dob'        => $this->input->post('dob'),
      'age'        => $age,
      'email'      => $this->input->post('email'),
      'address1'   => $this->input->post('address1'),
      'address2'   => $this->input->post('address2'),
      'city'       => $this->input->post('city'),
      'state'      => $this->input->post('state'),
      'pincode'    => $this->input->post('pincode'),
      'referred'   => $this->input->post('referred'),
      'salary'     => $this->input->post('salary'),
      'salarytype' => $this->input->post('salarytype'),
      'perdaysalary'=> $this->input->post('perdaysalary'),
      'ot'          => $this->input->post('ot'),
      'status'      => 1


     );
     $result = $this->db->insert('add_staff',$data);
     if($result==true)
     {
      $this->session->set_flashdata('msg','Staff Added Successfully..!');
      redirect('attendance');
     }
     else
     {
      $this->session->set_flashdata('msg1','Staff Added Unsuccessfully..!');
      redirect('attendance');
     }

  }

    public function view()
    {
      $data['staff'] = $this->db->order_by('id','asc')->get('add_staff')->result();
        $this->load->view('header');
		$this->load->view('staff_list',$data);
		$this->load->view('footer');
    }

    public function dailyentry()
    {   
        $this->load->view('header');
		$this->load->view('attendance_entry');
		$this->load->view('footer');
    }

    public function reports()
    {
      $this->load->view('header');
      $this->load->view('attendance_reports');
      $this->load->view('footer');
    }



    public function edit()
    {
      $id = $this->uri->segment(3);
      $data['staff'] = $this->db->where('id',$id)->get('add_staff')->result();
      $this->load->view('header');
      $this->load->view('edit_staff',$data);
      $this->load->view('footer');

    }

    public function delete()
    {
      $id = $this->uri->segment(3);
      $data = $this->db->where('id',$id)->delete('add_staff');
      if($data==true)
      {
        $this->session->set_flashdata('msg','Staff Deleted Successfully..!');
        redirect('attendance/view');
      }
      else
      {
        $this->session->set_flashdata('msg1','Staff Deleted Unsuccessfully..!');
        redirect('attendance/view');
      }
    }

    public function update()
    {
      $id = $this->input->post('id');

      $data = array(

        'staff_id'   => $this->input->post('staff_id'),
        'date'       => date('Y-m-d'),
        'time'       => date('Y-m-d h:i:s'),
        'staff_name' => $this->input->post('staff_name'),
        'mobileno'   => $this->input->post('mobileno'),
        'amobileno'  => $this->input->post('amobileno'),
        'dob'        => $this->input->post('dob'),
        'age'        => $this->input->post('age'),
        'email'      => $this->input->post('email'),
        'address1'   => $this->input->post('address1'),
        'address2'   => $this->input->post('address2'),
        'city'       => $this->input->post('city'),
        'state'      => $this->input->post('state'),
        'pincode'    => $this->input->post('pincode'),
        'referred'   => $this->input->post('referred'),
        'salary'     => $this->input->post('salary'),
        'salarytype' => $this->input->post('salarytype'),
        'perdaysalary'=> $this->input->post('perdaysalary'),
        'ot'          => $this->input->post('ot'),
        'status'      => 1
  
  
       );

       $this->db->where('id',$id);
       $result = $this->db->update('add_staff',$data);
       if($result==true)
       {
        $this->session->set_flashdata('msg','Staff Details Updated Successfully');
        redirect('attendance');
       }
       else
       {
        $this->session->set_flashdata('msg1','Staff Details Updated Unsuccessfully');
        redirect('attendance');
       }
    }

    public function entry()
    {
      @$attendancedate=date('Y-m-d',strtotime(str_replace('/', '-', $_POST['attendancedate'])));
      $staffs=$this->db->where('status',1)->get('add_staff')->result_array();
    	$html='<table id="table" class="table" >
		<thead>
		<tr>
		<th>S.NO</th>
		<th>Staff Name</th>
		<th>Attendance</th>
		<th>In-Time</th>
		<th>Out-Time</th>
   
		</tr>
		</thead>
		<tbody>';
		$i=1;
		foreach ($staffs as $rows) {
     
      $where=array('attendancedate'=>$attendancedate,
				'staff'=>$rows['id']);
        
			$attend=$this->db->get_where('attendance',$where)->result_array();
		
      if($attend)
			{
				foreach ($attend as $row){
          if($row["attendances"]=='Present' || $row["attendances"]=='Half Day')
					{
						$readonly='';
						$outtime=$row['outtime'];
						$intime=$row['intime'];
        
					}
					else
					{
						$readonly='readonly';
						$intime='';
						$outtime='';
         
					}
          $html.='<tr>
					<td>'.$i++.'</td>
					<td><input type="hidden" value="'.$row['id'].'" name="id[]" parsley-trigger="change"   class="form-control" id="id"><input type="hidden" value="'.$rows['id'].'" name="staff_name[]" parsley-trigger="change"   class="form-control" id="staff'.$rows['id'].'">'.$rows['staff_name'].'</td>
					<td><select name="attendances[]" id="attendances'.$rows['id'].'" class="form-control">
					<option value="Present"'; if($row["attendances"]=="Present")$html.='selected';$html.='>Present</option>
					<option value="Half Day"'; if($row["attendances"]=="Half Day")$html.='selected';$html.='>Half Day</option>
					<option value="Leave"'; if($row["attendances"]=="Leave")$html.='selected';$html.='>Leave</option>
					<option value="Absent"'; if($row["attendances"]=="Absent")$html.='selected';$html.='>Absent</option>
					<option value="Holiday"'; if($row["attendances"]=="Holiday")$html.='selected';$html.='>Holiday</option>
					</select></td>
					<<td><input type="text" name="intime[]" parsley-trigger="change"  class="form-control time" value="'.$intime.'" id="intime'.$rows['id'].'"></td>
					<td><input type="text" name="outtime[]" parsley-trigger="change" value="'.$outtime.'"   class="form-control time" id="outtime'.$rows['id'].'"></td>
         
					</tr>';
        }
      }
      else
      {
        $html.='<tr>
				<td>'.$i++.'</td>
				<td><input type="hidden" value="'.$rows['id'].'" name="staff_name[]" parsley-trigger="change"   class="form-control" id="staff'.$rows['id'].'">'.$rows['staff_name'].'</td>
				<td><select name="attendances[]" id="attendances'.$rows['id'].'" class="form-control">
				<option value="Present">Present</option>
				<option value="Half Day">Half Day</option>
				<option value="Leave">Leave</option>
				<option value="Absent">Absent</option>
				<option value="Holiday">Holiday</option>
				</select></td>
        <td><input type="text" name="intime[]" parsley-trigger="change" value="10:00 AM"  class="form-control time" id="intime'.$rows['id'].'"></td>
				<td><input type="text" name="outtime[]" parsley-trigger="change" value="8:00 PM"  class="form-control time" id="outtime'.$rows['id'].'"></td>
       
				</tr>';
      }
}
$html.='</tbody>
		<tfoot>
		<tr>
		<th></th>
		<th></th>
		<th></th>
    
		<th><input type="submit"  class="btn btn-success btn-custom" value="Submit"></th>
		</tr>
		</tfoot>
		</table>
		<script>';
		foreach ($staffs as $rows) {
			$html.='$("#attendances'.$rows['id'].'").change(function(){
				var attendances=$(this).val();
				if(attendances=="Present" || attendances=="Half Day")
				{
					$("#intime'.$rows['id'].'").attr("readonly",false);
					$("#outtime'.$rows['id'].'").attr("readonly",false);
       
				}
				else
				{
					$("#intime'.$rows['id'].'").attr("readonly",true);
					$("#outtime'.$rows['id'].'").attr("readonly",true);
      
					$("#intime'.$rows['id'].'").val("");
					$("#outtime'.$rows['id'].'").val("");
          $("#ot'.$rows['id'].'").val("");
				}
			});';
		}
		$html.='</script>';
		echo $html;
}

public function makeattendance()
	{
		@$attendancedate=date('Y-m-d',strtotime(str_replace('/', '-', $_POST['attendancedate'])));
		$staff=$this->input->post('staff_name');
		$attendances=$this->input->post('attendances');
		@$intime=$this->input->post('intime');
		@$outtime=$this->input->post('outtime');

		@$id=$this->input->post('id');
		$count=count($staff);
		for ($i=0; $i <$count ; $i++) 
		{ 
			$where=array('attendancedate'=>$attendancedate,
				'staff'=>$staff[$i]);
			$attend=$this->db->get_where('attendance',$where)->result_array();
			if(@$intime[$i]=='')
			{
				$intimes[$i]='';
			}
			else
			{
				$intimes[$i]=$intime[$i];
			}
			if(@$outtime[$i]=='')
			{
				$outtimes[$i]='';
			}
			else
			{
				$outtimes[$i]=$outtime[$i];
			}
   
			if($attend)
			{
				$data= array('staff'=>$staff[$i],
					'attendances'=>$attendances[$i],
					'intime'=>$intimes[$i],
					'outtime'=>$outtimes[$i],
    
					'lastupdate'=>date('Y-m-d H:i:s')
				);
        print_r($data);
				$this->db->where('id',$id[$i]);	
				$this->db->update('attendance',$data);
				$result=$this->db->affected_rows() !=1 ? false:true;
			}
			else
			{
				$data= array('date' =>date('Y-m-d'),
					'time' =>date("H:i:s"),
					'attendancedate'=>$attendancedate,
					'staff'=>$staff[$i],
					'attendances'=>$attendances[$i],
					'intime'=>$intimes[$i],
					'outtime'=>$outtimes[$i],
 
					'status'=>1,
					'lastupdate'=>date('Y-m-d H:i:s')
				);
        print_r($data);
				$this->db->insert('attendance',$data);
				$result=$this->db->affected_rows() !=1 ? false:true;
			}
		}
		if($result==true)
		{
			$this->session->set_flashdata('msg','Attendance added Successfully');
			redirect('attendance/dailyentry');
		}
		else
		{
			$this->session->set_flashdata('msg','Attendance added Failed');
			redirect('attendance/dailyentry');
		}
	}


  Public function get_staffs()
	{			
				$this->db->where('status',1);
		$query=$this->db->get('add_staff');
        $result= $query->result();
       
        $data=array();
		foreach($result as $r)
		{
			$data['value']=$r->id;
			$data['label']=$r->staff_name;
			$json[]=$data;
			
			
		}
		echo json_encode($json);
		
	
	}

	public function report()
	{
		// print_r($this->input->post());exit();
		$staff_name=$this->input->post('staff_name');
		
		$month=$this->input->post('month');
		
		
		$year=$this->input->post('year');
		

		$nfp=$this->db->where('month(attendancedate)', $month)->where('year(attendancedate)', $year)->where('staff',$staff_name)->where('attendances','Present')->get('attendance')->result_array();
		$nfa=$this->db->where('month(attendancedate)', $month)->where('year(attendancedate)', $year)->where('staff',$staff_name)->where('attendances','Absent')->get('attendance')->result_array();
		$reports=$this->db->where('month(attendancedate)', $month)->where('year(attendancedate)', $year)->where('staff',$staff_name)->order_by('attendancedate','ASC')->get('attendance')->result_array();
		
		$html='<table id="table" class="table">
		<thead>
		<tr>
		<th>S.NO</th>
		<th>Date</th>
		<th>Staff Name</th>
		<th>Attendance</th>
		<th>In Time</th>
		<th>Out Time</th>
		<th>Total Hour</th>
		<th>Extra Hour</th>
		</tr>
		</thead>
		<tbody>';
		$i=1;
		$extra_hours=array();
		$totalhourss=array();
		if($reports)
		{
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
					$ex_hour1 = '0:00:0';
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
				$staffname=$this->db->select('staff_name')->where('id',$rows['staff'])->get('add_staff')->row()->staff_name;
				
				// if($rows['project_status']>0){
				// 	$style='background-color:dodgerblue;color:white;';
				// 	$place=' ('.$rows['project'].')';
				// }else{
				// 	$place='';
				// 	$style='';
				// }
				$html.='<tr>
				<td>'.$i++.'</td>
				<td>'.date('d/m/Y',strtotime(str_replace('-', '/', $rows['attendancedate']))).'</td>
			
				<td>'.$rows['attendances'].'</td>
				<td>'.$rows['intime'].'</td>
				<td>'.$rows['outtime'].'</td>
				<td>'.$totalhours.'</td>
				<td>'.$ex_hour.'</td>
				</tr>';
				$extra_hours[]=$ex_hour1;
				$totalhourss[]=$totalhours;
			}
		}
		$time = 0;
		$time_arr =  $extra_hours;
		foreach ($time_arr as $time_val) {
			$time +=$this->explode_time($time_val); // this fucntion will convert all hh:mm to seconds
		}
		$time1 = 0;
		$time_arr1 =  $totalhourss;
		foreach ($time_arr1 as $time_val1) {
			$time1 +=$this->explode_time($time_val1); // this fucntion will convert all hh:mm to seconds
		}
		$html.='</tbody>
		</table>
		<div class="dayscounts">
		<div>No of Days Present: '.count($nfp).'</div>
		<div>No of Days Absent: '.count($nfa).'</div>
		<div>Total Working Hour: '.$this->second_to_hhmm($time1).'</div>
		<div>Total Extra Hour: '.$this->second_to_hhmm($time).'</div>
	
		</div>
		<style>
		.dayscounts {
			text-align: justify;
			font-size: 16px;
		}
		<style>';
		echo $html;
	}

	public function explode_time($time) { //explode time and convert into seconds
		@$time = explode(':', $time);
		@$time = $time[0] * 3600 + $time[1] * 60;
		return $time;
	}
	public function second_to_hhmm($time) { //convert seconds to hh:mm
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
  
  public function print_reports()
  {
    $data['staff_name']=$this->input->post('staff_name');
	
		$data['month']=$this->input->post('month');
		$data['year']=$this->input->post('year');
	$this->load->view('print_attendancereports', $data);
  }
}
ob_flush();
?>
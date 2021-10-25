<?php
include '../../core/config.php';
	$result = mysql_query("SELECT * FROM tbl_teacher") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$list = array();
		if($row['t_gender'] == 1){
			$gender = "Male";
		}else{
			$gender = "Female";
		}
		$list['citizen'] = $row['t_citizen'];
		$list['status'] = $row['t_civil_status'];
		$list['count'] = $count;
		$list['lname'] = $row['t_lname'];
		$list['fname'] = $row['t_fname'];
		$list['mname'] = $row['t_mname'];
		$list['age'] = getAge($row['t_bdate']);
		$list['gender'] = $gender;
		$list['bdate'] = $row['t_bdate'];
		$list['action'] = "
				<button class='btn btn-success' data-toggle='modal' data-target='#update_modal' onclick='update_teacher($row[0])'><span class='fa fa-edit'></span></button>
				<button class='btn btn-danger' onclick='deleteTeacher($row[0],\"".$row['t_fname']." ".$row['t_lname']."\")'><span class='fa fa-trash'></span></button>
				";
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
?>
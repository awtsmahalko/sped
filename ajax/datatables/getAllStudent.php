<?php
include '../../core/config.php';
$account_id = $_SESSION['account_id'];
if(isset($_GET['q'])){
	if($_GET['q'] == "principal"){
		if($_GET['t'] > 0){
			$inject = "WHERE t_id = ".$_GET['t'];
		}else{
			$inject = "";
		}
	}else{
		$inject = "WHERE t_id = $account_id";
	}
}else{
	// $inject = "WHERE t_id = $account_id";
	$inject = "";
}
	$result = mysql_query("SELECT * FROM tbl_student $inject ORDER BY stu_lname ASC") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$list = array();
		($row['stu_gender'] == 1)?$gender = "Male":$gender = "Female";
		$list['status'] = $row['stu_special'];
		$list['stat'] = ($row['status'] == 1)?"<span class='label label-rouded label-success'>Enrolled</span>":"<span class='label label-rouded label-danger'>Not Enrolled</span>";
		$list['count'] = $count;
		$list['lname'] = $row['stu_lname'];
		$list['fname'] = $row['stu_fname'];
		$list['mname'] = $row['stu_mname'];
		$list['age'] = getAge($row['stu_bdate']);
		$list['gender'] = $gender;
		$list['bdate'] = $row['stu_bdate'];
		$list['action'] = "
				<button class='btn btn-success' data-toggle='modal' data-target='#update_modal' onclick='update_student($row[0])'><span class='fa fa-edit'></span></button>
				<button class='btn btn-danger' onclick='removeStu($row[0],\"".$row['stu_fname']."\")'><span class='fa fa-trash'></span></button>
				";
		$list['p_name'] =  $row['stu_lname'].", ".$row['stu_fname']." ".$row['stu_mname'];
		$list['p_teacher'] = getTeachername($row['t_id']);
		$list['p_action'] = "
				<button class='btn btn-success' data-toggle='modal' data-target='#update_modal' onclick='update_student($row[0])'><span class='fa fa-list'></span></button>";

		array_push($response['data'], $list);
		$count++;
	}
	echo json_encode($response);
?>
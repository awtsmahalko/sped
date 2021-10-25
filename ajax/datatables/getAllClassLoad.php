<?php
include '../../core/config.php';
$account_id = $_SESSION['account_id'];
$class_id = $_GET['class_id'];
	$result = mysql_query("SELECT * FROM tbl_class_load WHERE t_id = $account_id AND class_id = $class_id") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		$status = getData("stu_special","tbl_student","stu_id = ".$row['stu_id']);

		$list = array();
		$list['count'] = $count;
		$list['name'] = getStudentName($row['stu_id']);
		$list['status'] = $status[0];
		$list['action'] = "
				<button class='btn btn-danger' onclick='removeStu($row[0],\"".getStudentName($row['stu_id'])."\")'><span class='fa fa-minus-circle'></span></button>
				";
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
?>
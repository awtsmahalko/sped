<?php
include '../../core/config.php';
if($_SESSION['user_type'] == 2){
	$account_id = $_SESSION['account_id'];
	$inject = " WHERE t_id = $account_id";
}else{
	$inject = "";
}
	$result = mysql_query("SELECT * FROM tbl_class $inject") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	$current_sy = getCurrentSY();
	while($row = mysql_fetch_array($result)){
		$list = array();
		$count_l = mysql_fetch_array(mysql_query("SELECT COUNT(class_id) FROM tbl_class_load WHERE class_id = '$row[0]'"));
		$count_s = mysql_fetch_array(mysql_query("SELECT COUNT(class_id) FROM tbl_class_subject WHERE class_id = '$row[0]'"));
		$disabled = ($row['class_year'] < $current_sy)?"disabled":"";
		$list['count'] = $count;
		$list['teacher'] = getTeacherName($row['t_id']);
		$list['code'] = $row['class_code'];
		$list['class'] = $row['class_name'];
		$list['section'] = $row['class_section'];
		$list['room'] = $row['class_room'];
		$list['subject'] = $count_s[0];
		$list['student'] = $count_l[0];
		$list['year'] = $row['class_year']." - ".($row['class_year'] + 1 );
		if($_SESSION['user_type'] == 0){
		$list['action'] = "
				<button $disabled class='btn btn-success' data-toggle='modal' data-target='#update_modal' onclick='update_class($row[0])'><span class='fa fa-edit'></span></button>
				<button $disabled class='btn btn-danger' onclick='deleteClass($row[0],\"".$row['class_code']."\")'><span class='fa fa-trash'></span></button>
				";
		}else{
		$list['action'] = "
				<button $disabled class='btn btn-success' onclick='window.location=\"index.php?page=".md5('class-load')."&".md5('class_id')."=".$row['class_id']."\"'><span class='fa fa-users'></span></button>
				<button $disabled class='btn btn-primary' data-toggle='tooltip' title='Load Subject!' onclick='window.location=\"index.php?page=".md5('class-subject')."&".md5('class_id')."=".$row['class_id']."\"'><span class='fa fa-list'></span></button>
				";
		}
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);

?>
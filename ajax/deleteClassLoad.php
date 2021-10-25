<?php
include '../core/config.php';
	$id = $_POST['id'];
	$class_d = mysql_fetch_array(mysql_query("SELECT * FROM `tbl_class_load` WHERE cl_id = $id"));
	$class_id = $class_d['class_id'];
	$stu_id = $class_d['stu_id'];
	$checker = mysql_fetch_array(mysql_query("SELECT COUNT(sqh_id) FROM `tbl_stu_quiz_head` WHERE class_id = $class_id AND stu_id = $stu_id AND status = 1"));
	if($checker[0] > 0){
		echo 2;
	}else{
		$query = mysql_query("DELETE FROM tbl_class_load WHERE cl_id = '$id'");
		if($query){
			mysql_query("DELETE FROM `tbl_stu_quiz_head` WHERE class_id = $class_id AND stu_id = $stu_id");
			mysql_query("UPDATE `tbl_student` SET status = 0 WHERE stu_id = $stu_id");
			echo 1;
		}else{
			echo 0;
		}
	}
?>
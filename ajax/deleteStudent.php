<?php
include '../core/config.php';
	$stu_id = $_POST['id'];
	$count_t = mysql_fetch_array(mysql_query("SELECT COUNT(stu_id) FROM tbl_class_load WHERE stu_id = '$stu_id'"));
	if($count_t[0] > 0){
		echo 2;
	}else{
		$img = getData("img","tbl_student","stu_id = '$stu_id'");
		$query = mysql_query("DELETE FROM `tbl_student` WHERE stu_id = '$stu_id'");
		if($query){
			unlink('../pictures/'.$img[0]);
			mysql_query("DELETE FROM `tbl_user` WHERE account_id = '$stu_id' AND user_type = 1");
			mysql_query("DELETE FROM `tbl_announcement` WHERE user_id = '$stu_id' AND user_type = 1");
			echo 1;
		}else{
			echo 0;
		}
	}
?>
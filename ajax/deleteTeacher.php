<?php
include '../core/config.php';
	$t_id = $_POST['id'];
	$count_t = mysql_fetch_array(mysql_query("SELECT COUNT(t_id) FROM tbl_class WHERE t_id = '$t_id'"));
	if($count_t[0] > 0){
		echo 2;
	}else{
		$img = getData("img","tbl_teacher","t_id = '$t_id'");
		$query = mysql_query("DELETE FROM `tbl_teacher` WHERE t_id = '$t_id'");
		if($query){
			unlink('../pictures/'.$img[0]);
			mysql_query("DELETE FROM `tbl_user` WHERE account_id = '$t_id' AND user_type = 2");
			mysql_query("DELETE FROM `tbl_announcement` WHERE user_id = '$t_id' AND user_type = 2");
			echo 1;
		}else{
			echo 0;
		}
	}
?>
<?php
include '../core/config.php';
	$class_id = $_POST['id'];
	$count_l = mysql_fetch_array(mysql_query("SELECT COUNT(class_id) FROM tbl_class_load WHERE class_id = '$class_id'"));
	$count_s = mysql_fetch_array(mysql_query("SELECT COUNT(class_id) FROM tbl_class_subject WHERE class_id = '$class_id'"));
	$count_t = $count_l[0] + $count_s[0];
	if($count_t > 0){
		echo 2;
	}else{
		$query = mysql_query("DELETE FROM `tbl_class` WHERE class_id = '$class_id'");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}
?>
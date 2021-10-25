<?php
include '../core/config.php';
	$sub_id = $_POST['id'];
	$count_t = mysql_fetch_array(mysql_query("SELECT COUNT(s_id) FROM tbl_class_subject WHERE s_id = '$sub_id'"));
	if($count_t[0] > 0){
		echo 2;
	}else{
		$query = mysql_query("DELETE FROM `tbl_subject` WHERE sub_id = '$sub_id'");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}
?>
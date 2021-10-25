<?php
include '../core/config.php';
	$cq_id = $_POST['id'];
	$count_t = mysql_fetch_array(mysql_query("SELECT status FROM tbl_class_quiz_head WHERE cq_id = '$cq_id'"));
	if($count_t[0] > 0){
		echo 2;
	}else{
		$query = mysql_query("DELETE FROM `tbl_class_quiz_head` WHERE cq_id = '$cq_id'");
		if($query){
			mysql_query("DELETE FROM `tbl_class_quiz_detail` WHERE cq_id = '$cq_id'");
			echo 1;
		}else{
			echo 0;
		}
	}
?>
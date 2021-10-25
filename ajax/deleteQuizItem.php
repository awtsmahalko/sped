<?php
include '../core/config.php';
	$id = $_POST['id'];
	$cq_id = $_POST['cq_id'];
	$query = mysql_query("DELETE FROM `tbl_class_quiz_detail` WHERE cqd_id = '$id' AND cq_id = '$cq_id'");
	if($query){
		echo 1;
	}else{
		echo 0;
	}

?>
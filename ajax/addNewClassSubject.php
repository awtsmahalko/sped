<?php
include '../core/config.php';
	$t_id = $_SESSION['account_id'];
	$sub_id = $_POST['sub_id'];
	$class_id = $_POST['class_id'];
	$count = mysql_fetch_array(mysql_query("SELECT COUNT(cs_id) FROM tbl_class_subject WHERE class_id = $class_id AND t_id = $t_id AND s_id = $sub_id"));
	if($count[0] > 0){
		echo 2;
	}else{
		$query = mysql_query("INSERT INTO `tbl_class_subject` (`cs_id`, `class_id`, `t_id`, `s_id`) VALUES (NULL, '$class_id', '$t_id', '$sub_id')");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}
?>
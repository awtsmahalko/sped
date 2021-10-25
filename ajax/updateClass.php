<?php
include '../core/config.php';
	//$t_id = $_SESSION['account_id'];
	$class_id = $_POST['u_class_id'];
	$class_code = clean($_POST['u_class_code']);
	$class_name = clean($_POST['u_class_name']);
	$class_section = clean($_POST['u_class_section']);
	$class_room = clean($_POST['u_class_room']);
	$t_id = $_POST['u_teacher'];
	$class_year = $_POST['u_class_year'];
	$count_cl = mysql_fetch_array(mysql_query("SELECT COUNT(class_id) FROM tbl_class WHERE class_id != $class_id AND class_year = '$class_year' AND class_name = '$class_name' AND class_section = '$class_section'"));
	if($count_cl[0] > 0){
		echo 2;
	}else{
		$query = mysql_query("UPDATE `tbl_class` SET `class_code` = '$class_code', `t_id` = '$t_id', `class_name` = '$class_name', `class_year` = '$class_year', `class_section` = '$class_section', `class_room` = '$class_room' WHERE class_id = '$class_id'");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}
?>
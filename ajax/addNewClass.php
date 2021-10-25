<?php
include '../core/config.php';
	//$t_id = $_SESSION['account_id'];
	$class_code = clean($_POST['class_code']);
	$class_name = clean($_POST['class_name']);
	$class_section = clean($_POST['class_section']);
	$class_room = clean($_POST['class_room']);
	$t_id = $_POST['teacher'];
	// $class_year = clean($_POST['class_year']);
	$class_year = getCurrentSY();
	$count_cl = mysql_fetch_array(mysql_query("SELECT COUNT(class_id) FROM tbl_class WHERE class_year = '$class_year' AND class_name = '$class_name' AND class_section = '$class_section'"));
	if($count_cl[0] > 0){
		echo 2;
	}else{
		$query = mysql_query("INSERT INTO `tbl_class` (`class_id`, `class_code`, `t_id`, `s_id`, `class_name`, `class_year`, `class_section`, `class_room`) VALUES (NULL, '$class_code', '$t_id', '', '$class_name', '$class_year', '$class_section', '$class_room')");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}
?>
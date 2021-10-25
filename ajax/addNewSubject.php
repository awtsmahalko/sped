<?php
include '../core/config.php';
	$t_id = $_SESSION['account_id'];
	$sub_code = clean($_POST['sub_code']);
	$sub_name = clean($_POST['sub_name']);
	$lang = 0;// $_POST['lang'];
	$sub_percent = $_POST['sub_percent'];
	$count = mysql_fetch_array(mysql_query("SELECT COUNT(sub_id) FROM tbl_subject WHERE t_id = $t_id AND (sub_name = '$sub_name' OR sub_code = '$sub_code')"));
	if($count[0] > 0){
		echo 2;
	}else{
		$query = mysql_query("INSERT INTO `tbl_subject` (`sub_id`, `t_id`, `sub_code`, `sub_name`, `sub_status`, `lang`, `sub_percent`) VALUES (NULL, '$t_id', '$sub_code', '$sub_name', '1', '$lang', '$sub_percent')");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}
?>
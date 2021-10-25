<?php
include '../core/config.php';
	$t_id = $_SESSION['account_id'];
	$sub_id = $_POST['u_sub_id'];
	$sub_code = clean($_POST['u_sub_code']);
	$sub_name = clean($_POST['u_sub_name']);
	$lang = 0;//$_POST['u_lang'];
	$sub_percent = $_POST['u_sub_percent'];
	$count = mysql_fetch_array(mysql_query("SELECT COUNT(sub_id) FROM tbl_subject WHERE sub_id != $sub_id AND t_id = $t_id AND (sub_name = '$sub_name' OR sub_code = '$sub_code')"));
	if($count[0] > 0){
		echo 2;
	}else{
		$query = mysql_query("UPDATE `tbl_subject` SET `sub_code` = '$sub_code', `sub_name` = '$sub_name', `lang` = '$lang', `sub_percent` = '$sub_percent' WHERE t_id = $t_id AND sub_id = $sub_id");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}
?>
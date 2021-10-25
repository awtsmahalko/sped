<?php
include '../core/config.php';
	$t_id = $_SESSION['account_id'];
	$degree_name = clean($_POST['degree_name']);
	$course = clean($_POST['course']);
	$school = clean($_POST['school']);
	$year_grad = clean($_POST['year_grad']);

	$query = mysql_query("INSERT INTO `tbl_degree`(`degree_id`, `degree_name`, `school`, `course`, `year_grad`, `t_id`) VALUES (NULL,'$degree_name','$school','$course','$year_grad',$t_id)");
	if($query){
		echo 1;
	}else{
		echo 0;
	}
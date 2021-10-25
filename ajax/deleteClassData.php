<?php
include '../core/config.php';
	$id = $_POST['id'];
	$field = $_POST['field'];
	$tbl = $_POST['table'];
	$query = mysql_query("DELETE FROM $tbl WHERE $field = '$id'");
	if($query){
		echo 1;
	}else{
		echo 0;
	}

?>
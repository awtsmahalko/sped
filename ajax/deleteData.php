<?php
include '../core/config.php';
	$id = $_POST['id'];
	$tbl = $_POST['table'];
	if(isset($_POST['data'])){
		$data = "WHERE ".$_POST['data'];
	}else{
		$data = "";
	}
	$query = mysql_query("DELETE FROM $tbl $data");
	if($query){
		echo 1;
	}else{
		echo 0;
	}

?>
<?php
include '../core/config.php';
	$school_year = $_POST['school_year'];
	$count = mysql_fetch_array(mysql_query("SELECT COUNT(school_year_id) FROM tbl_school_year WHERE school_year = '$school_year'"));
	if($count[0] > 0){
		echo 2;
	}else{
		$query = mysql_query("INSERT INTO `tbl_school_year` (`school_year_id`, `school_year`, `status`) VALUES (NULL, '$school_year', '1')");
		if($query){
			echo 1;
		}else{
			echo 0;
		}
	}
?>
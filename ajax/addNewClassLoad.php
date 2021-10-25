<?php
include '../core/config.php';
	$t_id = $_SESSION['account_id'];
	$stu_id = $_POST['stu_id'];
	$class_id = $_POST['class_id'];

	if(countStud($t_id,$stu_id,$class_id) > 0){
		echo 2;
	}else{
		$query = mysql_query("INSERT INTO `tbl_class_load` (`cl_id`, `class_id`, `t_id`, `stu_id`, `status`) VALUES (NULL, '$class_id', '$t_id', '$stu_id', '')");
		if($query){
			mysql_query("UPDATE tbl_student SET status = 1, t_id = $t_id WHERE stu_id = $stu_id");
			echo 1;
		}else{
			echo 0;
		}
	}
	function countStud($t_id,$stu_id,$class_id){
		$count = mysql_fetch_array(mysql_query("SELECT COUNT(cl_id) FROM tbl_class_load WHERE t_id = $t_id AND stu_id = $stu_id AND class_id = $class_id"));
		return $count[0];
	}
?>
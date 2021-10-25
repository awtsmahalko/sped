<?php
include '../core/config.php';
	$account_id = $_SESSION['account_id'];
	$class_id = $_POST['class_id_modal'];
	$sub_id = $_POST['subject_id_modal'];
	$quarter = $_POST['quarter_modal'];
	$quiz_name = $_POST['quiz_name'];
	$date_added = date("Y-m-d");
	if($quiz_name == 'Quiz 11'){
		echo 3;
	}else{
		$count = mysql_fetch_array(mysql_query("SELECT count(quiz_name) FROM `tbl_class_quiz_head` WHERE class_id = '$class_id' AND t_id = $account_id AND sub_id = $sub_id AND quiz_name = '$quiz_name' AND quarter = $quarter"));
		if($count[0] > 0){
			echo 2;
		}else{
			$query = mysql_query("INSERT INTO `tbl_class_quiz_head` (`cq_id`, `quiz_name`, `class_id`, `sub_id`, `t_id`, `date_added`, `quarter`) VALUES (NULL, '$quiz_name', '$class_id', '$sub_id', '$account_id', '$date_added', '$quarter')");
			if($query){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
?>
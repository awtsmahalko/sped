<?php
include '../core/config.php';
	$account_id = $_SESSION['account_id'];
	$sub_id = $_POST['sub_id'];
	$class_id = $_POST['class_id'];
	$quarter = $_POST['q_id'];

	$fetch = mysql_fetch_array(mysql_query("SELECT count(quiz_name) FROM `tbl_class_quiz_head` WHERE class_id = '$class_id' AND t_id = $account_id AND sub_id = $sub_id AND quarter = $quarter"));
	echo "Quiz ".($fetch[0] + 1);
?>
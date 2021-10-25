<?php
include '../core/config.php';
	$id = $_GET['id'];
	$question = clean($_POST['uquestion']);
	$choice_a = clean($_POST['uchoice_a']);
	$choice_b = clean($_POST['uchoice_b']);
	$answer = $_POST['uanswer'];
	
	$query = mysql_query("UPDATE `tbl_class_quiz_detail` SET `quest` = '$question', `item_1` = '$choice_a', `item_2` = '$choice_b', `answer` = '$answer' WHERE cqd_id = '$id'");
	if($query){
		echo 1;
	}else{
		echo 0;
	}
?>
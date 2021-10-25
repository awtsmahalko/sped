<?php
include '../core/config.php';
	$stu_id = $_SESSION['account_id'];
	$cqd_id = $_POST['cqd_id'];
	$cq_id = $_POST['cq_id'];
	$ans = $_POST['ans'];
	$item = $_POST['item'];
	$last_item = $_POST['last_item'];

	$query = mysql_query("UPDATE `tbl_stu_quiz_detail` SET `answer` = '$ans', status = 1 WHERE `cqd_id` = $cqd_id AND stu_id = $stu_id");
	if($query){
		if(($item - 1) == $last_item){
			$data = mysql_fetch_array(mysql_query("SELECT class_id,sub_id,t_id,quiz_name FROM tbl_class_quiz_head WHERE cq_id = $cq_id"));
			$date = date("Y-m-d");
			$score = getQuizItems($cq_id);
			mysql_query("UPDATE `tbl_stu_quiz_head` SET `status` = '1',date_taken = '$date', score = '$score' WHERE `cq_id` = $cq_id AND stu_id = '$stu_id'");
			echo md5('stu-subject')."&".md5('class_id')."=$data[0]&".md5('s_id')."=$data[1]";
			$msg = $_SESSION['pre']." ".$_SESSION['lname']." Answered $data[3] [".getSubjectName($data[1])."]";
			$link = md5('stu-view-quiz')."&quiz=$cq_id&id=".$stu_id;
			addNotif("Answered Quiz",$msg,$link,0,1);
			addNotif("Answered Quiz",$msg,$link,2,$data[2]);
		}else{
			echo md5('stu-take-quiz')."&cq_id=$cq_id&item_no=$item";
		}
	}else{
		echo 0;
	}

	function getQuizItems($cq_id){
		$fetch_quest = mysql_query("SELECT cqd_id,answer FROM tbl_class_quiz_detail WHERE cq_id = $cq_id ORDER BY item_no ASC");
		$data = 0;
		while($row_quest = mysql_fetch_array($fetch_quest)){
			$data += checkMyAnswer($row_quest['answer'],$row_quest['cqd_id']);
		}
		return $data;
	}
	function checkMyAnswer($ans,$cqd){
		$user_id = $_SESSION['account_id'];
		$count = mysql_fetch_array(mysql_query("SELECT COUNT(sqd_id) FROM `tbl_stu_quiz_detail` WHERE cqd_id = $cqd AND stu_id = $user_id AND answer = '$ans' AND status = 1"));
		return $count[0];
	}
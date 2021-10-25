<?php
include '../../core/config.php';
	$account_id = $_SESSION['account_id'];
	if($_SESSION['user_type'] == 2){
		$inject = "AND t_id = $account_id";
	}else{
		$inject = "";
	}
	$id = $_GET['id'];
	$sub_id = $_GET['sub_id'];
	$quarter = $_GET['quarter'] * 1;

	$result = mysql_query("SELECT * FROM `tbl_class_quiz_head` WHERE class_id = '$id' AND sub_id = $sub_id AND quarter = $quarter $inject") or die (mysql_error());
	$count = 1;
	$response['data'] = array();
	while($row = mysql_fetch_array($result)){
		if($_SESSION['user_type'] == 2){
			$action = "<button class='btn btn-success' onclick='window.location=\"index.php?page=".md5('class-quiz')."&class_id=$id&sub_id=$sub_id&quiz=".$row['cq_id']."\"'><span class='fa fa-list'></span></button>
				<button class='btn btn-danger' onclick='removeQuiz($row[0],\"".$row['quiz_name']."\")'><span class='fa fa-trash'></span></button>";
		}else{
			$action = "<button class='btn btn-success' onclick='window.location=\"index.php?page=".md5('class-quiz')."&class_id=$id&sub_id=$sub_id&quiz=".$row['cq_id']."\"'><span class='fa fa-list'></span></button>";
		}
		$count_t = mysql_fetch_array(mysql_query("SELECT COUNT(cq_id) FROM tbl_class_quiz_detail WHERE cq_id = '$row[0]'"));
		$sub = getData("sub_name","tbl_subject","sub_id = ".$row['sub_id']." AND t_id = $account_id");
		$list = array();
		if($row['quarter'] == 1){
			$quarter = "<span class='label label-rouded label-danger'>FIRST</span>";
		}else if($row['quarter'] == 2){
			$quarter = "<span class='label label-rouded label-danger'>SECOND</span>";
		}else if($row['quarter'] == 3){
			$quarter = "<span class='label label-rouded label-danger'>THIRD</span>";
		}else if($row['quarter'] == 4){
			$quarter = "<span class='label label-rouded label-danger'>FOURTH</span>";
		}else{
			$quarter = "<span class='label label-rouded label-danger'>NOT FOUND</span>";
		}
		$list['count'] = $count;
		$list['teacher'] = getTeacherName($row['t_id']);
		$list['quiz_name'] = $row['quiz_name'];
		$list['quarter'] = $quarter;
		$list['no'] = $count_t[0];
		$list['total'] = getOver($row['cq_id']);
		$list['status'] = ($row['status'] == 1)?"<span class='label label-rouded label-success'>POSTED</span>":"<span class='label label-rouded label-danger'>SAVED</span>";
		$list['action'] = $action;
		array_push($response['data'], $list);
	$count++;
	}
	echo json_encode($response);
	function getOver($cq_id){
		$fetch = mysql_fetch_array(mysql_query("SELECT COUNT(cq_id) FROM `tbl_stu_quiz_head` WHERE cq_id = $cq_id AND status = 1"));
		return $fetch[0];
	}
?>
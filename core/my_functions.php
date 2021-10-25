<?php
function addUser($username,$pass,$user_type,$account_id){
	// $password = strtolower(str_replace(" ", "", $pass));
	$password = $pass;
	mysql_query("INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `user_type`, `account_id`, `user_status`, `date_added`) VALUES (NULL, '$username', '".md5($password)."', '$user_type`', '$account_id', '1', '".date('Y-m-d H:i:s')."')");
}
function getStudentName($stu_id){
	$fetch = mysql_fetch_array(mysql_query("SELECT * FROM tbl_student WHERE stu_id = $stu_id"));
	return $fetch['stu_fname']." ".$fetch['stu_mname']." ".$fetch['stu_lname'];
}
function getAge($dateOfBirth){
	$dateOfBirth = date("d-m-Y", strtotime($dateOfBirth));
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	return $diff->format('%y');
}
function getTeacherName($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT * FROM tbl_teacher WHERE t_id = $id"));
	return $fetch['t_fname']." ".$fetch['t_mname']." ".$fetch['t_lname'];
}
function getTeacherNick($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT * FROM tbl_teacher WHERE t_id = $id"));
	($fetch['t_gender'] == 1)?$g="Mr.":$g="Ms.";
	return $g." ".$fetch['t_lname'];
}
function getQuizName($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT quiz_name FROM tbl_class_quiz_head WHERE cq_id = $id"));
	return $fetch[0];
}
function getSubjectName($id){
	$fetch = mysql_fetch_array(mysql_query("SELECT sub_name FROM tbl_subject WHERE sub_id = $id"));
	return $fetch[0];
}
function addNotif($title,$message,$link,$user_type,$user_id){
	date_default_timezone_set("Asia/Manila");
	$date_added = date("Y-m-d H:i:s");
	mysql_query("INSERT INTO `tbl_notification`(`notif_id`, `user_type`, `user_id`, `title`, `message`, `link`, `date_added`) VALUES (NULL,'$user_type','$user_id','$title','$message','$link','$date_added')");
}
function getData($field,$table,$value){
	if($value == ""){
		$inject = "";
	}else{
		$inject = " WHERE $value";
	}
	$fetch = mysql_fetch_array(mysql_query("SELECT $field FROM $table$inject"));
	return $fetch;
}

function stuQuizNotif($title,$msg,$class_id,$sub_id){
$link = md5('stu-subject')."&".md5('class_id')."=".$class_id."&".md5('s_id')."=".$sub_id;
$query = mysql_query("SELECT stu_id FROM tbl_class_load WHERE class_id = $class_id");
	while ($row = mysql_fetch_array($query)) {
		addNotif($title,$msg,$link,1,$row[0]);
	}
}
function getRemarks($score){
	if (($score <= 100) && ($score >= 90)){
		$text = "C";
	}else if (($score <= 89) && ($score >= 75)){
		$text = "D";
	}else{
		$text = "B";
	}
	return $text;
}
function getCurrentSY(){
	$fetch = mysql_fetch_array(mysql_query("SELECT school_year FROM `tbl_school_year` WHERE status = 1 ORDER BY school_year DESC LIMIT 1"));
	return $fetch[0];
}
function getEnrolled($sy){
	$fetch = mysql_fetch_array(mysql_query("SELECT COUNT(c.class_id) FROM `tbl_class` AS c, tbl_class_load AS cl WHERE cl.class_id = c.class_id AND c.class_year = '$sy'"));
	return $fetch[0];
}
?>